<?php

namespace App\Entity;

use App\Enums\JMS\RestSerializerGroupCampEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * CampStructure
 *
 * @ORM\Table(name="camp_structure", uniqueConstraints={@ORM\UniqueConstraint(name="camp_structure_uidx_c_2_3", columns={"id_camp", "code_structure"})}, indexes={@ORM\Index(name="IDX_7BAA117A4AB45E32", columns={"id_camp"}), @ORM\Index(name="IDX_7BAA117AC3444FD2", columns={"code_structure"})})
 * @ORM\Entity
 */
class CampStructure extends AbstractDdcCampEntity
{
    /**
     * @var bool
     *
     * @ORM\Column(name="organisatrice", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $organisatrice = false;

    /**
     * @var bool
     *
     * @ORM\Column(name="participante", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $participante = false;

    /**
     * @var Camp
     *
     * @ORM\ManyToOne(targetEntity="Camp", inversedBy="structures")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Exclude()
     */
    private $camp;

    /**
     * @var Structure
     *
     * @ORM\ManyToOne(targetEntity="Structure", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_structure", referencedColumnName="code", nullable=false)
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     * })
     */
    private $structure;

    public function getCamp(): ?Camp
    {
        return $this->camp;
    }

    public function setCamp(?Camp $camp): self
    {
        $this->camp = $camp;
        return $this;
    }

    public function getStructure(): Structure
    {
        return $this->structure;
    }

    public function setStructure(Structure $structure): self
    {
        $this->structure = $structure;
        return $this;
    }

    public function getOrganisatrice(): ?bool
    {
        return $this->organisatrice;
    }

    public function setOrganisatrice(bool $organisatrice): self
    {
        $this->organisatrice = $organisatrice;

        return $this;
    }

    public function getParticipante(): ?bool
    {
        return $this->participante;
    }

    public function setParticipante(bool $participante): self
    {
        $this->participante = $participante;

        return $this;
    }
}
