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
          <?php if(count($all_employees['data']) > 0): ?>
            <?php $__currentLoopData = $all_employees['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="lookalike_table_row">
              <div class="lookalike_table_body" id="head_one<?php echo e($single_employee['employee_id']); ?>">
                  <ul>
                      <li style="width:22%">
                          <div class="d_profile">
                              <div class="d_pro_img">
                                  <img src="<?php echo e(asset('employeeimages/' . $single_employee['employee_picture'])); ?>" alt="image">
                              </div>
                              <div class="d_pro_text">
                                  <h4><?php echo e($single_employee['employee_title']); ?> <?php echo e(ucfirst($single_employee['employee_first_name'])); ?> <?php echo e($single_employee['employee_last_name']); ?></h4>
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

                                          <input type="checkbox" <?php if($single_employee['active_status']==1) echo 'checked'; ?> class="switch" id="switch-sm3<?php echo e($single_employee['employee_id']); ?>" name="active_status_emp" name="active_status_emp">
                                                
                                          <label for="switch-sm3<?php echo e($single_employee['employee_id']); ?>">Active User</label>
                                        </span>

                                      </div>

                                      <div class="remove_acc" onclick="remove_emp(<?php echo $single_employee['employee_id'];?>)">
                                          <a href="javascript:;"><img src="<?php echo e(asset('admin/adminimages/delete.svg')); ?>" alt="icon">Remove account</a>
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
       <button type="button" class="btn btn-light btn-xs pre_search_emp" <?php if($all_employees['prev_page_url']){  } else{ echo "disabled"; } ?> data-url="<?php echo $all_employees['prev_page_url']; ?>&type=emp_page">Previous Page</button>
       <input type="hidden" class="emp_page_hidden" value="<?php echo e($all_employees['current_page']); ?>">
       <span>Page <?php echo e($all_employees['current_page']); ?> of <?php echo e($all_employees['last_page']); ?> Pages</span>
       <button type="button" class="btn btn-light btn-xs next_search_emp"  <?php if($all_employees['next_page_url']){  } else{ echo "disabled"; } ?>  data-url="<?php echo $all_employees['next_page_url'] ?>&type=emp_page">Next Page</button>
      </div>
  </div>
</div>
              
