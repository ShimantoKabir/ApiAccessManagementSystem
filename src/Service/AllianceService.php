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
        $group = $this->allianceRepository->saveAlliance($alliance);

        if ($group == null){
            throw new Exception("Can't save the group!");
        }

        return $group;
    }
}