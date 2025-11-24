<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use Core\Controller;
use Core\Response;
use App\Models\ContactMessage;

class ContactApiController extends Controller {
    
    public function submit() {
        $input = $this->getJsonInput();
        
        $errors = $this->validate($input, [
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required'
        ]);

        if (!empty($errors)) {
            Response::json(['status' => 'error', 'message' => 'Լրացրեք պարտադիր դաշտերը', 'errors' => $errors], 400);
        }

        try {
            // Используем модель ContactMessage
            $ref = ContactMessage::create([
                'name'    => $input['name'],
                'email'   => $input['email'],
                'phone'   => $input['phone'] ?? '',
                'topic'   => $input['topic'] ?? 'general',
                'message' => $input['message']
            ]);

            Response::json([
                'status' => 'ok', 
                'message' => 'Ձեր նամակը հաջողությամբ ուղարկվեց:', // Success message
                'reference' => $ref
            ]);

        } catch (\Exception $e) {
            error_log("Contact Error: " . $e->getMessage());
            Response::json(['status' => 'error', 'message' => 'Սերվերի սխալ'], 500);
        }
    }
}