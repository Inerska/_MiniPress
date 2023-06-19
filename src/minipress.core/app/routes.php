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
    define('ADMIN_PREFIX', '/admin');

    /**
     * API
     */

    // Retrieve all articles
    $app->get(API_PREFIX . '/articles', ListArticlesAction::class);

    // Retrieve article with id
    $app->get(API_PREFIX . '/articles/{id}', GetArticleAction::class);

    // Retrieve all categories
    $app->get(API_PREFIX . '/categories', ListCategoriesAction::class);

    // Retrieve all articles for a category
    $app->get(API_PREFIX . '/categories/{id}/articles', ListCategoryArticlesAction::class);

    // Retrieve all articles for an author
    $app->get(API_PREFIX . '/auteurs/{id}/articles', ListAuthorArticlesAction::class);

    /**
     * Admin
     */

    // routes.php
    $app->get('/hello/{name}', function ($request, $response, $args) {
        $name = $args['name'];

        $view = $this->get('view')->make('hello', ['name' => $name])->render();

        $response->getBody()->write($view);

        return $response;
    });


};
