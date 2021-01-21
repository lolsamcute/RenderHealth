<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="page_head">
                <h1 class="heading">Manage Members/Patient
                    <a class="add_schedule" data-toggle="modal" data-target="#add_member" href="javascript:;">
                        <img src="<?php echo e(asset('admin/adminimages/add.svg')); ?>" alt="icon">
                    </a>
                </h1>
                <button type="button" data-toggle="modal" data-target="#search_patient" class="btn btn-primary btn-sm">Search Member/Patient</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 main_div">
            <div class="table_hospital pagination_fixed_bottom">
                <div class="table-responsive">
                    <table class="table" cellspacing="10">
                        <tr>
                            <th>MEMBER DATA</th>
                            <th>PATIENT ID</th>
                            <th>DATE OF BIRTH</th>
                            <th>CURRENT PLAN</th>
                            <th>ENDED SUBSCRIPTIONS</th>
                            <th></th>
                        </tr>
                        <?php if(count($all_patients) > 0): ?>
                        <?php $__currentLoopData = $all_patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $all_patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="d_profile">
                                    <div class="d_pro_img">
                                        <?php if((file_exists(getcwd().'/uploads/patient/'.basename($all_patient['patient_profile_img']))) && (!empty($all_patient['patient_profile_img']))){
                                        ?>
                                        <img src="<?php echo e(asset('/uploads/patient/'.$all_patient['patient_profile_img'])); ?>" alt="image">
                                        <?php }
                                        else { ?>
                                        <img src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                                        <?php } ?>

                                    </div>
                                    <div class="d_pro_text">

                                        <h4> <?php if($all_patient['patient_gender']== 0 && $all_patient['patient_gender']!= NULL): ?> Mr.
                                            <?php elseif($all_patient['patient_gender']== 1 && $all_patient['patient_martial_status']== 1): ?>Mrs
                                            <?php elseif($all_patient['patient_gender']== 1): ?> Miss
                                            <?php else: ?>
                                            <?php endif; ?> <?php echo e($all_patient['patient_first_name']); ?> <?php echo e($all_patient['patient_last_name']); ?></h4>
                                        <a href="javascript:;" onclick="ViewPatientProfile(<?php echo $all_patient['patient_unique_id']; ?>);">View Profile</a>
                                    </div>
                                </div>
                            </td>
                            <?php //echo $all_patient['patient_date_of_birth'];
                            ?>

                            <td>PATIENT-<?php echo e($all_patient['patient_unique_id']); ?></td>
                            <td><?php if(!empty($all_patient['patient_date_of_birth'])): ?> <?php echo e(date('d M, Y',$all_patient['patient_date_of_birth'])); ?> <?php else: ?> <?php echo e("--"); ?> <?php endif; ?> </td>
                            <td><?php echo e($all_patient['patient_insurance']); ?></td>
                            <td><?php if(!empty($all_patient['patient_end_subscription'])): ?><?php echo e(date('d M, Y',$all_patient['patient_end_subscription'])); ?> <?php else: ?> <?php echo e("--"); ?> <?php endif; ?></td>
                            <td>
                                <a href="<?php echo e(url('/admin/medical_records/'.$all_patient['patient_unique_id'])); ?>" class="btn btn-light btn-xs mr-2" name="button"><img class="icon" src="<?php echo e(asset('admin/adminimages/eye.svg')); ?>" alt="icon">View Record(s)</a>
                                <a href="#" onclick="removePatients(<?php echo $all_patient['patient_unique_id'] ?>)" class="btn btn-light btn-xs btn_delete_deal" name="button">
                                    <img class="icon" src="<?php echo e(asset('admin/adminimages/delete.svg')); ?>" alt="icon">Delete
                                </a>
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
                    <button type="button" class="btn btn-light btn-xs pre_mem" <?php if ($all_patients->previousPageUrl()) {
                                                                                } else {
                                                                                    echo "disabled";
                                                                                } ?> data-url="<?php echo $all_patients->previousPageUrl(); ?>&type=mem_page">Previous Page</button>
                    <input type="hidden" class="mem_page_hidden" value="<?php echo e($all_patients->currentPage()); ?>">
                    <span>Page <?php echo e($all_patients->currentPage()); ?> of <?php echo e($all_patients->lastPage()); ?> Pages</span>
                    <button type="button" class="btn btn-light btn-xs next_mem" <?php if ($all_patients->nextPageUrl()) {
                                                                                } else {
                                                                                    echo "disabled";
                                                                                } ?> data-url="<?php echo $all_patients->nextPageUrl(); ?>&type=mem_page">Next Page</button>
                </div>
            </div>
        </div>
</main>
<div class="modal fade" id="search_patient">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width1">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Search Member/Patient</h3>
                <button type="button" id="search_patient_modal" class="close" data-dismiss="modal"><img src="<?php echo e(asset('admin/adminimages/popup_close.svg')); ?>" /></button>
            </div>
            <div class="modal-body">
                <form id="search_patient_form" name="search_patient_form" method="GET">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" placeholder="" class="form-control" name="patient_name" id="patient_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Surname</label>
                                <input type="text" placeholder="" class="form-control" value="" name="patient_surname" id="patient_surname">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <input type="text" class="form-control datepicker" name="patient_dob" value="" id="patient_dob" placeholder="DD/MM/YYYY">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="text-center">----OR----</div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Patient ID</label>
                                <input type="text" placeholder="" class="form-control" value="" name="patient_recno" id="patient_recno">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mb-3 mt-3" name="button">Search Patient</button>
                        </div>
                    </div>
                    <input type="hidden" id="patient_name_hidden">
                    <input type="hidden" id="patient_surname_hidden">
                    <input type="hidden" id="patient_recno_hidden">
                    <input type="hidden" id="patient_dob_hidden">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Member/Patient screen -->
<div class="modal fade" id="add_member">
    <div class="modal-dialog modal-md modal-dialog-centered genmodal genmodal_custom custom_width3">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add Member/Patient</h3>
                <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(asset('admin/adminimages/popup_close.svg')); ?>" /></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger-outline alert-danger-outline-addmember alert-dismissible alert_icon fade show" role="alert" style="display: none;">
                    <div class="d-flex align-items-center">
                        <div class="alert-icon-col">
                            <span class="fa fa-warning"></span>
                        </div>
                        <div class="alert_text addmember_danger_pop">

                        </div>
                        <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                    </div>
                </div>
                <div class="alert alert-success-outline alert-success-outline-addmember alert-dismissible alert_icon fade show" role="alert" style="display: none;">
                    <div class="d-flex align-items-center">
                        <div class="alert-icon-col">
                            <span class="fa fa-check"></span>
                        </div>
                        <div class="alert_text addmember_success_pop">

                        </div>
                        <a href="#" class="close alert_close" data-dismiss="alert" aria-label="close"><i class="fa fa-close"></i></a>
                    </div>
                </div>
                <form id="add_member_form" name="add_member_form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                    <div class="form-group">
                        <label>Title</label>
                        <div class="select_box width220">
                        <select class="form-control" name="patient_title" id="patient_title">
                            <option value="" selected>Select Title</option>
                            <option value="Dr.">Dr.</option>
                            <option value="Professor">Professor</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Miss">Miss</option>
                        </select>
                        </div>
                    </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" class="form-control patient_first_name" placeholder="First name" name="patient_first_name">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Middle name</label>
                                <input type="text" class="form-control patient_middle_name" placeholder="Middle name" name="patient_middle_name">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" class="form-control patient_last_name" placeholder="Last name" name="patient_last_name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control patient_email" placeholder="Your email" name="patient_email" id="patient_email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label><br>
                                <input type="text" class="form-control patient_phone" placeholder="Phone number" name="patient_phone" id="patient_phone" value="+234" style="margin-right:207px;">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control patient_password" placeholder="Password" name="patient_password" id="patient_password">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control c_password re_pass" placeholder="Re-enter password" name="c_password" id="c_password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control patient_address" placeholder="Address" name="patient_address" id="patient_address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>State</label>
                                <div class="select_box width220">
                                    <select class="form-control patient_state" name="patient_state" id="hospital_state_nigeria">
                                        <option value="0" data-id="0" selected>Select State</option>
                                        <?php if(count($statesNigeria) > 0): ?>
                                        <?php $__currentLoopData = $statesNigeria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option data-id="<?php echo e($state['id']); ?>" value="<?php echo e($state['name']); ?>"><?php echo e($state['name']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>LGA</label>
                                <div class="select_box width2201">
                                    <select class="form-control lga" name="lga" id="lga">
                                        <option value="0" data-id="0" selected>Select LGA</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" placeholder="City" class="form-control patient_city" id="hosp_city" name="patient_city">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <label>Date Of Birth</label>
                            <div class="select_box">
                                <select id="select_num" class="form-control" name="day" style="background-color: #fff;">
                                    <option value="">Select Day</option>
                                    <?php for ($i = 1; $i <= 31; $i++) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }   ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-2 px-0">
                            <label>&nbsp;</label>
                            <div class="select_box">
                                <select id="select_day" class="form-control" name="month" style="background-color: #fff;">
                                    <option value="">Select Month</option>
                                    <?php for ($m = 1; $m <= 12; $m++) {
                                        $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                                        echo '<option value="' . $month . '">' . $month . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <label>&nbsp;</label>
                            <div class="select_box">
                                <select class="form-control" id="year" name="years" style="background-color: #fff;">
                                    <option value="">Select Year</option>
                                    <?php
                                    $date = date('Y');
                                    $new_date =$date-12;
                                    $range = 1900;
                                    for($i=$range;$i<=$new_date; $i++){ $year=$range++; ?> <option id="year_get" value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                        <?php
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">

                            <label>Gender</label>
                            <div class="form-group">
                                <div class="select_box width220">
                                    <select class="form-control " name="patient_gender" id="patient_gender">
                                        <option value="1">Female</option>
                                        <option value="0">Male</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label>Marital Status</label>
                            <div class="doctor_table_record">
                                <select class="form-control" name="patient_martial_status" id="patient_martial_status">
                                    <option value="1">Married</option>
                                    <option value="0">Single</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>State Of Origin</label>
                                <input type="text" class="form-control patient_origin_state" placeholder="State Of Origin" name="patient_origin_state" id="patient_origin_state">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Religion</label>
                                <input type="text" class="form-control religion" placeholder="Religion" name="religion" id="religion">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Language</label>
                                <div class="select_box1 mb-2">
                                    <input type="text" id="patient_languages" class="form-control patient_languages" name="patient_languages" value="" id="patient_languages">
                                </div>
                                <div class="input_tags">
                                    <ul id="top">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Education School</label>
                                <div class="select_box1 mb-2">
                                <input type="text" placeholder="" class="form-control"  name="edu_school" id="edu_school">
                                </div>
                                <div class="input_tags">
                                    <ul id="top">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Insurance</label>
                                <input type="text" class="form-control patient_insurance" placeholder="Insurance" name="patient_insurance" id="patient_insurance">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Preffered Hospital</label>
                                <select class="form-control patient_visited_hospital" name="patient_visited_hospital" id="patient_visited_hospital">
                                    <option value="">Select Hospital</option>
                                    <?php if(count($hospitals) > 0): ?>
                                    <?php $__currentLoopData = $hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($hospital->hosp_id); ?>"><?php echo e($hospital->hosp_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="multi-field-wrapper">
                        <div class="patient_profile">
                            <h4>Dependent</h4>
                            <a class="add_schedule add-field"  href="javascript:;">
                                <img src="<?php echo e(asset('admin/adminimages/add.svg')); ?>" alt="icon">
                            </a>
                        </div>
                        <div class="multi-fields">
                            <div class="row multi-field">
                                <div class="col-sm-2 ">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control patient_first_name" placeholder="Name" name="dependentname[]">
                                    </div>
                                </div>
                                <div class="col-2 ">
                                    <label>Date Of Birth </label>
                                    <div class="select_box">
                                        <select id="select_num" class="form-control" name="dependentday[]" style="background-color: #fff;">
                                            <option value="">Select Day</option>
                                            <?php for ($i = 1; $i <= 31; $i++) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }   ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 ">
                                    <label>&nbsp;</label>
                                    <div class="select_box">
                                        <select id="select_day" class="form-control" name="dependentmonth[]" style="background-color: #fff;">
                                            <option value="">Select Month</option>
                                            <?php for ($m = 1; $m <= 12; $m++) {
                                                $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                                                echo '<option value="' . $month . '">' . $month . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 ">
                                    <label>&nbsp;</label>
                                    <div class="select_box">
                                        <select class="form-control" id="year" name="dependentyears[]" style="background-color: #fff;">
                                            <option value="">Select Year</option>
                                            <?php
                                            $date = date('Y');
                                            $new_date =$date-12;
                                            $range = 1900;
                                            for($i=$range;$i<=$new_date; $i++){ $year=$range++; ?> <option id="year_get" value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                                <?php
                                                }
                                                ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-sm-2 ">
                                    <div class="form-group">
                                        <label>Relationship</label>
                                        <input type="text" class="form-control patient_first_name" placeholder="First name" name="dependentrelationship[]">
                                    </div>
                                </div>
                                <div class="col-sm-2 remove-field mt-4" style="margin-top:35px !important">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <a class=" remove-field"  href="javascript:;">
                                            <img src="<?php echo e(asset('admin/doctor/images/del_sr.svg')); ?>" alt="icon" width="28px">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                       
                    </div>
                    <strong><h4>Next Of Kin</h4></strong>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" class="form-control next_first_name" placeholder="First name" name="next_first_name" id="next_first_name">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Surname</label>
                                <input type="text" class="form-control next_surname" placeholder="Surname" name="next_surname" id="next_surname">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control next_phone" placeholder="Phone Number" name="next_phone" id="next_phone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mb-3 mt-3" name="button">Add Member/Patient</button>
                        </div>
                    </div>
                    <input type="hidden" id="default_image" value="<?php echo e(asset('admin/adminimages/thumb.svg')); ?>">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- View Profile Modal -->
<div class="modal fade" id="view_profile">
    <div class="modal-dialog modal-lg modal-dialog-centered genmodal view_profile_modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Patient Profile</h3>
                <button type="button" class="close" data-dismiss="modal"><img src="<?php echo e(asset('admin/doctor/images/popup_close_w.svg')); ?>" /></button>
            </div>
            <div class="modal-body">
                <div class="my_profile_section">
                    <div class="profile_name">
                        <div class="profile_d_image">
                            <img src="<?php echo e(asset('admin/doctor/images/profile.svg')); ?>" alt="">
                        </div>
                        <h4></h4>
                        <h6></h6>
                        <span class="patient_id_detail"></span>
                    </div>
                    <div class="widget_profile_desc patient_profile_md mb-0">
                        <ul>
                            <li id="address">
                                <span>
                                    <img src="<?php echo e(asset('admin/doctor/images/location.svg')); ?>" alt="icon">
                                </span>
                                <p></p>
                            </li>
                            <li id="marital_status">
                                <span>
                                    <img src="<?php echo e(asset('admin/doctor/images/gender.svg')); ?>" alt="icon">
                                </span>
                                <p></p>
                            </li>
                            <li id="language">
                                <span>
                                    <img src="<?php echo e(asset('admin/doctor/images/mic.svg')); ?>" alt="icon">
                                </span>
                                <p></p>
                            </li>
                            <li id="Birthday">
                                <span>
                                    <img src="<?php echo e(asset('admin/doctor/images/bday.svg')); ?>" alt="icon">
                                </span>
                                <p></p>
                            </li>
                            <li>
                                <span>
                                    <img src="<?php echo e(asset('admin/doctor/images/drop.svg')); ?>" alt="icon">
                                </span>
                                <p id="blood_group"> </p>

                                <p class="blood_group2" style="display: none;">Blood type : </p>
                                <div class="select_box select_blood_type blood_group2" style="display: none;">
                                    <select class="form-control">
                                        <option value="O-">O-</option>
                                        <option value="O+">O+</option>
                                        <option value="A-">A-</option>
                                        <option value="A+">A+</option>
                                        <option value="B-">B-</option>
                                        <option value="B+">B+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="AB+">AB+</option>
                                    </select>
                                </div>

                            </li>
                            <li>
                                <span>
                                    <img src="<?php echo e(asset('admin/doctor/images/group.svg')); ?>" alt="icon">
                                </span>
                                <p>State Of Origin : <span id="state_of_origin">Yoruba</span></p>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>