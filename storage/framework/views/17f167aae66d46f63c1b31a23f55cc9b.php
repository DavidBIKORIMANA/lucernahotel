<?php $__env->startSection('styles'); ?>
<style>
/* ───── Design Tokens ───── */
:root {
    --rd-blue:   #0A192F;
    --rd-accent: #1a5276;
    --rd-gold:   #B89550;
    --rd-serif:  'Cormorant Garamond', serif;
    --rd-sans:   'DM Sans', sans-serif;
    --rd-ease:   .3s cubic-bezier(.16,1,.3,1);
    --rd-body:   #4a4a4a;
    --rd-light:  #f7f7f7;
    --rd-border: #e0e0e0;
}

/* ───── Page Shell ───── */
.rd-page { background: #fff; padding-top: 96px; }

/* ── Room Title Bar ── */
.rd-title-bar {
    max-width: 1260px;
    margin: 0 auto;
    padding: 36px 40px 0;
}
.rd-title-bar h1 {
    font-family: var(--rd-serif);
    font-size: 36px;
    font-weight: 600;
    color: var(--rd-blue);
    margin: 0;
    line-height: 1.2;
}

/* ── Two-Column Layout ── */
.rd-columns {
    max-width: 1260px;
    margin: 0 auto;
    padding: 28px 40px 60px;
    display: flex;
    gap: 40px;
    align-items: flex-start;
}
.rd-left  { flex: 0 0 55%; max-width: 55%; }
.rd-right { flex: 0 0 calc(45% - 40px); max-width: calc(45% - 40px); position: sticky; top: 110px; }

/* ═══════════════════════════════════════════
   LEFT COLUMN — Gallery + Info
═══════════════════════════════════════════ */

/* ── Gallery Image ── */
.rd-gallery-wrap {
    position: relative;
    width: 100%;
    border-radius: 6px;
    overflow: hidden;
    background: #000;
}
.rd-gallery-wrap img#main-feat-img {
    width: 100%;
    height: 420px;
    object-fit: cover;
    display: block;
    transition: opacity .25s ease;
}
.rd-gallery-wrap img.is-fading { opacity: 0; }

/* Nav arrows */
.rd-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,.85);
    color: var(--rd-blue);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    z-index: 10;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background .2s, box-shadow .2s;
    box-shadow: 0 2px 8px rgba(0,0,0,.15);
}
.rd-nav-btn:hover { background: #fff; box-shadow: 0 2px 12px rgba(0,0,0,.25); }
.rd-prev { left: 12px; }
.rd-next { right: 12px; }

/* VIEW GALLERY button */
.rd-view-gallery-btn {
    position: absolute;
    bottom: 16px;
    right: 16px;
    z-index: 10;
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(0,0,0,.6);
    backdrop-filter: blur(4px);
    color: #fff;
    padding: 8px 18px;
    border: none;
    border-radius: 4px;
    font-family: var(--rd-sans);
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    cursor: pointer;
    transition: background .2s;
}
.rd-view-gallery-btn:hover { background: rgba(0,0,0,.8); }
.rd-view-gallery-btn svg { flex-shrink: 0; }

/* Counter badge */
.rd-badge {
    position: absolute;
    top: 14px;
    left: 14px;
    z-index: 10;
    background: rgba(0,0,0,.55);
    backdrop-filter: blur(4px);
    color: #fff;
    padding: 4px 12px;
    font-family: var(--rd-sans);
    font-size: 12px;
    font-weight: 500;
    border-radius: 20px;
    pointer-events: none;
}

/* ── Thumbnail Strip ── */
.rd-thumb-strip {
    display: flex;
    gap: 8px;
    margin-top: 10px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding-bottom: 4px;
    scrollbar-width: thin;
    scrollbar-color: var(--rd-gold) transparent;
}
.rd-thumb-strip::-webkit-scrollbar { height: 3px; }
.rd-thumb-strip::-webkit-scrollbar-thumb { background: var(--rd-gold); border-radius: 3px; }
.rd-thumb-item {
    width: 90px;
    height: 60px;
    flex-shrink: 0;
    cursor: pointer;
    border: 2px solid transparent;
    border-radius: 4px;
    overflow: hidden;
    opacity: .5;
    transition: opacity .2s, border-color .2s;
}
.rd-thumb-item:hover { opacity: .8; }
.rd-thumb-item.is-active { border-color: var(--rd-blue); opacity: 1; }
.rd-thumb-item img { width: 100%; height: 100%; object-fit: cover; display: block; }

/* ── Description Section ── */
.rd-section {
    margin-top: 32px;
}
.rd-section-title {
    font-family: var(--rd-sans);
    font-size: 16px;
    font-weight: 700;
    background: linear-gradient(179deg, #0a70e3 .46%, #034ea2 87.03%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-transform: uppercase;
    letter-spacing: .5px;
    padding-bottom: 8px;
    border-bottom: 2px solid #0a70e3;
    margin-bottom: 16px;
    display: inline-block;
}
.rd-desc-text {
    font-family: var(--rd-sans);
    font-size: 14.5px;
    line-height: 1.85;
    color: var(--rd-body);
    padding: 0px 20px;
}

/* ── Details Grid (2 columns) ── */
.rd-details-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px 40px;
    margin-top: 28px;
}
.rd-detail-item {}
.rd-detail-label {
    font-family: var(--rd-sans);
    font-size: 14px;
    font-weight: 700;
    background: linear-gradient(179deg, #0a70e3 .46%, #034ea2 87.03%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 4px;
}
.rd-detail-value {
    font-family: var(--rd-sans);
    font-size: 13.5px;
    color: var(--rd-body);
    line-height: 1.5;
}

/* ── Facilities List ── */
.rd-facilities-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.rd-facilities-list li {
    font-family: var(--rd-sans);
    font-size: 13.5px;
    color: var(--rd-body);
    display: flex;
    align-items: center;
    gap: 10px;
    line-height: 1.5;
}
.rd-facilities-list li::before {
    content: '';
    width: 0; height: 0;
    border-left: 6px solid #0a70e3;
    border-top: 4px solid transparent;
    border-bottom: 4px solid transparent;
    flex-shrink: 0;
}

/* ── See More Details toggle ── */
.rd-see-more {
    margin-top: 24px;
    border-top: 1px solid var(--rd-border);
    padding-top: 16px;
}
.rd-see-more-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    background: none;
    border: none;
    cursor: pointer;
    font-family: var(--rd-sans);
    font-size: 15px;
    font-weight: 700;
    color: #034ea2;
    padding: 0;
}
.rd-see-more-btn .plus {
    width: 24px; height: 24px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; font-weight: 300;
    color: #0a70e3;
    transition: transform .25s;
}
.rd-see-more-btn.is-open .plus { transform: rotate(45deg); }
.rd-more-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height .35s ease;
}
.rd-more-content.is-open {
    max-height: 600px;
}
.rd-more-inner {
    padding-top: 16px;
}

/* ═══════════════════════════════════════════
   RIGHT COLUMN — Booking Card
═══════════════════════════════════════════ */

/* ── Rate Banner (header) ── */
.rd-rate-banner {
    background: linear-gradient(179deg, #0a70e3 .46%, #034ea2 87.03%);
    padding: 0px 20px;
    text-align: center;
    border-radius: 4px 4px 0 0;
}
.rd-rate-banner-price {
    font-family: var(--rd-serif);
    font-size: 26px;
    font-weight: 600;
    color: #fff;
}
.rd-rate-old {
    text-decoration: line-through;
    color: rgba(255,255,255,.55);
    font-size: 17px;
    margin-right: 6px;
}
.rd-rate-banner-unit {
    font-family: var(--rd-sans);
    font-size: 12px;
    color: rgba(255,255,255,.75);
}

/* ── Booking Form Body ── */
.rd-book-body {
    border: 1px solid var(--rd-border);
    border-top: none;
    border-radius: 0 0 4px 4px;
    padding: 22px;
    background: #fff;
}
.rd-date-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 14px;
}
.rd-date-row .rd-field { margin-bottom: 0; }
.rd-field { margin-bottom: 14px; }
.rd-field label {
    display: block;
    font-family: var(--rd-sans);
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .18em;
    text-transform: uppercase;
    color: #999;
    margin-bottom: 5px;
}
.rd-field input,
.rd-field select {
    width: 100%;
    padding: 10px 14px;
    font-family: var(--rd-sans);
    font-size: 13px;
    color: #333;
    border: 1px solid #ddd;
    border-radius: 2px;
    background: #fff;
    transition: border .2s;
}
.rd-field input:focus,
.rd-field select:focus { outline: none; border-color: var(--rd-gold); }

.rd-avail-msg {
    font-family: var(--rd-sans);
    font-size: 13px;
    margin-top: 6px;
    color: #999;
}
.rd-avail-msg.success { color: #22c55e; font-weight: 600; }

/* ── Pricing Table ── */
.rd-pricing-table {
    background: var(--rd-light);
    padding: 12px;
    margin: 14px 0 18px;
    font-family: var(--rd-sans);
    font-size: 13px;
    border-radius: 2px;
}
.rd-pricing-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 4px 0;
    margin-bottom: 5px;
    color: #666;
}
.rd-pricing-row:last-child { margin-bottom: 0; }
.rd-pricing-row span:last-child { font-weight: 600; color: #333; }
.rd-pricing-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0 0;
    margin-top: 8px;
    border-top: 1px solid #ddd;
    font-family: var(--rd-sans);
    font-size: 15px;
    font-weight: 700;
    color: var(--rd-blue);
}

/* ── Book Now Button ── */
.rd-btn-book {
    display: block;
    width: 100%;
    padding: 14px;
    font-family: var(--rd-sans);
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-align: center;
    border: none;
    border-radius: 2px;
    cursor: pointer;
    transition: all .25s;
    text-decoration: none;
    background: linear-gradient(179deg, #0a70e3 .46%, #034ea2 87.03%);
    color: #fff;
}
.rd-btn-book:hover { background: #0556b8; color: #fff; }
.rd-btn-book:disabled { opacity: .5; cursor: not-allowed; }

/* ── Reviews Card ── */
.rd-reviews-card {
    margin-top: 16px;
    padding: 18px 22px;
    background: var(--rd-light);
    border: 1px solid var(--rd-border);
    border-left: 4px solid var(--rd-gold);
    border-radius: 4px;
}
.rd-rate-name {
    font-family: var(--rd-sans);
    font-size: 17px;
    font-weight: 700;
    color: var(--rd-blue);
}

/* ── Other Rooms ── */
.rd-other-section {
    max-width: 1260px;
    margin: 0 auto;
    padding: 0 40px 60px;
}
.rd-other-title {
    font-family: var(--rd-serif);
    font-size: 26px;
    font-weight: 600;
    color: var(--rd-blue);
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--rd-border);
}
.rd-other-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
    gap: 24px;
}
.rd-other-card {
    border: 1px solid var(--rd-border);
    border-radius: 6px;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    transition: box-shadow .2s, transform .2s;
}
.rd-other-card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,.1);
    transform: translateY(-2px);
    color: inherit;
}
.rd-other-card-img { height: 280px; overflow: hidden; }
.rd-other-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease; }
.rd-other-card:hover .rd-other-card-img img { transform: scale(1.05); }
.rd-other-card-body { padding: 16px 18px; }
.rd-other-card-name {
    font-family: var(--rd-serif);
    font-size: 20px;
    font-weight: 600;
    color: var(--rd-blue);
    margin-bottom: 6px;
}
.rd-other-card-price {
    font-family: var(--rd-sans);
    font-size: 15px;
    font-weight: 700;
    color: var(--rd-accent);
}
.rd-other-card-meta {
    font-family: var(--rd-sans);
    font-size: 12.5px;
    color: #888;
    margin-top: 4px;
}

/* ═══ LIGHTBOX ═══ */
.rd-lightbox {
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
.rd-lightbox.is-open { opacity: 1; visibility: visible; }
.rd-lightbox img {
    max-width: 88vw; max-height: 82vh;
    object-fit: contain; border-radius: 4px;
    transition: opacity .2s ease; user-select: none;
}
.rd-lightbox img.is-fading { opacity: 0; }
.rd-lb-close {
    position: absolute; top: 20px; right: 28px;
    color: #fff; font-size: 38px; cursor: pointer;
    width: 48px; height: 48px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 50%; background: rgba(255,255,255,.08);
    transition: background .25s; z-index: 10; border: none; line-height: 1;
}
.rd-lb-close:hover { background: rgba(255,255,255,.2); }
.rd-lb-badge {
    position: absolute; top: 24px; left: 28px;
    color: rgba(255,255,255,.7);
    font-family: var(--rd-sans); font-size: 14px;
    font-weight: 500; letter-spacing: .5px;
    pointer-events: none;
}
.rd-lb-nav {
    position: absolute; top: 50%; transform: translateY(-50%);
    background: rgba(255,255,255,.08); backdrop-filter: blur(4px);
    color: #fff; border: none;
    width: 52px; height: 52px; border-radius: 50%;
    cursor: pointer; font-size: 20px;
    display: flex; align-items: center; justify-content: center;
    transition: background .25s, transform .25s; z-index: 10;
}
.rd-lb-nav:hover { background: var(--rd-gold); transform: translateY(-50%) scale(1.08); }
.rd-lb-prev { left: 24px; }
.rd-lb-next { right: 24px; }

/* ═══ RESPONSIVE ═══ */
@media (max-width: 1024px) {
    .rd-columns { flex-direction: column; padding: 20px 24px 50px; gap: 30px; }
    .rd-left, .rd-right { flex: 1 1 100%; max-width: 100%; }
    .rd-right { position: static; }
    .rd-title-bar { padding: 28px 24px 0; }
}
@media (max-width: 768px) {
    .rd-title-bar h1 { font-size: 28px; }
    .rd-gallery-wrap img#main-feat-img { height: 300px; }
    .rd-details-grid { gap: 18px 24px; }
    .rd-rate-card { padding: 18px; }
    .rd-other-section { padding: 0 24px 40px; }
}
@media (max-width: 480px) {
    .rd-title-bar { padding: 20px 16px 0; }
    .rd-title-bar h1 { font-size: 24px; }
    .rd-columns { padding: 16px 16px 40px; }
    .rd-gallery-wrap img#main-feat-img { height: 240px; }
    .rd-details-grid { grid-template-columns: 1fr; gap: 16px; }
    .rd-thumb-item { width: 70px; height: 46px; }
    .rd-date-row { grid-template-columns: 1fr; gap: 0; }
    .rd-date-row .rd-field { margin-bottom: 14px; }
    .rd-other-section { padding: 0 16px 30px; }
    .rd-lb-nav { width: 40px; height: 40px; font-size: 16px; }
    .rd-lb-prev { left: 8px; }
    .rd-lb-next { right: 8px; }
    .rd-lb-close { top: 12px; right: 14px; font-size: 30px; width: 40px; height: 40px; }
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
<?php
    $images = [asset('upload/roomimg/'.$roomdetails->image)];
    foreach($multiImage as $mi) { $images[] = asset('upload/roomimg/multi_img/'.$mi->multi_img); }
    $isHall = (strtolower($roomdetails->type->name ?? '') === 'hall' || ($roomdetails->room_capacity >= 50));
    $entityLabel = $isHall ? 'Hall' : 'Room';
    $unitLabel   = $isHall ? 'event' : 'night';
    $discountedPrice = $roomdetails->discount > 0
        ? $roomdetails->price - ($roomdetails->price * $roomdetails->discount / 100)
        : $roomdetails->price;
?>

<div class="rd-page">
    
    <div class="rd-title-bar">
        <h1><?php echo e($roomdetails->type->name); ?></h1>
    </div>

    
    <div class="rd-columns">

        
        <div class="rd-left">
            
            <div class="rd-gallery-wrap" id="gallery-main">
                <span class="rd-badge"><span id="curr-idx">1</span> / <?php echo e(count($images)); ?></span>
                <button class="rd-nav-btn rd-prev" id="btn-prev" aria-label="Previous">&#10094;</button>
                <button class="rd-nav-btn rd-next" id="btn-next" aria-label="Next">&#10095;</button>
                <button class="rd-view-gallery-btn" id="view-gallery-btn">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    VIEW GALLERY
                </button>
                <img id="main-feat-img" src="<?php echo e($images[0]); ?>" alt="<?php echo e($roomdetails->type->name); ?>">
            </div>
            <div class="rd-thumb-strip" id="thumb-strip">
                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $src): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="rd-thumb-item <?php echo e($i === 0 ? 'is-active' : ''); ?>" data-index="<?php echo e($i); ?>">
                    <img src="<?php echo e($src); ?>" alt="Photo <?php echo e($i + 1); ?>" loading="lazy">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="rd-section">
                <span class="rd-section-title">Description</span>
                <div class="rd-desc-text"><?php echo $roomdetails->description; ?></div>
            </div>

            
            <?php if($roomdetails->view || $roomdetails->size || $roomdetails->room_capacity || $roomdetails->bed_style): ?>
            <div class="rd-details-grid">
                <?php if($roomdetails->view): ?>
                <div class="rd-detail-item">
                    <div class="rd-detail-label">View:</div>
                    <div class="rd-detail-value"><?php echo e($roomdetails->view); ?></div>
                </div>
                <?php endif; ?>
                <?php if($roomdetails->size): ?>
                <div class="rd-detail-item">
                    <div class="rd-detail-label">Size:</div>
                    <div class="rd-detail-value"><?php echo e($roomdetails->size); ?></div>
                </div>
                <?php endif; ?>
                <?php if($roomdetails->room_capacity): ?>
                <div class="rd-detail-item">
                    <div class="rd-detail-label">Occupancy:</div>
                    <div class="rd-detail-value">Up to <?php echo e($roomdetails->room_capacity); ?> <?php echo e($roomdetails->room_capacity > 1 ? 'guests' : 'guest'); ?></div>
                </div>
                <?php endif; ?>
                <?php if($roomdetails->bed_style): ?>
                <div class="rd-detail-item">
                    <div class="rd-detail-label">Bedding:</div>
                    <div class="rd-detail-value"><?php echo e($roomdetails->bed_style); ?></div>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            
            <?php if($facility->count()): ?>
            <div class="rd-section">
                <ul class="rd-facilities-list">
                    <?php $__currentLoopData = $facility; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($fac->facility_name); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <?php endif; ?>

            
            <?php if($roomdetails->short_desc || $roomdetails->amenities): ?>
            <div class="rd-see-more">
                <button class="rd-see-more-btn" id="see-more-btn">
                    See More Details
                    <span class="plus">+</span>
                </button>
                <div class="rd-more-content" id="more-content">
                    <div class="rd-more-inner rd-desc-text">
                        <?php if($roomdetails->short_desc): ?>
                        <p><?php echo e($roomdetails->short_desc); ?></p>
                        <?php endif; ?>
                        <?php if(is_array($roomdetails->amenities) && count($roomdetails->amenities)): ?>
                        <ul style="margin-top:12px;">
                            <?php $__currentLoopData = $roomdetails->amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($amenity); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="rd-right">
            
            <div class="rd-rate-banner">
                <div class="rd-rate-banner-price">
                    <?php if($roomdetails->discount > 0): ?>
                        <span class="rd-rate-old">$ <?php echo e(number_format($roomdetails->price, 0)); ?></span>
                        $ <?php echo e(number_format($discountedPrice, 0)); ?>

                    <?php else: ?>
                        $ <?php echo e(number_format($roomdetails->price, 0)); ?>

                    <?php endif; ?>
                </div>
                <div class="rd-rate-banner-unit">/ <?php echo e($unitLabel); ?></div>
            </div>

            
            <div class="rd-book-body">
                <form action="<?php echo e(route('user_booking_store', $roomdetails->id)); ?>" method="post" id="bk_form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="room_id" value="<?php echo e($roomdetails->id); ?>">
                    <input type="hidden" id="room_price" value="<?php echo e($roomdetails->price); ?>">
                    <input type="hidden" id="discount_p" value="<?php echo e($roomdetails->discount); ?>">
                    <input type="hidden" id="total_adult" value="<?php echo e($roomdetails->total_adult); ?>">
                    <input type="hidden" name="available_room" id="available_room">

                    <div class="rd-date-row">
                        <div class="rd-field">
                            <label>Check In</label>
                            <input type="text" name="check_in" id="check_in" required autocomplete="off"
                                   placeholder="Select date" value="<?php echo e(old('check_in')); ?>">
                        </div>
                        <div class="rd-field">
                            <label>Check Out</label>
                            <input type="text" name="check_out" id="check_out" required autocomplete="off"
                                   placeholder="Select date" value="<?php echo e(old('check_out')); ?>">
                        </div>
                    </div>

                    <div style="display:none">
                        <select name="persion" id="nmbr_person">
                            <?php for($i = 1; $i <= 4; $i++): ?>
                            <option <?php echo e(old('persion') == $i ? 'selected' : ''); ?> value="0<?php echo e($i); ?>">0<?php echo e($i); ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="rd-field">
                        <label>Number of <?php echo e($entityLabel); ?>s</label>
                        <select name="number_of_rooms" id="select_room" class="number_of_rooms">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                            <option value="0<?php echo e($i); ?>">0<?php echo e($i); ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="rd-avail-msg available_room"></div>

                    
                    <div class="rd-pricing-table" id="pricing_table" style="display:none">
                        <div class="rd-pricing-row">
                            <span>Rate / <?php echo e($unitLabel); ?></span>
                            <span>$ <?php echo e(number_format($roomdetails->price, 0)); ?></span>
                        </div>
                        <div class="rd-pricing-row">
                            <span>Nights</span>
                            <span class="t_nights">0</span>
                        </div>
                        <div class="rd-pricing-row">
                            <span><?php echo e($entityLabel); ?>s</span>
                            <span class="t_rooms">1</span>
                        </div>
                        <div class="rd-pricing-row">
                            <span>Subtotal</span>
                            <span class="t_subtotal">$ 0</span>
                        </div>
                        <?php if($roomdetails->discount > 0): ?>
                        <div class="rd-pricing-row">
                            <span>Discount (<?php echo e($roomdetails->discount); ?>%)</span>
                            <span class="t_discount" style="color:#22c55e">-$ 0</span>
                        </div>
                        <?php endif; ?>
                        <div class="rd-pricing-total">
                            <span>Total</span>
                            <span class="t_g_total">$ 0</span>
                        </div>
                    </div>

                    <?php if(auth()->guard()->check()): ?>
                    <button type="submit" class="rd-btn-book" id="book_now_btn" disabled>Book Now</button>
                    <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>?redirect=<?php echo e(urlencode(url()->full())); ?>" class="rd-btn-book">Login to Book</a>
                    <?php endif; ?>
                </form>
            </div>

            
            <?php if($roomdetails->approved_reviews && $roomdetails->approved_reviews->count()): ?>
            <?php $avgRating = round($roomdetails->approved_reviews->avg('rating'), 1); ?>
            <div class="rd-reviews-card">
                <div class="rd-rate-name" style="margin-bottom: 8px;">Guest Reviews</div>
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px;">
                    <span style="font-size:28px;font-weight:700;color:var(--rd-blue);font-family:var(--rd-sans);"><?php echo e($avgRating); ?></span>
                    <span style="font-size:13px;color:#888;font-family:var(--rd-sans);">/ 5 — <?php echo e($roomdetails->approved_reviews->count()); ?> <?php echo e(Str::plural('review', $roomdetails->approved_reviews->count())); ?></span>
                </div>
                <div style="display:flex;gap:3px;">
                    <?php for($s = 1; $s <= 5; $s++): ?>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="<?php echo e($s <= round($avgRating) ? '#d0aa48' : '#ddd'); ?>"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    <?php endfor; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    
    <?php if($otherRooms->count()): ?>
    <div class="rd-other-section">
        <div class="rd-other-title">Other <?php echo e($entityLabel); ?>s You May Like</div>
        <div class="rd-other-grid">
            <?php $__currentLoopData = $otherRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a class="rd-other-card" href="<?php echo e(url('room/details/'.$item->id)); ?>">
                <div class="rd-other-card-img">
                    <img src="<?php echo e(asset('upload/roomimg/'.$item->image)); ?>" alt="<?php echo e($item->type->name ?? 'Room'); ?>" loading="lazy">
                </div>
                <div class="rd-other-card-body">
                    <div class="rd-other-card-name"><?php echo e($item->type->name ?? 'Room'); ?></div>
                    <div class="rd-other-card-price">$ <?php echo e(number_format($item->price, 0)); ?> / <?php echo e($isHall ? 'event' : 'night'); ?></div>
                    <div class="rd-other-card-meta">
                        <?php if($item->room_capacity): ?> Up to <?php echo e($item->room_capacity); ?> guests <?php endif; ?>
                        <?php if($item->bed_style): ?> &middot; <?php echo e($item->bed_style); ?> <?php endif; ?>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>
</div>


<div id="lightbox" class="rd-lightbox" role="dialog" aria-modal="true" aria-label="Image viewer">
    <span class="rd-lb-badge"><span id="lb-idx">1</span> / <?php echo e(count($images)); ?></span>
    <button class="rd-lb-close" id="lb-close" aria-label="Close lightbox">&times;</button>
    <button class="rd-lb-nav rd-lb-prev" id="lb-prev" aria-label="Previous">&#10094;</button>
    <button class="rd-lb-nav rd-lb-next" id="lb-next" aria-label="Next">&#10095;</button>
    <img id="lb-img" src="" alt="Zoomed photo">
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var photos = <?php echo json_encode($images, 15, 512) ?>;
    var idx = 0;
    var lbOpen = false;

    var mainImg  = document.getElementById('main-feat-img');
    var badge    = document.getElementById('curr-idx');
    var thumbs   = document.querySelectorAll('.rd-thumb-item');
    var strip    = document.getElementById('thumb-strip');
    var btnPrev  = document.getElementById('btn-prev');
    var btnNext  = document.getElementById('btn-next');
    var lb       = document.getElementById('lightbox');
    var lbImg    = document.getElementById('lb-img');
    var lbBadge  = document.getElementById('lb-idx');
    var lbClose  = document.getElementById('lb-close');
    var lbPrev   = document.getElementById('lb-prev');
    var lbNext   = document.getElementById('lb-next');

    function goTo(n) {
        if (n < 0) n = photos.length - 1;
        if (n >= photos.length) n = 0;
        idx = n;
        mainImg.classList.add('is-fading');
        setTimeout(function () { mainImg.src = photos[idx]; mainImg.classList.remove('is-fading'); }, 200);
        badge.textContent = idx + 1;
        thumbs.forEach(function (t, i) {
            t.classList.toggle('is-active', i === idx);
            if (i === idx) scrollThumb(t);
        });
        if (lbOpen) {
            lbImg.classList.add('is-fading');
            setTimeout(function () { lbImg.src = photos[idx]; lbImg.classList.remove('is-fading'); }, 150);
            lbBadge.textContent = idx + 1;
        }
    }

    function scrollThumb(t) {
        var sl = strip.scrollLeft, sw = strip.clientWidth, tl = t.offsetLeft, tw = t.offsetWidth;
        if (tl < sl + 16) strip.scrollTo({ left: tl - 16, behavior: 'smooth' });
        else if (tl + tw > sl + sw - 16) strip.scrollTo({ left: tl + tw - sw + 16, behavior: 'smooth' });
    }

    btnNext.addEventListener('click', function () { goTo(idx + 1); });
    btnPrev.addEventListener('click', function () { goTo(idx - 1); });
    thumbs.forEach(function (t) { t.addEventListener('click', function () { goTo(+this.dataset.index); }); });

    /* Open lightbox */
    function openLightbox() {
        lbImg.src = photos[idx]; lbBadge.textContent = idx + 1;
        lb.classList.add('is-open'); document.body.style.overflow = 'hidden'; lbOpen = true;
    }
    document.getElementById('view-gallery-btn').addEventListener('click', function (e) { e.stopPropagation(); openLightbox(); });
    document.getElementById('gallery-main').addEventListener('click', function (e) {
        if (e.target.closest('.rd-nav-btn') || e.target.closest('.rd-view-gallery-btn')) return;
        openLightbox();
    });

    function closeLightbox() { lb.classList.remove('is-open'); document.body.style.overflow = ''; lbOpen = false; }
    lbClose.addEventListener('click', closeLightbox);
    lb.addEventListener('click', function (e) { if (e.target === lb) closeLightbox(); });
    lbNext.addEventListener('click', function (e) { e.stopPropagation(); goTo(idx + 1); });
    lbPrev.addEventListener('click', function (e) { e.stopPropagation(); goTo(idx - 1); });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && lbOpen) closeLightbox();
        if (e.key === 'ArrowRight') goTo(idx + 1);
        if (e.key === 'ArrowLeft') goTo(idx - 1);
    });

    [document.getElementById('gallery-main'), lb].forEach(function (el) {
        var x0 = null;
        el.addEventListener('touchstart', function (e) { x0 = e.changedTouches[0].clientX; }, { passive: true });
        el.addEventListener('touchend', function (e) {
            if (x0 === null) return;
            var dx = e.changedTouches[0].clientX - x0;
            if (Math.abs(dx) > 40) dx < 0 ? goTo(idx + 1) : goTo(idx - 1);
            x0 = null;
        }, { passive: true });
    });

    /* See More Details toggle */
    var seeMoreBtn = document.getElementById('see-more-btn');
    var moreContent = document.getElementById('more-content');
    if (seeMoreBtn && moreContent) {
        seeMoreBtn.addEventListener('click', function () {
            seeMoreBtn.classList.toggle('is-open');
            moreContent.classList.toggle('is-open');
        });
    }

    /* ════════════════════════════════════
       BOOKING LOGIC
    ════════════════════════════════════ */
    var ciField = document.getElementById('check_in');
    var coField = document.getElementById('check_out');
    var roomIdVal = "<?php echo e($roomdetails->id); ?>";

    new Pikaday({ field: ciField, format: 'YYYY-MM-DD', minDate: new Date(), onSelect: function(){ checkDates(); } });
    new Pikaday({ field: coField, format: 'YYYY-MM-DD', minDate: new Date(), onSelect: function(){ checkDates(); } });

    if (ciField.value && coField.value) getAvailability(ciField.value, coField.value, roomIdVal);

    document.getElementById('select_room').addEventListener('change', function(){ checkDates(); });

    function checkDates(){
        if (ciField.value && coField.value) getAvailability(ciField.value, coField.value, roomIdVal);
    }

    function getAvailability(check_in, check_out, room_id){
        var url = "<?php echo e(route('check_room_availability')); ?>" +
            '?room_id=' + encodeURIComponent(room_id) +
            '&check_in=' + encodeURIComponent(check_in) +
            '&check_out=' + encodeURIComponent(check_out);

        fetch(url)
            .then(function(r){ return r.json(); })
            .then(function(data){
                var el = document.querySelector('.available_room');
                el.classList.add('success');
                el.innerHTML = '&#10003; ' + data.available_room + ' <?php echo e($entityLabel); ?>(s) available';
                document.getElementById('available_room').value = data.available_room;
                var btn = document.getElementById('book_now_btn');
                if (btn) btn.disabled = false;
                priceCalculate(data.total_nights);
            });
    }

    function priceCalculate(totalNights){
        var roomPrice  = parseFloat(document.getElementById('room_price').value);
        var discountP  = parseFloat(document.getElementById('discount_p').value);
        var selectRoom = parseInt(document.getElementById('select_room').value);

        var subtotal = roomPrice * totalNights * selectRoom;
        var disc = (discountP / 100) * subtotal;
        var total = subtotal - disc;

        document.querySelector('.t_nights').textContent = totalNights;
        document.querySelector('.t_rooms').textContent = selectRoom;
        document.querySelector('.t_subtotal').textContent = '$ ' + subtotal.toLocaleString();
        var discEl = document.querySelector('.t_discount');
        if (discEl) discEl.textContent = '-$ ' + disc.toLocaleString();
        document.querySelector('.t_g_total').textContent = '$ ' + total.toLocaleString();
        document.getElementById('pricing_table').style.display = '';
    }

    document.getElementById('bk_form').addEventListener('submit', function(e){
        var avRoom     = parseInt(document.getElementById('available_room').value);
        var selectRoom = parseInt(document.getElementById('select_room').value);
        if (selectRoom > avRoom){
            e.preventDefault();
            alert('Sorry, only ' + avRoom + ' <?php echo e($entityLabel); ?>(s) available. Please select fewer.');
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\htdocs\lucerna\resources\views/frontend/room/room_details.blade.php ENDPATH**/ ?>