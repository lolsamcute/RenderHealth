<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
  <div class="row">
    <div class="col-12">
      <div class="page_head">
        <!-- <h1 class="heading invisible">Medical Record</h1> -->
        <div>
          <form name="serach_data_form" id="serach_data_form">
            <input type="search" id="search_data" name="search_data" class="form-control form-control-sm" rows="20" placeholder="Search Data">
          </form>
        </div>
        <div class="appointment_type">
          <ul class="nav nav-pills" role="tablist">
            <li><a class="active" role="tab" data-toggle="pill" href="#doctors">Doctors</a></li>
            <li><a role="tab" data-toggle="pill" href="#Nurses">Nurses</a></li>
            <li><a role="tab" data-toggle="pill" href="#Administrator">Administrator</a></li>

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
        <div id="doctors" class="tab-pane fade show active">
          <div class="table-responsive">
            <div class="table_hospital pagination_fixed_bottom">
              <div id="accordion" class="lookalike_table mb-4">
                <div class="lookalike_table_head">
                  <ul>
                    <li style="width:22%">Member Datas</li>
                    <li style="width:19%">Doctor ID</li>
                    <li style="width:9%">Role</li>
                    <li style="width:13%">Phone Number</li>
                    <li style="width:12%">Status</li>
                    <li></li>
                  </ul>
                </div>
                <?php if(count($hospital_doctors) > 0): ?>
                <?php $__currentLoopData = $hospital_doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital_doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="lookalike_table_row">
                  <div class="lookalike_table_body" id="head_one<?php echo e($hospital_doctor['doctor_id']); ?>">
                    <ul>
                      <li style="width:22%">
                        <div class="d_profile">
                          <div class="d_pro_img">
                            <?php
                            if(!empty($hospital_doctor['doctor_picture'])){
                            if(file_exists(getcwd().'/doctorimages/'.$hospital_doctor['doctor_picture'])){?>
                            <img src="<?php echo e(asset('/doctorimages/'.$hospital_doctor['doctor_picture'])); ?>" alt="image">
                            <?php }
                            else { ?>
                            <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                            <?php } }
                            else { ?>
                            <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                            <?php } ?>

                          </div>
                          <div class="d_pro_text">
                            <h4>
                              

                            <?php echo e($hospital_doctor['doctor_title']); ?> <?php echo e($hospital_doctor['doctor_first_name']); ?> <?php echo e($hospital_doctor['doctor_last_name']); ?></h4>
                            <a href="javascript:;"><?php echo e($hospital_doctor['doctor_state']); ?>, <?php echo e($hospital_doctor['doctor_country']); ?></a>
                          </div>
                        </div>
                      </li>
                      <li style="width:19%">ID-<?php echo e($hospital_doctor['doctor_id']); ?></li>
                      <li style="width:9%">Doctor</li>
                      <li style="width:13%"><?php echo e($hospital_doctor['doctor_phone']); ?></li>
                      <li style="width:12%">

                        <span class="badge badge-pill <?php if ($hospital_doctor['active_status'] == 0) {
                                                        echo 'badge-danger';
                                                      } elseif ($hospital_doctor['active_status'] == 1) {
                                                        echo 'badge-success';
                                                      } ?>" id="status_row_<?php echo e($hospital_doctor['doctor_id']); ?>"><?php if ($hospital_doctor['active_status'] == 0) {
                                                                                                                echo 'Suspend';
                                                                                                              } else if ($hospital_doctor['active_status'] == 1) {
                                                                                                                echo 'Active User';
                                                                                                              } ?></span>

                      </li>
                      <li>
                        <button class="btn btn-light btn-xs" data-toggle="collapse" data-target="#accord_one<?php echo e($hospital_doctor['doctor_id']); ?>" aria-expanded="true" aria-controls="accord_one<?php echo e($hospital_doctor['doctor_id']); ?>">
                          <img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">Manage Access
                        </button>
                      </li>
                    </ul>
                  </div>
                  <div id="accord_one<?php echo e($hospital_doctor['doctor_id']); ?>" class=" collapse" aria-labelledby="head_one<?php echo e($hospital_doctor['doctor_id']); ?>" data-parent="#accordion">
                    <form data-id="<?php echo e($hospital_doctor['doctor_id']); ?>" id="update_doctor_details_<?php echo e($hospital_doctor['doctor_id']); ?>" name="update_doctor_details_<?php echo e($hospital_doctor['doctor_id']); ?>" onsubmit="update_doctor_details(this,event)">
                      <input type="hidden" value="<?php echo e($hospital_doctor['doctor_id']); ?>" name="update_doctor_id">
                      <div class="lookalike_table_detail">
                        <ul>
                          <li class="wc-25 ">
                            <div class="employee_table_record">
                              <h5>Doctor Access</h5>
                              <div class="form-check">
                                <input value="1" name="appointment_access" class="form-check-input form-check-custom"  id="appointment<?php echo e($hospital_doctor['doctor_id']); ?>" type="checkbox"  <?php echo $hospital_doctor['appointment_access']==1 ?'checked':''; ?> />
                                <label class="form-check-label" for="appointment<?php echo e($hospital_doctor['doctor_id']); ?>">Appointment</label>
                              </div>
                              <div class="form-check">
                                <input value="2" name="patient_queue_access" class="form-check-input form-check-custom"  id="patient_queue<?php echo e($hospital_doctor['doctor_id']); ?>" type="checkbox"  <?php echo $hospital_doctor['patient_queue_access']==1 ?'checked':''; ?> />
                                <label class="form-check-label" for="patient_queue<?php echo e($hospital_doctor['doctor_id']); ?>">Patient Queue</label>
                              </div>
                              <div class="form-check">
                                <input value="3" name="health_record_access" class="form-check-input form-check-custom"  id="health_record<?php echo e($hospital_doctor['doctor_id']); ?>" type="checkbox"  <?php echo $hospital_doctor['health_record_access']==1 ?'checked':''; ?> />
                                <label class="form-check-label" for="health_record<?php echo e($hospital_doctor['doctor_id']); ?>">Health Record</label>
                              </div>
                              <!-- <div class="form-check">
                                <input value="1" name="access_for_hospital[]" class="form-check-input form-check-custom" <?php if ($hospital_doctor['access_to_hospital'] == 1 || $hospital_doctor['access_to_hospital'] == 3) echo 'checked'; ?> id="entry_patient<?php echo e($hospital_doctor['doctor_id']); ?>" type="checkbox" />
                                <label class="form-check-label" for="entry_patient<?php echo e($hospital_doctor['doctor_id']); ?>">Entry Patient Data</label>
                              </div>
                              <div class="form-check">
                                <input value="2" name="access_for_hospital[]" class="form-check-input form-check-custom" <?php if ($hospital_doctor['access_to_hospital'] == 2 || $hospital_doctor['access_to_hospital'] == 3) echo 'checked'; ?> id="access_hospital<?php echo e($hospital_doctor['doctor_id']); ?>" type="checkbox" />
                                <label class="form-check-label" for="access_hospital<?php echo e($hospital_doctor['doctor_id']); ?>">Access Hospital Billings</label>
                              </div> -->
                            </div>
                            
                          </li>
                          <li class="wc-25">
                          <div class="employee_table_record ">
                              <h5>&nbsp;</h5>
                              <div class="form-check">
                                <input value="4" name="billings_access" class="form-check-input form-check-custom"  id="billings<?php echo e($hospital_doctor['doctor_id']); ?>" type="checkbox" <?php echo $hospital_doctor['billings_access']==1 ?'checked':''; ?> />
                                <label class="form-check-label" for="billings<?php echo e($hospital_doctor['doctor_id']); ?>">Billings</label>
                              </div>
                              <div class="form-check">
                                <input value="5" name="teleconsulation_access" class="form-check-input form-check-custom"  id="teleconsulation<?php echo e($hospital_doctor['doctor_id']); ?>" type="checkbox"  <?php echo $hospital_doctor['teleconsulation_access']==1 ?'checked':''; ?> />
                                <label class="form-check-label" for="teleconsulation<?php echo e($hospital_doctor['doctor_id']); ?>">Teleconsulation</label>
                              </div>
                              <div class="form-check">
                                <input value="6" name="inventory_management_access" class="form-check-input form-check-custom"  id="inventory_management<?php echo e($hospital_doctor['doctor_id']); ?>" type="checkbox" <?php echo $hospital_doctor['inventory_management_access']==1 ?'checked':''; ?> />
                                <label class="form-check-label" for="inventory_management<?php echo e($hospital_doctor['doctor_id']); ?>">Inventory Management</label>
                              </div>
                              <!-- <div class="form-check">
                                <input value="1" name="access_for_hospital[]" class="form-check-input form-check-custom" <?php if ($hospital_doctor['access_to_hospital'] == 1 || $hospital_doctor['access_to_hospital'] == 3) echo 'checked'; ?> id="entry_patient<?php echo e($hospital_doctor['doctor_id']); ?>" type="checkbox" />
                                <label class="form-check-label" for="entry_patient<?php echo e($hospital_doctor['doctor_id']); ?>">Entry Patient Data</label>
                              </div>
                              <div class="form-check">
                                <input value="2" name="access_for_hospital[]" class="form-check-input form-check-custom" <?php if ($hospital_doctor['access_to_hospital'] == 2 || $hospital_doctor['access_to_hospital'] == 3) echo 'checked'; ?> id="access_hospital<?php echo e($hospital_doctor['doctor_id']); ?>" type="checkbox" />
                                <label class="form-check-label" for="access_hospital<?php echo e($hospital_doctor['doctor_id']); ?>">Access Hospital Billings</label>
                              </div> -->
                            </div>
                          </li>
                          <!-- <li class="wc-25">
                            <div class="employee_table_record">
                              <h5>Access for Patient Record</h5>
                              <div class="form-check">
                                <input class="form-check-input form-check-custom" <?php if ($hospital_doctor['access_to_patient_record'] == 1) echo 'checked'; ?> name="entry_patient_record" id="entry_patient_record<?php echo e($hospital_doctor['doctor_id']); ?>" type="radio" value="1" />

                                <label class="form-check-label <?php if ($hospital_doctor['access_to_patient_record'] == 1) echo 'active'; ?>" for="entry_patient_record<?php echo e($hospital_doctor['doctor_id']); ?>">Access to Full Patient Record</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input form-check-custom <?php if ($hospital_doctor['access_to_patient_record'] == 1) echo 'active'; ?>" <?php if ($hospital_doctor['access_to_patient_record'] == 2) echo 'checked'; ?> name="entry_patient_record" id="limited_patient_record<?php echo e($hospital_doctor['doctor_id']); ?>" type="radio" value="2" />
                                <label class="form-check-label" for="limited_patient_record<?php echo e($hospital_doctor['doctor_id']); ?>">Limited Patient Record</label>
                              </div>
                            </div>
                          </li> -->
                          <li class="wc-50">
                            <div>
                              <div class="switch_acc mb-3">
                                <!-- Small switch -->
                                <div class="form-group mr-4 mb-0">
                                  <span class="switch switch-sm">

                                    <input type="checkbox" <?php if ($hospital_doctor['active_status'] == 1) echo 'checked'; ?> class="switch" id="switch-sm3<?php echo e($hospital_doctor['doctor_id']); ?>" name="active_status_doc" onclick="getselectedtext(this)">

                                    <label for="switch-sm3<?php echo e($hospital_doctor['doctor_id']); ?>"><?php if($hospital_doctor['active_status']==1): ?>Deactive User <?php else: ?> Active User <?php endif; ?></label>
                                  </span>
                                </div>
                                <div class="remove_acc">
                                  <a href="javascript:;" onclick="remove_doctor(<?php echo $hospital_doctor['doctor_id']; ?>)"><img src="<?php echo e(asset('admin/doctor/images/delete.svg')); ?>" alt="icon">Remove account</a>
                                  <a href="javascript:;" onclick="$('#top').html('');editProfile(<?php echo $hospital_doctor['doctor_id']; ?>,'doctor')"><img src="<?php echo e(asset('admin/doctor/images/delete.svg')); ?>" alt="icon">Edit account</a>
                                  <a href="javascript:;" onclick="viewProfile(<?php echo $hospital_doctor['doctor_id']; ?>,'doctor')"><img src="<?php echo e(asset('admin/doctor/images/delete.svg')); ?>" alt="icon">View account</a>
                                </div>
                              </div>
                              <div class="access_patient_other_options">
                                <button type="button" class="btn btn-light btn-xs mr-2" data-toggle="collapse" data-target="#accord_one<?php echo e($hospital_doctor['doctor_id']); ?>" aria-expanded="true" aria-controls="accord_one" name="button">Cancel</button>
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

                No Doctors Found

                <?php endif; ?>

              </div>
              <div class="table_pagination">
                <button type="button" class="btn btn-light btn-xs pre_docs" <?php if ($hospital_doctors->previousPageUrl()) {
                                                                            } else {
                                                                              echo "disabled";
                                                                            } ?> data-url="<?php echo $hospital_doctors->previousPageUrl(); ?>&type=doc_page">Previous Page</button>
                <input type="hidden" class="doc_page_hidden" value="<?php echo e($hospital_doctors->currentPage()); ?>">
                <span>Page <?php echo e($hospital_doctors->currentPage()); ?> of <?php echo e($hospital_doctors->lastPage()); ?> Pages</span>
                <button type="button" class="btn btn-light btn-xs next_docs" <?php if ($hospital_doctors->nextPageUrl()) {
                                                                              } else {
                                                                                echo "disabled";
                                                                              } ?> data-url="<?php echo $hospital_doctors->nextPageUrl(); ?>&type=doc_page">Next Page</button>
              </div>
            </div>
          </div>
        </div>
        <div id="Nurses" class="tab-pane fade">
          <div class="table_hospital pagination_fixed_bottom">
            <div class="table-responsive">
              <div id="accordion" class="lookalike_table mb-4">
                <div class="lookalike_table_head">
                  <ul>
                    <li style="width:22%">Member Data</li>
                    <li style="width:19%">Nurse ID</li>
                    <li style="width:9%">Role</li>
                    <li style="width:13%">Phone Number</li>
                    <li style="width:12%">Status</li>
                    <li></li>
                  </ul>
                </div>
                <?php if(count($hospital_nurses) > 0): ?>
                <?php $__currentLoopData = $hospital_nurses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_nurse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="lookalike_table_row">
                  <div class="lookalike_table_body" id="head_one<?php echo e($single_nurse['nurse_id']); ?>">
                    <ul>
                      <li style="width:22%">
                        <div class="d_profile">
                          <div class="d_pro_img">
                            <?php if(!empty($single_nurse['nurse_picture'])){
                            if(file_exists(getcwd().'/nurseimages/'.$single_nurse['nurse_picture'])){
                            ?>
                            <img src="<?php echo e(asset('/nurseimages/'.$single_nurse['nurse_picture'])); ?>" alt="image">
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
                            <h4> <?php echo e($single_nurse['nurse_title']); ?>

                              <?php echo e($single_nurse['nurse_first_name']); ?> <?php echo e($single_nurse['nurse_last_name']); ?></h4>
                            <a href="javascript:;"><?php echo e($single_nurse['nurse_state']); ?>, <?php echo e($single_nurse['nurse_country']); ?></a>
                          </div>
                        </div>
                      </li>
                      <li style="width:19%">ID-<?php echo e($single_nurse['nurse_id']); ?></li>
                      <li style="width:9%">Nurse</li>
                      <li style="width:13%"><?php echo e($single_nurse['nurse_phone']); ?></li>
                      <li style="width:12%">

                        <span class="badge badge-pill <?php if ($single_nurse['active_status'] == 0) {
                                                        echo 'badge-danger';
                                                      } elseif ($single_nurse['active_status'] == 1) {
                                                        echo 'badge-success';
                                                      } ?>" id="status_row_<?php echo e($single_nurse['nurse_id']); ?>"><?php if ($single_nurse['active_status'] == 0) {
                                                                                                            echo 'Suspend';
                                                                                                          } else if ($single_nurse['active_status'] == 1) {
                                                                                                            echo 'Active User';
                                                                                                          } ?></span>

                      </li>
                      <li>
                        <button class="btn btn-light btn-xs" data-toggle="collapse" data-target="#accord_one<?php echo e($single_nurse['nurse_id']); ?>" aria-expanded="true" aria-controls="accord_one<?php echo e($single_nurse['nurse_id']); ?>">
                          <img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">Manage Access
                        </button>
                      </li>
                    </ul>
                  </div>
                  <div id="accord_one<?php echo e($single_nurse['nurse_id']); ?>" class=" collapse" aria-labelledby="head_one<?php echo e($single_nurse['nurse_id']); ?>" data-parent="#accordion">
                    <form data-id="<?php echo e($single_nurse['nurse_id']); ?>" id="update_nurse_details_<?php echo e($single_nurse['nurse_id']); ?>" name="update_nurse_details_<?php echo e($single_nurse['nurse_id']); ?>" onsubmit="update_nurse_details(this,event)">
                      <input type="hidden" value="<?php echo e($single_nurse['nurse_id']); ?>" name="update_nurse_id">
                      <div class="lookalike_table_detail">
                        <ul>
                          <li class="wc-25">
                            <div class="employee_table_record">
                              <h5>Access for Hospital</h5>
                              <div class="form-check">
                                <input value="1" name="access_for_hospital[]" class="form-check-input form-check-custom" <?php if ($single_nurse['access_to_hospital'] == 1 || $single_nurse['access_to_hospital'] == 3) echo 'checked'; ?> id="entry_patient<?php echo e($single_nurse['nurse_id']); ?>" type="checkbox" />
                                <label class="form-check-label" for="entry_patient<?php echo e($single_nurse['nurse_id']); ?>">Entry Patient Data</label>
                              </div>
                              <div class="form-check">
                                <input value="2" name="access_for_hospital[]" class="form-check-input form-check-custom" <?php if ($single_nurse['access_to_hospital'] == 2 || $single_nurse['access_to_hospital'] == 3) echo 'checked'; ?> id="access_hospital<?php echo e($single_nurse['nurse_id']); ?>" type="checkbox" />
                                <label class="form-check-label" for="access_hospital<?php echo e($single_nurse['nurse_id']); ?>">Access Hospital Billings</label>
                              </div>
                            </div>
                          </li>
                          <li class="wc-25">
                            <div class="employee_table_record">
                              <h5>Access for Patient Record</h5>
                              <div class="form-check">
                                <input class="form-check-input form-check-custom" <?php if ($single_nurse['access_to_patient_record'] == 1) echo 'checked'; ?> name="entry_patient_record" id="entry_patient_record<?php echo e($single_nurse['nurse_id']); ?>" type="radio" value="1" />

                                <label class="form-check-label <?php if ($single_nurse['access_to_patient_record'] == 1) echo 'active'; ?>" for="entry_patient_record<?php echo e($single_nurse['nurse_id']); ?>">Access to Full Patient Record</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input form-check-custom <?php if ($single_nurse['access_to_patient_record'] == 1) echo 'active'; ?>" <?php if ($single_nurse['access_to_patient_record'] == 2) echo 'checked'; ?> name="entry_patient_record" id="limited_patient_record<?php echo e($single_nurse['nurse_id']); ?>" type="radio" value="2" />
                                <label class="form-check-label" for="limited_patient_record<?php echo e($single_nurse['nurse_id']); ?>">Limited Patient Record</label>
                              </div>
                            </div>
                          </li>
                          <li class="wc-50">
                            <div>
                              <div class="switch_acc mb-3">
                                <!-- Small switch -->
                                <div class="form-group mr-4 mb-0">
                                  <span class="switch switch-sm">

                                    <input type="checkbox" <?php if ($single_nurse['active_status'] == 1) echo 'checked'; ?> class="switch" id="switch-sm3<?php echo e($single_nurse['nurse_id']); ?>" name="active_status_nurse">

                                    <label for="switch-sm3<?php echo e($single_nurse['nurse_id']); ?>"><?php if($single_nurse['active_status']==1): ?>Deactive User <?php else: ?> Active User <?php endif; ?></label>
                                  </span>
                                </div>
                                <div class="remove_acc">
                                  <a href="javascript:;" onclick="remove_nurse(<?php echo $single_nurse['nurse_id']; ?>)"><img src="<?php echo e(asset('admin/doctor/images/delete.svg')); ?>" alt="icon">Remove account</a>
                                  <a href="javascript:;" onclick="$('.master_top').html('');editProfile(<?php echo $single_nurse['nurse_id']; ?>,'nurse')"><img src="<?php echo e(asset('admin/doctor/images/delete.svg')); ?>" alt="icon">Edit account</a>
                                  <a href="javascript:;" onclick="viewProfile(<?php echo $single_nurse['nurse_id']; ?>,'nurse')"><img src="<?php echo e(asset('admin/doctor/images/delete.svg')); ?>" alt="icon">View account</a>
                                </div>
                              </div>
                              <div class="access_patient_other_options">
                                <button type="button" class="btn btn-light btn-xs mr-2" data-toggle="collapse" data-target="#accord_one<?php echo e($single_nurse['nurse_id']); ?>" aria-expanded="true" aria-controls="accord_one" name="button">Cancel</button>
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

                No Nurses Found

                <?php endif; ?>
              </div>
            </div>
            <div class="table_pagination">
              <button type="button" class="btn btn-light btn-xs pre_docs" <?php if ($hospital_nurses->previousPageUrl()) {
                                                                          } else {
                                                                            echo "disabled";
                                                                          } ?> data-url="<?php echo $hospital_nurses->previousPageUrl(); ?>&type=doc_page">Previous Page</button>
              <input type="hidden" class="doc_page_hidden" value="<?php echo e($hospital_nurses->currentPage()); ?>">
              <span>Page <?php echo e($hospital_nurses->currentPage()); ?> of <?php echo e($hospital_nurses->lastPage()); ?> Pages</span>
              <button type="button" class="btn btn-light btn-xs next_docs" <?php if ($hospital_nurses->nextPageUrl()) {
                                                                            } else {
                                                                              echo "disabled";
                                                                            } ?> data-url="<?php echo $hospital_nurses->nextPageUrl(); ?>&type=doc_page">Next Page</button>
            </div>

          </div>
        </div>
        <div id="Administrator" class="tab-pane fade">
          <div class="table_hospital pagination_fixed_bottom">
            <div class="table-responsive">
              <div id="accordion" class="lookalike_table mb-4">
                <div class="lookalike_table_head">
                  <ul>
                    <li style="width:22%">Member Data</li>
                    <li style="width:19%">Admin ID</li>
                    <li style="width:9%">Role</li>
                    <li style="width:13%">Phone Number</li>
                    <li style="width:12%">Status</li>
                    <li></li>
                  </ul>
                </div>
                <?php echo e($hospital_admins); ?>

                <?php if(count($hospital_admins) > 0): ?>
                <?php $__currentLoopData = $hospital_admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="lookalike_table_row">
                  <div class="lookalike_table_body" id="head_one<?php echo e($single_admin['admin_id']); ?>">
                    <ul>
                      <li style="width:22%">
                        <div class="d_profile">
                          <div class="d_pro_img">
                            <?php if(!empty($single_admin['administrator_picture'])){
                            if(file_exists(getcwd().'/administratorimages/'.$single_admin['administrator_picture'])){
                            ?>
                            <img src="<?php echo e(asset('/administratorimages/'.$single_admin['administrator_picture'])); ?>" alt="image">
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
                            <h4><?php if($single_admin['administrator_gender'] === 0): ?> Mr.
                              <?php elseif($single_admin['administrator_gender']== 1 && $single_admin['administrator_marital_status']== 1): ?>Mrs
                              <?php elseif($single_admin['administrator_gender']== 1): ?> Miss
                              <?php endif; ?>

                              <?php echo e($single_admin['administrator_name']); ?></h4>
                            <a href="javascript:;"><?php echo e($single_admin['administrator_state']); ?>, <?php echo e($single_admin['administrator_country']); ?></a>
                          </div>
                        </div>
                      </li>
                      <li style="width:19%">ID-<?php echo e($single_admin['admin_id']); ?></li>
                      <li style="width:9%">Administrator</li>
                      <li style="width:13%"><?php echo e($single_admin['administrator_phone']); ?></li>
                      <li style="width:12%">

                        <span class="badge badge-pill <?php if ($single_admin['pending_status'] == 0) {
                                                        echo 'badge-danger';
                                                      } elseif ($single_admin['pending_status'] == 1) {
                                                        echo 'badge-success';
                                                      } ?>" id="status_row_<?php echo e($single_admin['admin_id']); ?>"><?php if ($single_admin['pending_status'] == 0) {
                                                                                                            echo 'Suspend';
                                                                                                          } else if ($single_admin['pending_status'] == 1) {
                                                                                                            echo 'Active User';
                                                                                                          } ?></span>

                      </li>
                      <li>
                        <button class="btn btn-light btn-xs" data-toggle="collapse" data-target="#accord_one<?php echo e($single_admin['admin_id']); ?>" aria-expanded="true" aria-controls="accord_one<?php echo e($single_admin['admin_id']); ?>">
                          <img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">Manage Access
                        </button>
                      </li>
                    </ul>
                  </div>
                  <div id="accord_one<?php echo e($single_admin['admin_id']); ?>" class=" collapse" aria-labelledby="head_one<?php echo e($single_admin['admin_id']); ?>" data-parent="#accordion">
                    <form data-id="<?php echo e($single_admin['admin_id']); ?>" id="update_admin_details_<?php echo e($single_admin['admin_id']); ?>" name="update_admin_details_<?php echo e($single_admin['admin_id']); ?>" onsubmit="update_admin_details(this,event)">
                      <input type="hidden" value="<?php echo e($single_admin['admin_id']); ?>" name="update_admin_id">
                      <div class="lookalike_table_detail">
                        <ul>

                          <li class="wc-25">
                            <div class="employee_table_record">
                              <h5>Access for Patient Record</h5>
                              <div class="form-check">
                                <input class="form-check-input form-check-custom" <?php if ($single_admin['access_to_record'] == 1) echo 'checked'; ?> name="entry_patient_record" id="entry_patient_record<?php echo e($single_admin['admin_id']); ?>" type="radio" value="1" />

                                <label class="form-check-label <?php if ($single_admin['access_to_record'] == 1) echo 'active'; ?>" for="entry_patient_record<?php echo e($single_admin['admin_id']); ?>">Access to Full Patient Record</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input form-check-custom <?php if ($single_admin['access_to_record'] == 1) echo 'active'; ?>" <?php if ($single_admin['access_to_record'] == 2) echo 'checked'; ?> name="entry_patient_record" id="limited_patient_record<?php echo e($single_admin['admin_id']); ?>" type="radio" value="2" />
                                <label class="form-check-label" for="limited_patient_record<?php echo e($single_admin['admin_id']); ?>">Limited Patient Record</label>
                              </div>
                            </div>
                          </li>
                          <li class="wc-75">
                            <div>
                              <div class="switch_acc mb-3">
                                <!-- Small switch -->
                                <div class="form-group mr-4 mb-0">
                                  <span class="switch switch-sm">

                                    <input type="checkbox" <?php if ($single_admin['pending_status'] == 1) echo 'checked'; ?> class="switch" id="switch-sm3<?php echo e($single_admin['admin_id']); ?>" name="active_status_admin">

                                    <label for="switch-sm3<?php echo e($single_admin['admin_id']); ?>"><?php if($single_admin['pending_status']==1): ?>Deactive User <?php else: ?> Active User <?php endif; ?></label>
                                  </span>
                                </div>
                                <div class="remove_acc">
                                  <a href="javascript:;" onclick="remove_administrator(<?php echo $single_admin['admin_id']; ?>)"><img src="<?php echo e(asset('admin/doctor/images/delete.svg')); ?>" alt="icon">Remove account</a>
                                  <a href="javascript:;" onclick="$('.master_top').html('');editProfile(<?php echo $single_admin['admin_id']; ?>,'admin')"><img src="<?php echo e(asset('admin/doctor/images/delete.svg')); ?>" alt="icon">Edit account</a>
                                  <a href="javascript:;" onclick="viewProfile(<?php echo $single_admin['admin_id']; ?>,'admin')"><img src="<?php echo e(asset('admin/doctor/images/delete.svg')); ?>" alt="icon">View account</a>
                                </div>
                              </div>
                              <div class="access_patient_other_options">
                                <button type="button" class="btn btn-light btn-xs mr-2" data-toggle="collapse" data-target="#accord_one<?php echo e($single_admin['admin_id']); ?>" aria-expanded="true" aria-controls="accord_one" name="button">Cancel</button>
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

                No Administartor Found

                <?php endif; ?>
              </div>
            </div>
            <div class="table_pagination">
              <button type="button" class="btn btn-light btn-xs pre_docs" <?php if ($hospital_admins->previousPageUrl()) {
                                                                          } else {
                                                                            echo "disabled";
                                                                          } ?> data-url="<?php echo $hospital_admins->previousPageUrl(); ?>&type=doc_page">Previous Page</button>
              <input type="hidden" class="doc_page_hidden" value="<?php echo e($hospital_admins->currentPage()); ?>">
              <span>Page <?php echo e($hospital_admins->currentPage()); ?> of <?php echo e($hospital_admins->lastPage()); ?> Pages</span>
              <button type="button" class="btn btn-light btn-xs next_docs" <?php if ($hospital_admins->nextPageUrl()) {
                                                                            } else {
                                                                              echo "disabled";
                                                                            } ?> data-url="<?php echo $hospital_admins->nextPageUrl(); ?>&type=doc_page">Next Page</button>
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
        <h3><span id="doctorTitle">Add Doctor</span>
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

        <form id="add_dr_form" name="add_dr_form" data-id="hospital" enctype="multipart/form-data">
          <Input type="hidden" readonly class="form-control" name="hosp_id" id="hosp_id" value="<?php echo e($hospital_detail['hosp_id']); ?>" />
          <Input type="hidden" readonly class="form-control" name="mode" id="mode" value="ADD" />

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
                <input type="text" placeholder="Phone Number" maxlength="15" class="form-control" value="+234" name="doctor_phone" id="dr_ph" >
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
                    echo '<option value="' . $m . '">' . $month . '</option>';
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
                <select class="form-control" name="doctor_role" id="doctor_role" disabled>
                  <option value="Select Gender">Select Role</option>
                  <option value="admin">Admin</option>
                  <option value="nurse">Nurse</option>
                  <option value="doctor" selected>Doctor</option>
                </select>
              </div>
            </div>
          </div>
          <!-- Third row -->

          <!-- Fourth row -->
         

          <!-- Fifth row -->
          <div class="row">
            <div class="employee_table_record col-sm-4 ">
                <h5>Are you Specialist?</h5>
                <div class="form-check" id="Specialist">
                    <input class="form-check-input form-check-custom" name="specialistmenu"  value="1" id="entry_patient_data" type="radio"/>
                    <label class="form-check-label" for="entry_patient_data">Yes, I am</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input form-check-custom" id="access_hospital_billings" name="specialistmenu"  value="2" type="radio"/>
                    <label class="form-check-label" for="access_hospital_billings">No, I am not</label>
                </div>
            </div>
            <div class="form-group col-sm-6 doctor_speciality">
              <label>What is your speciality?</label>
              <div class="select_box ">
                <select class="form-control" name="doctor_speciality" id="doctor_speciality">
                  <option value="">Select Doctors Speciality</option>
                  <?php $__currentLoopData = $specialist_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($category['name']); ?>"><?php echo e($category['name']); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>
          </div>
          <!-- Sixth row -->
          <div class="row">
          <div class="employee_table_record col-sm-4">
                <h5>Are You board certified doctor?</h5>
                <div class="form-check" id="certifiedDoctor">
                    <input class="form-check-input form-check-custom" name="access_for_hospital"  value="1" id="certified_doctor_yes" type="radio"/>
                    <label class="form-check-label" for="certified_doctor_yes">Yes, I am</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input form-check-custom" id="certified_doctor_no" name="access_for_hospital"  value="2" type="radio"/>
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
              <button type="submit" class="btn btn-primary mb-3 mt-3" name="button" id="submit_btn">Add Doctor
              </button>
            </div>
          </div>

          <input type="hidden" id="default_image" value="<?php echo e(asset('admin/adminimages/thumb.svg')); ?>">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Add Nurse screen -->
<div class="modal fade" id="add_nurse">
  <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width3">
    <div class="modal-content">
      <div class="modal-header">
        <h3><span id="nurseTitle">Add Nurse</span>
        </h3>
        <button type="button" class="close" data-dismiss="modal">
          <img src="<?php echo e(asset('admin/adminimages/popup_close.svg')); ?>" />
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger-outline alert-danger-outline-addnurse alert-dismissible alert_icon fade show" role="alert" style="display: none;">
          <div class="d-flex align-items-center">
            <div class="alert-icon-col">
              <span class="fa fa-warning">
              </span>
            </div>
            <div class="alert_text addnurse_danger_pop">
            </div>
            <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
              <i class="fa fa-close">
              </i>
            </a>
          </div>
        </div>
        <div class="alert alert-success-outline alert-success-outline-addnurse alert-dismissible alert_icon fade show" role="alert" style="display: none;">
          <div class="d-flex align-items-center">
            <div class="alert-icon-col">
              <span class="fa fa-check">
              </span>
            </div>
            <div class="alert_text addnurse_success_pop">
            </div>
            <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
              <i class="fa fa-close">
              </i>
            </a>
          </div>
        </div>

        <form id="add_nurse_form" name="add_nurse_form" enctype="multipart/form-data">

          <Input type="hidden" readonly class="form-control" name="hosp_id" id="hosp_id" value="<?php echo e($hospital_detail['hosp_id']); ?>" />
          <Input type="hidden" readonly class="form-control" name="mode" id="mode" value="ADD" />

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Title</label>
                <div class="select_box width220">
                  <select class="form-control" name="nurse_title" id="nurse_title">
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
                <input type="text" placeholder="Akintude" class="form-control" name="nurse_first_name" id="nurse_first_name">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Middle Name
                </label>
                <input type="text" placeholder="Middle Name" class="form-control" name="nurse_middle_name" id="nurse_middle_name">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label>Surname
                </label>
                <input type="text" placeholder="Surname" class="form-control" name="nurse_last_name" id="nurse_last_name">
              </div>
            </div>
          </div>
          <!-- Second row -->
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label>Email
                </label>
                <input type="text" placeholder="nurse@gmail.com" class="form-control" name="nurse_email" id="nurse_email">
              </div>
            </div>
            <div class="col-sm-4">
              <label>Phone Number</label>
              <div class="form-group">
                <input type="text" placeholder="Phone Number" maxlength="15" class="form-control" value="+234" name="nurse_phone" id="nurse_ph" >
              </div>
            </div>
            <div class="form-group col-sm-4">
                <label>Sex</label>
                <div class="select_box">
                  <select class="form-control" name="nurse_gender" id="nurse_gender">
                    <option value="">Select Sex</option>
                    <option value="1">Female</option>
                    <option value="0">Male</option>
                  </select>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-12">
                  <div class="form-group">
                      <label>Language</label>
                      <div class="select_box1 mb-2">
                          <input type="text"  class="form-control master_languages" name="languages" value="" id="nurse_languages">
                      </div>
                      <div class="input_tags">
                          <ul  class="master_top">
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
                      <input type="text" placeholder="" class="form-control nurse_edu_school"  name="edu_school" id="edu_school">
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-2">
              <label>Date Of Birth </label>
              <div class="select_box">
                <select id="nurseselect_num" class="form-control" name="day" style="background-color: #fff;">
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
                <select id="nurseselect_day" class="form-control" name="month" style="background-color: #fff;">
                  <option value="">Select Month</option>
                  <?php for ($m = 1; $m <= 12; $m++) {
                    $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                    echo '<option value="' . $m . '">' . $month . '</option>';
                  } ?>
                </select>
              </div>
            </div>
            <div class="col-2">
              <label>&nbsp;</label>
              <div class="select_box">
                <select class="form-control" id="nurseyear" name="years" style="background-color: #fff;">
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
                <select class="form-control" name="nurse_role" id="nurse_role" disabled>
                  <option value="Select Gender">Select Role</option>
                  <option value="admin">Admin</option>
                  <option value="nurse" selected>Nurse</option>
                  <option value="doctor">Doctor</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Third row -->
          
          <!-- Fourth row -->
          <!-- Fifth row -->
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nurse ID
                </label>
                <input type="text" placeholder="Nurse ID" class="form-control" name="nurse_id" id="nurse_id" readonly value="<?php echo time(); ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="add_photo_profile mt-2">
                <div class="photo_profile_place">
                  <img src="<?php echo e(asset('admin/adminimages/thumb.svg')); ?>" alt="image" id="preview-image_nurse" width="100px" height="100px">
                </div>
                <div class="add_pro_picture">
                  <h3>Add Photo Profile
                  </h3>
                  <span>jpg/png with size maximum 500kb
                  </span>
                  <label class="btn btn-light btn-sm" for="select_photo_file_nurse">Select Photo File
                  </label>
                  <input type="file" id="select_photo_file_nurse" accept="image/jpeg,image/jpg,image/png" />
                </div>
              </div>
            </div>
          </div>

          <!-- Last row -->
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label>Username</label>
                <input type="text" placeholder="Akintude" class="form-control" name="nurse_username" id="nurse_username">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Password</label>
                <input type="password" placeholder="Password" class="form-control" name="nurse_password" id="nurse_password">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" placeholder="Confirm Password" class="form-control" name="nurse_confirmPassword" id="nurse_confirmPassword">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary mb-3 mt-3" name="button" id="Nurse_submit_btn">Add Nurse
              </button>
            </div>
          </div>
          <input type="hidden" id="default_image" value="<?php echo e(asset('admin/adminimages/thumb.svg')); ?>">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Add Administrator screen -->
<div class="modal fade" id="add_administrator">
  <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width3">
    <div class="modal-content">
      <div class="modal-header">
        <h3><span id="adminTitle">Add Administrator</span>
        </h3>
        <button type="button" class="close" data-dismiss="modal">
          <img src="<?php echo e(asset('admin/adminimages/popup_close.svg')); ?>" />
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger-outline alert-danger-outline-addadmin alert-dismissible alert_icon fade show" role="alert" style="display: none;">
          <div class="d-flex align-items-center">
            <div class="alert-icon-col">
              <span class="fa fa-warning">
              </span>
            </div>
            <div class="alert_text addadmin_danger_pop">
            </div>
            <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
              <i class="fa fa-close">
              </i>
            </a>
          </div>
        </div>
        <div class="alert alert-success-outline alert-success-outline-addadmin alert-dismissible alert_icon fade show" role="alert" style="display: none;">
          <div class="d-flex align-items-center">
            <div class="alert-icon-col">
              <span class="fa fa-check">
              </span>
            </div>
            <div class="alert_text addadmin_success_pop">
            </div>
            <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close">
              <i class="fa fa-close">
              </i>
            </a>
          </div>
        </div>
        <form id="add_admin_form" name="add_admin_form" enctype="multipart/form-data">

          <Input type="hidden" readonly class="form-control" name="hosp_id" id="hosp_id" value="<?php echo e($hospital_detail['hosp_id']); ?>" />
          <Input type="hidden" readonly class="form-control" name="mode" id="mode" value="ADD" />

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Title</label>
                <div class="select_box width220">
                  <select class="form-control" name="admin_title" id="admin_title">
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
                <input type="text" placeholder="Akintude" class="form-control" name="admin_first_name" id="admin_first_name">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Middle Name
                </label>
                <input type="text" placeholder="Middle Name" class="form-control" name="admin_middlename" id="admin_middlename">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label>Surname
                </label>
                <input type="text" placeholder="Surname" class="form-control" name="admin_last_name" id="admin_last_name">
              </div>
            </div>
          </div>
          <!-- Second row -->
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label>Email
                </label>
                <input type="text" placeholder="doctor@gmail.com" class="form-control" name="admin_email" id="admin_email">
              </div>
            </div>
            <div class="col-sm-4">
              <label>Phone Number</label>
              <div class="form-group">
                <input type="text" placeholder="Phone Number" maxlength="15" class="form-control" value="+234" name="admin_ph" id="admin_ph" >
              </div>
            </div>
            <div class="form-group col-sm-4">
                <label>Sex</label>
                <div class="select_box ">
                  <select class="form-control" name="admin_gender" id="admin_gender">
                    <option value="Select Gender">Select Sex</option>
                    <option value="1">Female</option>
                    <option value="0">Male</option>
                  </select>
                </div>
              </div>
          </div>

          <div class="row">
            <div class="col-2">
              <label>Date Of Birth </label>
              <div class="select_box">
                <select id="adminselect_num" class="form-control" name="day" style="background-color: #fff;">
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
                <select id="adminselect_day" class="form-control" name="month" style="background-color: #fff;">
                  <option value="">Select Month</option>
                  <?php for ($m = 1; $m <= 12; $m++) {
                    $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                    echo '<option value="' . $m . '">' . $month . '</option>';
                  } ?>
                </select>
              </div>
            </div>
            <div class="col-2">
              <label>&nbsp;</label>
              <div class="select_box">
                <select class="form-control" id="adminyear" name="years" style="background-color: #fff;">
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
                <select class="form-control" name="admin_role" id="admin_role" disabled>
                  <option value="Select Gender">Select Role</option>
                  <option value="admin" selected>Admin</option>
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
            <div class="col-sm-6">
              <div class="form-group">
                <label>Administrator ID
                </label>
                <input type="text" placeholder="Admin ID" class="form-control" name="admin_id" id="admin_id" readonly value="<?php echo time(); ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="add_photo_profile mt-2">
                <div class="photo_profile_place">
                  <img src="<?php echo e(asset('admin/adminimages/thumb.svg')); ?>" alt="image" id="preview-image_admin" width="100px" height="100px">
                </div>
                <div class="add_pro_picture">
                  <h3>Add Photo Profile
                  </h3>
                  <span>jpg/png with size maximum 500kb
                  </span>
                  <label class="btn btn-light btn-sm" for="select_photo_file_admin">Select Photo File
                  </label>
                  <input type="file" id="select_photo_file_admin" accept="image/jpeg,image/jpg,image/png" />
                </div>
              </div>
            </div>
          </div>

          <!-- Last row -->
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label>Username</label>
                <input type="text" placeholder="Akintude" class="form-control" name="admin_username" id="admin_username">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Password</label>
                <input type="password" placeholder="Password" class="form-control" name="admin_password" id="admin_password">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" placeholder="Confirm Password" class="form-control" name="admin_confirmPassword" id="admin_confirmPassword">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary mb-3 mt-3" name="button" id="Admin_submit_btn">Add Admin
              </button>
            </div>
          </div>
          <input type="hidden" id="default_image" value="<?php echo e(asset('admin/adminimages/thumb.svg')); ?>">
        </form>
      </div>
    </div>
  </div>
</div>

<div id="site_url" style="display:none"><?php echo e(url('/')); ?></div>
<Input type="hidden" readonly class="form-control" name="hospital_id" id="hospital_id" value="<?php echo e($hospital_detail['hosp_id']); ?>" style="display:none" />

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
<?php echo $__env->make('layouts.admin_dashboard_detail', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>