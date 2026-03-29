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
  .btn-add{padding:10px 22px;border-radius:10px;background:var(--gold);color:#042a5e;font-size:13px;font-weight:600;border:none;cursor:pointer;transition:background var(--transition),transform .15s;text-decoration:none;display:inline-flex;align-items:center;gap:6px;}
  .btn-add:hover{background:var(--gold-light);transform:translateY(-1px);color:#042a5e;}
  .btn-add svg{width:16px;height:16px;}

  .season-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:20px;}
  .season-card{background:var(--bg-card);border:1px solid var(--border2);border-radius:var(--radius);padding:24px;backdrop-filter:blur(6px);transition:transform var(--transition),border-color var(--transition);position:relative;overflow:hidden;}
  .season-card:hover{transform:translateY(-2px);border-color:var(--gold-dim);}
  .season-card.inactive{opacity:.6;}
  .season-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px;}
  .season-name{font-family:var(--font-display);font-size:20px;font-weight:500;color:var(--text-1);}
  .season-badge{padding:4px 12px;border-radius:20px;font-size:11px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;}
  .season-badge.active{background:rgba(76,175,125,.15);color:#4caf7d;border:1px solid rgba(76,175,125,.25);}
  .season-badge.inactive{background:rgba(255,255,255,.06);color:var(--text-3);border:1px solid rgba(255,255,255,.1);}
  .season-meta{display:flex;flex-direction:column;gap:10px;margin-bottom:18px;}
  .season-meta-row{display:flex;align-items:center;gap:10px;font-size:13px;color:var(--text-2);}
  .season-meta-row svg{width:16px;height:16px;color:var(--text-3);flex-shrink:0;}
  .season-meta-row strong{color:var(--text-1);font-weight:600;}
  .multiplier-badge{background:var(--gold-bg);color:var(--gold);padding:3px 10px;border-radius:6px;font-weight:600;font-size:13px;border:1px solid rgba(201,168,76,.2);}
  .season-dates{display:flex;gap:8px;align-items:center;}
  .date-pill{background:rgba(255,255,255,.06);padding:4px 10px;border-radius:6px;font-size:12px;color:var(--text-2);border:1px solid rgba(255,255,255,.08);}
  .date-arrow{color:var(--text-3);font-size:12px;}
  .season-actions{display:flex;gap:8px;padding-top:16px;border-top:1px solid var(--border2);}
  .act-btn{padding:8px 16px;border-radius:8px;font-size:12px;font-weight:500;border:none;cursor:pointer;transition:background var(--transition),transform .15s;display:inline-flex;align-items:center;gap:5px;text-decoration:none;}
  .act-btn:hover{transform:translateY(-1px);}
  .act-btn.edit{background:rgba(75,142,245,.12);color:var(--info);border:1px solid rgba(75,142,245,.2);}
  .act-btn.edit:hover{background:rgba(75,142,245,.2);}
  .act-btn.delete{background:rgba(224,82,82,.1);color:var(--danger);border:1px solid rgba(224,82,82,.18);}
  .act-btn.delete:hover{background:rgba(224,82,82,.2);}
  .act-btn svg{width:14px;height:14px;}
  .overrides-count{font-size:12px;color:var(--text-3);margin-top:2px;}

  .empty-state{text-align:center;padding:60px 20px;color:var(--text-3);}
  .empty-state svg{width:48px;height:48px;margin-bottom:12px;opacity:.4;}
  .empty-state p{font-size:14px;}

  @keyframes fadeUp{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
  .season-card{animation:fadeUp .4s ease both;}
  .season-card:nth-child(2){animation-delay:.05s;}
  .season-card:nth-child(3){animation-delay:.1s;}
  .season-card:nth-child(4){animation-delay:.15s;}
  .season-card:nth-child(5){animation-delay:.2s;}
  .season-card:nth-child(6){animation-delay:.25s;}
</style>
@endpush

<div class="page-top">
  <div class="page-top-left">
    <div class="page-title">Rate <span>Seasons</span></div>
    <div class="page-breadcrumb-custom">
      <a href="{{ route('admin.dashboard') }}">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 22V9l9-7 9 7v13"/><path d="M9 22V12h6v10"/></svg>
      </a>
      <span class="bc-sep">/</span>
      <span>Rate Seasons</span>
    </div>
  </div>
  <a href="{{ route('add.season') }}" class="btn-add">
    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    Add Season
  </a>
</div>

@if($seasons->isEmpty())
<div class="empty-state">
  <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
  <p>No rate seasons yet. Create one to manage seasonal pricing.</p>
</div>
@else
<div class="season-grid">
  @foreach($seasons as $season)
  <div class="season-card {{ $season->is_active ? '' : 'inactive' }}">
    <div class="season-header">
      <div>
        <div class="season-name">{{ $season->name }}</div>
        <div class="overrides-count">{{ $season->room_overrides()->count() }} room override(s)</div>
      </div>
      <span class="season-badge {{ $season->is_active ? 'active' : 'inactive' }}">
        {{ $season->is_active ? 'Active' : 'Inactive' }}
      </span>
    </div>
    <div class="season-meta">
      <div class="season-meta-row">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        <div class="season-dates">
          <span class="date-pill">{{ $season->start_date->format('M d, Y') }}</span>
          <span class="date-arrow">→</span>
          <span class="date-pill">{{ $season->end_date->format('M d, Y') }}</span>
        </div>
      </div>
      <div class="season-meta-row">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        Price Multiplier: <span class="multiplier-badge">{{ $season->price_multiplier }}×</span>
      </div>
    </div>
    <div class="season-actions">
      <a href="{{ route('edit.season', $season->id) }}" class="act-btn edit">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        Edit
      </a>
      <a href="{{ route('delete.season', $season->id) }}" class="act-btn delete" id="delete">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
        Delete
      </a>
    </div>
  </div>
  @endforeach
</div>
@endif
@endsection
