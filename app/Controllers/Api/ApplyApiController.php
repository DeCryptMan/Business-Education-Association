<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use Core\Controller;
use Core\Response;
use Core\Lang;
use App\Models\Mentee;
use App\Models\Mentor;

class ApplyApiController extends Controller {
    
    /**
     * Handle Mentee Application
     */
    public function submitMentee() {
        // 1. Проверка обязательных полей
        $required = ['fullName', 'email', 'phone', 'signature'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                Response::json(['success' => false, 'message' => $this->getMsg('missing_fields')]);
                return;
            }
        }

        // 2. Данные профиля
        $profileData = $_POST;
        unset($profileData['csrf_token']);

        // 3. Сохранение (ИСПРАВЛЕНО: ключи теперь совпадают с Моделью)
        try {
            $id = Mentee::create([
                'fullName' => $_POST['fullName'], // Было 'full_name', стало 'fullName'
                'email'    => $_POST['email'],
                'phone'    => $_POST['phone'],
                'profile_data' => json_encode($profileData, JSON_UNESCAPED_UNICODE)
            ]);

            if ($id) {
                Response::json([
                    'success' => true, 
                    'message' => $this->getMsg('success_mentee')
                ]);
            } else {
                Response::json(['success' => false, 'message' => $this->getMsg('db_error')]);
            }
        } catch (\Exception $e) {
            Response::json(['success' => false, 'message' => 'System Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Handle Mentor Application
     */
    public function submitMentor() {
        // 1. Проверка
        $required = ['fullName', 'email', 'phone', 'motivation', 'signature'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                Response::json(['success' => false, 'message' => $this->getMsg('missing_fields')]);
                return;
            }
        }

        // 2. Данные
        $profileData = $_POST;
        unset($profileData['csrf_token']);

        // 3. Сохранение (ИСПРАВЛЕНО: добавлены orgName и currentPosition)
        try {
            $id = Mentor::create([
                'fullName' => $_POST['fullName'], // Исправлено
                'email'    => $_POST['email'],
                'phone'    => $_POST['phone'],
                
                // Мапинг полей формы в поля модели
                'orgName'         => $_POST['currentOrg'] ?? '', // Добавлено
                'currentPosition' => $_POST['position'] ?? '',   // Добавлено
                
                'profile_data' => json_encode($profileData, JSON_UNESCAPED_UNICODE)
            ]);

            if ($id) {
                Response::json([
                    'success' => true, 
                    'message' => $this->getMsg('success_mentor')
                ]);
            } else {
                Response::json(['success' => false, 'message' => $this->getMsg('db_error')]);
            }
        } catch (\Exception $e) {
            Response::json(['success' => false, 'message' => 'System Error: ' . $e->getMessage()]);
        }
    }

    /**
     * Helper to get messages based on current language
     */
    private function getMsg(string $key): string {
        $lang = Lang::current();
        
        $messages = [
            'success_mentee' => [
                'hy' => 'Հայտը հաջողությամբ ուղարկվեց։ Մենք շուտով կկապնվենք Ձեզ հետ։',
                'en' => 'Application submitted successfully! We will contact you soon.'
            ],
            'success_mentor' => [
                'hy' => 'Շնորհակալություն։ Ձեր մենթորի հայտը ընդունված է։',
                'en' => 'Thank you. Your mentor application has been received.'
            ],
            'missing_fields' => [
                'hy' => 'Խնդրում ենք լրացնել բոլոր պարտադիր դաշտերը (*)',
                'en' => 'Please fill in all required fields (*)'
            ],
            'db_error' => [
                'hy' => 'Տեղի ունեցավ սխալ տվյալների պահպանման ժամանակ։',
                'en' => 'Database error occurred while saving.'
            ]
        ];

        return $messages[$key][$lang] ?? $messages[$key]['hy'];
    }
}