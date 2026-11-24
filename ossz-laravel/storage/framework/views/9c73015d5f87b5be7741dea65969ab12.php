<?php $__env->startSection('title', is_fr() ? 'Catalogue' : 'Products'); ?>

<?php $__env->startSection('content'); ?>
    <div style="display:flex;justify-content:space-between;gap:1rem;margin-bottom:1.2rem;flex-wrap:wrap">
        <form method="GET" style="display:flex;gap:.6rem">
            <input class="field" style="max-width:280px" type="search" name="q" value="<?php echo e($q); ?>" placeholder="<?php echo e(is_fr() ? 'Rechercher…' : 'Search…'); ?>">
            <button class="btn btn-secondary btn-sm" type="submit"><?php echo e(is_fr() ? 'Filtrer' : 'Filter'); ?></button>
        </form>
        <a class="btn btn-primary btn-sm" href="<?php echo e(route('admin.products.create')); ?>">+ <?php echo e(is_fr() ? 'Nouvelle pièce' : 'New product'); ?></a>
    </div>

    <div class="card" style="padding:1.2rem">
        <table class="table">
            <thead>
                <tr>
                    <th><?php echo e(is_fr() ? 'Pièce' : 'Piece'); ?></th>
                    <th><?php echo e(is_fr() ? 'Catégorie' : 'Category'); ?></th>
                    <th><?php echo e(t('buy.size')); ?> / <?php echo e(t('buy.colour')); ?></th>
                    <th><?php echo e(is_fr() ? 'Prix' : 'Price'); ?></th>
                    <th><?php echo e(is_fr() ? 'Stock' : 'Stock'); ?></th>
                    <th><?php echo e(is_fr() ? 'Statut' : 'Status'); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <strong style="font-size:.85rem"><?php echo e($product->name); ?></strong><br>
                            <span style="font-size:.72rem;color:var(--muted)"><?php echo e($product->slug); ?></span>
                        </td>
                        <td style="font-size:.8rem"><?php echo e($product->category?->name ?? '—'); ?><br><span style="color:var(--muted);font-size:.72rem"><?php echo e($product->collection?->name ?? ''); ?></span></td>
                        <td style="font-size:.75rem"><?php echo e($product->variants->map(fn ($v) => $v->size.'/'.$v->colour.' ('.$v->stock_qty.')')->implode(', ')); ?></td>
                        <td><?php echo e(format_xaf($product->base_price)); ?></td>
                        <td><?php echo e($product->variants->sum('stock_qty')); ?></td>
                        <td>
                            <span class="pill <?php echo e($product->is_published ? 'pill-green' : 'pill-gray'); ?>"><?php echo e($product->is_published ? (is_fr() ? 'Publié' : 'Live') : (is_fr() ? 'Brouillon' : 'Draft')); ?></span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->is_featured): ?><span class="pill pill-yellow"><?php echo e(is_fr() ? 'Vedette' : 'Featured'); ?></span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                        <td>
                            <a class="btn btn-ghost btn-sm" href="<?php echo e(route('admin.products.edit', $product)); ?>"><?php echo e(is_fr() ? 'Modifier' : 'Edit'); ?></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" style="color:var(--muted)"><?php echo e(is_fr() ? 'Aucune pièce.' : 'No products.'); ?></td></tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/products.blade.php ENDPATH**/ ?>