<?php $settings = \App\Support\Settings::all(); ?>

<button class="concierge-btn" aria-label="Concierge">💬</button>

<div class="concierge-panel" role="dialog" aria-label="Concierge">
    <div class="concierge-head">
        <h3><?php echo e(is_fr() ? 'Le Concierge OSSZ' : 'The OSSZ Concierge'); ?></h3>
        <p><?php echo e(is_fr() ? 'À votre écoute, jour et nuit' : 'Here for you, around the clock'); ?></p>
    </div>

    <div class="concierge-log" aria-live="polite"></div>

    <div class="concierge-suggestions">
        <button type="button"><?php echo e(is_fr() ? 'Montrez-moi la haute couture du soir' : 'Show me evening wear'); ?></button>
        <button type="button"><?php echo e(is_fr() ? 'Quels sont vos frais de livraison ?' : 'What are your delivery fees?'); ?></button>
        <button type="button"><?php echo e(is_fr() ? 'Réserver un essayage' : 'Book a fitting appointment'); ?></button>
    </div>

    <form class="concierge-form">
        <input
            class="field"
            type="text"
            name="message"
            autocomplete="off"
            placeholder="<?php echo e(is_fr() ? 'Posez une question sur une pièce…' : 'Ask about a piece, a size, an order…'); ?>"
            data-greeting="<?php echo e($settings['concierge_greeting']); ?>"
        >
        <button class="btn btn-primary btn-sm" type="submit"><?php echo e(is_fr() ? 'Envoyer' : 'Send'); ?></button>
    </form>
</div>
<?php /**PATH /home/z/my-project/ossz-laravel/resources/views/partials/concierge.blade.php ENDPATH**/ ?>