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
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="{{ asset('front-theme/css/style.css') }}" rel="stylesheet" />
        <!-- responsive style -->
        <link href="{{ asset('front-theme/css/responsive.css') }}" rel="stylesheet" />

        <link href="{{ asset('front-theme/css/font-awesome.min.css') }}" rel="stylesheet" />

        <link href="{{ asset('front-theme/libs/toastr/toastr.min.css') }}" rel="stylesheet" />
        
        <script src="{{ asset('front-theme/js/jquery-3.4.1.min.js') }}"></script>



        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="">

            <!-- ======= Header ======= -->
            @include('layouts.header')
            <!-- Header Ended -->
            <div id="app">
                <main class="">
                    @yield('content')
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
