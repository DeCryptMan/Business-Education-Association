<?php 
use Core\Url;
use Core\Lang; 
use Core\Auth;

// Հելփեր ակտիվ մենյուն ընդգծելու համար
function isActive($path) {
    $current = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    // Հեռացնում ենք բազային ճանապարհը, եթե կա
    $base = Core\Url::base();
    if ($base && str_starts_with($current, $base)) {
        $current = substr($current, strlen($base));
    }
    $current = ltrim($current, '/');
    
    if ($path === 'admin' && ($current === 'admin' || $current === 'admin/')) return 'active';
    if ($path !== 'admin' && str_starts_with($current, $path)) return 'active';
    return '';
}
?>
<!DOCTYPE html>
<html lang="<?= Lang::current() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Ադմին Վահանակ — ԲԿԱ Միություն</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 280px;
            --header-height: 70px;
            --bg-body: #f8fafc;
            --bg-sidebar: #0f172a;
            --text-sidebar: #94a3b8;
            --text-sidebar-active: #ffffff;
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --sidebar-item-hover: rgba(255,255,255,0.05);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* --- SIDEBAR --- */
        .nf-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            color: var(--text-sidebar);
            z-index: 1040;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        /* Mobile: Hide sidebar by default */
        @media (max-width: 991.98px) {
            .nf-sidebar { transform: translateX(-100%); }
            .nf-sidebar.show { transform: translateX(0); }
        }

        .nf-brand {
            height: var(--header-height);
            display: flex; align-items: center; padding: 0 24px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            text-decoration: none; color: #fff; gap: 12px;
        }
        .nf-brand-logo {
            width: 36px; height: 36px; background: var(--primary);
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: #fff;
        }
        .nf-brand-text { font-weight: 700; font-size: 1.1rem; letter-spacing: -0.5px; }

        .nf-sidebar-content {
            flex-grow: 1; overflow-y: auto; padding: 20px 12px;
            scrollbar-width: thin; scrollbar-color: #334155 transparent;
        }

        .nf-menu-label {
            font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px;
            color: #475569; font-weight: 700; margin: 20px 12px 8px;
        }

        .nf-nav-link {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 16px; border-radius: 10px;
            color: var(--text-sidebar); text-decoration: none;
            font-weight: 500; transition: all 0.2s;
            margin-bottom: 2px;
        }
        .nf-nav-link:hover {
            background: var(--sidebar-item-hover); color: #fff;
        }
        .nf-nav-link.active {
            background: var(--primary); color: #fff;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        .nf-nav-icon { width: 20px; height: 20px; stroke-width: 2; }

        /* --- MAIN CONTENT WRAPPER --- */
        .nf-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex; flex-direction: column;
            transition: margin-left 0.3s ease;
        }
        @media (max-width: 991.98px) {
            .nf-main { margin-left: 0; }
        }

        /* --- HEADER --- */
        .nf-header {
            height: var(--header-height);
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 24px;
            position: sticky; top: 0; z-index: 1020;
        }
        
        .nf-toggle-btn {
            background: none; border: none; padding: 8px;
            color: #334155; cursor: pointer; border-radius: 8px;
        }
        .nf-toggle-btn:hover { background: #f1f5f9; }

        /* --- CONTENT BODY --- */
        .nf-content { padding: 30px; flex-grow: 1; }
        @media (max-width: 768px) { .nf-content { padding: 20px 16px; } }

        /* --- OVERLAY --- */
        .nf-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); z-index: 1030;
            opacity: 0; visibility: hidden; transition: all 0.3s;
        }
        .nf-overlay.show { opacity: 1; visibility: visible; }

        /* Footer User */
        .nf-user-menu {
            padding: 16px 20px; border-top: 1px solid rgba(255,255,255,0.05);
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(0,0,0,0.2);
        }
        .nf-user-info { display: flex; align-items: center; gap: 10px; }
        .nf-avatar {
            width: 32px; height: 32px; border-radius: 50%; background: #475569;
            color: #fff; display: flex; align-items: center; justify-content: center; font-size: 0.85rem;
        }
        .nf-username { font-size: 0.9rem; font-weight: 600; color: #fff; }
        .nf-role { font-size: 0.75rem; color: #64748b; }
        
        .nf-logout { color: #ef4444; transition: 0.2s; cursor: pointer; background: none; border: none;}
        .nf-logout:hover { color: #f87171; transform: scale(1.1); }

    </style>
</head>
<body>

    <div class="nf-overlay" id="sidebarOverlay"></div>

    <aside class="nf-sidebar" id="sidebar">
        <a href="<?= Url::to('admin') ?>" class="nf-brand">
            <div class="nf-brand-logo">ԲԿ</div>
            <div class="nf-brand-text">Ադմին Վահանակ</div>
        </a>

        <nav class="nf-sidebar-content">
            <div class="nf-menu-label">Ընդհանուր</div>
            <a href="<?= Url::to('admin') ?>" class="nf-nav-link <?= isActive('admin') ?>">
                <svg class="nf-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                <span>Կառավարման վահանակ</span>
            </a>

            <div class="nf-menu-label">Հայտեր</div>
            <a href="<?= Url::to('admin/mentors') ?>" class="nf-nav-link <?= isActive('admin/mentors') ?>">
                <svg class="nf-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <span>Մենթորներ</span>
            </a>
            <a href="<?= Url::to('admin/mentees') ?>" class="nf-nav-link <?= isActive('admin/mentees') ?>">
                <svg class="nf-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <span>Մենթիներ</span>
            </a>

            <div class="nf-menu-label">Հաղորդակցություն</div>
            <a href="<?= Url::to('admin/messages') ?>" class="nf-nav-link <?= isActive('admin/messages') ?>">
                <svg class="nf-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                <span>Նամակներ</span>
            </a>

            <div class="nf-menu-label">Բովանդակություն</div>
            <a href="<?= Url::to('admin/news') ?>" class="nf-nav-link <?= isActive('admin/news') ?>">
                <svg class="nf-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v1m2 13a2 2 0 0 1-2-2V7m2 13a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                <span>Նորություններ</span>
            </a>
                    <a href="<?= Url::to('admin/events') ?>" class="nf-nav-link">
            <span>📅 Միջոցառումներ</span>
        </a>
        </nav>

        <div class="nf-user-menu">
            <div class="nf-user-info">
                <div class="nf-avatar">Ա</div>
                <div>
                    <div class="nf-username">Ադմինիստրատոր</div>
                    <div class="nf-role">Գլխավոր Ադմին</div>
                </div>
            </div>
            <form action="<?= Url::to('logout') ?>" method="POST" style="margin:0;">
                <button type="submit" class="nf-logout" title="Ելք">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                </button>
            </form>
        </div>
    </aside>

    <div class="nf-main">
        <header class="nf-header">
            <button class="nf-toggle-btn d-lg-none" id="sidebarToggle">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </button>
            
            <div class="d-flex align-items-center gap-3">
                <a href="<?= Url::to('/') ?>" target="_blank" class="btn btn-sm btn-outline-secondary d-none d-md-inline-flex align-items-center gap-2">
                    <span>🌐</span> Անցնել կայք
                </a>
            </div>
        </header>

        <div class="nf-content">
            <?php echo $content; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Բջջային կողային վահանակի տրամաբանությունը
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        if(toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
        if(overlay) overlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>