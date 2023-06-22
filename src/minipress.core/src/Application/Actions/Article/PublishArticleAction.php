<?php

declare(strict_types=1);

namespace App\Application\Actions\Article;

use Psr\Http\Message\ResponseInterface as Response;

final class PublishArticleAction extends ArticleAction
{
    protected function action(): Response
    {
        $articleId = (int) $this->resolveArg('id');
        $this->repository->publish($articleId);

        $this->logger->info("Article id `{$articleId}` was published.");

        return $this->respondWithData([]);
    }
}