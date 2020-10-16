<?php

namespace App\Repository;

use App\Entity\CampAdherentSoutien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CampAdherentSoutien|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampAdherentSoutien|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampAdherentSoutien[]    findAll()
 * @method CampAdherentSoutien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampAdherentSoutienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampAdherentSoutien::class);
    }

    // /**
    //  * @return CampAdherentSoutien[] Returns an array of CampAdherentSoutien objects
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
    public function findOneBySomeField($value): ?CampAdherentSoutien
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
