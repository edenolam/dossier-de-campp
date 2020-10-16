<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupRefsEnum;

/**
 * TypeCamp
 *
 * @ORM\Table(name="type_camp", uniqueConstraints={@ORM\UniqueConstraint(name="type_camp_uidx_c_2", columns={"libelle"})})
 * @ORM\Entity(repositoryClass="App\Repository\TypeCampRepository", readOnly=true)
 */
class TypeCamp
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", nullable=false)
     * @ORM\Id
     * @JMS\Groups({
     *     RestSerializerGroupEnum::IDENTIFIANT,
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="code_groupe_camp", type="string", nullable=false)
     * @JMS\Groups({
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $codeGroupeCamp;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", nullable=false)
     * @JMS\Groups({
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="fichier_css", type="string", nullable=false, options={"comment"="Nom du fichier CSS associé"})
     * @JMS\Groups({
     *     RestSerializerGroupRefsEnum::FICHE
     * })
     */
    private $fichierCss;

    /**
     * @var string
     *
     * @ORM\Column(name="fichier_logo", type="string", nullable=false)
     * @JMS\Groups({
     *     RestSerializerGroupRefsEnum::FICHE,
     * })
     */
    private $fichierLogo;

    /**
     * @var bool
     *
     * @ORM\Column(name="actif", type="boolean", nullable=false, options={"default"="1"})
     * @JMS\Groups({
     *     RestSerializerGroupRefsEnum::FICHE,
     * })
     */
    private $actif = true;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Camp", mappedBy="typeCamp")
     *
     * @JMS\Exclude()
     */
    private $camps;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="TypeCampModule", mappedBy="typeCamp")
     *
     * @JMS\Groups({
     *      RestSerializerGroupRefsEnum::FICHE,
     *      RestSerializerGroupRefsEnum::MODULE,
     * })
     */
    private $modules;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="TypeCampNumeroUtile", mappedBy="typeCamp")
     *
     * @JMS\Groups({
     *      RestSerializerGroupRefsEnum::FICHE,
     *      RestSerializerGroupRefsEnum::NUMERO_UTILE,
     * })
     */
    private $numeroUtiles;

    public function __construct()
    {
        $this->camps = new ArrayCollection();
        $this->modules = new ArrayCollection();
        $this->numeroUtiles = new ArrayCollection();
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getCodeGroupeCamp(): string
    {
        return $this->codeGroupeCamp;
    }

    public function setCodeGroupeCamp(string $codeGroupeCamp): self
    {
        $this->codeGroupeCamp = $codeGroupeCamp;

        return $this;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getFichierCss(): ?string
    {
        return $this->fichierCss;
    }

    public function setFichierCss(string $fichierCss): self
    {
        $this->fichierCss = $fichierCss;

        return $this;
    }

    public function getFichierLogo(): ?string
    {
        return $this->fichierLogo;
    }

    public function setFichierLogo(string $fichierLogo): self
    {
        $this->fichierLogo = $fichierLogo;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * @return Collection|Camp[]
     */
    public function getCamps(): Collection
    {
        return $this->camps;
    }

    public function addCamp(Camp $camp): self
    {
        if (!$this->camps->contains($camp)) {
            $this->camps[] = $camp;
            $camp->setTypeCamp($this);
        }

        return $this;
    }

    public function removeCamp(Camp $camp): self
    {
        if ($this->camps->contains($camp)) {
            $this->camps->removeElement($camp);
            // set the owning side to null (unless already changed)
            if ($camp->getTypeCamp() === $this) {
                $camp->setTypeCamp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeCampModule[]
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(TypeCampModule $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
            $module->setTypeCamp($this);
        }

        return $this;
    }

    public function removeModule(TypeCampModule $module): self
    {
        if ($this->modules->contains($module)) {
            $this->modules->removeElement($module);
            // set the owning side to null (unless already changed)
            if ($module->getTypeCamp() === $this) {
                $module->setTypeCamp(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TypeCampNumeroUtile[]
     */
    public function getNumeroUtiles(): Collection
    {
        return $this->numeroUtiles;
    }

    public function addNumeroUtile(TypeCampNumeroUtile $numeroUtile): self
    {
        if (!$this->numeroUtiles->contains($numeroUtile)) {
            $this->numeroUtiles[] = $numeroUtile;
            $numeroUtile->setTypeCamp($this);
        }

        return $this;
    }

    public function removeNumeroUtile(TypeCampNumeroUtile $numeroUtile): self
    {
        if ($this->numeroUtiles->contains($numeroUtile)) {
            $this->numeroUtiles->removeElement($numeroUtile);
            // set the owning side to null (unless already changed)
            if ($numeroUtile->getTypeCamp() === $this) {
                $numeroUtile->setTypeCamp(null);
            }
        }

        return $this;
    }


}
