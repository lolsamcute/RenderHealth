<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
     <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo e(asset('admin/doctor/images/favicon.png')); ?>">
    <title>Render Health</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
          crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.css" integrity="sha256-I23rKKBc0+Qh38KLk0F8kfmLoQQ9F4dS0f8064Jfu8I=" crossorigin="anonymous" />
    <link href="<?php echo e(asset('admin/doctor/css/datepicker.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('admin/doctor/css/prettyCheckable.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/doctor/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/doctor/css/developer.css')); ?>" rel="stylesheet">
  </head>

  <body class="slide_left">
     <nav class="navbar navbar-expand navbar-light navbar_custom">
        <button id="menu" class="navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
          </button>
        <a class="navbar-brand" href="<?php echo e(url('/admin/dashboard')); ?>"><img src="<?php echo e(asset('admin/adminimages/render_logo_white.svg')); ?>" alt="logo"/></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="header_search my-2 my-lg-0 mr-auto">
                <form class="form-inline">
                    <div class="search_icon">
                        <img src="<?php echo e(asset('admin/adminimages/search.svg')); ?>" alt="icon">
                    </div>
                    <input class="form-control mr-sm-2" placeholder="Search Appointment records" aria-label="Search" type="search">
                </form>
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
                    <?php if(isset($admin_details->last_name)): ?><?php echo e($admin_details->last_name); ?><?php endif; ?></span>
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
              <?php echo $__env->yieldContent('content'); ?>
              <div id="site_url" style="display:none"><?php echo e(url('/')); ?></div>
            </div>
        </div>


         <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
        </script>
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
        </script>       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js"></script>
        <script src="<?php echo e(asset('admin/adminjs/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('admin/adminjs/prettyCheckable.min.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/adminjs/main.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/adminjs/admin.js')); ?>"></script>
         <script src="https://js.paystack.co/v1/inline.js"></script>
        <script type="text/javascript">
            
            if (window.location.href.indexOf("dashboard") > -1) {
                $('#sidebar_menu li ').removeClass('active');
                $("#option_1").addClass('active');

            }
            else if(window.location.href.indexOf("all_hospitals") > -1){
                $('#sidebar_menu li').removeClass('active');
                $("#option_2").addClass('active');
            }
            else if (window.location.href.indexOf("all_employees") > -1) {
                $('#sidebar_menu li').removeClass('active');
                $("#option_4").addClass('active');
            } 


            $('.datepicker').datepicker()
      
                
        </script>
    

  </body>
</html>