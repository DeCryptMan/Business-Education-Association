<?php
namespace App\Controllers;
use Core\Controller;
use Core\View;

class ApplyController extends Controller {
    public function mentorForm() {
        View::render('apply-mentor');
    }
    public function menteeForm() {
        View::render('apply-mentee');
    }
}