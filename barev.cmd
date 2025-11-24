@echo off
echo Creating advanced PHP MVC framework structure...

REM ===== ROOT FILES =====
type nul > index.php
type nul > .htaccess

REM ===== CONFIG =====
mkdir config
type nul > config\config.php
type nul > config\database.php

REM ===== CORE (Framework Kernel) =====
mkdir core
type nul > core\Auth.php
type nul > core\Controller.php
type nul > core\Database.php
type nul > core\Request.php
type nul > core\Response.php
type nul > core\Router.php
type nul > core\View.php

REM ===== APP (Controllers, Models, Views) =====
mkdir app
mkdir app\Controllers
mkdir app\Controllers\Admin
mkdir app\Controllers\Api
mkdir app\Models
mkdir app\Views
mkdir app\Views\admin
mkdir app\Views\layouts
mkdir app\Views\emails

REM ===== APP CONTROLLERS =====
type nul > app\Controllers\AuthController.php
type nul > app\Controllers\HomeController.php
type nul > app\Controllers\PageController.php

REM Admin controllers placeholder
type nul > app\Controllers\Admin\.gitkeep

REM API controllers placeholder
type nul > app\Controllers\Api\.gitkeep

REM ===== MODELS =====
type nul > app\Models\ContactMessage.php
type nul > app\Models\Mentee.php
type nul > app\Models\Mentor.php
type nul > app\Models\News.php
type nul > app\Models\User.php

REM ===== VIEWS =====
type nul > app\Views\about.php
type nul > app\Views\contact.php
type nul > app\Views\home.php
type nul > app\Views\login.php
type nul > app\Views\news-single.php

REM Layouts, admin, emails placeholders
type nul > app\Views\layouts\.gitkeep
type nul > app\Views\admin\.gitkeep
type nul > app\Views\emails\.gitkeep

REM ===== ASSETS (CSS / JS / IMG) =====
mkdir assets
mkdir assets\css
mkdir assets\js
mkdir assets\img

type nul > assets\css\style.css
type nul > assets\js\app.js

REM ===== DONE =====
echo Done! Advanced MVC framework created successfully!
pause
