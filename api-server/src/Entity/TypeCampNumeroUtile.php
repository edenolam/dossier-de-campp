<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;

/**
 * TypeCampNumeroUtile
 *
 * @ORM\Table(name="type_camp_numero_utile", uniqueConstraints={@ORM\UniqueConstraint(name="type_camp_numero_utile_uidx_c_2_3", columns={"code_type_camp", "id_numero_utile"})}, indexes={@ORM\Index(name="IDX_CC7C98BCBADEFF00", columns={"code_type_camp"}), @ORM\Index(name="IDX_CC7C98BC2C45B0F5", columns={"id_numero_utile"})})
 * @ORM\Entity
 */
class TypeCampNumeroUtile
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
     * @var bool
     *
     * @ORM\Column(name="obligatoire", type="boolean", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $obligatoire = false;

    /**
     * @var TypeCamp
     *
     * @ORM\ManyToOne(targetEntity="TypeCamp", inversedBy="numeroUtiles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_type_camp", referencedColumnName="code", nullable=false)
     * })
     *
     * @JMS\Exclude()
     */
    private $typeCamp;

    /**
     * @var NumeroUtile
     *
     * @ORM\ManyToOne(targetEntity="NumeroUtile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_numero_utile", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Groups({
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $numeroUtile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObligatoire(): ?bool
    {
        return $this->obligatoire;
    }

    public function setObligatoire(bool $obligatoire): self
    {
        $this->obligatoire = $obligatoire;

        return $this;
    }

    public function getTypeCamp(): ?TypeCamp
    {
        return $this->typeCamp;
    }

    public function setTypeCamp(?TypeCamp $typeCamp): self
    {
        $this->typeCamp = $typeCamp;

        return $this;
    }

    public function getNumeroUtile(): ?NumeroUtile
    {
        return $this->numeroUtile;
    }

    public function setNumeroUtile(?NumeroUtile $numeroUtile): self
    {
        $this->numeroUtile = $numeroUtile;

        return $this;
    }

}
