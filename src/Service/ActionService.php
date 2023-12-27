<?php

namespace App\Service;

use App\Entity\Action;
use App\Repository\ActionRepository;
use Psr\Log\LoggerInterface;

/**
 *
 */
class ActionService
{
    /**
     * @var ActionRepository
     */
    private ActionRepository $actionRepository;
    private LoggerInterface $logger;

    public function __construct(ActionRepository $actionRepository, LoggerInterface $logger)
    {
        $this->actionRepository = $actionRepository;
        $this->logger = $logger;
    }

    /**
     * @param array<Action> $actions
     * @return void
     */
    public function saveOrUpdateAction(array $actions): void
    {
        foreach ($actions as $action){
            $existAction = $this->actionRepository->findByRouteAndMethod(
                $action->getRoute(),
                $action->getMethod()
            );

            if ($existAction == null){
                $this->actionRepository->save($action);
                $this->logger->debug("No action found!");
            }else{
                $this->actionRepository->update($existAction, $existAction->getId());
                $this->logger->debug("Action found!");
            }
        }
    }

}