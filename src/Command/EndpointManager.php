<?php

namespace App\Command;

use App\Entity\Endpoint;
use App\Service\EndpointService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\RouterInterface;

#[AsCommand(
    name: 'app:create-or-update-endpoint',
    description: 'Creates or update endpoint',
    aliases: ['app:endpoint'],
    hidden: false
)]
class EndpointManager extends Command
{
    private  RouterInterface $router;
    private EndpointService $endpointService;

    /**
     * @var array<Endpoint>
     */
    private array $endpoints = [];

    public function __construct(RouterInterface $router, EndpointService $endpointService)
    {
        $this->router = $router;
        $this->endpointService = $endpointService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->endpoints = [];

        foreach ($this->router->getRouteCollection()->all() as $route) {

            if (str_starts_with($route->getPath(), "/api")){
//                $ep = new Endpoint();
//
//                $ep->method = "";
//                $ep->route = $route->getPath();
//                $ep->setDatetime();
//
//                $this->endpoints[] = $ep;
            }

        }

        $this->endpointService->saveOrUpdateEndpoint($this->endpoints);

        return Command::SUCCESS;
    }
}