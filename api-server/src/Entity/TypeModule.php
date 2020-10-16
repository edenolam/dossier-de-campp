<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupRefsEnum;

/**
 * TypeModule
 *
 * @ORM\Table(name="type_module", uniqueConstraints={@ORM\UniqueConstraint(name="type_module_uidx_c_2", columns={"libelle"})})
 * @ORM\Entity
 */
class TypeModule
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", nullable=false)
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
     * @var int
     *
     * @ORM\Column(name="ordre_affichage", type="smallint", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupRefsEnum::LISTE,
     *     RestSerializerGroupRefsEnum::FICHE,
     * })
     */
    private $ordreAffichage;

    /**
     * @var bool
     *
     * @ORM\Column(name="type_systeme", type="boolean", nullable=false, options={"comment"="type systeme non supprimable (ex: MOSS)"})
     *
     * @JMS\Groups({
     *     RestSerializerGroupRefsEnum::LISTE,
     *     RestSerializerGroupRefsEnum::FICHE,
     * })
     */
    private $typeSysteme = false;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getOrdreAffichage(): ?int
    {
        return $this->ordreAffichage;
    }

    public function setOrdreAffichage(int $ordreAffichage): self
    {
        $this->ordreAffichage = $ordreAffichage;

        return $this;
    }

    public function getTypeSysteme(): ?bool
    {
        return $this->typeSysteme;
    }

    public function setTypeSysteme(bool $typeSysteme): self
    {
        $this->typeSysteme = $typeSysteme;

        return $this;
    }


}
