<?php $__env->startSection('title', is_fr() ? 'Boîte de Réception & Messages' : 'Contact Inbox & Inquiries'); ?>

<?php $__env->startSection('content'); ?>
<div style="display:grid;gap:1.25rem">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card" style="padding:1.5rem;<?php echo e($message->handled ? 'opacity:.75;' : ''); ?>">
            <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:.75rem;align-items:flex-start">
                <div>
                    <div style="display:flex;align-items:center;gap:.65rem">
                        <strong style="font-size:1rem;color:var(--ink)"><?php echo e($message->name); ?></strong>
                        <span class="status-badge <?php echo e($message->handled ? 'success' : 'warning'); ?>">
                            <?php echo e($message->handled ? (is_fr() ? 'Traité' : 'Handled') : (is_fr() ? 'En attente' : 'Awaiting Reply')); ?>

                        </span>
                    </div>
                    <div style="font-size:.78rem;color:var(--muted);margin-top:.25rem">
                        <span><?php echo e($message->contact); ?></span> · <span><?php echo e(format_date_time($message->created_at)); ?></span>
                    </div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $message->handled): ?>
                    <form method="POST" action="<?php echo e(route('admin.contact.handled')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($message->id); ?>">
                        <button class="btn btn-secondary btn-sm" type="submit">
                            ✓ <?php echo e(is_fr() ? 'Marquer comme traité' : 'Mark as Handled'); ?>

                        </button>
                    </form>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Client's message body -->
            <div style="margin-top:1rem;background:var(--canvas);padding:1rem;border-radius:12px;border:1px solid var(--line);font-size:.875rem;color:var(--ink-soft);white-space:pre-line;line-height:1.6">
                <?php echo e($message->message); ?>

            </div>

            <!-- Reply Form -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $message->handled): ?>
                <div style="margin-top:1.25rem;padding-top:1.25rem;border-top:1px solid var(--line)">
                    <p class="eyebrow" style="margin-bottom:.5rem"><?php echo e(is_fr() ? 'Envoyer une réponse par email / WhatsApp' : 'Direct Dispatch Reply'); ?></p>
                    <form method="POST" action="<?php echo e(route('admin.contact.reply')); ?>" style="display:grid;gap:.75rem;max-width:640px">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="messageId" value="<?php echo e($message->id); ?>">
                        <input class="field" name="subject" placeholder="<?php echo e(is_fr() ? 'Objet de l\'email (optionnel)' : 'Email subject line (optional)'); ?>" value="Re: <?php echo e(\Illuminate\Support\Str::limit($message->message, 40)); ?>">
                        <textarea class="field" name="reply" rows="3" placeholder="<?php echo e(is_fr() ? 'Rédigez votre réponse ici…' : 'Type your personalized message reply here…'); ?>" required></textarea>
                        <div style="display:flex;align-items:center;gap:.75rem">
                            <button class="btn btn-primary btn-sm" type="submit">
                                <?php echo e(is_fr() ? 'Envoyer la réponse' : 'Send Reply via SMTP / WhatsApp'); ?>

                            </button>
                            <span style="font-size:.72rem;color:var(--muted)">
                                <?php echo e(is_fr() ? 'Envoyé automatiquement par email ou file WhatsApp.' : 'Dispatched via Namecheap SMTP or queued to WhatsApp.'); ?>

                            </span>
                        </div>
                    </form>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="card" style="padding:3rem;text-align:center">
            <p style="color:var(--muted);font-size:.9rem"><?php echo e(is_fr() ? 'Aucun message dans la boîte de réception.' : 'No customer messages in the inbox.'); ?></p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/contact.blade.php ENDPATH**/ ?>