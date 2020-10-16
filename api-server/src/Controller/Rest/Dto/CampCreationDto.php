<?php


namespace App\Controller\Rest\Dto;

use DateTime;
use JMS\Serializer\Annotation\Type;
use Swagger\Annotations as SWG;

/**
 * DTO contenant les informations nécessaire à la création d'un camp.
 *
 * @package App\Controller\Rest\Dto
 */
class CampCreationDto
{
    /**
     * @var string
     * @Type("string")
     * @SWG\Property(title="Code du type de camp", required={"true"}, type="string", maxLength=20)
     */
    private $codeTypeCamp;

    /**
     * @var string
     * @Type("string")
     * @SWG\Property(title="Nom du camp", required={"true"}, type="string", description="Ex: Camp 11-14 ans du 18/12/2019 au 05/01/2020 dirigé par Cédric Ouvrard aux Forts")
     */
    private $libelle;

    /**
     * @var ?DateTime
     * @Type("DateTime")
     * @SWG\Property(title="Date de début du camp", required={"false"}, type="string",
     *      description="Date de début du camp au format ISO 8601",
     *      example="2005-08-15T15:52:01+0000")
     */
    private $dateDebut;

    /**
     * @var ?DateTime
     * @Type("DateTime")
     * @SWG\Property(title="Date de fin du camp", required={"false"}, type="string",
     *      description="Date de fin du camp au format ISO 8601",
     *      example="2005-08-15T15:52:01+0000")
     */
    private $dateFin;

    /**
     * @var string[]
     * @Type("array")
     * @SWG\Property(title="Liste des modules à activer à la création", required={"true"}, type="array", @SWG\Items(type="string"))
     */
    private $codemodules;

    /**
     * @return string
     */
    public function getCodeTypeCamp(): string
    {
        return $this->codeTypeCamp;
    }

    /**
     * @param string $codeTypeCamp
     */
    public function setCodeTypeCamp(string $codeTypeCamp): void
    {
        $this->codeTypeCamp = $codeTypeCamp;
    }

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }

    /**
     * @return DateTime|null ?DateTime
     */
    public function getDateDebut(): ?DateTime
    {
        return $this->dateDebut;
    }

    /**
     * @param DateTime $dateDebut
     */
    public function setDateDebut(DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return ?DateTime
     */
    public function getDateFin(): ?DateTime
    {
        return $this->dateFin;
    }

    /**
     * @param DateTime $dateFin
     */
    public function setDateFin(DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return string[]
     */
    public function getCodemodules(): array
    {
        return $this->codemodules;
    }

    /**
     * @param string[] $codemodules
     */
    public function setCodemodules(array $codemodules): void
    {
        $this->codemodules = $codemodules;
    }
}