<?php

declare(strict_types=1);

namespace App\Application\Actions\Authentication\Form;

use App\Application\Actions\Authentication\AuthenticationAction;
use App\Domain\User\User;
use Psr\Http\Message\ResponseInterface as Response;

final class SignUpAuthenticationSubmitAction extends AuthenticationAction
{
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();

        $user = User::where('email', $data['email'])->first();
        if (!is_null($user)) {
            return $this->response
                ->withHeader('Location', '/admin/auth/signup')
                ->withStatus(302);
        }

        $newUser = User::create([
            'nom' => $data['name'],
            'email' => $data['email'],
            'mot_de_passe' => password_hash($data['password'], PASSWORD_ARGON2ID)
        ]);

        $this->service->attempt($data['email'], $data['password']);

        return $this->response
            ->withHeader('Location', '/admin')
            ->withStatus(302);
    }
}