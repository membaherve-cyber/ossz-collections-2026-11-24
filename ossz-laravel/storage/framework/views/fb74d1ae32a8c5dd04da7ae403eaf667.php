<?php $__env->startSection('title', t('offline.title')); ?>

<?php $__env->startSection('content'); ?>
    <section class="wrap" style="padding:6rem 0;text-align:center">
        <h1 class="display" style="font-size:1.6rem"><?php echo e(t('offline.title')); ?></h1>
        <p style="margin-top:1rem;font-size:.9rem;color:var(--ink-soft)"><?php echo e(t('offline.body')); ?></p>
        <a class="btn btn-primary" style="margin-top:2rem" href="<?php echo e(url()->previous() ?: route('home')); ?>"><?php echo e(t('offline.retry')); ?></a>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/offline.blade.php ENDPATH**/ ?>