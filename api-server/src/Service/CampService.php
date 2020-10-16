<?php


namespace App\Service;


use App\Controller\Rest\Dto\CampCreationDto;
use App\Entity\Adherent;
use App\Entity\Camp;
use App\Entity\Camp817;
use App\Entity\CampAdherentParticipant;
use App\Entity\CampAdherentStaff;
use App\Entity\CampHistoriqueModification;
use App\Entity\CampModule;
use App\Entity\CampStructure;
use App\Entity\Structure;
use App\Entity\TypeCamp;
use App\Entity\TypeCampModule;
use App\Enums\CampModuleFixeEnum;
use App\Enums\CampStatutEnum;
use App\Enums\GroupeCampEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use DomainException;
use Swaggest\JsonDiff\Exception;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class CampService
 * @package App\Service
 */
class CampService extends AbstractDdcCampService
{
    /** Retourne la liste des camps
     * @return array
     */
    function getCamps(): array
    {
        return $this->getDdcRepository(Camp::class)->findAll();
    }

    /**
     * @param int $id
     * @return Camp
     * @throws EntityNotFoundException
     */
    function getCamp(int $id): Camp
    {
        /** @var Camp $camp */
        $camp = $this->getDdcRepository(Camp::class)->find($id);
        if (!$camp) {
            throw new EntityNotFoundException('Le camp avec l\'identifiant ' . $id . ' n\'existe pas.');
        }
        return $camp;
    }

    /** Initialisation d'un nouveau camp
     * @param CampCreationDto $campCreationDto
     * @param string $userNumero
     * @return Camp
     * @throws ORMException
     * @throws OptimisticLockException
     */
    function creerCamp(CampCreationDto $campCreationDto, string $userNumero): Camp
    {

        /** @var Adherent $adherent */
        $adherent = $this->getDdcRepository(Adherent::class)->find($userNumero);
        /** @var TypeCamp $typeCamp */
        $typeCamp = $this->getDdcRepository(TypeCamp::class)->find($campCreationDto->getCodeTypeCamp());

        // Initialisation du camp
        $camp = new Camp();
        $camp
            ->setTypeCamp($typeCamp)
            ->setCodeGroupeCamp($typeCamp->getCodeGroupeCamp())
            ->setLibelle($campCreationDto->getLibelle())
            ->setDateDebut($campCreationDto->getDateDebut())
            ->setDateFin($campCreationDto->getDateFin())
            ->setStatut(CampStatutEnum::INITIAL);

        // Création de l'enregistrement spécifique au groupe de camp
        switch ($typeCamp->getCodeGroupeCamp()) {
            case GroupeCampEnum::GC_8_17:
                $camp817 = new Camp817();
                $camp->setCamp817($camp817);
                break;
            default:
                throw new DomainException("Le groupe de camp \"" . $typeCamp->getCodeGroupeCamp() . "\" n'est pas encore implémenté.", 1000);
        }

        // Rattachement des modules sélectionnés
        foreach ($campCreationDto->getCodemodules() as $codemodule) {
            /** @var TypeCampModule $typeCampModule */
            $typeCampModule = $this->getDdcRepository(TypeCampModule::class)
                ->findOneBy(['typeCamp' => $campCreationDto->getCodeTypeCamp(), 'module' => $codemodule]);

            if ($typeCampModule == null) throw new BadRequestHttpException("Le module \"" . $codemodule . "\" n'est pas disponible pour le type de camp \"" . $campCreationDto->getCodeTypeCamp() . "\".");

            $campModule = new CampModule();
            $campModule
                ->setModule($typeCampModule->getModule())
                ->setActif(true);

            // Ajout à la liste des modules
            $camp->addModule($campModule);
        }

        // Création histo création
        $histoData = new CampHistoriqueModification();
        $histoData
            ->setCamp($camp)
            ->setCodeModule(CampModuleFixeEnum::GENERAL)
            ->setDateHeureModification(new DateTime(null, new DateTimeZone('Europe/Paris')))
            ->setAdherent($adherent)
            ->setModificationJson("{}");

        // exécution des opérations Db
        $em = $this->getDdcEm();
        $em->persist($camp);

        // Mise en place ref croisée
        $camp->setHistoCreation($histoData);
        $em->persist($camp);

        $em->flush();
        return $camp;
    }

    /**
     * @param Camp $camp
     * @param RestSerializerGroupCampModuleEnum $module
     * @param string $userNumero
     * @return Camp
     * @throws EntityNotFoundException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    function modifierCampModule(Camp $camp, RestSerializerGroupCampModuleEnum $module, string $userNumero): Camp
    {
        /** @var Camp $dbCamp */
        $dbCamp = $this->getDdcRepository(Camp::class)->find($camp->getId());
        if (!$dbCamp) {
            throw new EntityNotFoundException('La discussion avec l\'identifiant ' . $camp->getId() . ' n\'existe pas.');
        }

        /** @var Adherent $adherent */
        $adherent = $this->getDdcRepository(Adherent::class)->find($userNumero);

        // Mise à jour de la discussion
        $dbCampFingerPrint = $this->serializeUpdatableEntity($dbCamp, $module);

        // Mise à jour des propriétés modifiables
        $em = $this->getDdcEm();

        switch ($module) {
            /*
             * Informations générales relatives au camp
             */
            case RestSerializerGroupCampModuleEnum::INFO_GENERALE:

                // Mise à jour infos de camp
                $dbCamp
                    ->setLibelle($camp->getLibelle())
                    ->setSynthese($camp->getSynthese())
                    ->setDateDebut($camp->getDateDebut())
                    ->setDateFin($camp->getDateFin());

                // Mise à jour des infos propres au type de camp
                switch ($dbCamp->getCodeGroupeCamp()) {
                    case GroupeCampEnum::GC_8_17:
                        $camp817 = $camp->getCamp817();
                        $dbCamp->getCamp817()
                            ->setPrevisionNbre613($camp817->getPrevisionNbre613())
                            ->setPrevisionNbre1417($camp817->getPrevisionNbre1417())
                            ->setPrevisionNbreAnimateurs($camp817->getPrevisionNbreAnimateurs())
                            ->setPrevisionNbreFilles($camp817->getPrevisionNbreFilles())
                            ->setPrevisionNbreGarcons($camp817->getPrevisionNbreGarcons())
                            ->setPrevisionNbreParticipants($camp817->getPrevisionNbreParticipants())
                            ->setAgeMaxi($camp817->getAgeMaxi())
                            ->setAgeMini($camp817->getAgeMini());
                        break;
                    default:
                }

                // Mise à jour des structures rattachées

                /** @var CampStructure[] $currStructures */
                $currStructures =  $dbCamp->getStructures()->toArray();
                $dbCamp->getStructures()->clear();

                foreach ($camp->getStructures() as $campStructure) {
                    if ($campStructure->getId() == 0) {
                        /** @var Structure $structure */
                        $structure = $this->getDdcRepository(Structure::class)->find($campStructure->getStructure());
                        $campStructureToIns = new CampStructure();
                        $campStructureToIns
                            ->setOrganisatrice($campStructure->isOrganisatrice())
                            ->setParticipante($campStructure->isParticipante())
                            ->setStructure($structure);
                        $dbCamp->addStructure($campStructureToIns);
                    }
                    else {
                        foreach ($currStructures as $currStructure) {
                            if ($currStructure->getId() == $campStructure->getId()) {
                                $currStructure
                                    ->setOrganisatrice($campStructure->isOrganisatrice())
                                    ->setParticipante($campStructure->isParticipante());
                                if ($currStructure->getStructure()->getCode() != $campStructure->getStructure()->getCode()) {
                                    /** @var Structure $structure */
                                    $structure = $this->getDdcRepository(Structure::class)->find($campStructure->getStructure());
                                    $currStructure->setStructure($structure);
                                }
                                $dbCamp->addStructure($currStructure);
                            }
                        }
                    }
                }
                break;

            /*
             * Liste des participants au camp
             */
            case RestSerializerGroupCampModuleEnum::PARTICIPANT:

                /** @var CampAdherentParticipant[] $currParticipants */
                $currParticipants =  $dbCamp->getParticipants()->toArray();
                $dbCamp->clearParticipants();

                foreach ($camp->getParticipants() as $campParticipant) {
                    if (!$campParticipant->getId() || $campParticipant->getId() == 0) {
                        /** @var Adherent $participant */
                        $participant = $this->getDdcRepository(Adherent::class)->find($campParticipant->getAdherent());
                        $campParticipantToIns = new CampAdherentParticipant();
                        $campParticipantToIns
                            ->setDateDebutPresence($campParticipant->getDateDebutPresence())
                            ->setDateFinPresence($campParticipant->getDateFinPresence())
                            ->setAdherent($participant)
                            ->setMossAccompagnementSpecifique($campParticipant->getMossAccompagnementSpecifique())
                            ->setChefEquipe($campParticipant->getChefEquipe())
                            ->setCoordonneesParents($campParticipant->getCoordonneesParents());
                        $dbCamp->addParticipant($campParticipantToIns);
                    }
                    else {
                        foreach ($currParticipants as $currParticipant) {
                            if ($currParticipant->getId() == $campParticipant->getId()) {
                                $currParticipant
                                    ->setDateDebutPresence($campParticipant->getDateDebutPresence())
                                    ->setDateFinPresence($campParticipant->getDateFinPresence())
                                    ->setMossAccompagnementSpecifique($campParticipant->getMossAccompagnementSpecifique())
                                    ->setChefEquipe($campParticipant->getChefEquipe())
                                    ->setCoordonneesParents($campParticipant->getCoordonneesParents());

                                if ($currParticipant->getAdherent()->getNumero() != $campParticipant->getAdherent()->getNumero()) {
                                    /** @var Adherent $participant */
                                    $participant = $this->getDdcRepository(Adherent::class)->find($campParticipant->getAdherent());
                                    $currParticipant->setAdherent($participant);
                                }
                                $dbCamp->addParticipant($currParticipant);
                            }
                        }
                    }
                }

                break;

            /*
             * Lise des membres du staff du camp
             */
            case RestSerializerGroupCampModuleEnum::STAFF:

                /** @var CampAdherentStaff[] $currStaffs */
                $currStaffs =  $dbCamp->getStaffs()->toArray();
                $dbCamp->clearStaffs();

                foreach ($camp->getStaffs() as $campStaff) {
                    if ($campStaff->getId() == 0) {
                        /** @var Adherent $participant */
                        $participant = $this->getDdcRepository(Adherent::class)->find($campStaff->getAdherent());
                        $campStaffToIns = new CampAdherentStaff();
                        $campStaffToIns
                            ->setDateDebutPresence($campStaff->getDateDebutPresence())
                            ->setDateFinPresence($campStaff->getDateFinPresence())
                            ->setAdherent($participant)
                            ->setMossAccompagnementSpecifique($campStaff->getMossAccompagnementSpecifique())

                            ->setRoleStaffDirecteur($campStaff->getRoleStaffDirecteur())
                            ->setRoleStaffChef($campStaff->getRoleStaffChef())

                            ->setValidationStagePratiqueBafa($campStaff->getValidationStagePratiqueBafa())
                            ->setValidationStagePratiqueBafd1($campStaff->getValidationStagePratiqueBafd1())
                            ->setValidationStagePratiqueBafd2($campStaff->getValidationStagePratiqueBafd2())

                            ->setRoleMaitriseIntendant($campStaff->getRoleMaitriseIntendant())
                            ->setRoleMaitriseTresorier($campStaff->getRoleMaitriseTresorier())
                            ->setRoleMaitriseAS($campStaff->getRoleMaitriseAS())
                            ->setRoleMaitriseMateriel($campStaff->getRoleMaitriseMateriel())
                            ->setRoleMaitriseAutre($campStaff->getRoleMaitriseAutre())
                            ->setRoleMaitriseAutreDetail($campStaff->getRoleMaitriseAutreDetail());

                        $dbCamp->addStaff($campStaffToIns);
                    }
                    else {
                        foreach ($currStaffs as $currStaff) {
                            if ($currStaff->getId() == $campStaff->getId()) {
                                $currStaff
                                    ->setDateDebutPresence($campStaff->getDateDebutPresence())
                                    ->setDateFinPresence($campStaff->getDateFinPresence())
                                    ->setMossAccompagnementSpecifique($campStaff->getMossAccompagnementSpecifique())

                                    ->setRoleStaffDirecteur($campStaff->getRoleStaffDirecteur())
                                    ->setRoleStaffChef($campStaff->getRoleStaffChef())

                                    ->setValidationStagePratiqueBafa($campStaff->getValidationStagePratiqueBafa())
                                    ->setValidationStagePratiqueBafd1($campStaff->getValidationStagePratiqueBafd1())
                                    ->setValidationStagePratiqueBafd2($campStaff->getValidationStagePratiqueBafd2())

                                    ->setRoleMaitriseIntendant($campStaff->getRoleMaitriseIntendant())
                                    ->setRoleMaitriseTresorier($campStaff->getRoleMaitriseTresorier())
                                    ->setRoleMaitriseAS($campStaff->getRoleMaitriseAS())
                                    ->setRoleMaitriseMateriel($campStaff->getRoleMaitriseMateriel())
                                    ->setRoleMaitriseAutre($campStaff->getRoleMaitriseAutre())
                                    ->setRoleMaitriseAutreDetail($campStaff->getRoleMaitriseAutreDetail());

                                if ($currStaff->getAdherent()->getNumero() != $campStaff->getAdherent()->getNumero()) {
                                    /** @var Adherent $participant */
                                    $participant = $this->getDdcRepository(Adherent::class)->find($campStaff->getAdherent());
                                    $currStaff->setAdherent($participant);
                                }
                                $dbCamp->addStaff($currStaff);
                            }
                        }
                    }
                }

                break;

            default:
                throw new DomainException("La mise à jour des informations du module \"" . $module . "\" n'est pas encore implémentée.", 2000);

        }

        $em->persist($dbCamp);
        $em->flush();

        // Génération de l'entrée d'historique des modifications
        $histoData = $this->createHistorisationData($module, $adherent, $dbCampFingerPrint, $dbCamp);
        $em->persist($histoData);

        $dbCamp->setHistoDerniereModification($histoData);
        $em->persist($dbCamp);

        $em->flush();
        return $dbCamp;
    }

    public function getLastModuleModification(int $id, string $codeModule)
    {
        return $this->getDdcRepository(CampHistoriqueModification::class)
            ->getLastModuleModification($id, $codeModule);
    }
}