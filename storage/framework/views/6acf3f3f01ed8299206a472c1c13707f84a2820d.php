<?php $__env->startSection('content'); ?>
<style>
    .tab:nth-child(2) {
        display: none;
    }
    #prevBtn, #add_hospital_button{
        display: none;
    }

</style>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="page_head">
                <h1 class="heading">Manage Hospital/Labs
                    <a data-toggle="modal" data-target="#add_hospital_lab" class="add_schedule" href="javascript:;" onclick="$('#hospitalTitle').html('Add Hospital/Laboratorium');" >
                        <img src="<?php echo e(asset('admin/doctor/images/add.svg')); ?>" alt="icon">
                    </a>
                </h1>
                <div class="appointment_type">
                    <ul class="nav nav-pills" role="tablist">
                        <li><a role="tab" data-toggle="pill" href="#pending_hospital_labs">Pending Hospital/Labs <?php if($pending_hospitals_count >0): ?><span><?php echo e($pending_hospitals_count); ?> </span><?php endif; ?></a></li>
                        <li><a class="active" role="tab" data-toggle="pill" href="#all_hospitals">All Hospital</a></li>
                        <button type="button" data-toggle="modal" data-target="#search_hospital" class="btn btn-primary btn-sm">Search Hospital </button>
                    </ul>
                </div>
            </div>
            <div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert" style="display: none;">
                <div class="d-flex align-items-center">
                    <div class="alert-icon-col">
                        <span class="fa fa-warning"></span>
                    </div>
                    <div class="alert_text pending_danger">

                    </div>
                    <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <div class="alert alert-success-outline alert-dismissible alert_icon fade show" role="alert" style="display: none;">
                <div class="d-flex align-items-center">
                    <div class="alert-icon-col">
                        <span class="fa fa-check"></span>
                    </div>
                    <div class="alert_text pending_success">

                    </div>
                    <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="tab-content main_div">
                <div id="pending_hospital_labs" class="tab-pane fade">
                    <div class="table_hospital pagination_fixed_bottom">
                        <div class="table-responsive">
                            <table class="table" cellspacing="10">
                                <tr>
                                    <th>MEMBER DATA</th>
                                    <th>ADDRESS</th>
                                    <th>PHONE NUMBER</th>
                                    <th>DATE CREATED</th>
                                    <th></th>
                                </tr>
                                <?php if(count($pending_hospitals) > 0): ?>
                                <?php $__currentLoopData = $pending_hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending_hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="d_profile">
                                            <div class="d_pro_text">
                                                <h4><?php echo e($pending_hospital['hosp_name']); ?></h4>
                                                <a href="javascript:;"><?php echo e($pending_hospital['hosp_state']); ?>, <?php echo e($pending_hospital['hosp_country']); ?></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo e($pending_hospital['hosp_address']); ?></td>
                                    <td><?php echo e($pending_hospital['hosp_phone']); ?></td>
                                    <td><?php echo e(date('d M Y',$pending_hospital['hosp_created_date'])); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-blue btn-sm mr-2" name="button" onclick="accept_hosp('<?php echo e($pending_hospital->id); ?>','<?php echo e($pending_hospital->hosp_id); ?>');">Accept</button>
                                        <button type="button" class="btn btn-danger btn-sm" name="button" onclick="ignore_hosp('<?php echo e($pending_hospital->id); ?>','<?php echo e($pending_hospital->hosp_id); ?>');">Ignore</button>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No Pending Hospitals Found</td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                        <div class="table_pagination">
                            <button type="button" class="btn btn-light btn-xs pre_labs" <?php if ($pending_hospitals->previousPageUrl()) {
                                                                                        } else {
                                                                                            echo "disabled";
                                                                                        } ?> data-url="<?php echo $pending_hospitals->previousPageUrl(); ?>&type=pen_page">Previous Page</button>
                            <input type="hidden" class="pen_page_hidden" value="<?php echo e($pending_hospitals->currentPage()); ?>">
                            <span>Page <?php echo e($pending_hospitals->currentPage()); ?> of <?php echo e($pending_hospitals->lastPage()); ?> Pages</span>
                            <button type="button" class="btn btn-light btn-xs next_labs" <?php if ($pending_hospitals->nextPageUrl()) {
                                                                                            } else {
                                                                                                echo "disabled";
                                                                                            } ?> data-url="<?php echo $pending_hospitals->nextPageUrl(); ?>&type=pen_page">Next Page</button>
                        </div>
                    </div>
                </div>
                <div id="all_hospitals" class="tab-pane fade show active">
                    <div class="table_hospital pagination_fixed_bottom">
                        <div class="table-responsive">
                            <table class="table" cellspacing="10">
                                <tr>
                                    <th>MEMBER DATA</th>
                                    <th>HOSPITAL ID</th>
                                    <th class="text-center">DOCTORS</th>
                                    <th class="text-center">NURSES</th>
                                    <th class="text-center">ADMIN</th>
                                    <th class="text-right"></th>
                                </tr>
                                <?php if(count($all_hospitals) > 0): ?>
                                <?php $__currentLoopData = $all_hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="d_profile">
                                            <div class="d_pro_text">
                                                <h4><?php echo e($all_hospital['hosp_name']); ?></h4>
                                                <a href="javascript:;"><?php echo e($all_hospital['hosp_state']); ?>, <?php echo e($all_hospital['hosp_country']); ?></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Hospital-<?php echo e($all_hospital['hosp_id']); ?></td>
                                    <td class="text-center"><?php echo e($all_hospital['doctorsCount']); ?></td>
                                    <td class="text-center"><?php echo e($all_hospital['nurseCount']); ?></td>
                                    <td class="text-center"><?php echo e($all_hospital['administratorsCount']); ?></td>
                                    <td class="text-right">
                                        <a href="#" onclick="viewHospital(<?php echo $all_hospital['hosp_id'] ?>)" class="btn btn-light btn-xs btn_view_deal" name="button">
                                            <img class="icon" src="<?php echo e(asset('admin/adminimages/eye.svg')); ?>" alt="icon">View
                                        </a>
                                        <a href="#" onclick="editHospital(<?php echo $all_hospital['hosp_id'] ?>)" class="btn btn-light btn-xs btn_edit_deal" name="button">
                                            <img class="icon" src="<?php echo e(asset('admin/adminimages/btn-edit.svg')); ?>" alt="icon">Edit
                                        </a>
                                        <a href="#" onclick="removeHospital(<?php echo $all_hospital['hosp_id'] ?>)" class="btn btn-light btn-xs btn_delete_deal" name="button">
                                            <img class="icon" src="<?php echo e(asset('admin/adminimages/delete.svg')); ?>" alt="icon">Delete
                                        </a>
                                        <a class="btn btn-light btn-xs" href="<?php echo e(url('admin/hospital_detail/'.$all_hospital['hosp_id'])); ?>"><img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">More</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No Hospitals Found</td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                        <div class="table_pagination">
                            <button type="button" class="btn btn-light btn-xs pre_labs" <?php if ($all_hospitals->previousPageUrl()) {
                                                                                        } else {
                                                                                            echo "disabled";
                                                                                        } ?> data-url="<?php echo $all_hospitals->previousPageUrl(); ?>&type=all_page">Previous Page</button>
                            <input type="hidden" class="all_page_hidden" value="<?php echo e($all_hospitals->currentPage()); ?>">
                            <span>Page <?php echo e($all_hospitals->currentPage()); ?> of <?php echo e($all_hospitals->lastPage()); ?> Pages</span>
                            <button type="button" class="btn btn-light btn-xs next_labs" <?php if ($all_hospitals->nextPageUrl()) {
                                                                                            } else {
                                                                                                echo "disabled";
                                                                                            } ?> data-url="<?php echo $all_hospitals->nextPageUrl(); ?>&type=all_page">Next Page</button>
                        </div>
                    </div>
                </div>
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
<!-- new hospital/labs screen -->

<div class="modal fade" id="add_hospital_lab">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width3">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="hospitalTitle">Add Hospital/Laboratorium</h3>
                <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(asset('admin/doctor/images/popup_close.svg')); ?>"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger-outline alert-danger-outline-addhos alert-dismissible alert_icon fade show" role="alert" style="display: none;">
                    <div class="d-flex align-items-center">
                        <div class="alert-icon-col">
                            <span class="fa fa-warning"></span>
                        </div>
                        <div class="alert_text addhos_danger_pop">

                        </div>
                        <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                    </div>
                </div>
                <div class="alert alert-success-outline alert-success-outline-addhos alert-dismissible alert_icon fade show" role="alert" style="display: none;">
                    <div class="d-flex align-items-center">
                        <div class="alert-icon-col">
                            <span class="fa fa-check"></span>
                        </div>
                        <div class="alert_text addhos_success_pop">

                        </div>
                        <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                    </div>
                </div>
                <form id="add_hospital_form" name="add_hospital_form" action="">
                
                    <div class="tab">
                    <Input type="hidden" readonly class="form-control" name="hosp_id" id="hosp_id" />
                    <Input type="hidden" readonly class="form-control" name="mode" id="mode" value="ADD" />
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Name of Facility</label>
                                    <input type="text" placeholder="Name of Facility" class="form-control" name="name_of_facility" id="name_of_facility">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" placeholder="Email" class="form-control" name="hosp_email" id="hosp_email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Phone Number</label>
                                <div class="form-group">
                                    <input type="text" placeholder="Phone Number" class="form-control" id="patient_phone" name="hosp_phone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" placeholder="Address" class="form-control" name="hosp_address" id="hosp_address">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>State</label>
                                    <div class="select_box width220">
                                        <select class="form-control" name="hosp_state" id="hospital_state_nigeria">
                                            <option value="0" data-id="0" selected>Select State</option>
                                            <?php if(count($statesNigeria) > 0): ?>
                                            <?php $__currentLoopData = $statesNigeria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($state['id']); ?>" value="<?php echo e($state['name']); ?>"><?php echo e($state['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>LGA</label>
                                    <div class="select_box width2201">
                                        <select class="form-control" name="lga" id="lga">
                                            <option value="0" data-id="0" selected>Select LGA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" placeholder="City" class="form-control" id="hosp_city" name="hosp_city">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Type of Facility</label>
                                    <div class="select_box width2201">
                                        <select class="form-control" name="type_of_facility" id="type_of_facility">
                                            <option value="0" data-id="0" selected>Select Facility</option>
                                            <?php if(count($facility) > 0): ?>
                                            <?php $__currentLoopData = $facility; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($facility['id']); ?>" value="<?php echo e($facility['name']); ?>"><?php echo e($facility['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Specialities</label>
                                    <div class="select_box">
                                        <select class="form-control" name="hosp_speciality" id="hosp_speciality">
                                            <option value="0" data-id="0" selected>Select Speciality</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <strong>
                            <h5>Point of Contact</h5>
                        </strong>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" placeholder="First Name" class="form-control" name="point_first_name" id="point_first_name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Surname</label>
                                    <input type="text" placeholder="Surname" class="form-control" name="point_surname" id="point_surname">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" placeholder="Email" class="form-control" name="point_email" id="point_email" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Phone Number</label>
                                <div class="form-group">
                                    <input type="text" placeholder="Phone Number" class="form-control" name="point_phone" maxlength="15" id="point_phone">
                                </div>
                            </div>
                        </div>
                        <strong>
                            <h5>2nd Point of Contact</h5>
                        </strong>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" placeholder="First Name" class="form-control" name="point2_first_name" id="point2_first_name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Surname</label>
                                    <input type="text" placeholder="Surname" class="form-control" name="point2_surname" id="point2_surname" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" placeholder="Email" class="form-control" name="point2_email" id="point2_email" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Phone Number</label>
                                <div class="form-group">
                                    <input type="text" placeholder="Phone Number" class="form-control" name="point2_phone" maxlength="15" id="point2_phone">
                                </div>
                            </div>
                        </div>

                        <!-- Old Part -->
                        <!-- <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital name</label>
                                        <input type="text" placeholder="Mr. Akintude" class="form-control" name="hospital_name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital Phone Number</label>
                                        <input type="text" placeholder="..." class="form-control" name="hospital_ph" maxlength="15">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital ID</label>
                                        <input type="text" placeholder="HMO/Client ID" class="form-control" name="hospital_id">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" placeholder="Example : Adamawa, Nigeria" class="form-control" name="hospital_address">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <div class="select_box width220">
                                            <select class="form-control" name="hospital_country" id="hospital_country">
                                               <option value="0" data-id="0" selected>Select Country</option>
                                                <?php if(count($countries) > 0): ?>
                                                  <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                  <option data-id="<?php echo e($country['id']); ?>" value="<?php echo e($country['name']); ?>"><?php echo e($country['name']); ?></option>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?> 
                                             </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 pr-0">
                                    <div class="form-group">
                                        <label>State</label>
                                        <div class="select_box width220">
                                            <select class="form-control" name="hospital_state" id="hospital_state">
                                                <option value="0" data-id="0" selected>Select State</option>
                                             </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Hospital Status</label>
                                        <div class="select_box width2201">
                                            <select class="form-control" name="hospital_sts">
                                                <option value="1">Active</option>
                                                <option value="0">Not Active</option>
                                             </select>
                                        </div>
                                    </div>
                                </div>

                            </div> -->
                        <!-- Old Part -->
                    </div>

                    <!-- Next Page -->

                    <div class="tab">
                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <div class="employee_table_record mt-2">
                                    <h5>Hours of Operation</h5>
                                    <div class="form-check">
                                        <input class="form-check-input form-check-custom" name="entry_patient_record" value="1" id="allhours" type="radio" checked="checked" />
                                        <label class="form-check-label" for="allhours">24 Hours</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--  Hours  -->
                        <div class="row hours">
                            <div class="col-sm-2">
                                <div class="employee_table_record mt-2 ">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-custom daycheckbox" name="entry_patient_record" value="1" id="Monday" type="checkbox" />
                                        <label class="form-check-label" for="Monday">Monday</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group ">
                                    <div class="select_box width2201">
                                        <select class="form-control Monday monday_from" name="hours[monday][]">
                                        
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            to
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="select_box width2201">
                                        <select class="form-control Monday monday_to" name="hours[monday][]">
                                             
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hours">
                            <div class="col-sm-2">
                                <div class="employee_table_record mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-custom daycheckbox" name="entry_patient_record" value="1" id="Tuesday" type="checkbox" />
                                        <label class="form-check-label" for="Tuesday">Tuesday</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="select_box width2201">
                                        <select class="form-control Tuesday tuesday_from" name="hours[tuesday][]">
                                             
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            to
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="select_box width2201">
                                        <select class="form-control Tuesday tuesday_to" name="hours[tuesday][]">
                                             
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hours">
                            <div class="col-sm-2">
                                <div class="employee_table_record mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-custom daycheckbox" name="entry_patient_record" value="1" id="Wednesday" type="checkbox" />
                                        <label class="form-check-label" for="Wednesday">Wednesday</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="select_box width2201">
                                        <select class="form-control Wednesday wednesday_from" name="hours[wednesday][]">
                                             
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            to
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="select_box width2201">
                                        <select class="form-control Wednesday wednesday_to" name="hours[wednesday][]">
                                             
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hours">
                            <div class="col-sm-2">
                                <div class="employee_table_record mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-custom daycheckbox" name="entry_patient_record" value="1" id="Thursday" type="checkbox" />
                                        <label class="form-check-label" for="Thursday">Thursday</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="select_box width2201">
                                        <select class="form-control Thursday thursday_from" name="hours[thursday][]">
                                             
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            to
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="select_box width2201">
                                        <select class="form-control Thursday thursday_to" name="hours[thursday][]">
                                             
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hours">
                            <div class="col-sm-2">
                                <div class="employee_table_record mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-custom daycheckbox" name="entry_patient_record" value="1" id="Friday" type="checkbox" />
                                        <label class="form-check-label" for="Friday">Friday</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="select_box width2201">
                                        <select class="form-control Friday friday_from" name="hours[friday][]">
                                             
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            to
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="select_box width2201">
                                        <select class="form-control Friday friday_to" name="hours[friday][]">
                                             
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hours">
                            <div class="col-sm-2">
                                <div class="employee_table_record mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-custom daycheckbox" name="entry_patient_record" value="1" id="Saturday" type="checkbox" />
                                        <label class="form-check-label" for="Saturday">Saturday</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="select_box width2201">
                                        <select class="form-control Saturday saturday_from" name="hours[saturday][]">
                                             
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            to
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="select_box width2201">
                                        <select class="form-control Saturday saturday_to" name="hours[saturday][]">
                                             
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row hours">
                            <div class="col-sm-2">
                                <div class="employee_table_record mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-custom daycheckbox" name="entry_patient_record" value="1" id="Sunday" type="checkbox" />
                                        <label class="form-check-label" for="Sunday">Sunday</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="select_box width2201">
                                        <select class="form-control Sunday sunday_from" name="hours[sunday][]">
                                            
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            to
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="select_box width2201">
                                        <select class="form-control Sunday sunday_to" name="hours[sunday][]">
                                             
                                            <?php if(count($timeList) > 0): ?>
                                            <?php $__currentLoopData = $timeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($time['value']); ?>" value="<?php echo e($time['value']); ?>"><?php echo e($time['name']); ?></option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  Hours  -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>HMO Accepted</label>
                                    <div class="">
                                        <select class="form-control hmo_select" name="hmo[]" id="hmo" multiple>
                                            <option ></option>
                                            <?php if(count($Hmolist) > 0): ?>
                                            <?php $__currentLoopData = $Hmolist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hmo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-id="<?php echo e($hmo['id']); ?>" value="<?php echo e($hmo['name']); ?>"><?php echo e($hmo['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Service Offered -->
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Service Offered</label>

                                <?php if(count($serviceofferd) > 0): ?>
                                <?php $__currentLoopData = $serviceofferd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="form-check-label" for="<?php echo e($service['id']); ?>"><?php echo e($service['name']); ?></label>
                                <div class="employee_table_record mt-2">
                                    <div class="form-check">
                                        <input data-id="<?php echo e($service['id']); ?>" class="form-check-input form-check-custom <?php echo e(str_replace(' ','-',$service['name'])); ?>" name="serviceofferd[]" value="<?php echo e($service['name']); ?>" id="<?php echo e($service['id']); ?>" type="checkbox" />
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- Service Offered -->
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="button" id="prevBtn" class="btn btn-primary mb-3 mt-3" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" id="nextBtn" class="btn btn-primary mb-3 mt-3"    onclick="nextPrev(1)">Next</button>
                            <button type="submit" class="btn btn-primary mb-3 mt-3" name="button" id="add_hospital_button">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Search Hospital -->
<div class="modal fade" id="search_hospital">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width1">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Search Hospital
                </h3>
                <button type="button" id="search_emp_modal" class="close" data-dismiss="modal">
                    <img src="<?php echo e(asset('admin/adminimages/popup_close.svg')); ?>" />
                </button>
            </div>
            <div class="modal-body plr-96">
                <form id="search_hosp_form" name="search_hosp_form">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <img src="<?php echo e(asset('admin/adminimages/search_input.svg')); ?>" alt="icon">
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search by name or ID" name="name_or_id" id="name_or_id">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mb-3 mt-3" name="button">Search Hospital
                            </button>
                        </div>
                    </div>
                    <input type="hidden" id="name_or_id_hidden">
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<script>
    var currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        if(n == 1){
            document.getElementById("prevBtn").style.display = "inline";  
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("add_hospital_button").style.display = "inline";
        }else{
            document.getElementById("prevBtn").style.display = "none";  
            document.getElementById("nextBtn").style.display = "inline";
            document.getElementById("add_hospital_button").style.display = "none"; 
        }
    }

    function nextPrev(n) {
        if(n == 1){
            document.getElementById("prevBtn").style.display = "inline";  
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("add_hospital_button").style.display = "inline";
        }else{
            document.getElementById("prevBtn").style.display = "none";  
            document.getElementById("nextBtn").style.display = "inline";
            document.getElementById("add_hospital_button").style.display = "none"; 
        }
        var x = document.getElementsByClassName("tab");
        x[currentTab].style.display = "none";
        currentTab = currentTab + n;
        if (currentTab >= x.length) {
            document.getElementById("add_hospital_form").submit();
            return false;
        }
        showTab(currentTab);
    }
</script>
<?php echo $__env->make('layouts.admin_dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>