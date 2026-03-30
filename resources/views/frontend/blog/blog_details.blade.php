@extends('frontend.main_master')
@section('title', $blog->post_titile . ' — ' . config('app.name'))
@section('styles')
    /* ── Blog Details Layout ── */
    .inner-banner { background:var(--navy); padding:140px 20px 48px; text-align:center; }
    .inner-banner h3 { font-family:var(--f-head); font-size:36px; font-weight:400; color:var(--white); margin-top:8px; }
    .inner-banner ul { list-style:none; display:flex; justify-content:center; gap:8px; font-size:13px; color:rgba(255,255,255,.6); }
    .inner-banner ul a { color:rgba(255,255,255,.7); text-decoration:none; }
    .inner-banner ul a:hover { color:var(--white); }
    .blog-details-area { padding:60px 0 48px; }
    .blog-details-area .container { max-width:1280px; margin:0 auto; padding:0 20px; }
    .blog-details-area .row { display:flex; flex-wrap:wrap; gap:32px; }
    .blog-details-area .col-lg-8 { flex:1 1 65%; min-width:0; }
    .blog-details-area .col-lg-4 { flex:0 0 300px; }
    .blog-article-img img { width:100%; height:auto; border-radius:4px; }
    .blog-article-title h2 { font-family:var(--f-head); font-size:30px; font-weight:400; color:var(--navy); margin:24px 0 12px; }
    .blog-article-title ul { list-style:none; display:flex; gap:16px; font-size:13px; color:var(--mid); margin-bottom:24px; }
    .blog-article-title ul i { margin-right:4px; }
    .article-content { font-family:var(--f-body); font-size:15px; line-height:1.8; color:var(--ink); }
    .article-content p { margin-bottom:16px; }
    .article-content img { max-width:100%; height:auto; }
    .comments-wrap { margin-top:40px; padding-top:28px; border-top:1px solid #e2e8f0; }
    .comments-wrap .title,.comments-form h2 { font-family:var(--f-head); font-size:24px; font-weight:400; color:var(--navy); margin-bottom:20px; }
    .comments-wrap ul { list-style:none; }
    .comments-wrap li { display:flex; gap:14px; padding:16px 0; border-bottom:1px solid #f0f0f0; }
    .comments-wrap li img { width:44px; height:44px; border-radius:50%; object-fit:cover; flex-shrink:0; }
    .comments-wrap li h3 { font-size:15px; font-weight:600; color:var(--navy); margin:0 0 2px; }
    .comments-wrap li span { font-size:12px; color:var(--mid); display:block; margin-bottom:6px; }
    .comments-wrap li p { font-size:14px; line-height:1.6; color:var(--ink); margin:0; }
    .comments-form { margin-top:32px; }
    .comments-form textarea { width:100%; font-family:var(--f-body); font-size:15px; padding:12px 16px; border:1.5px solid #dde2ea; border-radius:4px; background:var(--off-white); color:var(--ink); outline:none; resize:vertical; min-height:120px; transition:border-color .2s; }
    .comments-form textarea:focus { border-color:var(--brand); box-shadow:0 0 0 3px rgba(12,77,162,.08); }
    .comments-form button[type="submit"],.default-btn { background:var(--brand); color:var(--white); border:none; padding:12px 28px; font-family:var(--f-body); font-size:13px; font-weight:600; letter-spacing:.1em; text-transform:uppercase; border-radius:4px; cursor:pointer; margin-top:10px; transition:all .25s; }
    .comments-form button[type="submit"]:hover,.default-btn:hover { background:var(--brand-dark); transform:translateY(-1px); box-shadow:0 4px 16px rgba(3,78,162,.25); }
    .side-bar-wrap { display:flex; flex-direction:column; gap:24px; }
    .search-widget { background:var(--off-white); padding:16px; border-radius:4px; }
    .search-widget .search-form { display:flex; gap:8px; }
    .search-widget input[type="search"] { flex:1; font-family:var(--f-body); font-size:14px; padding:10px 14px; border:1.5px solid #dde2ea; border-radius:4px; outline:none; background:var(--white); }
    .search-widget button { background:var(--brand); color:var(--white); border:none; padding:10px 14px; border-radius:4px; cursor:pointer; }
    .services-bar-widget,.side-bar-widget { background:var(--off-white); padding:20px; border-radius:4px; }
    .services-bar-widget .title,.side-bar-widget .title { font-family:var(--f-head); font-size:20px; color:var(--navy); margin-bottom:14px; font-weight:400; }
    .side-bar-categories ul { list-style:none; margin-bottom:4px; }
    .side-bar-categories a { font-size:14px; color:var(--brand); text-decoration:none; }
    .side-bar-categories a:hover { text-decoration:underline; }
    .widget-popular-post .item { display:flex; gap:12px; padding:10px 0; border-bottom:1px solid #e8e8e8; }
    .widget-popular-post .item:last-child { border-bottom:none; }
    .widget-popular-post .thumb img { width:72px; height:72px; object-fit:cover; border-radius:4px; flex-shrink:0; }
    .widget-popular-post .info { min-width:0; }
    .widget-popular-post .title-text { font-size:14px; font-weight:600; margin:0 0 6px; }
    .widget-popular-post .title-text a { color:var(--navy); text-decoration:none; }
    .widget-popular-post .title-text a:hover { color:var(--brand); }
    .widget-popular-post .info ul { list-style:none; display:flex; gap:12px; font-size:12px; color:var(--mid); }
    @media(max-width:768px){
        .inner-banner { padding:120px 14px 36px; }
        .inner-banner h3 { font-size:26px; }
        .blog-details-area .row { flex-direction:column; }
        .blog-details-area .col-lg-4 { flex:1 1 100%; }
    }
    @media(max-width:480px){
        .inner-banner { padding:100px 10px 28px; }
        .inner-banner h3 { font-size:22px; }
        .blog-details-area { padding:36px 0 28px; }
        .blog-article-title h2 { font-size:24px; }
    }
@endsection
@section('main')
 <!-- Inner Banner -->
 <div class="inner-banner inner-bg3">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>Blog Details </li>
            </ul>
            <h3>{{ $blog->post_titile }}</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Blog Details Area -->
<div class="blog-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-article">
                    <div class="blog-article-img">
                        <img src="{{ asset($blog->post_image) }}" alt="Images" style="width:100%; height:auto; max-width:1000px; border-radius:4px;">
                    </div>

                    <div class="blog-article-title">
                        <h2>{{ $blog->post_titile }}</h2>
                        <ul>
                            
                            <li>
                                <i class='bx bx-user'></i>
                                {{ $blog['user']['name'] }}
                            </li>

                            <li>
                                <i class='bx bx-calendar'></i>
                                {{ $blog->created_at->format('M d Y')  }}
                            </li>
                        </ul>
                    </div>
                    
                    <div class="article-content">
                        <p>
                            {!! $blog->long_descp !!}
                        </p>
                    </div>
@php
    $comment = App\Models\Comment::where('post_id',$blog->id)->where('status','1')->limit(5)->get();
@endphp
                    <div class="comments-wrap">
                        <h3 class="title">Comments</h3>
                        <ul>
                            @foreach ($comment as $com) 
                            <li>
                                <img src="{{ (!empty($com->user->photo)) ? url('upload/user_images/'.$com->user->photo) : url('upload/no_image.jpg') }}" alt="Image" style="width: 50px; height:50px;">
                                <h3>{{ $com->user->name }}</h3>
                                <span>{{ $com->created_at->format('M d Y') }}</span>
                                <p>
                                    {{ $com->message }}
                                </p>
                                 
                            </li>
                            @endforeach
                            
                        </ul>
                    </div>

                    <div class="comments-form">
                        <div class="contact-form">
      
                            <h2>Leave A Comment</h2>
    @php 
        if (Auth::check()) {
           $id = Auth::user()->id;
           $userData = App\Models\User::find($id);
        }else {
            $userData = null;
        }
    @endphp

    @auth            
    <form method="POST" action="{{ route('store.comment') }}" >
        @csrf

        <div class="row">
             
            <input type="hidden" name="post_id" value="{{ $blog->id }}">

            @if ($userData)
                <input type="hidden" name="user_id" value="{{ $userData->id }}">
            @endif


            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <textarea name="message" class="form-control" id="message" cols="30" rows="8" required data-error="Write your message" placeholder="Your Message"></textarea>
                </div>
            </div>

            
            <div class="col-lg-12 col-md-12">
                <button type="submit" class="default-btn btn-bg-three">
                    Post A Comment
                </button>
            </div>
        </div>
    </form>

    @else

    <p>Plz <a href="{{ route('login') }}">Login</a> First for Add Comment </p>

    @endauth   
                        </div>
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
<!-- Blog Details Area End -->

@endsection