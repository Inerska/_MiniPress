<?php

declare(strict_types=1);

namespace App\Application\Actions\Author;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\Author\AuthorRepository;
use Illuminate\View\Factory;
use Psr\Log\LoggerInterface;

abstract class AuthorAction extends Action
{
    protected AuthorRepository $repository;

    public function __construct(LoggerInterface $logger, Factory $view, AuthorRepository $authorRepository)
    {
        parent::__construct($logger, $view);
        $this->repository = $authorRepository;
    }
}