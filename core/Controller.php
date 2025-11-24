<?php
declare(strict_types=1);

namespace Core;

abstract class Controller {
    protected function getJsonInput(): array {
        $content = file_get_contents('php://input');
        if (!$content) {
            return [];
        }
        
        $data = json_decode($content, true);
        return is_array($data) ? $data : [];
    }

    /**
     * 
     * @param array $data Данные для проверки
     * @param array $rules Правила ['field' => 'required|email']
     * @return array Ошибки ['field' => 'Message']
     */
    protected function validate(array $data, array $rules): array {
        $errors = [];
        
        foreach ($rules as $field => $ruleString) {
            $ruleList = explode('|', $ruleString);
            $value = $data[$field] ?? null;

            foreach ($ruleList as $rule) {
                if ($rule === 'required' && empty($value)) {
                    $errors[$field] = "Поле $field обязательно для заполнения.";
                }
                if ($rule === 'email' && !empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field] = "Некорректный формат Email.";
                }
            }
        }
        
        return $errors;
    }

    protected function jsonResponse(array $data, int $status = 200): void {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
}