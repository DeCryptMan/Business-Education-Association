<?php
declare(strict_types=1);

return [
    'app_name' => 'Business & Education Association',
    'base_url' => 'http://localhost', // В продакшене лучше брать из getenv()
    'env'      => 'development', // development | production
    
    'db' => [
        'driver'  => 'mysql',
        'host'    => 'localhost',
        'dbname'  => 'be_association_db',
        'user'    => 'root',
        'pass'    => '',
        'charset' => 'utf8mb4',
        'options' => [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_STRINGIFY_FETCHES  => false,
        ]
    ],
    
    'session' => [
        'name'     => 'BE_SESSION',
        'lifetime' => 7200,
        'secure'   => false, // true для HTTPS
        'httponly' => true,
        'samesite' => 'Strict',
    ],
];