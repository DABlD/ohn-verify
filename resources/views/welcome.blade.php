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

	 <style>
	 	
	 	.row {
	 	  display: grid;
	 	  grid-template-columns: [labels] auto [controls] 1fr;
	 	  grid-auto-flow: row;
	 	  grid-gap: .8em;
	 	  background: #eee;
	 	  padding-left: 1.2em;
	 	  padding-right: 1.2em;
	 	  padding-bottom: 0.6em;
	 	  padding-top: 0.6em;
	 	}
	 	.row > label  {
	 	  grid-column: labels;
	 	  grid-row: auto;
	 	}
	 	.row > input,
	 	  grid-column: controls;
	 	  grid-row: auto;
	 	  border: none;
	 	  padding: 1em;
	 	}
	 </style>
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

	<script src="js/es6-shim.js"></script>
    <script src="js/websdk.client.bundle.min.js"></script>
    <script src="js/fingerprint.sdk.min.js"></script>
    <script src="js/custom2.js"></script>

	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		});

		var code = null;

		function verify(){
			Swal.fire({
				title: 'Scan the QR',
				html: `
					<img src="{{ asset('images/qr.png') }}">
				`,
			});
		}

		function checkNeedFP(){
			setTimeout(() => {
				$.ajax({
					url: '{{ route('checkNeedFP') }}',
					success: result => {
						result = JSON.parse(result);
						
						code = result.code;
						let data = JSON.parse(result.data);
						let img1 = JSON.parse(result.idImageUrl);
						let img2 = JSON.parse(result.selfieImageUrl);

						let string = "";

						Object.keys(data).forEach((i, j, value) =>{
							string += `
								<div class="row">
								  <label class="asd" for="${i}">${i}</label>
								  <input class="zxc" type="text" name="${i}" value=" ${data[i] ?? "-"}" required>
								</div>
							`;
						});

						Swal.fire({
							title: "Details",
							html: `
								<img src="${img2}" alt="Selfie" width="50%">
								<img src="${img1}" alt="ID" width="50%">
								<div id="verifying">
									${string}
								</div>
							`,
							confirmButtonText: "Take Fingerprint",
						}).then(result => {
							if(result.value){
								Swal.fire({
									title: "Put finger in Biometrics",
									html: `
										<img src="{{ asset("images/fp.jpg") }}" width="20%" alt="IMG">
									`,
									didOpen: () => {
										Swal.showLoading();
										myReader.reader.startCapture();
									}
								});
							}
						});
					},
				});

				// checkNeedFP();
			}, 10000);
		}
		checkNeedFP();
	</script>

</body>
</html>