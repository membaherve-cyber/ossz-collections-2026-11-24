<?php $__env->startSection('title', is_fr() ? 'Messages clients & archive' : 'Customer Messages & Archive'); ?>

<?php $__env->startSection('content'); ?>
<div class="card" style="padding:1.5rem">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;flex-wrap:wrap;gap:1rem">
        <div>
            <h2 style="font-size:1.1rem;font-weight:500;color:var(--ink)"><?php echo e(is_fr() ? 'Journal des notifications & messages' : 'Notification & Message Log'); ?></h2>
            <p style="font-size:.78rem;color:var(--muted);margin-top:.2rem"><?php echo e(is_fr() ? 'Historique complet des emails et messages WhatsApp envoyés ou en file d\'attente.' : 'Full historical audit of sent, queued, and failed client messages.'); ?></p>
        </div>
        <span class="status-badge neutral" style="font-weight:600"><?php echo e($notifications->count()); ?> <?php echo e(is_fr() ? 'enregistrements' : 'records'); ?></span>
    </div>

    <div style="overflow-x:auto">
        <table class="table" style="width:100%;font-size:.825rem">
            <thead>
                <tr style="border-bottom:1px solid var(--line);text-align:left">
                    <th style="padding:.75rem 1rem"><?php echo e(is_fr() ? 'Canal' : 'Channel'); ?></th>
                    <th style="padding:.75rem 1rem"><?php echo e(is_fr() ? 'Destinataire' : 'Recipient'); ?></th>
                    <th style="padding:.75rem 1rem"><?php echo e(is_fr() ? 'Objet / Message' : 'Subject / Message'); ?></th>
                    <th style="padding:.75rem 1rem"><?php echo e(is_fr() ? 'Statut' : 'Status'); ?></th>
                    <th style="padding:.75rem 1rem"><?php echo e(is_fr() ? 'Date' : 'Date'); ?></th>
                    <th style="padding:.75rem 1rem;text-align:right"><?php echo e(is_fr() ? 'Actions' : 'Actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr style="border-bottom:1px solid var(--line)">
                        <td style="padding:.75rem 1rem">
                            <span class="status-badge <?php echo e($n->channel === 'whatsapp' ? 'success' : 'neutral'); ?>">
                                <?php echo e(strtoupper($n->channel)); ?>

                            </span>
                        </td>
                        <td style="padding:.75rem 1rem;font-weight:500"><?php echo e($n->recipient); ?></td>
                        <td style="padding:.75rem 1rem;color:var(--ink-soft);max-width:320px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                            <?php echo e($n->subject ?: \Illuminate\Support\Str::limit($n->body, 60)); ?>

                        </td>
                        <td style="padding:.75rem 1rem">
                            <span class="status-badge <?php echo e($n->status === 'sent' ? 'success' : ($n->status === 'failed' ? 'danger' : 'warning')); ?>">
                                <?php echo e($n->status); ?>

                            </span>
                        </td>
                        <td style="padding:.75rem 1rem;font-size:.75rem;color:var(--muted)">
                            <?php echo e(format_date_time($n->created_at)); ?>

                        </td>
                        <td style="padding:.75rem 1rem;text-align:right">
                            <div style="display:inline-flex;align-items:center;gap:.5rem;justify-content:flex-end">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($n->channel === 'whatsapp'): ?>
                                    <a class="btn btn-secondary btn-sm" target="_blank" rel="noreferrer" href="<?php echo e(wa_link($n->recipient, $n->body)); ?>" style="padding:.3rem .6rem;font-size:.7rem">
                                        WhatsApp ↗
                                    </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <form method="POST" action="<?php echo e(route('admin.notifications.destroy', $n)); ?>" style="margin:0" onsubmit="return confirm('<?php echo e(is_fr() ? 'Supprimer cet enregistrement ?' : 'Permanently remove this notification record?'); ?>')">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm" style="background:#fee2e2;color:#991b1b;border:none;padding:.3rem .6rem;font-size:.7rem;cursor:pointer">
                                        <?php echo e(is_fr() ? 'Supprimer' : 'Delete'); ?>

                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" style="padding:2rem;text-align:center;color:var(--muted)">
                            <?php echo e(is_fr() ? 'Aucune notification archivée.' : 'No notification records in archive.'); ?>

                        </td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/z/my-project/ossz-laravel/resources/views/admin/notifications.blade.php ENDPATH**/ ?>