<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<base href="{!!asset('')!!}">
	<!-- App favicon -->
    <link rel="shortcut icon" href="hpbook/images/39c70677-cb25-4c54-9951-25862ec1756a.png">
	<link rel="stylesheet" href="hpbook/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="hpbook/css/style.css">
	<link rel="stylesheet" href="hpbook/fontawesome-free-5.3.1-web/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=vietnamese" rel="stylesheet">
	<!-- style page product -->
	<link rel="stylesheet" href="hpbook/css/style-product.css">


	<!-- style page login -->
	<link rel="stylesheet" href="hpbook/css/login.css">
	<!-- style page register -->
	<link rel="stylesheet" href="hpbook/css/register.css">
	<!-- style page change password -->
	<link rel="stylesheet" href="hpbook/css/change-pass.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">
    <link rel="stylesheet" href="hpbook/css/megamenu.css">
    @yield('css')
    <!-- JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script>
        window.Modernizr || document.write('<script src="hpbook/js/vendor/modernizr-2.8.3.min.js"><\/script>')
    </script>
</head>
<body>
	@include('hpbook.blocks.header')
	@yield('content')
	<!-- banner bot -->
	<div class="container mt-2 mt-md-4">
		<div class="row">
			{{--<div class="col-12">--}}
				{{--@php--}}
					{{--$banner = DB::table('banners')->get();--}}
				{{--//dd($banner);--}}
				{{--@endphp--}}
			{{--<img class="banner-bot" src="admin_public/upload/banners/{!!$banner[1]->image!!}" alt="{!!$banner[1]->image!!}">--}}
			{{--</div>--}}
		</div>
	</div>
	<!-- footer -->
	@include('hpbook.blocks.footer')
	<!-- end footer -->

	<script src="hpbook/jquery/jquery-3.3.1.min.js"></script>
	<script src="hpbook/jquery/popper.js"></script>
	<script src="hpbook/bootstrap/js/bootstrap.min.js"></script>
	<script src="hpbook/js/submenu.js"></script>
	
	<script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')
    </script>
    <script src="hpbook/js/megamenu.js"></script>
    @yield('script')
</body>
</html>