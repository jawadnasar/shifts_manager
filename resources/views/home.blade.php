@extends('layouts.app')

@section('content')

@section('title', 'Home') <!-- Set the title for this page -->

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

  <!-- service section -->

  <section class="service_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Services We Offer
        </h2>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="box ">
            <div class="img-box">
              <img src="{{ asset('front-theme/images/concierge.png') }}" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Concierge 
              </h6>
              <p>
              Safeguarding your world with unwavering security expertise.
              </p>
              <a href="{{ route('reception-security-detail')}}">
                Read More
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box ">
            <div class="img-box">
                <img src="{{ asset('front-theme/images/site_security.png') }}" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Site Security
              </h6>
              <p>
              Safeguarding your world with unwavering security expertise
              </p>
              <a href="{{ route('site-security-detail')}}">
                Read More
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box ">
            <div class="img-box">
                <img src="{{ asset('front-theme/images/door_supervisor.png') }}" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Door Supervisor
              </h6>
              <p>
              Safeguarding your world with unwavering security expertise.
              </p>
              <a href="{{ route('door-security-detail')}}">
                Read More
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="box ">
            <div class="img-box">
                <img src="{{ asset('front-theme/images/mall_security.png') }}" alt="">
            </div>
            <div class="detail-box">
              <h6>
              Shopping Malls
              </h6>
              <p>
              Safeguarding your world with unwavering security expertise.
              </p>
              <a href="{{ route('shopping-malls-security-detail')}}">
                Read More
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box ">
            <div class="img-box">
                <img src="{{ asset('front-theme/images/event_security.png') }}" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Event Security
              </h6>
              <p>
              Safeguarding your world with unwavering security expertise
              </p>
              <a href="{{ route('events-security-detail')}}">
                Read More
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box ">
            <div class="img-box">
                <img src="{{ asset('front-theme/images/mobile_patrolling.png') }}" alt="">
            </div>
            <div class="detail-box">
              <h6>
              Mobile Patrolling
              </h6>
              <p>
              Safeguarding your world with unwavering security expertise
              </p>
              <a href="{{ route('mobile-patrolling-security-detail')}}">
                Read More
              </a>
            </div>
          </div>
        </div>
      </div>


      <div class="row mt-5">
        <div class="col-lg-12">
            <p class="text-white">
                TRK Protectors is a leading security company dedicated to ensuring the safety and peace of mind for individuals and businesses alike. With a team of highly trained and experienced professionals, we offer a comprehensive range of security solutions tailored to meet the unique needs of our clients. From advanced surveillance systems and access control to expertly executed security protocols, our commitment to excellence and unwavering dedication to safeguarding your assets make us the trusted choice for all your security needs. Partner with TRK Protectors and experience a proactive and reliable approach to security, providing you with the protection you deserve.
            </p>
        </div>
      </div>
    </div>
  </section>
   <!-- section -->
    <section class="welcome-section py-5">
    <div class="container">
        <div class="row align-items-center">
        <!-- Image Column -->
        <div class="col-md-6">
            <div class="image-box text-center">
            <img src="{{ asset('front-theme/images/welcome_image.jpg') }}" class="img-fluid" alt="TRK Protector Guard">
            <!-- <div class="logo-overlay">
                <img src="images/trk-logo.png" alt="TRK Logo" class="logo img-fluid">
            </div> -->
            </div>
        </div>

        <!-- Text Column -->
        <div class="col-md-6">
            <div class="text-box">
            <h2 class="mb-3">Welcome to TRK Protectors</h2>
            <p class="mb-4">
                Step into the realm of security excellence with ‘TRK Protectors’ — your trusted safeguarding partner in the United Kingdom. As a premier security provider, we are dedicated to securing what matters most to you. Join us on a journey where protection meets peace of mind. With a passion for excellence and a commitment to innovation, our team delivers cutting-edge security services that set new industry standards.
            </p>
            <div class="btn-box">
              
                <a href="{{ route('services')}}" class="mb-2 btn-2">
                  Learn More
                </a>
              </div>
            </div>
        </div>
        </div>
    </div>
    </section>

 

  <!-- contact section -->



<!-- end contact section -->


  <section class="features-section py-5" style="background-color: #FF8811; color: #000;">
  <div class="container text-center">
    <div class="row justify-content-center">
      <!-- Feature 1 -->
      <div class="col-6 col-md-3 mb-4">
        <div class="feature-item">
          <i class="fa fa-shield" style="font-size: 40px;"></i>
          <h5 class="mt-2">First Class Service</h5>
        </div>
      </div>

      <!-- Feature 2 -->
      <div class="col-6 col-md-3 mb-4">
        <div class="feature-item">
          <i class="fa fa-clock-o" style="font-size: 40px;"></i>
          <h5 class="mt-2">Service Available 24/7/365</h5>
        </div>
      </div>

      <!-- Feature 3 -->
      <div class="col-6 col-md-3 mb-4">
        <div class="feature-item">
          <i class="fa fa-user-secret" style="font-size: 40px;"></i>
          <h5 class="mt-2">Health & Safety Compliant</h5>
        </div>
      </div>

      <!-- Feature 4 -->
      <div class="col-6 col-md-3 mb-4">
        <div class="feature-item">
          <i class="fa fa-check-circle" style="font-size: 40px;"></i>
          <h5 class="mt-2">Clear DBS & BS7858 Vetted Staff</h5>
        </div>
      </div>

      <!-- Feature 5 -->
      <div class="col-6 col-md-3 mb-4">
        <div class="feature-item">
          <i class="fa fa-star" style="font-size: 40px;"></i>
          <h5 class="mt-2">Highly Experienced</h5>
        </div>
      </div>

      <!-- Feature 6 -->
      <div class="col-6 col-md-3 mb-4">
        <div class="feature-item">
          <i class="fa fa-line-chart" style="font-size: 40px;"></i>
          <h5 class="mt-2">Competitive Rates & Quality Service</h5>
        </div>
      </div>

      <!-- Feature 7 -->
      <div class="col-6 col-md-3 mb-4">
        <div class="feature-item">
          <i class="fa fa-globe" style="font-size: 40px;"></i>
          <h5 class="mt-2">UK Wide Coverage</h5>
        </div>
      </div>

      <!-- Feature 8 -->
      <div class="col-6 col-md-3 mb-4">
        <div class="feature-item">
          <i class="fa fa-puzzle-piece" style="font-size: 40px;"></i>
          <h5 class="mt-2">Tailored & Personalized Solutions</h5>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="sponsors-section py-5 mt-3 mb-3">
  <div class="container text-center">
    <!-- Title -->
    <div class="heading_container heading_center">
        <h2>
        Reach Your Best UK-Based Security Partner
        </h2>
        <p>
          We deliver top-tier security services across the UK, tailored to meet your needs. With a commitment to reliability and professionalism, we ensure your safety and peace of mind.
        </p>
      </div>

    
  
  </div>
</section>


  <!-- end contact section -->
  <section class="sponsors-section py-5" style="background-color: #1a1a1a; color: white; text-align: center; position: relative;">
  <div class="container text-center">
    <!-- Logo and Tagline -->
    <div class="heading_container mb-4 text-center logo-container">
      <img src="{{ asset('front-theme/images/main_logo.png') }}" alt="Company Logo" class="mb-3" style="max-width: 150px;">
      <p>Pioneers in Comprehensive Security Solutions</p>
      <p style="font-size: 14px; line-height: 1.6;">
        Security is a top priority for individuals and businesses seeking to establish a presence in any area. At TRK Protectors, we specialize in delivering professional and reliable security services that instill confidence and peace of mind. Our expertise ensures the safety of your assets, employees, and operations, empowering investors and businesses to focus on growth and success. With TRK Protectors, you’re not just securing your business—you’re securing your future.
      </p>
      <p style="font-size: 12px;">
        Company No: 7996374<br>
        VAT Registration: 132 7467 15
      </p>
    </div>



    <!-- Accreditations Logos -->
    <div class="row justify-content-center align-items-center">
      <!-- Accreditation 1 -->
      <div class="col-6 col-md-2 mb-3">
        <img src="{{ asset('front-theme/images/ARC-Logo-300x177.jpg') }}" alt="BSI" class="img-fluid" style="max-height: 80px;">
      </div>
      <!-- Accreditation 2 -->
      <div class="col-6 col-md-2 mb-3">
        <img src="{{ asset('front-theme/images/OIF-image-300x134.jpg') }}" alt="NTIA" class="img-fluid" style="max-height: 80px;">
      </div>
      <!-- Accreditation 3 -->
      <div class="col-6 col-md-2 mb-3">
        <img src="{{ asset('front-theme/images/sia-approved-contractor-256x300.jpg') }}" alt="ISO 9001:2015" class="img-fluid" style="max-height: 80px;">
      </div>
      <!-- Accreditation 4 -->
      <div class="col-6 col-md-2 mb-3">
        <img src="{{ asset('front-theme/images/SAVENIGHTLIFE_new-red-150x150.webp') }}" alt="ARC" class="img-fluid" style="max-height: 80px;">
      </div>
      <!-- Accreditation 5 -->
      <div class="col-6 col-md-2 mb-3">
        <img src="{{ asset('front-theme/images/NTIA-LONG-WHITE-768x73.webp') }}" alt="National Security" class="img-fluid" style="max-height: 80px;">
      </div>

    </div>

    <!-- Enquiry Button -->
    <div class="mt-4">
      <a href="#" class="btn btn-primary" style="background-color: #0056b3; border-color: #0056b3; padding: 10px 20px; font-size: 16px;">Make an Enquiry</a>
    </div>
  </div>
</section>


<section class="sponsors-section py-5 mt-3 mb-3">
  <div class="container text-center">
    <!-- Title -->
    <div class="heading_container heading_center">
        <h2>
          Trusted UK-Based Security Partner for Your Protection
        </h2>
        <p>
          At TRK Protectors, we specialize in delivering high-quality, reliable security solutions tailored to your specific needs. Serving clients across the UK, our expert team ensures complete protection and peace of mind for businesses and individuals alike.
        </p>
       
    </div>
  </div>
</section>


  <!-- end team section -->
  @endsection