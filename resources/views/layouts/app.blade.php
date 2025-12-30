<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>
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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="">

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
