@extends('layouts.app')

@section('content')

@section('title', 'Home') <!-- Set the title for this page -->

  <!-- contact section -->
  <div class="row mb-3 mt-4">
    <div class="col-lg-12">
        <div class="container">
            <section class="contact-section">
                <h2>Contact 24/7</h2>
                <div class="contact-info">
                    
                    <div>
                        <img src="{{ asset('front-theme/images/phone.png') }}" alt="Phone">
                        <span>Now +44 7404 989621</span>
                        &nbsp;&nbsp;&nbsp;
                        <img src="{{ asset('front-theme/images/email.png') }}" alt="Email">
                        <span>trkprotectors@gmail.com</span>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

  <section class="contact_section layout_padding">
    <div class="contact_bg_box">
      <div class="img-box">
        <img src="{{ asset('front-theme/images/contact-bg.jpg') }}" alt="">
      </div>
    </div>
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
        Send us a Message
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
<br><br><br>

 

  <!-- end team section -->
  @endsection