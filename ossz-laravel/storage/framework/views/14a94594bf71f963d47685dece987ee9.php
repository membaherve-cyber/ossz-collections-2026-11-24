<?php $__env->startSection('account'); ?>
    <div class="grid grid-2">
        <div class="card" style="padding:1.5rem">
            <p class="eyebrow"><?php echo e(is_fr() ? 'Dernières commandes' : 'Recent orders'); ?></p>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div style="display:flex;justify-content:space-between;padding:.7rem 0;border-bottom:1px solid var(--line);font-size:.85rem">
                    <span>
                        <a class="link-underline" href="<?php echo e(route('order.track', ['number' => $order->order_number, 'contact' => $order->guest_email])); ?>"><?php echo e($order->order_number); ?></a>
                        <span style="color:var(--muted);font-size:.72rem"> · <?php echo e(format_date($order->created_at)); ?></span>
                    </span>
                    <span><?php echo e(format_xaf($order->total)); ?> · <?php echo e(status_label($order->status)); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p style="margin-top:.8rem;font-size:.85rem;color:var(--muted)"><?php echo e(is_fr() ? 'Aucune commande pour le moment.' : 'No orders yet.'); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="card" style="padding:1.5rem">
            <p class="eyebrow"><?php echo e(t('nav.appointments')); ?></p>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div style="display:flex;justify-content:space-between;padding:.7rem 0;border-bottom:1px solid var(--line);font-size:.85rem">
                    <span><?php echo e($apt->reference); ?> · <?php echo e($apt->service); ?></span>
                    <span><?php echo e(format_date_time($apt->slot_start)); ?> · <?php echo e(status_label($apt->status)); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p style="margin-top:.8rem;font-size:.85rem;color:var(--muted)"><?php echo e(is_fr() ? 'Aucun rendez-vous.' : 'No appointments.'); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <a class="btn btn-secondary btn-sm" style="margin-top:1rem" href="<?php echo e(route('appointments')); ?>"><?php echo e(t('home.bookCta')); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.account', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/account/home.blade.php ENDPATH**/ ?>