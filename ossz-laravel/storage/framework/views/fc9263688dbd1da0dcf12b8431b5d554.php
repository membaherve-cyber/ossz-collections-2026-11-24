<?php $__env->startSection('title', t('appt.title')); ?>

<?php $__env->startSection('content'); ?>
    <div class="wrap cart-layout">
        <div>
            <p class="eyebrow"><?php echo e(t('appt.eyebrow')); ?></p>
            <h1 class="display" style="font-size:1.8rem"><?php echo e(t('appt.title')); ?></h1>
            <p style="margin-top:.8rem;font-size:.9rem;color:var(--ink-soft);max-width:36rem"><?php echo e(t('appt.intro')); ?></p>

            <form method="POST" action="<?php echo e(route('appointments.book')); ?>" class="form-grid" style="margin-top:1.8rem;max-width:520px">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="label" for="name"><?php echo e(is_fr() ? 'Nom' : 'Name'); ?> *</label>
                    <input class="field" id="name" name="name" required value="<?php echo e(old('name', \App\Models\User::find(session('user_id'))?->full_name)); ?>">
                </div>
                <div>
                    <label class="label" for="contact">Email / WhatsApp *</label>
                    <input class="field" id="contact" name="contact" required value="<?php echo e(old('contact')); ?>">
                </div>
                <div>
                    <label class="label" for="service"><?php echo e(is_fr() ? 'Prestation' : 'Service'); ?></label>
                    <select class="field" id="service" name="service">
                        <option><?php echo e(is_fr() ? 'Séance de style' : 'Styling session'); ?></option>
                        <option><?php echo e(is_fr() ? 'Essayage' : 'Fitting'); ?></option>
                        <option><?php echo e(is_fr() ? 'Sur-mesure' : 'Made-to-measure'); ?></option>
                    </select>
                </div>
                <div class="form-grid cols-2">
                    <div>
                        <label class="label" for="date"><?php echo e(is_fr() ? 'Date' : 'Date'); ?> *</label>
                        <input class="field" id="date" type="date" name="date" required min="<?php echo e(now()->toDateString()); ?>" value="<?php echo e(old('date')); ?>">
                    </div>
                    <div>
                        <label class="label" for="time"><?php echo e(is_fr() ? 'Heure' : 'Time'); ?> *</label>
                        <input class="field" id="time" type="time" name="time" required value="<?php echo e(old('time', '10:00')); ?>">
                    </div>
                </div>
                <div>
                    <label class="label" for="notes"><?php echo e(is_fr() ? 'Notes' : 'Notes'); ?></label>
                    <textarea class="field" id="notes" name="notes" rows="2"><?php echo e(old('notes')); ?></textarea>
                </div>
                <button class="btn btn-primary" type="submit"><?php echo e(t('home.bookCta')); ?></button>
            </form>
        </div>

        <aside style="height:fit-content">
            <div class="card" style="padding:1.5rem;display:grid;gap:.8rem">
                <p style="font-size:.85rem;color:var(--ink-soft)"><?php echo e(t('appt.p1')); ?></p>
                <p style="font-size:.85rem;color:var(--ink-soft)"><?php echo e(t('appt.p2')); ?></p>
                <p style="font-size:.85rem;color:var(--ink-soft)"><?php echo e(t('appt.p3')); ?></p>
            </div>
        </aside>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/pages/appointments.blade.php ENDPATH**/ ?>