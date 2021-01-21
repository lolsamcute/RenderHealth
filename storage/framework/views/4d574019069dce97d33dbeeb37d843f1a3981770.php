<div class="widget_header mb-4">
    <h2>My Appointment</h2>
</div>
<div class="widget_body mb-3">
    <div class="table-responsive" style="max-height:500px;">
    <table class="table theme_table">
      <thead>
        <tr>
          <th scope="col">Hospital</th>
          <th scope="col">Doctor Name</th>
          <th scope="col">Date & Time</th>
          <th scope="col" class="text-center">Status</th>
        </tr>
      </thead>
      <tbody class="data_div">
      	<?php if(count($appointments) > 0): ?>	                  		
      		<?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	                  		
                <tr class="appointment_div cursor_pointer" data-id="<?php echo e($appointment['booking_id']); ?>" >
                  <td onclick="appointmentdetail(this); return false;">
                      <div class="center_type">
                          <h5><?php if(!empty($appointment['hospital_id'])): ?>
                              <?php echo e($appointment['hospital_detail']['hosp_name']); ?>

                              <?php elseif($appointment['hospital_name'] != ""): ?> <?php echo e($appointment['hospital_name']); ?>

                              <?php else: ?> - <?php endif; ?></h5>
                          <?php if($appointment['patient_appoint']['appointment_type'] == 1): ?>
                          	<a class="hospital_appointment" href="javascript:;">Telemedical Appointment</a>
                          <?php else: ?>
                          	<a class="hospital_appointment" href="javascript:;">Hospital Appointment</a>
                          <?php endif; ?>
                      </div>
                  </td>
                  <td onclick="appointmentdetail(this); return false;">
                      <div class="table_profile_header">
                      	<?php if(isset($appointment['doctor_id'])): ?>
                        	<div class="tprofile_image">
                        <?php
                        if(!empty($appointment['doctor_picture'])){
                        if(file_exists(getcwd().'/doctorimages/'.$appointment['doctor_picture'])){
                        ?>
                        <img src="<?php echo e(asset('/doctorimages/'.basename($appointment['doctor_picture']))); ?>" alt="image">
                        <?php     }
                        else { ?>
                        <img src="<?php echo e(asset('admin/doctor/images/doc1.png')); ?>" alt="image">
                        <?php   }
                        }
                        else { ?>
                        <img src="<?php echo e(asset('admin/doctor/images/doc1.png')); ?>" alt="image">
                        <?php   }
                        ?>
                        	</div>
                        	<div class="tprofile_text">			                            	
                                <h3>Dr., <?php echo e($appointment['doctor']['doctor_first_name']); ?> <?php echo e($appointment['doctor']['doctor_last_name']); ?></h3>
                                <p><?php echo e($appointment['doctor']['specialist_categories']['speciality_name']); ?></p>				                            
                        	</div>
                        <?php else: ?>
                        	<div class="tprofile_text">	                   	
                                <h3>Not available</h3>				                            
                        	</div>
                        <?php endif; ?>
                    </div>
                  </td>
                  <td onclick="appointmentdetail(this); return false;"> 
                      <div class="appointment_time">
                          <?php date_default_timezone_set($timezone); ?>
                          <h5><?php echo e(date('j F,Y',$appointment['appointment_time'])); ?> </h5>
                          <p>at <?php echo e(date('h:i A',$appointment['appointment_time'])); ?></p>
                      </div>
                  </td>
                  <td class="text-center">
                  	 <?php if(date('Y-m-d H:i',$appointment['appointment_time']) <= date('Y-m-d H:i',strtotime('-15 min'))): ?>
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
              <button type="button" class="btn btn-light btn-xs mr-2" onclick="cancelBooking(this); return false;"  data-patient_id="<?php echo e($appointment['patient_id']); ?>" data-booking_id="<?php echo e($appointment['booking_id']); ?>"  data-doctor_id="<?php echo e($appointment['doctor_id']); ?>">Yes, I am Sure</button>
              <button type="button" class="btn btn-blue btn-xs mr-2 reschedule_book" data-appoint_date="<?php echo e(date('Y-m-d' ,$appointment['appointment_time'])); ?>" data-appoint_time="<?php echo e(date('h:i A' ,$appointment['appointment_time'])); ?>" data-booking_id="<?php echo e($appointment['booking_id']); ?>" onclick="resheduleBooking(this); return false;">Reschedule</button>
              </div>
              </div>
                  </td>
                </tr>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php else: ?>
             	<tr><td colspan="4" class="text-center">No appointments Found</td></tr>
        <?php endif; ?>			                    
      </tbody>
    </table>
  </div>
</div>
<div class="widget_footer">
	<?php if($appointments->total() > $appointments->perPage()): ?>            		
        <?php echo e($appointments->links()); ?>

    <?php endif; ?>
</div>