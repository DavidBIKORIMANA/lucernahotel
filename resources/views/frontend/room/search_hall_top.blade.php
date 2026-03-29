@extends('frontend.main_master')

@section('styles')
/* ══════════════════════════════
   SEARCH RESULTS PAGE – HALLS
══════════════════════════════ */
.sr-hero {
    position:relative; height:300px; overflow:hidden;
    display:flex; align-items:center; justify-content:center;
}
.sr-hero-bg { position:absolute; inset:0; background:linear-gradient(139deg,var(--navy) 14.24%,var(--navy-deep) 75.61%); }
.sr-hero-overlay { position:absolute; inset:0; background:linear-gradient(to bottom,rgba(7,22,38,.3),rgba(7,22,38,.55)); }
.sr-hero-content { position:relative; z-index:2; text-align:center; padding:0 20px; }
.sr-hero-eyebrow {
    font-family:var(--f-body); font-size:12px; font-weight:600;
    letter-spacing:.28em; text-transform:uppercase;
    color:var(--gold); margin-bottom:10px;
}
.sr-hero-title {
    font-family:var(--f-head); font-size:clamp(28px,5vw,48px); font-weight:500;
    line-height:1.1; color:var(--white); margin-bottom:12px;
}
.sr-hero-title em { font-style:italic; font-weight:400; color:var(--gold); }
.sr-dates-strip {
    display:inline-flex; gap:16px; align-items:center;
    background:rgba(212,168,83,.1); backdrop-filter:blur(8px);
    padding:10px 24px; border-radius:2px; margin-top:14px;
    font-family:var(--f-body); font-size:13px; color:rgba(255,255,255,.85);
    border:1px solid rgba(212,168,83,.2);
}
.sr-dates-strip svg { width:16px; height:16px; stroke:var(--gold); }
.sr-dates-strip strong { color:var(--white); }
.sr-listing { max-width:1280px; margin:0 auto; padding:40px 48px 60px; }
.sr-grid {
    display:grid; grid-template-columns:repeat(3,1fr); gap:20px;
}
.sr-card {
    overflow:hidden; background:var(--white);
    border:1px solid rgba(12,36,64,.06);
    transition:all .35s; display:flex; flex-direction:column;
    text-decoration:none; color:inherit;
}
.sr-card:hover { box-shadow:0 12px 36px rgba(12,36,64,.1); transform:translateY(-3px); }
.sr-card-img { position:relative; overflow:hidden; height:240px; }
.sr-card-img img {
    width:100%; height:100%; object-fit:cover; display:block;
    transition:transform .5s var(--ease);
}
.sr-card:hover .sr-card-img img { transform:scale(1.05); }
.sr-avail-badge {
    position:absolute; top:12px; right:12px;
    font-family:var(--f-body); font-size:10px; font-weight:700;
    letter-spacing:.1em; text-transform:uppercase;
    padding:5px 12px; border-radius:2px;
    background:rgba(212,168,83,.9); color:var(--white);
}
.sr-type-badge {
    position:absolute; top:12px; left:12px;
    font-family:var(--f-body); font-size:10px; font-weight:700;
    letter-spacing:.1em; text-transform:uppercase;
    padding:5px 12px; border-radius:2px;
    background:rgba(212,168,83,.9); color:var(--white);
}
.sr-card-body { padding:20px; flex:1; display:flex; flex-direction:column; }
.sr-card-name {
    font-family:var(--f-head); font-size:22px; font-weight:400;
    font-style:italic; color:var(--navy); margin-bottom:6px;
}
.sr-card-meta {
    font-family:var(--f-body); font-size:12px; color:var(--soft);
    margin-bottom:12px;
}
.sr-card-footer { display:flex; justify-content:space-between; align-items:center; margin-top:auto; }
.sr-card-price { font-family:var(--f-head); font-size:20px; font-weight:600; color:var(--navy); }
.sr-card-price span { font-family:var(--f-body); font-size:12px; color:var(--soft); }
.sr-card-btn {
    font-family:var(--f-body); font-size:11px; font-weight:600;
    letter-spacing:.12em; text-transform:uppercase;
    padding:9px 18px; background:var(--navy); color:var(--gold);
    border:none; border-radius:2px; text-decoration:none;
    transition:all .25s;
}
.sr-card-btn:hover { background:var(--navy-deep); }
.sr-empty {
    grid-column:1/-1; text-align:center; padding:60px 20px;
    color:var(--soft); font-size:15px;
}
.sr-empty svg { width:48px; height:48px; stroke:var(--soft); margin-bottom:16px; display:block; margin:0 auto 16px; }
.sr-back-link {
    display:inline-block; margin-top:12px;
    font-family:var(--f-body); font-size:13px; color:var(--gold);
    text-decoration:none; font-weight:600;
}
.sr-back-link:hover { text-decoration:underline; }

@media(max-width:1024px){ .sr-grid { grid-template-columns:1fr 1fr; } .sr-listing { padding:32px 28px 48px; } }
@media(max-width:768px){ .sr-hero { height:260px; } .sr-grid { grid-template-columns:1fr; max-width:480px; margin:0 auto; } .sr-listing { padding:28px 14px 40px; } }
@media(max-width:480px){ .sr-hero { height:220px; } .sr-hero-title { font-size:clamp(22px,7vw,32px); } .sr-dates-strip { font-size:11px; padding:8px 16px; gap:10px; } .sr-card-img { height:200px; } }
@endsection

@section('main')

<section class="sr-hero">
    <div class="sr-hero-bg"></div>
    <div class="sr-hero-overlay"></div>
    <div class="sr-hero-content">
        <div class="sr-hero-eyebrow">Search Results</div>
        <h1 class="sr-hero-title">Available <em>Halls</em></h1>
        @if(old('check_in') && old('check_out'))
        <div class="sr-dates-strip">
            <svg viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <span><strong>{{ old('check_in') }}</strong> — <strong>{{ old('check_out') }}</strong></span>
        </div>
        @endif
    </div>
</section>

<div class="sr-listing">
    <div class="sr-grid">
        @php $empty_array = []; @endphp
        @foreach($rooms as $item)
        @php
            $bookings = App\Models\Booking::withCount('assign_rooms')
                ->whereIn('id', $check_date_booking_ids)
                ->where('rooms_id', $item->id)->get()->toArray();
            $total_book_room = array_sum(array_column($bookings, 'assign_rooms_count'));
            $av_room = ($item->room_numbers_count ?? 0) - $total_book_room;
        @endphp

        @if($av_room > 0)
        <div class="sr-card">
            <div class="sr-card-img">
                <a href="{{ route('search_room_details', $item->id.'?check_in='.old('check_in').'&check_out='.old('check_out').'&persion='.old('persion')) }}">
                    <img src="{{ asset('upload/roomimg/'.$item->image) }}" alt="{{ $item->type->name ?? 'Hall' }}" loading="lazy">
                </a>
                <span class="sr-type-badge">Hall</span>
                <span class="sr-avail-badge">{{ $av_room }} Available</span>
            </div>
            <div class="sr-card-body">
                <div class="sr-card-name">{{ $item->type->name ?? 'Hall' }}</div>
                <div class="sr-card-meta">
                    @if($item->room_capacity) Up to {{ $item->room_capacity }} Guests @endif
                    @if($item->size) &middot; {{ $item->size }} @endif
                </div>
                <div class="sr-card-footer">
                    <div class="sr-card-price">RwF {{ number_format($item->price, 0) }} <span>/ event</span></div>
                    <a href="{{ route('search_room_details', $item->id.'?check_in='.old('check_in').'&check_out='.old('check_out').'&persion='.old('persion')) }}" class="sr-card-btn">Reserve</a>
                </div>
            </div>
        </div>
        @else
            @php $empty_array[] = $item->id; @endphp
        @endif
        @endforeach

        @if(count($rooms) == count($empty_array))
        <div class="sr-empty">
            <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            <p>No halls available for the selected dates.</p>
            <a href="{{ url('/') }}" class="sr-back-link">← Try Different Dates</a>
        </div>
        @endif
    </div>
</div>
@endsection