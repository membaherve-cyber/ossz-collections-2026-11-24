<?php $__env->startSection('title', t('cart.title')); ?>

<?php $__env->startSection('content'); ?>
    <div class="wrap cart-layout">
        <div>
            <h1 class="display" style="font-size:1.7rem"><?php echo e(t('cart.title')); ?></h1>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($cart['lines']) === 0): ?>
                <div class="card" style="padding:3rem;text-align:center;margin-top:1.5rem">
                    <h2 class="display" style="font-size:1.2rem"><?php echo e(t('cart.empty')); ?></h2>
                    <p style="margin-top:.6rem;font-size:.85rem;color:var(--ink-soft)"><?php echo e(t('cart.emptyBody')); ?></p>
                    <a href="<?php echo e(route('shop')); ?>" class="btn btn-primary" style="margin-top:1.5rem"><?php echo e(t('cart.browse')); ?></a>
                </div>
            <?php else: ?>
                <div style="margin-top:1rem">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cart['lines']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="cart-line">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($line['image']): ?>
                                <a href="<?php echo e(route('product.show', $line['slug'])); ?>"><img src="<?php echo e($line['image']); ?>" alt="<?php echo e($line['name']); ?>"></a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div style="flex:1">
                                <a class="link-underline" href="<?php echo e(route('product.show', $line['slug'])); ?>"><?php echo e($line['name']); ?></a>
                                <p style="font-size:.75rem;color:var(--muted)"><?php echo e($line['size']); ?> · <?php echo e($line['colour']); ?></p>
                                <form method="POST" action="<?php echo e(route('cart.update')); ?>" style="display:flex;gap:.5rem;align-items:center;margin-top:.5rem">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="item_id" value="<?php echo e($line['itemId']); ?>">
                                    <input class="field" style="width:70px;padding:.35rem .5rem" type="number" name="quantity"
                                           min="0" max="<?php echo e(max($line['stockQty'], $line['quantity'])); ?>" value="<?php echo e($line['quantity']); ?>">
                                    <button class="btn btn-ghost btn-sm" type="submit"><?php echo e(t('cart.apply')); ?></button>
                                    <span style="font-size:.72rem;color:var(--muted)"><?php echo e($line['stockQty'] > 0 ? t('buy.inStock') : t('buy.soldOut')); ?></span>
                                </form>
                            </div>
                            <div style="text-align:right">
                                <p style="font-size:.9rem"><?php echo e(format_xaf($line['unitPrice'] * $line['quantity'])); ?></p>
                                <form method="POST" action="<?php echo e(route('cart.remove')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="item_id" value="<?php echo e($line['itemId']); ?>">
                                    <button class="btn btn-ghost btn-sm" type="submit"><?php echo e(t('cart.remove')); ?></button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <form method="POST" action="<?php echo e(route('cart.coupon')); ?>" style="display:flex;gap:.5rem;margin-top:1.2rem;max-width:380px">
                        <?php echo csrf_field(); ?>
                        <input class="field" type="text" name="code" value="<?php echo e($cart['couponCode']); ?>" placeholder="<?php echo e(t('cart.coupon')); ?>">
                        <button class="btn btn-secondary btn-sm" type="submit"><?php echo e(t('cart.apply')); ?></button>
                    </form>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($cart['lines']) > 0): ?>
            <aside class="card summary" style="height:fit-content">
                <h2 class="display" style="font-size:1.2rem"><?php echo e(t('cart.summary')); ?></h2>
                <div class="summary-row"><span><?php echo e(t('cart.subtotal')); ?></span><span><?php echo e(format_xaf($cart['subtotal'])); ?></span></div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cart['discount'] > 0): ?>
                    <div class="summary-row" style="color:#3f9d63"><span><?php echo e(t('cart.discount')); ?></span><span>−<?php echo e(format_xaf($cart['discount'])); ?></span></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="summary-row"><span><?php echo e(t('cart.deliveryEstimate')); ?></span><span><?php echo e(t('cart.complimentary')); ?></span></div>
                <div class="summary-row"><span><?php echo e(t('cart.vat')); ?></span><span><?php echo e(t('cart.vatIncluded')); ?></span></div>
                <div class="summary-row total"><span><?php echo e(t('cart.total')); ?></span><span><?php echo e(format_xaf($cart['subtotal'] - $cart['discount'])); ?></span></div>

                <p style="font-size:.72rem;color:var(--muted);margin-top:1rem"><?php echo e(t('cart.freeAbove')); ?></p>

                <div style="display:grid;gap:.6rem;margin-top:1.4rem">
                    <a href="<?php echo e(route('checkout.show')); ?>" class="btn btn-primary"><?php echo e(t('cart.checkoutAccount')); ?></a>
                    <a href="<?php echo e(route('checkout.show')); ?>" class="btn btn-secondary"><?php echo e(t('cart.checkoutGuest')); ?></a>
                    <p style="font-size:.7rem;color:var(--muted);text-align:center"><?php echo e(t('cart.guestNote')); ?></p>
                </div>

                <a href="<?php echo e(route('shop')); ?>" class="btn btn-ghost btn-sm" style="margin-top:1rem"><?php echo e(t('cart.continue')); ?></a>
            </aside>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/cart.blade.php ENDPATH**/ ?>