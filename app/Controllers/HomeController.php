<?php
declare(strict_types=1);
namespace App\Controllers;
use Core\Controller;
use Core\View;
use App\Models\News;
use App\Models\Mentor;
use App\Models\Mentee;
use App\Models\Event;
class HomeController extends Controller {
    public function index() {
        $news = News::getLatest(3);
        $upcomingEvents = [];
        try {
            $upcomingEvents = Event::getUpcoming(3);
        } catch (\Throwable $e) {
        }
        try {
            $stats = [
                'mentors' => Mentor::count(),
                'mentees' => Mentee::count(),
            ];
        } catch (\Throwable $e) {
            $stats = ['mentors' => 0, 'mentees' => 0];
        }
        View::render('home', [
            'news'  => $news,
            'events' => $upcomingEvents,
            'stats' => $stats
        ]);
    }
}