<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="icon" type="image/x-icon" href="<?php echo e(asset('style/assets/favicon.ico')); ?>" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="<?php echo e(asset('style/css/styles.css')); ?>" rel="stylesheet" />
    </head>

    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <?php echo $__env->make('user.navbarUser', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->yieldContent('content-user'); ?>
        </main>
        <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo e(asset('style/js/scripts.js')); ?>"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html><?php /**PATH D:\User Rinto\Documents\Project\berkah\resources\views/user/mainUser.blade.php ENDPATH**/ ?>