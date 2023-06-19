<?php

declare(strict_types=1);

use App\Application\Actions\Article\GetArticleAction;
use App\Application\Actions\Article\ListArticlesAction;
use App\Application\Actions\Article\ListAuthorArticlesAction;
use App\Application\Actions\Category\ListCategoriesAction;
use App\Application\Actions\Category\ListCategoryArticlesAction;
use Slim\App;

return function (App $app) {

    define('API_PREFIX', '/api/v1');

    /**
     * Display all articles as JSON.
     */
    $app->get(API_PREFIX . '/articles', ListArticlesAction::class);

    $app->get(API_PREFIX . '/articles/{id}', GetArticleAction::class);

    $app->get(API_PREFIX . '/categories', ListCategoriesAction::class);

    $app->get(API_PREFIX . '/categories/{id}/articles', ListCategoryArticlesAction::class);

    $app->get(API_PREFIX . '/auteurs/{id}/articles', ListAuthorArticlesAction::class);
};
