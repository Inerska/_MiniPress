<?php

declare(strict_types=1);

use App\Application\Actions\Article\CreateArticleAction;
use App\Application\Actions\Article\DisplayArticlesAction;
use App\Application\Actions\Article\Form\CreateArticleSubmitAction;
use App\Application\Actions\Article\GetArticleAction;
use App\Application\Actions\Article\ListArticlesAction;
use App\Application\Actions\Article\ListAuthorArticlesAction;
use App\Application\Actions\Authentication\Form\SignInAuthenticationSubmitAction;
use App\Application\Actions\Authentication\Form\SignUpAuthenticationSubmitAction;
use App\Application\Actions\Authentication\SignInAuthenticationAction;
use App\Application\Actions\Authentication\SignOutAuthenticationAction;
use App\Application\Actions\Authentication\SignUpAuthenticationAction;
use App\Application\Actions\Author\CreateAuthorAction;
use App\Application\Actions\Author\DisplayAuthorsAction;
use App\Application\Actions\Author\Form\CreateAuthorSubmitAction;
use App\Application\Actions\Author\ListAuthorsAction;
use App\Application\Actions\Category\CreateCategorieAction;
use App\Application\Actions\Category\DisplayCategoriesAction;
use App\Application\Actions\Category\Form\CreateCategorySubmitAction;
use App\Application\Actions\Category\ListCategoriesAction;
use App\Application\Actions\Category\ListCategoryArticlesAction;
use App\Application\Actions\IndexAdminAction;
use App\Application\Middleware\AuthenticationMiddleware;
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
    $app->get(API_PREFIX . '/articles[/]', ListArticlesAction::class);

    // Retrieve article with id
    $app->get(API_PREFIX . '/articles/{id}[/]', GetArticleAction::class);

    // Retrieve all categories
    $app->get(API_PREFIX . '/categories[/]', ListCategoriesAction::class);

    // Retrieve all articles for a category
    $app->get(API_PREFIX . '/categories/{id}/articles[/]', ListCategoryArticlesAction::class);

    // Retrieve all articles for an author
    $app->get(API_PREFIX . '/auteurs/{id}/articles[/]', ListAuthorArticlesAction::class);

    // Retrieve all authors
    $app->get(API_PREFIX . '/auteurs[/]', ListAuthorsAction::class);

    /**
     * Admin
     */
    $app->group(ADMIN_PREFIX, function (RouteCollectorProxy $routeCollectorProxy) {
        // Index
        $routeCollectorProxy->get('[/]', IndexAdminAction::class);

        // Creation of an article
        $routeCollectorProxy->get('/articles/create[/]', CreateArticleAction::class)
            ->addMiddleware(new AuthenticationMiddleware());

        // Handle the form submission
        $routeCollectorProxy->post('/articles/create[/]', CreateArticleSubmitAction::class);

        // Display all articles
        $routeCollectorProxy->get('/articles[/]', DisplayArticlesAction::class);

        // Display all categories
        $routeCollectorProxy->get('/categories[/]', DisplayCategoriesAction::class);

        // Create a category
        $routeCollectorProxy->get('/categories/create[/]', CreateCategorieAction::class);

        // handle the form submission
        $routeCollectorProxy->post('/categories/create[/]', CreateCategorySubmitAction::class);

        // Display all authors
        $routeCollectorProxy->get('/auteurs[/]', DisplayAuthorsAction::class);

        // Create an author account
        $routeCollectorProxy->get('/auteurs/create[/]', CreateAuthorAction::class);

        // handle the form submission
        $routeCollectorProxy->post('/auteurs/create[/]', CreateAuthorSubmitAction::class);

        // Authentication
        $routeCollectorProxy->group('/auth', function (RouteCollectorProxy $authenticationRouteCollectorProxy) {
            // Signin
            $authenticationRouteCollectorProxy->get('/signin[/]', SignInAuthenticationAction::class);

            // Handle the form submission
            $authenticationRouteCollectorProxy->post('/signin[/]', SignInAuthenticationSubmitAction::class);

            // Signout
            $authenticationRouteCollectorProxy->get('/signout[/]', SignOutAuthenticationAction::class);

            // Signup
            $authenticationRouteCollectorProxy->get('/signup[/]', SignUpAuthenticationAction::class);

            // Handle the form submission
            $authenticationRouteCollectorProxy->post('/signup[/]', SignUpAuthenticationSubmitAction::class);
        });
    });


};
