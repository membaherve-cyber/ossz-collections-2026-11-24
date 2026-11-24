<?php $__env->startSection('title', 'OSSZ Collections — Contemporary fashion house, Douala'); ?>

<?php $__env->startSection('content'); ?>
    <?php $loc = locale(); ?>

    
    <section class="relative w-full overflow-hidden bg-[#1a1a1a]" style="height:90vh;min-height:600px;">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hero && $hero->image_url): ?>
            <img src="<?php echo e($hero->image_url); ?>" alt="<?php echo e($hero->heading); ?>" fetchpriority="high"
                 class="hero-zoom object-contain object-center opacity-90 absolute inset-0 w-full h-full">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent pointer-events-none"></div>
        <div class="wrap relative flex h-full flex-col items-center justify-end pb-10 text-center text-white md:pb-16">
            <h1 class="display rise delay-1 max-w-3xl text-lg leading-[1.15] md:text-3xl">
                <?php echo e(\App\Support\I18n::pick($hero->heading ?? '', $hero->heading_fr ?? '')); ?>

            </h1>

            <div class="rise delay-3 mt-8 flex flex-wrap items-center justify-center gap-3">
                <a href="<?php echo e($hero->cta_href ?? '/shop'); ?>" class="btn btn-primary bg-white text-ink hover:bg-accent hover:text-white">
                    <?php echo e(\App\Support\I18n::pick($hero->cta_label ?? '', $hero->cta_label_fr ?? '')); ?>

                </a>
                <a href="<?php echo e(route('appointments')); ?>" class="btn bg-ink text-white hover:bg-accent hover:text-white border border-white/20">
                    <?php echo e(t('home.bookCta')); ?>

                </a>
            </div>
        </div>
    </section>

    
    <section class="wrap py-20">
        <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div class="max-w-2xl">
                <p class="eyebrow"><?php echo e(t('home.newEyebrow')); ?></p>
                <h2 class="display mt-2 text-3xl md:text-4xl"><?php echo e(t('home.newTitle')); ?></h2>
                <p class="mt-3 text-sm leading-relaxed text-ink-soft"><?php echo e(t('home.newIntro')); ?></p>
            </div>
            <a href="<?php echo e(route('shop')); ?>" class="link-underline text-[0.75rem] tracking-[0.16em] uppercase text-ink-soft">
                <?php echo e(t('home.shopAll')); ?> →
            </a>
        </div>
        <div class="mt-10 grid grid-cols-2 gap-x-5 gap-y-10 lg:grid-cols-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $newArrivals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('partials.product-card', ['p' => $p], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($banner): ?>
        <section class="relative overflow-hidden bg-[#1a1a1a]">
            <div class="grid md:grid-cols-2">
                <div class="relative aspect-[4/3] md:aspect-auto md:min-h-[520px]">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($banner->image_url): ?>
                        <img src="<?php echo e($banner->image_url); ?>" alt="<?php echo e($banner->heading); ?>"
                             class="object-cover object-top absolute inset-0 w-full h-full">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="flex flex-col justify-center gap-5 px-8 py-16 text-white md:px-16">
                    <p class="eyebrow text-white/70"><?php echo e(\App\Support\I18n::pick($banner->eyebrow, $banner->eyebrow_fr)); ?></p>
                    <h2 class="display text-3xl md:text-4xl"><?php echo e(\App\Support\I18n::pick($banner->heading, $banner->heading_fr)); ?></h2>
                    <p class="max-w-md text-sm leading-relaxed text-white/80"><?php echo e(\App\Support\I18n::pick($banner->body, $banner->body_fr)); ?></p>
                    <a href="<?php echo e($banner->cta_href); ?>"
                       class="btn btn-secondary w-fit border-white text-white hover:bg-white hover:text-ink">
                        <?php echo e(\App\Support\I18n::pick($banner->cta_label, $banner->cta_label_fr)); ?>

                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <section class="wrap py-20">
        <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div class="max-w-2xl">
                <p class="eyebrow"><?php echo e(t('home.editEyebrow')); ?></p>
                <h2 class="display mt-2 text-3xl md:text-4xl"><?php echo e(t('home.editTitle')); ?></h2>
            </div>
            <a href="<?php echo e(route('shop', ['sort' => 'popular'])); ?>" class="link-underline text-[0.75rem] tracking-[0.16em] uppercase text-ink-soft">
                <?php echo e(t('home.editLink')); ?> →
            </a>
        </div>
        <div class="mt-10 grid grid-cols-2 gap-x-5 gap-y-10 lg:grid-cols-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('partials.product-card', ['p' => $p], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    
    <section class="bg-paper py-20">
        <div class="wrap">
            <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <p class="eyebrow"><?php echo e(t('home.colsEyebrow')); ?></p>
                    <h2 class="display mt-2 text-3xl md:text-4xl"><?php echo e(t('home.colsTitle')); ?></h2>
                </div>
                <a href="<?php echo e(route('collections.index')); ?>" class="link-underline text-[0.75rem] tracking-[0.16em] uppercase text-ink-soft">
                    <?php echo e(t('home.colsLink')); ?> →
                </a>
            </div>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('collections.show', $c->slug)); ?>" class="group zoom-parent block">
                        <div class="photo-frame relative aspect-[4/5]">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($c->cover_image): ?>
                                <img src="<?php echo e($c->cover_image); ?>" alt="<?php echo e($c->name); ?>" loading="lazy"
                                     class="object-cover object-top absolute inset-0 w-full h-full">
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute inset-x-0 bottom-0 p-6 text-white">
                                <p class="eyebrow text-white/70"><?php echo e(\App\Support\I18n::pick($c->season, $c->season_fr)); ?></p>
                                <h3 class="display mt-1 text-2xl"><?php echo e(\App\Support\I18n::pick($c->name, $c->name_fr)); ?></h3>
                            </div>
                        </div>
                        <p class="mt-3 text-sm leading-relaxed text-ink-soft"><?php echo e(\App\Support\I18n::pick($c->description, $c->description_fr)); ?></p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    
    <section class="wrap py-20">
        <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
            <div class="max-w-2xl">
                <p class="eyebrow"><?php echo e(t('home.lookEyebrow')); ?></p>
                <h2 class="display mt-2 text-3xl md:text-4xl"><?php echo e(t('home.lookTitle')); ?></h2>
            </div>
            <a href="<?php echo e(route('lookbook')); ?>" class="link-underline text-[0.75rem] tracking-[0.16em] uppercase text-ink-soft">
                <?php echo e(t('home.lookLink')); ?> →
            </a>
        </div>
        <div class="mt-10 grid grid-cols-2 gap-4 md:grid-cols-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $looks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $look): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <figure class="<?php echo e($index === 0 ? 'col-span-2 md:col-span-1' : ''); ?>">
                    <div class="photo-frame relative aspect-[3/4] zoom-parent">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($look->media_type === 'video' && $look->video_url): ?>
                            <video src="<?php echo e($look->video_url); ?>" poster="<?php echo e($look->poster_url); ?>" muted playsinline preload="metadata"
                                   class="object-cover object-top absolute inset-0 w-full h-full"></video>
                        <?php elseif($look->image_url): ?>
                            <img src="<?php echo e($look->image_url); ?>" alt="<?php echo e($look->title); ?>" loading="lazy"
                                 class="object-cover object-top absolute inset-0 w-full h-full">
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <figcaption class="mt-2 text-xs text-muted"><?php echo e(\App\Support\I18n::pick($look->caption, $look->caption_fr)); ?></figcaption>
                </figure>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    
    <section class="bg-accent-soft/40 py-20">
        <div class="wrap grid items-center gap-12 md:grid-cols-2">
            <div>
                <p class="eyebrow"><?php echo e(t('home.storyEyebrow')); ?></p>
                <h2 class="display mt-3 text-3xl md:text-4xl"><?php echo e(t('home.storyTitle')); ?></h2>
                <p class="mt-5 text-sm leading-relaxed text-ink-soft"><?php echo e(t('home.storyBody')); ?></p>
                <div class="mt-7 flex flex-wrap gap-3">
                    <a href="<?php echo e(route('about')); ?>" class="btn btn-secondary"><?php echo e(t('home.storyCta')); ?></a>
                    <a href="<?php echo e(route('journal.index')); ?>" class="btn btn-ghost"><?php echo e(t('home.journalCta')); ?></a>
                </div>
            </div>
            <div class="grid gap-5">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('journal.show', $post->slug)); ?>" class="card flex gap-4 p-4 hover:border-ink">
                        <div class="photo-frame photo-frame-sm relative h-24 w-24 shrink-0">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->cover_image): ?>
                                <img src="<?php echo e($post->cover_image); ?>" alt="<?php echo e($post->title); ?>" loading="lazy"
                                     class="object-cover object-top absolute inset-0 w-full h-full">
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div>
                            <h3 class="display text-xl leading-tight"><?php echo e(\App\Support\I18n::pick($post->title, $post->title_fr)); ?></h3>
                            <p class="mt-1 text-xs leading-relaxed text-ink-soft"><?php echo e(\App\Support\I18n::pick($post->excerpt, $post->excerpt_fr)); ?></p>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($invite): ?>
                    <div class="card bg-paper p-5">
                        <p class="eyebrow"><?php echo e(\App\Support\I18n::pick($invite->eyebrow, $invite->eyebrow_fr)); ?></p>
                        <h3 class="display mt-1 text-xl"><?php echo e(\App\Support\I18n::pick($invite->heading, $invite->heading_fr)); ?></h3>
                        <p class="mt-2 text-xs text-ink-soft"><?php echo e(\App\Support\I18n::pick($invite->body, $invite->body_fr)); ?></p>
                        <a href="<?php echo e($invite->cta_href); ?>" class="btn btn-primary btn-sm mt-4">
                            <?php echo e(\App\Support\I18n::pick($invite->cta_label, $invite->cta_label_fr)); ?>

                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    
    <section class="bg-[#1a1a1a] py-10">
        <div class="wrap flex flex-col items-center justify-center gap-3 text-center">
            <p class="text-sm text-white/90">
                <?php echo e(is_fr() ? 'Besoin d\'aide pour trouver la bonne pièce ? Nous sommes là pour vous.' : 'Need help finding the right piece, or want to write us a message? We are here for you.'); ?>

            </p>
            <a href="<?php echo e(route('contact')); ?>" class="btn bg-white text-ink hover:bg-accent hover:text-white">
                <?php echo e(is_fr() ? 'Nous contacter' : 'Get in touch'); ?>

            </a>
            <p class="text-xs text-white/50">
                <?php echo e(is_fr() ? 'Ou écrivez-nous à' : 'Or write to us directly at'); ?>

                <a href="mailto:<?php echo e(\App\Support\Settings::get('contact_email')); ?>" class="text-accent hover:text-white hover:underline">
                    <?php echo e(\App\Support\Settings::get('contact_email')); ?>

                </a>
            </p>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/home.blade.php ENDPATH**/ ?>