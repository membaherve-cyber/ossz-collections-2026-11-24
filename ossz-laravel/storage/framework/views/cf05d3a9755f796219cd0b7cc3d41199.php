

<?php $__env->startSection('title', t('contact.title')); ?>

<?php $__env->startSection('content'); ?>
    <?php $settings = \App\Support\Settings::all(); ?>

    <div class="wrap cart-layout">
        <div>
            <p class="eyebrow"><?php echo e(t('contact.eyebrow')); ?></p>
            <h1 class="display" style="font-size:1.8rem"><?php echo e(t('contact.title')); ?></h1>
            <p style="margin-top:.8rem;font-size:.9rem;color:var(--ink-soft)"><?php echo e(t('contact.intro')); ?></p>

            <form method="POST" action="<?php echo e(route('contact.submit')); ?>" class="form-grid" style="margin-top:1.8rem;max-width:520px">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="label" for="name"><?php echo e(is_fr() ? 'Nom' : 'Name'); ?> *</label>
                    <input class="field" id="name" name="name" required value="<?php echo e(old('name')); ?>">
                </div>
                <div>
                    <label class="label" for="contact">Email / <?php echo e(t('contact.wa')); ?> *</label>
                    <input class="field" id="contact" name="contact" required value="<?php echo e(old('contact')); ?>">
                </div>
                <div>
                    <label class="label" for="message"><?php echo e(is_fr() ? 'Message' : 'Message'); ?> *</label>
                    <textarea class="field" id="message" name="message" rows="5" required><?php echo e(old('message')); ?></textarea>
                </div>
                <button class="btn btn-primary" type="submit"><?php echo e(t('contact.waCta')); ?></button>
            </form>
        </div>

        <aside style="display:grid;gap:1.2rem;height:fit-content">
            <div class="card" style="padding:1.5rem">
                <p class="eyebrow"><?php echo e(t('contact.boutique')); ?></p>
                <p style="margin-top:.6rem;font-size:.9rem"><?php echo e($settings['store_address']); ?></p>
            </div>
            <div class="card" style="padding:1.5rem">
                <p class="eyebrow"><?php echo e(t('contact.hours')); ?></p>
                <p style="margin-top:.6rem;font-size:.9rem"><?php echo e($settings['business_hours']); ?></p>
            </div>
            <div class="card" style="padding:1.5rem">
                <p class="eyebrow"><?php echo e(t('contact.email')); ?></p>
                <p style="margin-top:.6rem"><a class="link-underline" href="mailto:<?php echo e($settings['contact_email']); ?>"><?php echo e($settings['contact_email']); ?></a></p>
            </div>
            <div class="card" style="padding:1.5rem">
                <p class="eyebrow"><?php echo e(t('contact.wa')); ?></p>
                <p style="margin-top:.6rem">
                    <a class="link-underline" target="_blank" rel="noreferrer" href="<?php echo e(wa_link($settings['whatsapp_number'])); ?>"><?php echo e($settings['whatsapp_number']); ?></a>
                </p>
            </div>
        </aside>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/contact.blade.php ENDPATH**/ ?>