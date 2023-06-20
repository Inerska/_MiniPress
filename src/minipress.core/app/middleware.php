<?php

declare(strict_types=1);

use App\Application\Middleware\AuthenticationMiddleware;
use App\Application\Middleware\SessionMiddleware;
use Slim\App;

return function (App $app) {
    $app
        ->add(SessionMiddleware::class)
        ->add(AuthenticationMiddleware::class)
    ;
};
