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
class EndpointCommand extends Command
{
    private  RouterInterface $router;
    private EndpointService $endpointService;

    public function __construct(RouterInterface $router, EndpointService $endpointService)
    {
        $this->router = $router;
        $this->endpointService = $endpointService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $endpoints = [];

        foreach ($this->router->getRouteCollection()->all() as $route) {
            if (str_starts_with($route->getPath(), "/api") && count($route->getMethods()) > 0){
                $ep = new Endpoint();

                $ep->setMethod(json_encode($route->getMethods()));
                $ep->setRoute($route->getPath());

                $endpoints[] = $ep;
            }
        }

        // $output->writeln(json_encode($this->endpoints));

        $this->endpointService->saveOrUpdateEndpoint($endpoints);

        return Command::SUCCESS;
    }
}