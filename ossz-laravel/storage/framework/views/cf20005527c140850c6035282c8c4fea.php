<?php $__env->startSection('title', is_fr() ? 'Codes promo' : 'Coupons'); ?>

<?php $__env->startSection('content'); ?>
    <div class="grid" style="grid-template-columns:1.3fr 1fr;align-items:start">
        <div class="card" style="padding:1.2rem">
            <table class="table">
                <thead>
                    <tr><th>Code</th><th><?php echo e(is_fr() ? 'Type' : 'Type'); ?></th><th><?php echo e(is_fr() ? 'Valeur' : 'Value'); ?></th><th><?php echo e(is_fr() ? 'Utilisations' : 'Used'); ?></th><th><?php echo e(is_fr() ? 'Statut' : 'Status'); ?></th><th></th></tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><strong style="font-size:.85rem"><?php echo e($coupon->code); ?></strong>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($coupon->expires_at): ?><br><span style="font-size:.7rem;color:var(--muted)"><?php echo e(is_fr() ? 'exp.' : 'exp.'); ?> <?php echo e(format_date($coupon->expires_at)); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td style="font-size:.8rem"><?php echo e($coupon->type); ?></td>
                            <td><?php echo e($coupon->type === 'percentage' ? $coupon->value.'%' : format_xaf($coupon->value)); ?></td>
                            <td><?php echo e($coupon->times_used); ?><?php echo e($coupon->usage_limit ? ' / '.$coupon->usage_limit : ''); ?></td>
                            <td><span class="pill <?php echo e($coupon->is_active ? 'pill-green' : 'pill-gray'); ?>"><?php echo e($coupon->is_active ? (is_fr() ? 'actif' : 'active') : (is_fr() ? 'inactif' : 'inactive')); ?></span></td>
                            <td>
                                <form method="POST" action="<?php echo e(route('admin.coupons.toggle')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($coupon->id); ?>">
                                    <button class="btn btn-ghost btn-sm" type="submit"><?php echo e($coupon->is_active ? '⏸' : '▶'); ?></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" style="color:var(--muted)"><?php echo e(is_fr() ? 'Aucun code.' : 'No coupons.'); ?></td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="card" style="padding:1.5rem">
            <h3 style="font-size:.95rem;font-weight:400"><?php echo e(is_fr() ? 'Nouveau code' : 'New coupon'); ?></h3>
            <form method="POST" action="<?php echo e(route('admin.coupons.store')); ?>" class="form-grid" style="margin-top:1rem">
                <?php echo csrf_field(); ?>
                <input class="field" name="code" placeholder="OSSZ10" required style="text-transform:uppercase">
                <select class="field" name="type">
                    <option value="percentage"><?php echo e(is_fr() ? 'Pourcentage (%)' : 'Percentage (%)'); ?></option>
                    <option value="fixed"><?php echo e(is_fr() ? 'Montant fixe (FCFA)' : 'Fixed amount (FCFA)'); ?></option>
                    <option value="free_delivery"><?php echo e(is_fr() ? 'Livraison offerte' : 'Free delivery'); ?></option>
                </select>
                <input class="field" type="number" name="value" min="0" placeholder="Value">
                <input class="field" type="number" name="usage_limit" min="0" placeholder="<?php echo e(is_fr() ? 'Limite (0 = illimité)' : 'Usage limit (0 = unlimited)'); ?>">
                <input class="field" type="date" name="expires_at">
                <button class="btn btn-primary btn-sm" type="submit"><?php echo e(is_fr() ? 'Créer' : 'Create'); ?></button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/coupons.blade.php ENDPATH**/ ?>