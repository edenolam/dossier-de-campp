<?php

namespace App\Repository;

use App\Entity\CampModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CampModule|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampModule|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampModule[]    findAll()
 * @method CampModule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampModule::class);
    }

    // /**
    //  * @return CampModule[] Returns an array of CampModule objects
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
    public function findOneBySomeField($value): ?CampModule
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
