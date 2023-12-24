<?php

namespace App\Command;

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

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($this->router->getRouteCollection()->all() as $route) {
            $output->writeln($route->getRequirements());
        }

        return Command::SUCCESS;
    }
}