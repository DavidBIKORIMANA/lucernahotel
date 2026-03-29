@extends('frontend.main_master')

@section('styles')
@php
    $isHall = ($roomdetails->type->type ?? 'Room') === 'Hall';
    $unitLabel = $isHall ? 'event' : 'night';
    $entityLabel = $isHall ? 'Hall' : 'Room';
@endphp
/* ══════════════════════════════
   SEARCH ROOM DETAILS PAGE
══════════════════════════════ */
.srd-hero {
    position:relative; height:420px; overflow:hidden;
}
.srd-hero-img { width:100%; height:100%; object-fit:cover; display:block; }
.srd-hero-overlay {
    position:absolute; inset:0;
    background:linear-gradient(to bottom,rgba(7,22,38,.15) 0%,rgba(7,22,38,.7) 100%);
}
.srd-hero-content {
    position:absolute; bottom:0; left:0; right:0;
    padding:40px 48px; z-index:2; max-width:1280px; margin:0 auto;
}
.srd-breadcrumb {
    display:flex; align-items:center; gap:8px; margin-bottom:14px;
    font-family:var(--f-body); font-size:12px; color:rgba(255,255,255,.5);
}
.srd-breadcrumb a { color:rgba(255,255,255,.7); text-decoration:none; }
.srd-breadcrumb a:hover { color:var(--white); }
.srd-breadcrumb svg { width:12px; height:12px; stroke:rgba(255,255,255,.4); }
.srd-badge-type {
    display:inline-block; font-family:var(--f-body); font-size:10px; font-weight:700;
    letter-spacing:.2em; text-transform:uppercase;
    padding:4px 12px; border-radius:2px; margin-bottom:10px;
}
.srd-badge-type.room { background:var(--brand); color:var(--white); }
.srd-badge-type.hall { background:var(--gold); color:var(--navy); }
.srd-hero-title {
    font-family:var(--f-head); font-size:clamp(28px,4.5vw,48px);
    font-weight:500; font-style:italic; color:var(--white); margin-bottom:8px;
}
.srd-hero-price {
    font-family:var(--f-head); font-size:24px; font-weight:600; color:var(--brand-pale);
}
.srd-hero-price span { font-family:var(--f-body); font-size:13px; color:rgba(255,255,255,.4); }

/* ── Gallery ── */
.srd-gallery { max-width:1280px; margin:0 auto; padding:0 48px; margin-top:-1px; }
.srd-gallery-grid {
    display:grid; grid-template-columns:2fr 1fr 1fr; gap:6px;
    height:380px; overflow:hidden;
}
.srd-gallery-grid.single { grid-template-columns:1fr; }
.srd-gallery-item { overflow:hidden; cursor:pointer; position:relative; }
.srd-gallery-item:first-child { grid-row:1/3; }
.srd-gallery-item img {
    width:100%; height:100%; object-fit:cover; display:block;
    transition:transform .5s var(--ease);
}
.srd-gallery-item:hover img { transform:scale(1.05); }

/* ── Main layout ── */
.srd-main {
    max-width:1280px; margin:0 auto; padding:40px 48px 60px;
    display:grid; grid-template-columns:1fr 380px; gap:40px;
    align-items:start;
}

/* ── Content column ── */
.srd-section-title {
    font-family:var(--f-body); font-size:12px; font-weight:700;
    letter-spacing:.2em; text-transform:uppercase;
    color:var(--brand); margin-bottom:16px;
    padding-bottom:10px; border-bottom:2px solid rgba(12,77,162,.08);
}
.srd-description {
    font-family:var(--f-body); font-size:15px; color:var(--ink);
    line-height:1.8; margin-bottom:32px;
}
.srd-details-grid {
    display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:32px;
}
.srd-detail-card {
    padding:18px 20px; background:var(--off-white); border-left:3px solid var(--brand);
    transition:background .2s;
}
.srd-detail-card:hover { background:#eef3fa; }
.srd-detail-label {
    font-family:var(--f-body); font-size:10px; font-weight:700;
    letter-spacing:.18em; text-transform:uppercase; color:var(--soft);
    margin-bottom:4px;
}
.srd-detail-value {
    font-family:var(--f-head); font-size:18px; color:var(--navy);
}
.srd-facilities {
    display:flex; flex-wrap:wrap; gap:8px; margin-bottom:32px;
}
.srd-fac-tag {
    display:inline-flex; align-items:center; gap:6px;
    font-family:var(--f-body); font-size:12px; color:var(--navy);
    background:var(--off-white); padding:7px 14px; border-radius:2px;
    border:1px solid rgba(12,36,64,.06); transition:all .2s;
}
.srd-fac-tag:hover { background:var(--brand-pale); }
.srd-fac-tag svg { width:14px; height:14px; stroke:var(--brand); flex-shrink:0; }

/* ── Booking sidebar ── */
.srd-sidebar { position:sticky; top:24px; }
.srd-book-card {
    background:var(--white); border:1px solid rgba(12,36,64,.06);
    overflow:hidden;
}
.srd-book-header {
    background:var(--navy); padding:20px 24px;
    display:flex; align-items:baseline; gap:8px;
}
.srd-book-price {
    font-family:var(--f-head); font-size:28px; font-weight:600; color:var(--white);
}
.srd-book-unit {
    font-family:var(--f-body); font-size:13px; color:rgba(255,255,255,.4);
}
.srd-book-body { padding:24px; }
.srd-field { margin-bottom:16px; }
.srd-field label {
    display:block; font-family:var(--f-body); font-size:10px; font-weight:700;
    letter-spacing:.18em; text-transform:uppercase; color:var(--soft);
    margin-bottom:6px;
}
.srd-field input, .srd-field select {
    width:100%; padding:10px 14px;
    font-family:var(--f-body); font-size:14px; color:var(--ink);
    border:1px solid rgba(12,36,64,.1); border-radius:2px;
    background:var(--off-white); transition:border .2s;
}
.srd-field input:focus, .srd-field select:focus {
    outline:none; border-color:var(--brand);
}
.srd-avail-msg {
    font-family:var(--f-body); font-size:13px; margin-top:6px;
    color:var(--soft);
}
.srd-avail-msg.success { color:#22c55e; font-weight:600; }
.srd-pricing-table { margin:20px 0 0; }
.srd-pricing-row {
    display:flex; justify-content:space-between; align-items:center;
    padding:8px 0; border-bottom:1px solid rgba(12,36,64,.04);
    font-family:var(--f-body); font-size:13px; color:var(--soft);
}
.srd-pricing-row:last-child { border-bottom:none; }
.srd-pricing-row span:last-child { font-weight:600; color:var(--ink); }
.srd-pricing-total {
    display:flex; justify-content:space-between; align-items:center;
    padding:14px 0 0; margin-top:6px;
    border-top:2px solid var(--navy);
    font-family:var(--f-head); font-size:20px; font-weight:600; color:var(--navy);
}
.srd-btn-book {
    display:block; width:100%; padding:14px;
    font-family:var(--f-body); font-size:12px; font-weight:700;
    letter-spacing:.18em; text-transform:uppercase;
    text-align:center; border:none; border-radius:2px;
    cursor:pointer; transition:all .25s; margin-top:20px;
    text-decoration:none;
}
.srd-btn-book.primary { background:var(--brand); color:var(--white); }
.srd-btn-book.primary:hover { background:var(--brand-light); }
.srd-btn-book:disabled { opacity:.5; cursor:not-allowed; }

/* ── Other rooms ── */
.srd-other {
    max-width:1280px; margin:0 auto; padding:0 48px 60px;
}
.srd-other-title {
    font-family:var(--f-head); font-size:28px; font-weight:400;
    font-style:italic; color:var(--navy); margin-bottom:24px;
}
.srd-other-grid {
    display:grid; grid-template-columns:1fr 1fr; gap:20px;
}
.srd-other-card {
    display:flex; overflow:hidden; background:var(--white);
    border:1px solid rgba(12,36,64,.06); transition:all .35s;
    text-decoration:none; color:inherit;
}
.srd-other-card:hover { box-shadow:0 12px 36px rgba(12,36,64,.08); transform:translateY(-2px); }
.srd-other-card-img { width:200px; min-height:180px; flex-shrink:0; overflow:hidden; }
.srd-other-card-img img {
    width:100%; height:100%; object-fit:cover; display:block;
    transition:transform .5s var(--ease);
}
.srd-other-card:hover .srd-other-card-img img { transform:scale(1.05); }
.srd-other-card-body {
    padding:20px; flex:1; display:flex; flex-direction:column; justify-content:center;
}
.srd-other-card-name {
    font-family:var(--f-head); font-size:20px; font-weight:400;
    font-style:italic; color:var(--navy); margin-bottom:6px;
}
.srd-other-card-price {
    font-family:var(--f-body); font-size:13px; color:var(--soft); margin-bottom:10px;
}
.srd-other-card-meta {
    font-family:var(--f-body); font-size:11px; color:var(--soft);
}

@media(max-width:1024px){
    .srd-main { grid-template-columns:1fr; } .srd-sidebar { position:static; max-width:480px; }
    .srd-hero-content { padding:32px 28px; } .srd-gallery { padding:0 28px; } .srd-main { padding:32px 28px 48px; } .srd-other { padding:0 28px 48px; }
    .srd-other-grid { grid-template-columns:1fr; }
}
@media(max-width:768px){
    .srd-hero { height:320px; } .srd-gallery-grid { grid-template-columns:1fr 1fr; height:280px; }
    .srd-gallery-item:first-child { grid-row:auto; } .srd-details-grid { grid-template-columns:1fr; }
    .srd-hero-content { padding:24px 14px; } .srd-gallery { padding:0 14px; } .srd-main { padding:24px 14px 40px; } .srd-other { padding:0 14px 40px; }
}
@media(max-width:480px){
    .srd-hero { height:260px; } .srd-gallery-grid { height:220px; }
    .srd-other-card { flex-direction:column; } .srd-other-card-img { width:100%; height:180px; }
}
@endsection

@section('main')

{{-- ── Hero ── --}}
<section class="srd-hero">
    <img class="srd-hero-img" src="{{ asset('upload/roomimg/'.$roomdetails->image) }}" alt="{{ $roomdetails->type->name ?? 'Room' }}">
    <div class="srd-hero-overlay"></div>
    <div class="srd-hero-content">
        <div class="srd-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <svg viewBox="0 0 24 24" fill="none"><polyline points="9 18 15 12 9 6"/></svg>
            <a href="{{ route('froom.all') }}">{{ $entityLabel }}s</a>
            <svg viewBox="0 0 24 24" fill="none"><polyline points="9 18 15 12 9 6"/></svg>
            <span style="color:rgba(255,255,255,.8)">{{ $roomdetails->type->name ?? $entityLabel }}</span>
        </div>
        <span class="srd-badge-type {{ $isHall ? 'hall' : 'room' }}">{{ $entityLabel }}</span>
        <h1 class="srd-hero-title">{{ $roomdetails->type->name ?? 'Room' }}</h1>
        <div class="srd-hero-price">
            @if($roomdetails->discount > 0)
                <span style="text-decoration:line-through;color:rgba(255,255,255,.35);font-size:18px">RwF {{ number_format($roomdetails->price,0) }}</span>
                RwF {{ number_format($roomdetails->price - ($roomdetails->price * $roomdetails->discount / 100),0) }}
            @else
                RwF {{ number_format($roomdetails->price,0) }}
            @endif
            <span>/ {{ $unitLabel }}</span>
        </div>
    </div>
</section>

{{-- ── Photo Gallery ── --}}
@if($multiImage->count())
<div class="srd-gallery">
    <div class="srd-gallery-grid {{ $multiImage->count() == 1 ? 'single' : '' }}">
        @foreach($multiImage->take(5) as $idx => $img)
        <div class="srd-gallery-item">
            <img src="{{ asset('upload/roomimg/multi_img/'.$img->multi_img) }}" alt="Gallery {{ $idx+1 }}" loading="lazy">
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- ── Main: Content + Booking Sidebar ── --}}
<div class="srd-main">
    {{-- Content --}}
    <div class="srd-content">
        <div class="srd-section-title">About This {{ $entityLabel }}</div>
        <div class="srd-description">{!! $roomdetails->description !!}</div>

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
    </div>

    {{-- Booking Sidebar --}}
    <div class="srd-sidebar">
        <div class="srd-book-card">
            <div class="srd-book-header">
                <span class="srd-book-price">RwF {{ number_format($roomdetails->price,0) }}</span>
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
                            <span>RwF {{ number_format($roomdetails->price,0) }}</span>
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
                            <span class="t_subtotal">RwF 0</span>
                        </div>
                        @if($roomdetails->discount > 0)
                        <div class="srd-pricing-row">
                            <span>Discount ({{ $roomdetails->discount }}%)</span>
                            <span class="t_discount" style="color:#22c55e">-RwF 0</span>
                        </div>
                        @endif
                        <div class="srd-pricing-total">
                            <span>Total</span>
                            <span class="t_g_total">RwF 0</span>
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
    </div>
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
                <div class="srd-other-card-price">RwF {{ number_format($item->price,0) }} / {{ $unitLabel }}</div>
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
@endsection

@section('scripts')
<script>
(function(){
    'use strict';

    var ciField = document.getElementById('check_in');
    var coField = document.getElementById('check_out');
    var roomIdVal = "{{ $room_id }}";

    // Pikaday date pickers
    new Pikaday({
        field: ciField,
        format: 'YYYY-MM-DD',
        minDate: new Date(),
        onSelect: function(){ checkDates(); }
    });
    new Pikaday({
        field: coField,
        format: 'YYYY-MM-DD',
        minDate: new Date(),
        onSelect: function(){ checkDates(); }
    });

    // Auto-check on page load if dates pre-filled
    if(ciField.value && coField.value){
        getAvailability(ciField.value, coField.value, roomIdVal);
    }

    // Re-check when room count changes
    document.getElementById('select_room').addEventListener('change', function(){ checkDates(); });

    function checkDates(){
        if(ciField.value && coField.value){
            getAvailability(ciField.value, coField.value, roomIdVal);
        }
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
        document.querySelector('.t_subtotal').textContent = 'RwF ' + subtotal.toLocaleString();
        var discEl = document.querySelector('.t_discount');
        if(discEl) discEl.textContent = '-RwF ' + disc.toLocaleString();
        document.querySelector('.t_g_total').textContent = 'RwF ' + total.toLocaleString();
        document.getElementById('pricing_table').style.display = '';
    }

    // Form validation
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
