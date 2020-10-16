<?php

namespace App\Repository;

use App\Entity\CampGrilleActivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CampGrilleActivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampGrilleActivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampGrilleActivite[]    findAll()
 * @method CampGrilleActivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampGrilleActiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampGrilleActivite::class);
    }

    // /**
    //  * @return CampGrilleActivite[] Returns an array of CampGrilleActivite objects
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
    public function findOneBySomeField($value): ?CampGrilleActivite
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
