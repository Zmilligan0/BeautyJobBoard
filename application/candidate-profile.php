<?php
$pageTitle = "Candidate Profile";
$accl = "2,1";
include("includes/job_connect.php");
include("includes/utils.php");

$type = $_SESSION['type'];

if (isset($_GET['error'])) {
    $resumeError = $_GET['error'];
}
$user = '';
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $user = $res = mysqli_query($jobConn, "SELECT * FROM candidate WHERE user_id = '$userId' LIMIT 1");

    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_array($res);
        $candidate_id = $row['candidate_id'];
    } else {
        header("Location: index");
    }
    $candidate_result = mysqli_query($jobConn, "SELECT first_name, last_name, headline, city, province, country, personal_description, visibility, facebook, instagram, linkedin, tiktok, banner_photo, profile_photo from candidate
    WHERE candidate_id = $candidate_id") or die(mysqli_error($jobConn));
    $row1 = mysqli_fetch_array($candidate_result);
    if ($row1['visibility'] == 0 && $type != 0) {
        header("Location: index");
    }
}
include("includes/header.php");
include("includes/_functions.php");
// $candidate_result = mysqli_query($jobConn, "SELECT first_name, last_name, headline, city, province, country, personal_description, visibility, facebook, instagram, linkedin, tiktok from candidate
// WHERE candidate_id = $candidate_id") or die(mysqli_error($jobConn));
// $row1 = mysqli_fetch_array($candidate_result);

$education_result = mysqli_query($jobConn, "SELECT degree_type, institution_name, field, education.start_date, education.end_date from education
WHERE candidate_id = $candidate_id") or die(mysqli_error($jobConn));

$experience_result = mysqli_query($jobConn, "SELECT title, company_name, start_date, end_date, city, province, country from experience
WHERE candidate_id = $candidate_id") or die(mysqli_error($jobConn));

$user_result = mysqli_query($jobConn, "SELECT * from user
WHERE user_id = '$userId'") or die(mysqli_error($jobConn));

?>
<style>
    .line {
        line-height: 0.5;
        font-weight: lighter;
    }

    .line1 {
        line-height: 1;
    }

    .view-bg {
        background-color: #aedef4;
        color: #556ee6;
    }

    .view-bg:hover {
        color: #aedef4;
        background-color: #556ee6;
    }

    .download-bg {
        background-color: #97f1e0;
        color: #18a38b;
    }

    .download-bg:hover {
        color: #97f1e0;
        background-color: #18a38b;
    }

    .delete-bg {
        background-color: #f197a8;
        color: #e2274a;
    }

    .delete-bg:hover {
        color: #f197a8;
        background-color: #e2274a;
    }

    h4 {
        color: white !important;
    }
</style>
<script src="../config.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="static/css/jordan.css" rel="stylesheet">
<main>
    <!-- Profile picture and related details -->
    <div>
        <?php
        if ($row1['banner_photo'] == "") {
            $banner_image = $companyBannerImagePath . "default.jpg";
        } else {
            $banner_image = $companyBannerImagePath . $row1['banner_photo'];
        }
        ?>
        <img src="<?php echo $banner_image; ?>" alt="<?php echo $banner_image; ?>" id="cover-photo" class="img-fluid mx-auto d-block">
    </div>
    <div>
        <?php
        if ($row1['profile_photo'] == "") {
            $profile_image = $companyProfileImagePath . "default.png";
        } else {
            $profile_image = $companyProfileImagePath . $row1['profile_photo'];
        }
        ?>
        <div id="user-bio" class="d-sm-flex" >
            <img src="<?php echo $profile_image; ?>" alt="<?php echo $profile_image; ?>" id="profile-photo" class="rounded-circle mx-2" height="168" width="168">
            <div class="mt-4">
                <h1 class="text-white"><?php echo $row1['first_name'] . " " . $row1['last_name']; ?></h1>
                <p class="text-white"><?php echo $row1['headline']; ?></p>
                <p class="text-white"><?php echo $row1['city'] . ", " . $row1['province'] . ", " . $row1['country']; ?></p>
            </div>
        </div>
    </div>
    <!-- <a href="candidate/edit-profile?id=<?php echo $userId ?>">edit</a> -->

    <?php
    if (isset($_GET['error'])) {
        if ($resumeError == "size") {
            echo "error: size";
        } else if ($resumeError == "type") {
            echo "error: type";
        } else if ($resumeError == "other") {
            echo "error: other";
        }
    }
    ?>

    <!-- Profile information -->
    <div class="d-flex flex-column flex-xl-row flex-wrap justify-content-center">
        <div id="bio-card" class="mt-4 order-1">
            <div class="card main-card me-xl-4">
                <div class="card-body">
                    <h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person" viewBox="0 0 16 16">
                            <path d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z" />
                            <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        </svg>
                        About Me
                    </h3>
                    <?php echo $row1['personal_description']; ?>
                    <h3 class="mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
                            <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z" />
                            <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z" />
                        </svg>
                        Education
                    </h3>
                    <?php while ($row = mysqli_fetch_array($education_result)) : ?>
                        <h6 class="line1"><?php echo $row['institution_name']; ?></h6>
                        <p class="text-muted line"><?php echo $row['degree_type'] . ", " . $row['field']; ?></p>
                        <p class="text-muted line">Graduation: <?php echo date('F j, Y', strtotime($row['end_date'])); ?></p>
                    <?php endwhile; ?>
                    <h3 class="mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                        </svg>
                        Experience
                    </h3>
                    <?php while ($row = mysqli_fetch_array($experience_result)) : ?>
                        <h6 class="line1"><?php echo $row['title']; ?></h6>
                        <p class="line1"><?php echo $row['company_name']; ?></p>
                        <p class="text-muted line"><?php echo date('F, Y', strtotime($row['start_date'])); ?> - <?php echo date('F, Y', strtotime($row['end_date'])); ?></p>
                        <p class="text-muted line"><?php echo $row['city'] . ", " . $row['province'] . ", " . $row['country']; ?></p>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        <div id="social-card" class="mt-4 order-3 order-xl-2">
            <div>
                <div class="card main-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Contact Me</h5>
                        <?php while ($row = mysqli_fetch_array($user_result)) : ?>
                            <p>(<?php echo substr($row['phone_number'], 0, 3); ?>) <?php echo substr($row['phone_number'], 3, 3); ?>-<?php echo substr($row['phone_number'], 6, 4); ?></p>
                            <p><?php echo $row['email']; ?></p>
                        <?php endwhile; ?>
                        <?php
                        if ($row1['facebook'] != null) {
                            echo '
                            <a href="' . $row1['facebook'] . '" id="facebook-link" class="me-3">
                                <img src="static/img/facebook.png" alt="Facebook" id="facebook-logo" height="25" width="25">
                            </a>
                            ';
                        }
                        if ($row1['instagram'] != null) {
                            echo '
                            <a href="' . $row1['instagram'] . '" id="instagram-link" class="me-3">
                                <img src="static/img/instagram.png" alt="Instagram" id="instagram-logo" height="25" width="25">
                            </a>
                            ';
                        }

                        if ($row1['linkedin'] != null) {
                            echo '
                            <a href="' . $row1['linkedin'] . '" id="twitter-link" class="me-3">
                                <img src="static/img/linkedin-logo.png" alt="Linkedin" id="linkedin-logo" height="25" width="25">
                            </a>
                            ';
                        }

                        if ($row1['tiktok'] != null) {
                            echo '
                            <a href="' . $row1['tiktok'] . '" id="tiktok-link" class="me-3">
                                <img src="static/img/tiktok.png" alt="TikTok" id="tiktok-logo" height="25" width="25">
                            </a>
                            ';
                        }
                        ?>
                        <?php
                        if ($type == 1) : ?>

                            <div class="container">
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-primary btn-sm" href="report?id=<?php echo $userId ?>">Report Profile</a>
                                </div>
                            </div>



                        <?php endif ?>
                    </div>

                </div>
                <?php
                // $type = $_SESSION['type'];
                if ($type == 0) {
                    echo '
                        <form action="scripts/services/status.php?id=' . $userId . '" method="POST" id="publish-card" class="card main-card">
                        <div class="card-body">
                        ';
                }
                ?>
                <!-- <form action="scripts/services/status.php?id=<?php echo $userId ?>" method="POST" id="publish-card" class="card main-card">
                <div class="card-body"> -->
                <?php
                // $type = $_SESSION['type'];
                // echo $type;
                $publication_status;
                // echo $row1['visibility'];
                if ($row1['visibility'] == 1 && $type == 0) {
                    $publication_status = "PUBLISHED";
                    echo '
                        <p id="publish-status-text">Your profile is currently ' . $publication_status . '</p>
                        <div class="form-check form-switch d-flex justify-content-between">
                            <div>
                                <input id="publish-switch" name="publish-switch" class="form-check-input" type="checkbox" role="switch" onchange="changeIsPublished()" checked>
                                <label class="form-check-label" for="publish-switch">Publish</label>
                            </div>
                            <button id="save-published-button" name="save-published-button" class="btn btn-success d-none">Save</button>
                        </div>
                        ';
                } else if ($type == 0) {
                    $publication_status = "UNPUBLISHED";
                    echo '
                        <p id="publish-status-text">Your profile is currently ' . $publication_status . '</p>
                        <div class="form-check form-switch d-flex justify-content-between">
                            <div>
                                <input id="publish-switch" name="publish-switch" class="form-check-input" type="checkbox" role="switch" onchange="changeIsPublished()">
                                <label class="form-check-label" for="publish-switch">Publish</label>
                            </div>
                            <button id="save-published-button" name="save-published-button" class="btn btn-success d-none">Save</button>
                        </div>
                        ';
                }
                ?>
                <script>
                    let savePublishedButton = document.getElementById("save-published-button");
                </script>
                <!-- <p id="publish-status-text">Your profile is currently <?php echo $publication_status ?></p>
                    <div class="form-check form-switch d-flex justify-content-between">
                        <div> -->
                <!-- <input id="publish-switch" name="publish-switch" class="form-check-input" type="checkbox" role="switch" onchange="changeIsPublished()" checked>
                            <label class="form-check-label" for="publish-switch">Publish</label>
                        </div>
                        <button id="save-published-button" name="save-published-button" class="btn btn-success d-none">Save</button>
                    </div> -->
                <?php
                if ($type == 0) {
                    echo '
                        </div>
                        </form>
                        ';
                }
                ?>
                <!-- </div>
            </form> -->
            </div>
        </div>
        <!-- Instagram feed -->
        <?php
        $result = mysqli_query($jobConn, "SELECT * FROM candidate WHERE user_id = $userId") or die("Error: " . mysqli_error($jobConn));
        $current_user = mysqli_fetch_array($result);
        $instagram_token = $current_user['instagram_key'];
        $instagram_user_id = $current_user['instagram_id'];
        if ((strlen($instagram_token)) > "1" || ($type == 0)) {
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
        if (($instagram_token) == "1" && ($type == 0)) {

            echo '
        <div id="connect-instagram" class="d-flex align-items-center justify-content-center main-card" autofocus>
            <button id="connect-instagram-button" class="btn btn-primary" autofocus>Connect Instagram</button>
            <p id="instagram-confirmation-text" class="d-none">Your Instagram Account is Connected!</p>
        </div>
        ';
            // mysqli_query($conn, "UPDATE candidate SET instagram_key = 2 WHERE user_id = $userId") or die("Error: " . mysqli_error($conn));
            mysqli_query($jobConn, "UPDATE candidate SET instagram_key = 2 WHERE user_id = $userId") or die("Error: " . mysqli_error($jobConn));
        } else if ($type == 0) {
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
        if ((strlen($instagram_token)) > "1" || ($type == 0)) {
            echo '
            </div>
            ';
        }

        ?>
        <!-- </div> -->
        <!-- Resume feed (echoed through php) -->
        <?php
        if ($type == 0) {
            echo '
            <div class="container pt-4 order-4">
            <h2>Resumes</h2>
            <p>Upload a pdf resume</p>
            ';
        }
        ?>
        <!-- <div class="container pt-4 order-4">
        <h2>Resumes</h2> -->
        <?php
        // $conn = new mysqli("localhost", "root", '', "job_platform");

        $result = mysqli_query($jobConn, "SELECT * FROM resume") or die("Error: " . mysqli_error($jobConn));
        // if (mysqli_num_rows($result) == 0) {
        //     mysqli_query($jobConn, "INSERT INTO resume (candidate_id, has_resume_one, has_resume_two, has_resume_three, resume_one_name, resume_two_name, resume_three_name) VALUES ('$candidate_id', 0, 0, 0, 'My Resume One', 'My Resume Two', 'My Resume Three')") or die("Error: " . mysqli_error($jobConn));
        // }

        // $result = mysqli_query($jobConn, "SELECT * FROM resume") or die("Error: " . mysqli_error($jobConn));
        if ($type == 0) {
            while ($row = mysqli_fetch_array($result)) {
                // $RESUMEID = $row['resume_id'];
                $candidateID = $row['candidate_id'];
                $FIRST = $row['has_resume_one'];
                $SECOND = $row['has_resume_two'];
                $THIRD = $row['has_resume_three'];
                $resumeOneName = $row['resume_one_name'];
                $resumeTwoName = $row['resume_two_name'];
                $resumeThreeName = $row['resume_three_name'];


                // $RESUMEID = 0;
                // $CANDIDATEID = 8;
                // $FIRST = 0;
                // $SECOND = 0;
                // $THIRD = 0;

                if ($candidateID == $candidate_id) {
                    if ($FIRST == 0) {
                        echo
                        '<div id="resume-three-section" class="card main-card mb-2">
                            <div class="card-body">
                                <div class="col-8 mx-auto">
                                    <form action="scripts/resume/upload.php?activeres=' . $candidateID . '&id=' . $userId . '" method="POST" enctype="multipart/form-data">
                                        <label for="uploadResumeOne" class="form-label">Upload resume</label>
                                        <input class="form-control" name="uploadResumeOne" id="uploadResumeOne" type="file" accept="pdf">
                                        <input class="btn btn-primary mt-2" type="submit" value="Upload Resume" name="submitA">
                                    </form>
                                    <button type="button" id="view-resume-one" class="btn btn-primary d-none">View</button>
                                    <button type="button" class="btn btn-success d-none">Download</button>
                                    <button id="resume-one-delete-button" name="resume-one-delete-button" type="submit" class="btn btn-danger d-none" onclick="clicked(event)">Delete</button>
                                    <button type="button" id="view-resume-two" class="btn btn-primary d-none">View</button>
                                    <button type="button" class="btn btn-success d-none">Download</button>
                                    <button id="resume-two-delete-button" name="resume-two-delete-button" type="submit" class="btn btn-danger d-none" onclick="clicked(event)">Delete</button>
                                    <button type="button" id="view-resume-three" class="btn btn-primary d-none">View</button>
                                    <button type="button" class="btn btn-success d-none">Download</button>
                                    <button id="resume-three-delete-button" name="resume-three-delete-button" type="submit" class="btn btn-danger d-none" onclick="clicked(event)">Delete</button>
                                    <p id="resume-one" class="d-none"></p>
                                    <p id="resume-two" class="d-none"></p>
                                    <p id="resume-three" class="d-none"></p>
                                </div>
                            </div>
                        </div>';
                    } else {
                        echo
                        '<div class="card main-card mb-4">
                            <div class="card-body">
                                <div class="col-8 py-4 mx-auto">

                                    <h5 id="resume-one-title">' . $resumeOneName . '</h5>
                                    
                                    <div class="d-flex" id="resume-one-title-edit">
                                        <form action="scripts/resume/update.php?canId=' . $candidateID . '&id=' . $userId . '" method="POST">
                                            <input type="text" id="resume-one-edit" name="resume-one-edit" maxlength="100" autofocus value="' . $resumeOneName . '">
                                        
                                            <button id="resume-one-save-button" name="resume-one-save-button" type="submit" class="btn btn-warning">Save</button>
                                        </form>
                                    </div>

                                    <object data="scripts/resume/uploads/' . $candidateID . '-one.pdf" type="application/pdf" id="resume-one" class="d-none">
                                        <p>
                                            Your web browser doesnt have a PDF plugin. Please download to view.
                                        </p>
                                    </object>
                                </div>
                                <div class="col-8 mx-auto d-flex">
                                
                                    <button type="button" id="view-resume-one" class="view-bg btn d-none d-xl-inline-block btn-primary me-2">View</button>
                                    <a href="scripts/resume/uploads/' . $candidateID . '-one.pdf" target="_blank" class="btn btn-primary d-xl-none">View</a> 

                                    
                                    <a href="scripts/resume/uploads/' . $candidateID . '-one.pdf" download>
                                        <button type="button" class="btn me-2 btn-success download-bg">Download</button>
                                    </a>

                                    <form action="scripts/resume/delete.php?canID=' . $candidateID . '&id=' . $userId . '&activeres=one" method="POST">

                                        <button id="resume-one-delete-button" name="resume-one-delete-button" type="submit" class="btn me-2 btn-danger delete-bg" onclick="clicked(event)">Delete
                                        </button>

                                    </form>';

                        // if ($type == 0) {
                            echo '
                                    <a href="candidate-profile?section=resumeOne&id=' . $userId . '" id="resume-one-edit-button"><svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" fill="currentColor" class="bi bi-pencil-square rounded view-bg" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg></a>
                                    ';
                        // }

                        echo '
                                </div>
                            </div>
                        </div>';
                        if ($SECOND == 0) {
                            echo
                            '<div id="resume-three-section" class="card main-card mb-2">
                                <div class="card-body">
                                    <div class="col-8 mx-auto">
                                        <form action="scripts/resume/upload.php?activeres=' . $candidateID . '&id=' . $userId . '" method="POST" enctype="multipart/form-data">
                                            <label for="uploadResumeTwo" class="form-label">Upload resume</label>
                                            <input class="form-control" name="uploadResumeTwo" id="uploadResumeTwo" type="file" accept="pdf">
                                            <input class="btn btn-primary mt-2" type="submit" value="Upload Resume" name="submitB">
                                        </form>
                                        <button type="button" id="view-resume-two" class="btn btn-primary d-none me-2">View</button>
                                        <button type="button" class="btn btn-success d-none">Download</button>
                                        <button id="resume-two-delete-button" name="resume-two-delete-button" type="submit" class="btn btn-danger d-none" onclick="clicked(event)">Delete</button>
                                        <button type="button" id="view-resume-three" class="btn btn-primary d-none">View</button>
                                        <button type="button" class="btn btn-success d-none">Download</button>
                                        <button id="resume-three-delete-button" name="resume-three-delete-button" type="submit" class="btn btn-danger d-none" onclick="clicked(event)">Delete</button>
                                        <p id="resume-two" class="d-none"></p>
                                        <p id="resume-three" class="d-none"></p>
                                    </div>
                                </div>
                            </div>';
                        } else {
                            echo
                            '<div class="card main-card mb-4">
                                <div class="card-body">
                                    <div class="col-8 py-4 mx-auto">
                                        <h5 id="resume-two-title">' . $resumeTwoName . '</h5>

                                        <div class="d-flex" id="resume-two-title-edit">
                                            <form action="scripts/resume/update.php?canId=' . $candidateID . '&id=' . $userId . '" method="POST">
                                                <input type="text" id="resume-two-edit" name="resume-two-edit" maxlength="100" autofocus value="' . $resumeTwoName . '">
                                            
                                                <button id="resume-two-save-button" name="resume-two-save-button" type="submit" class="btn btn-warning">Save</button>
                                            </form>
                                        </div>


                                        <object data="scripts/resume/uploads/' . $candidateID . '-two.pdf" type="application/pdf" id="resume-two" class="d-none">
                                            <p>
                                                Your web browser doesnt have a PDF plugin. Please download to view.
                                            </p>
                                            </object>
                                    </div>
                                    <div class="col-8 mx-auto d-flex">
                                        <button type="button" id="view-resume-two" class="btn btn-primary d-none d-xl-inline-block view-bg me-2">View</button>
                                        <a href="scripts/resume/uploads/' . $candidateID . '-two.pdf" target="_blank" class="btn btn-primary d-xl-none view-bg me-2">View</a> 
                                        <a href="scripts/resume/uploads/' . $candidateID . '-two.pdf" download>
                                            <button type="button" class="btn me-2 btn-success download-bg">Download</button>
                                        </a>
                                        <form action="scripts/resume/delete.php?canID=' . $candidateID . '&id=' . $userId . '&activeres=two" method="POST">
                                            <button id="resume-two-delete-button" name="resume-two-delete-button" type="submit" class="btn btn-danger delete-bg me-2" onclick="clicked(event)">Delete</button>
                                        </form>';
                            // if ($type == 0) {


                                echo '
                                        <a href="candidate-profile?section=resumeTwo&id=' . $userId . '" id="resume-two-edit-button"><svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" fill="currentColor" class="bi bi-pencil-square rounded view-bg" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg></a>
                                        ';
                            // }

                            echo '
                                    </div>
                                </div>
                            </div>';
                            if ($THIRD == 0) {
                                echo
                                '<div id="resume-three-section" class="card main-card mb-2">
                                    <div class="card-body">
                                        <div class="col-8 mx-auto">
                                            <form action="scripts/resume/upload.php?activeres=' . $candidateID . '&id=' . $userId . '" method="POST" enctype="multipart/form-data">
                                                <label for="uploadResumeThree" class="form-label">Upload resume</label>
                                                <input class="form-control" name="uploadResumeThree" id="uploadResumeThree" type="file" accept="pdf">
                                                <input class="btn btn-primary mt-2" type="submit" value="Upload Resume" name="submitC">
                                            </form>
                                            <button type="button" id="view-resume-three" class="btn btn-primary d-none">View</button>
                                            <button type="button" class="btn btn-success d-none">Download</button>
                                            <button id="resume-three-delete-button" name="resume-three-delete-button" type="submit" class="btn btn-danger d-none" onclick="clicked(event)">Delete</button>
                                            <p id="resume-three" class="d-none"></p>
                                        </div>
                                    </div>
                                </div>';
                            } else {
                                echo
                                '<div class="card main-card mb-4">
                                    <div class="card-body">
                                        <div class="col-8 py-4 mx-auto">
                                            <h5 id="resume-three-title">' . $resumeThreeName . '</h5>

                                            <div class="d-flex" id="resume-three-title-edit">
                                                <form action="scripts/resume/update.php?canId=' . $candidateID . '&id=' . $userId . '" method="POST">
                                                    <input type="text" id="resume-three-edit" name="resume-three-edit" maxlength="100" autofocus value="' . $resumeThreeName . '">
                                                
                                                    <button id="resume-three-save-button" name="resume-three-save-button" type="submit" class="btn btn-warning">Save</button>
                                                </form>
                                            </div>

                                            <object data="scripts/resume/uploads/' . $candidateID . '-three.pdf" type="application/pdf" id="resume-three" class="d-none">
                                                <p>
                                                    Your web browser doesnt have a PDF plugin. Please download to view.
                                                </p>
                                                </object>
                                        </div>
                                        <div class="col-8 mx-auto d-flex">
                                            <button type="button" id="view-resume-three" class="btn btn-primary d-none d-xl-inline-block view-bg me-2">View</button>
                                            <a href="scripts/resume/uploads/' . $candidateID . '-three.pdf" target="_blank" class="btn btn-primary d-xl-none view-bg me-2">View</a> 
                                            <a href="scripts/resume/uploads/' . $candidateID . '-three.pdf" download>
                                                <button type="button" class="btn me-2 btn-success download-bg">Download</button>
                                            </a>
                                            <form action="scripts/resume/delete.php?canID=' . $candidateID . '&id=' . $userId . '&activeres=three" method="POST">
                                                <button id="resume-three-delete-button" name="resume-three-delete-button" type="submit" class="btn btn-danger delete-bg me-2" onclick="clicked(event)">Delete</button>
                                            </form>';

                                // if ($type == 0) {
                                    echo '
                                            <a href="candidate-profile?section=resumeThree&id=' . $userId . '" id="resume-three-edit-button"><svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" fill="currentColor" class="bi bi-pencil-square rounded view-bg" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg></a>
                                            ';
                                // }

                                echo '
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                        }
                    }
                }
                
            }
        }
        else
        {
            $twosult = mysqli_query($jobConn, "SELECT * FROM resume") or die("Error: " . mysqli_error($jobConn));
            while ($row = mysqli_fetch_array($twosult)) 
            {
                // $RESUMEID = $row['resume_id'];
                $candidateID = $row['candidate_id'];
                
                $FIRST = $row['has_resume_one'];
                $SECOND = $row['has_resume_two'];
                $THIRD = $row['has_resume_three'];
                $resumeOneName = $row['resume_one_name'];
                $resumeTwoName = $row['resume_two_name'];
                $resumeThreeName = $row['resume_three_name'];


                // $RESUMEID = 0;
                // $CANDIDATEID = 8;
                // $FIRST = 0;
                // $SECOND = 0;
                // $THIRD = 0;

                if ($candidateID == $candidate_id) 
                {
                    if ($FIRST != 0) 
                    {
                    echo'
                    <div class="container pt-4 order-4">
                        <div class="card main-card mb-4">
                            <div class="card-body">
                                <div class="col-8 py-4 mx-auto">
                                    <h5 id="resume-one-title">' . $resumeOneName . '</h5>

                                    <object data="scripts/resume/uploads/' . $candidate_id . '-one.pdf" type="application/pdf" id="resume-one" class="d-none">
                                        <p>
                                            Your web browser doesnt have a PDF plugin. Please download to view.
                                        </p>
                                    </object>
                                </div>
                                <div class="col-8 mx-auto d-flex">
                                
                                    <button type="button" id="view-resume-one" class="view-bg btn d-none d-xl-inline-block btn-primary me-2">View</button>
                                    <a href="scripts/resume/uploads/' . $candidate_id . '-one.pdf" target="_blank" class="btn btn-primary d-xl-none">View</a> 
                                    
                                    <a href="scripts/resume/uploads/' . $candidate_id . '-one.pdf" download>
                                        <button type="button" class="btn me-2 btn-success download-bg">Download</button>
                                    </a>
                                </div>
                            </div>
                        </div>';
                    }
                    if ($SECOND != 0) 
                    {
                        echo
                        '<div class="card main-card mb-4">
                            <div class="card-body">
                                <div class="col-8 py-4 mx-auto">
                                    <h5 id="resume-two-title">' . $resumeTwoName . '</h5>
                                    <object data="scripts/resume/uploads/' . $candidateID . '-two.pdf" type="application/pdf" id="resume-two" class="d-none">
                                        <p>
                                            Your web browser doesnt have a PDF plugin. Please download to view.
                                        </p>
                                        </object>
                                </div>
                                <div class="col-8 mx-auto d-flex">
                                    <button type="button" id="view-resume-two" class="btn btn-primary d-none d-xl-inline-block view-bg me-2">View</button>
                                    <a href="scripts/resume/uploads/' . $candidateID . '-two.pdf" target="_blank" class="btn btn-primary d-xl-none view-bg me-2">View</a> 
                                    <a href="scripts/resume/uploads/' . $candidateID . '-two.pdf" download>
                                        <button type="button" class="btn me-2 btn-success download-bg">Download</button>
                                    </a>
                                </div>
                            </div>
                        </div>';
                    }
                    if ($THIRD != 0) 
                    {
                        echo
                        '<div class="card main-card mb-4">
                            <div class="card-body">
                                <div class="col-8 py-4 mx-auto">
                                    <h5 id="resume-three-title">' . $resumeThreeName . '</h5>
                                    <object data="scripts/resume/uploads/' . $candidateID . '-three.pdf" type="application/pdf" id="resume-three" class="d-none">
                                        <p>
                                            Your web browser doesnt have a PDF plugin. Please download to view.
                                        </p>
                                        </object>
                                </div>
                                <div class="col-8 mx-auto d-flex">
                                    <button type="button" id="view-resume-three" class="btn btn-primary d-none d-xl-inline-block view-bg me-2">View</button>
                                    <a href="scripts/resume/uploads/' . $candidateID . '-three.pdf" target="_blank" class="btn btn-primary d-xl-none view-bg me-2">View</a> 
                                    <a href="scripts/resume/uploads/' . $candidateID . '-three.pdf" download>
                                        <button type="button" class="btn me-2 btn-success download-bg">Download</button>
                                    </a>
                                </div>
                            </div>
                        </div>';
                                    
                    }
                    if ($FIRST != 0) 
                    {
                        echo '
                        </div>';
                    }
                }
            }
        }
        if ($type == 0) {
            echo '
            </div>
            ';
        }
        ?>
        <!-- </div> -->
    </div>

    <!-- <div class="container">
<div class="d-flex justify-content-end">
<a href="report">Report Profile</a>
</div>
</div> -->

</main>
<?php
include("includes/footer.php");
?>

<script>
    let instagramFeed = document.getElementById("instagram-feed");
    // let hahabutton = document.getElementById("display-instagram");

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
            let redirect_uri = "https://localhost/greenteam2022/application/intermediary";
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

        // if (reload > 0) 
        // {
        // reload = 0;
        // hideInstagram();
        // window.location.href = "https://localhost/GREENteam2022/application/candidate-profile?id=<?php echo $userId ?>";
        // displayInstagram();

        // } 
        // else if (reload == 0) 
        // {
        //     displayInstagram();
        // }

    });

    // document.getElementById("facebook-logo").src = "static/img/facebook.png";
    // document.getElementById("facebook-link").href = "https://www.facebook.com";
    // document.getElementById("instagram-logo").src = "static/img/instagram.png";
    // document.getElementById("instagram-link").href = "https://www.instagram.com";
    // document.getElementById("twitter-logo").src = "static/img/twitter.png";
    // document.getElementById("twitter-link").href = "https://www.twitter.com";
    // document.getElementById("tiktok-logo").src = "static/img/tiktok.png";
    // document.getElementById("tiktok-link").href = "https://www.tiktok.com";

    let resumeOne = document.getElementById("resume-one");
    let resumeTwo = document.getElementById("resume-two");
    let resumeThree = document.getElementById("resume-three");
    let activeResume = 1;
    document.getElementById("view-resume-one").onclick = function() {
        showResumeOne()
    };
    document.getElementById("view-resume-two").onclick = function() {
        showResumeTwo()
    };
    document.getElementById("view-resume-three").onclick = function() {
        showResumeThree()
    };

    let resumeOneEditButton = document.getElementById("resume-one-edit-button");
    let resumeOneTitle = document.getElementById("resume-one-title");
    let resumeOneTitleEdit = document.getElementById("resume-one-title-edit");

    let resumeTwoEditButton = document.getElementById("resume-two-edit-button");
    let resumeTwoTitle = document.getElementById("resume-two-title");
    let resumeTwoTitleEdit = document.getElementById("resume-two-title-edit");

    let resumeThreeEditButton = document.getElementById("resume-three-edit-button");
    let resumeThreeTitle = document.getElementById("resume-three-title");
    let resumeThreeTitleEdit = document.getElementById("resume-three-title-edit");

    let applicantView = true;
    let resumeOneDeleteButton = document.getElementById("resume-one-delete-button");
    let resumeTwoDeleteButton = document.getElementById("resume-two-delete-button");
    let resumeThreeDeleteButton = document.getElementById("resume-three-delete-button");
    let resumeThreeSection = document.getElementById("resume-three-section");
    let publishCard = document.getElementById("publish-card");
    let publishSwitch = document.getElementById("publish-switch");
    let publishStatusText = document.getElementById("publish-status-text");
    let publishInstagramSwitch = document.getElementById("publish-instagram-switch");

    // let pic1 = document.getElementById("pic1");
    // let pic2 = document.getElementById("pic2");
    // let pic3 = document.getElementById("pic3");
    // let pic4 = document.getElementById("pic4");

    let publishInstagramForm = document.getElementById("publish-instagram-form");
    let connectInstagramButton = document.getElementById("connect-instagram-button");
    let instagramConfirmationText = document.getElementById("instagram-confirmation-text");
    let instagramCard = document.getElementById("instagram-card");

    let instagramPublished = false;



    // let display_instagram_button = document.getElementById("display-instagram-button");
    // let connectInstagram = document.getElementById("connect-instagram");

    // let savePublishedButton = document.getElementById("save-published-button");
    savePublishedButton.onclick = function() {
        hideButton()
    };

    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });
    let value = params.code;
    let section = params.section;
    // let reload = parseInt(params.reload);

    console.log(section);

    if (section == "resumeOne") {
        resumeOneTitle.className = "d-none";
        resumeOneTitleEdit.className = "d-flex";
        resumeOneEditButton.className = "d-none";
        resumeTwoTitle.className = "";
        resumeTwoTitleEdit.className = "d-none";
        resumeTwoEditButton.className = "";
        resumeThreeTitle.className = "";
        resumeThreeTitleEdit.className = "d-none";
        resumeThreeEditButton.className = "";
    }
    else if (section == "resumeTwo") {
        
        resumeOneTitle.className = "";
        resumeOneTitleEdit.className = "d-none";
        resumeOneEditButton.className = "";
        resumeTwoTitle.className = "d-none";
        resumeTwoTitleEdit.className = "d-flex";
        resumeTwoEditButton.className = "d-none";
        resumeThreeTitle.className = "";
        resumeThreeTitleEdit.className = "d-none";
        resumeThreeEditButton.className = "";
        console.log("howdy");
    }
    else if (section == "resumeThree") {
        resumeOneTitle.className = "";
        resumeOneTitleEdit.className = "d-none";
        resumeOneEditButton.className = "";
        resumeTwoTitle.className = "";
        resumeTwoTitleEdit.className = "d-none";
        resumeTwoEditButton.className = "";
        resumeThreeTitle.className = "d-none";
        resumeThreeTitleEdit.className = "d-flex";
        resumeThreeEditButton.className = "d-none";
    } else {
        resumeOneTitle.className = "";
        resumeOneTitleEdit.className = "d-none";
        resumeOneEditButton.className = "";
        resumeTwoTitle.className = "";
        resumeTwoTitleEdit.className = "d-none";
        resumeTwoEditButton.className = "";
        resumeThreeTitle.className = "";
        resumeThreeTitleEdit.className = "d-none";
        resumeThreeEditButton.className = "";
    }


    // Display a specific resume
    function showResumeOne() {
        if (activeResume != 1) {
            resumeOne.className = "d-none d-xl-inline-block";
            resumeTwo.className = "d-none";
            resumeThree.className = "d-none";
            activeResume = 1;
        } else {
            resumeOne.className = "d-none";
            activeResume = 0;
        }
    }

    function showResumeTwo() {
        if (activeResume != 2) {
            resumeOne.className = "d-none";
            resumeTwo.className = "d-none d-xl-inline-block";
            resumeThree.className = "d-none";
            activeResume = 2;
        } else {
            resumeTwo.className = "d-none";
            activeResume = 0;
        }
    }

    function showResumeThree() {
        if (activeResume != 3) {
            resumeOne.className = "d-none";
            resumeTwo.className = "d-none";
            resumeThree.className = "d-none d-xl-inline-block";
            activeResume = 3;
        } else {
            resumeThree.className = "d-none";
            activeResume = 0;
        }
    }


    // Change publication status
    function changeIsPublished() {
        console.log("sakdjhduahufhsilhf");
        savePublishedButton.className = "btn btn-primary";
        // if (publishSwitch.checked) {
        //     publishStatus = "Your profile is currently PUBLISHED";
        // } else {
        //     publishStatus = "Your profile is currently UNPUBLISHED";
        // }
        // publishStatusText.innerHTML = publishStatus;
    }

    // Hide the save button after pressing it
    function hideButton() {
        savePublishedButton.className = "d-none";
    }

    // Change Instagram feed visibility
    function switchInstagramView() {
        let connectInstagram = document.getElementById("connect-instagram");
        // connectInstagram.className = ("d-flex align-items-center justify-content-center main-card");
        let pic1 = document.getElementById("pic1");
        let pic2 = document.getElementById("pic2");
        let pic3 = document.getElementById("pic3");
        let pic4 = document.getElementById("pic4");
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

    function clicked(e) {
        if (!confirm('Are you sure you want to delete this?')) {
            e.preventDefault();
        }
    }
</script>