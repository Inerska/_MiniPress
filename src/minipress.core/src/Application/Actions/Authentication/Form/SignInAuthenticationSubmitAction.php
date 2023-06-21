<?php

declare(strict_types=1);

namespace App\Application\Actions\Authentication\Form;

use App\Application\Actions\Authentication\AuthenticationAction;
use Psr\Http\Message\ResponseInterface as Response;

final class SignInAuthenticationSubmitAction extends AuthenticationAction
{
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();

        $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        $password = $data['password'];

        $result = $this->service->attempt($email, $password);

        if (!$result) {
            return $this->response->withHeader('Location', '/admin/auth/signin')->withStatus(302);
        } else {
            return $this->response->withHeader('Location', '/admin')->withStatus(302);
        }

        return $this->response;
    }
}