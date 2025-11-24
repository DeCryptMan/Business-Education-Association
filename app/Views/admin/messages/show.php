<?php use Core\Url; ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        
        <div class="mb-4 d-flex align-items-center gap-3">
            <a href="<?= Url::to('admin/messages') ?>" class="btn btn-light border shadow-sm rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                ←
            </a>
            <h4 class="mb-0 fw-bold">Նամակի դիտում</h4>
        </div>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center fw-bold fs-4 shadow-sm" style="width: 56px; height: 56px;">
                            <?= strtoupper(mb_substr($msg['full_name'], 0, 1)) ?>
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-dark"><?= htmlspecialchars($msg['full_name']) ?></h5>
                            <div class="text-muted small">
                                From: <a href="mailto:<?= $msg['email'] ?>" class="text-decoration-none"><?= htmlspecialchars($msg['email']) ?></a>
                                <?php if($msg['phone']): ?>
                                    • 📱 <?= htmlspecialchars($msg['phone']) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="small text-muted mb-1"><?= date('d M Y, H:i', strtotime($msg['created_at'])) ?></div>
                        <span class="badge bg-light text-dark border">Topic: <?= htmlspecialchars($msg['topic']) ?></span>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="p-4 bg-light rounded-3 border" style="min-height: 200px; white-space: pre-wrap; font-size: 1.05rem; line-height: 1.6; color: #334155;">
<?= htmlspecialchars($msg['message']) ?>
                </div>
            </div>

            <div class="card-footer bg-white p-4 border-top d-flex justify-content-between align-items-center">
                <a href="mailto:<?= $msg['email'] ?>" class="btn btn-primary px-4 rounded-pill shadow-sm">
                    ↩️ Պատասխանել (Reply)
                </a>
                
                <form action="<?= Url::to('admin/messages/' . $msg['id'] . '/delete') ?>" method="POST" onsubmit="return confirm('Ջնջե՞լ նամակը:');">
                    <button class="btn btn-outline-danger rounded-pill px-4">
                        🗑️ Ջնջել
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>