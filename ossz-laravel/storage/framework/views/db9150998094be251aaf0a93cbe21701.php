<?php $__env->startSection('title', t('checkout.title')); ?>

<?php $__env->startSection('content'); ?>
    <?php $user = \App\Models\User::find(session('user_id')); ?>

    <div class="wrap cart-layout">
        <div>
            <h1 class="display" style="font-size:1.7rem"><?php echo e(t('checkout.title')); ?></h1>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $user): ?>
                <p style="font-size:.78rem;color:var(--muted);margin-top:.4rem"><?php echo e(t('checkout.guestBanner')); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form method="POST" action="<?php echo e(route('checkout.place')); ?>" class="form-grid" style="margin-top:1.5rem">
                <?php echo csrf_field(); ?>

                <fieldset class="card" style="padding:1.5rem;border:1px solid var(--line)">
                    <legend class="eyebrow"><?php echo e(t('checkout.confirmAddress')); ?></legend>
                    <p style="font-size:.75rem;color:var(--muted);margin-bottom:1rem"><?php echo e(t('checkout.confirmAddressBody')); ?></p>

                    <div class="form-grid cols-2">
                        <div>
                            <label class="label" for="customerName"><?php echo e(is_fr() ? 'Nom complet' : 'Full name'); ?> *</label>
                            <input class="field" id="customerName" name="customerName" required
                                   value="<?php echo e(old('customerName', $user->full_name ?? '')); ?>">
                        </div>
                        <div>
                            <label class="label" for="phone"><?php echo e(t('contact.wa')); ?> / <?php echo e(is_fr() ? 'Téléphone' : 'Phone'); ?></label>
                            <input class="field" id="phone" name="phone" value="<?php echo e(old('phone', $user->phone ?? '')); ?>">
                        </div>
                        <div>
                            <label class="label" for="email">Email</label>
                            <input class="field" id="email" type="email" name="email" value="<?php echo e(old('email', $user->email ?? '')); ?>">
                        </div>
                        <div>
                            <label class="label" for="city"><?php echo e(is_fr() ? 'Ville' : 'City'); ?></label>
                            <input class="field" id="city" name="city" value="<?php echo e(old('city', 'Douala')); ?>">
                        </div>
                        <div>
                            <label class="label" for="area"><?php echo e(is_fr() ? 'Quartier' : 'Area'); ?></label>
                            <input class="field" id="area" name="area" value="<?php echo e(old('area')); ?>">
                        </div>
                        <div>
                            <label class="label" for="street"><?php echo e(is_fr() ? 'Rue' : 'Street'); ?></label>
                            <input class="field" id="street" name="street" value="<?php echo e(old('street')); ?>">
                        </div>
                    </div>
                    <div style="margin-top:1rem">
                        <label class="label" for="notes"><?php echo e(is_fr() ? 'Instructions de livraison' : 'Delivery notes'); ?></label>
                        <textarea class="field" id="notes" name="notes" rows="2"><?php echo e(old('notes')); ?></textarea>
                    </div>
                </fieldset>

                <fieldset class="card" style="padding:1.5rem;border:1px solid var(--line)">
                    <legend class="eyebrow"><?php echo e(t('cart.deliveryEstimate')); ?></legend>
                    <div class="form-grid">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label style="display:flex;gap:.6rem;align-items:center;font-size:.85rem">
                                <input type="radio" name="zoneId" value="<?php echo e($zone->id); ?>"
                                       data-method="<?php echo e($zone->method); ?>"
                                       <?php if($loop->first): echo 'checked'; endif; ?>>
                                <span>
                                    <strong><?php echo e(\App\Support\I18n::pick($zone->name, $zone->name_fr)); ?></strong><br>
                                    <span style="color:var(--muted);font-size:.72rem">
                                        <?php echo e(\App\Support\I18n::pick($zone->eta_label, $zone->eta_label_fr)); ?> —
                                        <?php echo e($zone->fee == 0 ? t('cart.complimentary') : format_xaf($zone->fee)); ?>

                                    </span>
                                </span>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </fieldset>

                <fieldset class="card" style="padding:1.5rem;border:1px solid var(--line)">
                    <legend class="eyebrow"><?php echo e(t('buy.payTitle')); ?></legend>
                    <p style="font-size:.75rem;color:var(--muted);margin-bottom:1rem"><?php echo e(t('buy.payTerms')); ?></p>
                    <div class="form-grid">
                        <label style="display:flex;gap:.6rem;align-items:center;font-size:.85rem">
                            <input type="radio" name="paymentMethod" value="mobile_money_mtn" <?php if(old('paymentMethod', 'mobile_money_mtn') === 'mobile_money_mtn'): echo 'checked'; endif; ?>>
                            <?php echo e(t('buy.momoMtn')); ?> — <?php echo e(t('buy.momoHint') ?? ''); ?>

                        </label>
                        <label style="display:flex;gap:.6rem;align-items:center;font-size:.85rem">
                            <input type="radio" name="paymentMethod" value="mobile_money_orange" <?php if(old('paymentMethod') === 'mobile_money_orange'): echo 'checked'; endif; ?>>
                            <?php echo e(t('buy.momoOrange')); ?>

                        </label>
                        <label style="display:flex;gap:.6rem;align-items:center;font-size:.85rem">
                            <input type="radio" name="paymentMethod" value="card" <?php if(old('paymentMethod') === 'card'): echo 'checked'; endif; ?>>
                            <?php echo e(t('buy.card')); ?>

                        </label>
                        <label style="display:flex;gap:.6rem;align-items:center;font-size:.85rem">
                            <input type="radio" name="paymentMethod" value="cash_on_delivery" <?php if(old('paymentMethod') === 'cash_on_delivery'): echo 'checked'; endif; ?>>
                            <?php echo e(t('buy.cod')); ?>

                        </label>
                    </div>
                </fieldset>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $user): ?>
                    <details class="card" style="padding:1.2rem">
                        <summary class="eyebrow" style="cursor:pointer"><?php echo e(t('choose.account')); ?></summary>
                        <p style="font-size:.75rem;color:var(--muted);margin:.6rem 0"><?php echo e(t('choose.accountHint')); ?></p>
                        <input class="field" type="password" name="password" minlength="6" placeholder="<?php echo e(t('buy.password')); ?>">
                    </details>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <label style="display:flex;gap:.6rem;align-items:center;font-size:.85rem">
                    <input type="checkbox" name="confirm_address" required>
                    <?php echo e(t('checkout.confirmTick')); ?>

                </label>

                <button class="btn btn-primary" type="submit" style="width:100%"><?php echo e(t('checkout.place')); ?></button>
            </form>
        </div>

        <aside class="card summary" style="height:fit-content">
            <h2 class="display" style="font-size:1.2rem"><?php echo e(t('cart.summary')); ?></h2>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cart['lines']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="summary-row">
                    <span><?php echo e($line['name']); ?> × <?php echo e($line['quantity']); ?></span>
                    <span><?php echo e(format_xaf($line['unitPrice'] * $line['quantity'])); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="summary-row"><span><?php echo e(t('cart.subtotal')); ?></span><span><?php echo e(format_xaf($cart['subtotal'])); ?></span></div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cart['discount'] > 0): ?>
                <div class="summary-row" style="color:#3f9d63"><span><?php echo e(t('cart.discount')); ?> (<?php echo e($cart['couponCode']); ?>)</span><span>−<?php echo e(format_xaf($cart['discount'])); ?></span></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="summary-row total"><span><?php echo e(t('cart.total')); ?></span><span><?php echo e(format_xaf($cart['subtotal'] - $cart['discount'])); ?></span></div>
            <p style="font-size:.7rem;color:var(--muted);margin-top:.8rem"><?php echo e(t('cart.deliveryEstimate')); ?>: <?php echo e(t('cart.complimentary')); ?> / <?php echo e(format_xaf(6500)); ?></p>
        </aside>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/checkout.blade.php ENDPATH**/ ?>