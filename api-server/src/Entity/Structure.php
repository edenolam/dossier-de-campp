<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;

/**
 * Structure
 *
 * @ORM\Table(name="structure", uniqueConstraints={@ORM\UniqueConstraint(name="structure_uidx_c_2", columns={"libelle"})})
 * @ORM\Entity(readOnly=true)
 */
class Structure
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", nullable=false)
     * @ORM\Id
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *      RestSerializerGroupEnum::IDENTIFIANT,
     *      RestSerializerGroupEnum::REF,
     * })
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $libelle;

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
}
