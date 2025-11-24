<?php
declare(strict_types=1);

namespace App\Models;

use Core\Model;
use PDO;

class Mentor extends Model {
    
    /**
     * Создание заявки ментора
     */
    public static function create(array $data): string {
        $ref = self::generateReference('MTR');

        $fullName = $data['fullName'] ?? 'Unknown';
        $email    = $data['email'] ?? '';
        $phone    = $data['mobilePhone'] ?? ($data['phone'] ?? '');
        $org      = $data['orgName'] ?? '';
        $position = $data['currentPosition'] ?? '';
        
        $profileData = json_encode($data, JSON_UNESCAPED_UNICODE);

        $sql = "INSERT INTO mentors (
                    reference, full_name, email, phone, 
                    organization, position, profile_data, created_at, status
                ) VALUES (
                    :ref, :name, :email, :phone, 
                    :org, :pos, :json, NOW(), 'new'
                )";
        
        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            'ref'   => $ref,
            'name'  => $fullName,
            'email' => $email,
            'phone' => $phone,
            'org'   => $org,
            'pos'   => $position,
            'json'  => $profileData
        ]);

        return $ref;
    }

    /**
     * Получить список менторов (с фильтрацией)
     */
    public static function getAll(array $filters = []): array {
        $db = self::db();
        $sql = "SELECT * FROM mentors WHERE 1=1";
        $params = [];

        // 1. Статус
        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $sql .= " AND status = :status";
            $params['status'] = $filters['status'];
        }

        // 2. Поиск (Имя, Email, Телефон, Организация)
        // Используем уникальные плейсхолдеры s1..s4, чтобы PDO не ругался
        if (!empty($filters['search'])) {
            $sql .= " AND (full_name LIKE :s1 OR email LIKE :s2 OR phone LIKE :s3 OR organization LIKE :s4)";
            $term = '%' . $filters['search'] . '%';
            $params['s1'] = $term;
            $params['s2'] = $term;
            $params['s3'] = $term;
            $params['s4'] = $term;
        }

        // 3. Период
        if (!empty($filters['period']) && $filters['period'] === '30days') {
            $sql .= " AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Получить ментора по ID
     */
    public static function getById(int $id): ?array {
        $stmt = self::db()->prepare("SELECT * FROM mentors WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $mentor = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($mentor && !empty($mentor['profile_data'])) {
            $mentor['profile_data'] = json_decode($mentor['profile_data'], true);
        }
        
        return $mentor ?: null;
    }

    /**
     * Обновить статус
     */
    public static function updateStatus(int $id, string $status): bool {
        $stmt = self::db()->prepare("UPDATE mentors SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }
    
    /**
     * Количество (для дашборда)
     */
    public static function count(): int {
        return (int) self::db()->query("SELECT COUNT(*) FROM mentors")->fetchColumn();
    }
}