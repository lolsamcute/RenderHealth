<div class="table_hospital pagination_fixed_bottom">
	<div class="table-responsive">
   <table class="table appointment_scehdule" cellspacing="10">
	   <tr>
		   <th>DATE</th>
		   <th>TYPE OF APPOINTMENT</th>
		   <th>Patient profile</th>
		   <th>TIME SCHEDULED</th>
		   <th></th>
	   </tr>
	   <?php //echo count($appointments);?>
	  	<?php if(count($appointments) > 0): ?> 
	  		<?php date_default_timezone_set($timezone); ?>
	  		<?php $i = 1; ?>
		  	<?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    <tr <?php if($appointment->st_status==1){ echo 'class="recent"'; } ?>>
				   	<td><?php if(date('Y-m-d' ,$appointment['appointment_time'])==date('Y-m-d')): ?>
						<?php echo e('Today'); ?><br>
						<?php elseif(date('Y-m-d' ,$appointment['appointment_time'])==date('Y-m-d',strtotime('+1 day'))): ?>
						<?php echo e('Tomorrow'); ?><br>
						<?php endif; ?>
						<?php echo e(date('d F Y' ,$appointment['appointment_time'])); ?>

				   	</td>
				   	<td>
				   		<?php if($appointment['appointment_type']==2): ?>
							<div class="med_center">	
								<h5><?php echo e($appointment['hospital_name']); ?></h5>
								<input type="hidden" class="a_id" name="a_id" id="a_id" value="<?php echo e($appointment['appointment_id']); ?>"> 
						   		<input type="hidden" class="doctor_id" name="doctor_id" id="doctor_id" value="123456"> 
						   		<input type="hidden" class="p_id" name="p_id" id="p_id" value="<?php echo e($appointment['patient_id']); ?>">
						   		<span id="table_date<?php echo e(($i)); ?>" class="appt_time" style="display: none;"><?php echo e($appointment['appointment_time']); ?></span>
								<p><?php echo e('Hospital Appointment'); ?></p>
							</div>
						<?php $i++; ?>
						<?php else: ?>
							<div class="tel_center">
                                <h5><img src="<?php echo e(asset('admin/doctor/images/tele_video.svg')); ?>" alt="icon">Teleconsultan Call</h5>
                                <input type="hidden" class="a_id" name="a_id" id="a_id" value="<?php echo e($appointment['appointment_id']); ?>"> 
						   		<input type="hidden" class="doctor_id" name="doctor_id" id="doctor_id" value="123456"> 
						   		<input type="hidden" class="p_id" name="p_id" id="p_id" value="<?php echo e($appointment['patient_id']); ?>">
                                <span id="table_date<?php echo e(($i)); ?>" class="appt_time" style="display: none;"><?php echo e($appointment['appointment_time']); ?></span>
                                <?php if($appointment['appointment_time'] >=  strtotime('now')): ?>
                                	<span id="demo<?php echo e(($i)); ?>" class="demo" style="display: none;"></span>   
                                <?php endif; ?>                                         
                           	</div>
                        <?php $i++; ?>
                        <?php endif; ?>					   
				   	</td>
				  	<td>
					   <div class="d_profile">
						   <div class="d_pro_img">
						   		 <?php if($appointment['patient_profile_img'] != "" && file_exists(getcwd().'/uploads/patient/'.$appointment['patient_profile_img'])): ?>
				                    <img src="<?php echo e(asset('uploads/patient/'.$appointment['patient_profile_img'])); ?>" alt="image"/>
				                <?php else: ?>
				                    <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image"/>
				                <?php endif; ?>						   
						   </div>
						   <div class="d_pro_text">
							   <h4><?php echo e(ucfirst($appointment['patient_first_name']).' '.ucfirst($appointment['patient_last_name'])); ?></h4>
							   <a href="javascript:;">View Profile</a>
						   </div>
					   </div>
				   	</td>
					<td><?php echo e(date('h:i A' ,$appointment['appointment_time'])); ?></td>
				   <td>
				   		<?php if($appointment['appointment_type']==1): ?>
					   		<?php if($disabled > 0): ?>
					   			<button type="button"  class="btn btn-light btn-xs mr-2 call_btn" name="button" onclick="callPatient(this); return false;" data-doctor_id="123456" data-call_type="<?php echo e($appointment['telemedical_type']); ?>" data-appoint_id="<?php echo e($appointment['appointment_id']); ?>" data-patient_id="<?php echo e($appointment['patient_id']); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">Call</button>
					   		<?php elseif(date('Y-m-d',$appointment['appointment_time']) >= date('Y-m-d')): ?>
						  	 	<button type="button" class="btn btn-light btn-xs mr-2 call_btn" name="button" onclick="callPatient(this); return false;" data-doctor_id="123456" data-call_type="<?php echo e($appointment['telemedical_type']); ?>" data-appoint_id="<?php echo e($appointment['appointment_id']); ?>" data-patient_id="<?php echo e($appointment['patient_id']); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">Call</button>

						  	<?php else: ?>
						  		<button type="button"  class="btn btn-light btn-xs mr-2 call_btn" name="button" onclick="callPatient(this); return false;" data-doctor_id="123456" data-call_type="<?php echo e($appointment['telemedical_type']); ?>" data-appoint_id="<?php echo e($appointment['appointment_id']); ?>" data-patient_id="<?php echo e($appointment['patient_id']); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">Call</button>
						  	
						  	<?php endif; ?>
						<?php else: ?>
							<?php if($appointment['booking_id'] != ""): ?>
								<a href="<?php echo e(url('admin/appointment_detail/'.$appointment['booking_id'])); ?>" class="btn btn-light btn-xs mr-2" name="button"><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="">View</a>
							<?php else: ?>
								<a href="javascript:;" class="btn btn-light btn-xs mr-2" name="button"><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">View</a>
							<?php endif; ?>
						<?php endif; ?>

					   	<div class="dropdown d-inline-block">					   		
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
									<button type="button" class="btn btn-light btn-xs mr-2" onclick="cancelBooking(this); return false;" data-booking_id="<?php echo e($appointment['booking_id']); ?>" data-patient_id="<?php echo e($appointment['patient_id']); ?>">Yes, I am Sure</button>
									<button type="button" class="btn btn-blue btn-xs mr-2 reschedule_book" data-appoint_date="<?php echo e(date('Y-m-d' ,$appointment['appointment_time'])); ?>" data-appoint_time="<?php echo e(date('h:i A' ,$appointment['appointment_time'])); ?>" data-booking_id="<?php echo e($appointment['booking_id']); ?>" onclick="resheduleBooking(this); return false;">Reschedule</button>
								</div>
							</div>
						</div>
				   </td>
			   	</tr>
	   		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	   	<?php else: ?>
	   		<tr>
	   			<td colspan="5" align="center"> No appointments Found</td>
	   		</tr>
		<?php endif; ?>    
		<!--div id="page11">
		<?php echo e($appointments->links()); ?>

		</div-->
   	</table>
   </div>
   	<div class="table_pagination">
	   <button type="button" class="btn btn-light btn-xs pre2" <?php if($appointments->previousPageUrl()){  } else{ echo "disabled"; } ?> data-url="<?php echo $appointments->previousPageUrl(); ?>">Previous Page</button>
	   <span>Page <?php echo e($appointments->currentPage()); ?> of <?php echo e($appointments->lastPage()); ?> Pages</span>
	   <button type="button" class="btn btn-light btn-xs next2"  <?php if($appointments->nextPageUrl()){  } else{ echo "disabled"; } ?>  data-url="<?php echo $appointments->nextPageUrl(); ?>">Next Page</button>
   	</div>
</div>