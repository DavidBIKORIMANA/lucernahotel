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
  .page-breadcrumb-custom svg{width:13px;height:13px;}
  .bc-sep{color:var(--text-3);opacity:.5;}

  .form-card{background:var(--bg-card);border:1px solid var(--border2);border-radius:var(--radius);padding:28px 32px;backdrop-filter:blur(6px);max-width:680px;}
  .form-card h5{font-family:var(--font-display);font-size:20px;font-weight:500;color:var(--text-1);margin-bottom:24px;}
  .form-row{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:18px;}
  .form-row.full{grid-template-columns:1fr;}
  .field label{display:block;font-size:12px;font-weight:500;color:var(--text-3);margin-bottom:6px;letter-spacing:.3px;}
  .field input,.field select,.field textarea{width:100%;padding:10px 14px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:var(--radius-sm);color:#fff;font-family:var(--font-ui);font-size:13px;outline:none;transition:border-color var(--transition),background var(--transition);}
  .field input:focus,.field select:focus,.field textarea:focus{border-color:var(--gold);background:rgba(255,255,255,.12);}
  .field input::placeholder,.field textarea::placeholder{color:rgba(255,255,255,.35);}
  .field select option{background:#0e1422;color:#fff;}
  .field .error{color:var(--danger);font-size:11px;margin-top:4px;}
  .form-actions{display:flex;gap:12px;margin-top:24px;}
  .btn-gold{padding:10px 28px;border-radius:10px;background:var(--gold);color:#042a5e;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:background var(--transition),transform .15s;}
  .btn-gold:hover{background:var(--gold-light);transform:translateY(-1px);}
  .btn-outline{padding:10px 28px;border-radius:10px;background:transparent;color:var(--text-2);font-size:13px;font-weight:500;border:1px solid var(--border2);cursor:pointer;transition:background var(--transition);text-decoration:none;display:inline-flex;align-items:center;}
  .btn-outline:hover{background:var(--bg-hover);color:var(--text-1);}
  .toggle-row{display:flex;align-items:center;gap:12px;margin-bottom:18px;}
  .toggle-switch{position:relative;width:44px;height:24px;}
  .toggle-switch input{opacity:0;width:0;height:0;}
  .toggle-slider{position:absolute;cursor:pointer;inset:0;background:rgba(255,255,255,.15);border-radius:24px;transition:background .3s;}
  .toggle-slider::before{content:"";position:absolute;left:3px;top:3px;width:18px;height:18px;background:#fff;border-radius:50%;transition:transform .3s;}
  .toggle-switch input:checked+.toggle-slider{background:var(--gold);}
  .toggle-switch input:checked+.toggle-slider::before{transform:translateX(20px);}
  .toggle-label{font-size:13px;color:var(--text-2);}
</style>
@endpush

<div class="page-top">
  <div class="page-top-left">
    <div class="page-title">Add <span>Rate Season</span></div>
    <div class="page-breadcrumb-custom">
      <a href="{{ route('admin.dashboard') }}">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 22V9l9-7 9 7v13"/><path d="M9 22V12h6v10"/></svg>
      </a>
      <span class="bc-sep">/</span>
      <a href="{{ route('all.seasons') }}">Rate Seasons</a>
      <span class="bc-sep">/</span>
      <span>Add</span>
    </div>
  </div>
</div>

<div class="form-card">
  <h5>New Rate Season</h5>
  <form action="{{ route('store.season') }}" method="post">
    @csrf
    <div class="form-row full">
      <div class="field">
        <label>Season Name</label>
        <input type="text" name="name" placeholder="e.g. High Season, Christmas Peak" required value="{{ old('name') }}">
        @error('name') <div class="error">{{ $message }}</div> @enderror
      </div>
    </div>
    <div class="form-row">
      <div class="field">
        <label>Start Date</label>
        <input type="date" name="start_date" required value="{{ old('start_date') }}">
        @error('start_date') <div class="error">{{ $message }}</div> @enderror
      </div>
      <div class="field">
        <label>End Date</label>
        <input type="date" name="end_date" required value="{{ old('end_date') }}">
        @error('end_date') <div class="error">{{ $message }}</div> @enderror
      </div>
    </div>
    <div class="form-row full">
      <div class="field">
        <label>Price Multiplier</label>
        <input type="number" name="price_multiplier" step="0.01" min="0.01" max="99.99" placeholder="e.g. 1.50 for 50% increase" required value="{{ old('price_multiplier') }}">
        @error('price_multiplier') <div class="error">{{ $message }}</div> @enderror
      </div>
    </div>
    <div class="toggle-row">
      <label class="toggle-switch">
        <input type="checkbox" name="is_active" value="1" checked>
        <span class="toggle-slider"></span>
      </label>
      <span class="toggle-label">Active</span>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn-gold">Create Season</button>
      <a href="{{ route('all.seasons') }}" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>
@endsection
