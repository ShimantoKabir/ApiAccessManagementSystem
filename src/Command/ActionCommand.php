<?php

namespace App\Command;

use App\Entity\Action;
use App\Service\ActionService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\RouterInterface;

#[AsCommand(
    name: 'app:manage-action',
    description: 'Creates or update action',
    aliases: ['app:action'],
    hidden: false
)]
class ActionCommand extends Command
{
    private  RouterInterface $router;
    private ActionService $actionService;

    public function __construct(RouterInterface $router, ActionService $actionService)
    {
        $this->router = $router;
        $this->actionService = $actionService;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $actions = [];

        foreach ($this->router->getRouteCollection()->all() as $route) {
            if (str_starts_with($route->getPath(), "/api") && count($route->getMethods()) > 0){
                $action = new Action();

                $action->setMethod(substr(json_encode($route->getMethods()), 2, -2));
                $action->setRoute($route->getPath());

                $actions[] = $action;
            }
        }

        // $output->writeln(json_encode($this->actions));

        $this->actionService->saveOrUpdateAction($actions);

        return Command::SUCCESS;
    }
}