<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use Core\Controller;
use Core\View;
use Core\Response;
use App\Models\Event;
use App\Services\UploaderService;

class EventsAdminController extends Controller {
    
    public function index() {
        $events = Event::getAll();
        View::render('admin/events/index', ['events' => $events], 'admin_layout');
    }

    public function create() {
        View::render('admin/events/create', [], 'admin_layout');
    }

    public function store() {
        $data = $_POST;
        
        if (empty($data['title_hy']) || empty($data['event_date'])) {
            die("Заголовок и Дата обязательны");
        }

        $imageUrl = null;
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            try {
                $uploader = new UploaderService();
                $imageUrl = $uploader->upload($_FILES['image'], 'events/');
            } catch (\Exception $e) { /* Log error */ }
        }

        $data['image_url'] = $imageUrl;

        if (Event::create($data)) {
            Response::redirect('admin/events');
        }
    }
    public function edit(string $id) {
        $event = Event::getById((int)$id);
        if (!$event) {
            die("Event not found");
        }
        View::render('admin/events/edit', ['event' => $event], 'admin_layout');
    }
    public function update(string $id) {
        $data = $_POST;
        $id = (int)$id;

        if (empty($data['title_hy']) || empty($data['event_date'])) {
            die("Заголовок и Дата обязательны");
        }

        $imageUrl = null;
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            try {
                $uploader = new UploaderService();
                $imageUrl = $uploader->upload($_FILES['image'], 'events/');
            } catch (\Exception $e) { /* Log error */ }
        }

        if ($imageUrl) {
            $data['image_url'] = $imageUrl;
        }

        if (Event::update($id, $data)) {
            Response::redirect('admin/events');
        } else {
            die("Error updating event");
        }
    }

    public function delete(string $id) {
        Event::delete((int)$id);
        Response::redirect('admin/events');
    }
}