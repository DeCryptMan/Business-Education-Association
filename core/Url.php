<?php
declare(strict_types=1);
namespace Core;
class Url {
    public static function base(): string {
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $dir = dirname($scriptName);
        $dir = str_replace('\\', '/', $dir);
        return $dir === '/' ? '' : $dir;
    }

    public static function to(string $path = ''): string {
        $path = ltrim($path, '/');
        return self::base() . '/' . $path;
    }
    public static function asset(string $path): string {
        return self::to('assets/' . ltrim($path, '/'));
    }
}