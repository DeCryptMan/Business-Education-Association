<?php
use Core\Url;
use Core\Lang;
use Core\Csrf;
?>
<!DOCTYPE html>
<html lang="<?= Lang::current() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Business & Education</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= Url::asset('css/style.css') ?>">

    <style>
        /* Специфичные стили для логина */
        .nf-login-body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .nf-login-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 10;
            overflow: hidden;
        }

        .nf-login-header {
            text-align: center;
            padding: 40px 40px 20px;
        }

        .nf-login-logo {
            width: 60px; height: 60px;
            background: #10b981;
            color: white;
            font-weight: 800;
            font-size: 1.5rem;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .nf-form-control {
            background: rgba(255,255,255,0.6);
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        .nf-form-control:focus {
            background: #fff;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .nf-login-footer {
            background: rgba(0,0,0,0.02);
            padding: 20px;
            text-align: center;
            border-top: 1px solid rgba(0,0,0,0.05);
        }
        
        /* Анимированный фон */
        .nf-blob-1, .nf-blob-2 {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 1;
            animation: float 10s infinite ease-in-out;
        }
        .nf-blob-1 {
            width: 400px; height: 400px;
            background: rgba(16, 185, 129, 0.3);
            top: -100px; left: -100px;
        }
        .nf-blob-2 {
            width: 300px; height: 300px;
            background: rgba(59, 130, 246, 0.3);
            bottom: -50px; right: -50px;
            animation-delay: -5s;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, 50px); }
        }
    </style>
</head>
<body class="nf-body nf-login-body">

    <div class="nf-blob-1"></div>
    <div class="nf-blob-2"></div>
    <div class="nf-bg-grid" style="opacity: 0.3"></div>

    <div class="nf-login-card nf-animate" data-animate="fade-up">
        <div class="nf-login-header">
            <img style="margin-bottom:10px;" width="150" src="./assets/img/logo-am.png" alt="">
            <h4 class="fw-bold text-dark mb-1">Admin Panel</h4>
            <p class="text-muted small mb-0">Sign in to manage the platform</p>
        </div>

        <div class="p-4 pt-0">
            <?php if (isset($_SESSION['flash_error'])): ?>
                <div class="alert alert-danger py-2 small rounded-3 border-0 bg-danger-subtle text-danger mb-4">
                    <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
                </div>
            <?php endif; ?>

            <form action="<?= Url::to('login') ?>" method="POST">
                
                <?= Csrf::field() ?>

                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control nf-form-control" id="emailInput" placeholder="name@example.com" required>
                    <label for="emailInput" class="text-muted">Email Address</label>
                </div>
                
                <div class="form-floating mb-4">
                    <input type="password" name="password" class="form-control nf-form-control" id="passInput" placeholder="Password" required>
                    <label for="passInput" class="text-muted">Password</label>
                </div>

                <button class="btn nf-btn-primary w-100 py-3 rounded-3 fw-bold fs-6">
                    Sign In
                </button>
            </form>
        </div>

        <div class="nf-login-footer">
            <a href="<?= Url::to('/') ?>" class="text-decoration-none text-muted small fw-medium hover-primary">
                ← Back to Website
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });
            document.querySelectorAll('.nf-animate').forEach((el) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                observer.observe(el);
            });
        });
    </script>
</body>
</html>