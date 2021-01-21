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
                        <a href="<?php echo e(url('/hospital/all_appointments')); ?>/<?php echo e($single_doctor['doctor_id']); ?>" class="btn btn-light btn-xs btn_view_appointment" data-id="<?php echo e($single_doctor['doctor_id']); ?>" name="button">
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