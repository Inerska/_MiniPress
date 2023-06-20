<?php

declare(strict_types=1);

namespace App\Application\Actions\Authentication;

use App\Domain\User\User;
use Psr\Http\Message\ResponseInterface as Response;

final class SignUpAuthenticationAction extends AuthenticationAction
{
    protected function action(): Response
    {
        if ($this->service->user()) {
            return $this
                ->response
                ->withHeader('Location', '/admin')
                ->withStatus(302);
        }

        return $this->respondWithView('auth/signup');
    }
}
