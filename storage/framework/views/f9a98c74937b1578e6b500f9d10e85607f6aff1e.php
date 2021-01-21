<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12 col-xl-3">
            <div class="widget">
                <div class="widget_header">
                    <h3>My Profile</h3>
                    <div class="btn-group">
                        <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?php echo e(asset('images/options.svg')); ?>" alt="options"/>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?php echo e(url('/patient/my_profile')); ?>">View my profile</a>
                            <a class="dropdown-item" href="<?php echo e(url('/patient/settings')); ?>">Edit my profile</a>
                            <!-- <a class="dropdown-item" href="javascript:;">Share</a> -->
                        </div>
                    </div>
                </div>
                <div class="widget_body widget_profile">
                    <div class="widget_profile_header">
                        <div class="wprofile_image">
                      
                            <?php if((file_exists(getcwd().'/uploads/patient/'.$patient_detail->patient_profile_img)) && !empty($patient_detail->patient_profile_img)): ?>                            
                                 <img src="<?php echo e(asset('uploads/patient/'.$patient_detail->patient_profile_img)); ?>" alt="image">
                            <?php else: ?>
                                <img id="uploadPreview" src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">                               
                            <?php endif; ?>
                        </div>
                        <div class="wprofile_text">
                            <h3><?php if($patient_detail->patient_gender == 1): ?>
                                  <?php if($patient_detail->patient_martial_status == 1): ?>
                                    <?php echo e('Mrs.'); ?>

                                  <?php else: ?>
                                    <?php echo e('Miss'); ?>

                                  <?php endif; ?>
                              <?php else: ?>
                                <?php echo e('Mr.'); ?>

                              <?php endif; ?>
                              <?php echo e($patient_detail->patient_first_name); ?> <?php echo e($patient_detail->patient_last_name); ?></h3>
                            <p><?php
                                if(!empty($patient_detail->patient_date_of_birth)){
                                $date = $patient_detail->patient_date_of_birth;
                                $databasedate = date("Y-m-d",$date);
                                $current_date = date("Y-m-d");
                                $diff = abs(strtotime($current_date) - strtotime($databasedate));
                                $years = floor($diff / (365*60*60*24));
                                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                printf("%d", $years);
                                echo "y/o,"; }
                            ?> <?php if($patient_detail->patient_gender == 0): ?> Male <?php else: ?> Female <?php endif; ?></p>
                        </div>
                    </div>
                    <div class="widget_profile_desc">
                        <ul>
                            <li>
                                <span>
                                    <img src="<?php echo e(asset('images/location.svg')); ?>" alt="icon">
                                </span>
                                <?php if(!empty($patient_detail->patient_address)): ?>
                                  <p><?php echo e(ucfirst($patient_detail->patient_address)); ?></p>
                                <?php else: ?>
                                  <p>-</p>
                                <?php endif; ?>
                            </li>
                            <li>
                                <span>
                                    <img src="<?php echo e(asset('images/gender.svg')); ?>" alt="icon">
                                </span>
                                <p><?php if($patient_detail->patient_martial_status == 0): ?> Single <?php elseif($patient_detail->patient_martial_status == 1): ?>Married <?php else: ?> - <?php endif; ?></p>
                            </li>
                            <li>
                                <span>
                                    <img src="<?php echo e(asset('images/mic.svg')); ?>" alt="icon">
                                </span>
                                <?php if(!empty($patient_detail->patient_languages)): ?>
                                  <p><?php echo e(join(',', array_map('ucfirst', explode(',', $patient_detail->patient_languages)))); ?></p>
                                <?php else: ?>
                                  <p>-</p>
                                <?php endif; ?>
                                
                            </li>
                            <li>
                                <span>
                                    <img src="<?php echo e(asset('images/bday.svg')); ?>" alt="icon">
                                </span>
                                <?php if(!empty($patient_detail->patient_date_of_birth)): ?>
                                  <p><?php echo e(date("dS M Y", $patient_detail->patient_date_of_birth)); ?> (Birthday)</p>
                                <?php else: ?>
                                  <p>-</p>
                                <?php endif; ?>
                                
                            </li>
                        </ul>
                    </div>
                    <div class="widget_profile_footer">
                        <ul>
                            <li>
                                <h5>Blood Type :</h5>
                                <?php if(!empty($patient_detail->patient_blood_type)): ?>
                                  <h4><?php echo e($patient_detail->patient_blood_type); ?></h4>
                                <?php else: ?>
                                  <h4>-</h4>
                                <?php endif; ?>
                                
                            </li>
                            <li>
                                <h5>State Of Origin :</h5>
                                <?php if(!empty($patient_detail->patient_origin_state)): ?>
                                  <h4><?php echo e(ucfirst($patient_detail->patient_origin_state)); ?></h4>
                                <?php else: ?>
                                  <h4>-</h4>
                                <?php endif; ?>
                                
                            </li>
                            <li>
                                <h5>Insurance :</h5>
                                <?php if(!empty($patient_detail->patient_insurance)): ?>
                                  <h4><?php echo e(ucfirst($patient_detail->patient_insurance)); ?></h4>
                                <?php else: ?>
                                  <h4>-</h4>
                                <?php endif; ?>                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="widget">
                <div class="widget_body">
                    <a class="widget_link teleconslt_href" href="javascript:;" onclick="blockPopupFn()">
                        <div class="widget_link_icon">
                            <img src="<?php echo e(asset('images/appoint.svg')); ?>" alt="icon">
                        </div>
                        <div class="widget_link_text">
                            <h4>Schedule Telelconsultation Appointment</h4>
                            <!-- <p>Set schedule to make appointment with doctor.</p> -->
                        </div>
                    </a>
                    <!-- <a class="widget_link teleconslt_href" href="javascript:;" data-toggle="modal" data-target="#Telelconsultation">
                        <div class="widget_link_icon">
                            <img src="<?php echo e(asset('images/appoint.svg')); ?>" alt="icon">
                        </div>
                        <div class="widget_link_text">
                            <h4>Schedule Telelconsultation Appointment</h4>
                            <p>Set schedule to make appointment with doctor.</p> 
                        </div>
                    </a> -->
                </div>
            </div>
            <div class="widget">
                <div class="widget_body">
                    <a class="widget_link" href="<?php echo e(url('patient/appointment')); ?>">
                        <div class="widget_link_icon">
                            <img src="<?php echo e(asset('images/hospital.svg')); ?>" alt="icon">
                        </div>
                        <div class="widget_link_text">
                            <h4>Schedule Hospital Appointment</h4>
                            <!-- <p>Set schedule to make appointment with doctor.</p> -->
                        </div>
                    </a>
                </div>
            </div>
            <div class="widget">
                <div class="widget_body">
                    <a class="widget_link" href="<?php echo e(url('/patient/add_new_diary')); ?>">
                        <div class="widget_link_icon">
                            <img src="<?php echo e(asset('images/red_heart.svg')); ?>" alt="icon">
                        </div>
                        <div class="widget_link_text">
                            <h4>Add New Health Diary</h4>
                            <!-- <p>Set schedule to make appointment with doctor.</p> -->
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-9">
            <div class="widget">
                <div class="widget_header">
                    <h3>Current Appointments</h3>
                </div>
                <div class="widget_body">
                    <table class="table theme_table">
                      <thead>
                        <tr>
                          <th scope="col">Hospital</th>
                          <th scope="col">Doctor Name</th>
                          <th scope="col">Date & Time</th>
                          <th scope="col" class="text-center"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(count($appoint_listing) > 0): ?>                       
                          <?php $__currentLoopData = $appoint_listing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                            <tr class="appointment_div cursor_pointer" data-id="<?php echo e($appointment['booking_id']); ?>" >
                              <td onclick="appointmentdetail(this); return false;">
                                  <div class="center_type">
                                      <h5><?php if(!empty($appointment['hospital_id'])): ?>
                                      <?php echo e($appointment['hospital_detail']['hosp_name']); ?>

                                      <?php elseif($appointment['hospital_name'] != ""): ?> <?php echo e($appointment['hospital_name']); ?>

                                      <?php else: ?> - <?php endif; ?></h5>
                                      <?php if($appointment['patient_appoint']['appointment_type'] == 1): ?>
                                        <a class="hospital_appointment" href="javascript:;">Hospital Appointment</a>
                                      <?php else: ?>
                                        <a class="hospital_appointment" href="javascript:;">Hospital Appointment</a>
                                      <?php endif; ?>
                                  </div>
                              </td>
                              <td onclick="appointmentdetail(this); return false;">
                                  <div class="table_profile_header">
                                    <div class="tprofile_image">
                                    
                                      <?php 
                                    if(isset($appointment['doctor'])){
                                      if((file_exists(getcwd().'/doctorimages/'.$appointment['doctor']['doctor_picture'])) && (!empty($appointment['doctor']['doctor_picture']))){
                                      ?>
                                      <img src="<?php echo e(asset('/doctorimages/'.$appointment['doctor']['doctor_picture'])); ?>" alt="image">
                                      <?php     }
                                      else { ?>
                                      <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                                      <?php   } }?>

                                    </div>
                                    <div class="tprofile_text">
                                       <?php if(!empty($appointment['doctor']['doctor_first_name'])): ?>
                                        <h3>Dr. <?php echo e($appointment['doctor']['doctor_first_name']); ?> <?php echo e($appointment['doctor']['doctor_last_name']); ?></h3>
                                        <?php endif; ?>
                                  <?php if(isset($appointment->doctor)): ?>
                                <p><?php echo e($appointment->doctor->specialist_categories['speciality_name']); ?></p>
                                <?php else: ?>
                                <p>Not avaliable</p>
<?php endif; ?>
                                        <!--p><?php echo e($appointment['doctor']['specialist_categories']['speciality_name']); ?></p-->
                                        
                                    </div>
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
                                 <!--  <button type="button" class="button_sm button_approved">Approved</button> -->
                              </td>
                            </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                              <tr ><td colspan="4" class="text-center">No appointments Found</td></tr>
                        <?php endif; ?>                        
                      </tbody>
                      <?php if($appoint_count > 0): ?>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="tfooter">                                    
                                        <img src="<?php echo e(asset('images/calender.svg')); ?>" alt="icon">There <?php if($appoint_count>1): ?>are <?php else: ?> is <?php endif; ?> <?php echo e($appoint_count); ?> Appointment ahead.<a href="<?php echo e(url('patient/my_appointments')); ?>">View All</a>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                      <?php endif; ?>
                    </table>
                </div>
            </div>
            <div class="widget">
                <div class="widget_header">
                    <h3>Health History</h3>
                </div>
                <div class="widget_body">
                    <table class="table theme_table">
                      <thead>
                        <tr>
                          <th scope="col">Hospital</th>
                          <th scope="col">Doctor Name</th>
                          <th scope="col">Date & Time</th>
                          <th scope="col" class="text-center">Attachment</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php if(count($health_history) >0): ?>
                            <?php $__currentLoopData = $health_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $health_hist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr class="history_div cursor_pointer" data-id="<?php echo e($health_hist->history_id); ?>" onclick="historydetail(this); return false;">
                                <td>
                                    <div class="center_type">
                                      <?php if(isset($health_hist->doctor->doctor_hospital_details)): ?>
                                        <h5><?php echo e($health_hist->doctor->doctor_hospital_details->hosp_name); ?></h5>
                                        <?php endif; ?>
                                        <a class="hospital_appointment" href="javascript:;">Hospital Appointment</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="table_profile_header">
                                      <div class="tprofile_image">
                                        <?php 
                                  if(isset($health_hist->doctor)){
                                        if((file_exists(getcwd().'/doctorimages/'.$health_hist->doctor->doctor_picture)) && (!empty($health_hist->doctor->doctor_picture))){
                                      ?>
                                      <img src="<?php echo e(asset('/doctorimages/'.$health_hist->doctor->doctor_picture)); ?>" alt="image">
                                      <?php     }
                                      else { ?>
                                      <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                                      <?php   }
                                    }
                                    else{?>
                                     <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                                 <?php }

                                       ?>

                                         
                                      </div>
                                      <div class="tprofile_text">
                                          <h3>Dr.
                                      <?php if(isset($health_hist->doctor)): ?>
                                      <?php echo e($health_hist->doctor->doctor_first_name); ?> <?php echo e($health_hist->doctor->doctor_last_name); ?>, <?php echo e($health_hist->doctor->doctor_degree); ?></h3>

                                          <p><?php echo e($health_hist->doctor->specialist_categories['speciality_name']); ?></p>
                                            <?php endif; ?>
                                      </div>
                                  </div>
                                </td>
                                <td>
                                    <div class="appointment_time">
                                        <h5><?php echo e(date('D', $health_hist->created_date)); ?>, <?php echo e(date('j M Y', $health_hist->created_date)); ?></h5>
                                     </div>
                                </td>
                                <td class="text-center">
                                    <div class="attachment">
                                        <img src="<?php echo e(asset('images/attachment.svg')); ?>" alt="icon">
                                        <?php $i=0; ?>
                                    <?php $__currentLoopData = $health_hist['history_attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history_attachments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                    <?php if($history_attachments->type == 2): ?>
                                  <?php $i++;?>
                                   <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                        <?php echo e($i); ?> Files
                                    </div>
                                </td>
                              </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php else: ?>
                              <tr><td colspan="4" class="text-center">No Health History Found</td></tr>
                          <?php endif; ?>                       
                      </tbody>
                      <?php if(count($health_history) >0): ?>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="tfooter">
                                        <!-- <img src="<?php echo e(asset('images/list.png')); ?>" alt="icon"><a class="ml-0" href="<?php echo e(url('patient/health_history_list')); ?>">View All Health History</a> -->
                                        <img src="<?php echo e(asset('images/list.png')); ?>" alt="icon"><a class="ml-0" href="javascript:void(0)" onclick="blockPopupFn()">View All Health History</a>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                      <?php endif; ?>
                    </table>
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
                <!-- <div class="consultation py-5 first_step" >
                    <div class=" col-sm-12">
                        <img src="<?php echo e(asset('images/video_consult.svg')); ?>" alt="icon">
                        <h5 class="mb-3">Video Consultation</h5>
           
                        <button type="button" class="btn btn-black btn-sm text-capitalize consult_btn" name="button" data-id="Video">Use Video Call</button>
                    </div>
                    <div class="consult_type w-50" style="display: none;">
                        <img src="<?php echo e(asset('images/audio_consult.svg')); ?>" alt="icon">
                        <h5 class="mb-3">Audio Consultation</h5>
                
                        <button type="button" class="btn btn-black btn-sm text-capitalize consult_btn" name="button"  data-id="Audio">Use Phone Call</button>
                    </div>
                </div>   -->            

                <div class="consultation py-3 second_step">
                    <div class="video_consult_detail">
                    	 <?php echo e(csrf_field()); ?>

                        <img src="<?php echo e(asset('images/video_consult.svg')); ?>" alt="icon">
                        <h5 class="second_head mb-3">Video Consultation</h5>
                        <input type="hidden" class="second_text" value="Video">
                       <!--  <p>You can make conversation use our <span class="second_text">Video</span> call API</p>    -->                     
                        <div class="form-group">
                            <div class="alert alert-danger-outline alert-dismissible alert_icon fade show error_msg select_fxwidth mb-3 text-left" id="error_msg" role="alert" style="display:none;">
                                <div class="d-flex align-items-center">
                                    <div class="alert-icon-col">
                                        <span class="fa fa-warning"></span>
                                    </div>
                                    <div class="alert_text error_text">
                                        Email field is required
                                    </div>
                                    <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                                </div>
                            </div>
                             <div class="select_box select_fxwidth mb-2">
                                 <select class="form-control consult_type1" name="consult_type" onchange="disableoption(this)">
                                     <option value="1">General Consultation</option>
                                     <option value="2">Speciality Consultation</option>                                     
                                 </select>
                             </div>
                             <div class="select_box select_fxwidth">
                                 <select class="form-control consult_time" name="consult_time">
                                     <option value="1" data-id="1">Immediate Appointment</option>
                                     <option value="2" data-id="2">Future Appointment</option>                                     
                                 </select>
                             </div>
                        </div>
                        <button type="button" class="btn btn-primary find_doctor" name="button" onclick="savetelemedicaldetails(this); return false;">Find Doctor</button>
                    </div>
                </div>
                <div class="consultation py-3 third_step"  style="display:none;">
                    <div class="video_consult_detail consult_datepicker">
                        <div class="picker">
                            <div class="datepicker_input mb-4 tele_appoint" data-date="<?php echo e(date('d F Y')); ?>" data-date-format="dd-mm-yyyy"></div>
                        </div>
                        <button type="button" class="btn btn-primary appointment_next" name="button" data-appoint_id="" data-consult_type="" onclick="appointemntnext(this); return false;">Next</button>
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