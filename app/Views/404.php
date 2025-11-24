<?php 
use Core\Url; 
?>

<style>
    /* --- OPTIMIZED 404 STYLES --- */
    :root {
        --nf-blue: #253894;
        --nf-green: #63A900;
        --nf-dark: #0f172a;
        --nf-muted: #64748b;
    }

    .nf-error-section {
        /* Use dvh for better mobile browser support (address bar handling) */
        min-height: 100dvh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        background: radial-gradient(circle at 50% 50%, #f8fafc 0%, #e2e8f0 100%);
        padding: 1rem;
    }

    /* Animated Background Blobs - Optimized */
    .nf-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px); /* Reduced blur slightly for mobile performance */
        opacity: 0.6;
        z-index: 0;
        will-change: transform; /* GPU acceleration hint */
        animation: floatBlob 12s infinite ease-in-out;
    }

    /* Responsive Blob Sizes */
    .nf-blob-1 {
        width: clamp(250px, 40vw, 400px);
        height: clamp(250px, 40vw, 400px);
        background: rgba(37, 56, 148, 0.2);
        top: -10%;
        left: -10%;
        animation-delay: 0s;
    }

    .nf-blob-2 {
        width: clamp(200px, 30vw, 300px);
        height: clamp(200px, 30vw, 300px);
        background: rgba(99, 169, 0, 0.2);
        bottom: 5%;
        right: -5%;
        animation-delay: -6s;
    }

    /* Glass Card - Responsive Padding */
    .nf-error-card {
        position: relative;
        z-index: 2;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px); /* Safari support */
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 24px;
        /* Responsive padding using clamp */
        padding: clamp(2rem, 5vw, 4rem) clamp(1.5rem, 4vw, 3rem);
        text-align: center;
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 100%;
        will-change: transform, opacity;
        animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* Typography */
    .nf-error-code {
        /* Fluid font size: scales between 5rem and 8rem based on screen width */
        font-size: clamp(5rem, 15vw, 8rem);
        font-weight: 900;
        line-height: 1;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, var(--nf-blue) 0%, var(--nf-green) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        position: relative;
        display: inline-block;
        user-select: none;
    }
    
    .nf-error-code::after {
        content: '404';
        position: absolute;
        top: 0;
        left: 3px;
        z-index: -1;
        background: none;
        -webkit-text-fill-color: rgba(0, 0, 0, 0.05);
        animation: glitch 3s infinite;
        will-change: transform;
    }

    .nf-error-title {
        font-size: clamp(1.25rem, 4vw, 1.5rem);
        font-weight: 700;
        color: var(--nf-dark);
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .nf-error-desc {
        color: var(--nf-muted);
        font-size: clamp(0.9rem, 2.5vw, 1rem);
        line-height: 1.6;
        margin-bottom: 2rem;
        max-width: 480px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Buttons */
    .nf-btn-home {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 32px;
        background: var(--nf-blue);
        color: white;
        font-weight: 600;
        font-size: 0.95rem;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 10px 20px -5px rgba(37, 56, 148, 0.3);
    }

    .nf-btn-home:hover, .nf-btn-home:active {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px -5px rgba(37, 56, 148, 0.4);
        color: white;
        background: #1e2e7a;
    }

    /* Animations */
    @keyframes floatBlob {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(20px, 30px); } /* Reduced movement for performance */
    }
    
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes glitch {
        0%, 100% { transform: translate(0); }
        92% { transform: translate(0); }
        94% { transform: translate(-2px, 2px); }
        96% { transform: translate(2px, -2px); }
        98% { transform: translate(-1px, 1px); }
    }

    /* Mobile Specific Adjustments */
    @media (max-width: 576px) {
        .nf-error-card {
            border-radius: 20px;
            padding: 2.5rem 1.5rem;
        }
        .nf-blob {
            filter: blur(40px); /* Lower blur for mobile performance */
        }
    }
</style>

<section class="nf-error-section">
    <div class="nf-blob nf-blob-1"></div>
    <div class="nf-blob nf-blob-2"></div>

    <div class="nf-error-card">
        <div class="nf-error-code" aria-hidden="true">404</div>
        
        <h1 class="nf-error-title">
            Էջը չի գտնվել
            <br>
            <span style="font-size: 0.9em; font-weight: 500; opacity: 0.7;">Page Not Found</span>
        </h1>
        
        <div class="nf-error-desc">
            <p class="mb-1">Այն էջը, որը փնտրում եք, հնարավոր է հեռացվել է, անվանափոխվել կամ ժամանակավորապես անհասանելի է:</p>
            <small class="opacity-75 d-block mt-2">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</small>
        </div>

        <div class="d-flex justify-content-center gap-3">
            <a href="<?= Url::to('/') ?>" class="nf-btn-home">
                <span class="me-2">←</span> Վերադառնալ Գլխավոր
            </a>
        </div>
    </div>
</section>