<?php $__env->startSection('account'); ?>
    <div class="card" style="padding:1.5rem">
        <h2 class="display" style="font-size:1.2rem"><?php echo e(t('nav.appointments')); ?></h2>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="display:flex;justify-content:space-between;align-items:center;padding:.9rem 0;border-bottom:1px solid var(--line);flex-wrap:wrap;gap:.5rem">
                <div>
                    <strong style="font-size:.9rem"><?php echo e($apt->reference); ?></strong> — <?php echo e($apt->service); ?>

                    <p style="font-size:.75rem;color:var(--muted);margin-top:.2rem"><?php echo e(format_date_time($apt->slot_start)); ?></p>
                </div>
                <div style="display:flex;gap:.8rem;align-items:center">
                    <span class="pill <?php echo e($apt->status === 'confirmed' ? 'pill-green' : ($apt->status === 'cancelled' ? 'pill-red' : 'pill-yellow')); ?>"><?php echo e(status_label($apt->status)); ?></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($apt->status, ['requested', 'confirmed'])): ?>
                        <form method="POST" action="<?php echo e(route('account.appointments.cancel')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($apt->id); ?>">
                            <button class="btn btn-ghost btn-sm" type="submit"><?php echo e(is_fr() ? 'Annuler' : 'Cancel'); ?></button>
                        </form>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="margin-top:1rem;font-size:.85rem;color:var(--muted)"><?php echo e(is_fr() ? 'Aucun rendez-vous.' : 'No appointments.'); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.account', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/account/appointments.blade.php ENDPATH**/ ?>