<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupRefsEnum;


/**
 * Adherent
 *
 * @ORM\Table(name="adherent")
 * @ORM\Entity(readOnly=true)
 */
class Adherent
{
    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", nullable=false)
     * @ORM\Id
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *      RestSerializerGroupEnum::REF,
     *      RestSerializerGroupEnum::IDENTIFIANT,
     * })
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", nullable=false, options={"comment"="H ou F"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $genre;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_naissance", type="date", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupRefsEnum::FICHE,
     * })
     */
    private $dateNaissance;


    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getDateNaissance(): DateTime
    {
        return $this->dateNaissance;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }
}
