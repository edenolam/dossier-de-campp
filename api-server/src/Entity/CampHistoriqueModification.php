<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;

/**
 * CampHistoriqueModification
 *
 * @ORM\Table(name="camp_historique_modification", indexes={@ORM\Index(name="camp_historique_modification_idx_c_2_3", columns={"id_camp", "date_heure_modification"}), @ORM\Index(name="IDX_AA7DAF484AB45E32", columns={"id_camp"}), @ORM\Index(name="IDX_AA7DAF4831C43700", columns={"numero_adherent"})})
 * @ORM\Entity(repositoryClass="App\Repository\CampHistoriqueModificationRepository")
 */
class CampHistoriqueModification
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_heure_modification", type="datetimetz", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $dateHeureModification;

    /**
     * @var string
     *
     * @ORM\Column(name="code_module", type="string", nullable=false, options={"comment"="Module, ecran concerné"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $codeModule;

    /**
     * @var string
     *
     * @ORM\Column(name="modification_json", type="json", nullable=false)
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     * })
     */
    private $modificationJson;

    /**
     * @var Camp
     *
     * @ORM\ManyToOne(targetEntity="Camp", fetch="EXTRA_LAZY")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Exclude()
     */
    private $camp;

    /**
     * @var Adherent
     *
     * @ORM\ManyToOne(targetEntity="Adherent", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numero_adherent", referencedColumnName="numero", nullable=false)
     * })
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $adherent;

    public function getId(): int
    {
        return $this->id;
    }

    public function getDateHeureModification(): ?\DateTimeInterface
    {
        return $this->dateHeureModification;
    }

    public function setDateHeureModification(\DateTimeInterface $dateHeureModification): self
    {
        $this->dateHeureModification = $dateHeureModification;
        return $this;
    }

    public function getCodeModule(): string
    {
        return $this->codeModule;
    }

    public function setCodeModule(string $codeModule): self
    {
        $this->codeModule = $codeModule;
        return $this;
    }

    public function getModificationJson(): string
    {
        return $this->modificationJson;
    }

    public function setModificationJson(string $modificationJson): self
    {
        $this->modificationJson = $modificationJson;
        return $this;
    }

    public function getCamp(): Camp
    {
        return $this->camp;
    }

    public function setCamp(Camp $camp): self
    {
        $this->camp = $camp;
        return $this;
    }

    public function getAdherent(): Adherent
    {
        return $this->adherent;
    }

    public function setAdherent(Adherent $adherent): self
    {
        $this->adherent = $adherent;
        return $this;
    }


}
