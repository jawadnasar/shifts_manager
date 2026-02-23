@extends('layouts.app')


@section('content')
@section('title', 'Security Insights & Industry Updates | TRK Protectors UK')

@section('meta_description', 'Explore the TRK Protectors blog for the latest security insights, industry updates, safety tips, and professional advice on event security, door supervision, mobile patrols, and site protection services across the UK.')

<link href="{{ asset('front-theme/css/blog.css') }}" rel="stylesheet" />

<!-- Hero Section -->
<section class="blog-hero">
    <h1>Our Insights & Updates</h1>
</section>

<div class="container mb-5">
    <div class="row">
        <!-- Blog Posts -->
        <div class="col-lg-8">
            @foreach($blogs as $blog)
            <div class="card mb-4 blog-card shadow-sm">
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="{{ route('blog.detail', $blog->slug) }}">
                            <img src="{{ $blog->featured_image ? asset('storage/blogs/' . $blog->featured_image) : asset('front-theme/images/default-blog.png') }}" class="img-fluid w-100" alt="{{ $blog->title }}">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body blog-card-body">
                            <h5>{{ $blog->title }}</h5>
                            @if($blog->subtitle)
                                <h6>{{ $blog->subtitle }}</h6>
                            @endif
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 150) }}</p>
                            <small class="text-muted">Published on {{ $blog->published_at ? $blog->published_at->format('F d, Y') : 'Not Published' }}</small>
                            <br>
                            <a href="{{ route('blog.detail', $blog->slug) }}" class="btn btn-sm btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Pagination -->
            <div class="mt-4">
                {{ $blogs->links('pagination::bootstrap-5') }}
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

            <!-- Categories -->
           
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('.detail-box').html(`
        <h1>
            Company Blog <br>
            <span>Latest Security Insights</span>
        </h1>
        <p>
            Stay informed with expert articles, industry updates, security tips 
            and news from our UK-based security specialists.
        </p>
        <div class="btn-box">
            <a href="{{ route('services') }}" class="btn-1">Our Services</a>
            <a href="{{ route('contact') }}" class="btn-2">Get in Touch</a>
        </div>
    `);
});
</script>
@endsection
