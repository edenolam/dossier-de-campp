<?php


namespace App\Service;

use App\Entity\Adherent;
use App\Entity\Camp;
use App\Entity\CampDiscussionEchange;
use App\Entity\CampDiscussionSujet;
use App\Enums\CampDiscussionSujetStatutEnum;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;

/**
 * Class CampDiscussionSujetService
 * @package App\Service
 */
class CampDiscussionSujetService extends AbstractDdcCampService
{
    /**
     * @param int $id
     * @return CampDiscussionSujet
     * @throws EntityNotFoundException
     */
    function getById(int $id) : CampDiscussionSujet {
        /** @var CampDiscussionSujet $sujet */
        $sujet = $this->getDdcRepository(CampDiscussionSujet::class)->find($id);
        if (!$sujet) {
            throw new EntityNotFoundException('La discussion avec l\'identifiant '.$id.' n\'existe pas.');
        }
        return $sujet;
    }

    /**
     * @param int $idCamp
     * @param string|null $codeModule
     * @param string|null $statut
     * @return CampDiscussionSujet[]
     */
    function listerCampDiscussions(int $idCamp, ?string $codeModule = null, ?string $statut = null): array
    {
        $criterias = [
            'camp' => $idCamp
        ];
        if ($codeModule) {
            $criterias['codeModule'] = $codeModule;
        }
        if ($statut) {
            $criterias['statut'] = $statut;
        }

        /** @var CampDiscussionSujet[] $discussions */
        $discussions = $this->getDdcRepository(CampDiscussionSujet::class)->findBy($criterias, ['dateHeureCreation' => 'desc']);
        return $discussions;
    }

    /**
     * @param CampDiscussionSujet $sujet
     * @param string $userNumero
     *
     * @return CampDiscussionSujet
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function creerDiscussion(CampDiscussionSujet $sujet, string $userNumero): CampDiscussionSujet
    {
        /** @var Adherent $adherent */
        $adherent = $this->getDdcRepository(Adherent::class)->find($userNumero);
        /** @var Camp $camp */
        $camp = $this->getDdcRepository(Camp::class)->find($sujet->getCamp()->getId());

        // Création de la discussion
        $newDiscussion = new CampDiscussionSujet();
        $newDiscussion->setCamp($camp)
            ->setCodeModule($sujet->getCodeModule())
            ->setAdherentCreateur($adherent)
            ->setDateHeureCreation(new DateTime(null, new DateTimeZone('Europe/Paris')))
            ->setStatut(CampDiscussionSujetStatutEnum::OUVERT)
            ->setSujet($sujet->getSujet());

        if ($sujet->getAdherentDestinataire()) {
            $numero = $sujet->getAdherentDestinataire()->getNumero();
            /** @var Adherent $destinataire */
            $destinataire = $this->getDdcRepository(Adherent::class)->find($numero);
            $newDiscussion->setAdherentDestinataire($destinataire);
        }

        $em = $this->getDdcEm();
        $em->persist($newDiscussion);
        $em->flush();
        return $newDiscussion;
    }

    /**
     * @param CampDiscussionSujet $sujet
     * @param string $userNumero
     * @return CampDiscussionSujet
     * @throws EntityNotFoundException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws \Swaggest\JsonDiff\Exception
     */
    public function modifierSujet(CampDiscussionSujet $sujet, string $userNumero): CampDiscussionSujet
    {
        /** @var CampDiscussionSujet $dbEntity */
        $dbEntity = $this->getDdcRepository(CampDiscussionSujet::class)->find($sujet->getId());
        if (!$dbEntity) {
            throw new EntityNotFoundException('La discussion avec l\'identifiant ' . $sujet->getId() . ' n\'existe pas.');
        }

        /** @var Adherent $adherent */
        $adherent = $this->getDdcRepository(Adherent::class)->find($userNumero);

        // Mise à jour de la discussion
        $dbEntityOriginal = $this->serializeUpdatableEntity($dbEntity);

        // Mise à jour des propriétés modifiables
        $em = $this->getDdcEm();
        $dbEntity->setStatut($sujet->getStatut());
        $dbEntity->setSujet($sujet->getSujet());

        if ($sujet->getAdherentDestinataire()) {
            $numero = $sujet->getAdherentDestinataire()->getNumero();
            /** @var Adherent $destinataire */
            $destinataire = $this->getDdcRepository(Adherent::class)->find($numero);
            $dbEntity->setAdherentDestinataire($destinataire);
        }

        $em->persist($dbEntity);

        // Génération de l'entrée d'historique des modifications
        $histoData = $this->createHistorisationData($dbEntity->getCamp(), $dbEntity->getCodeModule(), $adherent, $dbEntityOriginal, $dbEntity);
        $em->persist($histoData);

        $em->flush();
        return $dbEntity;
    }

    /**
     * @param CampDiscussionEchange $echange
     * @param string $userNumero
     * @return CampDiscussionSujet
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Exception
     */
    public function ajouterEchange(CampDiscussionEchange $echange, string $userNumero): CampDiscussionSujet
    {
        /** @var Adherent $adherent */
        $adherent = $this->getDdcRepository(Adherent::class)->find($userNumero);
        /** @var CampDiscussionSujet $sujet */
        $sujet = $this->getDdcRepository(CampDiscussionSujet::class)->find($echange->getSujet()->getId());

        $em = $this->getDdcEm();

        // Mise à jour des propriétés write-once
        $echange->setSujet($sujet);
        $echange->setAdherentEchange($adherent);
        $echange->setDateHeureEchange(new DateTime(null, new DateTimeZone('Europe/Paris')));

        // Mise à jour du status par défaut
        $em->persist($echange);

        $em->flush();

        $em->refresh($sujet);
        return $sujet;
    }
}