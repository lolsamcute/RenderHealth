<?php $__env->startSection('content'); ?>

<main class="col-12 col-md-12 col-xl-12 bd-content">
	<div class="row">
	    <div class="col-12 col-xl-9">
	        <div class="widget main_div">
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
	                      <th scope="col" class="text-center"></th>
	                    </tr>
	                  </thead>
	                  <tbody class="data_div">
	                  	<?php if(count($appointments) > 0): ?>	                  		
	                  		<?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	                  		
			                    <tr class="appointment_div cursor_pointer" data-id="<?php echo e($appointment['booking_id']); ?>">
			                      <td  onclick="appointmentdetail(this); return false;">
			                          <div class="center_type">
			                              <h5>
			                              	<?php if(!empty($appointment['hospital_id'])): ?>
			                              	<?php echo e($appointment['hospital_detail']['hosp_name']); ?>

			                              	<?php elseif($appointment['hospital_name'] != ""): ?> <?php echo e($appointment['hospital_name']); ?>

			                              	<?php else: ?> - <?php endif; ?></h5>
			                              <?php if($appointment['patient_appoint']['appointment_type'] == 1): ?>
			                              	<a class="hospital_appointment" href="javascript:;">Telelconsultation Appointment</a>
			                              <?php else: ?>
			                              	<a class="hospital_appointment" href="javascript:;">Hospital Appointment</a>
			                              <?php endif; ?>
			                          </div>
			                      </td>
			                      <td  onclick="appointmentdetail(this); return false;">
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
			                      <td  onclick="appointmentdetail(this); return false;">
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
	        </div>

	    </div>
	    <div class="col-12 col-xl-3">
	        <div class="dropdown mb-4">
	             <button type="button" class="btn btn-primary dropdown-toggle btn-block-toggle" data-toggle="dropdown">
	               Set New Appointment
	             </button>
	             <div class="dropdown-menu">
	               <a class="dropdown-item" href="javascript:void(0)" onclick="blockPopupFn()">
	                   <img src="<?php echo e(asset('images/tele_icon.svg')); ?>" alt="icon"> Telemedical Appointment
				   </a>
				   <!-- <a class="dropdown-item" href="<?php echo e(url('patient/dashboard/1')); ?>">
	                   <img src="<?php echo e(asset('images/tele_icon.svg')); ?>" alt="icon"> Telemedical Appointment
	               </a> -->
	               <a class="dropdown-item" href="<?php echo e(url('patient/appointment')); ?>">
	                   <img src="<?php echo e(asset('images/host_icon.svg')); ?>" alt="icon"> Hospital Appointment
	               </a>
	              </div>
	        </div>
	        <div class="filter">
	            <div class="filter_heading">
	                <h4>Filter</h4>
	                <a class="filter_reset" href="#" onclick="resetfilters(this); return false;">Reset Filter</a>
	            </div>
	            <div class="filter_body">
	                <div class="filter_row">
	                	<h5>Time of Appointment</h5>
	                    <div class="checkbox appointment_fil" onclick="sortAppointments(this); return false;">
	                        <input id="today" type="radio" name="ad" class="form-check-custom appointment_time_sel" value="1" />
	                        <label for="today">Today</label>
	                    </div>
	                    <div class="checkbox appointment_fil" onclick="sortAppointments(this); return false;">
	                        <input id="upcoming" type="radio" name="ad" class="form-check-custom appointment_time_sel" value="2" />
	                        <label for="upcoming">Upcoming</label>
	                    </div>
	                    <div class="checkbox appointment_fil" onclick="sortAppointments(this); return false;">
	                        <input id="previous" type="radio" name="ad" class="form-check-custom appointment_time_sel" value="3"/>
	                        <label for="previous">Previous</label>
	                    </div>
	                   <!--  <h5>Status of Appointment</h5>
	                    <div class="checkbox">
	                        <input id="all_status" type="checkbox" class="form-check-custom" checked value="" disabled/>
	                        <label for="all_status">All Status</label>
	                    </div>
	                    <div class="checkbox">
	                        <input id="approved" type="checkbox" class="form-check-custom" checked value="" disabled/>
	                        <label for="approved">Approved</label>
	                    </div>
	                    <div class="checkbox">
	                        <input id="pending" type="checkbox" class="form-check-custom" value="" disabled/>
	                        <label for="pending">Pending</label>
	                    </div> -->
	                </div>
	                <?php if(count($speciality_detail) > 0): ?>
		                <div class="filter_row">
		                    <h5>Doctor Speciality</h5>
		                    <?php $__currentLoopData = $speciality_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$speciality_det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			                    <div class="checkbox" onclick="sortAppointments(this); return false;">
			                        <input id="speaciality<?php echo e(($key+1)); ?>" type="checkbox" class="form-check-custom doc_speciality" value="<?php echo e($speciality_det['speciality_id']); ?>"/>
			                        <label for="speaciality<?php echo e(($key+1)); ?>"><?php echo e($speciality_det['speciality_name']); ?></label>
			                    </div>
			                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		                    
		                </div>
		            <?php endif; ?>
	                <?php if(count($hospitals) > 0): ?>
	               	 	<div class="filter_row">
	                   		<h5>Hospital</h5>	                   
		                    <div class="select_box">
		                        <select class="form-control hosp_list" name="" onchange="sortAppointments(this); return false;">
		                            <option value="">All Hospital</option>
		                            <?php $__currentLoopData = $hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                            	<option value="<?php echo e($hospital['hosp_id']); ?>"><?php echo e($hospital['hosp_name']); ?></option>
		                           	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		                            
		                        </select>
		                    </div>		               
	                	</div>
	                 <?php endif; ?>
	            </div>
	        </div>
	    </div>
	</div>
</main>
 <!-- Schedule Telelconsultation Appointment Modal -->
<div class="modal fade" id="Telelconsultation">
    <div class="modal-dialog modal-md modal-dialog-centered genModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Schedule Telelconsultation Appointment</h4>
                <button type="button" class="close mclose" data-dismiss="modal"><img src="<?php echo e(asset('images/cross_modal.svg')); ?>"/></button>
             </div>
            <div class="modal-body">
                <div class="consultation py-5" style="display:none1;">
                    <div class="consult_type ">
                        <img src="<?php echo e(asset('images/video_consult.svg')); ?>" alt="icon">
                        <h5>Video Consultation</h5>
                        <p>You can make conversation use our Video call API</p>
                        <button type="button" class="btn btn-black btn-sm text-capitalize" name="button">Use Video Call</button>
                    </div>
                    <div class="consult_type">
                        <img src="<?php echo e(asset('images/audio_consult.svg')); ?>" alt="icon">
                        <h5>Audio Consultation</h5>
                        <p>You can make conversation with call doctor’s number</p>
                        <button type="button" class="btn btn-black btn-sm text-capitalize" name="button">Use Phone Call</button>
                    </div>
                </div>

                <div class="consultation py-3"  style="display:none;">
                    <div class="video_consult_detail">
                        <img src="<?php echo e(asset('images/video_consult.svg')); ?>" alt="icon">
                        <h5>Video Consultation</h5>
                        <p>You can make conversation use our Video call API</p>
                        <div class="form-group">
                             <div class="select_box select_fxwidth">
                                 <select class="form-control" name="">
                                     <option value="">Speciality Consultation</option>
                                     <option value="">Value 2</option>
                                     <option value="">Value 3</option>
                                 </select>
                             </div>
                        </div>
                        <button type="button" class="btn btn-primary" name="button">Find Doctor</button>
                    </div>
                </div>

                <div class="consultation py-3"  style="display:none;">
                    <div class="video_consult_detail">
                        <img src="<?php echo e(asset('images/video_consult.svg')); ?>" alt="icon">
                        <h5>Video Consultation</h5>
                        <p>You can make conversation use our Video call API</p>
                        <div class="form-group">
                             <div class="select_box select_fxwidth mb-2">
                                 <select class="form-control" name="">
                                     <option value="">General Consultation</option>
                                     <option value="">Value 2</option>
                                     <option value="">Value 3</option>
                                 </select>
                             </div>
                             <div class="select_box select_fxwidth">
                                 <select class="form-control" name="">
                                     <option value="">Immediate Consultation</option>
                                     <option value="">Value 2</option>
                                     <option value="">Value 3</option>
                                 </select>
                             </div>
                        </div>
                        <button type="button" class="btn btn-primary" name="button">Find Doctor</button>
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
<?php echo $__env->make('layouts.patient_fluid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>