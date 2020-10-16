<?php

namespace App\Repository;

use App\Entity\TypeCampModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeCampModule|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeCampModule|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeCampModule[]    findAll()
 * @method TypeCampModule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeCampModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeCampModule::class);
    }

    // /**
    //  * @return TypeCampModule[] Returns an array of TypeCampModule objects
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
    public function findOneBySomeField($value): ?TypeCampModule
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
