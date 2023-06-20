<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Service\Identity;

interface AuthenticationStateProviderInterface
{
    public function user();

    public function check(): bool;

    public function attempt($email, $password): bool;

    public function logout();
}