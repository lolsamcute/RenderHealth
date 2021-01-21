<?php $__env->startSection('content'); ?>

<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="widget">
                <div class="widget_header">
                    <h2>Hospital appointment</h2>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-4">                        
                        <div class="widget_body doctor_exists_main widget_profile mb-4">
                            <div class="alert alert-danger-outline alert-dismissible alert_icon fade show error_msg_tele text-left" id="error_msg_tele" role="alert" style="display:none;">
                                <div class="d-flex align-items-center">
                                    <div class="alert-icon-col">
                                        <span class="fa fa-warning"></span>
                                    </div>
                                    <div class="alert_text error_text_tele">
                                        Email field is required
                                    </div>
                                    <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                                </div>
                            </div>
                            <form>
                                <?php echo e(csrf_field()); ?>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>1. Select Hospital</label>
                                            <div class="select_box">
                                                <select class="form-control hosp_list" name="hosp_list" onchange="hospitalDoctorListing(this); return false;">
                                                    <option value="">Select Hospital</option>
                                                    <?php if(count($hospitals) > 0): ?>
                                                        <?php $__currentLoopData = $hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($hospital->hosp_id); ?>"><?php echo e($hospital->hosp_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>2. Reason for visit</label>
                                            <textarea class="form-control symptoms" name="name" rows="4" cols="40" placeholder="Write here …"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php if(count($health_diaries)>0): ?>
                                        <a class="attachment mb-4 mt-2" href="javascript:;" data-toggle="modal" data-target="#select_diary">
                                                  <img src="<?php echo e(asset('images/attachment.svg')); ?>" alt="icon">
                                                  Attach My Health Diary
                                             </a> 
                                                        <?php else: ?>
                                                        <a class="attachment mb-4 mt-2" href="javascript:;" onClick="(function(){
                                                        alert('No health diary found');
                                                        return false;
                                                        })();return false;">
                                                        <img src="<?php echo e(asset('images/attachment.svg')); ?>" alt="icon">
                                                        Attach My Health Diary
                                                        </a> 
                                                        <?php endif; ?>

                                             <div class="attachdoaries">
                                         
                                             </div>
                                           

                                             <!--div class="form-group">
                                                 <label>3. Health Diary </label>
                                            <?php  $feeling = ['Feeling No Pain','Feeling Mild Pain','Feeling Moderate Pain','Feeling Severe Pain','Feeling Very Severe Pain','Feeling Worst Pain','other'];   
                                            ?>

                                             <select name="health_diary" id="health_diary" class="form-control">
                                                <option value="Select Diary">Select health diary to attach</option>
                                                    <?php if(count($health_diaries) > 0): ?>
                                                    <?php $__currentLoopData = $health_diaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dieary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($dieary->diary_id=='6'): ?>
                                                       <option value="<?php echo e($dieary->diary_id); ?>"><?php echo e($dieary->describe_feeling_other); ?></option>
                                                  
                                                    <?php else: ?>
                                                   <option value="<?php echo e($dieary->diary_id); ?>"><?php echo e($feeling[$dieary->feeling_details]); ?></option>
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>

                                             </select>
                                    </div-->
                                </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <input type="hidden" class="appoint_type" id="appoint_type" value="<?php echo e($hosp_id); ?>"> 
                                        <button class="btn btn-danger btn-min-width-auto mr-2" type="submit">Cancel</button>
                                        <button class="btn btn-primary" type="button" onclick="saveHospitalAppointment(this); return false;">Save appointment</button>
                                    </div>
                                </div>
                                 <!-- Diary Modal -->
    <div class="modal fade" id="select_diary">
        <div class="modal-dialog modal-xl modal-dialog-centered genModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add My Health Diary</h4>
                    <button type="button" class="close mclose" data-dismiss="modal"><img src="<?php echo e(asset('images/cross_modal.svg')); ?>"/></button>
                 </div>
                <div class="modal-body">
                    <div class="health_diary">
                        <ul class="row">
                            <?php $__currentLoopData = $health_diaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Singlehealth_diaries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="col-sm-4">
                                <input id="diary_<?php echo e($Singlehealth_diaries->id); ?>" value="<?php echo e($Singlehealth_diaries->diary_id); ?>" class="form-check-input health_diary" name="health_diary" type="checkbox"   onclick="appenddiary(<?php echo $Singlehealth_diaries->diary_id;?>,this)" />
                                <label for="diary_<?php echo e($Singlehealth_diaries->id); ?>">
                                    <span class="diary_date"><?php echo e(date('j F Y',$Singlehealth_diaries->created_date)); ?></span>
                                    <div class="diary_detail">
                                        <?php
                                             $feeling_pic = ['admin/doctor/images/smilies/no_pain@2x.png','admin/doctor/images/smilies/mild@2x.png','admin/doctor/images/smilies/moderate@2x.png','admin/doctor/images/smilies/severe@2x.png','admin/doctor/images/smilies/very_severe@2x.png','admin/doctor/images/smilies/worst_pain@2x.png','admin/doctor/images/smilies/moderate@2x.png'];
                                            ?>
                                        <span class="diary_icon"><img src="<?php echo e(asset($feeling_pic[$Singlehealth_diaries->feeling_details])); ?>" alt="smilies"></span>
                                   <?php 
                                     $put_disable_keys=array();

                                     $feeling = ['Feeling No Pain','Feeling Mild Pain','Feeling Moderate Pain','Feeling Severe Pain','Feeling Very Severe Pain','Feeling Worst Pain',"Other"];    
                                      $put_disable_keys[]=$Singlehealth_diaries->feeling_details;
                                     
                                  ?>                              

                                     
                                       <?php $__currentLoopData = $feeling; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$single_feeling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                       <?php if($key==6): ?>
                                       <h4> <?php echo e(trim($Singlehealth_diaries->describe_feeling_other)); ?></h4> 
                                      <?php else: ?>
                                       <?php if(in_array($key,$put_disable_keys)): ?>                              
                                        <h4><?php echo e($single_feeling); ?></h4>                                      
                                         <?php endif; ?>
                                           <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                                        <h6><?php echo e($Singlehealth_diaries->symptom_details); ?></h6>
                                    </div>
                                </label>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-xl-8 doctors_listing">
                        <div class="widget_body">
                            <div class="no_data">
                                <img src="<?php echo e(asset('images/no_data.svg')); ?>" alt="images">
                                <h4>No availability, Please check another Facility</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.patient_fluid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>