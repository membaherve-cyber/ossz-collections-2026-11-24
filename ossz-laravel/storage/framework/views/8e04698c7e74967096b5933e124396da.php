<?php $__env->startSection('content'); ?>
    <div class="wrap" style="padding:3rem 0;display:grid;gap:2.5rem;grid-template-columns:1fr">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem">
            <div>
                <p class="eyebrow"><?php echo e(is_fr() ? 'Mon compte' : 'My account'); ?></p>
                <h1 class="display" style="font-size:1.5rem"><?php echo e($osszUser->full_name ?: $osszUser->email); ?></h1>
            </div>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="btn btn-ghost btn-sm" type="submit"><?php echo e(is_fr() ? 'Se déconnecter' : 'Sign out'); ?></button>
            </form>
        </div>

        <nav style="display:flex;gap:1.5rem;flex-wrap:wrap;border-bottom:1px solid var(--line);padding-bottom:1rem;font-size:.8rem;text-transform:uppercase;letter-spacing:.1em">
            <a class="link-underline <?php echo e(url()->current() === route('account.home') ? '' : ''); ?>" href="<?php echo e(route('account.home')); ?>"><?php echo e(is_fr() ? 'Aperçu' : 'Overview'); ?></a>
            <a class="link-underline" href="<?php echo e(route('account.orders')); ?>"><?php echo e(is_fr() ? 'Commandes' : 'Orders'); ?></a>
            <a class="link-underline" href="<?php echo e(route('account.appointments')); ?>"><?php echo e(t('nav.appointments')); ?></a>
            <a class="link-underline" href="<?php echo e(route('account.addresses')); ?>"><?php echo e(is_fr() ? 'Adresses' : 'Addresses'); ?></a>
            <a class="link-underline" href="<?php echo e(route('account.wishlist')); ?>"><?php echo e(t('buy.wishlist')); ?></a>
            <a class="link-underline" href="<?php echo e(route('account.profile')); ?>"><?php echo e(is_fr() ? 'Profil' : 'Profile'); ?></a>
        </nav>

        <div>
            <?php echo $__env->yieldContent('account'); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/layouts/account.blade.php ENDPATH**/ ?>