<?php
// lb/routes/web.php

use App\Controllers\HomeController;
use App\Controllers\PageController;
use App\Controllers\ApplyController;
use App\Controllers\NewsController;
use App\Controllers\AuthController;
use App\Controllers\LanguageController;
use App\Controllers\EventsController;

// API Controllers
use App\Controllers\Api\ContactApiController;
use App\Controllers\Api\ApplyApiController;

// Admin Controllers
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\MentorsController;
use App\Controllers\Admin\MenteesController;
use App\Controllers\Admin\NewsAdminController;
use App\Controllers\Admin\MessagesController;
use App\Controllers\Admin\EventsAdminController;

// Middleware
use App\Middleware\AuthMiddleware;
use App\Middleware\CsrfMiddleware;

/** @var Core\Router $router */

// --- Public Pages ---
$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [PageController::class, 'about']);
$router->get('/contact', [PageController::class, 'contact']);
$router->get('/news', [NewsController::class, 'index']);
$router->get('/news/{slug}', [NewsController::class, 'show']);
$router->get('/lang/{lang}', [LanguageController::class, 'switch']);

// --- Forms Pages ---
$router->get('/apply/mentor', [ApplyController::class, 'mentorForm']);
$router->get('/apply/mentee', [ApplyController::class, 'menteeForm']);

// --- API Endpoints ---
$router->post('/backend/contact', [ContactApiController::class, 'submit'], [CsrfMiddleware::class]);
$router->post('/backend/mentor-profile', [ApplyApiController::class, 'submitMentor'], [CsrfMiddleware::class]);
$router->post('/backend/mentee-profile', [ApplyApiController::class, 'submitMentee'], [CsrfMiddleware::class]);

// --- Auth ---
$router->get('/login', [AuthController::class, 'loginForm']);
$router->post('/login', [AuthController::class, 'login'], [CsrfMiddleware::class]);
$router->post('/logout', [AuthController::class, 'logout']);

// --- ADMIN PANEL ---
$router->get('/admin', [DashboardController::class, 'index'], [AuthMiddleware::class]);

// 1. MENTORS
$router->get('/admin/mentors/export', [MentorsController::class, 'export'], [AuthMiddleware::class]);
$router->get('/admin/mentors', [MentorsController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/mentors/{id}', [MentorsController::class, 'show'], [AuthMiddleware::class]);
$router->post('/admin/mentors/{id}/status', [MentorsController::class, 'updateStatus'], [AuthMiddleware::class]);

// 2. MENTEES
$router->get('/admin/mentees/export', [MenteesController::class, 'export'], [AuthMiddleware::class]);
$router->get('/admin/mentees', [MenteesController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/mentees/{id}', [MenteesController::class, 'show'], [AuthMiddleware::class]);
$router->post('/admin/mentees/{id}/status', [MenteesController::class, 'updateStatus'], [AuthMiddleware::class]);

// 3. NEWS
$router->get('/admin/news', [NewsAdminController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/news/create', [NewsAdminController::class, 'create'], [AuthMiddleware::class]);
$router->post('/admin/news/store', [NewsAdminController::class, 'store'], [AuthMiddleware::class]);
$router->get('/admin/news/{id}/edit', [NewsAdminController::class, 'edit'], [AuthMiddleware::class]);
$router->post('/admin/news/{id}/update', [NewsAdminController::class, 'update'], [AuthMiddleware::class]);
$router->post('/admin/news/{id}/delete', [NewsAdminController::class, 'delete'], [AuthMiddleware::class]);

// 4. MESSAGES
$router->get('/admin/messages', [MessagesController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/messages/{id}', [MessagesController::class, 'show'], [AuthMiddleware::class]);
$router->post('/admin/messages/{id}/delete', [MessagesController::class, 'delete'], [AuthMiddleware::class]);

// 5. EVENTS
$router->get('/events', [EventsController::class, 'index']);
$router->get('/events/{id}', [EventsController::class, 'show']);
$router->get('/admin/events', [EventsAdminController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/events/create', [EventsAdminController::class, 'create'], [AuthMiddleware::class]);
$router->post('/admin/events/store', [EventsAdminController::class, 'store'], [AuthMiddleware::class]);
$router->get('/admin/events/{id}/edit', [EventsAdminController::class, 'edit'], [AuthMiddleware::class]);
$router->post('/admin/events/{id}/update', [EventsAdminController::class, 'update'], [AuthMiddleware::class]);
$router->post('/admin/events/{id}/delete', [EventsAdminController::class, 'delete'], [AuthMiddleware::class]);

// Pages
$router->get('/mentors', [PageController::class, 'mentors']);