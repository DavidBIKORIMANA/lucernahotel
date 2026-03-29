@php
  $headerUser = Auth::user();
  $headerProfileData = App\Models\User::find($headerUser->id);
  $ncount = $headerUser->unreadNotifications()->count();
  $headerInitials = collect(explode(' ', $headerProfileData->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('');
@endphp

<header class="header">
  <!-- Mobile toggle -->
  <div class="mobile-toggle" onclick="document.getElementById('sidebar').classList.toggle('open');document.getElementById('sidebarOverlay').classList.toggle('show');">
    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
  </div>

  <div class="header-title">
    {{ config('app.name') }} <span>Admin</span>
  </div>

  <div class="search-wrap">
    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
    <input class="search-input" type="search" placeholder="Search guests, rooms…"/>
  </div>

  <div class="header-actions">
    <a class="icon-btn" href="#" title="Notifications" id="notificationBtn" data-bs-toggle="dropdown" aria-expanded="false">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
      @if($ncount > 0)<span class="badge-dot"></span>@endif
    </a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationBtn" style="background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);min-width:320px;padding:0;overflow:hidden;">
      <div style="padding:14px 18px;border-bottom:1px solid var(--border2);display:flex;align-items:center;justify-content:space-between;">
        <span style="font-weight:600;color:var(--text-1);font-size:14px;">Notifications</span>
        <span id="notification-count" style="background:var(--gold);color:var(--bg-deep);font-size:10px;font-weight:600;padding:1px 7px;border-radius:20px;">{{ $ncount }}</span>
      </div>
      <div style="max-height:280px;overflow-y:auto;">
        @forelse ($headerUser->notifications as $notification)
        <a class="dropdown-item" href="javascript:;" onclick="markNotificationAsRead('{{ $notification->id }}')" style="padding:12px 18px;display:flex;align-items:flex-start;gap:10px;border-bottom:1px solid rgba(255,255,255,.03);color:var(--text-2);text-decoration:none;">
          <div style="width:32px;height:32px;border-radius:50%;background:rgba(76,175,125,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="14" height="14" fill="none" stroke="var(--success)" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <div style="flex:1;">
            <div style="font-size:13px;color:var(--text-1);font-weight:500;">{{ $notification->data['message'] }}</div>
            <div style="font-size:11px;color:var(--text-3);margin-top:2px;">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</div>
          </div>
        </a>
        @empty
        <div style="padding:20px 18px;text-align:center;color:var(--text-3);font-size:13px;">No notifications</div>
        @endforelse
      </div>
    </div>

    <a class="icon-btn" href="{{ route('booking.report') }}" title="Reports">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
    </a>

    <!-- Profile dropdown -->
    <div class="dropdown">
      <div class="header-avatar" title="{{ $headerProfileData->name }}" data-bs-toggle="dropdown" aria-expanded="false">
        @if(!empty($headerProfileData->photo))
          <img src="{{ url('upload/admin_images/'.$headerProfileData->photo) }}" alt="{{ $headerProfileData->name }}">
        @else
          {{ $headerInitials }}
        @endif
      </div>
      <ul class="dropdown-menu dropdown-menu-end" style="background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius);padding:6px;min-width:180px;">
        <li><a class="dropdown-item" href="{{ route('admin.profile') }}" style="color:var(--text-2);border-radius:var(--radius-sm);padding:8px 12px;font-size:13px;">Profile</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.change.password') }}" style="color:var(--text-2);border-radius:var(--radius-sm);padding:8px 12px;font-size:13px;">Change Password</a></li>
        <li><hr style="border-color:var(--border2);margin:4px 0;"></li>
        <li><a class="dropdown-item" href="{{ route('admin.logout') }}" style="color:var(--danger);border-radius:var(--radius-sm);padding:8px 12px;font-size:13px;">Logout</a></li>
      </ul>
    </div>
  </div>
</header>

<script>
function markNotificationAsRead(notificationId){
  fetch('/mark-notification-as-read/'+ notificationId,{
    method: 'POST',
    headers: {
      'Content-Type' : 'application/json',
      'X-CSRF-TOKEN' : '{{ csrf_token() }}'
    },
    body: JSON.stringify({})
  })
  .then(response => response.json())
  .then(data => {
    document.getElementById('notification-count').textContent = data.count;
    if(data.count == 0) {
      var dot = document.querySelector('.badge-dot');
      if(dot) dot.style.display = 'none';
    }
  })
  .catch(error => { console.log('Error',error); });
}
</script>
</script>