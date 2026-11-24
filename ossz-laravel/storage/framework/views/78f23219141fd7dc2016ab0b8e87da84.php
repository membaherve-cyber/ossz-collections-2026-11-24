<?php $__env->startSection('title', 'AI gaps'); ?>

<?php $__env->startSection('content'); ?>
    <div style="display:grid;gap:1rem">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $gaps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card" style="padding:1.3rem <?php echo e($gap->status === 'resolved' ? 'opacity:.65' : ''); ?>">
                <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:.5rem">
                    <div>
                        <strong style="font-size:.88rem"><?php echo e($gap->question); ?></strong>
                        <p style="font-size:.72rem;color:var(--muted);margin-top:.2rem">
                            <?php echo e(strtoupper($gap->locale)); ?> · intent: <?php echo e($gap->detected_intent ?: '—'); ?> · <?php echo e(format_date_time($gap->created_at)); ?>

                        </p>
                    </div>
                    <span class="pill <?php echo e($gap->status === 'resolved' ? 'pill-green' : 'pill-yellow'); ?>"><?php echo e($gap->status); ?></span>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($gap->search_performed || $gap->search_result): ?>
                    <p style="font-size:.75rem;color:var(--muted);margin-top:.6rem">
                        search: <?php echo e(\Illuminate\Support\Str::limit($gap->search_performed.' → '.$gap->search_result, 140)); ?>

                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($gap->status !== 'resolved'): ?>
                    <form method="POST" action="<?php echo e(route('admin.ai-gaps.resolve')); ?>" style="display:grid;gap:.6rem;margin-top:1rem;max-width:560px">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($gap->id); ?>">
                        <textarea class="field" name="resolved_answer" rows="2" placeholder="<?php echo e(is_fr() ? 'Réponse approuvée…' : 'Approved answer…'); ?>" required></textarea>
                        <button class="btn btn-secondary btn-sm" type="submit"><?php echo e(is_fr() ? 'Résoudre' : 'Resolve'); ?></button>
                    </form>
                <?php else: ?>
                    <p style="font-size:.8rem;margin-top:.6rem;color:var(--ink-soft)"><?php echo e($gap->resolved_answer); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="card" style="padding:2rem">
                <p style="color:var(--muted);font-size:.85rem">
                    <?php echo e(is_fr() ? 'Aucune question en attente — le concierge a répondu à tout.' : 'Nothing waiting — the concierge answered everything.'); ?>

                </p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/ai-gaps.blade.php ENDPATH**/ ?>