<?php $__env->startSection('title', is_fr() ? 'Nouveau mot de passe' : 'New password'); ?>

<?php $__env->startSection('content'); ?>
    <div class="wrap">
        <div class="card auth-card">
            <h1 class="display"><?php echo e(is_fr() ? 'Choisir un nouveau mot de passe' : 'Choose a new password'); ?></h1>
            <form method="POST" action="<?php echo e(route('password.update')); ?>" class="form-grid">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="token" value="<?php echo e($token); ?>">
                <div>
                    <label class="label" for="password"><?php echo e(t('buy.password')); ?> *</label>
                    <input class="field" id="password" type="password" name="password" required minlength="6">
                </div>
                <button class="btn btn-primary" type="submit"><?php echo e(is_fr() ? 'Enregistrer' : 'Save'); ?></button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/auth/reset-password.blade.php ENDPATH**/ ?>