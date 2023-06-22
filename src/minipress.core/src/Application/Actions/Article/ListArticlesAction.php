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

        if (isset($params['display'])) {
            $articles = match ($params['display']) {
                'all' => $this->repository->findAll(),
                default => $this->repository->where('published', false)->get(),
            };

            $articles = array_map(function ($article) {
                return [
                    'titre' => $article['titre'],
                    'date_creation' => $article['date_creation'],
                    'auteur_id' => $article['auteur_id'],
                    'url' => "/articles/{$article['id']}",
                    'published' => $article['published'],
                ];
            }, $articles);

            $this->logger->info('Articles list was viewed.');

            return $this->respondWithData($articles);
        }

        if (isset($params['sort'])) {
            $articles = match ($params['sort']) {
                'date-asc' => $this->repository->orderBy('date_creation', 'ASC'),
                'date-desc' => $this->repository->orderBy('date_creation', 'DESC'),
                'auteur' => $this->repository->orderBy('auteur_id', 'ASC'),
                default => $this->repository->findWhere('published', true),
            };
        } else {
            $articles = $this->repository->findWhere('published', true);
        }

        $articles = array_map(function ($article) {
            if ($article['published']) {
                return [
                    'titre' => $article['titre'],
                    'date_creation' => $article['date_creation'],
                    'auteur_id' => $article['auteur_id'],
                    'url' => "/articles/{$article['id']}",
                ];
            }
        }, $articles);

        $articles = array_filter($articles); // Remove any null values



        $this->logger->info('Articles list was viewed.');

        return $this->respondWithData($articles);
    }
}
