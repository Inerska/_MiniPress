<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use App\Infrastructure\Persistence\Service\Identity\AuthenticationStateProviderService;
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
            $events = new Dispatcher();

            $view = new Factory($resolver, $finder, $events);
            $authenticationServiceProvider = AuthenticationStateProviderService::getInstance();
            $view->share('authService', $authenticationServiceProvider);

            return $view;
        },

        Illuminate\View\ViewFinderInterface::class => function (ContainerInterface $c) {
            return $c->get('view')->getFinder();
        },

        Illuminate\Contracts\Events\Dispatcher::class => function (ContainerInterface $c) {
            return $c->get('view')->getDispatcher();
        },

        Illuminate\View\Engines\EngineResolver::class => function (ContainerInterface $c) {
            return $c->get('view')->getEngineResolver();
        },

        AuthenticationStateProviderService::class => function (ContainerInterface $c) {
            return AuthenticationStateProviderService::getInstance();
        },

    ]);
};