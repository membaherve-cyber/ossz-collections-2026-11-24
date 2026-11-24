<?php $__env->startSection('title', is_fr() ? 'Connexion' : 'Sign in'); ?>

<?php $__env->startSection('content'); ?>
<div class="wrap" style="max-width:28rem;padding:5rem 1.25rem;">
    <p class="eyebrow"><?php echo e(is_fr() ? 'Bon retour' : 'Welcome back'); ?></p>
    <h1 class="display" style="margin-top:.5rem;font-size:2.25rem;"><?php echo e(is_fr() ? 'Connexion' : 'Sign in'); ?></h1>
    <p style="margin-top:.75rem;font-size:.875rem;line-height:1.6;color:var(--ink-soft);">
        <?php echo e(is_fr() 
            ? 'Un compte conserve vos adresses, l\'historique de vos commandes et votre liste d\'envies. Vous pouvez également commander en tant qu\'invité.' 
            : 'An account keeps your addresses, order history and wishlist to hand. You may always check out as a guest instead.'); ?>

    </p>

    <div style="margin-top:2rem;">
        <form method="POST" action="<?php echo e(route('login.attempt')); ?>" class="card" style="padding:1.5rem;display:flex;flex-direction:column;gap:1rem;">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="next" value="<?php echo e($next); ?>">

            <div>
                <label class="label" for="email"><?php echo e(is_fr() ? 'Email ou identifiant' : 'Email or username'); ?></label>
                <input class="field" id="email" name="email" type="text" required autocomplete="username" value="<?php echo e(old('email')); ?>" autofocus>
            </div>

            <div>
                <label class="label" for="password"><?php echo e(is_fr() ? 'Mot de passe' : 'Password'); ?></label>
                <input class="field" id="password" type="password" name="password" required autocomplete="current-password">
            </div>

            <button class="btn btn-primary" type="submit" style="width:100%;margin-top:.5rem;">
                <?php echo e(is_fr() ? 'Se connecter' : 'Sign in'); ?>

            </button>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                <p style="font-size:.75rem;color:#dc2626;margin:0;"><?php echo e(session('error')); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <p style="text-align:center;font-size:.75rem;color:var(--muted);margin-top:.5rem;">
                <a href="<?php echo e(route('password.request')); ?>" class="link-underline" style="color:var(--accent);">
                    <?php echo e(is_fr() ? 'Mot de passe oublié ?' : 'Forgotten your password?'); ?>

                </a>
            </p>

            <p style="text-align:center;font-size:.75rem;color:var(--muted);">
                <?php echo e(is_fr() ? 'Nouveau client ?' : 'New here?'); ?>

                <a href="<?php echo e(route('register', ['next' => $next])); ?>" class="link-underline" style="color:var(--accent);">
                    <?php echo e(is_fr() ? 'Créer un compte' : 'Create an account'); ?>

                </a>
            </p>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/auth/login.blade.php ENDPATH**/ ?>