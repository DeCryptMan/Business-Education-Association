<?php
declare(strict_types=1);

namespace App\Models;

use Core\Model;
use PDO;

class Mentee extends Model {
    
    /**
     * Создание новой заявки
     */
    public static function create(array $data): string {
        $ref = self::generateReference('MTE');

        $fullName = $data['fullName'] ?? 'Unknown';
        $email    = $data['email'] ?? '';
        $phone    = $data['mobilePhone'] ?? ($data['phone'] ?? '');
        
        $profileData = json_encode($data, JSON_UNESCAPED_UNICODE);

        $sql = "INSERT INTO mentees (
                    reference, full_name, email, phone, 
                    profile_data, created_at, status
                ) VALUES (
                    :ref, :name, :email, :phone, 
                    :json, NOW(), 'new'
                )";
        
        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            'ref'   => $ref,
            'name'  => $fullName,
            'email' => $email,
            'phone' => $phone,
            'json'  => $profileData
        ]);

        return $ref;
    }

    /**
     * Получить список менти (с фильтрацией)
     * ИСПРАВЛЕНО: Уникальные имена параметров для поиска
     */
    public static function getAll(array $filters = []): array {
        $db = self::db();
        $sql = "SELECT * FROM mentees WHERE 1=1";
        $params = [];

        // 1. Фильтр по Статусу
        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $sql .= " AND status = :status";
            $params['status'] = $filters['status'];
        }

        // 2. Поиск (ИСПРАВЛЕНО: используем s1, s2, s3)
        if (!empty($filters['search'])) {
            $sql .= " AND (full_name LIKE :s1 OR email LIKE :s2 OR phone LIKE :s3)";
            $searchTerm = '%' . $filters['search'] . '%';
            $params['s1'] = $searchTerm;
            $params['s2'] = $searchTerm;
            $params['s3'] = $searchTerm;
        }

        // 3. Фильтр по Дате
        if (!empty($filters['period']) && $filters['period'] === '30days') {
            $sql .= " AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Получить одного менти по ID
     */
    public static function getById(int $id): ?array {
        $stmt = self::db()->prepare("SELECT * FROM mentees WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $mentee = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($mentee && !empty($mentee['profile_data'])) {
            $mentee['profile_data'] = json_decode($mentee['profile_data'], true);
        }

        return $mentee ?: null;
    }

    /**
     * Обновить статус заявки
     */
    public static function updateStatus(int $id, string $status): bool {
        $stmt = self::db()->prepare("UPDATE mentees SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }

    /**
     * Количество (для дашборда)
     */
    public static function count(): int {
        return (int) self::db()->query("SELECT COUNT(*) FROM mentees")->fetchColumn();
    }
}