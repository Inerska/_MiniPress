<?php

declare(strict_types=1);

namespace App\Application\Actions\Article;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\Article\ArticleRepository;
use Psr\Log\LoggerInterface;

abstract class ArticleAction extends Action
{
    protected ArticleRepository $repository;

    public function __construct(LoggerInterface $logger, ArticleRepository $articleRepository)
    {
        parent::__construct($logger);
        $this->repository = $articleRepository;
    }
}