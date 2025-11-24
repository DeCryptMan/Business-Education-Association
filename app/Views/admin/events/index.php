<?php use Core\Url; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📅 Միջոցառումներ (Events)</h2>
    <a href="<?= Url::to('admin/events/create') ?>" class="btn btn-primary">+ Ավելացնել</a>
</div>

<div class="card p-0 overflow-hidden border-0 shadow-sm">
    <table class="table table-hover mb-0">
        <thead class="bg-light">
            <tr>
                <th>Ամսաթիվ</th>
                <th>Վերնագիր</th>
                <th>Վայր</th>
                <th class="text-end">Գործողություն</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($events as $ev): ?>
            <tr>
                <td>
                    <span class="badge bg-info text-dark">
                        <?= date('d.m.Y', strtotime($ev['event_date'])) ?>
                    </span>
                    <small class="d-block text-muted"><?= $ev['start_time'] ?></small>
                </td>
                <td class="fw-bold"><?= htmlspecialchars($ev['title_hy']) ?></td>
                <td><?= htmlspecialchars($ev['location_hy']) ?></td>
                <td class="text-end">
                    <a href="<?= Url::to('admin/events/' . $ev['id'] . '/edit') ?>" class="btn btn-sm btn-light border text-primary fw-bold me-1">
                        ✎ Edit
                    </a>
                    <form action="<?= Url::to('admin/events/' . $ev['id'] . '/delete') ?>" method="POST" class="d-inline" onsubmit="return confirm('Ջնջե՞լ:')">
                        <button class="btn btn-sm btn-outline-danger">🗑️</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>