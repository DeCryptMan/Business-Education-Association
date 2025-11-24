<?php
use Core\Url;
use Core\Csrf;
?>

<style>
    /* --- MENTEE FORM STYLES (Green Theme) --- */
    :root {
        --f-primary: #10b981; /* Emerald 500 */
        --f-primary-dark: #059669;
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
        background: #ecfdf5; color: var(--f-primary-dark);
        font-weight: 700; box-shadow: 0 2px 5px rgba(16, 185, 129, 0.05);
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
    .form-floating > .form-control:focus { background-color: #fff; border-color: var(--f-primary); box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); }
    .form-floating > label { color: var(--f-text-muted); font-size: 0.85rem; }

    /* Checkboxes */
    .nf-check-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; }
    .nf-check-label {
        display: flex; align-items: flex-start; gap: 10px; padding: 10px;
        background: var(--f-input-bg); border-radius: 8px; cursor: pointer; font-size: 0.9rem;
        border: 1px solid transparent; transition: 0.2s; height: 100%;
    }
    .nf-check-input:checked + .nf-check-label { background: #ecfdf5; border-color: var(--f-primary); color: var(--f-primary-dark); font-weight: 600; }
    
    .nf-check-circle {
        width: 18px; height: 18px; border: 2px solid #cbd5e1; border-radius: 4px;
        flex-shrink: 0; position: relative; margin-top: 2px;
    }
    .nf-check-input:checked + .nf-check-label .nf-check-circle {
        background: var(--f-primary); border-color: var(--f-primary);
    }
    .nf-check-input:checked + .nf-check-label .nf-check-circle::after {
        content: '✓'; position: absolute; top: 50%; left: 50%;
        transform: translate(-50%, -50%); color: white; font-size: 10px; line-height: 1;
    }

    /* Submit Bar */
    .nf-submit-bar { position: sticky; bottom: 20px; z-index: 900; display: flex; justify-content: flex-end; }
    .nf-submit-btn {
        background: var(--f-primary); color: white; font-weight: 700; padding: 14px 40px;
        border-radius: 50px; border: none; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        transition: 0.3s;
    }
    .nf-submit-btn:hover { background: var(--f-primary-dark); transform: translateY(-2px); box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4); }
</style>

<section class="nf-section bg-light pt-5">
    <div class="container-lg mb-4">
        <div class="text-center max-w-3xl mx-auto">
            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill mb-3">
                MENTEE APPLICATION
            </span>
            <h1 class="display-5 fw-bold text-dark mb-2"><?= __('mentee_form.title') ?></h1>
            <p class="text-muted"><?= __('mentee_form.subtitle') ?></p>
        </div>
    </div>

    <div class="nf-app-container container-lg">
        <form id="menteeForm" class="nf-contact-form" data-endpoint="<?= Url::to('backend/mentee-profile') ?>">
            <?= Csrf::field() ?>

            <div class="row g-4">
                <div class="col-lg-3 d-none d-lg-block">
                    <nav class="nf-sticky-sidebar" id="desktopNav">
                        <a href="#sec-1" class="nf-nav-link active"><span class="nf-nav-num">1</span> <?= __('mentee_form.nav_personal') ?></a>
                        <a href="#sec-2" class="nf-nav-link"><span class="nf-nav-num">2</span> <?= __('mentee_form.nav_contact') ?></a>
                        <a href="#sec-3" class="nf-nav-link"><span class="nf-nav-num">3</span> <?= __('mentee_form.nav_status') ?></a>
                        <a href="#sec-4" class="nf-nav-link"><span class="nf-nav-num">4</span> <?= __('mentee_form.nav_description') ?></a>
                        <a href="#sec-5" class="nf-nav-link"><span class="nf-nav-num">5</span> <?= __('mentee_form.nav_edu') ?></a>
                        <a href="#sec-6" class="nf-nav-link"><span class="nf-nav-num">6</span> <?= __('mentee_form.nav_career') ?></a>
                        <a href="#sec-7" class="nf-nav-link"><span class="nf-nav-num">7</span> <?= __('mentee_form.nav_exp') ?></a>
                        <a href="#sec-8" class="nf-nav-link"><span class="nf-nav-num">8</span> <?= __('mentee_form.nav_goals') ?></a>
                        <a href="#sec-9" class="nf-nav-link"><span class="nf-nav-num">9</span> <?= __('mentee_form.nav_expectations') ?></a>
                        <a href="#sec-10" class="nf-nav-link"><span class="nf-nav-num">10</span> <?= __('mentee_form.nav_collaboration') ?></a>
                        <a href="#sec-11" class="nf-nav-link"><span class="nf-nav-num">11</span> <?= __('mentee_form.nav_digital') ?></a>
                        <a href="#sec-12" class="nf-nav-link"><span class="nf-nav-num">12</span> <?= __('mentee_form.nav_org') ?></a>
                        <a href="#sec-13" class="nf-nav-link"><span class="nf-nav-num">13</span> <?= __('mentee_form.nav_agreement') ?></a>
                    </nav>
                </div>

                <div class="col-lg-9">

                    <div id="sec-1" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentee_form.sec1_title') ?></div>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating"><input type="text" name="fullName" class="form-control" required placeholder="Name"><label><?= __('mentee_form.lbl_fullname') ?> *</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="birthInfo" class="form-control" placeholder="Birth"><label><?= __('mentee_form.lbl_birth') ?></label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="maritalStatus" class="form-control" placeholder="Status"><label><?= __('mentee_form.lbl_marital') ?></label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="children" class="form-control" placeholder="Kids"><label><?= __('mentee_form.lbl_children') ?></label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="dependants" class="form-control" placeholder="Care"><label><?= __('mentee_form.lbl_dependants') ?></label></div>
                            </div>
                            <div class="col-12">
                                <label class="d-block mb-2 text-muted small fw-bold"><?= __('mentee_form.lbl_care_sit') ?></label>
                                <div class="nf-check-grid">
                                    <?php $cares = ['daycare','nursing','family','other']; foreach($cares as $c): ?>
                                    <label><input type="checkbox" name="careSituation[]" value="<?= $c ?>" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentee_form.opt_'.$c) ?></span></label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="sec-2" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentee_form.sec2_title') ?></div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="orgName" class="form-control" placeholder="Comp"><label><?= __('mentee_form.lbl_org') ?></label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="personalAddress" class="form-control" placeholder="Addr"><label><?= __('mentee_form.lbl_address') ?></label></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating"><input type="text" name="postalCode" class="form-control" placeholder="Zip"><label><?= __('mentee_form.lbl_zip') ?></label></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating"><input type="tel" name="phone" class="form-control" placeholder="Phone"><label><?= __('mentee_form.lbl_phone') ?></label></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating"><input type="tel" name="mobilePhone" class="form-control" placeholder="Mobile"><label><?= __('mentee_form.lbl_mobile') ?></label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="email" name="email" class="form-control" required placeholder="Email"><label><?= __('mentee_form.lbl_email') ?> *</label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="email" name="workEmail" class="form-control" placeholder="Work Email"><label><?= __('mentee_form.lbl_work_email') ?></label></div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating"><input type="text" name="otherContact" class="form-control" placeholder="Social"><label><?= __('mentee_form.lbl_social') ?></label></div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating"><input type="text" name="website" class="form-control" placeholder="Site"><label><?= __('mentee_form.lbl_website') ?></label></div>
                            </div>
                        </div>
                    </div>

                    <div id="sec-3" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentee_form.sec3_title') ?></div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="currentComp" class="form-control" placeholder="Comp"><label><?= __('mentee_form.lbl_curr_comp') ?></label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="currentPosition" class="form-control" placeholder="Pos"><label><?= __('mentee_form.lbl_curr_pos') ?></label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="employmentType" class="form-control" placeholder="Full/Part"><label><?= __('mentee_form.lbl_emp_type') ?></label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="currentSector" class="form-control" placeholder="Sec"><label><?= __('mentee_form.lbl_curr_sector') ?></label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="startYear" class="form-control" placeholder="Year"><label><?= __('mentee_form.lbl_start_year') ?></label></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating"><input type="text" name="empCount" class="form-control" placeholder="Count"><label><?= __('mentee_form.lbl_emp_count') ?></label></div>
                            </div>
                            <div class="col-12 border-top pt-3 mt-2">
                                <div class="d-flex gap-4 mb-2">
                                    <span class="fw-bold small text-muted"><?= __('mentee_form.lbl_project_resp') ?></span>
                                    <label><input type="radio" name="projectResp" value="yes"> <?= __('mentee_form.opt_yes') ?></label>
                                    <label><input type="radio" name="projectResp" value="no"> <?= __('mentee_form.opt_no') ?></label>
                                </div>
                                <div class="d-flex gap-4 mb-2">
                                    <span class="fw-bold small text-muted"><?= __('mentee_form.lbl_budget_resp') ?></span>
                                    <label><input type="radio" name="budgetResp" value="yes"> <?= __('mentee_form.opt_yes') ?></label>
                                    <label><input type="radio" name="budgetResp" value="no"> <?= __('mentee_form.opt_no') ?></label>
                                </div>
                                <div class="d-flex gap-4 mb-2">
                                    <span class="fw-bold small text-muted"><?= __('mentee_form.lbl_promotion') ?></span>
                                    <label><input type="radio" name="promotion" value="yes"> <?= __('mentee_form.opt_yes') ?></label>
                                    <label><input type="radio" name="promotion" value="no"> <?= __('mentee_form.opt_no') ?></label>
                                </div>
                                <div class="d-flex gap-4 mb-2">
                                    <span class="fw-bold small text-muted"><?= __('mentee_form.lbl_pr_support') ?></span>
                                    <label><input type="radio" name="prSupport" value="yes"> <?= __('mentee_form.opt_yes') ?></label>
                                    <label><input type="radio" name="prSupport" value="no"> <?= __('mentee_form.opt_no') ?></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating"><textarea name="memberships" class="form-control" style="height:60px"></textarea><label><?= __('mentee_form.lbl_memberships') ?></label></div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating"><textarea name="volunteer" class="form-control" style="height:60px"></textarea><label><?= __('mentee_form.lbl_volunteer') ?></label></div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating"><input type="text" name="totalExp" class="form-control" placeholder="Exp"><label><?= __('mentee_form.lbl_total_exp') ?></label></div>
                            </div>
                            <div class="col-12">
                                <div class="nf-check-grid">
                                    <?php $socials = ['linkedin','x','instagram','facebook']; foreach($socials as $s): ?>
                                    <label><input type="checkbox" name="activeSocials[]" value="<?=$s?>" class="nf-check-input" hidden><span class="nf-check-label"><?= ucfirst($s) ?></span></label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="sec-4" class="nf-form-section">
                        <div class="row g-3">
                            <div class="col-12"><div class="form-floating"><textarea name="mainActivities" class="form-control" style="height:80px"></textarea><label><?= __('mentee_form.lbl_main_activities') ?></label></div></div>
                            <div class="col-12"><div class="form-floating"><textarea name="responsibilities" class="form-control" style="height:80px"></textarea><label><?= __('mentee_form.lbl_responsibilities') ?></label></div></div>
                        </div>
                    </div>

                    <div id="sec-5" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentee_form.sec4_title') ?></div>
                        <label class="d-block mb-2 text-muted small fw-bold"><?= __('mentee_form.lbl_edu_level') ?></label>
                        <div class="nf-check-grid mb-3">
                            <?php $edus = ['secondary','vocational','higher','other']; foreach($edus as $e): ?>
                            <label><input type="radio" name="highestEducation" value="<?= $e ?>" class="nf-check-input" hidden><span class="nf-check-label"><span class="nf-check-circle" style="border-radius:50%"></span> <?= __('mentee_form.opt_'.$e) ?></span></label>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="nf-sub-title border-top pt-3">1. <?= __('mentee_form.sub_higher_edu') ?></div>
                        <div class="row g-3">
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="highEduInst" class="form-control" placeholder="Inst"><label><?= __('mentee_form.lbl_edu_inst') ?></label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="highEduSpec" class="form-control" placeholder="Spec"><label><?= __('mentee_form.lbl_edu_spec') ?></label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="highEduQual" class="form-control" placeholder="Qual"><label><?= __('mentee_form.lbl_edu_qual') ?></label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="highEduDegree" class="form-control" placeholder="Deg"><label><?= __('mentee_form.lbl_edu_degree') ?></label></div></div>
                        </div>

                        <div class="nf-sub-title border-top pt-3">2. <?= __('mentee_form.sub_vocational') ?></div>
                        <div class="row g-3">
                            <div class="col-12"><div class="form-floating"><input type="text" name="vocOrg" class="form-control" placeholder="Org"><label><?= __('mentee_form.lbl_voc_org') ?></label></div></div>
                            <div class="col-12"><div class="form-floating"><input type="text" name="vocQual" class="form-control" placeholder="Qual"><label><?= __('mentee_form.lbl_voc_qual') ?></label></div></div>
                        </div>
                    </div>

                    <div id="sec-6" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentee_form.sec_career_path') ?></div>
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered table-sm small">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th><?= __('mentee_form.th_role') ?></th>
                                        <th><?= __('mentee_form.th_dur') ?></th>
                                        <th><?= __('mentee_form.th_sec') ?></th>
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
                        <div class="form-floating"><textarea name="careerComments" class="form-control" style="height:80px"></textarea><label><?= __('mentee_form.lbl_career_comments') ?></label></div>
                    </div>

                    <div id="sec-7" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentee_form.sec5_title') ?></div>
                        <div class="form-floating mb-3"><textarea name="decisiveSteps" class="form-control" style="height:100px"></textarea><label><?= __('mentee_form.lbl_decisive_steps') ?></label></div>
                        <div class="form-floating"><textarea name="careerOpportunityAssessment" class="form-control" style="height:100px"></textarea><label><?= __('mentee_form.lbl_opportunity') ?></label></div>
                    </div>

                    <div id="sec-8" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentee_form.sec6_title') ?></div>
                        <div class="form-floating mb-3"><textarea name="goalsShortTerm" class="form-control" style="height:80px"></textarea><label><?= __('mentee_form.lbl_short_term') ?></label></div>
                        <div class="form-floating mb-3"><textarea name="goalsMidTerm" class="form-control" style="height:80px"></textarea><label><?= __('mentee_form.lbl_mid_term') ?></label></div>
                        <div class="form-floating"><textarea name="goalsLongTerm" class="form-control" style="height:80px"></textarea><label><?= __('mentee_form.lbl_long_term') ?></label></div>
                    </div>

                    <div id="sec-9" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentee_form.sec7_title') ?></div>
                        <div class="nf-check-grid mb-3">
                            <?php $exps = ['careerGrowth','startup','bizDev','visibility','knowledge','feedback','finance','project','team','network','other']; foreach($exps as $e): ?>
                            <label><input type="checkbox" name="programExpectations[]" value="<?= $e ?>" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentee_form.opt_'.$e) ?></span></label>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-floating mb-3"><textarea name="currentChallenges" class="form-control" style="height:100px"></textarea><label><?= __('mentee_form.lbl_challenges') ?></label></div>
                        <div class="form-floating"><textarea name="skillsToDevelop" class="form-control" style="height:100px"></textarea><label><?= __('mentee_form.lbl_skills_develop') ?></label></div>
                    </div>

                    <div id="sec-10" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentee_form.sec8_title') ?></div>
                        <div class="nf-check-grid mb-3">
                            <?php $topics = ['career_plan','qual_raise','conflict','work_org','comm','negotiation','leadership','business_plan','project_mgmt','finance','time_mgmt','prog_mgmt','risk_mgmt','intl_rel','work_learning','presentation','stress','change']; foreach($topics as $t): ?>
                            <label><input type="checkbox" name="topics[]" value="<?= $t ?>" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentee_form.topic_'.$t) ?></span></label>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-floating"><input type="text" name="topicOther" class="form-control" placeholder="Other"><label><?= __('mentee_form.opt_other') ?></label></div>
                    </div>

                    <div id="sec-11" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentee_form.sec9_title') ?></div>
                        <div class="form-floating mb-3"><textarea name="digitalExp" class="form-control" style="height:80px"></textarea><label><?= __('mentee_form.lbl_digital_exp') ?></label></div>
                        <div class="form-floating mb-3"><textarea name="mentorHelp" class="form-control" style="height:80px"></textarea><label><?= __('mentee_form.lbl_mentor_help') ?></label></div>
                        <div class="form-floating mb-3"><textarea name="mentorExpectations" class="form-control" style="height:80px"></textarea><label><?= __('mentee_form.lbl_mentor_expect') ?></label></div>
                        <div class="form-floating"><textarea name="mentorOffer" class="form-control" style="height:80px"></textarea><label><?= __('mentee_form.lbl_mentor_offer') ?></label></div>
                    </div>

                    <div id="sec-12" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentee_form.sec10_title') ?></div>
                        <div class="form-floating mb-3"><textarea name="impElements" class="form-control" style="height:80px"></textarea><label><?= __('mentee_form.lbl_imp_elements') ?></label></div>
                        <div class="form-floating mb-3"><textarea name="similarPrograms" class="form-control" style="height:80px"></textarea><label><?= __('mentee_form.lbl_similar_progs') ?></label></div>
                        
                        <p class="fw-bold text-muted small mb-2"><?= __('mentee_form.lbl_contribution') ?></p>
                        <div class="nf-check-grid mb-3">
                            <label><input type="checkbox" name="contribution[]" value="space" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentee_form.contr_space') ?></span></label>
                            <label><input type="checkbox" name="contribution[]" value="support" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentee_form.contr_support') ?></span></label>
                            <label><input type="checkbox" name="contribution[]" value="visit" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentee_form.contr_visit') ?></span></label>
                            <label><input type="checkbox" name="contribution[]" value="other" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentee_form.opt_other') ?></span></label>
                        </div>

                        <p class="fw-bold text-muted small mb-2"><?= __('mentee_form.lbl_recognition') ?></p>
                        <div class="nf-check-grid mb-3">
                            <label><input type="radio" name="recognition" value="with_boss" class="nf-check-input" hidden><span class="nf-check-label"><span class="nf-check-circle" style="border-radius:50%"></span> <?= __('mentee_form.rec_with') ?></span></label>
                            <label><input type="radio" name="recognition" value="without_boss" class="nf-check-input" hidden><span class="nf-check-label"><span class="nf-check-circle" style="border-radius:50%"></span> <?= __('mentee_form.rec_without') ?></span></label>
                        </div>

                        <p class="fw-bold text-muted small mb-2"><?= __('mentee_form.lbl_source') ?></p>
                        <div class="nf-check-grid">
                            <?php $src = ['web','personal','professional','other']; foreach($src as $s): ?>
                            <label><input type="checkbox" name="infoSource[]" value="<?= $s ?>" class="nf-check-input" hidden><span class="nf-check-label"><?= __('mentee_form.src_'.$s) ?></span></label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div id="sec-13" class="nf-form-section">
                        <div class="nf-sec-title"><?= __('mentee_form.sec11_title') ?></div>
                        <div class="alert alert-light border small text-muted mb-3" style="max-height: 200px; overflow-y: auto; line-height: 1.6;">
                            <?= __('mentee_form.agreement_text') ?>
                            <div class="text-danger mt-2 fw-bold">** <?= __('mentee_form.fine_warning') ?></div>
                        </div>
                        <div class="d-flex flex-column gap-2 mb-4">
                            <label class="d-flex gap-2"><input type="checkbox" name="consentData" value="yes" required class="form-check-input"> <?= __('mentee_form.lbl_consent_data') ?></label>
                            <label class="d-flex gap-2"><input type="checkbox" name="consentPhoto" value="yes" class="form-check-input"> <?= __('mentee_form.lbl_consent_photo') ?></label>
                            <label class="d-flex gap-2"><input type="checkbox" name="consentLogo" value="yes" class="form-check-input"> <?= __('mentee_form.lbl_consent_logo') ?></label>
                            <label class="d-flex gap-2"><input type="checkbox" name="consentPublish" value="yes" class="form-check-input"> <?= __('mentee_form.lbl_consent_publish') ?></label>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="signaturePlace" class="form-control" required placeholder="Place"><label><?= __('mentee_form.lbl_place') ?> *</label></div></div>
                            <div class="col-md-6"><div class="form-floating"><input type="text" name="signatureName" class="form-control" required placeholder="Sign"><label><?= __('mentee_form.lbl_sign') ?> *</label></div></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="nf-submit-bar">
                <div class="nf-form-status me-3 align-self-center"></div>
                <button type="submit" class="nf-submit-btn">
                    <?= __('mentee_form.btn_submit') ?>
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