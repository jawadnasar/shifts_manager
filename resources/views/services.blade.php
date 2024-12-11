
@extends('layouts.app')

@section('content')

@section('title', 'About') <!-- Set the title for this page -->

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
    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <img src="{{ asset('front-theme/images/concierge.png') }}" alt="Reception" class="img-fluid rounded">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">Reception</h2>
            <p>
              TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore...
            </p>
            <div class="mt-3">
              <a href="{{ route('reception-security-detail')}}" class="btn btn-custom btn-lg">Learn More</a>
            </div>
        </div>
    </div>

    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <img src="{{ asset('front-theme/images/site_security.png') }}" alt="Reception" class="img-fluid rounded">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">Site Security</h2>
            <p>
            TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..
            </p>
            <div class="mt-3">
              <a href="{{ route('site-security-detail')}}" class="btn btn-custom btn-lg">Learn More</a>
            </div>
        </div>
    </div>

    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <img src="{{ asset('front-theme/images/door_supervisor.png') }}" alt="Reception" class="img-fluid rounded">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">Door Security</h2>
            <p>
            TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..
            </p>
            <div class="mt-3">
              <a href="{{ route('door-security-detail')}}" class="btn btn-custom btn-lg">Learn More</a>
            </div>
        </div>
    </div>

    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <img src="{{ asset('front-theme/images/event_security.png') }}" alt="Reception" class="img-fluid rounded">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">Events Security</h2>
            <p>
            TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..
            </p>
            <div class="mt-3">
              <a href="{{ route('events-security-detail')}}" class="btn btn-custom btn-lg">Learn More</a>
            </div>
        </div>
    </div>

    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <img src="{{ asset('front-theme/images/personal_body_guard.png') }}" alt="Reception" class="img-fluid rounded">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">Personal BodyGuard</h2>
            <p>
            TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailore …..
            </p>
            <div class="mt-3">
              <a href="{{ route('personal-body-guard-security-detail')}}" class="btn btn-custom btn-lg">Learn More</a>
            </div>
        </div>
    </div>

   

    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <img src="{{ asset('front-theme/images/mall_security.png') }}" alt="Reception" class="img-fluid rounded">
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">Shopping Malls</h2>
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
