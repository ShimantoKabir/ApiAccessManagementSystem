<?php

namespace App\Repository;

use App\Entity\Action;
use App\Entity\Group;

/**
 *
 */
interface GroupRepository
{
    /**
     * @param int $id
     * @return Group|null
     */
    function fetchGroup(int $id): ?Group;

    /**
     * @param Group $group
     * @return Group|null
     */
    function saveGroup(Group $group): ?Group;

    /**
     * @param Group $group
     * @param int $id
     * @return Group|null
     */
    function updateGroup(Group $group, int $id): ?Group;

    /**
     * @param int $id
     * @return bool
     */
    function deleteGroup(int $id): bool;

    /**
     * @param Action $action
     * @return Action|null
     */
    function removeAction(Action $action): ?Action;

    /**
     * @param Action $action
     * @return Action|null
     */
    function addAction(Action $action): ?Action;
}