<?php

namespace App\Repository;

use App\Entity\Action;
use App\Entity\Group;

interface GroupRepository 
{
    function fetchGroup(int $id): ?Group;

    function saveGroup(Group $group): ?Group;

    function updateGroup(Group $group, int $id): ?Group;

    function deleteGroup(int $id): bool;

    function removeAction(Action $action): ?Action;

    function addAction(Action $action): ?Action;
}