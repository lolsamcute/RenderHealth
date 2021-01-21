<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="widget">
                <div class="widget_header">
                    <h2>Add New Diary</h2>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="alert alert-danger-outline alert-dismissible alert_icon fade show error_msg_tele text-left mb-4" id="error_msg_tele" role="alert" style="display:none;">
                <div class="d-flex align-items-center">
                    <div class="alert-icon-col">
                        <span class="fa fa-warning"></span>
                    </div>
                    <div class="alert_text error_text_tele">
                       
                    </div>
                    <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="widget ">
                        <div class="widget_header">
                            <h3>1. Date & Feeling</h3>
                        </div>
                        
                        <div class="widget_body widget_profile  mb-4">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" disabled value="<?php echo e(date('Y-m-d')); ?>" name="date" class="form-control" placeholder="Type here.."/>
                            </div>
                        </div>
                    </div>
                    <div class="widget_body widget_profile  mb-4">
                            <div class="form-group">                                                
                                <label>How do you feel ?</label>
                                <div class="select_box">
                                     <?php 
                                     $put_disable_keys=array();

                                     $feeling = ['Feeling No Pain','Feeling Mild Pain','Feeling Moderate Pain','Feeling Severe Pain','Feeling Very Severe Pain','Feeling Worst Pain',"Other"];
                                  foreach($patient_diary as $single_diary){                                    
                                      $put_disable_keys[]=$single_diary->feeling_details;
                                    }   
                                  ?>
                               

                                    <select class="form-control feeling_detail" name="feeling_detail"> 
                                       <?php $__currentLoopData = $feeling; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$single_feeling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 

                                       <?php if(in_array($key,$put_disable_keys)): ?>                              
                                        <option value="<?php echo e($key); ?>" disabled=""><?php echo e($single_feeling); ?></option>
                                        <?php else: ?>
                                         <option value="<?php echo e($key); ?>"><?php echo e($single_feeling); ?></option>
                                         <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                       
                                    </select>
                                </div>                                
                            </div>
                             <input type="text" class="form-control other_health_diary" style="display:none" id="other_health_diary" placeholder="Describe Feeling" value="" name="describe_feeling_other">
                        </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="widget ">
                        <div class="widget_header">
                            <h3>2. Describe Symptoms</h3>
                        </div>
                        
                        <div class="widget_body widget_profile  mb-4">
                            <div class="form-group">
                                <label>Describe Symptoms</label>
                                <textarea name="name" class="form-control symptoms" placeholder="Type here.." rows="6"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="widget mb-4">
                        <div class="widget_header">
                            <h3>3. Medications Taken</h3>
                        </div>
                        <div class="widget_body widget_profile ">
                            <div class="form-group mb-0">
                                <label>Find Medication</label>
                                <div class="iconed_input mb-2">
                                    <input type="search" class="form-control patient_medication" id="patient_medication" placeholder="Find Medications" value="">
                                    <img src="<?php echo e(asset('admin/doctor/images/Icon-Search.svg')); ?>" alt="icon">
                                </div>
                                <div class="input_tags">
                                    <ul class="medi_parent">                                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget_header">
                            <h3>4. Attach Images</h3>
                        </div>
                        <div class="widget_body widget_profile ">
                            <div class="form-group mb-0">
                                <label>Attachment Image</label>
                                <div class="add_diary_images">
                                    <div class="add_diary_parent d-inline-block mr-2">
                                        
                                    </div>
                                    <div class="add_more_image">
                                        <label for="add_more_image">Add Image</label>
                                        <input type="file" id="add_more_image" name="add_more_image[]" multiple onchange="uploadDiaryImage(this); return false;" accept="image/*"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <?php echo e(csrf_field()); ?>

            <button type="button" class="btn btn-black submit_btn" name="button" onclick="saveHealthDiary(this); return false;">SAVE MY DIARY</button>
            
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.patient_fluid', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>