<form method="post">
    <div class="row">
        <div class="col-6">
            <div class="picker">
                 <?php  date_default_timezone_set($timezone); ?>
                <div class="datepicker_input mb-2 reshedule_time" data-date="<?php echo e(date('d-m-Y',strtotime($appoint_date))); ?>" data-date-format="dd-mm-yyyy" id="reshedule_time"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="patient_data_right">
                <div class="patient_profile">
                    <div class="pp_image">
                       <?php if((file_exists(getcwd().'/uploads/patient/'.basename($appointment['patient_detail']['patient_profile_img']))) && (!empty($appointment['patient_detail']['patient_profile_img']))){
                                      ?>
                                      <img src="<?php echo e(asset('/uploads/patient/'.$appointment['patient_detail']['patient_profile_img'])); ?>" alt="image">
                                      <?php     }
                                      else { ?>
                                      <img src="<?php echo e(asset('admin/doctor/images/doc2.png')); ?>" alt="image">
                                      <?php   } ?>
                    </div>
                    <div class="pp_desc">
                        <?php if($appointment['patient_detail']['patient_gender'] == 1): ?>
                            <h4>Mr. <?php echo e(ucfirst($appointment['patient_detail']['patient_first_name'])); ?> <?php echo e(ucfirst($appointment['patient_detail']['patient_last_name'])); ?></h4>
                            <h5>29 y/o, Male</h5>
                        <?php elseif($appointment['patient_detail']['patient_gender'] == 2): ?>
                            <h4>Ms. <?php echo e(ucfirst($appointment['patient_detail']['patient_first_name'])); ?> <?php echo e(ucfirst($appointment['patient_detail']['patient_last_name'])); ?></h4>
                            <h5>29 y/o, Female</h5>
                        <?php else: ?>
                            <h4><?php echo e(ucfirst($appointment['patient_detail']['patient_first_name'])); ?> <?php echo e(ucfirst($appointment['patient_detail']['patient_last_name'])); ?></h4>
                        <?php endif; ?>                        
                    </div>
                </div>
                <div class="patient_detail">
                    <ul>
                        <li>
                            <img src="<?php echo e(asset('admin/doctor/images/loc.svg')); ?>" alt="icon">
                            <div>
                                <h5>Location :</h5>
                                <?php if(!empty($appointment['hospital_name'])): ?>
                                    <h4><?php echo e($appointment['hospital_name']); ?></h4>
                                <?php else: ?>
                                    <h4>-</h4>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li>
                            <img src="<?php echo e(asset('admin/doctor/images/app.svg')); ?>" alt="icon">
                            <div>
                                <h5>Type of appointment :</h5>
                                <?php if($appointment['patient_appoint']['appointment_type'] ==2): ?>
                                    <h4>Hospital Appointment</h4>
                                <?php elseif($appointment['patient_appoint']['appointment_type'] ==1): ?>
                                    <h4>Telemedical Appointment</h4>
                                <?php endif; ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="form-group mb-4">
                    <label>Time</label>
                    <div class="select_box">
                        
                         <select class="form-control appoint_time" name="">

                           <?php if(!empty($doctor_avail_time) && count($doctor_avail_time) > 0): ?>
                        <?php                                                
                        $count =0;
                        ?>
                        <?php $__currentLoopData = $doctor_avail_time['doctor_availability']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$availability): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <?php
                        $availability_time = $availability['availability_time'];               


                        if(date("Y-m-d H:i",strtotime($availability_time))  >= date('Y-m-d H:i')){


                        if(count($doc_appoint_listing) > 0){
                        $inc =0;
                        foreach($doc_appoint_listing as $doc_appoint){
                        if($doctor_avail_time['doctor_id'] == $doc_appoint['doctor_id']){
                        if(date("H:i",strtotime($availability_time)) ==  date('H:i',$doc_appoint['appointment_time'])){
                        $inc = 1;
                        }
                        }
                        }
                        if($inc == 1){                                                                                      
                        ?>                                                                                   
                                    @endphp
                                                               <option value ='<?php echo e(date("h:i A",strtotime($availability_time))); ?>' <?php if(date("h:i A",strtotime($availability_time)) == date('h:i A',$appointment['appointment_time'])){ echo 'selected';} ?> disabled="disabled"><?php echo e(date("h:i A",strtotime($availability_time))); ?></option>
                                    <?php                        }else{
                                     ?>                        
                                                                <option value ='<?php echo e(date("h:i A",strtotime($availability_time))); ?>' <?php if(date("h:i A",strtotime($availability_time)) == date('h:i A',$appointment['appointment_time'])){ echo 'selected';} ?> ><?php echo e(date("h:i A",strtotime($availability_time))); ?></option>

                                    <?php                            
                                                            }
                                                        }else{
                                    ?>
                                                      <option value ='<?php echo e(date("h:i A",strtotime($availability_time))); ?>' <?php if(date("h:i A",strtotime($time->format("h:i A"))) == date('h:i A',$appointment['appointment_time'])){ echo 'selected';} ?> ><?php echo e(date("h:i A",strtotime($availability_time))); ?></option>
   
                                   <?php
                                                        }
                                                    
                                                                                                                 
                                                $count++;
                                            } 
                                   
                                ?>                                                             
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                 <option value =''>No available time set by doctor yet</option>
                            <?php endif; ?>
                         </select>
                     </div>
                </div>
                <input type="hidden" id="hidden_date" class="hidden_date" value="<?php echo e(date('d-m-Y',strtotime($appoint_date))); ?>">
                <input type="hidden" id="hidden_book_id" class="hidden_book_id" value="<?php echo e($appointment['booking_id']); ?>">
                <input type="hidden" id="hidden_patient_id" class="hidden_patient_id" value="<?php echo e($appointment['patient_id']); ?>">
                <button type="button" class="btn btn-primary" onclick="updateAppointment(this); return false;">Update Appointment</button>
            </div>
        </div>
    </div>
</form>