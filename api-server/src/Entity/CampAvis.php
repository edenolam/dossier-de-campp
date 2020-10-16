<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupCampEnum;

/**
 * CampAvis
 *
 * @ORM\Table(name="camp_avis", uniqueConstraints={@ORM\UniqueConstraint(name="camp_avis_uidx_c_2_3", columns={"id_camp", "type_avis"})}, indexes={@ORM\Index(name="IDX_6A7305F84AB45E32", columns={"id_camp"}), @ORM\Index(name="IDX_6A7305F8FFE2F7C9", columns={"numero_adherent_dernier_avis"})})
 * @ORM\Entity
 */
class CampAvis extends AbstractDdcCampEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="type_avis", type="string", nullable=false, options={"comment"="marine, intl, RG, AP"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $typeAvis;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_heure_dernier_avis", type="datetimetz", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $dateHeureDernierAvis;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", nullable=false, options={"default"="NON-EMIS"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $statut = 'NON-EMIS';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commentaire", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $commentaire;

    /**
     * @var Camp
     *
     * @ORM\ManyToOne(targetEntity="Camp", inversedBy="avis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Exclude()
     */
    private $camp;

    /**
     * @var Adherent
     *
     * @ORM\ManyToOne(targetEntity="Adherent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numero_adherent_dernier_avis", referencedColumnName="numero", nullable=false)
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $adherentDernierAvis;

    public function getTypeAvis(): ?string
    {
        return $this->typeAvis;
    }

    public function setTypeAvis(string $typeAvis): self
    {
        $this->typeAvis = $typeAvis;

        return $this;
    }

    public function getDateHeureDernierAvis(): ?\DateTimeInterface
    {
        return $this->dateHeureDernierAvis;
    }

    public function setDateHeureDernierAvis(\DateTimeInterface $dateHeureDernierAvis): self
    {
        $this->dateHeureDernierAvis = $dateHeureDernierAvis;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

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

    public function getAdherentDernierAvis(): ?Adherent
    {
        return $this->adherentDernierAvis;
    }

    public function setAdherentDernierAvis(?Adherent $adherentDernierAvis): self
    {
        $this->adherentDernierAvis = $adherentDernierAvis;

        return $this;
    }


}
