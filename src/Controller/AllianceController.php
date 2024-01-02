<?php

namespace App\Controller;

use App\ApiResource\AllianceActionDto;
use App\ApiResource\AllianceDto;
use App\Mapper\AllianceMapper;
use App\Service\AllianceService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class AllianceController extends AbstractController
{
    public AllianceService $alliancesService;
    public AllianceMapper $allianceMapper;

    public function __construct(AllianceService $alliancesService, AllianceMapper $allianceMapper)
    {
        $this->alliancesService = $alliancesService;
        $this->allianceMapper = $allianceMapper;
    }

    /**
     * @throws Exception
     */
    #[Route('/api/alliances', name: 'save-alliance', methods: "POST")]
    public function saveAlliance(#[MapRequestPayload] AllianceDto $allianceDto): JsonResponse
    {
        $alliance = $this->alliancesService->saveAlliance($this->allianceMapper->dtoToEntity($allianceDto));
        return $this->json($this->allianceMapper->entityToDto($alliance));
    }

    #[Route('/api/alliances/{id}', name: 'fetch-alliance', methods: "GET")]
    public function fetchAllianceById(int $id): JsonResponse
    {
        $alliance = $this->alliancesService->fetchAllianceById($id);
        return $this->json($this->allianceMapper->entityToDto($alliance));
    }

    #[Route('/api/alliances/{id}', name: 'remove-alliance', methods: "DELETE")]
    public function removeAllianceById(int $id): JsonResponse
    {
        $alliance = $this->alliancesService->removeAllianceById($id);
        return $this->json(["message" => "Actions added!"],Response::HTTP_GONE);
    }

    #[Route('/api/alliances/actions', name: 'delete-action-from-alliances', methods: "DELETE")]
    public function removeActions(#[MapRequestPayload] AllianceActionDto $allianceActionDto): JsonResponse
    {
        $this->alliancesService->removeActions($allianceActionDto);
        return $this->json(["message" => "Actions removed!"],Response::HTTP_GONE);
    }

    #[Route('/api/alliances/actions', name: 'add-action-from-alliances', methods: "PATCH")]
    public function addActions(#[MapRequestPayload] AllianceActionDto $allianceActionDto): JsonResponse
    {
        $this->alliancesService->addActions($allianceActionDto);
        return $this->json(["message" => "Actions added!"],Response::HTTP_GONE);
    }
}