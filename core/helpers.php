<?php
use Core\Lang;

if (!function_exists('__')) {
    function __(string $key, string $default = ''): string {
        return Lang::get($key, $default);
    }
}
if (!function_exists('lang')) {
    function lang(): string {
        return Lang::current();
    }
}