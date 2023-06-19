<?php

declare(strict_types=1);

namespace App\Application\Actions\Article;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\Article\ArticleRepository;
use Illuminate\View\Factory;
use Psr\Log\LoggerInterface;

abstract class ArticleAction extends Action
{
    protected ArticleRepository $repository;

    public function __construct(LoggerInterface $logger, Factory $view, ArticleRepository $articleRepository)
    {
        parent::__construct($logger, $view);
        $this->repository = $articleRepository;
    }
}