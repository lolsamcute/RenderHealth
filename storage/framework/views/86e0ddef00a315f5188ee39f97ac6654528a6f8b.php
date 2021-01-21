<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="widget_header widget_flex_header mb-2">
                <h2>Health Record Details : 
                 <?php if(isset($health_history->doctor)): ?>
                    <?php echo e(@$health_history->doctor->doctor_hospital_details->hosp_name); ?>

                 <?php endif; ?></h2>
            </div>
        </div>
        <div class="col-12 col-xl-9">
            <div class="widget">
                <div class="widget_body widget_profile mb-3">
                    <div class="params">
                        <div class="param_unit">
                            <img src="<?php echo e(asset('images/ic_pulse_rate.svg')); ?>" alt="icon">
                            <div class="param_text">
                                <h4><span><?php echo e($health_history->pulse); ?></span>Bit per Minute</h4>
                                <p>Pulse rate</p>
                            </div>
                        </div>
                        <div class="separator"></div>
                        <div class="param_unit">
                            <img src="<?php echo e(asset('images/ic_blood_Pressure.svg')); ?>" alt="icon">
                            <div class="param_text">
                                <h4><span><?php echo e($health_history->bp_sys); ?>/<?php echo e($health_history->bp_dia); ?></span>mmHg</h4>
                                <p>Blood Pressure</p>
                            </div>
                        </div>
                        <div class="separator"></div>
                        <div class="param_unit">
                            <img src="<?php echo e(asset('images/ic_respiratory.svg')); ?>" alt="icon">
                            <div class="param_text">
                                <h4><span><?php echo e($health_history->respiratory_rate); ?></span>X per Minute</h4>
                                <p>Respiratory Rate</p>
                            </div>
                        </div>
                        <div class="separator"></div>
                        <div class="param_unit">
                            <img src="<?php echo e(asset('images/ic_temperature.svg')); ?>" alt="icon">
                            <div class="param_text">
                                 <h4><span><?php echo e($health_history->temperature); ?>º</span> <?php if($health_history->measuring_type == 1): ?> <?php echo e("Celcius"); ?> <?php elseif($health_history->measuring_type == 2): ?><?php echo e("Farenheit"); ?> <?php endif; ?></h4>
                                <p>Temperature</p>
                            </div>
                        </div>
                        <div class="separator"></div>
                        <div class="param_unit">
                        <img src="<?php echo e(asset('admin/doctor/images/weight.svg')); ?>" alt="icon">
                        <div class="param_text">
                           <h4><?php if(!empty($health_history->weight)): ?><span><?php echo e($health_history->weight); ?></span>  <?php else: ?> <?php echo e("0"); ?> <?php endif; ?> Kgs </h4>
                        <p>Weight</p>
                        </div>
                        </div>
                        <div class="separator"></div>
                        <div class="param_unit">
                        <img src="<?php echo e(asset('admin/doctor/images/scale.svg')); ?>" alt="icon">
                        <div class="param_text">
                           <h4><?php if(!empty($health_history->height)): ?><span><?php echo e($health_history->height); ?></span> <?php else: ?> <?php echo e("0"); ?> <?php endif; ?> Cm </h4>
                        <p>Height</p>
                        </div>
                        </div>

                    </div>
                    <div class="payment_description">
                        <h3>General Notes</h3>
                        <p><?php echo e($health_history->general_notes); ?></p>
                    </div>
                    <div class="payment_description">
                        <h3>COMPLAIN</h3>
                        <ul class="comlain">
                            <li>
                                <span>Tue, 16 Feb 2018</span>
                                <p>ermentum nunc fermentum, consequat risus quis, bibendum ante.</p>
                            </li>
                        </ul>
                        <div class="view_history_complain">
                            <img src="<?php echo e(asset('images/list.png')); ?>" alt="icon"><a class="ml-0" href="javascript:;:">View Health Complain</a>
                        </div>
                     </div>
                    <div class="payment_description">
                        <h3>PLAN</h3>
                        <p><?php echo e($health_history->plan); ?></p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-xl-3">
            <div class="widget_body widget_profile mb-3">
                <div class="medical_detail">
                    <div class="medical_picture">
                        <?php date_default_timezone_set($time_zone); ?>
                        <?php if(!empty($health_history->doctor->doctor_picture)): ?>
                            <img src="<?php echo e(asset('/doctorimages/'.$health_history->doctor->doctor_picture)); ?>" alt="image">
                        <?php else: ?>
                            <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                        <?php endif; ?>
                    </div>
                    <ul>
                        <li class="medical_name">
                            <h5>Doctor :</h5>
                              <?php if(isset($health_history->doctor)): ?>
                            <p>Dr. <?php echo e($health_history->doctor->doctor_first_name); ?> <?php echo e($health_history->doctor->doctor_last_name); ?>, <?php echo e($health_history->doctor->doctor_degree); ?></p>
                            <?php endif; ?>
                        </li>
                        <li>
                            <h5>Hospital</h5>
                             <?php if(isset($health_history->doctor)): ?>
                            <p><?php echo e(@$health_history->doctor->doctor_hospital_details->hosp_name); ?></p>
                            <?php endif; ?>
                        </li>
                        <li>
                            <h5>Date & Time</h5>
                            <p><?php echo e(date('d F Y h:i A',$health_history->updated_date)); ?></p>
                        </li>
                    </ul>
                </div>
            </div>
             <?php $inc = 0; ?>
            <?php if(count($health_history['history_attachments']) > 0): ?>
                 <?php $__currentLoopData = $health_history['history_attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history_attachments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($history_attachments->type == 2): ?>
                        <?php $inc = 1; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php if($inc == 1): ?>
             <button type="button" class="btn btn-primary btn-block mb-12px btn-left-iconed" name="button"  data-toggle="modal" data-target="#onboarding" data-backdrop="static" data-keyboard="false"><img src="<?php echo e(asset('images/view_record.svg')); ?>" alt="icon" >VIEW ORIGINAL RECORDS</button>
               <!--  <a href="javascript:;" class="btn btn-light btn-sm btn-center mb-3" data-toggle="modal" data-target="#onboarding"><img src="<?php echo e(asset('admin/doctor/images/btn_view.svg')); ?>"/>View Original Record</a> -->
            <?php else: ?>
              <!--   <a href="javascript:;" class="btn btn-light btn-sm btn-center mb-3 disabled"><img src="<?php echo e(asset('admin/doctor/images/btn_view.svg')); ?>"/>View Original Record</a> -->
                     <button type="button" class="btn btn-primary btn-block mb-12px btn-left-iconed disabled" name="button"><img src="<?php echo e(asset('images/view_record.svg')); ?>" alt="icon">VIEW ORIGINAL RECORDS</button>
            <?php endif; ?>
           
            <button type="button" class="btn btn-black btn-block mb-12px  btn-left-iconed" name="button"><img src="<?php echo e(asset('images/time_ic.svg')); ?>" alt="icon"><a href="<?php echo e(url('patient/my_appointments')); ?>">FOLLOW-UP APPOINTMENT</a></button>
               <?php if($inc == 1): ?>
            <button type="button" class="btn btn-light-outline btn-block mb-12px  btn-left-iconed" name="button" data-toggle="modal" data-target="#send_record"><img src="<?php echo e(asset('images/send_ic.svg')); ?>" alt="icon" >SEND THIS RECORDS</button>
            <?php else: ?>
             <button type="button" class="btn btn-light-outline btn-block mb-12px  btn-left-iconed disabled" name="button" data-toggle="modal" data-target="#send_record"><img src="<?php echo e(asset('images/send_ic.svg')); ?>" alt="icon" >SEND THIS RECORDS</button>
             <?php endif; ?>
               <?php if($inc == 1): ?>
            <button type="button" class="btn btn-light-outline btn-block mb-12px  btn-left-iconed" name="button"><img src="<?php echo e(asset('images/download_ic.svg')); ?>" alt="icon"><a href="<?php echo e(asset('patient/downloadrecords/'.$health_history->history_id)); ?>">DOWNLOAD PDF FILES</a></button>
            <?php endif; ?>
        </div>

        <div class="col-12 col-xl-9">
            <div class="widget_body mb-4">
                <div class="settings">
                    <!-- Nav pills -->
                      <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="pill" href="#Examination">Examination</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="pill" href="#Laboratory_Results">Laboratory Results</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="pill" href="#Medications">Medications</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="pill" href="#Imaging_Documents">Imaging Documents</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="pill" href="#MICS">MICS</a>
                        </li>
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content padding-custom-history">
                        <div id="Examination" class="tab-pane active">
                            <div class="payment_description">
                                <h3>GENERAL</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet posuere est, sed gravida dui molestie vestibulum. Curabitur vel tempor lacus. Proin fermentum nunc fermentum, consequat risus quis, bibendum ante.</p>
                            </div>
                            <div class="payment_description">
                                <h3>CARDIOVASCULAR SYSTEM EXAM (CVS)</h3>
                                <p><?php echo e($health_history->cvs_det); ?></p>
                            </div>
                            <div class="payment_description">
                                <h3>RESPIRATORY</h3>
                                <p><?php echo e($health_history->respiratory_det); ?></p>
                            </div>
                            <div class="payment_description">
                                <h3>ABDOMEN</h3>
                                <p><?php echo e($health_history->abdomen_det); ?></p>
                            </div>
                            <div class="payment_description">
                                <h3>CENTRAL NERVOUS SYSTEM (CNS)</h3>
                                <p><?php echo e($health_history->cns_det); ?></p>
                            </div>
                            <div class="payment_description">
                                <h3>MUSCULOSKELETAL SYSTEM</h3>
                                <?php if(!empty($health_history->musculoskeletal)): ?>
                                            <p><?php echo e($health_history->musculoskeletal); ?></p>
                                        <?php else: ?>
                                            <p>No details</p>
                                        <?php endif; ?>
                            </div>
                            <div class="payment_description">
                                <h3>HEAD, EYE, EAR, NOSE, AND THROAT (HEENT)</h3>
                                <?php if(!empty($health_history->heent)): ?>
                                            <p><?php echo e($health_history->heent); ?></p>
                                        <?php else: ?>
                                            <p>No details</p>
                                        <?php endif; ?>
                            </div>
                            <div class="payment_description">
                                <h3>GENTO URINARY SYSTEM</h3>
                                <?php if(!empty($health_history->urinary)): ?>
                                            <p><?php echo e($health_history->urinary); ?></p>
                                        <?php else: ?>
                                            <p>No details</p>
                                        <?php endif; ?>
                            </div>
                            <div class="payment_description mb-0">
                                <h3>OTHER SYSTEM</h3>
                                <?php if(!empty($health_history->other_system)): ?>
                                            <p><?php echo e($health_history->other_system); ?></p>
                                        <?php else: ?>
                                            <p>No details</p>
                                        <?php endif; ?>
                            </div>
                        </div>
                        <div id="Laboratory_Results" class="tab-pane fade">
                            <div class="payment_description">
                                <h3>BLOOD COUNT</h3>
                                <div class="description_list">
                                    <ul>
                                        <li>
                                            <h4>Red Blood Cells</h4>
                                            <div class="line"></div>
                                            <div class="des_list_detail">
                                                <div class="des_list_detail_unit">
                                                    <span class="digits_numbers color_primary"><?php echo e($health_history->rbc_det); ?></span>
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
                                                    <span class="digits_numbers color_info"><?php echo e($health_history->wbc_det); ?></span>
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
                                                    <span class="digits_numbers color_primary"><?php echo e($health_history->hb_det); ?></span>
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
                                                    <span class="digits_numbers color_danger"><?php echo e($health_history->hmt_det); ?></span>
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
                                                    <span class="digits_numbers color_primary"><?php echo e($health_history->plt_det); ?></span>
                                                    <span class="digits_text">millions cell/mcL</span>
                                                    <span class="badge badge-primary">Normal</span>
                                                </div>
                                                <p>The normal range of red blood cell counts for female is 4 to 5 million cell/mcl</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="payment_description mb-0">
                                <h3>CHOLESTEROL</h3>
                                <div class="description_list">
                                    <ul>
                                        <li>
                                            <h4>Cholesterol LDL</h4>
                                            <div class="line"></div>
                                            <div class="des_list_detail">
                                                <div class="des_list_detail_unit">
                                                    <span class="digits_numbers color_primary"><?php echo e($health_history->ch_ldl_det); ?></span>
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
                                                    <span class="digits_numbers color_danger"><?php echo e($health_history->ch_hdl_det); ?></span>
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
                        <div id="Medications" class="tab-pane fade">
                             <div class="medications">
                                 <table class="modal_table table table-bordered">
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
                        <div id="Imaging_Documents" class="tab-pane fade">
                            <div class="imaging_documents">
                                <table class="modal_table table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>Date</th>
                                          <th>Name of Las</th>
                                          <th>Category</th>
                                          <th>Files</th>
                                          <th class="text-center">Explanation</th>
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
                                                          <a href="javascript;" data-img_path= "<?php echo e(asset('admin/doctor/uploads/hhistory/'.$health_history->history_id.'/'.$history_attachments->patient_attachment_name)); ?>" onclick="openAttachmentImage(this); return false;">
                                                            <img src="<?php echo e(asset('admin/doctor/images/attachment.svg')); ?>" alt="icon">
                                                            <?php $ext = pathinfo($history_attachments->patient_attachment_name, PATHINFO_EXTENSION); ?>
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
                        <div id="MICS" class="tab-pane fade">
                            MICS
                        </div>
                      </div>
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
                       <!-- <span class="onboarding_next">Next</span> -->
                       <span class="onboarding_last" data-dismiss="modal">Get Started</span>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="send_record">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal onboarding">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(asset('images/popup_close.svg')); ?>"/></button>
            <div class="modal-body">
                <form role="form" method="POST" action="" id="send_record_form">
                   
                    <div class="form-group">
                        <label class="control-label">Enter an Email address</label>
                        <div>
                            <input type="email" class="form-control input-lg" name="email" value="" id="email_record">
                        </div>
                    </div>
                     <div class="form-group">
                        <div>
                            <input  type="button" class="btn btn-primary button-record" onclick="sendrecord(<?php echo $health_history->history_id ?>)" value="Send Record">
                            <img src="<?php echo e(asset('images/loader.gif')); ?>" class="loader-image" style="display:none;">
 
                           
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.patient_fluid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>