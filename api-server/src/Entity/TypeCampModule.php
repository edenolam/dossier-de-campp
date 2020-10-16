<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupRefsEnum;

/**
 * TypeCampModule
 *
 * @ORM\Table(name="type_camp_module", uniqueConstraints={@ORM\UniqueConstraint(name="type_camp_module_uidx_c_2_3", columns={"code_type_camp", "code_module"})}, indexes={@ORM\Index(name="IDX_BE8A10BCBADEFF00", columns={"code_type_camp"}), @ORM\Index(name="IDX_BE8A10BC73A27E8A", columns={"code_module"})})
 * @ORM\Entity
 */
class TypeCampModule
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @JMS\Groups({
     *     RestSerializerGroupEnum::IDENTIFIANT,
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="surveyjs_traduction_json", type="json", nullable=true)
     *
     * @JMS\Groups({
     *     RestSerializerGroupRefsEnum::FICHE,
     * })
     */
    private $surveyjsTraductionJson;

    /**
     * @var TypeCamp
     *
     * @ORM\ManyToOne(targetEntity="TypeCamp", inversedBy="modules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_type_camp", referencedColumnName="code", nullable=false)
     * })
     *
     * @JMS\Groups({
     *     RestSerializerGroupRefsEnum::FICHE,
     * })
     */
    private $typeCamp;

    /**
     * @var Module
     *
     * @ORM\ManyToOne(targetEntity="Module")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_module", referencedColumnName="code", nullable=false)
     * })
     *
     * @JMS\Groups({
     *     RestSerializerGroupRefsEnum::MODULE
     * })
     */
    private $module;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSurveyjsTraductionJson(): ?string
    {
        return $this->surveyjsTraductionJson;
    }

    public function setSurveyjsTraductionJson(?string $surveyjsTraductionJson): self
    {
        $this->surveyjsTraductionJson = $surveyjsTraductionJson;
        return $this;
    }

    public function getTypeCamp(): TypeCamp
    {
        return $this->typeCamp;
    }

    public function setTypeCamp(TypeCamp $typeCamp): self
    {
        $this->typeCamp = $typeCamp;
        return $this;
    }

    public function getModule(): Module
    {
        return $this->module;
    }

    public function setModule(Module $module): self
    {
        $this->module = $module;
        return $this;
    }

}
