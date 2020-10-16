<?php


namespace App\Controller\Rest;

use App\Entity\CampDiscussionEchange;
use App\Entity\CampDiscussionSujet;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Service\CampDiscussionSujetService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CampDiscussionSujetController
 *
 * @SWG\Tag(name="Camp - Echange sur discussion")
 *
 * @package App\Controller\Rest
 */
class CampDiscussionEchangeController extends AbstractDdcRestController
{
    /**
     * @Rest\Post("/camp-discussion-echanges")
     * @ParamConverter("echange", converter="fos_rest.request_body")
     *
     * @SWG\Parameter(
     *      name="body",
     *      in="body",
     *      description="Détail d'un nouvel échange",
     *      type="json",
     *      required=true,
     *      @Model(type=CampDiscussionEchange::class, groups={RestSerializerGroupEnum::CREATION_ENFANT, RestSerializerGroupEnum::REF})
     * )
     * @SWG\Response(
     *     description="Retourne la discussion.",
     *     response=200,
     *     @Model(type=CampDiscussionSujet::class, groups={RestSerializerGroupEnum::TOUJOURS})
     * )
     *
     * @Rest\View(serializerGroups={
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     *
     * @param CampDiscussionEchange $echange
     * @return View
     */
    public function creerEchange(CampDiscussionEchange $echange): View
    {
        // FIXME Récupérer userNumero depuis le Token
        $userNumero = '150000000';

        $sujet = $this->getDdcService(CampDiscussionSujetService::class)->ajouterEchange($echange, $userNumero);
        return View::create($sujet, Response::HTTP_OK);
    }


}