<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use Slim\App;

return function (App $app) {

    define("API_PREFIX", '/api/v1');

    $app->get(API_PREFIX . '/users', ListUsersAction::class);
};
