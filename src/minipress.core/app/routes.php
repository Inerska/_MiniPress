<?php

declare(strict_types=1);

use App\Application\Actions\Article\ListArticlesAction;
use App\Application\Actions\Category\ListCategoriesAction;
use Slim\App;

return function (App $app) {

    define("API_PREFIX", '/api/v1');

    /**
     * Display all articles as JSON.
     */
    $app->get(API_PREFIX . '/articles', ListArticlesAction::class);

    $app->get(API_PREFIX . '/categories', ListCategoriesAction::class);
};
