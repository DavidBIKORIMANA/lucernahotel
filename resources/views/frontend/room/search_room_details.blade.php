@extends('frontend.main_master')

@section('styles')
@php
    $isHall = ($roomdetails->type->type ?? 'Room') === 'Hall';
    $unitLabel = $isHall ? 'event' : 'night';
    $entityLabel = $isHall ? 'Hall' : 'Room';
    $images = [asset('upload/roomimg/'.$roomdetails->image)];
    foreach($multiImage as $mi) { $images[] = asset('upload/roomimg/multi_img/'.$mi->multi_img); }
@endphp
<style>
/* ───── Design Tokens ───── */
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

/* ═══ 50/50 LAYOUT ═══ */
.srd-container { display:flex; min-height:100vh; background:#fdfcfb; padding-top:96px; }

/* ═══ LEFT — GALLERY COLUMN ═══ */
.srd-gallery-col {
    width:600px; flex-shrink:0; position:sticky; top:96px; height:600px;
    display:flex; flex-direction:column; background:var(--g-dark);
}

/* Main display */
.srd-main-display {
    position:relative; height:var(--g-main-h); width:100%;
    overflow:hidden; cursor:zoom-in; background:#000;
}
.srd-main-display img {
    width:100%; height:100%; object-fit:contain;
    opacity:1; transition:opacity .25s ease;
}
.srd-main-display img.is-fading { opacity:0; }

/* Counter badge */
.srd-badge {
    position:absolute; top:16px; right:16px; z-index:10;
    background:rgba(0,0,0,.65); backdrop-filter:blur(6px);
    color:#fff; padding:5px 14px;
    font-family:var(--g-sans); font-size:12px; font-weight:500;
    letter-spacing:.5px; border-radius:20px;
    pointer-events:none; user-select:none;
}

/* Prev / Next */
.srd-nav-btn {
    position:absolute; top:50%; transform:translateY(-50%);
    background:rgba(0,0,0,.3); backdrop-filter:blur(4px);
    color:#fff; border:none; width:48px; height:48px; border-radius:50%;
    cursor:pointer; z-index:10; font-size:18px;
    display:flex; align-items:center; justify-content:center;
    transition:background .25s, transform .25s; opacity:0;
}
.srd-main-display:hover .srd-nav-btn { opacity:1; }
.srd-nav-btn:hover { background:var(--g-gold); transform:translateY(-50%) scale(1.08); }
.srd-prev { left:14px; }
.srd-next { right:14px; }

/* Thumbnail strip */
.srd-thumb-strip {
    height:var(--g-thumb-h); display:flex; align-items:center;
    gap:10px; padding:0 16px; overflow-x:auto; overflow-y:hidden;
    background:var(--g-navy); scrollbar-width:thin;
    scrollbar-color:var(--g-gold) transparent; scroll-behavior:smooth;
}
.srd-thumb-strip::-webkit-scrollbar { height:4px; }
.srd-thumb-strip::-webkit-scrollbar-thumb { background:var(--g-gold); border-radius:4px; }
.srd-thumb-strip::-webkit-scrollbar-track { background:transparent; }

.srd-thumb-item {
    width:120px; height:78px; flex-shrink:0; cursor:pointer;
    border:2px solid transparent; border-radius:4px; overflow:hidden;
    transition:border-color var(--g-ease), opacity var(--g-ease), transform var(--g-ease);
    opacity:.45;
}
.srd-thumb-item:hover { opacity:.8; transform:scale(1.04); }
.srd-thumb-item.is-active {
    border-color:var(--g-gold); opacity:1;
    box-shadow:0 0 0 1px var(--g-gold);
}
.srd-thumb-item img { width:100%; height:100%; object-fit:cover; display:block; }

/* ═══ LIGHTBOX ═══ */
.srd-lightbox {
    position:fixed; inset:0; background:rgba(0,0,0,.96);
    z-index:99999; display:flex; align-items:center; justify-content:center;
    opacity:0; visibility:hidden; transition:opacity .3s ease, visibility .3s ease;
}
.srd-lightbox.is-open { opacity:1; visibility:visible; }
.srd-lightbox img {
    max-width:88vw; max-height:82vh; object-fit:contain;
    border-radius:4px; transition:opacity .2s ease; user-select:none;
}
.srd-lightbox img.is-fading { opacity:0; }

.srd-lb-close {
    position:absolute; top:20px; right:28px; color:#fff; font-size:38px;
    cursor:pointer; width:48px; height:48px; display:flex;
    align-items:center; justify-content:center; border-radius:50%;
    background:rgba(255,255,255,.08); transition:background .25s;
    z-index:10; border:none; line-height:1;
}
.srd-lb-close:hover { background:rgba(255,255,255,.2); }

.srd-lb-badge {
    position:absolute; top:24px; left:28px; color:rgba(255,255,255,.7);
    font-family:var(--g-sans); font-size:14px; font-weight:500;
    letter-spacing:.5px; pointer-events:none; user-select:none;
}

.srd-lb-nav {
    position:absolute; top:50%; transform:translateY(-50%);
    background:rgba(255,255,255,.08); backdrop-filter:blur(4px);
    color:#fff; border:none; width:52px; height:52px; border-radius:50%;
    cursor:pointer; font-size:20px; display:flex;
    align-items:center; justify-content:center;
    transition:background .25s, transform .25s; z-index:10;
}
.srd-lb-nav:hover { background:var(--g-gold); transform:translateY(-50%) scale(1.08); }
.srd-lb-prev { left:24px; }
.srd-lb-next { right:24px; }

/* ═══ RIGHT — DETAILS COLUMN ═══ */
.srd-details-col {
    flex:1; min-width:0; padding:20px 28px; overflow-y:auto; background:#fff;
}

/* Room header */
.srd-room-header {
    margin-bottom:24px; padding-bottom:15px;
    border-bottom:1px solid #f0f0f0;
}
.srd-room-badge {
    display:inline-block; font-family:var(--g-sans); font-size:11px; font-weight:700;
    letter-spacing:1px; text-transform:uppercase;
    padding:2px 10px; border-radius:2px; margin-bottom:8px;
}
.srd-room-badge.room { background:var(--g-gold); color:#fff; }
.srd-room-badge.hall { background:var(--g-gold); color:var(--g-navy); }
.srd-room-title {
    font-family:var(--g-serif); font-size:36px;
    font-weight:500; color:var(--g-navy); line-height:1.2; margin:0;
}
.srd-room-price {
    font-family:var(--g-sans); font-size:20px; font-weight:600;
    color:var(--g-gold); margin-top:5px;
}
.srd-room-price .old {
    text-decoration:line-through; color:#9ca3af; font-size:16px; margin-right:6px;
}
.srd-room-price .unit {
    font-family:var(--g-sans); font-size:13px; color:#777; font-weight:400;
}

/* Section titles */
.srd-section-title {
    font-family:var(--g-sans); font-size:13px; font-weight:700;
    letter-spacing:1px; text-transform:uppercase;
    color:var(--g-navy); margin-bottom:10px;
}

/* Description */
.srd-description {
    font-family:var(--g-sans); font-size:15px; color:#555;
    line-height:1.6; margin-bottom:25px;
}

/* Detail cards grid */
.srd-details-grid {
    display:grid; grid-template-columns:repeat(3,1fr); gap:10px; margin-bottom:25px;
}
.srd-detail-card {
    padding:12px; background:#f9f9f9; border-radius:2px;
}
.srd-detail-label {
    font-family:var(--g-sans); font-size:10px;
    text-transform:uppercase; color:#999; margin-bottom:4px;
}
.srd-detail-value {
    font-family:var(--g-sans); font-size:14px; font-weight:600; color:#333;
}

/* Facilities */
.srd-facilities { display:flex; flex-wrap:wrap; gap:8px; margin-bottom:30px; }
.srd-fac-tag {
    display:inline-flex; align-items:center; gap:6px;
    font-family:var(--g-sans); font-size:13px; color:#555;
    background:#fff; padding:5px 12px; border-radius:20px;
    border:1px solid #eee; transition:all .2s;
}
.srd-fac-tag:hover { background:#f5f0e8; border-color:#ddd; }
.srd-fac-tag svg { width:14px; height:14px; stroke:var(--g-gold); stroke-width:2; flex-shrink:0; }

/* ═══ Booking Card ═══ */
.srd-book-card {
    background:#fff; border:1px solid var(--g-navy);
    border-radius:4px; overflow:hidden; margin-top:0;
}
.srd-book-header {
    background:var(--g-navy); padding:15px 24px; text-align:center;
}
.srd-book-price-label {
    font-family:var(--g-serif); font-size:24px; font-weight:600; color:#fff;
}
.srd-book-unit { font-family:var(--g-sans); font-size:12px; color:rgba(255,255,255,.8); }
.srd-book-body { padding:20px; }

/* Form fields */
.srd-date-row { display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom:15px; }
.srd-date-row .srd-field { margin-bottom:0; }
.srd-field { margin-bottom:15px; }
.srd-field label {
    display:block; font-family:var(--g-sans); font-size:10px; font-weight:700;
    letter-spacing:.18em; text-transform:uppercase; color:#999; margin-bottom:5px;
}
.srd-field input, .srd-field select {
    width:100%; padding:10px 14px;
    font-family:var(--g-sans); font-size:13px; color:#333;
    border:1px solid #ddd; border-radius:2px;
    background:#fff; transition:border .2s;
}
.srd-field input:focus, .srd-field select:focus { outline:none; border-color:var(--g-gold); }

.srd-avail-msg {
    font-family:var(--g-sans); font-size:13px; margin-top:6px; color:#999;
}
.srd-avail-msg.success { color:#22c55e; font-weight:600; }

/* Pricing table */
.srd-pricing-table {
    background:#f9f9f9; padding:12px; margin:0 0 20px;
    font-family:var(--g-sans); font-size:13px;
}
.srd-pricing-row {
    display:flex; justify-content:space-between; align-items:center;
    padding:4px 0; margin-bottom:5px; color:#666;
}
.srd-pricing-row:last-child { margin-bottom:0; }
.srd-pricing-row span:last-child { font-weight:600; color:#333; }
.srd-pricing-total {
    display:flex; justify-content:space-between; align-items:center;
    padding:8px 0 0; margin-top:8px; border-top:1px solid #ddd;
    font-family:var(--g-sans); font-size:15px; font-weight:700; color:var(--g-navy);
}

/* Book button */
.srd-btn-book {
    display:block; width:100%; padding:14px;
    font-family:var(--g-sans); font-size:13px; font-weight:700;
    letter-spacing:1px; text-transform:uppercase;
    text-align:center; border:none; border-radius:2px;
    cursor:pointer; transition:all .25s; margin-top:0;
    text-decoration:none;
}
.srd-btn-book.primary { background:var(--g-gold); color:#fff; }
.srd-btn-book.primary:hover { background:#a07e3f; }
.srd-btn-book:disabled { opacity:.5; cursor:not-allowed; }

/* ═══ Other rooms strip ═══ */
.srd-other { max-width:1280px; margin:0 auto; padding:40px 48px 60px; }
.srd-other-title {
    font-family:var(--g-serif); font-size:28px; font-weight:400;
    font-style:italic; color:var(--g-navy); margin-bottom:24px;
}
.srd-other-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
.srd-other-card {
    display:flex; overflow:hidden; background:#fff;
    border:1px solid rgba(12,36,64,.06); transition:all .35s;
    text-decoration:none; color:inherit;
}
.srd-other-card:hover { box-shadow:0 12px 36px rgba(12,36,64,.08); transform:translateY(-2px); }
.srd-other-card-img { width:200px; min-height:180px; flex-shrink:0; overflow:hidden; }
.srd-other-card-img img {
    width:100%; height:100%; object-fit:cover; display:block;
    transition:transform .5s ease;
}
.srd-other-card:hover .srd-other-card-img img { transform:scale(1.05); }
.srd-other-card-body { padding:20px; flex:1; display:flex; flex-direction:column; justify-content:center; }
.srd-other-card-name {
    font-family:var(--g-serif); font-size:20px; font-weight:400;
    font-style:italic; color:var(--g-navy); margin-bottom:6px;
}
.srd-other-card-price { font-family:var(--g-sans); font-size:13px; color:#9ca3af; margin-bottom:10px; }
.srd-other-card-meta { font-family:var(--g-sans); font-size:11px; color:#9ca3af; }

/* ═══ RESPONSIVE ═══ */
@media(max-width:1024px){
    :root { --g-main-h:400px; --g-thumb-h:95px; }
    .srd-container { flex-direction:column; }
    .srd-gallery-col, .srd-details-col { width:100%; height:auto; position:static; }
    .srd-gallery-col { max-height:none; }
    .srd-nav-btn { opacity:1; }
    .srd-thumb-item { width:110px; height:70px; }
    .srd-other { padding:40px 28px 48px; }
    .srd-other-grid { grid-template-columns:1fr; }
}
@media(max-width:768px){
    :root { --g-main-h:320px; --g-thumb-h:80px; }
    .srd-details-col { padding:20px 14px; }
    .srd-nav-btn { width:40px; height:40px; font-size:15px; }
    .srd-prev { left:8px; } .srd-next { right:8px; }
    .srd-thumb-item { width:90px; height:58px; }
    .srd-thumb-strip { gap:8px; padding:0 10px; }
    .srd-badge { top:10px; right:10px; font-size:11px; padding:4px 10px; }
    .srd-lb-nav { width:42px; height:42px; font-size:16px; }
    .srd-lb-prev { left:10px; } .srd-lb-next { right:10px; }
    .srd-details-grid { grid-template-columns:1fr 1fr; }
    .srd-other { padding:32px 14px 40px; }
}
@media(max-width:480px){
    :root { --g-main-h:260px; --g-thumb-h:68px; }
    .srd-details-col { padding:16px 10px; }
    .srd-room-title { font-size:26px; }
    .srd-nav-btn { width:36px; height:36px; font-size:14px; }
    .srd-thumb-item { width:72px; height:48px; }
    .srd-thumb-strip { gap:6px; padding:0 8px; }
    .srd-details-grid { grid-template-columns:1fr; }
    .srd-date-row { grid-template-columns:1fr; gap:0; }
    .srd-date-row .srd-field { margin-bottom:15px; }
    .srd-lb-close { top:12px; right:14px; font-size:30px; width:40px; height:40px; }
    .srd-lb-badge { top:16px; left:14px; font-size:12px; }
    .srd-lb-nav { width:36px; height:36px; font-size:14px; }
    .srd-lb-prev { left:6px; } .srd-lb-next { right:6px; }
    .srd-other-card { flex-direction:column; }
    .srd-other-card-img { width:100%; height:180px; }
}
</style>
@endsection

@section('main')
<div class="srd-container">
    {{-- ══ Gallery Column ══ --}}
    <aside class="srd-gallery-col">
        <div class="srd-main-display" id="gallery-main">
            <span class="srd-badge"><span id="curr-idx">1</span> / {{ count($images) }}</span>
            <button class="srd-nav-btn srd-prev" id="btn-prev" aria-label="Previous photo">&#10094;</button>
            <button class="srd-nav-btn srd-next" id="btn-next" aria-label="Next photo">&#10095;</button>
            <img id="main-feat-img" src="{{ $images[0] }}" alt="{{ $roomdetails->type->name ?? $entityLabel }}">
        </div>
        <div class="srd-thumb-strip" id="thumb-strip">
            @foreach($images as $i => $src)
            <div class="srd-thumb-item {{ $i === 0 ? 'is-active' : '' }}" data-index="{{ $i }}">
                <img src="{{ $src }}" alt="Photo {{ $i + 1 }}">
            </div>
            @endforeach
        </div>
    </aside>

    {{-- ══ Details Column ══ --}}
    <main class="srd-details-col">
        {{-- Room header --}}
        <div class="srd-room-header">
            <span class="srd-room-badge {{ $isHall ? 'hall' : 'room' }}">{{ $entityLabel }}</span>
            <h1 class="srd-room-title">{{ $roomdetails->type->name ?? $entityLabel }}</h1>
            <div class="srd-room-price">
                @if($roomdetails->discount > 0)
                    <span class="old">$ {{ number_format($roomdetails->price,0) }}</span>
                    $ {{ number_format($roomdetails->price - ($roomdetails->price * $roomdetails->discount / 100),0) }}
                @else
                    $ {{ number_format($roomdetails->price,0) }}
                @endif
                <span class="unit">/ {{ $unitLabel }}</span>
            </div>
        </div>

        {{-- About --}}
        <div class="srd-section-title">About This {{ $entityLabel }}</div>
        <div class="srd-description">{!! $roomdetails->description !!}</div>

        {{-- Details grid --}}
        <div class="srd-section-title">Details</div>
        <div class="srd-details-grid">
            @if($roomdetails->room_capacity)
            <div class="srd-detail-card">
                <div class="srd-detail-label">Capacity</div>
                <div class="srd-detail-value">{{ $roomdetails->room_capacity }} Person</div>
            </div>
            @endif
            @if($roomdetails->size)
            <div class="srd-detail-card">
                <div class="srd-detail-label">Size</div>
                <div class="srd-detail-value">{{ $roomdetails->size }}</div>
            </div>
            @endif
            @if($roomdetails->view)
            <div class="srd-detail-card">
                <div class="srd-detail-label">View</div>
                <div class="srd-detail-value">{{ $roomdetails->view }}</div>
            </div>
            @endif
            @if($roomdetails->bed_style)
            <div class="srd-detail-card">
                <div class="srd-detail-label">Bed Style</div>
                <div class="srd-detail-value">{{ $roomdetails->bed_style }}</div>
            </div>
            @endif
        </div>

        {{-- Facilities --}}
        @if($facility->count())
        <div class="srd-section-title">Facilities</div>
        <div class="srd-facilities">
            @foreach($facility as $fac)
            <span class="srd-fac-tag">
                <svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg>
                {{ $fac->facility_name }}
            </span>
            @endforeach
        </div>
        @endif

        {{-- ══ Booking Card ══ --}}
        <div class="srd-book-card">
            <div class="srd-book-header">
                <span class="srd-book-price-label">$ {{ number_format($roomdetails->price,0) }}</span>
                <span class="srd-book-unit">/ {{ $unitLabel }}</span>
            </div>
            <div class="srd-book-body">
                <form action="{{ route('user_booking_store', $roomdetails->id) }}" method="post" id="bk_form">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $roomdetails->id }}">
                    <input type="hidden" id="room_price" value="{{ $roomdetails->price }}">
                    <input type="hidden" id="discount_p" value="{{ $roomdetails->discount }}">
                    <input type="hidden" id="total_adult" value="{{ $roomdetails->total_adult }}">
                    <input type="hidden" name="available_room" id="available_room">

                    <div class="srd-date-row">
                        <div class="srd-field">
                            <label>Check In</label>
                            <input type="text" name="check_in" id="check_in" required autocomplete="off"
                                   placeholder="Select date" value="{{ old('check_in') ? date('Y-m-d', strtotime(old('check_in'))) : '' }}">
                        </div>
                        <div class="srd-field">
                            <label>Check Out</label>
                            <input type="text" name="check_out" id="check_out" required autocomplete="off"
                                   placeholder="Select date" value="{{ old('check_out') ? date('Y-m-d', strtotime(old('check_out'))) : '' }}">
                        </div>
                    </div>

                    <div style="display:none">
                        <select name="persion" id="nmbr_person">
                            @for($i = 1; $i <= 4; $i++)
                            <option {{ old('persion') == $i ? 'selected' : '' }} value="0{{ $i }}">0{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="srd-field">
                        <label>Number of {{ $entityLabel }}s</label>
                        <select name="number_of_rooms" id="select_room" class="number_of_rooms">
                            @for($i = 1; $i <= 5; $i++)
                            <option value="0{{ $i }}">0{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="srd-avail-msg available_room"></div>

                    <div class="srd-pricing-table" id="pricing_table" style="display:none">
                        <div class="srd-pricing-row">
                            <span>Rate / {{ $unitLabel }}</span>
                            <span>$ {{ number_format($roomdetails->price,0) }}</span>
                        </div>
                        <div class="srd-pricing-row">
                            <span>Nights</span>
                            <span class="t_nights">0</span>
                        </div>
                        <div class="srd-pricing-row">
                            <span>{{ $entityLabel }}s</span>
                            <span class="t_rooms">1</span>
                        </div>
                        <div class="srd-pricing-row">
                            <span>Subtotal</span>
                            <span class="t_subtotal">$ 0</span>
                        </div>
                        @if($roomdetails->discount > 0)
                        <div class="srd-pricing-row">
                            <span>Discount ({{ $roomdetails->discount }}%)</span>
                            <span class="t_discount" style="color:#22c55e">-$ 0</span>
                        </div>
                        @endif
                        <div class="srd-pricing-total">
                            <span>Total</span>
                            <span class="t_g_total">$ 0</span>
                        </div>
                    </div>

                    @auth
                    <button type="submit" class="srd-btn-book primary" id="book_now_btn" disabled>Book Now</button>
                    @else
                    <a href="{{ route('login') }}?redirect={{ urlencode(url()->full()) }}" class="srd-btn-book primary">Login to Book</a>
                    @endauth
                </form>
            </div>
        </div>
    </main>
</div>

{{-- ── Other Rooms ── --}}
@if($otherRooms->count())
<div class="srd-other">
    <div class="srd-other-title">Other {{ $entityLabel }}s</div>
    <div class="srd-other-grid">
        @foreach($otherRooms as $item)
        <a class="srd-other-card" href="{{ route('search_room_details', $item->id.'?check_in='.old('check_in').'&check_out='.old('check_out').'&persion='.old('persion')) }}">
            <div class="srd-other-card-img">
                <img src="{{ asset('upload/roomimg/'.$item->image) }}" alt="{{ $item->type->name ?? 'Room' }}" loading="lazy">
            </div>
            <div class="srd-other-card-body">
                <div class="srd-other-card-name">{{ $item->type->name ?? 'Room' }}</div>
                <div class="srd-other-card-price">$ {{ number_format($item->price,0) }} / {{ $unitLabel }}</div>
                <div class="srd-other-card-meta">
                    @if($item->room_capacity) {{ $item->room_capacity }} Person @endif
                    @if($item->bed_style) &middot; {{ $item->bed_style }} @endif
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- ══ Lightbox ══ --}}
<div id="lightbox" class="srd-lightbox" role="dialog" aria-modal="true" aria-label="Image viewer">
    <span class="srd-lb-badge"><span id="lb-idx">1</span> / {{ count($images) }}</span>
    <button class="srd-lb-close" id="lb-close" aria-label="Close lightbox">&times;</button>
    <button class="srd-lb-nav srd-lb-prev" id="lb-prev" aria-label="Previous photo">&#10094;</button>
    <button class="srd-lb-nav srd-lb-next" id="lb-next" aria-label="Next photo">&#10095;</button>
    <img id="lb-img" src="" alt="Zoomed photo">
</div>
@endsection

@section('scripts')
<script>
(function(){
    'use strict';

    /* ── Gallery Data ── */
    var photos = @json($images);
    var idx = 0;
    var lbOpen = false;

    /* ── DOM ── */
    var mainImg  = document.getElementById('main-feat-img');
    var badge    = document.getElementById('curr-idx');
    var thumbs   = document.querySelectorAll('.srd-thumb-item');
    var strip    = document.getElementById('thumb-strip');
    var btnPrev  = document.getElementById('btn-prev');
    var btnNext  = document.getElementById('btn-next');

    var lb       = document.getElementById('lightbox');
    var lbImg    = document.getElementById('lb-img');
    var lbBadge  = document.getElementById('lb-idx');
    var lbClose  = document.getElementById('lb-close');
    var lbPrev   = document.getElementById('lb-prev');
    var lbNext   = document.getElementById('lb-next');

    /* ── Navigate ── */
    function goTo(newIdx) {
        if (newIdx < 0) newIdx = photos.length - 1;
        if (newIdx >= photos.length) newIdx = 0;
        idx = newIdx;

        mainImg.classList.add('is-fading');
        setTimeout(function () {
            mainImg.src = photos[idx];
            mainImg.classList.remove('is-fading');
        }, 200);

        badge.textContent = idx + 1;

        thumbs.forEach(function (t, i) {
            var active = (i === idx);
            t.classList.toggle('is-active', active);
            if (active) scrollThumbIntoView(t);
        });

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
        var sLeft = strip.scrollLeft, sWidth = strip.clientWidth;
        var tLeft = thumb.offsetLeft, tWidth = thumb.offsetWidth;
        var target;
        if (tLeft < sLeft + 16) target = tLeft - 16;
        else if (tLeft + tWidth > sLeft + sWidth - 16) target = tLeft + tWidth - sWidth + 16;
        else return;
        strip.scrollTo({ left: target, behavior: 'smooth' });
    }

    /* ── Gallery events ── */
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
    lb.addEventListener('click', function (e) { if (e.target === lb) closeLightbox(); });

    /* ── Lightbox nav ── */
    lbNext.addEventListener('click', function (e) { e.stopPropagation(); goTo(idx + 1); });
    lbPrev.addEventListener('click', function (e) { e.stopPropagation(); goTo(idx - 1); });

    /* ── Keyboard ── */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && lbOpen) { closeLightbox(); return; }
        if (e.key === 'ArrowRight') { goTo(idx + 1); return; }
        if (e.key === 'ArrowLeft')  { goTo(idx - 1); return; }
    });

    /* ── Touch swipe ── */
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

    /* ════════════════════════════════════
       BOOKING LOGIC (unchanged)
    ════════════════════════════════════ */
    var ciField = document.getElementById('check_in');
    var coField = document.getElementById('check_out');
    var roomIdVal = "{{ $room_id }}";

    new Pikaday({ field: ciField, format: 'YYYY-MM-DD', minDate: new Date(), onSelect: function(){ checkDates(); } });
    new Pikaday({ field: coField, format: 'YYYY-MM-DD', minDate: new Date(), onSelect: function(){ checkDates(); } });

    if(ciField.value && coField.value) getAvailability(ciField.value, coField.value, roomIdVal);

    document.getElementById('select_room').addEventListener('change', function(){ checkDates(); });

    function checkDates(){
        if(ciField.value && coField.value) getAvailability(ciField.value, coField.value, roomIdVal);
    }

    function getAvailability(check_in, check_out, room_id){
        var url = "{{ route('check_room_availability') }}" +
            '?room_id=' + encodeURIComponent(room_id) +
            '&check_in=' + encodeURIComponent(check_in) +
            '&check_out=' + encodeURIComponent(check_out);

        fetch(url)
            .then(function(r){ return r.json(); })
            .then(function(data){
                var el = document.querySelector('.available_room');
                el.classList.add('success');
                el.innerHTML = '&#10003; ' + data.available_room + ' {{ $entityLabel }}(s) available';
                document.getElementById('available_room').value = data.available_room;
                var btn = document.getElementById('book_now_btn');
                if(btn) btn.disabled = false;
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
        if(discEl) discEl.textContent = '-$ ' + disc.toLocaleString();
        document.querySelector('.t_g_total').textContent = '$ ' + total.toLocaleString();
        document.getElementById('pricing_table').style.display = '';
    }

    document.getElementById('bk_form').addEventListener('submit', function(e){
        var avRoom     = parseInt(document.getElementById('available_room').value);
        var selectRoom = parseInt(document.getElementById('select_room').value);
        if(selectRoom > avRoom){
            e.preventDefault();
            alert('Sorry, only ' + avRoom + ' {{ $entityLabel }}(s) available. Please select fewer.');
        }
    });
})();
</script>
@endsection
