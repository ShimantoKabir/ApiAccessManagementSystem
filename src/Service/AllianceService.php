<?php

namespace App\Service;

use App\ApiResource\AllianceActionDto;
use App\Entity\Alliance;
use App\Repository\ActionRepository;
use App\Repository\AllianceRepository;
use Exception;
use Symfony\Component\Config\Definition\Exception\InvalidTypeException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 *
 */
class AllianceService
{
    /**
     * @var AllianceRepository
     */
    private AllianceRepository $allianceRepository;
    private ActionRepository $actionRepository;
    private bool $isActionRemoved = false;
    private bool $isActionAdded = false;

    /**
     * @param AllianceRepository $allianceRepository
     * @param ActionRepository $actionRepository
     */
    public function __construct(AllianceRepository $allianceRepository, ActionRepository $actionRepository)
    {
        $this->allianceRepository = $allianceRepository;
        $this->actionRepository = $actionRepository;
    }

    /**
     * @throws Exception
     */
    public function saveAlliance(Alliance $alliance) : Alliance
    {
        foreach ($alliance->getActionIds() as $id){
            $alliance->addAction($this->actionRepository->findById($id));
        }

        $existAlliance = $this->allianceRepository->saveAlliance($alliance);

        if ($existAlliance == null){
            throw new Exception("Can't save the group!");
        }

        return $existAlliance;
    }

    public function fetchAllianceById(int $id) : Alliance
    {
        return $this->allianceRepository->findById($id);
    }

    public function removeActions(AllianceActionDto $allianceActionDto) : bool
    {
        $alliance = $this->allianceRepository->findById($allianceActionDto->id);

        if ($alliance == null){
            throw new NotFoundHttpException("No alliance found with this id ". $allianceActionDto->id);
        }

        foreach ($allianceActionDto->actionIds as $id){
            if (gettype($id) != "integer"){
                throw new InvalidTypeException("Action id should be integer");
            }

            $action = $this->actionRepository->findById($id);

            if ($action != null){
                $alliance->removeAction($action);
                $this->allianceRepository->saveAlliance($alliance);
                $this->isActionRemoved = true;
            }
        }

        return $this->isActionRemoved;
    }

    public function addActions(AllianceActionDto $allianceActionDto) : bool
    {
        $alliance = $this->allianceRepository->findById($allianceActionDto->id);

        if ($alliance == null){
            throw new NotFoundHttpException("No alliance found with this id ". $allianceActionDto->id);
        }

        foreach ($allianceActionDto->actionIds as $id){
            if (gettype($id) != "integer"){
                throw new InvalidTypeException("Action id should be integer");
            }

            $action = $this->actionRepository->findById($id);

            if ($action != null){
                $alliance->addAction($action);
                $this->isActionAdded = true;
            }

            $this->allianceRepository->saveAlliance($alliance);
        }

        return $this->isActionAdded;
    }

    public function removeAllianceById(int $id) : bool
    {
        $alliance = $this->allianceRepository->findById($id);

        if ($alliance == null){
            throw new NotFoundHttpException("No alliance found with this id ". $id);
        }

        

    }
}