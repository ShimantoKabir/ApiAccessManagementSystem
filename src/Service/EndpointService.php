<?php

namespace App\Service;

use App\Entity\Endpoint;
use App\Repository\EndpointRepository;

/**
 *
 */
class EndpointService
{

    /**
     * @var EndpointRepository
     */
    private EndpointRepository $endpointRepository;

    public function __construct(EndpointRepository $endpointRepository)
    {
        $this->endpointRepository = $endpointRepository;
    }

    /**
     * @param array<Endpoint> $endpoints
     * @return void
     */
    public function saveOrUpdateEndpoint(array $endpoints): void
    {
        foreach ($endpoints as $endpoint){
            $endpoint = $this->endpointRepository->findByRouteAndMethod(
                $endpoint->route,
                $endpoint->method
            );

            if ($endpoint == null){
                $this->endpointRepository->save($endpoint);
            }else{
                $this->endpointRepository->update($endpoint, $endpoint->id);
            }
        }
    }

}