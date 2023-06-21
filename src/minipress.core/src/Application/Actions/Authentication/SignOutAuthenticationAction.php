<?php

declare(strict_types=1);

namespace App\Application\Actions\Authentication;

use App\Application\Actions\Authentication\AuthenticationAction;
use Psr\Http\Message\ResponseInterface as Response;

final class SignOutAuthenticationAction extends AuthenticationAction
{
    protected function action(): Response
    {
        $this->service->logout();

        $this->response->getBody()->write('Logout successful');

        sleep(1);

        return $this->response
            ->withHeader('Location', '/admin')
            ->withStatus(302);
    }
}
