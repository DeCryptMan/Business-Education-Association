<?php
use Core\Url;
use Core\Csrf;
?>

<style>
    /* --- MENTOR FORM STYLES --- */
    :root {
        --f-primary: #3b82f6;
        --f-primary-dark: #2563eb;
        --f-bg: #f8fafc;
        --f-card: #ffffff;
        --f-text: #0f172a;
        --f-text-muted: #64748b;
        --f-border: #e2e8f0;
        --f-input-bg: #f1f5f9;
        --f-radius: 12px;
    }

    .nf-app-container { max-width: 1200px; margin: 0 auto; padding-bottom: 80px; }
    
    /* Sidebar */
    .nf-sticky-sidebar { position: sticky; top: 100px; max-height: calc(100vh - 120px); overflow-y: auto; }
    .nf-nav-link {
        display: flex; align-items: center; padding: 10px 15px;
        color: var(--f-text-muted); text-decoration: none;
        border-radius: var(--f-radius); margin-bottom: 4px;
        transition: all 0.2s ease; font-weight: 500; font-size: 0.85rem;
    }
    .nf-nav-link:hover { background: #f1f5f9; color: var(--f-text); }
    .nf-nav-link.active {
        background: #eff6ff; color: var(--f-primary-dark);
        font-weight: 700; box-shadow: 0 2px 5px rgba(59, 130, 246, 0.05);
    }
    .nf-nav-num {
        width: 22px; height: 22px; display: flex; align-items: center; justify-content: center;
        border-radius: 50%; background: #e2e8f0; font-size: 0.7rem; margin-right: 10px;
    }
    .nf-nav-link.active .nf-nav-num { background: var(--f-primary); color: white; }

    /* Form Sections */
    .nf-form-section {
        background: var(--f-card); border: 1px solid var(--f-border);
        border-radius: 16px; padding: 30px; margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02); scroll-margin-top: 140px;
    }
    .nf-sec-title {
        font-size: 1.1rem; font-weight: 700; color: var(--f-text);
        margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #f1f5f9;
    }
    .nf-sub-title {
        font-size: 0.95rem; font-weight: 600; color: #475569;
        margin-top: 20px; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 0.5px;
    }

    /* Inputs */
    .form-floating > .form-control { background-color: var(--f-input-bg); border: 1px solid transparent; border-radius: 10px; }
    .form-floating > .form-control:focus { background-color: #fff; border-color: var(--f-primary); box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
    .form-floating > label { color: var(--f-text-muted); font-size: 0.85rem; }

    /* Checkboxes */
    .nf-check-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 10px; }
    .nf-check-label {
        display: flex; align-items: flex-start; gap: 10px; padding: 10px;
        background: var(--f-input-bg); border-radius: 8px; cursor: pointer; font-size: 0.9rem;
        border: 1px solid transparent; transition: 0.2s;
    }
    .nf-check-input:checked + .nf-check-label { background: #eff6ff; border-color: var(--f-primary); color: var(--f-primary-dark); }
    
    /* Submit Bar */
    .nf-submit-bar { position: sticky; bottom: 20px; z-index: 900; display: flex; justify-content: flex-end; }
    .nf-submit-btn {
        background: var(--f-primary); color: white; font-weight: 700; padding: 14px 40px;
        border-radius: 50px; border: none; box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        transition: 0.3s;
    }
    .nf-submit-btn:hover { transform: translateY(-2px); box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4); }
</style>

<section class="nf-section bg-light pt-5">
    <div class="container-lg mb-4">
        <div class="text-center max-w-3xl mx-auto">
            <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill mb-3">
                MENTOR APPLICATION
            </span>
            <h1 class="display-5 fw-bold text-dark mb-2"><?= __('mentor_form.title') ?></h1>
            <p class="text-muted"><?= __('mentor_form.subtitle') ?></p>
        </div>
    </div>

    <div class="nf-app-container container-lg">
        <form id="mentorForm" class="nf-contact-form" data-endpoint="<?= Url::to('backend/mentor-profile') ?>">
            <?= Csrf::field() ?>

            <div class="row g-4">
                <div class="col-lg-3 d-none d-lg-block">
                    <nav class="nf-sticky-sidebar" id="desktopNav">
                        <a href="#sec-1" class="nf-nav-link active"><span class="nf-nav-num">1</span> <?= __('mentor_form.nav_personal') ?></a>
                        <a href="#sec-2" class="nf-nav-link"><span class="nf-nav-num">2</span> <?= __('mentor_form.nav_education') ?></a>
                        <a href="#sec-3" class="nf-nav-link"><span class="nf-nav-num">3</span> <?= __('mentor_form.nav_career_current') ?></a>
                        <a href="#sec-4" class="nf-nav-link"><span class="nf-nav-num">4</span> <?= __('mentor_form.nav_career_past') ?></a>
                        <a href="#sec-5" class="nf-nav-link"><span class="nf-nav-num">5</span> <?= __('mentor_form.nav_topics') ?></a>
                        <a href="#sec-6" class="nf-nav-link"><span class="nf-nav-num">6</span> <?= __('mentor_form.nav_pref') ?></a>
                        <a href="#sec-7" class="nf-nav-link"><span class="nf-nav-num">7</span> <?= __('mentor_form.nav_expectations') ?></a>
                        <a href="#sec-8" class="nf-nav-link"><span class="nf-nav-num">8</span> <?= __('mentor_form.nav_qualities') ?></a>
                        <a href="#sec-9" class="nf-nav-link"><span class="nf-nav-num">9</span> <?= __('mentor_form.nav_support') ?></a>
                        <a href="#sec-10" class="nf-nav-link"><span class="nf-nav-num">10</span> <?= __('mentor_form.nav_agreement') ?></a>
                    </nav>
                </div>

                <div class="col-lg-9">
                    
                    <div id="sec-1" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentor_form.sec1_title') ?></div>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="fullName" class="form-control" required placeholder="Name">
                                    <label><?= __('mentor_form.lbl_fullname') ?> *</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="orgName" class="form-control" placeholder="Org"><label><?= __('mentor_form.lbl_org_name') ?></label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="address" class="form-control" placeholder="Address"><label><?= __('mentor_form.lbl_address') ?></label></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating"><input type="number" name="zipCode" class="form-control" placeholder="Zip"><label><?= __('mentor_form.lbl_zip') ?></label></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating"><input type="phone" name="phone" class="form-control" placeholder="Phone"><label><?= __('mentor_form.lbl_phone') ?></label></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating"><input type="phone" name="mobilePhone" class="form-control" required placeholder="Mobile"><label><?= __('mentor_form.lbl_mobile') ?> *</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="email" name="email" class="form-control" required placeholder="Email"><label><?= __('mentor_form.lbl_email') ?> *</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="website" class="form-control" placeholder="Web"><label><?= __('mentor_form.lbl_website') ?></label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="date" name="birthInfo" class="form-control" placeholder="Birth"><label><?= __('mentor_form.lbl_birth') ?></label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="children" class="form-control" placeholder="Kids"><label><?= __('mentor_form.lbl_children') ?></label></div>
                            </div>
                            
                            <div class="col-12 border-top pt-3 mt-2">
                                <label class="d-block mb-2 text-muted small fw-bold"><?= __('mentor_form.lbl_care') ?></label>
                                <div class="nf-check-grid">
                                    <label><input type="checkbox" name="care[]" value="kindergarten" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentor_form.opt_care_kinder') ?></span></label>
                                    <label><input type="checkbox" name="care[]" value="nursing" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentor_form.opt_care_nursing') ?></span></label>
                                    <label><input type="checkbox" name="care[]" value="family" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentor_form.opt_care_family') ?></span></label>
                                    <label><input type="checkbox" name="care[]" value="other" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentor_form.opt_other') ?></span></label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <label class="d-block mb-2 text-muted small fw-bold"><?= __('mentor_form.lbl_employment') ?></label>
                                <div class="d-flex gap-3">
                                    <label><input type="radio" name="employment" value="self_employed" class="form-check-input"> <?= __('mentor_form.opt_self_employed') ?></label>
                                    <label><input type="radio" name="employment" value="employed" class="form-check-input"> <?= __('mentor_form.opt_employed') ?></label>
                                    <label class="d-flex align-items-center gap-2">
                                        <input type="radio" name="employment" value="other" class="form-check-input"> 
                                        <?= __('mentor_form.opt_other') ?> <input type="text" name="employment_other" class="form-control form-control-sm" style="width:150px;">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="sec-2" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentor_form.sec2_title') ?></div>
                        
                        <div class="nf-sub-title">1. <?= __('mentor_form.sub_higher_edu') ?></div>
                        <div class="row g-3">
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="highEduInst" class="form-control" placeholder="Inst"><label><?= __('mentor_form.lbl_edu_inst') ?></label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="highEduFaculty" class="form-control" placeholder="Fac"><label><?= __('mentor_form.lbl_edu_faculty') ?></label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="highEduSpec" class="form-control" placeholder="Spec"><label><?= __('mentor_form.lbl_edu_spec') ?></label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="highEduYear" class="form-control" placeholder="Year"><label><?= __('mentor_form.lbl_edu_year') ?></label></div></div>
                        </div>

                        <div class="nf-sub-title border-top pt-3">2. <?= __('mentor_form.sub_vocational') ?></div>
                        <div class="row g-3">
                            <div class="col-12"><div class="form-floating"><input type="text" name="vocField" class="form-control" placeholder="Field"><label><?= __('mentor_form.lbl_voc_field') ?></label></div></div>
                            <div class="col-12"><div class="form-floating"><input type="text" name="vocQual" class="form-control" placeholder="Qual"><label><?= __('mentor_form.lbl_voc_qual') ?></label></div></div>
                            <div class="col-12"><div class="form-floating"><input type="text" name="vocOrg" class="form-control" placeholder="Org"><label><?= __('mentor_form.lbl_voc_org') ?></label></div></div>
                        </div>
                    </div>

                    <div id="sec-3" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentor_form.sec3_title') ?></div>
                        <div class="row g-3">
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="currentComp" class="form-control" placeholder="Comp" required><label><?= __('mentor_form.lbl_curr_comp') ?> *</label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="currentAddr" class="form-control" placeholder="Addr"><label><?= __('mentor_form.lbl_curr_addr') ?></label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="currentSector" class="form-control" placeholder="Sec"><label><?= __('mentor_form.lbl_curr_sector') ?></label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="currentPos" class="form-control" placeholder="Pos" required><label><?= __('mentor_form.lbl_curr_pos') ?> *</label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="currentDur" class="form-control" placeholder="Dur"><label><?= __('mentor_form.lbl_curr_dur') ?></label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="empCount" class="form-control" placeholder="Count"><label><?= __('mentor_form.lbl_emp_count') ?></label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="subCount" class="form-control" placeholder="Sub"><label><?= __('mentor_form.lbl_sub_count') ?></label></div></div>
                            <div class="col-12"><div class="form-floating"><textarea name="mainFunc" class="form-control" style="height:80px"></textarea><label><?= __('mentor_form.lbl_main_func') ?></label></div></div>
                            <div class="col-12"><div class="form-floating"><textarea name="memberships" class="form-control" style="height:60px"></textarea><label><?= __('mentor_form.lbl_memberships') ?></label></div></div>
                            <div class="col-12"><div class="form-floating"><textarea name="volunteer" class="form-control" style="height:60px"></textarea><label><?= __('mentor_form.lbl_volunteer') ?></label></div></div>
                        </div>
                    </div>

                    <div id="sec-4" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentor_form.sec4_title') ?></div>
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered table-sm small">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('mentor_form.th_comp_role') ?></th>
                                        <th><?= __('mentor_form.th_duration') ?></th>
                                        <th><?= __('mentor_form.th_sector') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for($i=1; $i<=6; $i++): ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><input type="text" name="pastJob[<?=$i?>][role]" class="form-control form-control-sm border-0"></td>
                                        <td><input type="text" name="pastJob[<?=$i?>][dur]" class="form-control form-control-sm border-0"></td>
                                        <td><input type="text" name="pastJob[<?=$i?>][sec]" class="form-control form-control-sm border-0"></td>
                                    </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                        <p class="small text-muted">* <?= __('mentor_form.lbl_mgmt_note') ?></p>
                        <div class="form-floating">
                            <textarea name="careerComments" class="form-control" style="height:80px"></textarea>
                            <label><?= __('mentor_form.lbl_career_comments') ?></label>
                        </div>
                    </div>

                    <div id="sec-5" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentor_form.sec5_title') ?></div>
                        <div class="nf-check-grid mb-3">
                            <?php 
                            $topics = ['career_plan','qual_raise','conflict','work_org','comm','negotiation','leadership','business_plan','project_mgmt','finance','time_mgmt','prog_mgmt','risk_mgmt','intl_rel','work_learning','presentation','stress','change'];
                            foreach($topics as $t): ?>
                            <label><input type="checkbox" name="topics[]" value="<?= $t ?>" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentor_form.topic_'.$t) ?></span></label>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-floating">
                            <input type="text" name="topicOther" class="form-control">
                            <label><?= __('mentor_form.opt_other') ?></label>
                        </div>
                    </div>

                    <div id="sec-6" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentor_form.sec6_title') ?></div>
                        <div class="form-floating mb-3"><textarea name="menteeSector" class="form-control" style="height:80px"></textarea><label><?= __('mentor_form.lbl_mentee_sector') ?></label></div>
                        <div class="form-floating mb-3"><textarea name="menteeExpect" class="form-control" style="height:80px"></textarea><label><?= __('mentor_form.lbl_mentee_expect') ?></label></div>
                        <div class="form-floating"><textarea name="priorMentorExp" class="form-control" style="height:80px"></textarea><label><?= __('mentor_form.lbl_prior_exp') ?></label></div>
                    </div>

                    <div id="sec-7" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentor_form.sec7_title') ?></div>
                        <div class="nf-check-grid">
                            <?php $exps = ['insight','impulse','consulting','reflection','network','knowledge','other'];
                            foreach($exps as $e): ?>
                            <label><input type="checkbox" name="expectations[]" value="<?= $e ?>" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentor_form.exp_'.$e) ?></span></label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div id="sec-8" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentor_form.sec8_title') ?></div>
                        <div class="nf-check-grid mb-3">
                            <?php $quals = ['exp','analysis','inspire','teach','tolerance','trust','resp','other'];
                            foreach($quals as $q): ?>
                            <label><input type="checkbox" name="qualities[]" value="<?= $q ?>" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentor_form.qual_'.$q) ?></span></label>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-floating"><textarea name="leadershipDef" class="form-control" style="height:80px"></textarea><label><?= __('mentor_form.lbl_leadership_def') ?></label></div>
                    </div>

                    <div id="sec-9" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentor_form.sec9_title') ?></div>
                        
                        <p class="fw-bold text-muted small mb-2"><?= __('mentor_form.lbl_workshops') ?></p>
                        <div class="nf-check-grid mb-4">
                            <?php $ws = ['hr','agile','change','network','nonverbal','resilience','generation','critical','media','tools','feedback','newwork','branding','social'];
                            foreach($ws as $w): ?>
                            <label><input type="checkbox" name="workshops[]" value="<?= $w ?>" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentor_form.ws_'.$w) ?></span></label>
                            <?php endforeach; ?>
                        </div>

                        <p class="fw-bold text-muted small mb-2"><?= __('mentor_form.lbl_support') ?></p>
                        <div class="row g-2 mb-3">
                            <div class="col-12"><div class="input-group"><div class="input-group-text bg-white"><input type="checkbox" name="support[]" value="lecturer"></div><input type="text" name="supportLecturerTopic" class="form-control" placeholder="<?= __('mentor_form.ph_lecturer') ?>"></div></div>
                            <div class="col-12"><div class="input-group"><div class="input-group-text bg-white"><input type="checkbox" name="support[]" value="bestpractice"></div><input type="text" name="supportBPTopic" class="form-control" placeholder="<?= __('mentor_form.ph_bestpractice') ?>"></div></div>
                            <div class="col-12"><label class="nf-check-label border w-100"><input type="checkbox" name="support[]" value="space" class="nf-check-input" hidden><span class="p-2"><?= __('mentor_form.opt_space') ?></span></label></div>
                            <div class="col-12"><label class="nf-check-label border w-100"><input type="checkbox" name="support[]" value="assist" class="nf-check-input" hidden><span class="p-2"><?= __('mentor_form.opt_assist') ?></span></label></div>
                            <div class="col-12"><label class="nf-check-label border w-100"><input type="checkbox" name="support[]" value="visit" class="nf-check-input" hidden><span class="p-2"><?= __('mentor_form.opt_visit') ?></span></label></div>
                        </div>

                        <p class="fw-bold text-muted small mb-2"><?= __('mentor_form.lbl_freq') ?></p>
                        <div class="d-flex gap-3 flex-wrap mb-3">
                            <label><input type="radio" name="freq" value="weekly" class="form-check-input"> <?= __('mentor_form.freq_weekly') ?></label>
                            <label><input type="radio" name="freq" value="biweekly" class="form-check-input"> <?= __('mentor_form.freq_biweekly') ?></label>
                            <label><input type="radio" name="freq" value="monthly" class="form-check-input"> <?= __('mentor_form.freq_monthly') ?></label>
                            <label><input type="radio" name="freq" value="quarterly" class="form-check-input"> <?= __('mentor_form.freq_quarterly') ?></label>
                        </div>
                        <div class="form-floating"><textarea name="comments" class="form-control" style="height:80px"></textarea><label><?= __('mentor_form.lbl_comments') ?></label></div>
                    </div>

                    <div id="sec-10" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentor_form.sec10_title') ?></div>
                        <div class="alert alert-light border small text-muted mb-3" style="line-height: 1.6; max-height: 200px; overflow-y: auto;">
                            <?= __('mentor_form.agreement_text') ?>
                            <div class="text-danger mt-2 fw-bold">** <?= __('mentor_form.fine_warning') ?></div>
                        </div>
                        
                        <div class="d-flex flex-column gap-2 mb-4">
                            <label class="d-flex gap-2"><input type="checkbox" name="consentData" value="yes" required class="form-check-input"> <?= __('mentor_form.consent_data') ?></label>
                            <label class="d-flex gap-2"><input type="checkbox" name="consentPhoto" value="yes" class="form-check-input"> <?= __('mentor_form.consent_photo') ?></label>
                            <label class="d-flex gap-2"><input type="checkbox" name="consentLogo" value="yes" class="form-check-input"> <?= __('mentor_form.consent_logo') ?></label>
                            <label class="d-flex gap-2"><input type="checkbox" name="consentPublish" value="yes" class="form-check-input"> <?= __('mentor_form.consent_publish') ?></label>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="signaturePlace" class="form-control" required placeholder="Place"><label><?= __('mentor_form.lbl_place') ?> *</label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="signatureName" class="form-control" required placeholder="Sign"><label><?= __('mentor_form.lbl_sign') ?> *</label></div></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="nf-submit-bar">
                <div class="nf-form-status me-3 align-self-center"></div>
                <button type="submit" class="nf-submit-btn">
                    <?= __('mentor_form.btn_submit') ?>
                </button>
            </div>
        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sections = document.querySelectorAll('.nf-form-section');
    const navLinks = document.querySelectorAll('.nf-nav-link');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.getAttribute('id');
                navLinks.forEach(l => l.classList.remove('active'));
                const active = document.querySelector(`.nf-nav-link[href="#${id}"]`);
                if(active) active.classList.add('active');
            }
        });
    }, { rootMargin: '-20% 0px -60% 0px' });
    sections.forEach(s => observer.observe(s));
});
</script>
}