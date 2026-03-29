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

  .add-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 22px;border-radius:10px;background:var(--gold);color:#042a5e;font-size:13px;font-weight:600;font-family:var(--font-ui);border:none;cursor:pointer;transition:background var(--transition),transform .15s;text-decoration:none;}
  .add-btn:hover{background:var(--gold-light);color:#042a5e;transform:translateY(-1px);}
  .add-btn svg{width:16px;height:16px;}

  .room-type-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:18px;}

  .rt-card{background:var(--bg-card);border:1px solid var(--border2);border-radius:var(--radius);overflow:hidden;transition:border-color var(--transition),transform .2s;position:relative;backdrop-filter:blur(6px);}
  .rt-card::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(255,255,255,.06) 0%,transparent 60%);pointer-events:none;z-index:1;}
  .rt-card:hover{border-color:var(--gold-dim);transform:translateY(-3px);}

  .rt-img-wrap{position:relative;height:180px;overflow:hidden;}
  .rt-img-wrap img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease;}
  .rt-card:hover .rt-img-wrap img{transform:scale(1.05);}
  .rt-img-overlay{position:absolute;bottom:0;left:0;right:0;height:60%;background:linear-gradient(transparent,rgba(3,78,162,.85));z-index:2;}
  .rt-type-badge{position:absolute;top:14px;right:14px;z-index:3;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:600;letter-spacing:.3px;}
  .rt-type-badge.room{background:rgba(76,175,125,.15);color:var(--success);border:1px solid rgba(76,175,125,.25);}
  .rt-type-badge.hall{background:rgba(232,155,58,.15);color:var(--warning);border:1px solid rgba(232,155,58,.25);}

  .rt-body{padding:20px 22px;position:relative;z-index:2;}
  .rt-name{font-family:var(--font-display);font-size:22px;font-weight:600;color:var(--text-1);margin-bottom:6px;line-height:1.2;}
  .rt-meta{display:flex;align-items:center;gap:14px;margin-bottom:16px;}
  .rt-meta-item{display:flex;align-items:center;gap:5px;font-size:12px;color:var(--text-3);}
  .rt-meta-item svg{width:14px;height:14px;color:var(--gold-dim);}

  .rt-actions{display:flex;gap:8px;flex-wrap:wrap;}
  .rt-action-btn{display:inline-flex;align-items:center;gap:5px;padding:7px 14px;border-radius:8px;font-size:12px;font-weight:600;font-family:var(--font-ui);cursor:pointer;transition:background var(--transition),border-color var(--transition),transform .15s;text-decoration:none;border:1px solid;}
  .rt-action-btn:hover{transform:translateY(-1px);}
  .rt-action-btn.edit{background:rgba(232,155,58,.08);color:var(--warning);border-color:rgba(232,155,58,.2);}
  .rt-action-btn.edit:hover{background:rgba(232,155,58,.18);color:var(--warning);}
  .rt-action-btn.delete{background:rgba(224,82,82,.08);color:var(--danger);border-color:rgba(224,82,82,.2);}
  .rt-action-btn.delete:hover{background:rgba(224,82,82,.18);color:var(--danger);}
  .rt-action-btn svg{width:13px;height:13px;}

  .rt-empty{grid-column:1/-1;text-align:center;padding:60px 20px;color:var(--text-3);}
  .rt-empty svg{width:48px;height:48px;color:var(--border);margin-bottom:12px;display:block;margin-inline:auto;}
  .rt-empty-text{font-size:15px;margin-bottom:4px;color:var(--text-2);}
  .rt-empty-sub{font-size:13px;}

  @keyframes cardIn{from{opacity:0;transform:translateY(16px);}to{opacity:1;transform:translateY(0);}}
  .rt-card{animation:cardIn .45s ease both;}
  .rt-card:nth-child(1){animation-delay:.05s;}
  .rt-card:nth-child(2){animation-delay:.1s;}
  .rt-card:nth-child(3){animation-delay:.15s;}
  .rt-card:nth-child(4){animation-delay:.2s;}
  .rt-card:nth-child(5){animation-delay:.25s;}
  .rt-card:nth-child(6){animation-delay:.3s;}
</style>
@endpush

<!-- Page Top -->
<div class="page-top">
  <div class="page-top-left">
    <div class="page-title">Accommodation <span>Types</span></div>
    <div class="page-breadcrumb-custom">
      <a href="{{ route('admin.dashboard') }}">
        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 22V9l9-7 9 7v13"/><path d="M9 22V12h6v10"/></svg>
      </a>
      <span class="bc-sep">/</span>
      <span>Accommodation Types</span>
    </div>
  </div>
  <a href="{{ route('add.room.type') }}" class="add-btn">
    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    Add Room Type
  </a>
</div>

<!-- Room Type Cards -->
<div class="room-type-grid">
  @forelse ($allData as $key => $item)
    @php
      $rooms = App\Models\Room::where('roomtype_id', $item->id)->get();
      $roomCount = $rooms->count();
      $isHall = $item->type === 'Hall';
    @endphp
    <div class="rt-card">
      <div class="rt-img-wrap">
        <img src="{{ (!empty($item->room->image)) ? url('upload/roomimg/'.$item->room->image) : url('upload/no_image.jpg') }}" alt="{{ $item->name }}">
        <div class="rt-img-overlay"></div>
        <span class="rt-type-badge {{ $isHall ? 'hall' : 'room' }}">{{ $item->type ?? 'Room' }}</span>
      </div>
      <div class="rt-body">
        <div class="rt-name">{{ $item->name }}</div>
        <div class="rt-meta">
          <div class="rt-meta-item">
            <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M2 22V12l10-8 10 8v10H2z"/><path d="M9 22v-6h6v6"/></svg>
            {{ $roomCount }} {{ Str::plural($isHall ? 'hall' : 'room', $roomCount) }}
          </div>
        </div>
        <div class="rt-actions">
          @foreach ($rooms as $roo)
            <a href="{{ route('edit.room', [$roo->id, $item->type]) }}" class="rt-action-btn edit">
              <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              Edit
            </a>
            <a href="{{ route('delete.room', $roo->id) }}" class="rt-action-btn delete" id="delete">
              <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
              Delete
            </a>
          @endforeach
        </div>
      </div>
    </div>
  @empty
    <div class="rt-empty">
      <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M2 22V12l10-8 10 8v10H2z"/><path d="M9 22v-6h6v6"/></svg>
      <div class="rt-empty-text">No room types found</div>
      <div class="rt-empty-sub">Click "Add Room Type" to create your first accommodation type.</div>
    </div>
  @endforelse
</div>

@endsection