<div id="doctors" class="tab-pane fade <?php if($_GET['type'] == 'doc_page') { ?> show active <?php } ?>">
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
            <?php if(count($hospital_doctors) > 0): ?>
            	<?php $__currentLoopData = $hospital_doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital_doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="lookalike_table_row">
                    <div class="lookalike_table_body" id="head_one<?php echo e($hospital_doctor['doctor_id']); ?>">
                        <ul>
                            <li style="width:22%">
                                <div class="d_profile">
                                    <div class="d_pro_img">
                                        <img src="<?php echo e(asset('admin/doctor/images/doc1.png')); ?>" alt="image">
                                    </div>
                                    <div class="d_pro_text">
                                        <h4><?php echo e($hospital_doctor['doctor_title']); ?> <?php echo e($hospital_doctor['doctor_first_name']); ?> <?php echo e($hospital_doctor['doctor_last_name']); ?></h4>
                                        <a href="javascript:;"><?php echo e($hospital_doctor['doctor_state']); ?>, <?php echo e($hospital_doctor['doctor_country']); ?></a>
                                    </div>
                                </div>
                            </li>
                            <li style="width:19%">ID-<?php echo e($hospital_doctor['doctor_id']); ?></li>
                            <li style="width:9%">Doctor</li>
                            <li style="width:13%"><?php echo e($hospital_doctor['doctor_phone']); ?></li>
                            <li style="width:12%">
                            	
								<span class="badge badge-pill <?php if($hospital_doctor['active_status']==0) { echo 'badge-danger'; } elseif($hospital_doctor['active_status']==1) { echo 'badge-success'; } ?>" id="status_row_<?php echo e($hospital_doctor['doctor_id']); ?>"><?php if($hospital_doctor['active_status']==0){ echo 'Suspend';} else if($hospital_doctor['active_status']==1){ echo 'Active User';}?></span>

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
                                    <li class="wc-25">
                                        <div class="employee_table_record">
                                            <h5>Access for Hospital</h5>
                                            <div class="form-check">
                                                <input value="1"  name="access_for_hospital[]" class="form-check-input form-check-custom" <?php if($hospital_doctor['access_to_hospital']==1 || $hospital_doctor['access_to_hospital']==3) echo 'checked'; ?> id="entry_patient<?php echo e($hospital_doctor['doctor_id']); ?>" type="checkbox"/>
                                                <label class="form-check-label" for="entry_patient<?php echo e($hospital_doctor['doctor_id']); ?>">Entry Patient Data</label>
                                            </div>
                                            <div class="form-check">
                                                <input value="2" name="access_for_hospital[]" class="form-check-input form-check-custom" <?php if($hospital_doctor['access_to_hospital']==2 || $hospital_doctor['access_to_hospital']==3) echo 'checked'; ?> id="access_hospital<?php echo e($hospital_doctor['doctor_id']); ?>" type="checkbox"/>
                                                <label class="form-check-label" for="access_hospital<?php echo e($hospital_doctor['doctor_id']); ?>">Access Hospital Billings</label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="wc-25">
                                        <div class="employee_table_record">
                                            <h5>Access for Patient Record</h5>
                                            <div class="form-check">
                                                <input class="form-check-input form-check-custom" <?php if($hospital_doctor['access_to_patient_record']==1) echo 'checked'; ?> name="entry_patient_record"  id="entry_patient_record<?php echo e($hospital_doctor['doctor_id']); ?>" type="radio" value="1"/>

                                                <label class="form-check-label <?php if($hospital_doctor['access_to_patient_record']==1) echo 'active'; ?>" for="entry_patient_record<?php echo e($hospital_doctor['doctor_id']); ?>">Access to Full Patient Record</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input form-check-custom <?php if($hospital_doctor['access_to_patient_record']==1) echo 'active'; ?>" <?php if($hospital_doctor['access_to_patient_record']==2) echo 'checked'; ?> name="entry_patient_record"   id="limited_patient_record<?php echo e($hospital_doctor['doctor_id']); ?>" type="radio" value="2" />
                                                <label class="form-check-label" for="limited_patient_record<?php echo e($hospital_doctor['doctor_id']); ?>">Limited Patient Record</label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="wc-25">
                                        <div>
                                            <div class="switch_acc mb-3">
                                                <!-- Small switch -->
                                                <div class="form-group mr-4 mb-0">
                                                  <span class="switch switch-sm">

													<input type="checkbox" <?php if($hospital_doctor['active_status']==0) echo 'checked'; ?> class="switch" id="switch-sm3<?php echo e($hospital_doctor['doctor_id']); ?>" name="active_status_doc">
                                                    
                                                    <label for="switch-sm3<?php echo e($hospital_doctor['doctor_id']); ?>">Active User</label>
                                                  </span>
                                                </div>
                                                <div class="remove_acc" onclick="remove_doctor(<?php echo $hospital_doctor['doctor_id'];?>)">
                                                    <a href="javascript:;"><img src="<?php echo e(asset('admin/doctor/images/delete.svg')); ?>" alt="icon">Remove account</a>
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
           <button type="button" class="btn btn-light btn-xs pre_docs" <?php if($hospital_doctors->previousPageUrl()){  } else{ echo "disabled"; } ?> data-url="<?php echo $hospital_doctors->previousPageUrl(); ?>&type=doc_page">Previous Page</button>
           <input type="hidden" class="doc_page_hidden" value="<?php echo e($hospital_doctors->currentPage()); ?>">
           <span>Page <?php echo e($hospital_doctors->currentPage()); ?> of <?php echo e($hospital_doctors->lastPage()); ?> Pages</span>
           <button type="button" class="btn btn-light btn-xs next_docs"  <?php if($hospital_doctors->nextPageUrl()){  } else{ echo "disabled"; } ?>  data-url="<?php echo $hospital_doctors->nextPageUrl(); ?>&type=doc_page">Next Page</button>
       </div>
    </div>
</div>
<div id="Nurses" class="tab-pane fade  <?php if($_GET['type'] == 'nurse_page') { ?> show active <?php } ?>">
    Nurses
</div>
<div id="Administrator" class="tab-pane fade <?php if($_GET['type'] == 'ad_page') { ?> show active <?php } ?>">
    Administrator
</div>
              
