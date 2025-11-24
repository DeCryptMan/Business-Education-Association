<?php
declare(strict_types=1);

namespace App\Models;

use Core\Model; // Наследуем от нашего базового Model
use PDO;

class User extends Model {
    
    // Найти пользователя по Email
    public static function findByEmail(string $email) {
        // Используем self::db() вместо Database::connect()
        $stmt = self::db()->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Создать нового админа
    public static function create(string $email, string $password, string $role = 'admin') {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = self::db()->prepare("INSERT INTO users (email, password_hash, role) VALUES (:email, :hash, :role)");
        return $stmt->execute([
            'email' => $email,
            'hash' => $hash,
            'role' => $role
        ]);
    }
}