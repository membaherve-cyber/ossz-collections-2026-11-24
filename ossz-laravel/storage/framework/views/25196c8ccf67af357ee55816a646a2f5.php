<?php $__env->startSection('title', t('nav.lookbook')); ?>

<?php $__env->startSection('content'); ?>
    <div style="display:grid;gap:1.5rem">
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $looks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $look): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <form method="POST" action="<?php echo e(route('admin.lookbook.save')); ?>" class="card" style="padding:1.5rem" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($look->id); ?>">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem">
                    <div style="display:flex;gap:.5rem;align-items:center">
                        <span class="pill <?php echo e($look->media_type === 'video' ? 'pill-blue' : 'pill-gray'); ?>">
                            <?php echo e(strtoupper($look->media_type)); ?>

                        </span>
                        <strong style="font-size:.9rem"><?php echo e($look->title ?: 'Untitled Look'); ?></strong>
                    </div>
                    <button type="submit" form="del-look-<?php echo e($look->id); ?>" class="btn btn-ghost btn-sm" style="color:#b91c1c" onclick="return confirm('Delete this look?')">✕ <?php echo e(is_fr() ? 'Supprimer' : 'Delete'); ?></button>
                </div>

                <div class="form-grid cols-2">
                    <input class="field" name="title" value="<?php echo e($look->title); ?>" placeholder="Title">
                    <select class="field" name="media_type">
                        <option value="image" <?php if($look->media_type === 'image'): echo 'selected'; endif; ?>>Image</option>
                        <option value="video" <?php if($look->media_type === 'video'): echo 'selected'; endif; ?>>Video</option>
                    </select>
                </div>

                <div style="margin-top:1rem">
                    <?php echo $__env->make('admin.partials.image-upload', [
                        'name'     => 'image_url',
                        'value'    => $look->image_url,
                        'folder'   => 'lookbook',
                        'label'    => is_fr() ? 'Image du look (ImageKit)' : 'Look imagery (ImageKit)',
                        'helpText' => 'Upload look image directly to ImageKit or paste an external URL.'
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                <div class="form-grid cols-2" style="margin-top:1rem">
                    <input class="field" name="video_url" value="<?php echo e($look->video_url); ?>" placeholder="Video URL (mp4 / vimeo / youtube)">
                    <input class="field" name="poster_url" value="<?php echo e($look->poster_url); ?>" placeholder="Video Poster URL (optional)">
                    <input class="field" name="product_slug" value="<?php echo e($look->product_slug); ?>" placeholder="Product slug (e.g. midnight-agbada)">
                    <input class="field" type="number" name="sort_order" value="<?php echo e($look->sort_order); ?>" placeholder="Sort order">
                </div>

                <div class="form-grid cols-2" style="margin-top:.8rem">
                    <input class="field" name="caption" value="<?php echo e($look->caption); ?>" placeholder="Caption (EN)">
                    <input class="field" name="caption_fr" value="<?php echo e($look->caption_fr); ?>" placeholder="Caption (FR)">
                </div>

                <div style="margin-top:1rem">
                    <button class="btn btn-primary btn-sm" type="submit"><?php echo e(is_fr() ? 'Enregistrer les modifications' : 'Save changes'); ?></button>
                </div>
            </form>

            <form id="del-look-<?php echo e($look->id); ?>" method="POST" action="<?php echo e(route('admin.lookbook.delete')); ?>" style="display:none">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($look->id); ?>">
            </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="grid" style="grid-template-columns:1.2fr 1fr;gap:1.5rem">
            <form method="POST" action="<?php echo e(route('admin.lookbook.save')); ?>" class="card" style="padding:1.5rem" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <h3 style="font-size:.95rem;font-weight:500;margin-bottom:1rem">+ <?php echo e(is_fr() ? 'Nouveau look' : 'New look'); ?></h3>
                <div class="form-grid">
                    <input class="field" name="title" placeholder="Title">

                    <?php echo $__env->make('admin.partials.image-upload', [
                        'name'     => 'image_url',
                        'folder'   => 'lookbook',
                        'label'    => is_fr() ? 'Photo du look (ImageKit)' : 'Look photo (ImageKit)',
                        'helpText' => 'Upload image from computer directly to ImageKit.'
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <input class="field" name="caption" placeholder="Caption">
                    <input class="field" name="product_slug" placeholder="Tagged product-slug (e.g. midnight-agbada)">
                    <button class="btn btn-primary btn-sm" type="submit"><?php echo e(is_fr() ? 'Créer le look' : 'Create look'); ?></button>
                </div>
            </form>

            <form method="POST" action="<?php echo e(route('admin.lookbook.upload')); ?>" class="card" style="padding:1.5rem" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <h3 style="font-size:.95rem;font-weight:500;margin-bottom:.5rem"><?php echo e(is_fr() ? 'Téléverser une vidéo' : 'Upload lookbook video'); ?></h3>
                <p style="font-size:.78rem;color:var(--muted);margin-bottom:1rem">MP4, WebM or MOV up to 100 MB. Execution guard 120s.</p>
                <div class="form-grid">
                    <input class="field" type="file" name="video" accept="video/mp4,video/webm,video/quicktime" required>
                    <button class="btn btn-secondary btn-sm" type="submit"><?php echo e(is_fr() ? 'Téléverser la vidéo' : 'Upload video'); ?></button>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('uploaded_path')): ?>
                    <div class="card status-badge success" style="margin-top:1rem;padding:.6rem .8rem;font-size:.75rem">
                        ✓ Stored at: <code><?php echo e(session('uploaded_path')); ?></code>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/lookbook.blade.php ENDPATH**/ ?>