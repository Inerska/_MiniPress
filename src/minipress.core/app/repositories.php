<?php

declare(strict_types=1);

use App\Infrastructure\Persistence\Article\ArticleRepository;
use App\Infrastructure\Persistence\Category\CategoryRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        ArticleRepository::class => autowire(ArticleRepository::class),
        CategoryRepository::class => autowire(CategoryRepository::class),
    ]);
};
