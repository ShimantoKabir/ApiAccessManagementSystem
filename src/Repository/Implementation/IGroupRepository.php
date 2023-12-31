<?php

namespace App\Repository\Implementation;

use App\Entity\Action;
use App\Entity\Group;
use App\Repository\GroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class IGroupRepository implements GroupRepository
{
    private EntityManagerInterface $entityManager;
    private EntityRepository $entityRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $this->entityManager->getRepository(Group::class);
    }


    /**
     * @param int $id
     * @return Group|null
     */
    function fetchGroup(int $id): ?Group
    {
        return $this->entityRepository->find($id);
    }

    /**
     * @param Group $group
     * @return Group|null
     */
    function saveGroup(Group $group): ?Group
    {
//        foreach ($group->getActionList() as $action){
//            $group->getActions()->add($action);
//        }
//
        dd($group);

        $this->entityManager->persist($group);

        $this->entityManager->flush();

        return $group;
    }

    /**
     * @param Group $group
     * @param int $id
     * @return Group|null
     */
    function updateGroup(Group $group, int $id): ?Group
    {
        // TODO: Implement updateGroup() method.
    }

    /**
     * @param int $id
     * @return bool
     */
    function deleteGroup(int $id): bool
    {
        // TODO: Implement deleteGroup() method.
    }

    /**
     * @param Action $action
     * @return Action|null
     */
    function removeAction(Action $action): ?Action
    {
        // TODO: Implement removeAction() method.
    }

    /**
     * @param Action $action
     * @return Action|null
     */
    function addAction(Action $action): ?Action
    {
        // TODO: Implement addAction() method.
    }
}