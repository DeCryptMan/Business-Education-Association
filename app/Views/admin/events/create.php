<?php use Core\Url; ?>

<div class="container-fluid px-0">
    <form action="<?= Url::to('admin/events/store') ?>" method="POST" enctype="multipart/form-data">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">📅 Նոր Միջոցառում (New Event)</h3>
            <button type="submit" class="btn btn-success px-4">💾 Պահպանել</button>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card p-4 border-0 shadow-sm">
                    
                    <ul class="nav nav-tabs mb-3" id="eventTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="hy-tab" data-bs-toggle="tab" data-bs-target="#lang-hy" type="button">🇦🇲 HY</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#lang-en" type="button">🇬🇧 EN</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="eventTabsContent">
                        <div class="tab-pane fade show active" id="lang-hy" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Վերնագիր (HY) <span class="text-danger">*</span></label>
                                <input type="text" name="title_hy" class="form-control" required placeholder="Միջոցառման անվանումը...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Վայր (HY)</label>
                                <input type="text" name="location_hy" class="form-control" placeholder="Օր.՝ Երևան, Մարիոթ">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Նկարագրություն (HY)</label>
                                <textarea name="description_hy" class="form-control" rows="5" placeholder="Մանրամասներ..."></textarea>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="lang-en" role="tabpanel">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Title (EN)</label>
                                <input type="text" name="title_en" class="form-control" placeholder="Event Name...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Location (EN)</label>
                                <input type="text" name="location_en" class="form-control" placeholder="Ex: Yerevan, Marriott">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description (EN)</label>
                                <textarea name="description_en" class="form-control" rows="5" placeholder="Details..."></textarea>
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
                        <input type="date" name="event_date" class="form-control" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold">Ժամ (Սկիզբ)</label>
                        <input type="time" name="start_time" class="form-control">
                    </div>
                </div>

                <div class="card p-4 border-0 shadow-sm">
                    <h6 class="fw-bold text-muted mb-3">Գլխավոր Նկար</h6>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div class="form-text small">JPG, PNG (Max 5MB)</div>
                </div>
            </div>
        </div>
    </form>
</div>