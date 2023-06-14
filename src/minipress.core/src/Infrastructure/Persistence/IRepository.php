<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;

interface IRepository
{
    public function findAll(): array;

    public function findById(int $id): ?object;

    public function first(callable $callback = null): ?object;

    public function create(array $data): ?object;
}