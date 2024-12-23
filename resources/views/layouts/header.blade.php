<div class="hero_area">
    <!-- header section strats -->
    <div class="hero_bg_box">
      <!-- <div class="img-box">
        <img src="{{ asset('front-theme/images/hero-bg.jpg') }}" alt="">
      </div> -->


      <div class="img-box">
      @if(Route::currentRouteName() == 'home')
          <img src="{{ asset('front-theme/images/hero-bg.jpg') }}" alt="Home">
      @elseif(Route::currentRouteName() == 'about')
          <img src="{{ asset('front-theme/images/about_bg.jpg') }}" alt="About">
      @elseif(Route::currentRouteName() == 'services')
          <img src="{{ asset('front-theme/images/services_bg.jpg') }}" alt="Services">
      @elseif(Route::currentRouteName() == 'contact')
          <img src="{{ asset('front-theme/images/contact-bg.jpg') }}" alt="Contact">
      @elseif(Route::currentRouteName() == 'blog')
          <img src="{{ asset('front-theme/images/blog-bg.jpg') }}" alt="Blog">
      @elseif(Route::currentRouteName() == 'apply' || Route::currentRouteName() == 'security_agency_recruitment_form.create')
          <img src="{{ asset('front-theme/images/apply-bg.jpg') }}" alt="Apply">
      @elseif(Route::currentRouteName() == 'reception-security-detail')
          <img src="{{ asset('front-theme/images/reception-security-bg.jpg') }}" alt="Reception Security">
      @elseif(Route::currentRouteName() == 'site-security-detail')
          <img src="{{ asset('front-theme/images/site-security-bg.jpg') }}" alt="Site Security">
      @elseif(Route::currentRouteName() == 'door-security-detail')
          <img src="{{ asset('front-theme/images/door-security-bg.jpg') }}" alt="Door Security">
      @elseif(Route::currentRouteName() == 'events-security-detail')
          <img src="{{ asset('front-theme/images/events-security-bg.jpg') }}" alt="Events Security">
      @elseif(Route::currentRouteName() == 'personal-body-guard-security-detail')
          <img src="{{ asset('front-theme/images/personal-body-guard-bg.jpg') }}" alt="Personal Body Guard">
      @elseif(Route::currentRouteName() == 'shopping-malls-security-detail')
          <img src="{{ asset('front-theme/images/shopping-malls-bg.jpg') }}" alt="Shopping Malls Security">
      @else
          <img src="{{ asset('front-theme/images/default-bg.jpg') }}" alt="Default">
      @endif

      </div>

    </div>

    <header class="header_section">
      <div class="header_top">
        <div class="container-fluid">
          <div class="contact_link-container">
            <a href="" class="contact_link1">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>
                Top-notch Security Solutions
              </span>
            </a>
            <a href="" class="contact_link2">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>
                Call : +01 1234567890
              </span>
            </a>
            <a href="" class="contact_link3">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
                trkprotectors@gmail.com
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="index.html">
              <span>
                <img src="{{ asset('front-theme/images/main_logo.png') }}" alt="" style="width:120px;height:120px;">
              </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""></span>
            </button>

            <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
              <ul class="navbar-nav  ">
                <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'about' ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('about') }}">About Us </a>
                </li>
                <li class="nav-item {{ Route::is('services', 'reception-security-detail', 'site-security-detail', 'door-security-detail', 'events-security-detail', 'personal-body-guard-security-detail', 'shopping-malls-security-detail') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('services') }}"> Services</a>
              </li>

                <li class="nav-item {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('contact') }}"> Contact </a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'blog' ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('blog') }}">Blog</a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'security_agency_recruitment_form' ? 'active' : '' }}">
                  {{-- <a class="nav-link" href="{{ route('apply') }}">Apply</a> --}}
                  <a class="nav-link" href="{{ route('security_agency_recruitment_form.create') }}">Apply</a>
                </li>
                  
                <li class="nav-item">
                    @if(auth()->check())
                        <a class="nav-link" href="{{ route('logout') }}"
                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <!-- If the user is not logged in, you can add some other links or logic here -->
                    @endif
                </li>

              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class=" slider_section ">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                  <h1>
                    Securing Your <br>
                    <span>
                      Peace of Mind
                    </span>
                  </h1>
                  <p>
                    Dedicated to delivering top-notch security services you can trust.
                  </p>

                    <div class="btn-box">
                      <a href="{{ route('services')}}" class="btn-1"> Read more </a>
                      <a href="{{ route('contact')}}" class="btn-2">Contact Us</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                      Your Security <br>
                      <span>
                        Our Commitment
                      </span>
                    </h1>
                    <p>
                      Delivering unmatched protection and peace of mind for a safer tomorrow.
                    </p>

                    <div class="btn-box">
                      <a href="{{ route('services')}}" class="btn-1"> Read more </a>
                      <a href="{{ route('contact')}}" class="btn-2">Contact Us</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                  <h1>
                    Protecting You <br>
                    <span>
                      At Every Step
                    </span>
                  </h1>
                  <p>
                    Providing reliable and comprehensive security solutions tailored to your needs.
                  </p>
                    <div class="btn-box">
                      <a href="{{ route('services')}}" class="btn-1"> Read more </a>
                      <a href="{{ route('contact')}}" class="btn-2">Contact Us</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container idicator_container">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
        </div>
      </div>
    </section>
    <!-- end slider section -->
</div>
<style>
  .collapse {
    visibility: visible!important;
  }
</style>