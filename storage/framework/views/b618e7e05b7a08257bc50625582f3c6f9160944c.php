<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="widget">
                <div class="widget_header mb-4">
                    <h2>My Profile</h2>                               
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="widget_body mb-4">
                            <div class="my_profile_section">
                                <?php $__currentLoopData = $myprofile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myprofile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="profile_name">
                                        <div class="profile_d_image">                                        
                                            <?php if($myprofile->patient_profile_img == 0): ?>
                                                <img id="uploadPreview" src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('uploads/patient/'.$myprofile->patient_profile_img)); ?>" alt="image">
                                            <?php endif; ?>
                                        </div>
                                        <h4><?php if($myprofile->patient_gender == 1): ?>
                                                <?php if($myprofile->patient_martial_status == 1): ?>
                                                  <?php echo e('Mrs.'); ?>

                                                <?php else: ?>
                                                  <?php echo e('Miss'); ?>

                                                <?php endif; ?>
                                            <?php else: ?>
                                              <?php echo e('Mr.'); ?>

                                            <?php endif; ?>
                                            <?php echo e($myprofile->patient_first_name); ?> <?php echo e($myprofile->patient_last_name); ?></h4>
                                        <h6>
                                            <?php 
                                                if(!empty($myprofile->patient_date_of_birth)){
                                                $date = $myprofile->patient_date_of_birth;
                                                $databasedate = date("Y-m-d",$date);
                                                $current_date = date("Y-m-d");
                                                $diff = abs(strtotime($current_date) - strtotime($databasedate));
                                                $years = floor($diff / (365*60*60*24));
                                                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                printf("%d", $years);
                                                echo "y/o,"; }
                                                ?>  <?php if($myprofile->patient_gender == 0): ?> Male <?php else: ?> Female <?php endif; ?>
                                        </h6>
                                        <a href="<?php echo e(url('patient/settings')); ?>" class="btn btn-primary">EDIT MY PROFILE</a>
                                    </div>
                                    <div class="widget_profile_desc mb-0">
                                        <ul>
                                            <li><span><img src="<?php echo e(asset('admin/doctor/images/location.svg')); ?>" alt="icon"></span>
                                                <?php if(!empty($myprofile->patient_address)): ?>
                                                  <p><?php echo e(ucfirst($myprofile->patient_address)); ?></p>
                                                <?php else: ?>
                                                  <p>-</p>
                                                <?php endif; ?>
                                            </li>
                                            <li>
                                                <span><img src="<?php echo e(asset('admin/doctor/images/gender.svg')); ?>" alt="icon"></span>
                                                <p> <?php if($myprofile->patient_martial_status == 0): ?> Unmarried <?php else: ?> Married <?php endif; ?> </p>
                                            </li>
                                            <li>
                                                <span><img src="<?php echo e(asset('admin/doctor/images/mic.svg')); ?>" alt="icon"></span>
                                                <?php if(!empty($myprofile->patient_languages)): ?>
                                                  <p><?php echo e(join(',', array_map('ucfirst', explode(',', $myprofile->patient_languages)))); ?></p>
                                                <?php else: ?>
                                                  <p>-</p>
                                                <?php endif; ?>
                                            </li>
                                            <li>
                                                <span><img src="<?php echo e(asset('admin/doctor/images/bday.svg')); ?>" alt="icon"></span>
                                                <?php if(!empty($myprofile->patient_date_of_birth)): ?>
                                                  <p><?php echo e(date("dS M Y", $myprofile->patient_date_of_birth)); ?> (Birthday)</p>
                                                <?php else: ?>
                                                  <p>-</p>
                                                <?php endif; ?>
                                            </li>
                                            <li>
                                                <span><img src="<?php echo e(asset('admin/doctor/images/drop.svg')); ?>" alt="icon"></span>
                                                <?php if(!empty($myprofile->patient_blood_type)): ?>
                                                    <p>Blood type : <?php echo e($myprofile->patient_blood_type); ?></p>
                                                <?php else: ?>
                                                    <p>Blood type : -</p>
                                                <?php endif; ?>
                                            </li>
                                            <li>
                                                <span><img src="<?php echo e(asset('admin/doctor/images/group.svg')); ?>" alt="icon"></span>
                                                <?php if(!empty($myprofile->patient_blood_type)): ?>
                                                    <p>State Of Origin : <?php echo e(ucfirst($myprofile->patient_origin_state)); ?></p>
                                                <?php else: ?>
                                                    <p>State Of Origin : -</p>
                                                <?php endif; ?>
                                            </li>
                                        </ul>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="profile_data">
                                    <div class="data_unit">
                                        <img src="<?php echo e(asset('admin/doctor/images/attended.svg')); ?>" alt="icon">
                                            <h2><?php echo e($apt_cnt); ?></h2>
                                            <h5>Appointment Attended</h5>
                                    </div>
                                    <div class="data_unit">
                                        <img src="<?php echo e(asset('admin/doctor/images/created.svg')); ?>" alt="icon">
                                        <h2><?php echo e($hstry_cnt); ?></h2>
                                        <h5>Medical History Created</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="widget">
                            <div class="widget_body">
                                <a class="widget_link" href="javascript:void(0)" onclick="blockPopupFn()">
                                    <div class="widget_link_icon">
                                        <img src="<?php echo e(asset('admin/doctor/images/appoint.svg')); ?>" alt="icon">
                                    </div>
                                    <div class="widget_link_text">
                                        <h4>Schedule Telelconsultation Appointment</h4>
                                        <p>Make appointment with doctor.</p>
                                    </div>
                                </a>
                                <!-- <a class="widget_link" href="<?php echo e(url('/patient/dashboard/1')); ?>">
                                    <div class="widget_link_icon">
                                        <img src="<?php echo e(asset('admin/doctor/images/appoint.svg')); ?>" alt="icon">
                                    </div>
                                    <div class="widget_link_text">
                                        <h4>Schedule Telelconsultation Appointment</h4>
                                        <p>Make appointment with doctor.</p>
                                    </div>
                                </a> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="widget">
                            <div class="widget_body">
                                <a class="widget_link" href="<?php echo e(url('/patient/appointment')); ?>">
                                    <div class="widget_link_icon">
                                        <img src="<?php echo e(asset('admin/doctor/images/hospital.svg')); ?>" alt="icon">
                                    </div>
                                    <div class="widget_link_text">
                                        <h4>Schedule Hospital Appointment</h4>
                                        <p>Set schedule to make appointment with doctor.</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="widget">
                            <div class="widget_body">
                                <a class="widget_link" href="<?php echo e(url('/patient/add_new_diary')); ?>">
                                    <div class="widget_link_icon">
                                        <img src="<?php echo e(asset('admin/doctor/images/red_heart.svg')); ?>" alt="icon">
                                    </div>
                                    <div class="widget_link_text">
                                        <h4>Add New Health Diary</h4>
                                        <p>Set schedule to make appointment with doctor.</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.patient', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>