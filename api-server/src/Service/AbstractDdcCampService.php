<?php


namespace App\Service;


use App\Entity\AbstractDdcCampEntity;
use App\Entity\Adherent;
use App\Entity\Camp;
use App\Entity\CampHistoriqueModification;
use App\Enums\JMS\RestSerializerGroupCampEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;
use App\Enums\JMS\RestSerializerGroupEnum;
use DateTime;
use DateTimeZone;
use Doctrine\Common\Persistence\ManagerRegistry;
use Exception;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Swaggest\JsonDiff\Exception as JsonDiffException;
use Swaggest\JsonDiff\JsonDiff;

/**
 * Class AbstractDdcService
 * @package App\Service
 */
abstract class AbstractDdcCampService extends AbstractDdcService
{
    private $serializer;

    function __construct(ManagerRegistry $doctrine, SerializerInterface $serializer)
    {
        parent::__construct($doctrine);
        $this->serializer = $serializer;
    }

    /** Retourne un object contenant la représentation des seules properties modifiable.
     * @param Camp $entity
     * @param RestSerializerGroupCampModuleEnum|null $module
     * @return mixed
     */
    protected function serializeUpdatableEntity(Camp $entity, RestSerializerGroupCampModuleEnum $module = null) {
        $groups = array(
            RestSerializerGroupEnum::IDENTIFIANT,
            RestSerializerGroupCampEnum::HISTORISABLE
        );

        $dataToserialize = $entity;

        if ($module) {
            $groups[] = $module->getValue();

            /*
             * Trick pour contourner problème de détection des changements sur les tableaux avec jsonDiff
             */
            switch ($module) {
                case RestSerializerGroupCampModuleEnum::PARTICIPANT():
                    $dataToserialize = [];
                    foreach($entity->getParticipants() as $item) {
                        $dataToserialize[$item->getId()] = $item;
                    }
                    break;
                case RestSerializerGroupCampModuleEnum::STAFF():
                    $dataToserialize = [];
                    foreach($entity->getStaffs() as $item) {
                        $dataToserialize[$item->getId()] = $item;
                    }
                    break;
            }
        }

        $context = SerializationContext::create()->setGroups($groups);

        return json_decode($this->serializer->serialize($dataToserialize, 'json', $context));
    }

    /** Prépare l'enregistrement des modification apportées à l'entité donnée
     * @param RestSerializerGroupCampModuleEnum $module
     * @param Adherent $adherent
     * @param $originalEntityArray
     * @param Camp $newEntity
     * @return CampHistoriqueModification
     * @throws JsonDiffException
     */
    protected function createHistorisationData(RestSerializerGroupCampModuleEnum $module, Adherent $adherent,
                                               $originalEntityArray, Camp $newEntity) : CampHistoriqueModification {

        $diffData = new JsonDiff($originalEntityArray, $this->serializeUpdatableEntity($newEntity, $module),
            JsonDiff::REARRANGE_ARRAYS  /* tentative de détection des ids */
            + JsonDiff::SKIP_JSON_PATCH
            + JsonDiff::SKIP_JSON_MERGE_PATCH
            + JsonDiff::COLLECT_MODIFIED_DIFF);

        $diff = [
            'changed' => $diffData->getModifiedDiff(),
            'added' => $diffData->getAdded(),
            'removed' => $diffData->getRemoved(),
        ];

        $histoData = new CampHistoriqueModification();
        $histoData->setCamp($newEntity);
        $histoData->setCodeModule($module);
        $histoData->setDateHeureModification(new DateTime(null, new DateTimeZone('Europe/Paris')));
        $histoData->setAdherent($adherent);
        $histoData->setModificationJson(json_encode($diff));
        return $histoData;
    }

}