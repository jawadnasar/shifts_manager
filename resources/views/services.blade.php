
@extends('layouts.app')

@section('content')

@section('title', 'Services') <!-- Set the title for this page -->

<style>
  .hero_area {
  min-height: 60vh!important;
}
</style>
<section class="sponsors-section py-5">
  <div class="container text-center">
    <!-- Title -->
    <div class="heading_container heading_center">
        <h2>
          Our Services
        </h2>
        <p>
          TRK Protectors offers a comprehensive range of top-notch security services, tailored to meet diverse protection needs:
        </p>
      </div>
  </div>
</section>
<div class="container my-5">
    <div class="row align-items-center mb-3 sing_service_row">
        <div class="col-md-3">
            <img src="{{ asset('front-theme/images/concierge.png') }}" alt="Reception" class="img-fluid rounded">
        </div>
        <div class="col-md-9">
            <h2 class="mb-3 blog_category_title">Reception</h2>
            <p>
              TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore...
            </p>
            <div class="mt-3">
              <a href="{{ route('reception-security-detail')}}" class="btn btn-custom btn-lg">Learn More</a>
            </div>
        </div>
    </div>

    <div class="row align-items-center mb-3 sing_service_row">
        <div class="col-md-3">
            <img src="{{ asset('front-theme/images/site_security.png') }}" alt="Reception" class="img-fluid rounded">
        </div>
        <div class="col-md-9">
            <h2 class="mb-3 blog_category_title">Site Security</h2>
            <p>
            TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..
            </p>
            <div class="mt-3">
              <a href="{{ route('site-security-detail')}}" class="btn btn-custom btn-lg">Learn More</a>
            </div>
        </div>
    </div>

    <div class="row align-items-center mb-3 sing_service_row">
        <div class="col-md-3">
            <img src="{{ asset('front-theme/images/door_supervisor.png') }}" alt="Reception" class="img-fluid rounded">
        </div>
        <div class="col-md-9">
            <h2 class="mb-3 blog_category_title">Door Security</h2>
            <p>
            TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..
            </p>
            <div class="mt-3">
              <a href="{{ route('door-security-detail')}}" class="btn btn-custom btn-lg">Learn More</a>
            </div>
        </div>
    </div>

    <div class="row align-items-center mb-3 sing_service_row">
        <div class="col-md-3">
            <img src="{{ asset('front-theme/images/event_security.png') }}" alt="Reception" class="img-fluid rounded">
        </div>
        <div class="col-md-9">
            <h2 class="mb-3 blog_category_title">Events Security</h2>
            <p>
            TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..
            </p>
            <div class="mt-3">
              <a href="{{ route('events-security-detail')}}" class="btn btn-custom btn-lg">Learn More</a>
            </div>
        </div>
    </div>

    <div class="row align-items-center mb-3 sing_service_row">
        <div class="col-md-3">
            <img src="{{ asset('front-theme/images/mobile_patrolling.png') }}" alt="Reception" class="img-fluid rounded">
        </div>
        <div class="col-md-9">
            <h2 class="mb-3 blog_category_title">Mobile Patrolling</h2>
            <p>
            TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..
            </p>
            <div class="mt-3">
              <a href="{{ route('mobile-patrolling-security-detail')}}" class="btn btn-custom btn-lg">Learn More</a>
            </div>
        </div>
    </div>

   

    <div class="row align-items-center mb-3 sing_service_row">
        <div class="col-md-3">
            <img src="{{ asset('front-theme/images/mall_security.png') }}" alt="Reception" class="img-fluid rounded">
        </div>
        <div class="col-md-9">
            <h2 class="mb-3 blog_category_title">Shopping Malls</h2>
           <p>
            TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..
            </p>
            <div class="mt-3">
              <a href="{{ route('shopping-malls-security-detail')}}" class="btn btn-custom btn-lg">Learn More</a>
            </div>
        </div>
    </div>
</div>
@endsection
