<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TRK Protectors</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('adminth/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminth/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('adminth/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminth/libs/toastr/toastr.min.css') }}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('adminth/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('adminth/js/jquery-3.4.1.min.js') }}"></script>
    <!-- <link href="{{ asset('adminth/lib/toastr/toastr.min.css') }}" rel="stylesheet" /> -->
    <link href="{{ asset('front-theme/libs/toastr/toastr.min.css') }}" rel="stylesheet" />



</head>

<body>
    <div class="position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        @include('admin.layouts.sidebar')
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Header-->
            @include('admin.layouts.header')
            <!-- Header -->

            <!-- Errors section START -->
            @section('errors')
                {{-- All the errors will be shown here for validation --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {!! $errors->first() !!}
                    </div>
                @endif
            @show
            <!-- Errors section END -->

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

            <!-- Main Contents-->

            @yield('content')

            <!-- Main Contents -->


            <!-- Footer -->
            @yield('footer')
            <!-- Footer End -->
        </div>
        <!-- Content -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    @yield('javascript')

    <!-- JavaScript Libraries -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('adminth/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('adminth/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('adminth/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('adminth/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('adminth/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('adminth/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('adminth/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('adminth/js/main.js') }}"></script>
    <!-- <script src="{{ asset('adminth/lib/swal/swal.js') }}"></script>
    <script src="{{ asset('adminth/lib/toastr/toastr.min.js') }}"></script> -->
    <script src="{{ asset('front-theme/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('front-theme/libs/swal/swal.js') }}"></script>



</body>

</html>
