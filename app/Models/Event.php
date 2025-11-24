<?php
declare(strict_types=1);

namespace App\Models;

use Core\Model;
use PDO;

class Event extends Model {
    
    public static function getAll(): array {
        return self::db()->query("SELECT * FROM events ORDER BY event_date DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getForCalendar(): array {
        $events = self::getAll();
        $calendarData = [];
        foreach ($events as $ev) {
            $date = $ev['event_date'];
            $calendarData[$date][] = [
                'id' => $ev['id'],
                'title_hy' => $ev['title_hy'],
                'title_en' => $ev['title_en'],
                'time' => $ev['start_time'] ? date('H:i', strtotime($ev['start_time'])) : ''
            ];
        }
        return $calendarData;
    }

    public static function getById(int $id): ?array {
        $stmt = self::db()->prepare("SELECT * FROM events WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res ?: null;
    }

    public static function create(array $data): bool {
        $sql = "INSERT INTO events (title_hy, title_en, description_hy, description_en, event_date, start_time, location_hy, location_en, image_url) 
                VALUES (:title_hy, :title_en, :desc_hy, :desc_en, :date, :time, :loc_hy, :loc_en, :img)";
        
        $stmt = self::db()->prepare($sql);
        return $stmt->execute([
            'title_hy' => $data['title_hy'],
            'title_en' => $data['title_en'] ?? '',
            'desc_hy'  => $data['description_hy'] ?? '',
            'desc_en'  => $data['description_en'] ?? '',
            'date'     => $data['event_date'],
            'time'     => !empty($data['start_time']) ? $data['start_time'] : null,
            'loc_hy'   => $data['location_hy'] ?? '',
            'loc_en'   => $data['location_en'] ?? '',
            'img'      => $data['image_url'] ?? null
        ]);
    }

    // ՆՈՐ ՄԵԹՈԴ (NEW METHOD)
    public static function update(int $id, array $data): bool {
        $sql = "UPDATE events SET 
                    title_hy = :title_hy, title_en = :title_en,
                    description_hy = :desc_hy, description_en = :desc_en,
                    event_date = :date, start_time = :time,
                    location_hy = :loc_hy, location_en = :loc_en";
        
        // Թարմացնում ենք նկարը միայն եթե նորն է ուղարկվել
        if (!empty($data['image_url'])) {
            $sql .= ", image_url = :img";
        }

        $sql .= " WHERE id = :id";

        $stmt = self::db()->prepare($sql);
        
        $params = [
            'id'       => $id,
            'title_hy' => $data['title_hy'],
            'title_en' => $data['title_en'] ?? '',
            'desc_hy'  => $data['description_hy'] ?? '',
            'desc_en'  => $data['description_en'] ?? '',
            'date'     => $data['event_date'],
            'time'     => !empty($data['start_time']) ? $data['start_time'] : null,
            'loc_hy'   => $data['location_hy'] ?? '',
            'loc_en'   => $data['location_en'] ?? ''
        ];

        if (!empty($data['image_url'])) {
            $params['img'] = $data['image_url'];
        }

        return $stmt->execute($params);
    }

    public static function delete(int $id): bool {
        $stmt = self::db()->prepare("DELETE FROM events WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public static function getUpcoming(int $limit = 3): array {
        return self::db()
            ->query("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC LIMIT $limit")
            ->fetchAll(PDO::FETCH_ASSOC);
    }
}