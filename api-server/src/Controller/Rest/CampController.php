<?php


namespace App\Controller\Rest;

use App\Controller\Rest\Dto\CampCreationDto;
use App\Entity\Camp;
use App\Service\CampService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\JMS\RestSerializerGroupEnum;
use App\Enums\JMS\RestSerializerGroupCampModuleEnum;

/**
 * Class CampController
 *
 * @SWG\Tag(name="Camp - Informations")
 *
 * @package App\Controller\Rest
 */
class CampController extends AbstractDdcRestController
{
    /**
     * Affiche la liste des Camps
     * FIXME ajouter support de critères de filtrage
     *
     * @Rest\Get("/camps")
     * @Rest\View(serializerGroups={
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     *
     * @SWG\Response(
     *     description="Retourne la liste des camps.",
     *     response=200,
     *     @SWG\Schema(
     *         type="array",
     *          @Model(type=Camp::class, groups={RestSerializerGroupEnum::TOUJOURS})
     *     )
     * )
     *
     * @return View
     */
    public function getCamps(): View
    {
        $camps = $this->getDdcService(CampService::class)->getCamps();
        return View::create($camps, Response::HTTP_OK);
    }

    /**
     * Retourne les informations concernant un module particulier pour un camp donné
     *
     * @Rest\Get("/camps/{id}")
     * @REST\QueryParam(name="module", default=RestSerializerGroupCampModuleEnum::NOT_SET, description="Code du module")
     *
     * @SWG\Response(
     *     description="Retourne le camp.",
     *     response=200,
     *     @Model(type=Camp::class, groups={RestSerializerGroupEnum::TOUJOURS})
     * )
     *
     * @param int $id   identifiant du camp
     * @param ParamFetcherInterface $paramFetcher
     * @return Response
     */
    public function getCampForModule(int $id, ParamFetcherInterface $paramFetcher): Response
    {
        $camp = $this->getDdcService(CampService::class)->getCamp($id);

        $jmsGroups = [];
        $module = $paramFetcher->get("module");
        if ($module) $jmsGroups[] = $module;

        // Ajout du header contenant la dernière modification apportée au module
        $headers = [];
        $campHistoLastModification = $this->getDdcService(CampService::class)->getLastModuleModification($id, $module);
        if ($campHistoLastModification) {
            $headers["X-DDC-CAMP_HISTO_MODULE_DERNIERE_MODIFICATION"] = $this->serializeToJson($campHistoLastModification);
        }
        return $this->serializerGroupsFiltering($camp, $jmsGroups, Response::HTTP_OK, $headers);
    }

    /**
     * @Rest\Post("/camps")
     * @ParamConverter("campCreationDto", converter="fos_rest.request_body")
     *
     * @Rest\View(serializerGroups={
     *     RestSerializerGroupEnum::TOUJOURS,
     * })
     *
     * @SWG\Parameter(
     *      name="body",
     *      in="body",
     *      description="DTO",
     *      type="json",
     *      required=true,
     *      @Model(type=CampCreationDto::class)
     * )
     * @SWG\Response(
     *     description="Retourne le camp nouvellement créé.",
     *     response=200,
     *     @Model(type=Camp::class, groups={RestSerializerGroupEnum::TOUJOURS})
     * )
     *
     * @param CampCreationDto $campCreationDto
     * @return View
     */
    public function creerCamp(CampCreationDto $campCreationDto): View
    {
        // FIXME Récupérer userNumero depuis le Token
        $userNumero = '150000000';

        $camp = $this->getDdcService(CampService::class)->creerCamp($campCreationDto, $userNumero);
        return View::create($camp, Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/camps/modules/INFO_GENERALE")
     * @ParamConverter("camp", converter="fos_rest.request_body")
     *
     * @Rest\View(serializerGroups={
     *     RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupCampModuleEnum::INFO_GENERALE,
     * })
     *
     * @SWG\Parameter(
     *      name="body",
     *      in="body",
     *      description="Données administratives du camps à sauvegarder",
     *      type="json",
     *      required=true,
     *      @Model(type=Camp::class, groups={RestSerializerGroupEnum::IDENTIFIANT,RestSerializerGroupEnum::REF,RestSerializerGroupCampModuleEnum::INFO_GENERALE})
     * )
     * @SWG\Response(
     *     description="Retourne les données administratives du camp modifié.",
     *     response=200,
     *     @Model(type=Camp::class, groups={RestSerializerGroupEnum::TOUJOURS,RestSerializerGroupCampModuleEnum::INFO_GENERALE})
     * )
     *
     * @param Camp $camp
     * @return View
     */
    public function modifierCampAdministration(Camp $camp): View
    {
        // FIXME Récupérer userNumero depuis le Token
        $userNumero = '150000000';

        $camp = $this->getDdcService(CampService::class)
            ->modifierCampModule($camp, RestSerializerGroupCampModuleEnum::INFO_GENERALE(), $userNumero);
        return View::create($camp, Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/camps/modules/PARTICIPANT")
     * @ParamConverter("camp", converter="fos_rest.request_body")
     *
     * @Rest\View(serializerGroups={
     *     RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupCampModuleEnum::PARTICIPANT,
     * })
     *
     * @SWG\Parameter(
     *      name="body",
     *      in="body",
     *      description="Participant à sauvegarder",
     *      type="json",
     *      required=true,
     *      @Model(type=Camp::class, groups={RestSerializerGroupEnum::IDENTIFIANT,RestSerializerGroupEnum::REF,RestSerializerGroupCampModuleEnum::PARTICIPANT})
     * )
     * @SWG\Response(
     *     description="Retourne les participants au camp modifié.",
     *     response=200,
     *     @Model(type=Camp::class, groups={RestSerializerGroupEnum::TOUJOURS,RestSerializerGroupCampModuleEnum::PARTICIPANT})
     * )
     *
     * @param Camp $camp
     * @return View
     */
    public function modifierCampParticipant(Camp $camp): View
    {
        // FIXME Récupérer userNumero depuis le Token
        $userNumero = '150000000';

        $camp = $this->getDdcService(CampService::class)
            ->modifierCampModule($camp, RestSerializerGroupCampModuleEnum::PARTICIPANT(), $userNumero);
        return View::create($camp, Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/camps/modules/STAFF")
     * @ParamConverter("camp", converter="fos_rest.request_body")
     *
     * @Rest\View(serializerGroups={
     *     RestSerializerGroupEnum::TOUJOURS,
     *     RestSerializerGroupCampModuleEnum::STAFF,
     * })
     *
     * @SWG\Parameter(
     *      name="body",
     *      in="body",
     *      description="Staffs à sauvegarder",
     *      type="json",
     *      required=true,
     *      @Model(type=Camp::class, groups={RestSerializerGroupEnum::IDENTIFIANT,RestSerializerGroupEnum::REF,RestSerializerGroupCampModuleEnum::STAFF})
     * )
     * @SWG\Response(
     *     description="Retourne les participants au camp modifié.",
     *     response=200,
     *     @Model(type=Camp::class, groups={RestSerializerGroupEnum::TOUJOURS,RestSerializerGroupCampModuleEnum::STAFF})
     * )
     *
     * @param Camp $camp
     * @return View
     */
    public function modifierCampStaff(Camp $camp): View
    {
        // FIXME Récupérer userNumero depuis le Token
        $userNumero = '150000000';

        $camp = $this->getDdcService(CampService::class)
            ->modifierCampModule($camp, RestSerializerGroupCampModuleEnum::STAFF(), $userNumero);
        return View::create($camp, Response::HTTP_OK);
    }
}