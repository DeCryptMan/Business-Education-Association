<?php
use Core\Url; 
use Core\Lang;

$lang = Lang::current();
?>

<section class="nf-hero-news position-relative overflow-hidden">
    <div class="nf-hero-bg-pattern"></div>
    <div class="nf-hero-glow"></div>
    
    <div class="container-lg position-relative z-2">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8 nf-animate" data-animate="fade-up">
                <span class="nf-badge-pill mb-3">
                    <span class="nf-badge-dot pulse"></span>
                    <?= __('news_page.hero_badge') ?>
                </span>
                <h1 class="display-4 fw-bold mb-3 text-dark"><?= __('news_page.hero_title') ?></h1>
                <p class="lead text-secondary mb-0 mx-auto" style="max-width: 600px;">
                    <?= __('news_page.hero_desc') ?>
                </p>
            </div>
        </div>
    </div>
</section>

<section class="nf-section pt-5 pb-5 bg-light-subtle">
    <div class="container-lg">
        
        <?php if (empty($news)): ?>
            <div class="text-center py-5 nf-animate" data-animate="fade-up">
                <div class="nf-empty-icon mb-4">📰</div>
                <h3 class="h4 text-dark"><?= __('news_page.empty_title') ?></h3>
                <p class="text-muted mb-4"><?= __('news_page.empty_desc') ?></p>
                <a href="<?= Url::to('/') ?>" class="btn nf-btn-primary">
                    <?= __('news_page.return_home') ?>
                </a>
            </div>
        <?php else: ?>
            
            <?php if (count($news) > 3): 
                $featured = array_shift($news); 
                // Դինամիկ լեզվի ընտրություն
                $fTitle = $featured['title_' . $lang] ?? $featured['title_hy'];
                $fExcerpt = $featured['excerpt_' . $lang] ?? $featured['excerpt_hy'];
            ?>
            <div class="row mb-5 nf-animate" data-animate="fade-up">
                <div class="col-12">
                    <a href="<?= Url::to('news/' . $featured['slug']) ?>" class="nf-news-featured card border-0 shadow-sm overflow-hidden text-decoration-none text-dark">
                        <div class="row g-0 h-100">
                            <div class="col-md-7 position-relative overflow-hidden">
                                <?php if (!empty($featured['image_url'])): ?>
                                    <img src="<?= htmlspecialchars($featured['image_url']) ?>" class="img-fluid w-100 h-100 object-fit-cover transform-scale" alt="<?= htmlspecialchars($fTitle) ?>">
                                <?php else: ?>
                                    <div class="nf-placeholder-bg w-100 h-100 d-flex align-items-center justify-content-center bg-light text-secondary">
                                        <span class="fs-1">📷</span>
                                    </div>
                                <?php endif; ?>
                                <div class="nf-overlay-gradient"></div>
                            </div>
                            <div class="col-md-5 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2"><?= __('news_page.featured_badge') ?></span>
                                        <span class="text-muted small">
                                            <?= date('d.m.Y', strtotime($featured['published_at'])) ?>
                                        </span>
                                    </div>
                                    <h2 class="card-title h3 fw-bold mb-3 nf-link-hover">
                                        <?= htmlspecialchars($fTitle) ?>
                                    </h2>
                                    <p class="card-text text-secondary mb-4 line-clamp-3">
                                        <?= htmlspecialchars($fExcerpt ?? '') ?>
                                    </p>
                                    <span class="fw-semibold text-primary d-inline-flex align-items-center gap-2">
                                        <?= __('news_page.read_full') ?>
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <div class="row g-4">
                <?php foreach ($news as $index => $item): 
                    $iTitle = $item['title_' . $lang] ?? $item['title_hy'];
                    $iExcerpt = $item['excerpt_' . $lang] ?? $item['excerpt_hy'];
                ?>
                    <div class="col-md-6 col-lg-4 d-flex nf-animate" data-animate="fade-up" style="animation-delay: <?= $index * 0.1 ?>s">
                        <article class="card nf-news-card border-0 shadow-sm h-100 w-100">
                            
                            <a href="<?= Url::to('news/' . $item['slug']) ?>" class="nf-news-img-wrapper ratio ratio-16x9 overflow-hidden bg-light position-relative">
                                <?php if (!empty($item['image_url'])): ?>
                                    <img src="<?= htmlspecialchars($item['image_url']) ?>" class="object-fit-cover w-100 h-100 transition-transform" alt="<?= htmlspecialchars($iTitle) ?>">
                                <?php else: ?>
                                    <div class="d-flex align-items-center justify-content-center text-muted h-100 w-100">
                                        <span class="fs-4">📄</span>
                                    </div>
                                <?php endif; ?>
                                <div class="nf-card-overlay"></div>
                            </a>

                            <div class="card-body d-flex flex-column p-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-light text-secondary border border-light-subtle rounded-pill fw-normal">
                                        <?= __('news_page.card_badge') ?>
                                    </span>
                                    <small class="text-muted fw-medium">
                                        <?= date('d.m.Y', strtotime($item['published_at'])) ?>
                                    </small>
                                </div>

                                <h3 class="card-title h5 fw-bold mb-3">
                                    <a href="<?= Url::to('news/' . $item['slug']) ?>" class="text-decoration-none text-dark nf-title-link">
                                        <?= htmlspecialchars($iTitle) ?>
                                    </a>
                                </h3>

                                <p class="card-text text-secondary small mb-4 flex-grow-1 line-clamp-3">
                                    <?= htmlspecialchars(mb_substr($iExcerpt ?? '', 0, 120)) . '...' ?>
                                </p>

                                <a href="<?= Url::to('news/' . $item['slug']) ?>" class="nf-read-more stretched-link">
                                    <?= __('news_page.read_more') ?>
                                </a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="mt-5 pt-3 text-center nf-animate" data-animate="fade-up">
            <a href="<?= Url::to('/') ?>" class="btn nf-btn-outline rounded-pill px-4">
                <span class="me-2">←</span> <?= __('news_page.back_home') ?>
            </a>
        </div>
    </div>
</section>

<style>
/* Hero Section */
.nf-hero-news {
    padding: 6rem 0 4rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}
.nf-hero-bg-pattern {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
    background-size: 30px 30px;
    opacity: 0.4;
}
.nf-hero-glow {
    position: absolute;
    top: -50%;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    height: 200%;
    background: radial-gradient(circle, rgba(16, 185, 129, 0.05) 0%, rgba(255,255,255,0) 70%);
    pointer-events: none;
}

/* Badges */
.nf-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 6px 16px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 100px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #475569;
    box-shadow: 0 2px 4px rgba(0,0,0,0.03);
}
.nf-badge-dot {
    width: 8px;
    height: 8px;
    background-color: #10b981;
    border-radius: 50%;
}
.pulse {
    box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    animation: pulse-green 2s infinite;
}
@keyframes pulse-green {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}

/* Featured Card */
.nf-news-featured {
    background: #fff;
    border-radius: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.nf-news-featured:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important;
}
.nf-news-featured img {
    transition: transform 0.6s ease;
}
.nf-news-featured:hover img {
    transform: scale(1.03);
}

/* Regular Cards */
.nf-news-card {
    background: #fff;
    border-radius: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}
.nf-news-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px -10px rgba(0, 0, 0, 0.1) !important;
}

.nf-news-img-wrapper {
    border-radius: 16px 16px 0 0;
}
.nf-news-img-wrapper img {
    transition: transform 0.5s ease;
}
.nf-news-card:hover .nf-news-img-wrapper img {
    transform: scale(1.08);
}

.nf-title-link {
    background: linear-gradient(to right, #111, #111) 0 100% no-repeat;
    background-size: 0 1px;
    transition: background-size 0.3s;
}
.nf-news-card:hover .nf-title-link {
    background-size: 100% 1px;
    color: #0d6efd !important;
}

/* Read More Link */
.nf-read-more {
    color: #10b981;
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: color 0.2s;
}
.nf-read-more::after {
    content: '→';
    margin-left: 6px;
    transition: transform 0.2s;
}
.nf-news-card:hover .nf-read-more::after {
    transform: translateX(4px);
}

/* Utilities */
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.nf-empty-icon {
    font-size: 4rem;
    opacity: 0.5;
}
</style>