@extends('layouts.app')

@section('content')

@section('title', 'About TRK Protectors | Trusted UK Security Specialists')
@section('meta_description', 'Learn more about TRK Protectors, a trusted UK-based security company committed to delivering professional event security, door supervision, mobile patrols, site protection, and corporate security services. Our trained and SIA-licensed team ensures safety, reliability, and excellence across the UK.')
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
        <p class="text-left">
        Welcome to {{env('COMPANY_NAME')}}!
        <br>
        At {{env('COMPANY_NAME')}}, we take pride in being a premier private security company serving the UK. With a steadfast commitment to excellence and an unwavering focus on safeguarding your peace of mind, we are dedicated to providing top-notch security solutions tailored to meet your specific needs.
        <br>
       <b>Our Mission:</b><br>
        To be the trusted protectors of your safety, assets, and reputation. We strive to deliver uncompromising security services, ensuring you can focus on what matters most, while we handle the rest.
        <br>
        Why Choose {{env('COMPANY_NAME')}}?
        <br>
       <b>Expertise:</b> Our team comprises highly skilled and licensed security professionals with extensive experience in the field. We continuously invest in training and development to stay ahead of emerging security challenges.
        Comprehensive Solutions: Whether you need security for your business, event, or personal safety, we have a range of tailored solutions to address your unique requirements.
       <br><b> Reliability:</b><br> We understand the importance of dependability in the security industry. You can trust us to be vigilant, proactive, and responsive, providing the highest level of protection.
        Client-Centric Approach: We prioritize building strong partnerships with our clients, understanding their needs, and delivering personalized solutions that exceed expectations.
        <br><b>Our Services:</b><br>
        
       <b>Manned Security: </b><br>Trained security personnel who are vigilant and prepared to handle any situation with professionalism.
        <br><b>Event Security: </b><br>Ensuring the safety and smooth execution of your events, from small gatherings to large-scale functions.
      <br><b>CCTV Surveillance:</b><br> State-of-the-art CCTV systems to monitor and deter potential threats.
        Key Holding and Alarm Response: 24/7 support to protect your premises and respond promptly to any alarms.
        Personal Protection: Discreet and reliable protection for individuals and families, providing peace of mind wherever you go.
        <br>
        Let's Protect Together:
        <br>
        At {{env('COMPANY_NAME')}}, we believe that safety is a collective effort. As your dedicated security partner, we are committed to your well-being and the security of what you hold dear. Together, we can create a safer environment for you and your business.

        Contact us today for a consultation and let's design a security strategy that fits your needs perfectly.

        Your safety is our priority.
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