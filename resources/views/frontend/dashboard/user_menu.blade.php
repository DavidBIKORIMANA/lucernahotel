@php
$id = Auth::user()->id;
$profileData = App\Models\User::find($id);
$currentRoute = Route::currentRouteName();
@endphp

<aside class="ud-sidebar">
    <div class="ud-avatar-block">
        <img class="ud-avatar" src="{{ (!empty($profileData->photo)) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="{{ $profileData->name }}">
        <div class="ud-avatar-name">{{ $profileData->name }}</div>
        <div class="ud-avatar-email">{{ $profileData->email }}</div>
    </div>
    <nav class="ud-nav">
        <a href="{{ route('dashboard') }}" class="ud-nav-link{{ $currentRoute === 'dashboard' ? ' active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Dashboard
        </a>
        <a href="{{ route('user.profile') }}" class="ud-nav-link{{ $currentRoute === 'user.profile' ? ' active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            My Profile
        </a>
        <a href="{{ route('user.booking') }}" class="ud-nav-link{{ $currentRoute === 'user.booking' ? ' active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
            My Bookings
        </a>
        <a href="{{ route('user.change.password') }}" class="ud-nav-link{{ $currentRoute === 'user.change.password' ? ' active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            Change Password
        </a>
        <div class="ud-nav-divider"></div>
        <a href="{{ route('user.logout') }}" class="ud-nav-link logout">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>
            Sign Out
        </a>
    </nav>
</aside>