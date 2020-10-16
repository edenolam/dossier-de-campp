<?php

namespace App\Repository;

use App\Entity\CampCompagnon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CampCompagnon|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampCompagnon|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampCompagnon[]    findAll()
 * @method CampCompagnon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampCompagnonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampCompagnon::class);
    }

    // /**
    //  * @return CampCompagnon[] Returns an array of CampCompagnon objects
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
    public function findOneBySomeField($value): ?CampCompagnon
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
