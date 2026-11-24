<?php $__env->startSection('title', t('jour.title')); ?>

<?php $__env->startSection('content'); ?>
    <section class="wrap" style="padding:3rem 0 1rem">
        <h1 class="display" style="font-size:1.8rem"><?php echo e(t('jour.title')); ?></h1>
    </section>

    <section class="wrap grid grid-3" style="padding-bottom:4rem">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('journal.show', $post->slug)); ?>" class="product-card">
                <div class="photo-frame" style="aspect-ratio:4/3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->cover_image): ?><img src="<?php echo e($post->cover_image); ?>" alt="<?php echo e($post->title); ?>" loading="lazy"><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="card-body">
                    <h2 class="display" style="font-size:1.15rem"><?php echo e(\App\Support\I18n::pick($post->title, $post->title_fr)); ?></h2>
                    <p class="card-meta"><?php echo e(format_date($post->published_at)); ?> · <?php echo e($post->author_name); ?></p>
                    <p style="margin-top:.4rem;font-size:.82rem;color:var(--ink-soft)"><?php echo e(\App\Support\I18n::pick($post->excerpt, $post->excerpt_fr)); ?></p>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="grid-column:1/-1;font-size:.9rem;color:var(--muted)">
                <?php echo e(is_fr() ? 'Les premiers articles arrivent bientôt.' : 'The first entries are on their way.'); ?>

            </p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/journal.blade.php ENDPATH**/ ?>