@extends('frontend.main_master')

@section('styles')
*, *::before, *::after { --tw-border-opacity:1 !important; }
input:focus, select:focus, textarea:focus { outline:none !important; box-shadow:none !important; border-color:var(--brand) !important; --tw-ring-shadow:none !important; --tw-ring-color:transparent !important; }
.ud-hero { background:var(--navy); padding:48px 60px 40px; position:relative; overflow:hidden; }
.ud-hero::after { content:''; position:absolute; inset:0; background:radial-gradient(ellipse at 80% 50%, rgba(212,168,83,.06) 0%, transparent 70%); pointer-events:none; }
.ud-hero-inner { max-width:1320px; margin:0 auto; position:relative; z-index:1; }
.ud-hero-greeting { font-family:var(--f-body); font-size:14px; color:rgba(255,255,255,.45); margin-bottom:6px; }
.ud-hero-title { font-family:var(--f-head); font-size:clamp(26px,4vw,40px); font-weight:500; font-style:italic; color:var(--white); }
.ud-wrap { max-width:1320px; margin:0 auto; padding:40px 60px 64px; display:grid; grid-template-columns:260px 1fr; gap:40px; align-items:start; }
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
.ud-section-label { font-family:var(--f-body); font-size:13px; font-weight:700; letter-spacing:.22em; text-transform:uppercase; color:var(--brand); margin-bottom:18px; padding-bottom:12px; border-bottom:2px solid rgba(12,77,162,.06); }

/* Table */
.ud-table-wrap { overflow-x:auto; background:var(--white); border:1px solid rgba(12,36,64,.06); box-shadow:0 4px 24px rgba(12,36,64,.05); }
.ud-table { width:100%; border-collapse:collapse; min-width:700px; }
.ud-table th { font-family:var(--f-body); font-size:10px; font-weight:700; letter-spacing:.16em; text-transform:uppercase; color:var(--soft); padding:14px 16px; text-align:left; border-bottom:2px solid rgba(12,36,64,.06); background:var(--off-white); white-space:nowrap; }
.ud-table td { font-family:var(--f-body); font-size:14px; color:var(--ink); padding:14px 16px; border-bottom:1px solid rgba(12,36,64,.04); vertical-align:middle; }
.ud-table tr:hover td { background:rgba(12,77,162,.015); }
.ud-table .code-link { color:var(--brand); font-weight:600; text-decoration:none; font-size:13px; }
.ud-table .code-link:hover { text-decoration:underline; }
.ud-badge { display:inline-block; font-family:var(--f-body); font-size:10px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; padding:4px 12px; border-radius:2px; white-space:nowrap; }
.ud-badge.pending { background:rgba(234,179,8,.1); color:#a16207; }
.ud-badge.confirmed { background:rgba(34,197,94,.08); color:#16a34a; }
.ud-badge.checked-in { background:rgba(59,130,246,.08); color:#2563eb; }
.ud-badge.checked-out { background:rgba(107,114,128,.08); color:#4b5563; }
.ud-badge.cancelled { background:rgba(239,68,68,.08); color:#dc2626; }
.ud-date-badge { display:inline-block; font-family:var(--f-body); font-size:12px; font-weight:500; padding:3px 10px; border-radius:2px; }
.ud-date-in { background:rgba(12,77,162,.06); color:var(--brand); }
.ud-date-out { background:rgba(234,179,8,.08); color:#a16207; }
.ud-review-btn { padding:6px 14px; font-family:var(--f-body); font-size:11px; font-weight:700; letter-spacing:.1em; text-transform:uppercase; border:1px solid var(--brand); background:transparent; color:var(--brand); cursor:pointer; border-radius:2px; transition:all .2s; }
.ud-review-btn:hover { background:rgba(12,77,162,.04); }
.ud-reviewed { font-family:var(--f-body); font-size:12px; color:#16a34a; display:inline-flex; align-items:center; gap:4px; }
.ud-empty-table { text-align:center; padding:48px 20px; font-family:var(--f-body); font-size:15px; color:var(--soft); }

/* Action buttons */
.ud-action-btn { display:inline-flex; align-items:center; gap:5px; padding:5px 12px; font-family:var(--f-body); font-size:11px; font-weight:600; letter-spacing:.06em; text-transform:uppercase; border-radius:2px; cursor:pointer; transition:all .2s; text-decoration:none; border:1px solid transparent; }
.ud-action-btn.cancel { background:rgba(239,68,68,.06); color:#dc2626; border-color:rgba(239,68,68,.2); }
.ud-action-btn.cancel:hover { background:rgba(239,68,68,.12); }
.ud-action-btn.invoice { background:rgba(12,77,162,.06); color:var(--brand); border-color:rgba(12,77,162,.15); }
.ud-action-btn.invoice:hover { background:rgba(12,77,162,.1); }
.ud-action-btn svg { width:13px; height:13px; stroke:currentColor; flex-shrink:0; }
.ud-actions-cell { display:flex; gap:6px; flex-wrap:wrap; align-items:center; }
.ud-amount { font-family:var(--f-body); font-size:14px; font-weight:600; color:var(--navy); white-space:nowrap; }
.ud-amount small { font-weight:400; color:var(--soft); font-size:11px; }
.ud-pay-badge { display:inline-block; font-family:var(--f-body); font-size:10px; font-weight:700; letter-spacing:.08em; text-transform:uppercase; padding:3px 10px; border-radius:2px; }
.ud-pay-badge.paid { background:rgba(34,197,94,.08); color:#16a34a; }
.ud-pay-badge.unpaid { background:rgba(239,68,68,.08); color:#dc2626; }
.ud-pay-badge.partial { background:rgba(234,179,8,.1); color:#a16207; }

/* Cancel modal */
.ud-cancel-overlay { display:none; position:fixed; inset:0; background:rgba(7,22,38,.5); z-index:1000; align-items:center; justify-content:center; }
.ud-cancel-overlay.show { display:flex; }

/* Review modal styling */
.ud-modal-overlay { display:none; position:fixed; inset:0; background:rgba(7,22,38,.5); z-index:1000; align-items:center; justify-content:center; }
.ud-modal-overlay.show { display:flex; }
.ud-modal { background:var(--white); width:100%; max-width:480px; margin:20px; box-shadow:0 20px 60px rgba(12,36,64,.2); }
.ud-modal-header { padding:24px 28px; border-bottom:1px solid rgba(12,36,64,.06); display:flex; justify-content:space-between; align-items:center; }
.ud-modal-title { font-family:var(--f-head); font-size:22px; font-weight:500; color:var(--navy); }
.ud-modal-close { background:none; border:none; cursor:pointer; padding:4px; color:var(--soft); }
.ud-modal-close svg { width:20px; height:20px; stroke:currentColor; }
.ud-modal-body { padding:28px; }
.ud-modal-field { margin-bottom:18px; }
.ud-modal-field label { display:block; font-family:var(--f-body); font-size:11px; font-weight:700; letter-spacing:.16em; text-transform:uppercase; color:var(--soft); margin-bottom:8px; }
.ud-modal-field select, .ud-modal-field input, .ud-modal-field textarea { width:100%; border:1px solid rgba(12,36,64,.1); background:var(--off-white); border-radius:2px; font-family:var(--f-body); font-size:15px; color:var(--navy); padding:12px 16px; outline:none; }
.ud-modal-field select:focus, .ud-modal-field input:focus, .ud-modal-field textarea:focus { border-color:var(--brand); background:var(--white); box-shadow:0 0 0 3px rgba(12,77,162,.06); }
.ud-modal-field textarea { resize:vertical; min-height:100px; }
.ud-modal-footer { padding:0 28px 28px; }
.ud-modal-submit { width:100%; padding:14px; font-family:var(--f-body); font-size:12px; font-weight:700; letter-spacing:.16em; text-transform:uppercase; background:var(--brand); color:var(--white); border:none; cursor:pointer; border-radius:2px; transition:all .25s; }
.ud-modal-submit:hover { background:#0a56b5; }

@media(max-width:1024px){ .ud-hero { padding:36px 28px; } .ud-wrap { padding:28px; gap:28px; grid-template-columns:240px 1fr; } }
@media(max-width:768px){ .ud-wrap { grid-template-columns:1fr; } .ud-sidebar { position:relative; top:0; } .ud-hero { padding:28px 16px; } .ud-wrap { padding:20px 16px 48px; } }
@endsection

@section('main')

<div class="ud-hero">
    <div class="ud-hero-inner">
        <div class="ud-hero-greeting">Reservation History</div>
        <h1 class="ud-hero-title">My Bookings</h1>
    </div>
</div>

<div class="ud-wrap">
    @include('frontend.dashboard.user_menu')

    <div class="ud-content">
        <div class="ud-section-label">All Bookings</div>

        <div class="ud-table-wrap">
            @if($allData->count() > 0)
            <table class="ud-table">
                <thead>
                    <tr>
                        <th>Booking No</th>
                        <th>Room / Hall</th>
                        <th>Dates</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allData as $item)
                    @php
                        $statusMap = [0=>'pending',1=>'confirmed',2=>'checked-in',3=>'checked-out',4=>'cancelled',5=>'cancelled'];
                        $statusText = [0=>'Pending',1=>'Confirmed',2=>'Checked In',3=>'Checked Out',4=>'Cancelled',5=>'Denied'];
                        $payMap = [0=>'unpaid',1=>'paid',2=>'unpaid',3=>'partial'];
                        $payText = [0=>'Unpaid',1=>'Paid',2=>'Refunded',3=>'Partial'];
                        $existingReview = \App\Models\Review::where('booking_id', $item->id)->where('user_id', Auth::id())->first();
                    @endphp
                    <tr>
                        <td><a href="{{ route('user.invoice', $item->id) }}" class="code-link">{{ $item->code }}</a></td>
                        <td style="font-weight:500;color:var(--navy)">{{ $item->room->type->name ?? 'N/A' }}</td>
                        <td>
                            <span class="ud-date-badge ud-date-in">{{ \Carbon\Carbon::parse($item->check_in)->format('M d') }}</span>
                            <span style="color:var(--soft);margin:0 4px">→</span>
                            <span class="ud-date-badge ud-date-out">{{ \Carbon\Carbon::parse($item->check_out)->format('M d, Y') }}</span>
                        </td>
                        <td>
                            <div class="ud-amount">{{ number_format($item->total_price) }} <small>$</small></div>
                        </td>
                        <td><span class="ud-pay-badge {{ $payMap[$item->payment_status] ?? 'unpaid' }}">{{ $payText[$item->payment_status] ?? 'Unpaid' }}</span></td>
                        <td><span class="ud-badge {{ $statusMap[$item->status] ?? 'pending' }}">{{ $statusText[$item->status] ?? 'Pending' }}</span></td>
                        <td>
                            <div class="ud-actions-cell">
                                <a href="{{ route('user.invoice', $item->id) }}" class="ud-action-btn invoice">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                    Invoice
                                </a>
                                @if(in_array($item->status, [0, 1]))
                                <button type="button" class="ud-action-btn cancel" onclick="openCancelModal({{ $item->id }}, '{{ $item->code }}')">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                                    Cancel
                                </button>
                                @endif
                                @if($item->status == 3 && !$existingReview)
                                <button type="button" class="ud-review-btn" onclick="openReviewModal({{ $item->id }}, {{ $item->rooms_id }})">Review</button>
                                @elseif($existingReview)
                                <span class="ud-reviewed"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><path d="M22 4L12 14.01l-3-3"/></svg> Reviewed</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="ud-empty-table">No bookings found. Start by browsing our rooms &amp; halls.</div>
            @endif
        </div>
    </div>
</div>

{{-- Review Modal --}}
<div class="ud-modal-overlay" id="reviewModalOverlay">
    <div class="ud-modal">
        <form action="{{ route('store.review') }}" method="POST" id="reviewForm">
            @csrf
            <input type="hidden" name="booking_id" id="review_booking_id">
            <input type="hidden" name="room_id" id="review_room_id">
            <div class="ud-modal-header">
                <div class="ud-modal-title">Leave a Review</div>
                <button type="button" class="ud-modal-close" onclick="closeReviewModal()">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="ud-modal-body">
                <div class="ud-modal-field">
                    <label>Rating</label>
                    <select name="rating" required>
                        <option value="">Select rating...</option>
                        <option value="5">★★★★★ Excellent</option>
                        <option value="4">★★★★☆ Very Good</option>
                        <option value="3">★★★☆☆ Good</option>
                        <option value="2">★★☆☆☆ Fair</option>
                        <option value="1">★☆☆☆☆ Poor</option>
                    </select>
                </div>
                <div class="ud-modal-field">
                    <label>Title <span style="font-weight:400;letter-spacing:0;text-transform:none">(optional)</span></label>
                    <input type="text" name="title" maxlength="255" placeholder="Summarize your experience">
                </div>
                <div class="ud-modal-field">
                    <label>Your Review</label>
                    <textarea name="comment" required maxlength="1000" placeholder="Tell us about your stay..."></textarea>
                </div>
            </div>
            <div class="ud-modal-footer">
                <button type="submit" class="ud-modal-submit">Submit Review</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
function openReviewModal(bookingId, roomId){
    document.getElementById('review_booking_id').value = bookingId;
    document.getElementById('review_room_id').value = roomId;
    document.getElementById('reviewModalOverlay').classList.add('show');
    document.body.style.overflow = 'hidden';
}
function closeReviewModal(){
    document.getElementById('reviewModalOverlay').classList.remove('show');
    document.body.style.overflow = '';
}
document.getElementById('reviewModalOverlay').addEventListener('click', function(e){
    if(e.target === this) closeReviewModal();
});
</script>
@endsection