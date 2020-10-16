<?php

namespace App\Repository;

use App\Entity\CampJourneeType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CampJourneeType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampJourneeType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampJourneeType[]    findAll()
 * @method CampJourneeType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampJourneeTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampJourneeType::class);
    }

    // /**
    //  * @return CampJourneeType[] Returns an array of CampJourneeType objects
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
    public function findOneBySomeField($value): ?CampJourneeType
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
