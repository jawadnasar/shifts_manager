@extends('layouts.app')

@section('content')

@section('title', 'Thank You') <!-- Set the title for this page -->

<style>
    .hero_area {
        min-height: 60vh !important;
    }
</style>

<section class="thank-you-section py-5">
    <div class="container text-center">
        <!-- Title -->
        <div class="heading_container heading_center">
            <h2>
                Thank You for Your Application!
            </h2>
            <p>
                Your application has been successfully submitted. We will get back to you soon.
            </p>
        </div>

        <!-- Icon -->
        <div class="icon-container my-4">
            <i class="fa fa-check-circle fa-5x text-success"></i> <!-- Checkmark Icon -->
        </div>
        <div class="btn-box">
            <a href="{{ route('home')}}" class="mb-2 btn-2">
              Got It
            </a>
           
        </div>

    </div>
</section>

@endsection
