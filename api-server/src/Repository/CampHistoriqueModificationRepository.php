<?php

namespace App\Repository;

use App\Entity\CampHistoriqueModification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CampHistoriqueModification|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampHistoriqueModification|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampHistoriqueModification[]    findAll()
 * @method CampHistoriqueModification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampHistoriqueModificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampHistoriqueModification::class);
    }

    /**
     * @param int $idCamp
     * @param string $codeModule
     * @return mixed
     */
    public function getLastModuleModification(int $idCamp, string $codeModule)
    {
        $res = $this->createQueryBuilder('c')
            ->andWhere('c.camp = :idCamp')
            ->andWhere('c.codeModule = :codeModule')
            ->setParameter('idCamp', $idCamp)
            ->setParameter('codeModule', $codeModule)
            ->orderBy('c.dateHeureModification', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

        return ($res) ? $res[0] : null;
    }
}
