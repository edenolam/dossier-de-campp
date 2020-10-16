<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupRefsEnum;

/**
 * Module
 *
 * @ORM\Table(name="module", indexes={@ORM\Index(name="IDX_C24262866B2A4A0", columns={"code_type_module"})})
 * @ORM\Entity
 */
class Module
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", nullable=false, options={"comment"="Code (Enum) d'identification du module pour application des régles de gestion"})
     * @ORM\Id
     *
     * @JMS\Groups({
     *     RestSerializerGroupEnum::IDENTIFIANT,
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $libelle;

    /**
     * @var bool
     *
     * @ORM\Column(name="rattachement_multiple", type="boolean", nullable=false, options={"comment"="Peut être rattaché plusieurs fois au même camp (ex: Fiche intention)"})
     *
     * @JMS\Groups({
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $rattachementMultiple = false;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type_moss", type="string", nullable=true, options={"comment"="module Obligatoire Sur Situation : MARINE, INTL, HANDICAP, ..."})
     *
     * @JMS\Groups({
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $typeMoss;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre_affichage", type="smallint", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $ordreAffichage;

    /**
     * @var string
     *
     * @ORM\Column(name="surveyjs_json", type="json", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupRefsEnum::FICHE,
     * })
     */
    private $surveyjsJson;

    /**
     * @var TypeModule
     *
     * @ORM\ManyToOne(targetEntity="TypeModule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_type_module", referencedColumnName="code", nullable=false)
     * })
     *
     * @JMS\Groups({
     *     RestSerializerGroupRefsEnum::FICHE,
     * })
     */
    private $typeModule;


    public function getCode(): string
    {
        return $this->code;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getRattachementMultiple(): bool
    {
        return $this->rattachementMultiple;
    }

    public function setRattachementMultiple(bool $rattachementMultiple): self
    {
        $this->rattachementMultiple = $rattachementMultiple;

        return $this;
    }

    public function getTypeMoss(): string
    {
        return $this->typeMoss;
    }

    public function setTypeMoss(string $typeMoss): self
    {
        $this->typeMoss = $typeMoss;

        return $this;
    }

    public function getOrdreAffichage(): int
    {
        return $this->ordreAffichage;
    }

    public function setOrdreAffichage(int $ordreAffichage): self
    {
        $this->ordreAffichage = $ordreAffichage;

        return $this;
    }

    public function getSurveyjsJson(): string
    {
        return $this->surveyjsJson;
    }

    public function setSurveyjsJson(string $surveyjsJson): self
    {
        $this->surveyjsJson = $surveyjsJson;
        return $this;
    }

    public function getTypeModule(): TypeModule
    {
        return $this->typeModule;
    }

    public function setTypeModule(TypeModule $typeModule): self
    {
        $this->typeModule = $typeModule;

        return $this;
    }


}
