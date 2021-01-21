<?php $__env->startSection('content'); ?>

<main class="col-12 col-md-12 col-xl-12 bd-content">
  <div class="row">
    <div class="col-12">
      <div class="page_head">
        <h1 class="heading">Manage Doctor

          <a data-toggle="modal" data-target="#add_doctor" class="add_schedule" href="javascript:;">
            <img src="<?php echo e(asset('admin/adminimages/add.svg')); ?>" alt="icon">
          </a>
        </h1>
        <button type="button" data-toggle="modal" data-target="#search_doctor" class="btn btn-primary btn-sm">Search Doctor
        </button>
      </div>
      <div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert" style="display: none;">
        <div class="d-flex align-items-center">
          <div class="alert-icon-col">
            <span class="fa fa-warning"></span>
          </div>
          <div class="alert_text pending_danger"></div>
          <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
            <i class="fa fa-close"></i>
          </a>
        </div>
      </div>
      <div class="alert alert-success-outline alert-dismissible alert_icon fade show" role="alert" style="display: none;">
        <div class="d-flex align-items-center">
          <div class="alert-icon-col">
            <span class="fa fa-check"></span>
          </div>
          <div class="alert_text pending_success"></div>
          <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
            <i class="fa fa-close"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="tab-content main_div">
        <div id="hostpital_appointment" class="tab-pane fade show active">
          <div class="table-responsive">
            <div class="table_hospital pagination_fixed_bottom">
              <div id="accordion" class="lookalike_table mb-4">
                <div class="lookalike_table_head">
                  <ul>
                    <li style="width:22%">Doctor Data
                    </li>
                    <li style="width:19%">Doctor ID
                    </li>
                    <li style="width:13%">Phone Number
                    </li>
                    <li style="width:12%">Status
                    </li>
                    <li></li>
                  </ul>
                </div>
                <?php if(count($all_doctors) > 0): ?>
                <?php $__currentLoopData = $all_doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="lookalike_table_row">
                  <div class="lookalike_table_body" id="head_one<?php echo e($single_doctor['doctor_id']); ?>">
                    <ul>
                      <li style="width:22%">
                        <div class="d_profile">
                          <div class="d_pro_img">
                            <?php if(!empty($single_doctor
                            ['doctor_picture'])){
                            if(file_exists(getcwd().'/doctorimages/'.$single_doctor
                            ['doctor_picture'])){
                            ?>
                            <img src="<?php echo e(asset('/doctorimages/'.$single_doctor
                    ['doctor_picture'])); ?>" alt="image">
                            <?php }
                            else { ?>
                            <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                            <?php }
                            }
                            else { ?>
                            <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                            <?php }
                            ?>

                          </div>
                          <div class="d_pro_text">
                            <h4>
                              <?php echo e($single_doctor['doctor_title']); ?>

                              <?php echo e(ucfirst($single_doctor['doctor_first_name'])); ?> <?php echo e($single_doctor['doctor_last_name']); ?>

                            </h4>
                            <a href="javascript:;"><?php echo e($single_doctor['doctor_address']); ?>

                            </a>
                          </div>
                        </div>
                      </li>
                      <li style="width:19%">ID-Doctor-<?php echo e($single_doctor['doctor_id']); ?>

                      </li>
                      <li style="width:13%"><?php echo e($single_doctor['doctor_phone']); ?>

                      </li>
                      <li style="width:12%">
                        <span class="badge badge-pill 
                                   
                            <?php if ($single_doctor['active_status'] == 0) {
                              echo 'badge-danger';
                            } elseif ($single_doctor['active_status'] == 1) {
                              echo 'badge-success';
                            } ?>" id="status_row_<?php echo e($single_doctor['doctor_id']); ?>">
                          <?php if ($single_doctor['active_status'] == 0) {
                            echo 'Suspend';
                          } else if ($single_doctor['active_status'] == 1) {
                            echo 'Active User';
                          } ?>
                        </span>
                      </li>
                      <li>
                        <a href="<?php echo e(url('/admin/all_appointments')); ?>/<?php echo e($single_doctor['doctor_id']); ?>" class="btn btn-light btn-xs btn_view_appointment" data-id="<?php echo e($single_doctor['doctor_id']); ?>" name="button">
                          <img class="icon" src="<?php echo e(asset('admin/adminimages/eye.svg')); ?>" alt="icon">View Appointents

                        </a>
                      </li>
                    </ul>
                  </div>
                  <div id="accord_one<?php echo e($single_doctor['doctor_id']); ?>" class=" collapse" aria-labelledby="head_one<?php echo e($single_doctor['doctor_id']); ?>" data-parent="#accordion">
                    <form data-id="<?php echo e($single_doctor['doctor_id']); ?>" id="update_emp_details_<?php echo e($single_doctor
                         ['doctor_id']); ?>" onsubmit="update_emp_details(this,event)">
                      <input type="hidden" value="<?php echo e($single_doctor['doctor_id']); ?>" name="update_emp_id">
                      <div class="lookalike_table_detail">
                        <ul>
                          <li class="wc-25">
                            <div class="doctor_table_record">
                              <h5>Access for Hospital
                              </h5>
                              <div class="form-check">
                                <input value="1" name="access_for_hospital[]" class="form-check-input form-check-custom" <?php if ($single_doctor['access_to_hospital'] == 1 || $single_doctor['access_to_hospital'] == 3) echo 'checked'; ?> id="entry_patient<?php echo e($single_doctor
                              ['doctor_id']); ?>" type="checkbox" />
                                <label class="form-check-label" for="entry_patient<?php echo e($single_doctor
                                                                   ['doctor_id']); ?>">Entry Patient Data
                                </label>
                              </div>
                              <div class="form-check">
                                <input value="2" name="access_for_hospital[]" class="form-check-input form-check-custom" <?php if ($single_doctor['access_to_hospital'] == 2 || $single_doctor['access_to_hospital'] == 3) echo 'checked'; ?> id="access_hospital<?php echo e($single_doctor['doctor_
                              id']); ?>" type="checkbox" />
                                <label class="form-check-label" for="access_hospital<?php echo e($single_doctor
                                                                   ['doctor_id']); ?>">Access Hospital Billings
                                </label>
                              </div>
                            </div>
                          </li>
                          <li class="wc-25">
                            <div class="doctor_
                                      table_record">
                              <h5>Access for Patient Record
                              </h5>
                              <div class="form-check">
                                <input class="form-check-input form-check-custom" <?php if ($single_doctor['access_to_patient_record'] == 1) echo 'checked'; ?> name="entry_patient_record" id="entry_patient_record<?php echo e($single_doctor
                              ['doctor_id']); ?>" type="radio" value="1" />
                                <label class="form-check-label 
                                            
                                              <?php if ($single_doctor['access_to_patient_record'] == 1) echo 'active'; ?>" for="entry_patient_record<?php echo e($single_doctor['doctor_id']); ?>">Access to Full Patient Record

                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input form-check-custom 
                                            
                                              <?php if ($single_doctor['access_to_patient_record'] == 1) echo 'active'; ?>" <?php if ($single_doctor['access_to_patient_record'] == 2) echo 'checked'; ?> name="entry_patient_record" id="limited_patient_record<?php echo e($single_doctor
                              ['doctor_id']); ?>" type="radio" value="2" />
                                <label class="form-check-label" for="limited_patient_record<?php echo e($single_doctor
                                                                   ['doctor_id']); ?>">Limited Patient Record
                                </label>
                              </div>
                            </div>
                          </li>
                          <li class="wc-25">
                            <div>
                              <div class="switch_acc mb-3">
                                <!-- Small switch -->
                                <div class="form-group mr-4 mb-0">
                                  <span class="switch switch-sm">
                                    <input type="checkbox" <?php if ($single_doctor['active_status'] == 1) echo 'checked'; ?> class="switch" id="switch-sm3<?php echo e($single_doctor
                                  ['doctor_
                                  id']); ?>" name="active_status_emp" name="active_status_emp">
                                    <label for="switch-sm3<?php echo e($single_doctor
                                              ['doctor_
                                              id']); ?>">Active User
                                    </label>
                                  </span>
                                </div>
                                <div class="remove_acc" onclick="remove_emp( 
                                                  <?php echo $single_doctor['doctor_ id']; ?>)">
                                  <a href="javascript:;">
                                    <img src="<?php echo e(asset('admin/adminimages/delete.svg')); ?>" alt="icon">Remove account

                                  </a>
                                </div>
                              </div>
                              <div class="access_patient_other_options">
                                <button type="button" class="btn btn-light btn-xs mr-2" data-toggle="collapse" data-target="#accord_one{{$single_doctorel">
                              </button>
                                                  <button type="submit" class="btn btn-blue btn-xs" name="button">Save
                              </button>
                                                </div>
                                              </div>
                                            </li>
                                          </ul>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              No Doctor Found
              <?php endif; ?> 
            
                                </div>
                                <div class="table_pagination">
                                  <button type="button" class="btn btn-light btn-xs pre_emp" 
                      
                                    <?php if ($all_doctors
                                      ->previousPageUrl()
                                    ) {
                                    } else {
                                      echo "disabled";
                                    } ?> data-url="
              
                                    <?php echo $all_doctors->previousPageUrl(); ?>&type=doc_page">Previous Page
              
                                  </button>
                                  <input type="hidden" class="doc_page_hidden" value="<?php echo e($all_doctors
                                                                ->currentPage()); ?>">
                                  <span>Page <?php echo e($all_doctors
              ->currentPage()); ?> of <?php echo e($all_doctors
              ->lastPage()); ?> Pages
                                  </span>
                                  <button type="button" class="btn btn-light btn-xs next_emp" <?php if ($all_doctors->nextPageUrl()) {
                                                                                              } else {
                                                                                                echo "disabled";
                                                                                              } ?> data-url="
            
                                      <?php echo $all_doctors->nextPageUrl(); ?>&type=doc_page">Next Page

                                  </button>
                              </div>
                            </div>
                      </div>
                  </div>
                </div>
              </div>
</main>
<!-- Add Doctor screen -->
<div class="modal fade" id="add_doctor">
  <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width3">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Add Doctor</h3>
        <button type="button" class="close" data-dismiss="modal">
          <img src="<?php echo e(asset('admin/adminimages/popup_close.svg')); ?>" />
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger-outline alert-danger-outline-adddr alert-dismissible alert_icon fade show" role="alert" style="display: none;">
          <div class="d-flex align-items-center">
            <div class="alert-icon-col">
              <span class="fa fa-warning"></span>
            </div>
            <div class="alert_text adddr_danger_pop"></div>
            <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
              <i class="fa fa-close"></i>
            </a>
          </div>
        </div>
        <div class="alert alert-success-outline alert-success-outline-adddr alert-dismissible alert_icon fade show" role="alert" style="display: none;">
          <div class="d-flex align-items-center">
            <div class="alert-icon-col">
              <span class="fa fa-check"></span>
            </div>
            <div class="alert_text adddr_success_pop"></div>
            <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
              <i class="fa fa-close"></i>
            </a>
          </div>
        </div>
        <form id="add_dr_form" name="add_dr_form" data-id="hospital" enctype="multipart/form-data">

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Title</label>
                <div class="select_box width220">
                  <select class="form-control" name="doctor_title" id="doctor_title">
                    <option value="0" selected>Select Title</option>
                    <option value="Dr.">Dr.</option>
                    <option value="Professor">Professor</option>
                    <option value="Mr.">Mr.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Miss">Miss</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!-- First row -->
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label>First Name
                </label>
                <input type="text" placeholder="Akintude" class="form-control" name="doctor_first_name" id="doctor_first_name">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Middle Name
                </label>
                <input type="text" placeholder="Middle Name" class="form-control" name="doctor_middle_name" id="doctor_middle_name">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label>Surname
                </label>
                <input type="text" placeholder="Surname" class="form-control" name="doctor_last_name" id="doctor_last_name">
              </div>
            </div>
          </div>
          <!-- Second row -->
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label>Email
                </label>
                <input type="text" placeholder="doctor@gmail.com" class="form-control" name="doctor_email" id="doctor_email">
              </div>
            </div>
            <div class="col-sm-4">
              <label>Phone Number</label>
              <div class="form-group">
                <input type="text" placeholder="Phone Number" maxlength="15" class="form-control" value="+234" name="doctor_phone" id="dr_ph">
              </div>
            </div>
            <div class="form-group col-sm-4">
              <label>Sex</label>
              <div class="select_box">
                <select class="form-control" name="doctor_gender" id="doctor_gender">
                  <option value="">Select Sex</option>
                  <option value="1">Female</option>
                  <option value="0">Male</option>
                </select>
              </div>
            </div>

          </div>
          <div class="row">
              <div class="col-sm-12">
                  <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control patient_address" placeholder="Address" name="doctor_address" id="patient_address">
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-sm-3">
                  <div class="form-group">
                      <label>State</label>
                      <div class="select_box width220">
                          <select class="form-control dr_state" name="dr_state" id="hospital_state_nigeria">
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
                          <select class="form-control lga" name="lga" id="lga">
                              <option value="0" data-id="0" selected>Select LGA</option>
                          </select>
                      </div>
                  </div>
              </div>

              <div class="col-sm-3">
                  <div class="form-group">
                      <label>City</label>
                      <input type="text" placeholder="City" class="form-control patient_city" id="doctor_city" name="doctor_city">
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-2">
              <label>Date Of Birth </label>
              <div class="select_box">
                <select id="select_num" class="form-control" name="day" style="background-color: #fff;">
                  <option value="">Select Day</option>
                  <?php for ($i = 1; $i <= 31; $i++) {
                    echo '<option value="' . $i . '">' . $i . '</option>';
                  }   ?>
                </select>
              </div>
            </div>
            <div class="col-2 px-0">
              <label>&nbsp;</label>
              <div class="select_box">
                <select id="select_day" class="form-control" name="month" style="background-color: #fff;">
                  <option value="">Select Month</option>
                  <?php for ($m = 1; $m <= 12; $m++) {
                    $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                    echo '<option value="' . $month . '">' . $month . '</option>';
                  } ?>
                </select>
              </div>
            </div>
            <div class="col-2">
              <label>&nbsp;</label>
              <div class="select_box">
                <select class="form-control" id="year" name="years" style="background-color: #fff;">
                  <option value="">Select Year</option>
                  <?php
                  $date = date('Y');
                  $new_date =$date-12;
                  $range = 1900;
                  for($i=$range;$i<=$new_date; $i++){ $year=$range++; ?> <option id="year_get" value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                    <?php
                    }
                    ?>
                </select>
              </div>
            </div>
            <div class="form-group col-sm-6">
              <label>Role</label>
              <div class="select_box ">
                <select class="form-control" name="doctor_role" id="doctor_role">
                  <option value="Select Gender">Select Role</option>
                  <option value="admin">Admin</option>
                  <option value="nurse">Nurse</option>
                  <option value="doctor">Doctor</option>
                </select>
              </div>
            </div>
          </div>
          <!-- Third row -->

          <!-- Fourth row -->


          <!-- Fifth row -->
          <div class="row">
            <div class="employee_table_record col-sm-4">
              <h5>Are you Specialist?</h5>
              <div class="form-check">
                <input class="form-check-input form-check-custom" name="specialistmenu" value="1" id="entry_patient_data" type="radio" />
                <label class="form-check-label" for="entry_patient_data">Yes, I am</label>
              </div>
              <div class="form-check">
                <input class="form-check-input form-check-custom" checked id="access_hospital_billings" name="specialistmenu" value="2" type="radio" />
                <label class="form-check-label" for="access_hospital_billings">No, I am not</label>
              </div>
            </div>
            <div class="form-group col-sm-6 doctor_speciality">
              <label>What is your speciality?</label>
              <div class="select_box ">
                <select class="form-control" name="doctor_speciality" id="doctor_speciality">
                  <option value="">Select Doctors Speciality</option>
                  <?php $__currentLoopData = $specialist_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($category['id']); ?>"><?php echo e($category['name']); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>
          </div>
          <!-- Sixth row -->
          <div class="row">
            <div class="employee_table_record col-sm-4">
              <h5>Are You board certified doctor?</h5>
              <div class="form-check">
                <input class="form-check-input form-check-custom" name="certified_doctormenu" value="1" id="certified_doctor_yes" type="radio" />
                <label class="form-check-label" for="certified_doctor_yes">Yes, I am</label>
              </div>
              <div class="form-check">
                <input class="form-check-input form-check-custom" checked id="certified_doctor_no" name="certified_doctormenu" value="2" type="radio" />
                <label class="form-check-label" for="certified_doctor_no">No, I am not</label>
              </div>
            </div>

            <div class="col-sm-4 certified_doctormenu">
              <div class="form-group">
                <label>MDCN Register Number
                </label>
                <input type="text" disabled placeholder="78945" class="form-control" name="mdcn_register_no" id="mdcn_register_no">
              </div>
            </div>
            <div class="col-sm-4 certified_doctormenu">
              <div class="form-group">
                <label>Folio Number
                </label>
                <input type="text" disabled placeholder="78945" class="form-control" name="folio_number" id="folio_number">
              </div>
            </div>
          </div>
            <div class="row">
              <div class="col-12">
                  <div class="form-group">
                      <label>Language</label>
                      <div class="select_box1 mb-2">
                          <input type="text" id="doctor_languages" class="form-control doctor_languages" name="doctor_languages" value="" id="doctor_languages">
                      </div>
                      <div class="input_tags">
                          <ul id="top">
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-6">
                  <div class="form-group">
                      <label>Education School</label>
                      <div class="select_box1 mb-2">
                      <input type="text" placeholder="" class="form-control"  name="edu_school" id="edu_school">
                      </div>
                      <div class="input_tags">
                          <ul id="top">
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="col-6">
                  <div class="form-group">
                      <label>Years Practicing</label>
                      <div class="select_box1 mb-2">
                      <input type="number" placeholder="" class="form-control"  name="years_practised" id="years_practised">
                      </div>
                  </div>
              </div>
          </div>
          <!-- Seventh row -->
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Biography
                </label>
                <textarea class="form-control" name="biography" id="biography"></textarea>
              </div>
            </div>
          </div>

          <!-- Eighth row -->
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Doctor ID
                </label>
                <input type="text" placeholder="Doctor ID" class="form-control" name="doctor_id" id="doctor_id" readonly value="<?php echo time(); ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="add_photo_profile mt-2">
                <div class="photo_profile_place">
                  <img src="<?php echo e(asset('admin/adminimages/thumb.svg')); ?>" alt="image" id="preview-image" width="100px" height="100px">
                </div>
                <div class="add_pro_picture">
                  <h3>Add Photo Profile
                  </h3>
                  <span>jpg/png with size maximum 500kb
                  </span>
                  <label class="btn btn-light btn-sm" for="select_photo_file">Select Photo File
                  </label>
                  <input type="file" id="select_photo_file" accept="image/jpeg,image/jpg,image/png" />
                </div>
              </div>
            </div>
          </div>

          <!-- Lst row -->
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label>Username</label>
                <input type="text" placeholder="Akintude" class="form-control" name="doctor_username" id="doctor_username">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Password</label>
                <input type="password" placeholder="Password" class="form-control" name="doctor_password" id="doctor_password">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" placeholder="Confirm Password" class="form-control" name="confirmPassword" id="confirmPassword">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary mb-3 mt-3" name="button">Add Doctor
              </button>
            </div>
          </div>

          <input type="hidden" id="default_image" value="<?php echo e(asset('admin/adminimages/thumb.svg')); ?>">
        </form>

      </div>
    </div>
  </div>
</div>
<!-- Search Doctor -->
<div class="modal fade" id="search_doctor">
  <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width1">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Search Doctor</h3>
        <button type="button" id="search_emp_modal" class="close" data-dismiss="modal">
          <img src="<?php echo e(asset('admin/adminimages/popup_close.svg')); ?>" />
        </button>
      </div>
      <div class="modal-body plr-96">
        <form id="search_dr_form" name="search_dr_form">
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
              <button type="submit" class="btn btn-primary mb-3 mt-3" name="button">Search Doctor
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
<?php echo $__env->make('layouts.admin_dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>