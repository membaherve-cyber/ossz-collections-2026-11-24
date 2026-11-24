<?php $__env->startSection('title', \App\Support\I18n::pick($post->title, $post->title_fr)); ?>

<?php $__env->startSection('content'); ?>
    <article class="wrap" style="padding:3rem 0;max-width:760px">
        <a class="btn btn-ghost btn-sm" href="<?php echo e(route('journal.index')); ?>"><?php echo e(t('jour.all')); ?></a>

        <h1 class="display" style="font-size:2rem;margin-top:1rem"><?php echo e(\App\Support\I18n::pick($post->title, $post->title_fr)); ?></h1>
        <p class="card-meta" style="margin-top:.5rem"><?php echo e(format_date($post->published_at)); ?> · <?php echo e($post->author_name); ?></p>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->cover_image): ?>
            <div class="photo-frame" style="aspect-ratio:16/9;margin:2rem 0">
                <img src="<?php echo e($post->cover_image); ?>" alt="<?php echo e(\App\Support\I18n::pick($post->title, $post->title_fr)); ?>">
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div style="font-size:.95rem;line-height:1.85;color:var(--ink-soft);white-space:pre-line">
            <?php echo e(\App\Support\I18n::pick($post->body, $post->body_fr)); ?>

        </div>
    </article>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/journal-post.blade.php ENDPATH**/ ?>