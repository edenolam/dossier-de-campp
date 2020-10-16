<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;

/**
 * CampModule
 *
 * @ORM\Table(name="camp_module",
 *     indexes={
 *          @ORM\Index(name="camp_module_idx_c_2_3", columns={"id_camp", "code_module"}),
 *          @ORM\Index(name="IDX_F593C72D4AB45E32", columns={"id_camp"}),
 *          @ORM\Index(name="IDX_F593C72D73A27E8A", columns={"code_module"})
 * })
 * @ORM\Entity
 */
class CampModule extends AbstractDdcCampEntity
{
    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false, options={"default"="1","comment"="Support désactivation temporaire pour ne pas perdre données saisies"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $actif = true;

    /**
     * @var string|null
     *
     * @ORM\Column(name="surveyjs_reponses_json", type="json", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     * })
     */
    private $surveyjsReponsesJson;

    /**
     * @var Camp
     *
     * @ORM\ManyToOne(targetEntity="Camp", inversedBy="modules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Exclude()
     */
    private $camp;

    /**
     * @var Module
     *
     * @ORM\ManyToOne(targetEntity="Module", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_module", referencedColumnName="code", nullable=false)
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $module;

    /**
     * @return bool
     */
    public function isActif(): bool
    {
        return $this->actif;
    }

    /**
     * @param bool $actif
     * @return CampModule
     */
    public function setActif(bool $actif): CampModule
    {
        $this->actif = $actif;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSurveyjsReponsesJson(): ?string
    {
        return $this->surveyjsReponsesJson;
    }

    /**
     * @param string|null $surveyjsReponsesJson
     * @return CampModule
     */
    public function setSurveyjsReponsesJson(?string $surveyjsReponsesJson): CampModule
    {
        $this->surveyjsReponsesJson = $surveyjsReponsesJson;
        return $this;
    }

    /**
     * @return Camp
     */
    public function getCamp(): Camp
    {
        return $this->camp;
    }

    /**
     * @param Camp $camp
     * @return CampModule
     */
    public function setCamp(Camp $camp): CampModule
    {
        $this->camp = $camp;
        return $this;
    }

    /**
     * @return Module
     */
    public function getModule(): Module
    {
        return $this->module;
    }

    /**
     * @param Module $module
     * @return CampModule
     */
    public function setModule(Module $module): CampModule
    {
        $this->module = $module;
        return $this;
    }

    public function getActif(): bool
    {
        return $this->actif;
    }
}
