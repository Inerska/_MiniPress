<?php

declare(strict_types=1);

namespace App\Application\Actions\Author;

use Psr\Http\Message\ResponseInterface as Response;

final class CreateAuthorAction extends AuthorAction
{
    protected function action(): Response
    {
        return $this->respondWithView('authors/create');
    }
}