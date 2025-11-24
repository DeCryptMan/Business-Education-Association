<?php
namespace Core;

class Request {
    public function getPath(): string {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function getMethod(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isPost(): bool {
        return $this->getMethod() === 'POST';
    }

    public function isGet(): bool {
        return $this->getMethod() === 'GET';
    }
}