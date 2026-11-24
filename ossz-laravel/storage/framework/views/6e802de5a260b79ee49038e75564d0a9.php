<?php $__env->startSection('title', t('nav.appointments')); ?>

<?php $__env->startSection('content'); ?>
    <div class="card" style="padding:1.2rem">
        <table class="table">
            <thead>
                <tr>
                    <th>Ref</th><th><?php echo e(is_fr() ? 'Client' : 'Client'); ?></th><th><?php echo e(is_fr() ? 'Créneau' : 'Slot'); ?></th>
                    <th><?php echo e(is_fr() ? 'Prestation' : 'Service'); ?></th><th><?php echo e(is_fr() ? 'Statut' : 'Status'); ?></th><th></th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="font-size:.8rem"><?php echo e($appointment->reference); ?></td>
                        <td>
                            <strong style="font-size:.85rem"><?php echo e($appointment->guest_name); ?></strong><br>
                            <span style="font-size:.72rem;color:var(--muted)"><?php echo e($appointment->guest_contact); ?></span>
                        </td>
                        <td style="font-size:.8rem"><?php echo e(format_date_time($appointment->slot_start)); ?></td>
                        <td style="font-size:.8rem"><?php echo e($appointment->service); ?></td>
                        <td>
                            <span class="pill <?php echo e($appointment->status === 'confirmed' ? 'pill-green' : ($appointment->status === 'cancelled' ? 'pill-red' : ($appointment->status === 'completed' ? 'pill-blue' : 'pill-yellow'))); ?>">
                                <?php echo e(status_label($appointment->status)); ?>

                            </span>
                        </td>
                        <td>
                            <form method="POST" action="<?php echo e(route('admin.appointments.update', $appointment)); ?>" class="inline-form" style="display:flex;gap:.4rem">
                                <?php echo csrf_field(); ?>
                                <select class="field" style="width:auto;padding:.3rem .4rem;font-size:.75rem" name="status">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['requested', 'confirmed', 'completed', 'cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($s); ?>" <?php if($appointment->status === $s): echo 'selected'; endif; ?>><?php echo e(status_label($s)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                                <button class="btn btn-secondary btn-sm" type="submit">✓</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" style="color:var(--muted)"><?php echo e(is_fr() ? 'Aucun rendez-vous.' : 'No appointments.'); ?></td></tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/appointments.blade.php ENDPATH**/ ?>