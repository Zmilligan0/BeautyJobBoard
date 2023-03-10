<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<?php
$pageTitle = "New Job";
$employer_id = $industry = "";
$accl = "0,2";
include("../includes/job_connect.php");
include("../includes/utils.php");
$hide_me = false;
if (isset($_GET)) {
    extract($_GET);
}

if (isset($_GET['user_id'])) {
    $id = $_GET['user_id'];
    $result = mysqli_query($jobConn, "SELECT * FROM employer WHERE user_id = " . $_SESSION['user_id'] . " LIMIT 1");
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);

        $_SESSION['employer_id'] = $row['employer_id'];
    } else {
        $message = "<p>There was a problem retrieving the inforamtion</p>";
    }
}


// get the employer ID
include("../includes/header.php");
include 'includes/new-job-post.php';
$employer_id = $_SESSION['employer_id'];

if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $employer_id = $_SESSION['employer_id'];
    $get_one_sql = "SELECT title,employer_id,address,city,province,description,compensation,employment_type,postal_code,expiry_date
    FROM job WHERE job_id = $job_id AND employer_id = $employer_id";
    $get_one_result = $jobConn->query($get_one_sql);
    if ($get_one_result->num_rows == 1) {
        $get_one_row = $get_one_result->fetch_assoc();
        $job_title = $get_one_row['title'];
        $job_address = $get_one_row['address'];
        $city = $get_one_row['city'];
        $province = $get_one_row['province'];
        $job_description = $get_one_row['description'];
        $salary = $get_one_row['compensation'];
        //$pay_type = $get_one_row['payment_type'];
        $employment_type = $get_one_row['employment_type'];
        $postal_code =  $get_one_row['postal_code'];
        $expiry_date = $get_one_row['expiry_date'];
    } else {
        $message = "<p>There was a problem retrieving the information</p>";
        // header("Location:".THIS_PAGE."?m=notyourad");
    }
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

        .side-bar {
            background-color: #2f2f2f
        }
    </style>

    <!-- side bar css -->
    <style>
        .side-bar-hide {
            max-width: 0;
            overflow: hidden;
            transition: all 0.15s ease-in-out;
            visibility: hidden;

        }


        .side-bar-hide.active-side-bar {
            max-width: 280px;
            visibility: visible;
            height: 100vh;
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

        .deletenotvisible {
            visibility: hidden;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.7);
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

        .hamburger-sticky {
            position: absolute;
            top: 0;
            height: 50vh;

        }
    </style>
    <!-- CSS main -->
    <style>
        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .posting-mobile-view {
            width: 50%;
        }

        .search-icon {
            display: none;


        }

        .side-bar-sticky {
            position: sticky;
            top: 0;
            height: 100vh;
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

        .sidebar-sticky {
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
            $row1 = $employer_name1->fetch_assoc();
            ?>
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark  side-bar-sticky side-bar-hide active-side-bar" style="width: 280px;" id="try">
                <div class="d-flex flex-row justify-content-between">
                    <a href="../src/salon-profile.html" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none ms-lg-4">
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
                        <a href="new-job?id=<?php echo $id ?>" class="nav-link bg-danger text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-dotted me-2" viewBox="0 0 16 16">
                                <path d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                            </svg>
                            New Job Post
                        </a>
                    </li>

                    <!-- <li>
      <a href="edit-job.php" class="nav-link text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen me-2" viewBox="0 0 16 16">
          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
        </svg>
        Edit Job Post
      </a>
    </li> -->
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
                        <a href="edit-profile?id=<?php echo $id ?>" class="nav-link text-white">
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

            <!-- New job post Form -->
            <?php if ($hide_me == false) : ?>
            <div class=" p-3 container p-5 pt-1">
                <h1 class="text-decoration-underline">New Job</h1>


                <?php include 'includes/new-job-form.php' ?>

                <!-- This form is used for editing contact info of users in the "send new candidates to" section -->
                <!-- <form class="col-12 col-lg-4 p-2 m-auto" style="border: 1px solid #ced4da">
                <div> -->
                <!-- X button -->
                <!-- <div class="text-end">
                        <a href="#"><svg class="ms-1 mb-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z" /></svg></a>
                    </div>
     -->
                <!--Todo: Auto fill inputs with the selected users info -->
                <!-- <label for="user-name" class="fw-bold mt-2 form-label">Name</label>
                    <input type="text" id="user-name" class="form-control" name="user-name" placeholder="Enter name">
    
                    <label for="user-email" class="fw-bold mt-2 form-label">Email</label>
                    <input type="email" id="user-email" class="form-control" name="user-email" placeholder="Enter email">
    
                    <label for="user-description" class="fw-bold mt-2 form-label">Description</label>
                    <input type="text" id="user-description" class="form-control" name="user-description" placeholder="Enter description">
    
                    <div class="mb-3 text-lg-end text-center">
                        <button type="submit" class="btn btn-success mt-4 ">Save</button>
                    </div>
                </div>
            </form> -->
            </div>
            <?php endif ?>
            
            <?php if ($hide_me)
            {
                echo '<div class="container p-5 pt-1">';
                include 'includes/screening-questions.php';
                echo '</div>';
            }
                
            ?>
            

    </main>
    <script>
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

    <?php

    ?>