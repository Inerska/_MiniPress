<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Author;

use App\Domain\Article\Article;
use App\Domain\User\User;
use App\Infrastructure\Persistence\Article\Collection;
use App\Infrastructure\Persistence\Article\Model;
use App\Infrastructure\Persistence\IRepository;

final class AuthorRepository implements IRepository
{
    public function findAll(): array
    {
        return User::all()->toArray();
    }

    public function findById(int $id): ?object
    {
        return User::find($id);
    }

    public function findWhere(string $column, $value): array
    {
        return User::where($column, $value)->get()->toArray();
    }

    public function first(callable $callback = null): ?object
    {
        return User::first($callback);
    }

    public function create(array $data): ?object
    {
        return User::create($data);
    }

    public function orderBy(string $column, string $direction = 'asc'): array
    {
        return User::orderBy($column, $direction)->get()->toArray();
    }
}