<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use Psr\Http\Message\ResponseInterface as Response;

final class CreateCategorieAction extends CategoryAction
{
    protected function action(): Response
    {
        return $this->respondWithView('categories/create');
    }
}