<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use Psr\Http\Message\ResponseInterface as Response;

final class ListCategoryArticlesAction extends CategoryAction
{
    protected function action(): Response
    {
        $categoryId = (int)$this->resolveArg('id');
        $articles = $this->repository->findArticlesByCategoryId($categoryId);

        $articles = array_map(function ($article) {
            return [
                'title' => $article['titre'],
                'creation_date' => $article['date_creation'],
                'url' => 'TODO'
            ];
        }, $articles);

        $this->logger->info("Articles from category of id `{$categoryId}` were viewed.");

        return $this->respondWithData($articles);
    }
}