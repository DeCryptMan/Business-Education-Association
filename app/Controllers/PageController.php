<?php
namespace App\Controllers;
use Core\Controller;
use Core\View;
use App\Models\Mentor; 

class PageController extends Controller {
    
    public function about() {
        View::render('about');
    }
    
    public function contact() {
        View::render('contact');
    }
    public function mentors() {
        $mentors = Mentor::getAll(['status' => 'approved']);
        View::render('mentors', ['mentors' => $mentors]);
    }
}