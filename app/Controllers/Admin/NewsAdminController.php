<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

use Core\Controller;
use Core\View;
use Core\Response;
use App\Models\News;
use App\Services\UploaderService;

class NewsAdminController extends Controller {
    public function index() {
        $filters = [
            'search' => $_GET['search'] ?? '',
            'status' => $_GET['status'] ?? 'all'
        ];
        $allNews = News::getAll(); 
        $news = array_filter($allNews, function($n) use ($filters) {
            if (!empty($filters['search'])) {
                if (stripos($n['title_hy'], $filters['search']) === false) return false;
            }
            if ($filters['status'] === 'published' && !$n['is_published']) return false;
            if ($filters['status'] === 'draft' && $n['is_published']) return false;
            
            return true;
        });

        View::render('admin/news/index', [
            'news' => $news,
            'filters' => $filters
        ], 'admin_layout');
    }
    public function create() {
        View::render('admin/news/create', [], 'admin_layout');
    }
    public function store() {
        $data = $_POST;   
        if (empty($data['title_hy']) || empty($data['slug'])) {
            die("Ошибка: Заголовок (HY) и Slug обязательны");
        }
        $imageUrl = null;
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            try {
                $uploader = new UploaderService();
                $imageUrl = $uploader->upload($_FILES['image'], 'news/'); 
            } catch (\Exception $e) {
                error_log("Ошибка загрузки изображения: " . $e->getMessage());
                die("Ошибка загрузки изображения: " . $e->getMessage());
            }
        }
        $publishedAt = !empty($data['published_at']) ? $data['published_at'] : date('Y-m-d');

        $newsData = [
            'slug'         => $this->slugify($data['slug']),
            'title_hy'     => $data['title_hy'],
            'title_en'     => $data['title_en'] ?? '',
            'excerpt_hy'   => $data['excerpt_hy'] ?? '',
            'excerpt_en'   => $data['excerpt_en'] ?? '',
            'body_hy'      => $data['body_hy'] ?? '',
            'body_en'      => $data['body_en'] ?? '',
            'image_url'    => $imageUrl,
            'is_published' => isset($data['is_published']) ? 1 : 0,
            'published_at' => $publishedAt 
        ];

        if (News::create($newsData)) {
            Response::redirect('admin/news');
        } else {
            die("Ошибка при сохранении в БД");
        }
    }
    public function edit(string $id) {
        $news = News::getById((int)$id);
        if (!$news) {
            die("Новость не найдена");
        }
        View::render('admin/news/edit', ['news' => $news], 'admin_layout');
    }
    public function update(string $id) {
        $data = $_POST;
        $newsId = (int)$id;
        
        if (empty($data['title_hy']) || empty($data['slug'])) {
            die("Ошибка: Заголовок обязателен");
        }

        $imageUrl = null;
        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            try {
                $uploader = new UploaderService();
                $imageUrl = $uploader->upload($_FILES['image'], 'news/');
            } catch (\Exception $e) {
                error_log("Ошибка обновления изображения: " . $e->getMessage());
                die("Ошибка обновления изображения: " . $e->getMessage());
            }
        }
        $publishedAt = !empty($data['published_at']) ? $data['published_at'] : date('Y-m-d');
        $updateData = [
            'slug'         => $this->slugify($data['slug']),
            'title_hy'     => $data['title_hy'],
            'title_en'     => $data['title_en'] ?? '',
            'excerpt_hy'   => $data['excerpt_hy'] ?? '',
            'excerpt_en'   => $data['excerpt_en'] ?? '',
            'body_hy'      => $data['body_hy'] ?? '',
            'body_en'      => $data['body_en'] ?? '',
            'image_url'    => $imageUrl, 
            'is_published' => isset($data['is_published']) ? 1 : 0,
            'published_at' => $publishedAt 
        ];

        if (News::update($newsId, $updateData)) {
            Response::redirect('admin/news');
        } else {
            die("Ошибка при обновлении");
        }
    }
    public function delete(string $id) {
        News::delete((int)$id);
        Response::redirect('admin/news');
    }
    private function slugify(string $text): string {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        return strtolower($text);
    }
}