<?php use Core\Url; ?>

<style>
    .nf-card-shell { background: #fff; border-radius: 16px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 2px 12px rgba(0,0,0,0.02); overflow: hidden; }
    
    .nf-header-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 15px; }
    .nf-page-title { font-weight: 700; font-size: 1.5rem; color: #1e293b; margin: 0; }

    .nf-filters { padding: 16px 20px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 10px; background: #fff; }
    .nf-search-input { flex-grow: 1; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 8px 15px; }
    
    .nf-table { width: 100%; border-collapse: collapse; }
    .nf-table th { padding: 16px 20px; background: #f8fafc; color: #64748b; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; }
    .nf-table td { padding: 16px 20px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    
    /* News Specific */
    .nf-news-img { width: 50px; height: 36px; border-radius: 6px; object-fit: cover; background: #f1f5f9; border: 1px solid #e2e8f0; }
    .status-pub { background: #dcfce7; color: #166534; padding: 3px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; }
    .status-draft { background: #f3f4f6; color: #4b5563; padding: 3px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: 600; border: 1px solid #e5e7eb; }

    @media (max-width: 768px) {
        .nf-header-row { flex-direction: column; align-items: flex-start; }
        .nf-header-actions { width: 100%; display: flex; } .nf-header-actions .btn { flex: 1; }
        
        .nf-table thead { display: none; }
        .nf-table tr { display: flex; flex-direction: column; padding: 15px; border-bottom: 1px solid #e2e8f0; }
        .nf-table td { padding: 5px 0; border: none; display: flex; justify-content: space-between; width: 100%; }
        .nf-table td::before { content: attr(data-label); font-weight: 600; color: #94a3b8; font-size: 0.8rem; margin-right: 10px; }
        .nf-hide-mob { display: none; }
    }
</style>

<div class="nf-header-row">
    <div>
        <h1 class="nf-page-title">📰 Նորություններ (News)</h1>
        <p class="text-muted small mb-0">Կայքի նորություններ</p>
    </div>
    <div class="nf-header-actions">
        <a href="<?= Url::to('admin/news/create') ?>" class="btn btn-primary shadow-sm px-4">
            + Ավելացնել
        </a>
    </div>
</div>

<div class="nf-card-shell">
    
    <form action="<?= Url::to('admin/news') ?>" method="GET" class="nf-filters">
        <input type="text" name="search" class="nf-search-input" placeholder="Որոնել..." value="<?= htmlspecialchars($filters['search'] ?? '') ?>">
        <select name="status" class="form-select border-0 bg-light fw-medium" style="width: auto;" onchange="this.form.submit()">
            <?php $st = $filters['status'] ?? 'all'; ?>
            <option value="all" <?= $st==='all'?'selected':'' ?>>All</option>
            <option value="published" <?= $st==='published'?'selected':'' ?>>Published</option>
            <option value="draft" <?= $st==='draft'?'selected':'' ?>>Draft</option>
        </select>
    </form>

    <div class="table-responsive">
    <table class="nf-table">
        <thead>
            <tr>
                <th class="ps-4">Նկար</th>
                <th>Վերնագիր</th>
                <th class="nf-hide-mob">Slug</th>
                <th>Status</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($news)): ?>
                <tr><td colspan="5" class="text-center py-5 text-muted">📭 Empty</td></tr>
            <?php else: ?>
                <?php foreach($news as $n): ?>
                <tr>
                    <td class="ps-4" data-label="Image">
                        <?php if(!empty($n['image_url'])): ?>
                            <img src="<?= Url::to(htmlspecialchars($n['image_url'])) ?>" class="nf-news-img">
                        <?php else: ?>
                            <div class="nf-news-img d-flex align-items-center justify-content-center text-muted small">IMG</div>
                        <?php endif; ?>
                    </td>
                    <td data-label="Title" class="fw-bold text-dark">
                        <?= htmlspecialchars($n['title_hy']) ?>
                    </td>
                    <td data-label="Slug" class="nf-hide-mob">
                        <code class="text-muted small"><?= htmlspecialchars($n['slug']) ?></code>
                    </td>
                    <td data-label="Status">
                        <?php if($n['is_published']): ?>
                            <span class="status-pub">Published</span>
                        <?php else: ?>
                            <span class="status-draft">Draft</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end pe-4">
                        <a href="<?= Url::to('admin/news/' . $n['id'] . '/edit') ?>" class="btn btn-sm btn-light border text-primary fw-bold">Edit</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>