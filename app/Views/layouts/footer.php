<?php use Core\Url; ?>

<style>
    /* --- ULTIMATE OPTIMIZED FOOTER --- */
    :root {
        /* Palette */
        --f-bg-dark: #0a0e17;      /* Deepest Navy/Black */
        --f-text-main: #94a3b8;    /* Slate 400 */
        --f-text-light: #e2e8f0;   /* Slate 200 */
        --f-brand-blue: #253894;
        --f-brand-green: #63A900;
        --f-border: rgba(255,255,255,0.06);
        
        /* Spacing */
        --f-gap: 2rem;
    }

    .nf-footer {
        background-color: var(--f-bg-dark);
        color: var(--f-text-main);
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        font-size: 0.9rem;
        position: relative;
        margin-top: auto;
        overflow: hidden;
    }

    /* Gradient Top Border (Visual Anchor) */
    .nf-footer::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--f-brand-blue) 0%, var(--f-brand-green) 50%, var(--f-brand-blue) 100%);
        opacity: 0.9;
    }

    /* Main Grid Layout */
    .f-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr 1.2fr; /* Desktop ratio */
        gap: 3rem;
        padding: 4rem 0 3rem;
    }

    /* Responsive Breakpoints */
    @media (max-width: 992px) {
        .f-grid { grid-template-columns: 1fr 1fr; gap: 2rem; } /* Tablet */
    }
    @media (max-width: 576px) {
        .f-grid { grid-template-columns: 1fr; gap: 2.5rem; text-align: center; } /* Mobile */
        .f-socials, .f-contact-item { justify-content: center; }
    }

    /* Headers */
    .f-heading {
        color: #fff;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 1.25rem;
        display: block;
    }

    /* Links List */
    .f-nav-list { list-style: none; padding: 0; margin: 0; }
    .f-nav-item { margin-bottom: 0.6rem; }
    .f-nav-link {
        color: var(--f-text-main);
        text-decoration: none;
        transition: color 0.2s, transform 0.2s;
        display: inline-block;
    }
    .f-nav-link:hover {
        color: #fff;
        transform: translateX(4px);
    }

    /* Brand Block */
    .f-brand-desc {
        line-height: 1.6;
        margin-bottom: 1.5rem;
        font-size: 0.85rem;
        opacity: 0.8;
        max-width: 320px;
    }
    @media (max-width: 576px) { .f-brand-desc { margin-left: auto; margin-right: auto; } }

    /* Social Icons (Touch Friendly) */
    .f-socials { display: flex; gap: 10px; flex-wrap: wrap; }
    .f-social-link {
        width: 40px; height: 40px; /* Min touch target */
        border-radius: 8px;
        background: rgba(255,255,255,0.03);
        border: 1px solid var(--f-border);
        display: flex; align-items: center; justify-content: center;
        color: var(--f-text-main);
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .f-social-link:hover {
        background: var(--f-brand-blue);
        border-color: var(--f-brand-blue);
        color: #fff;
        transform: translateY(-2px);
    }

    /* Contact Items */
    .f-contact-item {
        display: flex; align-items: flex-start; gap: 12px;
        margin-bottom: 1rem;
    }
    .f-contact-icon {
        color: var(--f-brand-green);
        margin-top: 3px;
        flex-shrink: 0;
    }
    .f-contact-text {
        font-size: 0.85rem;
        line-height: 1.5;
    }
    .f-contact-link { color: var(--f-text-light); text-decoration: none; transition: 0.2s; }
    .f-contact-link:hover { color: #fff; text-decoration: underline; }

    /* Bottom Bar */
    .f-bottom {
        border-top: 1px solid var(--f-border);
        padding: 1.5rem 0;
        font-size: 0.75rem;
        color: #475569;
    }
    
    /* SVG Utility */
    .icon-svg { width: 18px; height: 18px; fill: currentColor; }
    .icon-stroke { width: 18px; height: 18px; fill: none; stroke: currentColor; stroke-width: 2; }
</style>

<footer class="nf-footer">
    <div class="container-lg">
        <div class="f-grid">
            
            <div class="f-col">
                <a href="<?= Url::to('/') ?>" class="d-block mb-4" aria-label="Home">
                    <img src="<?= Url::asset('img/logo-am.png') ?>" alt="BE Association" width="140" style="filter: brightness(0) invert(1); opacity: 0.9;">
                </a>
                <p class="f-brand-desc">
                    <?= __('footer.desc') ?>
                </p>
                <div class="f-socials">
                    <a href="https://www.facebook.com/profile.php?id=61574912073843" class="f-social-link"><svg class="icon-svg" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                    <a href="https://www.linkedin.com/company/business-and-education-association" class="f-social-link"><svg class="icon-svg" viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg></a>
                    <a href="https://www.instagram.com/business_education_association/" class="f-social-link"><svg class="icon-stroke" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg></a>
                </div>
            </div>

            <div class="f-col">
                <span class="f-heading"><?= __('footer.nav') ?></span>
                <nav>
                    <ul class="f-nav-list">
                        <li class="f-nav-item"><a href="<?= Url::to('/') ?>" class="f-nav-link"><?= __('nav.home') ?></a></li>
                        <li class="f-nav-item"><a href="<?= Url::to('/#program') ?>" class="f-nav-link"><?= __('nav.program') ?></a></li>
                        <li class="f-nav-item"><a href="<?= Url::to('news') ?>" class="f-nav-link"><?= __('nav.news') ?></a></li>
                        <li class="f-nav-item"><a href="<?= Url::to('about') ?>" class="f-nav-link"><?= __('nav.about') ?></a></li>
                        <li class="f-nav-item"><a href="<?= Url::to('contact') ?>" class="f-nav-link"><?= __('nav.contact') ?></a></li>
                    </ul>
                </nav>
            </div>

            <div class="f-col">
                <span class="f-heading"><?= __('footer.resources') ?></span>
                <nav>
                    <ul class="f-nav-list">
                        <li class="f-nav-item"><a href="<?= Url::to('apply/mentee') ?>" class="f-nav-link"><?= __('home.btn_mentee') ?></a></li>
                        <li class="f-nav-item"><a href="<?= Url::to('apply/mentor') ?>" class="f-nav-link"><?= __('home.btn_mentor') ?></a></li>
                        <li class="f-nav-item"><a href="<?= Url::to('login') ?>" class="f-nav-link"><?= __('nav.admin_login', 'Admin Panel') ?></a></li>
                    </ul>
                </nav>
            </div>

            <div class="f-col">
                <span class="f-heading"><?= __('footer.contacts') ?></span>
                <address style="font-style: normal;">
                    <div class="f-contact-item">
                        <div class="f-contact-icon"><svg class="icon-stroke" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></div>
                        <div class="f-contact-text">
                            <span class="d-block  small mb-1"><?= __('footer.address') ?></span>
                            <a href="#" class="f-contact-link">Երևան, Հայաստան<br>Աբովյան փող. 34</a>
                        </div>
                    </div>
                    <div class="f-contact-item">
                        <div class="f-contact-icon"><svg class="icon-stroke" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></div>
                        <div class="f-contact-text">
                            <span class="d-block d small mb-1"><?= __('footer.email') ?></span>
                            <a href="mailto:info@bea.am" class="f-contact-link">info@bea.am</a>
                        </div>
                    </div>
                    <div class="f-contact-item">
                        <div class="f-contact-icon"><svg class="icon-stroke" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.05 12.05 0 0 0 .57 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.05 12.05 0 0 0 2.81.57A2 2 0 0 1 22 16.92z"></path></svg></div>
                        <div class="f-contact-text">
                            <span class="d-block  small mb-1"><?= __('footer.phone') ?></span>
                            <a href="tel:+37411528112" class="f-contact-link">+374 (11) 52 81 12</a>
                        </div>
                    </div>
                </address>
            </div>

        </div>
    </div>

    <div class="f-bottom">
        <div class="container-lg">
            <div class="row align-items-center gy-2">
                <div class="col-md-6 text-center text-md-start">
                    © <?= date('Y') ?> Business & Education Association.
                </div>
                <div class="col-md-6 text-center text-md-end opacity-50 text-uppercase small" style="letter-spacing: 1px;">
                    <?= __('footer.made_by') ?>
                </div>
            </div>
        </div>
    </div>
</footer>