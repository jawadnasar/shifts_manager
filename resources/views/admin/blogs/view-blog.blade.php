@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Blog Details</h4>
        <a href="{{ route('blogs.index') }}" class="btn btn-light btn-sm">← Back</a>
    </div>

    <div class="row">

        <!-- LEFT: BLOG DETAILS -->
        <div class="col-lg-8">

            <!-- TITLE -->
            <div class="mb-4">
                <label class="form-label fw-bold">Title</label>
                <p>{{ $blog->title }}</p>
            </div>

            <!-- SUBTITLE -->
            <div class="mb-4">
                <label class="form-label">Subtitle</label>
                <p>{{ $blog->subtitle ?? '-' }}</p>
            </div>

            <!-- CONTENT -->
            <div class="mb-4">
                <label class="form-label fw-bold">Content</label>
                <div class="border rounded p-3" style="background:#f8f9fa;">
                    {!! $blog->content !!}
                </div>
            </div>

            <!-- FEATURED IMAGE -->
            @if($blog->featured_image)
            <div class="mb-4">
                <label class="form-label">Featured Image</label>
                <div>
                    <img src="{{ asset('storage/blogs/' . $blog->featured_image) }}" 
                         alt="Featured Image" 
                         style="width:200px; height:auto; border-radius:4px;">
                </div>
            </div>
            @endif

            <!-- PUBLISH DATE -->
            <div class="mb-4">
                <label class="form-label">Published At</label>
                <p>{{ $blog->published_at ? $blog->published_at->format('d M Y H:i') : '-' }}</p>
            </div>

            <!-- AUTHOR -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Author Name</label>
                    <p>{{ $blog->author_name }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Author Position</label>
                    <p>{{ $blog->author_position ?? '-' }}</p>
                </div>
            </div>

        </div>

        <!-- RIGHT: STATUS UPDATE -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <h6 class="fw-bold mb-3">Update Status</h6>

                    <!-- Current Status -->
                    <p>
                        <strong>Current Status:</strong>
                        @if($blog->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </p>

                    <!-- Status Update Form -->
                   
                     <form id="change_status_form">
                            @csrf
                            <input type="hidden" name="id" value="{{ $blog->id }}">
                            <select class="form-select" name="status" id="is_active">
                                <option value="1" {{ $blog->is_active ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$blog->is_active ? 'selected' : '' }}>Inactive</option>
                            </select>
                    </form>

                    <hr>

                    <p class="small text-muted mb-0">
                        Tip: Use this section to quickly activate or deactivate the blog.
                    </p>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection


@section('javascript')
    @include('admin.blogs.view-blog-js')
@endsection
