<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },

        'view' => function () {
            $paths = [__DIR__ . '/../resources/views'];
            $cache = __DIR__ . '/../storage/framework/views';

            $filesystem = new Filesystem();
            $compiler = new BladeCompiler($filesystem, $cache);

            $resolver = new EngineResolver();
            $resolver->register('blade', function () use ($compiler) {
                return new CompilerEngine($compiler);
            });

            $finder = new FileViewFinder($filesystem, $paths);
            return new Factory($resolver, $finder, new Dispatcher());
        }
    ]);
};