<?php

namespace App\Service;

use App\Entity\Endpoint;
use App\Repository\EndpointRepository;
use Psr\Log\LoggerInterface;

/**
 *
 */
class EndpointService
{

    /**
     * @var EndpointRepository
     */
    private EndpointRepository $endpointRepository;
    private LoggerInterface $logger;

    public function __construct(EndpointRepository $endpointRepository, LoggerInterface $logger)
    {
        $this->endpointRepository = $endpointRepository;
        $this->logger = $logger;
    }

    /**
     * @param array<Endpoint> $endpoints
     * @return void
     */
    public function saveOrUpdateEndpoint(array $endpoints): void
    {
        foreach ($endpoints as $endpoint){
            $existEndpoint = $this->endpointRepository->findByRouteAndMethod(
                $endpoint->getRoute(),
                $endpoint->getMethod()
            );

            if ($existEndpoint == null){
                $this->endpointRepository->save($endpoint);
            }else{
                $this->endpointRepository->update($existEndpoint, $existEndpoint->getId());
            }
        }
    }

}