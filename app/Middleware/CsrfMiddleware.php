<?php
namespace App\Middleware;

use Core\Csrf;
use Core\Response;

class CsrfMiddleware {
    public function handle(): void {
        $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        if (!Csrf::verify($token)) {
            http_response_code(419);
            echo "419 | Ошибка безопасности (CSRF token mismatch). Обновите страницу.";
            exit;
        }
    }
}