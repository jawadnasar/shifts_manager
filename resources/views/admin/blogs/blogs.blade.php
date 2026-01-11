@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Blogs Start -->
    <div class="text-center rounded p-4">

        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Blogs</h6>
        </div>

        <!-- Top Action Row -->
        <div class="row row-on-table-top btns-right mb-3">
            <div class="col-lg-12 text-left">
                <a href="{{ route('blogs.add') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>&nbsp;Add Blog
                </a>
            </div>
        </div>

        <br>

        <!-- Table -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Filter -->
                <form id="blog_filter_form" class="p-3 bg-light rounded shadow-sm">
                    <div class="row g-3">
                        <div class="form-group col-md-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Blog title">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="subtitle" class="form-label">Subtitle</label>
                            <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Blog subtitle">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="author_name" class="form-label">Author</label>
                            <input type="text" class="form-control" name="author_name" id="author_name" placeholder="Author name">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">All</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="published_from" class="form-label">Published From</label>
                            <input type="date" class="form-control" name="published_from" id="published_from">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="published_to" class="form-label">Published To</label>
                            <input type="date" class="form-control" name="published_to" id="published_to">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-50 me-2">Search</button>
                            <button type="button" class="btn btn-secondary w-50" onclick="resetBlogFilters()">Reset</button>
                        </div>
                    </div>
                </form>

                <!-- Table Goes Here -->
                <div class="table-responsive">
                   <div id="blogs_table_container">
                        @include('admin.blogs.table')
                    </div>

                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- Blogs End -->

</div>
@endsection

@section('javascript')
    @include('admin.blogs.blogs-js')
@endsection
