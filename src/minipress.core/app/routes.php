<?php

declare(strict_types=1);

use App\Application\Actions\Article\CreateArticleAction;
use App\Application\Actions\Article\DisplayArticlesAction;
use App\Application\Actions\Article\Form\CreateArticleSubmitAction;
use App\Application\Actions\Article\GetArticleAction;
use App\Application\Actions\Article\ListArticlesAction;
use App\Application\Actions\Article\ListAuthorArticlesAction;
use App\Application\Actions\Category\ListCategoriesAction;
use App\Application\Actions\Category\ListCategoryArticlesAction;
use App\Application\Actions\IndexAdminAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

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
    $app->group(ADMIN_PREFIX, function (RouteCollectorProxy $routeCollectorProxy) {
        // Index
        $routeCollectorProxy->get('[/]', IndexAdminAction::class);

        // Creation of an article
        $routeCollectorProxy->get('/articles/create', CreateArticleAction::class);

        // Handle the form submission
        $routeCollectorProxy->post('/articles/create', CreateArticleSubmitAction::class);

        // Display all articles
        $routeCollectorProxy->get('/articles', DisplayArticlesAction::class);

    });


};
