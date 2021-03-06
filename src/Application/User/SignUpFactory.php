<?php
namespace Application\User;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception;
use Monolog\Logger;

use Infrastructure\Repository\Mock\UserRepository;

/**
 * Class SignUpFactory
 *
 * @author Vasil Dakov <vasildakov@gmail.com>
 */
class SignUpFactory
{
    /**
     * @param ContainerInterface $container
     * @return CreateUser
     */
    public function __invoke(ContainerInterface $container)
    {
        $users     = $container->get(UserRepository::class);
        $logger    = $container->get(Logger::class);

        return new SignUp($users, $logger);
    }
}
