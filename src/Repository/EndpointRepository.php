<?php

namespace App\Repository;

use App\Entity\Endpoint;

/**
 *
 */
interface EndpointRepository
{
    /**
     * @param Endpoint $endpoint
     * @return Endpoint
     */
    function save(Endpoint $endpoint) : Endpoint;

    /**
     * @param string $endpoint
     * @param string $method
     * @return Endpoint|null
     */
    function findByRouteAndMethod(string $endpoint, string $method) : ?Endpoint;

    /**
     * @param Endpoint $endpoint
     * @param int $id
     * @return Endpoint|null
     */
    function update(Endpoint $endpoint, int $id) : ?Endpoint;
}
