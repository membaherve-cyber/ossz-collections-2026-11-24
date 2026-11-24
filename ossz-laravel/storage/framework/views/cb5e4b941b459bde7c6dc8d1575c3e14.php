<?php $__env->startSection('title', t('cols.title')); ?>

<?php $__env->startSection('content'); ?>
    <section class="wrap" style="padding:3rem 0 1rem;text-align:center">
        <p class="eyebrow"><?php echo e(t('cols.eyebrow')); ?></p>
        <h1 class="display" style="font-size:1.8rem"><?php echo e(t('cols.title')); ?></h1>
        <p style="margin-top:.8rem;font-size:.9rem;color:var(--ink-soft)"><?php echo e(t('cols.intro')); ?></p>
    </section>

    <section class="wrap grid grid-3" style="padding-bottom:4rem">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('collections.show', $c->slug)); ?>" class="product-card">
                <div class="photo-frame" style="aspect-ratio:4/5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($c->cover_image): ?><img src="<?php echo e($c->cover_image); ?>" alt="<?php echo e($c->name); ?>" loading="lazy"><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div style="position:absolute;inset:auto 0 0 0;padding:1.5rem;color:#fff;background:linear-gradient(to top,rgba(0,0,0,.6),transparent)">
                        <p class="eyebrow" style="color:rgba(255,255,255,.75)"><?php echo e(\App\Support\I18n::pick($c->season, $c->season_fr)); ?></p>
                        <h2 class="display" style="font-size:1.4rem"><?php echo e(\App\Support\I18n::pick($c->name, $c->name_fr)); ?></h2>
                    </div>
                </div>
                <p style="margin-top:.75rem;font-size:.85rem;color:var(--ink-soft)"><?php echo e(\App\Support\I18n::pick($c->description, $c->description_fr)); ?></p>
                <p style="margin-top:.4rem;font-size:.78rem;letter-spacing:.1em;text-transform:uppercase"><?php echo e(t('cols.view')); ?> →</p>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/collections.blade.php ENDPATH**/ ?>