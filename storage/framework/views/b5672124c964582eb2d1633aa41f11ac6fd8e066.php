<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="ltr">
    <head>
        <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
        <meta http-equiv="Cache-Control" content="post-check=0, pre-check=0">
        <meta http-equiv="Pragma" content="0">
        <title>Login</title>
        <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>

    <body class="bg-gradient-primary my-body">
        <div class="container">

        <!-- Outer Row -->
            <div class="row justify-content-center">
                <?php echo $__env->yieldContent('content'); ?>
            </div>

        </div>
        <?php echo $__env->make('layouts.footer-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\ddukddak\resources\views/layouts/master_login.blade.php ENDPATH**/ ?>