@extends('frontend.main_master')
@section('title', $namecat->category_name . ' — ' . config('app.name'))
@section('styles')
    /* ── Blog Layout ── */
    .inner-banner { background:var(--navy); padding:140px 20px 48px; text-align:center; }
    .inner-banner h3 { font-family:var(--f-head); font-size:36px; font-weight:400; color:var(--white); margin-top:8px; }
    .inner-banner ul { list-style:none; display:flex; justify-content:center; gap:8px; font-size:13px; color:rgba(255,255,255,.6); }
    .inner-banner ul a { color:rgba(255,255,255,.7); text-decoration:none; }
    .blog-style-area { padding:60px 0 48px; }
    .blog-style-area .container { max-width:1280px; margin:0 auto; padding:0 20px; }
    .blog-style-area .row { display:flex; flex-wrap:wrap; gap:24px; }
    .blog-style-area > .container > .row > .col-lg-8 { flex:1 1 65%; min-width:0; }
    .blog-style-area > .container > .row > .col-lg-4 { flex:0 0 300px; }
    .col-lg-12 { width:100%; }
    .blog-card { border:1px solid #e8e8e8; border-radius:6px; overflow:hidden; margin-bottom:20px; }
    .blog-card .row { display:flex; flex-wrap:wrap; gap:0; }
    .blog-card .col-lg-5,.blog-card .col-md-4 { flex:0 0 40%; }
    .blog-card .col-lg-7,.blog-card .col-md-8 { flex:1 1 58%; }
    .p-0 { padding:0!important; }
    .blog-img img { width:100%; height:100%; object-fit:cover; display:block; }
    .blog-content { padding:20px; }
    .blog-content h3 { font-family:var(--f-head); font-size:22px; color:var(--navy); margin:8px 0; }
    .blog-content h3 a { color:inherit; text-decoration:none; }
    .blog-content h3 a:hover { color:var(--brand); }
    .blog-content span { font-size:12px; color:var(--mid); }
    .blog-content p { font-size:14px; color:var(--ink); line-height:1.7; margin:8px 0 12px; }
    .read-btn { font-size:13px; font-weight:600; color:var(--brand); text-decoration:none; }
    .read-btn:hover { text-decoration:underline; }
    .pagination-area { display:flex; gap:6px; justify-content:center; padding:20px 0; }
    .page-numbers { padding:8px 14px; border:1px solid #ddd; border-radius:4px; font-size:14px; color:var(--navy); text-decoration:none; }
    .page-numbers.current { background:var(--brand); color:var(--white); border-color:var(--brand); }
    .side-bar-wrap { display:flex; flex-direction:column; gap:24px; }
    .search-widget { background:var(--off-white); padding:16px; border-radius:4px; }
    .search-widget .search-form { display:flex; gap:8px; }
    .search-widget input[type="search"],.form-control { flex:1; font-family:var(--f-body); font-size:14px; padding:10px 14px; border:1.5px solid #dde2ea; border-radius:4px; outline:none; background:var(--white); width:100%; }
    .search-widget button { background:var(--brand); color:var(--white); border:none; padding:10px 14px; border-radius:4px; cursor:pointer; }
    .services-bar-widget,.side-bar-widget { background:var(--off-white); padding:20px; border-radius:4px; }
    .services-bar-widget .title,.side-bar-widget .title { font-family:var(--f-head); font-size:20px; color:var(--navy); margin-bottom:14px; font-weight:400; }
    .side-bar-categories ul { list-style:none; margin-bottom:4px; }
    .side-bar-categories a { font-size:14px; color:var(--brand); text-decoration:none; }
    .side-bar-categories a:hover { text-decoration:underline; }
    .widget-popular-post .item { display:flex; gap:12px; padding:10px 0; border-bottom:1px solid #e8e8e8; }
    .widget-popular-post .item:last-child { border-bottom:none; }
    .widget-popular-post .thumb img { width:72px; height:72px; object-fit:cover; border-radius:4px; }
    .widget-popular-post .info { min-width:0; }
    .widget-popular-post .title-text { font-size:14px; font-weight:600; margin:0 0 6px; }
    .widget-popular-post .title-text a { color:var(--navy); text-decoration:none; }
    .widget-popular-post .info ul { list-style:none; display:flex; gap:12px; font-size:12px; color:var(--mid); }
    @media(max-width:768px){
        .inner-banner { padding:120px 14px 36px; }
        .inner-banner h3 { font-size:26px; }
        .blog-style-area > .container > .row { flex-direction:column; }
        .blog-style-area > .container > .row > .col-lg-4 { flex:1 1 100%; }
        .blog-card .col-lg-5,.blog-card .col-md-4 { flex:1 1 100%; }
        .blog-card .col-lg-7,.blog-card .col-md-8 { flex:1 1 100%; }
    }
    @media(max-width:480px){
        .inner-banner { padding:100px 10px 28px; }
        .inner-banner h3 { font-size:22px; }
    }
@endsection
@section('main')

    <!-- Inner Banner -->
    <div class="inner-banner inner-bg4">
        <div class="container">
            <div class="inner-title">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>{{ $namecat->category_name }}</li>
                </ul>
                <h3>{{ $namecat->category_name }}</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Blog Style Area -->
    <div class="blog-style-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    
                    @foreach ($blog as $item ) 
                   
                    <div class="col-lg-12">
                        <div class="blog-card">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-4 p-0">
                                    <div class="blog-img">
                                        <a href="{{ url('blog/details/'.$item->post_slug) }}">
                                            <img src="{{ asset($item->post_image) }}" alt="Images">
                                        </a>
                                    </div>
                                </div>

                <div class="col-lg-7 col-md-8 p-0">
                    <div class="blog-content">
                <span>{{ $item->created_at->format('M d Y')  }}</span>
                        <h3>
                            <a href="{{ url('blog/details/'.$item->post_slug) }}">{{ $item->post_titile }}</a>
                        </h3>
                        <p>{{ $item->short_descp }}</p>
                        <a href="{{ url('blog/details/'.$item->post_slug) }}" class="read-btn">
                            Read More
                        </a>
                    </div>
                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                

                    <div class="col-lg-12 col-md-12">
                        <div class="pagination-area">
                            <a href="#" class="prev page-numbers">
                                <i class='bx bx-chevrons-left'></i>
                            </a>

                            <span class="page-numbers current" aria-current="page">1</span>
                            <a href="#" class="page-numbers">2</a>
                            <a href="#" class="page-numbers">3</a>
                            
                            <a href="#" class="next page-numbers">
                                <i class='bx bx-chevrons-right'></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="side-bar-wrap">
                        <div class="search-widget">
                            <form class="search-form">
                                <input type="search" class="form-control" placeholder="Search...">
                                <button type="submit">
                                    <i class="bx bx-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="services-bar-widget">
                            <h3 class="title">Blog Category</h3>
                            <div class="side-bar-categories">
                                @foreach ($bcategory as $cat) 
                                <ul>
                                    <li>
                                        <a href="{{ url('blog/cat/list/'.$cat->id) }}">{{ $cat->category_name }}</a>
                                    </li> 
                                </ul>
                                @endforeach
                            </div>
                        </div>
                        <div class="side-bar-widget">
                            <h3 class="title">Recent Posts</h3>
                            <div class="widget-popular-post">
                                @foreach ($lpost as $post)   
                            <article class="item">
                                <a href="blog-details.html" class="thumb">
                <img src="{{ asset($post->post_image) }}" alt="Images" style="width: 80px; height:80px;">      
                                </a>
                                <div class="info">
                                    <h4 class="title-text">
                                        <a href="blog-details.html">
                                            {{ $post->post_titile }}
                                        </a>
                                    </h4>
                                    <ul>
                                        <li>
                                            <i class='bx bx-user'></i>
                                            29K
                                        </li>
                                        <li>
                                            <i class='bx bx-message-square-detail'></i>
                                            15K
                                        </li>
                                    </ul>
                                </div>
                            </article>
                            @endforeach

                                
                            </div>
                        </div>

                     
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Style Area End -->





@endsection