@extends('layouts.app')

@section('content')

@section('title', 'Blog') <!-- Set the title for this page -->

<section class="sponsors-section py-5">
  <div class="container text-center">
    <!-- Title -->
    <div class="heading_container heading_center">
        <h2>
          Blog
        </h2>
        
      </div>
  </div>
</section>

  <div class="container mt-5">
        <div class="row mb-4 single-blog-card">
            <div class="col-12">
                <a href="{{ route('reception-security-detail')}}" class="text-decoration-none">
                    <div class="card border-0 shadow-lg">
                        <div class="row g-0">
                            <!-- Left Column (Image or Icon) -->
                            <div class="col-md-4">
                                <img src="{{ asset('front-theme/images/concierge.png') }}" class="img-fluid rounded-start" alt="Door Security">
                            </div>
                            <!-- Right Column (Text Content) -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-dark blog_category_title">Reception</h5>
                                    <p class="card-text text-dark"> TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore...</p>
                                    <p class="card-text">
                                        <small class="text-muted">Published on August 7, 2023</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mb-4 single-blog-card">
            <div class="col-12">
                <a href="{{ route('site-security-detail')}}" class="text-decoration-none">
                    <div class="card border-0 shadow-lg">
                        <div class="row g-0">
                            <!-- Left Column (Image or Icon) -->
                            <div class="col-md-4">
                                <img src="{{ asset('front-theme/images/site_security.png') }}" class="img-fluid rounded-start" alt="Door Security">
                            </div>
                            <!-- Right Column (Text Content) -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-dark blog_category_title">Site Security</h5>
                                    <p class="card-text text-dark">  TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..</p>
                                    <p class="card-text">
                                        <small class="text-muted">Published on August 7, 2023</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> <div class="row mb-4 single-blog-card">
            <div class="col-12">
                <a href="{{ route('door-security-detail')}}" class="text-decoration-none">
                    <div class="card border-0 shadow-lg">
                        <div class="row g-0">
                            <!-- Left Column (Image or Icon) -->
                            <div class="col-md-4">
                                <img src="{{ asset('front-theme/images/door_supervisor.png') }}" class="img-fluid rounded-start" alt="Door Security">
                            </div>
                            <!-- Right Column (Text Content) -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-dark blog_category_title">Door Security</h5>
                                    <p class="card-text text-dark"> TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..</p>
                                    <p class="card-text">
                                        <small class="text-muted">Published on August 7, 2023</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> <div class="row mb-4 single-blog-card">
            <div class="col-12">
                <a href="{{ route('events-security-detail')}}" class="text-decoration-none">
                    <div class="card border-0 shadow-lg">
                        <div class="row g-0">
                            <!-- Left Column (Image or Icon) -->
                            <div class="col-md-4">
                                <img src="{{ asset('front-theme/images/event_security.png') }}" class="img-fluid rounded-start" alt="Door Security">
                            </div>
                            <!-- Right Column (Text Content) -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-dark blog_category_title">Events Security</h5>
                                    <p class="card-text text-dark">  TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..</p>
                                    <p class="card-text">
                                        <small class="text-muted">Published on August 7, 2023</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> <div class="row mb-4 single-blog-card">
            <div class="col-12">
                <a href="{{ route('personal-body-guard-security-detail')}}" class="text-decoration-none">
                    <div class="card border-0 shadow-lg">
                        <div class="row g-0">
                            <!-- Left Column (Image or Icon) -->
                            <div class="col-md-4">
                                <img src="{{ asset('front-theme/images/personal_body_guard.png') }}" class="img-fluid rounded-start" alt="Door Security">
                            </div>
                            <!-- Right Column (Text Content) -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-dark blog_category_title">Personal BodyGuard</h5>
                                    <p class="card-text text-dark"> TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..</p>
                                    <p class="card-text">
                                        <small class="text-muted">Published on August 7, 2023</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> <div class="row mb-4 single-blog-card">
            <div class="col-12">
                <a href="{{ route('shopping-malls-security-detail')}}" class="text-decoration-none">
                    <div class="card border-0 shadow-lg">
                        <div class="row g-0">
                            <!-- Left Column (Image or Icon) -->
                            <div class="col-md-4">
                                <img src="{{ asset('front-theme/images/shoppimg_mall_image.png') }}" class="img-fluid rounded-start" alt="Door Security">
                            </div>
                            <!-- Right Column (Text Content) -->
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-dark blog_category_title">Shopping Malls</h5>
                                    <p class="card-text text-dark"> TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..</p>
                                    <p class="card-text">
                                        <small class="text-muted">Published on August 7, 2023</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div> 
        

    </div>


  @endsection