<?php $__env->startSection('title', is_fr() ? 'Bibliothèque de médias' : 'Media library'); ?>

<?php $__env->startSection('content'); ?>
    <div class="grid" style="grid-template-columns:1.3fr 1fr;align-items:start;gap:1.5rem">
        <div class="card" style="padding:1.5rem">
            <table class="table">
                <thead><tr><th><?php echo e(is_fr() ? 'Aperçu & URL' : 'Preview & URL'); ?></th><th>Tags</th><th><?php echo e(is_fr() ? 'Date' : 'Date'); ?></th></tr></thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:.75rem">
                                    <div style="width:42px;height:42px;border-radius:8px;overflow:hidden;background:var(--canvas);border:1px solid var(--line);flex-shrink:0">
                                        <img src="<?php echo e($item->url); ?>" alt="" style="width:100%;height:100%;object-fit:cover">
                                    </div>
                                    <div style="min-width:0">
                                        <a href="<?php echo e($item->url); ?>" target="_blank" style="font-size:.78rem;word-break:break-all;color:var(--ink)" class="link-underline">
                                            <?php echo e(Str::limit($item->url, 45)); ?>

                                        </a>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(str_contains($item->url, 'imagekit')): ?>
                                            <span style="font-size:.65rem;color:var(--accent);display:block;font-weight:600">● ImageKit CDN</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:.75rem"><?php echo e($item->tags ?: '—'); ?></td>
                            <td style="font-size:.75rem;color:var(--muted)"><?php echo e(format_date($item->created_at)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="3" style="color:var(--muted)"><?php echo e(is_fr() ? 'Aucun média.' : 'No media.'); ?></td></tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <form method="POST" action="<?php echo e(route('admin.media.upload')); ?>" class="card" style="padding:1.5rem" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <h3 style="font-size:.95rem;font-weight:500">+ <?php echo e(is_fr() ? 'Téléverser vers ImageKit' : 'Upload to ImageKit'); ?></h3>
            <div class="form-grid" style="margin-top:1rem">
                <input class="field" type="file" name="file" accept="image/*,video/*" required>
                <input class="field" name="tags" placeholder="<?php echo e(is_fr() ? 'Tags (séparés par virgule, ex: catalogue, été)' : 'Tags (comma separated, e.g. lookbook, hero)'); ?>">
                <input class="field" name="alt" placeholder="<?php echo e(is_fr() ? 'Texte alternatif / description' : 'Alt text / description'); ?>">
                <button class="btn btn-primary btn-sm" type="submit"><?php echo e(is_fr() ? 'Téléverser' : 'Upload file'); ?></button>
            </div>
            <p style="font-size:.72rem;color:var(--muted);margin-top:1rem;line-height:1.5">
                <?php echo e(is_fr() ? 'Les images sont automatiquement téléversées sur ImageKit CDN avec optimisation automatique et fallback local sécurisé.'
                   : 'Assets are uploaded securely to ImageKit CDN with automatic WebP conversion, global CDN caching, and local storage fallback.'); ?>

            </p>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/media.blade.php ENDPATH**/ ?>