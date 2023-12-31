<?php

namespace App\Repository;

use App\Entity\Action;

/**
 *
 */
interface ActionRepository
{
    /**
     * @param Action $action
     * @return Action
     */
    function save(Action $action) : Action;

    /**
     * @param string $route
     * @param string $method
     * @return Action|null
     */
    function findByRouteAndMethod(string $route, string $method) : ?Action;

    /**
     * @param Action $action
     * @param int $id
     * @return Action|null
     */
    function update(Action $action, int $id) : ?Action;

    /**
     * @param int $id
     * @return Action|null
     */
    function findById(int $id): ?Action;
}
