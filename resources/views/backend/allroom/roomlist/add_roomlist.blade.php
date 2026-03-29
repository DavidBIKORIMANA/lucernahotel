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

  .rm-card{background:var(--bg-card);border:1px solid var(--border2);border-radius:var(--radius);padding:28px 32px;backdrop-filter:blur(6px);margin-bottom:20px;}
  .rm-card h5{font-family:var(--font-display);font-size:20px;font-weight:500;color:var(--text-1);margin-bottom:24px;padding-bottom:12px;border-bottom:1px solid var(--border2);}
  .form-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
  .form-grid.cols-2{grid-template-columns:1fr 1fr;}
  .form-grid.cols-4{grid-template-columns:repeat(4,1fr);}
  .field{margin-bottom:0;}
  .field.span-2{grid-column:span 2;}
  .field.span-3{grid-column:span 3;}
  .field label{display:block;font-size:12px;font-weight:500;color:var(--text-3);margin-bottom:6px;letter-spacing:.3px;}
  .field input,.field select,.field textarea{width:100%;padding:10px 14px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:var(--radius-sm);color:#fff;font-family:var(--font-ui);font-size:13px;outline:none;transition:border-color var(--transition),background var(--transition);}
  .field input:focus,.field select:focus,.field textarea:focus{border-color:var(--gold);background:rgba(255,255,255,.12);}
  .field input::placeholder,.field textarea::placeholder{color:rgba(255,255,255,.35);}
  .field select option{background:#0e1422;color:#fff;}
  .field textarea{min-height:80px;resize:vertical;}
  .avail-tag{display:inline-flex;align-items:center;gap:5px;margin-top:8px;font-size:12px;font-weight:600;color:var(--success);}
  .btn-gold{padding:10px 28px;border-radius:10px;background:var(--gold);color:#042a5e;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:background var(--transition),transform .15s;}
  .btn-gold:hover{background:var(--gold-light);transform:translateY(-1px);}
  .section-sep{font-family:var(--font-display);font-size:16px;font-weight:500;color:var(--gold);margin:0 0 20px;padding-top:4px;}
  @media(max-width:900px){.form-grid,.form-grid.cols-4{grid-template-columns:1fr;}.field.span-2,.field.span-3{grid-column:span 1;}}
</style>
@endpush

<div class="page-top">
  <div class="page-top-left">
    <div class="page-title">Add <span>Reservation</span></div>
    <div class="page-breadcrumb-custom">
      <a href="{{ route('admin.dashboard') }}">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="width:13px;height:13px;"><path d="M3 22V9l9-7 9 7v13"/><path d="M9 22V12h6v10"/></svg>
      </a>
      <span class="bc-sep">/</span>
      <a href="{{ route('view.room.list') }}">Room List</a>
      <span class="bc-sep">/</span>
      <span>Add Reservation</span>
    </div>
  </div>
</div>

<form method="POST" action="{{ route('store.roomlist') }}">
  @csrf

  <div class="rm-card">
    <h5>Room / Hall & Dates</h5>
    <div class="form-grid">
      <div class="field">
        <label>Room / Hall Type</label>
        <select name="room_id" id="room_id">
          <option value="">Select Room or Hall…</option>
          @foreach ($roomtype as $item)
          @if($item->room)
          <option value="{{ $item->room->id }}">{{ $item->name }} ({{ $item->type ?? 'Room' }})</option>
          @endif
          @endforeach
        </select>
      </div>
      <div class="field">
        <label>Check-in</label>
        <input type="date" name="check_in" id="check_in">
      </div>
      <div class="field">
        <label>Check-out</label>
        <input type="date" name="check_out" id="check_out">
      </div>
      <div class="field">
        <label>Number of Rooms</label>
        <input type="number" name="number_of_rooms" min="1" placeholder="1">
        <input type="hidden" name="available_room" id="available_room">
        <div class="avail-tag">Availability: <span class="availability">0</span></div>
      </div>
      <div class="field">
        <label>Number of Guests</label>
        <input type="number" name="number_of_person" id="number_of_person" min="1" placeholder="1">
      </div>
    </div>
  </div>

  <div class="rm-card">
    <h5>Customer Information</h5>
    <div class="form-grid">
      <div class="field">
        <label>Full Name</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Guest name">
      </div>
      <div class="field">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com">
      </div>
      <div class="field">
        <label>Phone</label>
        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+250 ...">
      </div>
      <div class="field">
        <label>Country</label>
        <input type="text" name="country" value="{{ old('country') }}" placeholder="Rwanda">
      </div>
      <div class="field">
        <label>State</label>
        <input type="text" name="state" value="{{ old('state') }}">
      </div>
      <div class="field">
        <label>Zip Code</label>
        <input type="text" name="zip_code" value="{{ old('zip_code') }}">
      </div>
      <div class="field span-3">
        <label>Address</label>
        <textarea name="address" rows="3" placeholder="Customer address…">{{ old('address') }}</textarea>
      </div>
    </div>
  </div>

  <button type="submit" class="btn-gold">Create Reservation</button>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const roomId = document.getElementById('room_id');
  const checkIn = document.getElementById('check_in');
  const checkOut = document.getElementById('check_out');

  roomId.addEventListener('change', function() {
    checkIn.value = '';
    checkOut.value = '';
    document.querySelector('.availability').textContent = '0';
    document.getElementById('available_room').value = 0;
  });

  checkOut.addEventListener('change', function() {
    const ci = checkIn.value, co = checkOut.value, rid = roomId.value;
    if (new Date(ci) > new Date(co)) {
      alert('Check-out must be after check-in');
      checkOut.value = '';
      return;
    }
    if (ci && co && rid) {
      fetch("{{ route('check_room_availability') }}?room_id=" + rid + "&check_in=" + ci + "&check_out=" + co)
        .then(r => r.json())
        .then(data => {
          document.querySelector('.availability').textContent = data.available_room;
          document.getElementById('available_room').value = data.available_room;
        });
    }
  });
});
</script>
@endpush

@endsection