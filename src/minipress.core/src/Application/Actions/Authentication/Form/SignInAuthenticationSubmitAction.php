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
        $password = filter_var($data['password'], FILTER_SANITIZE_STRING);

        $result = $this->service->attempt($email, $password);

        if (!$result) {
            $this->response = $this->response->withStatus(401);
            $this->response->getBody()->write('Invalid credentials');
        } else {
            $this->response->getBody()->write('Login successful');
        }

        return $this->response;
    }
}