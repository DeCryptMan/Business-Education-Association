<?php use Core\Url; ?>

<style>
    /* Переопределяем активный цвет для Менторов (Синий) */
    .nf-tab-link.active { color: #3b82f6; border-bottom-color: #3b82f6; }
    /* Используем те же стили, что выше, они глобальные или скопированы */
    .nf-card-shell { background: #fff; border-radius: 16px; border: 1px solid rgba(0,0,0,0.04); overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    .nf-header-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 10px; }
    .nf-page-title { font-weight: 700; font-size: 1.5rem; color: #1e293b; margin: 0; }
    
    .nf-tabs-scroller { overflow-x: auto; white-space: nowrap; border-bottom: 1px solid #e2e8f0; padding: 0 20px; }
    .nf-tab-link { display: inline-block; padding: 12px 20px; text-decoration: none; color: #64748b; font-weight: 600; border-bottom: 2px solid transparent; }
    .nf-tab-link:hover { color: #0f172a; }
    .nf-badge-count { background: #f1f5f9; color: #475569; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem; margin-left: 6px; }

    .nf-filters { padding: 20px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; }
    .nf-search-input { border-radius: 10px; border: 1px solid #e2e8f0; padding: 10px 15px 10px 40px; width: 100%; }
    
    .nf-table { width: 100%; border-collapse: collapse; }
    .nf-table th { padding: 16px 20px; background: #fff; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; border-bottom: 1px solid #e2e8f0; }
    .nf-table td { padding: 16px 20px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .nf-table tr:hover td { background: #f8fafc; }

    /* Badges */
    .nf-status { display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
    .dot { width: 6px; height: 6px; border-radius: 50%; }
    .st-new { background: #eff6ff; color: #2563eb; } .st-new .dot { background: #2563eb; }
    .st-approved { background: #ecfdf5; color: #059669; } .st-approved .dot { background: #059669; }
    .st-rejected { background: #fef2f2; color: #dc2626; } .st-rejected .dot { background: #dc2626; }

    /* Mobile */
    @media (max-width: 768px) {
        .nf-header-row { flex-direction: column; align-items: flex-start; }
        .nf-header-actions { width: 100%; display: flex; }
        .nf-header-actions .btn { flex: 1; }
        
        .nf-table thead { display: none; }
        .nf-table tr { display: block; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 15px; }
        .nf-table td { display: flex; justify-content: space-between; align-items: center; padding: 12px 15px; text-align: right; }
        .nf-table td::before { content: attr(data-label); float: left; font-weight: 600; color: #64748b; }
        .nf-table td:first-child { display: block; background: #f8fafc; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .nf-table td:last-child { justify-content: flex-end; }
    }
</style>

<div class="nf-header-row">
    <div>
        <h1 class="nf-page-title">👨‍🏫 Մենթորներ (Mentors)</h1>
        <p class="text-muted small mb-0">Մենթորների հայտերի կառավարում</p>
    </div>
    <div class="nf-header-actions">
        <a href="<?= Url::to('admin/mentors/export') . '?' . http_build_query($_GET) ?>" class="btn btn-light border shadow-sm text-primary fw-medium">
            📥 Export
        </a>
    </div>
</div>

<div class="nf-card-shell">
    
    <div class="nf-tabs-scroller">
        <?php 
            $tabs = ['new'=>'Նոր','approved'=>'Հաստատված','rejected'=>'Մերժված','all'=>'Բոլորը'];
            foreach($tabs as $k=>$l): $active = ($filters['status'] === $k);
        ?>
        <a href="<?= Url::to('admin/mentors?status=' . $k) ?>" class="nf-tab-link <?= $active ? 'active' : '' ?>">
            <?= $l ?> <span class="nf-badge-count"><?= $counts[$k] ?? 0 ?></span>
        </a>
        <?php endforeach; ?>
    </div>

    <form action="<?= Url::to('admin/mentors') ?>" method="GET" class="nf-filters">
        <input type="hidden" name="status" value="<?= htmlspecialchars($filters['status']) ?>">
        <div class="row g-2">
            <div class="col-12 col-md-6 col-lg-4">
                <input type="text" name="search" class="nf-search-input" placeholder="Որոնել (անուն, org...)" value="<?= htmlspecialchars($filters['search']) ?>">
            </div>
            <div class="col-6 col-md-3">
                <button type="submit" class="btn btn-primary w-100 rounded-3">Փնտրել</button>
            </div>
        </div>
    </form>

    <?php if(empty($mentors)): ?>
        <div class="text-center py-5 text-muted">Տվյալներ չկան</div>
    <?php else: ?>
        <table class="nf-table">
            <thead>
                <tr>
                    <th>Մենթոր</th>
                    <th>Կազմակերպություն</th>
                    <th>Կոնտակտ</th>
                    <th>Կարգավիճակ</th>
                    <th class="text-end">Գործողություն</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($mentors as $m): 
                    $ini = mb_substr($m['full_name'], 0, 2);
                    $stClass = match($m['status'] ?? 'new') { 'approved'=>'st-approved', 'rejected'=>'st-rejected', default=>'st-new' };
                ?>
                <tr>
                    <td data-label="Մենթոր">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width:40px; height:40px; font-weight:700;">
                                <?= strtoupper($ini) ?>
                            </div>
                            <div>
                                <div class="fw-bold text-dark"><?= htmlspecialchars($m['full_name']) ?></div>
                                <div class="small text-muted">ID: #<?= $m['id'] ?></div>
                            </div>
                        </div>
                    </td>
                    <td data-label="Կազմակերպություն">
                        <div class="fw-medium"><?= htmlspecialchars($m['organization']) ?></div>
                        <div class="small text-muted"><?= htmlspecialchars($m['position']) ?></div>
                    </td>
                    <td data-label="Կոնտակտ">
                        <div class="small"><?= htmlspecialchars($m['email']) ?></div>
                        <div class="small text-muted"><?= htmlspecialchars($m['phone']) ?></div>
                    </td>
                    <td data-label="Կարգավիճակ">
                        <span class="nf-status <?= $stClass ?>">
                            <span class="dot"></span> <?= ucfirst($m['status'] ?? 'new') ?>
                        </span>
                    </td>
                    <td data-label="">
                        <a href="<?= Url::to('admin/mentors/' . $m['id']) ?>" class="btn btn-sm btn-outline-primary px-3 rounded-pill">Դիտել</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>