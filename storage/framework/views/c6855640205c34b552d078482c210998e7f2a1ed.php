<div class="table_hospital pagination_fixed_bottom">
 <div class="table-responsive">
   <table class="table" cellspacing="10">
       <tr>
           <th>MEMBER DATA</th>
           <th>PATIENT ID</th>
           <th>DATE  OF BIRTH</th>
           <th>CURRENT PLAN</th>
           <th>ENDED SUBRIPTIONS</th>
           <th></th>
       </tr>
        <?php if(count($all_patients) > 0): ?>
          <?php $__currentLoopData = $all_patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <tr>
               <td>
                   <div class="d_profile">
                        <div class="d_pro_img">
                           <?php if(file_exists(getcwd().'/uploads/patient/'.basename($all_patient['patient_profile_img'])) && !empty($all_patient['patient_profile_img'])) { ?>                          
                                     <img src="<?php echo e(asset('uploads/patient/'.$all_patient['patient_profile_img'])); ?>" alt="image">
                                   <?php   } else {  ?> 
                                       <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                                      <?php }   ?> 
                                   </div>
                       <div class="d_pro_text">
                           <h4> <?php echo e($all_patient['patient_title']); ?> <?php echo e($all_patient['patient_first_name']); ?> <?php echo e($all_patient['patient_last_name']); ?></h4>
                           <a href="javascript:;">View Profile</a>
                       </div>
                   </div>
               </td>
               <td>PATIENT-<?php echo e($all_patient['patient_unique_id']); ?></td>
              <td><?php if(!empty($all_patient['patient_date_of_birth'])): ?> <?php echo e(date('d M, Y',$all_patient['patient_date_of_birth'])); ?>   <?php else: ?> <?php echo e("--"); ?> <?php endif; ?> </td>
               <td><?php echo e($all_patient['patient_insurance']); ?></td>
              <td><?php if(!empty($all_patient['patient_end_subscription'])): ?><?php echo e(date('d M, Y',$all_patient['patient_end_subscription'])); ?> <?php else: ?> <?php echo e("--"); ?> <?php endif; ?></td>
                <td>
                    <a href="<?php echo e(url('/admin/medical_records/'.$all_patient['patient_unique_id'])); ?>" class="btn btn-light btn-xs mr-2" name="button"><img class="icon" src="<?php echo e(asset('admin/adminimages/eye.svg')); ?>" alt="icon">View Record(s)</a>
                </td>
                
           </tr>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <tr>
              <td colspan="7" class="text-center">No Members Found</td>
          </tr>
        <?php endif; ?> 
   </table>
 </div>
    <div class="table_pagination">
     <button type="button" class="btn btn-light btn-xs pre_mem" <?php if($all_patients->previousPageUrl()){  } else{ echo "disabled"; } ?> data-url="<?php echo $all_patients->previousPageUrl(); ?>&type=mem_page">Previous Page</button>
     <input type="hidden" class="mem_page_hidden" value="<?php echo e($all_patients->currentPage()); ?>">
     <span>Page <?php echo e($all_patients->currentPage()); ?> of <?php echo e($all_patients->lastPage()); ?> Pages</span>
     <button type="button" class="btn btn-light btn-xs next_mem"  <?php if($all_patients->nextPageUrl()){  } else{ echo "disabled"; } ?>  data-url="<?php echo $all_patients->nextPageUrl(); ?>&type=mem_page">Next Page</button>
    </div>
</div>
              
