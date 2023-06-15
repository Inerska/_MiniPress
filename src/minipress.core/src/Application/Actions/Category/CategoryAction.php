<?php

declare(strict_types=1);

namespace App\Application\Actions\Category;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\Category\CategoryRepository;
use Psr\Log\LoggerInterface;

abstract class CategoryAction extends Action
{
    protected CategoryRepository $repository;

    public function __construct(LoggerInterface $logger, CategoryRepository $repository)
    {
        parent::__construct($logger);
        $this->repository = $repository;
    }
}