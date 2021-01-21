
        <div class="table_hospital pagination_fixed_bottom">
             <div class="table-responsive">
          <table class="table appointment_scehdule" cellspacing="10">

            <tr>
              <th>DATE</th>
    
              <th>Patient profile</th>
              <th>TIME SCHEDULED</th>
              <th></th>
            </tr>
            <?php $i = "1" ?>           
            <?php if(count($PatientAppointment_details) > 0): ?>
              <?php $__currentLoopData = $PatientAppointment_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient_details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr <?php if($patient_details->st_status==1){ echo 'class="recent"'; } ?> id="let">
                  <td>
                    <?php date_default_timezone_set($timezone); ?>

                    <?php if(date('Y-m-d' ,$patient_details->appointment_time)==date('Y-m-d')): ?>
                        <?php echo e('Today'); ?><br>
                    <?php elseif(date('Y-m-d' ,$patient_details->appointment_time)==date('Y-m-d',strtotime('+1 day'))): ?>
                        <?php echo e('Tomorrow'); ?><br>
                    <?php endif; ?>
                        <?php echo e(date('d F Y' ,$patient_details->appointment_time)); ?>           
                  </td>
               
                  <td>
                    <div class="d_profile">
                      <div class="d_pro_img">

                        <?php if($patient_details->patient_detail->patient_profile_img != "" && (file_exists(getcwd().'uploads/patient/'.$patient_details->patient_detail->patient_profile_img))): ?>
                      
                              <img src="<?php echo e(asset('uploads/patient/'.$patient_details->patient_detail->patient_profile_img)); ?>" alt="image">
                       
                        <?php else: ?>
                    
                          <img src="<?php echo e(asset('admin/doctor/images/profile.svg')); ?>" alt="image"/>
                   
                      <?php endif; ?>
                      
                      </div>
                      <div class="d_pro_text">
                        <h4><?php if($patient_details->patient_detail->patient_gender== 0 && $patient_details->patient_detail->patient_gender!= NULL): ?> Mr.
                                       <?php elseif($patient_details->patient_detail->patient_gender== 1 && $patient_details->patient_detail->patient_martial_status== 1): ?>Mrs
                                       <?php elseif($patient_details->patient_detail->patient_gender== 1): ?> Miss
                                       <?php else: ?> 
                                       <?php endif; ?><?php echo e($patient_details->patient_detail->patient_first_name); ?></h4>
                        <a href="javascript:;">View Profile</a>
                      </div>
                    </div>
                  </td>
                  <td><?php echo e($newdate = date('h:i:A', $patient_details->appointment_time)); ?></td>                                       
                    <td>
                      <?php if($patient_details->patient_appoint->appointment_type==1): ?>
                        <?php if($disabled > 0): ?>
                          <button type="button" disabled class="btn btn-light btn-xs mr-2 call_btn" name="button" onclick="callPatient(this); return false;" data-doctor_id="123456" data-call_type="<?php echo e($patient_details->patient_appoint->telemedical_type); ?>" data-appoint_id="<?php echo e($patient_details->patient_appoint->appointment_id); ?>" data-patient_id="<?php echo e($patient_details->patient_id); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">Call</button>
                        <?php elseif(date('Y-m-d',$patient_details->appointment_time) >= date('Y-m-d')): ?>
                          <button type="button" class="btn btn-light btn-xs mr-2 call_btn" name="button" onclick="callPatient(this); return false;" data-doctor_id="123456" data-call_type="<?php echo e($patient_details->patient_appoint->telemedical_type); ?>" data-appoint_id="<?php echo e($patient_details->patient_appoint->appointment_id); ?>" data-patient_id="<?php echo e($patient_details->patient_id); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">Call</button>
                        <?php else: ?>                        
                          <button type="button" disabled class="btn btn-light btn-xs mr-2 call_btn" name="button" onclick="callPatient(this); return false;" data-doctor_id="123456" data-call_type="<?php echo e($patient_details->patient_appoint->telemedical_type); ?>" data-appoint_id="<?php echo e($patient_details->patient_appoint->appointment_id); ?>" data-patient_id="<?php echo e($patient_details->patient_id); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">Call</button>
                        <?php endif; ?>
                      <?php endif; ?>
                     
                     <?php if($patient_details->patient_appoint->appointment_type == 2): ?>
                <a href="<?php echo e(url('doctor/appointment_detail/'.$patient_details->booking_id)); ?>" class="btn btn-light btn-xs mr-2" name="button"><img class="icon" src="" alt=""><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">View </a>             
              <?php endif; ?>

                  <div class="dropdown d-inline-block">               
                <?php if(date('Y-m-d H:i',$PatientAppointment_details['appointment_time']) <= date('Y-m-d H:i',strtotime('-15 min'))): ?>
                <a class="btn btn-danger no_caret btn-xs dropdown-toggle disabled_cancel" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                  Cancel
                </a>
              <?php else: ?>
                <a class="btn btn-danger no_caret btn-xs dropdown-toggle" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Cancel
                </a>
              <?php endif; ?>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <div class="sure">
                  <h5>Are you sure want to cancel the appointment?</h5>
                  <button type="button" class="btn btn-light btn-xs mr-2" onclick="cancelBooking(this); return false;" data-booking_id="<?php echo e($PatientAppointment_details['booking_id']); ?>" data-patient_id="<?php echo e($PatientAppointment_details['patient_id']); ?>">Yes, I am Sure</button>
                  <button type="button" class="btn btn-blue btn-xs mr-2 reschedule_book" data-appoint_date="<?php echo e(date('Y-m-d' ,$PatientAppointment_details['appointment_time'])); ?>" data-appoint_time="<?php echo e(date('h:i A' ,$PatientAppointment_details['appointment_time'])); ?>" data-booking_id="<?php echo e($PatientAppointment_details['booking_id']); ?>" onclick="resheduleBooking(this); return false;">Reschedule</button>
                </div>
              </div>
            </div>
                    </td>
                  </tr>
                  <?php $i++ ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <?php if($type==2): ?>
              <td align="center" colspan="4">No Hospital Appointments</td>
              <?php else: ?>
               <td align="center" colspan="4">No Telemedical Appointments</td>
               <?php endif; ?>
            <?php endif; ?>
          </table>
        </div>
          <div class="table_pagination">
              <button type="button" class="btn btn-light btn-xs pre1" <?php if($PatientAppointment_details->previousPageUrl()){  } else{ echo "disabled"; } ?> data-url="<?php echo $PatientAppointment_details->previousPageUrl(); ?>">Previous Page</button>
     <span>Page <?php echo e($PatientAppointment_details->currentPage()); ?> of <?php echo e($PatientAppointment_details->lastPage()); ?> Pages</span>
     <button type="button" class="btn btn-light btn-xs next1"  <?php if($PatientAppointment_details->nextPageUrl()){  } else{ echo "disabled"; } ?>  data-url="<?php echo $PatientAppointment_details->nextPageUrl(); ?>">Next Page</button>
          </div>
        </div>
    
