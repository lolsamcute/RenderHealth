<?php $__env->startSection('content'); ?>
<form class="form-signin" role="form" method="POST" action="" onsubmit="patientLogin(this); return false;">
     <?php echo e(csrf_field()); ?>

    <div class="text-center">
        <img class="mb-4" src="<?php echo e(asset('images/logo.svg')); ?>" alt="logo" width="94">
    </div>
    <h1>Sign in to my account</h1>
    
    <div class="alert alert-danger-outline alert-dismissible alert_icon fade show error_msg" id="error_msg" role="alert" style="display: none;">
        <div class="d-flex align-items-center">
            <div class="alert-icon-col">
                <span class="fa fa-warning"></span>
            </div>
            <div class="alert_text error_text">
                Email field is required
            </div>
            <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
        </div>
    </div>

    <div class="form-group">
        <label>Username</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><img src="<?php echo e(asset('images/mail.svg')); ?>" alt="icon"></span>
            </div>

            <?php if(isset($email) && $email!=""): ?>

                <input type="text" class="form-control patient_email" placeholder="Your username" value="<?php echo e($email); ?>" name ="email">
            <?php else: ?>
                <input type="text" class="form-control patient_email" placeholder="Your username" value="" name ="email">
            <?php endif; ?>
        </div>
        <!-- <small class="invalid-feedback">Email field is required</small> -->
    </div>
    <div class="form-group">
        <a class="forgot_password" data-toggle="modal" data-target="#forgot_password" href="javascript:;">Forgot password?</a>
        <label>Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><img src="<?php echo e(asset('images/lock.svg')); ?>" alt="icon"></span>
            </div>
            <?php if(isset($password) && $password!=""): ?>
                <input type="password" class="form-control patient_password" value="<?php echo e($password); ?>" placeholder="Your password" name ="password">                
            <?php else: ?>
                <input type="password" class="form-control patient_password" value="" placeholder="Your password" name ="password">
            <?php endif; ?>
            
        </div>
    </div>
    <div class="row form-bottom">
        <div class="col-sm-7">
            <div class="form-group form-check">
                <?php if(isset($email) && $email!="" && isset($password) && $password!=""): ?>
                    <input type="checkbox" class="form-check-input form-check-custom" checked id="remember">
                 <?php else: ?>
                    <input type="checkbox" class="form-check-input form-check-custom" id="remember">
                <?php endif; ?>            
                <label class="form-check-label" for="remember">Remember my account</label>
            </div>
        </div>
        <div class="col-sm-5 text-right">
            <button class="btn btn-primary" type="submit">Sign in</button>
        </div>
    </div>
</form>
<div class="login_footer">
    Don't have account?<a href="<?php echo e(url('patient/signup')); ?>">Get Started here</a>
</div>
<!-- Forgot Password Modal -->
<div class="modal fade" id="forgot_password">
    <div class="modal-dialog modal-dialog-centered mforgot">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">                
                <form class="form-signin text-center" id="forgot_form" onsubmit="forgotpassword(this); return false;">
                    <button type="button" class="close mclose" data-dismiss="modal"><img src="<?php echo e(asset('images/cross_modal.svg')); ?>"/></button>
                    <div class="text-center">
                        <img class="mb-4" src="<?php echo e(asset('images/logo.svg')); ?>" alt="logo" width="94">
                    </div>
                    <h1>Lost your password?</h1>
                    <p>Enter email address to receive link to reset password</p>
                    <div class="alert alert-success-outline alert-dismissible alert_icon fade show success_modal_msg" id="success_modal_msg" role="alert" style="display:none;">
                       <div class="d-flex align-items-center">
                           <div class="alert-icon-col">
                               <span class="fa fa-check"></span>
                           </div>
                           <div class="alert_text success_modal_text">
                               You have been successfully registered
                           </div>
                           <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                       </div>
                   </div>
                    <div class="alert alert-danger-outline alert-dismissible alert_icon fade show error_modal_msg" id="error_modal_msg" role="alert" style="display: none;">
                        <div class="d-flex align-items-center">
                            <div class="alert-icon-col">
                                <span class="fa fa-warning"></span>
                            </div>
                            <div class="alert_text error_modal_text text-left">
                                Email field is required
                            </div>
                            <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><img src="<?php echo e(asset('images/mail.svg')); ?>" alt="icon"></span>
                            </div>
                            <input type="text" class="form-control forgot_email" placeholder="Your email">
                        </div>
                    </div>
                    <div class="form-bottom">
                        <button class="btn btn-primary resend_link" type="submit">SEND RESET LINK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>