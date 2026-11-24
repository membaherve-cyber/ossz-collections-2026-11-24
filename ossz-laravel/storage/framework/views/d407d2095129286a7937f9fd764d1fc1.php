<?php $__env->startSection('title', is_fr() ? 'Tableau de bord' : 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="stat-grid">
        <div class="card stat"><p class="stat-label"><?php echo e(is_fr() ? 'Commandes' : 'Orders'); ?></p><p class="value"><?php echo e($stats['ordersPlaced']); ?></p></div>
        <div class="card stat"><p class="stat-label"><?php echo e(is_fr() ? 'En cours' : 'Open'); ?></p><p class="value"><?php echo e($stats['ordersOpen']); ?></p></div>
        <div class="card stat"><p class="stat-label"><?php echo e(is_fr() ? 'Chiffre d\'affaires' : 'Revenue'); ?></p><p class="value"><?php echo e(format_xaf($stats['revenue'])); ?></p></div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canManage): ?>
            <div class="card stat"><p class="stat-label"><?php echo e(is_fr() ? 'Pièces' : 'Products'); ?></p><p class="value"><?php echo e($stats['products']); ?></p></div>
            <div class="card stat"><p class="stat-label"><?php echo e(is_fr() ? 'Stock bas' : 'Low stock'); ?></p><p class="value"><?php echo e($stats['lowStock']); ?></p></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <div class="card stat"><p class="stat-label"><?php echo e(is_fr() ? 'Clients' : 'Customers'); ?></p><p class="value"><?php echo e($stats['customers']); ?></p></div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canFulfil): ?>
            <div class="card stat"><p class="stat-label">RDV</p><p class="value"><?php echo e($stats['appointments']); ?></p></div>
            <div class="card stat"><p class="stat-label"><?php echo e(is_fr() ? 'Messages' : 'Messages'); ?></p><p class="value"><?php echo e($stats['messages']); ?></p></div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($canFulfil && $recentOrders->isNotEmpty()): ?>
        <div class="card" style="padding:1.5rem">
            <div style="display:flex;justify-content:space-between;align-items:center">
                <h2 style="font-size:1rem;font-weight:400"><?php echo e(is_fr() ? 'Commandes récentes' : 'Recent orders'); ?></h2>
                <a class="btn btn-ghost btn-sm" href="<?php echo e(route('admin.orders.index')); ?>"><?php echo e(is_fr() ? 'Tout voir' : 'View all'); ?> →</a>
            </div>
            <table class="table" style="margin-top:1rem">
                <thead>
                    <tr><th>#</th><th><?php echo e(is_fr() ? 'Client' : 'Customer'); ?></th><th><?php echo e(is_fr() ? 'Date' : 'Date'); ?></th><th><?php echo e(is_fr() ? 'Statut' : 'Status'); ?></th><th><?php echo e(is_fr() ? 'Total' : 'Total'); ?></th><th></th></tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><a class="link-underline" href="<?php echo e(route('admin.orders.show', $order)); ?>"><?php echo e($order->order_number); ?></a></td>
                            <td><?php echo e($order->customer_name); ?></td>
                            <td><?php echo e(format_date($order->created_at)); ?></td>
                            <td><span class="pill pill-blue"><?php echo e(status_label($order->status)); ?></span></td>
                            <td><?php echo e(format_xaf($order->total)); ?></td>
                            <td>
                                <form method="POST" action="<?php echo e(route('admin.orders.update-status', $order)); ?>" class="inline-form">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="status" value="processing">
                                    <button class="btn btn-ghost btn-sm" type="submit">→ <?php echo e(is_fr() ? 'Préparer' : 'Process'); ?></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $canFulfil && ! $canManage): ?>
        <div class="card" style="padding:2rem">
            <p style="font-size:.9rem;color:var(--muted)"><?php echo e(is_fr() ? 'Votre compte n\'a pas encore de permissions d\'administration.' : 'Your account has no admin permissions yet.'); ?></p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>