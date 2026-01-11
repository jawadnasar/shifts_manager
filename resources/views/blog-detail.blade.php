@extends('layouts.app')

@section('title', $blog->title . ' | Our Blog')

@section('content')

<style>
  
   .blog-hero {
        position: relative;
        min-height: 30vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.4); /* subtle overlay */
        color: #fff;
        margin-bottom: 50px;
        border-radius: 12px;
    }
    .blog-hero h1 {
        font-size: 2.8rem;
        font-weight: 700;
        text-align: center;
        z-index: 2;
    }

    /* Sidebar */
    .sidebar-widget {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .sidebar-widget h5 {
        font-weight: 700;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
    .sidebar-widget ul li a {
        display: block;
        padding: 6px 0;
        color: #333;
        transition: 0.2s;
    }
    .sidebar-widget ul li a:hover {
        color: #007bff;
        padding-left: 5px;
    }
    .recent-post img {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }
</style>

<!-- Hero Section -->
<section class="blog-hero">
    <h1>{{ $blog->title }}</h1>
</section>

<div class="container mb-5">
    <div class="row">
        <!-- Blog Content -->
        <div class="col-lg-8">
            <div class="card mb-4 blog-card shadow-sm">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="card-body blog-card-body">
                            @if($blog->subtitle)
                                <h5 class="mb-1">{{ $blog->subtitle }}</h5>
                            @endif
                            <p class="text-bold">{!! $blog->content !!}</p>
                            <small class="text-muted">Published on {{ $blog->published_at ? $blog->published_at->format('F d, Y') : 'Not Published' }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Recent Posts -->
            <div class="sidebar-widget">
                <h5>Recent Posts</h5>
                @foreach($recentBlogs as $recent)
                <div class="d-flex mb-3 recent-post">
                    <a href="{{ route('blog.detail', $recent->slug) }}">
                        <img src="{{ $recent->featured_image ? asset('storage/blogs/' . $recent->featured_image) : asset('front-theme/images/default-blog.png') }}" alt="{{ $recent->title }}">
                    </a>
                    <div class="ms-2">
                        <a href="{{ route('blog.detail', $recent->slug) }}" class="text-decoration-none text-dark">
                            {{ \Illuminate\Support\Str::limit($recent->title, 50) }}
                        </a>
                        <br>
                        <small class="text-muted">{{ $recent->published_at ? $recent->published_at->format('M d, Y') : '' }}</small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('.detail-box').html(`
        <h1>
            Blog Detail<br>
            <span>Latest Security Insights</span>
        </h1>
        <p>
            Stay informed with expert articles, industry updates, security tips 
            and news from our UK-based security specialists.
        </p>
        <div class="btn-box">
            <a href="{{ route('blog') }}" class="btn-1">Blogs</a>
            <a href="{{ route('contact') }}" class="btn-2">Get in Touch</a>
        </div>
    `);
});
</script>
@endsection
