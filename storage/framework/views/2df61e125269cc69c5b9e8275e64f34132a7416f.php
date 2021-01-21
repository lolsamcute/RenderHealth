<!doctype html>
<html lang="en" class="full_height">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo e(asset('admin/doctor/favicon.png')); ?>">
    
    <title>Render Health</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">    
    <link href="<?php echo e(asset('admin/doctor/css/prettyCheckable.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('admin/doctor/css/style.css')); ?>" rel="stylesheet">
</head>

<body class="full_page">

    <div class="image_section">
        <img src="<?php echo e(asset('admin/doctor/images/login_svg.svg')); ?>" alt="Doctor" class="img-fluid">
    </div>
    <div class="container">
      <?php echo $__env->yieldContent('content'); ?>
      <div id="site_url" style="display:none"><?php echo e(url('/')); ?></div>  
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>   
    <script src="<?php echo e(asset('js/prettyCheckable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/doctor/js/doctor.js')); ?>"></script>
</body>

</html>