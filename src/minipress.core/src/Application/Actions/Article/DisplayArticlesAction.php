<?php

declare(strict_types=1);

namespace App\Application\Actions\Article;

use App\Domain\Category\Category;
use Psr\Http\Message\ResponseInterface as Response;

final class DisplayArticlesAction extends ArticleAction
{
    protected function action(): Response
    {
        return $this->respondWithView('articles/view', [
            "categories" => Category::all(),
        ]);
    }
}