@extends('admin.admin_dashboard')
@section('admin')

@php
  use Carbon\Carbon;

  $bookings = App\Models\Booking::latest()->get();
  $pending = App\Models\Booking::where('status','0')->count();
  $confirmed = App\Models\Booking::where('status','1')->count();
  $checkedIn = App\Models\Booking::where('status','2')->count();
  $checkedOut = App\Models\Booking::where('status','3')->count();
  $cancelled = App\Models\Booking::where('status','4')->count();
  $totalPrice = App\Models\Booking::sum('total_price');

  $today = Carbon::now()->toDateString();
  $todayPrice = App\Models\Booking::whereDate('created_at', $today)->sum('total_price');
  $todayBookings = App\Models\Booking::whereDate('created_at', $today)->count();

  // This month
  $monthStart = Carbon::now()->startOfMonth();
  $monthPrice = App\Models\Booking::where('created_at', '>=', $monthStart)->sum('total_price');
  $monthBookings = App\Models\Booking::where('created_at', '>=', $monthStart)->count();

  // Last month for comparison
  $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
  $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
  $lastMonthPrice = App\Models\Booking::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('total_price');
  $lastMonthBookings = App\Models\Booking::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();

  // Trends
  $revenueTrend = $lastMonthPrice > 0 ? round((($monthPrice - $lastMonthPrice) / $lastMonthPrice) * 100, 1) : 0;
  $bookingTrend = $lastMonthBookings > 0 ? round((($monthBookings - $lastMonthBookings) / $lastMonthBookings) * 100, 1) : 0;

  // Occupancy
  $currentGuests = App\Models\Booking::where('status', 2)->count();
  $totalRoomNumbers = App\Models\RoomNumber::where('status', 'Active')->count();
  $occupancyRate = $totalRoomNumbers > 0 ? round(($currentGuests / $totalRoomNumbers) * 100) : 0;

  // Reviews
  $pendingReviews = App\Models\Review::where('is_approved', false)->count();

  // Total guests this year
  $totalGuestsYear = App\Models\Booking::whereYear('created_at', Carbon::now()->year)
      ->sum('number_of_rooms');

  // Recent 10 bookings
  $recentBookings = App\Models\Booking::orderBy('id','desc')->limit(10)->get();

  // Monthly revenue for chart (last 6 months)
  $monthlyRevenue = [];
  $monthlyLabels = [];
  for ($i = 5; $i >= 0; $i--) {
      $month = Carbon::now()->subMonths($i);
      $monthlyLabels[] = $month->format('M');
      $monthlyRevenue[] = App\Models\Booking::whereYear('created_at', $month->year)
          ->whereMonth('created_at', $month->month)
          ->sum('total_price');
  }

  // Room types with counts
  $roomTypes = App\Models\RoomType::with(['rooms.room_numbers'])->get();

  // Recent activity (last 5 bookings for timeline)
  $recentActivity = App\Models\Booking::orderBy('updated_at','desc')->limit(5)->get();

  // Greeting
  $hour = Carbon::now()->hour;
  $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
@endphp

@push('styles')
<style>
  .welcome-bar{display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;}
  .welcome-greeting{font-family:var(--font-display);font-size:32px;font-weight:500;color:var(--text-1);line-height:1.1;}
  .welcome-greeting span{color:var(--gold);}
  .welcome-sub{font-size:13px;color:var(--text-3);margin-top:4px;}
  .date-chip{background:var(--bg-card);border:1px solid var(--border);border-radius:20px;padding:7px 16px;font-size:12.5px;color:var(--text-2);display:flex;align-items:center;gap:7px;backdrop-filter:blur(6px);}
  .date-chip svg{color:var(--gold);}

  .kpi-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;}
  .kpi-card{background:var(--bg-card);border:1px solid var(--border2);border-radius:var(--radius);padding:22px 22px 20px;position:relative;overflow:hidden;transition:border-color var(--transition),transform .2s;cursor:default;backdrop-filter:blur(6px);}
  .kpi-card::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(255,255,255,.06) 0%,transparent 60%);pointer-events:none;}
  .kpi-card:hover{border-color:var(--gold-dim);transform:translateY(-2px);}
  .kpi-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px;}
  .kpi-icon{width:42px;height:42px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:20px;}
  .kpi-icon.gold{background:var(--gold-bg);border:1px solid rgba(201,168,76,.2);color:var(--gold);}
  .kpi-icon.blue{background:rgba(75,142,245,.08);border:1px solid rgba(75,142,245,.2);color:var(--info);}
  .kpi-icon.green{background:rgba(76,175,125,.08);border:1px solid rgba(76,175,125,.2);color:var(--success);}
  .kpi-icon.warn{background:rgba(232,155,58,.08);border:1px solid rgba(232,155,58,.2);color:var(--warning);}
  .kpi-trend{font-size:11px;font-weight:600;padding:3px 8px;border-radius:20px;display:flex;align-items:center;gap:3px;}
  .kpi-trend.up{background:rgba(76,175,125,.12);color:var(--success);}
  .kpi-trend.down{background:rgba(224,82,82,.12);color:var(--danger);}
  .kpi-value{font-family:var(--font-display);font-size:34px;font-weight:600;color:var(--text-1);line-height:1;margin-bottom:5px;}
  .kpi-label{font-size:12px;color:var(--text-3);font-weight:500;letter-spacing:.3px;}
  .kpi-bar{margin-top:14px;height:3px;background:var(--border2);border-radius:2px;overflow:hidden;}
  .kpi-bar-fill{height:100%;border-radius:2px;}

  .charts-row{display:grid;grid-template-columns:1fr 340px;gap:16px;margin-bottom:24px;}
  .chart-card{background:var(--bg-card);border:1px solid var(--border2);border-radius:var(--radius);padding:24px;backdrop-filter:blur(6px);}
  .chart-card .card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;padding:0;background:transparent;border:0;}
  .card-title{font-family:var(--font-display);font-size:18px;font-weight:500;color:var(--text-1);}
  .card-title small{display:block;font-family:var(--font-ui);font-size:11px;color:var(--text-3);font-weight:400;margin-top:2px;letter-spacing:.3px;}
  .donut-legend{display:flex;flex-direction:column;gap:10px;margin-top:20px;}
  .legend-row{display:flex;align-items:center;gap:10px;}
  .legend-dot{width:10px;height:10px;border-radius:50%;flex-shrink:0;}
  .legend-label{font-size:12.5px;color:var(--text-2);flex:1;}
  .legend-value{font-size:13px;font-weight:600;color:var(--text-1);}
  .legend-pct{font-size:11px;color:var(--text-3);}

  .lower-row{display:grid;grid-template-columns:1fr 320px;gap:16px;}
  .table-card{background:var(--bg-card);border:1px solid var(--border2);border-radius:var(--radius);overflow:hidden;backdrop-filter:blur(6px);}
  .table-card .card-header{padding:20px 24px;border-bottom:1px solid var(--border2);display:flex;align-items:center;justify-content:space-between;background:transparent;}
  .data-table{width:100%;border-collapse:collapse;}
  .data-table th{padding:10px 16px;font-size:10.5px;letter-spacing:1px;text-transform:uppercase;color:var(--text-3);font-weight:600;border-bottom:1px solid var(--border2);text-align:left;white-space:nowrap;}
  .data-table td{padding:13px 16px;font-size:13px;color:var(--text-2);border-bottom:1px solid rgba(255,255,255,.03);vertical-align:middle;}
  .data-table tr:last-child td{border-bottom:none;}
  .data-table tr{transition:background var(--transition);}
  .data-table tr:hover td{background:var(--bg-hover);color:var(--text-1);}
  .guest-cell{display:flex;align-items:center;gap:10px;}
  .guest-av{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:600;flex-shrink:0;}
  .guest-av.c1{background:rgba(201,168,76,.12);color:var(--gold);}
  .guest-av.c2{background:rgba(75,142,245,.12);color:var(--info);}
  .guest-av.c3{background:rgba(76,175,125,.12);color:var(--success);}
  .guest-av.c4{background:rgba(224,82,82,.12);color:var(--danger);}
  .guest-av.c5{background:rgba(232,155,58,.12);color:var(--warning);}
  .guest-name{font-size:13px;font-weight:500;color:var(--text-1);}
  .guest-email{font-size:11px;color:var(--text-3);}
  .status-pill{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;white-space:nowrap;}
  .status-pill::before{content:'';width:5px;height:5px;border-radius:50%;display:inline-block;}
  .status-pill.confirmed{background:rgba(76,175,125,.1);color:var(--success);border:1px solid rgba(76,175,125,.2);}
  .status-pill.confirmed::before{background:var(--success);}
  .status-pill.pending{background:rgba(232,155,58,.1);color:var(--warning);border:1px solid rgba(232,155,58,.2);}
  .status-pill.pending::before{background:var(--warning);}
  .status-pill.checked-in{background:rgba(75,142,245,.1);color:var(--info);border:1px solid rgba(75,142,245,.2);}
  .status-pill.checked-in::before{background:var(--info);}
  .status-pill.checked-out{background:rgba(158,168,190,.1);color:var(--text-2);border:1px solid rgba(158,168,190,.2);}
  .status-pill.checked-out::before{background:var(--text-2);}
  .status-pill.cancelled{background:rgba(224,82,82,.1);color:var(--danger);border:1px solid rgba(224,82,82,.2);}
  .status-pill.cancelled::before{background:var(--danger);}
  .amount-cell{font-weight:600;color:var(--gold);}
  .view-all-btn{display:flex;align-items:center;gap:6px;padding:5px 12px;border-radius:20px;border:1px solid var(--border);background:transparent;color:var(--gold);font-size:12px;font-family:var(--font-ui);font-weight:500;cursor:pointer;transition:background var(--transition);text-decoration:none;}
  .view-all-btn:hover{background:var(--gold-bg);color:var(--gold);}

  .side-col{display:flex;flex-direction:column;gap:16px;}
  .room-status-card{background:var(--bg-card);border:1px solid var(--border2);border-radius:var(--radius);padding:22px;flex:1;backdrop-filter:blur(6px);}
  .room-status-card .card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:0;padding:0;background:transparent;border:0;}
  .room-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:10px;margin-top:16px;}
  .room-type-chip{background:var(--bg-card2);border:1px solid var(--border2);border-radius:10px;padding:14px;transition:border-color var(--transition);}
  .room-type-chip:hover{border-color:var(--gold-dim);}
  .room-type-name{font-size:12px;color:var(--text-3);margin-bottom:4px;font-weight:500;}
  .room-type-count{font-family:var(--font-display);font-size:26px;font-weight:600;color:var(--text-1);line-height:1;}
  .room-type-sub{font-size:10px;color:var(--text-3);margin-top:2px;}
  .room-type-bar{margin-top:8px;height:2px;background:var(--border2);border-radius:2px;overflow:hidden;}
  .room-type-bar-fill{height:100%;border-radius:2px;}

  .activity-card{background:var(--bg-card);border:1px solid var(--border2);border-radius:var(--radius);padding:22px;backdrop-filter:blur(6px);}
  .activity-card .card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:0;padding:0;background:transparent;border:0;}
  .activity-list{margin-top:16px;display:flex;flex-direction:column;gap:0;}
  .activity-item{display:flex;gap:12px;padding:10px 0;border-bottom:1px solid rgba(255,255,255,.03);position:relative;}
  .activity-item:last-child{border-bottom:none;}
  .activity-dot-wrap{display:flex;flex-direction:column;align-items:center;}
  .activity-dot{width:8px;height:8px;border-radius:50%;margin-top:5px;flex-shrink:0;}
  .activity-line{width:1px;flex:1;background:var(--border2);margin-top:4px;}
  .activity-item:last-child .activity-line{display:none;}
  .activity-text{font-size:12.5px;color:var(--text-2);flex:1;}
  .activity-text strong{color:var(--text-1);font-weight:500;}
  .activity-time{font-size:11px;color:var(--text-3);}

  @keyframes fadeUp{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:translateY(0);}}
  .kpi-card{animation:fadeUp .5s ease both;}
  .kpi-card:nth-child(1){animation-delay:.05s;}
  .kpi-card:nth-child(2){animation-delay:.12s;}
  .kpi-card:nth-child(3){animation-delay:.19s;}
  .kpi-card:nth-child(4){animation-delay:.26s;}
  .chart-card,.table-card,.room-status-card,.activity-card{animation:fadeUp .5s ease both;animation-delay:.3s;}

  @media(max-width:1280px){.kpi-grid{grid-template-columns:repeat(2,1fr);}.charts-row{grid-template-columns:1fr;}.lower-row{grid-template-columns:1fr;}}
  @media(max-width:900px){.kpi-grid{grid-template-columns:1fr;}}
</style>
@endpush

<!-- Welcome -->
<div class="welcome-bar">
  <div>
    <div class="welcome-greeting">{{ $greeting }}, <span>{{ explode(' ', Auth::user()->name)[0] }}</span></div>
    <div class="welcome-sub">Here's what's happening at the hotel today.</div>
  </div>
  <div class="date-chip">
    <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
    {{ Carbon::now()->format('l, j F Y') }}
  </div>
</div>

<!-- KPIs -->
<div class="kpi-grid">
  <div class="kpi-card">
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
    <div class="kpi-value">${{ number_format($monthPrice) }}</div>
    <div class="kpi-label">MONTHLY REVENUE</div>
    <div class="kpi-bar"><div class="kpi-bar-fill" style="width:{{ min($totalPrice > 0 ? round(($monthPrice / max($totalPrice, 1)) * 100 * 4) : 0, 100) }}%;background:var(--gold);"></div></div>
  </div>

  <div class="kpi-card">
    <div class="kpi-header">
      <div class="kpi-icon blue">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M2 9h20M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z"/></svg>
      </div>
      <div class="kpi-trend {{ $bookingTrend >= 0 ? 'up' : 'down' }}">
        @if($bookingTrend >= 0)
        <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        @else
        <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg>
        @endif
        {{ $bookingTrend >= 0 ? '+' : '' }}{{ $bookingTrend }}%
      </div>
    </div>
    <div class="kpi-value">{{ $monthBookings }}</div>
    <div class="kpi-label">ACTIVE BOOKINGS · THIS MONTH</div>
    <div class="kpi-bar"><div class="kpi-bar-fill" style="width:{{ min($monthBookings * 2, 100) }}%;background:var(--info);"></div></div>
  </div>

  <div class="kpi-card">
    <div class="kpi-header">
      <div class="kpi-icon green">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M3 22V12l9-8 9 8v10"/><path d="M9 22v-6h6v6"/></svg>
      </div>
      <div class="kpi-trend up">
        <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        {{ $currentGuests }}/{{ $totalRoomNumbers }}
      </div>
    </div>
    <div class="kpi-value">{{ $occupancyRate }}<span style="font-size:20px;color:var(--text-3);">%</span></div>
    <div class="kpi-label">OCCUPANCY RATE · TODAY</div>
    <div class="kpi-bar"><div class="kpi-bar-fill" style="width:{{ $occupancyRate }}%;background:var(--success);"></div></div>
  </div>

  <div class="kpi-card">
    <div class="kpi-header">
      <div class="kpi-icon warn">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      </div>
      <div class="kpi-trend {{ $pending > 0 ? 'down' : 'up' }}">
        @if($pending > 0)
        <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/><polyline points="17 18 23 18 23 12"/></svg>
        {{ $pending }} pending
        @else
        <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        All clear
        @endif
      </div>
    </div>
    <div class="kpi-value">{{ number_format($totalGuestsYear) }}</div>
    <div class="kpi-label">TOTAL BOOKINGS · THIS YEAR</div>
    <div class="kpi-bar"><div class="kpi-bar-fill" style="width:55%;background:var(--warning);"></div></div>
  </div>
</div>

<!-- Charts Row -->
<div class="charts-row">
  <div class="chart-card">
    <div class="card-header">
      <div class="card-title">
        Revenue Overview
        <small>Monthly performance tracking</small>
      </div>
    </div>
    <canvas id="revenueChart" height="110"></canvas>
  </div>

  <div class="chart-card">
    <div class="card-header">
      <div class="card-title">
        Booking Status
        <small>Current distribution</small>
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
      <div class="legend-row"><div class="legend-dot" style="background:var(--success);"></div><span class="legend-label">Confirmed</span><span class="legend-value">{{ $confirmed }}</span></div>
      <div class="legend-row"><div class="legend-dot" style="background:var(--warning);"></div><span class="legend-label">Pending</span><span class="legend-value">{{ $pending }}</span></div>
      <div class="legend-row"><div class="legend-dot" style="background:var(--info);"></div><span class="legend-label">Checked In</span><span class="legend-value">{{ $checkedIn }}</span></div>
      <div class="legend-row"><div class="legend-dot" style="background:var(--danger);"></div><span class="legend-label">Cancelled</span><span class="legend-value">{{ $cancelled }}</span></div>
    </div>
  </div>
</div>

<!-- Lower Row -->
<div class="lower-row">
  <!-- Bookings Table -->
  <div class="table-card">
    <div class="card-header">
      <div class="card-title">
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
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @php $avatarColors = ['c1','c2','c3','c4','c5']; @endphp
        @foreach($recentBookings as $key => $item)
        @php
          $guestName = $item->user->name ?? 'Guest';
          $guestInitials = collect(explode(' ', $guestName))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('');
          $colorClass = $avatarColors[$key % 5];
          $statusClass = match((int)$item->status) {
              0 => 'pending',
              1 => 'confirmed',
              2 => 'checked-in',
              3 => 'checked-out',
              4 => 'cancelled',
              default => 'pending'
          };
          $statusLabel = match((int)$item->status) {
              0 => 'Pending',
              1 => 'Confirmed',
              2 => 'Checked In',
              3 => 'Checked Out',
              4 => 'Cancelled',
              default => 'Pending'
          };
        @endphp
        <tr>
          <td>
            <div class="guest-cell">
              <div class="guest-av {{ $colorClass }}">{{ $guestInitials }}</div>
              <div>
                <div class="guest-name">{{ $guestName }}</div>
                <div class="guest-email">{{ $item->code }}</div>
              </div>
            </div>
          </td>
          <td>{{ $item->room->type->name ?? '—' }}</td>
          <td>{{ $item->check_in }}</td>
          <td>{{ $item->check_out }}</td>
          <td class="amount-cell">${{ number_format($item->total_price) }}</td>
          <td><span class="status-pill {{ $statusClass }}">{{ $statusLabel }}</span></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Right Column -->
  <div class="side-col">
    <!-- Room Types -->
    <div class="room-status-card">
      <div class="card-header">
        <div class="card-title" style="font-size:16px;">
          Room Types
          <small>Availability by category</small>
        </div>
      </div>
      <div class="room-grid">
        @php $chipColors = ['var(--gold)', 'var(--info)', 'var(--success)', 'var(--danger)', 'var(--warning)']; @endphp
        @foreach($roomTypes->take(4) as $idx => $type)
        @php
          $totalRooms = $type->rooms->count();
          $activeRooms = $type->rooms->flatMap->room_numbers->where('status', 'Active')->count();
          $bookedRooms = \App\Models\Booking::where('status', 2)
              ->whereHas('room', fn($q) => $q->where('roomtype_id', $type->id))
              ->count();
          $available = max(0, $activeRooms - $bookedRooms);
          $pct = $activeRooms > 0 ? round((($activeRooms - $available) / $activeRooms) * 100) : 0;
        @endphp
        <div class="room-type-chip">
          <div class="room-type-name">{{ $type->name }}</div>
          <div class="room-type-count">{{ $activeRooms }}</div>
          <div class="room-type-sub">{{ $available }} available</div>
          <div class="room-type-bar"><div class="room-type-bar-fill" style="width:{{ $pct }}%;background:{{ $chipColors[$idx % 5] }};"></div></div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="activity-card">
      <div class="card-header">
        <div class="card-title" style="font-size:16px;">
          Recent Activity
          <small>Live updates</small>
        </div>
      </div>
      <div class="activity-list">
        @php
          $activityColors = ['var(--success)', 'var(--info)', 'var(--warning)', 'var(--danger)', 'var(--gold)'];
        @endphp
        @foreach($recentActivity as $aIdx => $activity)
        @php
          $activityText = match((int)$activity->status) {
              0 => '<strong>' . e($activity->user->name ?? 'Guest') . '</strong> made a new booking',
              1 => 'Booking <strong>#' . e($activity->code) . '</strong> confirmed',
              2 => '<strong>' . e($activity->user->name ?? 'Guest') . '</strong> checked in',
              3 => '<strong>' . e($activity->user->name ?? 'Guest') . '</strong> checked out',
              4 => 'Booking <strong>#' . e($activity->code) . '</strong> cancelled',
              default => 'Booking <strong>#' . e($activity->code) . '</strong> updated'
          };
        @endphp
        <div class="activity-item">
          <div class="activity-dot-wrap">
            <div class="activity-dot" style="background:{{ $activityColors[$aIdx % 5] }};"></div>
            <div class="activity-line"></div>
          </div>
          <div style="flex:1;">
            <div class="activity-text">{!! $activityText !!}</div>
            <div class="activity-time">{{ $activity->updated_at->diffForHumans() }}</div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<script>
  // Revenue Line Chart
  var rCtx = document.getElementById('revenueChart').getContext('2d');
  var grad = rCtx.createLinearGradient(0, 0, 0, 220);
  grad.addColorStop(0, 'rgba(201,168,76,0.28)');
  grad.addColorStop(1, 'rgba(201,168,76,0.00)');

  new Chart(rCtx, {
    type: 'line',
    data: {
      labels: @json($monthlyLabels),
      datasets: [{
        label: 'Revenue',
        data: @json($monthlyRevenue),
        borderColor: '#c9a84c',
        backgroundColor: grad,
        borderWidth: 2.2,
        tension: 0.42,
        fill: true,
        pointRadius: 0,
        pointHoverRadius: 5,
        pointHoverBackgroundColor: '#c9a84c',
        pointHoverBorderColor: '#090d17',
        pointHoverBorderWidth: 2,
      }]
    },
    options: {
      responsive: true,
      interaction: { mode: 'index', intersect: false },
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: '#131928',
          borderColor: 'rgba(201,168,76,.2)',
          borderWidth: 1,
          padding: 10,
          titleColor: '#9ea8be',
          bodyColor: '#f0ead8',
          titleFont: { family: "'Plus Jakarta Sans'", size: 11 },
          bodyFont: { family: "'Plus Jakarta Sans'", size: 13, weight: '600' },
          callbacks: { label: ctx => '  $' + ctx.parsed.y.toLocaleString() }
        }
      },
      scales: {
        x: {
          grid: { display: false },
          ticks: { color: '#5b6478', font: { family: "'Plus Jakarta Sans'", size: 11 }, maxRotation: 0 },
          border: { display: false }
        },
        y: {
          grid: { color: 'rgba(255,255,255,.04)', drawTicks: false },
          ticks: {
            color: '#5b6478',
            font: { family: "'Plus Jakarta Sans'", size: 11 },
            padding: 8,
            callback: v => '$' + (v/1000).toFixed(0) + 'k'
          },
          border: { display: false }
        }
      }
    }
  });

  // Donut Chart
  var dCtx = document.getElementById('donutChart').getContext('2d');
  new Chart(dCtx, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [{{ $confirmed }}, {{ $pending }}, {{ $checkedIn }}, {{ $cancelled }}],
        backgroundColor: ['#4caf7d','#e89b3a','#4b8ef5','#e05252'],
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

@endsection