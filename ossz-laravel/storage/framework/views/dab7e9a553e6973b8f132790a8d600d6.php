<?php $__env->startSection('account'); ?>
    <div>
        <h2 class="display" style="font-size:1.2rem;margin-bottom:1.2rem"><?php echo e(t('buy.wishlist')); ?></h2>
        <?php
            $cards = $rows->map(fn ($row) => [
                'id' => $row->product->id,
                'name' => $row->product->name,
                'name_fr' => $row->product->name_fr,
                'slug' => $row->product->slug,
                'basePrice' => (int) $row->product->base_price,
                'image' => $row->product->images->first()->url ?? '',
                'imageAlt' => $row->product->name,
                'inStock' => $row->product->variants->contains(fn ($v) => (int) $v->stock_qty > 0),
            ])->all();
        ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($cards) === 0): ?>
            <div class="card" style="padding:2.5rem;text-align:center">
                <p style="font-size:.85rem;color:var(--muted)">
                    <?php echo e(is_fr() ? 'Votre liste de favoris est vide — touchez « Favoris » sur une pièce pour la conserver ici.' : 'Your wishlist is empty — tap “Wishlist” on a piece to keep it here.'); ?>

                </p>
            </div>
        <?php else: ?>
            <div class="grid grid-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('partials.product-card', ['p' => $p], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.account', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/account/wishlist.blade.php ENDPATH**/ ?>