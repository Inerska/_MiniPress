<?php

declare(strict_types=1);

namespace Minipress\Application\Actions\Authentication;

use App\Domain\User\User;
use Psr\Http\Message\ResponseInterface as Response;

final class SignUpAuthenticationAction extends AuthenticationAction
{
    protected function action(): Response
    {
        $request = $this->request->getParsedBody();

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = password_hash($request['password'], PASSWORD_DEFAULT);
        $user->save();

        $this->service->user()->set($user);

        return $this->response->withHeader('Location', '/admin');
    }
}
