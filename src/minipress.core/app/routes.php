<?php

declare(strict_types=1);

use App\Application\Actions\Article\CreateArticleAction;
use App\Application\Actions\Article\DisplayArticlesAction;
use App\Application\Actions\Article\Form\CreateArticleSubmitAction;
use App\Application\Actions\Article\GetArticleAction;
use App\Application\Actions\Article\ListArticlesAction;
use App\Application\Actions\Article\ListAuthorArticlesAction;
use App\Application\Actions\Auth\SigninAction;
use App\Application\Actions\Auth\SigninSubmitAction;
use App\Application\Actions\Auth\SignoutAction;
use App\Application\Actions\Auth\SignupAction;
use App\Application\Actions\Auth\SignupSubmitAction;
use App\Application\Actions\Category\ListCategoriesAction;
use App\Application\Actions\Category\ListCategoryArticlesAction;
use App\Application\Actions\IndexAdminAction;
use Minipress\Infrastructure\Persistence\Service\Identity\SignUpAuthenticationAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    define('API_PREFIX', '/api/v1');
    define('ADMIN_PREFIX', '/admin');
    define('ADMIN_AUTH_PREFIX', '/auth');

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

        // Authentication
        $routeCollectorProxy->group('/auth', function (RouteCollectorProxy $authenticationRouteCollectorProxy) {
            // Signin
            $authenticationRouteCollectorProxy->get('/signin', SigninAction::class);

            // Handle the form submission
            $authenticationRouteCollectorProxy->post('/signin', SigninSubmitAction::class);

            // Signout
            $authenticationRouteCollectorProxy->get('/signout', SignoutAction::class);

            // Signup
            $authenticationRouteCollectorProxy->get('/signup', SignUpAuthenticationAction::class);

            // Handle the form submission
            $authenticationRouteCollectorProxy->post('/signup', SignupSubmitAction::class);
        });
    });


};
