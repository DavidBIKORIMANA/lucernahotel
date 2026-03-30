

<?php $__env->startSection('title',        'Lucerna Kabgayi HÃ´tel â€” Rwanda\'s Iconic Destination'); ?>
<?php $__env->startSection('meta_description', 'A world-class sanctuary rooted in Catholic hospitality â€” luxury rooms, fine dining, and landmark events in the heart of Rwanda.'); ?>

<?php $__env->startSection('styles'); ?>

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   HERO
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.hero {
    position:relative; height:80vh; min-height:540px;
    overflow:hidden; display:flex; align-items:center; justify-content:center;
}
.hero-slides  { position:absolute; inset:0; }
.hero-slide   { position:absolute; inset:0; opacity:0; transition:opacity 1.8s cubic-bezier(.4,0,.2,1); }
.hero-slide.active { opacity:1; }
.hero-slide img {
    width:100%; height:100%; object-fit:cover;
    transform:scale(1.05); transition:transform 10s ease;
}
.hero-slide.active img { transform:scale(1); }
.hero-overlay {
    position:absolute; inset:0;
    background:
        linear-gradient(to bottom, rgba(7,22,38,.45) 0%, rgba(7,22,38,.05) 35%, rgba(7,22,38,.35) 75%, rgba(7,22,38,.7) 100%);
}

.hero-content {
    position:relative; z-index:3;
    text-align:center; padding:0 20px 60px;
    max-width:820px; margin:0 auto;
}
.hero-eyebrow {
    font-family:var(--f-body); font-size:12px; font-weight:600;
    letter-spacing:.28em; text-transform:uppercase;
    color:var(--white); display:block; margin-bottom:16px;
    text-shadow:0 1px 6px rgba(0,0,0,.2);
    opacity:0; animation:fu .85s .2s var(--ease) forwards;
}
.hero-title {
    font-family:var(--f-head);
    font-size:clamp(34px,5.5vw,68px); font-weight:500;
    line-height:1.08; color:var(--white); margin-bottom:18px;
    text-shadow:0 2px 20px rgba(0,0,0,.3);
    opacity:0; animation:fu 1s .4s var(--ease) forwards;
}
.hero-title em { font-style:italic; font-weight:400; }
.hero-sub {
    font-family:var(--f-body); font-size:16px; font-weight:400; line-height:1.75;
    color:rgba(255,255,255,.85); max-width:520px; margin:0 auto 32px;
    text-shadow:0 1px 8px rgba(0,0,0,.2);
    opacity:0; animation:fu 1s .6s var(--ease) forwards;
}
.hero-actions {
    display:flex; gap:12px; align-items:center; justify-content:center; flex-wrap:wrap;
    opacity:0; animation:fu 1s .8s var(--ease) forwards;
}
@keyframes fu { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }

/* Slide dots */
.hero-dots {
    position:absolute; bottom:108px; left:50%; transform:translateX(-50%);
    z-index:4; display:flex; gap:7px;
}
.hero-dot { width:26px; height:2px; background:rgba(255,255,255,.3); border:none; cursor:pointer; transition:all .35s; border-radius:1px; }
.hero-dot.active { background:var(--brand-light); width:48px; }

/* Stats bar */
.hero-stats {
    position:absolute; bottom:0; left:0; right:0; z-index:4;
    background-image:linear-gradient(180deg,#0455b0 0%,#034ea2 100%);
    border-top:1px solid rgba(255,255,255,.1);
    display:grid; grid-template-columns:repeat(4,1fr);
}
.hstat { padding:18px 32px; text-align:center; border-right:1px solid rgba(255,255,255,.1); }
.hstat:last-child { border-right:none; }
.hstat-num { font-family:var(--f-head); font-size:28px; font-weight:400; color:var(--white); line-height:1; margin-bottom:4px; }
.hstat-lbl { font-family:var(--f-body); font-size:11px; font-weight:500; letter-spacing:.16em; text-transform:uppercase; color:var(--brand-pale); }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   BOOKING BAR
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.booking-section {
    padding:48px 48px 56px;
    background:var(--off-white);
}
.booking-section-inner {
    max-width:1280px; margin:0 auto;
}
.booking-section-header {
    display:flex; justify-content:space-between; align-items:flex-end;
    margin-bottom:28px;
}
.booking-section-title {
    font-family:var(--f-head); font-size:32px; font-weight:400;
    font-style:italic; color:var(--navy);
}
.booking-section-sub {
    font-family:var(--f-body); font-size:13px; color:var(--soft);
    letter-spacing:.03em;
}
.booking-bar {
    background:var(--white);
    box-shadow:0 4px 28px rgba(12,36,64,.1);
    border-bottom:4px solid var(--brand);
    border-radius:4px;
    overflow:hidden;
}
.booking-bar-inner {
    display:flex; align-items:stretch;
}
.bfield {
    flex:1; padding:24px 28px; border-right:1px solid rgba(12,77,162,.08);
    display:flex; flex-direction:column; justify-content:center;
    transition:background .2s;
}
.bfield:hover,.bfield:focus-within { background:rgba(12,77,162,.04); }
.bfield label {
    font-family:var(--f-body); font-size:12px; font-weight:700;
    letter-spacing:.2em; text-transform:uppercase; color:var(--brand);
    margin-bottom:6px; display:block;
}
.bfield input,.bfield select {
    font-family:var(--f-head); font-size:19px; font-weight:400;
    color:var(--navy); background:transparent; border:none; outline:none;
    appearance:none; width:100%; cursor:pointer;
}
.bfield input::placeholder { color:rgba(12,35,64,.3); font-style:italic; }
.bfield select option { background:var(--white); }
.booking-btn {
    background:var(--brand); border:none; padding:0 52px;
    font-family:var(--f-body); font-size:15px; font-weight:700;
    letter-spacing:.14em; text-transform:uppercase; color:var(--white);
    cursor:pointer; white-space:nowrap; transition:all .3s;
    min-width:210px;
}
.booking-btn:hover { background:var(--brand-light); box-shadow:inset 0 0 0 200px rgba(255,255,255,.08); }

/* Hotel identity strip above booking bar */
.hotel-identity-strip {
    background:var(--white); border-bottom:1px solid rgba(12,77,162,.06);
    padding:14px 0;
    box-shadow:0 1px 0 rgba(12,77,162,.06);
    border-radius:4px 4px 0 0;
}
.hotel-identity-inner {
    max-width:1280px; margin:0 auto; padding:0 28px;
    display:flex; align-items:center; justify-content:space-between;
}
.hotel-identity-left { display:flex; align-items:center; gap:12px; }
.hotel-identity-name {
    font-family:var(--f-body); font-size:13.5px; font-weight:600;
    color:var(--ink); letter-spacing:.01em;
}
.hotel-identity-rating {
    display:flex; align-items:center; gap:8px;
}
.hi-dots { display:flex; gap:3px; }
.hi-dot { width:9px; height:9px; border-radius:50%; background:var(--brand); }
.hi-dot.half { background:linear-gradient(90deg,var(--brand) 50%,rgba(12,77,162,.15) 50%); }
.hi-score { font-family:var(--f-body); font-size:12.5px; font-weight:600; color:var(--ink); }
.hi-reviews { font-family:var(--f-body); font-size:11.5px; color:var(--brand); text-decoration:underline; cursor:pointer; }
.hotel-identity-right { display:flex; gap:22px; align-items:center; }
.hi-map { font-family:var(--f-body); font-size:12.5px; font-weight:600; letter-spacing:.06em; text-transform:uppercase; color:var(--brand); text-decoration:none; display:flex; align-items:center; gap:6px; transition:color .2s; }
.hi-map:hover { color:var(--brand-light); }
.hi-phone { font-family:var(--f-body); font-size:12.5px; font-weight:600; letter-spacing:.06em; text-transform:uppercase; color:var(--brand); text-decoration:none; display:flex; align-items:center; gap:6px; transition:color .2s; }
.hi-phone:hover { color:var(--brand-light); }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   ABOUT
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.about-section { padding:72px 48px; background:var(--white); }
.about-inner {
    max-width:1280px; margin:0 auto;
    display:grid; grid-template-columns:1fr 1fr; gap:64px; align-items:center;
}
.about-img-wrap { position:relative; }
.about-img-main { width:100%; height:460px; object-fit:cover; display:block; }
.about-img-bar  { position:absolute; bottom:0; left:0; right:0; height:5px; background:var(--brand); }
.about-img-badge {
    position:absolute; bottom:24px; right:-22px; z-index:2;
    background:var(--navy); padding:22px 26px; text-align:center;
    box-shadow:0 8px 28px rgba(7,22,38,.22);
}
.aib-num { font-family:var(--f-head); font-size:34px; font-weight:400; color:var(--brand-pale); line-height:1; }
.aib-lbl { font-family:var(--f-body); font-size:9px; font-weight:600; letter-spacing:.14em; text-transform:uppercase; color:rgba(255,255,255,.45); margin-top:4px; }

.about-text .lead { margin-bottom:14px; }
.mv-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin:22px 0 28px; }
.mv-card {
    padding:20px 18px; background:var(--off-white);
    border-top:3px solid var(--brand); transition:all .3s;
}
.mv-card:hover { background:var(--white); box-shadow:0 6px 24px rgba(12,36,64,.07); transform:translateY(-2px); }
.mv-icon { color:var(--brand); margin-bottom:10px; }
.mv-label { font-family:var(--f-head); font-size:19px; font-weight:600; font-style:italic; color:var(--navy); margin-bottom:6px; }
.mv-text  { font-family:var(--f-body); font-size:14.5px; line-height:1.7; color:var(--mid); }

.about-values { display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:26px; }
.about-val {
    padding:14px 16px; background:var(--off-white);
    border-left:3px solid var(--brand); transition:all .25s;
}
.about-val:hover { background:var(--cream); border-color:var(--navy); }
.av-name { font-family:var(--f-head); font-size:19.5px; font-weight:400; font-style:italic; color:var(--navy); margin-bottom:4px; }
.av-text { font-family:var(--f-body); font-size:14px; color:var(--soft); line-height:1.6; }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   ROOMS
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.rooms-section {
    background: linear-gradient(139deg,#0c62c3 14.24%,#034ea2 75.61%); padding:48px 48px;
    position:relative;
}
.rooms-section::before { content:''; position:absolute; top:0; left:0; right:0; height:4px; background:var(--brand); }
.rooms-inner { max-width:1280px; margin:0 auto; }
.rooms-header { display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:24px; }

.rooms-grid {
    display:grid; grid-template-columns:repeat(2,1fr);
    gap:18px;
}
.room-card {
    display:flex; overflow:hidden; background:var(--navy);
    cursor:pointer; text-decoration:none; height:300px;
    transition:all .4s var(--ease);
}
.room-card:hover { box-shadow:0 16px 48px rgba(0,0,0,.25); transform:translateY(-3px); }
.room-card-img { width:48%; flex-shrink:0; overflow:hidden; position:relative; }
.room-img { width:100%; height:100%; object-fit:cover; object-position:center center; display:block; transition:transform .75s var(--ease); }
.room-card:hover .room-img { transform:scale(1.06); }
.room-info {
    flex:1; padding:28px 28px; display:flex; flex-direction:column; justify-content:center;
    position:relative;
}
.room-type {
    font-family:var(--f-body); font-size:11px; font-weight:600;
    letter-spacing:.25em; text-transform:uppercase;
    color:var(--brand-pale); margin-bottom:8px;
}
.room-name {
    font-family:var(--f-head); font-size:28px; font-weight:400;
    font-style:italic; color:var(--white); margin-bottom:10px;
}
.room-short-desc {
    font-family:var(--f-body); font-size:13px; color:rgba(255,255,255,.5);
    line-height:1.7; margin-bottom:14px;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
}
.room-meta {
    display:flex; gap:16px; margin-bottom:16px; flex-wrap:wrap;
}
.room-meta-item {
    font-family:var(--f-body); font-size:11px; color:rgba(255,255,255,.45);
    display:flex; align-items:center; gap:4px;
}
.room-meta-item svg { width:13px; height:13px; stroke:var(--brand-pale); flex-shrink:0; }
.room-meta-item strong { color:rgba(255,255,255,.7); font-weight:600; }
.room-footer { display:flex; justify-content:space-between; align-items:center; margin-top:auto; }
.room-price { font-family:var(--f-head); font-size:24px; font-weight:600; color:var(--brand-pale); }
.room-price span { font-family:var(--f-body); font-size:13px; color:rgba(255,255,255,.3); margin-left:2px; }
.room-arrow { width:32px; height:32px; border:1px solid rgba(12,77,162,.3); display:flex; align-items:center; justify-content:center; color:var(--brand-pale); font-size:14px; opacity:0; transition:all .3s; }
.room-card:hover .room-arrow { opacity:1; background:rgba(12,77,162,.12); }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   HALLS â€” Events & Conferences
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.halls-section {
    background:var(--navy); padding:64px 48px;
    position:relative; overflow:hidden;
}
.halls-section::before {
    content:''; position:absolute; top:0; left:0; right:0; height:4px;
    background:linear-gradient(90deg,var(--brand),var(--gold));
}
.halls-inner { max-width:1280px; margin:0 auto; }
.halls-header { display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:28px; }
.halls-scroll-wrap { position:relative; }
.halls-scroll {
    display:flex; flex-direction:column; gap:20px;
}
.hall-card {
    display:flex; overflow:hidden; background:#0a1e36;
    text-decoration:none; height:320px;
    transition:all .4s var(--ease);
}
.hall-card.single { max-width:900px; margin:0 auto; }
.hall-card:hover { box-shadow:0 16px 48px rgba(0,0,0,.3); transform:translateY(-3px); }
.hall-card-img {
    width:50%; flex-shrink:0; overflow:hidden; position:relative;
}
.hall-img {
    width:100%; height:100%; object-fit:cover; object-position:center center; display:block;
    transition:transform .75s var(--ease);
}
.hall-card:hover .hall-img { transform:scale(1.06); }
.hall-card-body {
    flex:1; padding:32px 36px; display:flex; flex-direction:column; justify-content:center;
    position:relative;
}
.hall-label {
    font-family:var(--f-body); font-size:11px; font-weight:600;
    letter-spacing:.25em; text-transform:uppercase;
    color:var(--gold); margin-bottom:8px;
}
.hall-name {
    font-family:var(--f-head); font-size:30px; font-weight:400;
    font-style:italic; color:var(--white); margin-bottom:10px;
}
.hall-desc {
    font-family:var(--f-body); font-size:14px; color:rgba(255,255,255,.55);
    line-height:1.7; margin-bottom:16px;
}
.hall-meta {
    display:flex; gap:20px; margin-bottom:18px; flex-wrap:wrap;
}
.hall-meta-item {
    font-family:var(--f-body); font-size:12px; color:rgba(255,255,255,.45);
    display:flex; align-items:center; gap:5px;
}
.hall-meta-item svg { width:14px; height:14px; stroke:var(--gold); flex-shrink:0; }
.hall-meta-item strong { color:rgba(255,255,255,.75); font-weight:600; }
.hall-price {
    font-family:var(--f-head); font-size:24px; font-weight:600; color:var(--brand-pale);
}
.hall-price span { font-family:var(--f-body); font-size:13px; color:rgba(255,255,255,.3); margin-left:2px; }
.hall-arrow {
    position:absolute; top:20px; right:20px;
    width:36px; height:36px; border:1px solid rgba(255,255,255,.12);
    display:flex; align-items:center; justify-content:center;
    color:var(--white); font-size:16px;
    opacity:0; transition:all .3s;
}
.hall-card:hover .hall-arrow { opacity:1; background:rgba(255,255,255,.08); }
/* Scroll indicators */
.halls-scroll-hint {
    display:flex; justify-content:center; gap:8px; margin-top:18px;
}
.halls-dot {
    width:24px; height:3px; border-radius:2px;
    background:rgba(255,255,255,.15); transition:all .3s;
}
.halls-dot.active { width:40px; background:var(--brand-pale); }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   AMENITIES (Marriott-style grid)
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.amenities-section { background:var(--off-white); padding:72px 48px; }
.amenities-inner { max-width:1280px; margin:0 auto; }
.amenities-header { text-align:center; max-width:560px; margin:0 auto 44px; }
.amenities-header .bar.center { margin-bottom:16px; }
.amenities-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; }
.amenity-card {
    background:var(--white); padding:36px 24px; text-align:center;
    border:1px solid rgba(12,36,64,.06); transition:all .35s;
    position:relative; overflow:hidden;
}
.amenity-card::after { content:''; position:absolute; bottom:0; left:0; right:0; height:3px; background:var(--brand); transform:scaleX(0); transition:transform .35s; }
.amenity-card:hover { transform:translateY(-4px); box-shadow:0 12px 36px rgba(12,36,64,.07); }
.amenity-card:hover::after { transform:scaleX(1); }
.amenity-icon-wrap { width:56px; height:56px; margin:0 auto 18px; background:rgba(12,77,162,.07); border-radius:50%; display:flex; align-items:center; justify-content:center; transition:all .35s; }
.amenity-card:hover .amenity-icon-wrap { background:var(--brand); }
.amenity-icon { font-size:20px; color:var(--brand); transition:color .35s; }
.amenity-card:hover .amenity-icon { color:var(--white); }
.amenity-name { font-family:var(--f-head); font-size:24px; font-weight:400; font-style:italic; color:var(--navy); margin-bottom:12px; }
.amenity-desc { font-family:var(--f-body); font-size:14.5px; line-height:1.7; color:var(--soft); }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   FEATURED AMENITIES ON-SITE (Marriott screenshot style)
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.featured-amenities {
    background:var(--white); padding:60px 48px;
    border-top:1px solid rgba(12,77,162,.07);
}
.featured-amenities-inner { max-width:1280px; margin:0 auto; }
.fa-header { margin-bottom:32px; }
.fa-title {
    font-family:var(--f-body); font-size:16px; font-weight:700;
    letter-spacing:.22em; text-transform:uppercase;
    color:var(--ink); margin-bottom:0;
}
.fa-grid {
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:0;
    border:1px solid rgba(12,36,64,.08);
}
.fa-item {
    padding:24px 24px; display:flex; align-items:flex-start; gap:14px;
    border-right:1px solid rgba(12,36,64,.08);
    border-bottom:1px solid rgba(12,36,64,.08);
    transition:background .2s;
}
.fa-item:hover { background:rgba(12,77,162,.03); }
.fa-item:nth-child(4n) { border-right:none; }
.fa-item-icon {
    width:34px; height:34px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    color:var(--brand); font-size:18px; margin-top:1px;
}
.fa-item-icon svg { width:24px; height:24px; stroke:var(--brand); fill:none; stroke-width:1.5; }
.fa-item-text { flex:1; }
.fa-item-name {
    font-family:var(--f-body); font-size:18px; font-weight:600; color:var(--ink);
    text-decoration:none; transition:color .2s;
    display:block;
}
.fa-item-name:hover,.fa-item-name.linked { color:var(--brand); text-decoration:underline; cursor:pointer; }
.fa-item-note { font-family:var(--f-body); font-size:15px; color:var(--soft); margin-top:3px; }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   HOTEL INFORMATION (Marriott style)
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.hotel-info-section {
    background:var(--off-white); padding:52px 48px;
    border-top:1px solid rgba(12,77,162,.07);
}
.hotel-info-inner { max-width:1280px; margin:0 auto; }
.hi-section-title {
    font-family:var(--f-body); font-size:16px; font-weight:700;
    letter-spacing:.22em; text-transform:uppercase;
    color:var(--ink); margin-bottom:28px;
    padding-bottom:12px; border-bottom:2px solid rgba(12,77,162,.1);
}
.hi-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:28px; }
.hi-group-title { font-family:var(--f-body); font-size:14px; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:var(--mid); margin-bottom:14px; }
.hi-row { display:flex; gap:10px; align-items:flex-start; margin-bottom:12px; }
.hi-row-icon { width:22px; height:22px; flex-shrink:0; color:var(--brand); margin-top:2px; }
.hi-row-icon svg { width:20px; height:20px; stroke:var(--brand); fill:none; stroke-width:1.5; }
.hi-row-body { flex:1; }
.hi-row-title { font-family:var(--f-body); font-size:17px; font-weight:600; color:var(--ink); margin-bottom:2px; }
.hi-row-detail { font-family:var(--f-body); font-size:15px; color:var(--soft); line-height:1.6; }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   DINING
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.dining-section { display:grid; grid-template-columns:1fr 1fr; min-height:520px; }
.dining-img-wrap { position:relative; overflow:hidden; }
.dining-img { width:100%; height:100%; min-height:520px; object-fit:cover; display:block; transition:transform 8s ease; }
.dining-img-wrap:hover .dining-img { transform:scale(1.03); }
.dining-img-bar { position:absolute; bottom:0; left:0; right:0; height:5px; background:var(--brand); }
.dining-content {
    background:var(--navy); padding:64px 52px;
    display:flex; flex-direction:column; justify-content:center;
}
.dining-content .lead.on-dark { margin-bottom:28px; }
.dining-items { margin-bottom:28px; }
.dining-item { display:flex; justify-content:space-between; align-items:center; padding:13px 0; border-bottom:1px solid rgba(255,255,255,.06); transition:padding .25s; }
.dining-item:last-child { border-bottom:none; }
.dining-item:hover { padding-left:5px; }
.dining-item-name { font-family:var(--f-head); font-size:20px; font-weight:400; font-style:italic; color:rgba(255,255,255,.85); transition:color .25s; }
.dining-item:hover .dining-item-name { color:var(--brand-pale); }
.dining-item-time { font-family:var(--f-body); font-size:12px; font-weight:500; color:var(--brand-pale); white-space:nowrap; }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   EVENTS
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.events-section { background:var(--white); padding:72px 48px; }
.events-inner { max-width:1280px; margin:0 auto; display:grid; grid-template-columns:1fr 1fr; gap:64px; align-items:center; }
.events-img-wrap { position:relative; }
.events-img { width:100%; height:480px; object-fit:cover; display:block; }
.events-img-bar { position:absolute; top:0; left:0; right:0; height:5px; background:var(--brand); }
.events-badge { position:absolute; bottom:-20px; right:28px; background:var(--brand); color:var(--white); padding:20px 28px; text-align:center; box-shadow:0 8px 28px rgba(12,77,162,.28); }
.eb-num { font-family:var(--f-head); font-size:38px; font-weight:400; line-height:1; }
.eb-lbl { font-family:var(--f-body); font-size:9px; font-weight:600; letter-spacing:.14em; text-transform:uppercase; color:rgba(255,255,255,.7); margin-top:3px; }
.events-content .lead { margin-bottom:14px; }
.events-features { display:grid; grid-template-columns:1fr 1fr; gap:10px; margin:20px 0 28px; }
.events-feat { padding:16px 14px; border:1px solid rgba(12,36,64,.09); border-left:3px solid var(--brand); transition:all .25s; }
.events-feat:hover { border-color:var(--brand); background:rgba(12,77,162,.03); transform:translateX(3px); }
.ef-name { font-family:var(--f-head); font-size:17px; font-weight:400; font-style:italic; color:var(--navy); margin-bottom:4px; }
.ef-desc { font-family:var(--f-body); font-size:13.5px; color:var(--soft); line-height:1.55; }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   TESTIMONIALS
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.testi-section { background:var(--navy); padding:64px 0; overflow:hidden; }
.testi-inner { max-width:1400px; margin:0 auto; padding:0 48px; }
.testi-header { text-align:center; margin-bottom:36px; }
.testi-grid {
    display:flex; gap:18px;
    overflow-x:auto; scroll-snap-type:x mandatory; scroll-behavior:smooth;
    padding:4px 0 18px;
    scrollbar-width:thin; scrollbar-color:var(--brand) rgba(255,255,255,.07);
}
.testi-grid::-webkit-scrollbar { height:3px; }
.testi-grid::-webkit-scrollbar-track { background:rgba(255,255,255,.05); }
.testi-grid::-webkit-scrollbar-thumb { background:var(--brand); border-radius:2px; }
.testi-card {
    flex:0 0 320px; scroll-snap-align:start;
    background:rgba(255,255,255,.04); border:1px solid rgba(12,77,162,.16);
    padding:32px 26px; transition:all .35s; position:relative;
}
.testi-card::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; background:var(--brand); transform:scaleX(0); transition:transform .4s; }
.testi-card:hover { background:rgba(255,255,255,.07); border-color:rgba(12,77,162,.38); transform:translateY(-3px); }
.testi-card:hover::before { transform:scaleX(1); }
.testi-quote { font-family:var(--f-head); font-size:44px; font-weight:400; color:var(--brand); line-height:.6; margin-bottom:16px; opacity:.45; }
.testi-text { font-family:var(--f-head); font-size:17px; font-weight:400; font-style:italic; line-height:1.75; color:rgba(255,255,255,.62); margin-bottom:20px; }
.testi-stars { font-size:13px; letter-spacing:3px; color:var(--gold); margin-bottom:12px; }
.testi-author { font-family:var(--f-body); font-size:14px; font-weight:600; color:var(--white); }
.testi-location { font-family:var(--f-body); font-size:12px; color:var(--brand-pale); margin-top:2px; }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   CONTACT
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
.contact-section { background:var(--off-white); padding:72px 48px; }
.contact-inner { max-width:1280px; margin:0 auto; display:grid; grid-template-columns:1fr 1.1fr; gap:64px; align-items:start; }
.contact-left .lead { margin-bottom:32px; }
.contact-details { display:flex; flex-direction:column; gap:18px; }
.cd-item { display:flex; gap:13px; align-items:flex-start; }
.cd-icon { width:42px; height:42px; flex-shrink:0; background:var(--brand); display:flex; align-items:center; justify-content:center; color:var(--white); font-size:15px; border-radius:2px; }
.cd-label { font-family:var(--f-body); font-size:12px; font-weight:600; letter-spacing:.18em; text-transform:uppercase; color:var(--brand); margin-bottom:3px; }
.cd-val { font-family:var(--f-head); font-size:19px; font-weight:400; font-style:italic; color:var(--navy); }
.cd-val a { color:inherit; text-decoration:none; transition:color .2s; }
.cd-val a:hover { color:var(--brand); }
.map-wrap { margin-top:24px; overflow:hidden; }
.map-wrap iframe { display:block; width:100%; height:240px; border:0; }

.contact-form-card {
    background:var(--white); border-top:4px solid var(--brand);
    padding:40px 34px; box-shadow:0 4px 28px rgba(12,36,64,.06);
}
.cfc-title { font-family:var(--f-head); font-size:26px; font-weight:400; font-style:italic; color:var(--navy); margin-bottom:24px; }
.contact-form { display:flex; flex-direction:column; gap:15px; }
.form-field label { display:block; font-family:var(--f-body); font-size:10px; font-weight:600; letter-spacing:.18em; text-transform:uppercase; color:var(--brand); margin-bottom:5px; }
.form-field input,.form-field textarea {
    width:100%; background:var(--off-white); border:1px solid rgba(12,36,64,.1);
    border-radius:2px; outline:none;
    font-family:var(--f-head); font-size:16px; font-weight:400; font-style:italic;
    color:var(--navy); padding:11px 13px; transition:border-color .2s,background .2s;
}
.form-field input:focus,.form-field textarea:focus { border-color:var(--brand); background:var(--white); box-shadow:0 0 0 3px rgba(12,77,162,.07); }
.form-field textarea { resize:none; height:88px; }
.form-field input::placeholder,.form-field textarea::placeholder { color:rgba(12,35,64,.28); font-style:italic; }
.form-row { display:grid; grid-template-columns:1fr 1fr; gap:15px; }
.form-submit {
    width:100%; background:var(--brand); border:none; padding:15px;
    font-family:var(--f-body); font-size:13px; font-weight:600; letter-spacing:.14em;
    text-transform:uppercase; color:var(--white); cursor:pointer; border-radius:2px;
    margin-top:4px; transition:background .25s,transform .25s;
}
.form-submit:hover { background:var(--brand-light); transform:translateY(-1px); box-shadow:0 5px 16px rgba(12,77,162,.26); }

/* â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
   RESPONSIVE
â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• */
@media(max-width:1200px){
    .about-section,.rooms-section,.amenities-section,.featured-amenities,
    .hotel-info-section,.events-section,.testi-section .testi-inner,
    .contact-section,.halls-section { padding-left:28px; padding-right:28px; }
    .dining-content { padding:52px 36px; }
    .hero-stat { padding:16px 20px; }
    .about-img-badge { right:-10px; }
}
@media(max-width:1024px){
    .rooms-grid { grid-template-columns:1fr 1fr; }
    .amenities-grid { grid-template-columns:repeat(2,1fr); }
    .fa-grid { grid-template-columns:repeat(2,1fr); }
    .fa-item:nth-child(2n) { border-right:none; }
    .hero-stats { grid-template-columns:repeat(2,1fr); }
    .hstat:nth-child(2) { border-right:none; }
    .hstat:nth-child(3),.hstat:nth-child(4) { border-top:1px solid rgba(255,255,255,.06); }
    .hi-grid { grid-template-columns:1fr 1fr; }
    .about-inner,.events-inner,.contact-inner { gap:44px; }
}
@media(max-width:960px){
    .booking-bar-inner { flex-wrap:wrap; }
    .bfield { flex:1 1 45%; min-width:200px; border-right:none; border-bottom:1px solid rgba(12,77,162,.07); }
    .booking-btn { flex:1 1 100%; }
    .about-inner { grid-template-columns:1fr; gap:36px; }
    .dining-section { grid-template-columns:1fr; }
    .dining-img { min-height:300px; }
    .dining-content { padding:44px 28px; }
    .events-inner { grid-template-columns:1fr; gap:32px; }
    .contact-inner { grid-template-columns:1fr; gap:32px; }
}
@media(max-width:768px){
    .hero { min-height:420px; }
    .hero-title { font-size:clamp(28px,9vw,44px); }
    .hero-sub { font-size:14px; }
    .hero-dots { bottom:100px; }
    .hero-stats { grid-template-columns:repeat(2,1fr); }
    .hstat { padding:14px; }
    .hotel-identity-strip { display:none; }
    .booking-section { padding:32px 14px 40px; }
    .booking-section-header { flex-direction:column; align-items:flex-start; gap:4px; margin-bottom:20px; }
    .booking-bar-inner { flex-direction:column; }
    .bfield { border-right:none; border-bottom:1px solid rgba(12,77,162,.07); padding:18px 20px; }
    .booking-btn { padding:20px; min-width:0; width:100%; }
    .about-inner,.events-inner,.contact-inner { grid-template-columns:1fr; gap:32px; }
    .about-img-main { height:300px; }
    .about-img-badge { display:none; }
    .mv-grid,.about-values,.events-features { grid-template-columns:1fr; }
    .rooms-grid { grid-template-columns:1fr; }
    .room-card { height:260px; }
    .room-card-img { width:42%; }
    .room-info { padding:22px 20px; }
    .room-name { font-size:22px; }
    .amenities-grid { grid-template-columns:1fr; }
    .fa-grid { grid-template-columns:1fr; }
    .fa-item:nth-child(n) { border-right:none; }
    .hi-grid { grid-template-columns:1fr; }
    .dining-section { grid-template-columns:1fr; }
    .dining-img { min-height:260px; }
    .dining-content { padding:40px 24px; }
    .contact-form-card { padding:26px 18px; }
    .form-row { grid-template-columns:1fr; }
    .about-section,.rooms-section,.amenities-section,.featured-amenities,
    .hotel-info-section,.events-section,.contact-section,.halls-section { padding:48px 14px; }
    .hall-card { height:240px; }
    .hall-card-img { width:40%; }
    .hall-card-body { padding:24px 20px; }
    .hall-name { font-size:26px; }
    .testi-inner { padding:0 14px; }
    .testi-card { flex:0 0 250px; padding:24px 18px; }
    .testi-grid { scroll-padding:0 14px; }
    .events-img { height:260px; }
    .events-badge { bottom:-14px; right:14px; padding:14px 20px; }
    .eb-num { font-size:28px; }
}

/* â”€â”€ Small phones â”€â”€ */
@media(max-width:480px){
    .hero { height:70vh; min-height:360px; }
    .hero-content { padding:0 14px 50px; }
    .hero-title { font-size:clamp(24px,8vw,34px); margin-bottom:12px; }
    .hero-eyebrow { font-size:10px; letter-spacing:.22em; margin-bottom:10px; }
    .hero-sub { font-size:13px; max-width:280px; margin-bottom:22px; }
    .hero-actions { gap:8px; }
    .hero-actions .btn-blue,.hero-actions .btn-outline-w { width:100%; text-align:center; justify-content:center; }
    .hero-dots { bottom:80px; }
    .hero-dot { width:20px; }
    .hero-dot.active { width:36px; }
    .hero-stats { grid-template-columns:1fr 1fr; }
    .hstat { padding:10px 8px; }
    .hstat-num { font-size:20px; }
    .hstat-lbl { font-size:8px; letter-spacing:.1em; }
    .booking-section { padding:24px 10px 32px; }
    .bfield { padding:14px 16px; }
    .bfield label { font-size:10px; letter-spacing:.14em; }
    .bfield input,.bfield select { font-size:17px; }
    .booking-btn { padding:16px; font-size:13px; letter-spacing:.1em; }
    .about-section,.rooms-section,.amenities-section,.featured-amenities,
    .hotel-info-section,.events-section,.contact-section,.halls-section { padding:36px 10px; }
    .hall-card { height:auto; flex-direction:column; }
    .hall-card-img { width:100%; height:220px; }
    .hall-card-body { padding:24px 20px; }
    .hall-name { font-size:22px; }
    .hall-desc { font-size:13px; }
    .about-img-main { height:220px; }
    .h-section { font-size:clamp(24px,6.5vw,36px); margin-bottom:10px; }
    .eyebrow { font-size:12px; letter-spacing:.18em; }
    .lead { font-size:14px; line-height:1.7; }
    .bar { width:28px; height:2px; }
    .mv-card { padding:16px 14px; }
    .mv-label { font-size:16px; }
    .mv-text { font-size:13px; }
    .about-val { padding:12px 14px; }
    .av-name { font-size:16px; }
    .av-text { font-size:12.5px; }
    .room-card { height:auto; flex-direction:column; }
    .room-card-img { width:100%; height:240px; }
    .room-img { height:100%; }
    .room-info { padding:20px 16px; }
    .room-name { font-size:20px; }
    .room-price { font-size:19px; }
    .amenity-card { padding:24px 16px; }
    .amenity-icon-wrap { width:48px; height:48px; }
    .amenity-name { font-size:19px; }
    .amenity-desc { font-size:13px; }
    .fa-item { padding:14px 16px; gap:10px; }
    .fa-item-name { font-size:13px; }
    .fa-item-note { font-size:11.5px; }
    .hi-row-title { font-size:13px; }
    .hi-row-detail { font-size:12px; }
    .dining-img { min-height:200px; }
    .dining-content { padding:32px 16px; }
    .dining-item-name { font-size:17px; }
    .dining-item-time { font-size:10.5px; }
    .events-img { height:200px; }
    .events-feat { padding:12px 10px; }
    .ef-name { font-size:15px; }
    .ef-desc { font-size:12px; }
    .testi-section { padding:48px 0; }
    .testi-inner { padding:0 10px; }
    .testi-card { flex:0 0 220px; padding:20px 14px; }
    .testi-quote { font-size:36px; margin-bottom:12px; }
    .testi-text { font-size:15px; margin-bottom:16px; }
    .testi-author { font-size:12.5px; }
    .testi-location { font-size:10.5px; }
    .contact-section { padding:36px 10px; }
    .contact-inner { gap:24px; }
    .contact-details { gap:14px; }
    .cd-icon { width:32px; height:32px; font-size:11px; }
    .cd-val { font-size:15px; }
    .cd-label { font-size:9px; }
    .map-wrap iframe { height:180px; }
    .contact-form-card { padding:20px 14px; }
    .cfc-title { font-size:22px; margin-bottom:18px; }
    .form-field label { font-size:9px; }
    .form-field input,.form-field textarea { font-size:15px; padding:9px 10px; }
    .form-submit { padding:13px; font-size:12px; }
    .btn-blue { font-size:10.5px; padding:10px 22px; letter-spacing:.1em; }
    .btn-outline-w { font-size:10.5px; padding:9px 20px; letter-spacing:.1em; }
}

/* â”€â”€ Very small phones (320-360px) â”€â”€ */
@media(max-width:360px){
    .hero { min-height:300px; }
    .hero-title { font-size:22px; }
    .hero-sub { font-size:12px; max-width:240px; }
    .hero-eyebrow { font-size:9px; }
    .hero-stats { grid-template-columns:1fr 1fr; }
    .hstat { padding:8px 6px; }
    .hstat-num { font-size:17px; }
    .hstat-lbl { font-size:7px; }
    .booking-section { padding:20px 8px 28px; }
    .bfield { padding:12px 12px; }
    .bfield input,.bfield select { font-size:14px; }
    .about-section,.rooms-section,.amenities-section,.featured-amenities,
    .hotel-info-section,.events-section,.contact-section,.halls-section { padding:28px 8px; }
    .hall-card-img { height:180px; }
    .hall-name { font-size:20px; }
    .hall-card-body { padding:20px 16px; }
    .about-img-main { height:180px; }
    .h-section { font-size:clamp(22px,5.5vw,28px); }
    .room-card-img { height:200px; }
    .amenity-card { padding:20px 12px; }
    .testi-card { flex:0 0 200px; padding:16px 12px; }
    .testi-text { font-size:14px; }
    .dining-content { padding:24px 12px; }
    .contact-form-card { padding:16px 10px; }
    .map-wrap iframe { height:150px; }
    .cd-val { font-size:14px; }
    .cd-val a { word-break:break-all; }
}

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>


<?php $hero = $homeSections['hero'] ?? null; ?>
<section class="hero">
    <div class="hero-slides">
        <?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="hero-slide <?php echo e($loop->first ? 'active' : ''); ?>"><img src="<?php echo e(asset($slide->image)); ?>" alt="<?php echo e($slide->alt_text); ?>" loading="<?php echo e($loop->first ? 'eager' : 'lazy'); ?>" <?php echo e($loop->first ? 'fetchpriority=high' : ''); ?>></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <span class="hero-eyebrow"><?php echo $hero->eyebrow ?? 'â˜…â˜…â˜… &nbsp;Â·&nbsp; Kabgayi, Rwanda'; ?></span>
        <h1 class="hero-title"><?php echo $hero->title ?? 'The Most <em>Welcoming</em><br>Sanctuary in Rwanda'; ?></h1>
        <p class="hero-sub"><?php echo e($hero->description ?? 'Rooted in Catholic hospitality. Elevated by world-class luxury.'); ?></p>
        <div class="hero-actions">
            <a href="<?php echo e($hero->button_url ?? '#booking'); ?>" class="btn-blue">
                <span><?php echo e($hero->button_text ?? 'Book Now'); ?></span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <a href="#about" class="btn-outline-w">Explore</a>
        </div>
    </div>

    <div class="hero-dots">
        <?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button class="hero-dot <?php echo e($loop->first ? 'active' : ''); ?>" onclick="goSlide(<?php echo e($loop->index); ?>)" aria-label="<?php echo e($loop->iteration); ?>"></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="hero-stats">
        <?php $__currentLoopData = $heroStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="hstat"><div class="hstat-num"><?php echo e($stat->counter_value); ?></div><div class="hstat-lbl"><?php echo e($stat->counter_label); ?></div></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section class="booking-section" id="booking">
    <div class="booking-section-inner">
        

        

        <div class="booking-bar">
    <form method="GET" action="<?php echo e(route('booking.search')); ?>" class="booking-bar-inner" id="bookingForm">
        <div class="bfield">
            <label for="check_in">Check In</label>
            <input type="text" id="check_in" name="check_in" placeholder="Select date" autocomplete="off" readonly required>
        </div>
        <div class="bfield">
            <label for="check_out">Check Out</label>
            <input type="text" id="check_out" name="check_out" placeholder="Select date" autocomplete="off" readonly required>
        </div>
        <div class="bfield">
            <label for="room_type">Category</label>
            <select id="room_type" name="room_type">
                <option value="">All Categories</option>
                <?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($type->id); ?>" data-max="<?php echo e($type->rooms()->where('status',1)->max(\DB::raw('CAST(total_adult AS UNSIGNED)')) ?? 4); ?>"><?php echo e($type->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="bfield">
            <label for="persion">Guests</label>
            <select id="persion" name="persion">
                <option value="1">1 Guest</option>
                <option value="2">2 Guests</option>
                <option value="3">3 Guests</option>
                <option value="4">4 Guests</option>
            </select>
        </div>
        <button type="submit" class="booking-btn">Check Availability</button>
    </form>
        </div>
    </div>
</section>


<?php if(($homeSections['about']->status ?? true)): ?>
<section class="about-section" id="about">
<?php $about = $homeSections['about'] ?? null; ?>
    <div class="about-inner">
        <div class="about-img-wrap reveal">
            <img class="about-img-main" src="<?php echo e(asset($about->image ?? 'frontend/assets/img/about-img.jpg')); ?>" alt="Lucerna interior" loading="lazy">
            <div class="about-img-bar"></div>
            <div class="about-img-badge">
                <div class="aib-num"><?php echo e($about->badge_value ?? '3â˜…'); ?></div>
                <div class="aib-lbl"><?php echo e($about->badge_label ?? 'Hotel'); ?></div>
            </div>
        </div>

        <div class="about-text">
            <span class="eyebrow reveal"><?php echo e($about->eyebrow ?? 'Welcome to Lucerna Kabgayi'); ?></span>
            <div class="bar reveal d1"></div>
            <h2 class="h-section reveal d1"><?php echo $about->title ?? 'A Sanctuary of <em>Hospitality</em> &amp; Grace'; ?></h2>
            <p class="lead reveal d2"><?php echo e($about->description ?? ''); ?></p>

            <div class="mv-grid reveal d3">
                <?php $mission = $homeSections['mission'] ?? null; ?>
                <?php $vision = $homeSections['vision'] ?? null; ?>
                <div class="mv-card">
                    <div class="mv-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="26" height="26"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                    </div>
                    <div class="mv-label"><?php echo e($mission->title ?? 'Our Mission'); ?></div>
                    <p class="mv-text"><?php echo e($mission->description ?? ''); ?></p>
                </div>
                <div class="mv-card">
                    <div class="mv-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="26" height="26"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                    <div class="mv-label"><?php echo e($vision->title ?? 'Our Vision'); ?></div>
                    <p class="mv-text"><?php echo e($vision->description ?? ''); ?></p>
                </div>
            </div>

            <div class="about-values reveal d4">
                <?php $__currentLoopData = $aboutPillars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pillar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="about-val"><div class="av-name"><?php echo e($pillar->name); ?></div><div class="av-text"><?php echo e($pillar->description); ?></div></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <a href="<?php echo e($about->button_url ?? '#contact'); ?>" class="btn-blue reveal d4">
                <span><?php echo e($about->button_text ?? 'Plan Your Stay'); ?></span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if(($homeSections['rooms']->status ?? true)): ?>
<?php $roomsSection = $homeSections['rooms'] ?? null; ?>
<section class="rooms-section" id="rooms">
    <div class="rooms-inner">
        <div class="rooms-header">
            <div>
                <span class="eyebrow light reveal"><?php echo e($roomsSection->eyebrow ?? 'Our Rooms'); ?></span>
                <h2 class="h-section on-dark reveal d1"><?php echo $roomsSection->title ?? 'Comfort & <em>Elegance</em> in Every Room'; ?></h2>
                <p class="lead on-dark reveal d2" style="max-width:440px"><?php echo e($roomsSection->description ?? 'Each room is a carefully composed haven â€” blending Rwandan warmth with world-class luxury.'); ?></p>
            </div>
            <?php if($roomsSection->button_text ?? null): ?>
            <a href="<?php echo e($roomsSection->button_url ?? route('froom.all')); ?>" class="btn-outline-w reveal" style="flex-shrink:0"><?php echo e($roomsSection->button_text); ?></a>
            <?php else: ?>
            <a href="<?php echo e(route('froom.all')); ?>" class="btn-outline-w reveal" style="flex-shrink:0">View All Rooms</a>
            <?php endif; ?>
        </div>
        <div class="rooms-grid">
            <?php $__empty_1 = true; $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php $delay = ['','d1','d2'][$loop->index % 3]; ?>
            <a href="<?php echo e(url('/room/details/'.$room->id)); ?>" class="room-card reveal <?php echo e($delay); ?>" style="text-decoration:none">
                <div class="room-card-img">
                    <img class="room-img" src="<?php echo e(asset('upload/roomimg/'.$room->image)); ?>" alt="<?php echo e($room->type->name ?? 'Room'); ?>" loading="lazy">
                </div>
                <div class="room-info">
                    <div class="room-type">Room</div>
                    <div class="room-name"><?php echo e($room->type->name ?? 'Room'); ?></div>
                    <?php if($room->short_desc): ?>
                    <div class="room-short-desc"><?php echo e($room->short_desc); ?></div>
                    <?php endif; ?>
                    <div class="room-meta">
                        <?php if($room->room_capacity): ?>
                        <span class="room-meta-item">
                            <svg viewBox="0 0 24 24" fill="none"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                            <strong><?php echo e($room->room_capacity); ?></strong> Guests
                        </span>
                        <?php endif; ?>
                        <?php if($room->size): ?>
                        <span class="room-meta-item">
                            <svg viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/></svg>
                            <?php echo e($room->size); ?>

                        </span>
                        <?php endif; ?>
                        <?php if($room->bed_style): ?>
                        <span class="room-meta-item">
                            <svg viewBox="0 0 24 24" fill="none"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 0 1 2 2v10"/><path d="M2 17h20"/><path d="M6 8v-2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2"/></svg>
                            <?php echo e($room->bed_style); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="room-footer">
                        <div class="room-price">$ <?php echo e(number_format($room->price, 0)); ?> <span>/ night</span></div>
                        <div class="room-arrow">â†’</div>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="color:rgba(255,255,255,.5);grid-column:1/-1;text-align:center;padding:40px 0;">Rooms coming soon.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if($halls->count() && ($homeSections['halls']->status ?? true)): ?>
<?php $hallsSection = $homeSections['halls'] ?? null; ?>
<section class="halls-section" id="halls">
    <div class="halls-inner">
        <div class="halls-header">
            <div>
                <span class="eyebrow light reveal"><?php echo e($hallsSection->eyebrow ?? 'Events & Conferences'); ?></span>
                <h2 class="h-section on-dark reveal d1"><?php echo $hallsSection->title ?? 'Where Great <em>Moments</em> Unfold'; ?></h2>
                <p class="lead on-dark reveal d2" style="max-width:460px"><?php echo e($hallsSection->description ?? 'World-class halls for conferences, weddings, and landmark celebrations.'); ?></p>
            </div>
        </div>
        <div class="halls-scroll-wrap">
            <div class="halls-scroll">
                <?php $__currentLoopData = $halls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(url('/room/details/'.$hall->id)); ?>" class="hall-card<?php echo e($halls->count() === 1 ? ' single' : ''); ?> reveal <?php echo e(['','d1'][$loop->index % 2]); ?>" style="text-decoration:none">
                    <div class="hall-card-img">
                        <img class="hall-img" src="<?php echo e(asset('upload/roomimg/'.$hall->image)); ?>" alt="<?php echo e($hall->type->name ?? 'Hall'); ?>" loading="lazy">
                    </div>
                    <div class="hall-card-body">
                        <div class="hall-label">Hall</div>
                        <div class="hall-name"><?php echo e($hall->type->name ?? 'Hall'); ?></div>
                        <?php if($hall->short_desc): ?>
                        <div class="hall-desc"><?php echo e(Str::limit($hall->short_desc, 120)); ?></div>
                        <?php endif; ?>
                        <div class="hall-meta">
                            <?php if($hall->room_capacity): ?>
                            <span class="hall-meta-item">
                                <svg viewBox="0 0 24 24" fill="none"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                <strong><?php echo e($hall->room_capacity); ?></strong> Guests
                            </span>
                            <?php endif; ?>
                            <?php if($hall->size): ?>
                            <span class="hall-meta-item">
                                <svg viewBox="0 0 24 24" fill="none"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/></svg>
                                <?php echo e($hall->size); ?>

                            </span>
                            <?php endif; ?>
                            <?php if($hall->bed_style): ?>
                            <span class="hall-meta-item">
                                <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                <?php echo e($hall->bed_style); ?>

                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="hall-price">$ <?php echo e(number_format($hall->price, 0)); ?> <span>/ event</span></div>
                    </div>
                    <div class="hall-arrow">â†’</div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if(($homeSections['amenities']->status ?? true)): ?>
<section class="amenities-section" id="amenities">
    <?php $amenitiesSection = $homeSections['amenities'] ?? null; ?>
    <div class="amenities-inner">
        <div class="amenities-header">
            <span class="eyebrow reveal"><?php echo e($amenitiesSection->eyebrow ?? 'Our Offerings'); ?></span>
            <div class="bar center reveal d1"></div>
            <h2 class="h-section reveal d1" style="max-width:460px;margin:0 auto"><?php echo $amenitiesSection->title ?? 'World-Class <em>Experiences</em> Await'; ?></h2>
        </div>
        <div class="amenities-grid">
            <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="amenity-card reveal<?php echo e($i > 0 ? ' d'.$i : ''); ?>">
                <div class="amenity-icon-wrap"><span class="amenity-icon"><?php echo $amenity->icon; ?></span></div>
                <div class="amenity-name"><?php echo e($amenity->name); ?></div>
                <p class="amenity-desc"><?php echo e($amenity->description); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<section class="featured-amenities">
    <div class="featured-amenities-inner">
        <div class="fa-header">
            <div class="fa-title">Featured Amenities On-Site</div>
        </div>
        <div class="fa-grid reveal">
            <?php $__currentLoopData = $featuredAmenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="fa-item">
                <div class="fa-item-icon">
                    <?php switch($fa->icon_key):
                        case ('garden'): ?>
                            <svg viewBox="0 0 24 24"><path d="M12 2C8 2 4 5.5 4 10c0 5.25 8 12 8 12s8-6.75 8-12c0-4.5-4-8-8-8z"/><circle cx="12" cy="10" r="3"/></svg>
                            <?php break; ?>
                        <?php case ('linen'): ?>
                            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 3v18M3 9h6M3 15h6"/></svg>
                            <?php break; ?>
                        <?php case ('business'): ?>
                            <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>
                            <?php break; ?>
                        <?php case ('meeting'): ?>
                            <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                            <?php break; ?>
                        <?php case ('restaurant'): ?>
                            <svg viewBox="0 0 24 24"><path d="M18 8h1a4 4 0 010 8h-1"/><path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                            <?php break; ?>
                        <?php case ('fitness'): ?>
                            <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <?php break; ?>
                        <?php case ('laundry'): ?>
                            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            <?php break; ?>
                        <?php case ('frontdesk'): ?>
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                            <?php break; ?>
                        <?php default: ?>
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg>
                    <?php endswitch; ?>
                </div>
                <div class="fa-item-text">
                    <span class="fa-item-name"><?php echo e($fa->name); ?></span>
                    <?php if($fa->note): ?>
                    <div class="fa-item-note"><?php echo e($fa->note); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section class="hotel-info-section">
    <div class="hotel-info-inner">
        <div class="hi-section-title">Hotel Information</div>
        <div class="hi-grid reveal">
            <?php $__currentLoopData = $hotelInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <div class="hi-group-title"><?php echo e($group); ?></div>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="hi-row">
                    <div class="hi-row-icon">
                        <?php switch($info->icon):
                            case ('clock'): ?>
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                                <?php break; ?>
                            <?php case ('user'): ?>
                                <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                <?php break; ?>
                            <?php case ('phone'): ?>
                                <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2A19.79 19.79 0 013.07 8.63 19.79 19.79 0 01.01 4.05 2 2 0 012 1.87h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81A2 2 0 017.25 8.5l-1.16 1.4a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                                <?php break; ?>
                            <?php case ('truck'): ?>
                                <svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h3l4 4v4h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                                <?php break; ?>
                            <?php case ('pin'): ?>
                                <svg viewBox="0 0 24 24"><path d="M12 2C8 2 4 5.5 4 10c0 5.25 8 12 8 12s8-6.75 8-12c0-4.5-4-8-8-8z"/><circle cx="12" cy="10" r="3"/></svg>
                                <?php break; ?>
                            <?php case ('cup'): ?>
                                <svg viewBox="0 0 24 24"><path d="M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                                <?php break; ?>
                            <?php case ('accessibility'): ?>
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><path d="M7 20l1-6h8l1 6"/><path d="M12 7v7"/></svg>
                                <?php break; ?>
                            <?php case ('shield'): ?>
                                <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                <?php break; ?>
                            <?php case ('no'): ?>
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                                <?php break; ?>
                            <?php default: ?>
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg>
                        <?php endswitch; ?>
                    </div>
                    <div class="hi-row-body">
                        <div class="hi-row-title"><?php echo e($info->title); ?></div>
                        <?php if($info->detail): ?>
                        <div class="hi-row-detail"><?php echo e($info->detail); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<?php if(($homeSections['dining']->status ?? true)): ?>
<?php $diningSection = $homeSections['dining'] ?? null; ?>
<section class="dining-section" id="dining">
    <div class="dining-img-wrap">
        <img class="dining-img" src="<?php echo e(asset($diningSection->image ?? 'frontend/assets/img/resto_bar/resto.jpg')); ?>" alt="Restaurant" loading="lazy">
        <div class="dining-img-bar"></div>
    </div>
    <div class="dining-content">
        <span class="eyebrow light reveal"><?php echo e($diningSection->eyebrow ?? 'Gastronomy'); ?></span>
        <div class="bar light reveal d1"></div>
        <h2 class="h-section on-dark reveal d1"><?php echo $diningSection->title ?? 'A Table Set<br>with <em>Passion</em>'; ?></h2>
        <p class="lead on-dark reveal d2"><?php echo e($diningSection->description ?? 'Our culinary team crafts every meal as an act of hospitality â€” drawing from Rwandan heritage and global traditions.'); ?></p>
        <div class="dining-items reveal d2">
            <?php $__currentLoopData = $diningItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="dining-item"><span class="dining-item-name"><?php echo e($item->name); ?></span><span class="dining-item-time"><?php echo e($item->time_text); ?></span></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if(($homeSections['events']->status ?? true)): ?>
<?php $eventsSection = $homeSections['events'] ?? null; ?>
<section class="events-section" id="meetings">
    <div class="events-inner">
        <div>
            <span class="eyebrow reveal"><?php echo e($eventsSection->eyebrow ?? 'Events & Conferences'); ?></span>
            <div class="bar reveal d1"></div>
            <h2 class="h-section reveal d1"><?php echo $eventsSection->title ?? 'Where Great <em>Decisions</em> Are Made'; ?></h2>
            <p class="lead reveal d2"><?php echo e($eventsSection->description ?? ''); ?></p>
            <?php if($eventsSection->description_2 ?? null): ?>
            <p class="lead reveal d2"><?php echo e($eventsSection->description_2); ?></p>
            <?php endif; ?>
            <div class="events-features reveal d3">
                <?php $__currentLoopData = $eventFeatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="events-feat"><div class="ef-name"><?php echo e($feat->name); ?></div><div class="ef-desc"><?php echo e($feat->description); ?></div></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if($eventsSection->button_text ?? null): ?>
            <a href="<?php echo e($eventsSection->button_url ?? '#contact'); ?>" class="btn-blue reveal d4">
                <span><?php echo e($eventsSection->button_text); ?></span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <?php endif; ?>
        </div>
        <div class="events-img-wrap reveal">
            <div class="events-img-bar"></div>
            <img class="events-img" src="<?php echo e(asset($eventsSection->image ?? 'frontend/assets/img/DSC_0319.jpg')); ?>" alt="Conference" loading="lazy">
            <?php if($eventsSection->badge_value ?? null): ?>
            <div class="events-badge">
                <div class="eb-num"><?php echo e($eventsSection->badge_value); ?></div>
                <div class="eb-lbl"><?php echo e($eventsSection->badge_label ?? ''); ?></div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if(($homeSections['testimonials']->status ?? true)): ?>
<?php $testiSection = $homeSections['testimonials'] ?? null; ?>
<section class="testi-section">
    <div class="testi-inner">
        <div class="testi-header">
            <span class="eyebrow light reveal"><?php echo e($testiSection->eyebrow ?? 'Guest Voices'); ?></span>
            <div class="bar light center reveal d1"></div>
            <h2 class="h-section on-dark reveal d1" style="max-width:400px;margin:0 auto"><?php echo $testiSection->title ?? 'Words That <em>Honour</em> Us'; ?></h2>
        </div>
        <div class="testi-grid">
            <?php $__empty_1 = true; $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="testi-card">
                <div class="testi-quote">&ldquo;</div>
                <p class="testi-text"><?php echo e($item->message); ?></p>
                <div class="testi-stars">â˜…â˜…â˜…â˜…â˜…</div>
                <div class="testi-author"><?php echo e($item->name); ?></div>
                <?php if($item->city): ?>
                <div class="testi-location"><?php echo e($item->city); ?></div>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="color:rgba(255,255,255,.5);text-align:center;width:100%">No testimonials yet.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if(($homeSections['contact']->status ?? true)): ?>
<?php $contactSection = $homeSections['contact'] ?? null; ?>
<section class="contact-section" id="contact">
    <div class="contact-inner">
        <div class="contact-left">
            <span class="eyebrow reveal"><?php echo e($contactSection->eyebrow ?? 'Get In Touch'); ?></span>
            <div class="bar reveal d1"></div>
            <h2 class="h-section reveal d1"><?php echo $contactSection->title ?? 'Begin Your <em>Journey</em>'; ?></h2>
            <p class="lead reveal d2"><?php echo e($contactSection->description ?? 'Our concierge team is ready to curate a bespoke experience for you â€” personal retreat, family stay, or grand corporate event.'); ?></p>
            <div class="contact-details reveal d3">
                <div class="cd-item">
                    <div class="cd-icon">â—ˆ</div>
                    <div><div class="cd-label">Address</div><div class="cd-val"><?php echo e($siteSettings->address ?? 'Muhanga, Kabgayi, Rwanda'); ?></div></div>
                </div>
                <div class="cd-item">
                    <div class="cd-icon">â—Ž</div>
                    <div><div class="cd-label">Reservations</div><div class="cd-val"><a href="tel:<?php echo e(preg_replace('/\s+/', '', $siteSettings->phone ?? '+250794191115')); ?>"><?php echo e($siteSettings->phone ?? '+250 794 191 115'); ?></a></div></div>
                </div>
                <div class="cd-item">
                    <div class="cd-icon">âœ‰</div>
                    <div><div class="cd-label">Email</div><div class="cd-val"><a href="mailto:<?php echo e($siteSettings->email ?? 'hotellucernakabgayi@gmail.com'); ?>"><?php echo e($siteSettings->email ?? 'hotellucernakabgayi@gmail.com'); ?></a></div></div>
                </div>
                <div class="cd-item">
                    <div class="cd-icon">â—‘</div>
                    <div><div class="cd-label">Reception</div><div class="cd-val">Open 24 Hours, Every Day</div></div>
                </div>
            </div>
            <div class="map-wrap reveal d4">
                <iframe src="<?php echo e($siteSettings->google_maps_embed ?? 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6149.053947903886!2d29.754994947779355!3d-2.08832623103027!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dccb9e7e84a8c1%3A0xbf93699bed85f0f!2sLucerna-Kabgayi%20Hotel!5e0!3m2!1sen!2sus!4v1707836567416!5m2!1sen!2sus'); ?>" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <div class="contact-form-card reveal d1">
            <div class="cfc-title">Send Us a Message</div>
            <form method="POST" action="<?php echo e(route('store.contact')); ?>" class="contact-form">
                <?php echo csrf_field(); ?>
                <div class="form-field"><label for="name">Full Name</label><input type="text" id="name" name="name" placeholder="Your full name" value="<?php echo e(old('name')); ?>" required></div>
                <div class="form-field"><label for="email">Email Address</label><input type="email" id="email" name="email" placeholder="your@email.com" value="<?php echo e(old('email')); ?>" required></div>
                <div class="form-field"><label for="phone">Phone Number</label><input type="tel" id="phone" name="phone" placeholder="+250 ..." value="<?php echo e(old('phone')); ?>"></div>
                <div class="form-field"><label for="subject">Subject</label><input type="text" id="subject" name="subject" placeholder="Subject of your message" value="<?php echo e(old('subject')); ?>" required></div>
                <div class="form-field"><label for="message">Message</label><textarea id="message" name="message" placeholder="Your message..." required><?php echo e(old('message')); ?></textarea></div>
                <button type="submit" class="form-submit">Send Enquiry</button>
            </form>
        </div>
    </div>
</section>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
(function(){
    'use strict';

    /* â”€â”€ Category â†’ Guests dynamic â”€â”€ */
    var catSel = document.getElementById('room_type');
    var guestSel = document.getElementById('persion');
    var defaultMax = 4;

    function buildGuestOptions(max) {
        var prev = parseInt(guestSel.value) || 1;
        guestSel.innerHTML = '';
        for (var i = 1; i <= max; i++) {
            var opt = document.createElement('option');
            opt.value = i;
            opt.textContent = i + (i === 1 ? ' Guest' : ' Guests');
            if (i === prev) opt.selected = true;
            guestSel.appendChild(opt);
        }
        if (prev > max) guestSel.value = max;
    }

    if (catSel && guestSel) {
        catSel.addEventListener('change', function() {
            var selected = catSel.options[catSel.selectedIndex];
            if (!catSel.value) {
                buildGuestOptions(defaultMax);
                return;
            }
            var dataMax = parseInt(selected.getAttribute('data-max'));
            if (dataMax && dataMax > 0) {
                buildGuestOptions(Math.min(dataMax, 50));
            } else {
                buildGuestOptions(defaultMax);
            }
        });
    }

    /* â”€â”€ Hero slideshow â”€â”€ */
    var slides=document.querySelectorAll('.hero-slide'),dots=document.querySelectorAll('.hero-dot'),cur=0,timer;
    function goSlide(n){
        slides[cur].classList.remove('active'); dots[cur].classList.remove('active');
        cur=((n%slides.length)+slides.length)%slides.length;
        slides[cur].classList.add('active'); dots[cur].classList.add('active');
    }
    window.goSlide=goSlide;
    function start(){ clearInterval(timer); timer=setInterval(function(){ goSlide(cur+1); },6500); }
    start();
    dots.forEach(function(d,i){ d.addEventListener('click',function(){ goSlide(i); start(); }); });
    var hero=document.querySelector('.hero'), tx=0;
    if(hero){
        hero.addEventListener('touchstart',function(e){ tx=e.changedTouches[0].screenX; },{passive:true});
        hero.addEventListener('touchend',function(e){ var dx=e.changedTouches[0].screenX-tx; if(Math.abs(dx)>44){ goSlide(dx<0?cur+1:cur-1); start(); } },{passive:true});
    }

    /* â”€â”€ Pikaday Calendar V12 â”€â”€ */
    document.addEventListener('DOMContentLoaded', function(){
        var today = new Date();
        var tomorrow = new Date(today); tomorrow.setDate(today.getDate()+1);

        var pickIn = new Pikaday({
            field:       document.getElementById('check_in'),
            format:      'DD MMM YYYY',
            minDate:     today,
            defaultDate: today,
            theme:       'lucerna-pikaday',
            toString:    function(d){ return d.toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'}); },
            onSelect:    function(d){
                var next=new Date(d); next.setDate(next.getDate()+1);
                pickOut.setMinDate(next);
                if(!pickOut.getDate() || pickOut.getDate()<=d){ pickOut.setDate(next); }
            }
        });

        var pickOut = new Pikaday({
            field:       document.getElementById('check_out'),
            format:      'DD MMM YYYY',
            minDate:     tomorrow,
            defaultDate: tomorrow,
            theme:       'lucerna-pikaday',
            toString:    function(d){ return d.toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'}); }
        });
    });

    /* â”€â”€ Halls scroll dots â”€â”€ */
    var hs=document.querySelector('.halls-scroll'), hDots=document.querySelectorAll('.halls-dot');
    if(hs && hDots.length>1){
        hs.addEventListener('scroll',function(){
            var cards=hs.querySelectorAll('.hall-card'), sw=hs.scrollLeft+hs.offsetWidth/2;
            cards.forEach(function(c,i){
                if(c.offsetLeft<=sw && c.offsetLeft+c.offsetWidth>sw){
                    hDots.forEach(function(d,j){ d.classList.toggle('active',j===i); });
                }
            });
        },{passive:true});
    }

})();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\htdocs\lucerna\resources\views/frontend/index.blade.php ENDPATH**/ ?>