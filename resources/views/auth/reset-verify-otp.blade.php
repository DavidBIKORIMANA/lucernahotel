<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code — {{ config('app.name') }}</title>
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
        .auth-footer-text{text-align:center;font-size:14px;color:var(--mid);margin-top:24px;}
        .auth-footer-text a{color:var(--brand);font-weight:600;text-decoration:none;transition:color .2s;}
        .auth-footer-text a:hover{text-decoration:underline;}
        .otp-inputs{display:flex;gap:10px;justify-content:center;margin-bottom:24px;}
        .otp-box{width:52px;height:60px;text-align:center;font-family:'Courier New',monospace;font-size:26px;font-weight:700;color:var(--brand);border:2px solid #dde2ea;border-radius:8px;background:var(--off-white);outline:none;transition:all .2s;}
        .otp-box:focus{border-color:var(--brand);box-shadow:0 0 0 3px rgba(12,77,162,.12);background:var(--white);}
        .otp-icon{width:64px;height:64px;border-radius:50%;background:rgba(12,77,162,.06);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;}
        .otp-icon svg{width:28px;height:28px;stroke:var(--brand);}
        .auth-resend{display:inline-flex;align-items:center;gap:4px;font-family:var(--f-body);font-size:13px;font-weight:500;color:var(--brand);text-decoration:none;transition:color .2s;background:none;border:none;cursor:pointer;padding:0;}
        .auth-resend:hover{color:var(--brand-dark);text-decoration:underline;}
        .auth-resend:disabled{color:var(--mid);cursor:not-allowed;text-decoration:none;}
        .auth-email-highlight{font-weight:600;color:var(--navy);}
        @media(max-width:960px){
            .auth-wrapper{flex-direction:column;}
            .auth-hero{min-height:220px;max-height:260px;}
            .auth-hero-top{padding:20px 24px;}
            .auth-hero-logo{height:30px;}
            .auth-hero-nav{padding:0 24px;gap:16px;}
            .auth-hero-nav a{font-size:12px;}
            .auth-hero-content{padding:0 24px 24px;}
            .auth-hero-title{font-size:24px;margin-bottom:8px;}
            .auth-hero-sub{font-size:13px;line-height:1.6;}
            .auth-hero-stars{font-size:13px;letter-spacing:3px;margin-bottom:8px;}
            .auth-form-panel{width:100%;padding:32px 24px;}
        }
        @media(max-width:480px){
            .auth-hero{min-height:180px;max-height:200px;}
            .auth-hero-top{padding:16px 16px;}
            .auth-hero-nav{padding:0 16px;}
            .auth-hero-content{padding:0 16px 16px;}
            .auth-hero-title{font-size:20px;}
            .auth-hero-sub{font-size:12px;}
            .auth-form-panel{padding:24px 16px;}
            .auth-form-title{font-size:26px;}
            .otp-inputs{gap:6px;}
            .otp-box{width:42px;height:50px;font-size:22px;}
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
            <h2 class="auth-hero-title">One Step Away</h2>
            <p class="auth-hero-sub">Enter the verification code we sent to your email to continue resetting your password.</p>
        </div>
    </div>

    <div class="auth-form-panel">
        <a href="{{ route('password.request') }}" class="auth-back">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Change Email
        </a>

        <div class="otp-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5"><path d="M12 15v2m-6 4h12a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2zm10-10V7a4 4 0 0 0-8 0v4h8z"/></svg>
        </div>

        <h1 class="auth-form-title" style="text-align:center;">Enter Code</h1>
        <p class="auth-form-sub" style="text-align:center;">
            We've sent a 6-digit code to <span class="auth-email-highlight">{{ session('reset_email', '') }}</span>
        </p>

        @if(session('status'))
            <div class="auth-success">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="auth-error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.otp.check') }}" id="otpForm">
            @csrf
            <input type="hidden" name="otp" id="otpHidden">

            <div class="otp-inputs">
                <input type="text" class="otp-box" maxlength="1" data-index="0" inputmode="numeric" autofocus>
                <input type="text" class="otp-box" maxlength="1" data-index="1" inputmode="numeric">
                <input type="text" class="otp-box" maxlength="1" data-index="2" inputmode="numeric">
                <input type="text" class="otp-box" maxlength="1" data-index="3" inputmode="numeric">
                <input type="text" class="otp-box" maxlength="1" data-index="4" inputmode="numeric">
                <input type="text" class="otp-box" maxlength="1" data-index="5" inputmode="numeric">
            </div>

            <button type="submit" class="auth-btn auth-btn-primary">Verify Code</button>
        </form>

        <div class="auth-footer-text" style="margin-top:20px;">
            Didn't receive the code?
            <form method="POST" action="{{ route('password.otp.resend') }}" style="display:inline;">
                @csrf
                <button type="submit" class="auth-resend" id="resendBtn">Resend Code</button>
            </form>
        </div>
    </div>
</div>

<script>
(function(){
    var boxes = document.querySelectorAll('.otp-box');
    var hidden = document.getElementById('otpHidden');
    var form = document.getElementById('otpForm');

    function updateHidden(){
        var otp = '';
        boxes.forEach(function(b){ otp += b.value; });
        hidden.value = otp;
    }

    boxes.forEach(function(box, i){
        box.addEventListener('input', function(){
            this.value = this.value.replace(/\D/g, '').slice(0,1);
            updateHidden();
            if(this.value && i < 5) boxes[i+1].focus();
            if(hidden.value.length === 6) form.submit();
        });
        box.addEventListener('keydown', function(e){
            if(e.key === 'Backspace' && !this.value && i > 0){
                boxes[i-1].focus();
                boxes[i-1].value = '';
                updateHidden();
            }
        });
        box.addEventListener('paste', function(e){
            e.preventDefault();
            var data = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '').slice(0,6);
            for(var j=0; j<data.length && j<6; j++){
                boxes[j].value = data[j];
            }
            updateHidden();
            if(data.length >= 6){ boxes[5].focus(); form.submit(); }
            else if(data.length > 0) boxes[Math.min(data.length, 5)].focus();
        });
    });

    var btn = document.getElementById('resendBtn');
    var cooldown = 60;
    var timer;
    function startCooldown(){
        btn.disabled = true;
        var remaining = cooldown;
        btn.textContent = 'Resend in ' + remaining + 's';
        timer = setInterval(function(){
            remaining--;
            btn.textContent = 'Resend in ' + remaining + 's';
            if(remaining <= 0){
                clearInterval(timer);
                btn.disabled = false;
                btn.textContent = 'Resend Code';
            }
        }, 1000);
    }
    @if(session('status'))
    startCooldown();
    @endif
})();
</script>
</body>
</html>