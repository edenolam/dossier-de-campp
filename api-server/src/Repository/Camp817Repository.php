<?php

namespace App\Repository;

use App\Entity\Camp817;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Camp817|null find($id, $lockMode = null, $lockVersion = null)
 * @method Camp817|null findOneBy(array $criteria, array $orderBy = null)
 * @method Camp817[]    findAll()
 * @method Camp817[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Camp817Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Camp817::class);
    }

    // /**
    //  * @return Camp817[] Returns an array of Camp817 objects
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
    public function findOneBySomeField($value): ?Camp817
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
