<?php use Core\Url; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    :root {
        --d-bg: #f8fafc;
        --d-surface: #ffffff;
        --d-text: #0f172a;
        --d-muted: #64748b;
        --d-border: #e2e8f0;
        
        /* Professional Palette */
        --c-primary: #0f172a; /* Slate 900 */
        --c-accent: #0ea5e9;  /* Sky 500 */
        --c-success: #10b981; /* Emerald 500 */
        --c-danger: #ef4444;  /* Red 500 */
        --c-warning: #f59e0b; /* Amber 500 */
    }

    /* UTILS */
    .dash-card {
        background: var(--d-surface);
        border: 1px solid var(--d-border);
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        height: 100%;
        transition: box-shadow 0.2s;
    }
    .dash-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.06); }

    .d-grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 24px; }
    .d-grid-main { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; }
    
    @media (max-width: 1200px) { .d-grid-4 { grid-template-columns: repeat(2, 1fr); } .d-grid-main { grid-template-columns: 1fr; } }
    @media (max-width: 576px) { .d-grid-4 { grid-template-columns: 1fr; } }

    /* KPI STATS */
    .stat-row { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; }
    .stat-icon-box {
        width: 40px; height: 40px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: #fff;
    }
    .stat-value { font-size: 28px; font-weight: 700; color: var(--d-text); line-height: 1.1; margin-bottom: 4px; }
    .stat-label { font-size: 13px; font-weight: 600; color: var(--d-muted); text-transform: uppercase; letter-spacing: 0.5px; }
    
    .growth-tag {
        font-size: 12px; font-weight: 600; padding: 2px 8px; border-radius: 4px;
        display: flex; align-items: center; gap: 4px;
    }
    .growth-up { background: #ecfdf5; color: var(--c-success); }
    .growth-down { background: #fef2f2; color: var(--c-danger); }
    .growth-neutral { background: #f1f5f9; color: var(--d-muted); }

    /* TABLE */
    .clean-table { width: 100%; border-collapse: collapse; font-size: 14px; }
    .clean-table th { text-align: left; color: var(--d-muted); font-weight: 600; padding: 12px 0; border-bottom: 1px solid var(--d-border); font-size: 12px; text-transform: uppercase; }
    .clean-table td { padding: 14px 0; border-bottom: 1px solid #f8fafc; color: var(--d-text); }
    .clean-table tr:last-child td { border-bottom: none; }

    /* STATUS DOTS */
    .status-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 6px; }
    .dot-new { background: var(--c-warning); box-shadow: 0 0 0 3px rgba(245,158,11,0.2); }
    .dot-active { background: var(--c-success); }
    .dot-rejected { background: var(--d-border); }

    /* SVGs */
    .icon-svg { width: 20px; height: 20px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1 text-dark">Վերահսկման Վահանակ</h4>
        <p class="text-muted small mb-0">Իրավիճակը համակարգում այս պահին</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= Url::to('admin/events/create') ?>" class="btn btn-sm btn-white border shadow-sm fw-bold">
            + Միջոցառում
        </a>
        <a href="<?= Url::to('admin/news/create') ?>" class="btn btn-sm btn-dark shadow-sm fw-bold">
            + Նորություն
        </a>
    </div>
</div>

<div class="d-grid-4">
    <div class="dash-card">
        <div class="stat-row">
            <div class="stat-icon-box" style="background: var(--c-primary);">
                <svg class="icon-svg" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </div>
            <?php if($kpi['mentors']['diff'] != 0): ?>
                <div class="growth-tag <?= $kpi['mentors']['is_positive'] ? 'growth-up' : 'growth-down' ?>">
                    <?= $kpi['mentors']['is_positive'] ? '▲' : '▼' ?> <?= abs($kpi['mentors']['diff']) ?>
                    <span class="opacity-50 ms-1">այսօր</span>
                </div>
            <?php else: ?>
                <div class="growth-tag growth-neutral">= 0 այսօր</div>
            <?php endif; ?>
        </div>
        <div class="stat-value"><?= $kpi['mentors']['total'] ?></div>
        <div class="stat-label">Մենթորներ</div>
    </div>

    <div class="dash-card">
        <div class="stat-row">
            <div class="stat-icon-box" style="background: var(--c-accent);">
                <svg class="icon-svg" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12V9a9 9 0 0 1 9-9 9 9 0 0 1 9 9v3"></path></svg>
            </div>
            <?php if($kpi['mentees']['diff'] != 0): ?>
                <div class="growth-tag <?= $kpi['mentees']['is_positive'] ? 'growth-up' : 'growth-down' ?>">
                    <?= $kpi['mentees']['is_positive'] ? '▲' : '▼' ?> <?= abs($kpi['mentees']['diff']) ?>
                    <span class="opacity-50 ms-1">այսօր</span>
                </div>
            <?php else: ?>
                <div class="growth-tag growth-neutral">= 0 այսօր</div>
            <?php endif; ?>
        </div>
        <div class="stat-value"><?= $kpi['mentees']['total'] ?></div>
        <div class="stat-label">Ուսանողներ</div>
    </div>

    <div class="dash-card">
        <div class="stat-row">
            <div class="stat-icon-box" style="background: var(--c-warning);">
                <svg class="icon-svg" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
            </div>
            <?php if($kpi['messages']['today'] > 0): ?>
                <div class="growth-tag growth-up">
                    +<?= $kpi['messages']['today'] ?> <span class="opacity-50 ms-1">նոր</span>
                </div>
            <?php endif; ?>
        </div>
        <div class="stat-value"><?= $kpi['messages']['total'] ?></div>
        <div class="stat-label">Հաղորդագրություններ</div>
    </div>

    <div class="dash-card">
        <div class="stat-row">
            <div class="stat-icon-box" style="background: var(--c-success);">
                <svg class="icon-svg" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            </div>
            <div class="growth-tag growth-neutral">
                Հարաբերակցություն
            </div>
        </div>
        <div class="stat-value"><?= $ratio ?></div>
        <div class="stat-label">Ուսանող / Մենթոր</div>
    </div>
</div>

<div class="d-grid-main">
    
    <div class="dash-card d-flex flex-column">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-bold mb-0">Ակտիվությունը (Վերջին 12 ժամ)</h6>
            <div class="text-muted small">
                <span class="status-dot" style="background: var(--c-accent);"></span>Հայտեր
            </div>
        </div>
        <div style="position: relative; height: 300px; width: 100%;">
            <canvas id="hourlyChart"></canvas>
        </div>
    </div>

    <div class="dash-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold mb-0">Վերջին մուտքերը</h6>
            <a href="<?= Url::to('admin/mentors') ?>" class="text-decoration-none small fw-bold text-primary">Դիտել բոլորը</a>
        </div>
        
        <table class="clean-table">
            <thead>
                <tr>
                    <th>Անուն</th>
                    <th>Դերը</th>
                    <th class="text-end">Կարգավիճակ</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($activity)): ?>
                    <tr><td colspan="3" class="text-center text-muted py-4">Տվյալներ չկան</td></tr>
                <?php else: ?>
                    <?php foreach($activity as $item): 
                        $role = $item['type'] === 'mentor' ? 'Մենթոր' : 'Ուսանող';
                        $statusClass = match($item['status']) {
                            'new' => 'dot-new',
                            'approved' => 'dot-active',
                            default => 'dot-rejected'
                        };
                        $statusLabel = match($item['status']) {
                            'new' => 'Նոր',
                            'approved' => 'Ակտիվ',
                            'rejected' => 'Մերժված',
                            default => $item['status']
                        };
                    ?>
                    <tr>
                        <td class="fw-bold text-dark">
                            <?= htmlspecialchars($item['full_name']) ?>
                            <div class="text-muted small fw-normal" style="font-size: 11px;">
                                <?= date('H:i', strtotime($item['created_at'])) ?>
                            </div>
                        </td>
                        <td class="text-muted"><?= $role ?></td>
                        <td class="text-end">
                            <span class="status-dot <?= $statusClass ?>"></span>
                            <span style="font-size: 12px; font-weight: 500;"><?= $statusLabel ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="dash-card mt-4">
    <h6 class="fw-bold mb-4">Հայտերի Ընթացքը (Funnel)</h6>
    <div class="row">
        <div class="col-md-6 border-end">
            <div class="d-flex align-items-center justify-content-between px-4">
                <div>
                    <h5 class="text-primary fw-bold mb-1">Մենթորներ</h5>
                    <div class="small text-muted">Ընդհանուր հաստատված</div>
                </div>
                <div class="text-end">
                    <h2 class="fw-bold mb-0 text-dark"><?= $dist['mentors']['approved'] ?></h2>
                    <small class="text-danger"><?= $dist['mentors']['new'] ?> սպասող</small>
                </div>
            </div>
            <div class="progress mt-3 mx-4" style="height: 6px;">
                <?php 
                    $mTotal = array_sum($dist['mentors']);
                    $mPerc = $mTotal > 0 ? ($dist['mentors']['approved'] / $mTotal) * 100 : 0;
                ?>
                <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $mPerc ?>%"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex align-items-center justify-content-between px-4">
                <div>
                    <h5 class="text-info fw-bold mb-1">Ուսանողներ</h5>
                    <div class="small text-muted">Ընդհանուր հաստատված</div>
                </div>
                <div class="text-end">
                    <h2 class="fw-bold mb-0 text-dark"><?= $dist['mentees']['approved'] ?></h2>
                    <small class="text-danger"><?= $dist['mentees']['new'] ?> սպասող</small>
                </div>
            </div>
            <div class="progress mt-3 mx-4" style="height: 6px;">
                <?php 
                    $sTotal = array_sum($dist['mentees']);
                    $sPerc = $sTotal > 0 ? ($dist['mentees']['approved'] / $sTotal) * 100 : 0;
                ?>
                <div class="progress-bar bg-info" role="progressbar" style="width: <?= $sPerc ?>%"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('hourlyChart').getContext('2d');
    
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(14, 165, 233, 0.2)');
    gradient.addColorStop(1, 'rgba(14, 165, 233, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= $chart['labels'] ?>,
            datasets: [{
                label: 'Ակտիվություն',
                data: <?= $chart['data'] ?>,
                borderColor: '#0ea5e9',
                backgroundColor: gradient,
                borderWidth: 2,
                pointRadius: 0,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { 
                    backgroundColor: '#0f172a', 
                    padding: 10,
                    titleFont: { family: 'Inter', size: 13 },
                    bodyFont: { family: 'Inter', size: 13 },
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' հայտ';
                        }
                    }
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#94a3b8' } },
                y: { border: { display: false }, grid: { color: '#f1f5f9' }, ticks: { stepSize: 1 } }
            }
        }
    });
});
</script>