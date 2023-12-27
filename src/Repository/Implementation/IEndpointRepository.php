<?php

namespace App\Repository\Implementation;

use App\Entity\Endpoint;
use App\Repository\EndpointRepository;
use DateTime;
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
        $this->entityManager->persist($endpoint);;
        $this->entityManager->flush();

        return $endpoint;
    }

    /**
     * @param string $route
     * @param string $method
     * @return Endpoint|null
     */
    function findByRouteAndMethod(string $route, string $method): ?Endpoint
    {
        return $this->entityRepository->findOneBy([
            'route' => $route,
            'method' => $method,
        ]);
    }

    /**
     * @param Endpoint $endpoint
     * @param int $id
     * @return Endpoint|null
     */
    function update(Endpoint $endpoint, int $id): ?Endpoint
    {
        $existEndpoint = $this->entityRepository->find($id);

        if ($existEndpoint == null){
            return null;
        }

        $existEndpoint->setRoute($endpoint->getRoute());
        $existEndpoint->setMethod($endpoint->getMethod());
        $endpoint->setUpdatedAt(new DateTime());

        $this->entityManager->persist($existEndpoint);;
        $this->entityManager->flush();

        return $existEndpoint;
    }
}