<?php $__env->startSection('title', 'FAQ'); ?>

<?php $__env->startSection('content'); ?>
    <div style="display:grid;gap:1rem">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <form method="POST" action="<?php echo e(route('admin.faqs.save')); ?>" class="card" style="padding:1.3rem">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($faq->id); ?>">
                <div class="form-grid cols-2">
                    <input class="field" name="category" value="<?php echo e($faq->category); ?>" placeholder="Category EN">
                    <input class="field" name="category_fr" value="<?php echo e($faq->category_fr); ?>" placeholder="Category FR">
                    <input class="field" name="question" value="<?php echo e($faq->question); ?>" required>
                    <input class="field" name="question_fr" value="<?php echo e($faq->question_fr); ?>">
                    <input class="field" type="number" name="sort_order" value="<?php echo e($faq->sort_order); ?>">
                </div>
                <div class="form-grid cols-2" style="margin-top:.8rem">
                    <textarea class="field" name="answer" rows="3" required><?php echo e($faq->answer); ?></textarea>
                    <textarea class="field" name="answer_fr" rows="3"><?php echo e($faq->answer_fr); ?></textarea>
                </div>
                <button class="btn btn-primary btn-sm" style="margin-top:.8rem" type="submit"><?php echo e(is_fr() ? 'Enregistrer' : 'Save'); ?></button>
            </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form method="POST" action="<?php echo e(route('admin.faqs.save')); ?>" class="card" style="padding:1.3rem">
            <?php echo csrf_field(); ?>
            <h3 style="font-size:.95rem;font-weight:400;margin-bottom:.8rem">+ <?php echo e(is_fr() ? 'Nouvelle FAQ' : 'New FAQ'); ?></h3>
            <div class="form-grid">
                <input class="field" name="question" placeholder="Question" required>
                <textarea class="field" name="answer" rows="2" placeholder="Answer" required></textarea>
                <input class="field" name="category" placeholder="General">
                <button class="btn btn-secondary btn-sm" type="submit"><?php echo e(is_fr() ? 'Créer' : 'Create'); ?></button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/faqs.blade.php ENDPATH**/ ?>