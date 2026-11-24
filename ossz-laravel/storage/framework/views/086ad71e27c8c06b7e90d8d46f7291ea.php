<?php $__env->startSection('title', \App\Support\I18n::pick($collection->name, $collection->name_fr)); ?>

<?php $__env->startSection('content'); ?>
    <section class="wrap" style="padding:3rem 0 1rem">
        <p class="eyebrow"><?php echo e(\App\Support\I18n::pick($collection->season, $collection->season_fr)); ?></p>
        <h1 class="display" style="font-size:1.9rem"><?php echo e(\App\Support\I18n::pick($collection->name, $collection->name_fr)); ?></h1>
        <p style="margin-top:.8rem;font-size:.9rem;color:var(--ink-soft);max-width:40rem">
            <?php echo e(\App\Support\I18n::pick($collection->description, $collection->description_fr)); ?>

        </p>
    </section>

    <section class="wrap grid grid-4" style="padding-bottom:4rem">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php echo $__env->make('partials.product-card', ['p' => $p], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="grid-column:1/-1;font-size:.9rem;color:var(--muted)">
                <?php echo e(is_fr() ? 'Les pièces de cette collection arrivent bientôt.' : 'Pieces from this collection are arriving soon.'); ?>

            </p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/collection-detail.blade.php ENDPATH**/ ?>