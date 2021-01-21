<?php $__env->startSection('content'); ?>
<form class="form-signin" action="" method="POST" onsubmit="hospitalLogin(this); return false;">
    <?php echo e(csrf_field()); ?>

    <div class="input_section">
        <div class="form_header">
            <div class="form_header_logo">
                <img src="<?php echo e(asset('admin/doctor/images/render_logo_white.svg')); ?>" alt="logo">
            </div>
            <div class="form_heading">
                <h3>Dashboard Website</h3>
                <p>You need to login to access render health apps.</p>
            </div>
        </div>
        <!-- <div class="login_options">
             <div class="login_type">
                 <input id="login_doctor" checked type="radio" name="login"/>
                 <label for="login_doctor">
                     <span>
                         <img src="images/check.svg" alt="check">
                     </span>Doctor
                 </label>
             </div>
             <div class="login_type">
                 <input id="login_employee" type="radio" name="login"/>
                 <label for="login_employee">
                     <span>
                         <img src="images/check.svg" alt="check">
                     </span>Employee
                 </label>
              </div>
             <div class="login_type">
                 <input id="login_hospital" type="radio" name="login"/>
                 <label for="login_hospital">
                     <span>
                         <img src="images/check.svg" alt="check">
                     </span>Hospital
                 </label>
             </div>
             <div class="login_type">
                 <input id="login_HMO" type="radio" name="login"/>
                 <label for="login_HMO">
                     <span>
                         <img src="images/check.svg" alt="check">
                     </span>HMO
                 </label>
             </div>
             <div class="login_type">
                 <input id="login_admin" type="radio" name="login"/>
                 <label for="login_admin">
                     <span>
                         <img src="images/check.svg" alt="check">
                     </span>Admin
                 </label>
             </div>
        </div> -->
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger-outline alert-dismissible alert_icon fade show error_msg"  id="error_msg"  role="alert" style="display: none;">
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
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control hospital_email" name="hospital_email" placeholder="your email registered" type="text">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control hospital_password" name="hospital_password" placeholder="your password" type="password">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary mt-3 login_admin" name="button">Login to my account</button>
            </div>
        </div>
    </div>
</form>
<div class="login_footer">
    <div class="container">
        <div class="login_footer_inner">
            <a class="help" href="tel:021-000-1234">
                <div class="help_icon">
                    <img src="<?php echo e(asset('admin/doctor/images/call.svg')); ?>" alt="icon">
                </div>
                <div class="help_desc">
                    <h3>Need Help?</h3>
                    <h4>Call. 0703 242 1768</h4>
                    <small>contact@renderhealth.com</small>
                </div>
            </a>
            <div class="register">
                don’t have account? Please <a href="registration.html">Register First</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.hospital_login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>