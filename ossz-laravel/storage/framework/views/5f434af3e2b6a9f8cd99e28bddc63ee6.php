<?php $__env->startSection('title', t('nav.journal')); ?>

<?php $__env->startSection('content'); ?>
    <div style="display:grid;gap:1.5rem">
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <form method="POST" action="<?php echo e(route('admin.journal.save')); ?>" class="card" style="padding:1.5rem" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($post->id); ?>">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem">
                    <div style="display:flex;gap:.5rem;align-items:center">
                        <span class="pill <?php echo e($post->status === 'published' ? 'pill-green' : 'pill-gray'); ?>">
                            <?php echo e(strtoupper($post->status)); ?>

                        </span>
                        <strong style="font-size:.9rem"><?php echo e($post->title); ?></strong>
                    </div>
                    <button type="submit" form="del-post-<?php echo e($post->id); ?>" class="btn btn-ghost btn-sm" style="color:#b91c1c" onclick="return confirm('Delete this journal post?')">✕ <?php echo e(is_fr() ? 'Supprimer' : 'Delete'); ?></button>
                </div>

                <div class="form-grid cols-2">
                    <input class="field" name="title" value="<?php echo e($post->title); ?>" placeholder="Title (EN)" required>
                    <input class="field" name="title_fr" value="<?php echo e($post->title_fr); ?>" placeholder="Title (FR)">
                    <input class="field" name="slug" value="<?php echo e($post->slug); ?>" placeholder="slug">
                    <input class="field" name="author_name" value="<?php echo e($post->author_name); ?>" placeholder="Author name">
                    <select class="field" name="status">
                        <option value="draft" <?php if($post->status === 'draft'): echo 'selected'; endif; ?>><?php echo e(is_fr() ? 'Brouillon' : 'Draft'); ?></option>
                        <option value="published" <?php if($post->status === 'published'): echo 'selected'; endif; ?>><?php echo e(is_fr() ? 'Publié' : 'Published'); ?></option>
                    </select>
                </div>

                <div style="margin-top:1rem">
                    <?php echo $__env->make('admin.partials.image-upload', [
                        'name'     => 'cover_image',
                        'value'    => $post->cover_image,
                        'folder'   => 'journal',
                        'label'    => is_fr() ? 'Image de couverture éditoriale (ImageKit)' : 'Editorial cover image (ImageKit)',
                        'helpText' => 'Upload image from computer directly to ImageKit or enter an image link.'
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                <div class="form-grid cols-2" style="margin-top:.8rem">
                    <textarea class="field" name="excerpt" rows="2" placeholder="Excerpt EN"><?php echo e($post->excerpt); ?></textarea>
                    <textarea class="field" name="excerpt_fr" rows="2" placeholder="Excerpt FR"><?php echo e($post->excerpt_fr); ?></textarea>
                    <textarea class="field" name="body" rows="6" placeholder="Body EN"><?php echo e($post->body); ?></textarea>
                    <textarea class="field" name="body_fr" rows="6" placeholder="Body FR"><?php echo e($post->body_fr); ?></textarea>
                </div>

                <div style="margin-top:1rem">
                    <button class="btn btn-primary btn-sm" type="submit"><?php echo e(is_fr() ? 'Enregistrer les modifications' : 'Save changes'); ?></button>
                </div>
            </form>

            <form id="del-post-<?php echo e($post->id); ?>" method="POST" action="<?php echo e(route('admin.journal.delete')); ?>" style="display:none">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($post->id); ?>">
            </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <form method="POST" action="<?php echo e(route('admin.journal.save')); ?>" class="card" style="padding:1.5rem" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <h3 style="font-size:.95rem;font-weight:500;margin-bottom:1rem">+ <?php echo e(is_fr() ? 'Nouvel article' : 'New journal entry'); ?></h3>
            <div class="form-grid cols-2">
                <input class="field" name="title" placeholder="Title EN" required>
                <input class="field" name="title_fr" placeholder="Title FR">
                <select class="field" name="status">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>

            <div style="margin-top:1rem">
                <?php echo $__env->make('admin.partials.image-upload', [
                    'name'     => 'cover_image',
                    'folder'   => 'journal',
                    'label'    => is_fr() ? 'Image de couverture éditoriale (ImageKit)' : 'Editorial cover image (ImageKit)',
                    'helpText' => 'Select an image from computer to automatically upload to ImageKit.'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            <textarea class="field" name="excerpt" rows="2" placeholder="Excerpt summary" style="margin-top:.8rem"></textarea>
            <textarea class="field" name="body" rows="6" placeholder="Full story text..." style="margin-top:.8rem"></textarea>
            <div style="margin-top:1rem">
                <button class="btn btn-primary btn-sm" type="submit"><?php echo e(is_fr() ? 'Créer l\'article' : 'Create entry'); ?></button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/journal.blade.php ENDPATH**/ ?>