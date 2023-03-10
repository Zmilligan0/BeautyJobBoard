<?php
$pageTitle = "Job Post";
include("includes/job_connect.php");
include("includes/utils.php");
$jobId = "";
if (isset($_GET['id'])) {
    $jobId = $_GET['id'];
} else {
    header('Location: search');
}
include("includes/header.php");
include("includes/_functions.php");
$year = date('Y');
$month = date('m');


$job_result = mysqli_query($jobConn, "SELECT job_id, title, job.city, job.province, compensation, employment_type, description, payment_type from job
WHERE job_id = $jobId ") or die(mysqli_error($jobConn));
$job_row = mysqli_fetch_array($job_result);

$employer_result = mysqli_query($jobConn, "SELECT business_name, employer.description, facebook, instagram, linkedin, tiktok, website_url, profile_image from employer
inner join job on employer.employer_id = job.employer_id  
WHERE job_id = $jobId ") or die(mysqli_error($jobConn));
$employer_row = mysqli_fetch_array($employer_result);

?>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .job-dates-font-size {
        font-size: 12px;
        color: #808080;
    }

    .company-sticky {
        position: sticky;
        top: 1rem;
    }

    .search-icon {
        display: none;
    }

    .search-bar-for-desktop {
        visibility: hidden;
        position: absolute;
    }

    /*---------- Header -------------------*/
    .nav-link {
        color: #ffffff;
    }

    .header-buttons {
        display: flex;
    }

    /*---------- Footer -------------------*/
    /* Custom font color and styling */
    footer {
        color: #ffffff;
    }

    /* Remove hyperlink underlines from the... */
    footer li a {
        text-decoration: none;
    }

    /* Removes the bullet points - cannot find a solution in bootstrap */
    .footer_widget ul li {
        list-style: none;
        display: block;
    }

    /* Color of the majority of the footer text and all hyperlink text */
    .footer_widget ul li a {
        color: #ffffff;
        font-size: 14px;
    }

    /* Top-border color of the of the copyright (bottom) footer*/
    /* .border-top {
        border-color: #ffffff;
        border-color: #ffa31a !important;
    } */

    /* Hover to display the dropdown menu is unavailable in Bootstrap */
    .dropdown:hover .dropdown-menu {
        display: block;
        /* margin-top: 0; */
        transition: all 0.5s ease;
    }

    /* Change the Login button's color when hovered  - delete me go to back to defaults*/
    /* .btn-outline-light:hover {
        background-color: #ffa31a !important;
    } */

    .plus-button {
        display: block;
    }

    .heart-button {
        display: none;
    }

    .wrapper:hover .plus-button {
        display: none;
    }

    .wrapper:hover .heart-button {
        display: block;
    }

    @media (max-width:1460px) {
        .job-description-hide {
            visibility: hidden;
            position: absolute;
        }

        .job-post-center {
            width: auto;
        }

        .btn-mobile-view {
            width: 20%;
        }

        .search-icon {
            width: 100%;
        }

        .search-bar-for-desktop {
            visibility: visible;
            position: static;
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

        .search-bar-for-desktop {
            visibility: visible;
            position: static;
        }

        .active {
            display: none;
        }
    }
</style>
<main>
    <!-- Page content-->
    <div class="container search-bar-for-desktop">
        <!-- Search bar Section -->
        <div class="row container-fluid mt-3 d-flex justify-content-center">
            <div class="col-sm-4 col-sm-4 search-bar-mobile-view">
                <input type="text" class="form-control" placeholder="Job title or company" name="job-search" id="job-search">
            </div>
            <div class="col-sm-4 col-sm-4 search-bar-mobile-view">
                <input type="text" class="form-control" placeholder="Location" name="Location-search-bar" id="Location-search-bar">
            </div>
            <div class="col-sm-4 col-sm-4 search-icon">
                <button class="btn btn-md btn-primary w-100 search-icon " type="submit" name="find-jobs" id="find-jobs">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="24px">
                        <path d="M22 20L20 22 14 16 14 14 16 14z" />
                        <path d="M9,16c-3.9,0-7-3.1-7-7c0-3.9,3.1-7,7-7c3.9,0,7,3.1,7,7C16,12.9,12.9,16,9,16z M9,4C6.2,4,4,6.2,4,9c0,2.8,2.2,5,5,5 c2.8,0,5-2.2,5-5C14,6.2,11.8,4,9,4z" />
                        <path d="M13.7 12.5H14.7V16H13.7z" transform="rotate(-44.992 14.25 14.25)" />
                    </svg>
                </button>
            </div>
            <button class="btn btn-md w-auto btn-primary desktop-view-button" type="submit" name="find-jobs" id="find-jobs">Find a Job!
            </button>
        </div>
    </div>
    <!-- page result -->
    <div class="container mt-5">
        <div class="d-flex flex-row w-100">
            <div class="card mb-4 box-shadow w-100 d-flex align-content-around flex-wrap">
                <div class="card-header">
                    <div class="m-1">
                    </div>
                    <div class="d-flex justify-content-between flex-column">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="my-0 font-weight-normal"><?php echo $job_row['title']; ?></h4>
                                <ul class="list-unstyled mt-1 mb-1">
                                    <li><?php echo $employer_row['business_name']; ?></li>
                                    <li><?php echo $job_row['city'] . ", " . $job_row['province']; ?></li>
                                </ul>
                            </div>

                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <?php if ($_SESSION['type'] == "0") : ?>
                                    <?php
                                    $user_id = $_SESSION['user_id'];
                                    $job_saved = mysqli_query($jobConn, "SELECT * from saved_job
                            Inner join candidate ON saved_job.candidate_id = candidate.candidate_id
                            WHERE job_id = $jobId AND candidate.user_id = $user_id")
                                        or die(mysqli_error($jobConn));
                                    $job_saved_query = mysqli_fetch_array($job_saved);
                                    ?>
                                    <?php if ($job_saved_query == null) : ?>
                                        <div>
                                            <?php
                                            $candidate_id = mysqli_query($jobConn, "SELECT * from candidate
                                            WHERE user_id = $user_id")
                                                or die(mysqli_error($jobConn));
                                            $candidate_id_query = mysqli_fetch_array($candidate_id);
                                            ?>
                                            <div class="wrapper">
                                                <div class="plus-button">
                                                    <a href="resources/save-job.php?job_id=<?php echo $job_row['job_id'] ?>&candidate_id=<?php echo $candidate_id_query['candidate_id'] ?>">

                                                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
                                                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                                            <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="heart-button">
                                                    <a href="resources/save-job.php?job_id=<?php echo $job_row['job_id'] ?>&candidate_id=<?php echo $candidate_id_query['candidate_id'] ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-bookmark-heart" viewBox="0 0 16 16">
                                                            <path d="M8 4.41c1.387-1.425 4.854 1.07 0 4.277C3.146 5.48 6.613 2.986 8 4.412z" />
                                                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                                        </svg>
                                                    </a>
                                                </div>

                                            </div>



                                        </div>
                                    <?php else : ?>
                                        <div>
                                            <a href="resources/delete-save-job.php?job_id=<?php echo $job_row['job_id'] ?>&candidate_id=<?php echo $job_saved_query['candidate_id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-bookmark-dash" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M5.5 6.5A.5.5 0 0 1 6 6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                                </svg>
                                            </a>
                                        </div>
                                    <?php endif ?>
                                <?php endif ?>
                            <?php endif ?>
                        </div>
                        <?php if (isset($_SESSION['user_id'])) : ?>
                            <?php if ($_SESSION['type'] == "0") : ?>
                                <div>
                                    <a href="apply?id=<?php echo $jobId ?>" class="btn btn-md btn-block btn-outline-primary w-auto mt-2">Apply
                                        Now!</a>
                                </div>
                            <?php endif ?>
                        <?php endif ?>
                        <p class="job-dates-font-size mt-2">Today</p>
                    </div>
                </div>
                <div class="card-body w-100">
                    <h4>Job Details</h4>
                    <ul class="list-unstyled mt-3 mb-4">
                        <h6>Salary</h6>
                        <li>
                            <?php 
                                $compensation = explode(",", $job_row['compensation']); 
                                $minPay = $compensation[0];
                                if(isset($compensation[1]) && $compensation[1] != $compensation[0]) {
                                    $maxPay = $compensation[1];
                                    echo $minPay . " to " . $maxPay . " CAD " . $job_row['payment_type'];
                                } else {
                                    echo $minPay . " CAD " . $job_row['payment_type'];
                                }

                            
                        
                            ?>
                        </li>
                        <li><?php //if ($job_row['compensation'] != null) { echo number_format($job_row['compensation']) . " an hour"; } 
                            ?></li>
                        <h6 class="mt-3">Job Type</h6>
                        <li><?php
                            if ($job_row['employment_type'] == 0) {
                                echo 'Full Time';
                            } elseif ($job_row['employment_type'] == 1) {
                                echo 'Part Time';
                            } elseif ($job_row['employment_type'] == 2) {
                                echo 'Contract';
                            } elseif ($job_row['employment_type'] == 3) {
                                echo 'Temporary';
                            } elseif ($job_row['employment_type'] == 4) {
                                echo 'Apprenticeship';
                            } else {
                                echo 'Unknown';
                            }
                            ?>
                        </li>

                    </ul>
                </div>
                <!-- <div class="card-body border w-100">
                    <h4>Qualifications</h4>
                    <ul class="list-unstyled mt-3 mb-4">
                        <h6>Experience</h6>
                        <li>1 Year Experience(Preferred)</li>
                        <li>Red Seal/Journeyman(Preferred)</li>
                    </ul>
                </div> -->
                <div class="card-body border w-100">
                    <h4>Full Job description</h4>
                    <div id="job_description">

                    </div>
                    <!-- Initialize Quill editor -->
                    <script>
                        var quill = new Quill('#job_description', {
                            theme: 'bubble',   
                            readOnly: true, 
                            modules: {toolbar: false}
                        });
                        quill.setContents(<?php echo stripslashes($job_row['description']) ?>);
                    </script>
                </div>

            </div>
            <!-- company info -->
            <div class="card box-shadow w-50 h-50 job-description-hide m-4 mt-0 company-sticky ">
                <div class="card-header ">
                    <h3>Company Info</h3>
                </div>
                <div class="card-body d-flex align-items-center flex-column">
                    <h5><?php echo $employer_row['business_name']; ?></h5>
                    <div id="user-bio" class="d-sm-flex">
                        <?php if ($employer_row['profile_image'] == "") {
                            $profile_image = $companyProfileImagePath . "company_default.png";
                        } else {
                            $profile_image = $companyProfileImagePath . $employer_row['profile_image'];
                        }

                        ?>
                        <img src="<?= $profile_image ?>" alt="<?= $profile_image ?>" id="profile-photo" class="rounded-circle mx-2" height="168" width="168">
                    </div>
                    <p><?php echo $employer_row['description']; ?></p>
                    <div class="row">
                        <div class="d-sm-flex ">
                            <a href="<?php echo $employe_row['facebook']; ?>" id="facebook-link" class="me-3 ms-2 mb-4">
                                <img src="static/img/facebook.png" alt="Facebook" class="mt-4 mt-sm-0" height="25" width="25">
                            </a>
                            <a href="<?php echo $employe_row['instagram']; ?>" id="instagram-link" class="me-3 ms-2">
                                <img src="static/img/instagram.png" alt="Instagram" class="mt-4 mt-sm-0" height="25" width="25">
                            </a>
                            <a href="<?php echo $employer_row['linkedin']; ?>" id="linkedin-link" class="me-3">
                                <img src="static/img/linkedin-logo.png" alt="Linkedin" class="mt-4 mt-sm-0" height="25" width="25">
                            </a>
                            <a href="<?php echo $employer_row['tiktok']; ?>" id="tiktok-link" class="me-3 ms-2">
                                <img src="static/img/tiktok.png" alt="TikTok" class="mt-4 mt-sm-0" height="25" width="25">
                            </a>
                        </div>
                    </div>
                    <a class="btn btn-outline-primary" href="<?php echo $employer_row['website_url']; ?>">Visit website</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
$result = mysqli_query($jobConn, "SELECT * FROM job_view WHERE job_id = $jobId AND month = $month AND year = $year");
if (mysqli_num_rows($result) == 1) {
    mysqli_query($jobConn, "UPDATE job_view SET view_count = view_count + 1 WHERE job_id = $jobId AND month = $month AND year = $year") or die(mysqli_error($jobConn));
} else {
    $sql = "INSERT INTO job_view (job_id, view_count, month, year) VALUES ($jobId, 1, $month, $year)";
    mysqli_query($jobConn, $sql);
}
?>

<?php
include("includes/footer.php");
?>