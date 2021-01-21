<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
	<div class="row">
		<div class="col-12">
			<div class="page_head">
				<h1 class="heading">Dashboard Overview</h1>
			</div>
		</div>
		<div class="col-12">
			<!-- <div class="action_container">
				<div class="action_box">
					<a href="<?php echo e(asset('doctor/search_patient')); ?>" class="action action_schedule">
						<div class="action_icon">
							<img src="<?php echo e(asset('admin/doctor/images/plus_date.svg')); ?>" alt="icon">
						</div>
						<div class="action_text">
							<h3>New Schedule</h3>
							<p>appointment with patient</p>
						</div>
					</a>
				</div>
				<div class="action_box">
					<a href="javascript:;" data-toggle="modal" data-target="#setup_availability" class="action action_availability" >
						<div class="action_icon">
							<img src="<?php echo e(asset('admin/doctor/images/setup.svg')); ?>" alt="icon">
						</div>
						<div class="action_text">
							<h3>Setup availability</h3>
							<p>appointment with patient</p>
						</div>
					</a>
				</div>
				<div class="action_box">
					<a href="javascript:;" class="action action_patient">
						<div class="action_text">
							<h2><?php echo e($patient_count); ?></h2>
							<h5>Patient Handled</h5>
						</div>
					</a>
				</div>
				<div class="action_box">
					<a href="javascript:;" class="action action_appointment">
						<div class="action_text">
							<h2><?php echo e($appointment_cnt); ?></h2>
							<h5>Appointment</h5>
						</div>
					</a>
				</div>
			</div> -->
		</div>
	</div>
	<div class="row">
		<div class="col-12">
		<div class="table_head">Upcoming Appointment</div>
			<div class="table_hospital">
				<table class="table" cellspacing="10">
					<tr>
						<th>DATE</th>
						<th>TYPE OF APPOINTMENT</th>
						<th>Patient profile</th>
						<th>TIME SCHEDULED</th>
						<th></th>
					</tr>
					<input type="hidden" name="url" id="url" value="<?php echo e(url('/')); ?>">
					<?php if(count($appointments) > 0): ?> 
					<?php date_default_timezone_set($timezone); ?>
					<?php $i = 1; ?>
					<?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						
						<td><?php if(date('Y-m-d' ,$appointment['appointment_time'])==date('Y-m-d')): ?>
							<?php echo e('Today'); ?>,
							<?php elseif(date('Y-m-d' ,$appointment['appointment_time'])==date('Y-m-d',strtotime('+1 day'))): ?>
							<?php echo e('Tomorrow'); ?>,
							<?php endif; ?>
							<?php echo e(date('d F Y' ,$appointment['appointment_time'])); ?>

						</td>
						<td>
							<?php if($appointment['appointment_type']==2): ?>
								<div class="med_center">	
									<h5><?php echo e($appointment['hospital_name']); ?></h5>
									<p><?php echo e('Hospital Appointment'); ?></p>
								</div>
							<?php else: ?>
								<div class="tel_center">
                                    <h5><img src="<?php echo e(asset('admin/doctor/images/tele_video.svg')); ?>" alt="icon">Teleconsultan Call</h5>
                                    <span id="table_date<?php echo e(($i)); ?>" style="display: none;"><?php echo e($appointment['appointment_time']); ?></span>
                                    <?php if($appointment['appointment_time'] >=  strtotime('now')): ?>
                                    	<span id="demo<?php echo e(($i)); ?>" style="display: none;"></span>   
                                    <?php endif; ?>                                     
                               	</div>
                            <?php $i++; ?>
                            <?php endif; ?>
						</td>
						<td>
							<div class="d_profile">
								<div class="d_pro_img">
									<img src="<?php echo e(asset('uploads/patient').'/'.$appointment['patient_profile_img']); ?>" alt="image">
								</div>
								<div class="d_pro_text">
<!--
									<h4>Mr. Ayo Akintunde</h4>
-->
									<h4><?php echo e(ucfirst($appointment['patient_first_name']).' '.ucfirst($appointment['patient_last_name'])); ?></h4>
									<a href="javascript:;">View Profile</a>
								</div>
							</div>
						</td>
<!--
						 <td>08.00 AM (EST)</td>
-->
						<td><?php echo e(date('h:i A' ,$appointment['appointment_time'])); ?></td>
						<td>
					   		<?php if($appointment['appointment_type']==1): ?>
						   		<?php if($disabled > 0): ?>
						   			<button type="button" disabled class="btn btn-light btn-xs mr-2 call_btn" name="button" onclick="callPatient(this); return false;" data-doctor_id="123456" data-call_type="<?php echo e($appointment['telemedical_type']); ?>" data-appoint_id="<?php echo e($appointment['appointment_id']); ?>" data-patient_id="<?php echo e($appointment['patient_id']); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">Call</button>
						   		<?php elseif(date('Y-m-d',$appointment['appointment_time']) >= date('Y-m-d')): ?>
							  	 	<button type="button" class="btn btn-light btn-xs mr-2 call_btn" name="button" onclick="callPatient(this); return false;" data-doctor_id="123456" data-call_type="<?php echo e($appointment['telemedical_type']); ?>" data-appoint_id="<?php echo e($appointment['appointment_id']); ?>" data-patient_id="<?php echo e($appointment['patient_id']); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">Call</button>

							  	<?php else: ?>
							  		<button type="button" disabled class="btn btn-light btn-xs mr-2 call_btn" name="button" onclick="callPatient(this); return false;" data-doctor_id="123456" data-call_type="<?php echo e($appointment['telemedical_type']); ?>" data-appoint_id="<?php echo e($appointment['appointment_id']); ?>" data-patient_id="<?php echo e($appointment['patient_id']); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">Call</button>
							  	
							  	<?php endif; ?>
							<?php else: ?>
								<?php if($appointment['booking_id'] != ""): ?>
									<a href="<?php echo e(url('doctor/appointment_detail/'.$appointment['booking_id'])); ?>" class="btn btn-light btn-xs mr-2" name="button"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">View</a>
								<?php else: ?>
									<a href="javascript:;" class="btn btn-light btn-xs mr-2" name="button"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">View</a>
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
										<button type="button" class="btn btn-light btn-xs mr-2" onclick="cancelBooking(this); return false;" data-booking_id="<?php echo e($appointment['booking_id']); ?>">Yes, I am Sure</button>
										<button type="button" class="btn btn-blue btn-xs mr-2 reschedule_book" data-appoint_date="<?php echo e(date('Y-m-d' ,$appointment['appointment_time'])); ?>" data-appoint_time="<?php echo e(date('h:i A' ,$appointment['appointment_time'])); ?>" data-booking_id="<?php echo e($appointment['booking_id']); ?>" onclick="resheduleBooking(this); return false;">Reschedule</button>
									</div>
								</div>
							</div>
					   </td>
					</tr>
				   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				   <?php else: ?>
				   <tr><td></td><td></td><td>No record found</td><td></td><td></td></tr>
				   <?php endif; ?>
				</table>
				<a class="btn btn-primary btn-sm" href="<?php echo e(url('/doctor/all_appointments')); ?>">View All Schedule</a>
			</div>
		</div>
	</div>
</main>

 <!-- set availability screen -->
<div class="modal fade" id="setup_availability">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal setup_availability">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Enter Appointment Availability</h3>
                <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(asset('admin/doctor/images/popup_close_w.svg')); ?>"/></button>
            </div>
            <div class="modal-body">
                <div class="popup_tabs">
                    <ul class="nav nav-pills tabs_main" role="tablist">
                        <li><a class="active tabs_head" role="tab"  data-toggle="pill" href="#hostpital_appointment" data-id ="1">Hospital Appointment</a></li>
                        <li><a role="tab" class="tabs_head" data-toggle="pill"  href="#telemedical_appointment" data-id="2">Telemedical Appointment</a></li>
                     </ul>
                </div>
                
                <div class="tab-content">
                	 <?php echo e(csrf_field()); ?>

                     <div id="hostpital_appointment" class="tab-pane fade show active">
						<form id="hosp_form">
							 <div class="consult_detail">
								 <div class="picker">
									 <div class="datepicker_input mb-2 availability_date" id="date1" data-date="<?php echo e(date('d F Y')); ?>" data-date-format="dd-mm-yyyy"></div>
								 </div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Start time</label>
											<div class="select_box">																								 	
												 	<select class="form-control start_time" name="hosp_start_time">											 	
													 	<?php $inc = 0; ?>		
													 	<?php date_default_timezone_set($timezone); ?>										 	
														 <?php for($i=0; $i < 24; $i++ ): ?>
														 	<?php if($i < 10): ?>
													 			<option value='<?php echo e(date("H:i",strtotime($i.":00"))); ?>' <?php if(date("H:i",strtotime("0".$i.":00")) < date("H:i",strtotime("now"))){ ?>disabled <?php } ?>><?php echo e(date("H:i",strtotime($i.":00"))); ?></option>
													 		<?php else: ?>
														 		<option value='<?php echo e(date("H:i",strtotime($i.":00"))); ?>' <?php if(date("H:i",strtotime($i.":00")) < date("H:i",strtotime("now"))){  ?>disabled <?php } ?>><?php echo e(date("H:i",strtotime($i.":00"))); ?></option>
														 	<?php endif; ?>
														<?php endfor; ?>
												 	</select>
											 </div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>End time</label>
											<div class="select_box">
												 <select class="form-control end_time" name="hosp_end_time">
													 <?php $inc = 0; ?>												 	
													 <?php for($i=0; $i < 24; $i++ ): ?>
													 	<?php if($i < 10): ?>
												 			<option value='<?php echo e(date("H:i",strtotime($i.":00"))); ?>' <?php if(date("H:i",strtotime("0".$i.":00")) < date("H:i",strtotime("now"))){ ?>disabled <?php } ?>><?php echo e(date("H:i",strtotime($i.":00"))); ?></option>
												 		<?php else: ?>
													 		<option value='<?php echo e(date("H:i",strtotime($i.":00"))); ?>' <?php if(date("H:i",strtotime($i.":00")) < date("H:i",strtotime("now"))){ ?>disabled <?php } ?>><?php echo e(date("H:i",strtotime($i.":00"))); ?></option>
													 	<?php endif; ?>
													<?php endfor; ?>
												 </select>
											 </div>
										</div>
									</div>
								</div>
								<div class="text-center mt-2">
									<input type="hidden" name="hidden_date_hosp" id="hidden_date_hosp" class="hidden_date" value="<?php echo date('d-m-Y'); ?>">	
									<input type="hidden" name="hidden_hosp_type" value="2">	
									<button type="button" class="btn btn-primary save_availbility" id="hosp_save" name="button">Confirm & Save</button>
								</div>
							  </div>
                         </form>
                     </div>
                     <div id="telemedical_appointment" class="tab-pane fade">
						<form id="tele_form">	
							 <div class="consult_detail">
								 <div class="picker">
									 <div class="datepicker_input mb-2 availability_date" id="date2" data-date="<?php echo date('d-m-Y');  ?>" data-date-format="dd-mm-yyyy"></div>
								 </div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Start time</label>
											<div class="select_box">	

												 <select class="form-control start_time" name="hosp_start_time">	
												 	<?php $inc = 0; ?>												 	
													 <?php for($i=0; $i < 24; $i++ ): ?>
													 	<?php if($i < 10): ?>
												 			<option value='<?php echo e(date("H:i",strtotime($i.":00"))); ?>' <?php if(date("H:i",strtotime("0".$i.":00")) < date("H:i",strtotime("now"))){ ?>disabled <?php } ?>><?php echo e(date("H:i",strtotime($i.":00"))); ?></option>
												 		<?php else: ?>
													 		<option value='<?php echo e(date("H:i",strtotime($i.":00"))); ?>' <?php if(date("H:i",strtotime($i.":00")) < date("H:i",strtotime("now"))){ ?>disabled <?php } ?>><?php echo e(date("H:i",strtotime($i.":00"))); ?></option>
													 	<?php endif; ?>
													<?php endfor; ?>
												 </select>
											 </div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>End time</label>
											<div class="select_box">
												 <select class="form-control end_time" name="hosp_end_time">
													<?php $inc = 0; ?>												 	
													 <?php for($i=0; $i < 24; $i++ ): ?>
													 	<?php if($i < 10): ?>
												 			<option value='<?php echo e(date("H:i",strtotime($i.":00"))); ?>' <?php if(date("H:i",strtotime("0".$i.":00")) < date("H:i",strtotime("now"))){ ?>disabled <?php } ?>><?php echo e(date("H:i",strtotime($i.":00"))); ?></option>
												 		<?php else: ?>
													 		<option value='<?php echo e(date("H:i",strtotime($i.":00"))); ?>' <?php if(date("H:i",strtotime($i.":00")) < date("H:i",strtotime("now"))){ ?>disabled <?php } ?>><?php echo e(date("H:i",strtotime($i.":00"))); ?></option>
													 	<?php endif; ?>
													<?php endfor; ?>
												 </select>
											 </div>
										</div>
									</div>
								</div>
								<div class="text-center mt-2">
									<input type="hidden" name="hidden date_hosp" id="hidden_date_tele" class="hidden_date" value="<?php echo date('d-m-Y'); ?>">
									<input type="hidden" name="hidden_hosp_type" value="1">	
									<button type="button" class="btn btn-primary save_availbility" id="tele_save" name="button">Confirm & Save</button>
								</div>
							  </div>
						</form>
                     </div>
                 </div>
            </div>
        </div>
    </div>
</div>

<!-- reschedule screen -->
<div class="modal fade" id="reschedule_appointment" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width2">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Reschedule Appointment</h3>
                <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(asset('admin/doctor/images/popup_close.svg')); ?>"/></button>
            </div>
            <div class="modal-body reshedule_detail">                
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.hospital', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>