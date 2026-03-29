<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{asset('backend/assets/images/favicon-32x32.png')}}" type="image/png"/>
	<link rel="preconnect" href="https://fonts.googleapis.com"/>
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
	<!-- Bootstrap (for inner pages compatibility) -->
	<link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
	<title>{{ config('app.name') }} — Admin</title>
	<style>
		*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
		:root{
			--bg-deep:#090d17;--bg-base:#0e1422;--bg-card:#131928;--bg-card2:#192033;--bg-hover:#1e2840;
			--gold:#c9a84c;--gold-light:#e4c97a;--gold-dim:#8a6e2e;--gold-bg:rgba(201,168,76,.08);
			--border:rgba(201,168,76,.12);--border2:rgba(255,255,255,.06);
			--text-1:#f0ead8;--text-2:#9ea8be;--text-3:#5b6478;
			--danger:#e05252;--success:#4caf7d;--info:#4b8ef5;--warning:#e89b3a;
			--sidebar-w:260px;--header-h:68px;--radius:14px;--radius-sm:8px;
			--font-display:'Cormorant Garamond',Georgia,serif;
			--font-ui:'Plus Jakarta Sans',system-ui,sans-serif;
			--transition:.22s cubic-bezier(.4,0,.2,1);
		}
		html,body{height:100%;font-family:var(--font-ui);background:var(--bg-deep);color:var(--text-1);font-size:14px;line-height:1.6;}
		::-webkit-scrollbar{width:5px;}::-webkit-scrollbar-track{background:transparent;}::-webkit-scrollbar-thumb{background:var(--border);border-radius:4px;}
		a{color:inherit;text-decoration:none;}
		.shell{display:flex;min-height:100vh;}

		/* ── Sidebar ── */
		.sidebar{width:var(--sidebar-w);background:var(--bg-base);border-right:1px solid var(--border);display:flex;flex-direction:column;position:fixed;top:0;left:0;bottom:0;z-index:100;overflow-y:auto;transition:transform var(--transition);}
		.sidebar-brand{padding:28px 24px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:12px;}
		.brand-icon{width:38px;height:38px;background:var(--gold-bg);border:1px solid var(--border);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--gold);font-size:18px;flex-shrink:0;}
		.brand-name{font-family:var(--font-display);font-size:20px;font-weight:600;color:var(--text-1);letter-spacing:.3px;}
		.brand-sub{font-size:10px;color:var(--gold);letter-spacing:2px;text-transform:uppercase;font-weight:500;margin-top:-2px;}
		.nav-section{padding:16px 12px 0;}
		.nav-label{font-size:10px;letter-spacing:1.5px;text-transform:uppercase;color:var(--text-3);font-weight:600;padding:0 12px;margin-bottom:6px;margin-top:14px;}
		.nav-item{display:flex;align-items:center;gap:11px;padding:10px 12px;border-radius:var(--radius-sm);color:var(--text-2);cursor:pointer;transition:background var(--transition),color var(--transition);position:relative;text-decoration:none;}
		.nav-item:hover{background:var(--bg-hover);color:var(--text-1);}
		.nav-item.active{background:var(--gold-bg);color:var(--gold);border:1px solid var(--border);}
		.nav-item.active .nav-icon{color:var(--gold);}
		.nav-icon{width:18px;height:18px;flex-shrink:0;opacity:.8;}
		.nav-item.active .nav-icon{opacity:1;}
		.nav-text{font-size:13.5px;font-weight:500;}
		.nav-badge{margin-left:auto;background:var(--gold);color:var(--bg-deep);font-size:10px;font-weight:600;padding:1px 7px;border-radius:20px;min-width:20px;text-align:center;}
		.nav-badge.red{background:var(--danger);color:#fff;}
		.nav-group{margin-bottom:2px;}
		.nav-group-toggle{display:flex;align-items:center;gap:11px;padding:10px 12px;border-radius:var(--radius-sm);color:var(--text-2);cursor:pointer;transition:background var(--transition),color var(--transition);user-select:none;}
		.nav-group-toggle:hover{background:var(--bg-hover);color:var(--text-1);}
		.nav-group-children{padding-left:16px;overflow:hidden;max-height:0;transition:max-height .3s ease;}
		.nav-group.open .nav-group-children{max-height:300px;}
		.nav-chevron{margin-left:auto;transition:transform .25s;width:14px;height:14px;color:var(--text-3);}
		.nav-group.open .nav-chevron{transform:rotate(90deg);}
		.sidebar-footer{margin-top:auto;padding:16px 12px;border-top:1px solid var(--border);}
		.user-card{display:flex;align-items:center;gap:10px;padding:10px;border-radius:var(--radius-sm);cursor:pointer;transition:background var(--transition);}
		.user-card:hover{background:var(--bg-hover);}
		.user-avatar{width:36px;height:36px;border-radius:50%;background:var(--gold-bg);border:1.5px solid var(--gold-dim);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;color:var(--gold);flex-shrink:0;overflow:hidden;}
		.user-avatar img{width:100%;height:100%;object-fit:cover;border-radius:50%;}
		.user-name{font-size:13px;font-weight:600;color:var(--text-1);}
		.user-role{font-size:11px;color:var(--text-3);}

		/* ── Main ── */
		.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh;}

		/* ── Header ── */
		.header{height:var(--header-h);background:var(--bg-base);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 28px;gap:16px;position:sticky;top:0;z-index:90;}
		.header-title{font-family:var(--font-display);font-size:22px;font-weight:500;color:var(--text-1);flex:1;}
		.header-title span{color:var(--gold);}
		.search-wrap{position:relative;display:flex;align-items:center;}
		.search-wrap svg{position:absolute;left:12px;color:var(--text-3);pointer-events:none;}
		.search-input{background:var(--bg-card);border:1px solid var(--border2);border-radius:20px;padding:8px 16px 8px 36px;color:var(--text-1);font-family:var(--font-ui);font-size:13px;width:220px;outline:none;transition:border var(--transition),width var(--transition);}
		.search-input::placeholder{color:var(--text-3);}
		.search-input:focus{border-color:var(--gold-dim);width:270px;}
		.header-actions{display:flex;align-items:center;gap:8px;}
		.icon-btn{width:38px;height:38px;background:var(--bg-card);border:1px solid var(--border2);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--text-2);cursor:pointer;transition:background var(--transition),color var(--transition),border var(--transition);position:relative;text-decoration:none;}
		.icon-btn:hover{background:var(--bg-hover);color:var(--gold);border-color:var(--border);}
		.badge-dot{position:absolute;top:7px;right:7px;width:7px;height:7px;background:var(--danger);border:1.5px solid var(--bg-base);border-radius:50%;}
		.header-avatar{width:38px;height:38px;border-radius:50%;background:var(--gold-bg);border:1.5px solid var(--gold-dim);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;color:var(--gold);cursor:pointer;transition:border-color var(--transition);overflow:hidden;}
		.header-avatar:hover{border-color:var(--gold);}
		.header-avatar img{width:100%;height:100%;object-fit:cover;border-radius:50%;}

		/* ── Page ── */
		.page{padding:28px;flex:1;background:linear-gradient(139deg,#0c62c3 14.24%,#034ea2 75.61%);
			--bg-card:rgba(255,255,255,.1);--bg-card2:rgba(255,255,255,.06);--bg-hover:rgba(255,255,255,.08);
			--bg-deep:rgba(0,0,0,.15);--border:rgba(255,255,255,.15);--border2:rgba(255,255,255,.1);
			--text-1:#fff;--text-2:rgba(255,255,255,.75);--text-3:rgba(255,255,255,.5);
			--gold-bg:rgba(201,168,76,.15);
		}

		/* ── Bootstrap dark overrides for inner pages ── */
		.page .card{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);border-radius:var(--radius);color:#fff;backdrop-filter:blur(6px);}
		.page .card-header{background:rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.1);color:#fff;}
		.page .card-body{color:rgba(255,255,255,.85);}
		.page .table{color:rgba(255,255,255,.85);--bs-table-bg:transparent;--bs-table-striped-bg:rgba(255,255,255,.04);--bs-table-hover-bg:rgba(255,255,255,.08);}
		.page .table th{color:rgba(255,255,255,.55);border-color:rgba(255,255,255,.1);font-size:11px;letter-spacing:.5px;text-transform:uppercase;}
		.page .table td{border-color:rgba(255,255,255,.06);vertical-align:middle;}
		.page .form-control,.page .form-select{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.18);color:#fff;border-radius:var(--radius-sm);}
		.page .form-control:focus,.page .form-select:focus{background:rgba(255,255,255,.15);border-color:var(--gold);box-shadow:0 0 0 3px rgba(201,168,76,.2);color:#fff;}
		.page .form-control::placeholder{color:rgba(255,255,255,.4);}
		.page .form-label,.page label{color:rgba(255,255,255,.75);}
		.page .btn-info{background:var(--info);border-color:var(--info);}
		.page .btn-danger{background:var(--danger);border-color:var(--danger);}
		.page .btn-success{background:var(--success);border-color:var(--success);}
		.page .btn-warning{background:var(--warning);border-color:var(--warning);color:var(--bg-deep);}
		.page .text-secondary{color:rgba(255,255,255,.5)!important;}
		.page .page-content{padding:0;}
		.page h4,.page h5,.page h6{color:#fff;}
		.page .badge{font-weight:600;}
		.page .breadcrumb{background:transparent;}
		.page a:not(.btn):not(.add-btn):not(.nav-link):not(.dropdown-item){color:var(--gold);}
		.page a:not(.btn):not(.add-btn):not(.nav-link):not(.dropdown-item):hover{color:var(--gold-light);}
		.page .btn-primary{background:var(--gold);border-color:var(--gold);color:#042a5e;font-weight:600;}
		.page .btn-primary:hover{background:var(--gold-light);border-color:var(--gold-light);color:#042a5e;}
		.page .add-btn{color:#042a5e;}
		.page .add-btn:hover{color:#042a5e;}
		.dropdown-menu{background:var(--bg-card)!important;border:1px solid var(--border)!important;}
		.dropdown-item{color:var(--text-2)!important;}
		.dropdown-item:hover,.dropdown-item:focus{background:var(--bg-hover)!important;color:var(--text-1)!important;}

		/* ── Mobile Footer ── */
		.admin-footer{padding:16px 28px;border-top:1px solid rgba(255,255,255,.1);text-align:center;font-size:12px;color:rgba(255,255,255,.45);background:transparent;}

		/* ── Responsive ── */
		@media(max-width:1280px){.sidebar{width:240px;}.main{margin-left:240px;}}
		@media(max-width:900px){
			.sidebar{transform:translateX(-100%);position:fixed;z-index:200;width:260px;}
			.sidebar.open{transform:translateX(0);}
			.main{margin-left:0;}
			.mobile-toggle{display:flex!important;}
		}
		.mobile-toggle{display:none;cursor:pointer;color:var(--text-2);}
		.sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:150;}
		.sidebar-overlay.show{display:block;}
	</style>
	@stack('styles')
</head>
<body>
<div class="shell">
	@include('admin.body.sidebar')
	<div class="main">
		@include('admin.body.header')
		<div class="page">
			@yield('admin')
		</div>
		@include('admin.body.footer')
	</div>
</div>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="document.querySelector('.sidebar').classList.remove('open');this.classList.remove('show');"></div>

<script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('backend/assets/js/code.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break;
 }
 @endif
</script>

<script>
/* Sidebar nav group toggle */
function toggleGroup(el) { el.classList.toggle('open'); }
</script>

<!--datatable JS-->
<script src="{{asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
<!--datatable JS-->

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>

@stack('scripts')
</body>

</html>
