<?php

declare(strict_types=1);

namespace App\Application\Actions\Author;

use Psr\Http\Message\ResponseInterface as Response;

final class DisplayAuthorsAction extends AuthorAction
{
    protected function action(): Response
    {
        $authors = $this->repository->findAll();

        $this->logger->info("Authors list was viewed.");

        return $this
            ->respondWithView('authors/view', [
                'authors' => $authors
            ]);
    }
}