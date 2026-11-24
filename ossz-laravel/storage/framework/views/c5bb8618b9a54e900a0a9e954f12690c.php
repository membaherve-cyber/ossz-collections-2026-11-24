<?php
    $uid = $uid ?? 'ik_' . substr(md5($name . rand()), 0, 8);
    $value = $value ?? '';
    $folder = $folder ?? 'products';
    $label = $label ?? 'Image';
    $required = $required ?? false;
    $helpText = $helpText ?? '';
?>

<div class="image-upload-control" id="ctrl-<?php echo e($uid); ?>" style="margin-bottom:1rem">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.4rem">
        <label class="label" style="margin-bottom:0;font-size:.82rem;font-weight:500">
            <?php echo e($label); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($required): ?><span style="color:var(--accent)">*</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </label>
        <span class="storage-badge" id="badge-<?php echo e($uid); ?>" style="display:<?php echo e($value ? 'inline-block' : 'none'); ?>;font-size:.68rem;letter-spacing:.08em;text-transform:uppercase;padding:.2rem .6rem;border-radius:999px;background:rgba(155,95,47,0.12);color:var(--accent);font-weight:600">
            <?php echo e(str_contains($value, 'imagekit') ? 'ImageKit' : 'Saved Image'); ?>

        </span>
    </div>

    
    <input type="hidden" name="<?php echo e($name); ?>" id="input-<?php echo e($uid); ?>" value="<?php echo e($value); ?>" <?php echo e($required && empty($value) ? 'required' : ''); ?>>

    
    <input type="file" id="file-<?php echo e($uid); ?>" accept="image/jpeg,image/png,image/webp,image/avif,image/gif" style="display:none" onchange="window.handleIkUpload('<?php echo e($uid); ?>', '<?php echo e($folder); ?>')">

    
    <div class="card" style="padding:1rem;border:1px solid var(--line);background:var(--paper);border-radius:14px;box-shadow:0 1px 3px rgba(0,0,0,0.04)">
        <div style="display:flex;gap:1.2rem;align-items:center;flex-wrap:wrap">
            
            <div id="preview-box-<?php echo e($uid); ?>" style="width:96px;height:96px;border-radius:10px;overflow:hidden;background:var(--canvas);border:1px solid var(--line);flex-shrink:0;display:flex;align-items:center;justify-content:center;position:relative">
                <img id="preview-img-<?php echo e($uid); ?>" src="<?php echo e($value ?: 'data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'40\' height=\'40\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'%23a8a29e\' stroke-width=\'1.5\'><rect width=\'18\' height=\'18\' x=\'3\' y=\'3\' rx=\'2\'/><circle cx=\'9\' cy=\'9\' r=\'2\'/><path d=\'m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21\'/></svg>'); ?>" alt="" style="width:100%;height:100%;object-fit:cover;<?php echo e(empty($value) ? 'opacity:0.35;padding:1.2rem;' : ''); ?>">
                <div id="loading-overlay-<?php echo e($uid); ?>" style="display:none;position:absolute;inset:0;background:rgba(255,255,255,0.85);align-items:center;justify-content:center;flex-direction:column;font-size:.65rem;color:var(--accent);font-weight:600">
                    <svg style="animation:spin 1s linear infinite;width:24px;height:24px;margin-bottom:4px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10" stroke-opacity="0.25"/><path d="M12 2a10 10 0 0 1 10 10"/></svg>
                    <span>Uploading…</span>
                </div>
            </div>

            
            <div style="flex:1;min-width:220px">
                <div style="display:flex;gap:.5rem;align-items:center;flex-wrap:wrap">
                    <button type="button" class="btn btn-secondary btn-sm" onclick="document.getElementById('file-<?php echo e($uid); ?>').click()" style="display:inline-flex;align-items:center;gap:.4rem">
                        <svg style="width:14px;height:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        <span id="btn-text-<?php echo e($uid); ?>"><?php echo e($value ? (is_fr() ? 'Changer l\'image' : 'Replace Image') : (is_fr() ? 'Téléverser une image' : 'Upload Image')); ?></span>
                    </button>

                    <button type="button" class="btn btn-ghost btn-sm" id="btn-remove-<?php echo e($uid); ?>" onclick="window.handleIkRemove('<?php echo e($uid); ?>')" style="display:<?php echo e($value ? 'inline-block' : 'none'); ?>;color:#b91c1c">
                        <?php echo e(is_fr() ? 'Supprimer' : 'Remove'); ?>

                    </button>

                    <button type="button" class="btn btn-ghost btn-sm" onclick="window.toggleIkUrlField('<?php echo e($uid); ?>')" style="font-size:.72rem;color:var(--muted)">
                        <?php echo e(is_fr() ? 'Saisir un lien direct' : 'Or paste URL'); ?>

                    </button>
                </div>

                
                <div id="status-<?php echo e($uid); ?>" style="display:none;margin-top:.5rem;font-size:.76rem"></div>

                
                <div id="url-box-<?php echo e($uid); ?>" style="display:none;margin-top:.6rem">
                    <input class="field" style="font-size:.75rem;padding:.4rem .6rem" placeholder="https://ik.imagekit.io/… or /catalogue/…" value="<?php echo e($value); ?>" oninput="window.handleIkManualUrl('<?php echo e($uid); ?>', this.value)">
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($helpText): ?>
                    <p style="font-size:.72rem;color:var(--muted);margin-top:.4rem"><?php echo e($helpText); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if (! $__env->hasRenderedOnce('f161a021-86a3-4b3e-a367-20aca9b8dfe9')): $__env->markAsRenderedOnce('f161a021-86a3-4b3e-a367-20aca9b8dfe9'); ?>
<?php $__env->startPush('scripts'); ?>
<script>
window.handleIkUpload = async function(uid, folder) {
    const fileInput = document.getElementById('file-' + uid);
    const hiddenInput = document.getElementById('input-' + uid);
    const previewImg = document.getElementById('preview-img-' + uid);
    const overlay = document.getElementById('loading-overlay-' + uid);
    const statusBox = document.getElementById('status-' + uid);
    const badge = document.getElementById('badge-' + uid);
    const btnRemove = document.getElementById('btn-remove-' + uid);
    const btnText = document.getElementById('btn-text-' + uid);

    if (!fileInput.files || !fileInput.files[0]) return;
    const file = fileInput.files[0];

    // Show loading
    overlay.style.display = 'flex';
    statusBox.style.display = 'none';

    const formData = new FormData();
    formData.append('file', file);
    formData.append('folder', folder);

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            || document.querySelector('input[name="_token"]')?.value || '';

        const res = await fetch('/admin/api/upload-image', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        });

        const data = await res.json();
        if (!res.ok || !data.ok) {
            throw new Error(data.error || 'Upload to ImageKit failed.');
        }

        // Set resulting ImageKit URL into form input
        hiddenInput.value = data.url;
        previewImg.src = data.url;
        previewImg.style.opacity = '1';
        previewImg.style.padding = '0';

        badge.innerText = data.storage === 'imagekit' ? 'ImageKit' : 'Local Storage';
        badge.style.display = 'inline-block';
        btnRemove.style.display = 'inline-block';
        btnText.innerText = 'Replace Image';

        statusBox.style.display = 'block';
        statusBox.style.color = '#15803d';
        statusBox.innerHTML = '✓ Uploaded successfully to ImageKit.';
    } catch (err) {
        statusBox.style.display = 'block';
        statusBox.style.color = '#b91c1c';
        statusBox.innerText = '✕ ' + (err.message || 'Upload error');
    } finally {
        overlay.style.display = 'none';
        fileInput.value = '';
    }
};

window.handleIkRemove = function(uid) {
    const hiddenInput = document.getElementById('input-' + uid);
    const previewImg = document.getElementById('preview-img-' + uid);
    const badge = document.getElementById('badge-' + uid);
    const btnRemove = document.getElementById('btn-remove-' + uid);
    const btnText = document.getElementById('btn-text-' + uid);
    const statusBox = document.getElementById('status-' + uid);

    hiddenInput.value = '';
    previewImg.src = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="%23a8a29e" stroke-width="1.5"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>';
    previewImg.style.opacity = '0.35';
    previewImg.style.padding = '1.2rem';

    badge.style.display = 'none';
    btnRemove.style.display = 'none';
    btnText.innerText = 'Upload Image';
    statusBox.style.display = 'none';
};

window.toggleIkUrlField = function(uid) {
    const box = document.getElementById('url-box-' + uid);
    box.style.display = box.style.display === 'none' ? 'block' : 'none';
};

window.handleIkManualUrl = function(uid, url) {
    const hiddenInput = document.getElementById('input-' + uid);
    const previewImg = document.getElementById('preview-img-' + uid);
    const badge = document.getElementById('badge-' + uid);
    const btnRemove = document.getElementById('btn-remove-' + uid);
    const btnText = document.getElementById('btn-text-' + uid);

    hiddenInput.value = url;
    if (url.trim()) {
        previewImg.src = url;
        previewImg.style.opacity = '1';
        previewImg.style.padding = '0';
        badge.innerText = 'Custom URL';
        badge.style.display = 'inline-block';
        btnRemove.style.display = 'inline-block';
        btnText.innerText = 'Replace Image';
    } else {
        window.handleIkRemove(uid);
    }
};
</script>
<style>
@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/partials/image-upload.blade.php ENDPATH**/ ?>