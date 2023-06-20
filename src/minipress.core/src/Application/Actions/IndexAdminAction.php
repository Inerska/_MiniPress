<?php

declare(strict_types=1);

namespace App\Application\Actions;

use Psr\Http\Message\ResponseInterface as Response;

final class IndexAdminAction extends Action
{
    protected function action(): Response
    {
        return $this->respondWithView('layout');
    }
}