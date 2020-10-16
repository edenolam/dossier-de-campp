<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;

/**
 * NumeroUtile
 *
 * @ORM\Table(name="numero_utile")
 * @ORM\Entity
 */
class NumeroUtile
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
     * @var int
     *
     * @ORM\Column(name="categorie", type="integer", nullable=false, options={"comment"="1=Structure, 2=Secours, 3=Utiles, 4=International"})
     *
     * @JMS\Groups({
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $categorie;

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
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $ordreAffichage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?int
    {
        return $this->categorie;
    }

    public function setCategorie(int $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
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


}
