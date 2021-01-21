<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
	<div class="row">
		<div class="col-12">
			<div class="page_head">
				<h1 class="heading">Appointment List
					<!-- <a class="add_schedule" data-toggle="modal" data-target="#add_deal" href="javascript:;" onclick="$('#dealTitle,#submit_deal_btn').html('Add Deal')">
                        <img src="<?php echo e(asset('admin/adminimages/add.svg')); ?>" alt="icon">
                    </a> -->
				</h1>
				<div class="select_box col-md-2">
					<select class="form-control" name="filterAppointment" id="filterAppointment" onChange="filterAppointment(this.value)">
						<option value="0" selected>Filter By Status</option>
						<option value="All" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'All' ? 'selected' : '' ?>>All</option>
						<option value="Booking Name" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'Booking Name' ? 'selected' : '' ?>>Booking Name</option>
						<option value="Specialist" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'Specialist' ? 'selected' : '' ?>>Specialist</option>
						<option value="Doctor" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'Doctor' ? 'selected' : '' ?>>Doctor</option>
						<option value="Patient" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'Patient' ? 'selected' : '' ?>>Patient</option>
						<option value="Date" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'Date' ? 'selected' : '' ?>>Created At</option>
					</select>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12 main_div">
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
						<?php //echo count($appointments);
						?>
						<?php if(count($appointments) > 0): ?>
						<?php date_default_timezone_set($timezone); ?>
						<?php $i = 1; ?>
						<?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr <?php if ($appointment->st_status == 1) {
								echo 'class="recent"';
							} ?>>
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
									<?php if($appointment['appointment_time'] >= strtotime('now')): ?>
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
										<img src="<?php echo e(asset('uploads/patient/'.$appointment['patient_profile_img'])); ?>" alt="image" />
										<?php else: ?>
										<img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image" />
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
								<button type="button" class="btn btn-light btn-xs mr-2 call_btn" name="button" onclick="callPatient(this); return false;" data-doctor_id="123456" data-call_type="<?php echo e($appointment['telemedical_type']); ?>" data-appoint_id="<?php echo e($appointment['appointment_id']); ?>" data-patient_id="<?php echo e($appointment['patient_id']); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">Call</button>
								<?php elseif(date('Y-m-d',$appointment['appointment_time']) >= date('Y-m-d')): ?>
								<button type="button" class="btn btn-light btn-xs mr-2 call_btn" name="button" onclick="callPatient(this); return false;" data-doctor_id="123456" data-call_type="<?php echo e($appointment['telemedical_type']); ?>" data-appoint_id="<?php echo e($appointment['appointment_id']); ?>" data-patient_id="<?php echo e($appointment['patient_id']); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">Call</button>

								<?php else: ?>
								<button type="button" class="btn btn-light btn-xs mr-2 call_btn" name="button" onclick="callPatient(this); return false;" data-doctor_id="123456" data-call_type="<?php echo e($appointment['telemedical_type']); ?>" data-appoint_id="<?php echo e($appointment['appointment_id']); ?>" data-patient_id="<?php echo e($appointment['patient_id']); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/call_blue.svg')); ?>" alt="icon">Call</button>

								<?php endif; ?>
								<?php else: ?>
								<?php if($appointment['booking_id'] != ""): ?>
								<a href="<?php echo e(url('admin/appointment_detail/'.$appointment['booking_id'])); ?>" class="btn btn-light btn-xs mr-2" name="button"><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="">View</a>
								<?php else: ?>
								<a href="javascript:;" class="btn btn-light btn-xs mr-2" name="button"><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">View</a>
								<?php endif; ?>
								<?php endif; ?>

								<div class="dropdown d-inline-block">
									<?php if(date('Y-m-d H:i',$appointment['appointment_time']) <= date('Y-m-d H:i',strtotime('-15 min'))): ?> <a class="btn btn-danger no_caret btn-xs dropdown-toggle disabled_cancel" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
												<button type="button" class="btn btn-light btn-xs mr-2" onclick="cancelBookingForAdmin(this); return false;" data-booking_id="<?php echo e($appointment['booking_id']); ?>" data-patient_id="<?php echo e($appointment['patient_id']); ?>" data-doctor_id="<?php echo e($appointment['doctor_id']); ?>">Yes, I am Sure</button>
												<button type="button" class="btn btn-blue btn-xs mr-2 reschedule_book" data-appoint_date="<?php echo e(date('Y-m-d' ,$appointment['appointment_time'])); ?>" data-appoint_time="<?php echo e(date('h:i A' ,$appointment['appointment_time'])); ?>" data-booking_id="<?php echo e($appointment['booking_id']); ?>" data-doctor_id="<?php echo e($appointment['doctor_id']); ?>" onclick="resheduleBookingForAdmin(this); return false;">Reschedule</button>
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
					<button type="button" class="btn btn-light btn-xs pre_emp" <?php if ($appointments->previousPageUrl()) {
																				} else {
																					echo "disabled";
																				} ?> data-url="<?php echo $appointments->previousPageUrl(); ?>&type=doc_page">Previous Page
					</button>
					<input type="hidden" class="doc_page_hidden" value="<?php echo e($appointments->currentPage()); ?>">
					<span>Page <?php echo e($appointments->currentPage()); ?> of <?php echo e($appointments->lastPage()); ?> Pages</span>
					<button type="button" class="btn btn-light btn-xs next_emp" <?php if ($appointments->nextPageUrl()) {
																				} else {
																					echo "disabled";
																				} ?> data-url="<?php echo $appointments->nextPageUrl(); ?>&type=doc_page">Next Page
					</button>
				</div>
			</div>
		</div>
</main>


<!-- Modal -->
<div class="modal fade" id="view_user" role="dialog">
	<div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width3">
		<div class="modal-content">
			<div class="modal-header">
				<h3>View Details
				</h3>
				<button type="button" class="close" data-dismiss="modal">
					<img src="<?php echo e(asset('admin/adminimages/popup_close.svg')); ?>" />
				</button>
			</div>

			<div class="modal-body">
				<div class="alert alert-danger-outline alert-danger-outline-adddr alert-dismissible alert_icon fade show" role="alert" style="display: none;">
					<div class="d-flex align-items-center">
						<div class="alert-icon-col">
							<span class="fa fa-warning">
							</span>
						</div>
						<div class="alert_text adddr_danger_pop">
						</div>
						<a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
							<i class="fa fa-close">
							</i>
						</a>
					</div>
				</div>
				<div class="alert alert-success-outline alert-success-outline-adddr alert-dismissible alert_icon fade show" role="alert" style="display: none;">
					<div class="d-flex align-items-center">
						<div class="alert-icon-col">
							<span class="fa fa-check">
							</span>
						</div>
						<div class="alert_text adddr_success_pop">
						</div>
						<a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
							<i class="fa fa-close">
							</i>
						</a>
					</div>
				</div>

				<div class="row" id="view_user_body">

				</div>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>