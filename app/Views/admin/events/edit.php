<?php use Core\Url; ?>

<div class="container-fluid px-0">
    <form action="<?= Url::to('admin/events/' . $event['id'] . '/update') ?>" method="POST" enctype="multipart/form-data">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="<?= Url::to('admin/events') ?>" class="text-decoration-none text-muted small">← Վերադառնալ</a>
                <h3 class="fw-bold mb-0">✏️ Խմբագրել Միջոցառումը</h3>
            </div>
            <button type="submit" class="btn btn-primary px-4">💾 Թարմացնել (Update)</button>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card p-4 border-0 shadow-sm">
                    
                    <ul class="nav nav-tabs mb-3" id="eventTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" id="hy-tab" data-bs-toggle="tab" data-bs-target="#lang-hy" type="button">🇦🇲 HY</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#lang-en" type="button">🇬🇧 EN</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="eventTabsContent">
                        <div class="tab-pane fade show active" id="lang-hy" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Վերնագիր (HY) <span class="text-danger">*</span></label>
                                <input type="text" name="title_hy" class="form-control" required value="<?= htmlspecialchars($event['title_hy']) ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Վայր (HY)</label>
                                <input type="text" name="location_hy" class="form-control" value="<?= htmlspecialchars($event['location_hy']) ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Նկարագրություն (HY)</label>
                                <textarea name="description_hy" class="form-control" rows="5"><?= htmlspecialchars($event['description_hy']) ?></textarea>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="lang-en" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Title (EN)</label>
                                <input type="text" name="title_en" class="form-control" value="<?= htmlspecialchars($event['title_en']) ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Location (EN)</label>
                                <input type="text" name="location_en" class="form-control" value="<?= htmlspecialchars($event['location_en']) ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description (EN)</label>
                                <textarea name="description_en" class="form-control" rows="5"><?= htmlspecialchars($event['description_en']) ?></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="card p-4 border-0 shadow-sm mb-4">
                    <h6 class="fw-bold text-muted mb-3">Ժամանակ և Ամսաթիվ</h6>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Ամսաթիվ <span class="text-danger">*</span></label>
                        <input type="date" name="event_date" class="form-control" required value="<?= $event['event_date'] ?>">
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold">Ժամ (Սկիզբ)</label>
                        <input type="time" name="start_time" class="form-control" value="<?= $event['start_time'] ?>">
                    </div>
                </div>

                <div class="card p-4 border-0 shadow-sm">
                    <h6 class="fw-bold text-muted mb-3">Գլխավոր Նկար</h6>
                    
                    <?php if(!empty($event['image_url'])): ?>
                        <div class="mb-3 text-center bg-light rounded p-2">
                            <img src="<?= Url::to($event['image_url']) ?>" class="img-fluid rounded shadow-sm" style="max-height: 120px;">
                            <div class="small text-muted mt-1">Ընթացիկ նկար</div>
                        </div>
                    <?php endif; ?>

                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div class="form-text small">Ընտրեք նորը՝ հինը փոխարինելու համար (Max 5MB)</div>
                </div>
            </div>
        </div>
    </form>
</div>