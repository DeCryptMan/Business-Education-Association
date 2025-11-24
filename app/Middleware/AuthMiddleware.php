<?php
namespace App\Middleware;

use Core\Auth;
use Core\Response;

class AuthMiddleware {
    public function handle(): void {
        if (!Auth::check()) {
            Response::redirect('/login');
        }
    }
}