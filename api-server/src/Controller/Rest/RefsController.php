<?php


namespace App\Controller\Rest;

use App\Service\RefsService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupRefsEnum;

/**
 * Class RefsController
 *
 * @SWG\Tag(name="Référentiel")
 *
 * @package App\Controller\Rest
 */
class RefsController extends AbstractDdcRestController
{
    /**
     * Récupére la liste des types de camps actifs avec la liste des modules disponibles
     * @Rest\Get("/type-camps")
     * @Rest\View(serializerGroups={
     *     RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupRefsEnum::MODULE,
     * })
     *
     * @SWG\Response(
     *     description="Retourne la liste des types de camps avec leurs différents modules autorisés.",
     *     response=200,
     *     @SWG\Schema(
     *         type="array",
     *          @Model(type=TypeCamp::class, groups={RestSerializerGroupEnum::TOUJOURS,RestSerializerGroupRefsEnum::MODULE})
     *     )
     * )
     */
    public function getTypeCamps(): View
    {
        $typeCamps = $this->getDdcService(RefsService::class)->getTypeCamps();
        return View::create($typeCamps, Response::HTTP_OK);
    }
}