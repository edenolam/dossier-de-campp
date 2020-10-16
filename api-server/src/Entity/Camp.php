<?php

namespace App\Entity;

use App\Enums\JMS\RestSerializerGroupCampEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupRefsEnum;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\Annotation\Accessor;

/**
 * Camp
 *
 * @ORM\Table(name="camp", indexes={
 *     @ORM\Index(name="IDX_C1944230BADEFF00", columns={"code_type_camp"}),
 *     @ORM\Index(name="IDX_C1944230680CD64D", columns={"id_camp_8_17"}),
 *     @ORM\Index(name="IDX_C19442304A27ECF0", columns={"id_camp_compagnon"}),
 *     @ORM\Index(name="IDX_C194423072A1AAEA", columns={"id_lieu_principal"}),
 *     @ORM\Index(name="IDX_C194423078DB7C5A", columns={"id_histo_creation"}),
 *     @ORM\Index(name="IDX_C1944230FCB5D004", columns={"id_histo_derniere_modification"})})
 * @ORM\Entity(repositoryClass="App\Repository\CampRepository")
 */
class Camp
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::IDENTIFIANT,
     *      RestSerializerGroupEnum::TOUJOURS,
     *      RestSerializerGroupEnum::REF,
     * })
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code_groupe_camp", type="string", nullable=false, options={"comment"="typage de l'enregistrement pour gestion héritage"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $codeGroupeCamp;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="smallint", nullable=false, options={"default"="1"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $statut = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="synthese", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $synthese;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="date_debut", type="date", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $dateDebut;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $dateFin;

    /**
     * @var TypeCamp
     *
     * @ORM\ManyToOne(targetEntity="TypeCamp", inversedBy="camps", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_type_camp", referencedColumnName="code")
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $typeCamp;

    /**
     * @var Camp817
     *
     * @ORM\ManyToOne(targetEntity="Camp817", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp_8_17", referencedColumnName="id", nullable=true)
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     * })
     */
    private $camp817;

    /**
     * @var CampCompagnon
     *
     * @ORM\ManyToOne(targetEntity="CampCompagnon", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp_compagnon", referencedColumnName="id", nullable=true)
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     * })
     */
    private $campCompagnon;

    /**
     * @var Lieu
     *
     * @ORM\ManyToOne(targetEntity="Lieu", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lieu_principal", referencedColumnName="id")
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $lieuPrincipal;

    /**
     * @var CampHistoriqueModification
     *
     * @ORM\ManyToOne(targetEntity="CampHistoriqueModification", cascade={"persist"}, fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_histo_creation", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     * })
     */
    private $histoCreation;

    /**
     * @var CampHistoriqueModification|null
     *
     * @ORM\ManyToOne(targetEntity="CampHistoriqueModification", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_histo_derniere_modification", referencedColumnName="id", nullable=true)
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $histoDerniereModification;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CampLieuEtape", mappedBy="camp", orphanRemoval=true)
     * @ORM\OrderBy({"dateDebut" = "ASC"})
     *
     * @JMS\Groups({
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     * })
     * @Accessor("getLieuEtapes")
     */
    private $lieuEtapes;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CampAdherentParticipant", mappedBy="camp", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"id" = "ASC"})
     *
     * @JMS\Type("ArrayCollection<App\Entity\CampAdherentParticipant>")
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::PARTICIPANT,
     * })
     * @Accessor("getParticipants")
     */
    private $participants;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CampAdherentStaff", mappedBy="camp", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"id" = "ASC"})
     *
     * @JMS\Type("ArrayCollection<App\Entity\CampAdherentStaff>")
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::STAFF,
     * })
     * @Accessor("getStaffs")
     */
    private $staffs;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CampModule", mappedBy="camp", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"module" = "ASC"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupRefsEnum::MODULE,
     * })
     * @Accessor("getModules")
     */
    private $modules;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CampStructure", mappedBy="camp", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"structure" = "ASC"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     * })
     * @Accessor("getStructures")
     */
    private $structures;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CampNumeroUtile", mappedBy="camp", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"id" = "ASC"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     * })
     * @Accessor("getNumeroUtiles")
     */
    private $numeroUtiles;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CampJourneeType", mappedBy="camp", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"heureDebut" = "ASC"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     * })
     * @Accessor("getJourneeTypes")
     */
    private $journeeTypes;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CampGrilleActivite", mappedBy="camp", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"dateActivite" = "ASC", "creneau" = "ASC"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     * })
     * @Accessor("getGrilleActivites")
     */
    private $grilleActivites;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CampDiscussionSujet", mappedBy="camp", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"id" = "DESC"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     * })
     * @Accessor("getDiscussions")
     */
    private $discussions;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CampAvis", mappedBy="camp", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"id" = "ASC"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     * })
     * @Accessor("getAvis")
     */
    private $avis;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CampAdherentSoutien", mappedBy="camp", cascade={"persist"}, orphanRemoval=true)
     * @ORM\OrderBy({"id" = "ASC"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     * })
     * @Accessor("getSoutiens")
     */
    private $soutiens;

    public function __construct()
    {
        $this->lieuEtapes = new ArrayCollection();
        $this->participants = new ArrayCollection();
        $this->staffs = new ArrayCollection();
        $this->modules = new ArrayCollection();
        $this->structures = new ArrayCollection();
        $this->numeroUtiles = new ArrayCollection();
        $this->journeeTypes = new ArrayCollection();
        $this->grilleActivites = new ArrayCollection();
        $this->discussions = new ArrayCollection();
        $this->avis = new ArrayCollection();
        $this->soutiens = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getCodeGroupeCamp(): ?string
    {
        return $this->codeGroupeCamp;
    }

    public function setCodeGroupeCamp(string $codeGroupeCamp): self
    {
        $this->codeGroupeCamp = $codeGroupeCamp;

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

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getSynthese(): ?string
    {
        return $this->synthese;
    }

    public function setSynthese(?string $synthese): self
    {
        $this->synthese = $synthese;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        if ($this->_areDatesDifferent($this->dateDebut,$dateDebut)) $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        if ($this->_areDatesDifferent($this->dateFin, $dateFin)) $this->dateFin = $dateFin;

        return $this;
    }

    public function getTypeCamp(): TypeCamp
    {
        return $this->typeCamp;
    }

    public function setTypeCamp(TypeCamp $typeCamp): self
    {
        $this->typeCamp = $typeCamp;

        return $this;
    }

    public function getCamp817(): ?Camp817
    {
        return $this->camp817;
    }

    public function setCamp817(?Camp817 $camp817): self
    {
        $this->camp817 = $camp817;

        return $this;
    }

    public function getCampCompagnon(): ?CampCompagnon
    {
        return $this->campCompagnon;
    }

    public function setCampCompagnon(?CampCompagnon $campCompagnon): self
    {
        $this->campCompagnon = $campCompagnon;

        return $this;
    }

    public function getLieuPrincipal(): ?Lieu
    {
        return $this->lieuPrincipal;
    }

    public function setLieuPrincipal(?Lieu $lieuPrincipal): self
    {
        $this->lieuPrincipal = $lieuPrincipal;

        return $this;
    }

    public function getHistoCreation(): ?CampHistoriqueModification
    {
        return $this->histoCreation;
    }

    public function setHistoCreation(?CampHistoriqueModification $histoCreation): self
    {
        $this->histoCreation = $histoCreation;

        return $this;
    }

    public function getHistoDerniereModification(): ?CampHistoriqueModification
    {
        return $this->histoDerniereModification;
    }

    public function setHistoDerniereModification(?CampHistoriqueModification $histoDerniereModification): self
    {
        $this->histoDerniereModification = $histoDerniereModification;

        return $this;
    }

    /**
     * @return Collection|CampLieuEtape[]
     */
    public function getLieuEtapes(): Collection
    {
        return $this->lieuEtapes;
    }

    public function addLieuEtapes(CampLieuEtape $lieuEtapes): self
    {
        if (!$this->lieuEtapes->contains($lieuEtapes)) {
            $this->lieuEtapes[] = $lieuEtapes;
            $lieuEtapes->setCamp($this);
        }

        return $this;
    }

    public function removeLieuEtapes(CampLieuEtape $lieuEtapes): self
    {
        if ($this->lieuEtapes->contains($lieuEtapes)) {
            $this->lieuEtapes->removeElement($lieuEtapes);
            // set the owning side to null (unless already changed)
            if ($lieuEtapes->getCamp() === $this) {
                $lieuEtapes->setCamp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CampAdherentParticipant[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function clearParticipants()
    {
        return $this->participants->clear();
    }

    public function addParticipant(CampAdherentParticipant $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->setCamp($this);
        }

        return $this;
    }

    public function removeParticipant(CampAdherentParticipant $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
            // set the owning side to null (unless already changed)
            if ($participant->getCamp() === $this) {
                $participant->setCamp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CampAdherentStaff[]
     */
    public function getStaffs(): Collection
    {
        return $this->staffs;
    }

    public function clearStaffs()
    {
        return $this->staffs->clear();
    }

    public function addStaff(CampAdherentStaff $staff): self
    {
        if (!$this->staffs->contains($staff)) {
            $this->staffs[] = $staff;
            $staff->setCamp($this);
        }

        return $this;
    }

    public function removeStaff(CampAdherentStaff $staff): self
    {
        if ($this->staffs->contains($staff)) {
            $this->staffs->removeElement($staff);
            // set the owning side to null (unless already changed)
            if ($staff->getCamp() === $this) {
                $staff->setCamp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CampModule[]
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(CampModule $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
            $module->setCamp($this);
        }

        return $this;
    }

    public function removeModule(CampModule $module): self
    {
        if ($this->modules->contains($module)) {
            $this->modules->removeElement($module);
            // set the owning side to null (unless already changed)
            if ($module->getCamp() === $this) {
                $module->setCamp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CampStructure[]
     */
    public function getStructures(): Collection
    {
        return $this->structures;
    }

    public function addStructure(CampStructure $structure): self
    {
        if (!$this->structures->contains($structure)) {
            $this->structures[] = $structure;
            $structure->setCamp($this);
        }

        return $this;
    }

    public function removeStructure(CampStructure $structure): self
    {
        if ($this->structures->contains($structure)) {
            $this->structures->removeElement($structure);
            // set the owning side to null (unless already changed)
            if ($structure->getCamp() === $this) {
                $structure->setCamp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CampNumeroUtile[]
     */
    public function getNumeroUtiles(): Collection
    {
        return $this->numeroUtiles;
    }

    public function addNumeroUtile(CampNumeroUtile $numeroUtile): self
    {
        if (!$this->numeroUtiles->contains($numeroUtile)) {
            $this->numeroUtiles[] = $numeroUtile;
            $numeroUtile->setCamp($this);
        }

        return $this;
    }

    public function removeNumeroUtile(CampNumeroUtile $numeroUtile): self
    {
        if ($this->numeroUtiles->contains($numeroUtile)) {
            $this->numeroUtiles->removeElement($numeroUtile);
            // set the owning side to null (unless already changed)
            if ($numeroUtile->getCamp() === $this) {
                $numeroUtile->setCamp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CampJourneeType[]
     */
    public function getJourneeTypes(): Collection
    {
        return $this->journeeTypes;
    }

    public function addJourneeType(CampJourneeType $journeeType): self
    {
        if (!$this->journeeTypes->contains($journeeType)) {
            $this->journeeTypes[] = $journeeType;
            $journeeType->setCamp($this);
        }

        return $this;
    }

    public function removeJourneeType(CampJourneeType $journeeType): self
    {
        if ($this->journeeTypes->contains($journeeType)) {
            $this->journeeTypes->removeElement($journeeType);
            // set the owning side to null (unless already changed)
            if ($journeeType->getCamp() === $this) {
                $journeeType->setCamp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CampGrilleActivite[]
     */
    public function getGrilleActivites(): Collection
    {
        return $this->grilleActivites;
    }

    public function addGrilleActivite(CampGrilleActivite $grilleActivite): self
    {
        if (!$this->grilleActivites->contains($grilleActivite)) {
            $this->grilleActivites[] = $grilleActivite;
            $grilleActivite->setCamp($this);
        }

        return $this;
    }

    public function removeGrilleActivite(CampGrilleActivite $grilleActivite): self
    {
        if ($this->grilleActivites->contains($grilleActivite)) {
            $this->grilleActivites->removeElement($grilleActivite);
            // set the owning side to null (unless already changed)
            if ($grilleActivite->getCamp() === $this) {
                $grilleActivite->setCamp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CampDiscussionSujet[]
     */
    public function getDiscussions(): Collection
    {
        return $this->discussions;
    }

    public function addDiscussion(CampDiscussionSujet $discussion): self
    {
        if (!$this->discussions->contains($discussion)) {
            $this->discussions[] = $discussion;
            $discussion->setCamp($this);
        }

        return $this;
    }

    public function removeDiscussion(CampDiscussionSujet $discussion): self
    {
        if ($this->discussions->contains($discussion)) {
            $this->discussions->removeElement($discussion);
            // set the owning side to null (unless already changed)
            if ($discussion->getCamp() === $this) {
                $discussion->setCamp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CampAvis[]
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(CampAvis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setCamp($this);
        }

        return $this;
    }

    public function removeAvi(CampAvis $avi): self
    {
        if ($this->avis->contains($avi)) {
            $this->avis->removeElement($avi);
            // set the owning side to null (unless already changed)
            if ($avi->getCamp() === $this) {
                $avi->setCamp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CampAdherentSoutien[]
     */
    public function getSoutiens(): Collection
    {
        return $this->soutiens;
    }

    public function addSoutien(CampAdherentSoutien $soutien): self
    {
        if (!$this->soutiens->contains($soutien)) {
            $this->soutiens[] = $soutien;
            $soutien->setCamp($this);
        }

        return $this;
    }

    public function removeAdherentSoutien(CampAdherentSoutien $soutien): self
    {
        if ($this->soutiens->contains($soutien)) {
            $this->soutiens->removeElement($soutien);
            // set the owning side to null (unless already changed)
            if ($soutien->getCamp() === $this) {
                $soutien->setCamp(null);
            }
        }

        return $this;
    }

    public function addLieuEtape(CampLieuEtape $lieuEtape): self
    {
        if (!$this->lieuEtapes->contains($lieuEtape)) {
            $this->lieuEtapes[] = $lieuEtape;
            $lieuEtape->setCamp($this);
        }

        return $this;
    }

    public function removeLieuEtape(CampLieuEtape $lieuEtape): self
    {
        if ($this->lieuEtapes->contains($lieuEtape)) {
            $this->lieuEtapes->removeElement($lieuEtape);
            // set the owning side to null (unless already changed)
            if ($lieuEtape->getCamp() === $this) {
                $lieuEtape->setCamp(null);
            }
        }

        return $this;
    }

    private function _getIdSortedIterator($coll)
    {
        $iterator = $coll->getIterator();
        $iterator->uasort(function ($first, $second) {
            return (int)$first->getId() > (int)$second->getId() ? 1 : -1;
        });
        return $iterator;
    }

    public function removeSoutien(CampAdherentSoutien $soutien): self
    {
        if ($this->soutiens->contains($soutien)) {
            $this->soutiens->removeElement($soutien);
            // set the owning side to null (unless already changed)
            if ($soutien->getCamp() === $this) {
                $soutien->setCamp(null);
            }
        }

        return $this;
    }
}
