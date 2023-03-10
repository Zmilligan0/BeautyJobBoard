<?php
$pageTitle = "Contacts";
$accl = "0,2";
include("../includes/job_connect.php");
include("../includes/utils.php");
include("../includes/header.php");

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
$employer_id = $_SESSION['employer_id'];


if (isset($_POST['contact-search'])) {
    $job_search = $_POST['contact-search'];
    $search_part1 = "AND (first_name LIKE '%$job_search%' OR last_name LIKE '%$job_search%' OR email LIKE '%$job_search%' OR notes LIKE '%$job_search%')";
} else {
    $job_search = "";
    $search_part1 = "";
}
if (isset($_GET['id'])){
    $_GET['id'];
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}


// Pagination
$limit = 10;
$count_sql ="SELECT COUNT(*)from contact 
where employer_id = $employer_id $search_part1";
$count_result = mysqli_query($jobConn, $count_sql);
$count_row = mysqli_fetch_row($count_result);
$count_of_records = $count_row[0];

if ($count_of_records > $limit)
{
    $end = round($count_of_records % $limit, 0);
    $splits = round(($count_of_records - $end) / $limit, 0);

    if ($end !=0)
    {
        $number_of_pages = $splits + 1;
    }
    else
    {
        $number_of_pages = $splits;
    }

    $start_position = ($page * $limit) - $limit;

    $limit_string = "LIMIT $start_position, $limit";
    
} else {
    $limit_string = "LIMIT 0, $limit";
}
if (!defined("THIS_PAGE")){
    define("THIS_PAGE", $_SERVER['PHP_SELF']);
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
            background-color: #222222;
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
    <!-- CSS main-->
    <style>
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

        @media (max-width:1460px) {
            .posting-mobile-view {
                width: 100%;
            }
        }

        @media (max-width:575px) {
            .search-icon {
                display: inline;

            }

            .search-bar-mobile-view {
                margin-bottom: 1rem;
            }


        }


        .deletenotvisible {
            visibility: hidden;
            position: absolute;

            /* color with alpha channel */
            background-color: rgba(0, 0, 0, 0.7);
            /* 0.7 = 70% opacity */

            /* stretch to screen edges */
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
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white side-bar side-bar-sticky side-bar-hide active-side-bar" style="width: 280px;" id="try">
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

                    <!-- <li>
      <a href="edit-job.php" class="nav-link text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen me-2" viewBox="0 0 16 16">
          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
        </svg>
        Edit Job Post
      </a>
    </li> -->
                    <li>
                        <a href="contacts?id=<?php echo $id ?>" class="nav-link bg-danger text-white">
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
            <!-- JobList -->
            <div class="container-fluid ps-5 pt-1">
                <!-- header -->
                <div class="mt-3 mb-3">
                    <h2>Salon Contacts</h2>
                </div>

                <!-- job list sections -->

                <div class="card">
                    <div class="card-body d-flex flex-row justify-content-between mt-3">
                        <h4>Contact List</h4>
                        <!-- button for add new jobs -->
                        <div><a class="btn btn-danger" href="new-contact?id=<?php echo $id ?>">Add New Contact</a>
                            <a class="btn btn-danger" href="contacts.php?id=<?php echo $id ?>">Refresh</a>
                        </div>
                    </div>
                    <hr>
                    <!-- Search Bar -->

                    <div class=" pb-3">


                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" class="row container-fluid mt-3 d-flex justify-content-center">
                            <div class="col-sm-3 col-sm-3 search-bar-mobile-view">
                                <input type="text" class="form-control" placeholder="Name, Email, or Description" name="contact-search" id="contact-search">
                            </div>

                            <div class="desktop-view-button col-sm-2 col-sm-2 ">
                                <button class="btn btn-md w-100 btn-danger desktop-view-button" type="submit" name="find-jobs" id="find-jobs">Filter
                                </button>
                            </div>

                    </div>
                    </form>


                    <!-- contact list  -->
                    <?php
                    $list_sql = "SELECT first_name, last_name, email, notes, contact_id from contact 
                                    where employer_id = $employer_id $search_part1 $limit_string";
                    $list_result = $jobConn->query($list_sql);
                    ?>
                    <div>
                        <hr>
                        <div class="card-body d-flex justify-content-between row text-center">
                            <div class="table-responsive">
                                <table class="table table-bordered align-middlenowrap">
                                    <!-- if no list -->
                                    <?php if ($list_result->num_rows > 0) : ?>
                                        <thead>
                                            <tr>
                                                <th style="text-align: left;">No.</th>
                                                <th style="text-align: left;">Name</th>
                                                <th style="text-align: left;">E-mail</th>
                                                <th style="text-align: left;">Notes</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php $i = 1;
                                        while ($row = $list_result->fetch_assoc()) : ?>


                                            <tbody>
                                                <tr>

                                                    <th style="text-align: left;"><?php echo $i;
                                                        $i++; ?></th>
                                                    <td style="text-align: left;"><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                                                    <td style="text-align: left;"><?php echo $row['email'] ?></td>
                                                    <td style="text-align: left;"><?php echo $row['notes'] ?></td>
                                                    <td>
                                                        <?php $contact_id = $row['contact_id']; ?>
                                                        <a class="btn btn-sm btn-soft-primary pencil-bg" href="new-contact.php?id=<?php echo $id; ?>&contact_id=<?php echo $contact_id ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                            </svg></a>
                                                        <a onclick="popupFunction(<?php echo $contact_id ?>)" class="btn btn-sm btn-soft-danger deleteTrash"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                            </svg></a>
                                                    </td>
                                                </tr>
                                            <?php endwhile ?>
                                            </tbody>
                                </table>

                            </div>

                        <?php else : ?>
                            <p class="alert alert-danger text-center">No Data found</p>

                        <?php endif ?>
                            <?php include 'includes/pagination_contact.php'?>
                    </div>
                </div>
            </div>



        </div>
        </div>



    </main>





    </div>
    <!-- delete warning -->
    <div class="deletenotvisible d-flex justify-content-center align-items-center" id="deletepopup">
        <div class="deleteborder">
            <div class="modal-body px-4 py-5 text-center w-auto ">
                <button type="button" class="btn-close position-absolute end-0 top-0 m-3" onclick="closepopupFunction()"></button>
                <div class="avatar-sm mb-4 mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
                <p class="text-muted font-size-16 mb-4">Are you sure you want to permanently erase the job.</p>

                <div class="hstack gap-2 justify-content-center mb-0">
                    <a type="button" class="btn btn-danger" id="deletelink">Delete Now</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closepopupFunction()">Close</button>
                </div>
            </div>
        </div>
        <!-- js -->
        <script>
            function popupFunction(delete_contact) {
                document.getElementById("deletepopup").style.visibility = "visible";
                document.getElementById("deletelink").href = "delete_contact.php?user_id=<?php echo $id ?>&contact_id=" + delete_contact;
            }

            function closepopupFunction() {
                document.getElementById("deletepopup").style.visibility = "hidden"
            }
        </script>
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

        include("../includes/no_footer.php");
        ?>