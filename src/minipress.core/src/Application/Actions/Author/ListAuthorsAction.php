<?php

declare(strict_types=1);

namespace App\Application\Actions\Author;

use Psr\Http\Message\ResponseInterface as Response;

final class ListAuthorsAction extends AuthorAction
{
    protected function action(): Response
    {
        $authors = $this->repository->findAll();

        $this->logger->info("Authors list was viewed.");

        $authors = array_map(function ($article) {
            return [
                'id' => $article['id'],
                'nom' => $article['nom'],
                'email' => $article['email'],
            ];
        }, $authors);

        return $this
            ->respondWithData($authors);
    }
}