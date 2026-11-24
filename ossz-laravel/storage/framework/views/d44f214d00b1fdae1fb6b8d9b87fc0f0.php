<?php $__env->startSection('title', $order ? "Order {$order->order_number}" : t('footer.trackLink')); ?>

<?php $__env->startSection('content'); ?>
    <section class="wrap" style="padding:3rem 0;max-width:760px">
        <h1 class="display" style="font-size:1.6rem">
            <?php echo e($order ? (is_fr() ? 'Commande' : 'Order').' '.$order->order_number : t('footer.trackLink')); ?>

        </h1>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $order): ?>
            <div class="card" style="padding:2rem;margin-top:1.5rem">
                <p style="font-size:.9rem;color:var(--ink-soft)">
                    <?php echo e(is_fr() ? 'Nous n\'avons pas trouvé cette commande. Vérifiez le numéro et réessayez.' : 'We could not find that order. Check the number and try again.'); ?>

                </p>
                <a class="btn btn-secondary btn-sm" style="margin-top:1rem" href="<?php echo e(route('order.lookup.form')); ?>">← <?php echo e(t('footer.trackLink')); ?></a>
            </div>
        <?php elseif(! $matched): ?>
            <div class="card" style="padding:2rem;margin-top:1.5rem">
                <p style="font-size:.9rem;color:var(--ink-soft)">
                    <?php echo e(is_fr()
                        ? 'Pour des raisons de confidentialité, confirmez l\'email ou le téléphone utilisé lors de la commande.'
                        : 'For privacy, please confirm the email or phone used when ordering.'); ?>

                </p>
                <form method="GET" action="<?php echo e(url('order/'.$order->order_number)); ?>" style="display:flex;gap:.6rem;margin-top:1rem;max-width:420px">
                    <input class="field" name="contact" required placeholder="email / <?php echo e(t('contact.wa')); ?>" value="<?php echo e($contact); ?>">
                    <button class="btn btn-primary btn-sm" type="submit"><?php echo e(is_fr() ? 'Confirmer' : 'Confirm'); ?></button>
                </form>
            </div>
        <?php else: ?>
            <div class="card" style="padding:1.8rem;margin-top:1.5rem">
                <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:.6rem">
                    <div>
                        <p class="eyebrow"><?php echo e(status_label($order->status)); ?></p>
                        <p style="font-size:.9rem;margin-top:.3rem"><?php echo e($order->customer_name); ?></p>
                        <p style="font-size:.75rem;color:var(--muted)"><?php echo e(format_date_time($order->created_at)); ?></p>
                    </div>
                    <div style="text-align:right">
                        <p class="eyebrow"><?php echo e(t('cart.total')); ?></p>
                        <p style="font-size:1.2rem"><?php echo e(format_xaf($order->total)); ?></p>
                        <p style="font-size:.72rem;color:var(--muted)"><?php echo e(payment_label($order->payment_method)); ?> · <?php echo e(status_label($order->payment_status)); ?></p>
                    </div>
                </div>

                
                <div style="display:flex;gap:.3rem;margin-top:1.8rem">
                    <?php
                        $steps = ['placed', 'processing', 'ready', 'out_for_delivery', 'delivered'];
                        $idx = array_search($order->status, $steps, true);
                        $cancelled = in_array($order->status, ['cancelled', 'returned']);
                    ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div style="flex:1;text-align:center">
                            <div style="height:4px;border-radius:2px;background:<?php echo e((! $cancelled && $i <= $idx) ? 'var(--accent)' : 'var(--line)'); ?>"></div>
                            <p style="font-size:.6rem;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);margin-top:.35rem"><?php echo e(status_label($step)); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cancelled): ?>
                    <p class="pill pill-red" style="margin-top:1rem"><?php echo e(status_label($order->status)); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="card" style="padding:1.5rem;margin-top:1rem">
                <p class="eyebrow"><?php echo e(is_fr() ? 'Articles' : 'Items'); ?></p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="display:flex;justify-content:space-between;gap:1rem;padding:.7rem 0;border-bottom:1px solid var(--line);font-size:.88rem">
                        <span><?php echo e($item->product_name); ?> <span style="color:var(--muted);font-size:.75rem"><?php echo e($item->variant_label); ?> × <?php echo e($item->quantity); ?></span></span>
                        <span><?php echo e(format_xaf($item->unit_price * $item->quantity)); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="summary-row" style="margin-top:.8rem"><span><?php echo e(t('cart.subtotal')); ?></span><span><?php echo e(format_xaf($order->subtotal)); ?></span></div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->discount > 0): ?>
                    <div class="summary-row" style="color:#3f9d63"><span><?php echo e(t('cart.discount')); ?></span><span>−<?php echo e(format_xaf($order->discount)); ?></span></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="summary-row"><span><?php echo e(t('cart.deliveryEstimate')); ?> — <?php echo e(delivery_label($order->delivery_method)); ?></span><span><?php echo e($order->delivery_fee == 0 ? t('cart.complimentary') : format_xaf($order->delivery_fee)); ?></span></div>
                <div class="summary-row total"><span><?php echo e(t('cart.total')); ?></span><span><?php echo e(format_xaf($order->total)); ?></span></div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/order-track.blade.php ENDPATH**/ ?>