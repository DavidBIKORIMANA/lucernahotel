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
  .form-card{background:var(--bg-card);border:1px solid var(--border2);border-radius:var(--radius);padding:28px 32px;backdrop-filter:blur(6px);max-width:520px;}
  .form-card h5{font-family:var(--font-display);font-size:20px;font-weight:500;color:var(--text-1);margin-bottom:24px;}
  .form-row{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:18px;}
  .field label{display:block;font-size:12px;font-weight:500;color:var(--text-3);margin-bottom:6px;letter-spacing:.3px;}
  .field input,.field select{width:100%;padding:10px 14px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:var(--radius-sm);color:#fff;font-family:var(--font-ui);font-size:13px;outline:none;transition:border-color var(--transition),background var(--transition);}
  .field input:focus,.field select:focus{border-color:var(--gold);background:rgba(255,255,255,.12);}
  .field select option{background:#0e1422;color:#fff;}
  .form-actions{display:flex;gap:12px;margin-top:24px;}
  .btn-gold{padding:10px 28px;border-radius:10px;background:var(--gold);color:#042a5e;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:background var(--transition),transform .15s;}
  .btn-gold:hover{background:var(--gold-light);transform:translateY(-1px);}
  .btn-outline{padding:10px 28px;border-radius:10px;background:transparent;color:var(--text-2);font-size:13px;font-weight:500;border:1px solid var(--border2);cursor:pointer;transition:background var(--transition);text-decoration:none;display:inline-flex;align-items:center;}
  .btn-outline:hover{background:var(--bg-hover);color:var(--text-1);}
</style>
@endpush

<div class="page-top">
  <div class="page-top-left">
    @php $isHall = ($editroomno->room_type->type ?? '') === 'Hall'; @endphp
    <div class="page-title">Edit <span>{{ $isHall ? 'Hall' : 'Room' }} Number</span></div>
    <div class="page-breadcrumb-custom">
      <a href="{{ route('admin.dashboard') }}">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" style="width:13px;height:13px;"><path d="M3 22V9l9-7 9 7v13"/><path d="M9 22V12h6v10"/></svg>
      </a>
      <span class="bc-sep">/</span>
      <a href="{{ route('room.type.list') }}">Room Types</a>
      <span class="bc-sep">/</span>
      <span>{{ $isHall ? 'Hall' : 'Room' }} #{{ $editroomno->room_no }}</span>
    </div>
  </div>
</div>

<div class="form-card">
  <h5>Update {{ $isHall ? 'Hall' : 'Room' }} Number</h5>
  <form action="{{ route('update.roomno', $editroomno->id) }}" method="post">
    @csrf
    <div class="form-row">
      <div class="field">
        <label>{{ $isHall ? 'Hall' : 'Room' }} Number</label>
        <input type="text" name="room_no" value="{{ $editroomno->room_no }}" required>
      </div>
      <div class="field">
        <label>Status</label>
        <select name="status" required>
          <option value="Active" {{ $editroomno->status == 'Active' ? 'selected' : '' }}>Active</option>
          <option value="Inactive" {{ $editroomno->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn-gold">Save Changes</button>
      <a href="{{ route('room.type.list') }}" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>
@endsection