<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupCampEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;


/**
 * CampGrilleActivite
 *
 * @ORM\Table(name="camp_grille_activite", uniqueConstraints={@ORM\UniqueConstraint(name="camp_grille_activite_uidx_c_2_3_4", columns={"id_camp", "date_activite", "creneau"})}, indexes={@ORM\Index(name="IDX_6ECD59964AB45E32", columns={"id_camp"}), @ORM\Index(name="IDX_6ECD59965257D542", columns={"id_staff_responsable"})})
 * @ORM\Entity
 */
class CampGrilleActivite extends AbstractDdcCampEntity
{
    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_activite", type="date", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $dateActivite;

    /**
     * @var int
     *
     * @ORM\Column(name="creneau", type="smallint", nullable=false, options={"comment"="1=matin, 2=après-midi, 3=soir"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $creneau;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imaginaire", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $imaginaire;

    /**
     * @var Camp
     *
     * @ORM\ManyToOne(targetEntity="Camp", inversedBy="grilleActivites")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Exclude()
     */
    private $camp;

    /**
     * @var CampAdherentStaff
     *
     * @ORM\ManyToOne(targetEntity="CampAdherentStaff")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_staff_responsable", referencedColumnName="id")
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $staffResponsable;

    public function getDateActivite(): ?\DateTimeInterface
    {
        return $this->dateActivite;
    }

    public function setDateActivite(\DateTimeInterface $dateActivite): self
    {
        if ($this->_areDatesDifferent($this->dateActivite, $dateActivite)) $this->dateActivite = $dateActivite;

        return $this;
    }

    public function getCreneau(): ?int
    {
        return $this->creneau;
    }

    public function setCreneau(int $creneau): self
    {
        $this->creneau = $creneau;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImaginaire(): ?string
    {
        return $this->imaginaire;
    }

    public function setImaginaire(?string $imaginaire): self
    {
        $this->imaginaire = $imaginaire;

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

    public function getStaffResponsable(): ?CampAdherentStaff
    {
        return $this->staffResponsable;
    }

    public function setStaffResponsable(?CampAdherentStaff $staffResponsable): self
    {
        $this->staffResponsable = $staffResponsable;

        return $this;
    }
}
