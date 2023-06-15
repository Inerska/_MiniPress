<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use Psr\Http\Message\ResponseInterface;

final class ListCategoriesAction extends CategoryAction
{
    protected function action(): ResponseInterface
    {
        $categories = $this->repository->findAll();

        $this->logger->info('Categories list was viewed.');

        return $this->respondWithData($categories);
    }
}