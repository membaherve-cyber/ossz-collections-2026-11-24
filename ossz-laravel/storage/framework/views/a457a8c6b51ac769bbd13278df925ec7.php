<?php $__env->startSection('title', is_fr() ? 'Blocs d\'accueil' : 'Homepage blocks'); ?>

<?php $__env->startSection('content'); ?>
    <div style="display:grid;gap:1.5rem">
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <form method="POST" action="<?php echo e(route('admin.homepage.save')); ?>" class="card" style="padding:1.5rem" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($block->id); ?>">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem">
                    <div style="display:flex;gap:.5rem;align-items:center">
                        <span class="pill pill-blue"><?php echo e(strtoupper($block->type)); ?></span>
                        <strong style="font-size:.9rem"><?php echo e($block->heading ?: 'Untitled block'); ?></strong>
                    </div>
                    <div style="display:flex;gap:1rem;align-items:center">
                        <label style="font-size:.8rem;display:flex;gap:.4rem;align-items:center;cursor:pointer">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published" value="1" <?php if($block->is_published): echo 'checked'; endif; ?>>
                            <?php echo e(is_fr() ? 'Publié' : 'Published'); ?>

                        </label>
                        <button type="submit" form="del-block-<?php echo e($block->id); ?>" class="btn btn-ghost btn-sm" style="color:#b91c1c" onclick="return confirm('Delete this block?')">✕ <?php echo e(is_fr() ? 'Supprimer' : 'Delete'); ?></button>
                    </div>
                </div>

                <div class="form-grid cols-2">
                    <select class="field" name="type">
                        <option value="hero" <?php if($block->type === 'hero'): echo 'selected'; endif; ?>>Hero (Banner principal)</option>
                        <option value="banner" <?php if($block->type === 'banner'): echo 'selected'; endif; ?>>Banner (Plein écran)</option>
                        <option value="quote" <?php if($block->type === 'quote'): echo 'selected'; endif; ?>>Quote (Citation)</option>
                        <option value="editorial" <?php if($block->type === 'editorial'): echo 'selected'; endif; ?>>Editorial (Atelier)</option>
                    </select>
                    <input class="field" name="cta_href" value="<?php echo e($block->cta_href); ?>" placeholder="CTA URL (e.g. /shop)">
                    <input class="field" name="eyebrow" value="<?php echo e($block->eyebrow); ?>" placeholder="Eyebrow EN">
                    <input class="field" name="eyebrow_fr" value="<?php echo e($block->eyebrow_fr); ?>" placeholder="Eyebrow FR">
                    <input class="field" name="heading" value="<?php echo e($block->heading); ?>" placeholder="Heading EN">
                    <input class="field" name="heading_fr" value="<?php echo e($block->heading_fr); ?>" placeholder="Heading FR">
                    <input class="field" name="cta_label" value="<?php echo e($block->cta_label); ?>" placeholder="CTA EN">
                    <input class="field" name="cta_label_fr" value="<?php echo e($block->cta_label_fr); ?>" placeholder="CTA FR">
                </div>

                <div style="margin-top:1rem">
                    <?php echo $__env->make('admin.partials.image-upload', [
                        'name'     => 'image_url',
                        'value'    => $block->image_url,
                        'folder'   => 'homepage-blocks',
                        'label'    => is_fr() ? 'Visuel du bloc (ImageKit)' : 'Block imagery (ImageKit)',
                        'helpText' => 'Upload image from computer directly to ImageKit or enter an image link.'
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                <div class="form-grid cols-2" style="margin-top:.8rem">
                    <textarea class="field" name="body" rows="2" placeholder="Body EN"><?php echo e($block->body); ?></textarea>
                    <textarea class="field" name="body_fr" rows="2" placeholder="Body FR"><?php echo e($block->body_fr); ?></textarea>
                    <input class="field" type="number" name="sort_order" value="<?php echo e($block->sort_order); ?>" placeholder="Sort order">
                </div>

                <div style="margin-top:1rem">
                    <button class="btn btn-primary btn-sm" type="submit"><?php echo e(is_fr() ? 'Enregistrer les modifications' : 'Save changes'); ?></button>
                </div>
            </form>

            <form id="del-block-<?php echo e($block->id); ?>" method="POST" action="<?php echo e(route('admin.homepage.delete')); ?>" style="display:none">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($block->id); ?>">
            </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <form method="POST" action="<?php echo e(route('admin.homepage.save')); ?>" class="card" style="padding:1.5rem" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <h3 style="font-size:.95rem;font-weight:500;margin-bottom:1rem">+ <?php echo e(is_fr() ? 'Nouveau bloc d\'accueil' : 'New homepage block'); ?></h3>
            <div class="form-grid cols-2">
                <select class="field" name="type">
                    <option value="hero">Hero (Banner principal)</option>
                    <option value="banner">Banner (Plein écran)</option>
                    <option value="quote">Quote (Citation)</option>
                    <option value="editorial">Editorial (Atelier)</option>
                </select>
                <input class="field" name="cta_href" placeholder="CTA link (e.g. /shop)">
                <input class="field" name="heading" placeholder="Heading EN" required>
                <input class="field" name="heading_fr" placeholder="Heading FR">
                <input class="field" name="cta_label" placeholder="CTA button label">
            </div>

            <div style="margin-top:1rem">
                <?php echo $__env->make('admin.partials.image-upload', [
                    'name'     => 'image_url',
                    'folder'   => 'homepage-blocks',
                    'label'    => is_fr() ? 'Visuel du bloc (ImageKit)' : 'Block imagery (ImageKit)',
                    'helpText' => 'Select an image from computer to automatically upload to ImageKit.'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            <button class="btn btn-primary btn-sm" style="margin-top:1rem" type="submit"><?php echo e(is_fr() ? 'Créer le bloc' : 'Create block'); ?></button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/homepage.blade.php ENDPATH**/ ?>