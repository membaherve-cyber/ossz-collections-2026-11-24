<?php $__env->startSection('title', \App\Support\I18n::pick($product->name, $product->name_fr)); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $p = $product;
        $firstName = \App\Support\I18n::pick($p->name, $p->name_fr);
        $firstImage = $images->first();
    ?>

    <div class="wrap pdp">
        <div class="pdp-gallery">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="photo-frame" style="aspect-ratio:4/5">
                    <img src="<?php echo e($img->url); ?>" alt="<?php echo e($img->alt_text ?: $firstName); ?>" loading="<?php echo e($loop->first ? 'eager' : 'lazy'); ?>">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="photo-frame" style="aspect-ratio:4/5"></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="pdp-info">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($p->collection): ?>
                <a class="eyebrow link-underline" href="<?php echo e(route('collections.show', $p->collection->slug)); ?>">
                    <?php echo e(\App\Support\I18n::pick($p->collection->name, $p->collection->name_fr)); ?>

                </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <h1 class="display"><?php echo e($firstName); ?></h1>
            <p class="price"><?php echo e(format_xaf($p->base_price)); ?></p>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(trim((string) \App\Support\I18n::pick($p->description, $p->description_fr)) !== ''): ?>
                <p style="margin-top:1rem;font-size:.9rem;color:var(--ink-soft);white-space:pre-line">
                    <?php echo e(\App\Support\I18n::pick($p->description, $p->description_fr)); ?>

                </p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form method="POST" action="<?php echo e(route('cart.add')); ?>" style="margin-top:1.5rem">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="variant_id" id="variant-input" value="<?php echo e($variants->firstWhere('stock_qty', '>', 0)->id ?? $variants->first()?->id); ?>">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($variants->count() > 0): ?>
                    <p class="label"><?php echo e(t('buy.size')); ?></p>
                    <div class="variant-picker" id="variant-picker">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" class="chip <?php echo e($loop->first ? 'chip-active' : ''); ?>"
                                    data-variant="<?php echo e($v->id); ?>"
                                    data-stock="<?php echo e((int) $v->stock_qty); ?>"
                                    <?php if($v->stock_qty < 1): echo 'disabled'; endif; ?>>
                                <?php echo e($v->size); ?> · <?php echo e($v->colour); ?>

                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div style="display:flex;gap:.6rem;flex-wrap:wrap">
                    <button class="btn btn-primary" type="submit" <?php echo e($variants->every(fn ($v) => $v->stock_qty < 1) ? 'disabled' : ''); ?>>
                        <?php echo e(t('buy.addToCart')); ?>

                    </button>
                    <button class="btn btn-secondary" type="submit" name="buy_now" value="1" <?php echo e($variants->every(fn ($v) => $v->stock_qty < 1) ? 'disabled' : ''); ?>>
                        <?php echo e(t('buy.now')); ?>

                    </button>
                </div>
            </form>

            <form method="POST" action="<?php echo e(route('account.wishlist.toggle')); ?>" style="margin-top:.6rem">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product_id" value="<?php echo e($p->id); ?>">
                <button class="btn btn-ghost" type="submit" style="font-size:.85rem">
                    <?php echo e(t('buy.ln')); ?>

                </button>
            </form>

            <div class="pdp-block">
                <h3><?php echo e(t('buy.delivery')); ?></h3>
                <p style="font-size:.85rem;color:var(--ink-soft)"><?php echo e(t('buy.returns')); ?></p>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(trim((string) $p->details) !== ''): ?>
                <div class="pdp-block">
                    <h3><?php echo e(t('pdp.details')); ?></h3>
                    <p style="font-size:.85rem;color:var(--ink-soft);white-space:pre-line"><?php echo e(\App\Support\I18n::pick($p->details, $p->details_fr)); ?></p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(trim((string) $p->care_instructions) !== ''): ?>
                <div class="pdp-block">
                    <h3><?php echo e(t('pdp.care')); ?></h3>
                    <p style="font-size:.85rem;color:var(--ink-soft);white-space:pre-line"><?php echo e(\App\Support\I18n::pick($p->care_instructions, $p->care_instructions_fr)); ?></p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="pdp-block">
                <h3><?php echo e(t('pdp.deliveryReturns')); ?></h3>
                <p style="font-size:.85rem;color:var(--ink-soft)"><?php echo e(t('pdp.deliveryReturnsBody')); ?></p>
                <p style="margin-top:.8rem">
                    <a class="link-underline" style="font-size:.85rem" target="_blank" rel="noreferrer"
                       href="<?php echo e(wa_link(\App\Support\Settings::get('whatsapp_number'), ($p->name).' — ')); ?>">
                        <?php echo e(t('pdp.askWa')); ?>

                    </a>
                </p>
            </div>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($related) > 0): ?>
        <section class="wrap" style="padding-bottom:4rem">
            <h2 class="display" style="font-size:1.3rem;margin-bottom:1.5rem"><?php echo e(t('pdp.alsoLike')); ?></h2>
            <div class="grid grid-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = array_slice($related, 0, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('partials.product-card', ['p' => $rp], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php $__env->startPush('styles'); ?>
        <style>
            .chip[disabled] { opacity: .4; text-decoration: line-through; cursor: not-allowed; }
            .variant-picker .chip { cursor: pointer; }
        </style>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('scripts'); ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var picker = document.getElementById('variant-picker');
            var input  = document.getElementById('variant-input');
            if (!picker || !input) return;
            var chips = picker.querySelectorAll('button[data-variant]');
            chips.forEach(function(chip) {
                chip.addEventListener('click', function(e) {
                    e.preventDefault();
                    chips.forEach(function(c) { c.classList.remove('chip-active'); });
                    chip.classList.add('chip-active');
                    input.value = chip.getAttribute('data-variant');
                });
            });
        });
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/product.blade.php ENDPATH**/ ?>