<?php
namespace Core;

class Auth {
    public static function check(): bool {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
    public static function id() {
        return $_SESSION['user_id'] ?? null;
    }
    public static function logout(): void {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
    }
    public static function requireLogin(): void {
        if (!self::check()) {
            Response::redirect('/login');
        }
    }
}