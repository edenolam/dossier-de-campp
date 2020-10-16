<?php

namespace App\Repository;

use App\Entity\TypeCampNumeroUtile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeCampNumeroUtile|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeCampNumeroUtile|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeCampNumeroUtile[]    findAll()
 * @method TypeCampNumeroUtile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeCampNumeroUtileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeCampNumeroUtile::class);
    }

    // /**
    //  * @return TypeCampNumeroUtile[] Returns an array of TypeCampNumeroUtile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeCampNumeroUtile
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
