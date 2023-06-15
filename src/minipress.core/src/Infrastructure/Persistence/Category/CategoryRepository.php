<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Category;

use App\Domain\Category\Category;
use App\Infrastructure\Persistence\IRepository;

final class CategoryRepository implements IRepository
{
    public function findAll(): array
    {
        return Category::all()
            ->toArray();
    }

    public function findById(int $id): ?object
    {
        return Category::find($id);
    }

    public function first(callable $callback = null): ?object
    {
        return Category::first($callback);
    }

    public function create(array $data): ?object
    {
        return Category::create($data);
    }

    public function orderBy(string $column, string $direction = 'asc'): array
    {
        return Category::orderBy($column, $direction)
            ->get()
            ->toArray();
    }

    public function findWhere(string $column, $value): array
    {
        return Category::where($column, $value)
            ->get()
            ->toArray();
    }

    public function findArticlesByCategoryId(int $id): array
    {
        return Category::find($id)
            ->articles()
            ->get()
            ->toArray();
    }
}