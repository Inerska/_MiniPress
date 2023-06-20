<?php

declare(strict_types=1);

namespace Minipress\Application\Actions\Authentication;

use App\Application\Actions\Action;
use Illuminate\View\Factory;
use Minipress\Infrastructure\Persistence\Service\Identity\AuthenticationStateProviderService;
use Psr\Log\LoggerInterface;

abstract class AuthenticationAction extends Action
{
    protected AuthenticationStateProviderService $service;

    /**
     * @param LoggerInterface $logger
     * @param Factory $view
     */
    public function __construct(LoggerInterface $logger, Factory $view)
    {
        parent::__construct($logger, $view);
        $this->service = new AuthenticationStateProviderService();
    }
}