<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use Core\View;
use App\Models\Event;

class EventsController extends Controller {
    public function index() {
        $calendarData = Event::getForCalendar(); 
        View::render('events/calendar', [
            'calendarData' => $calendarData
        ]);
    }
    public function show(string $id) {
        $event = Event::getById((int)$id);
        
        if (!$event) {
            http_response_code(404);
            echo "Event not found";
            return;
        }

        View::render('events/show', [
            'event' => $event
        ]);
    }
}