<?php use Core\Url; ?>

<style>
    /* --- ULTRA MODERN PROFILE DESIGN --- */
    :root {
        --p-primary: #10b981; /* Emerald */
        --p-primary-dark: #047857;
        --p-bg: #f1f5f9;
        --p-card-bg: #ffffff;
        --p-text-main: #0f172a;
        --p-text-muted: #64748b;
        --p-border: #e2e8f0;
        --p-shadow: 0 10px 30px -10px rgba(0,0,0,0.08);
    }

    .nf-profile-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Back Button */
    .btn-back {
        display: inline-flex; align-items: center; gap: 8px;
        color: var(--p-text-muted); text-decoration: none; font-weight: 600;
        padding: 10px 0; margin-bottom: 20px; transition: color 0.2s;
    }
    .btn-back:hover { color: var(--p-text-main); }

    /* HEADER CARD */
    .nf-profile-header {
        background: linear-gradient(135deg, #059669 0%, #34d399 100%);
        border-radius: 24px;
        padding: 40px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px -10px rgba(16, 185, 129, 0.4);
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .nf-bg-pattern {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background-image: radial-gradient(rgba(255,255,255,0.15) 1.5px, transparent 1.5px);
        background-size: 24px 24px; opacity: 0.6; pointer-events: none;
    }

    .nf-profile-main {
        display: flex; align-items: center; gap: 30px; position: relative; z-index: 2;
    }

    .nf-avatar-xl {
        width: 100px; height: 100px;
        border-radius: 24px;
        background: rgba(255,255,255,0.25);
        backdrop-filter: blur(8px);
        display: flex; align-items: center; justify-content: center;
        font-size: 2.5rem; font-weight: 800; color: white;
        border: 3px solid rgba(255,255,255,0.4);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        text-transform: uppercase;
    }

    .nf-user-meta h1 { font-size: 2.2rem; font-weight: 800; margin: 0 0 5px 0; letter-spacing: -0.5px; }
    .nf-user-meta p { font-size: 1.1rem; opacity: 0.95; font-weight: 500; margin: 0; }
    .nf-user-id { font-size: 0.85rem; opacity: 0.7; margin-top: 5px; font-family: monospace; }

    .nf-header-actions {
        display: flex; gap: 15px; position: relative; z-index: 2;
    }
    .btn-header-action {
        padding: 12px 24px; border-radius: 14px; font-weight: 700; border: none;
        display: flex; align-items: center; gap: 8px; cursor: pointer; transition: all 0.2s;
    }
    .btn-approve { background: #ffffff; color: #059669; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .btn-approve:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(0,0,0,0.2); background: #f0fdf4; }
    .btn-reject { background: rgba(0,0,0,0.2); color: white; backdrop-filter: blur(4px); }
    .btn-reject:hover { background: rgba(0,0,0,0.3); }

    /* STATUS BADGE */
    .nf-status-pill {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 6px 14px; border-radius: 50px;
        background: rgba(255,255,255,0.2);
        font-weight: 700; font-size: 0.8rem; text-transform: uppercase;
        margin-left: 15px; vertical-align: middle;
        border: 1px solid rgba(255,255,255,0.3);
    }
    .nf-status-dot { width: 8px; height: 8px; background: #fff; border-radius: 50%; box-shadow: 0 0 10px #fff; }

    /* GRID SYSTEM */
    .nf-grid {
        display: grid; grid-template-columns: 380px 1fr; gap: 30px; align-items: start;
    }
    @media (max-width: 1100px) { .nf-grid { grid-template-columns: 1fr; } }

    /* CARDS */
    .nf-card {
        background: var(--p-card-bg);
        border-radius: 20px;
        border: 1px solid var(--p-border);
        box-shadow: var(--p-shadow);
        padding: 30px; margin-bottom: 24px;
        overflow: hidden;
    }
    
    .nf-card-title {
        font-size: 1.1rem; font-weight: 800; color: var(--p-text-main);
        margin-bottom: 24px; padding-bottom: 15px;
        border-bottom: 2px solid #f1f5f9;
        display: flex; align-items: center; gap: 12px;
    }
    .nf-card-icon {
        width: 36px; height: 36px; background: #ecfdf5; color: #059669;
        border-radius: 10px; display: flex; align-items: center; justify-content: center;
    }

    /* INFO LISTS */
    .nf-info-list { display: flex; flex-direction: column; gap: 20px; }
    .nf-info-item { display: flex; flex-direction: column; gap: 5px; }
    .nf-label {
        font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.8px;
        color: var(--p-text-muted); font-weight: 700;
    }
    .nf-value {
        font-size: 1rem; color: var(--p-text-main); font-weight: 500; line-height: 1.5;
    }
    .nf-value a { color: #2563eb; text-decoration: none; }
    
    /* CONSENTS */
    .nf-consent-item {
        display: flex; justify-content: space-between; align-items: center;
        padding: 12px 16px; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;
        margin-bottom: 10px;
    }
    .nf-badge-yes { background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; }
    .nf-badge-no { background: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; }

    /* DATA BOXES */
    .nf-data-box { margin-bottom: 24px; }
    .nf-data-label { font-size: 0.85rem; color: var(--p-text-muted); font-weight: 600; margin-bottom: 8px; display: block; }
    .nf-data-content {
        background: #f8fafc; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0;
        font-size: 0.95rem; color: var(--p-text-main); line-height: 1.6;
    }

    /* TAGS */
    .nf-tags { display: flex; flex-wrap: wrap; gap: 8px; }
    .nf-tag {
        background: #e0f2fe; color: #0369a1; padding: 6px 12px;
        border-radius: 8px; font-size: 0.85rem; font-weight: 600;
    }

    /* TABLE */
    .nf-mini-table {
        width: 100%; border-collapse: separate; border-spacing: 0;
        border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;
    }
    .nf-mini-table th { background: #f1f5f9; font-size: 0.75rem; text-transform: uppercase; padding: 12px 16px; text-align: left; color: #64748b; font-weight: 700; }
    .nf-mini-table td { padding: 12px 16px; border-top: 1px solid #e2e8f0; font-size: 0.9rem; color: #334155; }
    
    /* SVGs */
    .icon-svg { width: 20px; height: 20px; stroke-width: 2; }
</style>

<?php
    // --- ИСПРАВЛЕНИЕ ОШИБКИ (УМНАЯ РАСШИФРОВКА) ---
    $raw = $item['profile_data'] ?? [];
    $data = [];

    // 1. Проверка: Строка или Массив?
    if (is_array($raw)) {
        $data = $raw;
    } elseif (is_string($raw)) {
        // Чиним кавычки (&quot;) и превращаем в массив
        $clean = htmlspecialchars_decode($raw, ENT_QUOTES);
        $decoded = json_decode($clean, true);
        if (is_array($decoded)) {
            $data = $decoded;
        }
    }

    // 2. Проверка на вложенность (если внутри JSON еще один JSON)
    if (isset($data['profile_data'])) {
        $inner = $data['profile_data'];
        if (is_string($inner)) {
            $inner = json_decode(htmlspecialchars_decode($inner), true);
        }
        if (is_array($inner)) {
            $data = array_merge($data, $inner);
            unset($data['profile_data']);
        }
    }

    $initials = mb_substr($item['full_name'] ?? 'UN', 0, 2);
    
    $org = $data['currentOrg'] ?? $data['orgName'] ?? '—';
    $pos = $data['currentPosition'] ?? 'Ուսանող / Մենթի';
    
    $contacts = [
        'Էլ․ հասցե' => $item['email'],
        'Հեռախոս' => $item['phone'],
        'Բջջային' => $data['mobilePhone'] ?? null,
        'Ծննդյան տվյալներ' => $data['birthInfo'] ?? null,
        'Հասցե' => $data['personalAddress'] ?? null,
    ];
?>

<div class="nf-profile-container">
    
    <a href="<?= Url::to('admin/mentees') ?>" class="btn-back">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Վերադառնալ ցանկին
    </a>

    <!-- HEADER -->
    <div class="nf-profile-header">
        <div class="nf-bg-pattern"></div>
        
        <div class="nf-profile-main">
            <div class="nf-avatar-xl">
                <?= strtoupper($initials) ?>
            </div>
            <div class="nf-user-meta">
                <div class="d-flex align-items-center">
                    <h1><?= htmlspecialchars($item['full_name']) ?></h1>
                    <span class="nf-status-pill">
                        <span class="nf-status-dot"></span>
                        <?= ucfirst($item['status'] ?? 'new') ?>
                    </span>
                </div>
                <p><?= htmlspecialchars($org) ?> • <?= htmlspecialchars($pos) ?></p>
                <div class="nf-user-id">ID: #<?= $item['reference'] ?> | Date: <?= date('d M Y, H:i', strtotime($item['created_at'])) ?></div>
            </div>
        </div>

        <div class="nf-header-actions">
            <form action="<?= Url::to('admin/mentees/' . $item['id'] . '/status') ?>" method="POST">
                <input type="hidden" name="status" value="approved">
                <button type="submit" class="btn-header-action btn-approve" <?= $item['status'] === 'approved' ? 'disabled' : '' ?>>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                    Հաստատել
                </button>
            </form>

            <form action="<?= Url::to('admin/mentees/' . $item['id'] . '/status') ?>" method="POST">
                <input type="hidden" name="status" value="rejected">
                <button type="submit" class="btn-header-action btn-reject" <?= $item['status'] === 'rejected' ? 'disabled' : '' ?>>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    Մերժել
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN GRID -->
    <div class="nf-grid">
        
        <!-- LEFT COLUMN (Contact & Meta) -->
        <div class="nf-sidebar-col">
            
            <div class="nf-card">
                <div class="nf-card-title">
                    <div class="nf-card-icon">
                        <svg class="icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.05 12.05 0 0 0 .57 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.05 12.05 0 0 0 2.81.57A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    Կոնտակտային
                </div>
                <div class="nf-info-list">
                    <?php foreach($contacts as $label => $val): if(empty($val)) continue; ?>
                    <div class="nf-info-item">
                        <span class="nf-label"><?= $label ?></span>
                        <span class="nf-value"><?= htmlspecialchars($val) ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="nf-card">
                <div class="nf-card-title">
                    <div class="nf-card-icon">
                        <svg class="icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    Համաձայնագրեր
                </div>
                <div class="nf-consent-list">
                    <?php 
                    $consents = [
                        'consentDataProcessing' => 'Տվյալների մշակում',
                        'consentPhotos' => 'Լուսանկարներ',
                        'consentCompanyLogo' => 'Լոգոյի օգտագործում'
                    ];
                    foreach($consents as $key => $label): 
                        $isAgreed = !empty($data[$key]) && $data[$key] === 'yes';
                    ?>
                        <div class="nf-consent-item">
                            <small class="text-muted fw-bold"><?= $label ?></small>
                            <?php if($isAgreed): ?>
                                <span class="nf-badge-yes">Այո</span>
                            <?php else: ?>
                                <span class="nf-badge-no">Ոչ</span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN (Details) -->
        <div class="nf-main-col">
            
            <div class="nf-card">
                <div class="nf-card-title">
                    <div class="nf-card-icon">
                        <svg class="icon-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    </div>
                    Անկետայի Մանրամասներ
                </div>

                <?php 
                // Поля, которые мы уже показали или не хотим показывать
                $exclude = [
                    'fullName', 'email', 'phone', 'mobilePhone', 'orgName', 'currentPosition', 'currentOrg', 'birthInfo', 
                    'personalAddress', 'consentDataProcessing', 'consentPhotos', 'consentCompanyLogo', 'csrf_token'
                ];
                
                foreach($data as $key => $value): 
                    if(in_array($key, $exclude)) continue;
                    if(empty($value)) continue;
                    
                    // Преобразуем camelCase в обычный текст
                    $label = ucfirst(preg_replace('/(?<!^)[A-Z]/', ' $0', $key));
                ?>
                    <div class="nf-data-box">
                        <span class="nf-data-label"><?= htmlspecialchars($label) ?></span>
                        
                        <?php if(is_array($value)): ?>
                            
                            <?php if(isset($value[0]) && is_string($value[0])): ?>
                                <!-- Список тегов -->
                                <div class="nf-tags">
                                    <?php foreach($value as $tag): ?>
                                        <span class="nf-tag"><?= htmlspecialchars($tag) ?></span>
                                    <?php endforeach; ?>
                                </div>

                            <?php elseif(isset($value[1]['role'])): ?>
                                <!-- Таблица опыта работы -->
                                <div class="table-responsive">
                                    <table class="nf-mini-table">
                                        <thead><tr><th>Պաշտոն</th><th>Տևողություն</th><th>Ոլորտ</th></tr></thead>
                                        <tbody>
                                        <?php foreach($value as $job): if(empty($job['role'])) continue; ?>
                                            <tr>
                                                <td class="fw-bold"><?= htmlspecialchars($job['role']) ?></td>
                                                <td><?= htmlspecialchars($job['duration']) ?></td>
                                                <td><?= htmlspecialchars($job['field']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                            <?php else: ?>
                                <!-- JSON Dump для сложной структуры -->
                                <pre class="nf-data-content" style="font-family: monospace; font-size: 0.8rem;"><?= print_r($value, true) ?></pre>
                            <?php endif; ?>

                        <?php else: ?>
                            <!-- Обычный текст -->
                            <div class="nf-data-content"><?= nl2br(htmlspecialchars($value)) ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>
    </div>

</div>