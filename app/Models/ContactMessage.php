<?php
declare(strict_types=1);

namespace App\Models;

use Core\Model;
use PDO;

class ContactMessage extends Model {
    
    /**
     * Создание сообщения (вызывается из API)
     */
    public static function create(array $data): string {
        $ref = self::generateReference('MSG');

        $sql = "INSERT INTO contact_messages (
                    reference, full_name, email, phone, topic, message, status, created_at
                ) VALUES (
                    :ref, :name, :email, :phone, :topic, :message, 'new', NOW()
                )";
        
        $stmt = self::db()->prepare($sql);
        $stmt->execute([
            'ref'     => $ref,
            'name'    => $data['name'],
            'email'   => $data['email'],
            'phone'   => $data['phone'] ?? null,
            'topic'   => $data['topic'] ?? 'other',
            'message' => $data['message']
        ]);

        return $ref;
    }

    /**
     * Получить список сообщений (для Админки)
     */
    public static function getAll(array $filters = []): array {
        $sql = "SELECT * FROM contact_messages WHERE 1=1";
        $params = [];

        // Фильтр по статусу (new / processed)
        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $sql .= " AND status = :status";
            $params['status'] = $filters['status'];
        }

        // Поиск
        if (!empty($filters['search'])) {
            $sql .= " AND (full_name LIKE :s1 OR email LIKE :s2 OR message LIKE :s3)";
            $term = '%' . $filters['search'] . '%';
            $params['s1'] = $term;
            $params['s2'] = $term;
            $params['s3'] = $term;
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = self::db()->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Получить одно сообщение
     */
    public static function getById(int $id): ?array {
        $stmt = self::db()->prepare("SELECT * FROM contact_messages WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res ?: null;
    }

    /**
     * Пометить как прочитанное
     */
    public static function markAsRead(int $id): bool {
        $stmt = self::db()->prepare("UPDATE contact_messages SET status = 'processed' WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Удалить сообщение
     */
    public static function delete(int $id): bool {
        $stmt = self::db()->prepare("DELETE FROM contact_messages WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Кол-во новых (для меню)
     */
    public static function countNew(): int {
        return (int) self::db()->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'new'")->fetchColumn();
    }
}