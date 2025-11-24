<?php
declare(strict_types=1);
namespace App\Controllers;
use Core\Controller;
use Core\View;
use App\Models\News;
class NewsController extends Controller {
    public function index(): void {
        $news = News::getAllPublished();
        View::render('news', ['news' => $news]);
    }
    public function show(string $slug): void {
        $news = News::getBySlug($slug);
        
        if (!$news) {
            http_response_code(404);
            View::render('404', [], 'main'); 
            return;
        }
        View::render('news-single', ['news' => $news]);
    }
}