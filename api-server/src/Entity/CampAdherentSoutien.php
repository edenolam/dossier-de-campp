<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupCampEnum;

/**
 * CampAdherentSoutien
 *
 * @ORM\Table(name="camp_adherent_soutien", uniqueConstraints={@ORM\UniqueConstraint(name="camp_adherent_soutien_uidx_c_2_3", columns={"id_camp", "numero_adherent"})}, indexes={@ORM\Index(name="IDX_FA671FF74AB45E32", columns={"id_camp"}), @ORM\Index(name="IDX_FA671FF731C43700", columns={"numero_adherent"})})
 * @ORM\Entity
 */
class CampAdherentSoutien extends AbstractDdcCampEntity
{
    /**
     * @var Camp
     *
     * @ORM\ManyToOne(targetEntity="Camp", inversedBy="soutiens")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Exclude()
     *
     */
    private $camp;

    /**
     * @var Adherent
     *
     * @ORM\ManyToOne(targetEntity="Adherent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numero_adherent", referencedColumnName="numero", nullable=false)
     * })
     *
     * @JMS\Groups({
     *      RestSerializerGroupEnum::TOUJOURS,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $adherent;

    public function getCamp(): ?Camp
    {
        return $this->camp;
    }

    public function setCamp(?Camp $camp): self
    {
        $this->camp = $camp;

        return $this;
    }

    public function getAdherent(): ?Adherent
    {
        return $this->adherent;
    }

    public function setAdherent(?Adherent $adherent): self
    {
        $this->adherent = $adherent;

        return $this;
    }

}
