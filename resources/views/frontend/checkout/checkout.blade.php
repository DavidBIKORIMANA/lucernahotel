@extends('frontend.main_master')

@section('styles')
@php
    $isHall = ($room->type->type ?? 'Room') === 'Hall';
    $unitLabel = $isHall ? 'event' : 'night';
    $entityLabel = $isHall ? 'Hall' : 'Room';
    $subtotal = $room->price * $nights * $book_data['number_of_rooms'];
    $discount = ($room->discount/100) * $subtotal;
    $total = $subtotal - $discount;
@endphp
/* ══════════════════════════════
   CHECKOUT — LUXURY CLEAN
══════════════════════════════ */

/* Kill Tailwind focus ring leak */
*, *::before, *::after { --tw-border-opacity:1 !important; }
input:focus, select:focus, textarea:focus, button:focus {
    outline:none !important;
    box-shadow:none !important;
    border-color:var(--brand) !important;
    --tw-ring-shadow:none !important;
    --tw-ring-color:transparent !important;
}

/* ── Hero Banner ── */
.co-hero {
    background:var(--navy); padding:52px 60px 44px;
    position:relative; overflow:hidden;
}
.co-hero::after {
    content:''; position:absolute; inset:0;
    background:radial-gradient(ellipse at 80% 50%, rgba(212,168,83,.06) 0%, transparent 70%);
    pointer-events:none;
}
.co-hero-inner { max-width:1320px; margin:0 auto; position:relative; z-index:1; }
.co-breadcrumb {
    display:flex; align-items:center; gap:8px; margin-bottom:16px;
    font-family:var(--f-body); font-size:13px; color:rgba(255,255,255,.4);
}
.co-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; transition:color .2s; }
.co-breadcrumb a:hover { color:var(--white); }
.co-breadcrumb svg { width:14px; height:14px; stroke:rgba(255,255,255,.3); }
.co-hero-title {
    font-family:var(--f-head); font-size:clamp(28px,4vw,44px);
    font-weight:500; font-style:italic; color:var(--white); margin-bottom:6px;
}
.co-hero-sub {
    font-family:var(--f-body); font-size:14px; color:rgba(255,255,255,.4);
}

/* ── Layout ── */
.co-wrap {
    max-width:1320px; margin:0 auto; padding:48px 60px 72px;
    display:grid; grid-template-columns:1fr 420px; gap:48px; align-items:start;
}

/* ── Billing Form ── */
.co-billing { }
.co-section-label {
    font-family:var(--f-body); font-size:13px; font-weight:700;
    letter-spacing:.22em; text-transform:uppercase;
    color:var(--brand); margin-bottom:22px;
    padding-bottom:12px; border-bottom:2px solid rgba(12,77,162,.06);
}
.co-fields {
    display:grid; grid-template-columns:1fr 1fr; gap:18px;
    margin-bottom:36px;
}
.co-fields.full { grid-template-columns:1fr; }
.co-field { }
.co-field.span-2 { grid-column:1/-1; }
.co-field label {
    display:block; font-family:var(--f-body); font-size:11px; font-weight:700;
    letter-spacing:.18em; text-transform:uppercase;
    color:var(--soft); margin-bottom:8px;
}
.co-field label .req { color:#dc2626; }
.co-field label .opt { font-weight:400; letter-spacing:0; text-transform:none; color:var(--soft); font-size:11px; }
.co-field input, .co-field select, .co-field textarea {
    width:100%; border:1px solid rgba(12,36,64,.1);
    background:var(--off-white); border-radius:2px;
    font-family:var(--f-body); font-size:15px; color:var(--navy);
    padding:12px 16px; outline:none; transition:all .2s;
    -webkit-appearance:none; appearance:none;
}
.co-field textarea { resize:vertical; min-height:80px; }
.co-field input:focus, .co-field select:focus, .co-field textarea:focus {
    border-color:var(--brand) !important; background:var(--white);
    box-shadow:0 0 0 3px rgba(12,77,162,.06) !important;
}
.co-field .field-error {
    font-family:var(--f-body); font-size:12px; color:#dc2626; margin-top:4px;
}

/* ── Payment Methods ── */
.co-payments {
    display:grid; grid-template-columns:1fr 1fr; gap:14px;
    margin-bottom:24px;
}
.co-pay-card {
    position:relative; cursor:pointer;
}
.co-pay-radio {
    position:absolute; opacity:0; width:0; height:0;
}
.co-pay-label {
    display:flex; flex-direction:column; align-items:center;
    padding:14px 10px 12px; text-align:center;
    border:2px solid rgba(12,36,64,.08); background:var(--white);
    cursor:pointer; transition:all .25s;
}
.co-pay-radio:checked + .co-pay-label {
    border-color:var(--brand); background:rgba(12,77,162,.03);
    box-shadow:0 0 0 3px rgba(12,77,162,.08);
}
.co-pay-icon {
    width:36px; height:36px; border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    margin-bottom:8px; flex-shrink:0;
}
.co-pay-icon i { font-size:18px; }
.co-pay-name {
    font-family:var(--f-body); font-size:12px; font-weight:700;
    color:var(--navy); margin-bottom:1px;
}
.co-pay-desc {
    font-family:var(--f-body); font-size:10px; color:var(--soft);
}

/* Payment detail panels */
.co-pay-fields {
    display:none; padding:20px; background:var(--off-white);
    border:1px solid rgba(12,36,64,.06); margin-bottom:24px;
}
.co-pay-fields.show { display:block; }
.co-pay-alert {
    padding:16px 18px; margin-bottom:16px; font-family:var(--f-body);
    font-size:14px; line-height:1.6; border-radius:2px;
}
.co-pay-alert strong { font-weight:700; }
.co-pay-alert.mtn { background:rgba(255,203,5,.08); border-left:3px solid #ffcb05; color:var(--navy); }
.co-pay-alert.airtel { background:rgba(237,28,36,.05); border-left:3px solid #ed1c24; color:var(--navy); }
.co-pay-alert.bank { background:rgba(12,77,162,.04); border-left:3px solid var(--brand); color:var(--navy); }
.co-pay-alert.cash { background:rgba(34,197,94,.05); border-left:3px solid #16a34a; color:var(--navy); }
.co-pay-alert code {
    background:rgba(12,36,64,.06); padding:2px 8px; font-size:13px; border-radius:2px;
}
.co-bank-table {
    width:100%; border-collapse:collapse; margin-top:10px;
}
.co-bank-table td {
    padding:6px 0; font-family:var(--f-body); font-size:14px; color:var(--ink);
}
.co-bank-table td:first-child { font-weight:700; color:var(--soft); width:140px; }
.co-pay-detail-row {
    display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:12px;
}
.co-pay-detail-field label {
    display:block; font-family:var(--f-body); font-size:11px; font-weight:700;
    letter-spacing:.14em; text-transform:uppercase;
    color:var(--soft); margin-bottom:6px;
}
.co-pay-detail-field label .req { color:#dc2626; }
.co-pay-detail-field label .opt { font-weight:400; letter-spacing:0; text-transform:none; font-size:11px; }
.co-pay-detail-field input {
    width:100%; border:1px solid rgba(12,36,64,.1);
    background:var(--white); border-radius:2px;
    font-family:var(--f-body); font-size:14px; color:var(--navy);
    padding:10px 14px; outline:none; transition:border-color .2s;
}
.co-pay-detail-field input:focus {
    border-color:var(--brand) !important;
    box-shadow:0 0 0 3px rgba(12,77,162,.06) !important;
}

/* Submit button */
.co-submit {
    width:100%; padding:16px;
    font-family:var(--f-body); font-size:13px; font-weight:700;
    letter-spacing:.18em; text-transform:uppercase;
    background:var(--brand); color:var(--white); border:none;
    cursor:pointer; border-radius:2px; transition:all .25s;
    display:flex; align-items:center; justify-content:center; gap:8px;
}
.co-submit:hover { background:#0a56b5; transform:translateY(-1px); box-shadow:0 6px 20px rgba(12,77,162,.28); }
.co-submit:disabled { opacity:.5; cursor:not-allowed; transform:none; box-shadow:none; }
.co-submit i { font-size:18px; }

/* ── Booking Summary Sidebar ── */
.co-summary {
    position:sticky; top:24px;
    background:var(--white); border:1px solid rgba(12,36,64,.06);
    box-shadow:0 8px 40px rgba(12,36,64,.07); overflow:hidden;
}
.co-summary-header {
    background:var(--navy); padding:24px 28px;
}
.co-summary-title {
    font-family:var(--f-head); font-size:22px; font-weight:500;
    color:var(--white); margin-bottom:2px;
}
.co-summary-sub {
    font-family:var(--f-body); font-size:12px; color:rgba(255,255,255,.4);
}
.co-summary-body { padding:28px; }
.co-room-preview {
    display:flex; gap:16px; margin-bottom:24px;
    padding-bottom:24px; border-bottom:1px solid rgba(12,36,64,.06);
}
.co-room-img {
    width:110px; height:90px; object-fit:cover; flex-shrink:0; display:block;
}
.co-room-info { flex:1; }
.co-room-badge {
    display:inline-block; font-family:var(--f-body); font-size:9px; font-weight:700;
    letter-spacing:.18em; text-transform:uppercase;
    padding:3px 10px; margin-bottom:6px;
}
.co-room-badge.room { background:var(--brand); color:var(--white); }
.co-room-badge.hall { background:var(--gold); color:var(--navy); }
.co-room-name {
    font-family:var(--f-head); font-size:20px; font-weight:500;
    color:var(--navy); line-height:1.2; margin-bottom:4px;
}
.co-room-rate {
    font-family:var(--f-body); font-size:14px; font-weight:600; color:var(--brand);
}

/* Date row */
.co-dates {
    display:flex; gap:12px; margin-bottom:20px;
}
.co-date-box {
    flex:1; padding:14px; background:var(--off-white); text-align:center;
}
.co-date-label {
    font-family:var(--f-body); font-size:10px; font-weight:700;
    letter-spacing:.16em; text-transform:uppercase;
    color:var(--soft); margin-bottom:4px;
}
.co-date-value {
    font-family:var(--f-head); font-size:16px; font-weight:500; color:var(--navy);
}

/* Price breakdown */
.co-price-table { width:100%; border-collapse:collapse; margin-top:20px; }
.co-price-table td {
    padding:11px 0; font-family:var(--f-body); font-size:14px;
    color:var(--soft); border-bottom:1px solid rgba(12,36,64,.04);
}
.co-price-table td:last-child { text-align:right; font-weight:600; color:var(--navy); }
.co-price-table tr.total td {
    font-size:18px; font-weight:700; border-bottom:none;
    padding-top:16px; color:var(--brand);
    border-top:2px solid rgba(12,77,162,.08);
}

/* Secure badge */
.co-secure {
    display:flex; align-items:center; justify-content:center; gap:8px;
    margin-top:20px; padding-top:16px; border-top:1px solid rgba(12,36,64,.06);
    font-family:var(--f-body); font-size:12px; color:var(--soft);
}
.co-secure svg { width:16px; height:16px; stroke:var(--soft); flex-shrink:0; }

/* ── Responsive ── */
@media(max-width:1024px){
    .co-hero { padding:40px 28px; }
    .co-wrap { padding:36px 28px 60px; grid-template-columns:1fr 360px; gap:32px; }
}
@media(max-width:768px){
    .co-hero { padding:32px 16px; }
    .co-wrap { grid-template-columns:1fr; padding:28px 16px 48px; }
    .co-summary { position:relative; top:0; order:-1; }
    .co-fields { grid-template-columns:1fr; }
    .co-payments { grid-template-columns:1fr 1fr; }
    .co-pay-detail-row { grid-template-columns:1fr; }
}
@media(max-width:480px){
    .co-payments { grid-template-columns:1fr; }
    .co-dates { flex-direction:column; }
    .co-room-preview { flex-direction:column; }
    .co-room-img { width:100%; height:160px; }
}
@endsection

@section('main')

{{-- Hero Banner --}}
<div class="co-hero">
    <div class="co-hero-inner">
        <div class="co-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <svg viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <a href="{{ url('room/details/'.$room->id) }}">{{ $room->type->name ?? 'Room' }}</a>
            <svg viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span>Checkout</span>
        </div>
        <h1 class="co-hero-title">Complete Your Reservation</h1>
        <p class="co-hero-sub">Secure your stay at Lucerna Kabgayi Hotel</p>
    </div>
</div>

{{-- Main Layout --}}
<form method="post" action="{{ route('checkout.store') }}" enctype="multipart/form-data" class="checkout-form require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
@csrf
<div class="co-wrap">

    {{-- ── Billing Details ── --}}
    <div class="co-billing">
        <div class="co-section-label">Guest Information</div>
        <div class="co-fields">
            <div class="co-field">
                <label>Full Name <span class="req">*</span></label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                @error('name') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="co-field">
                <label>Email Address <span class="req">*</span></label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                @error('email') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="co-field">
                <label>Phone Number <span class="req">*</span></label>
                <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required>
                @error('phone') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="co-field">
                <label>National ID / Passport <span class="req">*</span></label>
                <input type="text" name="nid" value="{{ old('nid') }}" required>
                @error('nid') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="co-field">
                <label>Country <span class="req">*</span></label>
                <input type="text" name="country" value="{{ old('country') }}" required>
                @error('country') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="co-field">
                <label>State / Province <span class="req">*</span></label>
                <input type="text" name="state" value="{{ old('state') }}" required>
                @error('state') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="co-field">
                <label>Address <span class="req">*</span></label>
                <input type="text" name="address" value="{{ old('address', Auth::user()->address) }}" required>
                @error('address') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="co-field">
                <label>Zip Code <span class="req">*</span></label>
                <input type="text" name="zip_code" value="{{ old('zip_code') }}" required>
                @error('zip_code') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="co-field span-2">
                <label>Special Requests <span class="opt">(optional)</span></label>
                <textarea name="special_requests" placeholder="Any special requests or preferences...">{{ $book_data['special_requests'] ?? '' }}</textarea>
            </div>
        </div>

        {{-- ── Payment Method ── --}}
        <div class="co-section-label">Payment Method</div>
        <div class="co-payments">
            {{-- MTN MoMo --}}
            <div class="co-pay-card">
                <input type="radio" id="pay_mtn" name="payment_method" value="MTN_MOMO" class="co-pay-radio" {{ old('payment_method') == 'MTN_MOMO' ? 'checked' : '' }}>
                <label for="pay_mtn" class="co-pay-label">
                    <div class="co-pay-icon" style="background:#ffcb05;">
                        <i class="bx bx-phone" style="color:#003399;"></i>
                    </div>
                    <span class="co-pay-name">MTN MoMo</span>
                    <span class="co-pay-desc">Mobile Money</span>
                </label>
            </div>
            {{-- Airtel Money --}}
            <div class="co-pay-card">
                <input type="radio" id="pay_airtel" name="payment_method" value="AIRTEL_MOMO" class="co-pay-radio" {{ old('payment_method') == 'AIRTEL_MOMO' ? 'checked' : '' }}>
                <label for="pay_airtel" class="co-pay-label">
                    <div class="co-pay-icon" style="background:#ed1c24;">
                        <i class="bx bx-phone" style="color:#fff;"></i>
                    </div>
                    <span class="co-pay-name">Airtel Money</span>
                    <span class="co-pay-desc">Mobile Money</span>
                </label>
            </div>
            {{-- Bank Transfer --}}
            <div class="co-pay-card">
                <input type="radio" id="pay_bank" name="payment_method" value="BANK_TRANSFER" class="co-pay-radio" {{ old('payment_method') == 'BANK_TRANSFER' ? 'checked' : '' }}>
                <label for="pay_bank" class="co-pay-label">
                    <div class="co-pay-icon" style="background:var(--brand);">
                        <i class="bx bx-building" style="color:#fff;"></i>
                    </div>
                    <span class="co-pay-name">Bank Transfer</span>
                    <span class="co-pay-desc">Direct deposit</span>
                </label>
            </div>
            {{-- Cash --}}
            <div class="co-pay-card">
                <input type="radio" id="pay_cash" name="payment_method" value="CASH" class="co-pay-radio" {{ old('payment_method') == 'CASH' ? 'checked' : '' }}>
                <label for="pay_cash" class="co-pay-label">
                    <div class="co-pay-icon" style="background:#16a34a;">
                        <i class="bx bx-money" style="color:#fff;"></i>
                    </div>
                    <span class="co-pay-name">Pay at Hotel</span>
                    <span class="co-pay-desc">Cash on arrival</span>
                </label>
            </div>
        </div>
        @error('payment_method') <div class="field-error" style="margin-bottom:16px">{{ $message }}</div> @enderror

        {{-- MTN MoMo Fields --}}
        <div id="fields_MTN_MOMO" class="co-pay-fields">
            <div class="co-pay-alert mtn">
                <strong>MTN MoMo Instructions:</strong><br>
                Dial <code>*182*8*1*</code> then enter merchant code, or send payment to <strong>+250794191115</strong>
            </div>
            <div class="co-pay-detail-row">
                <div class="co-pay-detail-field">
                    <label>MoMo Phone Number <span class="req">*</span></label>
                    <input type="text" name="payment_phone" class="momo-phone" placeholder="07XXXXXXXX" value="{{ old('payment_phone') }}">
                    @error('payment_phone') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="co-pay-detail-field">
                    <label>Transaction ID <span class="opt">(if paid)</span></label>
                    <input type="text" name="momo_transaction_id" placeholder="e.g. TXN123456789" value="{{ old('momo_transaction_id') }}">
                </div>
            </div>
            <div class="co-pay-detail-field" style="margin-top:12px">
                <label>Payment Screenshot <span class="opt">(optional proof)</span></label>
                <input type="file" name="payment_proof" accept="image/*,.pdf">
            </div>
        </div>

        {{-- Airtel MoMo Fields --}}
        <div id="fields_AIRTEL_MOMO" class="co-pay-fields">
            <div class="co-pay-alert airtel">
                <strong>Airtel Money Instructions:</strong><br>
                Send payment to <strong>+250794191115</strong> (Lucerna Kabgayi Hotel)
            </div>
            <div class="co-pay-detail-row">
                <div class="co-pay-detail-field">
                    <label>Airtel Phone Number <span class="req">*</span></label>
                    <input type="text" name="payment_phone" class="momo-phone" placeholder="07XXXXXXXX" value="{{ old('payment_phone') }}">
                    @error('payment_phone') <div class="field-error">{{ $message }}</div> @enderror
                </div>
                <div class="co-pay-detail-field">
                    <label>Transaction ID <span class="opt">(if paid)</span></label>
                    <input type="text" name="momo_transaction_id" placeholder="e.g. TXN123456789" value="{{ old('momo_transaction_id') }}">
                </div>
            </div>
            <div class="co-pay-detail-field" style="margin-top:12px">
                <label>Payment Screenshot <span class="opt">(optional proof)</span></label>
                <input type="file" name="payment_proof" accept="image/*,.pdf">
            </div>
        </div>

        {{-- Bank Transfer Fields --}}
        <div id="fields_BANK_TRANSFER" class="co-pay-fields">
            <div class="co-pay-alert bank">
                <strong>Bank Transfer Details:</strong>
                <table class="co-bank-table">
                    <tr><td>Bank</td><td>Bank of Kigali</td></tr>
                    <tr><td>Account Name</td><td>Lucerna Kabgayi Hotel</td></tr>
                    <tr><td>Account No</td><td>100109876543</td></tr>
                    <tr><td>Branch</td><td>Muhanga</td></tr>
                </table>
            </div>
            <div class="co-pay-detail-row">
                <div class="co-pay-detail-field">
                    <label>Your Bank Name</label>
                    <input type="text" name="payment_bank_name" placeholder="e.g. Bank of Kigali" value="{{ old('payment_bank_name') }}">
                </div>
                <div class="co-pay-detail-field">
                    <label>Bank Reference No <span class="req">*</span></label>
                    <input type="text" name="payment_bank_ref" placeholder="Transfer reference" value="{{ old('payment_bank_ref') }}">
                    @error('payment_bank_ref') <div class="field-error">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="co-pay-detail-field" style="margin-top:12px">
                <label>Bank Slip / Receipt <span class="opt">(recommended)</span></label>
                <input type="file" name="payment_proof" accept="image/*,.pdf">
            </div>
        </div>

        {{-- Cash Fields --}}
        <div id="fields_CASH" class="co-pay-fields">
            <div class="co-pay-alert cash">
                <strong>Pay at Hotel</strong><br>
                You will pay in cash upon arrival at Lucerna Kabgayi Hotel, Muhanga.
                Your booking will be confirmed once the hotel approves it.
            </div>
        </div>

        <button type="submit" class="co-submit" id="coSubmitBtn">
            <i class="bx bx-lock-alt"></i> Confirm Booking
        </button>
    </div>

    {{-- ── Booking Summary ── --}}
    <div class="co-summary">
        <div class="co-summary-header">
            <div class="co-summary-title">Booking Summary</div>
            <div class="co-summary-sub">Review your reservation details</div>
        </div>
        <div class="co-summary-body">
            {{-- Room preview --}}
            <div class="co-room-preview">
                <img class="co-room-img" src="{{ !empty($room->image) ? url('upload/roomimg/'.$room->image) : url('upload/no_image.jpg') }}" alt="{{ $room->type->name ?? 'Room' }}">
                <div class="co-room-info">
                    <span class="co-room-badge {{ strtolower($entityLabel) }}">{{ $entityLabel }}</span>
                    <div class="co-room-name">{{ $room->type->name ?? 'Room' }}</div>
                    <div class="co-room-rate">{{ number_format($room->price) }} $ / {{ $unitLabel }}</div>
                </div>
            </div>

            {{-- Dates --}}
            <div class="co-dates">
                <div class="co-date-box">
                    <div class="co-date-label">Check In</div>
                    <div class="co-date-value">{{ \Carbon\Carbon::parse($book_data['check_in'])->format('M d, Y') }}</div>
                </div>
                <div class="co-date-box">
                    <div class="co-date-label">Check Out</div>
                    <div class="co-date-value">{{ \Carbon\Carbon::parse($book_data['check_out'])->format('M d, Y') }}</div>
                </div>
            </div>

            {{-- Price Breakdown --}}
            <table class="co-price-table">
                <tr>
                    <td>Rate per {{ $unitLabel }}</td>
                    <td>{{ number_format($room->price) }} $</td>
                </tr>
                <tr>
                    <td>Nights</td>
                    <td>{{ $nights }}</td>
                </tr>
                <tr>
                    <td>{{ $isHall ? 'Halls' : 'Rooms' }}</td>
                    <td>{{ $book_data['number_of_rooms'] }}</td>
                </tr>
                <tr>
                    <td>Subtotal</td>
                    <td>{{ number_format($subtotal) }} $</td>
                </tr>
                @if($discount > 0)
                <tr>
                    <td>Discount ({{ $room->discount }}%)</td>
                    <td style="color:#16a34a">-{{ number_format($discount) }} $</td>
                </tr>
                @endif
                <tr class="total">
                    <td>Total</td>
                    <td>{{ number_format($total) }} $</td>
                </tr>
            </table>

            {{-- Secure badge --}}
            <div class="co-secure">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Secure &amp; encrypted booking
            </div>
        </div>
    </div>
</div>
</form>

@endsection

@section('scripts')
<script>
(function(){
    'use strict';

    var radios = document.querySelectorAll('.co-pay-radio');
    var allFields = document.querySelectorAll('.co-pay-fields');

    function showPaymentFields(){
        /* hide all */
        allFields.forEach(function(f){
            f.classList.remove('show');
            f.querySelectorAll('input[name="payment_phone"]').forEach(function(i){ i.disabled = true; });
        });
        /* show selected */
        var checked = document.querySelector('.co-pay-radio:checked');
        if(!checked) return;
        var el = document.getElementById('fields_' + checked.value);
        if(el){
            el.classList.add('show');
            el.querySelectorAll('input[name="payment_phone"]').forEach(function(i){ i.disabled = false; });
        }
    }

    radios.forEach(function(r){ r.addEventListener('change', showPaymentFields); });
    showPaymentFields();

    /* Form submit guard */
    document.querySelector('.checkout-form').addEventListener('submit', function(e){
        var checked = document.querySelector('.co-pay-radio:checked');
        if(!checked){
            e.preventDefault();
            alert('Please select a payment method');
            return false;
        }
        var btn = document.getElementById('coSubmitBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Processing...';
    });
})();
</script>
@endsection
