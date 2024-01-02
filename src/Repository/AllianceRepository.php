<?php

namespace App\Repository;

use App\Entity\Action;
use App\Entity\Alliance;

/**
 *
 */
interface AllianceRepository
{
    /**
     * @param int $id
     * @return Alliance|null
     */
    function findById(int $id): ?Alliance;

    /**
     * @param Alliance $alliance
     * @return Alliance|null
     */
    function saveAlliance(Alliance $alliance): ?Alliance;

    /**
     * @param Alliance $alliance
     * @param int $id
     * @return Alliance|null
     */
    function updateAlliance(Alliance $alliance, int $id): ?Alliance;

    /**
     * @param int $id
     * @return bool
     */
    function deleteAlliance(int $id): bool;

    /**
     * @param Action $action
     * @return Action|null
     */
    function addAction(Action $action): ?Action;
}