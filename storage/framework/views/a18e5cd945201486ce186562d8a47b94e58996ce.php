<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
   <link rel="icon" href="<?php echo e(asset('admin/adminimages/favicon.png')); ?>">
    <title>Render Health</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
          crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.css" integrity="sha256-I23rKKBc0+Qh38KLk0F8kfmLoQQ9F4dS0f8064Jfu8I=" crossorigin="anonymous" />
    <link href="<?php echo e(asset('admin/admincss/datepicker.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('admin/admincss/prettyCheckable.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/admincss/style.css')); ?>" rel="stylesheet">
  <!-- date piker -->
     <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>
    <?php
      header("Cache-Control: no-cache, must-revalidate");
      header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    ?>
</head>

  <body class="slide_left">
  <div class="loading">Loading&#8230;</div>
      <nav class="navbar navbar-expand navbar-light navbar_custom">
          <button id="menu" class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="<?php echo e(url('/admin/dashboard')); ?>"><img src="<?php echo e(asset('admin/adminimages/render_logo_white.svg')); ?>" alt="logo"/></a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="header_search my-2 my-lg-0 mr-auto">
             </div>
            <ul class="navbar-nav navbar_menu">
                <li class="nav-item notifications">
                  <a class="nav-link" href="javascript:;">
                      <span class="counter"></span>
                      <img src="<?php echo e(asset('admin/adminimages/notifications.svg')); ?>" alt="Notifications">
                  </a>
                </li>
              <li class="nav-item dropdown profile_link">
                    <a class="nav-link dropdown-toggle" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="profile_image" style="background-image:url(<?php echo e(asset('admin/adminimages/profile.svg')); ?>);"></span>
                  Hi, &nbsp; <span class="username"><?php if(isset($admin_details->first_name)): ?><?php echo e($admin_details->first_name); ?><?php endif; ?>
                    <?php if(isset($admin_details->last_name)): ?><?php echo e($admin_details->last_name); ?><?php endif; ?>
                    </span>
                </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="javascript:;"><span><img src="<?php echo e(asset('admin/adminimages/help_center.svg')); ?>" alt="icon"></span>Help Center</a>
                            <a class="dropdown-item" href="<?php echo e(url('admin/logout')); ?>"><span><img src="<?php echo e(asset('admin/adminimages/logout.svg')); ?>" alt="icon"></span>Logout</a>
                    </div>
                </li>
            </ul>
          </div>
        </nav>

        <div class="container-fluid">
            <div class="row flex-xl-nowrap">
                <div class="bd-sidebar">
                    <div class="main_menu">                    
                  <?php if(Request::is('admin/hospital_detail','*')){ ?>
                  <a href="<?php echo e(url('/admin/all_hospitals')); ?>" class="btn btn-light btn-sm">Back to Hospitals</a>
                  <?php    }  else {?>
                  <a href="<?php echo e(url('/admin/dashboard')); ?>" class="btn btn-light btn-sm">Back to dashboard</a>
                  <?php } ?>                    
                         <div class="medical_patient_detail">
                            <h2><?php if(isset($hospital_detail->hosp_name)): ?><?php echo e($hospital_detail->hosp_name); ?><?php endif; ?></h2>
                            <span>HOSPITAL ID: <?php if(isset($hospital_detail->hosp_id)): ?><?php echo e($hospital_detail->hosp_id); ?><?php endif; ?></span>
                         </div>
                         <div class="widget_profile_desc">
                             <div class="patient_info">
                                 HOSPITAL INFORMATION
                             </div>
                            <ul>
                                <li>
                                    <span>
                                        <img src="<?php echo e(asset('admin/adminimages/location.svg')); ?>" alt="icon">
                                    </span>
                                    <p><?php if(isset($hospital_detail->hosp_address)): ?><?php echo e($hospital_detail->hosp_address); ?><?php endif; ?> - <?php if(isset($hospital_detail->hosp_state)): ?><?php echo e($hospital_detail->hosp_state); ?><?php endif; ?>, <?php if(isset($hospital_detail->hosp_country)): ?><?php echo e($hospital_detail->hosp_country); ?><?php endif; ?></p>
                                </li>
                                <li>
                                    <span>
                                        <img src="<?php echo e(asset('admin/adminimages/call_hos.svg')); ?>" alt="icon">
                                    </span>
                                    <p><?php if(isset($hospital_detail->hosp_phone)): ?><?php echo e($hospital_detail->hosp_phone); ?><?php endif; ?></p>
                                </li>
                            </ul>
                        </div>
                         <a href="javascript:;" data-toggle="modal" data-target="#add_doctor" class="btn btn-light btn-sm btn-center mb-3" onclick="$('#top').html('');$('#doctorTitle, #submit_btn').html('Add Doctor');"><img src="<?php echo e(asset('admin/adminimages/btn_view.svg')); ?>"/>Add New Doctor</a>
                         <a href="javascript:;" data-toggle="modal" data-target="#add_nurse" class="btn btn-light btn-sm btn-center mb-3" onclick="$('.master_top').html('');$('#nurseTitle , #Nurse_submit_btn').html('Add Nurse');"><img src="<?php echo e(asset('admin/adminimages/btn-edit.svg')); ?>"/>Add New Nurse</a>
                         <a href="javascript:;" data-toggle="modal" data-target="#add_administrator" class="btn btn-light btn-sm btn-center" onclick="$('#adminTitle , #Admin_submit_btn').html('Add Administrator');"><img src="<?php echo e(asset('admin/adminimages/btn-print.svg')); ?>"/>Add New Admin</a>

                    </div>
                    <a class="help_sm" href="tel:021-000-1234">
                        <div class="help_icon_sm">
                            <img src="<?php echo e(asset('admin/adminimages/call_sm.svg')); ?>" alt="icon">
                        </div>
                        <div class="help_desc_sm">
                            <h3>Need Help?</h3>
                            <h4>Call. 0703 242 1768</h4>
                            <small>contact@renderhealth.com</small>
                        </div>
                    </a>
                </div>
                <div class='black_overlay'></div>
                <?php echo $__env->yieldContent('content'); ?>
                
            </div>
        </div>

        


        <script src="https://code.jquery.com/jquery-3.3.1.js"
                integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
                crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
                integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
                crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
                integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
                crossorigin="anonymous">
        </script>
         <script type="text/javascript"  src="<?php echo e(asset('js/intlTelInput.js')); ?>"></script>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js"></script>
      <script src="<?php echo e(asset('admin/adminjs/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('admin/adminjs/prettyCheckable.min.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/adminjs/main.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/adminjs/admin.js')); ?>"></script>
 <link rel="stylesheet" href="<?php echo e(asset('css/intlTelInput.css')); ?>"> 
 
  </body>
</html>
