<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use Core\Controller;
use Core\View;
use Core\Response;
use App\Models\ContactMessage;

class MessagesController extends Controller {
    public function index() {
        $filters = [
            'status' => $_GET['status'] ?? 'all',
            'search' => $_GET['search'] ?? ''
        ];
        $messages = ContactMessage::getAll($filters);
        $counts = [
            'new'       => count(ContactMessage::getAll(['status' => 'new'])),
            'processed' => count(ContactMessage::getAll(['status' => 'processed'])),
            'all'       => count(ContactMessage::getAll())
        ];
        View::render('admin/messages/index', [
            'messages' => $messages,
            'filters'  => $filters,
            'counts'   => $counts
        ], 'admin_layout');
    }
    public function show(string $id) {
        $msg = ContactMessage::getById((int)$id);
        
        if (!$msg) {
            die("Message not found");
        }
        if ($msg['status'] === 'new') {
            ContactMessage::markAsRead((int)$id);
            $msg['status'] = 'processed';
        }
        View::render('admin/messages/show', ['msg' => $msg], 'admin_layout');
    }
    public function delete(string $id) {
        ContactMessage::delete((int)$id);
        Response::redirect('admin/messages');
    }
}   