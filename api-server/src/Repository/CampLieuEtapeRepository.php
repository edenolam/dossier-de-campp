<?php

namespace App\Repository;

use App\Entity\CampLieuEtape;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CampLieuEtape|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampLieuEtape|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampLieuEtape[]    findAll()
 * @method CampLieuEtape[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampLieuEtapeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampLieuEtape::class);
    }

    // /**
    //  * @return CampLieuEtape[] Returns an array of CampLieuEtape objects
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
    public function findOneBySomeField($value): ?CampLieuEtape
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
