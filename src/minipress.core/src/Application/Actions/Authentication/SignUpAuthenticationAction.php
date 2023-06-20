<?php

declare(strict_types=1);

namespace Minipress\Infrastructure\Persistence\Service\Identity;

use Minipress\Application\Actions\Authentication\AuthenticationAction;
use Psr\Http\Message\ResponseInterface as Response;

final class SignUpAuthenticationAction extends AuthenticationAction
{
    protected function action(): Response
    {
    }
}