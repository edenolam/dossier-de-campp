<?php

namespace App\Repository;

use App\Entity\CampNumeroUtile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CampNumeroUtile|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampNumeroUtile|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampNumeroUtile[]    findAll()
 * @method CampNumeroUtile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampNumeroUtileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampNumeroUtile::class);
    }

    // /**
    //  * @return CampNumeroUtile[] Returns an array of CampNumeroUtile objects
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
    public function findOneBySomeField($value): ?CampNumeroUtile
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
