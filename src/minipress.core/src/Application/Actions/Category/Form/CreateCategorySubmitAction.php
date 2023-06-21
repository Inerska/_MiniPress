<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use Psr\Http\Message\ResponseInterface as Response;

final class CreateCategorySubmitAction extends CategoryAction
{
    protected function action(): Response
    {
        $data = $this->request->getParsedBody();

        $this->repository->create($data);

        return $this
            ->response
            ->withHeader('Location', '/admin/categories');
    }
}