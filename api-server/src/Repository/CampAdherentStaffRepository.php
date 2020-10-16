<?php

namespace App\Repository;

use App\Entity\CampAdherentStaff;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CampAdherentStaff|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampAdherentStaff|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampAdherentStaff[]    findAll()
 * @method CampAdherentStaff[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampAdherentStaffRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampAdherentStaff::class);
    }

    // /**
    //  * @return CampAdherentStaff[] Returns an array of CampAdherentStaff objects
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
    public function findOneBySomeField($value): ?CampAdherentStaff
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
