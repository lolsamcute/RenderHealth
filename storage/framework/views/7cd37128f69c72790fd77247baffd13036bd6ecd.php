<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="page_head">
                <h1 class="heading">Settings</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="widget">
                <form method="post" name="doctorAccountSetting" id="doctorAccountSetting" action="" onsubmit="changeDocPassword(this); return false;">
                    <?php echo e(csrf_field()); ?>

                    <div class="medical_header">
                        <ul class="nav nav-pills" role="tablist">
                            <li><a class="active" role="tab" data-toggle="pill" href="#account_info">Account Info</a></li>
                            <li><a role="tab" data-toggle="pill" href="#profile">Profile</a></li>
                        </ul>
                    </div>
                    <div class="medical_body padding-40">
                        <div class="tab-content">
                            <div id="account_info" class="tab-pane fade show active">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="alert alert-danger-outline alert-dismissible alert_icon fade show error_msg_settings text-left mb-5" id="error_msg_settings" role="alert" style="display:none;">
                                            <div class="d-flex align-items-center">
                                                <div class="alert-icon-col">
                                                    <span class="fa fa-warning"></span>
                                                </div>
                                                <div class="alert_text error_text_settings">
                                                    Email field is required
                                                </div>
                                                <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Email Account</label>
                                            <input class="form-control doctor_email" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="setting_heading">
                                            Change Password
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input class="form-control crt_password" type="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input class="form-control new_password" type="password">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Re-type New Password</label>
                                                    <input class="form-control cnfrm_password" type="password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary mt-4">Save Setting</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div id="profile" class="tab-pane fade">
                                <form class="doctordata_profile" name="profile" id="profile" method="post" enctype="multipart/form-data" action="">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" id="profile_id" name="profile_id" value="<?php echo e($doctor_details->id); ?>" />
                                    <div class="change_profile">
                                        <?php $get_img = $doctor_details->doctor_picture;
                                        if($get_img == 0){ ?>
                                        <img id="uploadPreview" src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                                        <?php }else{ ?>
                                        <img id="uploadPreview" src="<?php echo e(asset('doctorimages/'.$get_img)); ?>" alt="image">
                                        <?php } ?>
                                        <div class="file_uploading">
                                            <label for="uploading">Upload New Photo Profile</label>
                                            <input type="file" id="uploading" name="images" accept="image/*" value="" />
                                        </div>
                                        <span class="max_size">(max. 2MB)</span>
                                    </div>
                                    <div class="messages" col-12 w-100></div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>First name</label>
                                                <input type="text" id="" disabled name="" class="form-control" value="<?php echo e($doctor_details->doctor_first_name); ?>">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Middle name</label>
                                                <input type="text" id="" name="" disabled class="form-control" value="<?php echo e($doctor_details->doctor_middle_name); ?>">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Last name</label>
                                                <input type="text" id="" name="" disabled class="form-control" value="<?php echo e($doctor_details->doctor_last_name); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="text" id="doctor_email" name="doctor_email" class="form-control" value="<?php echo e($doctor_details->doctor_email); ?>">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label>Mobile Number</label>
                                            <div class="form-group">
                                                <input type="text" id="patient_phone" name="doctor_phone" class="form-control doctor_phone" value="<?php echo e($doctor_details->doctor_phone); ?>">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <input type="text" disabled id="" name="" class="form-control " value="<?php echo e($doctor_details->doctor_role); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Speciality</label>
                                                <input type="text" id="" name="" class="form-control" value="<?php echo e(@$speciality->name); ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Biography</label>
                                                <input type="text" id="biography" name="biography" class="form-control doctor_phone" value="<?php echo e($doctor_details->biography); ?>">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Hospital</label>
                                                <input type="text" id="" name="" class="form-control doctor_phone" value="<?php echo e(@$hospital->hosp_name); ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-12">
                                        <div class="">
                                            <button id="scroll" class="btn btn-black mt-3" type="submit">SAVE CHANGES</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.doctor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>