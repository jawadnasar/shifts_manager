@extends('layouts.app')

@section('title', $blog->title . ' | Our Blog')



@section('content')

<link href="{{ asset('front-theme/css/blog.css') }}" rel="stylesheet" />
<style>
    .object-fit-cover {
    object-fit: cover;
}

.blog-content p {
    margin-bottom: 1rem;
    line-height: 1.7;
}

.blog-card-body {
    padding: 25px;
}

.blog-detail-image {
    width: 100%;
    height: 350px; /* Fixed clean height */
    overflow: hidden;
    border-radius: 10px 0 0 10px;
}

.blog-detail-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
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

                    <!-- Image Left (Same as listing page) -->
                    <div class="blog-detail-image">
                        <img src="{{ $blog->featured_image ? asset('storage/blogs/' . $blog->featured_image) : asset('front-theme/images/default-blog.png') }}"
                            alt="{{ $blog->title }}">
                    </div>

                    <!-- Content Right -->
                    <div class="col-md-7">
                        <div class="card-body blog-card-body">
                            
                            @if($blog->subtitle)
                                <h6 class="text-muted">{{ $blog->subtitle }}</h6>
                            @endif

                            <div class="blog-content mt-3">
                                {!! $blog->content !!}
                            </div>

                            <hr>

                            <small class="text-muted">
                                Published on {{ $blog->published_at ? $blog->published_at->format('F d, Y') : 'Not Published' }}
                            </small>

                            <br><br>

                            <a href="{{ route('blog') }}" class="btn btn-sm btn-primary">
                                ← Back to Blogs
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sidebar-widget">
                <h5>Recent Posts</h5>
                @foreach($recentBlogs as $recent)
                <div class="d-flex mb-3 recent-post">
                    <a href="{{ route('blog.detail', $recent->slug) }}">
                        <img src="{{ $recent->featured_image ? asset('storage/blogs/' . $recent->featured_image) : asset('front-theme/images/default-blog.png') }}"
                             alt="{{ $recent->title }}">
                    </a>
                    <div class="ms-2">
                        <a href="{{ route('blog.detail', $recent->slug) }}"
                           class="text-decoration-none text-dark">
                            {{ \Illuminate\Support\Str::limit($recent->title, 50) }}
                        </a>
                        <br>
                        <small class="text-muted">
                            {{ $recent->published_at ? $recent->published_at->format('M d, Y') : '' }}
                        </small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection