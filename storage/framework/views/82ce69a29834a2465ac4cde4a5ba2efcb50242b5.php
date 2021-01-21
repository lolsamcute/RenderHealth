<?php $__env->startSection('content'); ?>
<main class="col-12 col-md-12 col-xl-12 bd-content">
    <div class="row">
        <div class="col-12">
            <div class="widget">
                <div class="widget_header mb-4">
                    <h2>Settings</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="widget_body mb-4">
                            <div class="settings">
                                <!-- Nav pills -->
                                <ul class="nav nav-pills" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link " data-toggle="pill" href="#Account">Account</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#Profile">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#Notifications">Notifications & Others</a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div id="Account" class="tab-pane">
                                        <form method="post" name="accountSetting" id="accountSetting" action="">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" id="account_id" name="account_id" value="<?php echo e($patient[0]->id); ?>" />
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-group mb-4">
                                                        <div class="messages_account" col-12 w-100></div>
                                                        <label>Email Address</label>
                                                        <input type="email" class="form-control" value="" name="account_email" id="account_email">
                                                    </div>
                                                    <h3 class="form_head">Change Password</h3>
                                                    <div class="form-group">
                                                        <label>Current Password</label>
                                                        <input type="password" class="form-control" value="" name="account_password" id="account_password">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>New Password</label>
                                                                <input type="password" class="form-control" value="" name="account_new_password" id="account_new_password">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Confirm New Password</label>
                                                                <input type="password" class="form-control" value="" name="account_conf_password" id="account_conf_password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-black mt-3">SAVE CHANGES</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                    <div id="Profile" class="tab-pane active">
                                        <?php $__currentLoopData = $patient; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patients_details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <form class="d_profile" name="profile" id="profile" method="post" enctype="multipart/form-data" action="">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" id="profile_id" name="profile_id" value="<?php echo e($patients_details->id); ?>" />
                                            <div class="change_profile">
                                                <?php $get_img = $patients_details->patient_profile_img;
                                                if($get_img == 0){ ?>
                                                <img id="uploadPreview" src="<?php echo e(asset('images/profile.svg')); ?>" alt="image">
                                                <?php }else{ ?>
                                                <img id="uploadPreview" src="<?php echo e(asset('uploads/patient/'.$get_img)); ?>" alt="image">
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
                                                        <input type="text" id="patient_first_name" name="patient_first_name" class="form-control" value="<?php echo e($patients_details->patient_first_name); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Middle name</label>
                                                        <input type="text" id="patient_middle_name" name="patient_middle_name" class="form-control" value="<?php echo e($patients_details->patient_middle_name); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Last name</label>
                                                        <input type="text" id="patient_last_name" name="patient_last_name" class="form-control" value="<?php echo e($patients_details->patient_last_name); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Email Address</label>
                                                        <input type="text" id="patient_email" name="patient_email" class="form-control" value="<?php echo e($patients_details->patient_email); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Mobile Number</label>
                                                        <input type="text" id="patient_phone" name="patient_phone" class="form-control patient_phone" value="<?php echo e($patients_details->patient_phone); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Emergency Number</label>
                                                        <input type="text" id="emergency_phone" name="emergency_phone" class="form-control emergency_phone" value="<?php echo e($patients_details->emergency_phone); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" id="patient_address" name="patient_address" class="form-control" value="<?php echo e($patients_details->patient_address); ?>">
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
                                                                <option data-id="<?php echo e($state['id']); ?>" <?php echo e($patients_details->patient_state==$state['name']?'selected':''); ?> value="<?php echo e($state['name']); ?>"><?php echo e($state['name']); ?></option>
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
                                                                <?php if(count($patients_details->localGovernment) > 0): ?>
                                                                <?php $__currentLoopData = $patients_details->localGovernment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localGovernment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option data-id="<?php echo e($localGovernment['id']); ?>" <?php echo e($patients_details->lga==$localGovernment['name']?'selected':''); ?> value="<?php echo e($localGovernment['name']); ?>"><?php echo e($localGovernment['name']); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" placeholder="City" class="form-control patient_city" id="hosp_city" name="patient_city" value="<?php echo e($patients_details->patient_city); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Birthday</label>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="select_box">
                                                                    <select id="select_num" class="form-control" name="day">
                                                                        <?php $selected_day_num = date('d',$patients_details->patient_date_of_birth); ?>
                                                                        <option value="1" <?php if ($selected_day_num == '01') {
                                                                                                echo "selected";
                                                                                            } ?>>1</option>
                                                                        <option value="2" <?php if ($selected_day_num == '02') {
                                                                                                echo "selected";
                                                                                            } ?>>2</option>
                                                                        <option value="3" <?php if ($selected_day_num == '03') {
                                                                                                echo "selected";
                                                                                            } ?>>3</option>
                                                                        <option value="4" <?php if ($selected_day_num == '04') {
                                                                                                echo "selected";
                                                                                            } ?>>4</option>
                                                                        <option value="5" <?php if ($selected_day_num == '05') {
                                                                                                echo "selected";
                                                                                            } ?>>5</option>
                                                                        <option value="6" <?php if ($selected_day_num == '06') {
                                                                                                echo "selected";
                                                                                            } ?>>6</option>
                                                                        <option value="7" <?php if ($selected_day_num == '07') {
                                                                                                echo "selected";
                                                                                            } ?>>7</option>
                                                                        <option value="8" <?php if ($selected_day_num == '08') {
                                                                                                echo "selected";
                                                                                            } ?>>8</option>
                                                                        <option value="9" <?php if ($selected_day_num == '09') {
                                                                                                echo "selected";
                                                                                            } ?>>9</option>
                                                                        <option value="10" <?php if ($selected_day_num == '10') {
                                                                                                echo "selected";
                                                                                            } ?>>10</option>
                                                                        <option value="11" <?php if ($selected_day_num == '11') {
                                                                                                echo "selected";
                                                                                            } ?>>11</option>
                                                                        <option value="12" <?php if ($selected_day_num == '12') {
                                                                                                echo "selected";
                                                                                            } ?>>12</option>
                                                                        <option value="13" <?php if ($selected_day_num == '13') {
                                                                                                echo "selected";
                                                                                            } ?>>13</option>
                                                                        <option value="14" <?php if ($selected_day_num == '14') {
                                                                                                echo "selected";
                                                                                            } ?>>14</option>
                                                                        <option value="15" <?php if ($selected_day_num == '15') {
                                                                                                echo "selected";
                                                                                            } ?>>15</option>
                                                                        <option value="16" <?php if ($selected_day_num == '16') {
                                                                                                echo "selected";
                                                                                            } ?>>16</option>
                                                                        <option value="17" <?php if ($selected_day_num == '17') {
                                                                                                echo "selected";
                                                                                            } ?>>17</option>
                                                                        <option value="18" <?php if ($selected_day_num == '18') {
                                                                                                echo "selected";
                                                                                            } ?>>18</option>
                                                                        <option value="19" <?php if ($selected_day_num == '19') {
                                                                                                echo "selected";
                                                                                            } ?>>19</option>
                                                                        <option value="20" <?php if ($selected_day_num == '20') {
                                                                                                echo "selected";
                                                                                            } ?>>20</option>
                                                                        <option value="21" <?php if ($selected_day_num == '21') {
                                                                                                echo "selected";
                                                                                            } ?>>21</option>
                                                                        <option value="22" <?php if ($selected_day_num == '22') {
                                                                                                echo "selected";
                                                                                            } ?>>22</option>
                                                                        <option value="23" <?php if ($selected_day_num == '23') {
                                                                                                echo "selected";
                                                                                            } ?>>23</option>
                                                                        <option value="24" <?php if ($selected_day_num == '24') {
                                                                                                echo "selected";
                                                                                            } ?>>24</option>
                                                                        <option value="25" <?php if ($selected_day_num == '25') {
                                                                                                echo "selected";
                                                                                            } ?>>25</option>
                                                                        <option value="26" <?php if ($selected_day_num == '26') {
                                                                                                echo "selected";
                                                                                            } ?>>26</option>
                                                                        <option value="27" <?php if ($selected_day_num == '27') {
                                                                                                echo "selected";
                                                                                            } ?>>27</option>
                                                                        <option value="28" <?php if ($selected_day_num == '28') {
                                                                                                echo "selected";
                                                                                            } ?>>28</option>
                                                                        <option value="29" <?php if ($selected_day_num == '29') {
                                                                                                echo "selected";
                                                                                            } ?>>29</option>
                                                                        <option value="30" <?php if ($selected_day_num == '30') {
                                                                                                echo "selected";
                                                                                            } ?>>30</option>
                                                                        <option value="31" <?php if ($selected_day_num == '31') {
                                                                                                echo "selected";
                                                                                            } ?>>31</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-4 px-0">
                                                                <div class="select_box">
                                                                    <select id="select_day" class="form-control" name="month">
                                                                        <?php $selected_date = date('F',$patients_details->patient_date_of_birth); ?>
                                                                        <option value="January" <?php if ($selected_date == 'January') {
                                                                                                    echo "selected";
                                                                                                } ?>>January</option>
                                                                        <option value="February" <?php if ($selected_date == 'February') {
                                                                                                        echo "selected";
                                                                                                    } ?>>February</option>
                                                                        <option value="March" <?php if ($selected_date == 'March') {
                                                                                                    echo "selected";
                                                                                                } ?>>March</option>
                                                                        <option value="April" <?php if ($selected_date == 'April') {
                                                                                                    echo "selected";
                                                                                                } ?>>April</option>
                                                                        <option value="May" <?php if ($selected_date == 'May') {
                                                                                                echo "selected";
                                                                                            } ?>>May</option>
                                                                        <option value="June" <?php if ($selected_date == 'June') {
                                                                                                    echo "selected";
                                                                                                } ?>>June</option>
                                                                        <option value="July" <?php if ($selected_date == 'July') {
                                                                                                    echo "selected";
                                                                                                } ?>>July</option>
                                                                        <option value="August" <?php if ($selected_date == 'August') {
                                                                                                    echo "selected";
                                                                                                } ?>>August</option>
                                                                        <option value="September" <?php if ($selected_date == 'September') {
                                                                                                        echo "selected";
                                                                                                    } ?>>September</option>
                                                                        <option value="October" <?php if ($selected_date == 'October') {
                                                                                                    echo "selected";
                                                                                                } ?>>October</option>
                                                                        <option value="November" <?php if ($selected_date == 'November') {
                                                                                                        echo "selected";
                                                                                                    } ?>>November</option>
                                                                        <option value="December" <?php if ($selected_date == 'December') {
                                                                                                        echo "selected";
                                                                                                    } ?>>December</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="select_box">
                                                                    <select class="form-control" id="year" name="years">
                                                                        <?php
                                                                        $selected_year = date('Y',$patients_details->patient_date_of_birth);
                                                                        $date = date('Y');
                                                                        $new_date =$date-12;
                                                                        $range = 1900;
                                                                        for($i=$range;$i<=$new_date; $i++){ $year=$range++; if($selected_year==$year){ $selected='selected' ; }else{ $selected='' ; } ?> <option id="year_get" value="<?php echo e($year); ?>" <?php echo e($selected); ?>><?php echo e($year); ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Sex Gender</label>
                                                        <div class="select_box">
                                                            <?php $gender = $patients_details->patient_gender; ?>
                                                            <select class="form-control" name="gender">
                                                                <option value="0" <?php if ($gender == '0') {
                                                                                        echo "selected";
                                                                                    } ?>>Male</option>
                                                                <option value="1" <?php if ($gender == '1') {
                                                                                        echo "selected";
                                                                                    } ?>>Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Marital Status</label>
                                                        <div class="select_box">
                                                            <?php $marital_status = $patients_details->patient_martial_status; ?>
                                                            <select class="form-control" name="patient_martial_status">
                                                                <option value="0" <?php if ($marital_status == '0') {
                                                                                        echo "selected";
                                                                                    } ?>>Unmarried</option>
                                                                <option value="1" <?php if ($marital_status == '1') {
                                                                                        echo "selected";
                                                                                    } ?>>Married</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row col-12">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>State Of Origin</label>
                                                            <input class="form-control" type="text" id="patient_origin_state" name="patient_origin_state" value="<?php echo e($patients_details->patient_origin_state); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Blood Type</label>
                                                            <div class="select_box">
                                                                <select class="form-control" name="blood" disabled>
                                                                    <?php $selected_blood = $patients_details->patient_blood_type; ?>
                                                                    <option value="A+" <?php if ($selected_blood == 'A+') {
                                                                                            echo "selected";
                                                                                        } ?>>A+</option>
                                                                    <option value="B+" <?php if ($selected_blood == 'B+') {
                                                                                            echo "selected";
                                                                                        } ?>>B+</option>
                                                                    <option value="O+" <?php if ($selected_blood == 'O+') {
                                                                                            echo "selected";
                                                                                        } ?>>O+</option>
                                                                    <option value="AB+" <?php if ($selected_blood == 'AB+') {
                                                                                            echo "selected";
                                                                                        } ?>>AB+</option>
                                                                    <option value="A-" <?php if ($selected_blood == 'A-') {
                                                                                            echo "selected";
                                                                                        } ?>>A-</option>
                                                                    <option value="B-" <?php if ($selected_blood == 'B-') {
                                                                                            echo "selected";
                                                                                        } ?>>B-</option>
                                                                    <option value="O-" <?php if ($selected_blood == 'O-') {
                                                                                            echo "selected";
                                                                                        } ?>>O-</option>
                                                                    <option value="AB-" <?php if ($selected_blood == 'AB-') {
                                                                                            echo "selected";
                                                                                        } ?>>AB-</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Religion</label>
                                                            <input type="text" class="form-control religion" placeholder="Religion" name="religion" id="religion" value="<?php echo e($patients_details->religion); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row col-12">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Language</label>
                                                            <div class="select_box1 mb-2">
                                                                <input type="text" id="patient_languages" class="form-control" name="patient_languages" value="">
                                                            </div>
                                                            <div class="input_tags">
                                                                <ul id="top">
                                                                    <?php
                                                                    $get_language = $patients_details->patient_languages;
                                                                    $language_each = explode(",", $get_language);
                                                                    foreach($language_each as $language){
                                                                    if(!empty($language)){
                                                                    ?>
                                                                    <li>
                                                                        <div class="lang"><?php print_r($language); ?></div>
                                                                        <span class="delete_lang"><img src="<?php echo e(asset('admin/doctor/images/x_tag.svg')); ?>" alt="delete"></span>
                                                                    </li>

                                                                    <?php }
                                                                    } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="multi-field-wrapper">
                                                    <div class="patient_profile col-12">
                                                        <h4>Dependent</h4>
                                                        <a class="add_schedule add-field" href="javascript:;">
                                                            <img src="<?php echo e(asset('admin/adminimages/add.svg')); ?>" class="add_new" alt="icon" width="28px">
                                                        </a>
                                                    </div>

                                                    <div class="multi-fields col-12">
                                                        <?php if(count($hospitals_dependent) > 0): ?>
                                                        <?php $__currentLoopData = $hospitals_dependent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dependent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="row multi-field">
                                                            <div class="col-2">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" class="form-control patient_first_name" placeholder="Name" name="dependentname[]" value="<?php echo e($dependent->name ? $dependent->name : ''); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <label>Date Of Birth </label>
                                                                <div class="select_box">
                                                                    <select id="select_num" class="form-control" name="dependentday[]" style="background-color: #fff;">
                                                                        <option value="">Day</option>
                                                                        <?php for ($i = 1; $i <= 31; $i++) {
                                                                            $dayselected = $dependent->day && $dependent->day == $i ? 'selected' : '' ;
                                                                            echo '<option value="' . $i . '" '.$dayselected.'>' . $i . '</option>';
                                                                        }   ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <label>&nbsp;</label>
                                                                <div class="select_box">
                                                                    <select id="select_day" class="form-control" name="dependentmonth[]" style="background-color: #fff;">
                                                                        <option value="">Month</option>
                                                                        <?php for ($m = 1; $m <= 12; $m++) {
                                                                            $month = date('F', mktime(0, 0, 0, $m, 1, date('Y')));
                                                                            $selected = $dependent->month && $dependent->month == $month ? 'selected' : '' ;
                                                                            echo '<option value="' . $month . '" '.$selected.'>' . $month . '</option>';
                                                                        } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <label>&nbsp;</label>
                                                                <div class="select_box">
                                                                    <select class="form-control" id="year" name="dependentyears[]" style="background-color: #fff;">
                                                                        <option value="">Year</option>
                                                                        <?php
                                                                        $date = date('Y');
                                                                        $new_date =$date-12;
                                                                        $range = 1900;
                                                                        for($i=$range;$i<=$new_date; $i++){ $year=$range++; ?> <option id="year_get" value="<?php echo e($year); ?>" <?php echo isset($dependent->years) && $dependent->years == $year ? 'selected' : '' ?>><?php echo e($year); ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-2">
                                                                <div class="form-group">
                                                                    <label>Relationship</label>
                                                                    <input type="text" class="form-control patient_first_name" placeholder="First name" name="dependentrelationship[]" value=" <?php echo isset($dependent->relationship) ? $dependent->relationship: '' ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-2 remove-field mt-4" style="margin-top:35px !important">
                                                                <div class="form-group">
                                                                    <label>&nbsp;</label>
                                                                    <a class="remove-field" href="javascript:;">
                                                                        <img src="<?php echo e(asset('admin/doctor/images/del_sr.svg')); ?>" alt="icon" width="28px">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
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
                                                        <?php endif; ?>
                                                    </div>


                                                </div>
                                                <strong class="col-12">
                                                    <h4>Next Of Kin</h4>
                                                </strong>
                                                <div class="row col-12">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>First name</label>
                                                            <input type="text" class="form-control next_first_name" placeholder="First name" name="next_first_name" id="next_first_name" value="<?php echo e($patients_details->next_first_name); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Surname</label>
                                                            <input type="text" class="form-control next_surname" placeholder="Surname" name="next_surname" id="next_surname" value="<?php echo e($patients_details->next_surname); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                            <input type="text" class="form-control next_phone patient_phone" placeholder="Phone Number" name="next_phone" id="next_phone" value="<?php echo e($patients_details->next_phone); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row col-6">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Insurance</label>
                                                            <div class="select_box1 mb-2">
                                                                <input class="form-control" type="text" id="patient_insurance" name="patient_insurance" value="<?php echo e($patients_details->patient_insurance); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Preffered Hospital</label>
                                                        <select class="form-control patient_visited_hospital" name="patient_visited_hospital" id="patient_visited_hospital">
                                                            <option value="">Select Hospital</option>
                                                            <?php if(count($hospitals) > 0): ?>
                                                            <?php $__currentLoopData = $hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($hospital->hosp_id); ?>" <?php if ($patients_details->patient_visited_hospital == $hospital->hosp_id) {echo "selected"; } ?>><?php echo e($hospital->hosp_name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row col-12">
                                                    <div class="col-12">
                                                        <button id="scroll" class="btn btn-black mt-3" type="submit">SAVE CHANGES</button>
                                                    </div>
                                                </div>
                                                </form>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>

                                    <div id="Notifications" class="tab-pane fade">
                                        <div class="messages1" col-12 w-100></div>
                                        <h3 class="form_head">Mail & Notifications Setting</h3>
                                        <form name="notifications_other" id="notifications_other" method="post" action="#">
                                            <?php echo e(csrf_field()); ?>

                                            <div class="p_notify">
                                                <input type="hidden" id="notifications_id" name="notifications_id" value="<?php echo e($patients_details->id); ?>" />
                                                <div class="form-group form-check">
                                                    <?php
                                                    $activty_email = 0;
                                                    $newsletter = 0;
                                                    $history_email = 0;
                                                    if(count($patients_notification) > 0){
                                                    $activty_email = $patients_notification[0]->appointment_activity_email;
                                                    $activty_push = $patients_notification[0]->appointment_activity_push;
                                                    $activty_sms = $patients_notification[0]->appointment_activity_sms;
                                                    $cancel_email = $patients_notification[0]->appointment_cancel_email;
                                                    $cancel_push = $patients_notification[0]->appointment_cancel_push;
                                                    $cancel_sms = $patients_notification[0]->appointment_cancel_sms;
                                                    $reschedule_email = $patients_notification[0]->appointment_reschedule_email;
                                                    $reschedule_push = $patients_notification[0]->appointment_reschedule_push;
                                                    $reschedule_sms = $patients_notification[0]->appointment_reschedule_sms;
                                                    $newsletter = $patients_notification[0]->newsletter_subscription;
                                                    $history_email = $patients_notification[0]->patient_history_notification;
                                                    $history_push = $patients_notification[0]->patient_history_push;
                                                    $appt_reminder_push = $patients_notification[0]->patient_appt_reminder_push;
                                                    $appt_reminder_sms = $patients_notification[0]->patient_appt_reminder_sms;
                                                    $bill_push = $patients_notification[0]->patient_bill_push;
                                                    $bill_email = $patients_notification[0]->patient_bill_sms;
                                                    $heath_diary_push = $patients_notification[0]->heath_diary_push;
                                                    $outstanding_bill_push = $patients_notification[0]->outstanding_bill_push;
                                                    $outstanding_bill_email = $patients_notification[0]->outstanding_bill_email;
                                                    }
                                                    ?>
                                                    <input class="form-check-input form-check-custom" id="pn1" name="patient_activty" type="checkbox"/ value="1" <?php if (isset($activty_email) && $activty_email == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn1">Send Appointment scheduling to my email</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn2" name="patient_activty_push" type="checkbox"/ value="1" <?php if (isset($activty_push) && $activty_push == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn2">Send Appointment scheduling to my device</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn3" name="patient_activty_sms" type="checkbox"/ value="1" <?php if (isset($activty_sms) && $activty_sms == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn3">Send Appointment scheduling to me by sms</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn4" name="appt_cancel_email" type="checkbox"/ value="1" <?php if (isset($activty_sms) && $cancel_email == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn4">Send Appointment cancellation to my email</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn5" name="appt_cancel_push" type="checkbox"/ value="1" <?php if (isset($activty_sms) && $cancel_push == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn5">Send Appointment cancellation to my device</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn6" name="appt_cancel_sms" type="checkbox"/ value="1" <?php if (isset($activty_sms) && $cancel_sms == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn6">Send Appointment cancellation to me by sms</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn7" name="appt_reschedule_email" type="checkbox"/ value="1" <?php if (isset($activty_sms) && $reschedule_email == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn7">Send Appointment rescheduling to my email</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn8" name="appt_reschedule_device" type="checkbox"/ value="1" <?php if (isset($reschedule_push) && $reschedule_push == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn8">Send Appointment rescheduling to my device</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn9" name="appt_reschedule_sms" type="checkbox"/ value="1" <?php if (isset($reschedule_sms) && $reschedule_sms == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn9">Send Appointment rescheduling to me by sms</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn10" name="patient_history_push" type="checkbox"/ value="1" <?php if (isset($history_push) && $history_push == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn10">Send Health History activity to my device</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn11" name="patient_history_email" type="checkbox"/ value="1" <?php if (isset($history_email) && $history_email == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn11">Send Health History activity to my email</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn12" name="appt_reminder_push" type="checkbox"/ value="1" <?php if (isset($appt_reminder_push) && $appt_reminder_push == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn12">Send Appointment Reminder to my device</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn18" name="appt_reminder_sms" type="checkbox"/ value="1" <?php if (isset($appt_reminder_sms) && $appt_reminder_sms == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn18">Send Appointment Reminder to me by sms</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn13" name="bill_email" type="checkbox"/ value="1" <?php if (isset($bill_email) && $bill_email == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn13">Send New Bill genrated to my email</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn14" name="bill_push" type="checkbox"/ value="1" <?php if (isset($bill_push) && $bill_push == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn14">Send New Bill genrated to my device</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn15" name="health_diary_push" type="checkbox"/ value="1" <?php if (isset($heath_diary_push) && $heath_diary_push == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn15">Send Health Diary reminder to my device</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn16" name="outstanding_bill_push" type="checkbox"/ value="1" <?php if (isset($outstanding_bill_push) && $outstanding_bill_push == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn16">Send Outstanding Bill reminder to my device</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn17" name="outstanding_bill_email" type="checkbox"/ value="1" <?php if (isset($outstanding_bill_email) && $outstanding_bill_email == 1) echo 'checked'; ?>>
                                                    <label class="form-check-label" for="pn17">Send Outstanding Bill Reminder to my email</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input class="form-check-input form-check-custom" id="pn19" name="patient_newsletter" type="checkbox" value="1" <?php if (isset($newsletter) && $newsletter == 1) echo 'checked'; ?> />
                                                    <label class="form-check-label" for="pn19">I want to subscribe weekly newsletter about current health status & Render News</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-black mt-4" name="button">SAVE CHANGES</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.patient', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>