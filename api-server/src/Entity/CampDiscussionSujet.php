<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupCampEnum;

/**
 * CampDiscussionSujet
 *
 * @ORM\Table(name="camp_discussion_sujet",
 *     indexes={
 *      @ORM\Index(name="camp_discussion_sujet_idx_c_2_3_4", columns={"id_camp", "code_module", "date_heure_creation"}),
 *      @ORM\Index(name="IDX_73D5CF04AB45E32", columns={"id_camp"}),
 *      @ORM\Index(name="IDX_73D5CF0AC64AA10", columns={"numero_adherent_createur"}),
 *      @ORM\Index(name="IDX_73D5CF05202F444", columns={"numero_adherent_destinataire"})
 *  })
 * @ORM\Entity
 */
class CampDiscussionSujet extends AbstractDdcCampEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_module", type="string", nullable=false, options={"comment"="Module, ecran concerné"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *      RestSerializerGroupEnum::CREATION,
     * })
     */
    private $codeModule;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_heure_creation", type="datetimetz", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $dateHeureCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="sujet", type="string", nullable=false)
     *
     * @JMS\Groups({
     *     RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupEnum::CREATION,
     *     RestSerializerGroupEnum::MODIFICATION,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $sujet;

    /**
     * @var int
     *
     * @ORM\Column(name="statut", type="integer", nullable=false, options={"default"="1","comment"="1=Ouvert"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *      RestSerializerGroupEnum::MODIFICATION,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $statut = '1';

    /**
     * @var Camp
     *
     * @ORM\ManyToOne(targetEntity="Camp", inversedBy="discussions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp", referencedColumnName="id")
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::CREATION,
     * })
     */
    private $camp;

    /**
     * @var Adherent
     *
     * @ORM\ManyToOne(targetEntity="Adherent", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numero_adherent_createur", referencedColumnName="numero", nullable=false)
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $adherentCreateur;

    /**
     * @var Adherent
     *
     * @ORM\ManyToOne(targetEntity="Adherent", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numero_adherent_destinataire", referencedColumnName="numero")
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupEnum::CREATION,
     *     RestSerializerGroupEnum::MODIFICATION,
     *     RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $adherentDestinataire;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CampDiscussionEchange", mappedBy="sujet", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"id" = "ASC"})
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $echanges;

    public function __construct()
    {
        $this->echanges = new ArrayCollection();
    }

    public function getCodeModule(): ?string
    {
        return $this->codeModule;
    }

    public function setCodeModule(string $codeModule): self
    {
        $this->codeModule = $codeModule;

        return $this;
    }

    public function getDateHeureCreation(): ?\DateTimeInterface
    {
        return $this->dateHeureCreation;
    }

    public function setDateHeureCreation(\DateTimeInterface $dateHeureCreation): self
    {
        $this->dateHeureCreation = $dateHeureCreation;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

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

    public function getCamp(): ?Camp
    {
        return $this->camp;
    }

    public function setCamp(?Camp $camp): self
    {
        $this->camp = $camp;

        return $this;
    }

    public function getAdherentCreateur(): ?Adherent
    {
        return $this->adherentCreateur;
    }

    public function setAdherentCreateur(?Adherent $adherentCreateur): self
    {
        $this->adherentCreateur = $adherentCreateur;

        return $this;
    }

    public function getAdherentDestinataire(): ?Adherent
    {
        return $this->adherentDestinataire;
    }

    public function setAdherentDestinataire(?Adherent $adherentDestinataire): self
    {
        $this->adherentDestinataire = $adherentDestinataire;

        return $this;
    }

    /**
     * @return Collection|CampDiscussionEchange[]
     */
    public function getEchanges(): Collection
    {
        return $this->echanges;
    }

    public function addEchange(CampDiscussionEchange $echange): self
    {
        if (!$this->echanges->contains($echange)) {
            $this->echanges[] = $echange;
            $echange->setSujet($this);
        }

        return $this;
    }

    public function removeEchange(CampDiscussionEchange $echange): self
    {
        if ($this->echanges->contains($echange)) {
            $this->echanges->removeElement($echange);
            // set the owning side to null (unless already changed)
            if ($echange->getSujet() === $this) {
                $echange->setSujet(null);
            }
        }

        return $this;
    }

}
