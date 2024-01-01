<?php

namespace App\Repository\Implementation;

use App\Entity\Action;
use App\Entity\Alliance;
use App\Repository\ActionRepository;
use App\Repository\AllianceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class IAllianceRepository implements AllianceRepository
{
    private EntityManagerInterface $entityManager;
    private EntityRepository $entityRepository;
    private ActionRepository $actionRepository;

    public function __construct(EntityManagerInterface $entityManager, ActionRepository $actionRepository)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $this->entityManager->getRepository(Alliance::class);
        $this->actionRepository = $actionRepository;
    }


    /**
     * @param int $id
     * @return Alliance|null
     */
    function findById(int $id): ?Alliance
    {
        return $this->entityRepository->find($id);
    }

    /**
     * @param Alliance $alliance
     * @return Alliance|null
     */
    function saveAlliance(Alliance $alliance): ?Alliance
    {
        foreach ($alliance->getActionIds() as $id){
            $alliance->addAction($this->actionRepository->findById($id));
        }

        $this->entityManager->persist($alliance);
        $this->entityManager->flush();

        return $alliance;
    }

    /**
     * @param Alliance $alliance
     * @param int $id
     * @return Alliance|null
     */
    function updateAlliance(Alliance $alliance, int $id): ?Alliance
    {
        // TODO: Implement updateGroup() method.
    }

    /**
     * @param int $id
     * @return bool
     */
    function deleteAlliance(int $id): bool
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