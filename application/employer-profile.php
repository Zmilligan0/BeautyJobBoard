<?php
$pageTitle = "Employer Profile";
//$accl = "1,2";
include("includes/job_connect.php");
include("includes/utils.php");

$type = $_SESSION['type'];
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $res = mysqli_query($jobConn, "SELECT * FROM employer WHERE user_id = '$userId' LIMIT 1");
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_array($res);
        $employer_id = $row['employer_id'];
    } else {
        header("Location: index");
    }
}
include("includes/header.php");
include("includes/_functions.php");
?>
<?php
$result = mysqli_query($jobConn, "SELECT * from employer
WHERE employer_id = $employer_id") or die(mysqli_error($jobConn));
$row = mysqli_fetch_array($result);

$job_result = mysqli_query($jobConn, "SELECT title, job.job_id, job.city, job.province, job.description, post_date from job
inner join employer on job.employer_id = employer.employer_id
WHERE employer.employer_id = $employer_id") or die(mysqli_error($jobConn));

?>
<script src="../config.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="static/css/jordan.css" rel="stylesheet">
<style>
    h4 {
        color: white !important;
    }
</style>
<main>
    <!-- Logo and company details -->
    <div>
        <?php
        if ($row['banner_image'] == "") {
            $banner_image = $companyBannerImagePath . "default.jpg";
        } else {
            $banner_image = $companyBannerImagePath . $row['banner_image'];
        }
        ?>
        <img src="<?php echo $banner_image; ?>" alt="<?php echo $banner_image; ?>" id="cover-photo" class="img-fluid mx-auto d-block">
    </div>
    <div>
        <div id="user-bio" class="d-sm-flex">
            <?php if ($row['profile_image'] == "") {
                $profile_image = $companyProfileImagePath . "company_default.png";
            } else {
                $profile_image = $companyProfileImagePath . $row['profile_image'];
            }

            ?>
            <img src="<?php echo $profile_image; ?>" alt="<?php echo $profile_image; ?>" id="profile-photo" class="rounded-circle mx-2" height="168" width="168">
            <div class="mt-4">
                <h1><?php echo $row['business_name']; ?></h1>
                <p><?php echo $row['city'] . ", " . $row['province']; ?></p>
            </div>
        </div>
    </div>
    <style>
        .my-nav-link {
            background-color: lightgray !important;
        }

        .my-nav-link.active {
            background-color: #F4F5F7 !important;
        }

        .my-nav-link:hover,
        .my-nav-link.active:hover {
            background-color: #666666 !important;
        }

        .tab-content
        {
            background-color: white;
        }

        .tab-pane 
        {
            padding: 1rem;
        }
    </style>
    <!-- Profile information -->
    <div class="container d-flex flex-column flex-xl-row justify-content-between my-4">
        <div class="col-12 col-xl-8 pe-0 pe-xl-4">
            <div class="card main-card">
                <ul class="nav nav-tab">
                    <li class="nav-item">
                        <a href="#company-info-tab" class="nav-link active my-nav-link" data-bs-toggle="tab" style="color: #2F2F2F;">Company Info</a>
                    </li>
                    <li class="nav-item">
                        <a href="#why-join-us-tab" class="nav-link my-nav-link" data-bs-toggle="tab" style="color: #2F2F2F;">Why Join Us?</a>
                    </li>
                    <li class="nav-item">
                        <a href="#jobs-tab" class="nav-link my-nav-link" data-bs-toggle="tab" style="color: #2F2F2F;">Jobs</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="company-info-tab">
                        <div class="container mx-auto ">
                            <h3 class="mt-5">About Us</h3>
                            <p>
                                <?php echo $row['description']; ?>
                            </p>

                            <?php

                            $exploded_youtube_link = explode("watch?v=", $row['video']);
                            if (count($exploded_youtube_link) > 1) {
                                echo '<h3 class="mt-5">Featured Video</h3>';
                                $youtube_code = $exploded_youtube_link[1];
                                $embed_video = "https://www.youtube.com/embed/" . $youtube_code;

                                echo '<iframe width="100%" height="500" src=' . $embed_video .  '></iframe>';
                            }

                            ?>
                        </div>

                        <!-- Instagram feed -->
                        <?php
                        // $result = mysqli_query($jobConn, "SELECT * FROM candidate WHERE user_id = $userId") or die("Error: " . mysqli_error($jobConn));
                        // $current_user = mysqli_fetch_array($result);
                        $instagram_token = $row['instagram_key'];
                        $instagram_user_id = $row['instagram_id'];
                        if ((strlen($instagram_token)) > "1" || ($type == 1)) {
                            echo '
        <div id="instagram-card" class="container order-2 order-xl-3 pt-4">
        <div id="publish-instagram-form" class="d-none form-check form-switch">
            <input id="publish-instagram-switch" class="form-check-input" type="checkbox" role="switch" onchange="switchInstagramView()">
            <label class="form-check-label" for="publish-instagram-switch">Publish</label>
        </div>
        <div id="instagram-feed" class="row d-none">
            <div class="col-12 col-md-6">
                <img alt="Insert Instagram Picture Here" id="pic1" class="h-100 w-100 pt-4 d-inline-block">
            </div>
            <div class="col-12 col-md-6">
                <img alt="Insert Instagram Picture Here" id="pic2" class="h-100 w-100 pt-4 d-inline-block">
            </div>
            <div class="col-12 col-md-6">
                <img alt="Insert Instagram Picture Here" id="pic3" class="h-100 w-100 pt-4 d-inline-block">
            </div>
            <div class="col-12 col-md-6">
                <img alt="Insert Instagram Picture Here" id="pic4" class="h-100 w-100 pt-4 d-inline-block">
            </div>
        </div>
        ';
                        }

                        ?>
                        <!-- <div id="instagram-card" class="container order-2 order-xl-3 pt-4">
        <div id="publish-instagram-form" class="d-none form-check form-switch">
            <input id="publish-instagram-switch" class="form-check-input" type="checkbox" role="switch" onchange="switchInstagramView()">
            <label class="form-check-label" for="publish-instagram-switch">Publish</label>
        </div>
        <div id="instagram-feed" class="row d-none">
            <div class="col-12 col-md-6">
                <img alt="Insert Instagram Picture Here" id="pic1" class="h-100 w-100 pt-4 d-inline-block">
            </div>
            <div class="col-12 col-md-6">
                <img alt="Insert Instagram Picture Here" id="pic2" class="h-100 w-100 pt-4 d-inline-block">
            </div>
            <div class="col-12 col-md-6">
                <img alt="Insert Instagram Picture Here" id="pic3" class="h-100 w-100 pt-4 d-inline-block">
            </div>
            <div class="col-12 col-md-6">
                <img alt="Insert Instagram Picture Here" id="pic4" class="h-100 w-100 pt-4 d-inline-block">
            </div>
        </div> -->

                        <?php
                        // $conn = new mysqli("localhost", "root", '', "job_platform");
                        // $result = mysqli_query($conn, "SELECT * FROM candidate WHERE user_id = $userId") or die("Error: " . mysqli_error($conn));
                        // $result = mysqli_query($jobConn, "SELECT * FROM candidate WHERE user_id = $userId") or die("Error: " . mysqli_error($jobConn));


                        // $current_user = mysqli_fetch_array($result);
                        // $instagram_token = $current_user['instagram_key'];
                        // $instagram_user_id = $current_user['instagram_id'];
                        if (($instagram_token) == "1" && ($type == 1)) {

                            echo '
        <div id="connect-instagram" class="d-flex align-items-center justify-content-center main-card" autofocus>
            <button id="connect-instagram-button" class="btn btn-primary" autofocus>Connect Instagram</button>
            <p id="instagram-confirmation-text" class="d-none">Your Instagram Account is Connected!</p>
        </div>
        ';
                            // mysqli_query($conn, "UPDATE candidate SET instagram_key = 2 WHERE user_id = $userId") or die("Error: " . mysqli_error($conn));
                            mysqli_query($jobConn, "UPDATE candidate SET instagram_key = 2 WHERE user_id = $userId") or die("Error: " . mysqli_error($jobConn));
                        } else if ($type == 1) {
                            echo '
        <div id="connect-instagram" class="d-flex align-items-center justify-content-center main-card">
            <button id="connect-instagram-button" class="btn btn-primary">Connect Instagram</button>
            <p id="instagram-confirmation-text" class="d-none">Your Instagram Account is Connected!</p>
        </div>
        ';
                        } else {
                            echo '
        <div id="connect-instagram" class="d-flex align-items-center justify-content-center main-card d-none">
            <p id="instagram-confirmation-text" class="d-none">Your Instagram Account is Connected!</p>
        </div>
        ';
                        }
                        ?>
                        <?php
                        if ((strlen($instagram_token)) > "1" || ($type == 1)) {
                            echo '
            </div>
            ';
                        }

                        ?>

                    </div>
                    <div class="tab-pane fade" id="why-join-us-tab">
                        <div class="container mt-5">
                            <h2>Why Join Us?</h2>
                            <p>
                                <?php echo $row['description']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="jobs-tab">
                        <?php
                        function isJson($string)
                        {
                            json_decode($string);
                            return (json_last_error() == JSON_ERROR_NONE);
                        }

                        ?>
                        <?php while ($job_row = mysqli_fetch_array($job_result)) : ?>
                            <div class="card secondary-card mb-4 shadow w-100 mt-4">
                                <div class="card-header">
                                    <img src="<?= $profile_image ?>" alt="<?= $profile_image ?>" class="" height="50" width="50">
                                    <div>
                                        <h3 class="my-0 font-weight-normal"><?php echo $job_row['title'] ?></h3>
                                        <ul class="list-unstyled mt-1 mb-1">
                                            <li><?php echo $row['business_name'] ?></li>
                                            <li><?php echo $job_row['city'] . ", " . $job_row['province']; ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled mt-3 mb-4">
                                        <?php
                                        $job_row['description'] = stripslashes($job_row['description']);
                                        echo "<li id='quillContainer{$job_row['job_id']}'></li>";

                                        echo "<script>var quillJS{$job_row['job_id']} = new Quill('#quillContainer{$job_row['job_id']}', {theme: 'bubble', readOnly: true, modules: {toolbar: false}});";
                                        if (isJson($job_row['description'])) {
                                            echo "quillJS{$job_row['job_id']}.setContents({$job_row['description']})";
                                        } else {
                                            echo "quillJS{$job_row['job_id']}.setText('Job description not in valid format')";
                                        }
                                        echo "</script>";
                                        ?>


                                    </ul>
                                    <div class="d-flex justify-content-end">

                                        <p class="job-dates-font-size"><?php $date_posted = $job_row['post_date'];
                                                                        $format_date = date("M d, Y", strtotime($date_posted));
                                                                        echo $format_date;
                                                                        ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 pt-4 pt-xl-0">
            <div class="card main-card">
                <div class="card-body">
                    <h5 class="card-title">Additional Details</h5>
                    <ul class="list-unstyled mb-0">
                        <p class="mt-3 fw-bold">Industry:</p>
                        <li>
                            <?php echo $row['business_category'] ?>
                        </li>
                    </ul>
                    <div class="mt-4 d-sm-flex">
                        <?php
                        if ($row['facebook'] != null) {
                            echo '
                                <a href="' . $row['facebook'] . '" id="facebook-link" class="me-3">
                                    <img src="static/img/facebook.png" alt="Facebook" id="facebook-logo" height="25" width="25">
                                </a>
                                ';
                        }
                        if ($row['instagram'] != null) {
                            echo '
                                <a href="' . $row['instagram'] . '" id="instagram-link" class="me-3">
                                    <img src="static/img/instagram.png" alt="Instagram" id="instagram-logo" height="25" width="25">
                                </a>
                                ';
                        }

                        if ($row['linkedin'] != null) {
                            echo '
                                <a href="' . $row['linkedin'] . '" id="twitter-link" class="me-3">
                                    <img src="static/img/linkedin-logo.png" alt="Linkedin" id="linkedin-logo" height="25" width="25">
                                </a>
                                ';
                        }

                        if ($row['tiktok'] != null) {
                            echo '
                                <a href="' . $row['tiktok'] . '" id="tiktok-link" class="me-3">
                                    <img src="static/img/tiktok.png" alt="TikTok" id="tiktok-logo" height="25" width="25">
                                </a>
                                ';
                        }

                        if ($row['youtube'] != null) {
                            echo '
                                <a href="' . $row['youtube'] . '" id="youtube-link" class="me-3">
                                    <img src="static/img/youtube-logo.png" alt="YouTube" id="youtube-logo" height="25" width="25">
                                </a>
                                ';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="card main-card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Location</h5>
                    <ul class="list-unstyled mb-0 mt-4">
                        <li>
                            <p><?php echo $row['address']; ?></p>
                        </li>
                        <li>
                            <p><?php echo $row['city'] . ", " . $row['province']; ?></p>
                        </li>
                        <li>
                            <p>Canada</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
    if ($type == 0) {
        echo '
    <div class="container">
    <div class="d-flex justify-content-end mb-3">
    <a class="btn btn-danger" href="report?id=' . $userId . '">Report Profile</a>
    </div>
    </div>
    ';
    }

    ?>
</main>
<?php
include("includes/footer.php");
?>

<script>
    let instagramFeed = document.getElementById("instagram-feed");
    $(document).ready(function() {
        // Get parameters
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });
        <?php

        // $result = mysqli_query($conn, "SELECT * FROM candidate WHERE user_id = $userId") or die("Error: " . mysqli_error($conn));


        // $current_user = mysqli_fetch_array($result);
        // $instagram_token = $current_user['instagram_key'];
        // $instagram_user_id = $current_user['tiktok_key'];

        ?>
        let value = params.code;
        let reload = parseInt(params.reload);

        let myToken = <?php echo '"' . $instagram_token . '"' ?>;
        let hasToken;
        if (myToken.length <= 1) {
            hasToken = false;
        } else {
            hasToken = true;
        }


        // Connect to Instagram
        $("#connect-instagram-button").on("click", function() {
            sessionStorage.setItem("instagram_connected", true);
            let client_id = INSTAGRAM_CLIENT_ID;
            let redirect_uri = "https://localhost/greenteam2022/application/intermediary-employer";
            let myUrl = "https://api.instagram.com/oauth/authorize?client_id=" + INSTAGRAM_CLIENT_ID + "&redirect_uri=" + redirect_uri + "&scope=user_profile,user_media&response_type=code";
            window.open(myUrl, "_blank");
        });
        var client_id = INSTAGRAM_CLIENT_ID;
        var client_secret = INSTAGRAM_CLIENT_SECRET;

        if (hasToken) {
            var token = <?php echo '"' . $instagram_token . '"' ?>;
            var instagram_user_id = <?php echo '"' . $instagram_user_id . '"' ?>;
            getInstagramURLs(token, instagram_user_id);
        }

        // Display Instagram feed
        function getInstagramURLs(accessToken, userID) {
            const user_id = userID;
            const access_token = accessToken;
            const url = "https://graph.instagram.com/" + user_id + "/media?fields=media_url&access_token=" + access_token;
            $.ajax({

                type: "GET",
                url: url,
                success: function(res) {
                    let instagramFeedSize = res["data"].length;
                    if (instagramFeedSize == 0) {
                        sessionStorage.setItem("img1", "none");
                        sessionStorage.setItem("img2", "none");
                        sessionStorage.setItem("img3", "none");
                        sessionStorage.setItem("img4", "none");
                    } else if (instagramFeedSize == 1) {
                        sessionStorage.setItem("img1", res["data"][0].media_url);
                        sessionStorage.setItem("img2", "none");
                        sessionStorage.setItem("img3", "none");
                        sessionStorage.setItem("img4", "none");
                    } else if (instagramFeedSize == 2) {
                        sessionStorage.setItem("img1", res["data"][0].media_url);
                        sessionStorage.setItem("img2", res["data"][1].media_url);
                        sessionStorage.setItem("img3", "none");
                        sessionStorage.setItem("img4", "none");
                    } else if (instagramFeedSize == 3) {
                        sessionStorage.setItem("img1", res["data"][0].media_url);
                        sessionStorage.setItem("img2", res["data"][1].media_url);
                        sessionStorage.setItem("img3", res["data"][2].media_url);
                        sessionStorage.setItem("img4", "none");
                    } else if (instagramFeedSize >= 4) {
                        sessionStorage.setItem("img1", res["data"][0].media_url);
                        sessionStorage.setItem("img2", res["data"][1].media_url);
                        sessionStorage.setItem("img3", res["data"][2].media_url);
                        sessionStorage.setItem("img4", res["data"][3].media_url);
                    }


                    if (hasToken) {
                        displayInstagram();
                    }

                },
                error: function() {
                    // alert("oops 2");
                }
            })
        };

    });

    let publishCard = document.getElementById("publish-card");
    let publishSwitch = document.getElementById("publish-switch");
    let publishStatusText = document.getElementById("publish-status-text");
    let publishInstagramSwitch = document.getElementById("publish-instagram-switch");

    let pic1 = document.getElementById("pic1");
    let pic2 = document.getElementById("pic2");
    let pic3 = document.getElementById("pic3");
    let pic4 = document.getElementById("pic4");

    let publishInstagramForm = document.getElementById("publish-instagram-form");
    let connectInstagramButton = document.getElementById("connect-instagram-button");
    let instagramConfirmationText = document.getElementById("instagram-confirmation-text");
    let instagramCard = document.getElementById("instagram-card");

    let instagramPublished = false;


    let connectInstagram = document.getElementById("connect-instagram");

    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });
    let value = params.code;

    // Change Instagram feed visibility
    function switchInstagramView() {
        let connectInstagram = document.getElementById("connect-instagram");
        if (publishInstagramSwitch.checked) {
            pic1.className = ("h-100 w-100 pt-4 d-inline-block");
            pic2.className = ("h-100 w-100 pt-4 d-inline-block");
            pic3.className = ("h-100 w-100 pt-4 d-inline-block");
            pic4.className = ("h-100 w-100 pt-4 d-inline-block");
            displayInstagram();
            instagramPublished = true;
        } else {
            pic1.className = ("h-100 w-100 pt-4 d-none");
            pic2.className = ("h-100 w-100 pt-4 d-none");
            pic3.className = ("h-100 w-100 pt-4 d-none");
            pic4.className = ("h-100 w-100 pt-4 d-none");
            connectInstagram.className = "d-flex align-items-center justify-content-center main-card";
            instagramPublished = false;
        }
    }

    // Connect Instagram URLs to images
    function displayInstagram() {
        let connectInstagram = document.getElementById("connect-instagram");
        let pic1 = document.getElementById("pic1");
        let pic2 = document.getElementById("pic2");
        let pic3 = document.getElementById("pic3");
        let pic4 = document.getElementById("pic4");
        connectInstagram.className = "d-none align-items-center justify-content-center main-card";
        instagramFeed.className = "row";
        let i1src = sessionStorage.getItem("img1");
        let i2src = sessionStorage.getItem("img2");
        let i3src = sessionStorage.getItem("img3");
        let i4src = sessionStorage.getItem("img4");
        if (i1src == "none") {
            pic4.className = "d-none";
        } else {
            pic1.src = i1src;
        }

        if (i2src == "none") {
            pic4.className = "d-none";
        } else {
            pic2.src = i2src;
        }


        if (i3src == "none") {
            pic4.className = "d-none";
        } else {
            pic3.src = i3src;
        }


        if (i4src == "none") {
            pic4.className = "d-none";
        } else {
            pic4.src = i4src;
        }


    }

    function hideInstagram() {
        instagramFeed.className = "d-none";

    }
</script>