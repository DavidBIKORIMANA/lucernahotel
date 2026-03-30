<?php $__env->startSection('styles'); ?>
<style>
/* ───── Gallery Design Tokens ───── */
:root {
    --g-navy:  #0A192F;
    --g-gold:  #B89550;
    --g-dark:  #111827;
    --g-serif: 'Cormorant Garamond', serif;
    --g-sans:  'DM Sans', sans-serif;
    --g-ease:  .35s cubic-bezier(.16,1,.3,1);
    --g-main-h: 480px;
    --g-thumb-h: 110px;
}

/* ───── Layout ───── */
.srd-container {
    display: flex;
    min-height: 100vh;
    background: #fdfcfb;
    padding-top: 96px;
}

/* ═══ LEFT COLUMN — GALLERY ═══ */
.srd-gallery-column {
    width: 50%;
    position: sticky;
    top: 96px;
    height: calc(100vh - 96px);
    display: flex;
    flex-direction: column;
    background: var(--g-dark);
}

/* ── Main Display ── */
.srd-main-display {
    position: relative;
    height: var(--g-main-h);
    width: 100%;
    overflow: hidden;
    cursor: zoom-in;
    background: #000;
}
.srd-main-display img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    opacity: 1;
    transition: opacity .25s ease;
}
.srd-main-display img.is-fading { opacity: 0; }

/* Counter badge — top-right */
.srd-badge {
    position: absolute;
    top: 16px;
    right: 16px;
    z-index: 10;
    background: rgba(0,0,0,.65);
    backdrop-filter: blur(6px);
    color: #fff;
    padding: 5px 14px;
    font-family: var(--g-sans);
    font-size: 12px;
    font-weight: 500;
    letter-spacing: .5px;
    border-radius: 20px;
    pointer-events: none;
    user-select: none;
}

/* Prev / Next arrows on main */
.srd-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,.3);
    backdrop-filter: blur(4px);
    color: #fff;
    border: none;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    cursor: pointer;
    z-index: 10;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .25s, transform .25s;
    opacity: 0;
}
.srd-main-display:hover .srd-nav-btn { opacity: 1; }
.srd-nav-btn:hover {
    background: var(--g-gold);
    transform: translateY(-50%) scale(1.08);
}
.srd-prev { left: 14px; }
.srd-next { right: 14px; }

/* ── Thumbnail Strip ── */
.srd-thumb-strip {
    height: var(--g-thumb-h);
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 16px;
    overflow-x: auto;
    overflow-y: hidden;
    background: var(--g-navy);
    scrollbar-width: thin;
    scrollbar-color: var(--g-gold) transparent;
    scroll-behavior: smooth;
}
.srd-thumb-strip::-webkit-scrollbar { height: 4px; }
.srd-thumb-strip::-webkit-scrollbar-thumb {
    background: var(--g-gold);
    border-radius: 4px;
}
.srd-thumb-strip::-webkit-scrollbar-track { background: transparent; }

.srd-thumb-item {
    width: 120px;
    height: 78px;
    flex-shrink: 0;
    cursor: pointer;
    border: 2px solid transparent;
    border-radius: 4px;
    overflow: hidden;
    transition: border-color var(--g-ease), opacity var(--g-ease), transform var(--g-ease);
    opacity: .45;
}
.srd-thumb-item:hover { opacity: .8; transform: scale(1.04); }
.srd-thumb-item.is-active {
    border-color: var(--g-gold);
    opacity: 1;
    box-shadow: 0 0 0 1px var(--g-gold);
}
.srd-thumb-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* ═══ LIGHTBOX ═══ */
.srd-lightbox {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.96);
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: opacity .3s ease, visibility .3s ease;
}
.srd-lightbox.is-open {
    opacity: 1;
    visibility: visible;
}

.srd-lightbox img {
    max-width: 88vw;
    max-height: 82vh;
    object-fit: contain;
    border-radius: 4px;
    transition: opacity .2s ease;
    user-select: none;
}
.srd-lightbox img.is-fading { opacity: 0; }

/* Lightbox chrome */
.srd-lb-close {
    position: absolute;
    top: 20px;
    right: 28px;
    color: #fff;
    font-size: 38px;
    cursor: pointer;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255,255,255,.08);
    transition: background .25s;
    z-index: 10;
    border: none;
    line-height: 1;
}
.srd-lb-close:hover { background: rgba(255,255,255,.2); }

.srd-lb-badge {
    position: absolute;
    top: 24px;
    left: 28px;
    color: rgba(255,255,255,.7);
    font-family: var(--g-sans);
    font-size: 14px;
    font-weight: 500;
    letter-spacing: .5px;
    pointer-events: none;
    user-select: none;
}

.srd-lb-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,.08);
    backdrop-filter: blur(4px);
    color: #fff;
    border: none;
    width: 52px;
    height: 52px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .25s, transform .25s;
    z-index: 10;
}
.srd-lb-nav:hover {
    background: var(--g-gold);
    transform: translateY(-50%) scale(1.08);
}
.srd-lb-prev { left: 24px; }
.srd-lb-next { right: 24px; }

/* ═══ RIGHT COLUMN ═══ */
.srd-details-column {
    width: 50%;
    padding: 60px 6%;
    overflow-y: auto;
}

/* ═══ RESPONSIVE ═══ */
@media (max-width: 1024px) {
    :root { --g-main-h: 400px; --g-thumb-h: 95px; }
    .srd-container { flex-direction: column; }
    .srd-gallery-column,
    .srd-details-column {
        width: 100%;
        height: auto;
        position: static;
    }
    .srd-gallery-column { max-height: none; }
    .srd-nav-btn { opacity: 1; }
    .srd-thumb-item { width: 110px; height: 70px; }
}

@media (max-width: 768px) {
    :root { --g-main-h: 320px; --g-thumb-h: 80px; }
    .srd-details-column { padding: 36px 5%; }
    .srd-nav-btn { width: 40px; height: 40px; font-size: 15px; }
    .srd-prev { left: 8px; }
    .srd-next { right: 8px; }
    .srd-thumb-item { width: 90px; height: 58px; }
    .srd-thumb-strip { gap: 8px; padding: 0 10px; }
    .srd-badge { top: 10px; right: 10px; font-size: 11px; padding: 4px 10px; }
    .srd-lb-nav { width: 42px; height: 42px; font-size: 16px; }
    .srd-lb-prev { left: 10px; }
    .srd-lb-next { right: 10px; }
}

@media (max-width: 480px) {
    :root { --g-main-h: 260px; --g-thumb-h: 68px; }
    .srd-details-column { padding: 24px 4%; }
    .srd-nav-btn { width: 36px; height: 36px; font-size: 14px; }
    .srd-thumb-item { width: 72px; height: 48px; gap: 6px; }
    .srd-thumb-strip { gap: 6px; padding: 0 8px; }
    .srd-lb-close { top: 12px; right: 14px; font-size: 30px; width: 40px; height: 40px; }
    .srd-lb-badge { top: 16px; left: 14px; font-size: 12px; }
    .srd-lb-nav { width: 36px; height: 36px; font-size: 14px; }
    .srd-lb-prev { left: 6px; }
    .srd-lb-next { right: 6px; }
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
<?php
    $images = [asset('upload/roomimg/'.$roomdetails->image)];
    foreach($multiImage as $mi) { $images[] = asset('upload/roomimg/multi_img/'.$mi->multi_img); }
?>

<div class="srd-container">
    
    <aside class="srd-gallery-column">
        <div class="srd-main-display" id="gallery-main">
            <span class="srd-badge"><span id="curr-idx">1</span> / <?php echo e(count($images)); ?></span>
            <button class="srd-nav-btn srd-prev" id="btn-prev" aria-label="Previous photo">&#10094;</button>
            <button class="srd-nav-btn srd-next" id="btn-next" aria-label="Next photo">&#10095;</button>
            <img id="main-feat-img" src="<?php echo e($images[0]); ?>" alt="<?php echo e($roomdetails->type->name); ?>">
        </div>

        <div class="srd-thumb-strip" id="thumb-strip">
            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $src): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="srd-thumb-item <?php echo e($i === 0 ? 'is-active' : ''); ?>" data-index="<?php echo e($i); ?>">
                <img src="<?php echo e($src); ?>" alt="Photo <?php echo e($i + 1); ?>">
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </aside>

    
    <main class="srd-details-column">
        <h1 style="font-family: var(--g-serif); font-size: 48px; color: var(--g-navy);"><?php echo e($roomdetails->type->name); ?></h1>
        <hr class="my-4">
        <div class="room-desc" style="font-family: var(--g-sans); line-height: 1.8; color: #555;">
            <?php echo $roomdetails->description; ?>

        </div>
    </main>
</div>


<div id="lightbox" class="srd-lightbox" role="dialog" aria-modal="true" aria-label="Image viewer">
    <span class="srd-lb-badge"><span id="lb-idx">1</span> / <?php echo e(count($images)); ?></span>
    <button class="srd-lb-close" id="lb-close" aria-label="Close lightbox">&times;</button>
    <button class="srd-lb-nav srd-lb-prev" id="lb-prev" aria-label="Previous photo">&#10094;</button>
    <button class="srd-lb-nav srd-lb-next" id="lb-next" aria-label="Next photo">&#10095;</button>
    <img id="lb-img" src="" alt="Zoomed photo">
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    /* ── Data ── */
    var photos = <?php echo json_encode($images, 15, 512) ?>;
    var idx = 0;
    var lbOpen = false;

    /* ── DOM refs ── */
    var mainImg   = document.getElementById('main-feat-img');
    var badge     = document.getElementById('curr-idx');
    var thumbs    = document.querySelectorAll('.srd-thumb-item');
    var strip     = document.getElementById('thumb-strip');
    var btnPrev   = document.getElementById('btn-prev');
    var btnNext   = document.getElementById('btn-next');

    var lb        = document.getElementById('lightbox');
    var lbImg     = document.getElementById('lb-img');
    var lbBadge   = document.getElementById('lb-idx');
    var lbClose   = document.getElementById('lb-close');
    var lbPrev    = document.getElementById('lb-prev');
    var lbNext    = document.getElementById('lb-next');

    /* ── Helpers ── */
    function goTo(newIdx) {
        if (newIdx < 0) newIdx = photos.length - 1;
        if (newIdx >= photos.length) newIdx = 0;
        idx = newIdx;

        /* fade main image */
        mainImg.classList.add('is-fading');
        setTimeout(function () {
            mainImg.src = photos[idx];
            mainImg.classList.remove('is-fading');
        }, 200);

        /* update badge */
        badge.textContent = idx + 1;

        /* sync thumbnails */
        thumbs.forEach(function (t, i) {
            var active = (i === idx);
            t.classList.toggle('is-active', active);
            if (active) scrollThumbIntoView(t);
        });

        /* sync lightbox if open */
        if (lbOpen) {
            lbImg.classList.add('is-fading');
            setTimeout(function () {
                lbImg.src = photos[idx];
                lbImg.classList.remove('is-fading');
            }, 150);
            lbBadge.textContent = idx + 1;
        }
    }

    function scrollThumbIntoView(thumb) {
        var sLeft = strip.scrollLeft;
        var sWidth = strip.clientWidth;
        var tLeft  = thumb.offsetLeft;
        var tWidth = thumb.offsetWidth;
        var target;
        if (tLeft < sLeft + 16) {
            target = tLeft - 16;
        } else if (tLeft + tWidth > sLeft + sWidth - 16) {
            target = tLeft + tWidth - sWidth + 16;
        } else {
            return;
        }
        strip.scrollTo({ left: target, behavior: 'smooth' });
    }

    /* ── Gallery nav ── */
    btnNext.addEventListener('click', function () { goTo(idx + 1); });
    btnPrev.addEventListener('click', function () { goTo(idx - 1); });

    thumbs.forEach(function (thumb) {
        thumb.addEventListener('click', function () {
            goTo(parseInt(this.getAttribute('data-index')));
        });
    });

    /* ── Open lightbox ── */
    document.getElementById('gallery-main').addEventListener('click', function (e) {
        if (e.target.closest('.srd-nav-btn')) return;
        lbImg.src = photos[idx];
        lbBadge.textContent = idx + 1;
        lb.classList.add('is-open');
        document.body.style.overflow = 'hidden';
        lbOpen = true;
    });

    /* ── Close lightbox ── */
    function closeLightbox() {
        lb.classList.remove('is-open');
        document.body.style.overflow = '';
        lbOpen = false;
    }
    lbClose.addEventListener('click', closeLightbox);
    lb.addEventListener('click', function (e) {
        if (e.target === lb) closeLightbox();
    });

    /* ── Lightbox nav ── */
    lbNext.addEventListener('click', function (e) { e.stopPropagation(); goTo(idx + 1); });
    lbPrev.addEventListener('click', function (e) { e.stopPropagation(); goTo(idx - 1); });

    /* ── Keyboard ── */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && lbOpen) { closeLightbox(); return; }
        if (e.key === 'ArrowRight')       { goTo(idx + 1); return; }
        if (e.key === 'ArrowLeft')        { goTo(idx - 1); return; }
    });

    /* ── Touch swipe (lightbox + main) ── */
    [document.getElementById('gallery-main'), lb].forEach(function (el) {
        var x0 = null;
        el.addEventListener('touchstart', function (e) {
            x0 = e.changedTouches[0].clientX;
        }, { passive: true });
        el.addEventListener('touchend', function (e) {
            if (x0 === null) return;
            var dx = e.changedTouches[0].clientX - x0;
            if (Math.abs(dx) > 40) {
                dx < 0 ? goTo(idx + 1) : goTo(idx - 1);
            }
            x0 = null;
        }, { passive: true });
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\htdocs\lucerna\resources\views/frontend/room/room_details.blade.php ENDPATH**/ ?>