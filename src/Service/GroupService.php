<?php

namespace App\Service;

use App\Entity\Group;
use App\Repository\GroupRepository;
use Exception;

/**
 *
 */
class GroupService
{
    /**
     * @var GroupRepository
     */
    private GroupRepository $groupRepository;

    /**
     * @param GroupRepository $groupRepository
     */
    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * @throws Exception
     */
    public function saveGroup(Group $group) : Group
    {
        $group = $this->groupRepository->saveGroup($group);

        if ($group == null){
            throw new Exception("Can't save the group!");
        }

        return $group;
    }
}