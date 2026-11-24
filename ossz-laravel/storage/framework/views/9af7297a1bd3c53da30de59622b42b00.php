<?php $__env->startSection('title', is_fr() ? 'Clients' : 'Customers'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card" style="padding:1.2rem">
        <table class="table">
            <thead>
                <tr><th>Email</th><th><?php echo e(is_fr() ? 'Nom' : 'Name'); ?></th><th><?php echo e(t('contact.wa')); ?></th><th><?php echo e(is_fr() ? 'Commandes' : 'Orders'); ?></th><th><?php echo e(is_fr() ? 'Inscrit le' : 'Joined'); ?></th></tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="font-size:.85rem"><?php echo e($customer->email); ?></td>
                        <td><?php echo e($customer->full_name); ?></td>
                        <td style="font-size:.8rem"><?php echo e($customer->phone); ?></td>
                        <td><?php echo e($customer->orders_count); ?></td>
                        <td style="font-size:.75rem"><?php echo e(format_date($customer->created_at)); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" style="color:var(--muted)"><?php echo e(is_fr() ? 'Aucun client.' : 'No customers.'); ?></td></tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/customers.blade.php ENDPATH**/ ?>