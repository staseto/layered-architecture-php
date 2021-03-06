<?php
namespace Presentation\Api\Action;

use Interop\Container\ContainerInterface;
use League\Tactician\CommandBus;

class SignUpActionFactory
{
    /**
     * @param  ContainerInterface $container
     * @return RegisterAction
     */
    public function __invoke(ContainerInterface $container)
    {
        $bus = $container->get(CommandBus::class);

        return new SignUpAction($bus);
    }
}
