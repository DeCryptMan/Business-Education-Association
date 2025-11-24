<?php use Core\Url; ?>

<style>
    /* --- MENTORS PAGE DESIGN SYSTEM --- */
    :root {
        --m-card-bg: #ffffff;
        --m-border: #f1f5f9;
        --m-blue: #253894;
        --m-green: #63A900;
    }

    .mentors-hero {
        padding: 5rem 0 4rem;
        background: radial-gradient(circle at 50% 0%, rgba(37, 56, 148, 0.05) 0%, transparent 50%);
        text-align: center;
    }

    /* Grid System */
    .mentors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
        padding-bottom: 5rem;
    }

    /* The Square Card */
    .mentor-card {
        background: var(--m-card-bg);
        border: 1px solid var(--m-border);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .mentor-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -5px rgba(37, 56, 148, 0.1);
        border-color: transparent;
    }

    /* Photo Container (Square-ish aspect) */
    .mentor-photo-box {
        width: 100%;
        padding-top: 100%; /* 1:1 Aspect Ratio */
        position: relative;
        background: #f8fafc;
        overflow: hidden;
    }

    .mentor-img {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        object-fit: cover; /* Ensures image fills square nicely */
        transition: transform 0.5s ease;

    }
/* --- ИСПРАВЛЕНИЕ: Увеличиваем 4-ю картинку (последнюю) --- */
    .mentor-card:nth-child(4) .mentor-img {
        transform: scale(1.35);
        transform-origin: top center; /* Чтобы лицо не обрезалось сверху */
    }
    /* При наведении на 4-ю карточку увеличиваем еще чуть больше, чтобы сохранить эффект */
    .mentor-card:nth-child(4):hover .mentor-img {
        transform: scale(1.45);
    }
    .mentor-card:hover .mentor-img {
        transform: scale(1.05);
    }

    /* Info Overlay */
    .mentor-info {
        padding: 24px;
        background: #fff;
        position: relative;
        z-index: 2;
        border-top: 1px solid var(--m-border);
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    .mentor-name {
        font-size: 1.1rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
        letter-spacing: -0.02em;
    }

    .mentor-role {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--m-green);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }

    .mentor-company {
        font-size: 0.9rem;
        color: #64748b;
    }

    /* Decorative Elements */
    .mentor-card::after {
        content: '';
        position: absolute; bottom: 0; left: 0; width: 100%; height: 3px;
        background: linear-gradient(90deg, var(--m-blue), var(--m-green));
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }
    .mentor-card:hover::after { transform: scaleX(1); }
</style>

<section class="mentors-hero">
    <div class="container-lg">
        <span class="badge rounded-pill px-3 py-2 mb-3 fw-bold" style="background: rgba(37, 56, 148, 0.08); color: #253894;">
            ՄԵՐ ՓՈՐՁԱԳԵՏՆԵՐԸ
        </span>
        <h1 class="display-4 fw-bold mb-3 text-dark">Մեր Մենթորները</h1>
        <p class="text-muted lead mx-auto" style="max-width: 600px;">
            Ծանոթացեք ոլորտի առաջատար մասնագետների հետ, ովքեր պատրաստ են կիսվել իրենց փորձով և գիտելիքներով։
        </p>
    </div>
</section>

<section class="container-lg">
    <div class="mentors-grid">
        
        <?php 
        // --- ВРЕМЕННЫЕ ДАННЫЕ (HARDCODED) ---
        // Здесь прописаны 4 ментора вручную.
        // Вы можете менять имена и пути к картинкам здесь.
        
        $staticMentors = [
            [
                'name' => 'Նարինե Իսահակյան',
                'role' => '',
                'company' => '  ',
                'img' => 'assets/img/1.jpg' 
            ],
            [
                'name' => 'Կարինե Ղուկասյան',
                'role' => '',
                'company' => '',
                'img' => 'assets/img/2.jpg'
            ],
            [
                'name' => 'Արթուր Մելիքյան',
                'role' => '',
                'company' => '',
                'img' => 'assets/img/3.jpg'
            ],
            [
                'name' => 'Քրիստինա Աբելյան',
                'role' => '',
                'company' => '',
                'img' => 'assets/img/4.jpg'
            ]
        ];
        ?>

        <?php foreach($staticMentors as $m): ?>
            <article class="mentor-card">
                <div class="mentor-photo-box">
                    <img src="<?= Url::to($m['img']) ?>" class="mentor-img" alt="<?= htmlspecialchars($m['name']) ?>">
                </div>
                
                <div class="mentor-info">
                    <h3 class="mentor-name"><?= htmlspecialchars($m['name']) ?></h3>
                    <div class="mentor-role"><?= htmlspecialchars($m['role']) ?></div>
                    <div class="mentor-company"><?= htmlspecialchars($m['company']) ?></div>
                </div>
            </article>
        <?php endforeach; ?>

    </div>
</section>
