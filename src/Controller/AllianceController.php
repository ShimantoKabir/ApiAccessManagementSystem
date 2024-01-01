<?php

namespace App\Controller;

use App\ApiResource\AllianceDto;
use App\Mapper\AllianceMapper;
use App\Service\AllianceService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $group = $this->alliancesService->saveAlliance($this->allianceMapper->dtoToEntity($allianceDto));
        return $this->json($group);
    }
}