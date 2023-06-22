<?php

declare(strict_types=1);

namespace App\Application\Actions\Article;

use App\Domain\Category\Category;
use Psr\Http\Message\ResponseInterface as Response;

final class CreateArticleAction extends ArticleAction
{
    protected function action(): Response
    {
        return $this->respondWithView('articles/create', [
            'categories' => Category::all(),
        ]);
    }
}