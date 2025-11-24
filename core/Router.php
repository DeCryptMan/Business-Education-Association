<?php
namespace Core;

class Router {
    private array $routes = [];

    public function loadRoutes(string $path): void {
        if (file_exists($path)) {
            $router = $this; 
            require $path;
        }
    }

    public function get(string $path, array|callable $handler, array $middleware = []): void {
        $this->add('GET', $path, $handler, $middleware);
    }

    public function post(string $path, array|callable $handler, array $middleware = []): void {
        $this->add('POST', $path, $handler, $middleware);
    }

    private function add(string $method, string $path, array|callable $handler, array $middleware): void {
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $path);
        $pattern = "#^" . $pattern . "$#";
        
        $this->routes[$method][$pattern] = [
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    public function dispatch(string $uri, string $method): void {
        $path = parse_url($uri, PHP_URL_PATH);
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
        $scriptDir = str_replace('\\', '/', $scriptDir);
        if ($scriptDir !== '/' && str_starts_with($path, $scriptDir)) {
            $path = substr($path, strlen($scriptDir));
        }
        if ($path === '' || $path === false) {
            $path = '/';
        }
        // ---------------------------------------------------
        foreach ($this->routes[$method] ?? [] as $pattern => $route) {
            if (preg_match($pattern, $path, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                foreach ($route['middleware'] as $mwClass) {
                    $mw = new $mwClass();
                    if (method_exists($mw, 'handle')) {
                        $mw->handle();
                    }
                }
                $handler = $route['handler'];
                if (is_array($handler)) {
                    [$class, $action] = $handler;
                    $controller = new $class();
                    call_user_func_array([$controller, $action], $params);
                } elseif (is_callable($handler)) {
                    call_user_func_array($handler, $params);
                }
                return;
            }
        }

        $this->handleNotFound();
    }

    private function handleNotFound(): void {
        http_response_code(404);
        $view404 = __DIR__ . '/../app/Views/404.php';
        
        if (file_exists($view404)) {
            require $view404;
        } else {
            echo "<div style='text-align:center; margin-top:50px; font-family:sans-serif;'>";
            echo "<h1 style='font-size:48px'>404</h1>";
            echo "<p>Page Not Found.</p>";
            echo "<a href='/'>Вернуться на главную</a>";
            echo "</div>";
        }
        exit;
    }
}