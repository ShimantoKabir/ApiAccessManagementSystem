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
    function findByEndpointAndMethod(string $endpoint, string $method) : ?Endpoint;

    /**
     * @param Endpoint $endpoint
     * @return Endpoint
     */
    function update(Endpoint $endpoint) : Endpoint;
}
