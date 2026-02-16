
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
            At TRK Protectors, our Reception Security service provides the first line of defense for your premises, ensuring a safe and professional environment. Our team manages visitor access, screens entrants, and maintains efficient visitor logs while upholding a welcoming presence. We offer expert monitoring of entry points and rapid response to any security incidents. With a visible and professional approach, we deter unauthorized access and promote peace of mind. Trust TRK Protectors to keep your front-of-house secure, allowing your business to operate confidently.  
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
            <h2 class="mb-3 blog_category_title">Construction Site</h2>
            <p>
We provide comprehensive Construction Site Security to protect your projects from theft, vandalism, and unauthorized access. Our trained security professionals monitor the site around the clock, ensuring compliance with health and safety regulations. We implement access control, perimeter checks, and rapid incident response to maintain a secure environment. With a visible and proactive presence, we deter trespassers and safeguard your equipment and materials. You can trust us to keep your construction site safe, allowing your team to focus on completing projects efficiently.            </p>
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
We provide professional Door Security to ensure that your premises remain safe and controlled at all entry points. Our trained security personnel monitor entrances, verify identities, and manage access efficiently. We are prepared to respond quickly to any suspicious activity or security breaches. With a strong and visible presence, we deter unauthorized entry and protect your staff, visitors, and property. You can rely on us to maintain a secure environment, giving you peace of mind at all times.            </p>
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
We provide comprehensive Events Security to ensure your gatherings are safe, smooth, and enjoyable for everyone. Our trained security team manages crowd control, access points, and emergency situations with professionalism and efficiency. We monitor for potential risks and respond quickly to any incidents to maintain a secure environment. With a visible and proactive presence, we help prevent disruptions and keep guests safe. You can trust us to handle every aspect of event security, letting you focus on hosting a successful occasion.            </p>
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
We provide Mobile Patrolling services to keep your property secure across multiple locations with regular, professional checks. Our security team conducts thorough patrols, monitors for suspicious activity, and responds quickly to any incidents. We ensure that all areas are covered, from perimeter checks to interior monitoring, maintaining a safe environment. With a visible presence and rapid response, we deter crime and enhance peace of mind. You can rely on us to protect your assets, allowing you to focus on your business without security concerns.            </p>
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
We provide professional Shopping Mall Security to ensure a safe and welcoming environment for shoppers, retailers, and staff. Our trained security personnel monitor entrances, patrol common areas, and manage crowd control effectively. We respond quickly to incidents, handle emergencies with confidence, and help prevent theft and anti-social behavior. With a strong and visible presence, we create a secure atmosphere that enhances customer experience. You can rely on us to protect your shopping centre while maintaining a friendly and professional approach.            </p>
            <div class="mt-3">
              <a href="{{ route('shopping-malls-security-detail')}}" class="btn btn-custom btn-lg">Learn More</a>
            </div>
        </div>
    </div>
</div>
@endsection
