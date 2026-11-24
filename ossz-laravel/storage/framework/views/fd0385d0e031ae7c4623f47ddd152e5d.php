<?php $__env->startSection('account'); ?>
    <div class="card" style="padding:1.5rem">
        <h2 class="display" style="font-size:1.2rem"><?php echo e(is_fr() ? 'Toutes mes commandes' : 'All my orders'); ?></h2>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="padding:1rem 0;border-bottom:1px solid var(--line)">
                <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:.5rem">
                    <div>
                        <strong style="font-size:.9rem"><?php echo e($order->order_number); ?></strong>
                        <span class="pill pill-gray" style="margin-left:.5rem"><?php echo e(status_label($order->status)); ?></span>
                        <p style="font-size:.72rem;color:var(--muted);margin-top:.2rem"><?php echo e(format_date_time($order->created_at)); ?> · <?php echo e(payment_label($order->payment_method)); ?></p>
                    </div>
                    <div style="text-align:right">
                        <p style="font-size:.95rem"><?php echo e(format_xaf($order->total)); ?></p>
                        <a class="link-underline" style="font-size:.75rem" href="<?php echo e(route('order.track', ['number' => $order->order_number, 'contact' => $order->guest_email ?: $order->guest_phone])); ?>">
                            <?php echo e(t('footer.trackLink')); ?>

                        </a>
                    </div>
                </div>
                <ul style="list-style:none;margin-top:.5rem;font-size:.8rem;color:var(--ink-soft)">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($item->product_name); ?> (<?php echo e($item->variant_label); ?>) × <?php echo e($item->quantity); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="margin-top:1rem;font-size:.85rem;color:var(--muted)"><?php echo e(is_fr() ? 'Aucune commande pour le moment.' : 'No orders yet.'); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.account', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/account/orders.blade.php ENDPATH**/ ?>