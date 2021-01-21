<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content-full">
    <form action ="" method="POST" id="add_medical_record" enctype="multipart/form-data"> 
    <input type="hidden" class="edit" name="edit" value="1">
    <input type="hidden" class="history_id" name="history_id" value="<?php echo e($health_history->history_id); ?>">
    <input type="hidden" class="patient_id" name="patient_id" value="<?php echo e($health_history->patient->patient_unique_id); ?>">   
    <div class="row">
        <div class="col-12">
            <div class="page_head">
                <h1 class="heading">Edit patient medical records</h1>
                <div>
                     <a href="<?php echo e(url('admin/medical_records/'.$health_history->patient->patient_unique_id)); ?>" class="btn btn-light btn-sm mr-1">Cancel</a>
                     <div class="dropdown d-inline-block mr-1">
                      <!--<a class="btn btn-light no_caret btn-sm dropdown-toggle" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo e(asset('admin/doctor/images/attach.svg')); ?>" alt="icon"> Attach Original Record
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <div class="sure">
                              <h5>Attach original record from ?</h5>
                              <label for="comp_file" class="btn btn-light btn-xs mr-2">File on Computer</label>
                              <input type="file" id="comp_file" style="display: none;">
                              <button type="button" class="btn btn-blue btn-xs mr-2">Scanner</button>
                          </div>
                      </div>
                    </div>-->
                    <button type="submit" class="btn btn-primary btn-sm" onclick="saveHealthHistory(this); return false;">Save Document</button>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="alert alert-danger-outline alert-dismissible alert_icon fade show error_msg_history text-left mb-5" id="error_msg_history" role="alert" style="display:none;">
        <div class="d-flex align-items-center">
            <div class="alert-icon-col">
                <span class="fa fa-warning"></span>
            </div>
            <div class="alert_text error_text_history">
                Email field is required
            </div>
            <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-3">
            <!-- Nav tabs -->
            <div class="sidebar_nav mb-3">
                <ul class="nav nav-tabs widget" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#gen_info">General Info & Vital Informations
                        <img src="<?php echo e(asset('admin/doctor/images/forward.svg')); ?>" alt="icon">
                     </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#examination">Examination <img src="<?php echo e(asset('admin/doctor/images/forward.svg')); ?>" alt="icon"></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#lab_results">Laboratory Results <img src="<?php echo e(asset('admin/doctor/images/forward.svg')); ?>" alt="icon"></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#medications">Medications <img src="<?php echo e(asset('admin/doctor/images/forward.svg')); ?>" alt="icon"></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#imaging_docs">Imaging Documents <img src="<?php echo e(asset('admin/doctor/images/forward.svg')); ?>" alt="icon"></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#mics">MICS <img src="<?php echo e(asset('admin/doctor/images/forward.svg')); ?>" alt="icon"></a>
                  </li>
                </ul>
                <div class="attachment_count">
                    <img src="<?php echo e(asset('admin/doctor/images/attached.svg')); ?>" alt="icon">
                    Attachment of Original Record
                    <?php $inc = 0; ?>
                    <?php if(count($health_history['history_attachments']) > 0): ?>
                         <?php $__currentLoopData = $health_history['history_attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history_attachments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($history_attachments->type == 2): ?>
                                <?php $inc++; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <span class="attached_count"><?php echo e($inc); ?></span>
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
        <div class="col-12 col-md-9">
            <div class="tab-content">
                <div id="gen_info" class="tab-pane active widget">
                    <div class="med_record">
                        <div class="mr_head">
                            <div class="patient">
                              <div class="patient_image">
                                  <?php if($health_history->patient->patient_profile_img != ""): ?>
                                      <img src="<?php echo e(asset('uploads/patient/'.$health_history->patient->patient_profile_img)); ?>" alt="image"/>
                                  <?php else: ?>
                                      <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image"/>
                                  <?php endif; ?>  
                              </div>
                              <div class="patient_detail">
                                  <h2>
                                      <?php if($health_history->patient->patient_gender == 1): ?>
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
                          </div>
                        </div>
                        <div class="mr_body">  
                        <div class="form-group mb-4">
                                  <div class="row">
                                      <div class="col-3">
                                          <label>Date of Consutaltion</label>
                                          <span class="pull-right">:</span>
                                      </div>
                                      <div class="col-9">
                                          <div class="row">
                                              <div class="col-8 pl-0">
                                                <input type="date" class="form-control pulse_rate" name="date_of_consutaltion" value="<?php echo e($health_history->date_of_consutaltion); ?>">
                                              </div>
                                            
                                              
                                          </div>
                                      </div>
                                  </div>
                              </div>                            
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">

                                      <input name="hospital_id" value="<?php echo e($health_history->hospital_id); ?>" type="hidden" class="hospital_id">
                                       <input name="doctor_id" value="<?php echo e($health_history->doctor_id); ?>" type="hidden" class="doctor_list">
                                        <label>Temperature</label>
                                        <span class="pull-right">:</span>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-2 pl-0">
                                                <input type="text" class="form-control temperature" name="temperature" value="<?php echo e($health_history->temperature); ?>">
                                            </div>
                                            <div class="col-4 pl-0">
                                                <div class="select_box">
                                                     <select class="form-control temprature_type" name="temprature_type">
                                                         <option value="1">Oral 1</option>
                                                         <option value="2">Oral 2</option>
                                                         <option value="3">Oral 3</option>
                                                     </select>
                                                 </div>
                                             </div>
                                             <div class="col-2 pl-0">
                                                 <div class="btn-group">
                                                      <button type="button" class="btn btn-light <?php if($health_history->measuring_type ==1){ echo "temp_active"; } ?> btn-mr degree_type" data-type="1" >ºC</button>
                                                      <button type="button" class="btn btn-light btn-mr <?php if($health_history->measuring_type ==2){ echo "temp_active"; } ?> degree_type" data-type="2">ºF</button>
                                                  </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Weight</label>
                                        <span class="pull-right">:</span>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-2 pl-0">
                                                <input type="text" class="form-control weight" name="weight" value="<?php echo e($health_history->weight); ?>">
                                            </div>
                                            <div class="col-4 pl-0">
                                                 <div class="form-text">Kgs</div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Height</label>
                                        <span class="pull-right">:</span>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-2 pl-0">
                                                <input type="text" class="form-control height" name="height" value="<?php echo e($health_history->height); ?>">
                                            </div>
                                            <div class="col-4 pl-0">
                                                 <div class="form-text">Cm</div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Pulse</label>
                                        <span class="pull-right">:</span>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-2 pl-0">
                                                <input type="text" class="form-control pulse_rate" name="pulse_rate" value="<?php echo e($health_history->pulse); ?>">
                                            </div>
                                            <div class="col-4 pl-0">
                                                 <div class="form-text">/ Minutes</div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Respiratory Rate</label>
                                        <span class="pull-right">:</span>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-2 pl-0">
                                                <input type="text" class="form-control resp_rate" name="resp_rate" value="<?php echo e($health_history->respiratory_rate); ?>">
                                            </div>
                                            <div class="col-4 pl-0">
                                                 <div class="form-text">/ Minutes</div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Blood Pressure</label>
                                        <span class="pull-right">:</span>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-2 pl-0">
                                                <input type="text" class="form-control bp_syt" name="bp_syt" value="<?php echo e($health_history->bp_sys); ?>">
                                            </div>
                                            <div class="col-2 pl-0">
                                                 <div class="form-text">Systolic</div>
                                             </div>
                                             <div class="col-2 pl-0">
                                                 <input type="text" class="form-control bp_dia" name="bp_dia" value="<?php echo e($health_history->bp_dia); ?>">
                                             </div>
                                             <div class="col-2 pl-0">
                                                  <div class="form-text">Diastolic</div>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>General Notes</label>
                                        <span class="pull-right">:</span>
                                    </div>
                                    <div class="col-9 pl-0">
                                         <textarea class="form-control form-textarea general_notes" rows="4" name="general_notes"><?php echo e($health_history->general_notes); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Plan</label>
                                        <span class="pull-right">:</span>
                                    </div>
                                    <div class="col-9 pl-0">
                                         <textarea class="form-control form-textarea plan" name="plan" rows="4"><?php echo e($health_history->plan); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                  <div class="row">
                                      <div class="col-3">
                                          <label>Possible Diagnosis</label>
                                          <span class="pull-right">:</span>
                                      </div>
                                      <div class="col-9">
                                          <div class="row">
                                             
                                              <div class="col-9 pl-0">
                                                  <div class="select_box">
                                                  <select class="form-control temprature_type" onchange="PossibleDiagnosis(this)">
                                                    <option value="">Select Possible Diagnosis</option>                
                                                    <?php foreach($possibleDiagnosis as $diagnosis){
                                                     echo '<option value="'.$diagnosis->name.'">'.$diagnosis->name.'</option>';
                                                    } ?>
                                                     <option value="Other">Other</option>
                                                  </select>
                                                   </div>
                                               </div>
                                               <div class="col-9 pl-0" id="possible_diagnosis">
                                                  <input type="text" class="form-control" name="possible_diagnosis" style="display: block !important" value="<?php echo e($health_history->possible_diagnosis); ?>" id="possible_diagnosis_value">
                                               </div>
                                               
                                          </div>
                                      </div>
                                  </div>
                              </div>
                        </div>
                    </div>
                </div>
                <div id="examination" class="tab-pane fade widget">
                    <div class="med_record">
                        <div class="mr_head_sub">
                             Examination
                        </div>
                        <div class="mr_body">
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>CARDIOVASCULAR <br/>SYSTEM EXAM (CVS)</label>
                                    </div>
                                    <div class="col-9 pl-0">
                                         <textarea class="form-control form-textarea cvs" name="cvs" rows="4"><?php echo e($health_history->cvs_det); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>RESPIRATORY</label>
                                    </div>
                                    <div class="col-9 pl-0">
                                         <textarea class="form-control form-textarea resp_analysis" name="resp_analysis" rows="4"><?php echo e($health_history->respiratory_det); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>ABDOMEN</label>
                                    </div>
                                    <div class="col-9 pl-0">
                                         <textarea class="form-control form-textarea abd_rate" name="abd_rate" rows="4"><?php echo e($health_history->abdomen_det); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label>CENTRAL NERVOUS <br/> SYSTEM (CNS)</label>
                                    </div>
                                    <div class="col-9 pl-0">
                                         <textarea class="form-control form-textarea cns" name="cns" rows="4"><?php echo e($health_history->cns_det); ?></textarea>
                                    </div>
                                </div>
                            </div>

                              <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label>MUSCULOSKELETAL SYSTEM</label>
                                    </div>
                                    <div class="col-9 pl-0">
                                         <textarea class="form-control form-textarea musculoskeletal" name="musculoskeletal" rows="4"><?php echo e($health_history->musculoskeletal); ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label>HEENT</label>
                                    </div>
                                    <div class="col-9 pl-0">
                                         <textarea class="form-control form-textarea heent" name="heent" rows="4"><?php echo e($health_history->heent); ?></textarea>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label>URINARY</label>
                                    </div>
                                    <div class="col-9 pl-0">
                                         <textarea class="form-control form-textarea urinary" name="urinary" rows="4"><?php echo e($health_history->urinary); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Other System</label>
                                    </div>
                                    <div class="col-9 pl-0">
                                         <textarea class="form-control form-textarea other_system" name="other_system" rows="4"><?php echo e($health_history->other_system); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="lab_results" class="tab-pane fade widget">
                    <div class="med_record">
                        <div class="mr_head_sub">
                             Blood Count
                        </div>
                        <div class="mr_body">
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Red Blood Cells</label>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-2 pl-0">
                                                <input type="text" class="form-control rbc" name="rbc" value="<?php echo e($health_history->rbc_det); ?>">
                                            </div>
                                            <div class="col-10 pl-0">
                                                <div class="form_sub_text">
                                                    <h4>millions cell/mcL</h4>
                                                    <p>The normal range of red blood cell counts for female is 4 to 5 million cell/mcl</p>
                                                 </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>White Blood Cells</label>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-2 pl-0">
                                                <input type="text" class="form-control wbc" name="wbc" value="<?php echo e($health_history->wbc_det); ?>">
                                            </div>
                                            <div class="col-10 pl-0">
                                                <div class="form_sub_text">
                                                    <h4>cell/mcL</h4>
                                                    <p>The normal range of red blood cell counts for female is 4 to 5 million cell/mcl</p>
                                                 </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Hemoglobin (varies with altitude)</label>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-2 pl-0">
                                                <input type="text" class="form-control hb_rate" name="hb_rate" value="<?php echo e($health_history->hb_det); ?>">
                                            </div>
                                            <div class="col-10 pl-0">
                                                <div class="form_sub_text">
                                                    <h4>gm/DL</h4>
                                                    <p>The normal range of red blood cell counts for female is 4 to 5 million cell/mcl</p>
                                                 </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Hemoglobin (varies with altitude)</label>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-2 pl-0">
                                                <input type="text" class="form-control hb_per" name="hb_per" value="<?php echo e($health_history->hmt_det); ?>">
                                            </div>
                                            <div class="col-10 pl-0">
                                                <div class="form_sub_text">
                                                    <h4>%</h4>
                                                    <p>The normal range of red blood cell counts for female is 4 to 5 million cell/mcl</p>
                                                 </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Platelets</label>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-2 pl-0">
                                                <input type="text" class="form-control plt" name="plt" value="<?php echo e($health_history->plt_det); ?>">
                                            </div>
                                            <div class="col-10 pl-0">
                                                <div class="form_sub_text">
                                                    <h4>%</h4>
                                                    <p>The normal range of red blood cell counts for female is 4 to 5 million cell/mcl</p>
                                                 </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mr_head_sub sec_mr_head_sub">
                             Cholesterol
                        </div>
                        <div class="mr_body">
                            <div class="form-group mb-4">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Cholesterol LDL</label>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-2 pl-0">
                                                <input type="text" class="form-control chl_mil" name="chl_mil" value="<?php echo e($health_history->ch_ldl_det); ?>">
                                            </div>
                                            <div class="col-10 pl-0">
                                                <div class="form_sub_text">
                                                    <h4>millions cell/mcL</h4>
                                                    <p>The normal range of red blood cell counts for female is 4 to 5 million cell/mcl</p>
                                                 </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <label>Cholesterol LDL</label>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-2 pl-0">
                                                <input type="text" class="form-control chl_ldl"  name="chl_ldl" value="<?php echo e($health_history->ch_hdl_det); ?>">
                                            </div>
                                            <div class="col-10 pl-0">
                                                <div class="form_sub_text">
                                                    <h4>cell/mcL</h4>
                                                    <p>The normal range of red blood cell counts for female is 4 to 5 million cell/mcl</p>
                                                 </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="medications" class="tab-pane fade widget">
                    <div class="med_record">
                        <div class="mr_head_sub">
                             Add Medications
                        </div>
                        <div class="mr_body">
                            <div class="form-group mb-4">
                                <div class="row">
                                    <table class="patient_info_table medication_table">
                                        <tr>
                                            <th>Medicine Name</th>
                                            <th>Type</th>
                                            <th>Procedure</th>
                                            <th>Quantity</th>
                                            <th></th>
                                        </tr>
                                        <?php if(count($health_history['history_medication']) > 0): ?>
                                          <?php $__currentLoopData = $health_history['history_medication']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $health_medication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr data-id="<?php echo e($health_medication->id); ?>">
                                                <td><?php echo e($health_medication->medi_name); ?></td>
                                                <td>
                                                    <?php if($health_medication->medi_type == 1): ?>
                                                      Tablet
                                                    <?php elseif($health_medication->medi_type == 2): ?>
                                                      Syrup
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($health_medication->medi_procedure); ?></td>
                                                <td><?php echo e($health_medication->quantity); ?></td>
                                                <td>
                                                <span class="delete_row"><img src="<?php echo e(asset('images/cross_red.svg')); ?>" alt="delete" data-id="<?php echo e($health_medication->id); ?>" onclick="removedbmedications(this); return false;"></span>
                                            </td>                              
                                            </tr>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          <?php else: ?>
                                            <tr>
                                            <td><input type="text" class="form-control medi_name" placeholder="Medicine Name" value=""></td>
                                            <td>
                                                <div class="select_box" style="min-width: 130px;">
                                                     <select class="form-control medi_type">
                                                            <option value="">Select Type</option>
                                                            <option value="1">Tablet</option>
                                                            <option value="2">Syrup</option>                                                            
                                                     </select>
                                                 </div>
                                            </td>
                                            <td><input type="text" class="form-control medi_procedure" placeholder="..." value=""></td>
                                            <td><input type="text" class="form-control medi_quantity" placeholder=".." value=""></td>                                   
                                        </tr>
                                        <?php endif; ?>                                        
                                         <tr style="display: none;">
                                            <td><input type="text" class="form-control medi_name" placeholder="Medicine Name" value=""></td>
                                            <td>
                                                <div class="select_box" style="min-width: 130px;">
                                                     <select class="form-control medi_type">
                                                            <option value="">Select Type</option>
                                                            <option value="1">Tablet</option>
                                                            <option value="2">Syrup</option>                                                            
                                                     </select>
                                                 </div>
                                            </td>
                                            <td><input type="text" class="form-control medi_procedure" placeholder="..." value=""></td>
                                            <td><input type="text" class="form-control medi_quantity" placeholder=".." value=""></td>
                                            <td>
                                                <span class="delete_row delete_images"><img src="<?php echo e(asset('images/cross_red.svg')); ?>" alt="delete"  onclick="removemedications(this); return false;"></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <a class="badge_primary mt-2 d-inline-block add_medicine" href="javascript:;" onclick="addmoremedicines(this); return false;">Add More Medicine</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="imaging_docs" class="tab-pane fade widget">
                    <div class="med_record">
                        <div class="mr_head_sub">
                             Add Lab Document
                        </div>
                        <div class="mr_body">
                            <div class="form-group mb-4">
                                <div class="row">
                                    <table class="patient_info_table">
                                        <tr>
                                            <th>Name of Las</th>
                                            <th>Category</th>
                                            <th>Attach file</th>
                                            <th></th>
                                        </tr>
                                        <?php $count =0; ?>
                                         <?php if(count($health_history['history_attachments']) > 0): ?>                                            
                                            <?php $__currentLoopData = $health_history['history_attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history_attachments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <?php if($history_attachments->type == 1): ?>   
                                                <?php $count =1; ?>                                             
                                                <tr data-id="<?php echo e($history_attachments->patient_attachment_id); ?>">
                                                    <td><?php echo e($history_attachments->patient_lab_name); ?></td>
                                                    <td>
                                                        <?php if($history_attachments->attachment_type == 1): ?>
                                                          MRI
                                                        <?php elseif($history_attachments->attachment_type == 2): ?>
                                                          CT SCAN
                                                        <?php elseif($history_attachments->attachment_type == 3): ?>
                                                          X-RAY
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if(!empty($history_attachments->patient_attachment_name)): ?>
                                                          <a href="javascript;" data-img_path= "<?php echo e(asset('admin/doctor/uploads/hhistory/'.$health_history->history_id.'/'.$history_attachments->patient_attachment_name)); ?>" onclick="openAttachmentImage(this); return false;">
                                                            <span><?php echo e($history_attachments->patient_attachment_name); ?> </span>
                                                          </a>
                                                        <?php else: ?>
                                                          <div class="input_file">
                                                              <input type="file" id="historyattachment" class="historyattachment" accept="image/png,image/jpeg" onchange="changefilename(this); return false;"/>
                                                              <label for="historyattachment" class="historyattachmentlabel">
                                                                  <img class="mr-1" src="<?php echo e(asset('images/attach.svg')); ?>" alt="icon"> Upload File
                                                              </label>                                                       
                                                          </div>
                                                        <?php endif; ?>
                                                    </td> 
                                                    <td>
                                                        <span class="delete_row"><img src="<?php echo e(asset('images/cross_red.svg')); ?>" alt="delete" data-id="<?php echo e($history_attachments->patient_attachment_id); ?>" onclick="removedbattachment(this); return false;"></span>
                                                    </td>                                          
                                                </tr>
                                              <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          <?php endif; ?>
                                          <?php if($count == 0): ?>
                                            <tr>
                                              <td><input type="text" class="form-control centre_name"  placeholder="" value=""></td>
                                              <td>
                                                  <div class="select_box">
                                                       <select class="form-control attach_type" name="">
                                                               <option value="">Select Attachment Type</option>
                                                               <option value="1">MRI</option>
                                                               <option value="2">CT SCAN</option>
                                                               <option value="3">X-RAY</option>
                                                        </select>
                                                   </div>
                                              </td>
                                              <td>
                                                  <div class="input_file">
                                                      <input type="file" id="historyattachment1" class="historyattachment" accept="image/png,image/jpeg" onchange="changefilename(this); return false;"/>
                                                      <label for="historyattachment1" class="historyattachmentlabel">
                                                          <img class="mr-1" src="<?php echo e(asset('images/attach.svg')); ?>" alt="icon"> Upload File
                                                      </label>
                                                   
                                                  </div>
                                              </td>                                               
                                          </tr>
                                          <?php endif; ?>                                        
                                        <tr style="display: none;">
                                            <td><input type="text" class="form-control centre_name"  placeholder="" value=""></td>
                                            <td>
                                                <div class="select_box">
                                                     <select class="form-control attach_type" name="">
                                                             <option value="">Select Attachment Type</option>
                                                             <option value="1">MRI</option>
                                                             <option value="2">CT SCAN</option>
                                                             <option value="3">X-RAY</option>
                                                      </select>
                                                 </div>
                                            </td>
                                            <td>
                                                <div class="input_file">
                                                    <input type="file" id="historyattachment" class="historyattachment" accept="image/png,image/jpeg" onchange="changefilename(this); return false;"/>
                                                    <label for="historyattachment" class="historyattachmentlabel">
                                                        <img class="mr-1" src="<?php echo e(asset('images/attach.svg')); ?>" alt="icon"> Upload File
                                                    </label>
                                                 
                                                </div>
                                            </td>
                                             <td>
                                                <span class="delete_row delete_images"><img src="<?php echo e(asset('images/cross_red.svg')); ?>" alt="delete" onclick="removeattachment(this); return false;"></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <a class="badge_primary mt-2 d-inline-block add_attachment" href="javascript:;" onclick="addmoreattachments(this); return false;">Add More Document</a>
                            </div>
                        </div>
                    </div>                                
                </div>
                <div id="mics" class="tab-pane fade widget"><br>
                  <h3>Menu 2</h3>
                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                </div>
              </div>
        </div>
    </div>
</main>
<div class="modal fade" id="attachment_image">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_widthauto">
        <div class="modal-content">            
            <div class="modal-body attachment_img">
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
            

<?php echo $__env->make('layouts.admin_wsidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>