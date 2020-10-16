<?php

namespace App\Repository;

use App\Entity\TypeCamp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeCamp|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeCamp|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeCamp[]    findAll()
 * @method TypeCamp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeCampRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeCamp::class);
    }

    // /**
    //  * @return TypeCamp[] Returns an array of TypeCamp objects
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
    public function findOneBySomeField($value): ?TypeCamp
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
