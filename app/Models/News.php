<?php
declare(strict_types=1);

namespace App\Models;

use Core\Model;
use PDO;

class News extends Model {
    
    /**
     * Получить все опубликованные новости (для списка)
     */
    public static function getAllPublished(): array {
        // Сортировка теперь по published_at
        return self::db() 
            ->query("SELECT * FROM news WHERE is_published = 1 ORDER BY published_at DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Получить последние N новостей (для главной)
     */
    public static function getLatest(int $limit = 3): array {
        $stmt = self::db()->prepare("SELECT * FROM news WHERE is_published = 1 ORDER BY published_at DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Найти новость по Slug (для страницы новости)
     */
    public static function getBySlug(string $slug): ?array {
        $stmt = self::db()->prepare("SELECT * FROM news WHERE slug = :slug AND is_published = 1 LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res ?: null;
    }

    /**
     * Получить новость по ID (для админки)
     */
    public static function getById(int $id): ?array {
        $stmt = self::db()->prepare("SELECT * FROM news WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res ?: null;
    }

    /**
     * Для админки: получить вообще все новости
     */
    public static function getAll(): array {
        return self::db()->query("SELECT * FROM news ORDER BY published_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Создание новости
     */
    public static function create(array $data): bool {
        // Добавляем published_at в список полей и значений
        $sql = "INSERT INTO news (slug, title_hy, title_en, excerpt_hy, excerpt_en, body_hy, body_en, image_url, is_published, published_at, created_at) 
                VALUES (:slug, :title_hy, :title_en, :excerpt_hy, :excerpt_en, :body_hy, :body_en, :image_url, :is_published, :published_at, NOW())";
        
        $stmt = self::db()->prepare($sql);
        
        // Форматируем дату YYYY-MM-DD в YYYY-MM-DD 00:00:00 для базы данных
        $publishedAt = $data['published_at'] . ' 00:00:00';
        
        return $stmt->execute([
            'slug' => $data['slug'],
            'title_hy' => $data['title_hy'],
            'title_en' => $data['title_en'] ?? null,
            'excerpt_hy' => $data['excerpt_hy'] ?? null,
            'excerpt_en' => $data['excerpt_en'] ?? null,
            'body_hy' => $data['body_hy'] ?? null,
            'body_en' => $data['body_en'] ?? null,
            'image_url' => $data['image_url'] ?? null, // Path string
            'is_published' => $data['is_published'] ?? 1,
            'published_at' => $publishedAt, // НОВОЕ ПОЛЕ
        ]);
    }
    
    /**
     * Обновление новости
     */
    public static function update(int $id, array $data): bool {
        $sql = "UPDATE news SET 
                    slug = :slug,
                    title_hy = :title_hy, title_en = :title_en,
                    excerpt_hy = :excerpt_hy, excerpt_en = :excerpt_en,
                    body_hy = :body_hy, body_en = :body_en,
                    is_published = :is_published,
                    published_at = :published_at"; // ОБНОВЛЯЕМ ЭТО ПОЛЕ
        
        // Обновляем image_url только если был передан новый путь
        if (isset($data['image_url'])) { 
            $sql .= ", image_url = :image_url";
        }

        $sql .= " WHERE id = :id";
        
        $stmt = self::db()->prepare($sql);
        
        // Форматируем дату YYYY-MM-DD в YYYY-MM-DD 00:00:00 для базы данных
        $publishedAt = $data['published_at'] . ' 00:00:00';

        $params = [
            'id'           => $id,
            'slug'         => $data['slug'],
            'title_hy'     => $data['title_hy'],
            'title_en'     => $data['title_en'] ?? '',
            'excerpt_hy'   => $data['excerpt_hy'] ?? '',
            'excerpt_en'   => $data['excerpt_en'] ?? '',
            'body_hy'      => $data['body_hy'] ?? '',
            'body_en'      => $data['body_en'] ?? '',
            'is_published' => $data['is_published'] ?? 0,
            'published_at' => $publishedAt // НОВОЕ ЗНАЧЕНИЕ
        ];

        // Добавляем image_url в параметры, только если он был передан
        if (isset($data['image_url'])) {
            $params['image_url'] = $data['image_url'];
        }

        return $stmt->execute($params);
    }

    /**
     * Удаление новости
     */
    public static function delete(int $id): bool {
        $stmt = self::db()->prepare("DELETE FROM news WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}