<?php

declare(strict_types=1);

namespace App\Application\Middleware;

use App\Infrastructure\Persistence\Service\Identity\AuthenticationStateProviderService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

class AuthenticationMiddleware implements Middleware
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $service = AuthenticationStateProviderService::getInstance();

        if (!$service->check()) {
            $response = new Response();
            
            return $response
                ->withHeader('Location', '/admin/auth/signin')
                ->withStatus(302);
        }

        return $handler->handle($request);
    }
}
