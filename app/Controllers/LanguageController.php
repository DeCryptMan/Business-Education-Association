<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use Core\Response;
use Core\Lang;
use Core\Url;

class LanguageController extends Controller {
    
    public function switch(string $lang) {
        Lang::set($lang);
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }
        $referrer = $_SERVER['HTTP_REFERER'] ?? null;
        if (!$referrer || str_contains($referrer, '/lang/')) {
            $referrer = Url::to('/');
        }
        Response::redirect($referrer);
    }
}