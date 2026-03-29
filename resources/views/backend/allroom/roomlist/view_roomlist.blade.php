@extends('admin.admin_dashboard')
@section('admin')

@push('styles')
<style>
  .page-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px;}
  .page-top-left{display:flex;flex-direction:column;gap:4px;}
  .page-title{font-family:var(--font-display);font-size:26px;font-weight:500;color:var(--text-1);}
  .page-title span{color:var(--gold);}
  .page-breadcrumb-custom{display:flex;align-items:center;gap:6px;font-size:12px;color:var(--text-3);}
  .page-breadcrumb-custom a{color:var(--text-3);text-decoration:none;transition:color var(--transition);}
  .page-breadcrumb-custom a:hover{color:var(--gold);}
  .bc-sep{color:var(--text-3);opacity:.5;}

  .rl-card{background:var(--bg-card);border:1px solid var(--border2);border-radius:var(--radius);overflow:hidden;backdrop-filter:blur(6px);}
  .rl-card .card-head{padding:20px 24px;border-bottom:1px solid var(--border2);display:flex;align-items:center;justify-content:space-between;}
  .rl-card .card-head h5{font-family:var(--font-display);font-size:18px;font-weight:500;color:var(--text-1);margin:0;}
  .add-btn{display:inline-flex;align-items:center;gap:8px;padding:8px 20px;border-radius:10px;background:var(--gold);color:#042a5e;font-size:12px;font-weight:600;border:none;cursor:pointer;transition:background var(--transition),transform .15s;text-decoration:none;}
  .add-btn:hover{background:var(--gold-light);color:#042a5e;transform:translateY(-1px);}

  .rl-table{width:100%;border-collapse:collapse;}
  .rl-table th{padding:12px 16px;font-size:10.5px;letter-spacing:1px;text-transform:uppercase;color:var(--text-3);font-weight:600;border-bottom:1px solid var(--border2);text-align:left;white-space:nowrap;}
  .rl-table td{padding:13px 16px;font-size:13px;color:var(--text-2);border-bottom:1px solid rgba(255,255,255,.04);vertical-align:middle;}
  .rl-table tr:hover td{background:rgba(255,255,255,.04);}
  .pill{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;white-space:nowrap;}
  .pill::before{content:'';width:5px;height:5px;border-radius:50%;}
  .pill.booked{background:rgba(224,82,82,.1);color:var(--danger);border:1px solid rgba(224,82,82,.2);}
  .pill.booked::before{background:var(--danger);}
  .pill.pending{background:rgba(232,155,58,.1);color:var(--warning);border:1px solid rgba(232,155,58,.2);}
  .pill.pending::before{background:var(--warning);}
  .pill.available{background:rgba(76,175,125,.1);color:var(--success);border:1px solid rgba(76,175,125,.2);}
  .pill.available::before{background:var(--success);}
  .pill.active{background:rgba(76,175,125,.1);color:var(--success);border:1px solid rgba(76,175,125,.2);}
  .pill.active::before{background:var(--success);}
  .pill.inactive{background:rgba(224,82,82,.1);color:var(--danger);border:1px solid rgba(224,82,82,.2);}
  .pill.inactive::before{background:var(--danger);}
  .date-badge{display:inline-block;padding:2px 8px;border-radius:12px;font-size:11px;font-weight:500;}
  .date-badge.in{background:rgba(76,175,125,.1);color:var(--success);}
  .date-badge.out{background:rgba(75,142,245,.1);color:var(--info);}
  .pill.room-type{background:rgba(76,175,125,.1);color:var(--success);border:1px solid rgba(76,175,125,.2);}
  .pill.room-type::before{background:var(--success);}
  .pill.hall-type{background:rgba(232,155,58,.1);color:var(--warning);border:1px solid rgba(232,155,58,.2);}
  .pill.hall-type::before{background:var(--warning);}
</style>
@endpush

<div class="page-top">
  <div class="page-top-left">
    <div class="page-title">Room <span>List</span></div>
    <div class="page-breadcrumb-custom">
      <a href="{{ route('admin.dashboard') }}">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="width:13px;height:13px;"><path d="M3 22V9l9-7 9 7v13"/><path d="M9 22V12h6v10"/></svg>
      </a>
      <span class="bc-sep">/</span>
      <span>Room List</span>
    </div>
  </div>
  <a href="{{ route('add.room.list') }}" class="add-btn">
    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width:14px;height:14px;"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    Add Reservation
  </a>
</div>

<div class="rl-card">
  <div class="card-head">
    <h5>All Rooms & Assignments</h5>
  </div>
  <div style="overflow-x:auto;">
    <table class="rl-table" id="example">
      <thead>
        <tr>
          <th>#</th>
          <th>Room Type</th>
          <th>Type</th>
          <th>Room No</th>
          <th>Booking Status</th>
          <th>In / Out Dates</th>
          <th>Booking No</th>
          <th>Customer</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($room_number_list as $key => $item)
        <tr>
          <td>{{ $key + 1 }}</td>
          <td style="font-weight:500;color:var(--text-1);">{{ $item->name }}</td>
          <td>
            @php $isHall = ($item->room_type_type ?? '') === 'Hall'; @endphp
            <span class="pill {{ $isHall ? 'hall-type' : 'room-type' }}">{{ $item->room_type_type ?? 'Room' }}</span>
          </td>
          <td style="font-weight:600;color:var(--gold);">{{ $item->room_no }}</td>
          <td>
            @if ($item->booking_id != '')
              @if ($item->booking_stauts == 1)
                <span class="pill booked">Booked</span>
              @else
                <span class="pill pending">Pending</span>
              @endif
            @else
              <span class="pill available">Available</span>
            @endif
          </td>
          <td>
            @if ($item->booking_id != '')
              <span class="date-badge in">{{ date('d M Y', strtotime($item->check_in)) }}</span>
              →
              <span class="date-badge out">{{ date('d M Y', strtotime($item->check_out)) }}</span>
            @else
              <span style="color:var(--text-3);">—</span>
            @endif
          </td>
          <td>
            @if ($item->booking_id != '')
              <span style="font-weight:500;">{{ $item->booking_no }}</span>
            @else
              <span style="color:var(--text-3);">—</span>
            @endif
          </td>
          <td>
            @if ($item->booking_id != '')
              {{ $item->customer_name }}
            @else
              <span style="color:var(--text-3);">—</span>
            @endif
          </td>
          <td>
            @if ($item->status == 'Active')
              <span class="pill active">Active</span>
            @else
              <span class="pill inactive">Inactive</span>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection