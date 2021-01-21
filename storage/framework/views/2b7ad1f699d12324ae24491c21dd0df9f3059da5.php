<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
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
    <link href="<?php echo e(asset('admin/hospital/css/datepicker.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('admin/hospital/css/prettyCheckable.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/hospital/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/admincss/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/hospital/css/developer.css')); ?>" rel="stylesheet">
    <!--   date piker -->
    <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
        <nav class="navbar navbar-expand navbar-light navbar_custom">
            <button id="menu" class="navbar-toggler" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="<?php echo e(url('/hospital/dashboard')); ?>"><img src="<?php echo e(asset('admin/doctor/images/render_logo_white.svg')); ?>" alt="logo"/></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="header_search my-2 my-lg-0 mr-auto">
                    <div class="notify">
                       Hi, <?php echo e($administrator_details->administrator_name); ?>. You’ve <b><?php if(isset($today_appointments_count) && $today_appointments_count > 0): ?><?php echo e($today_appointments_count); ?><?php else: ?> <?php echo e("0"); ?><?php endif; ?> appointments today</b>
                   </div>
                </div>
                <ul class="navbar-nav navbar_menu">
                    <li class="nav-item notifications">
                        <a class="nav-link" href="javascript:;">
                          <span class="counter"></span>
                          <img src="<?php echo e(asset('admin/doctor/images/notifications.svg')); ?>" alt="Notifications">
                        </a>
                    </li>
                    <li class="nav-item dropdown profile_link">
                        <a class="nav-link dropdown-toggle" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="profile_image" style="background-image:url(<?php echo e(asset('administratorimages/'.$administrator_details->administrator_picture)); ?>);"></span>
                            Hi, &nbsp; <span class="username"><?php echo e($administrator_details->administrator_name); ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="javascript:;"><span><img src="<?php echo e(asset('admin/doctor/images/help_center.svg')); ?>" alt="icon"></span>Help Center</a>
                            <a class="dropdown-item" href="<?php echo e(url('hospital/logout')); ?>"><span><img src="<?php echo e(asset('admin/doctor/images/logout.svg')); ?>" alt="icon"></span>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row flex-xl-nowrap">
                <div class="bd-sidebar">
                    <div class="main_menu">
                        <ul>
                            <li id="act_0">
                                <a href="<?php echo e(url('/hospital/dashboard')); ?>">
                                    <div class="icon_main">
                                        <svg width="16px" height="16px" viewBox="0 0 16 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <defs></defs>
                                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="color_icon" transform="translate(-12.000000, -12.000000)" fill="#353638" fill-rule="nonzero">
                                                    <g id="Group-13">
                                                        <path d="M15.5555556,13.7777778 C15.5555556,14.7555556 14.7555556,15.5555556 13.7777778,15.5555556 C12.8,15.5555556 12,14.7555556 12,13.7777778 C12,12.8 12.8,12 13.7777778,12 C14.7555556,12 15.5555556,12.8 15.5555556,13.7777778 Z M20,12 C19.0222222,12 18.2222222,12.8 18.2222222,13.7777778 C18.2222222,14.7555556 19.0222222,15.5555556 20,15.5555556 C20.9777778,15.5555556 21.7777778,14.7555556 21.7777778,13.7777778 C21.7777778,12.8 20.9777778,12 20,12 Z M26.2222222,15.5555556 C27.2,15.5555556 28,14.7555556 28,13.7777778 C28,12.8 27.2,12 26.2222222,12 C25.2444444,12 24.4444444,12.8 24.4444444,13.7777778 C24.4444444,14.7555556 25.2444444,15.5555556 26.2222222,15.5555556 Z M13.7777778,18.2222222 C12.8,18.2222222 12,19.0222222 12,20 C12,20.9777778 12.8,21.7777778 13.7777778,21.7777778 C14.7555556,21.7777778 15.5555556,20.9777778 15.5555556,20 C15.5555556,19.0222222 14.7555556,18.2222222 13.7777778,18.2222222 Z M20,18.2222222 C19.0222222,18.2222222 18.2222222,19.0222222 18.2222222,20 C18.2222222,20.9777778 19.0222222,21.7777778 20,21.7777778 C20.9777778,21.7777778 21.7777778,20.9777778 21.7777778,20 C21.7777778,19.0222222 20.9777778,18.2222222 20,18.2222222 Z M26.2222222,18.2222222 C25.2444444,18.2222222 24.4444444,19.0222222 24.4444444,20 C24.4444444,20.9777778 25.2444444,21.7777778 26.2222222,21.7777778 C27.2,21.7777778 28,20.9777778 28,20 C28,19.0222222 27.2,18.2222222 26.2222222,18.2222222 Z M13.7777778,24.4444444 C12.8,24.4444444 12,25.2444444 12,26.2222222 C12,27.2 12.8,28 13.7777778,28 C14.7555556,28 15.5555556,27.2 15.5555556,26.2222222 C15.5555556,25.2444444 14.7555556,24.4444444 13.7777778,24.4444444 Z M20,24.4444444 C19.0222222,24.4444444 18.2222222,25.2444444 18.2222222,26.2222222 C18.2222222,27.2 19.0222222,28 20,28 C20.9777778,28 21.7777778,27.2 21.7777778,26.2222222 C21.7777778,25.2444444 20.9777778,24.4444444 20,24.4444444 Z M26.2222222,24.4444444 C25.2444444,24.4444444 24.4444444,25.2444444 24.4444444,26.2222222 C24.4444444,27.2 25.2444444,28 26.2222222,28 C27.2,28 28,27.2 28,26.2222222 C28,25.2444444 27.2,24.4444444 26.2222222,24.4444444 Z" id="Shape"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    Dashboard
                                </a>
                            </li>
                        </ul>
                        <div class="menu_heading">Appointment</div>
                        <ul>
                            <li id="act">
                                <a href="<?php echo e(url('/hospital/all_doctors')); ?>">
                                    <div class="icon_main has_notification">
                                        <svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <defs></defs>
                                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="color_icon" transform="translate(-11.000000, -111.000000)" fill="#353638" fill-rule="nonzero">
                                                    <g id="Group-13">
                                                        <path d="M29,113.16 L29,116.04 L11,116.04 L11,113.16 C11,112.728 11.288,112.44 11.72,112.44 L15.32,112.44 L15.32,111.36 C15.32,111.144 15.464,111 15.68,111 C15.896,111 16.04,111.144 16.04,111.36 L16.04,112.44 L23.96,112.44 L23.96,111.36 C23.96,111.144 24.104,111 24.32,111 C24.536,111 24.68,111.144 24.68,111.36 L24.68,112.44 L28.28,112.44 C28.712,112.44 29,112.728 29,113.16 Z M11,116.76 L29,116.76 L29,127.56 C29,127.992 28.712,128.28 28.28,128.28 L11.72,128.28 C11.288,128.28 11,127.992 11,127.56 L11,116.76 Z M23.96,120.36 L25.4,120.36 L25.4,118.92 L23.96,118.92 L23.96,120.36 Z M20.36,120.36 L21.8,120.36 L21.8,118.92 L20.36,118.92 L20.36,120.36 Z M18.2,123.96 L19.64,123.96 L19.64,122.52 L18.2,122.52 L18.2,123.96 Z M14.6,123.96 L16.04,123.96 L16.04,122.52 L14.6,122.52 L14.6,123.96 Z" id="Shape"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    Doctor
                                </a>
                            </li>
                            <li id="act1">
                                <a href="<?php echo e(url('hospital/all_nurses')); ?>">
                                    <div class="icon_main">
                                        <svg width="18px" height="17px" viewBox="0 0 18 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <defs></defs>
                                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="color_icon" transform="translate(-11.000000, -177.000000)" fill="#353638" fill-rule="nonzero">
                                                    <g id="Group-13">
                                                        <path d="M27.92,177 L12.08,177 C11.504,177 11,177.504 11,178.08 L11,189.6 C11,190.176 11.504,190.68 12.08,190.68 L21.224,190.68 C21.296,190.68 21.368,190.68 21.44,190.752 L24.968,193.416 C25.112,193.488 25.256,193.56 25.4,193.56 C25.544,193.56 25.616,193.56 25.688,193.488 C25.904,193.344 26.12,193.128 26.12,192.84 L26.12,190.68 L27.92,190.68 C28.496,190.68 29,190.176 29,189.6 L29,178.08 C29,177.504 28.496,177 27.92,177 Z M23.96,186.36 L21.8,184.92 L21.8,185.64 C21.8,186.072 21.512,186.36 21.08,186.36 L16.76,186.36 C16.328,186.36 16.04,186.072 16.04,185.64 L16.04,182.04 C16.04,181.608 16.328,181.32 16.76,181.32 L21.08,181.32 C21.512,181.32 21.8,181.608 21.8,182.04 L21.8,182.76 L23.96,181.32 L23.96,186.36 Z" id="Shape"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    Nurse
                                </a>
                            </li>
                        </ul>
                        <!-- <div class="menu_heading">OTHERS</div>
                        <ul>
                            <li id="act2">
                                <a href="<?php echo e(url('/hospital/search_patient')); ?>">
                                    <div class="icon_main">
                                        <svg width="20px" height="17px" viewBox="0 0 20 17" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <defs></defs>
                                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="color_icon" transform="translate(-12.000000, -277.000000)" fill="#353638" fill-rule="nonzero">
                                                    <g id="Group-13">
                                                        <path d="M28.3785275,278.520842 C26.9337276,278.520842 25.717054,279.737516 25.717054,281.182315 C25.717054,281.790652 25.9451803,282.322947 26.2493487,282.7792 L24.196212,284.832336 L24.7285067,285.364631 L26.7816434,283.311494 C27.237896,283.615663 27.7701907,283.843789 28.3785275,283.843789 C29.8233273,283.843789 31.0400009,282.627115 31.0400009,281.182315 C31.0400009,279.737516 29.8233273,278.520842 28.3785275,278.520842 Z M28.3785275,283.083368 C27.3139381,283.083368 26.477475,282.246905 26.477475,281.182315 C26.477475,280.117726 27.3139381,279.281263 28.3785275,279.281263 C29.4431168,279.281263 30.2795799,280.117726 30.2795799,281.182315 C30.2795799,282.246905 29.4431168,283.083368 28.3785275,283.083368 Z M26.477475,291.828209 C26.6295592,292.436546 26.1733066,293.044883 25.5649698,293.196967 C24.196212,293.425093 21.6868227,293.729262 19.2534756,293.729262 C16.8961705,293.729262 14.3107391,293.425093 12.9419814,293.196967 C12.3336446,293.120925 11.877392,292.512588 12.0294762,291.828209 L12.4096867,289.775073 C12.4857288,289.394862 12.7138551,289.090694 13.0940656,288.93861 L16.0597074,287.87402 C16.3638758,287.721936 16.5920021,287.49381 16.7440863,287.189641 L16.8961705,286.809431 L18.6451388,287.569852 C19.0253493,287.721936 19.4816019,287.721936 19.8618124,287.569852 L21.6107806,286.809431 L21.7628648,287.189641 C21.8389069,287.49381 22.1430753,287.797978 22.4472437,287.87402 L25.4128856,288.93861 C25.7930961,289.090694 26.0212224,289.394862 26.0972645,289.775073 L26.477475,291.828209 Z M15.2232443,280.041684 L15.0711601,278.748968 C14.995118,278.140631 15.3753285,277.684379 15.9836653,277.532295 C16.9722126,277.304168 18.5690967,277 19.2534756,277 C19.4816019,277 19.8618124,277.076042 20.2420229,277.076042 C19.7857703,278.977095 17.5045073,279.965642 15.2232443,280.041684 Z M21.0024438,277.228126 C21.5347385,277.304168 22.0670332,277.456253 22.5232858,277.532295 C23.0555805,277.684379 23.435791,278.216674 23.435791,278.748968 L22.8274542,284.832336 C22.7514121,285.212547 22.5232858,285.592757 22.1430753,285.744841 L19.8618124,286.733389 C19.4816019,286.885473 19.0253493,286.885473 18.6451388,286.733389 L16.3638758,285.744841 C15.9836653,285.592757 15.755539,285.212547 15.6794969,284.832336 L15.2992864,280.802105 C17.8847178,280.726063 20.4701492,279.509389 21.0024438,277.228126 Z" id="Shape"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    Search Patient
                                </a>
                            </li>
                            <li id="act3">
                                <a class="collapsed has_submenu" href="javascript:;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="icon_main has_notification">
                                        <svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <defs></defs>
                                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="color_icon" transform="translate(-11.000000, -111.000000)" fill="#353638" fill-rule="nonzero">
                                                    <g id="Group-13">
                                                        <path d="M29,113.16 L29,116.04 L11,116.04 L11,113.16 C11,112.728 11.288,112.44 11.72,112.44 L15.32,112.44 L15.32,111.36 C15.32,111.144 15.464,111 15.68,111 C15.896,111 16.04,111.144 16.04,111.36 L16.04,112.44 L23.96,112.44 L23.96,111.36 C23.96,111.144 24.104,111 24.32,111 C24.536,111 24.68,111.144 24.68,111.36 L24.68,112.44 L28.28,112.44 C28.712,112.44 29,112.728 29,113.16 Z M11,116.76 L29,116.76 L29,127.56 C29,127.992 28.712,128.28 28.28,128.28 L11.72,128.28 C11.288,128.28 11,127.992 11,127.56 L11,116.76 Z M23.96,120.36 L25.4,120.36 L25.4,118.92 L23.96,118.92 L23.96,120.36 Z M20.36,120.36 L21.8,120.36 L21.8,118.92 L20.36,118.92 L20.36,120.36 Z M18.2,123.96 L19.64,123.96 L19.64,122.52 L18.2,122.52 L18.2,123.96 Z M14.6,123.96 L16.04,123.96 L16.04,122.52 L14.6,122.52 L14.6,123.96 Z" id="Shape"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    Billings
                                </a>
                                <div id="collapseOne" class="collapse">
                                    <ul class="submenu">
                                        <li id="act4">
                                            <a href="<?php echo e(url('/hospital/view_all_billings')); ?>">View All Bilings</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">Billings by Hospital</a>
                                        </li>
                                        <li id="act5">
                                            <a href="<?php echo e(url('/hospital/dispute_billings')); ?>">Disputed Billings <span class="sub_counter">2</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li id="act6">
                                <a href="<?php echo e(url('/hospital/settings')); ?>">
                                    <div class="icon_main">
                                        <svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <defs></defs>
                                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="color_icon" transform="translate(-11.000000, -404.000000)" fill="#353638">
                                                    <g id="Group-13">
                                                        <path d="M28.5,411.571429 L27,411.142857 C26.8571429,411.142857 26.7857143,411 26.7857143,410.928571 C26.6428571,410.5 26.5,410.071429 26.2857143,409.714286 C26.2142857,409.642857 26.2142857,409.5 26.2857143,409.357143 L27,408 C27.1428571,407.714286 27.0714286,407.357143 26.8571429,407.142857 L25.8571429,406.142857 C25.6428571,405.928571 25.2857143,405.857143 25,406 L23.6428571,406.714286 C23.5714286,406.785714 23.4285714,406.785714 23.2857143,406.714286 C22.8571429,406.5 22.5,406.357143 22.0714286,406.214286 C21.9285714,406.214286 21.8571429,406.071429 21.8571429,406 L21.4285714,404.5 C21.3571429,404.214286 21.0714286,404 20.7142857,404 L19.2857143,404 C19,404 18.7142857,404.214286 18.5714286,404.5 L18.1428571,406 C18.1428571,406.142857 18,406.214286 17.9285714,406.214286 C17.5,406.357143 17.0714286,406.5 16.7142857,406.714286 C16.6428571,406.785714 16.5,406.785714 16.3571429,406.714286 L15,406 C14.7142857,405.857143 14.3571429,405.928571 14.1428571,406.142857 L13.1428571,407.142857 C12.9285714,407.357143 12.8571429,407.714286 13,408 L13.7142857,409.357143 C13.7857143,409.428571 13.7857143,409.571429 13.7142857,409.714286 C13.5,410.142857 13.3571429,410.5 13.2142857,410.928571 C13.2142857,411.071429 13.0714286,411.142857 13,411.142857 L11.5,411.571429 C11.2142857,411.642857 11,411.928571 11,412.285714 L11,413.714286 C11,414 11.2142857,414.285714 11.5,414.428571 L13,414.857143 C13.1428571,414.857143 13.2142857,415 13.2142857,415.071429 C13.3571429,415.5 13.5,415.928571 13.7142857,416.285714 C13.7857143,416.357143 13.7857143,416.5 13.7142857,416.642857 L13,418 C12.8571429,418.285714 12.9285714,418.642857 13.1428571,418.857143 L14.1428571,419.857143 C14.3571429,420.071429 14.7142857,420.142857 15,420 L16.3571429,419.285714 C16.4285714,419.214286 16.5714286,419.214286 16.7142857,419.285714 C17.1428571,419.5 17.5,419.642857 17.9285714,419.785714 C18.0714286,419.785714 18.1428571,419.928571 18.1428571,420 L18.5714286,421.5 C18.6428571,421.785714 18.9285714,422 19.2857143,422 L20.7142857,422 C21,422 21.2857143,421.785714 21.4285714,421.5 L21.8571429,420 C21.8571429,419.857143 22,419.785714 22.0714286,419.785714 C22.5,419.642857 22.9285714,419.5 23.2857143,419.285714 C23.3571429,419.214286 23.5,419.214286 23.6428571,419.285714 L25,420 C25.2857143,420.142857 25.6428571,420.071429 25.8571429,419.857143 L26.8571429,418.857143 C27.0714286,418.642857 27.1428571,418.285714 27,418 L26.2857143,416.642857 C26.2142857,416.571429 26.2142857,416.428571 26.2857143,416.285714 C26.5,415.857143 26.6428571,415.5 26.7857143,415.071429 C26.7857143,414.928571 26.9285714,414.857143 27,414.857143 L28.5,414.428571 C28.7857143,414.357143 29,414.071429 29,413.714286 L29,412.285714 C29,411.928571 28.7857143,411.642857 28.5,411.571429 Z M20.0714286,416.142857 C18.2857143,416.142857 16.8571429,414.714286 16.8571429,412.928571 C16.8571429,411.142857 18.2857143,409.714286 20.0714286,409.714286 C21.8571429,409.714286 23.2857143,411.142857 23.2857143,412.928571 C23.2857143,414.714286 21.8571429,416.142857 20.0714286,416.142857 Z" id="Shape"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    Settings
                                </a>
                            </li>
                        </ul> -->
                    </div>
                    <a class="help_sm" href="tel:021-000-1234">
                        <div class="help_icon_sm">
                            <img src="<?php echo e(asset('admin/doctor/images/call_sm.svg')); ?>" alt="icon">
                        </div>
                        <div class="help_desc_sm">
                            <h3>Need Help?</h3>
                            <h4>Call. 0703 242 1768</h4>
                    <small>contact@renderhealth.com</small>
                        </div>
                    </a>
                </div>
                 <div class="black_overlay"></div>
				<?php echo $__env->yieldContent('content'); ?>
                <div id="site_url" style="display:none"><?php echo e(url('/')); ?></div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
        </script>       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js"></script>
        <script src="<?php echo e(asset('admin/hospital/js/bootstrap-datepicker.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('admin/hospital/js/prettyCheckable.min.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/hospital/js/main.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/adminjs/main.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/adminjs/admin.js')); ?>"></script>
        <script src="<?php echo e(asset('admin/hospital/customjs/setup.js')); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
        </script>
        <?php if(!isset($page_type) || (isset($page_type) && $page_type != 'health_history')): ?>
            <script type="text/javascript"  src="<?php echo e(asset('admin/hospital/js/hospital_dashboard.js')); ?>"></script>
        <?php endif; ?>       
        <?php if(isset($page_type) && ($page_type == 'time_count' || $page_type == 'appointments')): ?>
            <script type="text/javascript"  src="<?php echo e(asset('admin/hospital/js/first.js')); ?>"></script>            
        <?php endif; ?> 
        <?php if(isset($page_type) && ($page_type == 'health_history')): ?>
            <script type="text/javascript"  src="<?php echo e(asset('admin/hospital/js/hospital_history_main.js')); ?>"></script>
        <?php endif; ?>  
        <?php if(isset($page_type) && ($page_type == 'settings')): ?>
            <script type="text/javascript"  src="<?php echo e(asset('admin/hospital/js/hospital_settings.js')); ?>"></script>
        <?php endif; ?>
        <?php if(isset($page_type) && ($page_type == 'billing')): ?>
            <script src="https://js.paystack.co/v1/inline.js"></script>
            <script type="text/javascript"  src="<?php echo e(asset('admin/hospital/js/hospital_billings.js')); ?>"></script>
        <?php endif; ?>    
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#onboarding').modal('show');
            });
            if (window.location.href.indexOf("dashboard") > -1) {

             $('.main_menu ul li ').removeClass('active');
             $("#act_0").addClass('active');

            }
            if(window.location.href.indexOf("all_appointments") > -1){
                $('.main_menu ul li ').removeClass('active');
                $("#act").addClass('active');
            }
            if (window.location.href.indexOf("telemedical_appoinment") > -1) {
                $('.main_menu ul li ').removeClass('active');
                $("#act1").addClass('active');
            } 
            if(window.location.href.indexOf("search_patient") > -1){
                $('.main_menu ul li ').removeClass('active');
                $("#act2").addClass('active');
            }
            if(window.location.href.indexOf("view_all_billings") > -1 || window.location.href.indexOf("billing_detail") > -1){
                $('.main_menu ul li ').removeClass('active');
                $("#act3").addClass('active');
                $("#act4").addClass('active');
                $('#collapseOne').collapse('show');
            }

            if(window.location.href.indexOf("dispute_billings") > -1 || window.location.href.indexOf("dispute_billing_detail") > -1){
                $('.main_menu ul li ').removeClass('active');
                $("#act3").addClass('active');
                $("#act5").addClass('active');
                $('#collapseOne').collapse('show');
            }

            if(window.location.href.indexOf("settings") > -1){
                $('.main_menu ul li ').removeClass('active');
                $("#act6").addClass('active');
            }       
        </script>
        <!-- Initialize Swiper -->
    </body>
</html>
