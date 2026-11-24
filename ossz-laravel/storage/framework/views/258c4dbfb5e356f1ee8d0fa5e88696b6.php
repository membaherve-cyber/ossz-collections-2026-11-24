<?php $__env->startSection('title', t('footer.trackLink')); ?>

<?php $__env->startSection('content'); ?>
    <section class="wrap" style="padding:3rem 0;max-width:520px">
        <h1 class="display" style="font-size:1.6rem"><?php echo e(t('footer.trackLink')); ?></h1>
        <p style="margin-top:.7rem;font-size:.85rem;color:var(--ink-soft)">
            <?php echo e(is_fr()
                ? 'Saisissez votre numéro de commande (OSZ-…) et l\'email ou le téléphone utilisé lors de la commande.'
                : 'Enter your order number (OSZ-…) and the email or phone used when ordering.'); ?>

        </p>

        <form method="POST" action="<?php echo e(route('order.lookup')); ?>" class="form-grid" style="margin-top:1.5rem">
            <?php echo csrf_field(); ?>
            <div>
                <label class="label" for="order_number"><?php echo e(is_fr() ? 'Numéro de commande' : 'Order number'); ?></label>
                <input class="field" id="order_number" name="order_number" required placeholder="OSZ-XXXXXXX" value="<?php echo e(old('order_number')); ?>">
            </div>
            <div>
                <label class="label" for="contact">Email / <?php echo e(t('contact.wa')); ?></label>
                <input class="field" id="contact" name="contact" required value="<?php echo e(old('contact')); ?>">
            </div>
            <button class="btn btn-primary" type="submit"><?php echo e(is_fr() ? 'Suivre' : 'Track'); ?></button>
        </form>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/order-lookup.blade.php ENDPATH**/ ?>