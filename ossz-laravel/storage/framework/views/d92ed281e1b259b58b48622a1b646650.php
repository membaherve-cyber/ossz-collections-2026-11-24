<?php $__env->startSection('account'); ?>
    <div class="card" style="padding:1.5rem;max-width:520px">
        <h2 class="display" style="font-size:1.2rem"><?php echo e(is_fr() ? 'Mes informations' : 'My details'); ?></h2>
        <form method="POST" action="<?php echo e(route('account.profile.update')); ?>" class="form-grid" style="margin-top:1rem">
            <?php echo csrf_field(); ?>
            <div>
                <label class="label" for="fullName"><?php echo e(is_fr() ? 'Nom complet' : 'Full name'); ?></label>
                <input class="field" id="fullName" name="fullName" value="<?php echo e(old('fullName', $user->full_name)); ?>">
            </div>
            <div>
                <label class="label" for="phone"><?php echo e(t('contact.wa')); ?></label>
                <input class="field" id="phone" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>">
            </div>
            <div>
                <label class="label" for="password"><?php echo e(is_fr() ? 'Nouveau mot de passe (optionnel)' : 'New password (optional)'); ?></label>
                <input class="field" id="password" type="password" name="password" minlength="6" autocomplete="new-password">
            </div>
            <div>
                <label class="label" for="currentPassword"><?php echo e(is_fr() ? 'Mot de passe actuel (pour confirmer le nouveau)' : 'Current password (to confirm a new one)'); ?></label>
                <input class="field" id="currentPassword" type="password" name="currentPassword" autocomplete="current-password">
            </div>
            <button class="btn btn-primary" type="submit"><?php echo e(is_fr() ? 'Enregistrer' : 'Save'); ?></button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.account', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/account/profile.blade.php ENDPATH**/ ?>