<?php

declare(strict_types=1);

namespace App\Application\Actions\Category\Form;

use App\Application\Actions\Category\CategoryAction;
use Psr\Http\Message\ResponseInterface as Response;

final class CreateCategorySubmitAction extends CategoryAction
{
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();

        $this->repository->create($data);

        $this->logger->info('Category was created successfully: ' . $data['nom']);

        return $this->response
            ->withHeader('Location', '/admin/categories')
            ->withStatus(302);
    }
}