<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="widget">
                <div class="widget_header widget_flex_header">
                    <div class="widget_flex">
                        <h2>Health Diary</h2>
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
                                <select class="form-control" name="" onchange="monthlyHealthDiary(this); return false;">                                                           
                                    <?php $__currentLoopData = $final_dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date_arr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(date('Y-m-01',$date_arr)); ?>" <?php if($date_arr >= strtotime($presentStartDate) &&  $date_arr <= strtotime($endDate)){ echo 'selected' ; } ?>><?php echo e(date('F',$date_arr)); ?> <?php echo e(date('Y',$date_arr)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </select>
                            <?php endif; ?>
                         </div>
                    </div>
                    <div>
                        <a href="<?php echo e(URL::To('/patient/add_new_diary')); ?>" class="btn btn-primary btn-emoji"><img src="<?php echo e(asset('admin/doctor/images/smilies/writing-hand.png')); ?>" alt="icon"> Add New Diary</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="main_diary_div">

            </div>  
        </div>
            <?php if(count($current_diary) == 0 && count($prev_diary) == 0): ?>
                <div class="col-12">
                    <div class="main_diary_div1">
                        <div class="widget_body">
                            <div class="no_data">
                                <img src="<?php echo e(asset('images/no_data.svg')); ?>" alt="images">
                                <h4>No Health Diary Available</h4>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>     
            <?php if(count($current_diary) > 0): ?>
                <div class="col-12">
                    <div class="main_diary_div1">
                        <div class="widget_caption">
                            This Week <span></span>
                        </div>
                        <div class="row">        

                            <?php $__currentLoopData = $current_diary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $current_dir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="health_diary_box">
                                        <div class="health_option">
                                            <div class="btn-group">
                                                <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="<?php echo e(asset('images/options.svg')); ?>" alt="options">
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                  <a class="dropdown-item" href="<?php echo e(asset('patient/edit_health_diary/'.$current_dir->diary_id)); ?>">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="diary_date"><?php echo e(date('j F Y',$current_dir->created_date)); ?></span>
                                        <div class="diary_detail">
                                            <?php
                                                $feeling_pic = ['admin/doctor/images/smilies/no_pain@2x.png','admin/doctor/images/smilies/mild@2x.png','admin/doctor/images/smilies/moderate@2x.png','admin/doctor/images/smilies/severe@2x.png','admin/doctor/images/smilies/very_severe@2x.png','admin/doctor/images/smilies/worst_pain@2x.png','admin/doctor/images/smilies/moderate@2x.png'];
                                            ?>
                                            <?php //echo $current_dir->feeling_details ;echo $feeling_pic[6];?>
                                            <span class="diary_icon"><img src="<?php echo e(asset($feeling_pic[$current_dir->feeling_details])); ?>" alt="icon"></span>
                                            <?php
                                        $feeling = ['Feeling No Pain','Feeling Mild Pain','Feeling Moderate Pain','Feeling Severe Pain','Feeling Very Severe Pain','Feeling Worst Pain',$current_dir->describe_feeling_other];                                                        
                                            ?>                                                        
                                            <h4><?php echo e($feeling[$current_dir->feeling_details]); ?></h4>
                                            <?php $symptoms = $current_dir->symptom_details; ?>
                                            <?php if(strlen($symptoms) > 70): ?>
                                                <h6><?php echo e(substr($symptoms,0,70)); ?>...</h6>
                                            <?php else: ?>
                                                <h6><?php echo e(substr($symptoms,0,70)); ?></h6>
                                            <?php endif; ?>
                                            <a data-toggle="modal" class="btn btn-black btn-xs mt-2 mb-3" href="javascript:;" data-id="<?php echo e($current_dir->diary_id); ?>" onclick="viewhealthdiary(this); return false;">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                                            
                        </div> 
                    </div>
                </div>                
            <?php endif; ?> 
            <?php if(count($prev_diary) > 0): ?>
                <div class="col-12">
                    <div class="main_diary_div1">
                        <div class="widget_caption">
                            Last Week <span></span>
                        </div>
                        <div class="row">                               
                            <?php $__currentLoopData = $prev_diary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prev_dir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="health_diary_box">
                                        <div class="health_option">
                                            <div class="btn-group">
                                                <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="<?php echo e(asset('admin/doctor/images/options.svg')); ?>" alt="options">
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="<?php echo e(asset('patient/edit_health_diary/'.$prev_dir->diary_id)); ?>">Edit</a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <span class="diary_date"><?php echo e(date('j F Y',$prev_dir->created_date)); ?></span>
                                        <div class="diary_detail">
                                            <?php
                                                $feeling_pic = ['admin/doctor/images/smilies/no_pain@2x.png','admin/doctor/images/smilies/mild@2x.png','admin/doctor/images/smilies/moderate@2x.png','admin/doctor/images/smilies/severe@2x.png','admin/doctor/images/smilies/very_severe@2x.png','admin/doctor/images/smilies/worst_pain@2x.png','admin/doctor/images/smilies/moderate@2x.png'];                                                       
                                            ?>
                                            <span class="diary_icon"><img src="<?php echo e(asset($feeling_pic[$prev_dir->feeling_details])); ?>" alt="icon"></span>
                                            <?php
                                              $feeling = ['Feeling No Pain','Feeling Mild Pain','Feeling Moderate Pain','Feeling Severe Pain','Feeling Very Severe Pain','Feeling Worst Pain',$prev_dir->describe_feeling_other];                                                      
                                            ?>                                                        
                                            <h4><?php echo e($feeling[$prev_dir->feeling_details]); ?></h4>
                                            <?php $symptoms = $prev_dir->symptom_details; ?>
                                            <?php if(strlen($symptoms) > 70): ?>
                                                <h6><?php echo e(substr($symptoms,0,70)); ?>...</h6>
                                            <?php else: ?>
                                                <h6><?php echo e(substr($symptoms,0,70)); ?></h6>
                                            <?php endif; ?>                                            
                                            <a data-toggle="modal" class="btn btn-black btn-xs mt-2 mb-3" href="javascript:;" data-id="<?php echo e($prev_dir->diary_id); ?>" onclick="viewhealthdiary(this); return false;">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                               
                        </div> 
                    </div> 
                </div>                
            <?php endif; ?> 
        </div>
    </div>
</main>                
</div>
</div>


<!-- View Health Diary Modal -->
<div class="modal fade" id="view_health_diary">
    <div class="modal-dialog modal-md modal-dialog-centered genModal">
        <div class="modal-content diary_content">    
        </div>
    </div>
</div>  
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.patient_fluid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>