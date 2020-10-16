<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupCampEnum;


/**
 * CampDiscussionEchange
 *
 * @ORM\Table(name="camp_discussion_echange", indexes={@ORM\Index(name="camp_discussion_echange_idx_c_2_3", columns={"id_camp_discussion_sujet", "date_heure_echange"}), @ORM\Index(name="IDX_154E2BF4D68ACBF0", columns={"id_camp_discussion_sujet"}), @ORM\Index(name="IDX_154E2BF4BAC3548A", columns={"numero_adherent_echange"})})
 * @ORM\Entity
 */
class CampDiscussionEchange extends AbstractDdcCampEntity
{
    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_heure_echange", type="datetimetz", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $dateHeureEchange;

    /**
     * @var string
     *
     * @ORM\Column(name="echange", type="string", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupEnum::CREATION_ENFANT,
     *     RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $echange;

    /**
     * @var CampDiscussionSujet
     *
     * @ORM\ManyToOne(targetEntity="CampDiscussionSujet", inversedBy="echanges")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp_discussion_sujet", referencedColumnName="id")
     * })
     *
     * @JMS\Groups({
     *     RestSerializerGroupEnum::CREATION_ENFANT,
     * })
     */
    private $sujet;

    /**
     * @var Adherent
     *
     * @ORM\ManyToOne(targetEntity="Adherent", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numero_adherent_echange", referencedColumnName="numero", nullable=false)
     * })
     *
     * @JMS\Groups({
     *     RestSerializerGroupEnum::CREATION_ENFANT,
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $adherentEchange;

    public function getDateHeureEchange(): ?\DateTimeInterface
    {
        return $this->dateHeureEchange;
    }

    public function setDateHeureEchange(\DateTimeInterface $dateHeureEchange): self
    {
        $this->dateHeureEchange = $dateHeureEchange;

        return $this;
    }

    public function getEchange(): ?string
    {
        return $this->echange;
    }

    public function setEchange(string $echange): self
    {
        $this->echange = $echange;

        return $this;
    }

    public function getSujet(): ?CampDiscussionSujet
    {
        return $this->sujet;
    }

    public function setSujet(?CampDiscussionSujet $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getAdherentEchange(): ?Adherent
    {
        return $this->adherentEchange;
    }

    public function setAdherentEchange(?Adherent $adherentEchange): self
    {
        $this->adherentEchange = $adherentEchange;

        return $this;
    }


}
