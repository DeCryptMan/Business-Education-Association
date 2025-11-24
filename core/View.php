<?php
// lb/core/View.php
namespace Core;

class View {
    /**
     * @param string $viewPath
     * @param array $data
     * @param string|null $layout
     * @return void
     */
    public static function render(string $viewPath, array $data = [], ?string $layout = 'main'): void {
        // Экранируем все строковые данные в массиве (Basic Auto-Escaping)
        $cleanData = self::sanitize($data);
        
        // Распаковываем
        extract($cleanData);
        // Добавляем оригинальные данные под префиксом raw_, если вдруг нужен HTML
        $rawData = $data; 

        ob_start();
        
        $viewFile = __DIR__ . "/../app/Views/$viewPath.php";
        if (!file_exists($viewFile)) {
            ob_end_clean();
            throw new \RuntimeException("View file not found: $viewPath");
        }
        
        require $viewFile;
        $content = ob_get_clean();

        if ($layout) {
            $layoutFile = __DIR__ . "/../app/Views/layouts/$layout.php";
            if (!file_exists($layoutFile)) {
                throw new \RuntimeException("Layout file not found: $layoutFile");
            }
            require $layoutFile;
        } else {
            echo $content;
        }
    }

    private static function sanitize(array $data): array {
        $clean = [];
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $clean[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            } elseif (is_array($value)) {
                $clean[$key] = self::sanitize($value);
            } else {
                $clean[$key] = $value;
            }
        }
        return $clean;
    }
}