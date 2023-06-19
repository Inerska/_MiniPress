<?php

declare(strict_types=1);

namespace App\Application\Actions\Article;

use Psr\Http\Message\ResponseInterface as Response;

final class ListAuthorArticlesAction extends ArticleAction
{
    protected function action(): Response
    {
        $authorId = (int)$this->resolveArg('id');
        $articles = $this->repository->findWhere('auteur_id', $authorId);

        return $this->respondWithData($articles);
    }
}