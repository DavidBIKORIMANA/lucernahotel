<aside class="sidebar" id="sidebar">
  <div class="sidebar-brand">
    <div class="brand-icon">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 22V9l9-7 9 7v13"/><path d="M9 22V12h6v10"/><rect x="11" y="4" width="2" height="2" fill="currentColor" stroke="none"/></svg>
    </div>
    <div>
      <div class="brand-name">{{ config('app.name') }}</div>
      <div class="brand-sub">Admin Panel</div>
    </div>
  </div>

  <nav class="nav-section">
    <div class="nav-label" style="margin-top:8px;">Overview</div>

    <a class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      <span class="nav-text">Dashboard</span>
    </a>

    <div class="nav-label">Rooms & Stays</div>

    <div class="nav-group {{ request()->routeIs('room.type.*') || request()->routeIs('add.room.type') || request()->routeIs('edit.room') || request()->routeIs('view.room.list') || request()->routeIs('add.room.list') || request()->routeIs('delete.room') || request()->routeIs('all.seasons') || request()->routeIs('add.season') || request()->routeIs('edit.season') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-group-toggle">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M2 22V12l10-8 10 8v10H2z"/><path d="M9 22v-6h6v6"/></svg>
        <span class="nav-text">Room Management</span>
        <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="nav-group-children">
        <a class="nav-item {{ request()->routeIs('room.type.list') || request()->routeIs('add.room.type') ? 'active' : '' }}" href="{{ route('room.type.list') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">Room Types</span>
        </a>
        <a class="nav-item {{ request()->routeIs('view.room.list') ? 'active' : '' }}" href="{{ route('view.room.list') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">Room List</span>
        </a>
        <a class="nav-item {{ request()->routeIs('add.room.list') ? 'active' : '' }}" href="{{ route('add.room.list') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">Add Reservation</span>
        </a>
        <a class="nav-item {{ request()->routeIs('all.seasons') || request()->routeIs('add.season') || request()->routeIs('edit.season') ? 'active' : '' }}" href="{{ route('all.seasons') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">Rate Seasons</span>
        </a>
      </div>
    </div>

    @php $pendingBookings = \App\Models\Booking::where('status','0')->count(); @endphp
    <div class="nav-group {{ request()->routeIs('booking.*') || request()->routeIs('edit_booking') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-group-toggle">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M2 9h20M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z"/><path d="M8 5v14"/></svg>
        <span class="nav-text">Bookings</span>
        @if($pendingBookings > 0)
        <span class="nav-badge red">{{ $pendingBookings }}</span>
        @endif
        <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="nav-group-children">
        <a class="nav-item {{ request()->routeIs('booking.list') ? 'active' : '' }}" href="{{ route('booking.list') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">Booking List</span>
        </a>
      </div>
    </div>

    @php $pendingReviewCount = \App\Models\Review::where('is_approved', false)->count(); @endphp
    <a class="nav-item {{ request()->routeIs('all.review') ? 'active' : '' }}" href="{{ route('all.review') }}">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
      <span class="nav-text">Reviews</span>
      @if($pendingReviewCount > 0)
      <span class="nav-badge">{{ $pendingReviewCount }}</span>
      @endif
    </a>

    <div class="nav-label">Content</div>

    <div class="nav-group {{ request()->routeIs('blog.category') || request()->routeIs('all.blog.post') || request()->routeIs('add.blog.post') || request()->routeIs('edit.blog.post') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-group-toggle">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
        <span class="nav-text">Blog</span>
        <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="nav-group-children">
        <a class="nav-item {{ request()->routeIs('blog.category') ? 'active' : '' }}" href="{{ route('blog.category') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">Blog Categories</span>
        </a>
        <a class="nav-item {{ request()->routeIs('all.blog.post') || request()->routeIs('add.blog.post') || request()->routeIs('edit.blog.post') ? 'active' : '' }}" href="{{ route('all.blog.post') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">All Posts</span>
        </a>
        <a class="nav-item {{ request()->routeIs('add.blog.post') ? 'active' : '' }}" href="{{ route('add.blog.post') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">Add Post</span>
        </a>
      </div>
    </div>

    <div class="nav-label">Operations</div>

    @if(Auth::user()->can('team.menu'))
    <div class="nav-group {{ request()->routeIs('all.team') || request()->routeIs('add.team') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-group-toggle">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        <span class="nav-text">Manage Teams</span>
        <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="nav-group-children">
        @if(Auth::user()->can('team.all'))
        <a class="nav-item {{ request()->routeIs('all.team') ? 'active' : '' }}" href="{{ route('all.team') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">All Team</span>
        </a>
        @endif
        @if(Auth::user()->can('team.add'))
        <a class="nav-item {{ request()->routeIs('add.team') ? 'active' : '' }}" href="{{ route('add.team') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">Add Team</span>
        </a>
        @endif
      </div>
    </div>
    @endif

    @if(Auth::user()->can('bookarea.menu'))
    <a class="nav-item {{ request()->routeIs('book.area') ? 'active' : '' }}" href="{{ route('book.area') }}">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      <span class="nav-text">Book Area</span>
    </a>
    @endif

    <a class="nav-item {{ request()->routeIs('booking.report') ? 'active' : '' }}" href="{{ route('booking.report') }}">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
      <span class="nav-text">Booking Report</span>
    </a>

    @php try { $unreadContacts = \App\Models\Contact::where('read_status', 0)->count(); } catch(\Exception $e) { $unreadContacts = 0; } @endphp
    <a class="nav-item {{ request()->routeIs('contact.message') ? 'active' : '' }}" href="{{ route('contact.message') }}">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
      <span class="nav-text">Contact Messages</span>
      @if($unreadContacts > 0)
      <span class="nav-badge red">{{ $unreadContacts }}</span>
      @endif
    </a>

    <a class="nav-item {{ request()->routeIs('all.gallery') ? 'active' : '' }}" href="{{ route('all.gallery') }}">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"/><polyline points="17 2 12 7 7 2"/></svg>
      <span class="nav-text">Hotel Gallery</span>
    </a>

    <div class="nav-group {{ request()->routeIs('all.testimonial') || request()->routeIs('add.testimonial') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-group-toggle">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <span class="nav-text">Testimonials</span>
        <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="nav-group-children">
        <a class="nav-item {{ request()->routeIs('all.testimonial') ? 'active' : '' }}" href="{{ route('all.testimonial') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">All Testimonials</span>
        </a>
        <a class="nav-item {{ request()->routeIs('add.testimonial') ? 'active' : '' }}" href="{{ route('add.testimonial') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">Add Testimonial</span>
        </a>
      </div>
    </div>

    <a class="nav-item {{ request()->routeIs('all.comment') ? 'active' : '' }}" href="{{ route('all.comment') }}">
      <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
      <span class="nav-text">Comments</span>
    </a>

    <div class="nav-label">System</div>

    <div class="nav-group {{ request()->routeIs('all.permission') || request()->routeIs('all.roles') || request()->routeIs('add.roles.permission') || request()->routeIs('all.roles.permission') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-group-toggle">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <span class="nav-text">Role & Permissions</span>
        <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="nav-group-children">
        <a class="nav-item {{ request()->routeIs('all.permission') ? 'active' : '' }}" href="{{ route('all.permission') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">All Permission</span>
        </a>
        <a class="nav-item {{ request()->routeIs('all.roles') ? 'active' : '' }}" href="{{ route('all.roles') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">All Roles</span>
        </a>
        <a class="nav-item {{ request()->routeIs('add.roles.permission') ? 'active' : '' }}" href="{{ route('add.roles.permission') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">Role In Permission</span>
        </a>
        <a class="nav-item {{ request()->routeIs('all.roles.permission') ? 'active' : '' }}" href="{{ route('all.roles.permission') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">All Role In Permission</span>
        </a>
      </div>
    </div>

    <div class="nav-group {{ request()->routeIs('all.admin') || request()->routeIs('add.admin') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-group-toggle">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        <span class="nav-text">Admin Users</span>
        <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="nav-group-children">
        <a class="nav-item {{ request()->routeIs('all.admin') ? 'active' : '' }}" href="{{ route('all.admin') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">All Admin</span>
        </a>
        <a class="nav-item {{ request()->routeIs('add.admin') ? 'active' : '' }}" href="{{ route('add.admin') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">Add Admin</span>
        </a>
      </div>
    </div>

    <div class="nav-group {{ request()->routeIs('smtp.setting') || request()->routeIs('site.setting') ? 'open' : '' }}" onclick="toggleGroup(this)">
      <div class="nav-group-toggle">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
        <span class="nav-text">Settings</span>
        <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="nav-group-children">
        <a class="nav-item {{ request()->routeIs('smtp.setting') ? 'active' : '' }}" href="{{ route('smtp.setting') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">SMTP Setting</span>
        </a>
        <a class="nav-item {{ request()->routeIs('site.setting') ? 'active' : '' }}" href="{{ route('site.setting') }}" style="padding-left:8px;font-size:13px;" onclick="event.stopPropagation();">
          <svg class="nav-icon" style="width:14px;height:14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/></svg>
          <span class="nav-text">Site Setting</span>
        </a>
      </div>
    </div>
  </nav>

  @php
    $sidebarUser = Auth::user();
    $initials = collect(explode(' ', $sidebarUser->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('');
  @endphp
  <div class="sidebar-footer">
    <a class="user-card" href="{{ route('admin.profile') }}">
      <div class="user-avatar">
        @if(!empty($sidebarUser->photo))
          <img src="{{ url('upload/admin_images/'.$sidebarUser->photo) }}" alt="{{ $sidebarUser->name }}">
        @else
          {{ $initials }}
        @endif
      </div>
      <div>
        <div class="user-name">{{ $sidebarUser->name }}</div>
        <div class="user-role">{{ $sidebarUser->getRoleNames()->first() ?? 'Admin' }}</div>
      </div>
      <svg class="user-more" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="5" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="12" cy="19" r="1"/></svg>
    </a>
  </div>
</aside>
