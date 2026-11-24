<?php
    $osszUser  = $osszUser ?? (\App\Models\User::find(session('user_id')));
    $cartView  = \App\Support\Cart::view();
    $loc       = locale();
    $isAdmin   = $osszUser && \App\Support\Auth::canEnterBackOffice($osszUser->role);
?>


<?php $bannerText = t('banner.freeDelivery'); ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($bannerText) && $bannerText !== 'banner.freeDelivery'): ?>
<div style="background:var(--ink);text-align:center;font-size:.68rem;letter-spacing:.2em;text-transform:uppercase;color:rgba(255,255,255,.85);padding:.5rem 1rem;">
    <?php echo e($bannerText); ?>

</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<header class="site-header" id="site-header">
    <div class="wrap" style="display:flex;align-items:center;justify-content:space-between;height:64px;gap:1rem;position:relative;">

        
        <button class="nav-toggle" id="nav-toggle" aria-label="<?php echo e(t('nav.openMenu')); ?>" aria-expanded="false"
                style="background:none;border:none;cursor:pointer;padding:.5rem;display:none;flex-direction:column;gap:5px;">
            <span style="display:block;height:1px;width:24px;background:var(--ink);"></span>
            <span style="display:block;height:1px;width:24px;background:var(--ink);"></span>
            <span style="display:block;height:1px;width:18px;background:var(--ink);"></span>
        </button>

        
        <nav class="main-nav" id="main-nav" aria-label="Primary navigation"
             style="display:flex;align-items:center;gap:1.75rem;font-size:.78rem;letter-spacing:.14em;text-transform:uppercase;">
            <a href="<?php echo e(route('shop')); ?>"
               class="link-underline<?php echo e(request()->is('shop*') ? ' nav-active' : ''); ?>"
               style="color:<?php echo e(request()->is('shop*') ? 'var(--accent)' : 'var(--ink-soft)'); ?>"><?php echo e(t('nav.shop')); ?></a>
            <a href="<?php echo e(route('collections.index')); ?>"
               class="link-underline<?php echo e(request()->is('collections*') ? ' nav-active' : ''); ?>"
               style="color:<?php echo e(request()->is('collections*') ? 'var(--accent)' : 'var(--ink-soft)'); ?>"><?php echo e(t('nav.collections')); ?></a>
            <a href="<?php echo e(route('lookbook')); ?>"
               class="link-underline<?php echo e(request()->is('lookbook*') ? ' nav-active' : ''); ?>"
               style="color:<?php echo e(request()->is('lookbook*') ? 'var(--accent)' : 'var(--ink-soft)'); ?>"><?php echo e(t('nav.lookbook')); ?></a>
        </nav>

        
        <a href="<?php echo e(route('home')); ?>" aria-label="OSSZ Collections"
           style="position:absolute;left:50%;transform:translateX(-50%);display:inline-block;line-height:0;flex-shrink:0;">
            <img src="/logo-ossz.png" alt="OSSZ Collections" style="height:32px;width:auto;display:block;">
        </a>

        
        <div style="display:flex;align-items:center;gap:1.75rem;">
            <nav class="main-nav main-nav-right" aria-label="Secondary navigation"
                 style="display:flex;align-items:center;gap:1.75rem;font-size:.78rem;letter-spacing:.14em;text-transform:uppercase;">
                <a href="<?php echo e(route('journal.index')); ?>"
                   class="link-underline<?php echo e(request()->is('journal*') ? ' nav-active' : ''); ?>"
                   style="color:<?php echo e(request()->is('journal*') ? 'var(--accent)' : 'var(--ink-soft)'); ?>"><?php echo e(t('nav.journal')); ?></a>
                <a href="<?php echo e(route('appointments')); ?>"
                   class="link-underline<?php echo e(request()->is('appointments*') ? ' nav-active' : ''); ?>"
                   style="color:<?php echo e(request()->is('appointments*') ? 'var(--accent)' : 'var(--ink-soft)'); ?>"><?php echo e(t('nav.appointments')); ?></a>
                <a href="<?php echo e(route('about')); ?>"
                   class="link-underline<?php echo e(request()->is('about*') ? ' nav-active' : ''); ?>"
                   style="color:<?php echo e(request()->is('about*') ? 'var(--accent)' : 'var(--ink-soft)'); ?>"><?php echo e(t('nav.about')); ?></a>
            </nav>

            
            <div style="display:flex;align-items:center;gap:.9rem;font-size:.75rem;letter-spacing:.12em;text-transform:uppercase;">
                
                <a href="<?php echo e(route('locale.switch', ['locale' => $loc === 'fr' ? 'en' : 'fr'])); ?>"
                   class="link-underline"
                   style="color:var(--ink-soft);font-size:.75rem;letter-spacing:.12em;text-transform:uppercase;">
                    <?php echo e($loc === 'fr' ? 'EN' : 'FR'); ?>

                </a>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isAdmin): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>"
                       style="display:none;color:var(--ink-soft);"
                       class="backoffice-link link-underline"><?php echo e(t('nav.backoffice')); ?></a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <a href="<?php echo e($osszUser ? route('account.home') : route('login')); ?>"
                   class="link-underline"
                   style="color:var(--ink-soft);white-space:nowrap;">
                    <?php echo e($osszUser ? explode(' ', $osszUser->full_name ?: $osszUser->email)[0] : t('nav.signin')); ?>

                </a>

                
                <a href="<?php echo e(route('cart.show')); ?>" aria-label="<?php echo e(t('nav.cart')); ?>"
                   style="position:relative;color:var(--ink);display:inline-flex;align-items:center;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"/>
                        <circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                    </svg>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cartView['itemCount'] > 0): ?>
                        <span style="position:absolute;top:-6px;right:-6px;display:inline-flex;align-items:center;justify-content:center;min-width:16px;height:16px;border-radius:999px;background:var(--accent);color:#fff;font-size:.55rem;padding:0 .2rem;">
                            <?php echo e($cartView['itemCount']); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>
            </div>
        </div>
    </div>

    
    <nav id="mobile-nav"
         style="display:none;position:absolute;top:100%;left:0;right:0;background:var(--paper);border-bottom:1px solid var(--line);z-index:50;padding:1.25rem 1.5rem;flex-direction:column;gap:.85rem;">
        <a href="<?php echo e(route('shop')); ?>" style="font-size:.82rem;letter-spacing:.12em;text-transform:uppercase;color:var(--ink-soft);"><?php echo e(t('nav.shop')); ?></a>
        <a href="<?php echo e(route('collections.index')); ?>" style="font-size:.82rem;letter-spacing:.12em;text-transform:uppercase;color:var(--ink-soft);"><?php echo e(t('nav.collections')); ?></a>
        <a href="<?php echo e(route('lookbook')); ?>" style="font-size:.82rem;letter-spacing:.12em;text-transform:uppercase;color:var(--ink-soft);"><?php echo e(t('nav.lookbook')); ?></a>
        <a href="<?php echo e(route('journal.index')); ?>" style="font-size:.82rem;letter-spacing:.12em;text-transform:uppercase;color:var(--ink-soft);"><?php echo e(t('nav.journal')); ?></a>
        <a href="<?php echo e(route('appointments')); ?>" style="font-size:.82rem;letter-spacing:.12em;text-transform:uppercase;color:var(--ink-soft);"><?php echo e(t('nav.appointments')); ?></a>
        <a href="<?php echo e(route('about')); ?>" style="font-size:.82rem;letter-spacing:.12em;text-transform:uppercase;color:var(--ink-soft);"><?php echo e(t('nav.about')); ?></a>
        <div style="display:flex;gap:1rem;padding-top:.5rem;border-top:1px solid var(--line);">
            <a href="<?php echo e(route('locale.switch', ['locale' => $loc === 'fr' ? 'en' : 'fr'])); ?>" style="font-size:.75rem;letter-spacing:.12em;text-transform:uppercase;color:var(--ink-soft);">
                <?php echo e($loc === 'fr' ? 'EN' : 'FR'); ?>

            </a>
            <a href="<?php echo e($osszUser ? route('account.home') : route('login')); ?>" style="font-size:.75rem;letter-spacing:.12em;text-transform:uppercase;color:var(--ink-soft);">
                <?php echo e($osszUser ? explode(' ', $osszUser->full_name ?: $osszUser->email)[0] : t('nav.signin')); ?>

            </a>
        </div>
    </nav>
</header>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
    <div class="flash flash-success wrap"><?php echo e(session('success')); ?></div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
    <div class="flash flash-error wrap"><?php echo e(session('error')); ?></div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
    <div class="flash flash-error wrap"><?php echo e(implode(' · ', $errors->all())); ?></div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if (! $__env->hasRenderedOnce('a697c6cd-0416-47e4-aa93-aa9385a70f02')): $__env->markAsRenderedOnce('a697c6cd-0416-47e4-aa93-aa9385a70f02'); ?>
<?php $__env->startPush('scripts'); ?>
<script>
(function(){
    var btn = document.getElementById('nav-toggle');
    var nav = document.getElementById('mobile-nav');
    if(!btn || !nav) return;
    btn.addEventListener('click', function(){
        var open = nav.style.display === 'flex';
        nav.style.display = open ? 'none' : 'flex';
        btn.setAttribute('aria-expanded', open ? 'false' : 'true');
    });
    // Scroll-shadow on header
    var hdr = document.getElementById('site-header');
    window.addEventListener('scroll', function(){
        hdr.style.borderBottomColor = window.scrollY > 12 ? 'var(--line)' : 'transparent';
    }, {passive:true});
})();
</script>
<style>
@media (max-width:900px){
    .main-nav, .main-nav-right, .backoffice-link { display:none !important; }
    #nav-toggle { display:flex !important; }
}
@media (min-width:901px){
    .backoffice-link { display:inline !important; }
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH /home/z/my-project/ossz-laravel/resources/views/partials/header.blade.php ENDPATH**/ ?>