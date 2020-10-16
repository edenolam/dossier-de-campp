<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupCampEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;

/**
 * CampNumeroUtile
 *
 * @ORM\Table(name="camp_numero_utile", uniqueConstraints={@ORM\UniqueConstraint(name="camp_numero_utile_uidx_c_2_3", columns={"id_camp", "id_numero_utile"})}, indexes={@ORM\Index(name="IDX_704D84274AB45E32", columns={"id_camp"}), @ORM\Index(name="IDX_704D84272C45B0F5", columns={"id_numero_utile"})})
 * @ORM\Entity
 */
class CampNumeroUtile extends AbstractDdcCampEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="infos_contact", type="string", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $infosContact;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone_contact", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $telephoneContact;

    /**
     * @var Camp
     *
     * @ORM\ManyToOne(targetEntity="Camp", inversedBy="numeroUtiles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Exclude()
     */
    private $camp;

    /**
     * @var NumeroUtile
     *
     * @ORM\ManyToOne(targetEntity="NumeroUtile", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_numero_utile", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     * })
     */
    private $numeroUtile;

    public function getInfosContact(): ?string
    {
        return $this->infosContact;
    }

    public function setInfosContact(string $infosContact): self
    {
        $this->infosContact = $infosContact;

        return $this;
    }

    public function getTelephoneContact(): ?string
    {
        return $this->telephoneContact;
    }

    public function setTelephoneContact(?string $telephoneContact): self
    {
        $this->telephoneContact = $telephoneContact;

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
