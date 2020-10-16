<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupCampEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;

/**
 * Camp817
 *
 * @ORM\Table(name="camp_8_17")
 * @ORM\Entity
 */
class Camp817
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @JMS\Exclude()
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="moss_nbre_accompagnement_specifique", type="integer", nullable=false, options={"comment"="Nombre de participants/staff cohé en tant que mossAccompagnementSpecifique"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $mossNbreAccompagnementSpecifique = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="moss_activite_marine", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $mossActiviteMarine = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="moss_projet_international", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $mossProjetInternational = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="moss_accueil_unite_etrangere", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $mossAccueilUniteEtrangere = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="moss_camp_accompagne", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $mossCampAccompagne = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="moss_camp_jumele", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $mossCampJumele = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="moss_activite_en_autonomie", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $mossActiviteEnAutonomie = false;

    /**
     * @var int
     *
     * @ORM\Column(name="prevision_nbre_animateurs", type="integer", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $previsionNbreAnimateurs = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="prevision_nbre_participants", type="integer", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $previsionNbreParticipants = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="prevision_nbre_filles", type="integer", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $previsionNbreFilles = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="prevision_nbre_garcons", type="integer", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $previsionNbreGarcons = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="prevision_nbre_6_13", type="integer", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $previsionNbre613 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="prevision_nbre_14_17", type="integer", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $previsionNbre1417 = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="age_mini", type="integer", nullable=false, options={"default"="8"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $ageMini = '8';

    /**
     * @var int
     *
     * @ORM\Column(name="age_maxi", type="integer", nullable=false, options={"default"="17"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $ageMaxi = '17';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire_staff", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $commentaireStaff;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone_contact_staff", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $telephoneContactStaff;

    /**
     * @var string|null
     *
     * @ORM\Column(name="projet_peda_bilan_annee", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $projetPedaBilanAnnee;

    /**
     * @var string|null
     *
     * @ORM\Column(name="projet_peda_ambitions", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $projetPedaAmbitions;

    public function getId(): int
    {
        return $this->id;
    }

    public function getMossNbreAccompagnementSpecifique(): ?int
    {
        return $this->mossNbreAccompagnementSpecifique;
    }

    public function setMossNbreAccompagnementSpecifique(int $mossNbreAccompagnementSpecifique): self
    {
        $this->mossNbreAccompagnementSpecifique = $mossNbreAccompagnementSpecifique;

        return $this;
    }

    public function getMossActiviteMarine(): ?bool
    {
        return $this->mossActiviteMarine;
    }

    public function setMossActiviteMarine(bool $mossActiviteMarine): self
    {
        $this->mossActiviteMarine = $mossActiviteMarine;

        return $this;
    }

    public function getMossProjetInternational(): ?bool
    {
        return $this->mossProjetInternational;
    }

    public function setMossProjetInternational(bool $mossProjetInternational): self
    {
        $this->mossProjetInternational = $mossProjetInternational;

        return $this;
    }

    public function getMossAccueilUniteEtrangere(): ?bool
    {
        return $this->mossAccueilUniteEtrangere;
    }

    public function setMossAccueilUniteEtrangere(bool $mossAccueilUniteEtrangere): self
    {
        $this->mossAccueilUniteEtrangere = $mossAccueilUniteEtrangere;

        return $this;
    }

    public function getMossCampAccompagne(): ?bool
    {
        return $this->mossCampAccompagne;
    }

    public function setMossCampAccompagne(bool $mossCampAccompagne): self
    {
        $this->mossCampAccompagne = $mossCampAccompagne;

        return $this;
    }

    public function getMossCampJumele(): ?bool
    {
        return $this->mossCampJumele;
    }

    public function setMossCampJumele(bool $mossCampJumele): self
    {
        $this->mossCampJumele = $mossCampJumele;

        return $this;
    }

    public function getMossActiviteEnAutonomie(): ?bool
    {
        return $this->mossActiviteEnAutonomie;
    }

    public function setMossActiviteEnAutonomie(bool $mossActiviteEnAutonomie): self
    {
        $this->mossActiviteEnAutonomie = $mossActiviteEnAutonomie;

        return $this;
    }

    public function getPrevisionNbreAnimateurs(): ?int
    {
        return $this->previsionNbreAnimateurs;
    }

    public function setPrevisionNbreAnimateurs(int $previsionNbreAnimateurs): self
    {
        $this->previsionNbreAnimateurs = $previsionNbreAnimateurs;

        return $this;
    }

    public function getPrevisionNbreParticipants(): ?int
    {
        return $this->previsionNbreParticipants;
    }

    public function setPrevisionNbreParticipants(int $previsionNbreParticipants): self
    {
        $this->previsionNbreParticipants = $previsionNbreParticipants;

        return $this;
    }

    public function getPrevisionNbreFilles(): ?int
    {
        return $this->previsionNbreFilles;
    }

    public function setPrevisionNbreFilles(int $previsionNbreFilles): self
    {
        $this->previsionNbreFilles = $previsionNbreFilles;

        return $this;
    }

    public function getPrevisionNbreGarcons(): ?int
    {
        return $this->previsionNbreGarcons;
    }

    public function setPrevisionNbreGarcons(int $previsionNbreGarcons): self
    {
        $this->previsionNbreGarcons = $previsionNbreGarcons;

        return $this;
    }

    public function getPrevisionNbre613(): ?int
    {
        return $this->previsionNbre613;
    }

    public function setPrevisionNbre613(int $previsionNbre613): self
    {
        $this->previsionNbre613 = $previsionNbre613;

        return $this;
    }

    public function getPrevisionNbre1417(): ?int
    {
        return $this->previsionNbre1417;
    }

    public function setPrevisionNbre1417(int $previsionNbre1417): self
    {
        $this->previsionNbre1417 = $previsionNbre1417;

        return $this;
    }

    public function getAgeMini(): ?int
    {
        return $this->ageMini;
    }

    public function setAgeMini(int $ageMini): self
    {
        $this->ageMini = $ageMini;

        return $this;
    }

    public function getAgeMaxi(): ?int
    {
        return $this->ageMaxi;
    }

    public function setAgeMaxi(int $ageMaxi): self
    {
        $this->ageMaxi = $ageMaxi;

        return $this;
    }

    public function getCommentaireStaff(): ?string
    {
        return $this->commentaireStaff;
    }

    public function setCommentaireStaff(?string $commentaireStaff): self
    {
        $this->commentaireStaff = $commentaireStaff;

        return $this;
    }

    public function getTelephoneContactStaff(): ?string
    {
        return $this->telephoneContactStaff;
    }

    public function setTelephoneContactStaff(?string $telephoneContactStaff): self
    {
        $this->telephoneContactStaff = $telephoneContactStaff;

        return $this;
    }

    public function getProjetPedaBilanAnnee(): ?string
    {
        return $this->projetPedaBilanAnnee;
    }

    public function setProjetPedaBilanAnnee(?string $projetPedaBilanAnnee): self
    {
        $this->projetPedaBilanAnnee = $projetPedaBilanAnnee;

        return $this;
    }

    public function getProjetPedaAmbitions(): ?string
    {
        return $this->projetPedaAmbitions;
    }

    public function setProjetPedaAmbitions(?string $projetPedaAmbitions): self
    {
        $this->projetPedaAmbitions = $projetPedaAmbitions;

        return $this;
    }


}
