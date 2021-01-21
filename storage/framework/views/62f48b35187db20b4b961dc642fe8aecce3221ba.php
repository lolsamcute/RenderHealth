<?php $__env->startSection('content'); ?>

<main class="col-12 col-md-12 col-xl-12 bd-content">
  <div class="row">
    <div class="col-12">
      <div class="page_head">
        <h1 class="heading">Manage Nurse

          <!-- <a data-toggle="modal" data-target="#add_doctor" class="add_schedule" href="javascript:;">
            <img src="<?php echo e(asset('admin/adminimages/add.svg')); ?>" alt="icon">
          </a> -->
        </h1>
        <!-- <button type="button" data-toggle="modal" data-target="#search_doctor" class="btn btn-primary btn-sm">Search Doctor
        </button> -->
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
      <div id="Nurses" class="">
          <div class="table_hospital pagination_fixed_bottom">
            <div class="table-responsive">
              <div id="accordion" class="lookalike_table mb-4">
                <div class="lookalike_table_head">
                  <ul>
                    <li style="width:22%">Member Data</li>
                    <li style="width:19%">Nurse ID</li>
                    <li style="width:15%">Role</li>
                    <li style="width:13%">Phone Number</li>
                    <li style="width:15%">Status</li>
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
                      <li style="width:15%">Nurse</li>
                      <li style="width:13%"><?php echo e($single_nurse['nurse_phone']); ?></li>
                      <li style="width:15%">

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
                         <a href="javascript:;" class="btn btn-light btn-xs" onclick="viewProfileHospital(<?php echo $single_nurse['nurse_id']; ?>,'nurse')">View account</a>
                        <!-- <button class="btn btn-light btn-xs" data-toggle="collapse" data-target="#accord_one<?php echo e($single_nurse['nurse_id']); ?>" aria-expanded="true" aria-controls="accord_one<?php echo e($single_nurse['nurse_id']); ?>">
                          <img class="icon" src="<?php echo e(asset('admin/doctor/images/eye.svg')); ?>" alt="icon">Manage Access
                        </button> -->
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
                </div>
              </div>
</main>

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
<?php echo $__env->make('layouts.hospital', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>