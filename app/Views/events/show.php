<?php use Core\Url; use Core\Lang; $l = Lang::current(); ?>
<div class="container py-5">
    <a href="<?= Url::to('events') ?>" class="btn btn-link mb-4">← Back to Calendar</a>
    
    <div class="row">
        <div class="col-lg-6">
            <?php if($event['image_url']): ?>
                <img src="<?= Url::to($event['image_url']) ?>" class="img-fluid rounded-4 shadow-sm mb-4">
            <?php endif; ?>
        </div>
        <div class="col-lg-6">
            <span class="badge bg-primary mb-2"><?= date('d M Y', strtotime($event['event_date'])) ?></span>
            <h1 class="fw-bold mb-3"><?= $event['title_' . $l] ?? $event['title_hy'] ?></h1>
            <div class="text-muted mb-4">
                📍 <?= $event['location_' . $l] ?? $event['location_hy'] ?> | 🕒 <?= $event['start_time'] ?>
            </div>
            <div class="lead">
                <?= nl2br($event['description_' . $l] ?? $event['description_hy']) ?>
            </div>
        </div>
    </div>
</div>