<!doctype html>
<html lang="zxx">
    
<!-- Mirrored from templates.envytheme.com/bexi/default/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Feb 2023 12:40:28 GMT -->
<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Links Of CSS File -->
		<link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/owl.theme.default.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/owl.carousel.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/swiper-bundle.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/flaticon.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/remixicon.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/meanmenu.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/odometer.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/animate.min.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/dark-mode.css') }}">
		<link rel="stylesheet" href="{{ url('assets/css/responsive.css') }}">
		
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="{{ url('assets/images/favicon.png') }}">
		<!-- Title -->
		<title>@yield('title')</title>
    </head>

    <body>
		<!-- Start Preloader Area -->
		{{-- <div class="preloader">
			<div class="lds-ripple">
				<div class="preloader-container">
					<div class="petal"></div>
					<div class="petal"></div>
					<div class="petal"></div>
					<div class="petal"></div>
					<div class="petal"></div>
					<div class="petal"></div>
					<div class="petal"></div>
					<div class="petal"></div>
					<div class="petal-1"></div>
					<div class="petal-1"></div>
					<div class="petal-1"></div>
					<div class="ball"></div>
				</div>
			</div>
		</div> --}}
		<!-- End Preloader Area -->

		<!-- Start Header Area -->
		@include('includes.user.navbar')

		@yield('content')

		@include('includes.user.footer')

		<!-- Start Go Top Area -->
		<div class="go-top">
			<i class="ri-arrow-up-s-fill"></i>
			<i class="ri-arrow-up-s-fill"></i>
		</div>
		<!-- End Go Top Area -->

        <!-- Links of JS File -->
        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery.min.js"></script>
        <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ url('assets/js/meanmenu.min.js') }}"></script>
		<script src="{{ url('assets/js/owl.carousel.min.js') }}"></script>
		<script src="{{ url('assets/js/swiper-bundle.min.js') }}"></script>
		<script src="{{ url('assets/js/appear.min.js') }}"></script>
		<script src="{{ url('assets/js/odometer.min.js') }}"></script>
		<script src="{{ url('assets/js/wow.min.js') }}"></script>
		<script src="{{ url('assets/js/jspdf.debug.js') }}"></script>
		<script src="{{ url('assets/js/form-validator.min.js') }}"></script>
		<script src="{{ url('assets/js/contact-form-script.js') }}"></script>
		<script src="{{ url('assets/js/ajaxchimp.min.js') }}"></script>
		<script src="{{ url('assets/js/custom.js') }}"></script>
    </body>
</html>