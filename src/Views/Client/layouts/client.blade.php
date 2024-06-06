<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Ansonika">
	<title>@yield('title')</title>
	@include('layouts.partials.head')
</head>

<body>

	<div id="page">

		<header class="version_1">
			@include('layouts.partials.nav')
		</header>
		<!-- /header -->

		<main>
			<!-- phẩn đầu trang sản phẩm nổi bật -->
			@yield('content')
			<!-- /container -->
		</main>
		<!-- /main -->
		<!-- footer -->
		<footer class="revealed">
			@include('layouts.partials.footer')
		</footer>
		<!--/footer-->
	</div>
	<!-- page -->
	<div id="toTop"></div><!-- Back to top button -->
	@include('layouts.partials.script')
	@yield('scripts')
</body>

</html>