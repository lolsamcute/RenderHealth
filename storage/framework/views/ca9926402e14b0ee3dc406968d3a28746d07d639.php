<!doctype html>
<html lang="<?php echo e(config('app.locale')); ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo e(asset('images/favicon.png')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />
    <title>Render Health</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
    <link href="<?php echo e(asset('css/prettyCheckable.css')); ?>" rel="stylesheet">
    
    <?php if(isset($page_type) && $page_type == 'extra_links'): ?>
      <link href="<?php echo e(asset('css/icon.css')); ?>" rel="stylesheet">
      <link href="<?php echo e(asset('css/datepicker.css')); ?>" rel="stylesheet" type="text/css" />
    <?php endif; ?>
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/developer.css')); ?>" rel="stylesheet">  
    <link rel="stylesheet" href="<?php echo e(asset('css/intlTelInput.css')); ?>">
    <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" crossorigin="anonymous"></script>
    <?php if(isset($back_btn) && $back_btn == "immediate"): ?>
      <script type="text/javascript">
        var refferer = document.referrer;   
        var present_url  = window.location.href;    
        if(refferer.indexOf("immediate_tele_details") > 0 || refferer.indexOf("future_tele_details") > 0 || present_url.indexOf("my_appointments") > 0){
           history.pushState(null, null, '<?php echo $_SERVER["REQUEST_URI"]; ?>');
           window.addEventListener('popstate', function(event) {
              window.location.assign("<?php echo url('patient/dashboard'); ?>");
          });
        }
    </script>
    <?php endif; ?>  
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>
  </head>

  <body>
      <nav class="navbar navbar-expand navbar-light navbar_custom">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if($page == "dashboard"): ?>
              <div class="header_search my-2 my-lg-0 mr-md-auto">
                  <form class="form-inline" style="visibility: hidden;">
                    <img src="<?php echo e(asset('images/Search.svg')); ?>" alt="icon"/>
                    <input class="form-control mr-sm-2" type="search" placeholder="Search for ..." aria-label="Search">
                  </form>
             </div>
            <?php elseif($page == "inner"): ?>
              <div class="header_search my-2 my-lg-0 mr-auto">
                <a href="<?php echo e(url('patient/my_appointments')); ?>" class="go_back">
                      <img src="<?php echo e(asset('images/back.svg')); ?>" alt="icon"> Back to My Appointments
                  </a>
             </div>
             <?php elseif($page == "history"): ?>
                <div class="header_search my-2 my-lg-0 mr-auto">
                  <a href="<?php echo e(url('patient/health_history_list')); ?>" class="go_back">
                        <img src="<?php echo e(asset('images/back.svg')); ?>" alt="icon"> Back to Health History
                    </a>
               </div>           
             <?php elseif($page == "billing"): ?>
                <div class="header_search my-2 my-lg-0 mr-auto">
                  <a href="<?php echo e(url('patient/billing')); ?>" class="go_back">
                        <img src="<?php echo e(asset('images/back.svg')); ?>" alt="icon"> Back to Billing
                    </a>
               </div>
            <?php endif; ?>
            <ul class="navbar-nav navbar_menu">
              <li class="nav-item dropdown profile_link">
                <a class="nav-link dropdown-toggle" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php if(!empty($user->patient_profile_img)): ?>
                    <span class="profile_image" style="background-image:url(<?php echo e(asset('uploads/patient/'.$user->patient_profile_img)); ?>);"></span>
                  <?php else: ?>
                    <span class="profile_image" style="background-image:url(<?php echo e(asset('images/profile.svg')); ?>);"></span>
                  <?php endif; ?>
                  Hi, &nbsp; <span class="username" id="username"><?php echo e(ucwords($user->patient_first_name)); ?> <?php echo e(ucwords($user->patient_last_name)); ?></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo e(url('patient/my_profile')); ?>"><span><img src="<?php echo e(asset('images/my_profile.svg')); ?>" alt="icon"></span>My Profile</a>
                  <a class="dropdown-item" href="<?php echo e(url('patient/settings')); ?>"><span><img src="<?php echo e(asset('images/settings.svg')); ?>" alt="icon"></span>Settings</a>
                   <a class="dropdown-item" href="<?php echo e(url('patient/logout')); ?>"><span><img src="<?php echo e(asset('images/logout.svg')); ?>" alt="icon"></span>Logout</a>
                </div>
              </li>
              <li class="nav-item notifications">
                <a class="nav-link" href="<?php echo e(url('patient/notifications')); ?>">
                    <span class="counter">2</span>
                    <img src="<?php echo e(asset('images/Notifications.svg')); ?>" alt="Notifications">
                </a>
              </li>
              <li class="nav-item emergency">
                <a href="tel:08-043-043-955" class="nav-link" href="#">
                    <div class="emer_image">
                        <img src="<?php echo e(asset('images/Phone.svg')); ?>" alt="Phone">
                    </div>
                    <div class="emer_desc">
                        <span class="emer_phone_number"><?php echo e(isset($user->emergency_phone)?$user->emergency_phone:'-'); ?></span>
                        <span class="emer_text">EMERGENCY CALL</span>
                    </div>
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <div class="container">
          <div class="row flex-xl-nowrap">
            <div class="bd-sidebar">
                <a class="navbar-brand" href="<?php echo e(url('patient/dashboard')); ?>"><img src="<?php echo e(asset('images/logo_white.png')); ?>" width="42" alt="logo"/></a>
                <div class="main_menu">
                    <ul>
                        <li class="active">
                            <a href="<?php echo e(url('patient/dashboard')); ?>" data-toggle="tooltip" data-placement="right" title="Dashboard">
                                    <img src="<?php echo e(asset('images/home.svg')); ?>" alt="Homepage"/>
                                </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('patient/my_appointments')); ?>" data-toggle="tooltip" data-placement="right" title="Appointment">
                                    <img src="<?php echo e(asset('images/appointment.svg')); ?>" alt="Appointment"/>
                                </a>
                        </li>
                        <li>
                            <!-- <a href="javascript:;" data-toggle="tooltip" data-placement="right" title="Health History"> -->
                            <a href="<?php echo e(url('patient/health_history_list')); ?>" data-toggle="tooltip" data-placement="right" title="Health History">
                                    <img src="<?php echo e(asset('images/history.svg')); ?>" alt="Health History"/>
                                </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/patient/health_diary')); ?>" data-toggle="tooltip" data-placement="right" title="Health Diary">
                                    <img src="<?php echo e(asset('images/diary.svg')); ?>" alt="Health Diary"/>
                                </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/patient/billing')); ?>" data-toggle="tooltip" data-placement="right" title="Billing">
                                    <img src="<?php echo e(asset('images/billing.svg')); ?>" alt="Billing"/>
                                </a>
                        </li>
                    </ul>

                </div>
            </div>
            <?php echo $__env->yieldContent('content'); ?>
          <div id="site_url" style="display:none"><?php echo e(url('/')); ?></div>
          <input type="hidden" class="patient_unique_id" value="<?php echo e($user->patient_unique_id); ?>">
          <!-- Pay Bill Modal -->
         <div class="modal fade" id="call" data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog modal-md-345 modal-dialog-centered genModal">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title">Incoming Call</h4>                          
                       </div>
                      <div class="modal-body">
                          <div class="incoming_call">
                              <img src="<?php echo e(asset('images/profile.svg')); ?>" class="doctor_pic" alt="profile">
                              <h4 class="doctor_name">Mr. Ayo Akintunde</h4>
                          </div>
                          <div class="genModalfooter_center">
                              <button type="button" class="btn btn-danger call_button mt-3 mx-2 reject_btn" onclick="disconnectCall(this); return false;">
                                  <img src="<?php echo e(asset('images/decline.png')); ?>" alt="Decline">
                              </button>
                              <button type="submit" class="btn btn-primary call_button mt-3 mx-2 accept_btn" onclick="connectCall(this); return false;">
                                  <img src="<?php echo e(asset('images/pick.png')); ?>" alt="Recieve">
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </div>    
           
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" crossorigin="anonymous"></script>   
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" crossorigin="anonymous"></script>   
    <script src="<?php echo e(asset('js/call.js')); ?>"></script>     

    <?php if(isset($page_type) && $page_type == 'settings'): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo e(asset('js/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('js/patient_first.js')); ?>"></script> 
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>        
    <script src="<?php echo e(asset('js/prettyCheckable.min.js')); ?>"></script> 
    <script type="text/javascript"  src="<?php echo e(asset('js/intlTelInput.js')); ?>"></script> 
    <?php endif; ?>
    <?php if(isset($controller) && $controller == 'patient'): ?>  
        <script src="<?php echo e(asset('js/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('js/main.js')); ?>"></script>        
        <script src="<?php echo e(asset('js/prettyCheckable.min.js')); ?>"></script> 
        <script src="https://js.paystack.co/v1/inline.js"></script> 
        <script type="text/javascript"  src="<?php echo e(asset('js/patient_dashboard.js')); ?>"></script>     
      


    <?php endif; ?> 
    <?php if(isset($page_type) && $page_type == 'billing'): ?>   
      <script src="<?php echo e(asset('js/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>  
      <script src="<?php echo e(asset('js/main.js')); ?>"></script>
      <script src="<?php echo e(asset('js/prettyCheckable.min.js')); ?>"></script> 
      <script src="https://js.paystack.co/v1/inline.js"></script> 
      <script src="<?php echo e(asset('js/patient_billing.js')); ?>"></script>   
    <?php endif; ?>
    <script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
  </body>
</html>