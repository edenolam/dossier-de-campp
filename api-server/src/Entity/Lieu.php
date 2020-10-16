<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;


/**
 * CampLieuEtape
 *
 * @ORM\Table(name="lieu")
 * @ORM\Entity(repositoryClass="App\Repository\CampLieuEtapeRepository")
 */
class Lieu
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
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_ligne_1", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::FICHE,
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     * })
     */
    private $adresseLigne1;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_ligne_2", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::FICHE,
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     * })
     */
    private $adresseLigne2;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::FICHE,
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     * })
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::FICHE,
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     * })
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="geojson", type="json", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::FICHE,
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     * })
     */
    private $geoJson;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAdresseLigne1(): ?string
    {
        return $this->adresseLigne1;
    }

    public function setAdresseLigne1(?string $adresseLigne1): self
    {
        $this->adresseLigne1 = $adresseLigne1;

        return $this;
    }

    public function getAdresseLigne2(): ?string
    {
        return $this->adresseLigne2;
    }

    public function setAdresseLigne2(?string $adresseLigne2): self
    {
        $this->adresseLigne2 = $adresseLigne2;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getGeoJson(): ?array
    {
        return $this->geoJson;
    }

    public function setGeoJson(?array $geoJson): self
    {
        $this->geoJson = $geoJson;

        return $this;
    }
}
