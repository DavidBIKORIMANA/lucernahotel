@extends('frontend.main_master')

@section('styles')
@php
    $isHall = ($roomdetails->type->type ?? 'Room') === 'Hall';
    $unitLabel = $isHall ? 'event' : 'night';
    $entityLabel = $isHall ? 'Hall' : 'Room';
@endphp
/* ══════════════════════════════
   ROOM / HALL DETAILS — CLEAN
══════════════════════════════ */

/* Kill Tailwind focus ring leak */
*, *::before, *::after {
    --tw-border-opacity:1 !important;
}
input:focus, select:focus, textarea:focus, button:focus {
    outline:none !important;
    box-shadow:none !important;
    border-color:var(--brand) !important;
    --tw-ring-shadow:none !important;
    --tw-ring-color:transparent !important;
}

/* ── Header ── */
.rd-header {
    background:linear-gradient(135deg, var(--navy) 0%, #0a1a30 100%);
    padding:32px 60px 36px; max-width:100%;
}
.rd-header-inner { max-width:1320px; margin:0 auto; }
.rd-breadcrumb {
    display:flex; align-items:center; gap:8px; margin-bottom:16px;
    font-family:var(--f-body); font-size:13px; color:rgba(255,255,255,.5);
}
.rd-breadcrumb a { color:rgba(255,255,255,.65); text-decoration:none; transition:color .2s; }
.rd-breadcrumb a:hover { color:var(--white); }
.rd-breadcrumb svg { width:14px; height:14px; stroke:rgba(255,255,255,.35); }
.rd-badge-type {
    display:inline-block; font-family:var(--f-body); font-size:11px; font-weight:700;
    letter-spacing:.2em; text-transform:uppercase;
    padding:5px 14px; border-radius:2px; margin-bottom:12px;
}
.rd-badge-type.room { background:var(--brand); color:var(--white); }
.rd-badge-type.hall { background:var(--gold); color:var(--navy); }
.rd-header-title {
    font-family:var(--f-head); font-size:clamp(32px,5vw,48px);
    font-weight:500; font-style:italic; color:var(--white);
    margin-bottom:10px; line-height:1.15;
}
.rd-header-price {
    font-family:var(--f-head); font-size:26px; font-weight:600; color:var(--white);
}
.rd-header-price .old {
    text-decoration:line-through; color:rgba(255,255,255,.35);
    font-size:18px; margin-right:10px; font-weight:400;
}
.rd-header-price .unit {
    font-family:var(--f-body); font-size:14px; color:rgba(255,255,255,.4);
    margin-left:4px;
}

/* ── Gallery ── */
.rd-gallery { max-width:1320px; margin:0 auto; padding:0 60px; }
.rd-gallery-grid {
    display:grid; grid-template-columns:2fr 1fr 1fr; gap:6px;
    height:400px; overflow:hidden; margin-top:-1px;
}
.rd-gallery-grid.single { grid-template-columns:1fr; }
.rd-gallery-item { overflow:hidden; cursor:pointer; position:relative; }
.rd-gallery-item:first-child { grid-row:1/3; }
.rd-gallery-item img {
    width:100%; height:100%; object-fit:cover; display:block;
    transition:transform .6s var(--ease);
}
.rd-gallery-item:hover img { transform:scale(1.06); }
.rd-gallery-more {
    position:absolute; inset:0; background:rgba(7,22,38,.6);
    display:flex; align-items:center; justify-content:center;
    font-family:var(--f-body); font-size:15px; font-weight:600;
    color:var(--white); letter-spacing:.1em;
}

/* ── Main two-column layout ── */
.rd-main {
    max-width:1320px; margin:0 auto; padding:48px 60px 64px;
    display:grid; grid-template-columns:1fr 400px; gap:48px;
    align-items:start;
}

/* ── Content ── */
.rd-section-label {
    font-family:var(--f-body); font-size:13px; font-weight:700;
    letter-spacing:.22em; text-transform:uppercase;
    color:var(--brand); margin-bottom:18px;
    padding-bottom:12px; border-bottom:2px solid rgba(12,77,162,.06);
}
.rd-desc {
    font-family:var(--f-body); font-size:16px; color:var(--ink);
    line-height:1.85; margin-bottom:36px;
}
.rd-desc p { margin-bottom:14px; }

/* Details grid */
.rd-details-grid {
    display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:36px;
}
.rd-detail-card {
    padding:20px 22px; background:var(--off-white);
    border-left:3px solid var(--brand); transition:background .2s;
}
.rd-detail-card:hover { background:#edf2f9; }
.rd-detail-card .label {
    font-family:var(--f-body); font-size:11px; font-weight:700;
    letter-spacing:.18em; text-transform:uppercase;
    color:var(--soft); margin-bottom:6px;
}
.rd-detail-card .value {
    font-family:var(--f-head); font-size:20px; font-weight:500;
    color:var(--navy);
}

/* Facilities */
.rd-facilities { display:flex; flex-wrap:wrap; gap:10px; margin-bottom:36px; }
.rd-fac-tag {
    display:inline-flex; align-items:center; gap:6px;
    font-family:var(--f-body); font-size:13px; font-weight:500;
    padding:8px 16px; background:var(--off-white); color:var(--navy);
    border:1px solid rgba(12,36,64,.06); border-radius:2px; transition:all .2s;
}
.rd-fac-tag:hover { background:var(--brand-pale); border-color:rgba(12,77,162,.12); }
.rd-fac-tag svg { width:14px; height:14px; stroke:var(--brand); flex-shrink:0; }

/* ── Booking Sidebar ── */
.rd-booking {
    position:sticky; top:108px;
    background:var(--white); border:1px solid rgba(12,36,64,.06);
    box-shadow:0 8px 40px rgba(12,36,64,.07);
    overflow:hidden;
}
.rd-booking-header {
    background:var(--navy); padding:24px 28px;
}
.rd-booking-title {
    font-family:var(--f-head); font-size:22px; font-weight:500;
    color:var(--white); margin-bottom:4px;
}
.rd-booking-subtitle {
    font-family:var(--f-body); font-size:13px; color:rgba(255,255,255,.45);
}
.rd-booking-body { padding:28px; }
.rd-field { margin-bottom:18px; }
.rd-field label {
    display:block; font-family:var(--f-body); font-size:11px; font-weight:700;
    letter-spacing:.18em; text-transform:uppercase;
    color:var(--soft); margin-bottom:8px;
}
.rd-field input, .rd-field select {
    width:100%; border:1px solid rgba(12,36,64,.1);
    background:var(--off-white); border-radius:2px;
    font-family:var(--f-body); font-size:15px; color:var(--navy);
    padding:12px 16px; outline:none; transition:border-color .2s;
    -webkit-appearance:none; appearance:none;
}
.rd-field input:focus, .rd-field select:focus {
    border-color:var(--brand) !important; background:var(--white);
    box-shadow:0 0 0 3px rgba(12,77,162,.06) !important;
}
.rd-field-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
.rd-avail-btn {
    width:100%; padding:13px;
    font-family:var(--f-body); font-size:12px; font-weight:700;
    letter-spacing:.16em; text-transform:uppercase;
    border:2px solid var(--brand); background:transparent; color:var(--brand);
    cursor:pointer; border-radius:2px; transition:all .25s; margin-bottom:18px;
}
.rd-avail-btn:hover { background:rgba(12,77,162,.04); }
.rd-avail-result {
    padding:14px 16px; border-radius:2px; margin-bottom:18px;
    font-family:var(--f-body); font-size:14px; display:none;
}
.rd-avail-result.available { background:rgba(34,197,94,.07); color:#16a34a; border:1px solid rgba(34,197,94,.15); }
.rd-avail-result.unavailable { background:rgba(239,68,68,.07); color:#dc2626; border:1px solid rgba(239,68,68,.15); }
.rd-avail-result.show { display:block; }

/* Price table */
.rd-price-table { width:100%; margin-bottom:18px; border-collapse:collapse; }
.rd-price-table td {
    padding:11px 0; font-family:var(--f-body); font-size:14px;
    color:var(--soft); border-bottom:1px solid rgba(12,36,64,.04);
}
.rd-price-table td:last-child { text-align:right; font-weight:600; color:var(--navy); }
.rd-price-table tr:last-child td {
    font-size:18px; font-weight:700; border-bottom:none;
    padding-top:16px; color:var(--brand);
    border-top:2px solid rgba(12,77,162,.08);
}
.rd-book-submit {
    width:100%; padding:15px;
    font-family:var(--f-body); font-size:13px; font-weight:700;
    letter-spacing:.18em; text-transform:uppercase;
    background:var(--brand); color:var(--white); border:none;
    cursor:pointer; border-radius:2px; transition:all .25s;
}
.rd-book-submit:hover { background:#0a56b5; transform:translateY(-1px); box-shadow:0 6px 20px rgba(12,77,162,.28); }
.rd-book-submit:disabled { opacity:.45; cursor:not-allowed; transform:none; box-shadow:none; }

/* ── Other rooms ── */
.rd-others { max-width:1320px; margin:0 auto; padding:0 60px 64px; }
.rd-others-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-top:20px; }
.rd-other-card {
    display:flex; overflow:hidden; background:var(--white);
    border:1px solid rgba(12,36,64,.06); transition:all .35s;
    text-decoration:none; color:inherit;
}
.rd-other-card:hover { box-shadow:0 10px 32px rgba(12,36,64,.08); transform:translateY(-2px); }
.rd-other-img-wrap { width:200px; flex-shrink:0; overflow:hidden; }
.rd-other-img { width:100%; height:100%; object-fit:cover; display:block; min-height:200px; transition:transform .5s var(--ease); }
.rd-other-card:hover .rd-other-img { transform:scale(1.05); }
.rd-other-info { padding:22px; flex:1; display:flex; flex-direction:column; }
.rd-other-name {
    font-family:var(--f-head); font-size:22px; font-weight:500;
    color:var(--navy); margin-bottom:6px;
}
.rd-other-price {
    font-family:var(--f-body); font-size:15px; color:var(--brand); font-weight:600; margin-bottom:10px;
}
.rd-other-desc {
    font-family:var(--f-body); font-size:14px; color:var(--soft);
    line-height:1.6; flex:1;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
}
.rd-other-link {
    font-family:var(--f-body); font-size:12px; font-weight:700;
    letter-spacing:.12em; text-transform:uppercase;
    color:var(--brand); margin-top:12px;
}

/* ── Reviews ── */
.rd-reviews { max-width:1320px; margin:0 auto; padding:0 60px 64px; }
.rd-review-summary {
    display:flex; align-items:center; gap:24px; margin-bottom:28px;
    padding:28px; background:var(--off-white);
}
.rd-review-avg {
    font-family:var(--f-head); font-size:52px; font-weight:600; color:var(--brand); line-height:1;
}
.rd-review-meta { font-family:var(--f-body); }
.rd-review-card {
    padding:22px; background:var(--off-white); margin-bottom:14px;
    border-left:3px solid var(--brand);
}
.rd-review-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; }
.rd-review-author { font-family:var(--f-body); font-size:15px; font-weight:600; color:var(--navy); }
.rd-review-date { font-family:var(--f-body); font-size:13px; color:var(--soft); }
.rd-review-stars { margin-bottom:10px; }
.rd-review-stars i { color:#f5a623; font-size:15px; }
.rd-review-text { font-family:var(--f-body); font-size:15px; color:var(--ink); line-height:1.7; }

/* ── Responsive ── */
@media(max-width:1024px){
    .rd-header { padding:28px 28px 32px; }
    .rd-gallery, .rd-main, .rd-others, .rd-reviews { padding-left:28px; padding-right:28px; }
    .rd-main { grid-template-columns:1fr 360px; gap:32px; }
    .rd-gallery-grid { height:320px; }
}
@media(max-width:768px){
    .rd-header { padding:24px 16px 28px; }
    .rd-header-title { font-size:clamp(26px,7vw,38px); }
    .rd-main { grid-template-columns:1fr; }
    .rd-booking { position:relative; top:0; }
    .rd-gallery, .rd-main, .rd-others, .rd-reviews { padding-left:16px; padding-right:16px; }
    .rd-gallery-grid { grid-template-columns:1fr 1fr; height:280px; }
    .rd-gallery-item:first-child { grid-row:auto; }
    .rd-details-grid { grid-template-columns:1fr; }
    .rd-others-grid { grid-template-columns:1fr; }
    .rd-other-card { flex-direction:column; }
    .rd-other-img-wrap { width:100%; }
    .rd-other-img { min-height:180px; height:180px; }
}
@media(max-width:480px){
    .rd-header-price { font-size:22px; }
    .rd-gallery-grid { grid-template-columns:1fr; height:auto; }
    .rd-gallery-item:first-child { grid-row:auto; }
    .rd-gallery-item { height:220px; }
    .rd-booking-body { padding:20px; }
    .rd-field-row { grid-template-columns:1fr; }
    .rd-review-summary { flex-direction:column; text-align:center; }
}
@endsection

@section('main')
@php
    $isHall = ($roomdetails->type->type ?? 'Room') === 'Hall';
    $unitLabel = $isHall ? 'event' : 'night';
    $entityLabel = $isHall ? 'Hall' : 'Room';
@endphp

{{-- Header --}}
<section class="rd-header">
    <div class="rd-header-inner">
        <div class="rd-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <svg viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <a href="{{ route('froom.all') }}">Rooms &amp; Halls</a>
            <svg viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span>{{ $roomdetails->type->name }}</span>
        </div>
        <span class="rd-badge-type {{ strtolower($entityLabel) }}">{{ $entityLabel }}</span>
        <h1 class="rd-header-title">{{ $roomdetails->type->name }}</h1>
        <div class="rd-header-price">
            @if($roomdetails->discount > 0)
            <span class="old">RwF {{ number_format($roomdetails->price,0) }}</span>
            @endif
            RwF {{ number_format($roomdetails->discount > 0 ? $roomdetails->price - ($roomdetails->price * $roomdetails->discount / 100) : $roomdetails->price, 0) }}
            <span class="unit">/ {{ $unitLabel }}</span>
        </div>
    </div>
</section>

{{-- Photo Gallery --}}
@if($multiImage->count() > 0)
<div class="rd-gallery">
    <div class="rd-gallery-grid{{ $multiImage->count() < 3 ? ' single' : '' }}">
        @foreach($multiImage->take(5) as $idx => $image)
        <div class="rd-gallery-item">
            <img src="{{ asset('upload/roomimg/multi_img/'.$image->multi_img) }}" alt="{{ $roomdetails->type->name }} photo {{ $idx+1 }}" loading="lazy">
            @if($idx === 4 && $multiImage->count() > 5)
            <div class="rd-gallery-more">+{{ $multiImage->count() - 5 }} more</div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- Main content + Booking sidebar --}}
<div class="rd-main">
    {{-- Content --}}
    <div class="rd-content">
        {{-- Description --}}
        <div class="rd-section-label">About This {{ $entityLabel }}</div>
        <div class="rd-desc">{!! $roomdetails->description !!}</div>

        {{-- Details grid --}}
        <div class="rd-section-label">{{ $entityLabel }} Details</div>
        <div class="rd-details-grid">
            @if($roomdetails->room_capacity)
            <div class="rd-detail-card">
                <div class="label">Capacity</div>
                <div class="value">{{ $roomdetails->room_capacity }} {{ $isHall ? 'Guests' : 'Person' }}</div>
            </div>
            @endif
            @if($roomdetails->size)
            <div class="rd-detail-card">
                <div class="label">Size</div>
                <div class="value">{{ $roomdetails->size }} ft²</div>
            </div>
            @endif
            @if($roomdetails->view)
            <div class="rd-detail-card">
                <div class="label">View</div>
                <div class="value">{{ $roomdetails->view }}</div>
            </div>
            @endif
            @if($roomdetails->bed_style && !$isHall)
            <div class="rd-detail-card">
                <div class="label">Bed Style</div>
                <div class="value">{{ $roomdetails->bed_style }}</div>
            </div>
            @endif
        </div>

        {{-- Facilities --}}
        @if($facility->count() > 0)
        <div class="rd-section-label">Facilities &amp; Amenities</div>
        <div class="rd-facilities">
            @foreach($facility as $fac)
            <span class="rd-fac-tag">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                {{ $fac->facility_name }}
            </span>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Booking Sidebar --}}
    <div class="rd-booking">
        <div class="rd-booking-header">
            <div class="rd-booking-title">Reserve This {{ $entityLabel }}</div>
            <div class="rd-booking-subtitle">Check availability &amp; book instantly</div>
        </div>
        <div class="rd-booking-body">
            <form action="{{ route('user_booking_store', $roomdetails->id) }}" method="POST" id="bookingForm">
                @csrf
                <input type="hidden" name="room_id" value="{{ $roomdetails->id }}">
                <input type="hidden" name="persion" value="01">

                <div class="rd-field-row">
                    <div class="rd-field">
                        <label>Check In</label>
                        <input type="text" name="check_in" id="rd_check_in" required autocomplete="off" placeholder="Select date">
                    </div>
                    <div class="rd-field">
                        <label>Check Out</label>
                        <input type="text" name="check_out" id="rd_check_out" required autocomplete="off" placeholder="Select date">
                    </div>
                </div>

                <div class="rd-field">
                    <label>Number of {{ $isHall ? 'Halls' : 'Rooms' }}</label>
                    <select name="number_of_rooms" id="rd_num_rooms">
                        @for($i = 1; $i <= 5; $i++)
                        <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                        @endfor
                    </select>
                </div>

                <input type="hidden" name="available_room" id="rd_available_room" value="0">

                <button type="button" class="rd-avail-btn" id="checkAvailBtn">
                    Check Availability
                </button>

                <div class="rd-avail-result" id="availResult"></div>

                <table class="rd-price-table" id="priceTable" style="display:none">
                    <tr>
                        <td>Rate per {{ $unitLabel }}</td>
                        <td id="pricePerNight">RwF 0</td>
                    </tr>
                    <tr>
                        <td>Nights</td>
                        <td id="totalNights">0</td>
                    </tr>
                    <tr>
                        <td>{{ $isHall ? 'Halls' : 'Rooms' }}</td>
                        <td id="totalRooms">1</td>
                    </tr>
                    @if($roomdetails->discount > 0)
                    <tr>
                        <td>Discount ({{ $roomdetails->discount }}%)</td>
                        <td id="discountAmt">-RwF 0</td>
                    </tr>
                    @endif
                    <tr>
                        <td>Total</td>
                        <td id="grandTotal">RwF 0</td>
                    </tr>
                </table>

                <button type="submit" class="rd-book-submit" id="bookNowBtn" disabled>
                    @auth
                        Book Now
                    @else
                        Login to Book
                    @endauth
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Other Rooms --}}
@if($otherRooms->count() > 0)
<div class="rd-others">
    <div class="rd-section-label">You May Also Like</div>
    <div class="rd-others-grid">
        @foreach($otherRooms as $item)
        <a href="{{ url('room/details/'.$item->id) }}" class="rd-other-card">
            <div class="rd-other-img-wrap">
                <img class="rd-other-img" src="{{ asset('upload/roomimg/'.$item->image) }}" alt="{{ $item->type->name ?? 'Room' }}" loading="lazy">
            </div>
            <div class="rd-other-info">
                <div class="rd-other-name">{{ $item->type->name ?? 'Room' }}</div>
                <div class="rd-other-price">RwF {{ number_format($item->price,0) }} / {{ ($item->type->type ?? 'Room') === 'Hall' ? 'event' : 'night' }}</div>
                @if($item->short_desc)
                <div class="rd-other-desc">{{ $item->short_desc }}</div>
                @endif
                <div class="rd-other-link">View Details →</div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- Guest Reviews --}}
@php
    $reviews = $roomdetails->approved_reviews ?? collect();
    $avgRating = $reviews->avg('rating');
@endphp
<div class="rd-reviews">
    <div class="rd-section-label">Guest Reviews</div>
    @if($reviews->count() > 0)
    <div class="rd-review-summary">
        <div class="rd-review-avg">{{ number_format($avgRating, 1) }}</div>
        <div class="rd-review-meta">
            <div style="margin-bottom:4px">
                @for($i = 1; $i <= 5; $i++)
                <i class='bx {{ $i <= round($avgRating) ? "bxs-star" : "bx-star" }}' style="color:#f5a623;font-size:18px"></i>
                @endfor
            </div>
            <div style="font-size:13px;color:var(--soft)">{{ $reviews->count() }} {{ Str::plural('review', $reviews->count()) }}</div>
        </div>
    </div>
    @foreach($reviews->take(5) as $review)
    <div class="rd-review-card">
        <div class="rd-review-head">
            <div class="rd-review-author">{{ $review->user->name ?? 'Guest' }}</div>
            <div class="rd-review-date">{{ $review->created_at->format('M d, Y') }}</div>
        </div>
        <div class="rd-review-stars">
            @for($i = 1; $i <= 5; $i++)
            <i class='bx {{ $i <= $review->rating ? "bxs-star" : "bx-star" }}'></i>
            @endfor
        </div>
        <div class="rd-review-text">{{ $review->comment }}</div>
    </div>
    @endforeach
    @else
    <p style="text-align:center;color:var(--soft);padding:48px 0;font-size:16px;font-family:var(--f-body)">No reviews yet. Be the first to share your experience!</p>
    @endif
</div>

@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
(function(){
    'use strict';

    var roomPrice = {{ $roomdetails->price }};
    var discount  = {{ $roomdetails->discount ?? 0 }};
    var roomId    = {{ $roomdetails->id }};
    var isAuth    = {{ auth()->check() ? 'true' : 'false' }};

    // Pikaday date pickers
    document.addEventListener('DOMContentLoaded', function(){
        var today = new Date();
        var tomorrow = new Date(today); tomorrow.setDate(today.getDate()+1);

        var pickIn = new Pikaday({
            field: document.getElementById('rd_check_in'),
            format: 'YYYY-MM-DD',
            minDate: today,
            defaultDate: today,
            theme: 'lucerna-pikaday',
            toString: function(d){
                return d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0');
            },
            onSelect: function(d){
                var next = new Date(d); next.setDate(next.getDate()+1);
                pickOut.setMinDate(next);
                if(!pickOut.getDate() || pickOut.getDate()<=d) pickOut.setDate(next);
                resetAvailability();
            }
        });

        var pickOut = new Pikaday({
            field: document.getElementById('rd_check_out'),
            format: 'YYYY-MM-DD',
            minDate: tomorrow,
            defaultDate: tomorrow,
            theme: 'lucerna-pikaday',
            toString: function(d){
                return d.getFullYear()+'-'+String(d.getMonth()+1).padStart(2,'0')+'-'+String(d.getDate()).padStart(2,'0');
            },
            onSelect: function(){ resetAvailability(); }
        });
    });

    // Number of rooms change
    document.getElementById('rd_num_rooms').addEventListener('change', function(){ resetAvailability(); });

    function resetAvailability(){
        document.getElementById('availResult').className = 'rd-avail-result';
        document.getElementById('availResult').style.display = 'none';
        document.getElementById('priceTable').style.display = 'none';
        document.getElementById('bookNowBtn').disabled = true;
        document.getElementById('rd_available_room').value = 0;
    }

    // Check availability
    document.getElementById('checkAvailBtn').addEventListener('click', function(){
        var checkIn  = document.getElementById('rd_check_in').value;
        var checkOut = document.getElementById('rd_check_out').value;
        var numRooms = parseInt(document.getElementById('rd_num_rooms').value);

        if(!checkIn || !checkOut){
            showAvail('Please select check-in and check-out dates.', false);
            return;
        }
        if(checkIn >= checkOut){
            showAvail('Check-out must be after check-in.', false);
            return;
        }

        var btn = this;
        btn.textContent = 'Checking...';
        btn.disabled = true;

        $.ajax({
            url: '{{ route("check_room_availability") }}',
            type: 'GET',
            data: { check_in: checkIn, check_out: checkOut, room_id: roomId },
            success: function(res){
                var avail = res.available_room;
                var nights = res.total_nights;
                document.getElementById('rd_available_room').value = avail;

                if(avail >= numRooms){
                    showAvail(avail + ' {{ $isHall ? "hall(s)" : "room(s)" }} available for ' + nights + ' night(s)', true);
                    updatePricing(nights, numRooms);
                    document.getElementById('bookNowBtn').disabled = !isAuth;
                } else if(avail > 0){
                    showAvail('Only ' + avail + ' available. Please reduce to ' + avail + ' or fewer.', false);
                } else {
                    showAvail('No availability for the selected dates. Try different dates.', false);
                }
                btn.textContent = 'CHECK AVAILABILITY';
                btn.disabled = false;
            },
            error: function(){
                showAvail('Could not check availability. Please try again.', false);
                btn.textContent = 'CHECK AVAILABILITY';
                btn.disabled = false;
            }
        });
    });

    function showAvail(msg, ok){
        var el = document.getElementById('availResult');
        el.textContent = msg;
        el.className = 'rd-avail-result show ' + (ok ? 'available' : 'unavailable');
        el.style.display = 'block';
    }

    function updatePricing(nights, numRooms){
        var sub = roomPrice * nights * numRooms;
        var disc = discount > 0 ? (sub * discount / 100) : 0;
        var total = sub - disc;

        document.getElementById('pricePerNight').textContent = 'RwF ' + roomPrice.toLocaleString();
        document.getElementById('totalNights').textContent = nights;
        document.getElementById('totalRooms').textContent = numRooms;
        if(document.getElementById('discountAmt')) document.getElementById('discountAmt').textContent = '-RwF ' + disc.toLocaleString();
        document.getElementById('grandTotal').textContent = 'RwF ' + total.toLocaleString();
        document.getElementById('priceTable').style.display = '';
    }

    // Form submission — redirect to login if not auth
    document.getElementById('bookingForm').addEventListener('submit', function(e){
        if(!isAuth){
            e.preventDefault();
            window.location.href = '{{ route("login") }}' + '?redirect=' + encodeURIComponent(window.location.href);
            return;
        }
        var avail = parseInt(document.getElementById('rd_available_room').value);
        var numRooms = parseInt(document.getElementById('rd_num_rooms').value);
        if(avail < numRooms){
            e.preventDefault();
            showAvail('Please check availability first.', false);
        }
    });
})();
</script>
@endsection