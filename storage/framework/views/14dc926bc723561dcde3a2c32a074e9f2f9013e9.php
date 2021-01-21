<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
	<div class="doctor_div">
		<div class="row">
			<div class="col-12">
				<div class="page_head">
					<h1 class="heading">My Schedule 
						<a class="add_schedule" href="<?php echo e(asset('doctor/search_patient')); ?>">
                            <img src="<?php echo e(asset('admin/doctor/images/add.svg')); ?>" alt="icon">
                        </a>
					</h1>
					
					<div class="select_box select_box_heading">
					  	<select class="appointment_time form-control" onclick="sortAllAppointments(this);">
					  		<option value="">Select Appointment Time</option>
					  		<option value="3">Past</option>
					  		<option value="1">Today</option>
					  		<option value="2">Upcoming</option>
					  	</select>
					 </div>
					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">						  
				<?php echo e(csrf_field()); ?>

				<div id="all_appointments" class="">
						
				</div>
			</div>
		</div>
	</div>	
</main>
<!-- new schedule screen -->
<div class="modal fade" id="add_appointment">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width1">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Appointment</h3>
                <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(asset('admin/doctor/images/popup_close.svg')); ?>"/></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <img src="<?php echo e(asset('admin/doctor/images/search_input.svg')); ?>" alt="icon">
                                </span>
                              </div>
                              <input type="text" class="form-control" placeholder="Search patient by name or surename">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Type of appointment</label>
                                <div class="select_box">
                                     <select class="form-control" name="">
                                         <option value="">Hospital Appointment</option>
                                         <option value="">Type 2</option>
                                         <option value="">Type 3</option>
                                     </select>
                                 </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Hospital Name</label>
                                <div class="select_box">
                                     <select class="form-control" name="">
                                         <option value="">Mawoya Hospital</option>
                                         <option value="">Type 2</option>
                                         <option value="">Type 3</option>
                                     </select>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="select_box">
                                     <select class="form-control" name="">
                                         <option value="">Wednesday, 24th July, 2018</option>
                                         <option value="">Type 2</option>
                                         <option value="">Type 3</option>
                                     </select>
                                 </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time</label>
                                <div class="select_box">
                                     <select class="form-control" name="">
                                         <option value="">08:45 AM</option>
                                         <option value="">Type 2</option>
                                         <option value="">Type 3</option>
                                     </select>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mb-3 mt-3" name="button">Save Appointment</button>
                        </div>
                    </div>
                </form>
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
<?php echo $__env->make('layouts.doctor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>