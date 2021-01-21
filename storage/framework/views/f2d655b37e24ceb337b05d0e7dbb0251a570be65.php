<?php $__env->startSection('content'); ?>
<div class="bd-sidebar">
    <div class="main_menu">
         <a href="<?php echo e(url('admin/medical_records/'.$health_history->patient->patient_unique_id )); ?>" class="btn btn-light btn-sm">Back to dashboard</a>
         <div class="medical_patient_detail">         	
            <h2><?php if($health_history->patient->patient_gender == 1): ?>
                  	<?php if($health_history->patient->patient_martial_status == 1): ?>
                      <?php echo e('Mrs.'); ?>

                  	<?php else: ?>
                      <?php echo e('Miss'); ?>

                  	<?php endif; ?>
              	<?php else: ?>
                  <?php echo e('Mr.'); ?>

             	<?php endif; ?>
              	<?php echo e(ucfirst($health_history->patient->patient_first_name).' '.ucfirst($health_history->patient->patient_last_name)); ?></h2>
            <span>PATIENT ID: Patient-<?php echo e($health_history->patient->patient_unique_id); ?></span>
         </div>
         <div class="widget_profile_desc">
             <div class="patient_info">
                 PATIENTS INFORMATION
             </div>
            <ul>
                <li>
                    <span>
                        <img src="<?php echo e(asset('admin/doctor/images/location.svg')); ?>" alt="icon">
                    </span>
                    <p><?php echo e(ucfirst($health_history->patient->patient_address)); ?></p>
                </li>
                <?php if(!empty($health_history->patient->patient_martial_status)): ?>
	                <li>
	                    <span>
	                        <img src="<?php echo e(asset('admin/doctor/images/status.svg')); ?>" alt="icon">
	                    </span>
	                    <?php if($health_history->patient->patient_martial_status == 0): ?>
	                    	<p>Single</p>
	                    <?php else: ?>
	                    	<p>Married</p>
	                    <?php endif; ?>
	                </li>
	            <?php endif; ?>
	            <?php if(!empty($health_history->patient->patient_languages)): ?>
	                <li>
	                    <span>
	                        <img src="<?php echo e(asset('admin/doctor/images/mic.svg')); ?>" alt="icon">
	                    </span>
	                    <p><?php echo e($health_history->patient->patient_languages); ?></p>
	                </li>
	            <?php endif; ?>
	            <?php if(!empty($health_history->patient->patient_date_of_birth)): ?>
	                <li>
	                    <span>
	                        <img src="<?php echo e(asset('admin/doctor/images/heart.svg')); ?>" alt="icon">
	                    </span>
	                    <p><?php echo e(date('dS F Y',$health_history->patient->patient_date_of_birth)); ?> (Birthday)</p>
	                </li>
	            <?php endif; ?>
            </ul>
        </div>
         <div class="left_btns">
            <?php $inc = 0; ?>
            <?php if(count($health_history['history_attachments']) > 0): ?>
                 <?php $__currentLoopData = $health_history['history_attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history_attachments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($history_attachments->type == 2): ?>
                        <?php $inc = 1; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php if($inc == 1): ?>
                <a href="javascript:;" class="btn btn-light btn-sm btn-center mb-3" data-toggle="modal" data-target="#onboarding"><img src="<?php echo e(asset('admin/doctor/images/btn_view.svg')); ?>"/>View Original Record</a>
            <?php else: ?>
                <a href="javascript:;" class="btn btn-light btn-sm btn-center mb-3 disabled"><img src="<?php echo e(asset('admin/doctor/images/btn_view.svg')); ?>"/>View Original Record</a>
            <?php endif; ?>
            <a href="<?php echo e(url('admin/edit_medical_record/'.$health_history->history_id)); ?>" class="btn btn-light btn-sm btn-center mb-3"><img src="<?php echo e(asset('admin/doctor/images/btn-edit.svg')); ?>"/>Edit Medical Record</a>
            <a href="javascript:;" class="btn btn-light btn-sm btn-center"><img src="<?php echo e(asset('admin/doctor/images/btn-print.svg')); ?>"/>Print Medical Record</a>
        </div>

    </div>
    <a class="help_sm" href="tel:021-000-1234">
        <div class="help_icon_sm">
            <img src="<?php echo e(asset('admin/doctor/images/call_sm.svg')); ?>" alt="icon">
        </div>
        <div class="help_desc_sm">
            <h3>Need Help?</h3>
            <h4>Call. 0703 242 1768</h4>
                    <small>contact@renderhealth.com</small>
        </div>
    </a>
</div>
<div class='black_overlay'></div>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="page_head">
                <!-- <h1 class="heading invisible">Medical Record</h1> -->
                <h1 class="heading billing_head" style="visibility:hidden;" >Billing Informations
                    <a data-toggle="modal" data-target="#add_new_billing" class="add_schedule" href="javascript:;" data-backdrop="static" data-keyboard="false">
                        <img src="<?php echo e(asset('admin/doctor/images/add.svg')); ?>" alt="icon">
                    </a>
                </h1>

                <div class="appointment_type">
                    <ul class="nav nav-pills" id="history_nav" role="tablist">
                        <li><a class="active record_tab_head" role="tab"  data-toggle="pill" data-id="view_record" href="#medical_record">Medical Record</a></li>
                        <li><a class="record_tab_head <?php if(isset($doctor_details->access_to_hospital) && ($doctor_details->access_to_hospital != 2 && $doctor_details->access_to_hospital != 3)){ echo 'disabled'; } ?>" role="tab" data-toggle="pill"  data-id="billing_detail" href="#billing_info">
                            <svg width="15px" height="17px" viewBox="0 0 15 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="icon_clr" transform="translate(-1035.000000, -458.000000)" fill="#49AEF4" fill-rule="nonzero">
                                        <g id="Group-9-Copy-4" transform="translate(268.000000, 374.000000)">
                                            <g id="Group-9" transform="translate(749.000000, 62.000000)">
                                                <g id="Group-8" transform="translate(17.000000, 22.000000)">
                                                    <path d="M15.2732733,14.2562813 L15.2732733,15.6156406 C15.2732733,16.3632883 14.6615616,16.975 13.9139139,16.975 L2.6991992,16.975 C3.65075075,16.975 4.3983984,16.2273524 4.3983984,15.2758008 L4.3983984,14.2562813 L15.2732733,14.2562813 Z M2.35935936,16.2953203 C1.61171171,16.2953203 1,15.6836086 1,14.935961 L1,0.322847848 C1,0.186911912 1.06796797,0.050975976 1.2039039,0.050975976 C1.33983984,-0.016991992 1.47577578,-0.016991992 1.54374374,0.050975976 L3.37887888,1.2743994 L5.21401401,0.050975976 C5.34994995,-0.016991992 5.48588589,-0.016991992 5.62182182,0.050975976 L7.45695696,1.2743994 L9.29209209,0.050975976 C9.42802803,-0.016991992 9.56396396,-0.016991992 9.6998999,0.050975976 L11.535035,1.2743994 L13.3701702,0.050975976 C13.5061061,-0.016991992 13.642042,-0.016991992 13.71001,0.050975976 C13.777978,0.118943944 13.9139139,0.25487988 13.9139139,0.322847848 L13.9139139,13.5766016 L3.71871872,13.5766016 L3.71871872,14.935961 C3.71871872,15.6836086 3.10700701,16.2953203 2.35935936,16.2953203 Z M9.15615616,8.479004 L9.15615616,9.15868368 C9.15615616,9.36258759 9.02022022,9.49852352 8.81631632,9.49852352 L5.41791792,9.49852352 C5.21401401,9.49852352 5.07807808,9.63445946 5.07807808,9.83836336 C5.07807808,10.0422673 5.21401401,10.1782032 5.41791792,10.1782032 L7.11711712,10.1782032 L7.11711712,10.518043 C7.11711712,10.7219469 7.25305305,10.8578829 7.45695696,10.8578829 C7.66086086,10.8578829 7.7967968,10.7219469 7.7967968,10.518043 L7.7967968,10.1782032 L8.81631632,10.1782032 C9.36006006,10.1782032 9.83583584,9.70242743 9.83583584,9.15868368 L9.83583584,8.479004 C9.83583584,7.93526026 9.36006006,7.45948448 8.81631632,7.45948448 L6.0975976,7.45948448 C5.89369369,7.45948448 5.75775776,7.32354855 5.75775776,7.11964464 L5.75775776,6.43996496 C5.75775776,6.23606106 5.89369369,6.10012513 6.0975976,6.10012513 L9.495996,6.10012513 C9.6998999,6.10012513 9.83583584,5.96418919 9.83583584,5.76028529 C9.83583584,5.55638138 9.6998999,5.42044545 9.495996,5.42044545 L7.7967968,5.42044545 L7.7967968,5.08060561 C7.7967968,4.8767017 7.66086086,4.74076577 7.45695696,4.74076577 C7.25305305,4.74076577 7.11711712,4.8767017 7.11711712,5.08060561 L7.11711712,5.42044545 L6.0975976,5.42044545 C5.55385385,5.42044545 5.07807808,5.89622122 5.07807808,6.43996496 L5.07807808,7.11964464 C5.07807808,7.66338839 5.55385385,8.13916416 6.0975976,8.13916416 L8.81631632,8.13916416 C9.02022022,8.13916416 9.15615616,8.2751001 9.15615616,8.479004 Z" id="Shape"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            Billing Info
                        </a></li>
                     </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="tab-content">
                <div id="medical_record" class="tab-pane fade show active">
                    <div class="widget">
                        <div class="medical_header">
                            <ul class="nav nav-pills" role="tablist">
                                <li><a class="active" role="tab"  data-toggle="pill" href="#general_info">General Info</a></li>
                                <li><a role="tab" data-toggle="pill"  href="#examination">Examination</a></li>
                                <li><a role="tab" data-toggle="pill"  href="#laboratory_results">Laboratory Results</a></li>
                                <li><a role="tab" data-toggle="pill"  href="#medications">Medications</a></li>
                                <li><a role="tab" data-toggle="pill"  href="#imaging_documents">Imaging Documents</a></li>
                                <li><a role="tab" data-toggle="pill"  href="#mics">MICS</a></li>
                              </ul>
                        </div>
                        <div class="medical_body">
                            <div class="tab-content">
                                <div id="general_info" class="tab-pane fade show active">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="patient_info">Vitals Information</div>
                                            <ul class="vital_info">
                                                <li>
                                                    <i><img src="<?php echo e(asset('admin/doctor/images/ic_pulse_rate.svg')); ?>" alt="icon"></i>
                                                    <div>
                                                        <h4><span><?php echo e($health_history->pulse); ?></span> Bit per Minute</h4>
                                                        <p>Pulse rate</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <i><img src="<?php echo e(asset('admin/doctor/images/ic_blood_Pressure.svg')); ?>" alt="icon"></i>
                                                    <div>
                                                        <h4><span><?php echo e($health_history->bp_sys); ?>/<?php echo e($health_history->bp_dia); ?></span> mmHg</h4>
                                                        <p>Blood Pressure</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <i><img src="<?php echo e(asset('admin/doctor/images/ic_respiratory.svg')); ?>" alt="icon"></i>
                                                    <div>
                                                        <h4><span><?php echo e($health_history->respiratory_rate); ?></span> X per Minute</h4>
                                                        <p>Respiratory Rate</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <i><img src="<?php echo e(asset('admin/doctor/images/ic_temp.svg')); ?>" alt="icon"></i>
                                                    <div>
                                                        <h4><span><?php echo e($health_history->temperature); ?>º</span> <?php if($health_history->measuring_type == 1): ?> <?php echo e("Celcius"); ?> <?php elseif($health_history->measuring_type == 2): ?><?php echo e("Farenheit"); ?> <?php endif; ?></h4>
                                                        <p>Temperature</p>
                                                    </div>
                                                </li>
                                                 <li>
                                                    <i><img src="<?php echo e(asset('admin/doctor/images/weight.svg')); ?>" alt="icon"></i>
                                                    <div>
                                                        <h4><?php if(!empty($health_history->weight)): ?><span><?php echo e($health_history->weight); ?></span>  <?php else: ?> <?php echo e("0"); ?> <?php endif; ?> Kgs </h4>
                                                        <p>Weight</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <i><img src="<?php echo e(asset('admin/doctor/images/scale.svg')); ?>" alt="icon"></i>
                                                    <div>
                                                       <h4><?php if(!empty($health_history->height)): ?><span><?php echo e($health_history->height); ?></span> <?php else: ?> <?php echo e("0"); ?> <?php endif; ?> Cm </h4>
                                                        <p>Height</p>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="medical_mrn">
                                                <h3>MRN ID : MRN-<?php echo e($health_history->patient->patient_unique_id); ?> </h3>
                                                <div class="mrn_detail">
                                                    <h4>GENERAL NOTES</h4>
                                                    <p><?php echo e($health_history->general_notes); ?></p>
                                                </div>
                                                <div class="mrn_detail">
                                                    <h4>COMPLAIN</h4>
                                                    <ul>
                                                        <li>
                                                            <h4>Tue, 16 Feb 2018</h4>
                                                            <p>ermentum nunc fermentum, consequat risus quis, bibendum ante.</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="mrn_detail">
                                                    <h4>PLAN</h4>
                                                    <p><?php echo e($health_history->plan); ?></p>
                                                </div>
                                                <div class="updated_on">
                                                    <?php if(isset($health_history->doctor_update) && !empty($health_history->doctor_update)): ?>
                                                        <span>Last Update <?php echo e(date('d F Y',$health_history->updated_date)); ?> by Dr. <?php echo e($health_history->doctor_update->doctor_first_name); ?> <?php echo e($health_history->doctor_update->doctor_last_name); ?></span>
                                                    <?php elseif(isset($health_history->nurse_update) && !empty($health_history->nurse_update)): ?>
                                                        <span>Last Update <?php echo e(date('d F Y',$health_history->updated_date)); ?> by Mr. <?php echo e($health_history->nurse_update->nurse_first_name); ?> <?php echo e($health_history->nurse_update->nurse_last_name); ?></span>
                                                    <?php elseif(isset($health_history->employee_update) && !empty($health_history->employee_update)): ?>
                                                        <span>Last Update <?php echo e(date('d F Y',$health_history->updated_date)); ?> by Mr. <?php echo e($health_history->employee_update->employee_first_name); ?> <?php echo e($health_history->employee_update->employee_last_name); ?></span>
                                                    <?php elseif(isset($health_history->hospital_update) && !empty($health_history->hospital_update)): ?>
                                                        <span>Last Update <?php echo e(date('d F Y',$health_history->updated_date)); ?> by <?php echo e($health_history->hospital_update->hosp_name); ?></span>
                                                   <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="examination" class="tab-pane fade">
                                    <div class="mrn_detail">
                                        <h4>GENERAL</h4>
                                        <?php if(!empty($health_history->general_notes)): ?>
                                            <p><?php echo e($health_history->general_notes); ?></p>
                                        <?php else: ?>
                                            <p>No details</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mrn_detail">
                                        <h4>CARDIOVASCULAR SYSTEM EXAM (CVS)</h4>
                                        <?php if(!empty($health_history->cvs_det)): ?>
                                            <p><?php echo e($health_history->cvs_det); ?></p>
                                        <?php else: ?>
                                            <p>No details</p>   
                                        <?php endif; ?>
                                    </div>
                                    <div class="mrn_detail">
                                        <h4>RESPIRATORY</h4>
                                        <?php if(!empty($health_history->respiratory_det)): ?>
                                            <p><?php echo e($health_history->respiratory_det); ?></p>
                                        <?php else: ?>
                                            <p>No details</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mrn_detail">
                                        <h4>ABDOMEN</h4>
                                        <?php if(!empty($health_history->abdomen_det)): ?>
                                            <p><?php echo e($health_history->abdomen_det); ?></p>
                                        <?php else: ?>
                                            <p>No details</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mrn_detail">
                                        <h4>CENTRAL NERVOUS SYSTEM (CNS)</h4>
                                        <?php if(!empty($health_history->cns_det)): ?>
                                            <p><?php echo e($health_history->cns_det); ?></p>
                                        <?php else: ?>
                                            <p>No details</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mrn_detail">
                                        <h4>MUSCULOSKELETAL SYSTEM</h4>
                                        <?php if(!empty($health_history->musculoskeletal)): ?>
                                            <p><?php echo e($health_history->musculoskeletal); ?></p>
                                        <?php else: ?>
                                            <p>No details</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mrn_detail">
                                        <h4>HEAD, EYE, EAR, NOSE, AND THROAT (HEENT)</h4>
                                       <?php if(!empty($health_history->heent)): ?>
                                            <p><?php echo e($health_history->heent); ?></p>
                                        <?php else: ?>
                                            <p>No details</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mrn_detail">
                                        <h4>GENTO URINARY SYSTEM</h4>
                                       <?php if(!empty($health_history->urinary)): ?>
                                            <p><?php echo e($health_history->urinary); ?></p>
                                        <?php else: ?>
                                            <p>No details</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mrn_detail mb-0">
                                        <h4>OTHER SYSTEM</h4>
                                        <?php if(!empty($health_history->other_system)): ?>
                                            <p><?php echo e($health_history->other_system); ?></p>
                                        <?php else: ?>
                                            <p>No details</p>
                                        <?php endif; ?>
                                    </div>

                                </div>
                                <div id="laboratory_results" class="tab-pane fade">
                                    <div class="mrn_detail">
                                        <h4>BLOOD COUNT</h4>
                                        <div class="description_list">
                                            <ul>
                                                <li>
                                                    <h4>Red Blood Cells</h4>
                                                    <div class="line"></div>
                                                    <div class="des_list_detail">
                                                        <div class="des_list_detail_unit">
                                                            <?php if(!empty($health_history->rbc_det)): ?>
                                                                <span class="digits_numbers color_primary"><?php echo e($health_history->rbc_det); ?></span>
                                                            <?php else: ?>
                                                                <span class="digits_numbers color_primary">0</span>
                                                            <?php endif; ?>
                                                            <span class="digits_text">millions cell/mcL</span>
                                                            <span class="badge badge-primary">Normal</span>
                                                        </div>
                                                        <p>The normal range of red blood cell counts for female is 4 to 5 million cell/mcl</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h4>White Blood Cells</h4>
                                                    <div class="line"></div>
                                                    <div class="des_list_detail">
                                                        <div class="des_list_detail_unit">
                                                            <?php if(!empty($health_history->wbc_det)): ?>
                                                                <span class="digits_numbers color_info"><?php echo e($health_history->wbc_det); ?></span>
                                                            <?php else: ?>
                                                                <span class="digits_numbers color_info">0</span>
                                                            <?php endif; ?>
                                                            <span class="digits_text">cell/mcL</span>
                                                            <span class="badge badge-info">Low</span>
                                                        </div>
                                                        <p>The normal range of white blood cell counts for female is 4 to 5 million cell/mcl</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h4>Hemoglobin (varies with altitude)</h4>
                                                    <div class="line"></div>
                                                    <div class="des_list_detail">
                                                        <div class="des_list_detail_unit">
                                                            <?php if(!empty($health_history->hb_det)): ?>
                                                                <span class="digits_numbers color_primary"><?php echo e($health_history->hb_det); ?></span>
                                                            <?php else: ?>
                                                                <span class="digits_numbers color_primary">0</span>
                                                            <?php endif; ?>
                                                            <span class="digits_text">gm/dL</span>
                                                            <span class="badge badge-primary">Normal</span>
                                                        </div>
                                                        <p>The normal range of hemoglobin counts for female is 4 to 5 million cell/mcl</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h4>Hematrocit (varies with altitude)</h4>
                                                    <div class="line"></div>
                                                    <div class="des_list_detail">
                                                        <div class="des_list_detail_unit">
                                                            <?php if(!empty($health_history->hmt_det)): ?>
                                                                <span class="digits_numbers color_primary"><?php echo e($health_history->hmt_det); ?></span>
                                                            <?php else: ?>
                                                                <span class="digits_numbers color_danger">0</span>
                                                            <?php endif; ?>
                                                            <span class="digits_text">%</span>
                                                            <span class="badge badge-danger">High</span>
                                                        </div>
                                                        <p>The normal range of hemoglobin counts for female is 4 to 5 million cell/mcl</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h4>Platelets</h4>
                                                    <div class="line"></div>
                                                    <div class="des_list_detail">
                                                        <div class="des_list_detail_unit">
                                                            <?php if(!empty($health_history->plt_det)): ?>
                                                                <span class="digits_numbers color_primary"><?php echo e($health_history->plt_det); ?></span>
                                                            <?php else: ?>
                                                                <span class="digits_numbers color_danger">0</span>
                                                            <?php endif; ?>
                                                            <span class="digits_text">millions cell/mcL</span>
                                                            <span class="badge badge-primary">Normal</span>
                                                        </div>
                                                        <p>The normal range of red blood cell counts for female is 4 to 5 million cell/mcl</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mrn_detail mb-0">
                                        <h4>CHOLESTEROL</h4>
                                        <div class="description_list">
                                            <ul>
                                                <li>
                                                    <h4>Cholesterol LDL</h4>
                                                    <div class="line"></div>
                                                    <div class="des_list_detail">
                                                        <div class="des_list_detail_unit">
                                                            <?php if(!empty($health_history->ch_ldl_det)): ?>
                                                                <span class="digits_numbers color_primary"><?php echo e($health_history->ch_ldl_det); ?></span>
                                                            <?php else: ?>
                                                                <span class="digits_numbers color_primary">0</span>
                                                            <?php endif; ?>
                                                            <span class="digits_text">cell/mcL</span>
                                                            <span class="badge badge-primary">Normal</span>
                                                        </div>
                                                        <p>The normal range of red blood cell counts for female is 4 to 5 million cell/mcl</p>
                                                    </div>
                                                </li>

                                                <li>
                                                    <h4>Cholesterol HDL</h4>
                                                    <div class="line"></div>
                                                    <div class="des_list_detail">
                                                        <div class="des_list_detail_unit">
                                                            <?php if(!empty($health_history->ch_hdl_det)): ?>
                                                                <span class="digits_numbers color_danger"><?php echo e($health_history->ch_hdl_det); ?></span>
                                                            <?php else: ?>
                                                                <span class="digits_numbers color_primary">0</span>
                                                            <?php endif; ?>
                                                            <span class="digits_text">cell/mcL</span>
                                                            <span class="badge badge-danger">High</span>
                                                        </div>
                                                        <p>The normal range of white blood cell counts for female is 4 to 5 million cell/mcl</p>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div id="medications" class="tab-pane fade">
                                    <div class="patient_fettle">
                                        <table class="fettle_table mb-2">
                                          <thead>
                                              <tr>
                                                  <th>Date</th>
                                                  <th>List of medicines</th>
                                                  <th>Procedure</th>
                                                  <th>Type</th>
                                                  <th>Qty</th>
                                              </tr>
                                          </thead>
                                          <tbody>                                                                           
                                                <?php if(count($health_history['history_medication']) > 0): ?>
                                                    <?php $__currentLoopData = $health_history['history_medication']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $health_medication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <tr>
                                                          <td><?php echo e(date('d/m/Y',$health_medication->created_date)); ?></td>
                                                          <td><?php echo e($health_medication->medi_name); ?></td>
                                                          <td><?php echo e($health_medication->medi_procedure); ?></td>
                                                          <?php if( $health_medication->medi_type == 1): ?>
                                                            <td>Tablet</td>
                                                          <?php elseif( $health_medication->medi_type == 2): ?>
                                                            <td>Syrup</td>
                                                          <?php endif; ?>
                                                          <td><?php echo e($health_medication->quantity); ?></td>
                                                      </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan=5>No medicines added</td>
                                                    </tr>
                                                <?php endif; ?>                                              
                                              <tr class="table_total">
                                                    <td colspan="5"></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                    </div>
                                </div>
                                <div id="imaging_documents" class="tab-pane fade">
                                    <div class="patient_fettle">
                                        <table class="fettle_table mb-2">
                                          <thead>
                                              <tr>
                                                  <th>Date</th>
                                                  <th>Name of Las</th>
                                                  <th>Category</th>
                                                  <th>Files</th>
                                               </tr>
                                          </thead>
                                          <tbody>
                                                <?php $count =1; ?>
                                                <?php if(count($health_history['history_attachments']) > 0): ?>
                                                    <?php $__currentLoopData = $health_history['history_attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history_attachments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($history_attachments->type == 1): ?>
                                                            <?php $count++; ?>
                                                            <tr>
                                                                <td><?php echo e(date('d/m/Y',$history_attachments->created_at)); ?></td>
                                                                <td><?php echo e($history_attachments->patient_lab_name); ?></td>
                                                                <?php if($history_attachments->attachment_type == 1): ?>
                                                                    <td>MRI</td>
                                                                <?php elseif($history_attachments->attachment_type == 2): ?>
                                                                    <td>CT SCAN</td>
                                                                <?php elseif($history_attachments->attachment_type == 3): ?>
                                                                    <td>X-RAY</td>  
                                                                <?php elseif($history_attachments->attachment_type == 0): ?>
                                                                    <td>-</td>      
                                                                <?php endif; ?>
                                                                   <td><div class="attachment">
                                                                     <?php 
                                                                    $file_path="";
                                                                    $ext = pathinfo($history_attachments->patient_attachment_name, PATHINFO_EXTENSION); 
                                                                  $filename=getcwd().'/admin/doctor/uploads/hhistory/'.$health_history->history_id.'/'.$history_attachments->patient_attachment_name;
                                                                     
                                                                 if(file_exists($filename)) {
                                                                   $file_path=asset('admin/doctor/uploads/hhistory/'.$health_history->history_id.'/'.$history_attachments->patient_attachment_name);
                                                                 }
                                                                  else  { 
                                                                      $file_path=asset('admin/nurse/uploads/hhistory/'.$health_history->history_id.'/'.$history_attachments->patient_attachment_name);
                                                                 }                                                              

                                                                     ?>                                                                    
                                                                      <a href="javascript;" data-img_path= "<?php echo e($file_path); ?>" onclick="openAttachmentImage(this,'<?php echo $ext;?>'); return false;">
                                                                        <img src="<?php echo e(asset('admin/doctor/images/attachment.svg')); ?>" alt="icon">
                                                                       
                                                                        <?php echo e(strtoupper($ext)); ?>

                                                                    </a>
                                                                  </div>
                                                              </td>
                                                           </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($count ==1): ?>
                                                        <tr>
                                                            <td colspan=5>No imaging documents added</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan=5>No imaging documents added</td>
                                                    </tr>
                                                <?php endif; ?>                           

                                              <tr class="table_total">
                                                    <td colspan="5"></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                    </div>
                                </div>
                                <div id="mics" class="tab-pane fade">MICS</div>
                             </div>
                        </div>
                    </div>
                </div>
                <div id="billing_info" class="tab-pane fade">

                        <div class="table_hospital main_div">
                            <table class="table" cellspacing="10">
                                <tr>
                                    <th>DATE CREATED</th>
                                    <th>INVOICE ID</th>
                                    <th>HOSPITAL / LABS</th>
                                    <th>AMOUNT</th>
                                    <th>PAID</th>
                                    <th>Balance</th>
                                    <th></th>
                                    <th>View Billing Detail</th>
                                </tr>
                                <?php if(count($billing_detail) > 0): ?>
                                    <?php $__currentLoopData = $billing_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $billing_det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr <?php if(($billing_det['payable_amount'] - $billing_det['paid_amount']) != 0){ ?> class="pending" <?php }?>>
                                            <td><?php echo e(date('j F Y',$billing_det['billing_date'])); ?></td>
                                            <td><?php echo e($billing_det['invoice_number']); ?></td>
                                            <td><?php echo e($billing_det->hospital->hosp_name); ?></td>
                                            <td>₦ <?php echo e($billing_det['payable_amount']); ?></td>
                                            <td>₦ <?php echo e($billing_det['paid_amount']); ?></td>
                                            <?php if(($billing_det['payable_amount'] - $billing_det['paid_amount']) > 0): ?>
                                                <td>₦ <?php echo e($billing_det['payable_amount'] - $billing_det['paid_amount']); ?></td> 
                                            <?php else: ?>  
                                                <td colspan="2" align="center"><span class="paid">PAID</span></td>   
                                            <?php endif; ?>                                           
                                            <?php if(($billing_det['payable_amount'] - $billing_det['paid_amount']) > 0): ?>
                                                <td>  
                                            <button class="btn btn-info btn-xs paybill_type" onclick="selectpaytype(this,event)" id="paybill_type">PAY BILL</button> 
                                            <div class="radio_div" style="display: none;">

                                            <label class="radio-inline"><input type="radio" name="pay_by" value="1" onclick="getselectedvalue(this,event)">Pay by Cash</label>


                                            <label class="radio-inline"><input type="radio" name="pay_by" value="2" onclick="getselectedvalue(this,event)">Pay by Card</label>

                                            </div>    

                                            <div class="cash_input" style="display:none;">
                                            <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width1">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                            <div class="modal-header">
                                            <?php $amount=$billing_det['payable_amount'] - $billing_det['paid_amount'];?>
                                            <h3>Amount to pay: ₦ <?php echo e($amount); ?></h3>
                                            <button type="button" class="close" data-dismiss="modal" onclick="getpaypopup();">&times;</button>    
                                            </div>
                                            <div class="modal-body">
                                            <div class="row">
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                            <label>Enter Amount to pay by cash</label>

                                            <input type="number" name="pay_amount" value="<?php echo e($billing_det['payable_amount'] - $billing_det['paid_amount']); ?>" class="form-control" placeholder="Enter Amount" min="1" max="<?php echo e($billing_det['payable_amount'] - $billing_det['paid_amount']); ?>"   onkeydown="limitmax(event,<?php echo $amount;?>);" onkeyup="limitmax(event,<?php echo $amount;?>);" id="pay_amount">

                                            </div>
                                            </div>
                                            </div> 
                                            <div class="row">
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                            <a href="javascript:;" class="btn btn-info btn-xs"  data-bill_id="<?php echo e($billing_det['billing_id']); ?>" data-doc_id="<?php echo e($billing_det['doctor_id']); ?>" data-pt_id="<?php echo e($billing_det['patient_id']); ?>" onclick="paybycash(this)">PAY BILL</a>      
                                            </div>
                                            </div>
                                            </div>           

                                            </div>
                                            </div>
                                            </div> 
                                            </div>

                                            <a href="javascript:;" class="btn btn-info btn-xs" id="pay_bill_popup"  onclick="payWithPaystack(this);" data-amt="<?php echo e($billing_det['payable_amount'] - $billing_det['paid_amount']); ?>" data-doc_id="<?php echo e($billing_det['doctor_id']); ?>" data-pt_id="<?php echo e($billing_det['patient_id']); ?>" data-bill_id="<?php echo e($billing_det['billing_id']); ?>">Pay Bill</a>
                                            </div>
                                            </td>
                                            <?php else: ?>


                                            <?php endif; ?>   
                                            <td><a href="<?php echo e(asset('admin/billing_detail/'.$billing_det['billing_id'].'/'.$billing_det['doctor_id'])); ?>" class="btn btn-light btn-xs" name="button"><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">View Detail</a></td>                    
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No Bills Found</td>
                                        </tr>
                                <?php endif; ?>                                
                            </table>
                            <div class="table_pagination">
                               <button type="button" class="btn btn-light btn-xs pre1" <?php if($billing_detail->previousPageUrl()){  } else{ echo "disabled"; } ?> data-url="<?php echo $billing_detail->previousPageUrl(); ?>">Previous Page</button>
                               <span>Page <?php echo e($billing_detail->currentPage()); ?> of <?php echo e($billing_detail->lastPage()); ?> Pages</span>
                               <button type="button" class="btn btn-light btn-xs next1"  <?php if($billing_detail->nextPageUrl()){  } else{ echo "disabled"; } ?>  data-url="<?php echo $billing_detail->nextPageUrl(); ?>">Next Page</button>
                            </div>
                        </div>
                </div>
              </div>
        </div>
    </div>
</main>
 <!-- add new billing screen -->
<div class="modal fade" id="add_new_billing">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width2">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Billing</h3>
                <h6>XV110/13022018/009</h6>
                <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(asset('admin/doctor/images/popup_close.svg')); ?>"/></button>
            </div>
            <div class="modal-body">
                <form>                
                <div class="row">                    
                    <div class="col-12 text-center">
                        <div class="alert alert-danger-outline alert-dismissible alert_icon fade show error_msg_bill text-left mb-5" id="error_msg_bill" role="alert" style="display:none;">
                            <div class="d-flex align-items-center">
                                <div class="alert-icon-col">
                                    <span class="fa fa-warning"></span>
                                </div>
                                <div class="alert_text error_text_bill">
                                    Email field is required
                                </div>
                                <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                            </div>
                        </div>
                        <table class="table_modal">
                            <tr>
                                <th style="width:20%">DATE CREATED</th>
                                <th style="width:60%">KIND OF SERVICES</th>
                                <th style="width:20%">AMOUNT</th>
                            </tr>
                            <tr>
                                <td><?php echo e(date('j F Y')); ?></td>
                                <td><input type="text" placeholder="Type about services here ..." class="form-control ser_nm"/></td>
                                <td>
                                    <div class="inline-group">
                                        <span class="currency">₦</span>
                                        <input type="text" placeholder="Bill Amount" class="form-control bll_amt flexauto"/>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e(date('j F Y')); ?></td>
                                <td><input type="text" placeholder="Type about services here ..." class="form-control ser_nm"/></td>
                                <td>
                                    <div class="inline-group">
                                        <span class="currency">₦</span>
                                        <input type="text" placeholder="Bill Amount" class="form-control bll_amt flexauto"/>
                                        <img src="<?php echo e(asset('admin/doctor/images/del_sr.svg')); ?>" alt="delete" class="ml-2" style="flex: 0 0 auto;" onclick="removeitems(this); return false;">
                                    </div>

                                </td>
                            </tr>
                            <tr style="display: none;">
                                <td><?php echo e(date('j F Y')); ?></td>
                                <td><input type="text" placeholder="Type about services here ..." class="form-control ser_nm"/></td>
                                <td>
                                    <div class="inline-group">
                                        <span class="currency">₦</span>
                                        <input type="text" placeholder="Bill Amount" class="form-control bll_amt flexauto"/>
                                        <img src="<?php echo e(asset('admin/doctor/images/del_sr.svg')); ?>" alt="delete" class="ml-2" style="flex: 0 0 auto;" onclick="removeitems(this); return false;">
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <a class="add_more_rows" href="javascript:;" onclick="addmoreitems(this); return false;"><img src="<?php echo e(asset('admin/doctor/images/add_more_items.svg')); ?>" alt="icon"> Add more items</a>
                                </td>
                            </tr>
                            <tr class="table_subtotal">
                                <td colspan="2">Sub Total Amount</td>
                                <td class="bl_ttl">₦ 0</td>
                            </tr>
                        </table>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <?php echo e(csrf_field()); ?>

                            <button type="button" class="btn btn-primary mb-3 mt-3 save_bling" name="button" onclick="savebilling(this); return false;" data-patient_id="<?php echo e($health_history->patient->patient_unique_id); ?>" data-total="" data-history_id="<?php echo e($health_history->history_id); ?>">Save New Billing</button>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="attachment_image">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_widthauto">
        <div class="modal-content">            
            <div class="modal-body attachment_img">
            </div>
        </div>
    </div>
</div>

 <!-- onboarding screen -->
<div class="modal fade" id="onboarding">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal onboarding">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(asset('images/popup_close.svg')); ?>"/></button>
            <div class="modal-body">
                <!-- Swiper -->
                 <div class="swiper-container">
                   <div class="swiper-wrapper">                    
                    <?php if(count($health_history['history_attachments']) > 0): ?>
                        <?php $__currentLoopData = $health_history['history_attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history_attachments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($history_attachments->type == 2): ?>
                                 <div class="swiper-slide">
                                     <div class="onboading_screens">
                                         <?php $ext = pathinfo($history_attachments['patient_attachment_name'], PATHINFO_EXTENSION); ?>
                                         <?php if(!empty($health_history->doctor_id)): ?>
                                             <?php if(strtolower($ext) == "png" || strtolower($ext) == "jpg" || strtolower($ext) == "jpeg"): ?>
                                                <img src="<?php echo e(asset('admin/doctor/uploads/hhistory/'.$history_attachments['patient_history_id'].'/original_record/'.$history_attachments['patient_attachment_name'])); ?>" alt="image">
                                            <?php elseif(strtolower($ext) == "pdf"): ?>
                                                <embed src="<?php echo e(asset('admin/doctor/uploads/hhistory/'.$history_attachments['patient_history_id'].'/original_record/'.$history_attachments['patient_attachment_name'])); ?>#" width=500px" height="500px" />
                                            <?php elseif(strtolower($ext) == 'doc' || strtolower($ext) == 'docx'): ?>
                                                <iframe src=" https://docs.google.com/viewer?url=<?php echo e(asset('admin/doctor/uploads/hhistory/'.$history_attachments['patient_history_id'].'/original_record/'.$history_attachments['patient_attachment_name'])); ?>&embedded=true" width="500px" height="500px"></iframe> 
                                            <?php endif; ?>
                                        <?php elseif(!empty($health_history->nurse_id)): ?>
                                             <?php if(strtolower($ext) == "png" || strtolower($ext) == "jpg" || strtolower($ext) == "jpeg"): ?>
                                                <img src="<?php echo e(asset('admin/nurse/uploads/hhistory/'.$history_attachments['patient_history_id'].'/original_record/'.$history_attachments['patient_attachment_name'])); ?>" alt="image">
                                            <?php elseif(strtolower($ext) == "pdf"): ?>
                                                <embed src="<?php echo e(asset('admin/nurse/uploads/hhistory/'.$history_attachments['patient_history_id'].'/original_record/'.$history_attachments['patient_attachment_name'])); ?>#" width=500px" height="500px" />
                                            <?php elseif(strtolower($ext) == 'doc' || strtolower($ext) == 'docx'): ?>
                                                <iframe src=" https://docs.google.com/viewer?url=<?php echo e(asset('admin/nurse/uploads/hhistory/'.$history_attachments['patient_history_id'].'/original_record/'.$history_attachments['patient_attachment_name'])); ?>&embedded=true" width="500px" height="500px"></iframe> 
                                            <?php endif; ?>
                                        <?php elseif(!empty($health_history->employee_id)): ?> 
                                             <?php if(strtolower($ext) == "png" || strtolower($ext) == "jpg" || strtolower($ext) == "jpeg"): ?>
                                                <img src="<?php echo e(asset('admin/employee/uploads/hhistory/'.$history_attachments['patient_history_id'].'/original_record/'.$history_attachments['patient_attachment_name'])); ?>" alt="image">
                                            <?php elseif(strtolower($ext) == "pdf"): ?>
                                                <embed src="<?php echo e(asset('admin/employee/uploads/hhistory/'.$history_attachments['patient_history_id'].'/original_record/'.$history_attachments['patient_attachment_name'])); ?>#" width=500px" height="500px" />
                                            <?php elseif(strtolower($ext) == 'doc' || strtolower($ext) == 'docx'): ?>
                                                <iframe src=" https://docs.google.com/viewer?url=<?php echo e(asset('admin/doctor/employee/hhistory/'.$history_attachments['patient_history_id'].'/original_record/'.$history_attachments['patient_attachment_name'])); ?>&embedded=true" width="500px" height="500px"></iframe> 
                                            <?php endif; ?> 
                                        <?php elseif(!empty($health_history->hospital_id)): ?> 
                                             <?php if(strtolower($ext) == "png" || strtolower($ext) == "jpg" || strtolower($ext) == "jpeg"): ?>
                                                <img src="<?php echo e(asset('admin/hospital/uploads/hhistory/'.$history_attachments['patient_history_id'].'/original_record/'.$history_attachments['patient_attachment_name'])); ?>" alt="image">
                                            <?php elseif(strtolower($ext) == "pdf"): ?>
                                                <embed src="<?php echo e(asset('admin/hospital/uploads/hhistory/'.$history_attachments['patient_history_id'].'/original_record/'.$history_attachments['patient_attachment_name'])); ?>#" width=500px" height="500px" />
                                            <?php elseif(strtolower($ext) == 'doc' || strtolower($ext) == 'docx'): ?>
                                                <iframe src=" https://docs.google.com/viewer?url=<?php echo e(asset('admin/hospital/uploads/hhistory/'.$history_attachments['patient_history_id'].'/original_record/'.$history_attachments['patient_attachment_name'])); ?>&embedded=true" width="500px" height="500px"></iframe> 
                                            <?php endif; ?>
                                        <?php endif; ?>
                                     </div>
                                 </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>                     
                    </div>
                   <!-- Add Pagination -->
                   <div class="swiper-pagination"></div>
                   <!-- Add Arrows -->
                   <div class="swiper-button-next">
                       <span class="onboarding_next">Next</span>
                       <span class="onboarding_last" data-dismiss="modal">Get Started</span>
                   </div>
                 </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_wsidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>