<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('/css/appoiment.css')); ?>" rel="stylesheet">
<main class="col-12 col-md-12 col-xl-12 bd-content appointment-padding">
    <div class="row">
        <div class="col-12">
            <div class="widget">
                <!-- <div class="widget_header">
                    <h2>Hospital appointment</h2>
                </div> -->

                <div class="row Hospital_appointment">
                    <!-- Left Side -->
                    <div class="col-12 col-xl-4">
                        <form method="GET">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group search-box">
                                        <i class="fa fa-search search-icon" aria-hidden="true"></i>
                                        <input type="input" class="form-control" placeholder="Search" name="hospital_name" id="hospital_name" />
                                        <input type="hidden" class="form-control" placeholder="Search" name="hosp_id" id="hosp_id" />
                                        <input type="hidden" class="form-control" placeholder="Search" name="doctor_id" id="doctor_id" />
                                        <!-- <i class="fa fa-microphone microphone-set " aria-hidden="true"></i> -->
                                        <!-- <button type="submit" class="btn btn-primary">Search</button> -->
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group search-box">
                                        <button type="button" data-toggle="modal" data-target="#search_schedule_appointment" class="btn btn-primary btn-sm"> Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php if(count($hospitals) > 0): ?>
                        

                        <form mothod="GET">
                            <?php echo e(csrf_field()); ?>

                            <?php $__currentLoopData = $hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="text-title"><?php echo e($key); ?></p>
                            <?php if(count($hospital) > 0): ?>
                            <?php $__currentLoopData = $hospital; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="widget_body doctor_exists_main widget_profile mb-2 <?php echo e(isset($_GET['hosp_id']) && $_GET['hosp_id'] == $item->hosp_id? 'active' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-12 round-set">
                                        <div class="">
                                            <input id="today" <?php echo e(isset($_GET['hosp_id']) && $_GET['hosp_id'] == $item->hosp_id? 'checked' : ''); ?> onChange="getDoctors(<?php echo e($item->hosp_id); ?>,'<?php echo e(isset($search_hospital_appointment)?$search_hospital_appointment:''); ?>','<?php echo e(isset($search_doctor)?$search_doctor:''); ?>','<?php echo e(isset($_GET['type_of_speciality'])?$_GET['type_of_speciality']:''); ?>','<?php echo e(isset($_GET['state'])?$_GET['state']:''); ?>','<?php echo e(isset($_GET['lga'])?$_GET['lga']:''); ?>','<?php echo e(isset($_GET['hospital_name'])?$_GET['hospital_name']:''); ?>')" type="radio" name="ad" class="form-check-custom appointment_time_sel" value="1" style="display: none;">
                                            <label for="today"></label>
                                        </div>
                                        <div class="form-group" id="appointment_details" data-id="<?php echo e($item->id ? $item->id : '--'); ?>">
                                            <p><?php echo e($item->hosp_name ? $item->hosp_name : '--'); ?></p>
                                        </div>
                                        <span class="form-control-static"><?php echo e($item->hosp_address ? $item->hosp_address.", " : ''); ?> <?php echo e($item->hosp_city ? $item->hosp_city.", " : ''); ?><?php echo e($item->hosp_state ? $item->hosp_state." " : ''); ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </form>
                        <?php else: ?>
                        <div class="widget_body doctor_exists_main widget_profile mb-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        No Specialist found!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Right Side -->
                    <?php if(count($doctors) > 0): ?>
                    <div class="col-12 col-xl-8 doctors_listing">
                        <div class="widget_body">
                            <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if(count($doctor) > 0): ?>
                            <?php $__currentLoopData = $doctor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="no_data">
                                <!-- <img src="<?php echo e(asset('images/no_data.svg')); ?>" alt="images">
                                <h4>No doctor available, Please select hospital</h4> -->
                                <div class="information-doctor <?php echo e(isset($_GET['doctor_id']) && $_GET['doctor_id'] == $item->doctor_id? 'active doctor_seleted' : ''); ?>">
                                    <div class="row set-pad" onClick="getDoctorsDetail(<?php echo e($item->hospital_id); ?>,'<?php echo e(isset($search_hospital_appointment)?$search_hospital_appointment:''); ?>',<?php echo e(isset($item)?$item->doctor_id:''); ?>,'<?php echo e(isset($_GET['type_of_speciality'])?$_GET['type_of_speciality']:''); ?>','<?php echo e(isset($_GET['state'])?$_GET['state']:''); ?>','<?php echo e(isset($_GET['lga'])?$_GET['lga']:''); ?>','<?php echo e(isset($_GET['hospital_name'])?$_GET['hospital_name']:''); ?>')">
                                        <div class="col-md-5 docter-set">
                                            <div class="media">
                                                <img style="background-image: url(../doctorimages/<?php echo e($item->doctor_picture); ?>)"  alt="">
                                                <div class="media-body">
                                                    <p><?php echo e($item->doctor_title ? $item->doctor_title : ''); ?> <?php echo e($item->doctor_first_name ? $item->doctor_first_name : ''); ?> <?php echo e($item->doctor_middle_name ? $item->doctor_middle_name : ''); ?> <?php echo e($item->doctor_last_name ? $item->doctor_last_name : ''); ?></p>
                                                    <p><?php echo e($item->doctor_speciality ? $item->doctor_speciality : ''); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="languages-list">
                                                <p>Languages</p>
                                                <p><?php echo e($item->doctor_languages ? str_replace(',',', ',$item->doctor_languages) : '--'); ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="languages-list">
                                                <p>Education</p>
                                                <p><?php echo e($item->doctor_education_school ? $item->doctor_education_school : '--'); ?></p>
                                                <div class="clearfix prettyradio labelright  blue side-btn">
                                                    <input id="today" <?php echo e(isset($_GET['doctor_id']) && $_GET['doctor_id'] == $item->doctor_id? 'checked' : ''); ?> onChange="getDoctorsDetail(<?php echo e($item->hospital_id); ?>,'<?php echo e(isset($search_hospital_appointment)?$search_hospital_appointment:''); ?>',<?php echo e(isset($item)?$item->doctor_id:''); ?>,'<?php echo e(isset($_GET['type_of_speciality'])?$_GET['type_of_speciality']:''); ?>','<?php echo e(isset($_GET['state'])?$_GET['state']:''); ?>','<?php echo e(isset($_GET['lga'])?$_GET['lga']:''); ?>','<?php echo e(isset($_GET['hospital_name'])?$_GET['hospital_name']:''); ?>')" type="radio" name="doctor" class="form-check-custom appointment_time_sel" value="1" style="display: none;">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mention-year">
                                                <img src="http://renderhealth.themezones.com/images/briefcase.svg" alt="">
                                                <p> <?php echo e($item->doctor_years_practised ? $item->doctor_years_practised : '0'); ?> Year<?php echo e($item->doctor_years_practised && $item->doctor_years_practised>1 ? "s" : ''); ?> of experience</p>
                                            </div>
                                            <div class="cantant-p">
                                                <p><?php echo e($item->biography ? $item->biography : ''); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                     
                                    <?php if(count($item->doctor_availability) > 0): ?>
                                    
                                    <hr class="doctor-hr">
                                    <div class="row pad-set-2">
                                        <div class="col-md-6" id="<?php echo e($row); ?>">
                                        <div class="doc_appoint_date">    
                                        <?php if($user): ?>                            
                                        <input type="text" class="datepicker_input hosp_datepicker" readonly value="<?php echo e(date('d-m-Y')); ?>" id="datepicker" data-doct_id="<?php echo e($item->doctor_id ? $item->doctor_id : ''); ?>" data-patient_id="<?php echo e(isset($user) && $user->patient_unique_id ? $user->patient_unique_id : ''); ?>"  data-key="<?php echo e($row); ?>" onchange="doctorAvailabilityListing(this); return false;">
                                            
                                        <?php else: ?>
                                        <input type="text" class="datepicker_input hosp_datepicker" readonly value="<?php echo e(date('d-m-Y')); ?>" id="datepicker" data-doct_id="<?php echo e($item->doctor_id ? $item->doctor_id : ''); ?>" data-patient_id=""  data-key="<?php echo e($row); ?>" onchange="doctorAvailabilityListing(this); return false;">
                                        <?php endif; ?>
                                        </div>
                                    </div>
                                   
                                        <div class="col-md-6">
                                            <div class="set-available">
                                                <div class="not-availabal">
                                                    <div class="round-set-icon"></div>
                                                    <p>Not Available</p>
                                                </div>
                                                <div class="not-availabal availabal">
                                                    <div class="round-set-icon"></div>
                                                    <p>Available</p>
                                                </div>

                                            </div>
                                        </div>
                                        <div  class="<?php echo e($row); ?>">
                                        <input type="hidden" name="hospital_name" id="hospital_name" value=""/>
                                        <input type="hidden" name="hosp_id" id="hosps_id" value="<?php echo e(isset($_GET['hosp_id']) ? $_GET['hosp_id'] : ''); ?>"/>
                                                    <input type="hidden" name="doctor_id" id="doctors_id" value="<?php echo e(isset($_GET['doctor_id']) ? $_GET['doctor_id'] : ''); ?>"/>
                                        <div class="availability_listing_list" style="display: none" >
                                            <ul class="availability_listing" ></ul>
                                            
                                        </div>
                                        <div class="row pad-set-2 appointment_loadmore">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-6 text-center">
                                                <a class="btn btn-black btn-xs mt-2 mb-3 loadMore" href="javascript:;" id="loadMore">See All</a>
                                            </div>
                                            <div class="col-sm-3"></div>    
                                        </div>
                                        <div class="col-md-12 schudule-btn-show" id="schudule-btn-show" style="display: none" >
                                           
                                           <?php if($user): ?>
                                            <div class="btn-doctor" data-target="#scheduleAppointmentModel" data-toggle="modal" onClick="scheduleAppointmentDetail(<?php echo e($item->doctor_id); ?>);">
                                                <a href="#">SCHEDULE APPOINTMENT</a>
                                            </div>
                                            <?php else: ?>
                                           
                                            <div class="btn-doctor" >
                                                <a href="http://renderhealth.themezones.com/patient/login">SCHEDULE APPOINTMENT</a>
                                            </div>
                                            <?php endif; ?>
                                            
                                        </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="scheduleAppointmentModel" tabindex="-1" role="dialog" aria-labelledby="scheduleAppointmentModelTitle" aria-hidden="true" style="overflow: scroll;">
                                                <div class="modal-dialog modal-dialog-centered doctor-modal" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class="header-text">
                                                                <div class="btn-doctor m-0" data-target="#scheduleAppointmentModel" data-toggle="modal">
                                                                    <a href="#">Cancel</a>
                                                                </div>
                                                                <p>Appointment Confirmation</p>
                                                                <div class="btn-doctor m-0" onClick="saveAppointmentDetail(<?php echo e($row); ?>)">
                                                                    <a href="#">Confirm</a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row detail-1">
                                                                <div class="col-md-8">
                                                                    <div class="detail-pation">
                                                                        <div class="media">
                                                                            <img clas="patient-img" id="patient_image" src="" alt="">
                                                                            <div class="media-body">
                                                                                <p class="text-media" id="patient_name"></p>
                                                                                <p class="text-media-1"><span id="patient_age"></span> y/o, <span id="patient_gender"></span></p>
                                                                                <ul class="patient-address">
                                                                                    <li><img src="http://renderhealth.themezones.com/images/location.svg" alt=""></li>
                                                                                    <li id="patient_address"></li>
                                                                                </ul>
                                                                                <ul class="patient-address brithday">
                                                                                    <li><img src="http://renderhealth.themezones.com/images/bday.svg" alt=""></li>
                                                                                    <li><span id="patient_dob"></span> (Brithday)</li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="appoiment-date text-center">
                                                                        <div>
                                                                            <p class="appoiment-banner"><span id="patient_month_year"></span> <br> <b id="patient_date"></b> <br> <span id="patient_time"></span></p>
                                                                            <div class="appoiment-text">
                                                                                <p>Hospital Appointment</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row detail-set-pad">
                                                                <div class="col-md-12">
                                                                    <div class="media p-3">
                                                                        <img clas="" id="doctor_picture"  alt="" width="70px">
                                                                        <div class="media-body">
                                                                            <div class="set-doctor">
                                                                                <p id="doctor_name"></p>
                                                                                <p id="doctor_speciality"></p>
                                                                            </div>
                                                                            <div class="location-detail">
                                                                                <p>Location:</p>
                                                                                <p id="doctor_address"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reanson-for">
                                                                        <p>Reason for visit</p>
                                                                        <textarea class="w-100" name="reanson_for_visit" id="reanson_for_visit" cols="30" rows="1" placeholder=""></textarea>
                                                                        <p class="text-bottom">
                                                                        <?php if(count($health_diaries)>0): ?>
                                                                        <a class="attachment mb-4 mt-2" href="javascript:;" data-toggle="modal" data-target="#select_diary" >
                                                                            <img src="<?php echo e(asset('images/attachment.svg')); ?>" alt="icon">
                                                                            Attach My Health Diary
                                                                        </a> 
                                                                        <?php else: ?>
                                                                            <a class="attachment mb-4 mt-2" href="javascript:;" onClick="(function(){
                                                                            alert('No health diary found');
                                                                            return false;
                                                                            })();return false;">
                                                                            <img src="<?php echo e(asset('images/attachment.svg')); ?>" alt="icon">
                                                                            Attach My Health Diary
                                                                            </a> 
                                                                        <?php endif; ?>
                                                                        <div class="attachdoaries">
                                         
                                                                        </div>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    
                                    <?php endif; ?>

                                </div>
                            </div>
                            <!-- Diary Modal -->
                            <div class="modal fade" id="select_diary">
                                <div class="modal-dialog modal-xl modal-dialog-centered genModal">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add My Health Diary</h4>
                                            <button type="button" class="close mclose" data-dismiss="modal"><img src="<?php echo e(asset('images/cross_modal.svg')); ?>"/></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="health_diary">
                                                <ul class="row">
                                                    <?php $__currentLoopData = $health_diaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Singlehealth_diaries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="col-sm-4">
                                                        <input id="diary_<?php echo e($Singlehealth_diaries->id); ?>" value="<?php echo e($Singlehealth_diaries->diary_id); ?>" class="form-check-input health_diary" name="health_diary" type="checkbox"   onclick="appenddiary(<?php echo $Singlehealth_diaries->diary_id;?>,this)" />
                                                        <label for="diary_<?php echo e($Singlehealth_diaries->id); ?>">
                                                            <span class="diary_date"><?php echo e(date('j F Y',$Singlehealth_diaries->created_date)); ?></span>
                                                            <div class="diary_detail">
                                                                <?php
                                                                    $feeling_pic = ['admin/doctor/images/smilies/no_pain@2x.png','admin/doctor/images/smilies/mild@2x.png','admin/doctor/images/smilies/moderate@2x.png','admin/doctor/images/smilies/severe@2x.png','admin/doctor/images/smilies/very_severe@2x.png','admin/doctor/images/smilies/worst_pain@2x.png','admin/doctor/images/smilies/moderate@2x.png'];
                                                                    ?>
                                                                <span class="diary_icon"><img src="<?php echo e(asset($feeling_pic[$Singlehealth_diaries->feeling_details])); ?>" alt="smilies"></span>
                                                        <?php 
                                                            $put_disable_keys=array();

                                                            $feeling = ['Feeling No Pain','Feeling Mild Pain','Feeling Moderate Pain','Feeling Severe Pain','Feeling Very Severe Pain','Feeling Worst Pain',"Other"];    
                                                            $put_disable_keys[]=$Singlehealth_diaries->feeling_details;
                                                            
                                                        ?>                              

                                                            
                                                            <?php $__currentLoopData = $feeling; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$single_feeling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                            <?php if($key==6): ?>
                                                            <h4> <?php echo e(trim($Singlehealth_diaries->describe_feeling_other)); ?></h4> 
                                                            <?php else: ?>
                                                            <?php if(in_array($key,$put_disable_keys)): ?>                              
                                                                <h4><?php echo e($single_feeling); ?></h4>                                      
                                                                <?php endif; ?>
                                                                <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

                                                                <h6><?php echo e($Singlehealth_diaries->symptom_details); ?></h6>
                                                            </div>
                                                        </label>
                                                    </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                            <div class="text-center">
                                            <a data-dismiss="modal" class="btn btn-primary col-sm-3 mt-2 mb-3 loadMore" href="javascript:;" id="loadMore" style="display: inline;">Submit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-12 col-xl-8 doctors_listing text-center">
                        <div class="widget_body">
                            <div class="no_data">
                                <img src="<?php echo e(asset('images/no_data.svg')); ?>" alt="images">
                                <h4>No availability, Please check another Facility</h4>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
               
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="search_schedule_appointment">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width1 doctor-modal " style="width:650px">
        <div class="modal-content">
            <div class="modal-header" style="padding-top:10px">
                <div class="header-text">
                    <div class="btn-doctor m-0" data-target="#scheduleAppointmentModel" data-toggle="modal" >
                        
                    </div>
                    <p>Filter</p>
                    <div class="btn-doctor m-0" >
                    <button type="button" id="search_patient_modal" class="close" data-dismiss="modal"><img src="<?php echo e(asset('admin/doctor/images/popup_close_w.svg')); ?>" /></button>
                    </div>

                </div>
            </div>
            <div class="modal-body" style="padding: 40px;">
                <form id="search_patient_form" name="search_patient_form" method="GET">


                    
                    <?php if(count($serviceOffered) > 0): ?>
                    
                    <div class=" row">
                        <?php $__currentLoopData = $serviceOffered; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row_serviceOffered => $Offered): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <div class="col-sm-6 row">
                            <div class="col-sm-9"><?php echo e($Offered->name); ?></div>
                            <div class="col-sm-3">
                            <div class="">
                                <?php
                                if(isset($_GET['offered'])){
                                    if(in_array($Offered['name'], $_GET['offered'])){
                                       $msg = "checked";
                                    }else{
                                        $msg = "";
                                    }
                                }
                                ?>
                                <input id="today" <?php echo e(isset($msg)?$msg:''); ?>  type="checkbox" name="offered[]" class="form-check-custom appointment_time_sel" value="<?php echo e($Offered->name); ?>"  style="display: none;">
                            </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                            <label>Specialities</label>
                            <div class="select_box">
                                <select class="form-control" name="type_of_speciality" id="type_of_speciality">
                                    <option value="" data-id="0" selected>Select Specialities</option>
                                    <?php if(count($speciality) > 0): ?>
                                    <?php $__currentLoopData = $speciality; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speciality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option data-id="<?php echo e($speciality['id']); ?>" value="<?php echo e($speciality['name']); ?>" <?php echo e(isset($_GET['type_of_speciality']) && $_GET['type_of_speciality']===$speciality['name']?'selected':''); ?>><?php echo e($speciality['name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                            <label>State</label>
                            <div class="select_box">
                                <select class="form-control" name="state" id="hospital_state_nigeria">
                                    <option value="" data-id="0" selected>Select States</option>
                                    <?php if(count($states) > 0): ?>
                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option data-id="<?php echo e($state['id']); ?>" value="<?php echo e($state['name']); ?>" <?php echo e(isset($_GET['state']) && $_GET['state']===$state['name']?'selected':''); ?>><?php echo e($state['name']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                            <label>LGA</label>
                            <div class="select_box">
                                <select class="form-control" name="lga" id="lga">
                                    <option value="" data-id="0" selected>Select LGA</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                        <label>HMO Accepted</label>
                        <div class="select_box">
                            <select class="form-control" name="HMO" id="hosp_speciality">
                                <option value="" data-id="0" selected>Select HMO</option>
                                <?php if(count($Hmolist) > 0): ?>
                                <?php $__currentLoopData = $Hmolist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hmo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option data-id="<?php echo e($hmo['id']); ?>" value="<?php echo e($hmo['name']); ?>" <?php echo e(isset($_GET['HMO']) && $_GET['HMO']===$hmo['name']?'selected':''); ?>><?php echo e($hmo['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mb-3 mt-3" name="button">Search</button>
                        </div>
                    </div>
                    <input type="hidden" id="patient_name_hidden">
                    <input type="hidden" id="patient_surname_hidden">
                    <input type="hidden" id="patient_recno_hidden">
                    <input type="hidden" id="patient_dob_hidden">
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.patient_fluid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>