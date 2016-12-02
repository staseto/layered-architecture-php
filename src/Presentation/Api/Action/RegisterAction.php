<?php
namespace Presentation\Api\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use League\Tactician\CommandBus;
use Zend\Stratigility\MiddlewareInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Json\Json;

use Application\User\CreateUserRequest;

class RegisterAction implements MiddlewareInterface
{
    /**
     * @var \League\Tactician\CommandBus
     */
    private $bus;

    /**
     * @param \League\Tactician\CommandBus $bus
     */
    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @param  Request       $request
     * @param  Response      $response
     * @param  callable|null $next
     * @return mixed Response|callable
     */
    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        $body    = $request->getBody();
        $content = Json::decode($body->getContents(), Json::TYPE_OBJECT);

        $command = new CreateUserRequest($content->email, $content->password);

        $this->bus->handle($command);

        return new JsonResponse([], 200);
    }
}