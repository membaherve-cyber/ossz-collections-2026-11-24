<?php $__env->startSection('title', is_fr() ? 'Commandes' : 'Orders'); ?>

<?php $__env->startSection('content'); ?>
    <form method="GET" style="display:flex;gap:.6rem;flex-wrap:wrap;margin-bottom:1.2rem">
        <input class="field" style="max-width:280px" type="search" name="q" value="<?php echo e($q); ?>" placeholder="<?php echo e(is_fr() ? 'Numéro, nom, email…' : 'Number, name, email…'); ?>">
        <select class="field" style="width:auto" name="status">
            <option value=""><?php echo e(is_fr() ? 'Tous les statuts' : 'All statuses'); ?></option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = ['placed', 'processing', 'ready', 'out_for_delivery', 'delivered', 'returned', 'cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($s); ?>" <?php if($status === $s): echo 'checked'; endif; ?>><?php echo e(status_label($s)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </select>
        <button class="btn btn-secondary btn-sm" type="submit"><?php echo e(is_fr() ? 'Filtrer' : 'Filter'); ?></button>
    </form>

    <div class="card" style="padding:1.2rem">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th><th><?php echo e(is_fr() ? 'Client' : 'Customer'); ?></th><th><?php echo e(is_fr() ? 'Date' : 'Date'); ?></th>
                    <th><?php echo e(is_fr() ? 'Paiement' : 'Payment'); ?></th><th><?php echo e(is_fr() ? 'Statut' : 'Status'); ?></th>
                    <th><?php echo e(is_fr() ? 'Total' : 'Total'); ?></th><th></th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><a class="link-underline" href="<?php echo e(route('admin.orders.show', $order)); ?>"><?php echo e($order->order_number); ?></a></td>
                        <td><?php echo e($order->customer_name); ?><br><span style="font-size:.72rem;color:var(--muted)"><?php echo e($order->guest_email ?: $order->guest_phone); ?></span></td>
                        <td><?php echo e(format_date($order->created_at)); ?></td>
                        <td style="font-size:.75rem"><?php echo e(payment_label($order->payment_method)); ?><br><?php echo e(status_label($order->payment_status)); ?></td>
                        <td><span class="pill pill-blue"><?php echo e(status_label($order->status)); ?></span></td>
                        <td><?php echo e(format_xaf($order->total)); ?></td>
                        <td>
                            <a class="btn btn-ghost btn-sm" href="<?php echo e(route('admin.orders.show', $order)); ?>"><?php echo e(is_fr() ? 'Ouvrir' : 'Open'); ?></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" style="color:var(--muted)"><?php echo e(is_fr() ? 'Aucune commande.' : 'No orders.'); ?></td></tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/orders.blade.php ENDPATH**/ ?>