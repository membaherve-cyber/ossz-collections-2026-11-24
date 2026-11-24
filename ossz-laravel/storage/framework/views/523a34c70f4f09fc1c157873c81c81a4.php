<?php $__env->startSection('title', is_fr() ? 'Créer un compte' : 'Create an account'); ?>

<?php $__env->startSection('content'); ?>
    <div class="wrap">
        <div class="card auth-card">
            <h1 class="display"><?php echo e(is_fr() ? 'Créer un compte' : 'Create an account'); ?></h1>
            <form method="POST" action="<?php echo e(route('register.store')); ?>" class="form-grid">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="next" value="<?php echo e($next); ?>">
                <div>
                    <label class="label" for="fullName"><?php echo e(is_fr() ? 'Nom complet' : 'Full name'); ?></label>
                    <input class="field" id="fullName" name="fullName" value="<?php echo e(old('fullName')); ?>">
                </div>
                <div>
                    <label class="label" for="email">Email *</label>
                    <input class="field" id="email" type="email" name="email" required value="<?php echo e(old('email')); ?>">
                </div>
                <div>
                    <label class="label" for="phone"><?php echo e(t('contact.wa')); ?></label>
                    <input class="field" id="phone" name="phone" value="<?php echo e(old('phone')); ?>">
                </div>
                <div>
                    <label class="label" for="password"><?php echo e(t('buy.password')); ?> *</label>
                    <input class="field" id="password" type="password" name="password" required minlength="6">
                </div>
                <button class="btn btn-primary" type="submit"><?php echo e(is_fr() ? 'Créer mon compte' : 'Create my account'); ?></button>
            </form>
            <p style="margin-top:1.2rem;font-size:.8rem">
                <?php echo e(is_fr() ? 'Déjà un compte ?' : 'Already have an account?'); ?>

                <a class="link-underline" href="<?php echo e(route('login', ['next' => $next])); ?>"><?php echo e(t('nav.signin')); ?></a>
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/auth/register.blade.php ENDPATH**/ ?>