<?php $__env->startSection('title', t('nav.collections')); ?>

<?php $__env->startSection('content'); ?>
    <div class="grid" style="grid-template-columns:1.3fr 1fr;align-items:start;gap:1.5rem">
        <div class="card" style="padding:1.5rem">
            <table class="table">
                <thead><tr><th><?php echo e(is_fr() ? 'Collection' : 'Collection'); ?></th><th><?php echo e(is_fr() ? 'Saison' : 'Season'); ?></th><th><?php echo e(is_fr() ? 'Pièces' : 'Pieces'); ?></th><th></th></tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:.75rem">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($collection->cover_image): ?>
                                        <div style="width:40px;height:40px;border-radius:8px;overflow:hidden;background:var(--canvas);border:1px solid var(--line);flex-shrink:0">
                                            <img src="<?php echo e($collection->cover_image); ?>" alt="" style="width:100%;height:100%;object-fit:cover">
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div>
                                        <strong style="font-size:.85rem"><?php echo e($collection->name); ?></strong><br>
                                        <span style="font-size:.72rem;color:var(--muted)"><?php echo e($collection->name_fr); ?></span>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo e($collection->season); ?></td>
                            <td><?php echo e($collection->products()->count()); ?></td>
                            <td>
                                <form method="POST" action="<?php echo e(route('admin.collections.destroy', $collection)); ?>" onsubmit="return confirm('Delete this collection?')">
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-ghost btn-sm" type="submit" style="color:#b91c1c">✕</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" style="color:var(--muted)"><?php echo e(is_fr() ? 'Aucune collection.' : 'No collections.'); ?></td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="card" style="padding:1.5rem">
            <h3 style="font-size:.95rem;font-weight:500;margin-bottom:1rem">+ <?php echo e(is_fr() ? 'Nouvelle collection' : 'New collection'); ?></h3>
            <form method="POST" action="<?php echo e(route('admin.collections.store')); ?>" class="form-grid" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input class="field" name="name" placeholder="<?php echo e(is_fr() ? 'Nom (EN)' : 'Name (EN)'); ?>" required>
                <input class="field" name="name_fr" placeholder="<?php echo e(is_fr() ? 'Nom (FR)' : 'Name (FR)'); ?>">
                <input class="field" name="season" placeholder="<?php echo e(is_fr() ? 'Saison (ex. 2026)' : 'Season (e.g. 2026)'); ?>">
                
                
                <?php echo $__env->make('admin.partials.image-upload', [
                    'name'     => 'cover_image',
                    'folder'   => 'collections',
                    'label'    => is_fr() ? 'Photo de couverture (ImageKit)' : 'Cover photo (ImageKit)',
                    'helpText' => 'Upload cover image directly to ImageKit or enter an image URL.'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <textarea class="field" name="description" rows="2" placeholder="<?php echo e(is_fr() ? 'Description' : 'Description'); ?>"></textarea>
                <button class="btn btn-primary btn-sm" type="submit"><?php echo e(is_fr() ? 'Créer la collection' : 'Create collection'); ?></button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/collections.blade.php ENDPATH**/ ?>