<?php

namespace App\Repository\Implementation;

use App\Entity\Action;
use App\Repository\ActionRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 *
 */
class IActionRepository implements ActionRepository
{

    private EntityManagerInterface $entityManager;
    private EntityRepository $entityRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $this->entityManager->getRepository(Action::class);
    }

    /**
     * @param Action $action
     * @return Action
     */
    function save(Action $action): Action
    {
        $this->entityManager->persist($action);;
        $this->entityManager->flush();

        return $action;
    }

    /**
     * @param string $route
     * @param string $method
     * @return Action|null
     */
    function findByRouteAndMethod(string $route, string $method): ?Action
    {
        return $this->entityRepository->findOneBy([
            'route' => $route,
            'method' => $method,
        ]);
    }

    /**
     * @param Action $action
     * @param int $id
     * @return Action|null
     */
    function update(Action $action, int $id): ?Action
    {
        $existAction = $this->entityRepository->find($id);

        if ($existAction == null){
            return null;
        }

        $existAction->setRoute($action->getRoute());
        $existAction->setMethod($action->getMethod());

        $this->entityManager->persist($existAction);;
        $this->entityManager->flush();

        return $existAction;
    }

    function findById(int $id): ?Action
    {
        return $this->entityRepository->find($id);
    }
}