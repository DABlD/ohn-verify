<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ "HDR | Verify"}}</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="{{ asset('fonts/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/auth/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('css/auth/hamburgers.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/auth/util.css') }}">
	<link rel="stylesheet" href="{{ asset('css/auth/main.css') }}">
	<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{ asset("images/shdmc.png") }}" width="500" height="300" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('login'); }}" style="margin-bottom: 170px;">
					@csrf
					<span class="login100-form-title">
						SHDMCI
						<br>
						Verification System
					</span>

					{{-- <div class="wrap-input100">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="far fa-id-card"></i>
						</span>
					</div>

					<div class="wrap-input100">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div> --}}
					
					<div class="container-login100-form-btn">
						<a class="login100-form-btn" onclick="verify()">
							Verify
						</a>
					</div>
					
					<div class="container-login100-form-btn">
						<a class="login100-form-btn">
							View List
						</a>
					</div>
					
					{{-- <div class="container-register100-form-btn">
					</div> --}}

					{{-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Password?
						</a>
					</div>
 --}}
					{{-- <div class="text-center p-t-136">
						<a class="txt2" href="{{ route('register') }}">
							Create your account
							<i class="fas fa-arrow-right"></i>
						</a>
					</div> --}}
				</form>
			</div>
		</div>
	</div>

	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap-bundle.min.js') }}"></script>
	<script src="{{ asset('js/auth/tilt.js') }}"></script>
	<script src="{{ asset('js/auth/main.js') }}"></script>
	<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})

		function verify(){
			Swal.fire({
				title: 'Scan the QR',
				html: `
					<img src="{{ asset('images/qr.png') }}">
				`,
			});
		}
	</script>

</body>
</html>