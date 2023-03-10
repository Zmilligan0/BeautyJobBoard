<?php
$accl = "2,0";
$pageTitle = "Application List";
include("../includes/job_connect.php");
include("../includes/utils.php");
include("../includes/header.php");
if (isset($_GET)) {
    extract($_GET);
}

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
}

$job_search = "";
$job_types = "";
$status_search = "";
$search_part1 = "";
$search_part2 = "";
$search_part3 = "";

if(isset($_POST['filter'])){
    if (isset($_POST['job_search'])){
        $job_search = $_POST['job_search'];
        $search_part1 = "AND (title LIKE '%$job_search%' OR business_name LIKE '%$job_search%')";
    } else {
        $job_search = "";
        $search_part1 = "";
    }

    if (isset($_POST['job_types'])){
        $job_types = $_POST['job_types'];
        $search_part2 = "AND (employment_type LIKE '%$job_types%')";
    } else {
        $job_types = "";
        $search_part2 = "";
    }

    if (isset($_POST['status_search'])){
        $status_search = $_POST['status_search'];
        $search_part3 = "AND (application.status LIKE '%$status_search%')";
    } else {
        $status_search = "";
        $search_part3 = "";
    }
}


$sql= "SELECT candidate_id, first_name, last_name From candidate WHERE user_id = '$_SESSION[user_id]'";
$list = $jobConn->query($sql);
while ($row = $list->fetch_assoc()){ 
    $candidate_id = $row['candidate_id'];
    $candidate_firstName =  $row['first_name'];
    $candidate_lastName =  $row['last_name'];
}


if (isset($_GET['page_no']) && $_GET['page_no'] !== "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
$limit = 5;
$offset = ($page_no - 1) * $limit;
$previose_page = $page_no - 1;
$next_page = $page_no + 1;
$result_count = mysqli_query($jobConn, "SELECT COUNT(*) as total_records 
From application
inner join job on application.job_id = job.job_id
inner join employer on job.employer_id = employer.employer_id 
where application.candidate_id = $candidate_id $search_part1 $search_part2 $search_part3");
$records = mysqli_fetch_array($result_count);
$total_records = $records['total_records'];
$total_no_of_pages = ceil($total_records / $limit);


$result = mysqli_query($jobConn,"SELECT application_id,application.status,business_name,title, job.city, job.province, employment_type, job.job_id From application
inner join job on application.job_id = job.job_id
inner join employer on job.employer_id = employer.employer_id 
where application.candidate_id = $candidate_id LIMIT $offset , $limit") or die(mysqli_error($jobConn));
if(isset($_POST['filter'])){
    $result = mysqli_query($jobConn,"SELECT application_id,application.status,business_name,title, job.city, job.province, employment_type, job.job_id From application
    inner join job on application.job_id = job.job_id
    inner join employer on job.employer_id = employer.employer_id 
    where application.candidate_id = $candidate_id $search_part1 $search_part2 $search_part3 LIMIT $offset , $limit") or die(mysqli_error($jobConn));
}

?>
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
        background-color:#222222;
        
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
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="35" fill="currentColor" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </button>
    </div>
    <!-- Side Bar -->
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white side-bar side-bar-sticky side-bar-hide active-side-bar"
        style="width: 280px;" id="try">
        <div class="d-flex flex-row justify-content-between">
            <!-- <a href="../candidate-profile"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none ms-lg-4"> -->
                <?php echo "<a href=\"" . ROOT_URL . "candidate-profile?id=$_SESSION[user_id]\" class=\"d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none ms-lg-4\">" ?>
                <span class="fs-4"><?php echo "$candidate_firstName" . " $candidate_lastName"; ?></span>
            </a>
            <button class="text-white border-0 w-0" style="background-color: #2f2f2f;" onclick="hide()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg"
                    viewBox="0 0 16 16">
                    <path
                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                </svg>
            </button>
        </div>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <!-- <a href="../candidate-profile" class="nav-link text-white"> -->
                <?php echo "<a href=\"" . ROOT_URL . "candidate/edit-profile?id=$_SESSION[user_id]\" class=\"nav-link text-white\">" ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person me-2" viewBox="0 0 16 16">
                        <path
                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                    </svg>
                    Edit Profile
                </a>
            </li>
            <li class="nav-item">
                <!-- <a href="login-security"  class="nav-link text-white"> -->
               <?php echo "<a href=\"" . ROOT_URL . "candidate/login-security?id=$_SESSION[user_id]\" class=\"nav-link text-white\">" ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-shield-check  me-2" viewBox="0 0 16 16">
                        <path
                            d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                        <path
                            d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                    </svg>
                    Login & Security
                </a>
            </li>
            <li>
                <!-- <a href="applications" class="nav-link active" aria-current="page"> -->
                <?php echo "<a href=\"" . ROOT_URL . "candidate/applications?id=$_SESSION[user_id]\" class=\"nav-link bg-danger active\" aria-current=\"page\">" ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-briefcase me-2" viewBox="0 0 16 16">
                        <path
                            d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                    My Applications
                </a>
            </li>
            <li>
                <?php echo "<a href=\"" . ROOT_URL . "candidate/saved_jobs?id=$_SESSION[user_id]\" class=\"nav-link text-white\">" ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark me-2" viewBox="0 0 16 16">
                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                    </svg>
                    Saved Jobs
                </a>
            </li>
        </ul>
    </div>
    <!-- side bar -->
    <!-- Application List -->
    <div class="container-fluid p-5 pt-1">
        <!-- header -->
        <div class="mt-3 mb-3">
            <h2>My Applications</h2>
        </div>
        <!-- header -->
        <!-- Application list sections -->
        <div class="card mb-4">
            <!-- Search Bar -->
            <div class="pt-4 pb-2">
                <form class="row container-fluid d-flex justify-content-center" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                    <div class="col-sm-3 col-sm-3 search-bar-mobile-view">
                        <input type="text" class="form-control" placeholder="Job title or company" name="job_search"
                            id="job_search" <?php if($job_search != ""){echo "value=\"$job_search\"";}?>>
                    </div>
                    <div class="col-sm-2 col-sm-2 search-bar-mobile-view">
                        <select class="form-select" aria-label="Default select example" name="job_types" id="job_types">
                            <option value="" <?php if($job_types == ""){echo "selected=\"selected\"";}?>>Select Type</option>
                            <option value="0" <?php if($job_types == "0"){echo "selected=\"selected\"";}?>>Full Time</option>
                            <option value="1" <?php if($job_types == "1"){echo "selected=\"selected\"";}?>>Part Time</option>
                            <option value="2" <?php if($job_types == "2"){echo "selected=\"selected\"";}?>>Contract</option>
                            <option value="3" <?php if($job_types == "3"){echo "selected=\"selected\"";}?>>Temporary</option>
                            <option value="4" <?php if($job_types == "4"){echo "selected=\"selected\"";}?>>Apprenticeship</option>
                        </select>
                    </div>
                    <div class="col-sm-2 col-sm-2 search-bar-mobile-view">
                        <select class="form-select" aria-label="Default select example" name="status_search" id="status_search">
                            <option value="" <?php if($status_search == ""){echo "selected=\"selected\"";}?>>Status</option>
                            <option value="1" <?php if($status_search == "1"){echo "selected=\"selected\"";}?>>Submitted</option>
                            <option value="2" <?php if($status_search == "2"){echo "selected=\"selected\"";}?>>In review</option>
                            <option value="3" <?php if($status_search == "3"){echo "selected=\"selected\"";}?>>Accepted</option>
                            <option value="4" <?php if($status_search == "3"){echo "selected=\"selected\"";}?>>Rejected</option>
                            <option value="0" <?php if($status_search == "0"){echo "selected=\"selected\"";}?>>Closed</option>
                        </select>
                    </div>
                    <div class="desktop-view-button col-sm-2 col-sm-2 ">
                        <button class="btn btn-md w-100 btn-danger desktop-view-button" type="submit" name="filter"
                            id="filter">Filter
                        </button>
                    </div>
                </form>
            </div>
            <!-- Search Bar -->

            <!-- Application list -->
            <div>
                <hr>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive"> 
                        <table class="table table-bordered align-middle nowrap">
                        <?php if ($result->num_rows > 0) : ?>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Job Title</th>
                                    <th>Company Name</th>
                                    <th>Location</th>
                                    <th style="text-align: center;">Type</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; while($row = mysqli_fetch_array($result)):?>
                                <tr>
                                    <th><?php echo $i; $i++;?></th>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['business_name'] ?></td>
                                    <td><?php echo $row['city'].",".$row['province']?></td>
                                    <td style="text-align: center;">
                                        <?php
                                            if ($row['employment_type'] == 0) {
                                                $type = '<span class="badge" style="background-color: rgba(52,195,143,.18); color: #34c38f">Full Time</span>';
                                            } elseif ($row['employment_type'] == 1) {
                                                $type = '<span class="badge" style="background-color: rgba(244,106,106,.18); color: #f46a6a">Part Time</span>';
                                            } elseif ($row['employment_type'] == 2) {
                                                $type = '<span class="badge" style="background-color: rgba(80,165,241,.18); color: #50a5f1">Contract</span>';
                                            } elseif ($row['employment_type'] == 3) {
                                                $type = '<span class="badge" style="background-color: rgba(241,180,76,.18); color: #f1b44c">Temporary</span>';
                                            } elseif ($row['employment_type'] == 4) {
                                                $type = '<span class="badge" style="background-color: #e3f5f4; color: #505e5d">Apprenticeship</span>';
                                            } else {
                                                $type = 'invalid';
                                            }

                                            echo $type;
                                        ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                            if ($row['status'] == 0) {
                                                $status1 = '<span class="badge bg-danger">Closed</span>';
                                            } elseif ($row['status'] == 1) {
                                                $status1 = '<span class="badge bg-primary">Submitted</span>';
                                            } elseif ($row['status'] == 2) {
                                                $status1 = '<span class="badge bg-warning">In Review</span>';
                                            } elseif ($row['status'] == 3) {
                                                $status1 = '<span class="badge bg-success">Approved</span>';
                                            } elseif ($row['status'] == 4) {
                                                $status1 = '<span class="badge bg-danger">Rejected</span>';
                                            } else {
                                                $status1 = '<span class="badge bg-danger">Unknown</span>';
                                            }
                                        ?>
                                        <?php echo $status1; ?>   
                                    </td>
                                    <td style="text-align: center;">
                                        <?php $application_id = $row['application_id'];?>
                                        <a class="btn btn-sm btn-soft-primary pencil-bg" href="../job-post?id=<?php echo $row['job_id']?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                                </svg>
                                        </a>
                                        <!-- <a onclick="return confirm('Are you sure you want to delete this application?'); return false;" class="btn btn-sm btn-soft-danger deleteTrash"
                                        href="delete_application.php?application_id=<?php echo $application_id?>&user_id=<?php echo $id ?>" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </a> -->
                                    </td> 
                                    <!-- delete warning -->
                                    <!-- <div class="modal-content deletenotvisible d-flex justify-content-center align-items-center" id="deletepopup">
                                        <div class="deleteborder">
                                            <div class="modal-body px-4 py-5 text-center w-auto ">
                                                <button type="button" class="btn-close position-absolute end-0 top-0 m-3"
                                                    onclick="closepopupFunction()"></button>
                                                <div class="avatar-sm mb-4 mx-auto">
                                                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </div>
                                                </div>
                                                <p class="text-muted font-size-16 mb-4">Are you sure you want to permanently erase the application.</p>
                                                <div class="hstack gap-2 justify-content-center mb-0">
                                                    <button type="button" class="btn btn-danger" href="delete_application.php?application_id=<?php //echo $application_id?>">Delete Now</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                        onclick="closepopupFunction()">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                   -->
                                </tr> 
                                <?php endwhile; ?>
                            </tbody>
                            <?php else : ?>
                                <p>No Data found</p>
                            <?php endif ?>
                        </table>
                    </div>
                    <!-- paginator -->
                    <div class="d-flex flex-row-reverse">
                        <div class="d-flex flex-column-reverse">
                            <p class="text-muted mb-0">Page <b><?= $page_no; ?></b> of <b><?= $total_no_of_pages ?></b></p>
                            <div class="col-auto">
                                <div class="d-inline-block ms-auto mb-0">
                                    <div class="p-2">
                                        <nav aria-label="Page navigation example" class="mb-0">
                                            <ul class="pagination mb-0">
                                                <li class="page-item">
                                                    <a class="page-link <?= ($page_no <= 1) ?
                                                                            'disabled' : ''; ?> " <?= ($page_no > 1) ? 'href=?id=' . $id . '&page_no=' . $previose_page : ''; ?> aria-label="Previous">«
                                                    </a>
                                                </li>
                                                <?php for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                                ?>


                                                    <?php if ($page_no != $counter) { ?>
                                                        <li class="page-item"><a class="page-link" href="?id=<?= $id; ?>&page_no=<?= $counter; ?>"><?= $counter; ?></a></li>
                                                    <?php } else { ?>
                                                        <li class="page-item"><a class="page-link active"><?= $counter; ?></a></li>
                                                    <?php } ?>
                                                <?php } ?>
                                                <li class="page-item">
                                                <a class="page-link <?= ($page_no >= $total_no_of_pages) ?
                                                                        'disabled' : ''; ?> " <?= ($page_no < $total_no_of_pages) ? 'href=?id=' . $id . '&page_no=' . $next_page : ''; ?> aria-label="Next">
                                                    »
                                                </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Paginator -->
                </div>
                <!-- Card Body -->
            </div>
            <!-- Application list -->
        </div>
        <!-- Application list sections -->
        
    </div>
    <!-- Application List -->
</main>

<!-- js -->
<script>
    function popupFunction() {
        document.getElementById("deletepopup").style.visibility = "visible"
    }

    function closepopupFunction() {
        document.getElementById("deletepopup").style.visibility = "hidden"
    }

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