<?php


namespace App\Controller\Rest;

use App\Entity\CampDiscussionEchange;
use App\Entity\CampDiscussionSujet;
use App\Service\CampDiscussionSujetService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\JMS\RestSerializerGroupEnum;
use Swagger\Annotations as SWG;

/**
 * Class CampDiscussionSujetController
 *
 * @SWG\Tag(name="Camp - Sujet de discussion")
 *
 * @package App\Controller\Rest
 */
class CampDiscussionSujetController extends AbstractDdcRestController
{
    /**
     * Retourne la liste des discussions d'un camp
     *
     * @Rest\Get("/camp-discussion-sujets")
     * @REST\QueryParam(name="id_camp", requirements="\d+", nullable=false, description="Identifiant du camp")
     * @REST\QueryParam(name="code_module", nullable=true, description="code du module (optionnel)")
     * @REST\QueryParam(name="statut", requirements="\d+", nullable=true, description="Identifiant du camp")
     *
     * @SWG\Response(
     *     description="Retourne la liste des discussions rattachées au camp.",
     *     response=200,
     *     @SWG\Schema(
     *         type="array",
     *          @Model(type=CampDiscussionSujet::class, groups={RestSerializerGroupEnum::TOUJOURS})
     *     )
     * )
     *
     * @Rest\View(serializerGroups={
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     *
     * @param ParamFetcherInterface $paramFetcher
     * @return View
     */
    public function listerCampDiscussions(ParamFetcherInterface $paramFetcher): View
    {
        $discussions = $this->getDdcService(CampDiscussionSujetService::class)
            ->listerCampDiscussions(
                $paramFetcher->get("id_camp", true),
                $paramFetcher->get("code_module"),
                $paramFetcher->get("statut"));

        return View::create($discussions, Response::HTTP_OK);
    }

    /**
     * Récupére la discussion donnée ainsi que ses échanges.
     *
     * @Rest\Get("/camp-discussion-sujets/{id}")
     * @Rest\View(serializerGroups={
     *     RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupEnum::FICHE,
     * })
     *
     * @SWG\Response(
     *     description="Retourne la discussion.",
     *     response=200,
     *     @Model(type=CampDiscussionSujet::class, groups={RestSerializerGroupEnum::TOUJOURS,RestSerializerGroupEnum::FICHE})
     * )
     *
     * @return View
     */
    public function getById(int $id): View
    {
        $sujet = $this->getDdcService(CampDiscussionSujetService::class)->getById($id);
        return View::create($sujet, Response::HTTP_OK);
    }

    /**
     * Initialise une nouvelle discussion pour un camp et un module donnés
     *
     * @Rest\Post("/camp-discussion-sujets")
     * @ParamConverter("sujet", converter="fos_rest.request_body")
     *
     * @SWG\Parameter(
     *      name="body",
     *      in="body",
     *      description="DTO",
     *      type="json",
     *      required=true,
     *      @Model(type=CampDiscussionSujet::class, groups={RestSerializerGroupEnum::CREATION, RestSerializerGroupEnum::REF})
     * )
     * @SWG\Response(
     *     description="Retourne la discussion nouvellement créée.",
     *     response=200,
     *     @Model(type=CampDiscussionSujet::class, groups={RestSerializerGroupEnum::TOUJOURS})
     * )
     *
     * @Rest\View(serializerGroups={
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     *
     * @param CampDiscussionSujet $sujet
     * @return View
     */
    public function creerDiscussion(CampDiscussionSujet $sujet): View
    {
        // FIXME Récupérer userNumero depuis le Token
        $userNumero = '150000000';

        $sujet = $this->getDdcService(CampDiscussionSujetService::class)->creerDiscussion($sujet, $userNumero);
        return View::create($sujet, Response::HTTP_OK);
    }

    /**
     * Modifie la discussion donnée
     * @Rest\Put("/camp-discussion-sujets")
     * @ParamConverter("sujet", converter="fos_rest.request_body")
     *
     * @SWG\Parameter(
     *      name="body",
     *      in="body",
     *      description="DTO",
     *      type="json",
     *      required=true,
     *      @Model(type=CampDiscussionSujet::class, groups={RestSerializerGroupEnum::MODIFICATION, RestSerializerGroupEnum::REF})
     * )
     * @SWG\Response(
     *     description="Retourne la discussion modifiée.",
     *     response=200,
     *     @Model(type=CampDiscussionSujet::class, groups={RestSerializerGroupEnum::TOUJOURS})
     * )
     *
     * @Rest\View(serializerGroups={
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     * @param CampDiscussionSujet $sujet
     * @return View
     */
    public function modifierSujet(CampDiscussionSujet $sujet): View
    {
        // FIXME Récupérer userNumero depuis le Token
        $userNumero = '150000000';

        $sujet = $this->getDdcService(CampDiscussionSujetService::class)->modifierSujet($sujet, $userNumero);
        return View::create($sujet, Response::HTTP_OK);
    }
}