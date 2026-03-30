@extends('frontend.main_master')

@section('styles')
/* ══════════════════════════════
   ALL ROOMS / HALLS LISTING
══════════════════════════════ */
.page-hero {
    position:relative; height:340px; overflow:hidden;
    display:flex; align-items:center; justify-content:center;
}
.page-hero-bg {
    position:absolute; inset:0;
    background:linear-gradient(139deg,#0c62c3 14.24%,#034ea2 75.61%);
}
.page-hero-overlay {
    position:absolute; inset:0;
    background:linear-gradient(to bottom,rgba(7,22,38,.3),rgba(7,22,38,.6));
}
.page-hero-content {
    position:relative; z-index:2; text-align:center; padding:0 20px;
}
.page-hero-eyebrow {
    font-family:var(--f-body); font-size:12px; font-weight:600;
    letter-spacing:.28em; text-transform:uppercase;
    color:rgba(255,255,255,.7); margin-bottom:12px;
}
.page-hero-title {
    font-family:var(--f-head); font-size:clamp(32px,5vw,56px); font-weight:500;
    line-height:1.1; color:var(--white); margin-bottom:14px;
}
.page-hero-title em { font-style:italic; font-weight:400; }
.page-hero-sub {
    font-family:var(--f-body); font-size:15px; color:rgba(255,255,255,.7);
    max-width:460px; margin:0 auto;
}
.breadcrumb-strip {
    display:flex; align-items:center; justify-content:center; gap:8px;
    margin-top:18px; font-family:var(--f-body); font-size:12px;
    color:rgba(255,255,255,.5);
}
.breadcrumb-strip a { color:rgba(255,255,255,.7); text-decoration:none; transition:color .2s; }
.breadcrumb-strip a:hover { color:var(--white); }
.breadcrumb-strip svg { width:12px; height:12px; stroke:rgba(255,255,255,.4); }

/* ── Filter tabs ── */
.filter-bar {
    max-width:1280px; margin:-28px auto 0; padding:0 48px; position:relative; z-index:3;
}
.filter-inner {
    background:var(--white); border-radius:2px;
    box-shadow:0 8px 40px rgba(12,36,64,.1);
    display:flex; align-items:center; justify-content:center; gap:0;
}
.filter-tab {
    flex:1; padding:20px 24px; text-align:center;
    font-family:var(--f-body); font-size:13px; font-weight:600;
    letter-spacing:.14em; text-transform:uppercase;
    color:var(--soft); cursor:pointer; border:none; background:none;
    border-bottom:3px solid transparent; transition:all .25s;
}
.filter-tab:hover { color:var(--ink); background:var(--off-white); }
.filter-tab.active { color:var(--brand); border-bottom-color:var(--brand); }
.filter-count {
    display:inline-block; min-width:20px; height:20px; line-height:20px;
    border-radius:10px; background:rgba(12,77,162,.08); color:var(--brand);
    font-size:10px; font-weight:700; margin-left:6px; padding:0 6px;
}

/* ── Room grid ── */
.rooms-listing { max-width:1280px; margin:0 auto; padding:48px 48px 72px; }
.rooms-grid-list {
    display:grid; grid-template-columns:repeat(3,1fr);
    gap:20px;
}
.rl-card {
    position:relative; overflow:hidden; background:var(--white);
    border:1px solid rgba(12,36,64,.06);
    transition:all .35s; display:flex; flex-direction:column;
    text-decoration:none; color:inherit;
}
.rl-card:hover {
    box-shadow:0 16px 48px rgba(12,36,64,.1);
    transform:translateY(-4px);
}
.rl-img-wrap { position:relative; overflow:hidden; height:260px; }
.rl-img {
    width:100%; height:100%; object-fit:cover; display:block;
    transition:transform .6s var(--ease);
}
.rl-card:hover .rl-img { transform:scale(1.06); }
.rl-badge {
    position:absolute; top:14px; left:14px;
    font-family:var(--f-body); font-size:10px; font-weight:700;
    letter-spacing:.18em; text-transform:uppercase;
    padding:5px 12px; border-radius:2px; z-index:2;
}
.rl-badge.room { background:var(--brand); color:var(--white); }
.rl-badge.hall { background:var(--gold); color:var(--navy); }
.rl-body { padding:22px 22px 18px; flex:1; display:flex; flex-direction:column; }
.rl-type-name {
    font-family:var(--f-body); font-size:11px; font-weight:600;
    letter-spacing:.16em; text-transform:uppercase;
    color:var(--brand); margin-bottom:6px;
}
.rl-name {
    font-family:var(--f-head); font-size:24px; font-weight:400;
    font-style:italic; color:var(--navy); margin-bottom:8px; line-height:1.2;
}
.rl-desc {
    font-family:var(--f-body); font-size:13px; color:var(--soft);
    line-height:1.6; margin-bottom:14px; flex:1;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
}
.rl-meta {
    display:flex; gap:16px; flex-wrap:wrap;
    padding-top:14px; border-top:1px solid rgba(12,36,64,.06); margin-bottom:14px;
}
.rl-meta-item {
    font-family:var(--f-body); font-size:12px; color:var(--soft);
    display:flex; align-items:center; gap:5px;
}
.rl-meta-item svg { width:14px; height:14px; stroke:var(--brand); fill:none; stroke-width:1.5; }
.rl-footer { display:flex; justify-content:space-between; align-items:center; }
.rl-price { font-family:var(--f-head); font-size:22px; font-weight:600; color:var(--navy); }
.rl-price span { font-family:var(--f-body); font-size:12px; color:var(--soft); font-weight:400; margin-left:2px; }
.rl-price .rl-old { font-size:14px; color:var(--soft); text-decoration:line-through; margin-right:6px; font-weight:400; }
.rl-book-btn {
    font-family:var(--f-body); font-size:11px; font-weight:600;
    letter-spacing:.14em; text-transform:uppercase;
    padding:10px 20px; background:var(--brand); color:var(--white);
    border:none; cursor:pointer; border-radius:2px;
    transition:all .25s; text-decoration:none;
}
.rl-book-btn:hover { background:var(--brand-light); transform:translateY(-1px); box-shadow:0 4px 12px rgba(12,77,162,.25); }
.no-results {
    grid-column:1/-1; text-align:center; padding:60px 20px;
    color:var(--soft); font-family:var(--f-body); font-size:15px;
}

/* ── Responsive ── */
@media(max-width:1024px){
    .rooms-grid-list { grid-template-columns:1fr 1fr; }
    .rooms-listing { padding:40px 28px 60px; }
    .filter-bar { padding:0 28px; }
}
@media(max-width:768px){
    .page-hero { height:280px; }
    .rooms-grid-list { grid-template-columns:1fr; max-width:480px; margin:0 auto; }
    .rooms-listing { padding:32px 14px 48px; }
    .filter-bar { padding:0 14px; margin-top:-24px; }
    .filter-tab { padding:14px 16px; font-size:11px; letter-spacing:.1em; }
    .rl-img-wrap { height:240px; }
}
@media(max-width:480px){
    .page-hero { height:240px; }
    .page-hero-title { font-size:clamp(26px,8vw,36px); }
    .filter-inner { flex-direction:column; }
    .filter-tab { border-bottom:none; border-left:3px solid transparent; }
    .filter-tab.active { border-left-color:var(--brand); }
    .rl-img-wrap { height:220px; }
    .rl-body { padding:18px 16px 14px; }
    .rl-name { font-size:20px; }
    .rl-price { font-size:18px; }
}
@endsection

@section('main')

{{-- Page Hero --}}
<section class="page-hero">
    <div class="page-hero-bg"></div>
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content">
        <div class="page-hero-eyebrow">Accommodation</div>
        <h1 class="page-hero-title">Our Rooms &amp; <em>Halls</em></h1>
        <p class="page-hero-sub">From intimate chambers to grand event halls — find the perfect space for every occasion.</p>
        <div class="breadcrumb-strip">
            <a href="{{ url('/') }}">Home</a>
            <svg viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span>Rooms &amp; Halls</span>
        </div>
    </div>
</section>

{{-- Filter Tabs --}}
<div class="filter-bar">
    <div class="filter-inner">
        <button class="filter-tab active" data-filter="all">All <span class="filter-count">{{ $rooms->count() }}</span></button>
        <button class="filter-tab" data-filter="Room">Rooms <span class="filter-count">{{ $rooms->filter(fn($r)=>($r->type->type ?? 'Room')==='Room')->count() }}</span></button>
        <button class="filter-tab" data-filter="Hall">Halls <span class="filter-count">{{ $rooms->filter(fn($r)=>($r->type->type ?? 'Room')==='Hall')->count() }}</span></button>
    </div>
</div>

{{-- Listing --}}
<div class="rooms-listing">
    <div class="rooms-grid-list" id="roomsGrid">
        @forelse($rooms as $item)
        @php
            $isHall = ($item->type->type ?? 'Room') === 'Hall';
            $typeLabel = $isHall ? 'Hall' : 'Room';
        @endphp
        <div class="rl-card" data-type="{{ $typeLabel }}">
            <div class="rl-img-wrap">
                <img class="rl-img" src="{{ asset('upload/roomimg/'.$item->image) }}" alt="{{ $item->type->name ?? 'Room' }}" loading="lazy">
                <span class="rl-badge {{ strtolower($typeLabel) }}">{{ $typeLabel }}</span>
            </div>
            <div class="rl-body">
                <div class="rl-type-name">{{ $typeLabel }}</div>
                <div class="rl-name">{{ $item->type->name ?? 'Room' }}</div>
                @if($item->short_desc)
                <div class="rl-desc">{{ $item->short_desc }}</div>
                @endif
                <div class="rl-meta">
                    @if($item->room_capacity)
                    <div class="rl-meta-item">
                        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        {{ $item->room_capacity }} {{ $isHall ? 'Guests' : 'Person' }}
                    </div>
                    @endif
                    @if($item->size)
                    <div class="rl-meta-item">
                        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
                        {{ $item->size }} ft²
                    </div>
                    @endif
                    @if($item->bed_style && !$isHall)
                    <div class="rl-meta-item">
                        <svg viewBox="0 0 24 24"><path d="M2 4v16M22 4v16M2 12h20M7 12V8a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v4"/></svg>
                        {{ $item->bed_style }}
                    </div>
                    @endif
                </div>
                <div class="rl-footer">
                    <div class="rl-price">
                        @if($item->discount > 0)
                        <span class="rl-old">$ {{ number_format($item->price,0) }}</span>
                        @endif
                        $ {{ number_format($item->discount > 0 ? $item->price - ($item->price * $item->discount / 100) : $item->price, 0) }}
                        <span>/ {{ $isHall ? 'event' : 'night' }}</span>
                    </div>
                    <a href="{{ url('room/details/'.$item->id) }}" class="rl-book-btn">View &amp; Book</a>
                </div>
            </div>
        </div>
        @empty
        <div class="no-results">No rooms or halls available at the moment.</div>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script>
(function(){
    var tabs = document.querySelectorAll('.filter-tab');
    var cards = document.querySelectorAll('.rl-card');
    tabs.forEach(function(tab){
        tab.addEventListener('click', function(){
            tabs.forEach(function(t){ t.classList.remove('active'); });
            tab.classList.add('active');
            var f = tab.getAttribute('data-filter');
            cards.forEach(function(c){
                c.style.display = (f === 'all' || c.getAttribute('data-type') === f) ? '' : 'none';
            });
        });
    });
})();
</script>
@endsection