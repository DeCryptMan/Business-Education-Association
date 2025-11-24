<?php
declare(strict_types=1);

namespace Core;

class Lang {
    private static string $current = 'hy'; 
    private static array $translations = [];
    private static array $allowed = ['hy', 'en'];

    public static function init(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!empty($_SESSION['lang']) && in_array($_SESSION['lang'], self::$allowed)) {
            self::$current = $_SESSION['lang'];
        } elseif (!empty($_COOKIE['lang']) && in_array($_COOKIE['lang'], self::$allowed)) {
            self::$current = $_COOKIE['lang'];
            $_SESSION['lang'] = self::$current;
        }

        self::loadTranslations();
    }

    private static function loadTranslations(): void {
        $path = __DIR__ . '/../app/Lang/' . self::$current . '.php';
        if (file_exists($path)) {
            self::$translations = require $path;
        } else {
            self::$translations = [];
        }
    }

    public static function get(string $key, string $default = ''): string {
        $keys = explode('.', $key);
        $value = self::$translations;

        foreach ($keys as $nestedKey) {
            if (isset($value[$nestedKey])) {
                $value = $value[$nestedKey];
            } else {
                return $default ?: $key;
            }
        }

        return is_string($value) ? $value : $key;
    }

    public static function current(): string {
        return self::$current;
    }

    public static function set(string $lang): void {
        if (in_array($lang, self::$allowed)) {
            self::$current = $lang;
            $_SESSION['lang'] = $lang;
            setcookie('lang', $lang, [
                'expires' => time() + (86400 * 30),
                'path' => '/',
                'domain' => '', 
                'secure' => false, // false для localhost, true для https
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
        }
    }
}