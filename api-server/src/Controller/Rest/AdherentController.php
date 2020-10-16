<?php


namespace App\Controller\Rest;

use App\Entity\Adherent;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupRefsEnum;
use App\Service\RefsService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdherentController
 *
 * @SWG\Tag(name="Référentiel")
 *
 * @package App\Controller\Rest
 */
class AdherentController extends AbstractDdcRestController
{
    /**
     * Récupére la liste des adhérents visible par l'utilisateur connecté.
     * On peut également en sélectionner un depuis cette liste en spécifiant son numéro en paramètre
     *
     * @Rest\Get("/adherents")
     * @REST\QueryParam(name="numero", requirements="\d+", nullable=true, description="Numéro de l'adhérent particulier")
     *
     * @Rest\View(serializerGroups={
     *     RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupRefsEnum::FICHE,
     * })
     *
     * @SWG\Response(
     *     description="Retourne la liste des des adhérents visible par l'utilisateur connecté.",
     *     response=200,
     *     @SWG\Schema(
     *         type="array",
     *          @Model(type=Adherent::class, groups={RestSerializerGroupEnum::TOUJOURS, RestSerializerGroupRefsEnum::FICHE})
     *     )
     * )
     *
     * @param ParamFetcherInterface $paramFetcher
     * @return View
     */
    public function getAdherents(ParamFetcherInterface $paramFetcher): View
    {
        // FIXME Récupérer userNumero depuis le Token
        $userNumero = '150000000';

        $discussions = $this->getDdcService(RefsService::class)
            ->getAdherents($userNumero,
                $paramFetcher->get("numero"));

        return View::create($discussions, Response::HTTP_OK);
    }
}