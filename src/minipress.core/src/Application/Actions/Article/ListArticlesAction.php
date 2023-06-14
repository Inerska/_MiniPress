<?php

declare(strict_types=1);

namespace App\Application\Actions\Article;

use Psr\Http\Message\ResponseInterface as Response;

final class ListArticlesAction extends ArticleAction
{
    protected function action(): Response
    {
        $articles = $this->repository->orderBy('date_creation', 'desc');

        $articles = array_map(function ($article) {
            return [
                'title' => $article['titre'],
                'creation_date' => $article['date_creation']
            ];
        }, $articles);

        $this->logger->info("Articles list was viewed.");

        return $this->respondWithData($articles);
    }
}