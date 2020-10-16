<?php

namespace App\Repository;

use App\Entity\CampAdherentParticipant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CampAdherentParticipant|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampAdherentParticipant|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampAdherentParticipant[]    findAll()
 * @method CampAdherentParticipant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampAdherentParticipantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampAdherentParticipant::class);
    }

    // /**
    //  * @return CampAdherentParticipant[] Returns an array of CampAdherentParticipant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CampAdherentParticipant
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
