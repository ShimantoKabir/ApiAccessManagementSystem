<?php

namespace App\Controller;

use App\ApiResource\GroupDto;
use App\Mapper\GroupMapper;
use App\Service\GroupService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class GroupController extends AbstractController
{
    public GroupService $groupService;
    public GroupMapper $groupMapper;

    public function __construct(GroupService $groupService, GroupMapper $groupMapper)
    {
        $this->groupService = $groupService;
        $this->groupMapper = $groupMapper;
    }

    /**
     * @throws Exception
     */
    #[Route('/api/groups', name: 'save-group', methods: "POST")]
    public function saveGroup(#[MapRequestPayload] GroupDto $groupDto): JsonResponse
    {
        $group = $this->groupService->saveGroup($this->groupMapper->dtoToEntity($groupDto));
        return $this->json($group);
    }
}