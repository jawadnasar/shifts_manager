@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Add New Blog</h4>
        <a href="{{ route('blogs.index') }}" class="btn btn-light btn-sm">
            ← Back
        </a>
    </div>

    <form id="blogForm" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row create_blog mb-10">

            <!-- LEFT: BLOG FORM -->
            <div class="col-lg-8">

                <!-- TITLE -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Title *</label>
                    <input type="text"
                           name="title"
                           class="form-control form-control-lg"
                           placeholder="Enter blog title"
                           >
                </div>

                <!-- SUBTITLE -->
                <div class="mb-4">
                    <label class="form-label">Subtitle</label>
                    <input type="text"
                           name="subtitle"
                           class="form-control"
                           placeholder="Optional subtitle">
                </div>

                <!-- CONTENT -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Content *</label>
                    <textarea name="content" rows="15"
                              class="summernote d-block w-100"
                              ></textarea>
                </div>

                <!-- FEATURED IMAGE -->
                <div class="mb-4">
                    <label class="form-label">Featured Image</label>
                    <input type="file"
                           name="featured_image"
                           class="form-control"
                           accept="image/*">
                </div>

                <!-- PUBLISH DATE -->
                <div class="mb-4">
                    <label class="form-label">Publish At</label>
                    <input type="datetime-local"
                           name="published_at"
                           class="form-control">
                </div>

                <!-- AUTHOR -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Author Name *</label>
                        <input type="text"
                               name="author_name"
                               class="form-control"
                               placeholder="Author name"
                               >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Author Position</label>
                        <input type="text"
                               name="author_position"
                               class="form-control"
                               placeholder="e.g. Editor, Content Writer">
                    </div>
                </div>

                <!-- ACTION -->
                <div class="text-end">
                    <button type="submit" name="action" value="publish" class="btn btn-primary px-4">
                       Submit
                    </button>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>


            </div>

            <!-- RIGHT: WRITING GUIDE -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Writing Guide</h6>

                        <ul class="small text-muted ps-3">
                            <li>Keep the title clear and descriptive</li>
                            <li>Use subtitle to add context</li>
                            <li>Break content into short paragraphs</li>
                            <li>Use headings for readability</li>
                            <li>Minimum recommended length: 600 words</li>
                            <li>Upload high-quality featured image</li>
                            <li>Set publish date if scheduling</li>
                        </ul>

                        <hr>

                        <p class="small text-muted mb-0">
                            Tip: Write for humans first, search engines second.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection

@section('javascript')
    @include('admin.blogs.add-blog-js')
@endsection
