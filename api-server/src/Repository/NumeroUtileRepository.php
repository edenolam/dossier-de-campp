<?php

namespace App\Repository;

use App\Entity\NumeroUtile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NumeroUtile|null find($id, $lockMode = null, $lockVersion = null)
 * @method NumeroUtile|null findOneBy(array $criteria, array $orderBy = null)
 * @method NumeroUtile[]    findAll()
 * @method NumeroUtile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumeroUtileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NumeroUtile::class);
    }

    // /**
    //  * @return NumeroUtile[] Returns an array of NumeroUtile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NumeroUtile
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
