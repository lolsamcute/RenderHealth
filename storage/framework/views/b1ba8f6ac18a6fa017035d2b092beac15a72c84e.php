<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
  <div class="row">
    <div class="col-12">
      <div class="page_head">
        <h1 class="heading">Doctors Billing
         
        </h1>
        
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
                  <li style="width:22%">Doctor Data
                  </li>
                  <li style="width:19%">Doctor ID
                  </li>
               
                  <li style="width:13%">Phone Number
                  </li>
                  <li style="width:12%">Status
                  </li>
                  <li>
                  </li>
                </ul>
              </div>
              <?php if(count($all_doctors) > 0): ?>
              <?php $__currentLoopData = $all_doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <?php //print_r($all_doctors);die;?>
              <div class="lookalike_table_row">
                <div class="lookalike_table_body" id="head_one<?php echo e($single_doctor['doctor_id']); ?>">
                  <ul>
                    <li style="width:22%">
                      <div class="d_profile">
                        <div class="d_pro_img">
                          <img src="<?php echo e(asset('doctorimages/' . $single_doctor
                                    ['doctor_picture'])); ?>" alt="image">
                        </div>
                        <div class="d_pro_text">
                          <h4> <?php if($single_doctor['doctor_gender'] === 0): ?> Mr.
                                               <?php elseif($single_doctor['doctor_gender']== 1 && $single_doctor['marital_status']== 1): ?>Mrs
                                               <?php elseif($single_doctor['doctor_gender']== 1): ?> Miss
                                                 <?php endif; ?>  <?php echo e(ucfirst($single_doctor['doctor_first_name'])); ?> <?php echo e($single_doctor['doctor_last_name']); ?>

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
                                   <?php if($single_doctor['active_status']==0) { echo 'badge-danger'; } elseif($single_doctor['active_status']==1) { echo 'badge-success'; } ?>" id="status_row_<?php echo e($single_doctor['doctor_id']); ?>">
                        <?php if($single_doctor['active_status']==0){ echo 'Suspend';} else if($single_doctor['active_status']==1){ echo 'Active User';}?>
                      </span>
                    </li> 
                    <li>
                       <a href="<?php echo e(url('/admin/view_all_billings')); ?>/<?php echo e($single_doctor['doctor_id']); ?>" class="btn btn-light btn-xs btn_view_appointment" data-id="<?php echo e($single_doctor['doctor_id']); ?>" name="button"><img class="icon" src="<?php echo e(asset('admin/adminimages/eye.svg')); ?>" alt="icon">View Billing
                      </a>
                    </li>
                  </ul>
                </div>
              
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              No Doctor Found
              <?php endif; ?> 
            </div>
            <div class="table_pagination">
              <button type="button" class="btn btn-light btn-xs pre_emp" 
                      <?php if($all_doctors
              ->previousPageUrl()){  } else{ echo "disabled"; } ?> data-url="
              <?php echo $all_doctors->previousPageUrl(); ?>&type=doc_page">Previous Page
              </button>
            <input type="hidden" class="doc_page_hidden" value="<?php echo e($all_doctors
                                                                ->currentPage()); ?>">
            <span>Page <?php echo e($all_doctors
              ->currentPage()); ?> of <?php echo e($all_doctors
              ->lastPage()); ?> Pages
            </span>
            <button type="button" class="btn btn-light btn-xs next_emp"  
                    <?php if($all_doctors->nextPageUrl()){  } else{ echo "disabled"; } ?>  data-url="
            <?php echo $all_doctors->nextPageUrl(); ?>&type=doc_page">Next Page
            </button>
        </div>
      </div>
    </div>
  </div>
  </div>
</main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>