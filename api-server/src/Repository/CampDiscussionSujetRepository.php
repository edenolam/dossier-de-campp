<?php

namespace App\Repository;

use App\Entity\CampDiscussionSujet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CampDiscussionSujet|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampDiscussionSujet|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampDiscussionSujet[]    findAll()
 * @method CampDiscussionSujet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampDiscussionSujetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampDiscussionSujet::class);
    }

    // /**
    //  * @return CampDiscussionSujet[] Returns an array of CampDiscussionSujet objects
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
    public function findOneBySomeField($value): ?CampDiscussionSujet
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
