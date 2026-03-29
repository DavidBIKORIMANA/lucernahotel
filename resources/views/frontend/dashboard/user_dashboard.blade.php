@extends('frontend.main_master')

@section('styles')
/* ══════════════════════════════
   GUEST DASHBOARD — LUXURY
══════════════════════════════ */
*, *::before, *::after { --tw-border-opacity:1 !important; }
input:focus, select:focus, textarea:focus { outline:none !important; box-shadow:none !important; border-color:var(--brand) !important; --tw-ring-shadow:none !important; --tw-ring-color:transparent !important; }

/* Hero */
.ud-hero { background:var(--navy); padding:48px 60px 40px; position:relative; overflow:hidden; }
.ud-hero::after { content:''; position:absolute; inset:0; background:radial-gradient(ellipse at 80% 50%, rgba(212,168,83,.06) 0%, transparent 70%); pointer-events:none; }
.ud-hero-inner { max-width:1320px; margin:0 auto; position:relative; z-index:1; }
.ud-hero-greeting { font-family:var(--f-body); font-size:14px; color:rgba(255,255,255,.45); margin-bottom:6px; }
.ud-hero-title { font-family:var(--f-head); font-size:clamp(26px,4vw,40px); font-weight:500; font-style:italic; color:var(--white); }

/* Layout */
.ud-wrap { max-width:1320px; margin:0 auto; padding:40px 60px 64px; display:grid; grid-template-columns:260px 1fr; gap:40px; align-items:start; }

/* Sidebar */
.ud-sidebar { position:sticky; top:24px; background:var(--white); border:1px solid rgba(12,36,64,.06); box-shadow:0 4px 24px rgba(12,36,64,.05); overflow:hidden; }
.ud-avatar-block { padding:28px 24px; text-align:center; background:var(--off-white); border-bottom:1px solid rgba(12,36,64,.06); }
.ud-avatar { width:80px; height:80px; border-radius:50%; object-fit:cover; border:3px solid var(--white); box-shadow:0 2px 12px rgba(12,36,64,.1); display:block; margin:0 auto 12px; }
.ud-avatar-name { font-family:var(--f-head); font-size:20px; font-weight:500; color:var(--navy); margin-bottom:2px; }
.ud-avatar-email { font-family:var(--f-body); font-size:13px; color:var(--soft); }
.ud-nav { padding:12px 0; }
.ud-nav-link { display:flex; align-items:center; gap:12px; padding:12px 24px; font-family:var(--f-body); font-size:14px; font-weight:500; color:var(--ink); text-decoration:none; transition:all .2s; border-left:3px solid transparent; }
.ud-nav-link:hover { background:var(--off-white); color:var(--brand); }
.ud-nav-link.active { background:rgba(12,77,162,.04); color:var(--brand); border-left-color:var(--brand); font-weight:600; }
.ud-nav-link svg { width:18px; height:18px; stroke:currentColor; flex-shrink:0; }
.ud-nav-link.logout { color:#dc2626; }
.ud-nav-link.logout:hover { background:rgba(220,38,38,.04); }
.ud-nav-divider { height:1px; background:rgba(12,36,64,.06); margin:8px 24px; }

/* Content */
.ud-content {}

/* Stat cards */
.ud-stats { display:grid; grid-template-columns:repeat(3,1fr); gap:18px; margin-bottom:36px; }
.ud-stat-card { padding:24px; background:var(--white); border:1px solid rgba(12,36,64,.06); box-shadow:0 2px 12px rgba(12,36,64,.04); transition:all .25s; }
.ud-stat-card:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(12,36,64,.08); }
.ud-stat-icon { width:44px; height:44px; border-radius:50%; display:flex; align-items:center; justify-content:center; margin-bottom:14px; }
.ud-stat-icon svg { width:22px; height:22px; }
.ud-stat-number { font-family:var(--f-head); font-size:36px; font-weight:600; line-height:1; margin-bottom:4px; }
.ud-stat-label { font-family:var(--f-body); font-size:12px; font-weight:600; letter-spacing:.14em; text-transform:uppercase; color:var(--soft); }
.ud-stat-card.total .ud-stat-icon { background:rgba(12,77,162,.08); }
.ud-stat-card.total .ud-stat-icon svg { stroke:var(--brand); }
.ud-stat-card.total .ud-stat-number { color:var(--brand); }
.ud-stat-card.pending .ud-stat-icon { background:rgba(234,179,8,.1); }
.ud-stat-card.pending .ud-stat-icon svg { stroke:#ca8a04; }
.ud-stat-card.pending .ud-stat-number { color:#ca8a04; }
.ud-stat-card.complete .ud-stat-icon { background:rgba(34,197,94,.08); }
.ud-stat-card.complete .ud-stat-icon svg { stroke:#16a34a; }
.ud-stat-card.complete .ud-stat-number { color:#16a34a; }

/* Section label */
.ud-section-label { font-family:var(--f-body); font-size:13px; font-weight:700; letter-spacing:.22em; text-transform:uppercase; color:var(--brand); margin-bottom:18px; padding-bottom:12px; border-bottom:2px solid rgba(12,77,162,.06); }

/* Recent bookings */
.ud-booking-card { display:flex; align-items:center; gap:18px; padding:18px 20px; background:var(--white); border:1px solid rgba(12,36,64,.06); margin-bottom:10px; transition:all .2s; }
.ud-booking-card:hover { box-shadow:0 4px 16px rgba(12,36,64,.06); }
.ud-booking-room { font-family:var(--f-head); font-size:17px; font-weight:500; color:var(--navy); flex:1; min-width:0; }
.ud-booking-room span { display:block; font-family:var(--f-body); font-size:12px; color:var(--soft); margin-top:2px; }
.ud-booking-dates { font-family:var(--f-body); font-size:13px; color:var(--soft); text-align:center; white-space:nowrap; }
.ud-booking-dates strong { color:var(--navy); display:block; }
.ud-badge { display:inline-block; font-family:var(--f-body); font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; padding:4px 12px; border-radius:2px; }
.ud-badge.pending { background:rgba(234,179,8,.1); color:#a16207; }
.ud-badge.confirmed { background:rgba(34,197,94,.08); color:#16a34a; }
.ud-badge.checked-in { background:rgba(59,130,246,.08); color:#2563eb; }
.ud-badge.checked-out { background:rgba(107,114,128,.08); color:#4b5563; }
.ud-badge.cancelled { background:rgba(239,68,68,.08); color:#dc2626; }
.ud-empty { text-align:center; padding:48px 20px; font-family:var(--f-body); font-size:15px; color:var(--soft); }
.ud-empty svg { width:48px; height:48px; stroke:rgba(12,36,64,.12); margin-bottom:14px; display:block; margin-left:auto; margin-right:auto; }
.ud-view-all { display:inline-flex; align-items:center; gap:6px; font-family:var(--f-body); font-size:12px; font-weight:700; letter-spacing:.14em; text-transform:uppercase; color:var(--brand); text-decoration:none; margin-top:16px; transition:color .2s; }
.ud-view-all:hover { color:var(--navy); }
.ud-view-all svg { width:16px; height:16px; stroke:currentColor; }

/* Quick actions */
.ud-actions { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:32px; }
.ud-action-card { display:flex; align-items:center; gap:14px; padding:20px; background:var(--white); border:1px solid rgba(12,36,64,.06); text-decoration:none; color:inherit; transition:all .25s; }
.ud-action-card:hover { box-shadow:0 6px 20px rgba(12,36,64,.08); transform:translateY(-2px); }
.ud-action-icon { width:44px; height:44px; border-radius:50%; background:rgba(12,77,162,.06); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.ud-action-icon svg { width:20px; height:20px; stroke:var(--brand); }
.ud-action-text { font-family:var(--f-body); font-size:14px; font-weight:600; color:var(--navy); }
.ud-action-text span { display:block; font-size:12px; font-weight:400; color:var(--soft); margin-top:2px; }

/* Forms shared */
.ud-form-card { background:var(--white); border:1px solid rgba(12,36,64,.06); box-shadow:0 4px 24px rgba(12,36,64,.05); padding:32px; }
.ud-fields { display:grid; grid-template-columns:1fr 1fr; gap:18px; margin-bottom:24px; }
.ud-fields.single { grid-template-columns:1fr; }
.ud-field { }
.ud-field.span-2 { grid-column:1/-1; }
.ud-field label { display:block; font-family:var(--f-body); font-size:11px; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:var(--soft); margin-bottom:8px; }
.ud-field label .req { color:#dc2626; }
.ud-field input, .ud-field select, .ud-field textarea { width:100%; border:1px solid rgba(12,36,64,.1); background:var(--off-white); border-radius:2px; font-family:var(--f-body); font-size:15px; color:var(--navy); padding:12px 16px; outline:none; transition:all .2s; }
.ud-field input:focus, .ud-field select:focus, .ud-field textarea:focus { border-color:var(--brand) !important; background:var(--white); box-shadow:0 0 0 3px rgba(12,77,162,.06) !important; }
.ud-field .field-error { font-family:var(--f-body); font-size:12px; color:#dc2626; margin-top:4px; }
.ud-save-btn { padding:14px 36px; font-family:var(--f-body); font-size:12px; font-weight:700; letter-spacing:.16em; text-transform:uppercase; background:var(--brand); color:var(--white); border:none; cursor:pointer; border-radius:2px; transition:all .25s; }
.ud-save-btn:hover { background:#0a56b5; transform:translateY(-1px); box-shadow:0 4px 16px rgba(12,77,162,.25); }
.ud-photo-preview { width:80px; height:80px; border-radius:50%; object-fit:cover; border:3px solid var(--off-white); }

/* Booking list table */
.ud-table-wrap { overflow-x:auto; }
.ud-table { width:100%; border-collapse:collapse; }
.ud-table th { font-family:var(--f-body); font-size:10px; font-weight:700; letter-spacing:.16em; text-transform:uppercase; color:var(--soft); padding:12px 14px; text-align:left; border-bottom:2px solid rgba(12,36,64,.06); white-space:nowrap; }
.ud-table td { font-family:var(--f-body); font-size:14px; color:var(--ink); padding:14px; border-bottom:1px solid rgba(12,36,64,.04); vertical-align:middle; }
.ud-table tr:hover td { background:rgba(12,77,162,.015); }
.ud-table .code-link { color:var(--brand); font-weight:600; text-decoration:none; }
.ud-table .code-link:hover { text-decoration:underline; }

/* Review modal override */
.ud-review-btn { padding:6px 14px; font-family:var(--f-body); font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; border:1px solid var(--brand); background:transparent; color:var(--brand); cursor:pointer; border-radius:2px; transition:all .2s; }
.ud-review-btn:hover { background:rgba(12,77,162,.04); }
.ud-reviewed { font-family:var(--f-body); font-size:12px; color:#16a34a; display:flex; align-items:center; gap:4px; }

/* Responsive */
@media(max-width:1024px){ .ud-hero { padding:36px 28px; } .ud-wrap { padding:28px; gap:28px; grid-template-columns:240px 1fr; } }
@media(max-width:768px){ .ud-wrap { grid-template-columns:1fr; } .ud-sidebar { position:relative; top:0; } .ud-stats { grid-template-columns:1fr; } .ud-actions { grid-template-columns:1fr; } .ud-fields { grid-template-columns:1fr; } .ud-hero { padding:28px 16px; } .ud-wrap { padding:20px 16px 48px; } }
@media(max-width:480px){ .ud-booking-card { flex-direction:column; align-items:flex-start; gap:10px; } .ud-booking-dates { text-align:left; } }
@endsection

@section('main')

{{-- Hero --}}
<div class="ud-hero">
    <div class="ud-hero-inner">
        <div class="ud-hero-greeting">Welcome back,</div>
        <h1 class="ud-hero-title">{{ Auth::user()->name }}</h1>
    </div>
</div>

{{-- Layout --}}
<div class="ud-wrap">
    @include('frontend.dashboard.user_menu')

    <div class="ud-content">
        {{-- Stats --}}
        <div class="ud-stats">
            <div class="ud-stat-card total">
                <div class="ud-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                </div>
                <div class="ud-stat-number">{{ $BookingT->count() }}</div>
                <div class="ud-stat-label">Total Bookings</div>
            </div>
            <div class="ud-stat-card pending">
                <div class="ud-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                </div>
                <div class="ud-stat-number">{{ $BookingP->count() }}</div>
                <div class="ud-stat-label">Pending</div>
            </div>
            <div class="ud-stat-card complete">
                <div class="ud-stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg>
                </div>
                <div class="ud-stat-number">{{ $BookingA->count() }}</div>
                <div class="ud-stat-label">Completed</div>
            </div>
        </div>

        {{-- Recent Bookings --}}
        <div class="ud-section-label">Recent Bookings</div>
        @if($recentBookings->count() > 0)
            @foreach($recentBookings as $booking)
            <div class="ud-booking-card">
                <div class="ud-booking-room">
                    {{ $booking->room->type->name ?? 'Room' }}
                    <span>{{ $booking->code }}</span>
                </div>
                <div class="ud-booking-dates">
                    <strong>{{ \Carbon\Carbon::parse($booking->check_in)->format('M d') }} — {{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</strong>
                    {{ $booking->number_of_rooms }} {{ $booking->number_of_rooms > 1 ? 'rooms' : 'room' }} · {{ $booking->total_night ?? '-' }} nights
                </div>
                @php
                    $statusMap = [0 => 'pending', 1 => 'confirmed', 2 => 'checked-in', 3 => 'checked-out', 4 => 'cancelled', 5 => 'cancelled'];
                    $statusText = [0 => 'Pending', 1 => 'Confirmed', 2 => 'Checked In', 3 => 'Checked Out', 4 => 'Cancelled', 5 => 'Denied'];
                @endphp
                <span class="ud-badge {{ $statusMap[$booking->status] ?? 'pending' }}">{{ $statusText[$booking->status] ?? 'Pending' }}</span>
            </div>
            @endforeach
            <a href="{{ route('user.booking') }}" class="ud-view-all">
                View All Bookings
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        @else
            <div class="ud-empty">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18M8 14h.01M12 14h.01M16 14h.01M8 18h.01M12 18h.01"/></svg>
                No bookings yet. Start by browsing our rooms &amp; halls.
            </div>
        @endif

        {{-- Quick actions --}}
        <div class="ud-actions">
            <a href="{{ route('froom.all') }}" class="ud-action-card">
                <div class="ud-action-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><path d="M9 22V12h6v10"/></svg>
                </div>
                <div class="ud-action-text">Browse Rooms<span>Find your perfect stay</span></div>
            </a>
            <a href="{{ route('user.profile') }}" class="ud-action-card">
                <div class="ud-action-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div class="ud-action-text">Edit Profile<span>Update your information</span></div>
            </a>
        </div>
    </div>
</div>

@endsection