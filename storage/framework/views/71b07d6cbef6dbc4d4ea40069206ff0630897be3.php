<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12 col-xl-9">
            <div class="widget">
                <div class="widget_header widget_flex_header mb-2">
                    <h2>Health History</h2>
                 
                    <div class="select_box select_black">
                          <?php if(isset($start_date->created_date)): ?>    
                            <?php 
                                date_default_timezone_set($time_zone);
                                $startDate = $start_date->created_date; 
                                $endDate = date("Y-m-t 23:59:59",strtotime('now'));
                                $presentStartDate = date("Y-m-01 00:00:00",strtotime('now'));    
                                $dates = array();                                            
                            ?>                                               
                            <?php while($startDate <= strtotime($endDate)): ?> 
                            <?php    $dates[] = $startDate;
                                    $startDate = strtotime("+1 month", $startDate); 
                                    $final_dates = array_reverse($dates);
                                    
                            ?>
                            <?php endwhile; ?> 
                            <select class="form-control history_mnth" name="" onchange="sortHealthHistory(this); return false;">                                                  
                                <?php $__currentLoopData = $final_dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date_arr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(date('Y-m-01',$date_arr)); ?>" <?php if($date_arr >= strtotime($presentStartDate) &&  $date_arr <= strtotime($endDate)){ echo 'selected' ; } ?>><?php echo e(date('F',$date_arr)); ?> <?php echo e(date('Y',$date_arr)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </select>
                        <?php endif; ?>                         
                     </div>
                </div>
                <div class="main_history_div">
                  <div class="widget_body minheight500 mb-3">
                    <div class="table-responsive">
                      <table class="table theme_table">
                        <thead>
                          <tr>
                            <th scope="col">Hospital</th>
                            <th scope="col">Doctor Name</th>
                            <th scope="col">Date & Time</th>
                            <th scope="col" class="text-center">Attachment</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(count($health_history) >0): ?>
                            <?php $__currentLoopData = $health_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $health_hist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr class="history_div cursor_pointer" data-id="<?php echo e($health_hist->history_id); ?>" onclick="historydetail(this); return false;">
                                <td>
                                    <div class="center_type">
  <?php if(isset($health_hist->doctor)): ?>
                                        <h5><?php echo e($health_hist->doctor->doctor_hospital_details->hosp_name); ?></h5>
                                        <?php endif; ?>
                                        <a class="hospital_appointment" href="javascript:;">Hospital Appointment</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="table_profile_header">
                                      <div class="tprofile_image">
                                          <?php
                                          if(isset($health_hist->doctor)){

                                           if((file_exists(getcwd().'/doctorimages/'.$health_hist->doctor->doctor_picture)) && (!empty($health_hist->doctor->doctor_picture))){
                                      ?>
                                      <img src="<?php echo e(asset('/doctorimages/'.$health_hist->doctor->doctor_picture)); ?>" alt="image">
                                      <?php     }
                                      else { ?>
                                      <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                                      <?php   } }else{ ?>
                                       <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                                       <?php } ?>
                                      </div>
                                      <div class="tprofile_text">
                                        <?php if(isset($health_hist->doctor)): ?>
                                          <h3>Dr. <?php echo e($health_hist->doctor->doctor_first_name); ?> <?php echo e($health_hist->doctor->doctor_last_name); ?>, <?php echo e($health_hist->doctor->doctor_degree); ?></h3>
                                          <p><?php echo e($health_hist->doctor->specialist_categories['speciality_name']); ?></p>
                                          <?php endif; ?>
                                      </div>
                                  </div>
                                </td>
                                <td>
                                    <div class="appointment_time">
                                        <h5><?php echo e(date('D', $health_hist->updated_date)); ?>, <?php echo e(date('j M Y ', $health_hist->updated_date)); ?> <?php echo e(date('h:i A ', $health_hist->updated_date)); ?></h5>
                                     </div>
                                </td>
                                <td class="text-center">
                                    <div class="attachment">
                                        <img src="<?php echo e(asset('images/attachment.svg')); ?>" alt="icon">
                                        <?php $i=0; ?>
                                    <?php $__currentLoopData = $health_hist['history_attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history_attachments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                    <?php if($history_attachments->type == 2): ?>
                                  <?php $i++;?>
                                   <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                        <?php echo e($i); ?> Files
                                    </div>
                                </td>
                              </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php else: ?>
                            <tr>
                              <td colspan="4" class="text-center">No History Found</td>
                            </tr>
                          <?php endif; ?>                        
                        </tbody>

                      </table>
                    </div>
                      <div class="showing_data">
                          Showing you <?php echo e(count($health_history)); ?> datas from your health history, stay health! <img src="<?php echo e(asset('images/smilies/raised-hand.png')); ?>" alt="icon">
                      </div>
                  </div>
                  <?php if($health_history->lastPage() > 1): ?>
                    <div class="widget_footer">
                        <?php if($health_history->hasPages()): ?>
                          <ul class="pagination">
                              
                              <?php if($health_history->onFirstPage()): ?>
                                  <li class="disable"><a href="javascript:;"><img src="<?php echo e(asset('images/left_page.svg')); ?>" alt="icon"></a></li>
                              <?php else: ?>
                                  <li><a href="<?php echo e($health_history->previousPageUrl()); ?>"><img src="<?php echo e(asset('images/left_page.svg')); ?>" alt="icon"></a></li>
                              <?php endif; ?>
                              
                              <?php if($health_history->hasMorePages()): ?>
                                  <li><a href="<?php echo e($health_history->nextPageUrl()); ?>"><img src="<?php echo e(asset('images/right_page.svg')); ?>" alt="icon"></a></li>        
                              <?php else: ?>
                                  <li class="disable"><a href="javascript:;"><img src="<?php echo e(asset('images/right_page.svg')); ?>" alt="icon"></a></li>
                              <?php endif; ?>
                        </ul><?php endif; ?>
                    </div>
                  <?php endif; ?>
                </div>
            </div>

        </div>
        <div class="col-12 col-xl-3">
            <div class="filter mt-5 pt-2">
                <div class="filter_heading">
                    <h4>Filter</h4>
                    <a class="filter_reset" onclick="resetfilters(this); return false;" href="javascript:;">Reset Filter</a>
                </div>
                <div class="filter_body">
                    <?php if(count($speciality_detail) > 0): ?>
                        <div class="filter_row">
                            <h5>Doctor Speciality</h5>
                            <?php $__currentLoopData = $speciality_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$speciality_det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <div class="checkbox" onclick="sortHealthHistory(this); return false;">
                                  <input id="speaciality<?php echo e(($key+1)); ?>" type="checkbox" class="form-check-custom doc_speciality" value="<?php echo e($speciality_det['speciality_id']); ?>"/>
                                  <label for="speaciality<?php echo e(($key+1)); ?>"><?php echo e($speciality_det['speciality_name']); ?></label>
                              </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                       
                        </div>
                    <?php endif; ?>
                    <div class="filter_row">
                        <h5>Hospital</h5>
                        <div class="select_box">
                            <select class="form-control hosp_list" name="" onchange="sortHealthHistory(this); return false;">
                                <option value="">All Hospitals</option>
                                <?php if(count($hospitals) > 0): ?>
                                  <?php $__currentLoopData = $hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value ="<?php echo e($hospital->hosp_id); ?>"><?php echo e($hospital->hosp_name); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.patient_fluid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>