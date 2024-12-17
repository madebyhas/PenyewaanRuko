<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="{{ asset('landing/images/favicon.png') }}">
	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Source+Serif+Pro:wght@400;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('landing/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('landing/css/owl.theme.default.min.css') }}">
	<link rel="stylesheet" href="{{ asset('landing/css/jquery.fancybox.min.css') }}">
	<link rel="stylesheet" href="{{ asset('landing/fonts/icomoon/style.css') }}">
	<link rel="stylesheet" href="{{ asset('landing/fonts/flaticon/font/flaticon.css') }}">
	<link rel="stylesheet" href="{{ asset('landing/css/daterangepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('landing/css/aos.css') }}">
	<link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">

	<title>AksaraFoodsCourt</title>
</head>

<body>
    <div class="wrapper">
        @include('landing.partials.nav')
        <div class="content-wrapper">
            @yield('container')
        </div>
    </div>
    @include('landing.partials.footer')
       
    </div>

    <script src="{{ asset('landing/js/jquery-3.4.1.min.js') }}"></script>
	<script src="{{ asset('landing/js/popper.min.js') }}"></script>
	<script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('landing/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('landing/js/jquery.animateNumber.min.js') }}"></script>
	<script src="{{ asset('landing/js/jquery.waypoints.min.js') }}"></script>
	<script src="{{ asset('landing/js/jquery.fancybox.min.js') }}"></script>
	<script src="{{ asset('landing/js/aos.js') }}"></script>
	<script src="{{ asset('landing/js/moment.min.js') }}"></script>
	<script src="{{ asset('landing/js/daterangepicker.js') }}"></script>

	<script src="{{ asset('landing/js/typed.js') }}"></script>
	<script>
		$(function() {
			var slides = $('.slides'),
			images = slides.find('img');

			images.each(function(i) {
				$(this).attr('data-id', i + 1);
			})

			var typed = new Typed('.typed-words', {
				strings: ["San Francisco."," Paris."," New Zealand.", " Maui.", " London."],
				typeSpeed: 80,
				backSpeed: 80,
				backDelay: 4000,
				startDelay: 1000,
				loop: true,
				showCursor: true,
				preStringTyped: (arrayPos, self) => {
					arrayPos++;
					console.log(arrayPos);
					$('.slides img').removeClass('active');
					$('.slides img[data-id="'+arrayPos+'"]').addClass('active');
				}

			});
		})

		document.getElementById('metode').addEventListener('change', function() {
        const selectedValue = this.value;

        // Sembunyikan semua informasi rekening terlebih dahulu
        document.querySelectorAll('.account-info').forEach(function(div) {
            div.style.display = 'none';
        });

        // Tampilkan informasi rekening sesuai pilihan
        if (selectedValue === 'BCA') {
            document.getElementById('bca-info').style.display = 'block';
        } else if (selectedValue === 'Mandiri') {
            document.getElementById('mandiri-info').style.display = 'block';
        } else if (selectedValue === 'BRI') {
            document.getElementById('bri-info').style.display = 'block';
        }
    });
	</script>

	<script src="{{ asset('landing/js/custom.js') }}"></script>

</body>
</html>