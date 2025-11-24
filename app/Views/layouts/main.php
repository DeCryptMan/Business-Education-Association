<?php 
use Core\Url; 
use Core\Lang; 

// --- ԼՈԳԻԿԱ ԼՈԳՈՆԵՐԻ ՀԱՄԱՐ ---
$lang = Lang::current();
$mainLogo = ($lang === 'en') ? 'logo-en.png' : 'logo-am.png';

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($requestUri, PHP_URL_PATH);
$base = Url::base();

if ($base !== '' && str_starts_with($path, $base)) {
    $path = substr($path, strlen($base));
}
$path = trim($path, '/');

$showSecondLogo = ($path === '' || $path === 'index.php' || $path === 'mentors');
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8" />
    <title><?= __('app.name', 'Business & Education Association') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= Url::asset('css/style.css') ?>" />

    <style>
        /* --- CORPORATE HEADER SYSTEM --- */
        :root {
            --nav-blue: #253894;
            --nav-blue-dark: #162055;
            --nav-green: #63A900;
            --nav-text: #0f172a;
            --nav-gray: #64748b;
            --h-topbar: 48px;
            --h-navbar: 84px;
            --h-scrolled: 70px;
        }

        body { font-family: 'Inter', sans-serif; }

        /* 1. TOP BAR */
        .nf-topbar {
            height: var(--h-topbar);
            background-color: var(--nav-blue);
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.815rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            position: relative;
            z-index: 1050;
        }
        .nf-top-link {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            display: flex; align-items: center; gap: 8px;
            transition: color 0.2s;
        }
        .nf-top-link:hover { color: #fff; }
        .nf-top-divider {
            width: 1px; height: 16px; background: rgba(255, 255, 255, 0.15); margin: 0 16px;
        }

        /* 2. MAIN HEADER */
        .nf-header {
            height: var(--h-navbar);
            background: #fff;
            position: sticky;
            top: 0; z-index: 1040;
            border-bottom: 1px solid rgba(0,0,0,0.04);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            width: auto;
            font-size: 15px;
        }
        .nf-header.scrolled {
            height: var(--h-scrolled);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 30px rgba(37, 56, 148, 0.08);
        }

        .nf-brand img {
            height: 48px; width: auto; transition: height 0.3s;
        }
        .nf-header.scrolled .nf-brand img { height: 40px; }

        .nf-logo-secondary {
            height: 42px; width: auto; transition: height 0.3s;
            border-left: 1px solid #e2e8f0; padding-left: 15px;
            margin-left: 5px;
        }
        .nf-header.scrolled .nf-logo-secondary { height: 35px; }

        /* Navigation Items */
        .nf-head-link {
            color: var(--nav-text);
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            padding: 28px 4px;
            margin: 0 14px;
            position: relative;
            transition: color 0.3s;
            white-space: nowrap;
        }
        .nf-head-link::before {
            content: '';
            position: absolute; bottom: 20px; left: 0; width: 100%; height: 2px;
            background: var(--nav-green);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .nf-head-link:hover { color: var(--nav-blue); }
        
        .nf-head-link:hover::before, 
        .nf-head-link.active::before {
            transform: scaleX(1);
            transform-origin: left;
        }
        html[lang="hy"] .nf-head-link {
            font-size: 0.85rem;
            margin: 0 8px;
            padding: 28px 2px;
        }

        .btn-header-cta {
            background: var(--nav-blue);
            color: #fff;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(37, 56, 148, 0.2);
        }
        .btn-header-cta:hover {
            background: var(--nav-blue-dark);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 56, 148, 0.3);
        }

        .lang-switch a {
            font-size: 0.75rem; font-weight: 800; letter-spacing: 0.05em;
            padding: 4px 8px; border-radius: 6px;
            color: rgba(255,255,255,0.7); text-decoration: none;
            transition: all 0.2s;
        }
        .lang-switch a.active {
            background: rgba(255,255,255,0.15); color: #fff;
        }
        .lang-switch a:hover:not(.active) { color: #fff; }

        .nf-burger {
            border: none; background: none; padding: 0; width: 30px; height: 20px;
            position: relative; cursor: pointer; z-index: 2001;
        }
        .nf-burger span {
            position: absolute; left:0; width: 100%; height: 2px;
            background: var(--nav-blue); transition: 0.3s; border-radius: 4px;
        }
        .nf-burger span:nth-child(1) { top: 0; }
        .nf-burger span:nth-child(2) { top: 9px; }
        .nf-burger span:nth-child(3) { top: 18px; }
        
        /* --- MOBILE MENU FIX --- */
        .nf-mobile-drawer {
            position: fixed; top: 0; right: 0; bottom: 0;
            width: 100%; max-width: 320px;
            background: #fff;
            box-shadow: -10px 0 40px rgba(0,0,0,0.1);
            z-index: 2000;
            transform: translateX(100%);
            transition: transform 0.4s cubic-bezier(0.77, 0, 0.175, 1);
            display: flex; flex-direction: column;
            padding: 80px 30px 40px;
            
            /* SCROLL FIX */
            overflow-y: auto; /* Включаем вертикальный скролл */
            -webkit-overflow-scrolling: touch; /* Плавный скролл на iOS */
            max-height: 100vh; /* Ограничиваем высоту экраном */
        }
        .nf-mobile-drawer.open { transform: translateX(0); }
        
        .nf-backdrop {
            position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px); z-index: 1999;
            opacity: 0; visibility: hidden; transition: all 0.4s;
        }
        .nf-backdrop.open { opacity: 1; visibility: visible; }

        .mobile-link {
            font-size: 1.25rem; font-weight: 700; color: var(--nav-text);
            text-decoration: none; padding: 15px 0; border-bottom: 1px solid rgba(0,0,0,0.05);
            display: block; transition: color 0.2s;
            flex-shrink: 0; /* Чтобы ссылки не сжимались */
        }
        .mobile-link:hover { color: var(--nav-blue); padding-left: 10px; }
    </style>
</head>
<body class="nf-body">

<div class="nf-topbar d-none d-lg-flex">
    <div class="container-lg d-flex justify-content-between h-100">
        <div class="d-flex align-items-center">
            <a href="mailto:info@bea.am" class="nf-top-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                <span style="font-family: monospace, sans-serif;">info@bea.am</span>
            </a>
            <div class="nf-top-divider"></div>
            <a href="tel:+37411528112" class="nf-top-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.05 12.05 0 0 0 .57 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.05 12.05 0 0 0 2.81.57A2 2 0 0 1 22 16.92z"/></svg>
                +374 (11) 52 81 12
            </a>
        </div>

        <div class="d-flex align-items-center">
            <div class="lang-switch d-flex">
                <a href="<?= Url::to('lang/hy') ?>" class="<?= Lang::current() === 'hy' ? 'active' : '' ?>">HY</a>
                <a href="<?= Url::to('lang/en') ?>" class="<?= Lang::current() === 'en' ? 'active' : '' ?>">EN</a>
            </div>
            <div class="nf-top-divider"></div>
            
            <a href="<?= Url::to('login') ?>" class="nf-top-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
                <span class="d-none d-xl-inline ms-1"><?= __('nav.login') ?></span>
            </a>
        </div>
    </div>
</div>

<header class="nf-header" id="nf-header">
    <div class="container-lg h-100">
        <div class="d-flex justify-content-between align-items-center h-100">
            
            <div class="d-flex align-items-center">
                <a href="<?= Url::to('/') ?>" class="nf-brand d-flex align-items-center text-decoration-none">
                    <img src="<?= Url::asset('img/' . $mainLogo) ?>" alt="BEA Logo" width="160" height="48" style="object-fit: contain;">
                </a>
                
                <?php if($showSecondLogo): ?>
                    <img src="<?= Url::asset('img/mentoring-program-en.png') ?>" alt="Mentoring Program" width="140" height="42" class="nf-logo-secondary d-none d-md-block" style="object-fit: contain;">
                <?php endif; ?>
            </div>

            <nav class="d-none d-lg-flex align-items-center">
                <a href="<?= Url::to('/') ?>" class="nf-head-link"><?= __('nav.home') ?></a>
                <a href="<?= Url::to('mentors') ?>" class="nf-head-link"><?= __('nav.mentors', 'Մենթորներ') ?></a>
                <a href="<?= Url::to('/#program') ?>" class="nf-head-link"><?= __('nav.program') ?></a>
                <a href="<?= Url::to('news') ?>" class="nf-head-link"><?= __('nav.news') ?></a>
                <a href="<?= Url::to('about') ?>" class="nf-head-link"><?= __('nav.about') ?></a>
                <a href="<?= Url::to('contact') ?>" class="nf-head-link"><?= __('nav.contact') ?></a>
                <a href="<?= Url::to('events') ?>" class="nf-head-link"><?= __('nav.events', 'Միջոցառումներ') ?></a>
            </nav>

            <div class="d-flex align-items-center gap-3">
                <a href="<?= Url::to('/#apply') ?>" class="btn-header-cta d-none d-sm-inline-flex">
                    <?= __('nav.apply_cta') ?>
                </a>
                <button class="nf-burger d-lg-none" id="nf-burger" aria-label="Menu" aria-controls="nf-mobile-drawer" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>
            </div>

        </div>
    </div>
</header>

<div class="nf-backdrop" id="nf-backdrop"></div>
<div class="nf-mobile-drawer" id="nf-mobile-drawer">
    <div class="d-flex justify-content-between align-items-center mb-5 flex-shrink-0">
        <span class="fw-bold text-uppercase text-muted small ls-1"><?= __('nav.menu') ?></span>
        <button class="btn-close" id="nf-menu-close" aria-label="Close Menu"></button>
    </div>
    
    <nav class="d-flex flex-column gap-2 flex-grow-1">
        <a href="<?= Url::to('/') ?>" class="mobile-link"><?= __('nav.home') ?></a>
        <a href="<?= Url::to('mentors') ?>" class="mobile-link"><?= __('nav.mentors', 'Մենթորներ') ?></a>
        <a href="<?= Url::to('/#program') ?>" class="mobile-link"><?= __('nav.program') ?></a>
        <a href="<?= Url::to('news') ?>" class="mobile-link"><?= __('nav.news') ?></a>
        <a href="<?= Url::to('about') ?>" class="mobile-link"><?= __('nav.about') ?></a>
        <a href="<?= Url::to('contact') ?>" class="mobile-link"><?= __('nav.contact') ?></a>
        <a href="<?= Url::to('events') ?>" class="mobile-link"><?= __('nav.events', 'Միջոցառումներ') ?></a>
    </nav>

    <div class="mt-4 flex-shrink-0 pb-4">
        <a href="<?= Url::to('/#apply') ?>" class="btn btn-primary w-100 rounded-pill py-3 fw-bold mb-4" style="background: #253894; border:none;">
            <?= __('nav.apply_cta') ?>
        </a>
        <div class="d-flex justify-content-center gap-4 border-top pt-4">
            <a href="<?= Url::to('lang/hy') ?>" class="text-dark fw-bold text-decoration-none">HY</a>
            <a href="<?= Url::to('lang/en') ?>" class="text-muted text-decoration-none">EN</a>
        </div>
    </div>
</div>

<main class="nf-main-content">
    <?= $content; ?>
</main>

<?php require_once __DIR__ . '/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="<?= Url::asset('js/app.js') ?>" defer></script>
</body>
</html>