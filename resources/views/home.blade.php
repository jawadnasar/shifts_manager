@extends('layouts.app')

@section('content')

@section('title', 'Home') <!-- Set the title for this page -->
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
              <a href="">
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
              <a href="">
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
              <a href="">
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
                <img src="{{ asset('front-theme/images/retail_security.png') }}" alt="">
            </div>
            <div class="detail-box">
              <h6>
                Retail Security
              </h6>
              <p>
              Safeguarding your world with unwavering security expertise.
              </p>
              <a href="">
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
              <a href="">
                Read More
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box ">
            <div class="img-box">
                <img src="{{ asset('front-theme/images/personal_body_guard.png') }}" alt="">
            </div>
            <div class="detail-box">
              <h6>
               Personal Bodyguard
              </h6>
              <p>
              Safeguarding your world with unwavering security expertise
              </p>
              <a href="">
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
            <img src="{{ asset('front-theme/images/banner.png') }}" class="img-fluid" alt="TRK Protector Guard">
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
            <a href="">
                Read More
              </a>
            </div>
        </div>
        </div>
    </div>
    </section>

 

  <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="contact_bg_box">
      <div class="img-box">
        <img src="{{ asset('front-theme/images/contact-bg.jpg') }}" alt="">
      </div>
    </div>
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
         Contact Us
        </h2>
      </div>
      <div class="">
        <div class="row">
          <div class="col-md-7 mx-auto">
            <form action="#">
              <div class="contact_form-container">
                <div>
                  <div>
                    <input type="text" placeholder="Your Full Name" />
                  </div>
                  <div>
                    <input type="email" placeholder="Your Email " />
                  </div>
                  <div>
                    <input type="text" placeholder="Your Phone Number" />
                  </div>
                  <div class="">
                    <input type="text" placeholder="Your Message" class="message_input" />
                  </div>
                  <div class="btn-box ">
                    <button type="submit">
                      Send
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->
  <section class="sponsors-section py-5">
  <div class="container text-center">
    <!-- Title -->
    <div class="heading_container heading_center">
        <h2>
          Our Sponsors
        </h2>
        <p>
          Lorem ipsum dolor sit amet, non odio tincidunt ut ante, lorem a euismod suspendisse vel, sed quam nulla mauris
          iaculis. Erat eget vitae malesuada, tortor tincidunt porta lorem lectus.
        </p>
      </div>

    <!-- Sponsor Logos -->
    <div class="row justify-content-center">
      <!-- Sponsor 1 -->
      <div class="col-6 col-md-3 mb-4">
        <img src="{{ asset('front-theme/images/sponsor.png') }}" alt="Sponsor 1" class="img-fluid sponsor-logo">
      </div>

      <!-- Sponsor 2 -->
      <div class="col-6 col-md-3 mb-4">
        <img src="{{ asset('front-theme/images/sponsor.png') }}" alt="Sponsor 2" class="img-fluid sponsor-logo">
      </div>

      <!-- Sponsor 3 -->
      <div class="col-6 col-md-3 mb-4">
        <img src="{{ asset('front-theme/images/sponsor.png') }}" alt="Sponsor 3" class="img-fluid sponsor-logo">
      </div>

      <!-- Sponsor 4 -->
      <div class="col-6 col-md-3 mb-4">
        <img src="{{ asset('front-theme/images/sponsor.png') }}" alt="Sponsor 4" class="img-fluid sponsor-logo">
      </div>
    </div>
  </div>
</section>

  <!-- team section -->

 

  <!-- end team section -->
  @endsection