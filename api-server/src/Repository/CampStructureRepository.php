<?php

namespace App\Repository;

use App\Entity\CampStructure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CampStructure|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampStructure|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampStructure[]    findAll()
 * @method CampStructure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampStructureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampStructure::class);
    }

    // /**
    //  * @return CampStructure[] Returns an array of CampStructure objects
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
    public function findOneBySomeField($value): ?CampStructure
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
