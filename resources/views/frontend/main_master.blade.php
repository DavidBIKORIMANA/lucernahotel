<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Lucerna Kabgayi Hôtel'))</title>
    <meta name="description" content="@yield('meta_description', 'A sanctuary rooted in Catholic hospitality in the heart of Rwanda.')">
    <meta name="keywords"    content="@yield('meta_keywords',   'Lucerna Kabgayi Hotel, Rwanda hotel, Muhanga hotel, Catholic hospitality')">
    <meta property="og:type"        content="website">
    <meta property="og:title"       content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('meta_description')">
    <meta property="og:image"       content="@yield('og_image', asset('frontend/assets/img/home-one.jpg'))">
    <meta property="og:url"         content="{{ url()->current() }}">

    <script type="application/ld+json">
    {"@context":"https://schema.org","@type":"Hotel","name":"Lucerna Kabgayi Hôtel","url":"{{ url('/') }}","image":"{{ asset('frontend/assets/img/home-one.jpg') }}","address":{"@type":"PostalAddress","addressLocality":"Muhanga","addressRegion":"Southern Province","addressCountry":"RW"},"starRating":{"@type":"Rating","ratingValue":"3"}}
    </script>

    @php $siteSetting = \App\Models\SiteSetting::first(); @endphp
    @if(!empty($siteSetting->google_analytics_id))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $siteSetting->google_analytics_id }}"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $siteSetting->google_analytics_id }}');</script>
    @endif

    {{-- Preconnect --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    {{-- Critical resource preloads --}}
    <link rel="preload" as="image"  href="{{ asset('frontend/assets/img/home-one.jpg') }}" fetchpriority="high">
    <link rel="preload" as="image"  href="{{ asset('logo.png') }}">
    <link rel="preload" as="style"  href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,400&family=Source+Sans+3:wght@300;400;500;600&display=swap">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,400&family=Source+Sans+3:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Pikaday Calendar V12 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.2/css/pikaday.min.css">

    {{-- Toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/img/favicon.png') }}">

    <style>
        /* ══════════════════════════════════════════
           DESIGN TOKENS
        ══════════════════════════════════════════ */
        :root {
            --brand:       #0c4da2;
            --brand-dark:  #0a3d82;
            --brand-light: #1a6fce;
            --brand-pale:  #cfe0f5;
            --navy:        #0c2340;
            --navy-deep:   #071626;
            --white:       #ffffff;
            --off-white:   #f6f7fa;
            --cream:       #f0ede8;
            --ink:         #181c2a;
            --mid:         #4a5568;
            --soft:        #8898aa;
            --border:      rgba(12,77,162,.1);
            --gold:        #d4a853;
            /* Fonts */
            --f-head: 'Atlantis_Resorts','Cormorant Garamond','Playfair Display',Georgia,serif;
            --f-body: 'Source Sans 3',-apple-system,sans-serif;
            --ease:   cubic-bezier(.4,0,.2,1);
        }

        *,*::before,*::after { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; }
        body {
            font-family: var(--f-body);
            background: var(--white);
            color: var(--ink);
            font-size: 15px;
            font-weight: 400;
            line-height: 1.65;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Preloader ── */
        #page-loader {
            position:fixed; inset:0; z-index:9999;
            background: var(--navy-deep);
            display:flex; align-items:center; justify-content:center;
            flex-direction:column; gap:18px;
            transition: opacity .5s var(--ease), visibility .5s;
        }
        #page-loader.done { opacity:0; visibility:hidden; pointer-events:none; }
        .loader-logo { height:50px; width:auto; filter:brightness(10); opacity:.9; }
        .loader-bar { width:160px; height:2px; background:rgba(255,255,255,.08); border-radius:1px; overflow:hidden; }
        .loader-fill { height:100%; width:0; background:var(--brand); border-radius:1px; animation:lf .85s cubic-bezier(0,0,.2,1) .1s forwards; }
        @keyframes lf { to { width:100%; } }

        /* ── Top Bar ── */
        .top-bar {
            position:fixed; top:0; left:0; right:0; z-index:400;
            background:#0057b7;
            height:48px;
            display:flex; align-items:center; justify-content:space-between;
            padding:0 36px;
            font-family:var(--f-body); font-size:12px; font-weight:400;
            letter-spacing:.03em; color:rgba(255,255,255,.85);
            border-bottom:1px solid rgba(255,255,255,.12);
            transition: transform .3s var(--ease), background .4s var(--ease);
        }
        .top-bar.hidden { transform:translateY(-100%); }
        .top-bar a { color:rgba(255,255,255,.9); text-decoration:none; transition:color .2s; }
        .top-bar a:hover { color:var(--white); }
        .top-bar-left  { display:flex; gap:14px; align-items:center; }
        .tb-icon { width:13px; height:13px; vertical-align:-2px; margin-right:3px; opacity:.8; }
        .top-bar-center { position:absolute; left:50%; transform:translateX(-50%); }
        .tb-logo-link { display:flex; align-items:center; gap:10px; text-decoration:none; }
        .tb-logo-img { height:42px; width:auto; }
        .tb-brand { display:flex; flex-direction:column; line-height:1; }
        .tb-brand-name { font-family:var(--f-head); font-size:20px; font-weight:400; color:var(--white); letter-spacing:.04em; }
        .tb-brand-sub { font-family:var(--f-body); font-size:7.5px; font-weight:600; letter-spacing:.22em; text-transform:uppercase; color:rgba(255,255,255,.45); margin-top:2px; }
        .tb-stars { color:var(--gold); font-size:14px; letter-spacing:3px; }
        .tb-name  { font-family:var(--f-head); font-size:12.5px; color:rgba(255,255,255,.7); letter-spacing:.06em; }
        .top-bar-right { display:flex; gap:12px; align-items:center; }
        .top-bar-right .nav-auth {
            font-family:var(--f-body); font-size:13px; font-weight:500;
            letter-spacing:.08em; text-transform:uppercase;
            color:var(--white); text-decoration:none;
            transition:all .25s; padding:6px 4px;
        }
        .top-bar-right .nav-auth:hover { opacity:.75; }
        .top-bar-right .nav-join {
            font-family:var(--f-body); font-size:12px; font-weight:600; letter-spacing:.1em;
            text-transform:uppercase; color:var(--white);
            background:transparent; padding:7px 18px;
            text-decoration:none; border-radius:3px; border:1.5px solid rgba(255,255,255,.6);
            transition:all .25s;
        }
        .top-bar-right .nav-join:hover { background:rgba(255,255,255,.15); border-color:var(--white); }
        .top-bar-right .nav-cta {
            font-family:var(--f-body); font-size:12px; font-weight:700; letter-spacing:.1em;
            text-transform:uppercase; color:#034ea2;
            background:var(--white); padding:8px 22px;
            text-decoration:none; border-radius:3px; border:1.5px solid var(--white);
            transition:all .25s; margin-left:2px;
        }
        .top-bar-right .nav-cta:hover { background:var(--brand-pale); border-color:var(--brand-pale); transform:translateY(-1px); box-shadow:0 4px 14px rgba(0,0,0,.18); }
        .tb-right-sep { width:1px; height:18px; background:rgba(255,255,255,.2); }
        .tb-sep { width:1px; height:15px; background:rgba(255,255,255,.2); }

        /* ── Nav ── */
        nav#mainNav {
            position:fixed; top:48px; left:0; right:0; z-index:300;
            height:48px; display:flex; align-items:center; justify-content:center;
            padding:0 48px;
            background:transparent;
            border-bottom:1px solid rgba(255,255,255,.08);
            transition:all .4s var(--ease);
        }
        nav#mainNav.scrolled {
            top:0;
            background-image:linear-gradient(180deg,#0860c5 0%,#034ea2 100%);
            height:48px;
            box-shadow:0 4px 22px rgba(3,40,100,.3);
            border-bottom:none;
        }

        .nav-logo { text-decoration:none; display:none; align-items:center; gap:9px; flex-shrink:0; }
        .nav-logo-img { height:40px; width:auto; transition:height .3s; }
        nav#mainNav.scrolled .nav-logo-img { height:34px; }
        .nav-wordmark { display:flex; flex-direction:column; line-height:1; }
        .nav-wm-top { font-family:var(--f-head); font-size:16px; font-weight:400; color:var(--white); transition:color .3s; }
        .nav-wm-sub { font-family:var(--f-body); font-size:7px; font-weight:600; letter-spacing:.2em; text-transform:uppercase; color:rgba(255,255,255,.5); margin-top:2px; transition:color .3s; }
        nav#mainNav.scrolled .nav-wm-top { color:var(--white); }
        nav#mainNav.scrolled .nav-wm-sub { color:rgba(255,255,255,.5); }

        .nav-links { display:flex; list-style:none; gap:32px; align-items:center; }
        .nav-links a {
            font-family:var(--f-body); font-size:1rem; font-weight:400;
            letter-spacing:.12em; text-transform:uppercase; line-height:1.4;
            color:var(--white); text-decoration:none;
            position:relative; padding-bottom:3px; transition:color .25s;
        }
        .nav-links a::after { content:''; position:absolute; bottom:0; left:0; width:0; height:2px; background:var(--white); transition:width .3s var(--ease); }
        .nav-links a:hover { color:var(--white); }
        .nav-links a:hover::after,.nav-links a.active::after { width:100%; }
        nav#mainNav.scrolled .nav-links a { color:var(--white); }
        nav#mainNav.scrolled .nav-links a:hover,
        nav#mainNav.scrolled .nav-links a.active { color:var(--white); }
        nav#mainNav.scrolled .nav-links a::after { background:var(--white); }

        .nav-cta {
            font-family:var(--f-body); font-size:10.5px; font-weight:600; letter-spacing:.14em;
            text-transform:uppercase; color:var(--brand-dark); background:var(--white);
            padding:8px 20px; text-decoration:none; border-radius:3px; transition:all .25s;
        }
        .nav-cta:hover { background:var(--brand-pale); transform:translateY(-1px); box-shadow:0 4px 14px rgba(0,0,0,.15); }

        .nav-right { display:flex; align-items:center; gap:14px; }
        .nav-auth {
            font-family:var(--f-body); font-size:10.5px; font-weight:500;
            letter-spacing:.1em; text-transform:uppercase;
            color:rgba(255,255,255,.8); text-decoration:none;
            transition:color .25s;
        }
        .nav-auth:hover { color:var(--white); }
        nav#mainNav.scrolled .nav-auth { color:rgba(255,255,255,.8); }
        nav#mainNav.scrolled .nav-auth:hover { color:var(--white); }
        .nav-auth-sep { width:1px; height:14px; background:rgba(255,255,255,.25); }
        nav#mainNav.scrolled .nav-auth-sep { background:rgba(255,255,255,.25); }
        .nav-auth-user { display:flex; align-items:center; gap:6px; }
        .nav-auth-user img { width:26px; height:26px; border-radius:50%; object-fit:cover; border:2px solid rgba(255,255,255,.3); }
        nav#mainNav.scrolled .nav-auth-user img { border-color:rgba(255,255,255,.4); }

        /* User dropdown */
        .user-dropdown-wrap { position:relative; }
        .user-dropdown-toggle { cursor:pointer; user-select:none; }
        .user-dropdown-toggle svg.dd-chevron { width:12px; height:12px; margin-left:2px; opacity:.6; transition:transform .2s; }
        .user-dropdown-wrap.open .dd-chevron { transform:rotate(180deg); }
        .user-dropdown {
            position:absolute; top:calc(100% + 10px); right:0; min-width:200px;
            background:var(--white); border-radius:8px; box-shadow:0 12px 40px rgba(0,0,0,.18);
            opacity:0; visibility:hidden; transform:translateY(-6px);
            transition:all .2s var(--ease); z-index:500; overflow:hidden;
        }
        .user-dropdown-wrap.open .user-dropdown { opacity:1; visibility:visible; transform:translateY(0); }
        .user-dropdown::before { content:''; position:absolute; top:-6px; right:16px; width:12px; height:12px; background:var(--white); transform:rotate(45deg); box-shadow:-2px -2px 4px rgba(0,0,0,.04); }
        .ud-header { padding:14px 16px; border-bottom:1px solid #edf0f4; }
        .ud-header-name { font-family:var(--f-body); font-size:14px; font-weight:600; color:var(--ink); }
        .ud-header-email { font-family:var(--f-body); font-size:12px; color:var(--mid); margin-top:1px; }
        .user-dropdown .ud-link {
            display:flex; align-items:center; gap:10px; padding:10px 16px;
            font-family:var(--f-body); font-size:13px; font-weight:500; color:var(--ink);
            text-decoration:none; transition:background .15s;
        }
        .user-dropdown .ud-link:hover { background:#f4f6fa; color:var(--ink); }
        .user-dropdown .ud-link svg { width:16px; height:16px; color:var(--mid); flex-shrink:0; }
        .ud-sep { height:1px; background:#edf0f4; margin:2px 0; }
        .user-dropdown .ud-link.logout { color:#dc2626; }
        .user-dropdown .ud-link.logout:hover { background:#fef2f2; color:#dc2626; }
        .user-dropdown .ud-link.logout svg { color:#dc2626; }
        .nav-join {
            font-family:var(--f-body); font-size:10.5px; font-weight:600; letter-spacing:.1em;
            text-transform:uppercase; color:var(--white);
            background:transparent; padding:6px 16px;
            text-decoration:none; border-radius:3px; border:1.5px solid rgba(255,255,255,.5);
            transition:all .25s;
        }
        .nav-join:hover { background:rgba(255,255,255,.12); border-color:var(--white); transform:translateY(-1px); }
        nav#mainNav.scrolled .nav-join { background:transparent; color:var(--white); border-color:rgba(255,255,255,.5); }
        nav#mainNav.scrolled .nav-join:hover { background:rgba(255,255,255,.12); border-color:var(--white); color:var(--white); }

        .nav-toggle { display:none; flex-direction:column; gap:5px; cursor:pointer; padding:6px; z-index:310; }
        .nav-toggle span { display:block; width:22px; height:2px; background:var(--white); transition:all .3s; }
        nav#mainNav.scrolled .nav-toggle span { background:var(--white); }

        /* ── Buttons ── */
        .btn-blue {
            font-family:var(--f-body); font-size:11.5px; font-weight:600;
            letter-spacing:.14em; text-transform:uppercase;
            padding:12px 32px; background:var(--brand); color:var(--white);
            border:none; cursor:pointer; text-decoration:none;
            display:inline-flex; align-items:center; gap:8px;
            border-radius:2px; transition:all .25s;
        }
        .btn-blue:hover { background:var(--brand-light); transform:translateY(-1px); box-shadow:0 5px 18px rgba(12,77,162,.26); }
        .btn-blue svg { width:14px; height:14px; }
        .btn-outline-w {
            font-family:var(--f-body); font-size:11.5px; font-weight:600; letter-spacing:.14em;
            text-transform:uppercase; padding:11px 28px; border:2px solid rgba(255,255,255,.6);
            color:var(--white); text-decoration:none; border-radius:2px; transition:all .25s; display:inline-block;
        }
        .btn-outline-w:hover { border-color:var(--white); background:rgba(255,255,255,.1); }

        /* ── Section Typography ── */
        .eyebrow { font-family:var(--f-body); font-size:16px; font-weight:600; letter-spacing:.24em; text-transform:uppercase; color:var(--brand); display:block; margin-bottom:10px; }
        .eyebrow.light { color:var(--brand-pale); }
        .eyebrow.gold  { color:var(--gold); }
        .h-section { font-family:var(--f-head); font-size:clamp(32px,3.8vw,56px); font-weight:400; line-height:1.12; color:var(--navy); margin-bottom:16px; }
        .h-section em { font-style:italic; font-weight:400; }
        .h-section.on-dark { color:var(--white); }
        .lead { font-family:var(--f-body); font-size:16px; font-weight:400; line-height:1.8; color:var(--mid); }
        .lead.on-dark { color:rgba(255,255,255,.6); }

        /* ── Divider ── */
        .bar { width:36px; height:3px; background:var(--brand); display:block; margin-bottom:16px; }
        .bar.light  { background:var(--brand-pale); }
        .bar.center { margin-left:auto; margin-right:auto; }

        /* ── Reveal ── */
        .reveal { opacity:0; transform:translateY(22px); transition:opacity .7s var(--ease),transform .7s var(--ease); }
        .reveal.visible { opacity:1; transform:translateY(0); }
        .d1{transition-delay:.08s} .d2{transition-delay:.16s} .d3{transition-delay:.24s} .d4{transition-delay:.32s}

        /* ── Pikaday override ── */
        .pika-single { font-family:var(--f-body)!important; border:1px solid var(--border)!important; border-radius:4px!important; box-shadow:0 8px 28px rgba(12,36,64,.1)!important; }
        .pika-label { font-family:var(--f-head)!important; font-weight:400!important; color:var(--navy)!important; }
        .pika-button:hover { background:var(--brand-pale)!important; }
        .is-selected .pika-button { background:var(--brand)!important; border-radius:2px!important; }
        abbr[title] { text-decoration:none!important; font-family:var(--f-body)!important; font-size:10.5px!important; font-weight:600!important; color:var(--mid)!important; letter-spacing:.04em!important; }

        /* ── Footer ── */
        footer { background:var(--navy-deep); }
        .footer-cta-strip { background:var(--brand); padding:22px 48px; display:flex; align-items:center; justify-content:space-between; gap:16px; }
        .footer-cta-text { font-family:var(--f-head); font-size:19px; font-weight:400; font-style:italic; color:var(--white); }
        .footer-main { padding:52px 48px 36px; display:grid; grid-template-columns:2fr 1fr 1fr 1.3fr; gap:44px; border-bottom:1px solid rgba(255,255,255,.05); }
        .footer-brand-name { font-family:var(--f-head); font-size:22px; font-weight:400; color:var(--white); margin-bottom:3px; }
        .footer-brand-sub  { font-family:var(--f-body); font-size:12px; font-weight:600; letter-spacing:.2em; text-transform:uppercase; color:var(--brand-pale); margin-bottom:14px; }
        .footer-tagline    { font-family:var(--f-body); font-size:14.5px; line-height:1.8; color:rgba(255,255,255,.38); max-width:280px; margin-bottom:20px; }
        .footer-social { display:flex; gap:8px; }
        .footer-social a { width:32px; height:32px; border-radius:50%; border:1px solid rgba(255,255,255,.1); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,.35); text-decoration:none; font-size:11px; transition:all .25s; }
        .footer-social a:hover { border-color:var(--brand); color:var(--brand-pale); background:rgba(12,77,162,.1); }
        .footer-col-title { font-family:var(--f-body); font-size:13px; font-weight:600; letter-spacing:.18em; text-transform:uppercase; color:var(--white); margin-bottom:16px; padding-bottom:10px; border-bottom:1px solid rgba(255,255,255,.05); }
        .footer-col ul { list-style:none; }
        .footer-col ul li { margin-bottom:10px; }
        .footer-col ul li a { font-family:var(--f-body); font-size:14.5px; color:rgba(255,255,255,.42); text-decoration:none; transition:color .2s,padding-left .2s; }
        .footer-col ul li a:hover { color:var(--brand-pale); padding-left:4px; }
        .footer-contact-item { display:flex; gap:10px; align-items:flex-start; margin-bottom:13px; }
        .footer-contact-icon { color:var(--brand); font-size:14px; flex-shrink:0; margin-top:2px; }
        .footer-contact-label { font-family:var(--f-body); font-size:11px; font-weight:600; letter-spacing:.15em; text-transform:uppercase; color:rgba(255,255,255,.3); margin-bottom:2px; }
        .footer-contact-val { font-family:var(--f-body); font-size:14.5px; color:rgba(255,255,255,.48); text-decoration:none; transition:color .2s; }
        .footer-contact-val:hover { color:var(--brand-pale); }
        .footer-bar { padding:16px 48px; display:flex; justify-content:space-between; align-items:center; }
        .footer-copy { font-family:var(--f-body); font-size:12.5px; color:rgba(255,255,255,.22); }

        ::-webkit-scrollbar { width:4px; }
        ::-webkit-scrollbar-track { background:var(--off-white); }
        ::-webkit-scrollbar-thumb { background:var(--brand); border-radius:2px; }

        /* ── Responsive ── */
        @media(max-width:1200px){
            nav#mainNav,.top-bar { padding-left:28px; padding-right:28px; }
            .footer-main { padding:40px 28px 28px; gap:28px; }
            .footer-cta-strip { padding:20px 28px; }
            .footer-bar { padding:14px 28px; }
        }
        @media(max-width:1024px){ .footer-main { grid-template-columns:1fr 1fr; } }
        @media(max-width:768px){
            .top-bar { height:auto; min-height:44px; padding:8px 14px; font-size:10.5px; flex-wrap:wrap; justify-content:center; gap:6px; }
            .top-bar-left { display:none; }
            .top-bar-center { position:static; transform:none; }
            .tb-logo-img { height:30px; }
            .tb-brand-name { font-size:16px; }
            .top-bar-right { gap:10px; }
            .top-bar-right .nav-auth,.top-bar-right .nav-join { display:none; }
            nav#mainNav { top:44px; padding:0 14px; height:48px; justify-content:center; }
            nav#mainNav.scrolled { top:0; }
            .nav-toggle { display:flex; position:absolute; right:14px; }
            .nav-links { position:fixed; top:0; right:-100%; width:260px; height:100vh; background:var(--navy); flex-direction:column; padding:68px 22px 22px; gap:0; transition:right .4s var(--ease); box-shadow:-6px 0 24px rgba(0,0,0,.2); }
            .nav-links.open { right:0; }
            .nav-links li { width:100%; }
            .nav-links a { display:block; padding:12px 0; color:rgba(255,255,255,.8)!important; border-bottom:1px solid rgba(255,255,255,.06); font-size:12px; }
            .nav-links a::after { display:none; }
            .nav-links .mobile-auth { padding-top:18px; margin-top:8px; border-top:1px solid rgba(255,255,255,.12); display:flex; flex-direction:column; gap:0; }
            .nav-links .mobile-auth a { font-size:12px; color:rgba(255,255,255,.8)!important; padding:12px 0; border-bottom:1px solid rgba(255,255,255,.06); text-decoration:none; display:block; }
            .nav-links .mobile-auth form button { font-family:var(--f-body); font-size:12px; color:rgba(255,255,255,.8); padding:12px 0; border:none; background:none; cursor:pointer; width:100%; text-align:left; border-bottom:1px solid rgba(255,255,255,.06); }
            .nav-links .mobile-auth { display:flex!important; }
            .footer-main { grid-template-columns:1fr; gap:24px; padding:32px 14px 22px; }
            .footer-cta-strip { flex-direction:column; text-align:center; padding:18px 14px; }
            .footer-bar { padding:12px 14px; flex-direction:column; gap:5px; text-align:center; }
        }
        @media(max-width:480px){
            .top-bar { padding:6px 10px; font-size:10px; min-height:38px; }
            .tb-logo-img { height:26px; }
            .tb-brand-name { font-size:14px; }
            nav#mainNav { height:44px; padding:0 10px; }
            .nav-links { width:240px; padding:60px 18px 18px; }
            .nav-links a { font-size:11px; padding:10px 0; }
            .footer-main { padding:24px 10px 18px; }
            .footer-cta-strip { padding:14px 10px; }
            .footer-cta-strip .btn-blue { font-size:10.5px; padding:10px 20px; width:100%; text-align:center; justify-content:center; }
            .footer-bar { padding:10px 10px; font-size:10px; }
        }
        @media(max-width:360px){
            .top-bar { padding:5px 8px; }
            .tb-logo-img { height:22px; }
            nav#mainNav { height:40px; }
            .nav-links { width:220px; }
        }

        @yield('styles')
    </style>
    @yield('head')
</head>
<body>

{{-- PRELOADER --}}
<div id="page-loader">
    <img src="{{ asset('logo.png') }}" alt="Lucerna" class="loader-logo">
    <div class="loader-bar"><div class="loader-fill"></div></div>
</div>

{{-- TOP BAR --}}
<div class="top-bar" id="topBar">
    <div class="top-bar-left">
        <a href="tel:+250794191115"><svg class="tb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6A19.79 19.79 0 012.12 4.18 2 2 0 014.11 2h3a2 2 0 012 1.72c.13.81.36 1.6.68 2.34a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.74.32 1.53.55 2.34.68A2 2 0 0122 16.92z"/></svg> +250 794 191 115</a>
        <div class="tb-sep"></div>
        <a href="https://maps.google.com/?q=Lucerna+Kabgayi+Hotel,+Muhanga,+Rwanda" target="_blank" rel="noopener"><svg class="tb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg> View Map</a>
        <div class="tb-sep"></div>
        <a href="mailto:hotellucernakabgayi@gmail.com"><svg class="tb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg> hotellucernakabgayi@gmail.com</a>
    </div>
    <div class="top-bar-center">
        <a href="{{ route('home') }}" class="tb-logo-link">
            <img src="{{ asset('logo.png') }}" alt="Lucerna Kabgayi Hôtel" class="tb-logo-img">
            {{-- <div class="tb-brand">
                <span class="tb-brand-name">Lucerna Kabgayi</span>
                <span class="tb-brand-sub">Hôtel · Rwanda</span>
            </div> --}}
        </a>
    </div>
    <div class="top-bar-right">
        <span class="tb-stars">★★★</span>
        <div class="tb-right-sep"></div>
        @auth
            <div class="user-dropdown-wrap" id="userDropdown">
                <a href="javascript:void(0)" class="nav-auth nav-auth-user user-dropdown-toggle" id="userDropdownToggle">
                    @if(Auth::user()->photo)
                        <img src="{{ asset(Auth::user()->photo) }}" alt="{{ Auth::user()->name }}">
                    @else
                        <svg class="tb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    @endif
                    {{ Auth::user()->name }}
                    <svg class="dd-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                </a>
                <div class="user-dropdown">
                    <div class="ud-header">
                        <div class="ud-header-name">{{ Auth::user()->name }}</div>
                        <div class="ud-header-email">{{ Auth::user()->email }}</div>
                    </div>
                    <a href="{{ url('/dashboard') }}" class="ud-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('user.profile') }}" class="ud-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        My Profile
                    </a>
                    <a href="{{ route('user.booking') }}" class="ud-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        My Bookings
                    </a>
                    <a href="{{ route('user.change.password') }}" class="ud-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        Change Password
                    </a>
                    <div class="ud-sep"></div>
                    <form method="POST" action="{{ route('logout') }}" id="topBarLogoutForm">
                        @csrf
                        <a href="javascript:void(0)" class="ud-link logout" onclick="document.getElementById('topBarLogoutForm').submit();">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                            Logout
                        </a>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="nav-auth">
                <svg class="tb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg> Login
            </a>
            <a href="{{ route('register') }}" class="nav-join">Join</a>
        @endauth
        <div class="tb-right-sep"></div>
        <a href="{{ route('home') }}#booking" class="nav-cta">Book Now</a>
    </div>
</div>

{{-- NAVIGATION --}}
<nav id="mainNav">
    <ul class="nav-links" id="navLinks">
        <li><a href="{{ route('home') }}"           class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('home') }}#about">About</a></li>
        <li><a href="{{ route('home') }}#rooms">Rooms</a></li>
        <li><a href="{{ route('home') }}#dining">Dining</a></li>
        <li><a href="{{ route('home') }}#meetings">Events</a></li>
        <li><a href="{{ route('home') }}#contact">Contact</a></li>
        {{-- Mobile auth links --}}
        <li class="mobile-auth" style="display:none;">
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Join / Register</a>
            @endauth
        </li>
    </ul>

    <div class="nav-toggle" id="navToggle">
        <span></span><span></span><span></span>
    </div>
</nav>

@yield('main')

{{-- FOOTER --}}
<footer>
    <div class="footer-cta-strip">
        <div class="footer-cta-text">Begin Your Journey at Lucerna Kabgayi</div>
        <a href="{{ route('home') }}#booking" class="btn-blue" style="background:var(--navy-deep);flex-shrink:0;">
            <span>Book Now</span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
    <div class="footer-main">
        <div class="footer-brand">
            <div class="footer-brand-name">Lucerna Kabgayi Hôtel</div>
            <div class="footer-brand-sub">Southern Province · Rwanda</div>
            <p class="footer-tagline">A sanctuary rooted in Catholic hospitality, welcoming every guest with warmth, grace, and world-class service.</p>
            <div class="footer-social">
                <a href="#" aria-label="Facebook">f</a>
                <a href="#" aria-label="Instagram">in</a>
                <a href="#" aria-label="Twitter">tw</a>
            </div>
        </div>
        <div class="footer-col">
            <div class="footer-col-title">Explore</div>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('home') }}#about">About</a></li>
                <li><a href="{{ route('home') }}#rooms">Rooms</a></li>
                <li><a href="{{ route('home') }}#dining">Dining</a></li>
                <li><a href="{{ route('home') }}#meetings">Events</a></li>
                <li><a href="{{ route('home') }}#contact">Contact</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <div class="footer-col-title">Services</div>
            <ul>
                <li><a href="{{ route('home') }}#amenities">Outdoor Garden</a></li>
                <li><a href="{{ route('home') }}#amenities">Fresh Linen Provided</a></li>
                <li><a href="{{ route('home') }}#amenities">Business Center</a></li>
                <li><a href="{{ route('home') }}#amenities">Meeting Space</a></li>
                <li><a href="{{ route('home') }}#amenities">Restaurant &amp; Bar</a></li>
                <li><a href="{{ route('home') }}#amenities">Fitness Center</a></li>
                <li><a href="{{ route('home') }}#amenities">On-Site Laundry</a></li>
                <li><a href="{{ route('home') }}#amenities">24-Hour Front Desk</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <div class="footer-col-title">Contact</div>
            <div class="footer-contact-item">
                <span class="footer-contact-icon">◈</span>
                <div><div class="footer-contact-label">Address</div><div class="footer-contact-val">Muhanga, Kabgayi, Rwanda</div></div>
            </div>
            <div class="footer-contact-item">
                <span class="footer-contact-icon">◎</span>
                <div><div class="footer-contact-label">Phone</div><a class="footer-contact-val" href="tel:+250794191115">+250 794 191 115</a></div>
            </div>
            <div class="footer-contact-item">
                <span class="footer-contact-icon">✉</span>
                <div><div class="footer-contact-label">Email</div><a class="footer-contact-val" href="mailto:hotellucernakabgayi@gmail.com">hotellucernakabgayi@gmail.com</a></div>
            </div>
        </div>
    </div>
    <div class="footer-bar">
        <div class="footer-copy">&copy; {{ date('Y') }} Lucerna Kabgayi Hôtel. All rights reserved.</div>
        <div class="footer-copy">Designed by IBABA Creative Space Ltd</div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.2/pikaday.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
(function(){
    'use strict';
    /* Preloader */
    window.addEventListener('load',function(){ setTimeout(function(){ document.getElementById('page-loader').classList.add('done'); },350); });
    /* Nav + topbar */
    var nav=document.getElementById('mainNav'),tb=document.getElementById('topBar');
    window.addEventListener('scroll',function(){ var y=window.scrollY; nav.classList.toggle('scrolled',y>50); if(tb) tb.classList.toggle('hidden',y>60); },{passive:true});
    /* Mobile */
    var tog=document.getElementById('navToggle'),lnk=document.getElementById('navLinks');
    if(tog) tog.addEventListener('click',function(){ lnk.classList.toggle('open'); });
    /* User dropdown */
    var udWrap=document.getElementById('userDropdown'),udTog=document.getElementById('userDropdownToggle');
    if(udTog){
        udTog.addEventListener('click',function(e){ e.preventDefault(); udWrap.classList.toggle('open'); });
        document.addEventListener('click',function(e){ if(udWrap && !udWrap.contains(e.target)) udWrap.classList.remove('open'); });
    }
    /* Reveal */
    document.addEventListener('DOMContentLoaded',function(){
        var ob=new IntersectionObserver(function(e){ e.forEach(function(x){ if(x.isIntersecting){ x.target.classList.add('visible'); ob.unobserve(x.target); } }); },{threshold:.07});
        document.querySelectorAll('.reveal').forEach(function(el){ ob.observe(el); });
    });
})();
</script>

@if(Session::has('message'))
<script>(function(){ var t="{{ Session::get('alert-type','info') }}",m="{{ Session::get('message') }}",map={info:'info',success:'success',warning:'warning',error:'error'}; if(toastr[map[t]]) toastr[map[t]](m); })();</script>
@endif

@if(!empty($siteSetting->whatsapp))
<a href="https://wa.me/{{ preg_replace('/[^0-9]/','', $siteSetting->whatsapp) }}?text={{ urlencode('Hello! I would like to make a reservation at Lucerna Kabgayi Hotel.') }}"
   target="_blank" rel="noopener"
   style="position:fixed;bottom:20px;right:20px;z-index:9999;width:50px;height:50px;border-radius:50%;background:#25D366;display:flex;align-items:center;justify-content:center;box-shadow:0 3px 10px rgba(0,0,0,.2);transition:transform .2s;"
   onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'" aria-label="Chat on WhatsApp">
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>
@endif

@yield('scripts')
</body>
</html>