<?php

namespace App\Repository;

use App\Entity\CampAvis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CampAvis|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampAvis|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampAvis[]    findAll()
 * @method CampAvis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampAvisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampAvis::class);
    }

    // /**
    //  * @return CampAvis[] Returns an array of CampAvis objects
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
    public function findOneBySomeField($value): ?CampAvis
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
