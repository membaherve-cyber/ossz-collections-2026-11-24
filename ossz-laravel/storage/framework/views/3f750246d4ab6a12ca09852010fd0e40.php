<?php $__env->startSection('title', is_fr() ? 'Réglages' : 'Settings'); ?>

<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e(route('admin.settings.save')); ?>" class="card" style="padding:1.5rem;max-width:680px">
        <?php echo csrf_field(); ?>
        <div class="form-grid">
            <div>
                <label class="label">WhatsApp (<?php echo e(is_fr() ? 'principal' : 'primary'); ?>)</label>
                <input class="field" name="whatsapp_number" value="<?php echo e($settings['whatsapp_number']); ?>">
            </div>
            <div>
                <label class="label">WhatsApp (<?php echo e(is_fr() ? 'secondaire' : 'secondary'); ?>)</label>
                <input class="field" name="whatsapp_number2" value="<?php echo e($settings['whatsapp_number2']); ?>">
            </div>
            <div>
                <label class="label"><?php echo e(is_fr() ? 'Adresse de la boutique' : 'Store address'); ?></label>
                <input class="field" name="store_address" value="<?php echo e($settings['store_address']); ?>">
            </div>
            <div>
                <label class="label"><?php echo e(is_fr() ? 'Horaires' : 'Business hours'); ?></label>
                <input class="field" name="business_hours" value="<?php echo e($settings['business_hours']); ?>">
            </div>
            <div>
                <label class="label">Contact email</label>
                <input class="field" type="email" name="contact_email" value="<?php echo e($settings['contact_email']); ?>">
            </div>
            <div>
                <label class="label"><?php echo e(is_fr() ? 'Message d\'accueil du concierge' : 'Concierge greeting'); ?></label>
                <textarea class="field" name="concierge_greeting" rows="2"><?php echo e($settings['concierge_greeting']); ?></textarea>
            </div>
            <div class="form-grid cols-2">
                <div>
                    <label class="label"><?php echo e(is_fr() ? 'Seuil livraison offerte (FCFA)' : 'Free delivery threshold (FCFA)'); ?></label>
                    <input class="field" type="number" name="free_delivery_threshold" value="<?php echo e($settings['free_delivery_threshold']); ?>">
                </div>
                <div>
                    <label class="label"><?php echo e(is_fr() ? 'Paiement à la livraison' : 'Cash on delivery'); ?></label>
                    <select class="field" name="cod_enabled">
                        <option value="true" <?php if($settings['cod_enabled'] === 'true'): echo 'selected'; endif; ?>><?php echo e(is_fr() ? 'Activé' : 'Enabled'); ?></option>
                        <option value="false" <?php if($settings['cod_enabled'] !== 'true'): echo 'selected'; endif; ?>><?php echo e(is_fr() ? 'Désactivé' : 'Disabled'); ?></option>
                    </select>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" style="margin-top:1.2rem" type="submit"><?php echo e(is_fr() ? 'Enregistrer' : 'Save settings'); ?></button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/settings.blade.php ENDPATH**/ ?>