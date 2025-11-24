<?php
declare(strict_types=1);

namespace Core;

use PDO;

abstract class Model {
    
    protected static function db(): PDO {
        return Database::connect();
    }
    protected static function generateReference(string $prefix): string {
        return $prefix . '-' . date('Y') . '-' . mt_rand(1000, 9999);
    }
}