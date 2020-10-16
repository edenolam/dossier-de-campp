<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use App\Enums\JMS\RestSerializerGroupCampEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;

/**
 * CampJourneeType
 *
 * @ORM\Table(name="camp_journee_type", uniqueConstraints={@ORM\UniqueConstraint(name="camp_journee_type_uidx_c_2_3", columns={"id_camp", "heure_debut"})}, indexes={@ORM\Index(name="IDX_986F5BDA4AB45E32", columns={"id_camp"})})
 * @ORM\Entity
 */
class CampJourneeType extends AbstractDdcCampEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="heure_debut", type="string", length=5, nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $heureDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="activite_participants", type="string", nullable=false)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $activiteParticipants;

    /**
     * @var string|null
     *
     * @ORM\Column(name="activite_staff", type="string", nullable=true)
     *
     * @JMS\Groups({
     *      RestSerializerGroupCampModuleEnum::NOT_SET,
     *      RestSerializerGroupCampEnum::HISTORISABLE,
     * })
     */
    private $activiteStaff;

    /**
     * @var Camp
     *
     * @ORM\ManyToOne(targetEntity="Camp", inversedBy="journeeTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_camp", referencedColumnName="id", nullable=false)
     * })
     *
     * @JMS\Exclude()
     */
    private $camp;

    public function getHeureDebut(): ?string
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(string $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getActiviteParticipants(): ?string
    {
        return $this->activiteParticipants;
    }

    public function setActiviteParticipants(string $activiteParticipants): self
    {
        $this->activiteParticipants = $activiteParticipants;

        return $this;
    }

    public function getActiviteStaff(): ?string
    {
        return $this->activiteStaff;
    }

    public function setActiviteStaff(?string $activiteStaff): self
    {
        $this->activiteStaff = $activiteStaff;

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
}
