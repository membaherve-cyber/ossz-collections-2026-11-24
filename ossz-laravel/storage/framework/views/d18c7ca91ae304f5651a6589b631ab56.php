

<?php $__env->startSection('title', $product->exists ? (is_fr() ? 'Modifier' : 'Edit').': '.$product->name : (is_fr() ? 'Nouvelle pièce' : 'New product')); ?>

<?php $__env->startSection('content'); ?>
    <form method="POST" action="<?php echo e($product->exists ? route('admin.products.update', $product) : route('admin.products.store')); ?>"
          enctype="multipart/form-data"
          style="display:grid;gap:1.2rem;max-width:820px">
        <?php echo csrf_field(); ?>

        <div class="card" style="padding:1.5rem">
            <div class="form-grid cols-2">
                <div>
                    <label class="label"><?php echo e(is_fr() ? 'Nom (EN)' : 'Name (EN)'); ?> *</label>
                    <input class="field" name="name" required value="<?php echo e(old('name', $product->name)); ?>">
                </div>
                <div>
                    <label class="label"><?php echo e(is_fr() ? 'Nom (FR)' : 'Name (FR)'); ?></label>
                    <input class="field" name="name_fr" value="<?php echo e(old('name_fr', $product->name_fr)); ?>">
                </div>
            </div>
            <div style="margin-top:1rem">
                <label class="label"><?php echo e(is_fr() ? 'Description (EN)' : 'Description (EN)'); ?></label>
                <textarea class="field" name="description" rows="3"><?php echo e(old('description', $product->description)); ?></textarea>
            </div>
            <div style="margin-top:1rem">
                <label class="label"><?php echo e(is_fr() ? 'Description (FR)' : 'Description (FR)'); ?></label>
                <textarea class="field" name="description_fr" rows="3"><?php echo e(old('description_fr', $product->description_fr)); ?></textarea>
            </div>
            <div class="form-grid cols-2" style="margin-top:1rem">
                <div>
                    <label class="label"><?php echo e(is_fr() ? 'Détails / matière (EN)' : 'Details / fabric (EN)'); ?></label>
                    <textarea class="field" name="details" rows="2"><?php echo e(old('details', $product->details)); ?></textarea>
                </div>
                <div>
                    <label class="label">Détails (FR)</label>
                    <textarea class="field" name="details_fr" rows="2"><?php echo e(old('details_fr', $product->details_fr)); ?></textarea>
                </div>
            </div>
            <div class="form-grid cols-2" style="margin-top:1rem">
                <div>
                    <label class="label"><?php echo e(is_fr() ? 'Entretien (EN)' : 'Care (EN)'); ?></label>
                    <textarea class="field" name="care_instructions" rows="2"><?php echo e(old('care_instructions', $product->care_instructions)); ?></textarea>
                </div>
                <div>
                    <label class="label">Entretien (FR)</label>
                    <textarea class="field" name="care_instructions_fr" rows="2"><?php echo e(old('care_instructions_fr', $product->care_instructions_fr)); ?></textarea>
                </div>
            </div>
        </div>

        <div class="card" style="padding:1.5rem">
            <div class="form-grid cols-2">
                <div>
                    <label class="label"><?php echo e(is_fr() ? 'Catégorie' : 'Category'); ?></label>
                    <select class="field" name="category_id">
                        <option value="">—</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php if(old('category_id', $product->category_id) == $cat->id): echo 'selected'; endif; ?>><?php echo e($cat->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>
                <div>
                    <label class="label"><?php echo e(is_fr() ? 'Collection' : 'Collection'); ?></label>
                    <select class="field" name="collection_id">
                        <option value="">—</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($col->id); ?>" <?php if(old('collection_id', $product->collection_id) == $col->id): echo 'selected'; endif; ?>><?php echo e($col->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>
                <div>
                    <label class="label"><?php echo e(is_fr() ? 'Prix de base (FCFA)' : 'Base price (FCFA)'); ?> *</label>
                    <input class="field" type="number" name="base_price" min="0" required value="<?php echo e(old('base_price', $product->base_price)); ?>">
                </div>
                <div>
                    <label class="label">SEO</label>
                    <input class="field" name="seo_title" value="<?php echo e(old('seo_title', $product->seo_title)); ?>">
                </div>
            </div>
            <div style="display:flex;gap:1.5rem;margin-top:1rem;font-size:.85rem">
                <label style="display:flex;gap:.5rem;align-items:center">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" value="1" <?php if(old('is_published', $product->is_published ?? true)): echo 'checked'; endif; ?>>
                    <?php echo e(is_fr() ? 'Publié' : 'Published'); ?>

                </label>
                <label style="display:flex;gap:.5rem;align-items:center">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" <?php if(old('is_featured', $product->is_featured)): echo 'checked'; endif; ?>>
                    <?php echo e(is_fr() ? 'Vedette' : 'Featured'); ?>

                </label>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $product->exists): ?>
                <div style="margin-top:1.2rem;border-top:1px solid var(--line);padding-top:1rem">
                    <?php echo $__env->make('admin.partials.image-upload', [
                        'name'     => 'initial_photo',
                        'folder'   => 'products',
                        'label'    => is_fr() ? 'Photo de couverture (ImageKit)' : 'Primary Product Photo (ImageKit)',
                        'helpText' => 'Select product cover photo from computer. It will upload directly to ImageKit.'
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div style="display:flex;gap:.8rem">
            <button class="btn btn-primary" type="submit"><?php echo e($product->exists ? (is_fr() ? 'Enregistrer' : 'Save') : (is_fr() ? 'Créer' : 'Create')); ?></button>
            <a class="btn btn-ghost" href="<?php echo e(route('admin.products.index')); ?>">← <?php echo e(is_fr() ? 'Catalogue' : 'Back'); ?></a>
        </div>
    </form>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->exists): ?>
        <div class="grid" style="grid-template-columns:1fr 1fr;margin-top:2rem;align-items:start">
            <div class="card" style="padding:1.5rem">
                <h3 style="font-size:.95rem;font-weight:400"><?php echo e(is_fr() ? 'Variantes' : 'Variants'); ?></h3>
                <table class="table" style="margin-top:.8rem">
                    <thead><tr><th><?php echo e(t('buy.size')); ?></th><th><?php echo e(t('buy.colour')); ?></th><th><?php echo e(is_fr() ? 'Stock' : 'Stock'); ?></th><th>Prix</th><th></th></tr></thead>
                    <tbody>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $product->variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($v->size); ?></td><td><?php echo e($v->colour); ?></td><td><?php echo e($v->stock_qty); ?></td>
                                <td><?php echo e($v->price_override ? format_xaf($v->price_override) : '—'); ?></td>
                                <td>
                                    <form method="POST" action="<?php echo e(route('admin.products.variants.delete', $v)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button class="btn btn-ghost btn-sm" type="submit">✕</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="5" style="color:var(--muted);font-size:.8rem"><?php echo e(is_fr() ? 'Aucune variante.' : 'No variants.'); ?></td></tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tbody>
                </table>

                <form method="POST" action="<?php echo e(route('admin.products.variants.add', $product)); ?>" class="form-grid cols-2" style="margin-top:1rem">
                    <?php echo csrf_field(); ?>
                    <input class="field" name="size" placeholder="M" required>
                    <input class="field" name="colour" placeholder="Ivory" required>
                    <input class="field" type="number" name="stock_qty" min="0" placeholder="Stock" required>
                    <input class="field" type="number" name="price_override" min="0" placeholder="<?php echo e(is_fr() ? 'Prix (optionnel)' : 'Price override'); ?>">
                    <button class="btn btn-secondary btn-sm" type="submit">+ <?php echo e(is_fr() ? 'Variante' : 'Variant'); ?></button>
                </form>
            </div>

            <div class="card" style="padding:1.5rem">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.8rem">
                    <h3 style="font-size:.95rem;font-weight:500"><?php echo e(is_fr() ? 'Galerie photos & ImageKit' : 'Product Gallery (ImageKit)'); ?></h3>
                    <span style="font-size:.75rem;color:var(--muted)"><?php echo e($product->images->count()); ?> <?php echo e(is_fr() ? 'photos' : 'photos'); ?></span>
                </div>

                
                <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(100px, 1fr));gap:.75rem;margin-top:.8rem">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div style="position:relative;border-radius:10px;overflow:hidden;border:1px solid var(--line);background:var(--canvas);box-shadow:0 1px 2px rgba(0,0,0,0.04)">
                            <div class="photo-frame" style="aspect-ratio:1">
                                <img src="<?php echo e($img->url); ?>" alt="<?php echo e($img->alt_text); ?>" style="width:100%;height:100%;object-fit:cover">
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($index === 0): ?>
                                <span style="position:absolute;bottom:4px;left:4px;background:var(--accent);color:#fff;font-size:.6rem;padding:.15rem .4rem;border-radius:4px;font-weight:600;letter-spacing:.05em">
                                    COVER
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <form method="POST" action="<?php echo e(route('admin.products.images.delete', $img)); ?>" style="position:absolute;top:4px;right:4px">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-sm" style="background:rgba(0,0,0,0.7);color:#fff;border-radius:6px;padding:.15rem .45rem;font-size:.7rem" type="submit" onclick="return confirm('Remove photo?')">✕</button>
                            </form>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p style="font-size:.8rem;color:var(--muted);grid-column:1/-1"><?php echo e(is_fr() ? 'Aucune image pour cette pièce.' : 'No images uploaded yet.'); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div style="margin-top:1.2rem;border-top:1px solid var(--line);padding-top:1rem">
                    <label class="label" style="font-size:.82rem;font-weight:500">+ <?php echo e(is_fr() ? 'Téléverser une image (ordinateur → ImageKit)' : 'Upload photo from computer to ImageKit'); ?></label>
                    <form method="POST" action="<?php echo e(route('admin.products.images.add', $product)); ?>" enctype="multipart/form-data" class="form-grid" style="margin-top:.5rem">
                        <?php echo csrf_field(); ?>
                        <div style="display:flex;gap:.6rem;align-items:center;flex-wrap:wrap">
                            <input class="field" type="file" name="file" accept="image/*" style="flex:1;min-width:200px">
                            <input class="field" name="alt_text" placeholder="Alt text / description" style="flex:1;min-width:160px">
                            <button class="btn btn-primary btn-sm" type="submit" style="white-space:nowrap">+ <?php echo e(is_fr() ? 'Téléverser' : 'Upload photo'); ?></button>
                        </div>
                        <div style="margin-top:.5rem">
                            <input class="field" name="url" placeholder="<?php echo e(is_fr() ? 'ou coller une URL directe (https://…)' : 'or paste direct image URL (https://…)'); ?>" style="font-size:.78rem;padding:.4rem .6rem">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/product-form.blade.php ENDPATH**/ ?>