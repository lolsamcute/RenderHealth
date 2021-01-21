<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
  <div class="row">
      <div class="col-12">
          <div class="page_head">
              <h1 class="heading">Manage Employee
                  <a data-toggle="modal" data-target="#add_employee" class="add_schedule" href="javascript:;" onclick="$('#empTitle,#submit_emp_btn').html('Add Employee')">
                      <img src="<?php echo e(asset('admin/adminimages/add.svg')); ?>" alt="icon">
                  </a>
              </h1>
              <button type="button" data-toggle="modal" data-target="#search_employee" class="btn btn-primary btn-sm">Search Employee</button>
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
              <div id="hostpital_appointment" class="tab-pane fade show active">
                  <div class="table_hospital pagination_fixed_bottom">
                      <div id="accordion" class="lookalike_table mb-4">
                          <div class="lookalike_table_head">
                              <ul>
                                  <li style="width:22%">Member Data</li>
                                  <li style="width:19%">Employee ID</li>
                                  <li style="width:9%">Role</li>
                                  <li style="width:13%">Phone Number</li>
                                  <li style="width:12%">Status</li>
                                  <li></li>
                              </ul>
                          </div>
                          <?php if(count($all_employees) > 0): ?>
                            <?php $__currentLoopData = $all_employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="lookalike_table_row">
                              <div class="lookalike_table_body" id="head_one<?php echo e($single_employee['employee_id']); ?>">
                                  <ul>
                                      <li style="width:22%">
                                          <div class="d_profile">
                                              <div class="d_pro_img">
                                                <?php if((file_exists(getcwd().'/employeeimages/'.basename($single_employee['employee_picture']))) && (!empty($single_employee['employee_picture']))){
                                      ?>
                                      <img src="<?php echo e(asset('/employeeimages/'.$single_employee['employee_picture'])); ?>" alt="image">
                                      <?php     }
                                      else { ?>
                                      <img src="<?php echo e(asset('admin/doctor/images/doc1.png')); ?>" alt="image">
                                      <?php   } ?>
                                                 
                                              </div>
                                              <div class="d_pro_text">
                                                  <h4>
                                                  <?php echo e($single_employee['employee_title']); ?> <?php echo e(ucfirst($single_employee['first_name'])); ?> <?php echo e($single_employee['last_name']); ?></h4>
                                                  <a href="javascript:;"><?php echo e($single_employee['employee_address']); ?></a>
                                              </div>
                                          </div>
                                      </li>
                                      <li style="width:19%">ID-Employee-<?php echo e($single_employee['employee_id']); ?></li>
                                      <li style="width:9%"><?php echo e($single_employee['employee_role']); ?></li>
                                      <li style="width:13%"><?php echo e($single_employee['employee_phone']); ?></li>
                                      <li style="width:12%">
                                        <span class="badge badge-pill <?php if($single_employee['active_status']==0) { echo 'badge-danger'; } elseif($single_employee['active_status']==1) { echo 'badge-success'; } ?>" id="status_row_<?php echo e($single_employee['employee_id']); ?>"><?php if($single_employee['active_status']==0){ echo 'Suspend';} else if($single_employee['active_status']==1){ echo 'Active User';}?></span>
                                      </li>
                                        
                                      <li>
                                          <button class="btn btn-light btn-xs" data-toggle="collapse" data-target="#accord_one<?php echo e($single_employee['employee_id']); ?>" aria-expanded="true" aria-controls="accord_one">
                                             <img class="icon" src="<?php echo e(asset('admin/adminimages/eye.svg')); ?>" alt="icon">Manage Access
                                          </button>
                                      </li>
                                  </ul>
                              </div>
                              <div id="accord_one<?php echo e($single_employee['employee_id']); ?>" class=" collapse" aria-labelledby="head_one<?php echo e($single_employee['employee_id']); ?>" data-parent="#accordion">
                                <form data-id="<?php echo e($single_employee['employee_id']); ?>" id="update_emp_details_<?php echo e($single_employee['employee_id']); ?>" name="update_emp_details_<?php echo e($single_employee['employee_id']); ?>" onsubmit="update_emp_details(this,event)">
                                      <input type="hidden" value="<?php echo e($single_employee['employee_id']); ?>" name="update_emp_id">
                                  <div class="lookalike_table_detail">
                                      <ul>
                                          <li class="wc-25">
                                              <div class="employee_table_record">
                                                  <h5>Access for Hospital</h5>
                                                  <div class="form-check">
                                                    <input value="1"  name="access_for_hospital[]" class="form-check-input form-check-custom" <?php if($single_employee['access_to_hospital']==1 || $single_employee['access_to_hospital']==3) echo 'checked'; ?> id="entry_patient<?php echo e($single_employee['employee_id']); ?>" type="checkbox"/>
                                                    <label class="form-check-label" for="entry_patient<?php echo e($single_employee['employee_id']); ?>">Entry Patient Data</label>
                                                  </div>

                                                  <div class="form-check">
                                                    <input value="2" name="access_for_hospital[]" class="form-check-input form-check-custom" <?php if($single_employee['access_to_hospital']==2 || $single_employee['access_to_hospital']==3) echo 'checked'; ?> id="access_hospital<?php echo e($single_employee['employee_id']); ?>" type="checkbox"/>
                                                    <label class="form-check-label" for="access_hospital<?php echo e($single_employee['employee_id']); ?>">Access Hospital Billings</label>
                                                  </div>
                                              </div>
                                          </li>
                                          <li class="wc-25">
                                              <div class="employee_table_record">
                                                  <h5>Access for Patient Record</h5>
                                                  <div class="form-check">
                                                    <input class="form-check-input form-check-custom" <?php if($single_employee['access_to_patient_record']==1) echo 'checked'; ?> name="entry_patient_record"  id="entry_patient_record<?php echo e($single_employee['employee_id']); ?>" type="radio" value="1"/>

                                                    <label class="form-check-label <?php if($single_employee['access_to_patient_record']==1) echo 'active'; ?>" for="entry_patient_record<?php echo e($single_employee['employee_id']); ?>">Access to Full Patient Record</label>
                                                  </div>

                                                  <div class="form-check">
                                                    <input class="form-check-input form-check-custom <?php if($single_employee['access_to_patient_record']==1) echo 'active'; ?>" <?php if($single_employee['access_to_patient_record']==2) echo 'checked'; ?> name="entry_patient_record"   id="limited_patient_record<?php echo e($single_employee['employee_id']); ?>" type="radio" value="2" />
                                                    <label class="form-check-label" for="limited_patient_record<?php echo e($single_employee['employee_id']); ?>">Limited Patient Record</label>
                                                  </div>

                                              </div>
                                          </li>
                                          <li class="wc-25">
                                              <div>
                                                  <div class="switch_acc mb-3">
                                                      <!-- Small switch -->
                                                      <div class="form-group mr-4 mb-0">
                                                        
                                                        <span class="switch switch-sm">

                                                          <input type="checkbox" <?php if($single_employee['active_status']==1) echo 'checked'; ?> class="switch" id="switch-sm3<?php echo e($single_employee['employee_id']); ?>" name="active_status_emp" name="active_status_emp" onclick="getselectedtext(this)" >          
                                                          <label for="switch-sm3<?php echo e($single_employee['employee_id']); ?>"><?php if($single_employee['active_status']==1): ?>Deactive User <?php else: ?> Active User <?php endif; ?></label>

                                                        </span>

                                                      </div>

                                                      <div class="view_acc" onclick="view_emp(<?php echo $single_employee['employee_id'];?>)">
                                                         <a href="javascript:;"><img src="<?php echo e(asset('admin/adminimages/eye.svg')); ?>" alt="icon">View </a>
                                                      </div>&nbsp;&nbsp;&nbsp;
                                                      <div class="edit_acc" onclick="$('#top').html('');edit_emp(<?php echo $single_employee['employee_id'];?>)">
                                                        <a href="javascript:;"><img src="<?php echo e(asset('admin/doctor/images/btn-edit.svg')); ?>" alt="icon">Edit </a>
                                                    </div>&nbsp;&nbsp;&nbsp;
                                                      <div class="remove_acc" onclick="remove_emp(<?php echo $single_employee['employee_id'];?>)">
                                                          <a href="javascript:;"><img src="<?php echo e(asset('admin/adminimages/delete.svg')); ?>" alt="icon">Remove </a>
                                                      </div>
                                                      
                                                    </div>
                                                  
                                                  <div class="access_patient_other_options">
                                                    <button type="button" class="btn btn-light btn-xs mr-2" data-toggle="collapse" data-target="#accord_one<?php echo e($single_employee['employee_id']); ?>" aria-expanded="true" aria-controls="accord_one" name="button">Cancel</button>
                                                    <button type="submit" class="btn btn-blue btn-xs" name="button">Save</button>
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
                              No Employee Found
                            <?php endif; ?> 
                      </div>
                      <div class="table_pagination">
                       <button type="button" class="btn btn-light btn-xs pre_emp" <?php if($all_employees->previousPageUrl()){  } else{ echo "disabled"; } ?> data-url="<?php echo $all_employees->previousPageUrl(); ?>&type=emp_page">Previous Page</button>
                       <input type="hidden" class="emp_page_hidden" value="<?php echo e($all_employees->currentPage()); ?>">
                       <span>Page <?php echo e($all_employees->currentPage()); ?> of <?php echo e($all_employees->lastPage()); ?> Pages</span>
                       <button type="button" class="btn btn-light btn-xs next_emp"  <?php if($all_employees->nextPageUrl()){  } else{ echo "disabled"; } ?>  data-url="<?php echo $all_employees->nextPageUrl(); ?>&type=emp_page">Next Page</button>
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

<!-- Add employee screen -->
<div class="modal fade" id="add_employee">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width3">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="empTitle">Add Employee</h3>
                <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(asset('admin/adminimages/popup_close.svg')); ?>"/></button>
            </div>
            <div class="modal-body">
              <div class="alert alert-danger-outline alert-danger-outline-addemp alert-dismissible alert_icon fade show" role="alert" style="display: none;">
                <div class="d-flex align-items-center">
                    <div class="alert-icon-col">
                        <span class="fa fa-warning"></span>
                    </div>
                    <div class="alert_text addemp_danger_pop">
                        
                    </div>
                    <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                </div>
              </div>
              <div class="alert alert-success-outline alert-success-outline-addemp alert-dismissible alert_icon fade show" role="alert" style="display: none;"> 
                <div class="d-flex align-items-center">
                    <div class="alert-icon-col">
                        <span class="fa fa-check"></span>
                    </div>
                    <div class="alert_text addemp_success_pop">
                        
                    </div>
                    <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                </div>
              </div>
              <form id="add_emp_form" name="add_emp_form" enctype="multipart/form-data">

              <Input type="hidden" readonly class="form-control" name="employee_id" id="employee_id" />
                <Input type="hidden" readonly class="form-control" name="mode" id="mode" value="ADD" />
                <div class="row">
                    <div class="col-sm-12">
                    <div class="form-group">
                        <label>Title</label>
                        <div class="select_box width220">
                        <select class="form-control" name="employee_title" id="employee_title">
                            <option value="" selected>Select Title</option>
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
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" placeholder="First Name" class="form-control"  name="first_name" id="first_name">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" placeholder="Middle Name" class="form-control"  name="middle_name" id="middle_name">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" placeholder="Surname" class="form-control"  name="surname" id="surname">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" placeholder="Email Address" class="form-control"  name="employee_email" id="employee_email">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" placeholder="Phone Number" maxlength="15" class="form-control"  name="employee_phone" id="employee_phone">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Alternative Number</label>
                            <input type="text" placeholder="Alternative Number" maxlength="15" class="form-control"  name="employee_alternative_phone" id="employee_alternative_phone">
                        </div>
                    </div>
                    <!-- <div class="col-sm-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" placeholder="Username" class="form-control"  name="username" id="username">
                        </div>
                    </div> -->
                    <div class="col-sm-12" id="passwordDIV">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" placeholder="Password" class="form-control"  name="password" id="password">
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input  type="text" placeholder="Example : Adamawa, Nigeria" class="form-control" name="emp_address" id="emp_address">
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-6">
                        <div class="form-group">
                            <label>State</label>
                            <div class="select_box">
                                <select class="form-control" name="employee_state" id="hospital_state_nigeria">
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
                            <label>City</label>
                            <input type="text" placeholder="City" class="form-control" id="employee_city" name="employee_city">
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-2">
                    <label>Date Of Birth</label>
                    <div class="select_box">
                        <select id="select_num" class="form-control" name="day" style="background-color: #fff;">  
                            <option value="">Select Day</option>                                
                        <?php for($i=1;$i<=31;$i++){ 
                        echo '<option value="'.$i.'">'.$i.'</option>';
                        }   ?>
                        </select>
                    </div>
                </div>
                <div class="col-2 px-0">
                <label>&nbsp;</label>
                    <div class="select_box">
                        <select id="select_day" class="form-control" name="month"  style="background-color: #fff;">               <option value="">Select Month</option>                   
                            <?php  for ($m=1; $m<=12; $m++) {
                                $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
                                echo '<option value="'.$month.'">'.$month.'</option>';
                                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                <label>&nbsp;</label>
                    <div class="select_box">
                        <select class="form-control" id="year" name="years"  style="background-color: #fff;">
                            <option value="">Select Year</option> 
                            <?php  
                            $date = date('Y');
                            $new_date =$date-12;
                            $range = 1900;
                            for($i=$range;$i<=$new_date; $i++){
                                $year = $range++;                                                                        
                            ?>
                                <option id="year_get" value="<?php echo e($year); ?>" ><?php echo e($year); ?></option>
                            <?php
                            }
                            ?>    
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                
                <label>Gender</label>
                    <div class="form-group">
                    <div class="select_box width220">
                        <select class="form-control" name="emp_gender" id="emp_gender">
                        <option value="1">Female</option>
                        <option value="0">Male</option>
                        </select>
                    </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label>Marital Status</label>
                    <div class="doctor_table_record">
                        <select class="form-control" name="emp_marital_status" id="emp_marital_status">
                            <option value="1">Married</option>
                            <option value="0">Single</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="row">
              <div class="col-12">
                  <div class="form-group">
                      <label>Language</label>
                      <div class="select_box1 mb-2">
                          <input type="text" id="doctor_languages" class="form-control employee_languages" name="employee_languages" value="" id="employee_languages">
                      </div>
                      <div class="input_tags">
                          <ul id="top">
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-12">
                  <div class="form-group">
                      <label>Education School</label>
                      <div class="select_box1 mb-2">
                      <input type="text" placeholder="" class="form-control"  name="employee_education_school" id="employee_education_school">
                      </div>
                      
                  </div>
              </div>
          </div>
                <div class="row">
                    <div class="col-sm-6">
                            <div class="form-group">
                                <label>State Of Origin</label>
                                <input type="text" placeholder="State Of Origin" class="form-control"  name="state_of_origin" id="state_of_origin">
                            </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Position</label>
                            <input type="text" placeholder="Position" class="form-control"  name="position" id="position">
                        </div>
                    </div>
                </div>
                <strong><h3>Next of Kin</h3></strong>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" placeholder="First Name" class="form-control"  name="nextofkin_first_name" id="nextofkin_first_name">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" placeholder="Surname" class="form-control"  name="nextofkin_surname" id="nextofkin_surname">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" placeholder="Phone Number" maxlength="15" class="form-control"  name="nextofkin_phone" id="nextofkin_phone">
                        </div>
                    </div>
                </div>
                <strong><h3>Reference</h3></strong>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" placeholder="First Name" class="form-control"  name="reference_first_name" id="reference_first_name">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" placeholder="Surname" class="form-control"  name="reference_surname" id="reference_surname">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" placeholder="Phone Number" maxlength="15" class="form-control"  name="reference_phone" id="reference_phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" placeholder="First Name" class="form-control"  name="reference2_first_name" id="reference2_first_name">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" placeholder="Surname" class="form-control"  name="reference2_surname" id="reference2_surname">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" placeholder="Phone Number" maxlength="15" class="form-control"  name="reference2_phone" id="reference2_phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input type="text" placeholder="Employee ID" class="form-control"  name="emp_id" id="emp_id" readonly value="<?php echo time();?>">
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Role</label>
                            <div class="select_box">
                                <select class="form-control" name="emp_role" id="emp_role" >
                                    <option value="Administration Staff">Administration Staff</option>
                                    <option value="Cashier">Cashier</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Status User</label>
                            <div class="select_box width220">
                                <select class="form-control" name="emp_status" id="emp_status" >
                                    <option value="1">Active </option>
                                    <option value="0">Not Active</option>
                                 </select>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-sm-6">
                        <div class="employee_table_record mt-2">
                            <h5>Access for Hospital</h5>
                            <div class="form-check">
                                <input class="form-check-input form-check-custom" name="access_for_hospital[]"  value="1" id="entry_patient_data" type="checkbox"/>
                                <label class="form-check-label" for="entry_patient_data">Entry Patient Data</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-custom" id="access_hospital_billings" name="access_for_hospital[]"  value="2" type="checkbox"/>
                                <label class="form-check-label" for="access_hospital_billings">Access Hospital Billings</label>
                            </div>
                        </div>
                        <div class="employee_table_record mt-4">
                            <h5>Access for Patient Record</h5>
                            <div class="form-check">
                                <input class="form-check-input form-check-custom" name="entry_patient_record" id="access_entry_patient_record" type="radio" value="1"/>
                                <label class="form-check-label" for="access_entry_patient_record">Access to Full Patient Record</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-custom" name="entry_patient_record" id="limited_patient_records" type="radio" value="2"/>
                                <label class="form-check-label" for="limited_patient_records">Limited Patient Record</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                         <div class="add_photo_profile mt-2">
                             <div class="photo_profile_place">
                                 <img src="<?php echo e(asset('admin/adminimages/thumb.svg')); ?>" alt="image" id="preview-image" width="100px" height="100px">
                             </div>
                             <div class="add_pro_picture">
                                 <h3>Add Photo Profile</h3>
                                 <span>jpg/png with size maximum 500kb</span>
                                 <label class="btn btn-light btn-sm" for="select_photo_file">Select Photo File</label>
                                 <input type="file" id="select_photo_file" accept="image/jpeg,image/jpg,image/png"/>
                             </div>
                         </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mb-3 mt-3" name="button" id="submit_emp_btn">Add Employee</button>
                    </div>
                </div>
                <input type="hidden" id="default_image" value="<?php echo e(asset('admin/adminimages/thumb.svg')); ?>">
              </form>
            </div>
        </div>
    </div>
</div>


<!-- Search Employee -->
<div class="modal fade" id="search_employee">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width1">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Search Employee</h3>
                <button type="button" id="search_emp_modal" class="close" data-dismiss="modal"><img src="<?php echo e(asset('admin/adminimages/popup_close.svg')); ?>"/></button>
            </div>
            <div class="modal-body plr-96">
              <form id="search_emp_form" name="search_emp_form">
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
                        <button type="submit" class="btn btn-primary mb-3 mt-3" name="button">Search Employee</button>
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