<?php
declare(strict_types=1);

use Core\Url;
use Core\Lang;

if (empty($news)) {
    http_response_code(404);
    echo "<h1>404</h1><p>Новость не найдена.</p><a href='" . Url::to('news') . "'>К списку новостей</a>";
    return;
}

$lang = Lang::current();
$title = $news['title_' . $lang] ?? $news['title_hy'] ?? 'Заголовок не указан';
$body = $news['body_' . $lang] ?? $news['body_hy'] ?? 'Текст отсутствует.';
$dateString = $news['published_at'] ?? $news['created_at'] ?? (new DateTime())->format('Y-m-d H:i:s');
?>

<section class="nf-section pt-5">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                
                <nav aria-label="breadcrumb" class="mb-4 small">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= Url::to('/') ?>">Գլխավոր</a></li>
                        <li class="breadcrumb-item"><a href="<?= Url::to('news') ?>">Նորություններ</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($title) ?></li>
                    </ol>
                </nav>

                <div class="text-center mb-5">
                    <span class="badge bg-primary-subtle text-primary mb-2">
                        <?= date('d M Y', strtotime($dateString)) ?>
                    </span>
                    <h1 class="display-5 fw-bold mb-4">
                        <?= htmlspecialchars($title) ?>
                    </h1>
                </div>

                <?php if (!empty($news['image_url'])): ?>
                    <div class="nf-single-image mb-5 rounded-4 overflow-hidden shadow-lg">
                        <img src="<?= Url::to(htmlspecialchars($news['image_url'])) ?>" class="img-fluid w-100 object-fit-cover" style="max-height: 480px;" alt="<?= htmlspecialchars($title) ?>">
                    </div>
                <?php endif; ?>

                <div class="nf-single-content lead">
                    <?= $body ?>
                </div>

                <div class="mt-5 pt-4 border-top text-center">
                    <a href="<?= Url::to('news') ?>" class="btn btn-outline-primary rounded-pill px-4">
                        ← Վերադառնալ բոլոր նորություններին
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>