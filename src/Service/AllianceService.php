<?php

namespace App\Service;

use App\Entity\Alliance;
use App\Repository\AllianceRepository;
use Exception;

/**
 *
 */
class AllianceService
{
    /**
     * @var AllianceRepository
     */
    private AllianceRepository $allianceRepository;

    /**
     * @param AllianceRepository $allianceRepository
     */
    public function __construct(AllianceRepository $allianceRepository)
    {
        $this->allianceRepository = $allianceRepository;
    }

    /**
     * @throws Exception
     */
    public function saveAlliance(Alliance $alliance) : Alliance
    {
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
}