@extends('admin.admin_dashboard')

@push('styles')
<style>
  /* ── KPI Cards ───────────────────────────────── */
  .kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
  }
  .kpi-card {
    background: var(--bg-card);
    border: 1px solid var(--border3);
    border-radius: var(--radius);
    padding: 22px 22px 18px;
    position: relative;
    overflow: hidden;
    transition: border-color var(--transition), transform .2s;
  }
  .kpi-card::before {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(208,170,72,.04) 0%, transparent 60%);
    pointer-events: none;
  }
  .kpi-card:hover { border-color: var(--border2); transform: translateY(-2px); }
  .kpi-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 16px; }
  .kpi-icon {
    width: 42px; height: 42px;
    border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
  }
  .kpi-icon.gold { background: var(--gold-faint); border: 1px solid var(--border); color: var(--gold); }
  .kpi-icon.blue { background: rgba(75,142,245,.08); border: 1px solid rgba(75,142,245,.18); color: var(--info); }
  .kpi-icon.green { background: rgba(63,184,122,.08); border: 1px solid rgba(63,184,122,.18); color: var(--success); }
  .kpi-icon.warn { background: rgba(232,153,58,.08); border: 1px solid rgba(232,153,58,.18); color: var(--warning); }

  .kpi-trend {
    font-size: 11px; font-weight: 600;
    padding: 3px 8px; border-radius: 20px;
    display: flex; align-items: center; gap: 3px;
  }
  .kpi-trend.up { background: rgba(63,184,122,.12); color: var(--success); }
  .kpi-trend.down { background: rgba(224,82,82,.12); color: var(--danger); }

  .kpi-value {
    font-family: var(--font-display);
    font-size: 34px; font-weight: 600;
    color: var(--text-1); line-height: 1; margin-bottom: 5px;
  }
  .kpi-label { font-size: 12px; color: var(--text-3); font-weight: 500; letter-spacing: .3px; }
  .kpi-bar {
    margin-top: 14px; height: 3px;
    background: var(--border3); border-radius: 2px; overflow: hidden;
  }
  .kpi-bar-fill { height: 100%; border-radius: 2px; }

  /* ── Welcome bar ─── */
  .welcome-bar {
    display: flex; align-items: flex-end; justify-content: space-between;
    margin-bottom: 28px; flex-wrap: wrap; gap: 12px;
  }
  .welcome-greeting {
    font-family: var(--font-display);
    font-size: 32px; font-weight: 500;
    color: var(--text-1); line-height: 1.1;
  }
  .welcome-greeting span { color: var(--gold); }
  .welcome-sub { font-size: 13px; color: var(--text-3); margin-top: 4px; }
  .date-chip {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 20px; padding: 7px 16px;
    font-size: 12.5px; color: var(--text-2);
    display: flex; align-items: center; gap: 7px;
  }
  .date-chip svg { color: var(--gold); }

  /* ── Charts row ── */
  .charts-row {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 16px; margin-bottom: 24px;
  }
  .chart-card {
    background: var(--bg-card);
    border: 1px solid var(--border3);
    border-radius: var(--radius); padding: 24px;
  }
  .chart-card .ch-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 20px;
  }
  .ch-title {
    font-family: var(--font-display);
    font-size: 18px; font-weight: 500; color: var(--text-1);
  }
  .ch-title small {
    display: block; font-family: var(--font-ui);
    font-size: 11px; color: var(--text-3);
    font-weight: 400; margin-top: 2px; letter-spacing: .3px;
  }

  /* donut legend */
  .donut-legend { display: flex; flex-direction: column; gap: 10px; margin-top: 20px; }
  .legend-row { display: flex; align-items: center; gap: 10px; }
  .legend-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
  .legend-label { font-size: 12.5px; color: var(--text-2); flex: 1; }
  .legend-value { font-size: 13px; font-weight: 600; color: var(--text-1); }
  .legend-pct { font-size: 11px; color: var(--text-3); }

  /* ── Lower row ── */
  .lower-row {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 16px;
  }

  /* ── Table card ── */
  .table-card {
    background: var(--bg-card);
    border: 1px solid var(--border3);
    border-radius: var(--radius); overflow: hidden;
  }
  .table-card .tc-header {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border3);
    display: flex; align-items: center; justify-content: space-between;
  }
  .data-table { width: 100%; border-collapse: collapse; }
  .data-table th {
    padding: 10px 16px; font-size: 10.5px;
    letter-spacing: 1px; text-transform: uppercase;
    color: var(--text-3); font-weight: 600;
    border-bottom: 1px solid var(--border3);
    text-align: left; white-space: nowrap;
  }
  .data-table td {
    padding: 12px 16px; font-size: 13px;
    color: var(--text-2);
    border-bottom: 1px solid rgba(255,255,255,.03);
    vertical-align: middle;
  }
  .data-table tr:last-child td { border-bottom: none; }
  .data-table tr { transition: background var(--transition); }
  .data-table tr:hover td { background: var(--bg-hover); color: var(--text-1); }

  .guest-cell { display: flex; align-items: center; gap: 10px; }
  .guest-av {
    width: 32px; height: 32px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 600; flex-shrink: 0;
    background: var(--gold-faint); color: var(--gold);
    border: 1px solid var(--border);
  }
  .guest-name { font-size: 13px; font-weight: 500; color: var(--text-1); }
  .guest-email { font-size: 11px; color: var(--text-3); }

  .status-pill {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 10px; border-radius: 20px;
    font-size: 11px; font-weight: 600; white-space: nowrap;
  }
  .status-pill::before { content: ''; width: 5px; height: 5px; border-radius: 50%; display: inline-block; }
  .status-pill.s-confirmed { background: rgba(63,184,122,.1); color: var(--success); border: 1px solid rgba(63,184,122,.2); }
  .status-pill.s-confirmed::before { background: var(--success); }
  .status-pill.s-pending { background: rgba(232,153,58,.1); color: var(--warning); border: 1px solid rgba(232,153,58,.2); }
  .status-pill.s-pending::before { background: var(--warning); }
  .status-pill.s-checkedin { background: rgba(75,142,245,.1); color: var(--info); border: 1px solid rgba(75,142,245,.2); }
  .status-pill.s-checkedin::before { background: var(--info); }
  .status-pill.s-checkedout { background: rgba(158,168,190,.1); color: var(--text-2); border: 1px solid rgba(158,168,190,.2); }
  .status-pill.s-checkedout::before { background: var(--text-2); }
  .status-pill.s-cancelled { background: rgba(224,82,82,.1); color: var(--danger); border: 1px solid rgba(224,82,82,.2); }
  .status-pill.s-cancelled::before { background: var(--danger); }
  .status-pill.s-denied { background: rgba(78,88,112,.1); color: var(--text-3); border: 1px solid rgba(78,88,112,.2); }
  .status-pill.s-denied::before { background: var(--text-3); }

  .amount-cell { font-weight: 600; color: var(--gold); }

  /* ── Side panel ── */
  .side-col { display: flex; flex-direction: column; gap: 16px; }

  .room-status-card {
    background: var(--bg-card);
    border: 1px solid var(--border3);
    border-radius: var(--radius); padding: 22px;
  }
  .room-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px; margin-top: 16px;
  }
  .room-type-chip {
    background: var(--bg-card2);
    border: 1px solid var(--border3);
    border-radius: 10px; padding: 14px;
    transition: border-color var(--transition);
  }
  .room-type-chip:hover { border-color: var(--border2); }
  .room-type-name { font-size: 12px; color: var(--text-3); margin-bottom: 4px; font-weight: 500; }
  .room-type-count { font-family: var(--font-display); font-size: 26px; font-weight: 600; color: var(--text-1); line-height: 1; }
  .room-type-sub { font-size: 10px; color: var(--text-3); margin-top: 2px; }
  .room-type-bar { margin-top: 8px; height: 2px; background: var(--border3); border-radius: 2px; overflow: hidden; }
  .room-type-bar-fill { height: 100%; border-radius: 2px; }

  .activity-card {
    background: var(--bg-card);
    border: 1px solid var(--border3);
    border-radius: var(--radius); padding: 22px;
  }
  .activity-list { margin-top: 16px; display: flex; flex-direction: column; gap: 0; }
  .activity-item {
    display: flex; gap: 12px; padding: 10px 0;
    border-bottom: 1px solid rgba(255,255,255,.03);
  }
  .activity-item:last-child { border-bottom: none; }
  .activity-dot-wrap { display: flex; flex-direction: column; align-items: center; }
  .activity-dot { width: 8px; height: 8px; border-radius: 50%; margin-top: 5px; flex-shrink: 0; }
  .activity-line { width: 1px; flex: 1; background: var(--border3); margin-top: 4px; }
  .activity-item:last-child .activity-line { display: none; }
  .activity-text { font-size: 12.5px; color: var(--text-2); flex: 1; }
  .activity-text strong { color: var(--text-1); font-weight: 500; }
  .activity-time { font-size: 11px; color: var(--text-3); }

  .view-all-btn {
    display: flex; align-items: center; gap: 6px;
    padding: 5px 12px; border-radius: 20px;
    border: 1px solid var(--border); background: transparent;
    color: var(--gold); font-size: 12px;
    font-family: var(--font-ui); font-weight: 500;
    cursor: pointer; transition: background var(--transition);
    text-decoration: none;
  }
  .view-all-btn:hover { background: var(--gold-faint); }

  /* ── Animations ── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .kpi-card { animation: fadeUp .5s ease both; }
  .kpi-card:nth-child(1) { animation-delay: .05s; }
  .kpi-card:nth-child(2) { animation-delay: .12s; }
  .kpi-card:nth-child(3) { animation-delay: .19s; }
  .kpi-card:nth-child(4) { animation-delay: .26s; }

  /* ── Clickable elements ── */
  a.kpi-card { text-decoration: none; color: inherit; }
  a.kpi-card:hover { border-color: var(--gold); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(208,170,72,.12); }
  .data-table tbody tr.clickable-row { cursor: pointer; transition: background var(--transition); }
  .data-table tbody tr.clickable-row:hover { background: rgba(208,170,72,.06); }
  a.room-type-chip { text-decoration: none; color: inherit; }
  a.room-type-chip:hover { border-color: var(--gold); transform: translateY(-2px); box-shadow: 0 4px 14px rgba(208,170,72,.1); }
  a.activity-item { text-decoration: none; color: inherit; cursor: pointer; }
  a.activity-item:hover { background: rgba(208,170,72,.04); border-radius: 6px; }
  .chart-card, .table-card, .room-status-card, .activity-card { animation: fadeUp .5s ease both; animation-delay: .3s; }

  /* ── Responsive ── */
  @media (max-width: 1280px) {
    .kpi-grid { grid-template-columns: repeat(2, 1fr); }
    .charts-row { grid-template-columns: 1fr; }
    .lower-row { grid-template-columns: 1fr; }
  }
  @media (max-width: 900px) {
    .kpi-grid { grid-template-columns: 1fr; }
  }
</style>
@endpush

@section('admin')

@php
  $user = Auth::user();
  $firstName = explode(' ', $user->name)[0];
  $hour = now()->format('H');
  $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
@endphp

<!-- Welcome -->
<div class="welcome-bar">
  <div>
    <div class="welcome-greeting">{{ $greeting }}, <span>{{ $firstName }}</span></div>
    <div class="welcome-sub">Here's what's happening at the hotel today.</div>
  </div>
  <div class="date-chip">
    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
    {{ now()->format('l, d F Y') }}
  </div>
</div>

<!-- KPIs -->
<div class="kpi-grid">

  {{-- Revenue --}}
  <a href="{{ route('booking.report') }}" class="kpi-card">
    <div class="kpi-header">
      <div class="kpi-icon gold">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 1 0 0 7h5a3.5 3.5 0 1 1 0 7H6"/></svg>
      </div>
      <div class="kpi-trend {{ $revenueTrend >= 0 ? 'up' : 'down' }}">
        @if($revenueTrend >= 0)
          <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        @else
          <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg>
        @endif
        {{ $revenueTrend >= 0 ? '+' : '' }}{{ $revenueTrend }}%
      </div>
    </div>
    <div class="kpi-value">{{ number_format($monthlyRevenue) }}</div>
    <div class="kpi-label">REVENUE ($) · THIS MONTH</div>
    @php $revenueTarget = max($monthlyRevenue, $yearlyRevenue / 12); $revPct = $revenueTarget > 0 ? min(100, round(($monthlyRevenue / $revenueTarget) * 100)) : 0; @endphp
    <div class="kpi-bar"><div class="kpi-bar-fill" style="width:{{ $revPct }}%;background:var(--gold);"></div></div>
  </a>

  {{-- Bookings --}}
  <a href="{{ route('booking.list') }}" class="kpi-card">
    <div class="kpi-header">
      <div class="kpi-icon blue">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M2 9h20M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z"/></svg>
      </div>
      <div class="kpi-trend {{ $bookingsTrend >= 0 ? 'up' : 'down' }}">
        @if($bookingsTrend >= 0)
          <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        @else
          <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg>
        @endif
        {{ $bookingsTrend >= 0 ? '+' : '' }}{{ $bookingsTrend }}%
      </div>
    </div>
    <div class="kpi-value">{{ $monthlyBookings->count() }}</div>
    <div class="kpi-label">BOOKINGS · THIS MONTH</div>
    @php $bkPct = $lastMonthBookings > 0 ? min(100, round(($monthlyBookings->count() / max($monthlyBookings->count(), $lastMonthBookings)) * 100)) : 100; @endphp
    <div class="kpi-bar"><div class="kpi-bar-fill" style="width:{{ $bkPct }}%;background:var(--info);"></div></div>
  </a>

  {{-- Occupancy --}}
  <a href="{{ route('view.room.list') }}" class="kpi-card">
    <div class="kpi-header">
      <div class="kpi-icon green">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M3 22V12l9-8 9 8v10"/><path d="M9 22v-6h6v6"/></svg>
      </div>
      <div class="kpi-trend {{ $occupancyRate >= 50 ? 'up' : 'down' }}">
        {{ $occupiedToday }}/{{ $totalRooms }} rooms
      </div>
    </div>
    <div class="kpi-value">{{ $occupancyRate }}<span style="font-size:20px;color:var(--text-3);">%</span></div>
    <div class="kpi-label">OCCUPANCY RATE · TODAY</div>
    <div class="kpi-bar"><div class="kpi-bar-fill" style="width:{{ $occupancyRate }}%;background:var(--success);"></div></div>
  </a>

  {{-- Guests --}}
  <a href="{{ route('booking.list') }}" class="kpi-card">
    <div class="kpi-header">
      <div class="kpi-icon warn">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      </div>
      <div class="kpi-trend {{ $guestsTrend >= 0 ? 'up' : 'down' }}">
        @if($guestsTrend >= 0)
          <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        @else
          <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg>
        @endif
        {{ $guestsTrend >= 0 ? '+' : '' }}{{ $guestsTrend }}%
      </div>
    </div>
    <div class="kpi-value">{{ number_format($yearlyGuests) }}</div>
    <div class="kpi-label">TOTAL GUESTS · THIS YEAR</div>
    <div class="kpi-bar"><div class="kpi-bar-fill" style="width:55%;background:var(--warning);"></div></div>
  </a>

</div>

<!-- Charts Row -->
<div class="charts-row">

  <!-- Revenue Line Chart -->
  <div class="chart-card">
    <div class="ch-header">
      <div class="ch-title">
        Revenue Overview
        <small>Monthly performance · {{ now()->year }} vs {{ now()->year - 1 }}</small>
      </div>
    </div>
    <canvas id="revenueChart" height="110"></canvas>
  </div>

  <!-- Donut Chart -->
  <div class="chart-card">
    <div class="ch-header">
      <div class="ch-title">
        Room Occupancy
        <small>Today's distribution</small>
      </div>
    </div>
    <div style="position:relative; width:170px; margin:0 auto;">
      <canvas id="donutChart" width="170" height="170"></canvas>
      <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;pointer-events:none;">
        <div style="font-family:var(--font-display);font-size:28px;font-weight:600;color:var(--text-1);line-height:1;">{{ $occupancyRate }}%</div>
        <div style="font-size:10px;color:var(--text-3);letter-spacing:.5px;">OCCUPIED</div>
      </div>
    </div>
    <div class="donut-legend">
      <div class="legend-row"><div class="legend-dot" style="background:#d0aa48;"></div><span class="legend-label">Occupied</span><span class="legend-value">{{ $occupiedToday }}</span><span class="legend-pct">rooms</span></div>
      <div class="legend-row"><div class="legend-dot" style="background:#4b8ef5;"></div><span class="legend-label">Reserved</span><span class="legend-value">{{ $reservedToday }}</span><span class="legend-pct">upcoming</span></div>
      <div class="legend-row"><div class="legend-dot" style="background:#3fb87a;"></div><span class="legend-label">Available</span><span class="legend-value">{{ $availableRooms }}</span><span class="legend-pct">rooms</span></div>
    </div>
  </div>

</div>

<!-- Lower Row -->
<div class="lower-row">

  <!-- Recent Bookings Table -->
  <div class="table-card">
    <div class="tc-header">
      <div class="ch-title">
        Recent Bookings
        <small>Latest reservations</small>
      </div>
      <a class="view-all-btn" href="{{ route('booking.list') }}">
        View all
        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
    <table class="data-table">
      <thead>
        <tr>
          <th>Guest</th>
          <th>Room</th>
          <th>Check-in</th>
          <th>Check-out</th>
          <th>Amount</th>
          <th>Payment</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recentBookings as $booking)
        @php
          $initials = collect(explode(' ', $booking->name ?? $booking->user->name ?? 'G'))->map(fn($w) => strtoupper(substr($w,0,1)))->take(2)->join('');
          $statusClass = match((int)$booking->status) {
              0 => 's-pending', 1 => 's-confirmed', 2 => 's-checkedin',
              3 => 's-checkedout', 4 => 's-cancelled', 5 => 's-denied',
              default => 's-pending'
          };
          $statusLabel = match((int)$booking->status) {
              0 => 'Pending', 1 => 'Confirmed', 2 => 'Checked In',
              3 => 'Checked Out', 4 => 'Cancelled', 5 => 'Denied',
              default => 'Unknown'
          };
        @endphp
        <tr class="clickable-row" onclick="window.location='{{ route('edit_booking', $booking->id) }}'">
          <td>
            <div class="guest-cell">
              <div class="guest-av">{{ $initials }}</div>
              <div>
                <div class="guest-name">{{ $booking->name ?? $booking->user->name ?? 'Guest' }}</div>
                <div class="guest-email">{{ $booking->email ?? $booking->user->email ?? '' }}</div>
              </div>
            </div>
          </td>
          <td>{{ $booking->room->type->name ?? 'N/A' }}</td>
          <td>{{ $booking->check_in->format('d M Y') }}</td>
          <td>{{ $booking->check_out->format('d M Y') }}</td>
          <td class="amount-cell">{{ number_format($booking->total_price) }}</td>
          <td>
            @if($booking->payment_status == 1)
              <span class="status-pill s-confirmed" style="font-size:10px;">Paid</span>
            @elseif($booking->payment_status == 3)
              <span class="status-pill s-pending" style="font-size:10px;">Partial</span>
            @else
              <span class="status-pill s-cancelled" style="font-size:10px;">Unpaid</span>
            @endif
          </td>
          <td><span class="status-pill {{ $statusClass }}">{{ $statusLabel }}</span></td>
        </tr>
        @empty
        <tr>
          <td colspan="7" style="text-align:center; padding:30px; color:var(--text-3);">No bookings yet</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Right Column -->
  <div class="side-col">

    <!-- Room Types -->
    <div class="room-status-card">
      <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:0;">
        <div class="ch-title" style="font-size:16px;">
          Room Types
          <small>Today's availability</small>
        </div>
        <a class="view-all-btn" href="{{ route('room.type.list') }}">
          View all
          <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
      <div class="room-grid">
        @php $colors = ['var(--gold)', 'var(--info)', 'var(--danger)', 'var(--success)', 'var(--warning)']; @endphp
        @foreach($roomTypes as $i => $type)
        <a href="{{ route('room.type.list') }}" class="room-type-chip">
          <div class="room-type-name">{{ $type->name }}</div>
          <div class="room-type-count">{{ $type->total_rooms }}</div>
          <div class="room-type-sub">{{ $type->available_rooms }} available</div>
          <div class="room-type-bar"><div class="room-type-bar-fill" style="width:{{ $type->occupied_pct }}%;background:{{ $colors[$i % count($colors)] }};"></div></div>
        </a>
        @endforeach
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="activity-card">
      <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:0;">
        <div class="ch-title" style="font-size:16px;">
          Recent Activity
          <small>Live updates</small>
        </div>
      </div>
      <div class="activity-list">
        @forelse($recentActivity as $log)
        @php
          $dotColor = match(true) {
              str_contains($log->action, 'confirmed') => 'var(--success)',
              str_contains($log->action, 'cancelled') || str_contains($log->action, 'denied') => 'var(--danger)',
              str_contains($log->action, 'checked_in') => 'var(--info)',
              str_contains($log->action, 'checked_out') => 'var(--text-3)',
              str_contains($log->action, 'payment') => 'var(--gold)',
              default => 'var(--warning)',
          };
          $actionLabel = str_replace('_', ' ', ucfirst($log->action));
        @endphp
        @if($log->model_type && class_basename($log->model_type) === 'Booking' && $log->model_id)
        <a href="{{ route('edit_booking', $log->model_id) }}" class="activity-item">
        @else
        <div class="activity-item">
        @endif
          <div class="activity-dot-wrap">
            <div class="activity-dot" style="background:{{ $dotColor }};"></div>
            <div class="activity-line"></div>
          </div>
          <div style="flex:1;">
            <div class="activity-text">
              <strong>{{ $log->user->name ?? 'System' }}</strong> — {{ $actionLabel }}
              @if($log->model_type && class_basename($log->model_type) === 'Booking')
                (#{{ $log->model_id }})
              @endif
            </div>
            <div class="activity-time">{{ $log->created_at->diffForHumans() }}</div>
          </div>
        @if($log->model_type && class_basename($log->model_type) === 'Booking' && $log->model_id)
        </a>
        @else
        </div>
        @endif
        @empty
        <div style="text-align:center; padding:20px; color:var(--text-3); font-size:13px;">No recent activity</div>
        @endforelse
      </div>
    </div>

  </div><!-- /side-col -->
</div><!-- /lower-row -->

@endsection

@push('scripts')
<script>
  /* ── Revenue Chart ── */
  const rCtx = document.getElementById('revenueChart').getContext('2d');

  const grad = rCtx.createLinearGradient(0, 0, 0, 220);
  grad.addColorStop(0, 'rgba(208,170,72,0.28)');
  grad.addColorStop(1, 'rgba(208,170,72,0.00)');

  const grad2 = rCtx.createLinearGradient(0, 0, 0, 220);
  grad2.addColorStop(0, 'rgba(75,142,245,0.18)');
  grad2.addColorStop(1, 'rgba(75,142,245,0.00)');

  new Chart(rCtx, {
    type: 'line',
    data: {
      labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
      datasets: [
        {
          label: '{{ now()->year }}',
          data: @json($monthlyRevenueData),
          borderColor: '#d0aa48',
          backgroundColor: grad,
          borderWidth: 2.2,
          tension: 0.42,
          fill: true,
          pointRadius: 0,
          pointHoverRadius: 5,
          pointHoverBackgroundColor: '#d0aa48',
          pointHoverBorderColor: '#080c18',
          pointHoverBorderWidth: 2,
        },
        {
          label: '{{ now()->year - 1 }}',
          data: @json($lastYearRevenueData),
          borderColor: '#4b8ef5',
          backgroundColor: grad2,
          borderWidth: 1.8,
          tension: 0.42,
          fill: true,
          borderDash: [5,4],
          pointRadius: 0,
          pointHoverRadius: 5,
          pointHoverBackgroundColor: '#4b8ef5',
          pointHoverBorderColor: '#080c18',
          pointHoverBorderWidth: 2,
        }
      ]
    },
    options: {
      responsive: true,
      interaction: { mode: 'index', intersect: false },
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: '#101828',
          borderColor: 'rgba(208,170,72,.2)',
          borderWidth: 1,
          padding: 10,
          titleColor: '#a4aec6',
          bodyColor: '#f2ebd6',
          titleFont: { family: "'DM Sans'", size: 11 },
          bodyFont: { family: "'DM Sans'", size: 13, weight: '600' },
          callbacks: {
            label: ctx => '  $' + Number(ctx.parsed.y).toLocaleString()
          }
        }
      },
      scales: {
        x: {
          grid: { display: false },
          ticks: { color: '#4e5870', font: { family: "'DM Sans'", size: 11 }, maxRotation: 0 },
          border: { display: false }
        },
        y: {
          grid: { color: 'rgba(255,255,255,.04)', drawTicks: false },
          ticks: {
            color: '#4e5870',
            font: { family: "'DM Sans'", size: 11 },
            padding: 8,
            callback: v => (v/1000).toFixed(0) + 'k'
          },
          border: { display: false }
        }
      }
    }
  });

  /* ── Donut Chart ── */
  const dCtx = document.getElementById('donutChart').getContext('2d');
  new Chart(dCtx, {
    type: 'doughnut',
    data: {
      labels: ['Occupied', 'Reserved', 'Available'],
      datasets: [{
        data: [{{ $occupiedToday }}, {{ $reservedToday }}, {{ $availableRooms }}],
        backgroundColor: ['#d0aa48','#4b8ef5','#3fb87a'],
        borderWidth: 0,
        hoverOffset: 4,
      }]
    },
    options: {
      cutout: '76%',
      responsive: false,
      plugins: { legend: { display: false }, tooltip: { enabled: false } }
    }
  });
</script>
@endpush
