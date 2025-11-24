<?php use Core\Url; ?>

<style>
    /* ... (Стили остаются без изменений) ... */
    
    /* --- ABOUT PAGE ENTERPRISE SYSTEM --- */
    :root {
        --a-blue: #253894;
        --a-blue-dark: #162055;
        --a-green: #63A900;
        --a-bg-light: #f8faff;
        --a-text-main: #0f172a;
        --a-text-muted: #475569;
        --a-border: #e2e8f0;
    }

    /* Global Icon Style */
    .svg-icon {
        width: 24px;
        height: 24px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    /* Hero Section */
    .about-hero {
        padding: 6rem 0 5rem;
        background: radial-gradient(circle at 0% 0%, rgba(37, 56, 148, 0.05) 0%, transparent 40%),
                    radial-gradient(circle at 100% 100%, rgba(99, 169, 0, 0.05) 0%, transparent 40%);
        text-align: center;
    }
    
    .about-badge {
        display: inline-flex; align-items: center; gap: 10px;
        padding: 8px 18px; background: #eff6ff; color: var(--a-blue);
        border-radius: 100px; font-weight: 700; font-size: 0.75rem;
        text-transform: uppercase; letter-spacing: 0.05em;
        margin-bottom: 24px; border: 1px solid rgba(37, 56, 148, 0.1);
    }

    /* Mission Block */
    .mission-card {
        background: #fff;
        border-radius: 24px;
        padding: 3.5rem;
        box-shadow: 0 20px 40px -10px rgba(37, 56, 148, 0.08);
        border: 1px solid rgba(0,0,0,0.04);
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    .mission-card::before {
        content: '';
        position: absolute; top: 0; left: 0; width: 4px; height: 100%;
        background: var(--a-blue);
    }

    /* Directions Grid */
    .direction-card {
        padding: 2.5rem 2rem;
        background: #fff;
        border: 1px solid var(--a-border);
        border-radius: 16px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }
    .direction-card:hover {
        border-color: var(--a-blue);
        transform: translateY(-5px);
        box-shadow: 0 15px 30px -5px rgba(37, 56, 148, 0.12);
    }
    .direction-icon-box {
        width: 56px; height: 56px;
        background: rgba(37, 56, 148, 0.06);
        color: var(--a-blue);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 1.5rem;
        transition: all 0.3s;
    }
    .direction-card:hover .direction-icon-box {
        background: var(--a-blue);
        color: #fff;
    }

    /* Values Grid */
    .value-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1.5rem;
        border-radius: 12px;
        background: var(--a-bg-light);
        border: 1px solid transparent;
        transition: 0.3s;
    }
    .value-item:hover {
        background: #fff;
        border-color: var(--a-border);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .value-icon {
        color: var(--a-green);
        margin-top: 3px;
    }

    /* Team Section */
    .team-block {
        background: var(--a-blue);
        color: #fff;
        border-radius: 24px;
        padding: 5rem 3rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 50px -10px rgba(37, 56, 148, 0.4);
    }
    .team-decor {
        position: absolute; top: -100px; right: -100px;
        width: 300px; height: 300px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    /* --- STRUCTURE FLOW STYLES --- */
    .structure-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
        flex-wrap: nowrap; /* Строго горизонтально на больших экранах */
        overflow-x: auto; /* Скролл, если экран очень узкий */
        padding: 20px 0;
    }

    .structure-card {
        background: #fff;
        border: 2px solid var(--a-border);
        border-radius: 16px;
        padding: 2rem 1.5rem;
        min-width: 200px;
        text-align: center;
        transition: 0.3s;
        position: relative;
        z-index: 2;
    }

    /* Выделяем цвета для разных уровней */
    .st-level-1 { border-color: var(--a-blue); background: #f8faff; } /* Президент */
    .st-level-2 { border-color: var(--a-blue-dark); } /* Совет */
    .st-level-3 { border-color: var(--a-text-muted); } /* Команда */
    .st-level-4 { border-color: var(--a-green); background: #fafff5; } /* Группы */

    .structure-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(37, 56, 148, 0.1);
    }

    .structure-icon {
        width: 48px; height: 48px;
        margin: 0 auto 1rem;
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        color: var(--a-blue);
    }
    .st-level-4 .structure-icon { color: var(--a-green); }

    .structure-arrow {
        color: var(--a-text-muted);
        opacity: 0.5;
        flex-shrink: 0;
    }

    /* Адаптив для телефонов: превращаем в вертикальную стопку */
    @media (max-width: 991px) {
        .structure-wrapper {
            flex-direction: column;
        }
        .structure-arrow {
            transform: rotate(90deg); /* Поворачиваем стрелку вниз */
            margin: 10px 0;
        }
        .structure-card {
            width: 100%;
            max-width: 300px;
        }
    }
</style>

<section class="about-hero">
    <div class="container-lg">
        <div class="nf-animate" data-animate="fade-up">
            <div class="about-badge">
                <span style="width: 6px; height: 6px; background: var(--a-green); border-radius: 50%;"></span>
                <?= __('about.hero_badge', 'Մեր Պատմությունը') ?>
            </div>
            <h1 class="display-4 fw-bold mb-4 text-dark"><?= __('about.hero_title') ?></h1>
            <p class="lead text-muted mx-auto" style="max-width: 700px; line-height: 1.7;">
                <?= __('about.hero_desc') ?>
            </p>
        </div>
    </div>
</section>

<section class="nf-section pb-5">
    <div class="container-lg">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 nf-animate" data-animate="fade-right">
                <div class="mission-card">
                    <h2 class="h3 fw-bold mb-4 text-dark"><?= __('about.mission_title') ?></h2>
                    <p class="text-muted mb-4" style="line-height: 1.8; font-size: 1.05rem;">
                        <?= __('about.mission_text_1') ?>
                    </p>
                    <h2 class="h3 fw-bold mb-4 text-dark"><?= __('about.mission_title1') ?></h2>
                    <p class="text-muted mb-0" style="line-height: 1.8; font-size: 1.05rem;">
                        <?= __('about.mission_text_2') ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-6 nf-animate" data-animate="fade-left">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="value-item">
                            <div class="value-icon">
                                <svg class="svg-icon" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2 text-dark"><?= __('about.val_transparency') ?></h5>
                                <p class="small text-muted mb-0"><?= __('about.val_transparency_desc') ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="value-item">
                            <div class="value-icon">
                                <svg class="svg-icon" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2 text-dark"><?= __('about.val_partnership') ?></h5>
                                <p class="small text-muted mb-0"><?= __('about.val_partnership_desc') ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="value-item">
                            <div class="value-icon">
                                <svg class="svg-icon" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2 text-dark"><?= __('about.val_empowerment') ?></h5>
                                <p class="small text-muted mb-0"><?= __('about.val_empowerment_desc') ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="value-item">
                            <div class="value-icon">
                                <svg class="svg-icon" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2 text-dark"><?= __('about.val_community') ?></h5>
                                <p class="small text-muted mb-0"><?= __('about.val_community_desc') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="nf-section py-5 bg-light">
    <div class="container-lg">
        <div class="text-center mb-5 nf-animate" data-animate="fade-up">
            <h2 class="fw-bold mb-3"><?= __('about.dir_title') ?></h2>
            <p class="text-muted"><?= __('about.dir_subtitle') ?></p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3 nf-animate" data-animate="fade-up">
                <div class="direction-card">
                    <div class="direction-icon-box">
                        <svg class="svg-icon" style="width:30px; height:30px;" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12V9a9 9 0 0 1 9-9 9 9 0 0 1 9 9v3"></path></svg>
                    </div>
                    <h5 class="fw-bold mb-3"><?= __('about.dir_mentor') ?></h5>
                    <p class="text-muted small mb-0"><?= __('about.dir_mentor_desc') ?></p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 nf-animate" data-animate="fade-up" style="animation-delay: 0.1s;">
                <div class="direction-card">
                    <div class="direction-icon-box">
                        <svg class="svg-icon" style="width:30px; height:30px;" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <h5 class="fw-bold mb-3"><?= __('about.dir_collab') ?></h5>
                    <p class="text-muted small mb-0"><?= __('about.dir_collab_desc') ?></p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 nf-animate" data-animate="fade-up" style="animation-delay: 0.2s;">
                <div class="direction-card">
                    <div class="direction-icon-box">
                        <svg class="svg-icon" style="width:30px; height:30px;" viewBox="0 0 24 24"><path d="M12 18.5a2.5 2.5 0 0 1-5 0V4a2 2 0 0 1 4 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-1v.5z"></path><path d="M22 9l-9.5 2.5v5L22 19V9z"></path><path d="M2 11v6"></path></svg>
                    </div>
                    <h5 class="fw-bold mb-3"><?= __('about.dir_events') ?></h5>
                    <p class="text-muted small mb-0"><?= __('about.dir_events_desc') ?></p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 nf-animate" data-animate="fade-up" style="animation-delay: 0.3s;">
                <div class="direction-card">
                    <div class="direction-icon-box">
                        <svg class="svg-icon" style="width:30px; height:30px;" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                    </div>
                    <h5 class="fw-bold mb-3"><?= __('about.dir_career') ?></h5>
                    <p class="text-muted small mb-0"><?= __('about.dir_career_desc') ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="nf-section py-5 bg-light">
    <div class="container-lg">
        <div class="text-center mb-5 nf-animate" data-animate="fade-up">
            <h2 class="fw-bold mb-3"><?= __('about.structure_title', 'Կառավարման Կառուցվածքը') ?></h2>
            <p class="text-muted"><?= __('about.structure_desc', 'Մեր կազմակերպության աշխատանքային հիերարխիան') ?></p>
        </div>

        <div class="structure-wrapper nf-animate" data-animate="fade-up">
            
            <div class="structure-card st-level-1">
                <div class="structure-icon">
                    <svg class="svg-icon" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
                <h5 class="fw-bold mb-1"><?= __('about.st_pres_title') ?></h5>
                <small class="text-muted"><?= __('about.st_pres_sub') ?></small>
            </div>

            <div class="structure-arrow">
                <svg class="svg-icon" style="width: 30px; height: 30px;" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </div>

            <div class="structure-card st-level-2">
                <div class="structure-icon">
                    <svg class="svg-icon" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <h5 class="fw-bold mb-1"><?= __('about.st_board_title') ?></h5>
                <small class="text-muted"><?= __('about.st_board_sub') ?></small>
            </div>

            <div class="structure-arrow">
                <svg class="svg-icon" style="width: 30px; height: 30px;" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </div>

            <div class="structure-card st-level-3">
                <div class="structure-icon">
                    <svg class="svg-icon" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
                <h5 class="fw-bold mb-1"><?= __('about.st_team_title') ?></h5>
                <small class="text-muted"><?= __('about.st_team_sub') ?></small>
            </div>

            <div class="structure-arrow">
                <svg class="svg-icon" style="width: 30px; height: 30px;" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </div>

            <div class="structure-card st-level-4">
                <div class="structure-icon">
                    <svg class="svg-icon" viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                </div>
                <h5 class="fw-bold mb-1"><?= __('about.st_groups_title') ?></h5>
                <small class="text-muted"><?= __('about.st_groups_sub') ?></small>
            </div>

        </div>
    </div>
</section>
<section class="py-5 text-center">
    <div class="container-lg">
        <p class="text-muted mb-4 fw-medium"><?= __('about.cta_text') ?></p>
        <a href="<?= Url::to('contact') ?>" class="btn btn-outline-primary rounded-pill px-5 py-3 fw-bold border-2" style="color: var(--a-blue); border-color: var(--a-blue);">
            <?= __('about.cta_btn') ?>
        </a>
    </div>
</section>