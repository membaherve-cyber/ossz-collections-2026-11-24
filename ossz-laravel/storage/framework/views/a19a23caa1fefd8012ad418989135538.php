<?php $__env->startSection('account'); ?>
    <div class="grid grid-2">
        <div class="card" style="padding:1.5rem">
            <h2 class="display" style="font-size:1.2rem"><?php echo e(is_fr() ? 'Mes adresses' : 'My addresses'); ?></h2>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div style="padding:1rem 0;border-bottom:1px solid var(--line);font-size:.85rem">
                    <strong><?php echo e($address->label); ?></strong> — <?php echo e($address->full_name); ?>

                    <p style="color:var(--muted);font-size:.78rem;margin-top:.2rem">
                        <?php echo e($address->street); ?> <?php echo e($address->area); ?>, <?php echo e($address->city); ?> · <?php echo e($address->phone); ?>

                    </p>
                    <form method="POST" action="<?php echo e(route('account.addresses.delete')); ?>" style="margin-top:.4rem">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($address->id); ?>">
                        <button class="btn btn-ghost btn-sm" type="submit"><?php echo e(is_fr() ? 'Supprimer' : 'Remove'); ?></button>
                    </form>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p style="margin-top:1rem;font-size:.85rem;color:var(--muted)"><?php echo e(is_fr() ? 'Aucune adresse enregistrée.' : 'No saved addresses.'); ?></p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="card" style="padding:1.5rem">
            <h2 class="display" style="font-size:1.2rem"><?php echo e(is_fr() ? 'Ajouter une adresse' : 'Add an address'); ?></h2>
            <form method="POST" action="<?php echo e(route('account.addresses.save')); ?>" class="form-grid" style="margin-top:1rem">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="label" for="label"><?php echo e(is_fr() ? 'Libellé' : 'Label'); ?></label>
                    <input class="field" id="label" name="label" value="<?php echo e(old('label', 'Home')); ?>">
                </div>
                <div>
                    <label class="label" for="full_name"><?php echo e(is_fr() ? 'Nom complet' : 'Full name'); ?> *</label>
                    <input class="field" id="full_name" name="full_name" required value="<?php echo e(old('full_name', $osszUser->full_name)); ?>">
                </div>
                <div>
                    <label class="label" for="phone"><?php echo e(t('contact.wa')); ?> *</label>
                    <input class="field" id="phone" name="phone" required value="<?php echo e(old('phone', $osszUser->phone)); ?>">
                </div>
                <div class="form-grid cols-2">
                    <div>
                        <label class="label" for="city"><?php echo e(is_fr() ? 'Ville' : 'City'); ?></label>
                        <input class="field" id="city" name="city" value="<?php echo e(old('city', 'Douala')); ?>">
                    </div>
                    <div>
                        <label class="label" for="area"><?php echo e(is_fr() ? 'Quartier' : 'Area'); ?></label>
                        <input class="field" id="area" name="area" value="<?php echo e(old('area')); ?>">
                    </div>
                </div>
                <div>
                    <label class="label" for="street"><?php echo e(is_fr() ? 'Rue' : 'Street'); ?></label>
                    <input class="field" id="street" name="street" value="<?php echo e(old('street')); ?>">
                </div>
                <button class="btn btn-primary" type="submit"><?php echo e(is_fr() ? 'Enregistrer' : 'Save address'); ?></button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.account', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/account/addresses.blade.php ENDPATH**/ ?>