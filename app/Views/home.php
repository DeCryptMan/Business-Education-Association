<?php 
use Core\Url; 
use Core\Lang; 

$lang = Lang::current(); 

$stats = $stats ?? [];
$mentorsCount = $stats['mentors'] ?? 0;
$menteesCount = $stats['mentees'] ?? 0;
$totalMembers = $mentorsCount + $menteesCount;
?>

<style>
    /* --- DESIGN SYSTEM v2.0 (Senior Level) --- */
    :root {
        /* Primary Palette */
        --brand-blue: #253894;
        --brand-blue-dark: #1a2666;
        --brand-blue-light: #3d52c2;
        
        /* Secondary Palette */
        --brand-green: #63A900;
        --brand-green-dark: #4b8000;
        --brand-green-light: #7ad100;

        /* Neutrals & Utility */
        --bg-surface: #ffffff;
        --bg-subtle: #f8fafc;
        --text-primary: #0f172a;
        --text-secondary: #475569;
        --border-color: #e2e8f0;

        /* Shadows (Elevations) */
        --shadow-sm: 0 1px 2px 0 rgba(37, 56, 148, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(37, 56, 148, 0.1), 0 2px 4px -1px rgba(37, 56, 148, 0.06);
        --shadow-xl: 0 20px 25px -5px rgba(37, 56, 148, 0.1), 0 10px 10px -5px rgba(37, 56, 148, 0.04);
        --shadow-glow: 0 0 20px rgba(37, 56, 148, 0.15);
    }

    /* --- GLOBAL OVERRIDES --- */
    body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; color: var(--text-primary); }
    
    .text-gradient {
        background: linear-gradient(135deg, var(--brand-blue) 0%, var(--brand-green) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* --- BUTTONS (High Performance) --- */
    .btn-brand-primary {
        background: var(--brand-blue);
        color: #fff;
        border: none;
        padding: 12px 32px;
        font-weight: 600;
        letter-spacing: 0.3px;
        border-radius: 50px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(37, 56, 148, 0.25);
    }
    .btn-brand-primary:hover {
        background: var(--brand-blue-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 56, 148, 0.35);
        color: #fff;
    }
    
    .btn-brand-outline {
        background: transparent;
        color: var(--brand-blue);
        border: 2px solid var(--brand-blue);
        padding: 10px 30px;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    .btn-brand-outline:hover {
        background: var(--brand-blue);
        color: #fff;
        box-shadow: 0 4px 12px rgba(37, 56, 148, 0.15);
    }

    /* --- HERO SECTION --- */
    .nf-hero { 
        padding: 7rem 0 6rem; 
        background: radial-gradient(circle at 100% 0%, rgba(99, 169, 0, 0.03) 0%, transparent 40%),
                    radial-gradient(circle at 0% 100%, rgba(37, 56, 148, 0.03) 0%, transparent 40%);
    }
    
    /* 3D Card Effect */
    .nf-hero-mockup {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px;
        padding: 30px;
        box-shadow: var(--shadow-xl);
        transform: perspective(1000px) rotateY(-5deg) rotateX(2deg);
        transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
    }
    .nf-hero-mockup:hover {
        transform: perspective(1000px) rotateY(0) rotateX(0);
    }

    /* --- FEATURE CARDS (Glassmorphism Light) --- */
    .nf-feature-card {
        background: #fff;
        border-radius: 20px;
        padding: 40px 30px;
        height: 100%;
        border: 1px solid var(--border-color);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        z-index: 1;
        overflow: hidden;
    }
    .nf-feature-card::before {
        content: '';
        position: absolute; top: 0; left: 0; width: 4px; height: 0;
        background: var(--brand-blue);
        transition: height 0.4s ease;
    }
    .nf-feature-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-xl);
        border-color: transparent;
    }
    .nf-feature-card:hover::before { height: 100%; }
    
    .feature-icon-circle {
        width: 60px; height: 60px;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 25px;
        transition: transform 0.3s ease;
    }
    .nf-feature-card:hover .feature-icon-circle { transform: scale(1.1) rotate(5deg); }

    /* --- PROFILE CARDS (Premium) --- */
    .nf-profile-card {
        height: 100%;
        border-radius: 24px;
        padding: 40px;
        display: flex;
        flex-direction: column;
        position: relative;
        transition: all 0.4s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }

    /* Mentor Card (Deep Corporate Blue) */
    .card-mentor {
        background: linear-gradient(160deg, #1e2959 0%, var(--brand-blue) 100%);
        color: #fff;
        box-shadow: 0 20px 40px -10px rgba(37, 56, 148, 0.4);
    }
    .card-mentor:hover { transform: translateY(-8px) scale(1.01); }
    .card-mentor .icon-box {
        background: rgba(255,255,255,0.1);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.2);
    }
    .card-mentor .btn-profile {
        background: #fff; color: var(--brand-blue);
    }

    /* Mentee Card (Clean White with Green Accents) */
    .card-mentee {
        background: #fff;
        border: 2px solid var(--bg-subtle);
        box-shadow: var(--shadow-xl);
    }
    .card-mentee:hover { border-color: var(--brand-green); transform: translateY(-8px); }
    .card-mentee .icon-box {
        background: rgba(99, 169, 0, 0.1);
        color: var(--brand-green);
    }
    .card-mentee .btn-profile {
        background: var(--brand-green); color: #fff;
        box-shadow: 0 4px 15px rgba(99, 169, 0, 0.3);
    }
    .card-mentee .btn-profile:hover {
        background: var(--brand-green-dark);
    }

    .icon-box {
        width: 70px; height: 70px; border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem; margin-bottom: 30px;
    }
    .btn-profile {
        padding: 14px 20px; border-radius: 14px; font-weight: 700;
        text-align: center; text-decoration: none; transition: all 0.3s;
        margin-top: auto; border: none;
    }

    /* --- NEWS CARD (Minimalist) --- */
    .news-card-minimal {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        height: 100%;
    }
    .news-card-minimal:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
    }
    .news-date-badge {
        position: absolute; top: 16px; left: 16px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(4px);
        padding: 8px 14px;
        border-radius: 12px;
        font-weight: 700;
        color: var(--brand-blue);
        font-size: 0.85rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* --- UTILS --- */
    .badge-pill-soft {
        padding: 6px 16px;
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .bg-blue-soft { background: rgba(37, 56, 148, 0.08); color: var(--brand-blue); }
    .bg-green-soft { background: rgba(99, 169, 0, 0.08); color: var(--brand-green); }
    
    .avatar-group { display: flex; padding-left: 10px; }
    .avatar-circle {
        width: 36px; height: 36px; border-radius: 50%;
        border: 3px solid #fff; margin-left: -12px;
        background-size: cover; background-position: center;
        background-color: #e2e8f0;
        position: relative;
    }

    /* Partners Grayscale */
    .partner-logo {
        height: 100px; width: auto; object-fit: contain;
        transition: all 0.4s ease;
    }
    .partner-logo:hover { filter: grayscale(0%); opacity: 1; transform: scale(1.05); }
</style>

<section id="hero" class="nf-hero">
  <div class="container-lg">
    <div class="row align-items-center gy-5">
      
      <div class="col-lg-6 order-1 order-lg-1">
        <div class="nf-animate" data-animate="fade-up">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill border bg-white mb-4" style="border-color: rgba(37, 56, 148, 0.15);">
                <span class="badge rounded-circle p-1" style="background: var(--brand-green);"></span>
                <span class="small fw-bold" style="color: var(--brand-blue); letter-spacing: 0.5px;"><?= __('home.hero_badge') ?></span>
            </div>

            <h1 class="display-4 fw-bolder mb-4" style="line-height: 1.15; color: #0f172a;">
                <?= __('home.hero_title') ?>
            </h1>

            <p class="lead text-secondary mb-5" style="font-weight: 400; line-height: 1.6; max-width: 540px;">
                <?= __('home.hero_subtitle') ?>
            </p>

            <div class="d-flex flex-wrap gap-3 mb-5">
                <a href="<?= Url::to('apply/mentee') ?>" class="btn btn-brand-primary shadow-lg">
                    <?= __('home.btn_mentee') ?>
                </a>
                <a href="<?= Url::to('apply/mentor') ?>" class="btn btn-brand-outline">
                    <?= __('home.btn_mentor') ?>
                </a>
            </div>

            <div class="d-flex align-items-center gap-4 pt-4 border-top" style="border-color: rgba(0,0,0,0.06) !important;">
                <div class="d-flex flex-column">
                    <h4 class="fw-bold mb-0 text-gradient"><?= $totalMembers ?>+</h4>
                    <span class="small text-muted fw-medium"><?= __('home.stat_active') ?></span>
                </div>
                <div style="width: 1px; height: 30px; background: #e2e8f0;"></div>
                <div class="d-flex flex-column">
                    <div class="d-flex align-items-center gap-1">
                        <span style="color: #fbbf24;">★★★★★</span>
                        <span class="fw-bold small text-dark">4.9</span>
                    </div>
                    <span class="small text-muted fw-medium"><?= __('home.stat_rating') ?></span>
                </div>
            </div>
        </div>
      </div>

      <div class="col-lg-6 order-1 order-lg-2">
        <div class="nf-hero-mockup-wrapper nf-animate ps-lg-5" data-animate="fade-left">
          <div class="nf-hero-mockup">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4">
              <div class="d-flex align-items-center gap-2">
                <div class="fw-bold text-dark small">Live Activity</div>
                <span class="badge bg-success-subtle text-success rounded-pill px-2" style="font-size: 10px;">● Online</span>
              </div>
              <div class="d-flex gap-1">
                <div style="width:8px; height:8px; border-radius:50%; background:#cbd5e1;"></div>
                <div style="width:8px; height:8px; border-radius:50%; background:#cbd5e1;"></div>
              </div>
            </div>

            <div class="row g-3">
                <div class="col-6">
                  <div class="p-4 rounded-4 h-100" style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border: 1px solid #bae6fd;">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                      <span class="small fw-bold text-primary text-uppercase tracking-wider"><?= __('home.stat_mentors') ?></span>
                      <span class="bg-white rounded-circle p-1 shadow-sm" style="font-size: 12px;">💼</span>
                    </div>
                    <h2 class="mb-0 text-primary fw-bold"><?= $mentorsCount ?></h2>
                  </div>
                </div>
                <div class="col-6">
                   <div class="p-4 rounded-4 h-100" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid #bbf7d0;">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                      <span class="small fw-bold text-success text-uppercase tracking-wider"><?= __('home.stat_mentees') ?></span>
                      <span class="bg-white rounded-circle p-1 shadow-sm" style="font-size: 12px;">🎓</span>
                    </div>
                    <h2 class="mb-0 text-success fw-bold"><?= $menteesCount ?></h2>
                  </div>
                </div>
                
                <div class="col-12 mt-2">
                    <div class="p-4 bg-white rounded-4 border shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="small fw-bold text-secondary"><?= __('home.stat_growth') ?></span>
                            <span class="text-success small fw-bold">+12%</span>
                        </div>
                        <div class="d-flex align-items-end justify-content-between" style="height: 60px; gap: 8px;">
                            <div style="width:100%; background:#f1f5f9; height: 30%; border-radius: 4px;"></div>
                            <div style="width:100%; background:#f1f5f9; height: 50%; border-radius: 4px;"></div>
                            <div style="width:100%; background:#f1f5f9; height: 40%; border-radius: 4px;"></div>
                            <div style="width:100%; background:#f1f5f9; height: 70%; border-radius: 4px;"></div>
                            <div style="width:100%; background: var(--brand-blue); height: 85%; border-radius: 4px;"></div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <img src="" alt="">
</section>

<section class="py-5 border-bottom bg-white">
  <div class="container-lg">
    <p class="text-center text-muted small fw-bold text-uppercase mb-4" style="letter-spacing: 1px;"><?= __('home.partners_title') ?></p>
    <div class="d-flex justify-content-center align-items-center flex-wrap gap-5 opacity-100">
        <img style="filter: grayscale(0%);" src="<?= Url::asset('img/partners/4.png') ?>" class="partner-logo" alt="Partner">
        <img style="filter: grayscale(0%);" src="<?= Url::asset('img/partners/2.png') ?>" class="partner-logo" alt="Partner">
        <img style="filter: grayscale(0%);" src="<?= Url::asset('img/partners/3.png') ?>" class="partner-logo" alt="Partner">
        <img style="filter: grayscale(0%);" src="<?= Url::asset('img/partners/1.png') ?>" class="partner-logo" alt="Partner">
    </div>
  </div>
</section>

<section id="program" class="nf-section bg-subtle py-5">
  <div class="container-lg">
    <div class="row mb-5 text-center justify-content-center">
        <div class="col-lg-7">
            <span class="badge-pill-soft bg-blue-soft mb-3 d-inline-block"><?= __('home.prog_badge') ?></span>
            <h2 class="fw-bolder display-6 mb-3" style="color: var(--brand-blue);"><?= __('home.prog_title') ?></h2>
            <p class="text-secondary lead fs-6"><?= __('home.prog_desc') ?></p>
        </div>
    </div>

    <div class="row g-4">
      <div class="col-md-4 nf-animate" data-animate="fade-up">
        <div class="nf-feature-card">
          <div class="feature-icon-circle bg-blue-soft text-primary d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-bullseye" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M8 13A5 5 0 1 1 8 3a5 5 0 0 1 0 10zm0 1A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
              <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/>
              <path d="M9.5 8a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
            </svg>
          </div>
          <h4 class="fw-bold mb-3 text-dark"><?= __('home.feat_1_title') ?></h4>
          <p class="text-secondary small mb-0 line-height-lg">
            <?= __('home.feat_1_desc') ?>
          </p>
        </div>
      </div>

      <div class="col-md-4 nf-animate" data-animate="fade-up" style="animation-delay: 0.1s;">
        <div class="nf-feature-card">
          <div class="feature-icon-circle bg-green-soft d-flex align-items-center justify-content-center" style="color: var(--brand-green);">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-journal-bookmark-fill" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8V1z"/>
              <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
              <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
            </svg>
          </div>
          <h4 class="fw-bold mb-3 text-dark"><?= __('home.feat_2_title') ?></h4>
          <p class="text-secondary small mb-0 line-height-lg">
            <?= __('home.feat_2_desc') ?>
          </p>
        </div>
      </div>

      <div class="col-md-4 nf-animate" data-animate="fade-up" style="animation-delay: 0.2s;">
        <div class="nf-feature-card">
          <div class="feature-icon-circle bg-blue-soft text-primary d-flex align-items-center justify-content-center">
             <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
              <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
              <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
              <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
            </svg>
          </div>
          <h4 class="fw-bold mb-3 text-dark"><?= __('home.feat_3_title') ?></h4>
          <p class="text-secondary small mb-0 line-height-lg">
            <?= __('home.feat_3_desc') ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="apply" class="nf-section py-5 position-relative overflow-hidden">
  <div style="position: absolute; top: 0; left: 0; width: 100%; height: 60%; background: #f8fafc; z-index: -1;"></div>
  
  <div class="container-lg">
    <div class="text-center mb-5 nf-animate" data-animate="fade-up">
      <h2 class="fw-bolder mb-2" style="color: var(--brand-blue);"><?= __('home.role_title') ?></h2>
      <p class="text-secondary mx-auto" style="max-width: 500px;">
        <?= __('home.role_subtitle') ?>
      </p>
    </div>

    <div class="row g-4 justify-content-center align-items-stretch">
      
      <div class="col-md-6 col-lg-5 nf-animate" data-animate="fade-right">
        <div class="nf-profile-card card-mentor">
          <div class="d-flex justify-content-between align-items-start w-100">
              <div class="icon-box">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M10 5a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2v2"/><path d="M10 16h4"/></svg>
              </div>
              <span class="badge bg-white text-dark bg-opacity-25 border border-white border-opacity-25 backdrop-blur">Senior</span>
          </div>
          
          <h3 class="h2 fw-bold mb-3"><?= __('home.mentor_card_title') ?></h3>
          <p class="opacity-75 mb-5 fs-6 fw-light" style="line-height: 1.6;">
            <?= __('home.mentor_card_desc') ?>
          </p>
          
          <a href="<?= Url::to('apply/mentor') ?>" class="btn-profile shadow-sm">
            <?= __('home.btn_mentor') ?>
          </a>
        </div>
      </div>

      <div class="col-md-6 col-lg-5 nf-animate" data-animate="fade-left">
        <div class="nf-profile-card card-mentee">
          <div class="icon-box">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5zM12 21v-7"/><path d="M12 18v-3"></path><path d="M16 10.5v-3"></path><path d="M8 10.5v-3"></path></svg>
          </div>
          
          <h3 class="h2 fw-bold mb-3 text-dark"><?= __('home.mentee_card_title') ?></h3>
          <p class="text-secondary mb-5 fs-6" style="line-height: 1.6;">
            <?= __('home.mentee_card_desc') ?>
          </p>
          
          <a href="<?= Url::to('apply/mentee') ?>" class="btn-profile">
            <?= __('home.btn_mentee') ?>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<section id="news" class="nf-section py-5">
  <div class="container-lg">
    <div class="d-flex align-items-end justify-content-between mb-5 nf-animate" data-animate="fade-up">
      <div>
        <span class="text-uppercase fw-bold small" style="color: var(--brand-green); letter-spacing: 1px;"><?= __('home.news_badge') ?></span>
        <h2 class="fw-bolder mb-0 display-6 text-dark"><?= __('home.news_title') ?></h2>
      </div>
      <a href="<?= Url::to('news') ?>" class="btn btn-link text-decoration-none fw-bold p-0" style="color: var(--brand-blue);">
        <?= __('home.news_all') ?> →
      </a>
    </div>

    <div class="row g-4">
      <?php if (empty($news)): ?>
         <div class="col-12 text-center py-5 bg-light rounded-4">
            <p class="text-muted mb-0"><?= __('home.news_empty') ?></p>
         </div>
      <?php else: ?>
        <?php foreach ($news as $index => $item): 
             // Динамический выбор языка для контента из БД
             $title = $item['title_' . $lang] ?? $item['title_hy'];
             $excerpt = $item['excerpt_' . $lang] ?? $item['excerpt_hy'];
        ?>
        <div class="col-md-4 d-flex nf-animate" data-animate="fade-up" style="animation-delay: <?= $index * 100 ?>ms">
          <article class="card news-card-minimal h-100 w-100">
            <div class="position-relative overflow-hidden h-50">
                 <?php if (!empty($item['image_url'])): ?>
                    <img src="<?= Url::to(htmlspecialchars($item['image_url'])) ?>" class="card-img-top w-100 h-100 object-fit-cover" alt="<?= htmlspecialchars($title) ?>">
                <?php else: ?>
                    <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-muted fs-1">📷</div>
                <?php endif; ?>
                <div class="news-date-badge">
                    <?= date('d M', strtotime($item['published_at'])) ?>
                </div>
            </div>

            <div class="card-body p-4 d-flex flex-column">
                <div class="mb-2">
                     <span class="badge-pill-soft bg-blue-soft" style="font-size: 0.65rem;">News</span>
                </div>
                <h5 class="fw-bold mb-3 text-dark">
                  <a href="<?= Url::to('news/' . $item['slug']) ?>" class="text-decoration-none text-dark stretched-link">
                    <?= htmlspecialchars($title) ?>
                  </a>
                </h5>
                <p class="card-text text-secondary small flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                  <?= htmlspecialchars(mb_substr($excerpt ?? '', 0, 100)) . '...' ?>
                </p>
            </div>
          </article>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php if (!empty($events)): ?>
<section id="events" class="nf-section py-5 bg-white border-top">
  <div class="container-lg">
    
    <div class="d-flex align-items-end justify-content-between mb-5 nf-animate" data-animate="fade-up">
      <div>
        <span class="text-uppercase fw-bold small" style="color: var(--brand-blue); letter-spacing: 1px;">
            <?= __('events.badge', 'Օրացույց') ?>
        </span>
        <h2 class="fw-bolder mb-0 display-6 text-dark">
            <?= __('events.title', 'Առաջիկա Միջոցառումներ') ?>
        </h2>
      </div>
      <a href="<?= Url::to('events') ?>" class="btn btn-link text-decoration-none fw-bold p-0" style="color: var(--brand-green);">
        <?= __('home.news_all', 'Դիտել բոլորը') ?> →
      </a>
    </div>

    <div class="row g-4">
        <?php foreach($events as $ev): 
            $eTitle = $ev['title_' . $lang] ?? $ev['title_hy'];
            $eLoc   = $ev['location_' . $lang] ?? $ev['location_hy'];
            
            // Форматирование даты
            $dateObj = strtotime($ev['event_date']);
            $day = date('d', $dateObj);
            $month = date('M', $dateObj); // Short month name
        ?>
        <div class="col-md-4 nf-animate" data-animate="fade-up">
            <a href="<?= Url::to('events/' . $ev['id']) ?>" class="text-decoration-none text-dark">
                <div class="card border-0 h-100 shadow-sm hover-lift" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                    
                    <div class="position-relative overflow-hidden rounded-top-4" style="height: 200px;">
                        <?php if(!empty($ev['image_url'])): ?>
                            <img src="<?= Url::to($ev['image_url']) ?>" class="w-100 h-100 object-fit-cover" alt="<?= htmlspecialchars($eTitle) ?>">
                        <?php else: ?>
                            <div class="w-100 h-100" style="background: linear-gradient(135deg, var(--brand-blue) 0%, var(--brand-green) 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem;">
                                📅
                            </div>
                        <?php endif; ?>
                        
                        <div class="position-absolute top-0 start-0 m-3 bg-white rounded-3 text-center shadow-sm p-2" style="min-width: 60px;">
                            <div class="fw-bold text-danger fs-4" style="line-height: 1;"><?= $day ?></div>
                            <div class="small text-muted fw-bold text-uppercase" style="font-size: 0.7rem;"><?= $month ?></div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="small text-muted mb-2 fw-bold text-uppercase" style="font-size: 0.75rem; color: var(--brand-green) !important;">
                            📍 <?= htmlspecialchars($eLoc ?: 'Online') ?>
                            <?php if($ev['start_time']): ?>
                                <span class="mx-1">•</span> 🕒 <?= date('H:i', strtotime($ev['start_time'])) ?>
                            <?php endif; ?>
                        </div>
                        <h5 class="fw-bold mb-0"><?= htmlspecialchars($eTitle) ?></h5>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>

  </div>
</section>

<style>
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
</style>
<?php endif; ?>

<section class="nf-section py-5 position-relative" style="background: var(--brand-blue); overflow: hidden;">
    <div style="position: absolute; top: -50%; right: -10%; width: 500px; height: 500px; border-radius: 50%; border: 40px solid rgba(255,255,255,0.03);"></div>
    <div style="position: absolute; bottom: -50%; left: -10%; width: 600px; height: 600px; border-radius: 50%; background: radial-gradient(circle, rgba(99, 169, 0, 0.2) 0%, transparent 70%);"></div>

  <div class="container-lg position-relative z-1">
    <div class="row align-items-center g-5">
        <div class="col-lg-8 text-center text-lg-start">
          <h2 class="display-5 fw-bold text-white mb-3"><?= __('home.cta_title') ?></h2>
          <p class="text-white text-opacity-75 lead mb-0"><?= __('home.cta_desc') ?></p>
        </div>
        <div class="col-lg-4 d-flex justify-content-center justify-content-lg-end gap-3">
          <a href="<?= Url::to('apply/mentee') ?>" class="btn btn-light fw-bold px-4 py-3 rounded-pill shadow-lg" style="color: var(--brand-blue);">
             <?= __('home.cta_mentee') ?>
          </a>
           <a href="<?= Url::to('apply/mentor') ?>" class="btn btn-outline-light fw-bold px-4 py-3 rounded-pill">
             <?= __('home.cta_mentor') ?>
          </a>
        </div>
    </div>
  </div>
</section>