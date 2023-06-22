<?php

declare(strict_types=1);

namespace App\Application\Actions\Author\Form;

use App\Application\Actions\Author\AuthorAction;
use App\Domain\User\User;
use App\Infrastructure\Persistence\Service\Identity\AuthenticationStateProviderService;
use Psr\Http\Message\ResponseInterface as Response;

final class CreateAuthorSubmitAction extends AuthorAction
{
    protected function action(): Response
    {
        $formData = $this->getFormData();

        if (empty($formData['username']) || empty($formData['password'])) {
            return $this->respondWithData(['error' => 'Invalid form data'], 400);
        }

        if (AuthenticationStateProviderService::getInstance()->isAdminAccount() === false) {
            return $this->respondWithData(['error' => 'Invalid form data, you must use an admin account'], 400);
        }

        $user = User::create([
            'nom' => $formData['username'],
            'password' => password_hash($formData['password'], PASSWORD_BCRYPT),
        ]);

        $this->logger->info('Author was created successfully: ' . $user->username);

        return $this->response
            ->withHeader('Location', '/auteurs')
            ->withStatus(302);
    }
}