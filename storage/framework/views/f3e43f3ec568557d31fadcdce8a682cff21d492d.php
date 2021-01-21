<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="page_head">
                <a href="<?php echo e(url('admin/all_appointments/'.$appointment[0]->doctor_id)); ?>" class="back_button">Back to schedule</a>
                <h1 class="inner_heading">Appointment Details</h1>
             </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
             <div class="widget padding-40">
                <div class="appointment_detail">
                    <div class="patient_profile">
                    	<?php if($appointment[0]['patient_id'] != ""): ?>
                    		<?php if($appointment[0]->patient_detail->patient_profile_img != ""): ?>
                    		<div class="pp_image">
	                            <img src="<?php echo e(asset('uploads/patient/'.$appointment[0]->patient_detail->patient_profile_img)); ?>" alt="image">
	                        </div>
                    		<?php else: ?>
			                <div class="pp_image">
			                    <img src="<?php echo e(asset('admin/doctor/images/profile.svg')); ?>" alt="image"/>
			                </div>
			                <?php endif; ?>                        
	                        <div class="pp_desc">
	                        	<?php if($appointment[0]->patient_detail->patient_gender == 1): ?>
	                            	<h4>Mr. <?php echo e(ucfirst($appointment[0]->patient_detail->patient_first_name)); ?> <?php echo e(ucfirst($appointment[0]->patient_detail->patient_last_name)); ?></h4>
	                            	<h5>29 y/o, Male</h5>
	                            <?php elseif($appointment[0]->patient_detail->patient_gender == 2): ?>
	                            	<h4>Ms. <?php echo e(ucfirst($appointment[0]->patient_detail->patient_first_name)); ?> <?php echo e(ucfirst($appointment[0]->patient_detail->patient_last_name)); ?></h4>
	                            	<h5>29 y/o, Female</h5>
	                            <?php else: ?>
	                            	<h4><?php echo e(ucfirst($appointment[0]->patient_detail->patient_first_name)); ?> <?php echo e(ucfirst($appointment[0]->patient_detail->patient_last_name)); ?></h4>
	                           	<?php endif; ?>
	                        </div>
	                    </div>
	               	<?php endif; ?>
                    <div class="d-flex">
                         <div class="patient_more">
                            <img src="<?php echo e(asset('admin/doctor/images/loc.svg')); ?>" alt="icon">
                            <div>
                                <?php if(empty($appointment[0]->hospital_id)): ?>
                                    <h4><?php echo e($appointment[0]->hospital_name); ?></h4>
                                    <h5>Oshodi Isolo, Lagos, Nigeria</h5>
                                <?php else: ?>
                                    <h4><?php echo e($appointment[0]->hospital_detail->hosp_name); ?></h4>
                                    <h5><?php echo e($appointment[0]->hospital_detail->hosp_address); ?></h5>
                                <?php endif; ?>
                            </div>
                        </div>
                         <div class="patient_more">
                            <img src="<?php echo e(asset('admin/doctor/images/clock.svg')); ?>" alt="icon">
                            <div>
                                <?php  date_default_timezone_set($timezone); ?>
                                <h4><?php echo e(date('D',$appointment[0]->appointment_time)); ?>, <?php echo e(date('j M Y',$appointment[0]->appointment_time)); ?></h4>
                                <h5>at <?php echo e(date('h:i A',$appointment[0]->appointment_time)); ?></h5>
                            </div>
                        </div>
                    </div>
                <a href="<?php echo e(asset('admin/medical_records/'.$appointment[0]->patient_id)); ?>" class="btn btn-primary btn-sm">View Medical Records</a>
                </div>
                <div class="cause">
                    <h5>Reason for visit :</h5>
                    <p><?php echo e($appointment[0]->symptoms); ?></p>
                </div>
                <div class="patient_fettle">
                   <h3>Patient Health Diary</h3>
                     <?php if(count($diary_details)>0): ?>
                        <?php $__currentLoopData = $diary_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diary_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row mb-4 pb-2">
                        <div class="col-sm-8">
                            <div class="ailing">
                            <?php $feeling_pic = ['admin/doctor/images/smilies/no_pain@2x.png','admin/doctor/images/smilies/mild@2x.png','admin/doctor/images/smilies/moderate@2x.png','admin/doctor/images/smilies/severe@2x.png','admin/doctor/images/smilies/very_severe@2x.png','admin/doctor/images/smilies/worst_pain@2x.png','admin/doctor/images/smilies/moderate@2x.png'];
                             $put_disable_keys=array();
                             $feeling = ['Feeling No Pain','Feeling Mild Pain','Feeling Moderate Pain','Feeling Severe Pain','Feeling Very Severe Pain','Feeling Worst Pain','other'];  

                            $source=$feeling_pic[$diary_detail->feeling_details];

                            if($diary_detail->feeling_details==6){
                            $feeling_other=$diary_detail->describe_feeling_other;
                            }
                            else{
                            $feeling_other=$diary_detail->feeling_details;                          
                            }
                            $put_disable_keys[]=$feeling_other;
                            ?>
                            <?php //print_r($put_disable_keys); ?>
                       
                            
                             <h5><img src="<?php echo e(asset($source)); ?>" alt="image"> 
                                <?php $__currentLoopData = $feeling; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$single_feeling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                       <?php if(in_array($key,$put_disable_keys)): ?>                              
                                        <?php echo e($single_feeling); ?>

                                      
                                         <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </h5>
                        <p><?php echo e($diary_detail->symptom_details); ?></p>
                        </div>
                        <div class="infirmary_pic">
                        <?php if(isset($diary_detail['diary_attachment']) && count($diary_detail['diary_attachment']) > 0): ?>
                        <?php $__currentLoopData = $diary_detail['diary_attachment']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e(asset($attachment['attachment_path'])); ?>" alt="">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                        <?php else: ?>
                        <p>No Attachments Attached</p>     
                        <?php endif; ?> 
                        </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="supplementary">
                                <h6>Diary created :</h6>
                                <h5><?php echo e(date('d F Y h:i A',$diary_detail->created_date)); ?></h5>
                            </div>
                            <div class="supplementary">
                                <h6>Medications :</h6>
                                <h5><?php echo e($diary_detail->medication_details); ?></h5>
                            </div>
                        </div>
                       
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                         <div class="row">
                             <div class="col-sm-12">
                     <p> No Patient Diary attached</p>
                </div>
                </div>

                      <?php endif; ?>
                </div>
             </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>