<?php
// lb/index.php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$config = require __DIR__ . '/config/config.php';
session_name($config['session']['name']);
session_set_cookie_params([
    'lifetime' => $config['session']['lifetime'],
    'path' => '/',
    'domain' => '',
    'secure' => $config['session']['secure'],
    'httponly' => $config['session']['httponly'],
    'samesite' => 'Strict'
]);
session_start();

// 3.(Autoloader)
spl_autoload_register(function ($class) {
    $prefix = '';
    $base_dir = __DIR__ . '/';
    $map = [
        'Core\\' => 'core/',
        'Config\\' => 'config/',
        'App\\Controllers\\' => 'app/Controllers/',
        'App\\Models\\' => 'app/Models/',
        'App\\Middleware\\' => 'app/Middleware/',
        'App\\Services\\' => 'app/Services/',
    ];

    foreach ($map as $ns => $dir) {
        if (str_starts_with($class, $ns)) {
            $relative_class = substr($class, strlen($ns));
            $file = $base_dir . $dir . str_replace('\\', '/', $relative_class) . '.php';
            if (file_exists($file)) {
                require $file;
                return;
            }
        }
    }
});

if (file_exists(__DIR__ . '/core/helpers.php')) {
    require_once __DIR__ . '/core/helpers.php';
}

try {
    Core\Lang::init();
} catch (Error $e) {
    die("Ошибка Core\Lang: " . $e->getMessage());
}
// 5. Routing
try {
    $router = new Core\Router();
    $router->loadRoutes(__DIR__ . '/routes/web.php');
    $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

} catch (Throwable $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo "Internal Server Error: " . $e->getMessage(); 
}