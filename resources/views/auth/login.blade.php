<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,400&family=Source+Sans+3:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/img/favicon.png') }}">
    <style>
        :root{--brand:#0c4da2;--brand-dark:#034ea2;--navy:#0c2340;--white:#fff;--off-white:#f6f7fa;--ink:#181c2a;--mid:#4a5568;--gold:#d4a853;--f-head:'Cormorant Garamond',Georgia,serif;--f-body:'Source Sans 3',-apple-system,sans-serif;}
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
        html,body{height:100%;font-family:var(--f-body);color:var(--ink);-webkit-font-smoothing:antialiased;}

        .auth-wrapper{display:flex;min-height:100vh;}

        /* Left panel — hero image */
        .auth-hero{flex:1;position:relative;background:var(--navy);display:flex;flex-direction:column;overflow:hidden;}
        .auth-hero img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;}
        .auth-hero-overlay{position:absolute;inset:0;background:linear-gradient(135deg,rgba(3,78,162,.85) 0%,rgba(7,22,38,.7) 50%,rgba(7,22,38,.8) 100%);}
        .auth-hero-top{position:relative;z-index:2;padding:36px 48px;}
        .auth-hero-logo{height:38px;filter:brightness(10);}
        .auth-hero-content{position:relative;z-index:2;padding:0 48px 48px;margin-top:auto;margin-bottom:auto;max-width:520px;}
        .auth-hero-title{font-family:var(--f-head);font-size:38px;font-weight:400;color:var(--white);line-height:1.2;margin-bottom:14px;}
        .auth-hero-sub{font-family:var(--f-body);font-size:15px;color:rgba(255,255,255,.7);line-height:1.8;}
        .auth-hero-stars{color:var(--gold);font-size:16px;letter-spacing:5px;margin-bottom:14px;display:block;}

        /* Right panel — form */
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

        .auth-divider{display:flex;align-items:center;gap:12px;margin:24px 0;color:#c4cad3;font-size:12px;text-transform:uppercase;letter-spacing:.1em;}
        .auth-divider::before,.auth-divider::after{content:'';flex:1;height:1px;background:#e2e6ec;}

        .auth-footer-text{text-align:center;font-size:14px;color:var(--mid);margin-top:24px;}
        .auth-footer-text a{color:var(--brand);font-weight:600;text-decoration:none;transition:color .2s;}
        .auth-footer-text a:hover{text-decoration:underline;}

        .auth-error{background:#fef2f2;border:1px solid #fecaca;color:#b91c1c;font-size:13px;padding:10px 14px;border-radius:4px;margin-bottom:16px;}

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

        <p class="auth-footer-text">Don't have an account? <a href="{{ route('register') }}">Create one</a></p>
    </div>
</div>
</body>
</html>
