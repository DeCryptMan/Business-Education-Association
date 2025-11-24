<?php
namespace App\Controllers;

use Core\Controller;
use Core\View;
use Core\Response;
use Core\Auth;
use Core\Url;
use Core\Database;

class AuthController extends Controller {
    public function loginForm() {
        if (Auth::check()) {
            Response::redirect('admin');
        }
        View::render('auth/login', [], false);
    }

    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            Response::redirect('admin');
        } else {
            $_SESSION['flash_error'] = 'Սխալ էլ․ հասցե կամ գաղտնաբառ (Неверный логин или пароль)';
            Response::redirect('login');
        }
    }
    public function logout() {
        Auth::logout();
        Response::redirect('/');
    }
}