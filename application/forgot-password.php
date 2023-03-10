<?php
$pageTitle = "Forgot Password";
include("includes/header.php");
?>
<style>
	body {
		margin: 0;
		-webkit-text-size-adjust: 100%;
		-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	}

	main{
		height: 100vh;
	}

	.form-control {
		border-radius: 5px;
		height: 45px;
		border: 1px solid #f5f8fa;
		padding: 10px 22px;
		font-size: 14px;
		color: #181c32;
		background: #f5f8fa;
	}

	a {
		text-decoration: none;
		/* color: var(--bs-teal); */
	}

	/* a:hover {
		color: var(--bs-green);
	} */

	/* .privacy-link a {
		color: var(--bs-gray-900);
	} */

	.bold {
		font-weight: bold;
	}

	/* .grey-text {
		color: var(--bs-gray-500);
	} */

	input:hover {
		border: 1px solid lightgrey;
	}

	input:focus {
		border: 1px solid green !important;
		box-shadow: none !important;
	}

	/* .authentication {
		background-color: var(--bs-white);
	} */
</style>
<main>
	<div class="authentication section-padding">
		<!-- authentication -->
		<div class="container h-100">
			<!-- container -->
			<div class="row justify-content-center align-items-center h-100 py-4">
				<!-- row -->
				<div class="col-xl-5 col-md-6 pt-5 mt-4">
					<!-- col -->
					<div class="card ps-2">
						<!-- card -->
						<div class="mini-logo text-center my-16" style="text-align:center;">
							<!-- logo -->
							<a href="index">
								<img style="width:6rem; margin: auto;" src="static/img/logo-2.png" alt="site-logo">
							</a>
						</div>
						<!-- logo -->
						<div class="text-center justify-content-center">
							<h4 class="card-title mt-3">Forgot Password?</h4>
							<p class="my-4 grey-text">Enter your email below and we will send you a link to reset your
								password</p>
						</div>
						<div class="card-body">
							<!-- card body -->
							<form action="#">
								<div class="row">
									<div class="col-12 mb-3">
										<input name="email" type="text" class="form-control bg-light"
											placeholder="Email Address" value>
									</div>
								</div>
								<div class="mt-16 d-grid gap-2 mb-2">
									<button type="submit" class="btn btn-primary mr-2">Reset Password</button>
								</div>
							</form>
							<div class="text-center mt-4">
								<p class="mt-16 mb-0 grey-text">Do not have an account?
									<a href="user-registration">Sign up</a>
								</p>
							</div>
						</div>
						<!-- card body -->
					</div>
					<!-- card -->
				</div>
				<!-- col -->
			</div>
			<!-- row -->
		</div>
		<!-- container -->
	</div>
	<!-- authentication -->
</main>
<?php
include("includes/footer.php");
?>