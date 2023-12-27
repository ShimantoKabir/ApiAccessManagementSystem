<?php

namespace App\Repository\Implementation;

use App\Entity\Endpoint;
use App\Entity\User;
use App\Repository\EndpointRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 *
 */
class IEndpointRepository implements EndpointRepository
{

    private EntityManagerInterface $entityManager;
    private EntityRepository $entityRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entityRepository = $this->entityManager->getRepository(Endpoint::class);
    }

    /**
     * @param Endpoint $endpoint
     * @return Endpoint
     */
    function save(Endpoint $endpoint): Endpoint
    {
        $this->save($endpoint);
    }

    /**
     * @param string $endpoint
     * @param string $method
     * @return Endpoint|null
     */
    function findByEndpointAndMethod(string $endpoint, string $method): ?Endpoint
    {
        // TODO: Implement findByEndpointAndMethod() method.
    }

    /**
     * @param Endpoint $endpoint
     * @return Endpoint
     */
    function update(Endpoint $endpoint): Endpoint
    {
        // TODO: Implement update() method.
    }
}