<?php

declare(strict_types=1);

namespace App\Application\Actions\Article;

use Psr\Http\Message\ResponseInterface as Response;

final class UnpublishArticleAction extends ArticleAction
{
    protected function action(): Response
    {
        $articleId = (int) $this->resolveArg('id');
        $this->repository->unpublish($articleId);

        $this->logger->info("Article id `{$articleId}` was unpublished.");

        return $this->respondWithData([]);
    }
}