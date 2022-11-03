<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <!--Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Meta Description Start-->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--Meta Description End-->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Favicon-->
    <link rel="icon" href="{{ asset('files/images/icon/fav_icon.png') }}" type="image/x-icon" />

    <!-- Stylesheet-->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
</head>

<body>
    <!-- Nav Bar Start-->
    @include('frontend.layout.navigation')
    <!-- Nav Bar End-->

    <!-- PAGE CONTENT BEGINS -->
    @yield('content')

    <!-- Footer -->
    <!-- Footer Start -->
    <section class="footer">
        <div class="container">
        </div>
    </section>
    <!-- Footer End -->

    <!-- Footer Copyright Start -->
    <section class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="copy">BLRI &copy; {{ date('Y') }} All Rights Reserved
                        &nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp; Powered by <a href="http://lscominc.com/">LS
                            COMMUNICATIONS</a><span></span></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Back to top button -->
    <a id="button"><i class="fas fa-chevron-up"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="{{ asset('frontend/js/popper.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery3.4.1.js') }}"></script>
    <script src="{{ asset('frontend/vendor/owlcarousel/js/owl.carousel.min.js') }}"></script>
    {{-- <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>

</html>

</body>

</html>
