<?php
$pageTitle = "Edit Profile";
$employer_id = $industry = "";
$accl = "0,2";
include("../includes/job_connect.php");
include("../includes/utils.php");
include("../includes/header.php");
include("../includes/_functions.php");
if (isset($_GET)) 
{
	extract($_GET);
}

if (isset($_GET['user_id'])) 
{
	$id = $_GET['user_id'];
	$result = mysqli_query($jobConn, "SELECT * FROM employer WHERE user_id = " . $_SESSION['user_id'] . " LIMIT 1");
	if (mysqli_num_rows($result) == 1) 
	{
		$row = mysqli_fetch_array($result);
		$_SESSION['employer_id'] = $row['employer_id'];
	}
	else
	{
		$message = "<p>There was a problem retrieving the information</p>";
	}
}


// get the employer ID
$employer_id = $_SESSION['employer_id'];
$user_id_sql = "SELECT user_id From employer WHERE user_id = '$_SESSION[user_id]'";
$user_id_list = $jobConn->query($user_id_sql);

$user_id = "";

while ($row = $user_id_list->fetch_assoc()) 
{
	$user_id = $row['user_id'];
}


?>

<body>
<style>
.showEditNav 
{
    visibility: hidden;
    position: absolute;
}

.dont-show
{
    visibility: visible;
    position: static;
}

.side-bar {
	background-color: #222222;
}

#main-div 
{
    width: 100%;
    margin-top: 2%;
    margin-left: 4%;
	margin-right: 4%;
    line-height: 2;
}

/* .category-form 
{
    width: 80%;
} */

.edit-button 
{
    text-decoration: none;
}

.edit-button:hover 
{
    text-decoration: underline;
}

/* .display-info 
{
	width: 750px;
}

.display-info-small 
{
	width: 75px;
} */

#description-save-button,
#description-cancel-button 
{
	max-height: 40px;
}

img {
	max-width:30rem;
	height: 10rem;
}
</style>

<!-- side bar css -->
<style>
.side-bar-hide 
{
    max-width: 0;
    overflow: hidden;
    transition: all 0.15s ease-in-out;
    visibility: hidden;
}


.side-bar-hide.active-side-bar 
{
    max-width: 280px;
    visibility: visible;
	height: 100vh;
}

.side-bar-sticky 
{
    position: sticky;
    top: 0;
    height: 100vh;
}

.hide-show-icon 
{
    visibility: hidden;
    border-radius: 0 7px 7px 0;
}

.deletenotvisible 
{
    visibility: hidden;
    position: absolute;
    background-color: rgba(0, 0, 0, 0.7);
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

.deleteborder 
{
background-color: #ffff;
}

.deletebutton 
{
    background-color: #f46a6f;
}

.deletebutton:hover 
{
    background-color: red;
}

.hamburger-sticky 
{
    position: absolute;
    top: 0;
    height: 50vh;
}
</style>
<!-- CSS main -->
<style>
.success 
{
    color: green;
}

.error 
{
    color: red;
}

.posting-mobile-view 
{
    width: 50%;
}

.search-icon 
{
    display: none;
}

.side-bar-sticky 
{
    position: sticky;
    top: 0;
    height: 100vh;
}


@media (max-width:1460px) 
{
    .job-description-hide 
	{
        visibility: hidden;
        position: absolute;
    }

    .posting-mobile-view 
	{
        width: 100%;
    }
}

@media (max-width:575px) 
{
    .desktop-view-button 
	{
        display: none;
    }

    .search-icon 
	{
        display: inline;
    }

    .search-bar-mobile-view 
	{
        margin-bottom: 1rem;
    }
}

.sidebar-sticky 
{
    position: sticky;
    top: 1rem;
}
</style>

<main>
<div class="d-flex">
            <!-- side bar -->
            <!-- button for the side bar hamburger menu -->
            <div class="hamburger-sticky" id="hamburger-position">
                <button class="bg-dark text-white border-0 start-0 mt-3 hide-show-icon  " onclick="show()" id="showIcon"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="35" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg></button>
            </div>
            <!-- side bar -->
            <?php
            $employer_name = "SELECT * from employer where employer_id = $employer_id";
            $employer_name1 = $jobConn->query($employer_name);
            $row1 = $employer_name1->fetch_assoc()
            ?>
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white side-bar side-bar-sticky side-bar-hide active-side-bar" style="width: 280px;" id="try">
                <div class="d-flex flex-row justify-content-between">
                    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none ms-lg-4">
                        <span class="fs-4"><?php echo ucfirst($row1['business_name']) ?></span>
                    </a>
                    <button class="bg-dark text-white border-0 w-0" onclick="hide()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                        </svg></button>
                </div>

                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="job-list?id=<?php echo $id ?>" class="nav-link text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase me-2" viewBox="0 0 16 16">
                                <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                            </svg>
                            My Job List
                        </a>
                    </li>
                    <li>
                        <a href="contacts?id=<?php echo $id ?>" class="nav-link text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill me-2" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                            </svg>
                            Contacts
                        </a>
                    </li>


                    <li>
                        <a href="applicant-list?id=<?php echo $id ?>" class="nav-link text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns-reverse me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z" />
                            </svg>
                            Application List
                        </a>
                    </li>

                    <li>
                        <a href="edit-profile?id=<?php echo $id ?>" class="nav-link bg-danger text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                            Edit Profile
                        </a>
                    </li>
                    <li>
                        <a href="login-security?id=<?php echo $id ?>" class="nav-link text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-fill-check me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647z" />
                            </svg>
                            Login and Security
                        </a>
                    </li>

                </ul>

            </div>

    <!-- <form action="update.php" method="POST" enctype="multipart/form-data"> -->
    <?php
    // $conn = new mysqli("localhost", "root", '', "job_platform");

    // $result = mysqli_query($conn, "SELECT * FROM employer WHERE employer_id = $employer_id") or die("Error: " . mysqli_error($conn));
	$result = mysqli_query($jobConn, "SELECT * FROM employer WHERE employer_id = $employer_id") or die("Error: " . mysqli_error($jobConn));
    $current_user = mysqli_fetch_array($result);
    $business_name = $current_user['business_name'];
    $industry = $current_user['business_category'];
    $description = $current_user['description'];
    $address = $current_user['address'];
    $city = $current_user['city'];
    $province = $current_user['province'];
    $postal = $current_user['postal_code'];
    $website = $current_user['website_url'];
    $facebook = $current_user['facebook'];
    $instagram = $current_user['instagram'];
    $twitter = $current_user['linkedin'];
    $tiktok = $current_user['tiktok'];
    $youtube = $current_user['youtube'];
	$video = $current_user['video'];
	if (str_contains($video, 'watch?v='))
	{
		$exploded_youtube_link = explode("watch?v=", $video);
	}
	else
	{
		$exploded_youtube_link = explode("shorts/", $video);
	}
	

	$profileImage = $current_user['profile_image'];
	$bannerImage = $current_user['banner_image'];

	if ($exploded_youtube_link[0] != null)
	{
		$youtube_code = $exploded_youtube_link[1];
		$embed_video = "https://www.youtube.com/embed/".$youtube_code;
	}
	else
	{
		$embed_video = "";
	}

	if(isset($_POST['profilesubmit'])) {
		$newProfile = $_FILES["myprofile"]["name"];
		$validProfile = 1; 
		$validBanner = 1; 
		$msgPre = "<div class=\"alert alert-danger\" role=\"alert\">";
		$msgSucPre = "<div class=\"alert alert-success\" role=\"alert\">";
		$msgPost = "</div>";
	  
		if($newProfile != "")
		{
		  if(($_FILES["myprofile"]["type"] != "image/jpeg") && ($_FILES["myprofile"]["type"] != "image/png")){
					$validProfile = 0;
					$valProfileMessage = "Not a valid JPG/PNG";
		  } //elseif (($_FILES["myprofile"]["size"]/1024)/1024 > 32){ //less than 32MB
					//$valid = 0;
					//$valFileMessage = "The uploaed image should be less that 32MB!";
				//}
		  
		  
		}else{
		  $validProfile = 0;
		  $valProfileMessage = "Please select a upload image.";
		}
	  
		if($validProfile == 1) {
		  $profilePrefix = "company_profile" . $_SESSION['employer_id'] . "_";
		  
		  if($_FILES["myprofile"]["type"] == "image/jpeg")
		  {
			$uniqFilename = uniqid($profilePrefix) . '.jpg';
		  } else {
			$uniqFilename = uniqid($profilePrefix) . '.png';
		  }
	  
		  //$thisFile = $imgOriginals . $uniqFilename;
		  $thisFile = "../uploads/img/original/" . $uniqFilename;
		  $companyProfileImagePath = "../uploads/img/profiles/";
		  if(move_uploaded_file($_FILES["myprofile"]["tmp_name"], $thisFile)){
			//here is a greater place to create our thumbs, as validation has passed, and the image has been uploaded
	  
			if($_FILES["myprofile"]["type"] == "image/jpeg"){
			createSquareImageCopy($thisFile, "$companyProfileImagePath", 200);
			
			} else {
			createSquareImageCopyPNG($thisFile, "$companyProfileImagePath", 200);
			}
		  } else {
			echo "error";
		  };

		//   mysqli_query($conn, "UPDATE employer SET profile_image=\"$uniqFilename\" WHERE employer_id=".$_SESSION['employer_id']) or die(mysqli_error($conn));
		  mysqli_query($jobConn, "UPDATE employer SET profile_image='$uniqFilename' WHERE employer_id=".$_SESSION['employer_id']) or die(mysqli_error($jobConn));
			  $validSucMsg = "Profile Image Uploaded!";
		  echo "<meta http-equiv=\"refresh\" content=\"0;url=edit-profile.php?id=$id\" />";
		} 
	  }
	  
	  if(isset($_POST['bannersubmit'])) {
		$newBanner = $_FILES["mybanner"]["name"];
		$validBanner = 1; 
		$msgPre = "<div class=\"alert alert-danger\" role=\"alert\">";
		$msgSucPre = "<div class=\"alert alert-success\" role=\"alert\">";
		$msgPost = "</div>";
	  
		if($newBanner != "")
		{
		  if(($_FILES["mybanner"]["type"] != "image/jpeg") && ($_FILES["mybanner"]["type"] != "image/png")){
					$validBanner = 0;
					$valBannerMessage = "Not a valid JPG/PNG";
		  } //elseif (($_FILES["myprofile"]["size"]/1024)/1024 > 32){ //less than 32MB
					//$valid = 0;
					//$valFileMessage = "The uploaed image should be less that 32MB!";
				//}
		  
		  
		}else{
		  $validBanner = 0;
		  $valBannerMessage = "Please select a upload image.";
		}
	  
		if($validBanner == 1) {
		  $profilePrefix = "company_banner" . $_SESSION['employer_id'] . "_";
		  
		  if($_FILES["mybanner"]["type"] == "image/jpeg")
		  {
			$uniqFilename = uniqid($profilePrefix) . '.jpg';
		  } else {
			$uniqFilename = uniqid($profilePrefix) . '.png';
		  }
	  
		  //$thisFile = $imgOriginals . $uniqFilename;
		  $thisFile = "../uploads/img/original/" . $uniqFilename;
		  $companyBannerImagePath = "../uploads/img/banner/";
		  if(move_uploaded_file($_FILES["mybanner"]["tmp_name"], $thisFile)){
			//here is a greater place to create our thumbs, as validation has passed, and the image has been uploaded
	  
			if($_FILES["mybanner"]["type"] == "image/jpeg"){
			  createBanner($thisFile, "$companyBannerImagePath", 1400, 200);
			
			} else {
			  createBannerPNG($thisFile, "$companyBannerImagePath",1400, 200);
			}
		  } else {
			echo "error";
		  };
		  mysqli_query($jobConn, "UPDATE employer SET banner_image='$uniqFilename' WHERE employer_id=".$_SESSION['employer_id']) or die(mysqli_error($jobConn));
			  $validSucMsg = "Banner Image Uploaded!";
		  echo "<meta http-equiv=\"refresh\" content=\"0;url=edit-profile.php?id=$id\" />";

		}
	  }
	?>

    
    <div id="main-div">
    
		<div class="d-flex row">

			<div class="col-lg-6 col-sm-12">
				<form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
					<div>
						<div>
							<?php 
								if($profileImage == "") {
								$profileImagePath = $companyProfileImagePath . "company_default.png"; //path can be changed in the _function.php file
								} else {
								$profileImagePath = $companyProfileImagePath . $profileImage;
								}
								echo "<img src=\"$profileImagePath\" alt=\"company profile picture\">";
							?>
						</div>
						<div class="d-flex row p-2">
							<div class="form-group col-7">
								<label for="myprofile">Profile Image</label>
								<input class="form-control" type="file" name="myprofile" />
								<?php if(isset($valProfileMessage)){echo $msgPre.$valProfileMessage.$msgPost;} ?>
							</div>
							<div class="form-group col-5" style="margin-top: 2rem;">
								<label for="profilesubmit">&nbsp;</label>
								<input type="submit" name="profilesubmit" class="btn btn-danger text-white" value="Upload Profile">
							</div>
						</div>	
					</div>
				</form>
			</div>

			<div class="col-lg-6 col-sm-12">
				<form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
					<div>
						<div>
							<?php 
								if($bannerImage == "") {
								$bannerImagePath = $companyBannerImagePath . "default.png"; //path can be changed in the _function.php file
								} else {
								$bannerImagePath = $companyBannerImagePath . $bannerImage;
								}
								echo "<img src=\"$bannerImagePath\" alt=\"company banner picture\">";
							?>
						</div>
						<div class="d-flex row p-2">
							<div class="form-group col-7">
								<label for="mybanner">Banner Image</label>
								<input class="form-control" type="file" name="mybanner" />
								<?php if(isset($valBannerMessage)){echo $msgPre.$valBannerMessage.$msgPost;} ?>
							</div>
							<div class="form-group col-5" style="margin-top: 2rem;">
								<label for="bannersubmit">&nbsp;</label>
								<input type="submit" name="bannersubmit" class="btn btn-danger text-white" value="Upload Banner">
							</div>
						</div>
					</div>
				</form>
			</div>

		</div>

    


	<?php
	if(isset($_GET['success']))
	{
		$validSucMsg = 'You have successfully updated '.$_GET['success'];
	}
	if(isset($_GET['failure']))
	{
		$invalidSucMsg = 'Warning: '. $_GET['failure']. ' failed to update.';
	}
	
	if(isset($validSucMsg))
	{
		$msgSucPre = "<div class=\"alert alert-success\" role=\"alert\">";
		$msgPost = "</div>";
		{echo $msgSucPre.$validSucMsg.$msgPost;}
	}
	if(isset($invalidSucMsg))
	{
		$msgSucPre = "<div class=\"alert alert-danger\" role=\"alert\">";
		$msgPost = "</div>";
		{echo $msgSucPre.$invalidSucMsg.$msgPost;}
	}
	echo '
	<div class="card p-4 mt-3">
		<h2>Company Info</h2>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between me-3">
						<div class="d-flex">
							<div id=""class="fw-bold position-absolute d-flex">
								<p id="name-title">Company Name</p>
								<p class="text-danger" title="required">*</p>
							</div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="name-display" class="d-none">'.$business_name.'</p>
							<input type="text" class="d-none" id="name-edit" name="name-edit" maxlength="100" autofocus value="'.$business_name.'" required>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=name&id='.$user_id.'" id="name-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitA" id="name-save-button">
						<a href="edit-profile?id='.$user_id.'" class="d-none" id="name-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>

			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between me-3">
						<div class="d-flex">
							<div id=""class="fw-bold position-absolute d-flex">
								<p id="industry-title">Industry</p>
								<p class="text-danger" title="required">*</p>
							</div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="industry-display" class="d-none">'.$industry.'</p>
							<input type="text" class="d-none" id="industry-edit" name="industry-edit" maxlength="50" autofocus value="'.$industry.'" required>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=industry&id='.$user_id.'" id="industry-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitB" id="industry-save-button">
						<a href="edit-profile?id='.$user_id.'" class="d-none" id="industry-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

		<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
			<div class="d-flex justify-content-between me-3">
				<div class="d-flex">
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<p id="description-title"class="fw-bold position-absolute">Description</p>
					<p id="description-display" class="d-none">'.$description.'</p>
					<textarea id="description-edit" class="d-none" name="description-edit" rows="8" cols="80" autofocus>'.$description.'</textarea>
				</div>
			</div>
			<div class="d-flex justify-content-end">
				<a href="edit-profile?section=description&id='.$user_id.'" id="description-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
				<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
			</svg></a>
				<input class="d-none" type="submit" value="Save" name="submitC" id="description-save-button">
				<a href="edit-profile?id='.$user_id.'" class="d-none" id="description-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
				<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
				<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
			</svg></a>
			</div>
		</form>
	</div>

	<div class="card p-4 mt-3">
		<h2>Location Info</h2>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="address-title"class="fw-bold position-absolute">Address</p>
							<p id="address-display" class="d-none">'.$address.'</p>
							<input type="text" id="address-edit" class="d-none" name="address-edit" maxlength="60" autofocus value="'.$address.'">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=address&id='.$user_id.'" id="address-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitD" id="address-save-button">
						<a href="edit-profile?id='.$user_id.'" class="d-none" id="address-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
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
								<p id="city-title">City</p>
								<p class="text-danger" title="required">*</p>
							</div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="city-display" class="d-none">'.$city.'</p>
							<input type="text" id="city-edit" class="d-none" name="city-edit" maxlength="40" autofocus value="'.$city.'" required>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=city&id='.$user_id.'" id="city-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitE" id="city-save-button">
						<a href="edit-profile?id='.$user_id.'" class="d-none" id="city-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
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
							<div id=""class="fw-bold position-absolute d-flex">
								<p id="province-title">Province</p>
								<p class="text-danger" title="required">*</p>
							</div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="province-display" class="d-none">'.$province.'</p>
							<select type="text" id="province-edit" class="d-none" name="province-edit" autofocus value="'.$province.'" required>
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
						<a href="edit-profile?section=province&id='.$user_id.'" id="province-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitF" id="province-save-button">
						<a href="edit-profile?id='.$user_id.'" class="d-none" id="province-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
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
								<p id="postal-title">Postal Code</p>
								<p class="text-danger" title="required">*</p>
							</div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="postal-display" class="d-none">'.$postal.'</p>
							<input type="text" id="postal-edit" class="d-none" name="postal-edit" maxlength="7" autofocus value="'.$postal.'" required>
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=postal&id='.$user_id.'" id="postal-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitG" id="postal-save-button">
						<a href="edit-profile?id='.$user_id.'" class="d-none" id="postal-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="card p-4 mt-3 mb-5">
		<h2>External Links</h2>

		<div class="d-flex row">
			<div class="col-lg-6 col-sm-12">
				<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
					<div class="d-flex justify-content-between">
						<div class="d-flex">
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<div class="me-5"></div>
							<p id="website-title"class="fw-bold position-absolute">Website</p>
							<p id="website-display" class="d-none">'.$website.'</p>
							<input type="text" id="website-edit" class="d-none" name="website-edit" maxlength="250" autofocus value="'.$website.'">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=website&id='.$user_id.'" id="website-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitH" id="website-save-button">
						<a href="edit-profile?id='.$user_id.'" class="d-none" id="website-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
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
							<p id="facebook-title"class="fw-bold position-absolute">Facebook</p>
							<p id="facebook-display" class="d-none">'.$facebook.'</p>
							<input type="text" id="facebook-edit" class="d-none" name="facebook-edit" maxlength="250" autofocus value="'.$facebook.'">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=facebook&id='.$user_id.'" id="facebook-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitI" id="facebook-save-button">
						<a href="edit-profile?id='.$user_id.'" class="d-none" id="facebook-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
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
							<p id="instagram-title"class="fw-bold position-absolute">Instagram</p>
							<p id="instagram-display" class="d-none">'.$instagram.'</p>
							<input type="text" id="instagram-edit" class="d-none" name="instagram-edit" maxlength="250" autofocus value="'.$instagram.'">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=instagram&id='.$user_id.'" id="instagram-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitJ" id="instagram-save-button">
						<a href="edit-profile?id='.$user_id.'" class="d-none" id="instagram-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
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
							<p id="twitter-title"class="fw-bold position-absolute">Twitter</p>
							<p id="twitter-display" class="d-none">'.$twitter.'</p>
							<input type="text" id="twitter-edit" class="d-none" name="twitter-edit" maxlength="250" autofocus value="'.$twitter.'">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=twitter&id='.$user_id.'" id="twitter-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitK" id="twitter-save-button">
						<a href="edit-profile?id='.$user_id.'" class="d-none" id="twitter-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
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
							<p id="tiktok-display" class="d-none">'.$tiktok.'</p>
							<input type="text" id="tiktok-edit" class="d-none" name="tiktok-edit" maxlength="250" autofocus value="'.$tiktok.'">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=tiktok&id='.$user_id.'" id="tiktok-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitL" id="tiktok-save-button">
						<a href="edit-profile?id='.$user_id.'" class="d-none" id="tiktok-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
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
							<p id="youtube-title"class="fw-bold position-absolute">YouTube Channel</p>
							<p id="youtube-display" class="d-none">'.$youtube.'</p>
							<input type="text" id="youtube-edit" class="d-none" name="youtube-edit" maxlength="250" autofocus value="'.$youtube.'">
						</div>
					</div>
					<div class="d-flex justify-content-end">
						<a href="edit-profile?section=youtube&id='.$user_id.'" id="youtube-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg></a>
						<input class="d-none" type="submit" value="Save" name="submitM" id="youtube-save-button">
						<a href="edit-profile?id='.$user_id.'" class="d-none" id="youtube-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg></a>
					</div>
				</form>
			</div>
		</div>

		<form action="update.php?user_id=' . $user_id . '" method="POST" enctype="multipart/form-data" class="d-flex justify-content-between category-form mt-5">
			<div class="d-flex justify-content-between">
				<div class="d-flex">
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<div class="me-5"></div>
					<p id="video-title"class="fw-bold position-absolute">YouTube Video</p>
					<iframe width="400" height="200" id="video-display" class="d-none" src='.$embed_video.'></iframe>
					<input type="text" id="video-edit" class="d-none" name="video-edit" maxlength="250" autofocus value="'.$video.'">
				</div>
			</div>

			<div class="d-flex justify-content-end">
				<a href="edit-profile?section=video&id='.$user_id.'" id="video-edit-button" class="d-none"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil text-danger" viewBox="0 0 16 16">
				<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
			</svg></a>
				<input class="d-none" type="submit" value="Save" name="submitN" id="video-save-button">
				<a href="edit-profile?id='.$user_id.'" class="d-none" id="video-cancel-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
				<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
				<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
			</svg></a>
			</div>
		</form>
	</div>
</div>
';
?>
</main>

<script>
let companyNameDisplay = document.getElementById("name-display");
let companyNameEdit = document.getElementById("name-edit");
let companyNameEditButton = document.getElementById("name-edit-button");
let companyNameSaveButton = document.getElementById("name-save-button");
let companyNameCancelButton = document.getElementById("name-cancel-button");

let industryDisplay = document.getElementById("industry-display");
let industryEdit = document.getElementById("industry-edit");
let industryEditButton = document.getElementById("industry-edit-button");
let industrySaveButton = document.getElementById("industry-save-button");
let industryCancelButton = document.getElementById("industry-cancel-button");

let descriptionDisplay = document.getElementById("description-display");
let descriptionEdit = document.getElementById("description-edit");
let descriptionEditButton = document.getElementById("description-edit-button");
let descriptionSaveButton = document.getElementById("description-save-button");
let descriptionCancelButton = document.getElementById("description-cancel-button");

let addressDisplay = document.getElementById("address-display");
let addressEdit = document.getElementById("address-edit");
let addressEditButton = document.getElementById("address-edit-button");
let addressSaveButton = document.getElementById("address-save-button");
let addressCancelButton = document.getElementById("address-cancel-button");

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

let postalDisplay = document.getElementById("postal-display");
let postalEdit = document.getElementById("postal-edit");
let postalEditButton = document.getElementById("postal-edit-button");
let postalSaveButton = document.getElementById("postal-save-button");
let postalCancelButton = document.getElementById("postal-cancel-button");

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

let videoDisplay = document.getElementById("video-display");
let videoEdit = document.getElementById("video-edit");
let videoEditButton = document.getElementById("video-edit-button");
let videoSaveButton = document.getElementById("video-save-button");
let videoCancelButton = document.getElementById("video-cancel-button");
const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});
let section = params.section;

if (section == null) 
{
	hideName();
	hideIndustry();
	hideDescription()
	hideAddress();
	hideCity();
	hideProvince();
	hidePostal();
	hideWebsite();
	hideFacebook();
	hideInstagram();
	hideTwitter();
	hideTiktok();
	hideYoutube();
	hideVideo();
}
else if (section == "name") 
{
	showName();
	hideIndustry();
	hideDescription()
	hideAddress();
	hideCity();
	hideProvince();
	hidePostal();
	hideWebsite();
	hideFacebook();
	hideInstagram();
	hideTwitter();
	hideTiktok();
	hideYoutube();
	hideVideo();
} 
else if (section == "industry") 
{
	hideName();
	showIndustry();
	hideDescription()
	hideAddress();
	hideCity();
	hideProvince();
	hidePostal();
	hideWebsite();
	hideFacebook();
	hideInstagram();
	hideTwitter();
	hideTiktok();
	hideYoutube();
	hideVideo();
} 
else if (section == "description") 
{
	hideName();
	hideIndustry();
	showDescription()
	hideAddress();
	hideCity();
	hideProvince();
	hidePostal();
	hideWebsite();
	hideFacebook();
	hideInstagram();
	hideTwitter();
	hideTiktok();
	hideYoutube();
	hideVideo();
} 
else if (section == "address") 
{
	hideName();
	hideIndustry();
	hideDescription()
	showAddress();
	hideCity();
	hideProvince();
	hidePostal();
	hideWebsite();
	hideFacebook();
	hideInstagram();
	hideTwitter();
	hideTiktok();
	hideYoutube();
	hideVideo();
} 
else if (section == "city")
{
	hideName();
	hideIndustry();
	hideDescription()
	hideAddress();
	showCity();
	hideProvince();
	hidePostal();
	hideWebsite();
	hideFacebook();
	hideInstagram();
	hideTwitter();
	hideTiktok();
	hideYoutube();
	hideVideo();
} 
else if (section == "province")
{
	hideName();
	hideIndustry();
	hideDescription()
	hideAddress();
	hideCity();
	showProvince();
	hidePostal();
	hideWebsite();
	hideFacebook();
	hideInstagram();
	hideTwitter();
	hideTiktok();
	hideYoutube();
	hideVideo();
} 
else if (section == "postal") 
{
	hideName();
	hideIndustry();
	hideDescription()
	hideAddress();
	hideCity();
	hideProvince();
	showPostal();
	hideWebsite();
	hideFacebook();
	hideInstagram();
	hideTwitter();
	hideTiktok();
	hideYoutube();
	hideVideo();
} 
else if (section == "website") 
{
	hideName();
	hideIndustry();
	hideDescription()
	hideAddress();
	hideCity();
	hideProvince();
	hidePostal();
	showWebsite();
	hideFacebook();
	hideInstagram();
	hideTwitter();
	hideTiktok();
	hideYoutube();
	hideVideo();
} 
else if (section == "facebook") 
{
	hideName();
	hideIndustry();
	hideDescription()
	hideAddress();
	hideCity();
	hideProvince();
	hidePostal();
	hideWebsite();
	showFacebook();
	hideInstagram();
	hideTwitter();
	hideTiktok();
	hideYoutube();
	hideVideo();
}
else if (section == "instagram") 
{
	hideName();
	hideIndustry();
	hideDescription()
	hideAddress();
	hideCity();
	hideProvince();
	hidePostal();
	hideWebsite();
	hideFacebook();
	showInstagram();
	hideTwitter();
	hideTiktok();
	hideYoutube();
	hideVideo();
} 
else if (section == "twitter") 
{
	hideName();
	hideIndustry();
	hideDescription()
	hideAddress();
	hideCity();
	hideProvince();
	hidePostal();
	hideWebsite();
	hideFacebook();
	hideInstagram();
	showTwitter();
	hideTiktok();
	hideYoutube();
	hideVideo();
}
else if (section == "tiktok")
{
	hideName();
	hideIndustry();
	hideDescription()
	hideAddress();
	hideCity();
	hideProvince();
	hidePostal();
	hideWebsite();
	hideFacebook();
	hideInstagram();
	hideTwitter();
	showTiktok();
	hideYoutube();
	hideVideo();
}
else if (section == "youtube")
{
	hideName();
	hideIndustry();
	hideDescription()
	hideAddress();
	hideCity();
	hideProvince();
	hidePostal();
	hideWebsite();
	hideFacebook();
	hideInstagram();
	hideTwitter();
	hideTiktok();
	showYoutube();
	hideVideo();
}
else if (section == "video")
{
	hideName();
	hideIndustry();
	hideDescription()
	hideAddress();
	hideCity();
	hideProvince();
	hidePostal();
	hideWebsite();
	hideFacebook();
	hideInstagram();
	hideTwitter();
	hideTiktok();
	hideYoutube();
	showVideo();
}

function showName() 
{
	companyNameDisplay.className = "d-none";
	companyNameEdit.className = "display-info form-control me-3";
	companyNameEditButton.className = "d-none";
	companyNameSaveButton.className = "btn btn-primary me-2 mt-2";
	companyNameCancelButton.className = "btn btn-danger mt-2";
}

function hideName() 
{
	companyNameDisplay.className = "display-info";
	companyNameEdit.className = "d-none";
	companyNameEditButton.className = "edit-button";
	companyNameSaveButton.className = "d-none";
	companyNameCancelButton.className = "d-none";
}

function showIndustry() 
{
	industryDisplay.className = "d-none";
	industryEdit.className = "display-info form-control me-3";
	industryEditButton.className = "d-none";
	industrySaveButton.className = "btn btn-primary me-2 mt-2";
	industryCancelButton.className = "btn btn-danger mt-2";
}

function hideIndustry() 
{
	industryDisplay.className = "display-info";
	industryEdit.className = "d-none";
	industryEditButton.className = "edit-button";
	industrySaveButton.className = "d-none";
	industryCancelButton.className = "d-none";
}

function showDescription() 
{
	descriptionDisplay.className = "d-none";
	descriptionEdit.className = "display-info form-control me-3";
	descriptionEditButton.className = "d-none";
	descriptionSaveButton.className = "btn btn-primary me-2 mt-2";
	descriptionCancelButton.className = "btn btn-danger mt-2";
}

function hideDescription() 
{
	descriptionDisplay.className = "display-info";
	descriptionEdit.className = "d-none";
	descriptionEditButton.className = "edit-button";
	descriptionSaveButton.className = "d-none";
	descriptionCancelButton.className = "d-none";
}

function showAddress() 
{
	addressDisplay.className = "d-none";
	addressEdit.className = "display-info form-control me-3";
	addressEditButton.className = "d-none";
	addressSaveButton.className = "btn btn-primary me-2 mt-2";
	addressCancelButton.className = "btn btn-danger mt-2";
}

function hideAddress() 
{
	addressDisplay.className = "display-info";
	addressEdit.className = "d-none";
	addressEditButton.className = "edit-button";
	addressSaveButton.className = "d-none";
	addressCancelButton.className = "d-none";
}

function showCity() 
{
	cityDisplay.className = "d-none";
	cityEdit.className = "display-info form-control me-3";
	cityEditButton.className = "d-none";
	citySaveButton.className = "btn btn-primary me-2 mt-2";
	cityCancelButton.className = "btn btn-danger mt-2";
}

function hideCity() 
{
	cityDisplay.className = "display-info";
	cityEdit.className = "d-none";
	cityEditButton.className = "edit-button";
	citySaveButton.className = "d-none";
	cityCancelButton.className = "d-none";
}

function showProvince() 
{
	provinceDisplay.className = "d-none";
	provinceEdit.className = "form-select me-3";
	provinceEditButton.className = "d-none";
	provinceSaveButton.className = "btn btn-primary me-2 mt-2";
	provinceCancelButton.className = "btn btn-danger mt-2";
}

function hideProvince() 
{
	provinceDisplay.className = "display-info";
	provinceEdit.className = "d-none";
	provinceEditButton.className = "edit-button";
	provinceSaveButton.className = "d-none";
	provinceCancelButton.className = "d-none";
}

function showPostal() 
{
	postalDisplay.className = "d-none";
	postalEdit.className = "display-info-small form-control me-3";
	postalEditButton.className = "d-none";
	postalSaveButton.className = "btn btn-primary me-2 mt-2";
	postalCancelButton.className = "btn btn-danger mt-2";
}

function hidePostal() 
{
	postalDisplay.className = "display-info";
	postalEdit.className = "d-none";
	postalEditButton.className = "edit-button";
	postalSaveButton.className = "d-none";
	postalCancelButton.className = "d-none";
}

function showWebsite() 
{
	websiteDisplay.className = "d-none";
	websiteEdit.className = "display-info form-control me-3";
	websiteEditButton.className = "d-none";
	websiteSaveButton.className = "btn btn-primary me-2 mt-2";
	websiteCancelButton.className = "btn btn-danger mt-2";
}

function hideWebsite() 
{
	websiteDisplay.className = "display-info";
	websiteEdit.className = "d-none";
	websiteEditButton.className = "edit-button";
	websiteSaveButton.className = "d-none";
	websiteCancelButton.className = "d-none";
}

function showFacebook() 
{
	facebookDisplay.className = "d-none";
	facebookEdit.className = "display-info form-control me-3";
	facebookEditButton.className = "d-none";
	facebookSaveButton.className = "btn btn-primary me-2 mt-2";
	facebookCancelButton.className = "btn btn-danger mt-2";
}

function hideFacebook() 
{
	facebookDisplay.className = "display-info";
	facebookEdit.className = "d-none";
	facebookEditButton.className = "edit-button";
	facebookSaveButton.className = "d-none";
	facebookCancelButton.className = "d-none";
}

function showInstagram() 
{
	instagramDisplay.className = "d-none";
	instagramEdit.className = "display-info form-control me-3";
	instagramEditButton.className = "d-none";
	instagramSaveButton.className = "btn btn-primary me-2 mt-2";
	instagramCancelButton.className = "btn btn-danger mt-2";
}

function hideInstagram() 
{
	instagramDisplay.className = "display-info";
	instagramEdit.className = "d-none";
	instagramEditButton.className = "edit-button";
	instagramSaveButton.className = "d-none";
	instagramCancelButton.className = "d-none";
}

function showTwitter() 
{
	twitterDisplay.className = "d-none";
	twitterEdit.className = "display-info form-control me-3";
	twitterEditButton.className = "d-none";
	twitterSaveButton.className = "btn btn-primary me-2 mt-2";
	twitterCancelButton.className = "btn btn-danger mt-2";
}

function hideTwitter() 
{
	twitterDisplay.className = "display-info";
	twitterEdit.className = "d-none";
	twitterEditButton.className = "edit-button";
	twitterSaveButton.className = "d-none";
	twitterCancelButton.className = "d-none";
}

function showTiktok() 
{
	tiktokDisplay.className = "d-none";
	tiktokEdit.className = "display-info form-control me-3";
	tiktokEditButton.className = "d-none";
	tiktokSaveButton.className = "btn btn-primary me-2 mt-2";
	tiktokCancelButton.className = "btn btn-danger mt-2";
}

function hideTiktok() 
{
	tiktokDisplay.className = "display-info";
	tiktokEdit.className = "d-none";
	tiktokEditButton.className = "edit-button";
	tiktokSaveButton.className = "d-none";
	tiktokCancelButton.className = "d-none";
}

function showYoutube() 
{
	youtubeDisplay.className = "d-none";
	youtubeEdit.className = "display-info form-control me-3";
	youtubeEditButton.className = "d-none";
	youtubeSaveButton.className = "btn btn-primary me-2 mt-2";
	youtubeCancelButton.className = "btn btn-danger mt-2";
}

function hideYoutube() 
{
	youtubeDisplay.className = "display-info";
	youtubeEdit.className = "d-none";
	youtubeEditButton.className = "edit-button";
	youtubeSaveButton.className = "d-none";
	youtubeCancelButton.className = "d-none";
}

function showVideo() 
{
	videoDisplay.className = "d-none";
	videoEdit.className = "display-info form-control me-3";
	videoEditButton.className = "d-none";
	videoSaveButton.className = "btn btn-primary me-2 mt-2";
	videoCancelButton.className = "btn btn-danger mt-2";
}

function hideVideo() 
{
	videoDisplay.className = "display-info";
	videoEdit.className = "d-none";
	videoEditButton.className = "edit-button";
	videoSaveButton.className = "d-none";
	videoCancelButton.className = "d-none";
}

// side bar function
function hide() 
{
	document.getElementById("try").classList.remove("active-side-bar");
	document.getElementById("showIcon").style.visibility = "visible";
	document.getElementById("showIcon").style.position = "absolute";
	document.getElementById("hamburger-position").style.position = "sticky";
}

function show() 
{
	document.getElementById("try").classList.add("active-side-bar");
	document.getElementById("showIcon").style.visibility = "hidden";
	document.getElementById("showIcon").style.position = "sticky";
	document.getElementById("hamburger-position").style.position = "absolute";
}

function screensize() 
{
    if (x.matches) 
	{
        document.getElementById("try").classList.remove("active-side-bar");
        document.getElementById("showIcon").style.visibility = "visible";
        document.getElementById("showIcon").style.position = "absolute";
        document.getElementById("hamburger-position").style.position = "sticky";
    } 
	else 
	{
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

<?php
// include ("../includes/no-footer.php");
?>