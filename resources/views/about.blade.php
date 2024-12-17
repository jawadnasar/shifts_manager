@extends('layouts.app')

@section('content')

@section('title', 'About') <!-- Set the title for this page -->
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
          About Us
        </h2>
        <p>
                TRK Protectors is a premier security agency based in the UK, dedicated to providing top-tier security solutions tailored to your needs. With expertise in a wide range of services, we specialize in reception security, site protection, event security, shopping mall safeguarding, and personal bodyguard services.

        Our commitment to excellence ensures that our highly trained personnel deliver reliable and professional security at all times. Whether you require protection for your premises, events, or personal safety, TRK Protectors stands as a trusted partner in ensuring peace of mind and safety for our clients across the UK.
        </p>
      </div>
  </div>
</section>
<section class="welcome-section py-5">
    <div class="container">
        <div class="row align-items-center">
        <!-- Image Column -->
        <div class="col-md-6">
            <div class="image-box text-center">
            <img src="{{ asset('front-theme/images/trk_guard.png') }}" class="img-fluid" alt="TRK Protector Guard">
            <!-- <div class="logo-overlay">
                <img src="images/trk-logo.png" alt="TRK Logo" class="logo img-fluid">
            </div> -->
            </div>
        </div>

        <!-- Text Column -->
        <div class="col-md-6">
            <div class="text-box">
            <div class="heading_container ">
              <h2>
                Safeguarding your world with unwavering security expertise?
              </h2>
            </div>
            <p>
            Get in touch and experience the peace of mind with TRK's Protectors top-notch security solutions.
            </p>
          <div class="btn-box">
            <a href="{{ route('contact')}}" class="mb-2 btn-2">
              Get In Touch
            </a>
            <a href="{{ route('services')}}" class="mb-2 btn-2">
              Learn More
            </a>
          </div>
          
        </div>
        </div>
        </div>
    </div>
    </div>
    </section>

  <!-- end about section -->

  <!-- end team section -->
  @endsection