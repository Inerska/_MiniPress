<?php

declare(strict_types=1);

namespace App\Application\Actions\Article;

use Psr\Http\Message\ResponseInterface as Response;

final class ListArticlesAction extends ArticleAction
{
    protected function action(): Response
    {
        $params = $this->request->getQueryParams();
        $articles = [];

        if (isset($params['sort'])) {
            $articles = match ($params['sort']) {
                'date-asc' => $this->repository->orderBy('date_creation', 'ASC'),
                'date-desc' => $this->repository->orderBy('date_creation', 'DESC'),
                'auteur' => $this->repository->orderBy('auteur_id', 'ASC'),
                default => $this->repository->findAll(),
            };
        } else {
            $articles = $this->repository->findAll();
        }

        $articles = array_map(function ($article) {
            return [
                'title' => $article['titre'],
                'creation_date' => $article['date_creation'],
                'auteur_id' => $article['auteur_id'],
                'url' => "/articles/{$article['id']}",
            ];
        }, $articles);

        $this->logger->info('Articles list was viewed.');

        return $this->respondWithData($articles);
    }
}
