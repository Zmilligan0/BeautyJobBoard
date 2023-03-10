<?php
$candidate_id = $industry = "";
$accl = "2,0";
$pageTitle = "Edit Profile";
include("../includes/job_connect.php");
include("../includes/utils.php");
include("../includes/header.php");
include("../includes/_functions.php");

if (isset($_GET)) {
	extract($_GET);
}

if (isset($_GET['user_id'])) {
	$id = $_GET['user_id'];
	// $result = mysqli_query($conn, "SELECT * FROM candidate WHERE user_id = " . $_SESSION['user_id'] . " LIMIT 1"); 
	$result = mysqli_query($jobConn, "SELECT * FROM candidate WHERE user_id = " . $_SESSION['user_id'] . " LIMIT 1");
	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_array($result);
		$_SESSION['candidate_id'] = $row['candidate_id'];
	} else {
		$message = "<p>There was a problem retrieving the information</p>";
	}
}

$sql = "SELECT candidate_id, first_name, last_name From candidate WHERE user_id = '$_SESSION[user_id]'";
$list = $jobConn->query($sql);
while ($row = $list->fetch_assoc()) {
	$candidate_id = $row['candidate_id'];
	$candidate_firstName =  $row['first_name'];
	$candidate_lastName =  $row['last_name'];
}

// get the candidate and user ID
// $conn = new mysqli("localhost", "root", '', "job_platform");
$candidate_id = $_SESSION['candidate_id'];
$user_id_sql = "SELECT user_id From candidate WHERE user_id = '$_SESSION[user_id]'";
$user_id_list = $jobConn->query($user_id_sql);
$user_id = "";

while ($row = $user_id_list->fetch_assoc()) {
	$user_id = $row['user_id'];
}

?>

<body>
	<style>
		.showEditNav {
			visibility: hidden;
			position: absolute;
		}

		.dont-show {
			visibility: visible;
			position: static;
		}

		#main-div {
			width: 100%;
			margin-top: 2%;
			margin-left: 4%;
			margin-right: 4%;
			line-height: 2;
		}
		
		/* #main-div p{
			margin-top: 1rem;
		} */

		.category-form {
			width: 90%;
		}

		.edit-button {
			text-decoration: none;
		}

		.edit-button:hover {
			text-decoration: underline;
		}

		/* .display-info {
			width: 750px;
		}

		.display-info-medium {
			width: 250px;
		}

		.display-info-small {
			width: 75px;
		} */

		.description-button {
			max-height: 40px;
		}

		img {
			max-width:30rem;
			height: 10rem;
		}
	</style>
	<style>
		.bi {
			vertical-align: -.125em;
			pointer-events: none;
		}

		.posting-mobile-view {
			width: 50%;
		}

		.search-icon {
			display: none;
		}

		.list-height {
			height: 45rem;
		}

		.pencil-bg {
			background-color: #eef0fc;
			color: #556ee6;
		}

		.pencil-bg:hover {
			color: #eef0fc;
			background-color: #556ee6;
		}

		.deleteTrash {
			background-color: #fef0f0;
			color: #f57575;
		}

		.deleteTrash:hover {
			background-color: #f57575;
			color: #fef0f0;
		}

		.deletenotvisible {
			visibility: hidden;
			position: absolute;
			background-color: rgba(0, 0, 0, 0.7);
			/* 0.7 = 70% opacity */
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
		}

		.deleteborder {
			background-color: #ffff;
		}

		.deletebutton {
			background-color: #f46a6f;
		}

		.deletebutton :hover {
			background-color: red;
		}

		.side-bar-hide {
			max-width: 0;
			overflow: hidden;
			transition: all 0.15s ease-in-out;
			visibility: hidden;
		}

		.side-bar-hide.active-side-bar {
			max-width: 280px;
			visibility: visible;
		}

		.side-bar-sticky {
			position: sticky;
			top: 0;
			height: 100vh;
		}

		.hide-show-icon {
			visibility: hidden;
			border-radius: 0 7px 7px 0;
		}

		.hamburger-sticky {
			position: absolute;
			top: 0;
			height: 50vh;
		}

		.side-bar {
			background-color: #222222;
		}

		@media (max-width:1460px) {
			.job-description-hide {
				visibility: hidden;
				position: absolute;
			}

			.posting-mobile-view {
				width: 100%;
			}
		}

		@media (max-width:575px) {
			.desktop-view-button {
				display: none;
			}

			.search-icon {
				display: inline;
			}

			.search-bar-mobile-view {
				margin-bottom: 1rem;
			}
		}
	</style>

	<main class="d-flex">
		<div class="hamburger-sticky" id="hamburger-position">
			<button class="bg-dark text-white border-0 start-0 mt-3 hide-show-icon  " onclick="show()" id="showIcon">
				<svg xmlns="http://www.w3.org/2000/svg" width="40" height="35" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
				</svg>
			</button>
		</div>
		<!-- Side Bar -->
		<div class="d-flex flex-column flex-shrink-0 p-3 text-white side-bar side-bar-sticky side-bar-hide active-side-bar" style="width: 280px;" id="try">
			<div class="d-flex flex-row justify-content-between">
				<!-- <a href="../candidate-profile"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none ms-lg-4"> -->
				<?php echo "<a href=\"" . ROOT_URL . "candidate-profile?id=$_SESSION[user_id]\" class=\"d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none ms-lg-4\">" ?>
				<span class="fs-4"><?php echo "$candidate_firstName" . " $candidate_lastName"; ?></span>
				</a>
				<button class="text-white border-0 w-0" style="background-color: #2f2f2f;" onclick="hide()">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
						<path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
					</svg>
				</button>
			</div>
			<hr>
			<ul class="nav nav-pills flex-column mb-auto">
				<li class="nav-item">
					<!-- <a href="../candidate-profile" class="nav-link text-white"> -->
					<?php echo "<a href=\"" . ROOT_URL . "candidate/edit-profile?id=$_SESSION[user_id]\" class=\"nav-link bg-danger active\" aria-current=\"page\">" ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person me-2" viewBox="0 0 16 16">
						<path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
					</svg>
					Edit Profile
					</a>
				</li>
				<li class="nav-item">
					<!-- <a href="login-security"  class="nav-link text-white"> -->
					<?php echo "<a href=\"" . ROOT_URL . "candidate/login-security?id=$_SESSION[user_id]\" class=\"nav-link text-white\">" ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-check  me-2" viewBox="0 0 16 16">
						<path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
						<path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
					</svg>
					Login & Security
					</a>
				</li>
				<li>
					<!-- <a href="applications" class="nav-link active" aria-current="page"> -->
					<?php echo "<a href=\"" . ROOT_URL . "candidate/applications?id=$_SESSION[user_id]\" class=\"nav-link text-white\">" ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase me-2" viewBox="0 0 16 16">
						<path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
					</svg>
					My Applications
					</a>
				</li>
				<li>
					<?php echo "<a href=\"" . ROOT_URL . "candidate/saved_jobs?id=$_SESSION[user_id]\" class=\"nav-link text-white\">" ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark me-2" viewBox="0 0 16 16">
						<path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
					</svg>
					Saved Jobs
					</a>
				</li>
			</ul>
		</div>
		<!-- side bar -->
		<!-- </div> -->


		<?php

		$result = mysqli_query($jobConn, "SELECT * FROM candidate WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));


		$current_user = mysqli_fetch_array($result);
		$first_name = $current_user['first_name'];
		$last_name = $current_user['last_name'];
		$description = $current_user['personal_description'];
		$gender = $current_user['gender'];
		$pronouns = $current_user['pronouns'];
		$city = $current_user['city'];
		$province = $current_user['province'];
		$country = $current_user['country'];
		$website = $current_user['website_url'];
		$facebook = $current_user['facebook'];
		$instagram = $current_user['instagram'];
		$twitter = $current_user['linkedin'];
		$tiktok = $current_user['tiktok'];
		$youtube = $current_user['youtube'];
		$headline = $current_user['headline'];

		$profileImage = $current_user['profile_photo'];
		$bannerImage = $current_user['banner_photo'];

		if (isset($_POST['profilesubmit'])) {
			$newProfile = $_FILES["myprofile"]["name"];
			$validProfile = 1;
			$validBanner = 1;
			$msgPre = "<div class=\"alert alert-danger\" role=\"alert\">";
			$msgSucPre = "<div class=\"alert alert-success\" role=\"alert\">";
			$msgPost = "</div>";

			if ($newProfile != "") {
				if (($_FILES["myprofile"]["type"] != "image/jpeg") && ($_FILES["myprofile"]["type"] != "image/png")) {
					$validProfile = 0;
					$valProfileMessage = "Not a valid JPG/PNG";
				} //elseif (($_FILES["myprofile"]["size"]/1024)/1024 > 32){ //less than 32MB
				//$valid = 0;
				//$valFileMessage = "The uploaded image should be less that 32MB!";
				//}


			} else {
				$validProfile = 0;
				$valProfileMessage = "Please select a upload image.";
			}

			if ($validProfile == 1) {
				$profilePrefix = "candidate_profile" . $_SESSION['candidate_id'] . "_";

				if ($_FILES["myprofile"]["type"] == "image/jpeg") {
					$uniqFilename = uniqid($profilePrefix) . '.jpg';
				} else {
					$uniqFilename = uniqid($profilePrefix) . '.png';
				}

				//$thisFile = $imgOriginals . $uniqFilename;
				$thisFile = "../uploads/img/original/" . $uniqFilename;
				$companyProfileImagePath = "../uploads/img/profiles/";
				if (move_uploaded_file($_FILES["myprofile"]["tmp_name"], $thisFile)) {
					//here is a greater place to create our thumbs, as validation has passed, and the image has been uploaded

					if ($_FILES["myprofile"]["type"] == "image/jpeg") {
						createSquareImageCopy($thisFile, "$companyProfileImagePath", 200);
					} else {
						createSquareImageCopyPNG($thisFile, "$companyProfileImagePath", 200);
					}
				} else {
					echo "error";
				};

				//$theID =  $_SESSION['candidateID'];
				mysqli_query($jobConn, "UPDATE candidate SET profile_photo='$uniqFilename' WHERE candidate_id=" . $_SESSION['candidate_id']) or die(mysqli_error($jobConn));
				$validSucMsg = "Profile Image Uploaded!";
				echo "<meta http-equiv=\"refresh\" content=\"0;url=edit-profile.php?id=$id\" />";
			}
		}

		if (isset($_POST['bannersubmit'])) {
			$newBanner = $_FILES["mybanner"]["name"];
			$validBanner = 1;
			$msgPre = "<div class=\"alert alert-danger\" role=\"alert\">";
			$msgSucPre = "<div class=\"alert alert-success\" role=\"alert\">";
			$msgPost = "</div>";

			if ($newBanner != "") {
				if (($_FILES["mybanner"]["type"] != "image/jpeg") && ($_FILES["mybanner"]["type"] != "image/png")) {
					$validBanner = 0;
					$valBannerMessage = "Not a valid JPG/PNG";
				} //elseif (($_FILES["myprofile"]["size"]/1024)/1024 > 32){ //less than 32MB
				//$valid = 0;
				//$valFileMessage = "The uploaded image should be less that 32MB!";
				//}


			} else {
				$validBanner = 0;
				$valBannerMessage = "Please select a upload image.";
			}

			if ($validBanner == 1) {
				$profilePrefix = "candidate_banner" . $_SESSION['candidate_id'] . "_";

				if ($_FILES["mybanner"]["type"] == "image/jpeg") {
					$uniqFilename = uniqid($profilePrefix) . '.jpg';
				} else {
					$uniqFilename = uniqid($profilePrefix) . '.png';
				}

				//$thisFile = $imgOriginals . $uniqFilename;
				$thisFile = "../uploads/img/original/" . $uniqFilename;
				$companyBannerImagePath = "../uploads/img/banner/";
				if (move_uploaded_file($_FILES["mybanner"]["tmp_name"], $thisFile)) {
					//here is a greater place to create our thumbs, as validation has passed, and the image has been uploaded

					if ($_FILES["mybanner"]["type"] == "image/jpeg") {
						createBanner($thisFile, "$companyBannerImagePath", 1400, 200);
					} else {
						createBannerPNG($thisFile, "$companyBannerImagePath", 1400,  200);
					}
				} else {
					echo "error";
				};
				//$theID =  $_SESSION['candidateID'];
				mysqli_query($jobConn, "UPDATE candidate SET banner_photo='$uniqFilename' WHERE candidate_id=" . $_SESSION['candidate_id']) or die(mysqli_error($jobConn));
				$validSucMsg = "Banner Image Uploaded!";
				echo "<meta http-equiv=\"refresh\" content=\"0;url=edit-profile.php?id=$id\" />";
			}
		}

		?>


		<div id="main-div">
			<!-- <h2 class="mb-5">Personal Info</h2> -->

			<div class="d-flex row">
				<div class="col-lg-6 col-sm-12">
					<form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
						<div>
							<div>
								<?php
								if ($profileImage == "") {
									$profileImagePath = $companyProfileImagePath . "default.png"; //path can be changed in the _function.php file
								} else {
									$profileImagePath = $companyProfileImagePath . $profileImage;
								}
								echo "<img src=\"$profileImagePath\" alt=\"Candidate profile picture\">";
								?>
							</div>
							<div class="d-flex row p-2">
								<div class="form-group col-7">
									<label class="form-label" for="myprofile">Profile Image</label>
									<input class="form-control" type="file" name="myprofile" />
									<?php if (isset($valProfileMessage)) {
										echo $msgPre . $valProfileMessage . $msgPost;
									} ?>
								</div>
								<div class="form-group col-5" style="margin-top: 2.4rem;">
									<label for="profilesubmit">&nbsp;</label>
									<input type="submit" name="profilesubmit" class="btn btn-danger" value="Upload Profile">
								</div>
							</div>
						</div>
					</form>
				</div>

				<div class="col-lg-6 col-sm-12">
					<form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
						<div>
							<?php
							if ($bannerImage == "") {
								$bannerImagePath = $companyBannerImagePath . "default.png"; //path can be changed in the _function.php file
							} else {
								$bannerImagePath = $companyBannerImagePath . $bannerImage;
							}
							echo "<img src=\"$bannerImagePath\" alt=\"Candidate banner picture\">";
							?>
						</div>
						<div class="d-flex row p-2">
							<div class="form-group col-7">
								<label class="form-label" for="mybanner">Banner Image</label>
								<input class="form-control" type="file" name="mybanner" />
								<?php if (isset($valBannerMessage)) {
									echo $msgPre . $valBannerMessage . $msgPost;
								} ?>
							</div>
							<div class="form-group col-5" style="margin-top: 2.4rem;">
								<label for="bannersubmit">&nbsp;</label>
								<input type="submit" name="bannersubmit" class="btn btn-danger" value="Upload Banner">
							</div>
						</div>
						
					</form>
				</div>

			</div>


			<?php
			if (isset($_GET['success'])) {
				$validSucMsg = 'You have successfully updated ' . $_GET['success'];
			}
			if (isset($_GET['failure'])) {
				$invalidSucMsg = 'Warning: ' . $_GET['failure'] . ' failed to update.';
			}
			if (isset($_GET['add'])) {
				$addSucMsg = 'You have successfully added a new ' . $_GET['add'];
			}
			if (isset($_GET['delete'])) {
				$addSucMsg = 'You have successfully deleted your ' . $_GET['delete'];
			}

			if (isset($validSucMsg)) {
				$msgSucPre = "<div class=\"alert alert-success\" role=\"alert\">";
				$msgPost = "</div>"; {
					echo $msgSucPre . $validSucMsg . $msgPost;
				}
			}
			if (isset($invalidSucMsg)) {
				$msgSucPre = "<div class=\"alert alert-danger\" role=\"alert\">";
				$msgPost = "</div>"; {
					echo $msgSucPre . $invalidSucMsg . $msgPost;
				}
			}
			if (isset($addSucMsg)) {
				$msgSucPre = "<div class=\"alert alert-success\" role=\"alert\">";
				$msgPost = "</div>"; {
					echo $msgSucPre . $addSucMsg . $msgPost;
				}
			}
			echo '

	<div class="card p-4 mt-3">

		<h2 class="">Personal Info</h2>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div id="" class="fw-bold position-absolute d-flex">
								<p id="first-name-title" >First Name</p>
								<p class="text-danger" title="required">*</p>
							</div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="first-name-display" class="d-none form-label">' . $first_name . '</p>
							<input type="text" class="d-none form-control" id="first-name-edit" name="first-name-edit" maxlength="50" autofocus value="' . $first_name . '" required>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=first-name&id=' . $user_id . '" id="first-name-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitA" id="first-name-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="first-name-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div id=""class="fw-bold position-absolute d-flex">
								<p id="last-name-title">Last Name</p>
								<p class="text-danger" title="required">*</p>
							</div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="last-name-display" class="d-none">' . $last_name . '</p>
							<input type="text" class="d-none" id="last-name-edit" name="last-name-edit" maxlength="50" autofocus value="' . $last_name . '" required>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=last-name&id=' . $user_id . '" id="last-name-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitB" id="last-name-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="last-name-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>
		
		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>						
							<p id="description-title"class="fw-bold position-absolute">Description</p>
							<p id="description-display" class="d-none">' . $description . '</p>
							<textarea id="description-edit" class="d-none" name="description-edit" rows="8" cols="80" autofocus>' . $description . '</textarea>
						</div>
					</div>
					<div class="d-flex justify-content-end ms-2">
						<a href="edit-profile?section=description&id=' . $user_id . '" id="description-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitC" id="description-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="description-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>

			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div id=""class="fw-bold position-absolute d-flex">
								<p id="gender-title">Gender</p>
							</div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="gender-display" class="d-none">' . $gender . '</p>
							<select type="text" id="gender-edit" class="d-none" name="gender-edit" autofocus value="' . $gender . '" required>
								<option value="M">Male</option>
								<option value="F">Female</option>
								<option value="N">Non-Binary</option>
								<option value="O">Other / Rather not say</option>
							</select>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=gender&id=' . $user_id . '" id="gender-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitD" id="gender-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="gender-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="pronouns-title"class="fw-bold position-absolute">Pronouns</p>
							<p id="pronouns-display" class="d-none">' . $pronouns . '</p>
							<input type="text" id="pronouns-edit" class="d-none" name="pronouns-edit" maxlength="15" autofocus value="' . $pronouns . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=pronouns&id=' . $user_id . '" id="pronouns-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitE" id="pronouns-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="pronouns-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="city-title"class="fw-bold position-absolute">City</p>
							<p id="city-display" class="d-none">' . $city . '</p>
							<input type="text" id="city-edit" class="d-none" name="city-edit" maxlength="40" autofocus value="' . $city . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=city&id=' . $user_id . '" id="city-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitF" id="city-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="city-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="province-title"class="fw-bold position-absolute">Province</p>
							<p id="province-display" class="d-none">' . $province . '</p>
							<select type="text" id="province-edit" class="d-none" name="province-edit" autofocus value="' . $province . '">
								<option value="AB">Alberta</option>
								<option value="BC">British Columbia</option>
								<option value="MB">Manitoba</option>
								<option value="NB">New Brunswick</option>
								<option value="NL">Newfoundland and Labrador</option>
								<option value="NT">Northwest Territories</option>
								<option value="NS">Nova Scotia</option>
								<option value="NU">Nunavut</option>
								<option value="ON">Ontario</option>
								<option value="PE">Prince Edward Island</option>
								<option value="QC">Quebec</option>
								<option value="SK">Saskatchewan</option>
								<option value="YT">Yukon</option>
							</select>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=province&id=' . $user_id . '" id="province-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitG" id="province-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="province-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="country-title"class="fw-bold position-absolute">Country</p>
							<p id="country-display" class="d-none">' . $country . '</p>
							<select id="country-edit" class="d-none" name="country-edit">
								<option value="Afghanistan">Afghanistan</option>
								<option value="Åland Islands">Åland Islands</option>
								<option value="Albania">Albania</option>
								<option value="Algeria">Algeria</option>
								<option value="American Samoa">American Samoa</option>
								<option value="Andorra">Andorra</option>
								<option value="Angola">Angola</option>
								<option value="Anguilla">Anguilla</option>
								<option value="Antarctica">Antarctica</option>
								<option value="Antigua and Barbuda">Antigua and Barbuda</option>
								<option value="Argentina">Argentina</option>
								<option value="Armenia">Armenia</option>
								<option value="Aruba">Aruba</option>
								<option value="Australia">Australia</option>
								<option value="Austria">Austria</option>
								<option value="Azerbaijan">Azerbaijan</option>
								<option value="Bahamas">Bahamas</option>
								<option value="Bahrain">Bahrain</option>
								<option value="Bangladesh">Bangladesh</option>
								<option value="Barbados">Barbados</option>
								<option value="Belarus">Belarus</option>
								<option value="Belgium">Belgium</option>
								<option value="Belize">Belize</option>
								<option value="Benin">Benin</option>
								<option value="Bermuda">Bermuda</option>
								<option value="Bhutan">Bhutan</option>
								<option value="Bolivia">Bolivia</option>
								<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
								<option value="Botswana">Botswana</option>
								<option value="Bouvet Island">Bouvet Island</option>
								<option value="Brazil">Brazil</option>
								<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
								<option value="Brunei Darussalam">Brunei Darussalam</option>
								<option value="Bulgaria">Bulgaria</option>
								<option value="Burkina Faso">Burkina Faso</option>
								<option value="Burundi">Burundi</option>
								<option value="Cambodia">Cambodia</option>
								<option value="Cameroon">Cameroon</option>
								<option value="Canada">Canada</option>
								<option value="Cape Verde">Cape Verde</option>
								<option value="Cayman Islands">Cayman Islands</option>
								<option value="Central African Republic">Central African Republic</option>
								<option value="Chad">Chad</option>
								<option value="Chile">Chile</option>
								<option value="China">China</option>
								<option value="Christmas Island">Christmas Island</option>
								<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
								<option value="Colombia">Colombia</option>
								<option value="Comoros">Comoros</option>
								<option value="Congo">Congo</option>
								<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
								<option value="Cook Islands">Cook Islands</option>
								<option value="Costa Rica">Costa Rica</option>
								<option value="Cote D\'ivoire">Cote D\'ivoire</option>
								<option value="Croatia">Croatia</option>
								<option value="Cuba">Cuba</option>
								<option value="Cyprus">Cyprus</option>
								<option value="Czech Republic">Czech Republic</option>
								<option value="Denmark">Denmark</option>
								<option value="Djibouti">Djibouti</option>
								<option value="Dominica">Dominica</option>
								<option value="Dominican Republic">Dominican Republic</option>
								<option value="Ecuador">Ecuador</option>
								<option value="Egypt">Egypt</option>
								<option value="El Salvador">El Salvador</option>
								<option value="Equatorial Guinea">Equatorial Guinea</option>
								<option value="Eritrea">Eritrea</option>
								<option value="Estonia">Estonia</option>
								<option value="Ethiopia">Ethiopia</option>
								<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
								<option value="Faroe Islands">Faroe Islands</option>
								<option value="Fiji">Fiji</option>
								<option value="Finland">Finland</option>
								<option value="France">France</option>
								<option value="French Guiana">French Guiana</option>
								<option value="French Polynesia">French Polynesia</option>
								<option value="French Southern Territories">French Southern Territories</option>
								<option value="Gabon">Gabon</option>
								<option value="Gambia">Gambia</option>
								<option value="Georgia">Georgia</option>
								<option value="Germany">Germany</option>
								<option value="Ghana">Ghana</option>
								<option value="Gibraltar">Gibraltar</option>
								<option value="Greece">Greece</option>
								<option value="Greenland">Greenland</option>
								<option value="Grenada">Grenada</option>
								<option value="Guadeloupe">Guadeloupe</option>
								<option value="Guam">Guam</option>
								<option value="Guatemala">Guatemala</option>
								<option value="Guernsey">Guernsey</option>
								<option value="Guinea">Guinea</option>
								<option value="Guinea-bissau">Guinea-bissau</option>
								<option value="Guyana">Guyana</option>
								<option value="Haiti">Haiti</option>
								<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
								<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
								<option value="Honduras">Honduras</option>
								<option value="Hong Kong">Hong Kong</option>
								<option value="Hungary">Hungary</option>
								<option value="Iceland">Iceland</option>
								<option value="India">India</option>
								<option value="Indonesia">Indonesia</option>
								<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
								<option value="Iraq">Iraq</option>
								<option value="Ireland">Ireland</option>
								<option value="Isle of Man">Isle of Man</option>
								<option value="Israel">Israel</option>
								<option value="Italy">Italy</option>
								<option value="Jamaica">Jamaica</option>
								<option value="Japan">Japan</option>
								<option value="Jersey">Jersey</option>
								<option value="Jordan">Jordan</option>
								<option value="Kazakhstan">Kazakhstan</option>
								<option value="Kenya">Kenya</option>
								<option value="Kiribati">Kiribati</option>
								<option value="Korea, Democratic People\'s Republic of">Korea, Democratic People\'s Republic of</option>
								<option value="Korea, Republic of">Korea, Republic of</option>
								<option value="Kuwait">Kuwait</option>
								<option value="Kyrgyzstan">Kyrgyzstan</option>
								<option value="Lao People\'s Democratic Republic">Lao People\'s Democratic Republic</option>
								<option value="Latvia">Latvia</option>
								<option value="Lebanon">Lebanon</option>
								<option value="Lesotho">Lesotho</option>
								<option value="Liberia">Liberia</option>
								<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
								<option value="Liechtenstein">Liechtenstein</option>
								<option value="Lithuania">Lithuania</option>
								<option value="Luxembourg">Luxembourg</option>
								<option value="Macao">Macao</option>
								<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
								<option value="Madagascar">Madagascar</option>
								<option value="Malawi">Malawi</option>
								<option value="Malaysia">Malaysia</option>
								<option value="Maldives">Maldives</option>
								<option value="Mali">Mali</option>
								<option value="Malta">Malta</option>
								<option value="Marshall Islands">Marshall Islands</option>
								<option value="Martinique">Martinique</option>
								<option value="Mauritania">Mauritania</option>
								<option value="Mauritius">Mauritius</option>
								<option value="Mayotte">Mayotte</option>
								<option value="Mexico">Mexico</option>
								<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
								<option value="Moldova, Republic of">Moldova, Republic of</option>
								<option value="Monaco">Monaco</option>
								<option value="Mongolia">Mongolia</option>
								<option value="Montenegro">Montenegro</option>
								<option value="Montserrat">Montserrat</option>
								<option value="Morocco">Morocco</option>
								<option value="Mozambique">Mozambique</option>
								<option value="Myanmar">Myanmar</option>
								<option value="Namibia">Namibia</option>
								<option value="Nauru">Nauru</option>
								<option value="Nepal">Nepal</option>
								<option value="Netherlands">Netherlands</option>
								<option value="Netherlands Antilles">Netherlands Antilles</option>
								<option value="New Caledonia">New Caledonia</option>
								<option value="New Zealand">New Zealand</option>
								<option value="Nicaragua">Nicaragua</option>
								<option value="Niger">Niger</option>
								<option value="Nigeria">Nigeria</option>
								<option value="Niue">Niue</option>
								<option value="Norfolk Island">Norfolk Island</option>
								<option value="Northern Mariana Islands">Northern Mariana Islands</option>
								<option value="Norway">Norway</option>
								<option value="Oman">Oman</option>
								<option value="Pakistan">Pakistan</option>
								<option value="Palau">Palau</option>
								<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
								<option value="Panama">Panama</option>
								<option value="Papua New Guinea">Papua New Guinea</option>
								<option value="Paraguay">Paraguay</option>
								<option value="Peru">Peru</option>
								<option value="Philippines">Philippines</option>
								<option value="Pitcairn">Pitcairn</option>
								<option value="Poland">Poland</option>
								<option value="Portugal">Portugal</option>
								<option value="Puerto Rico">Puerto Rico</option>
								<option value="Qatar">Qatar</option>
								<option value="Reunion">Reunion</option>
								<option value="Romania">Romania</option>
								<option value="Russian Federation">Russian Federation</option>
								<option value="Rwanda">Rwanda</option>
								<option value="Saint Helena">Saint Helena</option>
								<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
								<option value="Saint Lucia">Saint Lucia</option>
								<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
								<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
								<option value="Samoa">Samoa</option>
								<option value="San Marino">San Marino</option>
								<option value="Sao Tome and Principe">Sao Tome and Principe</option>
								<option value="Saudi Arabia">Saudi Arabia</option>
								<option value="Senegal">Senegal</option>
								<option value="Serbia">Serbia</option>
								<option value="Seychelles">Seychelles</option>
								<option value="Sierra Leone">Sierra Leone</option>
								<option value="Singapore">Singapore</option>
								<option value="Slovakia">Slovakia</option>
								<option value="Slovenia">Slovenia</option>
								<option value="Solomon Islands">Solomon Islands</option>
								<option value="Somalia">Somalia</option>
								<option value="South Africa">South Africa</option>
								<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
								<option value="Spain">Spain</option>
								<option value="Sri Lanka">Sri Lanka</option>
								<option value="Sudan">Sudan</option>
								<option value="Suriname">Suriname</option>
								<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
								<option value="Swaziland">Swaziland</option>
								<option value="Sweden">Sweden</option>
								<option value="Switzerland">Switzerland</option>
								<option value="Syrian Arab Republic">Syrian Arab Republic</option>
								<option value="Taiwan">Taiwan</option>
								<option value="Tajikistan">Tajikistan</option>
								<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
								<option value="Thailand">Thailand</option>
								<option value="Timor-leste">Timor-leste</option>
								<option value="Togo">Togo</option>
								<option value="Tokelau">Tokelau</option>
								<option value="Tonga">Tonga</option>
								<option value="Trinidad and Tobago">Trinidad and Tobago</option>
								<option value="Tunisia">Tunisia</option>
								<option value="Turkey">Turkey</option>
								<option value="Turkmenistan">Turkmenistan</option>
								<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
								<option value="Tuvalu">Tuvalu</option>
								<option value="Uganda">Uganda</option>
								<option value="Ukraine">Ukraine</option>
								<option value="United Arab Emirates">United Arab Emirates</option>
								<option value="United Kingdom">United Kingdom</option>
								<option value="United States">United States</option>
								<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
								<option value="Uruguay">Uruguay</option>
								<option value="Uzbekistan">Uzbekistan</option>
								<option value="Vanuatu">Vanuatu</option>
								<option value="Venezuela">Venezuela</option>
								<option value="Viet Nam">Viet Nam</option>
								<option value="Virgin Islands, British">Virgin Islands, British</option>
								<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
								<option value="Wallis and Futuna">Wallis and Futuna</option>
								<option value="Western Sahara">Western Sahara</option>
								<option value="Yemen">Yemen</option>
								<option value="Zambia">Zambia</option>
								<option value="Zimbabwe">Zimbabwe</option>
							</select>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=country&id=' . $user_id . '" id="country-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitH" id="country-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="country-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

	</div>


	<div class="card p-4 mt-3">
		<h2 class="">Contact Info</h2>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="website-title"class="fw-bold position-absolute">Website</p>
							<p id="website-display" class="d-none">' . $website . '</p>
							<input type="text" id="website-edit" class="d-none" name="website-edit" maxlength="250" autofocus value="' . $website . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=website&id=' . $user_id . '" id="website-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitI" id="website-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="website-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>

			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="facebook-title"class="fw-bold position-absolute">Facebook</p>
							<p id="facebook-display" class="d-none">' . $facebook . '</p>
							<input type="text" id="facebook-edit" class="d-none" name="facebook-edit" maxlength="250" autofocus value="' . $facebook . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=facebook&id=' . $user_id . '" id="facebook-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitJ" id="facebook-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="facebook-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="instagram-title"class="fw-bold position-absolute">Instagram</p>
							<p id="instagram-display" class="d-none">' . $instagram . '</p>
							<input type="text" id="instagram-edit" class="d-none" name="instagram-edit" maxlength="250" autofocus value="' . $instagram . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=instagram&id=' . $user_id . '" id="instagram-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitK" id="instagram-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="instagram-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>

			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="twitter-title"class="fw-bold position-absolute">Twitter</p>
							<p id="twitter-display" class="d-none">' . $twitter . '</p>
							<input type="text" id="twitter-edit" class="d-none" name="twitter-edit" maxlength="250" autofocus value="' . $twitter . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=twitter&id=' . $user_id . '" id="twitter-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitL" id="twitter-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="twitter-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="tiktok-title"class="fw-bold position-absolute">TikTok</p>
							<p id="tiktok-display" class="d-none">' . $tiktok . '</p>
							<input type="text" id="tiktok-edit" class="d-none" name="tiktok-edit" maxlength="250" autofocus value="' . $tiktok . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=tiktok&id=' . $user_id . '" id="tiktok-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitM" id="tiktok-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="tiktok-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>

			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="youtube-title"class="fw-bold position-absolute">YouTube</p>
							<p id="youtube-display" class="d-none">' . $youtube . '</p>
							<input type="text" id="youtube-edit" class="d-none" name="youtube-edit" maxlength="250" autofocus value="' . $youtube . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=youtube&id=' . $user_id . '" id="youtube-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitN" id="youtube-save-button">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="youtube-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<h2 class="mt-5 ">Experience Info</h2>

	<div class="d-flex row">
		<div class="col-lg-6 col-sm-12 mb-4">
			<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
				<div class="d-flex justify-content-between">
					<div class="d-flex">
						<div class="me-5"></div>
						<div class="me-5"></div>
						<div class="me-5"></div>
						<p id="headline-title"class="fw-bold position-absolute">Headline</p>
						<p id="headline-display" class="d-none">' . $headline . '</p>
						<input type="text" id="headline-edit" class="d-none" name="headline-edit" maxlength="200" autofocus value="' . $headline . '">
					</div>
				</div>
				<div class="d-flex justify-content-end">
					<a href="edit-profile?section=headline&id=' . $user_id . '" id="headline-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
					<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
				</svg></a>
					<input class="d-none" type="submit" value="Save" name="submitO" id="headline-save-button">
					<a href="edit-profile?id=' . $user_id . '" class="d-none" id="headline-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
					<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
					<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
				</svg></a>
				</div>
			</form>
		</div>
	</div>';

	$experience_result = mysqli_query($jobConn, "SELECT experience_id, title, company_name, start_date, end_date, description, employment_type, city, province, country from experience
	WHERE candidate_id = $candidate_id") or die(mysqli_error($jobConn));
		if (mysqli_num_rows($experience_result) < 5) {
		echo '
	<div class="card p-4">
		
			<h3 class="">Add Job</h3>
			<div id="add-job-form">
				<form style="width:100%" action="update.php?user_id=' . $user_id . '" id="" method="POST" enctype="multipart/form-data" class="justify-content-between mt-3">

					<div class="d-flex row">
						<div class="d-flex col-lg-6 col-sm-12 mt-4">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p class="fw-bold position-absolute">Company Name</p>
							<input type="text" id="company-name-post" name="company-name-post" class="display-info form-control" maxlength="100">
						</div>
						<div class="d-flex col-lg-6 col-sm-12 mt-4">
							<div id=""class="fw-bold position-absolute d-flex">
								<p>Title</p>
								<p class="text-danger" title="required">*</p>
							</div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<input type="text" id="title-post" name="title-post" class="display-info form-control" maxlength="100" required>
						</div>
					</div>

					<div class="d-flex row">
						<div class="d-flex col-lg-6 col-sm-12 mt-4">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id=""class="fw-bold position-absolute">Start Date</p>
							<input type="date" class="form-control" id="start-date-post" name="start-date-post">
						</div>
						<div class="d-flex col-lg-6 col-sm-12 mt-4">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id=""class="fw-bold position-absolute">End Date</p>
							<input type="date" class="form-control" id="end-date-post" name="end-date-post">
						</div>
					</div>

					<div class="d-flex mt-4">
						<div class="me-5"></div>
						<div class="me-5"></div>
						<div class="me-5"></div>
						<div class="me-5"></div>
						<p id=""class="fw-bold position-absolute">Description</p>
						<textarea id="description-post" name="description-post" class="display-info form-control" rows="8" cols="80"></textarea>
					</div>

					<div class="d-flex row">
						<div class="d-flex col-lg-6 col-sm-12 mt-4">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id=""class="fw-bold position-absolute">Employment Type</p>
							<select type="text" class="form-select" id="employment-type-post" name="employment-type-post">
								<option value=0>Full Time</option>
								<option value=1>Part Time</option>
								<option value=2>Contract</option>
								<option value=3>Temporary</option>
							</select>
						</div>

						<div class="d-flex col-lg-6 col-sm-12 mt-4">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id=""class="fw-bold position-absolute">City</p>
							<input type="text" id="city-post" name="city-post" class="display-info-medium form-control" maxlength="40">
						</div>
					</div>

					<div class="d-flex row mb-4">
						<div class="d-flex col-lg-6 col-sm-12 mt-4">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id=""class="fw-bold position-absolute">Province</p>
							<input type="text" id="province-post" name="province-post" class="display-info-medium form-control" maxlength="40">
						</div>

						<div class="d-flex col-lg-6 col-sm-12 mt-4">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id=""class="fw-bold position-absolute">Country</p>
							<select id="country-post" class="form-select" name="country-post">
								<option value="Afghanistan">Afghanistan</option>
								<option value="Åland Islands">Åland Islands</option>
								<option value="Albania">Albania</option>
								<option value="Algeria">Algeria</option>
								<option value="American Samoa">American Samoa</option>
								<option value="Andorra">Andorra</option>
								<option value="Angola">Angola</option>
								<option value="Anguilla">Anguilla</option>
								<option value="Antarctica">Antarctica</option>
								<option value="Antigua and Barbuda">Antigua and Barbuda</option>
								<option value="Argentina">Argentina</option>
								<option value="Armenia">Armenia</option>
								<option value="Aruba">Aruba</option>
								<option value="Australia">Australia</option>
								<option value="Austria">Austria</option>
								<option value="Azerbaijan">Azerbaijan</option>
								<option value="Bahamas">Bahamas</option>
								<option value="Bahrain">Bahrain</option>
								<option value="Bangladesh">Bangladesh</option>
								<option value="Barbados">Barbados</option>
								<option value="Belarus">Belarus</option>
								<option value="Belgium">Belgium</option>
								<option value="Belize">Belize</option>
								<option value="Benin">Benin</option>
								<option value="Bermuda">Bermuda</option>
								<option value="Bhutan">Bhutan</option>
								<option value="Bolivia">Bolivia</option>
								<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
								<option value="Botswana">Botswana</option>
								<option value="Bouvet Island">Bouvet Island</option>
								<option value="Brazil">Brazil</option>
								<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
								<option value="Brunei Darussalam">Brunei Darussalam</option>
								<option value="Bulgaria">Bulgaria</option>
								<option value="Burkina Faso">Burkina Faso</option>
								<option value="Burundi">Burundi</option>
								<option value="Cambodia">Cambodia</option>
								<option value="Cameroon">Cameroon</option>
								<option value="Canada">Canada</option>
								<option value="Cape Verde">Cape Verde</option>
								<option value="Cayman Islands">Cayman Islands</option>
								<option value="Central African Republic">Central African Republic</option>
								<option value="Chad">Chad</option>
								<option value="Chile">Chile</option>
								<option value="China">China</option>
								<option value="Christmas Island">Christmas Island</option>
								<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
								<option value="Colombia">Colombia</option>
								<option value="Comoros">Comoros</option>
								<option value="Congo">Congo</option>
								<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
								<option value="Cook Islands">Cook Islands</option>
								<option value="Costa Rica">Costa Rica</option>
								<option value="Cote D\'ivoire">Cote D\'ivoire</option>
								<option value="Croatia">Croatia</option>
								<option value="Cuba">Cuba</option>
								<option value="Cyprus">Cyprus</option>
								<option value="Czech Republic">Czech Republic</option>
								<option value="Denmark">Denmark</option>
								<option value="Djibouti">Djibouti</option>
								<option value="Dominica">Dominica</option>
								<option value="Dominican Republic">Dominican Republic</option>
								<option value="Ecuador">Ecuador</option>
								<option value="Egypt">Egypt</option>
								<option value="El Salvador">El Salvador</option>
								<option value="Equatorial Guinea">Equatorial Guinea</option>
								<option value="Eritrea">Eritrea</option>
								<option value="Estonia">Estonia</option>
								<option value="Ethiopia">Ethiopia</option>
								<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
								<option value="Faroe Islands">Faroe Islands</option>
								<option value="Fiji">Fiji</option>
								<option value="Finland">Finland</option>
								<option value="France">France</option>
								<option value="French Guiana">French Guiana</option>
								<option value="French Polynesia">French Polynesia</option>
								<option value="French Southern Territories">French Southern Territories</option>
								<option value="Gabon">Gabon</option>
								<option value="Gambia">Gambia</option>
								<option value="Georgia">Georgia</option>
								<option value="Germany">Germany</option>
								<option value="Ghana">Ghana</option>
								<option value="Gibraltar">Gibraltar</option>
								<option value="Greece">Greece</option>
								<option value="Greenland">Greenland</option>
								<option value="Grenada">Grenada</option>
								<option value="Guadeloupe">Guadeloupe</option>
								<option value="Guam">Guam</option>
								<option value="Guatemala">Guatemala</option>
								<option value="Guernsey">Guernsey</option>
								<option value="Guinea">Guinea</option>
								<option value="Guinea-bissau">Guinea-bissau</option>
								<option value="Guyana">Guyana</option>
								<option value="Haiti">Haiti</option>
								<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
								<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
								<option value="Honduras">Honduras</option>
								<option value="Hong Kong">Hong Kong</option>
								<option value="Hungary">Hungary</option>
								<option value="Iceland">Iceland</option>
								<option value="India">India</option>
								<option value="Indonesia">Indonesia</option>
								<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
								<option value="Iraq">Iraq</option>
								<option value="Ireland">Ireland</option>
								<option value="Isle of Man">Isle of Man</option>
								<option value="Israel">Israel</option>
								<option value="Italy">Italy</option>
								<option value="Jamaica">Jamaica</option>
								<option value="Japan">Japan</option>
								<option value="Jersey">Jersey</option>
								<option value="Jordan">Jordan</option>
								<option value="Kazakhstan">Kazakhstan</option>
								<option value="Kenya">Kenya</option>
								<option value="Kiribati">Kiribati</option>
								<option value="Korea, Democratic People\'s Republic of">Korea, Democratic People\'s Republic of</option>
								<option value="Korea, Republic of">Korea, Republic of</option>
								<option value="Kuwait">Kuwait</option>
								<option value="Kyrgyzstan">Kyrgyzstan</option>
								<option value="Lao People\'s Democratic Republic">Lao People\'s Democratic Republic</option>
								<option value="Latvia">Latvia</option>
								<option value="Lebanon">Lebanon</option>
								<option value="Lesotho">Lesotho</option>
								<option value="Liberia">Liberia</option>
								<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
								<option value="Liechtenstein">Liechtenstein</option>
								<option value="Lithuania">Lithuania</option>
								<option value="Luxembourg">Luxembourg</option>
								<option value="Macao">Macao</option>
								<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
								<option value="Madagascar">Madagascar</option>
								<option value="Malawi">Malawi</option>
								<option value="Malaysia">Malaysia</option>
								<option value="Maldives">Maldives</option>
								<option value="Mali">Mali</option>
								<option value="Malta">Malta</option>
								<option value="Marshall Islands">Marshall Islands</option>
								<option value="Martinique">Martinique</option>
								<option value="Mauritania">Mauritania</option>
								<option value="Mauritius">Mauritius</option>
								<option value="Mayotte">Mayotte</option>
								<option value="Mexico">Mexico</option>
								<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
								<option value="Moldova, Republic of">Moldova, Republic of</option>
								<option value="Monaco">Monaco</option>
								<option value="Mongolia">Mongolia</option>
								<option value="Montenegro">Montenegro</option>
								<option value="Montserrat">Montserrat</option>
								<option value="Morocco">Morocco</option>
								<option value="Mozambique">Mozambique</option>
								<option value="Myanmar">Myanmar</option>
								<option value="Namibia">Namibia</option>
								<option value="Nauru">Nauru</option>
								<option value="Nepal">Nepal</option>
								<option value="Netherlands">Netherlands</option>
								<option value="Netherlands Antilles">Netherlands Antilles</option>
								<option value="New Caledonia">New Caledonia</option>
								<option value="New Zealand">New Zealand</option>
								<option value="Nicaragua">Nicaragua</option>
								<option value="Niger">Niger</option>
								<option value="Nigeria">Nigeria</option>
								<option value="Niue">Niue</option>
								<option value="Norfolk Island">Norfolk Island</option>
								<option value="Northern Mariana Islands">Northern Mariana Islands</option>
								<option value="Norway">Norway</option>
								<option value="Oman">Oman</option>
								<option value="Pakistan">Pakistan</option>
								<option value="Palau">Palau</option>
								<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
								<option value="Panama">Panama</option>
								<option value="Papua New Guinea">Papua New Guinea</option>
								<option value="Paraguay">Paraguay</option>
								<option value="Peru">Peru</option>
								<option value="Philippines">Philippines</option>
								<option value="Pitcairn">Pitcairn</option>
								<option value="Poland">Poland</option>
								<option value="Portugal">Portugal</option>
								<option value="Puerto Rico">Puerto Rico</option>
								<option value="Qatar">Qatar</option>
								<option value="Reunion">Reunion</option>
								<option value="Romania">Romania</option>
								<option value="Russian Federation">Russian Federation</option>
								<option value="Rwanda">Rwanda</option>
								<option value="Saint Helena">Saint Helena</option>
								<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
								<option value="Saint Lucia">Saint Lucia</option>
								<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
								<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
								<option value="Samoa">Samoa</option>
								<option value="San Marino">San Marino</option>
								<option value="Sao Tome and Principe">Sao Tome and Principe</option>
								<option value="Saudi Arabia">Saudi Arabia</option>
								<option value="Senegal">Senegal</option>
								<option value="Serbia">Serbia</option>
								<option value="Seychelles">Seychelles</option>
								<option value="Sierra Leone">Sierra Leone</option>
								<option value="Singapore">Singapore</option>
								<option value="Slovakia">Slovakia</option>
								<option value="Slovenia">Slovenia</option>
								<option value="Solomon Islands">Solomon Islands</option>
								<option value="Somalia">Somalia</option>
								<option value="South Africa">South Africa</option>
								<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
								<option value="Spain">Spain</option>
								<option value="Sri Lanka">Sri Lanka</option>
								<option value="Sudan">Sudan</option>
								<option value="Suriname">Suriname</option>
								<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
								<option value="Swaziland">Swaziland</option>
								<option value="Sweden">Sweden</option>
								<option value="Switzerland">Switzerland</option>
								<option value="Syrian Arab Republic">Syrian Arab Republic</option>
								<option value="Taiwan">Taiwan</option>
								<option value="Tajikistan">Tajikistan</option>
								<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
								<option value="Thailand">Thailand</option>
								<option value="Timor-leste">Timor-leste</option>
								<option value="Togo">Togo</option>
								<option value="Tokelau">Tokelau</option>
								<option value="Tonga">Tonga</option>
								<option value="Trinidad and Tobago">Trinidad and Tobago</option>
								<option value="Tunisia">Tunisia</option>
								<option value="Turkey">Turkey</option>
								<option value="Turkmenistan">Turkmenistan</option>
								<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
								<option value="Tuvalu">Tuvalu</option>
								<option value="Uganda">Uganda</option>
								<option value="Ukraine">Ukraine</option>
								<option value="United Arab Emirates">United Arab Emirates</option>
								<option value="United Kingdom">United Kingdom</option>
								<option value="United States">United States</option>
								<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
								<option value="Uruguay">Uruguay</option>
								<option value="Uzbekistan">Uzbekistan</option>
								<option value="Vanuatu">Vanuatu</option>
								<option value="Venezuela">Venezuela</option>
								<option value="Viet Nam">Viet Nam</option>
								<option value="Virgin Islands, British">Virgin Islands, British</option>
								<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
								<option value="Wallis and Futuna">Wallis and Futuna</option>
								<option value="Western Sahara">Western Sahara</option>
								<option value="Yemen">Yemen</option>
								<option value="Zambia">Zambia</option>
								<option value="Zimbabwe">Zimbabwe</option>
							</select>
						</div>
					</div>

					<div width=100 class="d-flex justify-content-end">
						<input type="submit" value="Submit Job" name="submitP" id="headline-save-button" class="btn btn-success">
					</div>
				</form>
			</div>
		
	</div>
';
}

while ($row = mysqli_fetch_array($experience_result)) :
	if ($row['employment_type'] == 0) {
		$employment_type = "Full Time";
	} else if ($row['employment_type'] == 1) {
		$employment_type = "Part Time";
	} else if ($row['employment_type'] == 2) {
		$employment_type = "Contract";
	} else if ($row['employment_type'] == 3) {
		$employment_type = "Temporary";
	}
	if ($row['start_date'] == null) {
		$work_start_date = "";
	} else {
		$work_start_date = date('F jS, Y', strtotime($row['start_date']));
	}

	if ($row['end_date'] == null) {
		$work_end_date = "";
	} else {
		$work_end_date = date('F jS, Y', strtotime($row['end_date']));
	}

	echo '
	<div class="card p-4 mt-3">
		<h2 class="mb-5">Edit Job</h2>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '&exp_id=' . $row['experience_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="name-edit-title-' . $row['experience_id'] . '"class="fw-bold position-absolute">Company Name</p>
							<p id="name-edit-display-' . $row['experience_id'] . '">' . $row['company_name'] . '</p>
							<input type="text" id="name-edit-edit-' . $row['experience_id'] . '" class="d-none" name="name-edit-edit" maxlength="100" autofocus value="' . $row['company_name'] . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=name-edit&exp_id=' . $row['experience_id'] . '&id=' . $user_id . '" class="edit-button" id="name-edit-edit-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitR" id="name-edit-save-button-' . $row['experience_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="name-edit-cancel-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>

			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '&exp_id=' . $row['experience_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between">
					<div class="d-flex">
						<div class="d-flex">
							<div id=""class="fw-bold position-absolute d-flex">
								<p id="title-edit-title-' . $row['experience_id'] . '">Title</p>
								<p class="text-danger" title="required">*</p>
							</div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="title-edit-display-' . $row['experience_id'] . '">' . $row['title'] . '</p>
							<input type="text" id="title-edit-edit-' . $row['experience_id'] . '" class="d-none" name="title-edit-edit" maxlength="100" autofocus value=' . $row['title'] . ' required>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=title-edit&exp_id=' . $row['experience_id'] . '&id=' . $user_id . '" class="edit-button" id="title-edit-edit-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitS" id="title-edit-save-button-' . $row['experience_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="title-edit-cancel-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '&exp_id=' . $row['experience_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="work-start-date-edit-title-' . $row['experience_id'] . '"class="fw-bold position-absolute">Start Date</p>
							<p id="work-start-date-edit-display-' . $row['experience_id'] . '">' . $work_start_date . '</p>
							<input type="date" id="work-start-date-edit-edit-' . $row['experience_id'] . '" class="d-none" name="work-start-date-edit-edit" autofocus value="' . $work_start_date . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=work-start-date-edit&exp_id=' . $row['experience_id'] . '&id=' . $user_id . '" class="edit-button" id="work-start-date-edit-edit-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitT" id="work-start-date-edit-save-button-' . $row['experience_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="work-start-date-edit-cancel-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>

			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '&exp_id=' . $row['experience_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="work-end-date-edit-title-' . $row['experience_id'] . '"class="fw-bold position-absolute">End Date</p>
							<p id="work-end-date-edit-display-' . $row['experience_id'] . '">' . $work_end_date . '</p>
							<input type="date" id="work-end-date-edit-edit-' . $row['experience_id'] . '" class="d-none" name="work-end-date-edit-edit" autofocus value="' . $work_end_date . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=work-end-date-edit&exp_id=' . $row['experience_id'] . '&id=' . $user_id . '" class="edit-button" id="work-end-date-edit-edit-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitU" id="work-end-date-edit-save-button-' . $row['experience_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="work-end-date-edit-cancel-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

		<form action="update.php?user_id=' . $user_id . '&exp_id=' . $row['experience_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between">
			<div class="d-flex justify-content-between">
				<div class="d-flex">
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<p id="description-edit-title-' . $row['experience_id'] . '" class="fw-bold position-absolute">Description</p>
					<p id="description-edit-display-' . $row['experience_id'] . '">' . $row['description'] . '</p>
					<textarea id="description-edit-edit-' . $row['experience_id'] . '" class="d-none" name="description-edit-edit" rows="8" cols="80" autofocus>' . $row['description'] . '</textarea>
				</div>
			</div>
			<div class="d-flex justify-content-end">
				<a href="edit-profile?section=description-edit&exp_id=' . $row['experience_id'] . '&id=' . $user_id . '" class="edit-button" id="description-edit-edit-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
				<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
			</svg></a>
				<input class="d-none" type="submit" value="Save" name="submitV" id="description-edit-save-button-' . $row['experience_id'] . '">
				<a href="edit-profile?id=' . $user_id . '" class="d-none" id="description-edit-cancel-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
				<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
				<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
			</svg></a>
			</div>
		</form>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '&exp_id=' . $row['experience_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="employment-type-edit-title-' . $row['experience_id'] . '"class="fw-bold position-absolute">Employment Type</p>
							<p id="employment-type-edit-display-' . $row['experience_id'] . '">' . $employment_type . '</p>
							<select type="text" id="employment-type-edit-edit-' . $row['experience_id'] . '" class="d-none" name="employment-type-edit-edit" autofocus value="' . $employment_type . '">
								<option value=0>Full Time</option>
								<option value=1>Part Time</option>
								<option value=2>Contract</option>
								<option value=3>Temporary</option>
							</select>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=employment-type-edit&exp_id=' . $row['experience_id'] . '&id=' . $user_id . '" class="edit-button" id="employment-type-edit-edit-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitW" id="employment-type-edit-save-button-' . $row['experience_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="employment-type-edit-cancel-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>

			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '&exp_id=' . $row['experience_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="city-edit-title-' . $row['experience_id'] . '"class="fw-bold position-absolute">City</p>
							<p id="city-edit-display-' . $row['experience_id'] . '">' . $row['city'] . '</p>
							<input type="text" id="city-edit-edit-' . $row['experience_id'] . '" class="d-none" name="city-edit-edit" maxlength="40" autofocus value="' . $row['city'] . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=city-edit&exp_id=' . $row['experience_id'] . '&id=' . $user_id . '" class="edit-button" id="city-edit-edit-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitX" id="city-edit-save-button-' . $row['experience_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="city-edit-cancel-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '&exp_id=' . $row['experience_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="province-edit-title-' . $row['experience_id'] . '"class="fw-bold position-absolute">Province</p>
							<p id="province-edit-display-' . $row['experience_id'] . '">' . $row['province'] . '</p>
							<input type="text" id="province-edit-edit-' . $row['experience_id'] . '" class="d-none" name="province-edit-edit" maxlength="40" autofocus value="' . $row['province'] . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=province-edit&exp_id=' . $row['experience_id'] . '&id=' . $user_id . '" class="edit-button" id="province-edit-edit-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitY" id="province-edit-save-button-' . $row['experience_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="province-edit-cancel-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '&exp_id=' . $row['experience_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="country-edit-title-' . $row['experience_id'] . '"class="fw-bold position-absolute">Country</p>
							<p id="country-edit-display-' . $row['experience_id'] . '">' . $row['country'] . '</p>
								<select id="country-edit-edit-' . $row['experience_id'] . '" class="d-none" name="country-edit-edit" autofocus>
									<option value="Afghanistan">Afghanistan</option>
									<option value="Åland Islands">Åland Islands</option>
									<option value="Albania">Albania</option>
									<option value="Algeria">Algeria</option>
									<option value="American Samoa">American Samoa</option>
									<option value="Andorra">Andorra</option>
									<option value="Angola">Angola</option>
									<option value="Anguilla">Anguilla</option>
									<option value="Antarctica">Antarctica</option>
									<option value="Antigua and Barbuda">Antigua and Barbuda</option>
									<option value="Argentina">Argentina</option>
									<option value="Armenia">Armenia</option>
									<option value="Aruba">Aruba</option>
									<option value="Australia">Australia</option>
									<option value="Austria">Austria</option>
									<option value="Azerbaijan">Azerbaijan</option>
									<option value="Bahamas">Bahamas</option>
									<option value="Bahrain">Bahrain</option>
									<option value="Bangladesh">Bangladesh</option>
									<option value="Barbados">Barbados</option>
									<option value="Belarus">Belarus</option>
									<option value="Belgium">Belgium</option>
									<option value="Belize">Belize</option>
									<option value="Benin">Benin</option>
									<option value="Bermuda">Bermuda</option>
									<option value="Bhutan">Bhutan</option>
									<option value="Bolivia">Bolivia</option>
									<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
									<option value="Botswana">Botswana</option>
									<option value="Bouvet Island">Bouvet Island</option>
									<option value="Brazil">Brazil</option>
									<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
									<option value="Brunei Darussalam">Brunei Darussalam</option>
									<option value="Bulgaria">Bulgaria</option>
									<option value="Burkina Faso">Burkina Faso</option>
									<option value="Burundi">Burundi</option>
									<option value="Cambodia">Cambodia</option>
									<option value="Cameroon">Cameroon</option>
									<option value="Canada">Canada</option>
									<option value="Cape Verde">Cape Verde</option>
									<option value="Cayman Islands">Cayman Islands</option>
									<option value="Central African Republic">Central African Republic</option>
									<option value="Chad">Chad</option>
									<option value="Chile">Chile</option>
									<option value="China">China</option>
									<option value="Christmas Island">Christmas Island</option>
									<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
									<option value="Colombia">Colombia</option>
									<option value="Comoros">Comoros</option>
									<option value="Congo">Congo</option>
									<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
									<option value="Cook Islands">Cook Islands</option>
									<option value="Costa Rica">Costa Rica</option>
									<option value="Cote D\'ivoire">Cote D\'ivoire</option>
									<option value="Croatia">Croatia</option>
									<option value="Cuba">Cuba</option>
									<option value="Cyprus">Cyprus</option>
									<option value="Czech Republic">Czech Republic</option>
									<option value="Denmark">Denmark</option>
									<option value="Djibouti">Djibouti</option>
									<option value="Dominica">Dominica</option>
									<option value="Dominican Republic">Dominican Republic</option>
									<option value="Ecuador">Ecuador</option>
									<option value="Egypt">Egypt</option>
									<option value="El Salvador">El Salvador</option>
									<option value="Equatorial Guinea">Equatorial Guinea</option>
									<option value="Eritrea">Eritrea</option>
									<option value="Estonia">Estonia</option>
									<option value="Ethiopia">Ethiopia</option>
									<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
									<option value="Faroe Islands">Faroe Islands</option>
									<option value="Fiji">Fiji</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="French Guiana">French Guiana</option>
									<option value="French Polynesia">French Polynesia</option>
									<option value="French Southern Territories">French Southern Territories</option>
									<option value="Gabon">Gabon</option>
									<option value="Gambia">Gambia</option>
									<option value="Georgia">Georgia</option>
									<option value="Germany">Germany</option>
									<option value="Ghana">Ghana</option>
									<option value="Gibraltar">Gibraltar</option>
									<option value="Greece">Greece</option>
									<option value="Greenland">Greenland</option>
									<option value="Grenada">Grenada</option>
									<option value="Guadeloupe">Guadeloupe</option>
									<option value="Guam">Guam</option>
									<option value="Guatemala">Guatemala</option>
									<option value="Guernsey">Guernsey</option>
									<option value="Guinea">Guinea</option>
									<option value="Guinea-bissau">Guinea-bissau</option>
									<option value="Guyana">Guyana</option>
									<option value="Haiti">Haiti</option>
									<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
									<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
									<option value="Honduras">Honduras</option>
									<option value="Hong Kong">Hong Kong</option>
									<option value="Hungary">Hungary</option>
									<option value="Iceland">Iceland</option>
									<option value="India">India</option>
									<option value="Indonesia">Indonesia</option>
									<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
									<option value="Iraq">Iraq</option>
									<option value="Ireland">Ireland</option>
									<option value="Isle of Man">Isle of Man</option>
									<option value="Israel">Israel</option>
									<option value="Italy">Italy</option>
									<option value="Jamaica">Jamaica</option>
									<option value="Japan">Japan</option>
									<option value="Jersey">Jersey</option>
									<option value="Jordan">Jordan</option>
									<option value="Kazakhstan">Kazakhstan</option>
									<option value="Kenya">Kenya</option>
									<option value="Kiribati">Kiribati</option>
									<option value="Korea, Democratic People\'s Republic of">Korea, Democratic People\'s Republic of</option>
									<option value="Korea, Republic of">Korea, Republic of</option>
									<option value="Kuwait">Kuwait</option>
									<option value="Kyrgyzstan">Kyrgyzstan</option>
									<option value="Lao People\'s Democratic Republic">Lao People\'s Democratic Republic</option>
									<option value="Latvia">Latvia</option>
									<option value="Lebanon">Lebanon</option>
									<option value="Lesotho">Lesotho</option>
									<option value="Liberia">Liberia</option>
									<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
									<option value="Liechtenstein">Liechtenstein</option>
									<option value="Lithuania">Lithuania</option>
									<option value="Luxembourg">Luxembourg</option>
									<option value="Macao">Macao</option>
									<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
									<option value="Madagascar">Madagascar</option>
									<option value="Malawi">Malawi</option>
									<option value="Malaysia">Malaysia</option>
									<option value="Maldives">Maldives</option>
									<option value="Mali">Mali</option>
									<option value="Malta">Malta</option>
									<option value="Marshall Islands">Marshall Islands</option>
									<option value="Martinique">Martinique</option>
									<option value="Mauritania">Mauritania</option>
									<option value="Mauritius">Mauritius</option>
									<option value="Mayotte">Mayotte</option>
									<option value="Mexico">Mexico</option>
									<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
									<option value="Moldova, Republic of">Moldova, Republic of</option>
									<option value="Monaco">Monaco</option>
									<option value="Mongolia">Mongolia</option>
									<option value="Montenegro">Montenegro</option>
									<option value="Montserrat">Montserrat</option>
									<option value="Morocco">Morocco</option>
									<option value="Mozambique">Mozambique</option>
									<option value="Myanmar">Myanmar</option>
									<option value="Namibia">Namibia</option>
									<option value="Nauru">Nauru</option>
									<option value="Nepal">Nepal</option>
									<option value="Netherlands">Netherlands</option>
									<option value="Netherlands Antilles">Netherlands Antilles</option>
									<option value="New Caledonia">New Caledonia</option>
									<option value="New Zealand">New Zealand</option>
									<option value="Nicaragua">Nicaragua</option>
									<option value="Niger">Niger</option>
									<option value="Nigeria">Nigeria</option>
									<option value="Niue">Niue</option>
									<option value="Norfolk Island">Norfolk Island</option>
									<option value="Northern Mariana Islands">Northern Mariana Islands</option>
									<option value="Norway">Norway</option>
									<option value="Oman">Oman</option>
									<option value="Pakistan">Pakistan</option>
									<option value="Palau">Palau</option>
									<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
									<option value="Panama">Panama</option>
									<option value="Papua New Guinea">Papua New Guinea</option>
									<option value="Paraguay">Paraguay</option>
									<option value="Peru">Peru</option>
									<option value="Philippines">Philippines</option>
									<option value="Pitcairn">Pitcairn</option>
									<option value="Poland">Poland</option>
									<option value="Portugal">Portugal</option>
									<option value="Puerto Rico">Puerto Rico</option>
									<option value="Qatar">Qatar</option>
									<option value="Reunion">Reunion</option>
									<option value="Romania">Romania</option>
									<option value="Russian Federation">Russian Federation</option>
									<option value="Rwanda">Rwanda</option>
									<option value="Saint Helena">Saint Helena</option>
									<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
									<option value="Saint Lucia">Saint Lucia</option>
									<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
									<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
									<option value="Samoa">Samoa</option>
									<option value="San Marino">San Marino</option>
									<option value="Sao Tome and Principe">Sao Tome and Principe</option>
									<option value="Saudi Arabia">Saudi Arabia</option>
									<option value="Senegal">Senegal</option>
									<option value="Serbia">Serbia</option>
									<option value="Seychelles">Seychelles</option>
									<option value="Sierra Leone">Sierra Leone</option>
									<option value="Singapore">Singapore</option>
									<option value="Slovakia">Slovakia</option>
									<option value="Slovenia">Slovenia</option>
									<option value="Solomon Islands">Solomon Islands</option>
									<option value="Somalia">Somalia</option>
									<option value="South Africa">South Africa</option>
									<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
									<option value="Spain">Spain</option>
									<option value="Sri Lanka">Sri Lanka</option>
									<option value="Sudan">Sudan</option>
									<option value="Suriname">Suriname</option>
									<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
									<option value="Swaziland">Swaziland</option>
									<option value="Sweden">Sweden</option>
									<option value="Switzerland">Switzerland</option>
									<option value="Syrian Arab Republic">Syrian Arab Republic</option>
									<option value="Taiwan">Taiwan</option>
									<option value="Tajikistan">Tajikistan</option>
									<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
									<option value="Thailand">Thailand</option>
									<option value="Timor-leste">Timor-leste</option>
									<option value="Togo">Togo</option>
									<option value="Tokelau">Tokelau</option>
									<option value="Tonga">Tonga</option>
									<option value="Trinidad and Tobago">Trinidad and Tobago</option>
									<option value="Tunisia">Tunisia</option>
									<option value="Turkey">Turkey</option>
									<option value="Turkmenistan">Turkmenistan</option>
									<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
									<option value="Tuvalu">Tuvalu</option>
									<option value="Uganda">Uganda</option>
									<option value="Ukraine">Ukraine</option>
									<option value="United Arab Emirates">United Arab Emirates</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="United States">United States</option>
									<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
									<option value="Uruguay">Uruguay</option>
									<option value="Uzbekistan">Uzbekistan</option>
									<option value="Vanuatu">Vanuatu</option>
									<option value="Venezuela">Venezuela</option>
									<option value="Viet Nam">Viet Nam</option>
									<option value="Virgin Islands, British">Virgin Islands, British</option>
									<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
									<option value="Wallis and Futuna">Wallis and Futuna</option>
									<option value="Western Sahara">Western Sahara</option>
									<option value="Yemen">Yemen</option>
									<option value="Zambia">Zambia</option>
									<option value="Zimbabwe">Zimbabwe</option>
								</select>
							</div>
						</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=country-edit&exp_id=' . $row['experience_id'] . '&id=' . $user_id . '" class="edit-button" id="country-edit-edit-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitZ" id="country-edit-save-button-' . $row['experience_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="country-edit-cancel-button-' . $row['experience_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

		<form width=100 class="d-flex justify-content-end mt-3" action="update.php?user_id=' . $user_id . '&exp_id=' . $row['experience_id'] . '" id="" method="POST" enctype="multipart/form-data" >
			<input type="submit" value="Delete Job" name="submitAG" id="" class="btn btn-danger" onclick="clicked(event)">
		</form>
		
	</div>
';

endwhile;
$education_result = mysqli_query($jobConn, "SELECT education_id, degree_type, institution_name, field, start_date, end_date, gpa from education
WHERE candidate_id = $candidate_id") or die(mysqli_error($jobConn));
	if (mysqli_num_rows($education_result) < 5) {
		echo '
	<h2 class="my-5">Education Info</h2>
	<div class="card p-4">
		<h3 class="">Add Education</h3>
		<form style="width:100%" action="update.php?user_id=' . $user_id . '" id="" method="POST" enctype="multipart/form-data" class="justify-content-between">

			<div class="d-flex row">
				<div class="d-flex col-lg-6 col-sm-12 mt-5">
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<p id=""class="fw-bold position-absolute">Degree Type</p>
					<input type="text" id="degree-post" name="degree-post" class="display-info-medium form-control" maxlength="20">
				</div>
				<div class="d-flex col-lg-6 col-sm-12 mt-5">
					<div class="fw-bold position-absolute d-flex">
						<p>Institution</p>
						<p class="text-danger" title="required">*</p>
					</div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<input type="text" id="institution-post" name="institution-post" class="display-info form-control" maxlength="100" required>
				</div>
			</div>

			<div class="d-flex row">
				<div class="d-flex col-lg-6 col-sm-12 mt-5">
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<p id=""class="fw-bold position-absolute">Field</p>
					<input type="text" id="field-post" name="field-post" class="form-control" maxlength="100">
				</div>
				<div class="d-flex col-lg-6 col-sm-12 mt-5">
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<p id=""class="fw-bold position-absolute">GPA</p>
					<input type="number" id="gpa-post" name="gpa-post" class="form-control" min=0 max=4 step=0.1>
				</div>
			</div>

			<div class="d-flex row">
				<div class="d-flex col-lg-6 col-sm-12 mt-5">
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<p id=""class="fw-bold position-absolute">Start Date</p>
					<input type="date" id="education-start-date-post" class="form-control" name="education-start-date-post">
				</div>
				<div class="d-flex col-lg-6 col-sm-12 mt-5">
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<p id=""class="fw-bold position-absolute">End Date</p>
					<input type="date" id="education-end-date-post" class="form-control" name="education-end-date-post">
				</div>
			</div>
				
			<div width=100 class="d-flex justify-content-end mt-4">
				<input type="submit" value="Submit Education" name="submitQ" id="headline-save-button" class="btn btn-success">
			</div>
		</form>	
	</div>';
			}
			while ($row = mysqli_fetch_array($education_result)) :
				if ($row['start_date'] == null) {
					$school_start_date = "";
				} else {
					$school_start_date = date('F jS, Y', strtotime($row['start_date']));
				}

				if ($row['end_date'] == null) {
					$school_end_date = "";
				} else {
					$school_end_date = date('F jS, Y', strtotime($row['end_date']));
				}
				echo '
	<div class="card p-4 mt-3 mb-5">
	
		<h2 class="">Edit Education</h2>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '&edu_id=' . $row['education_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between mt-4">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="degree-type-edit-title-' . $row['education_id'] . '"class="fw-bold position-absolute">Degree Type</p>
							<p id="degree-type-edit-display-' . $row['education_id'] . '">' . $row['degree_type'] . '</p>
							<input type="text" id="degree-type-edit-edit-' . $row['education_id'] . '" class="d-none" name="degree-type-edit-edit" maxlength="20" autofocus value=' . $row['degree_type'] . '>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=degree-type-edit&edu_id=' . $row['education_id'] . '&id=' . $user_id . '" class="edit-button" id="degree-type-edit-edit-button-' . $row['education_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitAA" id="degree-type-edit-save-button-' . $row['education_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="degree-type-edit-cancel-button-' . $row['education_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>

			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '&edu_id=' . $row['education_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between mt-4">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div id=""class="fw-bold position-absolute d-flex">
								<p id="institution-name-edit-title-' . $row['education_id'] . '">Institution</p>
								<p class="text-danger" title="required">*</p>
							</div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="institution-name-edit-display-' . $row['education_id'] . '">' . $row['institution_name'] . '</p>
							<input type="text" id="institution-name-edit-edit-' . $row['education_id'] . '" class="d-none" name="institution-name-edit-edit" maxlength="100" autofocus value="' . $row['institution_name'] . '" required>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=institution-name-edit&edu_id=' . $row['education_id'] . '&id=' . $user_id . '" class="edit-button" id="institution-name-edit-edit-button-' . $row['education_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitAB" id="institution-name-edit-save-button-' . $row['education_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="institution-name-edit-cancel-button-' . $row['education_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '&edu_id=' . $row['education_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="field-edit-title-' . $row['education_id'] . '"class="fw-bold position-absolute">Field</p>
							<p id="field-edit-display-' . $row['education_id'] . '">' . $row['field'] . '</p>
							<input type="text" id="field-edit-edit-' . $row['education_id'] . '" class="d-none" name="field-edit-edit" maxlength="100" autofocus value="' . $row['field'] . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=field-edit&edu_id=' . $row['education_id'] . '&id=' . $user_id . '" class="edit-button" id="field-edit-edit-button-' . $row['education_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitAC" id="field-edit-save-button-' . $row['education_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="field-edit-cancel-button-' . $row['education_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>

			<div class="col-lg-6 col-sm-12">
					<form action="update.php?user_id=' . $user_id . '&edu_id=' . $row['education_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="gpa-edit-title-' . $row['education_id'] . '"class="fw-bold position-absolute">GPA</p>
							<p id="gpa-edit-display-' . $row['education_id'] . '">' . $row['gpa'] . '</p>
							<input type="number" id="gpa-edit-edit-' . $row['education_id'] . '" class="d-none" name="gpa-edit-edit" min=0 max=4 step=0.1 autofocus value="' . $row['gpa'] . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=gpa-edit&edu_id=' . $row['education_id'] . '&id=' . $user_id . '" class="edit-button" id="gpa-edit-edit-button-' . $row['education_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitAF" id="gpa-edit-save-button-' . $row['education_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="gpa-edit-cancel-button-' . $row['education_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '&edu_id=' . $row['education_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="school-start-date-edit-title-' . $row['education_id'] . '"class="fw-bold position-absolute">Start Date</p>
							<p id="school-start-date-edit-display-' . $row['education_id'] . '">' . $school_start_date . '</p>
							<input type="date" id="school-start-date-edit-edit-' . $row['education_id'] . '" class="d-none" name="school-start-date-edit-edit" autofocus value="' . $school_start_date . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=school-start-date-edit&edu_id=' . $row['education_id'] . '&id=' . $user_id . '" class="edit-button" id="school-start-date-edit-edit-button-' . $row['education_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitAD" id="school-start-date-edit-save-button-' . $row['education_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="school-start-date-edit-cancel-button-' . $row['education_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>

			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '&edu_id=' . $row['education_id'] . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="school-end-date-edit-title-' . $row['education_id'] . '"class="fw-bold position-absolute">End Date</p>
							<p id="school-end-date-edit-display-' . $row['education_id'] . '">' . $school_end_date . '</p>
							<input type="date" id="school-end-date-edit-edit-' . $row['education_id'] . '" class="d-none" name="school-end-date-edit-edit" autofocus value="' . $school_end_date . '">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=school-end-date-edit&edu_id=' . $row['education_id'] . '&id=' . $user_id . '" class="edit-button" id="school-end-date-edit-edit-button-' . $row['education_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitAE" id="school-end-date-edit-save-button-' . $row['education_id'] . '">
						<a href="edit-profile?id=' . $user_id . '" class="d-none" id="school-end-date-edit-cancel-button-' . $row['education_id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

		<form width=100 class="d-flex justify-content-end" action="update.php?user_id=' . $user_id . '&edu_id=' . $row['education_id'] . '" id="" method="POST" enctype="multipart/form-data">
			<input type="submit" value="Delete Education" name="submitAH" id="" class="btn btn-danger mt-3" onclick="clicked(event)">
		</form>
	
	</div>
';

			endwhile;

			echo '
</div>
';
			?>
	</main>
	<script>
		const params = new Proxy(new URLSearchParams(window.location.search), {
			get: (searchParams, prop) => searchParams.get(prop),
		});

		let experienceID;
		let educationID;
		if (params.exp_id != null) {
			experienceID = params.exp_id;
			educationID = 1;
		} else {
			educationID = params.edu_id;
			experienceID = 1;
		}

		let firstNameDisplay = document.getElementById("first-name-display");
		let firstNameEdit = document.getElementById("first-name-edit");
		let firstNameEditButton = document.getElementById("first-name-edit-button");
		let firstNameSaveButton = document.getElementById("first-name-save-button");
		let firstNameCancelButton = document.getElementById("first-name-cancel-button");

		let lastNameDisplay = document.getElementById("last-name-display");
		let lastNameEdit = document.getElementById("last-name-edit");
		let lastNameEditButton = document.getElementById("last-name-edit-button");
		let lastNameSaveButton = document.getElementById("last-name-save-button");
		let lastNameCancelButton = document.getElementById("last-name-cancel-button");

		let descriptionDisplay = document.getElementById("description-display");
		let descriptionEdit = document.getElementById("description-edit");
		let descriptionEditButton = document.getElementById("description-edit-button");
		let descriptionSaveButton = document.getElementById("description-save-button");
		let descriptionCancelButton = document.getElementById("description-cancel-button");

		let genderDisplay = document.getElementById("gender-display");
		let genderEdit = document.getElementById("gender-edit");
		let genderEditButton = document.getElementById("gender-edit-button");
		let genderSaveButton = document.getElementById("gender-save-button");
		let genderCancelButton = document.getElementById("gender-cancel-button");

		let pronounsDisplay = document.getElementById("pronouns-display");
		let pronounsEdit = document.getElementById("pronouns-edit");
		let pronounsEditButton = document.getElementById("pronouns-edit-button");
		let pronounsSaveButton = document.getElementById("pronouns-save-button");
		let pronounsCancelButton = document.getElementById("pronouns-cancel-button");

		let cityDisplay = document.getElementById("city-display");
		let cityEdit = document.getElementById("city-edit");
		let cityEditButton = document.getElementById("city-edit-button");
		let citySaveButton = document.getElementById("city-save-button");
		let cityCancelButton = document.getElementById("city-cancel-button");

		let provinceDisplay = document.getElementById("province-display");
		let provinceEdit = document.getElementById("province-edit");
		let provinceEditButton = document.getElementById("province-edit-button");
		let provinceSaveButton = document.getElementById("province-save-button");
		let provinceCancelButton = document.getElementById("province-cancel-button");

		let countryDisplay = document.getElementById("country-display");
		let countryEdit = document.getElementById("country-edit");
		let countryEditButton = document.getElementById("country-edit-button");
		let countrySaveButton = document.getElementById("country-save-button");
		let countryCancelButton = document.getElementById("country-cancel-button");

		let websiteDisplay = document.getElementById("website-display");
		let websiteEdit = document.getElementById("website-edit");
		let websiteEditButton = document.getElementById("website-edit-button");
		let websiteSaveButton = document.getElementById("website-save-button");
		let websiteCancelButton = document.getElementById("website-cancel-button");

		let facebookDisplay = document.getElementById("facebook-display");
		let facebookEdit = document.getElementById("facebook-edit");
		let facebookEditButton = document.getElementById("facebook-edit-button");
		let facebookSaveButton = document.getElementById("facebook-save-button");
		let facebookCancelButton = document.getElementById("facebook-cancel-button");

		let instagramDisplay = document.getElementById("instagram-display");
		let instagramEdit = document.getElementById("instagram-edit");
		let instagramEditButton = document.getElementById("instagram-edit-button");
		let instagramSaveButton = document.getElementById("instagram-save-button");
		let instagramCancelButton = document.getElementById("instagram-cancel-button");

		let twitterDisplay = document.getElementById("twitter-display");
		let twitterEdit = document.getElementById("twitter-edit");
		let twitterEditButton = document.getElementById("twitter-edit-button");
		let twitterSaveButton = document.getElementById("twitter-save-button");
		let twitterCancelButton = document.getElementById("twitter-cancel-button");

		let tiktokDisplay = document.getElementById("tiktok-display");
		let tiktokEdit = document.getElementById("tiktok-edit");
		let tiktokEditButton = document.getElementById("tiktok-edit-button");
		let tiktokSaveButton = document.getElementById("tiktok-save-button");
		let tiktokCancelButton = document.getElementById("tiktok-cancel-button");

		let youtubeDisplay = document.getElementById("youtube-display");
		let youtubeEdit = document.getElementById("youtube-edit");
		let youtubeEditButton = document.getElementById("youtube-edit-button");
		let youtubeSaveButton = document.getElementById("youtube-save-button");
		let youtubeCancelButton = document.getElementById("youtube-cancel-button");

		let headlineDisplay = document.getElementById("headline-display");
		let headlineEdit = document.getElementById("headline-edit");
		let headlineEditButton = document.getElementById("headline-edit-button");
		let headlineSaveButton = document.getElementById("headline-save-button");
		let headlineCancelButton = document.getElementById("headline-cancel-button");

		let titleEditDisplay = document.getElementById("title-edit-display-" + experienceID);
		let titleEditEdit = document.getElementById("title-edit-edit-" + experienceID);
		let titleEditEditButton = document.getElementById("title-edit-edit-button-" + experienceID);
		let titleEditSaveButton = document.getElementById("title-edit-save-button-" + experienceID);
		let titleEditCancelButton = document.getElementById("title-edit-cancel-button-" + experienceID);

		let nameEditDisplay = document.getElementById("name-edit-display-" + experienceID);
		let nameEditEdit = document.getElementById("name-edit-edit-" + experienceID);
		let nameEditEditButton = document.getElementById("name-edit-edit-button-" + experienceID);
		let nameEditSaveButton = document.getElementById("name-edit-save-button-" + experienceID);
		let nameEditCancelButton = document.getElementById("name-edit-cancel-button-" + experienceID);

		let workStartDateEditDisplay = document.getElementById("work-start-date-edit-display-" + experienceID);
		let workStartDateEditEdit = document.getElementById("work-start-date-edit-edit-" + experienceID);
		let workStartDateEditEditButton = document.getElementById("work-start-date-edit-edit-button-" + experienceID);
		let workStartDateEditSaveButton = document.getElementById("work-start-date-edit-save-button-" + experienceID);
		let workStartDateEditCancelButton = document.getElementById("work-start-date-edit-cancel-button-" + experienceID);

		let workEndDateEditDisplay = document.getElementById("work-end-date-edit-display-" + experienceID);
		let workEndDateEditEdit = document.getElementById("work-end-date-edit-edit-" + experienceID);
		let workEndDateEditEditButton = document.getElementById("work-end-date-edit-edit-button-" + experienceID);
		let workEndDateEditSaveButton = document.getElementById("work-end-date-edit-save-button-" + experienceID);
		let workEndDateEditCancelButton = document.getElementById("work-end-date-edit-cancel-button-" + experienceID);

		let descriptionEditDisplay = document.getElementById("description-edit-display-" + experienceID);
		let descriptionEditEdit = document.getElementById("description-edit-edit-" + experienceID);
		let descriptionEditEditButton = document.getElementById("description-edit-edit-button-" + experienceID);
		let descriptionEditSaveButton = document.getElementById("description-edit-save-button-" + experienceID);
		let descriptionEditCancelButton = document.getElementById("description-edit-cancel-button-" + experienceID);

		let employmentTypeEditDisplay = document.getElementById("employment-type-edit-display-" + experienceID);
		let employmentTypeEditEdit = document.getElementById("employment-type-edit-edit-" + experienceID);
		let employmentTypeEditEditButton = document.getElementById("employment-type-edit-edit-button-" + experienceID);
		let employmentTypeEditSaveButton = document.getElementById("employment-type-edit-save-button-" + experienceID);
		let employmentTypeEditCancelButton = document.getElementById("employment-type-edit-cancel-button-" + experienceID);

		let cityEditDisplay = document.getElementById("city-edit-display-" + experienceID);
		let cityEditEdit = document.getElementById("city-edit-edit-" + experienceID);
		let cityEditEditButton = document.getElementById("city-edit-edit-button-" + experienceID);
		let cityEditSaveButton = document.getElementById("city-edit-save-button-" + experienceID);
		let cityEditCancelButton = document.getElementById("city-edit-cancel-button-" + experienceID);

		let provinceEditDisplay = document.getElementById("province-edit-display-" + experienceID);
		let provinceEditEdit = document.getElementById("province-edit-edit-" + experienceID);
		let provinceEditEditButton = document.getElementById("province-edit-edit-button-" + experienceID);
		let provinceEditSaveButton = document.getElementById("province-edit-save-button-" + experienceID);
		let provinceEditCancelButton = document.getElementById("province-edit-cancel-button-" + experienceID);

		let countryEditDisplay = document.getElementById("country-edit-display-" + experienceID);
		let countryEditEdit = document.getElementById("country-edit-edit-" + experienceID);
		let countryEditEditButton = document.getElementById("country-edit-edit-button-" + experienceID);
		let countryEditSaveButton = document.getElementById("country-edit-save-button-" + experienceID);
		let countryEditCancelButton = document.getElementById("country-edit-cancel-button-" + experienceID);

		let degreeTypeEditDisplay = document.getElementById("degree-type-edit-display-" + educationID);
		let degreeTypeEditEdit = document.getElementById("degree-type-edit-edit-" + educationID);
		let degreeTypeEditEditButton = document.getElementById("degree-type-edit-edit-button-" + educationID);
		let degreeTypeEditSaveButton = document.getElementById("degree-type-edit-save-button-" + educationID);
		let degreeTypeEditCancelButton = document.getElementById("degree-type-edit-cancel-button-" + educationID);

		let institutionNameEditDisplay = document.getElementById("institution-name-edit-display-" + educationID);
		let institutionNameEditEdit = document.getElementById("institution-name-edit-edit-" + educationID);
		let institutionNameEditEditButton = document.getElementById("institution-name-edit-edit-button-" + educationID);
		let institutionNameEditSaveButton = document.getElementById("institution-name-edit-save-button-" + educationID);
		let institutionNameEditCancelButton = document.getElementById("institution-name-edit-cancel-button-" + educationID);

		let fieldEditDisplay = document.getElementById("field-edit-display-" + educationID);
		let fieldEditEdit = document.getElementById("field-edit-edit-" + educationID);
		let fieldEditEditButton = document.getElementById("field-edit-edit-button-" + educationID);
		let fieldEditSaveButton = document.getElementById("field-edit-save-button-" + educationID);
		let fieldEditCancelButton = document.getElementById("field-edit-cancel-button-" + educationID);

		let schoolStartDateEditDisplay = document.getElementById("school-start-date-edit-display-" + educationID);
		let schoolStartDateEditEdit = document.getElementById("school-start-date-edit-edit-" + educationID);
		let schoolStartDateEditEditButton = document.getElementById("school-start-date-edit-edit-button-" + educationID);
		let schoolStartDateEditSaveButton = document.getElementById("school-start-date-edit-save-button-" + educationID);
		let schoolStartDateEditCancelButton = document.getElementById("school-start-date-edit-cancel-button-" + educationID);

		let schoolEndDateEditDisplay = document.getElementById("school-end-date-edit-display-" + educationID);
		let schoolEndDateEditEdit = document.getElementById("school-end-date-edit-edit-" + educationID);
		let schoolEndDateEditEditButton = document.getElementById("school-end-date-edit-edit-button-" + educationID);
		let schoolEndDateEditSaveButton = document.getElementById("school-end-date-edit-save-button-" + educationID);
		let schoolEndDateEditCancelButton = document.getElementById("school-end-date-edit-cancel-button-" + educationID);

		let gpaEditDisplay = document.getElementById("gpa-edit-display-" + educationID);
		let gpaEditEdit = document.getElementById("gpa-edit-edit-" + educationID);
		let gpaEditEditButton = document.getElementById("gpa-edit-edit-button-" + educationID);
		let gpaEditSaveButton = document.getElementById("gpa-edit-save-button-" + educationID);
		let gpaEditCancelButton = document.getElementById("gpa-edit-cancel-button-" + educationID);

		let section = params.section;
		if (section == null) {
			console.log("uihuisefui");
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "first-name") {
			showFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "last-name") {
			hideFirstName();
			showLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "description") {
			hideFirstName();
			hideLastName();
			showDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "gender") {
			hideFirstName();
			hideLastName();
			hideDescription()
			showGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "pronouns") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			showPronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "city") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			showCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "province") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			showProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "country") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			showCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "website") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			showWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "facebook") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			showFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "instagram") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			showInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "twitter") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			showTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "tiktok") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			showTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "youtube") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			showYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "headline") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			showHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "title-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			showTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "name-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			showNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "work-start-date-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			showWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "work-end-date-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			showWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "description-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			showDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "employment-type-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			showEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "city-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			showCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "province-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			showProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "country-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			showCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "degree-type-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			showDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "institution-name-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			showInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "field-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			showFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "school-start-date-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			showSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "school-end-date-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			showSchoolEndDateEdit();
			hideGPAEdit();
		} else if (section == "gpa-edit") {
			hideFirstName();
			hideLastName();
			hideDescription()
			hideGender();
			hidePronouns();
			hideCity();
			hideProvince();
			hideCountry();
			hideWebsite();
			hideFacebook();
			hideInstagram();
			hideTwitter();
			hideTiktok();
			hideYoutube();
			hideHeadline();
			hideTitleEdit();
			hideNameEdit();
			hideWorkStartDateEdit();
			hideWorkEndDateEdit();
			hideDescriptionEdit();
			hideEmploymentTypeEdit();
			hideCityEdit();
			hideProvinceEdit();
			hideCountryEdit();
			hideDegreeTypeEdit();
			hideInstitutionNameEdit();
			hideFieldEdit();
			hideSchoolStartDateEdit();
			hideSchoolEndDateEdit();
			showGPAEdit();
		}

		function showFirstName() {
			firstNameDisplay.className = "d-none";
			firstNameEdit.className = "display-info form-control me-3";
			firstNameEditButton.className = "d-none";
			firstNameSaveButton.className = "btn btn-primary me-2 mt-2";
			firstNameCancelButton.className = "btn btn-danger mt-2";
		}

		function hideFirstName() {
			firstNameDisplay.className = "display-info";
			firstNameEdit.className = "d-none";
			firstNameEditButton.className = "edit-button";
			firstNameSaveButton.className = "d-none";
			firstNameCancelButton.className = "d-none";
		}

		function showLastName() {
			lastNameDisplay.className = "d-none";
			lastNameEdit.className = "display-info form-control me-3";
			lastNameEditButton.className = "d-none";
			lastNameSaveButton.className = "btn btn-primary me-2 mt-2";
			lastNameCancelButton.className = "btn btn-danger mt-2";
		}

		function hideLastName() {
			lastNameDisplay.className = "display-info";
			lastNameEdit.className = "d-none";
			lastNameEditButton.className = "edit-button";
			lastNameSaveButton.className = "d-none";
			lastNameCancelButton.className = "d-none";
		}

		function showDescription() {
			descriptionDisplay.className = "d-none";
			descriptionEdit.className = "display-info form-control me-3";
			descriptionEditButton.className = "d-none";
			descriptionSaveButton.className = "btn btn-primary me-2 mt-2 description-button";
			descriptionCancelButton.className = "btn btn-danger mt-2 description-button";
		}

		function hideDescription() {
			console.log("??!");
			descriptionDisplay.className = "display-info";
			descriptionEdit.className = "d-none";
			descriptionEditButton.className = "edit-button";
			descriptionSaveButton.className = "d-none";
			descriptionCancelButton.className = "d-none";
		}

		function showGender() {
			genderDisplay.className = "d-none";
			genderEdit.className = "form-select me-3";
			genderEditButton.className = "d-none";
			genderSaveButton.className = "btn btn-primary me-2 mt-2";
			genderCancelButton.className = "btn btn-danger mt-2";
		}

		function hideGender() {
			console.log("???");
			genderDisplay.className = "display-info";
			genderEdit.className = "d-none";
			genderEditButton.className = "edit-button";
			genderSaveButton.className = "d-none";
			genderCancelButton.className = "d-none";
			console.log("I am here");
		}

		function showPronouns() {
			pronounsDisplay.className = "d-none";
			pronounsEdit.className = "display-info-medium form-control me-3";
			pronounsEditButton.className = "d-none";
			pronounsSaveButton.className = "btn btn-primary me-2 mt-2";
			pronounsCancelButton.className = "btn btn-danger mt-2";
		}

		function hidePronouns() {
			pronounsDisplay.className = "display-info";
			pronounsEdit.className = "d-none";
			pronounsEditButton.className = "edit-button";
			pronounsSaveButton.className = "d-none";
			pronounsCancelButton.className = "d-none";
		}

		function showCity() {
			cityDisplay.className = "d-none";
			cityEdit.className = "display-info form-control me-3";
			cityEditButton.className = "d-none";
			citySaveButton.className = "btn btn-primary me-2 mt-2";
			cityCancelButton.className = "btn btn-danger mt-2";
		}

		function hideCity() {
			cityDisplay.className = "display-info";
			cityEdit.className = "d-none";
			cityEditButton.className = "edit-button";
			citySaveButton.className = "d-none";
			cityCancelButton.className = "d-none";
		}

		function showProvince() {
			provinceDisplay.className = "d-none";
			provinceEdit.className = "form-select me-3";
			provinceEditButton.className = "d-none";
			provinceSaveButton.className = "btn btn-primary me-2 mt-2";
			provinceCancelButton.className = "btn btn-danger mt-2";
		}

		function hideProvince() {
			provinceDisplay.className = "display-info";
			provinceEdit.className = "d-none";
			provinceEditButton.className = "edit-button";
			provinceSaveButton.className = "d-none";
			provinceCancelButton.className = "d-none";
		}

		function showCountry() {
			countryDisplay.className = "d-none";
			countryEdit.className = "form-select me-3";
			countryEditButton.className = "d-none";
			countrySaveButton.className = "btn btn-primary me-2 mt-2";
			countryCancelButton.className = "btn btn-danger mt-2";
		}

		function hideCountry() {
			countryDisplay.className = "display-info";
			countryEdit.className = "d-none";
			countryEditButton.className = "edit-button";
			countrySaveButton.className = "d-none";
			countryCancelButton.className = "d-none";
		}

		function showWebsite() {
			websiteDisplay.className = "d-none";
			websiteEdit.className = "display-info form-control me-3";
			websiteEditButton.className = "d-none";
			websiteSaveButton.className = "btn btn-primary me-2 mt-2";
			websiteCancelButton.className = "btn btn-danger mt-2";
		}

		function hideWebsite() {
			websiteDisplay.className = "display-info";
			websiteEdit.className = "d-none";
			websiteEditButton.className = "edit-button";
			websiteSaveButton.className = "d-none";
			websiteCancelButton.className = "d-none";
		}

		function showFacebook() {
			facebookDisplay.className = "d-none";
			facebookEdit.className = "display-info form-control me-3";
			facebookEditButton.className = "d-none";
			facebookSaveButton.className = "btn btn-primary me-2 mt-2";
			facebookCancelButton.className = "btn btn-danger mt-2";
		}

		function hideFacebook() {
			facebookDisplay.className = "display-info";
			facebookEdit.className = "d-none";
			facebookEditButton.className = "edit-button";
			facebookSaveButton.className = "d-none";
			facebookCancelButton.className = "d-none";
		}

		function showInstagram() {
			instagramDisplay.className = "d-none";
			instagramEdit.className = "display-info form-control me-3";
			instagramEditButton.className = "d-none";
			instagramSaveButton.className = "btn btn-primary me-2 mt-2";
			instagramCancelButton.className = "btn btn-danger mt-2";
		}

		function hideInstagram() {
			instagramDisplay.className = "display-info";
			instagramEdit.className = "d-none";
			instagramEditButton.className = "edit-button";
			instagramSaveButton.className = "d-none";
			instagramCancelButton.className = "d-none";
		}

		function showTwitter() {
			twitterDisplay.className = "d-none";
			twitterEdit.className = "display-info form-control me-3";
			twitterEditButton.className = "d-none";
			twitterSaveButton.className = "btn btn-primary me-2 mt-2";
			twitterCancelButton.className = "btn btn-danger mt-2";
		}

		function hideTwitter() {
			twitterDisplay.className = "display-info";
			twitterEdit.className = "d-none";
			twitterEditButton.className = "edit-button";
			twitterSaveButton.className = "d-none";
			twitterCancelButton.className = "d-none";
		}

		function showTiktok() {
			tiktokDisplay.className = "d-none";
			tiktokEdit.className = "display-info form-control me-3";
			tiktokEditButton.className = "d-none";
			tiktokSaveButton.className = "btn btn-primary me-2 mt-2";
			tiktokCancelButton.className = "btn btn-danger mt-2";
		}

		function hideTiktok() {
			tiktokDisplay.className = "display-info";
			tiktokEdit.className = "d-none";
			tiktokEditButton.className = "edit-button";
			tiktokSaveButton.className = "d-none";
			tiktokCancelButton.className = "d-none";
		}

		function showYoutube() {
			youtubeDisplay.className = "d-none";
			youtubeEdit.className = "display-info form-control me-3";
			youtubeEditButton.className = "d-none";
			youtubeSaveButton.className = "btn btn-primary me-2 mt-2";
			youtubeCancelButton.className = "btn btn-danger mt-2";
		}

		function hideYoutube() {
			youtubeDisplay.className = "display-info";
			youtubeEdit.className = "d-none";
			youtubeEditButton.className = "edit-button";
			youtubeSaveButton.className = "d-none";
			youtubeCancelButton.className = "d-none";
		}

		function showHeadline() {
			headlineDisplay.className = "d-none";
			headlineEdit.className = "display-info form-control me-3";
			headlineEditButton.className = "d-none";
			headlineSaveButton.className = "btn btn-primary me-2 mt-2";
			headlineCancelButton.className = "btn btn-danger mt-2";
		}

		function hideHeadline() {
			headlineDisplay.className = "display-info";
			headlineEdit.className = "d-none";
			headlineEditButton.className = "edit-button";
			headlineSaveButton.className = "d-none";
			headlineCancelButton.className = "d-none";
		}

		function showTitleEdit() {
			titleEditDisplay.className = "d-none";
			titleEditEdit.className = "display-info form-control me-3";
			titleEditEditButton.className = "d-none";
			titleEditSaveButton.className = "btn btn-primary me-2 mt-2";
			titleEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideTitleEdit() {
			try {
				titleEditDisplay.className = "";
				titleEditEdit.className = "d-none";
				titleEditEditButton.className = "edit-button";
				titleEditSaveButton.className = "d-none";
				titleEditCancelButton.className = "d-none";
			} catch {}
		}

		function showNameEdit() {
			nameEditDisplay.className = "d-none";
			nameEditEdit.className = "display-info form-control me-3";
			nameEditEditButton.className = "d-none";
			nameEditSaveButton.className = "btn btn-primary me-2 mt-2";
			nameEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideNameEdit() {
			try {
				nameEditDisplay.className = "";
				nameEditEdit.className = "d-none";
				nameEditEditButton.className = "edit-button";
				nameEditSaveButton.className = "d-none";
				nameEditCancelButton.className = "d-none";
			} catch {}
		}

		function showWorkStartDateEdit() {
			workStartDateEditDisplay.className = "d-none";
			workStartDateEditEdit.className = "form-control me-3";
			workStartDateEditEditButton.className = "d-none";
			workStartDateEditSaveButton.className = "btn btn-primary me-2 mt-2";
			workStartDateEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideWorkStartDateEdit() {
			try {
				workStartDateEditDisplay.className = "";
				workStartDateEditEdit.className = "d-none";
				workStartDateEditEditButton.className = "edit-button";
				workStartDateEditSaveButton.className = "d-none";
				workStartDateEditCancelButton.className = "d-none";
			} catch {}
		}

		function showWorkEndDateEdit() {
			workEndDateEditDisplay.className = "d-none";
			workEndDateEditEdit.className = "form-control me-3";
			workEndDateEditEditButton.className = "d-none";
			workEndDateEditSaveButton.className = "btn btn-primary me-2 mt-2";
			workEndDateEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideWorkEndDateEdit() {
			try {
				workEndDateEditDisplay.className = "";
				workEndDateEditEdit.className = "d-none";
				workEndDateEditEditButton.className = "edit-button";
				workEndDateEditSaveButton.className = "d-none";
				workEndDateEditCancelButton.className = "d-none";
			} catch {}
		}

		function showDescriptionEdit() {
			descriptionEditDisplay.className = "d-none";
			descriptionEditEdit.className = "display-info form-control me-3";
			descriptionEditEditButton.className = "d-none";
			descriptionEditSaveButton.className = "btn btn-primary me-2 mt-2 description-button";
			descriptionEditCancelButton.className = "btn btn-danger mt-2 description-button";
		}

		function hideDescriptionEdit() {
			try {
				descriptionEditDisplay.className = "";
				descriptionEditEdit.className = "d-none";
				descriptionEditEditButton.className = "edit-button";
				descriptionEditSaveButton.className = "d-none";
				descriptionEditCancelButton.className = "d-none";
			} catch {}
		}

		function showEmploymentTypeEdit() {
			employmentTypeEditDisplay.className = "d-none";
			employmentTypeEditEdit.className = "form-select me-3";
			employmentTypeEditEditButton.className = "d-none";
			employmentTypeEditSaveButton.className = "btn btn-primary me-2 mt-2";
			employmentTypeEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideEmploymentTypeEdit() {
			try {
				employmentTypeEditDisplay.className = "";
				employmentTypeEditEdit.className = "d-none";
				employmentTypeEditEditButton.className = "edit-button";
				employmentTypeEditSaveButton.className = "d-none";
				employmentTypeEditCancelButton.className = "d-none";
			} catch {}
		}

		function showCityEdit() {
			cityEditDisplay.className = "d-none";
			cityEditEdit.className = "display-info form-control me-3";
			cityEditEditButton.className = "d-none";
			cityEditSaveButton.className = "btn btn-primary me-2 mt-2";
			cityEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideCityEdit() {
			try {
				cityEditDisplay.className = "";
				cityEditEdit.className = "d-none";
				cityEditEditButton.className = "edit-button";
				cityEditSaveButton.className = "d-none";
				cityEditCancelButton.className = "d-none";
			} catch {}
		}

		function showProvinceEdit() {
			provinceEditDisplay.className = "d-none";
			provinceEditEdit.className = "display-info form-control me-3";
			provinceEditEditButton.className = "d-none";
			provinceEditSaveButton.className = "btn btn-primary me-2 mt-2";
			provinceEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideProvinceEdit() {
			try {
				provinceEditDisplay.className = "";
				provinceEditEdit.className = "d-none";
				provinceEditEditButton.className = "edit-button";
				provinceEditSaveButton.className = "d-none";
				provinceEditCancelButton.className = "d-none";
			} catch {}
		}

		function showCountryEdit() {
			countryEditDisplay.className = "d-none";
			countryEditEdit.className = "form-select me-3";
			countryEditEditButton.className = "d-none";
			countryEditSaveButton.className = "btn btn-primary me-2 mt-2";
			countryEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideCountryEdit() {
			try {
				countryEditDisplay.className = "";
				countryEditEdit.className = "d-none";
				countryEditEditButton.className = "edit-button";
				countryEditSaveButton.className = "d-none";
				countryEditCancelButton.className = "d-none";
			} catch {}
		}

		function showDegreeTypeEdit() {
			degreeTypeEditDisplay.className = "d-none";
			degreeTypeEditEdit.className = "display-info form-control me-3";
			degreeTypeEditEditButton.className = "d-none";
			degreeTypeEditSaveButton.className = "btn btn-primary me-2 mt-2";
			degreeTypeEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideDegreeTypeEdit() {
			try {
				degreeTypeEditDisplay.className = "display-info";
				degreeTypeEditEdit.className = "d-none";
				degreeTypeEditEditButton.className = "edit-button";
				degreeTypeEditSaveButton.className = "d-none";
				degreeTypeEditCancelButton.className = "d-none";
			} catch {}
		}

		function showInstitutionNameEdit() {
			institutionNameEditDisplay.className = "d-none";
			institutionNameEditEdit.className = "display-info form-control me-3";
			institutionNameEditEditButton.className = "d-none";
			institutionNameEditSaveButton.className = "btn btn-primary me-2 mt-2";
			institutionNameEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideInstitutionNameEdit() {
			try {
				institutionNameEditDisplay.className = "display-info";
				institutionNameEditEdit.className = "d-none";
				institutionNameEditEditButton.className = "edit-button";
				institutionNameEditSaveButton.className = "d-none";
				institutionNameEditCancelButton.className = "d-none";
			} catch {}
		}

		function showFieldEdit() {
			fieldEditDisplay.className = "d-none";
			fieldEditEdit.className = "display-info form-control me-3";
			fieldEditEditButton.className = "d-none";
			fieldEditSaveButton.className = "btn btn-primary me-2 mt-2";
			fieldEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideFieldEdit() {
			try {
				fieldEditDisplay.className = "display-info";
				fieldEditEdit.className = "d-none";
				fieldEditEditButton.className = "edit-button";
				fieldEditSaveButton.className = "d-none";
				fieldEditCancelButton.className = "d-none";
			} catch {}
		}

		function showSchoolStartDateEdit() {
			schoolStartDateEditDisplay.className = "d-none";
			schoolStartDateEditEdit.className = "form-control me-3";
			schoolStartDateEditEditButton.className = "d-none";
			schoolStartDateEditSaveButton.className = "btn btn-primary me-2 mt-2";
			schoolStartDateEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideSchoolStartDateEdit() {
			try {
				schoolStartDateEditDisplay.className = "";
				schoolStartDateEditEdit.className = "d-none";
				schoolStartDateEditEditButton.className = "edit-button";
				schoolStartDateEditSaveButton.className = "d-none";
				schoolStartDateEditCancelButton.className = "d-none";
			} catch {}
		}

		function showSchoolEndDateEdit() {
			schoolEndDateEditDisplay.className = "d-none";
			schoolEndDateEditEdit.className = "form-control me-3";
			schoolEndDateEditEditButton.className = "d-none";
			schoolEndDateEditSaveButton.className = "btn btn-primary me-2 mt-2";
			schoolEndDateEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideSchoolEndDateEdit() {
			try {
				schoolEndDateEditDisplay.className = "";
				schoolEndDateEditEdit.className = "d-none";
				schoolEndDateEditEditButton.className = "edit-button";
				schoolEndDateEditSaveButton.className = "d-none";
				schoolEndDateEditCancelButton.className = "d-none";
			} catch {}
		}

		function showGPAEdit() {
			gpaEditDisplay.className = "d-none";
			gpaEditEdit.className = "form-control me-3";
			gpaEditEditButton.className = "d-none";
			gpaEditSaveButton.className = "btn btn-primary me-2 mt-2";
			gpaEditCancelButton.className = "btn btn-danger mt-2";
		}

		function hideGPAEdit() {
			try {
				gpaEditDisplay.className = "";
				gpaEditEdit.className = "d-none";
				gpaEditEditButton.className = "edit-button";
				gpaEditSaveButton.className = "d-none";
				gpaEditCancelButton.className = "d-none";
			} catch {}
		}

		function clicked(e) {
			if (!confirm('Are you sure you want to delete this?')) {
				e.preventDefault();
			}
		}

		// side bar function
		function hide() {
			document.getElementById("try").classList.remove("active-side-bar");
			document.getElementById("showIcon").style.visibility = "visible";
			document.getElementById("showIcon").style.position = "absolute";
			document.getElementById("hamburger-position").style.position = "sticky";

		}

		function show() {
			document.getElementById("try").classList.add("active-side-bar");
			document.getElementById("showIcon").style.visibility = "hidden";
			document.getElementById("showIcon").style.position = "sticky";
			document.getElementById("hamburger-position").style.position = "absolute";
		}

		function screensize() {
			if (x.matches) {
				document.getElementById("try").classList.remove("active-side-bar");
				document.getElementById("showIcon").style.visibility = "visible";
				document.getElementById("showIcon").style.position = "absolute";
				document.getElementById("hamburger-position").style.position = "sticky";
			} else {
				document.getElementById("try").classList.add("active-side-bar");
				document.getElementById("showIcon").style.visibility = "hidden";
				document.getElementById("showIcon").style.position = "sticky";
				document.getElementById("hamburger-position").style.position = "absolute";
			}
		}

		var x = window.matchMedia("(max-width: 1460px)")
		screensize(x) // Call listener function at run time
		x.addListener(screensize) // Attach listener function on state changes
	</script>
</body>

<?php
// include ("../includes/no-footer.php");
?>