<?php
$pageTitle = "Verify Account";
include("includes/utils.php");
include("includes/job_connect.php");
include("scripts/services/send-sms.php");

if (isset($_SESSION['user_id'], $_SESSION['is_verified'])) {
	if ($_SESSION['is_verified'] == 1) {
		header("Location: index.php");
	}
} else {
	header('Location: index.php');
}

$validPhone = "";
$phone = isset($_POST['phone']) ? $_POST['phone'] : "";
$user_id = $_SESSION['user_id'];
$inputCode = isset($_POST['code']) ? $_POST['code'] : 0;
$action = isset($_POST['action']) ? $_POST['action'] : null;
$alerts = "";
$redirect = false;
$codeR = mt_rand((10 ** 6) / 10, (10 ** 6) - 1);

if ($phone && $action == 1) {
	// Phone number submitted, awaiting verification code
	$phone = preg_replace("/[^0-9]/", "", $phone);
	if (strlen($phone) == 10) {

		try {
			$res = mysqli_query($jobConn, "SELECT * FROM verification WHERE user_id = " . $user_id);

			if (mysqli_num_rows($res) == 1) {
				mysqli_query($jobConn, "UPDATE verification SET phone = $phone, code = $codeR, creation_date = NOW() WHERE user_id = " . $user_id);
			} else {
				mysqli_query($jobConn, "INSERT INTO verification (user_id, phone, code) VALUES (" . $user_id . ", $phone, $codeR)");
			}

			// Send SMS
			$message = "Your verification code is: " . $codeR;
			sendSMS($phone, $message);

			$validPhone = $phone;
		} catch (Exception $e) {
			$alerts = "<div class='fatal alert alert-danger'>An error has occurred. Please try again later.</div>";
		}
	} else {
		$alerts = "<div class='alert alert-danger'>Please enter a valid phone number</div>";
	}
} else if ($phone && $action == 2) {
	// Phone number and code submitted, verify code
	$phone = preg_replace("/[^0-9]/", "", $phone);
	$inputCode = preg_replace("/[^0-9]/", "", $inputCode);

	if (strlen($phone) == 10 && strlen($inputCode) == 6) {

		try {
			$res = mysqli_query($jobConn, "SELECT * FROM verification WHERE user_id = " . $user_id . " AND phone = $phone AND code = $inputCode");
		} catch (Exception $e) {
			$alerts = "Error: " . $e->getMessage();
		}

		if (mysqli_num_rows($res) == 1) {
			try {
				// Verification successful, update user's phone number and validation status
				mysqli_query($jobConn, "UPDATE user SET phone_number = $phone, is_verified = 1 WHERE user_id = " . $user_id);

				// Delete verification record
				mysqli_query($jobConn, "DELETE FROM verification WHERE user_id = " . $user_id);

				$alerts .= "<div id='success' class='alert alert-success mt-3' role='alert'>Verification Successful</div>";

				$_SESSION['is_verified'] = 1;

				$redirect = true;
			} catch (Exception $e) {
				$alerts .= "<div class='fatal alert alert-danger' role='alert'>An error has occurred. Please try again later.</div>";
			}
		} else {
			$alerts .= "<div class='alert alert-danger' role='alert'>Incorrect verification code</div>";
		}
	} else {
		$alerts .= "<div class='alert alert-danger' role='alert'>Please enter a valid phone number and verification code</div>";
	}
}
include("includes/header.php");
?>
<style>
	main {
		display: flex;
		align-items: center;
		justify-content: center;
		height: calc(100vh - 62px);
		background-color: #F3F2F1;
	}

	div.verify-container {
		padding: 0;
		width: 480px;
	}

	a {
		text-decoration: none;
	}

	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	input[type=number] {
		-moz-appearance: textfield;
	}

	.alert {
		margin-bottom: 1rem;
	}
</style>
<main>
	<div class="container verify-container">
		<!-- <div class="mini-logo text-center my-16" style="text-align:center;">
			<a href="index">
				<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi mb-3 bi-bootstrap-fill" viewBox="0 0 16 16">
					<path d="M6.375 7.125V4.658h1.78c.973 0 1.542.457 1.542 1.237 0 .802-.604 1.23-1.764 1.23H6.375zm0 3.762h1.898c1.184 0 1.81-.48 1.81-1.377 0-.885-.65-1.348-1.886-1.348H6.375v2.725z" />
					<path d="M4.002 0a4 4 0 0 0-4 4v8a4 4 0 0 0 4 4h8a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4h-8zm1.06 12V3.545h3.399c1.587 0 2.543.809 2.543 2.11 0 .884-.65 1.675-1.483 1.816v.1c1.143.117 1.904.931 1.904 2.033 0 1.488-1.084 2.396-2.888 2.396H5.062z" />
				</svg>
			</a>
		</div> -->
		<div class="card">
			<div class="text-center justify-content-center">
				<h4 class="card-title mt-3">Verify Your Account</h4>
				<!-- <p class="mb-1">Please enter a valid phone number.</p> -->
			</div>
			<div class="card-body">
				<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
					<div class="row">
						<div class="col-12 mb-3">
							<label class="form-label grey-text bold">Phone Number</label>
							<input name="phone" id="phone" type="tel" class="form-control bg-light" value="<?php if (isset($phone)) { echo $phone; } ?>">
						</div>
						<div style="display: none;" id="div-code" class="col-12 mb-3">
							<label class="form-label grey-text bold">6-Digit Code</label>
							<input name="code" type="number" maxlength="6" id="code" class="form-control bg-light" value="<?php if ($inputCode) { echo $inputCode; } ?>">
						</div>
					</div>
					<div class="my-2" style="width: 100%;">
						<button style="width: 100%;" id="action-btn" type="submit" name="action" value="1" class="btn btn-primary mr-2">Send Verification Code</button>
					</div>
					<?php
					if ($validPhone) {
						echo "<input type='hidden' id='phone-num' name='phone' value='" . $validPhone . "'>";
					}
					?>
					<div>
						<style>
							small>button {
								border: none;
								background: none;
								color: #007bff;
								padding: 0;
								font: inherit;
								outline: inherit;
							}

							small>button:hover {
								text-decoration: underline;
							}

							small>button.disabled {
								color: #6c757d;
								cursor: not-allowed;
							}

							button#change-number,
							button#resend-code {
								display: none;
							}
						</style>
						<p class="mt-3 mb-0 grey-text" style="display: flex; justify-content: space-between;">
							<small><button type="submit" id="resend-code" name="action" value="3">Resend Verification Code</button></small>
							<small><button type="button" id="change-number">Change Number</button></small>
						</p>
					</div>
				</form>
			</div>
		</div>
		<?php
		echo $alerts;

		if ($redirect) {
			echo "<script>setTimeout(function(){window.location.href = 'index';}, 3000);</script>";
		}

		if ($action) {
			echo "<span id='action-true'></span>";
		}
		?>
	</div>
</main>
<script>
	// Elements
	var phoneNum = document.getElementById("phone-num");
	var actionBtn = document.getElementById("action-btn");
	var codeField = document.getElementById("code");
	var divCode = document.getElementById("div-code");
	var phoneField = document.getElementById("phone");
	var resendCode = document.getElementById("resend-code");
	var changeNumber = document.getElementById("change-number");

	// Check if element with class fatal exists
	var fatal = document.getElementsByClassName("fatal");
	console.log("Fatal: " + fatal.length);

	// Input control for verification code
	codeField.addEventListener("keydown", function(e) {
		if (e.key.length == 1 && e.key.match(/[^0-9]/g)) {
			e.preventDefault();
		}
		if (this.value.length >= 6 && e.key != "Backspace") {
			e.preventDefault();
		}
	});

	// Input control for phone number
	phoneField.addEventListener("keydown", function(e) {
		if (e.key.length == 1 && e.key.match(/[^0-9]/g)) {
			e.preventDefault();
		}
		if (this.value.length >= 10 && e.key != "Backspace") {
			e.preventDefault();
		}
	});

	changeNumber.addEventListener("click", function() {
		window.location.href = "verify";
	})

	if (codeField.value != "" || actionBtn.value == "2" && fatal.length == 0) {
		divCode.style.display = "block";
		codeField.focus();
	}

	if (document.getElementById("action-true") && fatal.length == 0) {
		actionBtn.value = "2";
		actionBtn.innerHTML = "Verify";
		divCode.style.display = "block";
		changeNumber.style.display = "block";
		resendCode.style.display = "block";
		codeField.focus();
	}

	if (phoneNum) {
		actionBtn.value = "2";
		actionBtn.innerHTML = "Verify";
		phoneField.disabled = true;
	}
</script>
<?php
include("includes/footer.php");
?>