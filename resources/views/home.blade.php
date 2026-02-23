@extends('layouts.app')

@section('content')

@section('content')

@section('title', 'TRK Protectors | Professional Security Services Across the UK')
@section('meta_description', 'TRK Protectors is a UK-based security company providing professional event security, door supervisors, mobile patrols, shopping mall security, reception security, construction site security, and tailored protection services. Reliable, trained, and trusted security solutions across the UK.')

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
                            Reliable Security Guards for Your Business
                        </h2>
                    </div>
                    <p>
                        Protect your property, staff, and customers with professional, licensed security guards. We
                        provide reliable, 24/7 security services tailored for shops, offices, construction sites, and
                        commercial properties across the UK. Get dependable protection when you need it most.
                    </p>
                    <div class="btn-box">
                        <a href="{{ route('contact') }}" class="mb-2 btn btn-info">
                            Request a Quote
                        </a>
                        <a href="{{ route('services') }}" class="mb-2 btn btn-secondary">
                            Get Security Now
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
                            Professional front-of-house security providing a welcoming presence while maintaining strict
                            safety standards.
                        </p>
                        <a href="{{ route('reception-security-detail') }}">
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
                            Construction Site
                        </h6>
                        <p>
                            Reliable site security protecting equipment, materials, and premises from theft and
                            unauthorized access. </p>
                        <a href="{{ route('site-security-detail') }}">
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
                            Licensed door supervisors ensuring safety, crowd control, and compliance at venues and
                            entrances. </p>
                        <a href="{{ route('door-security-detail') }}">
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
                            Visible, trained security guards maintaining a safe shopping environment for customers and
                            staff. </p>
                        <a href="{{ route('shopping-malls-security-detail') }}">
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
                            Experienced event security managing crowds, access control, and incident prevention for all
                            event sizes. </p>
                        <a href="{{ route('events-security-detail') }}">
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
                            Cost-effective mobile patrols delivering regular inspections and rapid response for your
                            property. </p>
                        <a href="{{ route('mobile-patrolling-security-detail') }}">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-5">
            <div class="col-lg-12">
                <p class="text-white">
                    TRK Protectors is your dedicated UK-based security partner, providing SIA-licensed static guards,
                    mobile patrols, and event security teams. We develop tailored solutions that protect your business
                    premises, assets, and people with unwavering reliability. Our proactive approach focuses on
                    deterring threats and preventing incidents before they occur. We combine experienced personnel with
                    clear protocols to ensure your safety and operational continuity. Partner with us to implement a
                    security strategy that delivers true peace of mind.
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
                    <img src="{{ asset('front-theme/images/welcome_image.jpg') }}" class="img-fluid"
                        alt="TRK Protector Guard">
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
                        As your trusted UK security partner, we provide businesses with professional, SIA-licensed
                        security personnelfrom on-site guards and mobile patrols to event security teams. We focus on
                        reliable, proactive protection for your premises, assets, and people. Explore how our tailored
                        solutions can address your specific security challenges and provide the peace of mind you need
                        to operate with confidence.
                    </p>
                    <div class="btn-box">

                        <a href="{{ route('services') }}" class="mb-2 btn-2">
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
                We deliver top-tier security services across the UK, tailored to meet your needs. With a commitment to
                reliability and professionalism, we ensure your safety and peace of mind.
            </p>
        </div>



    </div>
</section>


<!-- end contact section -->
<section class="sponsors-section py-5"
    style="background-color: #1a1a1a; color: white; text-align: center; position: relative;">
    <div class="container text-center">
        <!-- Logo and Tagline -->
        <div class="heading_container mb-4 text-center logo-container">
            <img src="{{ asset('front-theme/images/main_logo.png') }}" alt="Company Logo" class="mb-3"
                style="max-width: 150px;">
            <p>Pioneers in Comprehensive Security Solutions</p>
            <p style="font-size: 14px; line-height: 1.6;">
                Security is a top priority for individuals and businesses seeking to establish a presence in any area.
                At TRK Protectors, we specialize in delivering professional and reliable security services that instill
                confidence and peace of mind. Our expertise ensures the safety of your assets, employees, and
                operations, empowering investors and businesses to focus on growth and success. With TRK Protectors,
                you’re not just securing your business—you’re securing your future.
            </p>
            {{-- <p style="font-size: 12px;">
        Company No:{{env('COMPANY_NUMBER')}} <br>
        VAT Registration:{{env('COMPANY_VAT_REGISTRATION')}} <br>
      </p> --}}
        </div>



        <!-- Accreditations Logos -->
        <div class="row justify-content-center align-items-center">
            <!-- Accreditation 1 -->
            @foreach ($certificates as $certificate)
                <div class="col-6 col-md-2 mb-3">
                    <img src="{{ asset('storage/certificates/' . $certificate->logo) }}" alt="Certificate Logo"
                        class="img-fluid" style="max-height: 80px;">
                </div>
            @endforeach

        </div>

        <!-- Enquiry Button -->
        <div class="mt-4">
            <div class="btn-box">

                <a href="{{ route('contact') }}#contact_form_section" class="mb-2 btn-2">
                    Make an Inquiry
                </a>
            </div>
        </div>
        <!-- <a href="#" class="btn btn-primary" style="background-color: #0056b3; border-color: #0056b3; padding: 10px 20px; font-size: 16px;">Make an Enquiry</a> -->
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
                At TRK Protectors, we specialize in delivering high-quality, reliable security solutions tailored to
                your specific needs. Serving clients across the UK, our expert team ensures complete protection and
                peace of mind for businesses and individuals alike.
            </p>

        </div>
    </div>
</section>


<!-- end team section -->
@endsection
