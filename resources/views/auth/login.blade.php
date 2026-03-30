@extends('frontend.main_master')

@section('title', 'Sign In — ' . config('app.name'))

@section('styles')
    /* ── Nav solid on auth pages ── */
    nav#mainNav{background-image:linear-gradient(180deg,#0860c5 0%,#034ea2 100%)!important;box-shadow:0 4px 22px rgba(3,40,100,.3)!important;}
    /* ── Auth Layout ── */
    .auth-wrapper{display:flex;min-height:calc(100vh - 96px);margin-top:96px;}
    .auth-hero{flex:1;position:relative;background:var(--navy);display:flex;flex-direction:column;overflow:hidden;}
    .auth-hero img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
    .auth-hero-overlay{position:absolute;inset:0;background:linear-gradient(135deg,rgba(3,78,162,.85) 0%,rgba(7,22,38,.7) 50%,rgba(7,22,38,.8) 100%);}
    .auth-hero-content{position:relative;z-index:2;padding:48px;margin:auto 0;max-width:520px;}
    .auth-hero-title{font-family:var(--f-head);font-size:38px;font-weight:400;color:var(--white);line-height:1.2;margin-bottom:14px;}
    .auth-hero-sub{font-family:var(--f-body);font-size:15px;color:rgba(255,255,255,.7);line-height:1.8;}
    .auth-hero-stars{color:var(--gold);font-size:16px;letter-spacing:5px;margin-bottom:14px;display:block;}
    .auth-form-panel{width:520px;flex-shrink:0;display:flex;flex-direction:column;justify-content:center;padding:48px 56px;background:var(--white);overflow-y:auto;}
    .auth-back{font-family:var(--f-body);font-size:13px;color:var(--mid);text-decoration:none;display:inline-flex;align-items:center;gap:6px;margin-bottom:36px;transition:color .2s;}
    .auth-back:hover{color:var(--brand);}
    .auth-back svg{width:16px;height:16px;}
    .auth-form-title{font-family:var(--f-head);font-size:32px;font-weight:400;color:var(--navy);margin-bottom:6px;}
    .auth-form-sub{font-family:var(--f-body);font-size:14px;color:var(--mid);margin-bottom:32px;line-height:1.6;}
    .auth-field{margin-bottom:20px;}
    .auth-label{display:block;font-family:var(--f-body);font-size:11px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;color:var(--mid);margin-bottom:6px;}
    .auth-input{width:100%;font-family:var(--f-body);font-size:15px;padding:12px 16px;border:1.5px solid #dde2ea;border-radius:4px;background:var(--off-white);color:var(--ink);transition:border-color .2s,box-shadow .2s;outline:none;}
    .auth-input:focus{border-color:var(--brand);box-shadow:0 0 0 3px rgba(12,77,162,.1);background:var(--white);}
    .auth-input::placeholder{color:#a0aec0;}
    .auth-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;}
    .auth-check{display:flex;align-items:center;gap:8px;font-size:13.5px;color:var(--mid);cursor:pointer;}
    .auth-check input{width:16px;height:16px;accent-color:var(--brand);cursor:pointer;}
    .auth-forgot{font-size:13px;color:var(--brand);text-decoration:none;font-weight:500;transition:color .2s;}
    .auth-forgot:hover{color:var(--brand-dark);text-decoration:underline;}
    .auth-btn{width:100%;font-family:var(--f-body);font-size:13px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;padding:14px;border:none;border-radius:4px;cursor:pointer;transition:all .25s;display:flex;align-items:center;justify-content:center;gap:8px;}
    .auth-btn-primary{background-image:linear-gradient(179deg,#0a70e3 .46%,#034ea2 87.03%);color:var(--white);}
    .auth-btn-primary:hover{box-shadow:0 6px 20px rgba(3,78,162,.3);transform:translateY(-1px);}
    .auth-footer-text{text-align:center;font-size:14px;color:var(--mid);margin-top:24px;}
    .auth-footer-text a{color:var(--brand);font-weight:600;text-decoration:none;transition:color .2s;}
    .auth-footer-text a:hover{text-decoration:underline;}
    .auth-error{background:#fef2f2;border:1px solid #fecaca;color:#b91c1c;font-size:13px;padding:10px 14px;border-radius:4px;margin-bottom:16px;}
    @media(max-width:960px){
        .auth-wrapper{flex-direction:column;min-height:auto;margin-top:96px;}
        .auth-hero{min-height:220px;max-height:260px;}
        .auth-hero-content{padding:24px;}
        .auth-hero-title{font-size:24px;margin-bottom:8px;}
        .auth-hero-sub{font-size:13px;line-height:1.6;}
        .auth-hero-stars{font-size:13px;letter-spacing:3px;margin-bottom:8px;}
        .auth-form-panel{width:100%;padding:32px 24px;}
    }
    @media(max-width:768px){
        .auth-wrapper{margin-top:92px;min-height:calc(100vh - 92px);}
    }
    @media(max-width:480px){
        .auth-wrapper{margin-top:82px;min-height:calc(100vh - 82px);}
        .auth-hero{min-height:180px;max-height:200px;}
        .auth-hero-content{padding:16px;}
        .auth-hero-title{font-size:20px;}
        .auth-hero-sub{font-size:12px;}
        .auth-form-panel{padding:24px 16px;}
        .auth-form-title{font-size:26px;}
    }
@endsection

@section('main')
<div class="auth-wrapper">
    <div class="auth-hero">
        <img src="{{ asset('frontend/assets/img/home-one.jpg') }}" alt="{{ config('app.name') }}">
        <div class="auth-hero-overlay"></div>
        <div class="auth-hero-content">
            <span class="auth-hero-stars">★★★</span>
            <h2 class="auth-hero-title">Welcome Back to {{ config('app.name') }}</h2>
            <p class="auth-hero-sub">Your sanctuary of Catholic hospitality and world-class luxury in the heart of Rwanda.</p>
        </div>
    </div>

    <div class="auth-form-panel">
        <a href="{{ route('home') }}" class="auth-back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to Home
        </a>

        <h1 class="auth-form-title">Sign In</h1>
        <p class="auth-form-sub">Welcome back. Enter your credentials to access your account.</p>

        @if ($errors->any())
            <div class="auth-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            @if(request('redirect'))
            <input type="hidden" name="redirect" value="{{ request('redirect') }}">
            @endif
            <div class="auth-field">
                <label class="auth-label" for="login">Email / Name / Phone</label>
                <input class="auth-input" type="text" name="login" id="login" placeholder="Enter your email, name or phone" required autofocus>
            </div>

            <div class="auth-field">
                <label class="auth-label" for="password">Password</label>
                <input class="auth-input" type="password" name="password" id="password" placeholder="Enter your password" required>
            </div>

            <div class="auth-row">
                <label class="auth-check">
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a href="{{ route('password.request') }}" class="auth-forgot">Forgot password?</a>
            </div>

            <button type="submit" class="auth-btn auth-btn-primary">Sign In</button>
        </form>

        <p class="auth-footer-text">Don't have an account? <a href="{{ route('register') }}{{ request('redirect') ? '?redirect='.urlencode(request('redirect')) : '' }}">Create one</a></p>
    </div>
</div>
@endsection
