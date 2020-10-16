<?php


namespace App\Service;


use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

/** Classe abstraite dont toutes les classes de Service doivent descendre
 * afin d'avoir accès automatiquement à certains services annaxes (Log, Em, ...)
 * Class AbstractDdcService
 * @package App\Service
 */
abstract class AbstractDdcService implements LoggerAwareInterface
{
    /** @var LoggerInterface */
    protected $logger;
    private $doctrine;

    function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /** Sets a logger instance on the object.
     * @param LoggerInterface $logger
     * @return void
     * @see https://symfony.com/doc/4.4/logging.html
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /** Retourne une connexion postgres de bas niveau
     * @return Connection
     */
    protected function _getDdcSqlConnection(): Connection
    {
        return $this->doctrine->getManager('ddc')->getConnection();
    }

    /** Retourne l'entity manager
     * @return EntityManager
     */
    protected function getDdcEm(): EntityManager
    {
        return $this->doctrine->getManager('ddc');
    }

    /** Retourne le Repository de manipulation de l'entité dont le ClassName est passé en paramètre.
     * @param string $repositoryClassName
     * @return EntityRepository
     */
    protected function getDdcRepository(string $repositoryClassName): EntityRepository
    {
        return $this->getDdcEm()->getRepository($repositoryClassName);
    }
}