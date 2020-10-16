<?php


namespace App\Entity;

use App\Enums\JMS\RestSerializerGroupEnum;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractDdcCampEntity
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
     *      RestSerializerGroupEnum::REF,
     *      RestSerializerGroupEnum::TOUJOURS,
     *      RestSerializerGroupEnum::MODIFICATION,
     * })
     */
    private $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /** Vérifie si deux dates sont différentes sans tenir compte de la partie horaire
     * Cette fonction est utilisée afin de ne setter les dates dans les entités ssi différentes
     * Cela évite les updates inutiles (ex sur rattachement des participant, staff, ...)
     * @param DateTimeInterface|null $date1
     * @param DateTimeInterface|null $date2
     * @return bool
     */
    protected function _areDatesDifferent(?DateTimeInterface $date1, ?DateTimeInterface $date2) : bool {
        if (!$date1 && !$date2) return false;
        if (!$date1 || !$date2) return true;
        if ($date1 && $date1->diff($date2)->d != 0) return true;
        if ($date2 && $date2->diff($date1)->d != 0) return true;
        return false;
    }
}