<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupCampEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;


/**
 * CampLieuEtape
 *
 * @ORM\Table(name="camp_lieu_etape", indexes={@ORM\Index(name="camp_lieu_etape_uidx_c_2_4", columns={"id_camp"})})
 * @ORM\Entity(repositoryClass="App\Repository\CampLieuEtapeRepository")
 */
class CampLieuEtape extends AbstractDdcCampEntity
{
    /**
     * @var Camp
     *
     * @ORM\ManyToOne(targetEntity="Camp", inversedBy="lieuEtapes", fetch="LAZY")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Exclude()
     */
    private $camp;

    /**
     * @var Lieu
     *
     * @ORM\ManyToOne(targetEntity="Lieu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lieu", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $lieu;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $dateDebut;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $dateFin;

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        if ($this->_areDatesDifferent($this->dateDebut, $dateDebut)) $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        if ($this->_areDatesDifferent($this->dateFin, $dateFin)) $this->dateFin = $dateFin;

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

    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    public function setLieu(?Lieu $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

}
