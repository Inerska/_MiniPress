<?php

declare(strict_types=1);

use App\Infrastructure\Persistence\Article\ArticleRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        ArticleRepository::class => autowire(ArticleRepository::class),
    ]);
};
