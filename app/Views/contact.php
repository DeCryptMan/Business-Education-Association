<?php
use Core\Url;
use Core\Csrf;
?>

<style>
    /* --- CONTACT PAGE ENTERPRISE SYSTEM --- */
    :root {
        --c-blue: #253894;
        --c-blue-dark: #162055;
        --c-green: #63A900;
        --c-bg-body: #f8faff;
        --c-surface: #ffffff;
        --c-text-main: #0f172a;
        --c-text-muted: #475569;
        --c-border: #e2e8f0;
        --c-radius: 16px;
        --c-shadow: 0 10px 30px -5px rgba(37, 56, 148, 0.08);
    }

    /* Section Header */
    .contact-hero {
        padding: 5rem 0 4rem;
        text-align: center;
        background: radial-gradient(circle at 50% 100%, rgba(37, 56, 148, 0.05) 0%, transparent 60%);
    }
    
    .page-label {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 6px 16px; background: rgba(37, 56, 148, 0.08); color: var(--c-blue);
        border-radius: 100px; font-weight: 700; font-size: 0.75rem;
        text-transform: uppercase; letter-spacing: 0.05em;
        margin-bottom: 20px;
    }

    /* Info Cards (Left Column) */
    .info-card {
        background: var(--c-surface);
        padding: 24px;
        border-radius: var(--c-radius);
        border: 1px solid var(--c-border);
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    .info-card:hover {
        border-color: var(--c-blue);
        box-shadow: var(--c-shadow);
        transform: translateY(-2px);
    }
    
    .icon-box {
        width: 48px; height: 48px;
        background: rgba(37, 56, 148, 0.05);
        color: var(--c-blue);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        transition: 0.3s;
    }
    .info-card:hover .icon-box {
        background: var(--c-blue);
        color: #fff;
    }

    .info-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--c-text-main);
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.02em;
    }
    .info-value {
        color: var(--c-text-muted);
        font-size: 0.95rem;
        line-height: 1.5;
        text-decoration: none;
        transition: 0.2s;
    }
    a.info-value:hover { color: var(--c-blue); }

    /* Form Card (Right Column) */
    .form-wrapper {
        background: var(--c-surface);
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 20px 40px -10px rgba(37, 56, 148, 0.1);
        border: 1px solid rgba(0,0,0,0.02);
    }

    /* Inputs */
    .form-group { margin-bottom: 24px; }
    .form-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--c-text-main);
        margin-bottom: 8px;
        display: block;
    }
    
    .form-control-pro {
        width: 100%;
        padding: 14px 18px;
        font-size: 0.95rem;
        color: var(--c-text-main);
        background-color: #f8fafc;
        border: 1px solid var(--c-border);
        border-radius: 10px;
        transition: all 0.2s ease;
    }
    .form-control-pro:focus {
        background-color: #fff;
        border-color: var(--c-blue);
        outline: none;
        box-shadow: 0 0 0 4px rgba(37, 56, 148, 0.1);
    }
    textarea.form-control-pro { min-height: 140px; resize: vertical; }

    /* Submit Button */
    .btn-submit {
        width: 100%;
        padding: 16px;
        background: var(--c-blue);
        color: #fff;
        font-weight: 700;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(37, 56, 148, 0.2);
        display: flex; align-items: center; justify-content: center; gap: 10px;
    }
    .btn-submit:hover {
        background: var(--c-blue-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 56, 148, 0.3);
    }
    .btn-submit:disabled { opacity: 0.7; cursor: not-allowed; }

    /* Map Section */
    .map-frame {
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid var(--c-border);
        height: 450px;
        position: relative;
    }
    .map-frame iframe { width: 100%; height: 100%; border: 0; filter: grayscale(20%); }
</style>

<section class="contact-hero">
    <div class="container-lg">
        <div class="nf-animate" data-animate="fade-up">
            <span class="page-label"><?= __('contact.hero_badge') ?></span>
            <h1 class="display-4 fw-bold text-dark mb-3"><?= __('contact.hero_title') ?></h1>
            <p class="text-muted mx-auto" style="max-width: 600px; font-size: 1.1rem;">
                <?= __('contact.hero_desc') ?>
            </p>
        </div>
    </div>
</section>

<section class="pb-5">
    <div class="container-lg">
        <div class="row g-5">
            
            <div class="col-lg-5 nf-animate" data-animate="fade-right">
                <h3 class="h4 fw-bold mb-4 text-dark"><?= __('contact.info_title') ?></h3>
                
                <div class="info-card">
                    <div class="icon-box"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></div>
                    <div>
                        <div class="info-title"><?= __('contact.addr_label') ?></div>
                        <div class="info-value"><?= __('contact.addr_value') ?></div>
                    </div>
                </div>

                <div class="info-card">
                    <div class="icon-box"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.05 12.05 0 0 0 .57 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.05 12.05 0 0 0 2.81.57A2 2 0 0 1 22 16.92z"></path></svg></div>
                    <div>
                        <div class="info-title"><?= __('contact.phone_label') ?></div>
                        <a href="tel:+37411528112" class="info-value d-block">+374 (11) 52 81 12</a>
                    </div>
                </div>

                <div class="info-card">
                    <div class="icon-box"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></div>
                    <div>
                        <div class="info-title"><?= __('contact.email_label') ?></div>
                        <a href="mailto:info@bea.am" class="info-value d-block">info@bea.am</a>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top">
                    <h6 class="fw-bold text-muted text-uppercase small mb-3"><?= __('contact.social_label') ?></h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="btn btn-outline-secondary rounded-3 border px-3 py-2 d-flex align-items-center gap-2 small fw-bold">Facebook</a>
                        <a href="#" class="btn btn-outline-secondary rounded-3 border px-3 py-2 d-flex align-items-center gap-2 small fw-bold">LinkedIn</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 nf-animate" data-animate="fade-left">
                <div class="form-wrapper">
                    <div class="d-flex align-items-end justify-content-between mb-4">
                        <h3 class="h4 fw-bold text-dark mb-0"><?= __('contact.form_title') ?></h3>
                        <span class="badge bg-light text-muted border"><?= __('contact.form_badge') ?></span>
                    </div>

                    <form id="nf-contact-form" class="nf-contact-form" data-endpoint="<?= Url::to('backend/contact') ?>">
                        <?= Csrf::field() ?>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label for="name" class="form-label"><?= __('contact.f_name') ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control-pro" id="name" placeholder="<?= __('contact.f_name_ph') ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label for="email" class="form-label"><?= __('contact.f_email') ?> <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control-pro" id="email" placeholder="name@example.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label for="phone" class="form-label"><?= __('contact.f_phone') ?></label>
                                    <input type="text" name="phone" class="form-control-pro" id="phone" placeholder="+374 XX XXXXXX">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <label for="topic" class="form-label"><?= __('contact.f_topic') ?></label>
                                    <select name="topic" class="form-control-pro" id="topic">
                                        <option value="general"><?= __('contact.t_general') ?></option>
                                        <option value="mentor"><?= __('contact.t_mentor') ?></option>
                                        <option value="partnership"><?= __('contact.t_partnership') ?></option>
                                        <option value="other"><?= __('contact.t_other') ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <label for="message" class="form-label"><?= __('contact.f_message') ?> <span class="text-danger">*</span></label>
                                    <textarea name="message" class="form-control-pro" id="message" placeholder="<?= __('contact.f_message_ph') ?>" required></textarea>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="consent" required>
                                    <label class="form-check-label small text-muted" for="consent">
                                        <?= __('contact.f_consent') ?>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 pt-2">
                                <button type="submit" class="btn-submit">
                                    <span class="spinner-border spinner-border-sm d-none me-2"></span>
                                    <?= __('contact.f_btn') ?>
                                </button>
                                <div class="nf-form-status mt-3 fw-bold text-center"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="pb-5 nf-animate" data-animate="fade-up">
    <div class="container-lg">
        <div class="map-frame shadow-sm">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d190.50442515909648!2d44.52097304889651!3d40.185237738127576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406abce132372ec7%3A0x29eb0922f85a93a!2s34%20Abovyan%20poxoc%2C%20Yerevan%200009!5e0!3m2!1sru!2sam!4v1763719074937!5m2!1sru!2sam" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>