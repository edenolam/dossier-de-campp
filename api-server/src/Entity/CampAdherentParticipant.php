<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupCampEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;

/**
 * CampAdherentParticipant
 *
 * @ORM\Table(name="camp_adherent_participant", indexes={@ORM\Index(name="IDX_535405DC8481FE19", columns={"id_camp_adherent"})})
 * @ORM\Entity
 */
class CampAdherentParticipant extends AbstractDdcCampEntity
{
    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_debut_presence", type="date", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::PARTICIPANT,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $dateDebutPresence;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_fin_presence", type="date", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::PARTICIPANT,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $dateFinPresence;

    /**
     * @var bool
     *
     * @ORM\Column(name="moss_accompagnement_specifique", type="boolean", nullable=false)`
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::PARTICIPANT,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $mossAccompagnementSpecifique = false;

    /**
     * @var Camp
     *
     * @ORM\ManyToOne(targetEntity="Camp", inversedBy="participants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Exclude
     */
    private $camp;

    /**
     * @var Adherent
     *
     * @ORM\ManyToOne(targetEntity="Adherent", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numero_adherent", referencedColumnName="numero")
     * })
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::PARTICIPANT,
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $adherent;


    /**
     * @var bool
     *
     * @ORM\Column(name="chef_equipe", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::PARTICIPANT,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $chefEquipe = false;

    /**
     * @var string|null
     *
     * @ORM\Column(name="coordonnees_parents", type="string", nullable=true)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::PARTICIPANT,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $coordonneesParents;


    public function getChefEquipe(): ?bool
    {
        return $this->chefEquipe;
    }

    public function setChefEquipe(bool $chefEquipe): self
    {
        $this->chefEquipe = $chefEquipe;

        return $this;
    }

    public function getCoordonneesParents(): ?string
    {
        return $this->coordonneesParents;
    }

    public function setCoordonneesParents(?string $coordonneesParents): self
    {
        $this->coordonneesParents = $coordonneesParents;

        return $this;
    }

    public function getDateDebutPresence(): ?\DateTimeInterface
    {
        return $this->dateDebutPresence;
    }

    public function setDateDebutPresence(\DateTimeInterface $dateDebutPresence): self
    {
        if ($this->_areDatesDifferent($this->dateDebutPresence,$dateDebutPresence)) $this->dateDebutPresence = $dateDebutPresence;

        return $this;
    }

    public function getDateFinPresence(): ?\DateTimeInterface
    {
        return $this->dateFinPresence;
    }

    public function setDateFinPresence(\DateTimeInterface $dateFinPresence): self
    {
        if ($this->_areDatesDifferent($this->dateFinPresence,$dateFinPresence)) $this->dateFinPresence = $dateFinPresence;

        return $this;
    }

    public function getMossAccompagnementSpecifique(): ?bool
    {
        return $this->mossAccompagnementSpecifique;
    }

    public function setMossAccompagnementSpecifique(bool $mossAccompagnementSpecifique): self
    {
        $this->mossAccompagnementSpecifique = $mossAccompagnementSpecifique;

        return $this;
    }

    public function getCamp(): ?Camp
    {
        return $this->camp;
    }

    public function setCamp(?Camp $camp): self
    {
        $this->camp = $camp;

        return $this;
    }

    public function getAdherent(): ?Adherent
    {
        return $this->adherent;
    }

    public function setAdherent(?Adherent $adherent): self
    {
        $this->adherent = $adherent;

        return $this;
    }

}
