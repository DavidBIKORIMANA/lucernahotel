<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="{{asset('backend/assets/images/favicon-32x32.png')}}" type="image/png"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>

  <!-- Bootstrap (inner pages compatibility) -->
  <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

  <title>{{ config('app.name','Lucerna') }} — Admin</title>

  <style>
  /* ══════════════════════════════════════════════════════
     GOLD DESIGN SYSTEM
  ══════════════════════════════════════════════════════ */
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    /* Gold ramp */
    --g50:  #fdf9ee; --g100: #f5e9bc; --g200: #e8cd7e;
    --g300: #d9b34a; --g400: #c9a140; --g500: #b08a20;
    --g600: #8a6a14; --g700: #664e0c; --g800: #433306; --g900: #211900;

    --gold:       #d0aa48;
    --gold-light: #e8c96a;
    --gold-pale:  #f5e9bc;
    --gold-glow:  rgba(208,170,72,.18);
    --gold-rim:   rgba(208,170,72,.30);
    --gold-faint: rgba(208,170,72,.07);
    --gold-bg:    rgba(208,170,72,.09);

    /* Backgrounds */
    --bg-void:  #05070f;
    --bg-deep:  #080c18;
    --bg-base:  #0c1120;
    --bg-card:  #101828;  /* ← used by inner pages via override */
    --bg-card2: #151f30;
    --bg-lift:  #1a2538;
    --bg-hover: #1d2a40;

    /* Borders */
    --border:   rgba(208,170,72,.14);
    --border2:  rgba(208,170,72,.22);
    --border3:  rgba(255,255,255,.05);

    /* Text */
    --text-1: #f2ebd6;
    --text-2: #a4aec6;
    --text-3: #4e5870;

    /* Semantic */
    --success: #3fb87a;
    --info:    #4b8ef5;
    --danger:  #e05252;
    --warning: #e8993a;

    /* Layout */
    --sidebar-w: 262px;
    --header-h:  68px;
    --radius:    16px;
    --radius-sm: 10px;
    --radius-xs: 6px;
    --transition: .22s cubic-bezier(.4,0,.2,1);

    --font-display: 'Cormorant Garamond', Georgia, serif;
    --font-ui:      'DM Sans', system-ui, sans-serif;
  }

  html, body {
    height: 100%;
    font-family: var(--font-ui);
    background: var(--bg-void);
    color: var(--text-1);
    font-size: 14px;
    line-height: 1.6;
  }

  a { color: inherit; text-decoration: none; }

  ::-webkit-scrollbar { width: 4px; }
  ::-webkit-scrollbar-track { background: transparent; }
  ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

  .shell { display: flex; min-height: 100vh; }

  /* ════════════════════════════════════════════════
     SIDEBAR
  ════════════════════════════════════════════════ */
  .sidebar {
    width: var(--sidebar-w);
    background: var(--bg-base);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; left: 0; bottom: 0;
    z-index: 200;
    overflow-y: auto;
    transition: transform var(--transition);
  }

  /* thin gold glow on right edge */
  .sidebar::after {
    content: '';
    position: absolute;
    top: 0; right: -1px; bottom: 0;
    width: 1px;
    background: linear-gradient(180deg, transparent 0%, var(--gold) 40%, var(--gold) 60%, transparent 100%);
    opacity: .12;
    pointer-events: none;
  }

  /* ── Brand ── */
  .sidebar-brand {
    padding: 24px 20px 20px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 12px;
    position: relative;
  }
  .brand-icon {
    width: 40px; height: 40px;
    background: linear-gradient(135deg, rgba(208,170,72,.2) 0%, rgba(208,170,72,.06) 100%);
    border: 1px solid var(--border2);
    border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    color: var(--gold);
    flex-shrink: 0;
    box-shadow: 0 0 20px rgba(208,170,72,.1);
  }
  .brand-name {
    font-family: var(--font-display);
    font-size: 21px; font-weight: 600;
    color: var(--text-1);
    letter-spacing: .3px;
    line-height: 1.1;
  }
  .brand-sub {
    font-size: 9.5px; color: var(--gold);
    letter-spacing: 2.5px; text-transform: uppercase;
    font-weight: 500; margin-top: 1px;
    font-family: var(--font-ui);
  }

  /* ── Nav ── */
  .nav-section { padding: 14px 10px 16px; flex: 1; }
  .nav-label {
    font-size: 9.5px; letter-spacing: 1.8px;
    text-transform: uppercase; color: var(--text-3);
    font-weight: 600; padding: 0 10px;
    margin-bottom: 5px; margin-top: 18px;
    font-family: var(--font-ui);
  }
  .nav-label:first-child { margin-top: 6px; }

  .nav-item {
    display: flex; align-items: center; gap: 11px;
    padding: 9px 10px;
    border-radius: var(--radius-sm);
    color: var(--text-2);
    cursor: pointer;
    transition: background var(--transition), color var(--transition), border-color var(--transition);
    border: 1px solid transparent;
    margin-bottom: 1px;
  }
  .nav-item:hover { background: var(--bg-hover); color: var(--text-1); }
  .nav-item.active {
    background: var(--gold-faint);
    color: var(--gold);
    border-color: var(--border);
  }
  .nav-item.active .nav-icon { opacity: 1; }
  .nav-icon { width: 17px; height: 17px; flex-shrink: 0; opacity: .65; transition: opacity var(--transition); }
  .nav-item:hover .nav-icon { opacity: .9; }
  .nav-text { font-size: 13px; font-weight: 500; }
  .nav-badge {
    margin-left: auto;
    background: var(--gold); color: var(--bg-void);
    font-size: 10px; font-weight: 700;
    padding: 1px 7px; border-radius: 20px;
    min-width: 20px; text-align: center;
    font-family: var(--font-ui);
  }
  .nav-badge.red { background: var(--danger); color: #fff; }

  .nav-group { margin-bottom: 1px; }
  .nav-group-toggle {
    display: flex; align-items: center; gap: 11px;
    padding: 9px 10px;
    border-radius: var(--radius-sm);
    color: var(--text-2); cursor: pointer;
    transition: background var(--transition), color var(--transition);
    user-select: none;
    border: 1px solid transparent;
  }
  .nav-group-toggle:hover { background: var(--bg-hover); color: var(--text-1); }
  .nav-group-children {
    padding-left: 14px; overflow: hidden;
    max-height: 0; transition: max-height .3s ease;
  }
  .nav-group.open .nav-group-children { max-height: 320px; }
  .nav-chevron {
    margin-left: auto; transition: transform .25s;
    width: 14px; height: 14px; color: var(--text-3);
  }
  .nav-group.open .nav-chevron { transform: rotate(90deg); }
  .nav-sub-item {
    display: flex; align-items: center; gap: 9px;
    padding: 8px 10px; border-radius: var(--radius-sm);
    color: var(--text-3); font-size: 12.5px; font-weight: 500;
    transition: background var(--transition), color var(--transition);
    cursor: pointer; border: 1px solid transparent;
    margin-bottom: 1px;
  }
  .nav-sub-item:hover { background: var(--bg-hover); color: var(--text-2); }
  .nav-sub-dot { width: 5px; height: 5px; border-radius: 50%; background: var(--text-3); flex-shrink: 0; transition: background var(--transition); }
  .nav-sub-item:hover .nav-sub-dot { background: var(--gold); }

  /* ── Sidebar footer ── */
  .sidebar-footer {
    padding: 14px 10px;
    border-top: 1px solid var(--border);
    background: var(--bg-base);
  }
  .user-card {
    display: flex; align-items: center; gap: 10px;
    padding: 10px;
    border-radius: var(--radius-sm);
    cursor: pointer;
    transition: background var(--transition);
    border: 1px solid transparent;
  }
  .user-card:hover { background: var(--bg-hover); border-color: var(--border); }
  .user-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: linear-gradient(135deg, rgba(208,170,72,.2), rgba(208,170,72,.06));
    border: 1.5px solid var(--border2);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 600; color: var(--gold);
    flex-shrink: 0; overflow: hidden;
  }
  .user-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }
  .user-name  { font-size: 13px; font-weight: 600; color: var(--text-1); line-height: 1.2; }
  .user-role  { font-size: 10.5px; color: var(--text-3); margin-top: 1px; }
  .user-more  { margin-left: auto; color: var(--text-3); }

  /* ════════════════════════════════════════════════
     MAIN AREA
  ════════════════════════════════════════════════ */
  .main {
    margin-left: var(--sidebar-w);
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  /* ════════════════════════════════════════════════
     HEADER
  ════════════════════════════════════════════════ */
  .header {
    height: var(--header-h);
    background: var(--bg-base);
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center;
    padding: 0 28px; gap: 14px;
    position: sticky; top: 0; z-index: 90;
  }

  .mobile-toggle {
    display: none; cursor: pointer;
    color: var(--text-2); flex-shrink: 0;
  }
  .mobile-toggle:hover { color: var(--gold); }

  .header-title {
    font-family: var(--font-display);
    font-size: 22px; font-weight: 500;
    color: var(--text-1); flex: 1;
  }
  .header-title span { color: var(--gold); }

  .search-wrap { position: relative; display: flex; align-items: center; }
  .search-wrap .s-ico { position: absolute; left: 12px; color: var(--text-3); pointer-events: none; }
  .search-input {
    background: var(--bg-card2);
    border: 1px solid var(--border3);
    border-radius: 30px;
    padding: 8px 16px 8px 36px;
    color: var(--text-1);
    font-family: var(--font-ui);
    font-size: 13px;
    width: 210px; outline: none;
    transition: border var(--transition), width var(--transition), box-shadow var(--transition);
  }
  .search-input::placeholder { color: var(--text-3); }
  .search-input:focus {
    border-color: var(--border2);
    width: 260px;
    box-shadow: 0 0 0 3px rgba(208,170,72,.08);
  }

  .header-actions { display: flex; align-items: center; gap: 8px; }

  .icon-btn {
    width: 38px; height: 38px;
    background: var(--bg-card2);
    border: 1px solid var(--border3);
    border-radius: 11px;
    display: flex; align-items: center; justify-content: center;
    color: var(--text-2); cursor: pointer;
    transition: background var(--transition), color var(--transition), border-color var(--transition), box-shadow var(--transition);
    position: relative; text-decoration: none;
  }
  .icon-btn:hover {
    background: var(--bg-hover);
    color: var(--gold);
    border-color: var(--border);
    box-shadow: 0 0 12px rgba(208,170,72,.08);
  }
  .badge-dot {
    position: absolute; top: 7px; right: 7px;
    width: 7px; height: 7px;
    background: var(--danger);
    border: 1.5px solid var(--bg-base);
    border-radius: 50%;
  }

  /* notification dropdown */
  .notif-dropdown {
    position: relative;
  }
  .notif-panel {
    display: none;
    position: absolute; top: calc(100% + 10px); right: 0;
    width: 320px;
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    box-shadow: 0 20px 60px rgba(0,0,0,.5);
    z-index: 300;
    overflow: hidden;
  }
  .notif-dropdown.open .notif-panel { display: block; }
  .notif-header {
    padding: 14px 18px;
    border-bottom: 1px solid var(--border3);
    display: flex; align-items: center; justify-content: space-between;
  }
  .notif-title { font-size: 14px; font-weight: 600; color: var(--text-1); }
  .notif-count {
    font-size: 11px; font-weight: 600;
    background: var(--gold-faint); color: var(--gold);
    border: 1px solid var(--border);
    padding: 2px 8px; border-radius: 20px;
  }
  .notif-list { max-height: 280px; overflow-y: auto; }
  .notif-item {
    display: flex; gap: 12px; padding: 12px 18px;
    border-bottom: 1px solid rgba(255,255,255,.03);
    transition: background var(--transition);
    cursor: pointer;
  }
  .notif-item:hover { background: var(--bg-hover); }
  .notif-item:last-child { border-bottom: none; }
  .notif-icon {
    width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    background: var(--gold-faint); color: var(--gold);
    border: 1px solid var(--border);
  }
  .notif-msg { font-size: 12.5px; color: var(--text-2); line-height: 1.5; }
  .notif-msg strong { color: var(--text-1); font-weight: 500; }
  .notif-time { font-size: 10.5px; color: var(--text-3); margin-top: 2px; }
  .notif-footer {
    padding: 11px 18px;
    border-top: 1px solid var(--border3);
    text-align: center;
  }
  .notif-all-btn {
    font-size: 12px; color: var(--gold); font-weight: 500;
    cursor: pointer; transition: color var(--transition);
    font-family: var(--font-ui);
    display: inline-flex; align-items: center; gap: 5px;
  }
  .notif-all-btn:hover { color: var(--gold-light); }

  /* user dropdown */
  .user-dropdown { position: relative; }
  .user-dropdown-panel {
    display: none;
    position: absolute; top: calc(100% + 10px); right: 0;
    width: 200px;
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    box-shadow: 0 16px 48px rgba(0,0,0,.5);
    z-index: 300;
    overflow: hidden;
    padding: 6px;
  }
  .user-dropdown.open .user-dropdown-panel { display: block; }
  .u-menu-item {
    display: flex; align-items: center; gap: 9px;
    padding: 9px 12px; border-radius: 8px;
    color: var(--text-2); font-size: 13px; font-weight: 500;
    cursor: pointer; transition: background var(--transition), color var(--transition);
    border: 1px solid transparent;
  }
  .u-menu-item:hover { background: var(--bg-hover); color: var(--text-1); }
  .u-menu-item.danger:hover { background: rgba(224,82,82,.08); color: var(--danger); }
  .u-menu-divider { height: 1px; background: var(--border3); margin: 4px 0; }

  .header-avatar {
    width: 38px; height: 38px; border-radius: 50%;
    background: linear-gradient(135deg, rgba(208,170,72,.2), rgba(208,170,72,.06));
    border: 1.5px solid var(--border2);
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 600; color: var(--gold);
    cursor: pointer;
    transition: border-color var(--transition), box-shadow var(--transition);
    overflow: hidden;
  }
  .header-avatar:hover {
    border-color: var(--gold);
    box-shadow: 0 0 16px rgba(208,170,72,.2);
  }
  .header-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; }

  /* ════════════════════════════════════════════════
     PAGE WRAPPER — gold gradient bg
  ════════════════════════════════════════════════ */
  .page {
    flex: 1;
    padding: 28px;
    background:
      radial-gradient(ellipse at 10% 0%, rgba(208,170,72,.06) 0%, transparent 50%),
      radial-gradient(ellipse at 90% 100%, rgba(75,142,245,.05) 0%, transparent 50%),
      var(--bg-void);
    min-height: calc(100vh - var(--header-h));
  }

  /* ════════════════════════════════════════════════
     BOOTSTRAP INNER-PAGE OVERRIDES
  ════════════════════════════════════════════════ */
  .page .card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    color: var(--text-1);
    backdrop-filter: blur(6px);
  }
  .page .card-header {
    background: rgba(208,170,72,.04);
    border-bottom: 1px solid var(--border3);
    color: var(--text-1);
    border-radius: calc(var(--radius) - 1px) calc(var(--radius) - 1px) 0 0;
    padding: 16px 20px;
  }
  .page .card-body { color: var(--text-2); padding: 20px; }

  .page .table {
    color: var(--text-2);
    --bs-table-bg: transparent;
    --bs-table-striped-bg: rgba(208,170,72,.02);
    --bs-table-hover-bg: var(--bg-hover);
  }
  .page .table thead th {
    color: var(--text-3);
    border-color: var(--border3);
    font-size: 10.5px;
    letter-spacing: 1px;
    text-transform: uppercase;
    font-weight: 600;
    padding: 10px 14px;
    font-family: var(--font-ui);
  }
  .page .table tbody td {
    border-color: rgba(255,255,255,.03);
    vertical-align: middle;
    padding: 12px 14px;
    color: var(--text-2);
  }
  .page .table tbody tr:hover td { color: var(--text-1); }

  .page .form-control,
  .page .form-select {
    background: var(--bg-card2);
    border: 1px solid var(--border);
    color: var(--text-1);
    border-radius: var(--radius-sm);
    font-family: var(--font-ui);
  }
  .page .form-control:focus,
  .page .form-select:focus {
    background: var(--bg-lift);
    border-color: var(--border2);
    box-shadow: 0 0 0 3px rgba(208,170,72,.12);
    color: var(--text-1);
  }
  .page .form-control::placeholder { color: var(--text-3); }
  .page .form-label, .page label { color: var(--text-2); font-weight: 500; font-size: 13px; }
  .page select option { background: var(--bg-card2); color: var(--text-1); }

  /* ── Buttons ── */
  .page .btn-primary {
    background: linear-gradient(135deg, var(--gold), var(--g300));
    border-color: var(--gold);
    color: var(--bg-void);
    font-weight: 600;
    font-family: var(--font-ui);
    transition: box-shadow var(--transition), transform .15s;
  }
  .page .btn-primary:hover {
    background: linear-gradient(135deg, var(--gold-light), var(--gold));
    border-color: var(--gold-light);
    color: var(--bg-void);
    box-shadow: 0 4px 20px rgba(208,170,72,.3);
    transform: translateY(-1px);
  }
  .page .btn-success  { background: var(--success); border-color: var(--success); }
  .page .btn-danger   { background: var(--danger);  border-color: var(--danger);  }
  .page .btn-info     { background: var(--info);    border-color: var(--info);    }
  .page .btn-warning  { background: var(--warning); border-color: var(--warning); color: var(--bg-void); }
  .page .btn-secondary{ background: var(--bg-lift); border-color: var(--border);  color: var(--text-2); }
  .page .btn-secondary:hover { background: var(--bg-hover); color: var(--text-1); }

  /* ── Badges ── */
  .page .badge { font-weight: 600; font-family: var(--font-ui); letter-spacing: .3px; }
  .page .badge.bg-success { background: rgba(63,184,122,.15) !important; color: var(--success) !important; border: 1px solid rgba(63,184,122,.25); }
  .page .badge.bg-danger  { background: rgba(224,82,82,.15)  !important; color: var(--danger)  !important; border: 1px solid rgba(224,82,82,.25); }
  .page .badge.bg-warning { background: rgba(232,153,58,.15) !important; color: var(--warning) !important; border: 1px solid rgba(232,153,58,.25); }
  .page .badge.bg-info    { background: rgba(75,142,245,.15) !important; color: var(--info)    !important; border: 1px solid rgba(75,142,245,.25); }
  .page .badge.bg-primary { background: var(--gold-faint)    !important; color: var(--gold)    !important; border: 1px solid var(--border); }

  /* ── Links & misc ── */
  .page a:not(.btn):not(.nav-link):not(.dropdown-item):not(.view-all-btn) { color: var(--gold); }
  .page a:not(.btn):not(.nav-link):not(.dropdown-item):not(.view-all-btn):hover { color: var(--gold-light); }
  .page h4, .page h5, .page h6 { color: var(--text-1); font-family: var(--font-display); font-weight: 600; }
  .page .text-muted, .page .text-secondary { color: var(--text-3) !important; }

  /* ── DataTable ── */
  .page .dataTables_wrapper .dataTables_filter input,
  .page .dataTables_wrapper .dataTables_length select {
    background: var(--bg-card2);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    color: var(--text-1);
    padding: 5px 10px;
  }
  .page .dataTables_wrapper .dataTables_info,
  .page .dataTables_wrapper .dataTables_filter label,
  .page .dataTables_wrapper .dataTables_length label { color: var(--text-3); font-size: 12px; }
  .page .dataTables_wrapper .paginate_button {
    background: var(--bg-card2) !important;
    border: 1px solid var(--border) !important;
    color: var(--text-2) !important;
    border-radius: var(--radius-xs) !important;
    margin: 0 2px !important;
  }
  .page .dataTables_wrapper .paginate_button:hover {
    background: var(--bg-hover) !important;
    color: var(--gold) !important;
    border-color: var(--border2) !important;
  }
  .page .dataTables_wrapper .paginate_button.current {
    background: var(--gold-faint) !important;
    border-color: var(--border2) !important;
    color: var(--gold) !important;
  }

  /* ── Dropdowns ── */
  .dropdown-menu {
    background: var(--bg-card) !important;
    border: 1px solid var(--border) !important;
    border-radius: var(--radius-sm) !important;
    box-shadow: 0 12px 40px rgba(0,0,0,.5) !important;
    padding: 6px !important;
  }
  .dropdown-item {
    color: var(--text-2) !important;
    border-radius: 7px !important;
    padding: 8px 12px !important;
    font-size: 13px !important;
    font-family: var(--font-ui) !important;
    transition: background var(--transition), color var(--transition) !important;
  }
  .dropdown-item:hover, .dropdown-item:focus {
    background: var(--bg-hover) !important;
    color: var(--text-1) !important;
  }

  /* ── Summernote ── */
  .page .note-editor { border-color: var(--border) !important; border-radius: var(--radius-sm) !important; }
  .page .note-toolbar { background: var(--bg-card2) !important; border-color: var(--border3) !important; }
  .page .note-editing-area .note-editable { background: var(--bg-card2) !important; color: var(--text-1) !important; }

  /* ── Page section heading ── */
  .page-heading {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 24px; flex-wrap: wrap; gap: 10px;
  }
  .page-heading h4 { margin: 0; }
  .breadcrumb { background: transparent !important; padding: 0 !important; margin: 0 !important; }
  .breadcrumb-item, .breadcrumb-item a { font-size: 12px; color: var(--text-3) !important; }
  .breadcrumb-item.active { color: var(--text-2) !important; }
  .breadcrumb-item + .breadcrumb-item::before { color: var(--text-3) !important; }

  /* ── Footer ── */
  .admin-footer {
    padding: 14px 28px;
    border-top: 1px solid var(--border3);
    text-align: center;
    font-size: 11.5px;
    color: var(--text-3);
    font-family: var(--font-ui);
  }
  .admin-footer span { color: var(--gold); }

  /* ════════════════════════════════════════════════
     RESPONSIVE
  ════════════════════════════════════════════════ */
  @media (max-width: 1280px) {
    :root { --sidebar-w: 240px; }
  }
  @media (max-width: 900px) {
    .sidebar { transform: translateX(-100%); }
    .sidebar.open { transform: translateX(0); }
    .main { margin-left: 0; }
    .mobile-toggle { display: flex !important; }
    .search-wrap { display: none; }
    .page { padding: 16px; }
  }

  /* ── Sidebar overlay (mobile) ── */
  .sidebar-overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,.65);
    z-index: 150;
    backdrop-filter: blur(2px);
  }
  .sidebar-overlay.show { display: block; }

  /* ── Toastr gold override ── */
  #toast-container > div {
    border-radius: var(--radius-sm) !important;
    font-family: var(--font-ui) !important;
    font-size: 13px !important;
    box-shadow: 0 8px 30px rgba(0,0,0,.5) !important;
  }
  </style>

  @stack('styles')
</head>

<body>
<div class="shell">

  {{-- ══ SIDEBAR ══ --}}
  @php
    $user = Auth::user();
    $sidebarPhoto = (!empty($user->photo)) ? url('upload/admin_images/'.$user->photo) : null;
    $sidebarInitials = collect(explode(' ', $user->name))->map(fn($w)=>strtoupper(substr($w,0,1)))->take(2)->join('');
  @endphp

  <aside class="sidebar" id="sidebar">
    <!-- Brand -->
    <div class="sidebar-brand">
      <div class="brand-icon">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
          <path d="M3 22V9l9-7 9 7v13"/><path d="M9 22V12h6v10"/>
          <rect x="11" y="4" width="2" height="2" fill="currentColor" stroke="none"/>
        </svg>
      </div>
      <div>
        <div class="brand-name">{{ config('app.name','Lucerna') }}</div>
        <div class="brand-sub">Admin Panel</div>
      </div>
    </div>

    <!-- Navigation -->
    <nav class="nav-section">

      <div class="nav-label">Overview</div>
      <a class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        <span class="nav-text">Dashboard</span>
      </a>

      <div class="nav-label">Rooms & Stays</div>

      <a class="nav-item {{ request()->routeIs('room.type.list') ? 'active' : '' }}" href="{{ route('room.type.list') }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M2 22V12l10-8 10 8v10H2z"/><path d="M9 22v-6h6v6"/></svg>
        <span class="nav-text">Accommodation</span>
      </a>

      <a class="nav-item {{ request()->routeIs('view.room.list') ? 'active' : '' }}" href="{{ route('view.room.list') }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
        <span class="nav-text">Room List</span>
      </a>

      <div class="nav-label">Bookings</div>

      <div class="nav-group {{ request()->routeIs('booking.*','add.room.list') ? 'open' : '' }}" onclick="toggleGroup(this)">
        <div class="nav-group-toggle">
          <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M2 9h20M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z"/><path d="M8 5v14"/></svg>
          <span class="nav-text">Bookings</span>
          @php $pendingCount = App\Models\Booking::where('status','0')->count(); @endphp
          @if($pendingCount > 0)<span class="nav-badge red">{{ $pendingCount }}</span>@endif
          <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </div>
        <div class="nav-group-children">
          <a class="nav-sub-item" href="{{ route('booking.list') }}"><span class="nav-sub-dot"></span>Booking List</a>
          <a class="nav-sub-item" href="{{ route('add.room.list') }}"><span class="nav-sub-dot"></span>Add Booking</a>
          <a class="nav-sub-item" href="{{ route('booking.report') }}"><span class="nav-sub-dot"></span>Booking Report</a>
        </div>
      </div>

      <a class="nav-item {{ request()->routeIs('all.review') ? 'active' : '' }}" href="{{ route('all.review') }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        <span class="nav-text">Reviews</span>
        @php $pendingReviews = App\Models\Review::where('is_approved',false)->count(); @endphp
        @if($pendingReviews > 0)<span class="nav-badge">{{ $pendingReviews }}</span>@endif
      </a>

      <div class="nav-label">Content</div>

      <div class="nav-group {{ request()->routeIs('homepage.manage','homepage.sections','all.hero.slides','add.hero.slide','edit.hero.slide','all.hero.stats','add.hero.stat','edit.hero.stat','all.about.pillars','add.about.pillar','edit.about.pillar','all.amenities','add.amenity','edit.amenity','all.featured.amenities','add.featured.amenity','edit.featured.amenity','all.dining.items','add.dining.item','edit.dining.item','all.event.features','add.event.feature','edit.event.feature','all.hotel.info','add.hotel.info','edit.hotel.info','homepage.site.settings') ? 'open' : '' }}" onclick="toggleGroup(this)">
        <div class="nav-group-toggle">
          <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          <span class="nav-text">Homepage Content</span>
          <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </div>
        <div class="nav-group-children">
          <a class="nav-sub-item" href="{{ route('homepage.manage') }}"><span class="nav-sub-dot"></span>Dashboard</a>
          <a class="nav-sub-item" href="{{ route('homepage.sections') }}"><span class="nav-sub-dot"></span>Sections</a>
          <a class="nav-sub-item" href="{{ route('all.hero.slides') }}"><span class="nav-sub-dot"></span>Hero Slides</a>
          <a class="nav-sub-item" href="{{ route('all.hero.stats') }}"><span class="nav-sub-dot"></span>Hero Stats</a>
          <a class="nav-sub-item" href="{{ route('all.about.pillars') }}"><span class="nav-sub-dot"></span>About Pillars</a>
          <a class="nav-sub-item" href="{{ route('all.amenities') }}"><span class="nav-sub-dot"></span>Amenities</a>
          <a class="nav-sub-item" href="{{ route('all.featured.amenities') }}"><span class="nav-sub-dot"></span>Featured Amenities</a>
          <a class="nav-sub-item" href="{{ route('all.dining.items') }}"><span class="nav-sub-dot"></span>Dining Items</a>
          <a class="nav-sub-item" href="{{ route('all.event.features') }}"><span class="nav-sub-dot"></span>Event Features</a>
          <a class="nav-sub-item" href="{{ route('all.hotel.info') }}"><span class="nav-sub-dot"></span>Hotel Info</a>
          <a class="nav-sub-item" href="{{ route('homepage.site.settings') }}"><span class="nav-sub-dot"></span>Site Settings</a>
        </div>
      </div>

      <a class="nav-item {{ request()->routeIs('all.facility.options','add.facility.option','edit.facility.option') ? 'active' : '' }}" href="{{ route('all.facility.options') }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
        <span class="nav-text">Facilities</span>
      </a>

      <div class="nav-group {{ request()->routeIs('blog.category','all.blog.post','add.blog.post','edit.blog.post') ? 'open' : '' }}" onclick="toggleGroup(this)">
        <div class="nav-group-toggle">
          <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          <span class="nav-text">Blog</span>
          <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </div>
        <div class="nav-group-children">
          <a class="nav-sub-item" href="{{ route('blog.category') }}"><span class="nav-sub-dot"></span>Categories</a>
          <a class="nav-sub-item" href="{{ route('all.blog.post') }}"><span class="nav-sub-dot"></span>All Posts</a>
          <a class="nav-sub-item" href="{{ route('add.blog.post') }}"><span class="nav-sub-dot"></span>Add Post</a>
        </div>
      </div>

      <div class="nav-label">Operations</div>

      @if(Auth::user()->can('team.menu'))
      <div class="nav-group {{ request()->routeIs('all.team','add.team') ? 'open' : '' }}" onclick="toggleGroup(this)">
        <div class="nav-group-toggle">
          <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          <span class="nav-text">Manage Teams</span>
          <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </div>
        <div class="nav-group-children">
          @if(Auth::user()->can('team.all'))<a class="nav-sub-item" href="{{ route('all.team') }}"><span class="nav-sub-dot"></span>All Teams</a>@endif
          @if(Auth::user()->can('team.add'))<a class="nav-sub-item" href="{{ route('add.team') }}"><span class="nav-sub-dot"></span>Add Team</a>@endif
        </div>
      </div>
      @endif

      <a class="nav-item {{ request()->routeIs('all.gallery') ? 'active' : '' }}" href="{{ route('all.gallery') }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="15" rx="2"/><polyline points="17 2 12 7 7 2"/></svg>
        <span class="nav-text">Hotel Gallery</span>
      </a>

      <a class="nav-item {{ request()->routeIs('all.testimonial','add.testimonial') ? 'active' : '' }}" href="{{ route('all.testimonial') }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <span class="nav-text">Testimonials</span>
      </a>

      <a class="nav-item {{ request()->routeIs('all.comment') ? 'active' : '' }}" href="{{ route('all.comment') }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
        <span class="nav-text">Contact Messages</span>
        @php $msgCount = App\Models\Contact::count() ?? 0; @endphp
        @if($msgCount > 0)<span class="nav-badge red">{{ $msgCount }}</span>@endif
      </a>

      @if(Auth::user()->can('bookarea.menu'))
      <a class="nav-item {{ request()->routeIs('book.area') ? 'active' : '' }}" href="{{ route('book.area') }}">
        <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M9 20H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H20a2 2 0 0 1 2 2v5"/><circle cx="17" cy="17" r="3"/><path d="M21 21l-1.5-1.5"/></svg>
        <span class="nav-text">Book Area</span>
      </a>
      @endif

      <div class="nav-label">System</div>

      <div class="nav-group {{ request()->routeIs('all.permission','all.roles','add.roles.permission','all.roles.permission') ? 'open' : '' }}" onclick="toggleGroup(this)">
        <div class="nav-group-toggle">
          <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <span class="nav-text">Roles &amp; Permissions</span>
          <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </div>
        <div class="nav-group-children">
          <a class="nav-sub-item" href="{{ route('all.permission') }}"><span class="nav-sub-dot"></span>All Permissions</a>
          <a class="nav-sub-item" href="{{ route('all.roles') }}"><span class="nav-sub-dot"></span>All Roles</a>
          <a class="nav-sub-item" href="{{ route('add.roles.permission') }}"><span class="nav-sub-dot"></span>Assign Permissions</a>
          <a class="nav-sub-item" href="{{ route('all.roles.permission') }}"><span class="nav-sub-dot"></span>View Assignments</a>
        </div>
      </div>

      <div class="nav-group {{ request()->routeIs('all.admin','add.admin') ? 'open' : '' }}" onclick="toggleGroup(this)">
        <div class="nav-group-toggle">
          <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <span class="nav-text">Admin Users</span>
          <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </div>
        <div class="nav-group-children">
          <a class="nav-sub-item" href="{{ route('all.admin') }}"><span class="nav-sub-dot"></span>All Admins</a>
          <a class="nav-sub-item" href="{{ route('add.admin') }}"><span class="nav-sub-dot"></span>Add Admin</a>
        </div>
      </div>

      <div class="nav-group {{ request()->routeIs('smtp.setting','site.setting') ? 'open' : '' }}" onclick="toggleGroup(this)">
        <div class="nav-group-toggle">
          <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 1 1-14.14 0"/></svg>
          <span class="nav-text">Settings</span>
          <svg class="nav-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
        </div>
        <div class="nav-group-children">
          <a class="nav-sub-item" href="{{ route('smtp.setting') }}"><span class="nav-sub-dot"></span>SMTP Settings</a>
          <a class="nav-sub-item" href="{{ route('site.setting') }}"><span class="nav-sub-dot"></span>Site Settings</a>
        </div>
      </div>

    </nav>

    <!-- User footer -->
    <div class="sidebar-footer">
      <div class="user-card">
        <div class="user-avatar">
          @if($sidebarPhoto)
            <img src="{{ $sidebarPhoto }}" alt="{{ $user->name }}">
          @else
            {{ $sidebarInitials }}
          @endif
        </div>
        <div style="flex:1;min-width:0;">
          <div class="user-name">{{ $user->name }}</div>
          <div class="user-role">{{ $user->getRoleNames()->first() ?? 'Administrator' }}</div>
        </div>
        <svg class="user-more" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="5" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="12" cy="19" r="1"/></svg>
      </div>
    </div>
  </aside>

  {{-- ══ MAIN ══ --}}
  <div class="main">

    {{-- ── HEADER ── --}}
    @php
      $profileData = App\Models\User::find(Auth::id());
      $headerInitials = collect(explode(' ', $profileData->name))->map(fn($w)=>strtoupper(substr($w,0,1)))->take(2)->join('');
      $headerPhoto = (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : null;
      $ncount = Auth::user()->unreadNotifications()->count();
    @endphp

    <header class="header">
      <div class="mobile-toggle" onclick="document.getElementById('sidebar').classList.toggle('open');document.getElementById('sidebarOverlay').classList.toggle('show');">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      </div>

      <div class="header-title">Lucerna <span>Hotel</span></div>

      <div class="search-wrap">
        <svg class="s-ico" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <input class="search-input" type="search" placeholder="Search guests, rooms…"/>
      </div>

      <div class="header-actions">

        {{-- Notifications --}}
        <div class="notif-dropdown" id="notifDropdown">
          <div class="icon-btn" onclick="toggleDropdown('notifDropdown')">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            @if($ncount > 0)<span class="badge-dot"></span>@endif
          </div>
          <div class="notif-panel">
            <div class="notif-header">
              <span class="notif-title">Notifications</span>
              @if($ncount > 0)<span class="notif-count" id="notification-count">{{ $ncount }} new</span>@endif
            </div>
            <div class="notif-list">
              @forelse(Auth::user()->notifications as $notif)
              <div class="notif-item" onclick="markNotificationAsRead('{{ $notif->id }}')">
                <div class="notif-icon">
                  <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 9h20M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z"/></svg>
                </div>
                <div style="flex:1;">
                  <div class="notif-msg"><strong>{{ $notif->data['message'] ?? 'New notification' }}</strong></div>
                  <div class="notif-time">{{ \Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</div>
                </div>
              </div>
              @empty
              <div style="padding:20px;text-align:center;color:var(--text-3);font-size:12.5px;">No notifications</div>
              @endforelse
            </div>
            <div class="notif-footer">
              <span class="notif-all-btn">
                View all
                <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </span>
            </div>
          </div>
        </div>

        {{-- Calendar shortcut --}}
        <a class="icon-btn" href="{{ route('booking.list') }}" title="Bookings">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </a>

        {{-- User menu --}}
        <div class="user-dropdown" id="userDropdown">
          <div class="header-avatar" onclick="toggleDropdown('userDropdown')">
            @if($headerPhoto)
              <img src="{{ $headerPhoto }}" alt="{{ $profileData->name }}">
            @else
              {{ $headerInitials }}
            @endif
          </div>
          <div class="user-dropdown-panel">
            <div style="padding:10px 12px 8px; border-bottom:1px solid var(--border3); margin-bottom:4px;">
              <div style="font-size:13px; font-weight:600; color:var(--text-1);">{{ $profileData->name }}</div>
              <div style="font-size:11px; color:var(--text-3); margin-top:1px;">{{ $profileData->email }}</div>
            </div>
            <a class="u-menu-item" href="{{ route('admin.profile') }}">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              My Profile
            </a>
            <a class="u-menu-item" href="{{ route('admin.change.password') }}">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              Change Password
            </a>
            <div class="u-menu-divider"></div>
            <a class="u-menu-item danger" href="{{ route('admin.logout') }}">
              <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
              Sign Out
            </a>
          </div>
        </div>

      </div>
    </header>

    {{-- ── PAGE CONTENT ── --}}
    <div class="page">
      @yield('admin')
    </div>

    {{-- ── FOOTER ── --}}
    <footer class="admin-footer">
      © {{ date('Y') }} <span>{{ config('app.name','Lucerna') }}</span> — All rights reserved.
      Crafted with care for luxury hospitality.
    </footer>

  </div>{{-- /main --}}
</div>{{-- /shell --}}

<div class="sidebar-overlay" id="sidebarOverlay"
     onclick="document.getElementById('sidebar').classList.remove('open');this.classList.remove('show');"></div>

{{-- ══ SCRIPTS ══ --}}
<script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('backend/assets/js/code.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
/* ── Toastr config ── */
toastr.options = {
  closeButton: true,
  progressBar: true,
  positionClass: 'toast-top-right',
  timeOut: 4000,
  extendedTimeOut: 1000,
};
@if(Session::has('message'))
(function(){
  var type = "{{ Session::get('alert-type','info') }}";
  var msg  = "{{ Session::get('message') }}";
  if(type==='success') toastr.success(msg);
  else if(type==='error')   toastr.error(msg);
  else if(type==='warning') toastr.warning(msg);
  else toastr.info(msg);
})();
@endif
</script>

{{-- DataTables --}}
<script src="{{asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script>
$(document).ready(function(){
  $('#example').DataTable({
    language: {
      search: '',
      searchPlaceholder: 'Search…',
      lengthMenu: 'Show _MENU_',
      info: 'Showing _START_–_END_ of _TOTAL_',
    }
  });
});
</script>

{{-- Summernote --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
$(document).ready(function(){
  $('.summernote').summernote({
    toolbar: [
      ['style', ['bold','italic','underline','clear']],
      ['font', ['strikethrough']],
      ['para', ['ul','ol','paragraph']],
      ['insert', ['link','picture']],
      ['view', ['fullscreen','codeview']]
    ],
    height: 200,
    callbacks: {
      onInit: function(){
        // match dark theme
        $('.note-editor').css({'border-color':'var(--border)','border-radius':'var(--radius-sm)'});
        $('.note-toolbar').css({'background':'var(--bg-card2)','border-color':'var(--border3)'});
        $('.note-editable').css({'background':'var(--bg-card2)','color':'var(--text-1)'});
      }
    }
  });
});
</script>

<script>
/* ── Nav group toggle ── */
function toggleGroup(el){ el.classList.toggle('open'); }

/* ── Dropdown toggle ── */
function toggleDropdown(id){
  var el = document.getElementById(id);
  var wasOpen = el.classList.contains('open');
  // close all
  document.querySelectorAll('.notif-dropdown,.user-dropdown').forEach(d=>d.classList.remove('open'));
  if(!wasOpen) el.classList.add('open');
}
document.addEventListener('click',function(e){
  if(!e.target.closest('.notif-dropdown') && !e.target.closest('.user-dropdown')){
    document.querySelectorAll('.notif-dropdown,.user-dropdown').forEach(d=>d.classList.remove('open'));
  }
});

/* ── Mark notification as read ── */
function markNotificationAsRead(id){
  fetch('/mark-notification-as-read/'+id,{
    method:'POST',
    headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
    body:JSON.stringify({})
  })
  .then(r=>r.json())
  .then(data=>{
    var el=document.getElementById('notification-count');
    if(el) el.textContent=data.count>0?data.count+' new':'';
  })
  .catch(err=>console.error('Notif error',err));
}
</script>

@stack('scripts')
</body>
</html>