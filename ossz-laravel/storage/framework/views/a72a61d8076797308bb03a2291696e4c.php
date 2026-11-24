<?php $__env->startSection('title', is_fr() ? 'Stock' : 'Inventory'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card" style="padding:1.2rem">
        <table class="table">
            <thead>
                <tr>
                    <th><?php echo e(is_fr() ? 'Pièce' : 'Piece'); ?></th>
                    <th><?php echo e(t('buy.size')); ?></th><th><?php echo e(t('buy.colour')); ?></th>
                    <th><?php echo e(is_fr() ? 'Stock' : 'Stock'); ?></th>
                    <th><?php echo e(is_fr() ? 'Seuil' : 'Threshold'); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="<?php echo e($variant->stock_qty <= $variant->low_stock_threshold ? 'low-stock' : ''); ?>">
                        <td>
                            <strong style="font-size:.85rem"><?php echo e($variant->product->name); ?></strong>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($variant->stock_qty <= $variant->low_stock_threshold): ?>
                                <span class="pill pill-red"><?php echo e(is_fr() ? 'bas' : 'low'); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                        <td><?php echo e($variant->size); ?></td>
                        <td><?php echo e($variant->colour); ?></td>
                        <td>
                            <form method="POST" action="<?php echo e(route('admin.inventory.update')); ?>" style="display:flex;gap:.4rem;align-items:center">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="variant_id" value="<?php echo e($variant->id); ?>">
                                <input class="field" style="width:80px;padding:.3rem .5rem" type="number" name="stock_qty" min="0" value="<?php echo e($variant->stock_qty); ?>">
                                <button class="btn btn-secondary btn-sm" type="submit">✓</button>
                            </form>
                        </td>
                        <td><?php echo e($variant->low_stock_threshold); ?></td>
                        <td style="font-size:.75rem;color:var(--muted)">
                            <?php echo e($variant->product->collection?->name ?? ''); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php $__env->startPush('styles'); ?>
        <style>.low-stock td { background: rgba(248, 215, 218, .25); }</style>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/inventory.blade.php ENDPATH**/ ?>