<?php
namespace Core;

class Response {
    public static function json($data, int $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function redirect(string $url) {
        if (!str_starts_with($url, 'http')) {
            $url = Url::to($url);
        }
        
        header("Location: $url");
        exit;
    }
}