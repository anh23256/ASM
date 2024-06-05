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

	<!-- COMMON SCRIPTS -->
	<script src="{{asset('assets/Client/js/common_scripts.min.js')}}"></script>
	<script src="{{asset('assets/Client/js/main.js')}}"></script>

	<!-- SPECIFIC SCRIPTS -->
	<script src="{{asset('assets/Client/js/carousel-home-2.js')}}"></script>
	<script>
		// Client type Panel
		$('input[name="client_type"]').on("click", function() {
			var inputValue = $(this).attr("value");
			var targetBox = $("." + inputValue);
			$(".box").not(targetBox).hide();
			$(targetBox).show();
		});
	</script>
	<script>
		// Other address Panel
		$('#other_addr input').on("change", function() {
			if (this.checked)
				$('#other_addr_c').fadeIn('fast');
			else
				$('#other_addr_c').fadeOut('fast');
		});
	</script>
	<script src="{{asset('assets/Client/js/carousel_with_thumbs.js')}}"></script>
</body>

</html>