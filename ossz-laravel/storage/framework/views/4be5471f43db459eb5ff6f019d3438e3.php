<?php $__env->startSection('title', t('faq.title')); ?>

<?php $__env->startSection('content'); ?>
    <section class="wrap" style="padding:3rem 0 1rem;max-width:800px">
        <p class="eyebrow"><?php echo e(t('faq.eyebrow')); ?></p>
        <h1 class="display" style="font-size:1.8rem"><?php echo e(t('faq.title')); ?></h1>
        <p style="margin-top:.8rem;font-size:.9rem;color:var(--ink-soft)"><?php echo e(t('faq.intro')); ?></p>
    </section>

    <section class="wrap" style="max-width:800px;padding-bottom:4rem;display:grid;gap:.75rem">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <details class="card" style="padding:1.1rem 1.3rem">
                <summary style="cursor:pointer;font-size:.92rem;font-weight:500">
                    <?php echo e(\App\Support\I18n::pick($faq->question, $faq->question_fr)); ?>

                </summary>
                <p style="margin-top:.7rem;font-size:.85rem;color:var(--ink-soft);white-space:pre-line">
                    <?php echo e(\App\Support\I18n::pick($faq->answer, $faq->answer_fr)); ?>

                </p>
                <p class="eyebrow" style="margin-top:.7rem"><?php echo e(\App\Support\I18n::pick($faq->category, $faq->category_fr)); ?></p>
            </details>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="font-size:.9rem;color:var(--muted)"><?php echo e(is_fr() ? 'FAQ bientôt disponible.' : 'FAQ coming soon.'); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="card" style="padding:1.5rem;margin-top:1.5rem">
            <p class="eyebrow"><?php echo e(t('faq.stillEyebrow')); ?></p>
            <div style="display:flex;gap:.75rem;margin-top:1rem;flex-wrap:wrap">
                <a class="btn btn-secondary btn-sm" href="<?php echo e(route('contact')); ?>"><?php echo e(t('faq.contactCta')); ?></a>
                <a class="btn btn-ghost btn-sm" href="<?php echo e(route('order.lookup.form')); ?>"><?php echo e(t('faq.trackCta')); ?></a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/faq.blade.php ENDPATH**/ ?>