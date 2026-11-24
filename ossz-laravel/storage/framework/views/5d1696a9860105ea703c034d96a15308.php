<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#1b1917">
    <title><?php echo $__env->yieldContent('title', 'OSSZ Collections — Contemporary fashion house, Douala'); ?></title>
    <meta name="description" content="OSSZ Collections is a contemporary fashion house in Douala, Cameroon — African design sensibility, modern luxury tailoring, delivered across Cameroon.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="icon" href="/icons/favicon-32.png" sizes="32x32" type="image/png">
    <link rel="apple-touch-icon" href="/icons/apple-touch-icon.png" sizes="180x180">
    <link rel="manifest" href="/manifest.webmanifest">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-canvas text-ink antialiased">
    <a href="#main" class="skip-link">Skip to content</a>

    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main id="main">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('partials.concierge', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /home/z/my-project/ossz-laravel/resources/views/layouts/app.blade.php ENDPATH**/ ?>