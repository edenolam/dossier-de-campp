<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupCampEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;

/**
 * CampAdherentStaff
 * FIXME transformer bitmask en pseudo getter
 *
 * @ORM\Table(name="camp_adherent_staff", indexes={@ORM\Index(name="IDX_EEB85CA88481FE19", columns={"id_camp_adherent"})})
 * @ORM\Entity
 */
class CampAdherentStaff extends AbstractDdcCampEntity
{

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_debut_presence", type="date", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::STAFF,
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
     *     RestSerializerGroupCampModuleEnum::STAFF,
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
     *     RestSerializerGroupCampModuleEnum::STAFF,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $mossAccompagnementSpecifique = false;

    /**
     * @var Camp
     *
     * @ORM\ManyToOne(targetEntity="Camp", inversedBy="staffs")
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
     *      RestSerializerGroupCampModuleEnum::STAFF,
     * })
     */
    private $adherent;

    /**
     * @var bool
     *
     * @ORM\Column(name="role_staff_directeur", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::STAFF,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $roleStaffDirecteur = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="role_staff_chef", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::STAFF,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $roleStaffChef = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="validation_stage_pratique_bafa", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::STAFF,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $validationStagePratiqueBafa = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="validation_stage_pratique_bafd1", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::STAFF,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $validationStagePratiqueBafd1 = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="validation_stage_pratique_bafd2", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::STAFF,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $validationStagePratiqueBafd2 = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="role_maitrise_intendant", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::STAFF,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $roleMaitriseIntendant = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="role_maitrise_tresorier", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::STAFF,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $roleMaitriseTresorier = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="role_maitrise_as", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::STAFF,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $roleMaitriseAS = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="role_maitrise_materiel", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::STAFF,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $roleMaitriseMateriel = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="role_maitrise_autre", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::STAFF,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $roleMaitriseAutre = false;

    /**
     * @var string|null
     *
     * @ORM\Column(name="role_maitrise_autre_detail", type="string", nullable=true)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::STAFF,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $roleMaitriseAutreDetail;

    public function getDateDebutPresence(): ?\DateTimeInterface
    {
        return $this->dateDebutPresence;
    }

    public function setDateDebutPresence(\DateTimeInterface $dateDebutPresence): self
    {
        $this->dateDebutPresence = $dateDebutPresence;

        return $this;
    }

    public function getDateFinPresence(): ?\DateTimeInterface
    {
        return $this->dateFinPresence;
    }

    public function setDateFinPresence(\DateTimeInterface $dateFinPresence): self
    {
        $this->dateFinPresence = $dateFinPresence;

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

    public function getRoleStaffDirecteur(): ?bool
    {
        return $this->roleStaffDirecteur;
    }

    public function setRoleStaffDirecteur(bool $roleStaffDirecteur): self
    {
        $this->roleStaffDirecteur = $roleStaffDirecteur;

        return $this;
    }

    public function getRoleStaffChef(): ?bool
    {
        return $this->roleStaffChef;
    }

    public function setRoleStaffChef(bool $roleStaffChef): self
    {
        $this->roleStaffChef = $roleStaffChef;

        return $this;
    }

    public function getValidationStagePratiqueBafa(): ?bool
    {
        return $this->validationStagePratiqueBafa;
    }

    public function setValidationStagePratiqueBafa(bool $validationStagePratiqueBafa): self
    {
        $this->validationStagePratiqueBafa = $validationStagePratiqueBafa;

        return $this;
    }

    public function getValidationStagePratiqueBafd1(): ?bool
    {
        return $this->validationStagePratiqueBafd1;
    }

    public function setValidationStagePratiqueBafd1(bool $validationStagePratiqueBafd1): self
    {
        $this->validationStagePratiqueBafd1 = $validationStagePratiqueBafd1;

        return $this;
    }

    public function getValidationStagePratiqueBafd2(): ?bool
    {
        return $this->validationStagePratiqueBafd2;
    }

    public function setValidationStagePratiqueBafd2(bool $validationStagePratiqueBafd2): self
    {
        $this->validationStagePratiqueBafd2 = $validationStagePratiqueBafd2;

        return $this;
    }

    public function getRoleMaitriseIntendant(): ?bool
    {
        return $this->roleMaitriseIntendant;
    }

    public function setRoleMaitriseIntendant(bool $roleMaitriseIntendant): self
    {
        $this->roleMaitriseIntendant = $roleMaitriseIntendant;

        return $this;
    }

    public function getRoleMaitriseTresorier(): ?bool
    {
        return $this->roleMaitriseTresorier;
    }

    public function setRoleMaitriseTresorier(bool $roleMaitriseTresorier): self
    {
        $this->roleMaitriseTresorier = $roleMaitriseTresorier;

        return $this;
    }

    public function getRoleMaitriseAS(): ?bool
    {
        return $this->roleMaitriseAS;
    }

    public function setRoleMaitriseAS(bool $roleMaitriseAS): self
    {
        $this->roleMaitriseAS = $roleMaitriseAS;

        return $this;
    }

    public function getRoleMaitriseMateriel(): ?bool
    {
        return $this->roleMaitriseMateriel;
    }

    public function setRoleMaitriseMateriel(bool $roleMaitriseMateriel): self
    {
        $this->roleMaitriseMateriel = $roleMaitriseMateriel;

        return $this;
    }

    public function getRoleMaitriseAutre(): ?bool
    {
        return $this->roleMaitriseAutre;
    }

    public function setRoleMaitriseAutre(bool $roleMaitriseAutre): self
    {
        $this->roleMaitriseAutre = $roleMaitriseAutre;

        return $this;
    }

    public function getRoleMaitriseAutreDetail(): ?string
    {
        return $this->roleMaitriseAutreDetail;
    }

    public function setRoleMaitriseAutreDetail(?string $roleMaitriseAutreDetail): self
    {
        $this->roleMaitriseAutreDetail = $roleMaitriseAutreDetail;

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
