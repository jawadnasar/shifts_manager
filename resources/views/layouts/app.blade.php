<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9WJDW96SHE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-9WJDW96SHE');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ env('APP_DESCRIPTION') }}">
    <title>@yield('title', config('app.name')) | {{ env('APP_TITLE_DESCRIPTION') }}</title>

    <meta name="keywords"
        content="security company UK, SIA security guards, construction site security UK, event security UK, mobile patrol security UK, door supervisor security UK">
    <meta name="robots" content="home, follow">
    <meta name="author" content="@yield('title', config('app.name'))">

    <link rel="icon" href="{{ asset('front-theme/images/main_logo.png') }}" type="icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />



    <!-- Libs Included -->
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front-theme/css/bootstrap.css') }}" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap"
        rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('front-theme/css/style.css') }}?v={{ config('app.version') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('front-theme/css/responsive.css') }}?v={{ config('app.version') }}" rel="stylesheet" />

    <link href="{{ asset('front-theme/css/font-awesome.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('front-theme/libs/toastr/toastr.min.css') }}" rel="stylesheet" />

    <script src="{{ asset('front-theme/js/jquery-3.4.1.min.js') }}"></script>


    <!-- Adding google tag for Adsense and analytics -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11080741261"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-11080741261');
    </script>

    <!-- Open Graph SEO -->
    <meta property="og:title" content="@yield('title', config('app.name')) | {{ env('APP_TITLE_DESCRIPTION') }}">
    <meta property="og:description" content="{{ env('APP_DESCRIPTION') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('COMPANY_WEBSITE') }}">
    <meta property="og:image" content="{{ asset('front-theme/images/main_logo.png') }}">

    <!-- Google Structured Data SEO -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "SecurityService",
            "name": "{{env('APP_NAME')}}",
            "url": "{{env('COMPANY_WEBSITE')}}",
            "telephone": "{{env('COMPANY_PHONE')}}",
            "areaServed": "United Kingdom"
        }
    </script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="@yield('body_class', '')">

    <!-- ======= Header ======= -->
    @include('layouts.header')
    <!-- Header Ended -->
    <div id="app">
        <main class="">

            {{-- This is the overlay spinner for waiting and stopping users to do anything (in future please make it in center css is in style.css) --}}
            <div id="loading-overlay" style="display:none">
                {{-- Loading spinner --}}
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            {{-- Errors section START --}}
            @section('errors')
                {{-- All the errors will be shown here for validation --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {!! $errors->first() !!}
                    </div>
                @endif
            @show
            {{-- Errors section END --}}

            {{-- Error section START --}}
            @section('error')
                {{-- All the errors will be shown here for validation --}}
                @if (session('error'))
                    <div class="alert alert-danger">
                        {!! session('error') !!}
                    </div>
                @endif
            @show
            {{-- Error section END --}}

            {{-- Success section START --}}
            @section('success')
                {{-- All the success messages will be shown here --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {!! session('success') !!}
                    </div>
                @endif
            @show
            {{-- Success section END --}}

            {{-- Content section START --}}
            @yield('content')
            {{-- Content section END --}}

        </main>
    </div>

    <!-- ======= Footer ======= -->
    @include('layouts.footer')
    @yield('javascript')


    <!-- <script src="{{ asset('front-theme/js/jquery-3.4.1.min.js') }}"></script> -->
    <script src="{{ asset('front-theme/js/bootstrap.js') }}"></script>
    <script src="{{ asset('front-theme/js/custom.js') }}"></script>
    <script src="{{ asset('front-theme/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('front-theme/libs/swal/swal.js') }}"></script>



</body>

</html>
