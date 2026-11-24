<?php $__env->startSection('title', is_fr() ? 'Mot de passe oublié' : 'Forgot password'); ?>

<?php $__env->startSection('content'); ?>
    <div class="wrap">
        <div class="card auth-card">
            <h1 class="display"><?php echo e(is_fr() ? 'Mot de passe oublié' : 'Forgot password'); ?></h1>
            <form method="POST" action="<?php echo e(route('password.email')); ?>" class="form-grid">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="label" for="email">Email</label>
                    <input class="field" id="email" type="email" name="email" required value="<?php echo e(old('email')); ?>">
                </div>
                <button class="btn btn-primary" type="submit"><?php echo e(is_fr() ? 'Envoyer le lien' : 'Send reset link'); ?></button>
            </form>
            <p style="margin-top:1.2rem;font-size:.8rem">
                <a class="link-underline" href="<?php echo e(route('login')); ?>">← <?php echo e(t('nav.signin')); ?></a>
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/auth/forgot-password.blade.php ENDPATH**/ ?>