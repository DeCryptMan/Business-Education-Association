<?php use Core\Url; ?>

<style>
    /* Стили такие же как в create.php */
    .nf-form-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; overflow: hidden; }
    .nf-form-header { padding: 20px 30px; border-bottom: 1px solid #f1f5f9; background: #f8fafc; }
    .nf-form-body { padding: 30px; }
    .nav-tabs .nav-link { color: #64748b; font-weight: 500; border: none; border-bottom: 2px solid transparent; }
    .nav-tabs .nav-link.active { color: #3b82f6; border-bottom-color: #3b82f6; background: none; }
    
    .nf-image-upload {
        border: 2px dashed #e2e8f0; border-radius: 12px; padding: 20px; text-align: center;
        cursor: pointer; transition: all 0.2s; background: #f8fafc; position: relative; overflow: hidden;
    }
    .nf-image-upload:hover { border-color: #3b82f6; background: #eff6ff; }
    .nf-current-img { width: 100%; height: auto; border-radius: 8px; display: block; margin-bottom: 10px; }
</style>

<div class="container-fluid px-0">
    
    <form action="<?= Url::to('admin/news/' . $news['id'] . '/update') ?>" method="POST" enctype="multipart/form-data">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="<?= Url::to('admin/news') ?>" class="text-decoration-none text-muted small">← Վերադառնալ</a>
                <h3 class="fw-bold mt-1 mb-0">Խմբագրել (Edit): #<?= $news['id'] ?></h3>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= Url::to('news/' . $news['slug']) ?>" target="_blank" class="btn btn-white border shadow-sm">
                    🌐 Դիտել
                </a>
                <button type="submit" class="btn btn-primary px-4 shadow-sm fw-medium">
                    💾 Թարմացնել (Update)
                </button>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-8">
                <div class="nf-form-card">
                    <div class="nf-form-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-secondary">Բովանդակություն</span>
                        <ul class="nav nav-tabs card-header-tabs" id="langTabs" role="tablist">
                            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#lang-hy" type="button">🇦🇲 HY</button></li>
                            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#lang-en" type="button">🇬🇧 EN</button></li>
                        </ul>
                    </div>

                    <div class="nf-form-body">
                        <div class="tab-content">
                            
                            <div class="tab-pane fade show active" id="lang-hy">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary">Վերնագիր (HY) <span class="text-danger">*</span></label>
                                    <input type="text" name="title_hy" id="title_hy" class="form-control form-control-lg" 
                                           value="<?= htmlspecialchars($news['title_hy']) ?>" required oninput="generateSlug()">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary">Համառոտ (Excerpt)</label>
                                    <textarea name="excerpt_hy" class="form-control" rows="3"><?= htmlspecialchars($news['excerpt_hy'] ?? '') ?></textarea>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label fw-semibold text-secondary">Տեքստ (Body)</label>
                                    <textarea name="body_hy" class="form-control" rows="10"><?= htmlspecialchars($news['body_hy'] ?? '') ?></textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="lang-en">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary">Title (EN)</label>
                                    <input type="text" name="title_en" class="form-control form-control-lg" value="<?= htmlspecialchars($news['title_en'] ?? '') ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary">Short Description</label>
                                    <textarea name="excerpt_en" class="form-control" rows="3"><?= htmlspecialchars($news['excerpt_en'] ?? '') ?></textarea>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label fw-semibold text-secondary">Content</label>
                                    <textarea name="body_en" class="form-control" rows="10"><?= htmlspecialchars($news['body_en'] ?? '') ?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                
                <div class="nf-form-card mb-4">
                    <div class="nf-form-body">
                        
                        <?php 
                            // Получаем только дату из поля (Y-m-d). Если published_at пустой, берем created_at.
                            $dateToDisplay = $news['published_at'] ?? $news['created_at'];
                            $currentDate = substr($dateToDisplay, 0, 10);
                        ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Ամսաթիվ (Date)</label>
                            <!-- ПОЛЕ ДЛЯ ДАТЫ ПУБЛИКАЦИИ -->
                            <input type="date" name="published_at" class="form-control" value="<?= htmlspecialchars($currentDate) ?>">
                            <div class="form-text small">Дата, которая будет отображаться на сайте</div>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" <?= $news['is_published'] ? 'checked' : '' ?>>
                            <label class="form-check-label fw-bold" for="is_published">Հրապարակված է</label>
                        </div>
                        <div class="mb-0">
                            <label class="form-label small text-muted fw-bold">SLUG (URL)</label>
                            <input type="text" name="slug" id="slug" class="form-control form-control-sm bg-light text-primary" value="<?= htmlspecialchars($news['slug']) ?>" required>
                        </div>
                    </div>
                </div>

                <div class="nf-form-card mb-4">
                    <div class="nf-form-header">
                        <span class="fw-bold text-secondary">Նկար</span>
                    </div>
                    <div class="nf-form-body">
                        <label class="nf-image-upload w-100" for="imageInput">
                            <input type="file" name="image" id="imageInput" hidden accept="image/*" onchange="previewImage(this)">
                            
                            <?php if(!empty($news['image_url'])): ?>
                                <img id="imagePreview" src="<?= htmlspecialchars(Core\Url::to($news['image_url'])) ?>" class="nf-current-img">
                                <div class="small text-muted">Սեղմեք՝ փոխելու համար</div>
                            <?php else: ?>
                                <div id="uploadPlaceholder">
                                    <div class="fs-1 mb-2">🖼️</div>
                                    <span class="text-primary">Ավելացնել նկար</span>
                                </div>
                                <img id="imagePreview" class="nf-preview-img" style="display:none; max-width:100%;">
                            <?php endif; ?>
                        </label>
                    </div>
                </div>

                <div class="nf-form-card border-danger">
                    <div class="nf-form-body">
                        <h6 class="text-danger fw-bold">Վտանգավոր գոտի</h6>
                        <p class="small text-muted">Ջնջել այս նորությունը անվերադարձ։</p>
                        <button type="button" class="btn btn-outline-danger w-100 btn-sm" onclick="if(confirm('Ջնջե՞լ նորությունը:')) document.getElementById('deleteForm').submit();">
                            🗑️ Ջնջել նորությունը
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <form id="deleteForm" action="<?= Url::to('admin/news/' . $news['id'] . '/delete') ?>" method="POST" style="display:none;">
    </form>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('imagePreview');
                img.src = e.target.result;
                img.style.display = 'block';
                const ph = document.getElementById('uploadPlaceholder');
                if(ph) ph.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function generateSlug() {
        const title = document.getElementById('title_hy').value;
        let slug = title.toLowerCase().trim();
        const map = {
            'ա':'a','բ':'b','գ':'g','դ':'d','ե':'e','զ':'z','է':'e','ը':'y','թ':'t','ժ':'zh','ի':'i','լ':'l','խ':'kh','ծ':'ts','կ':'k','հ':'h','ձ':'dz','ղ':'gh','ճ':'ch','մ':'m','յ':'y','ն':'n','շ':'sh','ո':'o','չ':'ch','պ':'p','ջ':'j','ռ':'r','ս':'s','վ':'v','տ':'t','ր':'r','ց':'c','ու':'u','փ':'p','ք':'q','և':'ev','օ':'o','ֆ':'f'
        };
        slug = slug.split('').map(char => map[char] || char).join('');
        slug = slug.replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
        document.getElementById('slug').value = slug;
    }
</script>