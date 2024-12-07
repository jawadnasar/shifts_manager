@extends('layouts.app')

@section('content')

@section('title', 'About') <!-- Set the title for this page -->

<section class="sponsors-section py-5">
  <div class="container text-center">
    <!-- Title -->
    <div class="heading_container heading_center">
        <h2>
          About Us
        </h2>
        <p>
          Lorem ipsum dolor sit amet, non odio tincidunt ut ante, lorem a euismod suspendisse vel, sed quam nulla mauris
          iaculis. Erat eget vitae malesuada, tortor tincidunt porta lorem lectus.
        </p>
      </div>
  </div>
</section>
<section class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6 px-0">
          <div class="img_container">
            <div class="img-box">
              <img src="{{ asset('front-theme/images/guard.jpg') }}" alt="" />
            </div>
          </div>
        </div>
        <div class="col-md-6 px-0">
          <div class="detail-box">
            <div class="heading_container ">
              <h2>
                Safeguarding your world with unwavering security expertise?
              </h2>
            </div>
            <p>
              Get in touch and experience the peace of mind with TRK's Protectors top-notch security solutions.
            </p>
            <div class="btn-box">
              <a href="">
                Get In Touch
              </a>
              <a href="">
                Learn More
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- end team section -->
  @endsection