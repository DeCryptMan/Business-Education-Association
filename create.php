<?php
// lb/create_admin.php
declare(strict_types=1);

require __DIR__ . '/config/config.php';
require __DIR__ . '/core/Database.php';

use Core\Database;

try {
    $db = Database::connect();
    
    $email = 'admin@admin.am';
    $password = 'admin123'; // ВАШ НОВЫЙ ПАРОЛЬ
    
    // 1. Хэшируем пароль правильно
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    // 2. Проверяем, есть ли такой юзер
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->fetch()) {
        // Если есть — обновляем пароль
        $update = $db->prepare("UPDATE users SET password_hash = ?, role = 'admin' WHERE email = ?");
        $update->execute([$hash, $email]);
        echo "<h1>Успех!</h1> Пароль для <b>$email</b> обновлен. Новый пароль: <b>$password</b>";
    } else {
        // Если нет — создаем нового
        $insert = $db->prepare("INSERT INTO users (email, password_hash, role) VALUES (?, ?, 'admin')");
        $insert->execute([$email, $hash]);
        echo "<h1>Успех!</h1> Пользователь <b>$email</b> создан. Пароль: <b>$password</b>";
    }
    
    echo "<br><br><a href='login'>Перейти к входу</a>";

} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}