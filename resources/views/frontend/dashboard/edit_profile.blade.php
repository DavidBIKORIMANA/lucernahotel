@extends('frontend.main_master')

@section('styles')
/* inherit ud-* styles from dashboard */
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
.ud-form-card { background:var(--white); border:1px solid rgba(12,36,64,.06); box-shadow:0 4px 24px rgba(12,36,64,.05); padding:32px; }
.ud-fields { display:grid; grid-template-columns:1fr 1fr; gap:18px; margin-bottom:24px; }
.ud-field { }
.ud-field.span-2 { grid-column:1/-1; }
.ud-field label { display:block; font-family:var(--f-body); font-size:11px; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:var(--soft); margin-bottom:8px; }
.ud-field label .req { color:#dc2626; }
.ud-field input, .ud-field select, .ud-field textarea { width:100%; border:1px solid rgba(12,36,64,.1); background:var(--off-white); border-radius:2px; font-family:var(--f-body); font-size:15px; color:var(--navy); padding:12px 16px; outline:none; transition:all .2s; }
.ud-field input:focus, .ud-field select:focus, .ud-field textarea:focus { border-color:var(--brand) !important; background:var(--white); box-shadow:0 0 0 3px rgba(12,77,162,.06) !important; }
.ud-field .field-error { font-family:var(--f-body); font-size:12px; color:#dc2626; margin-top:4px; }
.ud-save-btn { padding:14px 36px; font-family:var(--f-body); font-size:12px; font-weight:700; letter-spacing:.16em; text-transform:uppercase; background:var(--brand); color:var(--white); border:none; cursor:pointer; border-radius:2px; transition:all .25s; }
.ud-save-btn:hover { background:#0a56b5; transform:translateY(-1px); box-shadow:0 4px 16px rgba(12,77,162,.25); }
.ud-photo-preview { width:80px; height:80px; border-radius:50%; object-fit:cover; border:3px solid var(--off-white); }
@media(max-width:1024px){ .ud-hero { padding:36px 28px; } .ud-wrap { padding:28px; gap:28px; grid-template-columns:240px 1fr; } }
@media(max-width:768px){ .ud-wrap { grid-template-columns:1fr; } .ud-sidebar { position:relative; top:0; } .ud-fields { grid-template-columns:1fr; } .ud-hero { padding:28px 16px; } .ud-wrap { padding:20px 16px 48px; } }
@endsection

@section('main')

<div class="ud-hero">
    <div class="ud-hero-inner">
        <div class="ud-hero-greeting">Account Settings</div>
        <h1 class="ud-hero-title">My Profile</h1>
    </div>
</div>

<div class="ud-wrap">
    @include('frontend.dashboard.user_menu')

    <div class="ud-content">
        <div class="ud-section-label">Personal Information</div>
        <div class="ud-form-card">
            <form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="ud-fields">
                    <div class="ud-field">
                        <label>Full Name <span class="req">*</span></label>
                        <input type="text" name="name" value="{{ $profileData->name }}">
                    </div>
                    <div class="ud-field">
                        <label>Email Address <span class="req">*</span></label>
                        <input type="email" name="email" value="{{ $profileData->email }}">
                    </div>
                    <div class="ud-field">
                        <label>Phone Number</label>
                        <input type="text" name="phone" value="{{ $profileData->phone }}">
                    </div>
                    <div class="ud-field">
                        <label>Address</label>
                        <input type="text" name="address" value="{{ $profileData->address }}">
                    </div>
                    <div class="ud-field span-2">
                        <label>Profile Photo</label>
                        <div style="display:flex;align-items:center;gap:20px;margin-bottom:8px">
                            <img id="showImage" class="ud-photo-preview" src="{{ (!empty($profileData->photo)) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="Profile">
                            <input type="file" name="photo" id="image" style="flex:1">
                        </div>
                    </div>
                </div>
                <button type="submit" class="ud-save-btn">Save Changes</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.getElementById('image').addEventListener('change', function(e){
    var reader = new FileReader();
    reader.onload = function(ev){ document.getElementById('showImage').src = ev.target.result; };
    reader.readAsDataURL(e.target.files[0]);
});
</script>
@endsection