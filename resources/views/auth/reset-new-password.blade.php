<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,400&family=Source+Sans+3:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/img/favicon.png') }}">
    <style>
        :root{--brand:#0c4da2;--brand-dark:#034ea2;--navy:#0c2340;--white:#fff;--off-white:#f6f7fa;--ink:#181c2a;--mid:#4a5568;--gold:#d4a853;--f-head:'Cormorant Garamond',Georgia,serif;--f-body:'Source Sans 3',-apple-system,sans-serif;}
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        html,body{height:100%;font-family:var(--f-body);color:var(--ink);-webkit-font-smoothing:antialiased;}
        .auth-wrapper{display:flex;min-height:100vh;}
        .auth-hero{flex:1;position:relative;background:var(--navy);display:flex;flex-direction:column;overflow:hidden;}
        .auth-hero img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
        .auth-hero-overlay{position:absolute;inset:0;background:linear-gradient(135deg,rgba(3,78,162,.85) 0%,rgba(7,22,38,.7) 50%,rgba(7,22,38,.8) 100%);}
        .auth-hero-top{position:relative;z-index:2;padding:36px 48px;}
        .auth-hero-logo{height:38px;filter:brightness(10);transition:opacity .2s;}
        .auth-hero-logo:hover{opacity:.85;}
        .auth-hero-nav{position:relative;z-index:2;padding:0 48px;display:flex;gap:24px;flex-wrap:wrap;}
        .auth-hero-nav a{font-family:var(--f-body);font-size:13px;font-weight:500;color:rgba(255,255,255,.7);text-decoration:none;transition:color .2s;letter-spacing:.02em;}
        .auth-hero-nav a:hover{color:var(--white);}
        .auth-hero-nav a::after{content:'';display:block;width:0;height:1.5px;background:var(--gold);transition:width .3s;margin-top:2px;}
        .auth-hero-nav a:hover::after{width:100%;}
        .auth-hero-content{position:relative;z-index:2;padding:0 48px 48px;margin-top:auto;margin-bottom:auto;max-width:520px;}
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
        .auth-btn{width:100%;font-family:var(--f-body);font-size:13px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;padding:14px;border:none;border-radius:4px;cursor:pointer;transition:all .25s;display:flex;align-items:center;justify-content:center;gap:8px;}
        .auth-btn-primary{background-image:linear-gradient(179deg,#0a70e3 .46%,#034ea2 87.03%);color:var(--white);}
        .auth-btn-primary:hover{box-shadow:0 6px 20px rgba(3,78,162,.3);transform:translateY(-1px);}
        .auth-error{background:#fef2f2;border:1px solid #fecaca;color:#b91c1c;font-size:13px;padding:10px 14px;border-radius:4px;margin-bottom:16px;}
        .auth-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;font-size:13px;padding:10px 14px;border-radius:4px;margin-bottom:16px;}
        .otp-icon{width:64px;height:64px;border-radius:50%;background:rgba(12,77,162,.06);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;}
        .otp-icon svg{width:28px;height:28px;stroke:var(--brand);}
        .pw-toggle{position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--mid);padding:2px;display:flex;}
        .pw-toggle:hover{color:var(--brand);}
        .pw-toggle svg{width:18px;height:18px;}
        .auth-field-pw{position:relative;}
        .pw-strength{height:3px;border-radius:2px;margin-top:6px;background:#e2e8f0;overflow:hidden;}
        .pw-strength-bar{height:100%;border-radius:2px;transition:width .3s,background .3s;width:0;}
        @media(max-width:960px){
            .auth-hero{display:none;}
            .auth-form-panel{width:100%;max-width:480px;margin:0 auto;padding:32px 24px;}
        }
    </style>
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-hero">
        <img src="{{ asset('frontend/assets/img/home-one.jpg') }}" alt="{{ config('app.name') }}">
        <div class="auth-hero-overlay"></div>
        <div class="auth-hero-top">
            <a href="{{ route('home') }}">
                <img class="auth-hero-logo" src="{{ asset('frontend/assets/img/logos/logo.jpeg') }}" alt="{{ config('app.name') }}">
            </a>
        </div>
        <div class="auth-hero-nav">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('froom.all') }}">Rooms</a>
            <a href="{{ route('show.gallery') }}">Gallery</a>
            <a href="{{ route('blog.list') }}">Blog</a>
            <a href="{{ route('contact.us') }}">Contact</a>
        </div>
        <div class="auth-hero-content">
            <span class="auth-hero-stars">★★★</span>
            <h2 class="auth-hero-title">Create New Password</h2>
            <p class="auth-hero-sub">Choose a strong, unique password to keep your account safe and secure.</p>
        </div>
    </div>

    <div class="auth-form-panel">
        <a href="{{ route('login') }}" class="auth-back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Back to Login
        </a>

        <div class="otp-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5"><path d="M15 7a2 2 0 0 1 2 2m4 0a6 6 0 0 1-7.743 5.743L11 17H9v2H7v2H4a1 1 0 0 1-1-1v-2.586a1 1 0 0 1 .293-.707l5.964-5.964A6 6 0 1 1 21 9z"/></svg>
        </div>

        <h1 class="auth-form-title" style="text-align:center;">Set New Password</h1>
        <p class="auth-form-sub" style="text-align:center;">Your identity has been verified. Enter your new password below.</p>

        @if ($errors->any())
            <div class="auth-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.otp.store') }}">
            @csrf
            <div class="auth-field auth-field-pw">
                <label class="auth-label" for="password">New Password</label>
                <input id="password" class="auth-input" type="password" name="password" placeholder="Min 8 characters" required autofocus>
                <button type="button" class="pw-toggle" onclick="togglePw('password', this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
                <div class="pw-strength"><div class="pw-strength-bar" id="pwBar"></div></div>
            </div>

            <div class="auth-field auth-field-pw">
                <label class="auth-label" for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" placeholder="Repeat your password" required>
                <button type="button" class="pw-toggle" onclick="togglePw('password_confirmation', this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>

            <button type="submit" class="auth-btn auth-btn-primary">
                Reset Password
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
        </form>
    </div>
</div>

<script>
function togglePw(id, btn){
    var inp = document.getElementById(id);
    var show = inp.type === 'password';
    inp.type = show ? 'text' : 'password';
    btn.innerHTML = show
        ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>'
        : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></svg>';
}

(function(){
    var pw = document.getElementById('password');
    var bar = document.getElementById('pwBar');
    pw.addEventListener('input', function(){
        var v = pw.value, score = 0;
        if(v.length >= 8) score++;
        if(/[A-Z]/.test(v)) score++;
        if(/[0-9]/.test(v)) score++;
        if(/[^A-Za-z0-9]/.test(v)) score++;
        var colors = ['#e53e3e','#ed8936','#ecc94b','#48bb78'];
        var widths = ['25%','50%','75%','100%'];
        bar.style.width = v.length > 0 ? widths[score-1] || '10%' : '0';
        bar.style.background = v.length > 0 ? (colors[score-1] || '#e53e3e') : '#e2e8f0';
    });
})();
</script>
</body>
</html>