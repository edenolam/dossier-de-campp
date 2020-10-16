<?php


namespace App\Controller\Rest;


use App\Service\AbstractDdcService;
use App\Service\DdcServiceLocator;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\JMS\RestSerializerGroupEnum;

abstract class AbstractDdcRestController extends AbstractFOSRestController implements LoggerAwareInterface
{
    /** @var LoggerInterface */ protected $logger;
    private $serviceLocator;
    /** @var SerializerInterface  */
    private $serializer;

    public function __construct(DdcServiceLocator $serviceLocator, SerializerInterface $serializer)
    {
        $this->serviceLocator = $serviceLocator;
        $this->serializer = $serializer;
    }

    protected function getDdcService(string $serviceName) : AbstractDdcService {
        return $this->serviceLocator->get($serviceName);
    }

    protected function serializeToJson($datas) {
        $ret = $this->serializer->serialize($datas,'json');
        return $ret;
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

    /** Retourne des données auxquelles une liste de groupe de filtrage JMS est appliquée
     * @param $data
     * @param array $jmsGroups
     * @param int $statutCode
     * @param array $headers
     * @return Response
     */
    protected function serializerGroupsFiltering($data, array $jmsGroups = ["default"],
                                                 int $statutCode = Response::HTTP_OK,
                                                 array $headers = []) : Response {
        // Ajout du groupe RestSerializerGroupEnum::TOUJOURS
        $jmsGroups[] = RestSerializerGroupEnum::TOUJOURS;

        // Filtrage
        $context = new Context();
        $context->setGroups($jmsGroups);
        $view = $this->view($data, $statutCode, $headers);
        $view->setContext($context);
        return $this->handleView($view);
    }
}