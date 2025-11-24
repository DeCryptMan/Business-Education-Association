<?php
declare(strict_types=1);

namespace Core;

use PDO;
use PDOException;
use RuntimeException;

class Database {
    private static ?PDO $pdo = null;
    public static function connect(): PDO {
        if (self::$pdo === null) {
            $configFile = __DIR__ . '/../config/config.php';
            if (!file_exists($configFile)) {
                throw new RuntimeException("Config file not found: " . $configFile);
            }
            $config = require $configFile;
            if (!isset($config['db'])) {
                throw new RuntimeException("Database configuration not found in config.php");
            }
            $dbConf = $config['db'];
            $driver = $dbConf['driver'] ?? 'mysql';
            $dsn = "{$driver}:host={$dbConf['host']};dbname={$dbConf['dbname']};charset={$dbConf['charset']}";
            $options = $dbConf['options'] ?? [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_STRINGIFY_FETCHES  => false,
            ];

            try {
                self::$pdo = new PDO($dsn, $dbConf['user'], $dbConf['pass'], $options);
            } catch (PDOException $e) {
                error_log("Database Connection Error: " . $e->getMessage());
                if (($config['env'] ?? 'production') === 'development') {
                    throw $e;
                } 
                http_response_code(500);
                echo "Сервис временно недоступен (ошибка подключения к БД).";
                exit;
            }
        }
        
        return self::$pdo;
    }
    private function __construct() {}
    private function __clone() {}
}