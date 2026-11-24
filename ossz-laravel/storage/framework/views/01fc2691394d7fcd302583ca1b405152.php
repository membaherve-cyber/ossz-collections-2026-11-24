<?php $__env->startSection('title', is_fr() ? 'La maison' : 'The house'); ?>

<?php $__env->startSection('content'); ?>
    <section class="wrap" style="padding:3rem 0 1rem;max-width:760px">
        <p class="eyebrow"><?php echo e(t('home.storyEyebrow')); ?></p>
        <h1 class="display" style="font-size:2rem"><?php echo e(t('home.storyTitle')); ?></h1>
        <p style="margin-top:1.2rem;font-size:.95rem;line-height:1.85;color:var(--ink-soft)"><?php echo e(t('home.storyBody')); ?></p>
    </section>

    <section class="wrap" style="max-width:760px;padding-bottom:4rem;display:grid;gap:1.5rem">
        <div class="card" style="padding:1.8rem">
            <h2 class="display" style="font-size:1.2rem"><?php echo e(is_fr() ? 'L\'atelier' : 'The atelier'); ?></h2>
            <p style="margin-top:.7rem;font-size:.88rem;color:var(--ink-soft)">
                <?php echo e(is_fr()
                    ? 'Chaque pièce est coupée, cousue et finie dans notre atelier d\'Ange Raphael, à Douala, par des artisans que nous connaissons par leur prénom.'
                    : 'Every piece is cut, sewn and finished in our Ange Raphael atelier in Douala, by artisans we know by name.'); ?>

            </p>
        </div>
        <div class="card" style="padding:1.8rem">
            <h2 class="display" style="font-size:1.2rem"><?php echo e(is_fr() ? 'Nos services' : 'Our services'); ?></h2>
            <div style="margin-top:.8rem;display:grid;gap:.6rem;font-size:.88rem;color:var(--ink-soft)">
                <p><strong><?php echo e(t('home.svc1')); ?></strong> — <?php echo e(t('home.svc1b')); ?></p>
                <p><strong><?php echo e(t('home.svc2')); ?></strong> — <?php echo e(t('home.svc2b')); ?></p>
                <p><strong><?php echo e(t('home.svc3')); ?></strong> — <?php echo e(t('home.svc3b')); ?></p>
                <p><strong><?php echo e(t('home.svc4')); ?></strong> — <?php echo e(t('home.svc4b')); ?></p>
            </div>
        </div>
        <div style="display:flex;gap:.75rem">
            <a class="btn btn-primary" href="<?php echo e(route('contact')); ?>"><?php echo e(t('faq.contactCta')); ?></a>
            <a class="btn btn-secondary" href="<?php echo e(route('appointments')); ?>"><?php echo e(t('home.bookCta')); ?></a>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/about.blade.php ENDPATH**/ ?>