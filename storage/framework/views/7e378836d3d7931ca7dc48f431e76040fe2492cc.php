<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="page_head">
                <h1 class="heading">Search Patient’s Data</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="widget padding-40">  
                <div class="messages">   	 
                    <?php if($errors->any()): ?>                               
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <div class="alert alert-danger-outline alert-dismissible alert_icon fade show" role="alert"><div class="d-flex align-items-center"><div class="alert-icon-col"><span class="fa fa-warning"></span></div><div class="alert_text"><?php echo e($error); ?></div><a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a></div></div> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                             
                    <?php endif; ?>
                </div>
                <?php echo Form::open(array('url' => 'admin/patient_search_result','method' => 'get','id'=>'got')); ?>

                   <?php echo e(csrf_field()); ?>                
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input name="patient_name" class="form-control" id="patient_name" placeholder="" type="text">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">                  
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label>Surname</label>
                    <input name="surename" class="form-control" id="surename" placeholder="" type="text">
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                    <label>Date of Birth</label>                                           
                    <!-- <input class="form-control" type="date" id="dob" name="dob">  -->
                    <input  class="form-control" type="text" id="datepicker-1" name="dob" placeholder="DD/MM/YYYY">                                       
                    </div>
                    </div>
                      
                            
                        <div class="col-sm-12">
                            <div class="form-group"><div class="text-center">---OR---</div></div>
                        </div>                 
                     
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label data-toggle="tooltip" data-placement="top" title="You also can search by Patient ID for fastest way">Patient ID</label>
                                <input  name="medical_record" class="form-control" id="medical_record" placeholder="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary mt-4">Search Patient</button>
                        </div>
                    </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>