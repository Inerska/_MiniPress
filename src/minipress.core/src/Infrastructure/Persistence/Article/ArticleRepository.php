<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Article;

use App\Domain\Article\Article;
use App\Infrastructure\Persistence\IRepository;

final class ArticleRepository implements IRepository
{
    /**
     * @return Collection|array
     */
    public function findAll(): array
    {
        return Article::all()
            ->toArray();
    }

    /**
     * @param int $id
     * @return Model|object|null
     */
    public function findById(int $id): ?object
    {
        return Article::find($id);
    }

    /**
     * @param callable|null $callback
     * @return Model|object|null
     */
    public function first(callable $callback = null): ?object
    {
        return $callback
            ? Article::where($callback)->first()
            : Article::first();
    }

    /**
     * @param array $data
     * @return Model|object $article
     */
    public function create(array $data): object
    {
        return Article::create($data);
    }
}