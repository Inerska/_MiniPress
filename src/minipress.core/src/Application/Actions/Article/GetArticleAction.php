<?php

declare(strict_types=1);

namespace App\Application\Actions\Article;

use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

final class GetArticleAction extends ArticleAction
{
    /**
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $articleId = (int)$this->resolveArg('id');
        $article = $this->repository->findById($articleId);

        $this->logger->info("Article of id `{$articleId}` was viewed.");

        return $this->respondWithData($article);
    }
}