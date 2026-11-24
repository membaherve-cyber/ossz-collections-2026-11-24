<?php $__env->startSection('title', t('look.title')); ?>

<?php $__env->startSection('content'); ?>
    <section class="wrap" style="padding:3rem 0 1rem;text-align:center">
        <p class="eyebrow"><?php echo e(t('look.eyebrow')); ?></p>
        <h1 class="display" style="font-size:1.8rem"><?php echo e(t('look.title')); ?></h1>
        <p style="margin-top:.8rem;font-size:.9rem;color:var(--ink-soft)"><?php echo e(t('look.intro')); ?></p>
    </section>

    <section class="wrap grid grid-3" style="padding-bottom:4rem">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $looks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $look): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <figure>
                <div class="photo-frame" style="aspect-ratio:3/4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($look->media_type === 'video' && $look->video_url): ?>
                        <video src="<?php echo e($look->video_url); ?>" poster="<?php echo e($look->poster_url); ?>" muted playsinline preload="metadata" controls></video>
                    <?php elseif($look->image_url): ?>
                        <img src="<?php echo e($look->image_url); ?>" alt="<?php echo e($look->title); ?>" loading="lazy">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <figcaption style="margin-top:.5rem;font-size:.72rem;color:var(--muted)">
                    <?php echo e(\App\Support\I18n::pick($look->caption, $look->caption_fr)); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($look->product_slug): ?>
                        · <a class="link-underline" href="<?php echo e(route('product.show', $look->product_slug)); ?>"><?php echo e(t('look.shop')); ?></a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </figcaption>
            </figure>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/lookbook.blade.php ENDPATH**/ ?>