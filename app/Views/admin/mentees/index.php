<?php use Core\Url; ?>

<style>
    /* --- RESPONSIVE DATA TABLE SYSTEM --- */
    .nf-card-shell {
        background: #fff; border-radius: 16px; border: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 2px 12px rgba(0,0,0,0.02); overflow: hidden;
    }

    /* Header & Tabs */
    .nf-header-row {
        display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 20px;
    }
    .nf-page-title { font-weight: 700; font-size: 1.5rem; color: #1e293b; margin: 0; }
    
    .nf-tabs-scroller {
        overflow-x: auto; white-space: nowrap; -webkit-overflow-scrolling: touch;
        border-bottom: 1px solid #e2e8f0; padding: 0 20px;
        margin-bottom: 0; /* fix */
    }
    .nf-tab-link {
        display: inline-block; padding: 12px 20px; text-decoration: none;
        color: #64748b; font-weight: 600; font-size: 0.9rem;
        border-bottom: 2px solid transparent; transition: all 0.2s;
    }
    .nf-tab-link:hover { color: #0f172a; }
    .nf-tab-link.active { color: #10b981; border-bottom-color: #10b981; }
    .nf-badge-count { 
        background: #f1f5f9; color: #475569; padding: 2px 8px; 
        border-radius: 12px; font-size: 0.75rem; margin-left: 6px;
    }
    
    /* Filters */
    .nf-filters { padding: 20px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; }
    .nf-search-input {
        border-radius: 10px; border: 1px solid #e2e8f0; padding: 10px 15px 10px 40px;
        width: 100%; font-size: 0.95rem; background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E") no-repeat 12px center;
    }
    
    /* Table Styling */
    .nf-table { width: 100%; border-collapse: collapse; }
    .nf-table th {
        text-align: left; padding: 16px 20px; background: #fff;
        color: #64748b; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;
        border-bottom: 1px solid #e2e8f0;
    }
    .nf-table td { padding: 16px 20px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; color: #334155; }
    .nf-table tr:last-child td { border-bottom: none; }
    .nf-table tr:hover td { background: #f8fafc; }

    /* Statuses */
    .nf-status { display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
    .nf-status-dot { width: 6px; height: 6px; border-radius: 50%; }
    
    .st-new { background: #eff6ff; color: #2563eb; } .st-new .dot { background: #2563eb; }
    .st-approved { background: #ecfdf5; color: #059669; } .st-approved .dot { background: #059669; }
    .st-rejected { background: #fef2f2; color: #dc2626; } .st-rejected .dot { background: #dc2626; }

    /* Mobile Optimization */
    @media (max-width: 768px) {
        .nf-header-row { flex-direction: column; align-items: flex-start; gap: 10px; }
        .nf-header-actions { width: 100%; display: flex; gap: 10px; }
        .nf-header-actions .btn { flex: 1; }
        
        /* Карточный вид на мобильном */
        .nf-table, .nf-table thead, .nf-table tbody, .nf-table th, .nf-table td, .nf-table tr { display: block; }
        .nf-table thead { display: none; }
        .nf-table tr { border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 15px; overflow: hidden; }
        .nf-table td { padding: 12px 15px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
        .nf-table td::before { content: attr(data-label); font-weight: 600; color: #64748b; font-size: 0.8rem; }
        .nf-table td:first-child { background: #f8fafc; border-bottom: 1px solid #e2e8f0; font-weight: 700; display: block; }
        .nf-table td:last-child { justify-content: flex-end; background: #fff; }
        .nf-hide-mobile { display: none; }
    }
</style>

<div class="nf-header-row">
    <div>
        <h1 class="nf-page-title">🎓 Մենթիներ (Mentees)</h1>
        <p class="text-muted small mb-0">Ուսանողների հայտերի կառավարում</p>
    </div>
    <div class="nf-header-actions">
        <a href="<?= Url::to('admin/mentees/export') . '?' . http_build_query($_GET) ?>" class="btn btn-light border shadow-sm text-success fw-medium">
            📥 Export
        </a>
    </div>
</div>

<div class="nf-card-shell">
    
    <div class="nf-tabs-scroller">
        <?php 
            $tabs = [
                'new' => 'Նոր (New)',
                'approved' => 'Հաստատված',
                'rejected' => 'Մերժված',
                'all' => 'Բոլորը'
            ];
            foreach($tabs as $key => $label): 
                $isActive = ($filters['status'] === $key);
        ?>
        <a href="<?= Url::to('admin/mentees?status=' . $key) ?>" class="nf-tab-link <?= $isActive ? 'active' : '' ?>">
            <?= $label ?> <span class="nf-badge-count"><?= $counts[$key] ?? 0 ?></span>
        </a>
        <?php endforeach; ?>
    </div>

    <form action="<?= Url::to('admin/mentees') ?>" method="GET" class="nf-filters">
        <input type="hidden" name="status" value="<?= htmlspecialchars($filters['status']) ?>">
        
        <div class="row g-2">
            <div class="col-12 col-md-6 col-lg-4">
                <input type="text" name="search" class="nf-search-input" placeholder="Որոնել (անուն, email, հեռ)..." value="<?= htmlspecialchars($filters['search']) ?>">
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <select name="period" class="form-select border-200 rounded-3" onchange="this.form.submit()">
                    <option value="all">📅 Բոլորը</option>
                    <option value="30days" <?= $filters['period'] === '30days' ? 'selected' : '' ?>>Վերջին 30 օրը</option>
                </select>
            </div>
            <div class="col-6 col-md-3 col-lg-2">
                <button type="submit" class="btn btn-primary w-100 rounded-3">Փնտրել</button>
            </div>
        </div>
    </form>

    <?php if(empty($mentees)): ?>
        <div class="text-center py-5">
            <div class="fs-1 text-muted mb-2">📂</div>
            <p class="text-muted">Տվյալներ չեն գտնվել</p>
        </div>
    <?php else: ?>
        <table class="nf-table">
            <thead>
                <tr>
                    <th>Ուսանող</th>
                    <th>Կոնտակտային</th>
                    <th>Կարգավիճակ</th>
                    <th>Ամսաթիվ</th>
                    <th class="text-end">Գործողություն</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($mentees as $m): 
                    $initials = mb_substr($m['full_name'], 0, 2);
                    $stClass = match($m['status'] ?? 'new') { 'approved'=>'st-approved', 'rejected'=>'st-rejected', default=>'st-new' };
                ?>
                <tr>
                    <td data-label="Ուսանող">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width:40px; height:40px; font-weight:700;">
                                <?= strtoupper($initials) ?>
                            </div>
                            <div>
                                <div class="fw-bold text-dark"><?= htmlspecialchars($m['full_name']) ?></div>
                                <div class="small text-muted">ID: #<?= $m['id'] ?></div>
                            </div>
                        </div>
                    </td>
                    <td data-label="Կոնտակտ">
                        <div class="small"><?= htmlspecialchars($m['email']) ?></div>
                        <div class="small text-muted"><?= htmlspecialchars($m['phone']) ?></div>
                    </td>
                    <td data-label="Կարգավիճակ">
                        <span class="nf-status <?= $stClass ?>">
                            <span class="nf-status-dot dot"></span> <?= ucfirst($m['status'] ?? 'new') ?>
                        </span>
                    </td>
                    <td data-label="Ամսաթիվ" class="text-muted small">
                        <?= date('d.m.y', strtotime($m['created_at'])) ?>
                    </td>
                    <td data-label="">
                        <a href="<?= Url::to('admin/mentees/' . $m['id']) ?>" class="btn btn-sm btn-outline-primary px-3 rounded-pill">
                            Դիտել
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>