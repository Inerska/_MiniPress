<?php

declare(strict_types=1);

namespace Minipress\Infrastructure\Persistence\Service\Identity;

use App\Domain\User\User;

final class AuthenticationStateProviderService implements AuthenticationStateProviderInterface
{
    private static ?AuthenticationStateProviderService $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): AuthenticationStateProviderService
    {
        if (self::$instance === null) {
            self::$instance = new AuthenticationStateProviderService();
        }

        return self::$instance;
    }

    public function user()
    {
        if (isset($_SESSION['user_id'])) {
            return User::find($_SESSION['user_id']);
        }

        return null;
    }

    public function check(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function attempt($email, $password): bool
    {
        $user = User::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            $_SESSION['user_id'] = $user->id;
            return true;
        }

        return false;
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
    }
}