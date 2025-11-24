<?php use Core\Url; ?>

<style>
    /* Базовый дизайн карточек */
    .nf-form-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; overflow: hidden; }
    .nf-form-header { padding: 20px 30px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; }
    .nf-form-body { padding: 30px; }

    /* Tabs for Languages */
    .nav-tabs { border-bottom: 2px solid #e2e8f0; }
    .nav-tabs .nav-link { color: #64748b; font-weight: 500; border: none; border-bottom: 2px solid transparent; padding: 10px 15px; margin-bottom: -2px;}
    .nav-tabs .nav-link.active { color: #3b82f6; border-bottom-color: #3b82f6; background: none; font-weight: 700; }
    
    /* Image Upload Section (Enhanced) */
    .nf-image-upload-wrapper { padding: 0 !important; } /* убираем внутренний паддинг карточки */
    .nf-image-upload {
        border: 2px dashed #e2e8f0; border-radius: 12px; padding: 30px; text-align: center;
        cursor: pointer; transition: all 0.2s; background: #f8fafc; position: relative;
    }
    .nf-image-upload:hover { border-color: #3b82f6; background: #eff6ff; }
    .nf-preview-img { max-width: 100%; height: auto; border-radius: 8px; display: none; margin: 0 auto; }
    .nf-upload-label { pointer-events: none; }
    .nf-preview-container { margin-bottom: 15px; position: relative; }
    .nf-remove-btn { position: absolute; top: 5px; right: 5px; z-index: 10; }
</style>

<div class="container-fluid px-0">
    
    <form action="<?= Url::to('admin/news/store') ?>" method="POST" enctype="multipart/form-data">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="<?= Url::to('admin/news') ?>" class="text-decoration-none text-muted small">← Վերադառնալ</a>
                <h3 class="fw-bold mt-1 mb-0">Ստեղծել Նորություն</h3>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success px-4 shadow-sm fw-medium">
                    💾 Հրապարակել (Save)
                </button>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-8">
                <div class="nf-form-card">
                    <!-- Заголовки вкладок -->
                    <div class="nf-form-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-secondary">Բովանդակություն</span>
                        <ul class="nav nav-tabs card-header-tabs" id="langTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="hy-tab" data-bs-toggle="tab" data-bs-target="#lang-hy" type="button" role="tab">🇦🇲 HY</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#lang-en" type="button" role="tab">🇬🇧 EN</button>
                            </li>
                        </ul>
                    </div>

                    <div class="nf-form-body">
                        <div class="tab-content">
                            
                            <div class="tab-pane fade show active" id="lang-hy" role="tabpanel">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary">Վերնագիր (Title HY) <span class="text-danger">*</span></label>
                                    <input type="text" name="title_hy" id="title_hy" class="form-control form-control-lg" 
                                           placeholder="Օրինակ՝ Մենթորության ծրագրի մեկնարկը..." required oninput="generateSlug()">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary">Համառոտ նկարագրություն (Excerpt)</label>
                                    <textarea name="excerpt_hy" class="form-control" rows="3" placeholder="Կարճ տեքստ ցուցակի համար..."></textarea>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label fw-semibold text-secondary">Տեքստ (Content)</label>
                                    <textarea name="body_hy" class="form-control" rows="10" placeholder="Հիմնական տեքստը այստեղ..."></textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="lang-en" role="tabpanel">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary">Title (EN)</label>
                                    <input type="text" name="title_en" class="form-control form-control-lg" placeholder="Ex: Mentorship Program Launch...">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary">Short Description</label>
                                    <textarea name="excerpt_en" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="mb-0">
                                    <label class="form-label fw-semibold text-secondary">Content</label>
                                    <textarea name="body_en" class="form-control" rows="10"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                
                <div class="nf-form-card mb-4">
                    <div class="nf-form-body">
                        
                        <!-- Дата публикации -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Ամսաթիվ (Date)</label>
                            <input type="date" name="published_at" class="form-control" value="<?= date('Y-m-d') ?>">
                            <div class="form-text small">Дата, которая будет отображаться на сайте</div>
                        </div>

                        <!-- Статус публикации -->
                        <div class="form-check form-switch mb-4 pb-2 border-bottom">
                            <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" checked>
                            <label class="form-check-label fw-bold" for="is_published">Հրապարակել կայքում</label>
                        </div>
                        
                        <!-- SLUG -->
                        <div class="mb-0">
                            <label class="form-label small text-muted fw-bold">SLUG (URL)</label>
                            <input type="text" name="slug" id="slug" class="form-control form-control-sm bg-light text-primary" required>
                            <div class="form-text small">Автоматически генерируется из заголовка</div>
                        </div>
                    </div>
                </div>

                <div class="nf-form-card nf-image-upload-wrapper">
                    <div class="nf-form-header">
                        <span class="fw-bold text-secondary">Գլխավոր նկար</span>
                    </div>
                    
                    <div class="nf-form-body">
                        
                        <div id="imagePreviewContainer" class="nf-preview-container" style="display:none;">
                            <img id="imagePreview" class="nf-preview-img mb-3">
                            <button type="button" class="btn btn-sm btn-danger nf-remove-btn" onclick="removeImage()">
                                ❌
                            </button>
                            <!-- Hidden field to tell backend to clear image if user uploads nothing but clicks delete -->
                            <input type="hidden" name="remove_image" id="removeImageInput" value="0">
                        </div>

                        <label class="nf-image-upload w-100" for="imageInput" id="uploadLabel">
                            <input type="file" name="image" id="imageInput" hidden accept="image/*" onchange="previewImage(this)">
                            
                            <div id="uploadPlaceholder" class="nf-upload-label">
                                <div class="fs-1 mb-2 text-muted">🖼️</div>
                                <span class="text-primary fw-medium">Ընտրել նկար</span>
                                <div class="small text-muted mt-1">JPG, PNG (Max 5MB)</div>
                            </div>
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
    // Preview Image and toggle visibility
    function previewImage(input) {
        const previewImg = document.getElementById('imagePreview');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const removeInput = document.getElementById('removeImageInput');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.style.display = 'block';
                uploadPlaceholder.style.display = 'none';
                removeInput.value = '0'; // Сбросить удаление, если файл выбран
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Remove Image Logic (clears preview and marks for removal on update)
    function removeImage() {
        const input = document.getElementById('imageInput');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const removeInput = document.getElementById('removeImageInput');
        
        // Сбросить файл в input
        input.value = ''; 
        // Скрыть превью и показать плейсхолдер
        previewContainer.style.display = 'none';
        uploadPlaceholder.style.display = 'block';
        // Установить флаг для удаления существующего изображения в БД
        removeInput.value = '1';
    }

    // Auto Slug Generator (для армянского языка)
    function generateSlug() {
        const title = document.getElementById('title_hy').value;
        let slug = title.toLowerCase().trim();
        
        const map = {
            'ա': 'a', 'բ': 'b', 'գ': 'g', 'դ': 'd', 'ե': 'e', 'զ': 'z', 'է': 'e', 'ը': 'y', 
            'թ': 't', 'ժ': 'zh', 'ի': 'i', 'լ': 'l', 'խ': 'kh', 'ծ': 'ts', 'կ': 'k', 'հ': 'h', 
            'ձ': 'dz', 'ղ': 'gh', 'ճ': 'ch', 'մ': 'm', 'յ': 'y', 'ն': 'n', 'շ': 'sh', 'ո': 'o', 
            'չ': 'ch', 'պ': 'p', 'ջ': 'j', 'ռ': 'r', 'ս': 's', 'վ': 'v', 'տ': 't', 'ր': 'r', 
            'ց': 'c', 'ու': 'u', 'փ': 'p', 'ք': 'q', 'և': 'ev', 'օ': 'o', 'ֆ': 'f'
        };
        
        slug = slug.split('').map(char => map[char] || char).join('');
        
        slug = slug.replace(/[^a-z0-9\s-]/g, '')
                   .replace(/\s+/g, '-')
                   .replace(/-+/g, '-');
                   
        document.getElementById('slug').value = slug;
    }
</script>