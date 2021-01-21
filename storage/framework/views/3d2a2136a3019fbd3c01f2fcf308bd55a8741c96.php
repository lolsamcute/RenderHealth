<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>" class="full_height">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="<?php echo e(asset('images/favicon.png')); ?>">   
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title>Render Health</title>

        <!-- Styles -->
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" crossorigin="anonymous">
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
        <link href="<?php echo e(asset('css/prettyCheckable.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
     
                 <link rel="stylesheet" href="<?php echo e(asset('css/intlTelInput.css')); ?>"> 
            <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>;
        </script>
    </head>
    <body class="full_page">
        <?php echo $__env->yieldContent('content'); ?>
        <div id="site_url" style="display:none"><?php echo e(url('/')); ?></div>
        <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" crossorigin="anonymous"></script>
        <?php if(isset($controller) && $controller == 'patient'): ?>
            <script type="text/javascript"  src="<?php echo e(asset('js/intlTelInput.js')); ?>"></script>   
            <script type="text/javascript"  src="<?php echo e(asset('js/patient.js')); ?>"></script>

        <?php endif; ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"  crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"  crossorigin="anonymous"></script>
        <script src="<?php echo e(asset('js/prettyCheckable.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/main.js')); ?>"></script>
        
    </body>
</html>