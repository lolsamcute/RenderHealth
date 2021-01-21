<?php $__env->startSection('content'); ?>
<form class="form-signin" action="" method="POST" onsubmit="adminLogin(this); return false;">
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
                    <input class="form-control admin_email" name="admin_email" placeholder="your email registered" type="text">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control admin_password" name="admin_password" placeholder="your password" type="password">
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
           
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>