<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * CampCompagnon
 *
 * @ORM\Table(name="camp_compagnon")
 * @ORM\Entity
 */
class CampCompagnon
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @JMS\Exclude
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }


}
