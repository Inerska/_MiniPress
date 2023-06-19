<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\Category\CategoryRepository;
use Illuminate\View\Factory;
use Psr\Log\LoggerInterface;

abstract class CategoryAction extends Action
{
    protected CategoryRepository $repository;

    public function __construct(LoggerInterface $logger, Factory $view, CategoryRepository $repository)
    {
        parent::__construct($logger, $view);
        $this->repository = $repository;
    }
}