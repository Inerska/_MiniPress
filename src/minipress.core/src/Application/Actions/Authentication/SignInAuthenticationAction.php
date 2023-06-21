<?php

declare(strict_types=1);

namespace App\Application\Actions\Authentication;

use Psr\Http\Message\ResponseInterface as Response;

final class SignInAuthenticationAction extends AuthenticationAction
{
    protected function action(): Response
    {
        if ($this->service->check()) {
            return $this->response
                ->withHeader('Location', '/admin')
                ->withStatus(302);
        }

        return $this->respondWithView('auth/signin');
    }
}