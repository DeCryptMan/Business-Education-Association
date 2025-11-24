<?php use Core\Url; ?>

<style>
    .nf-msg-card { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.02); }
    
    /* Tabs */
    .nf-tabs { display: flex; gap: 10px; padding: 15px 25px; border-bottom: 1px solid #f1f5f9; }
    .nf-tab-link { 
        text-decoration: none; color: #64748b; font-weight: 600; font-size: 0.9rem; padding: 8px 16px; border-radius: 8px; transition: all 0.2s;
    }
    .nf-tab-link:hover { background: #f8fafc; color: #0f172a; }
    .nf-tab-link.active { background: #fff7ed; color: #ea580c; } /* Orange theme for messages */
    .nf-badge-count { background: #fff; border: 1px solid #e2e8f0; padding: 2px 8px; border-radius: 10px; font-size: 0.75rem; margin-left: 6px; }
    
    /* Table */
    .nf-table th { background: #f8fafc; color: #64748b; font-size: 0.75rem; text-transform: uppercase; padding: 16px 24px; font-weight: 700; }
    .nf-table td { padding: 16px 24px; vertical-align: middle; border-bottom: 1px solid #f1f5f9; }
    
    /* Status Dot */
    .msg-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; }
    .dot-new { background: #ea580c; box-shadow: 0 0 0 4px #fff7ed; }
    .dot-read { background: #cbd5e1; }

    /* Avatar */
    .msg-avatar {
        width: 40px; height: 40px; border-radius: 10px; background: #f1f5f9; color: #64748b;
        display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem;
    }
</style>

<div class="d-flex justify-content-between align-items-end mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">📩 Նամակներ (Messages)</h2>
        <p class="text-muted small mb-0">Հետադարձ կապի հաղորդագրություններ</p>
    </div>
</div>

<div class="nf-msg-card">
    
    <div class="nf-tabs">
        <a href="<?= Url::to('admin/messages?status=new') ?>" class="nf-tab-link <?= $filters['status'] === 'new' ? 'active' : '' ?>">
            Նոր (New) <span class="nf-badge-count"><?= $counts['new'] ?></span>
        </a>
        <a href="<?= Url::to('admin/messages?status=processed') ?>" class="nf-tab-link <?= $filters['status'] === 'processed' ? 'active' : '' ?>">
            Ընթերցված (Read) <span class="nf-badge-count"><?= $counts['processed'] ?></span>
        </a>
        <a href="<?= Url::to('admin/messages?status=all') ?>" class="nf-tab-link <?= $filters['status'] === 'all' ? 'active' : '' ?>">
            Բոլորը (All) <span class="nf-badge-count"><?= $counts['all'] ?></span>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table nf-table mb-0 table-hover">
            <thead>
                <tr>
                    <th class="ps-4" style="width: 50px;"></th>
                    <th>Ուղարկող</th>
                    <th>Թեմա (Topic)</th>
                    <th>Ամսաթիվ</th>
                    <th class="text-end pe-4"></th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($messages)): ?>
                    <tr><td colspan="5" class="text-center py-5 text-muted">Նամակներ չկան</td></tr>
                <?php else: ?>
                    <?php foreach($messages as $m): 
                        $initial = mb_substr($m['full_name'], 0, 1);
                        $isNew = $m['status'] === 'new';
                        $rowClass = $isNew ? 'fw-bold bg-white' : 'text-muted bg-light-subtle';
                    ?>
                    <tr class="<?= $isNew ? '' : 'opacity-75' ?>">
                        <td class="ps-4">
                            <div class="msg-dot <?= $isNew ? 'dot-new' : 'dot-read' ?>" title="<?= $m['status'] ?>"></div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="msg-avatar">
                                    <?= strtoupper($initial) ?>
                                </div>
                                <div>
                                    <div class="<?= $isNew ? 'text-dark' : '' ?>"><?= htmlspecialchars($m['full_name']) ?></div>
                                    <div class="small text-muted"><?= htmlspecialchars($m['email']) ?></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border rounded-pill fw-normal me-2">
                                <?= htmlspecialchars($m['topic']) ?>
                            </span>
                            <span class="small text-secondary">
                                <?= htmlspecialchars(mb_substr($m['message'], 0, 50)) ?>...
                            </span>
                        </td>
                        <td class="small text-muted">
                            <?= date('d M, H:i', strtotime($m['created_at'])) ?>
                        </td>
                        <td class="text-end pe-4">
                            <a href="<?= Url::to('admin/messages/' . $m['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                Կարդալ
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>