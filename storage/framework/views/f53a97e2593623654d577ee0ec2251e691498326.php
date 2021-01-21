<?php $__env->startSection('content'); ?>

    <main class="col-12 col-md-12 col-xl-12 bd-content">
        <div class="main_div">
            <div class="row">
                <div class="col-12">
                    <div class="page_head">
                        <div class="patient">
                            <div class="patient_image">

                                <?php if($patient_detail['patient_profile_img'] != ""): ?>
                                    <img src="<?php echo e(asset('uploads/patient/'.$patient_detail['patient_profile_img'])); ?>" alt="image"/>
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image"/>
                                <?php endif; ?>  
                            </div>
                            <div class="patient_detail">
                                <h2>
                                    <?php if($patient_detail['patient_gender'] == 1): ?>
                                        <?php if($patient_detail['patient_martial_status'] == 1): ?>
                                            <?php echo e('Mrs.'); ?>

                                        <?php else: ?>
                                            <?php echo e('Miss'); ?>

                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php echo e('Mr.'); ?>

                                    <?php endif; ?>
                                    <?php echo e(ucfirst($patient_detail['patient_first_name']).' '.ucfirst($patient_detail['patient_last_name'])); ?></h2>
                                <span>PATIENT ID: Patient-<?php echo e($patient_detail['patient_unique_id']); ?></span>
                            </div>
                        </div>
                        <div>
                        <a href="<?php echo e(url('doctor/patients/add_new_record/'.$patient_detail['patient_unique_id'])); ?>" class="btn btn-primary btn-sm btn-medical">Add Medical Record</a> 

                        </div>
                    </div>
                </div>
            </div>

            <?php if(count($health_history) >0): ?>    
                <div class="row">
                    <div class="col-12">
                        <div class="table_hospital pagination_fixed_bottom">
                        <div class="table-responsive">
                        <table class="table" cellspacing="10">
                            <tr>
                                <th>DATE</th>
                                <th>HOSPITAL </th>
                                <th>DOCTOR NAME</th>
                                <th>MEDICAL RECORD NUMBER</th>
                                <th></th>
                            </tr>
                            <?php $__currentLoopData = $health_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $health_his): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>

                                    <td><?php if(date('Y-m-d' ,$health_his['created_date'])==date('Y-m-d')): ?>
                                        <?php echo e('Today'); ?><br>
                                        <?php elseif(date('Y-m-d' ,$health_his['created_date'])==date('Y-m-d',strtotime('+1 day'))): ?>
                                        <?php echo e('Tomorrow'); ?><br>
                                        <?php endif; ?>
                                        <?php echo e(date('d F Y' ,$health_his['created_date'])); ?>

                                    </td>
                                    <?php if(!empty($health_his->doctor_id)): ?>                                
                                        <td><?php echo e($health_his->doctor->doctor_hospital_details->hosp_name); ?></td>
                                    <?php elseif(!empty($health_his->nurse_id)): ?>
                                        <td><?php echo e($health_his->nurse->nurse_hospital_details->hosp_name); ?></td>
                                    <?php elseif(!empty($health_his->employee_id)): ?>
                                        <td><?php echo e($health_his->employee->employee_hospital_details->hosp_name); ?></td>
                                    <?php elseif(!empty($health_his->hospital_id)): ?>
                                        <td><?php echo e($health_his->hospital->hosp_name); ?></td> 
                                    <?php endif; ?>
                                    <td>

                                        <div class="d_profile">
                                            <?php if(!empty($health_his->doctor_id)): ?>
                                            <div class="d_pro_img">
                                                    <?php
                                        if(!empty($health_his->doctor->doctor_picture)){
                                        if(file_exists(getcwd().'/doctorimages/'.$health_his->doctor->doctor_picture)){
                                            ?>
                                                            <img src="<?php echo e(asset('/doctorimages/'.$health_his->doctor->doctor_picture)); ?>" alt="image">
                                                    <?php     }
                                                        else { ?>
                                                            <img src="<?php echo e(asset('admin/doctor/images/profile.svg')); ?>" alt="image">
                                                    <?php   }
                                                    }
                                                    else { ?>
                                                            <img src="<?php echo e(asset('admin/doctor/images/profile.svg')); ?>" alt="image">
                                                    <?php   }

                                                    ?>
                                            </div>
                                            <div class="d_pro_text">
                                                <h4> <?php if($health_his->doctor->doctor_gender === 0): ?> Mr.
                                                <?php elseif($health_his->doctor->doctor_gender== 1 && $health_his->doctor->marital_status== 1): ?>Mrs
                                                <?php elseif($health_his->doctor->doctor_gender== 1): ?> Miss
                                                    <?php endif; ?> 
                                                    <?php echo e($health_his->doctor->doctor_first_name); ?> <?php echo e($health_his->doctor->doctor_last_name); ?></h4>
                                                <!--  <a href="javascript:;">View Profile</a> -->
                                            </div>
                                            <?php elseif(!empty($health_his->nurse_id)): ?>
                                                <div class="d_pro_img">
                                                    <?php if(!empty($health_his->nurse->nurse_picture)): ?>
                                                        <img src="<?php echo e(asset('admin/nurse/uploads/profile/'.$health_his->nurse->nurse_picture)); ?>" alt="image">                               
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('admin/nurse/images/profile.svg')); ?>" alt="image">                                                
                                                    <?php endif; ?>
                                            </div>
                                            <div class="d_pro_text">
                                                <h4>Mr. <?php echo e($health_his->nurse->nurse_first_name); ?> <?php echo e($health_his->nurse->nurse_last_name); ?></h4>
                                                <a href="javascript:;">View Profile</a>
                                            </div>
                                            <?php elseif(!empty($health_his->employee_id)): ?>
                                                <div class="d_pro_img">
                                                    <?php if(!empty($health_his->employee->employee_picture)): ?>
                                                        <img src="<?php echo e(asset('admin/employee/uploads/profile/'.$health_his->employee->employee_picture)); ?>" alt="image">                               
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('admin/employee/images/profile.svg')); ?>" alt="image">                                                
                                                    <?php endif; ?>
                                            </div>
                                            <div class="d_pro_text">
                                                <h4>Mr. <?php echo e($health_his->employee->employee_first_name); ?> <?php echo e($health_his->employee->employee_last_name); ?></h4>
                                                <a href="javascript:;">View Profile</a>
                                            </div>
                                            <?php elseif(!empty($health_his->hospital_id)): ?>
                                                <div class="d_pro_img">
                                                    <?php if(!empty($health_his->hospital->hospital_picture)): ?>
                                                        <img src="<?php echo e(asset('admin/hospital/uploads/profile/'.$health_his->hospital->hospital_picture)); ?>" alt="image">                               
                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('admin/hospital/images/profile.svg')); ?>" alt="image">                                                
                                                    <?php endif; ?>
                                            </div>
                                            <div class="d_pro_text">
                                                <h4><?php echo e($health_his->hospital->hosp_name); ?></h4>
                                                <a href="javascript:;">View Profile</a>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                        <td>MRN-<?php echo e($health_his->history_id); ?></td>
                                        <td>
                                            <a href="<?php echo e(url('doctor/patients/view_record/'.$health_his->history_id)); ?>" class="btn btn-light btn-xs mr-2" name="button"><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">View Detail</a>
                                            <div class="dropdown d-inline-block">
                                            <a class="option no_caret btn-xs dropdown-toggle" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="<?php echo e(asset('admin/doctor/images/options.svg')); ?>" alt="icon"/>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="javascript:;" onclick="billingInfo(this); return false;" data-id="<?php echo e($health_his->history_id); ?>"><span><img src="<?php echo e(asset('admin/doctor/images/billling.svg')); ?>" alt="icon"></span>Billing Info</a>
                                                <a class="dropdown-item" href="<?php echo e(url('doctor/edit_medical_record/'. $health_his->history_id)); ?>"><span><img src="<?php echo e(asset('admin/doctor/images/enter.svg')); ?>" alt="icon"></span>Enter Record</a>
                                            </div>
                                        </div>
                                        </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                       
                        </table>
                        </div>
                        <div class="table_pagination">
                            <button type="button" class="btn btn-light btn-xs pre1" <?php if($health_history->previousPageUrl()){  } else{ echo "disabled"; } ?> data-url="<?php echo $health_history->previousPageUrl(); ?>">Previous Page</button>
                            <span>Page <?php echo e($health_history->currentPage()); ?> of <?php echo e($health_history->lastPage()); ?> Pages</span>
                            <button type="button" class="btn btn-light btn-xs next1"  <?php if($health_history->nextPageUrl()){  } else{ echo "disabled"; } ?>  data-url="<?php echo $health_history->nextPageUrl(); ?>">Next Page</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-12">
                        <div class="widget padding-40">
                            <div class="empty_record">
                                <img src="<?php echo e(asset('admin/doctor/images/no_record.svg')); ?>" alt="icon">
                                <h3>This Patient doesn’t have medical record history before</h3>
                                <p>Please add new medical record on the top right button of this page</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.doctor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>