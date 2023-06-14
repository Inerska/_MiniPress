<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Service;

use Illuminate\Database\Capsule\Manager as DB;

final class Eloquent
{
    public static function init($filename): void
    {
        $db = new DB();
        $db->addConnection(parse_ini_file($filename));
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}