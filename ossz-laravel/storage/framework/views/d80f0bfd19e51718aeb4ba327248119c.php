<?php $__env->startSection('title', t('search.title')); ?>

<?php $__env->startSection('content'); ?>
    <section class="wrap" style="padding:3rem 0 1rem;max-width:720px">
        <h1 class="display" style="font-size:1.8rem"><?php echo e(t('search.title')); ?></h1>

        <form method="GET" action="<?php echo e(route('search')); ?>" style="display:flex;gap:.6rem;margin-top:1.5rem">
            <input class="field" type="search" name="q" value="<?php echo e($q); ?>" placeholder="<?php echo e(t('search.placeholder')); ?>" autofocus>
            <button class="btn btn-primary" type="submit"><?php echo e(t('search.cta')); ?></button>
        </form>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($q === ''): ?>
            <div style="margin-top:2rem">
                <p class="eyebrow"><?php echo e(t('search.popular')); ?></p>
                <div class="grid grid-4" style="margin-top:1rem">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('partials.product-card', ['p' => $p], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </section>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($q !== ''): ?>
        <section class="wrap" style="padding-bottom:4rem">
            <p style="font-size:.85rem;color:var(--ink-soft);margin-bottom:1.5rem">
                <?php echo e(t('search.results', ['n' => count($products), 'q' => $q])); ?>

            </p>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($products) === 0): ?>
                <div class="card" style="padding:2.5rem;text-align:center">
                    <h2 class="display" style="font-size:1.2rem"><?php echo e(t('shop.noneTitle')); ?></h2>
                    <p style="margin-top:.5rem;font-size:.85rem;color:var(--ink-soft)"><?php echo e(t('shop.noneBody')); ?></p>
                    <a class="btn btn-secondary btn-sm" style="margin-top:1.2rem" href="<?php echo e(route('shop')); ?>"><?php echo e(t('search.browse')); ?></a>
                </div>
            <?php else: ?>
                <div class="grid grid-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('partials.product-card', ['p' => $p], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/search.blade.php ENDPATH**/ ?>