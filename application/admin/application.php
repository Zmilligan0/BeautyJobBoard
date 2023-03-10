<?php  
    $accl = "0,0";
    $pageTitle = "Application Management";
    include ("../includes/job_connect.php");
    include ("../includes/utils.php");
    include ("../includes/header.php");
?>

<?php
    if(isset($_GET['salon_id']) && is_numeric($_GET['salon_id'])){
        $salon_id = $_GET['salon_id'];
    } else {
        $salon_id = "";
    }
    if(isset($_GET['salon_name'])){
        $salon_name = $_GET['salon_name'];
    } else {
        $salon_name = "";
    }
    if(isset($_GET['job_title'])){
        $job_title = $_GET['job_title'];
    } else {
        $job_title = "";
    }
    if(isset($_GET['status'])){
        $status = $_GET['status'];
    } else {
        $status = "";
    }
    if(isset($_GET['employment_type'])){
        $employment_type = $_GET['employment_type'];
    } else {
        $employment_type = "";
    }
    if(isset($_GET['start_date']) && $_GET['start_date'] != ""){
        $start_date = strtotime($_GET['start_date']);
        $lower = date('Y-m-d H:i:s', $start_date);
    } else {
        $lower = "";
    }
    if(isset($_GET['end_date']) && $_GET['end_date'] !="" ){
        $end_date = strtotime($_GET['end_date']);
        $higher = date('Y-m-d H:i:s', $end_date);
    } else {
        $higher = "";
    }

    $queryFilter = "";

    if(isset($_GET['filter'])){
        $queryAppend = array();

        if($salon_id != ""){
            array_push($queryAppend, "application.employer_id = $salon_id");
        }
  
        if($salon_name != ""){
            array_push($queryAppend, "business_name LIKE '%$salon_name%'");
        }

        if($job_title != ""){
            array_push($queryAppend, "title LIKE '%$job_title%'");
        }

        if($status != ""){
            array_push($queryAppend, "application.status = $status");
        }

        if($employment_type != ""){
            array_push($queryAppend, "employment_type = $employment_type");
        }

        if($lower != ""){
            array_push($queryAppend, "application_date >= '$lower'");
        }

        if($higher != ""){
            array_push($queryAppend, "application_date <= '$higher'");
        }
    
        foreach($queryAppend as $k => $v) {
          if($k == 0){
            $queryFilter .= " WHERE " . $v;
          } else {
            $queryFilter .= " AND " . $v;
          }
        }
    }
?>
<?php 
  $result = mysqli_query($jobConn, "SELECT application_id, application.job_id, title, business_name, application.candidate_id, first_name, last_name, application.status, application_date, job.city, application.employer_id, employment_type FROM application INNER JOIN job ON application.job_id=job.job_id INNER JOIN candidate ON application.candidate_id=candidate.candidate_id INNER JOIN employer ON application.employer_id=employer.employer_id ORDER BY application_id") or die(mysqli_error($jobConn));
  if(isset($_GET['filter'])){
    $result = mysqli_query($jobConn, "SELECT application_id, application.job_id, title, business_name, application.candidate_id, first_name, last_name, application.status, application_date, job.city, application.employer_id, employment_type FROM application INNER JOIN job ON application.job_id=job.job_id INNER JOIN candidate ON application.candidate_id=candidate.candidate_id INNER JOIN employer ON application.employer_id=employer.employer_id $queryFilter ORDER BY application_id") or die(mysqli_error($jobConn));
  }

?>


<link rel="stylesheet" href="css/styles.css">
<main>
    <div class="d-flex">
        
        <!--side bar-->
        <?php include ("side_bar.php"); ?>
        <!--contents-->
        <div class="container-fluid p-5 pt-1">
            <!-- header -->
            <div class="mt-3 mb-3">
                <h2>Application Management</h2>
            </div>
            <!-- job list sections -->
            <div class="card mb-4">
                <div class="card-body d-flex flex-row justify-content-between mt-3">
                    <div class="d-flex" style="font-size: 1.5rem;">
                        <a class="link-dark" href="./application.php">Application List</a>
                    </div>
                    <!-- button for add new jobs -->
                    <div>
                        <a class="btn btn-danger" href="./application.php">Refresh</a>
                    </div>
                </div>
                <!-- Search Bar -->
                <hr>
                <div class=" pb-2 pt-2">
                    <form class="row container-fluid d-flex justify-content-center">
                        <div class="row ">
                            <div class="col-sm-2 search-bar-mobile-view">
                                <input type="text" class="form-control"
                                    placeholder="Employer ID" name="salon_id"
                                    id="salon_id" <?php if($salon_id != ""){echo "value=\"$salon_id\"";}?>>
                            </div>
                            <div class="col-sm-3 search-bar-mobile-view">
                                <input type="text" class="form-control"
                                    placeholder="Business Name" name="salon_name"
                                    id="salon_name" <?php if($salon_name != ""){echo "value=\"$salon_name\"";}?>>
                            </div>
                            <div class="col-sm-3 search-bar-mobile-view">
                                <input type="text" class="form-control"
                                    placeholder="Job title" name="job_title"
                                    id="job_title" <?php if($job_title != ""){echo "value=\"$job_title\"";}?>>
                            </div>
                            <div class="col-sm-2 search-bar-mobile-view">
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option value="" <?php if($status == ""){echo "selected=\"selected\"";}?>>Status</option>
                                    <option value="1" <?php if($status == "1"){echo "selected=\"selected\"";}?>>Submitted</option>
                                    <option value="2" <?php if($status == "2"){echo "selected=\"selected\"";}?>>In Review</option>
                                    <option value="3" <?php if($status == "3"){echo "selected=\"selected\"";}?>>Accepted</option>
                                    <option value="4" <?php if($status == "4"){echo "selected=\"selected\"";}?>>Rejected</option>
                                    <option value="0" <?php if($status == "0"){echo "selected=\"selected\"";}?>>Closed</option>
                                </select>

                            </div>
                            <div class="col-sm-2 search-bar-mobile-view">
                                <select class="form-select" name="employment_type" aria-label="Default select example">
                                    <option value="" <?php if($employment_type == ""){echo "selected=\"selected\"";}?>>Select Type</option>
                                    <option value="0" <?php if($employment_type == "0"){echo "selected=\"selected\"";}?>>Full Time</option>
                                    <option value="1" <?php if($employment_type == "1"){echo "selected=\"selected\"";}?>>Part Time</option>
                                    <option value="2" <?php if($employment_type == "2"){echo "selected=\"selected\"";}?>>Contract</option>
                                    <option value="3" <?php if($employment_type == "3"){echo "selected=\"selected\"";}?>>Temporary</option>
                                    <option value="4" <?php if($employment_type == "4"){echo "selected=\"selected\"";}?>>Apprenticeship</option>
                                </select>
                            </div>
                        </div>
                        <div class="row text-center m-2">
                            <div class="col-sm-1 search-bar-mobile-view">
                                <label class="form-label">From</label>
                            </div>
                            <div class="col-sm-4 search-bar-mobile-view">
                                <input type="date" class="form-control" name="start_date" id="start_date" <?php if($lower != ""){echo "value=\"$start_date\"";}?>>
                            </div>
                            <div class="col-sm-1 search-bar-mobile-view">
                                <label class="form-label">To</label>
                            </div>
                            <div class="col-sm-4 search-bar-mobile-view">
                                <input type="date" class="form-control" name="end_date" id="end_date" <?php if($higher != ""){echo "value=\"$end_date\"";}?>>
                            </div>
                            <div class="desktop-view-button col-sm-2">
                                <button class="btn btn-md w-100 btn-danger desktop-view-button" type="submit" name="filter" id="filter">Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- job list -->
                <div>
                    <hr>
                    <div class="card-body list-height d-flex justify-content-between row text-center">
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle nowrap">
                                <thead>
                                    <tr>
                                        <th style="text-align: left;">Appliction ID</th>
                                        <th style="text-align: left;">Job ID</th>
                                        <th style="text-align: left;">Job Title</th>
                                        <th style="text-align: left;">Job City</th>
                                        <th style="text-align: left;">Salon ID</th>
                                        <th style="text-align: left;">Salon Name</th>
                                        <th style="text-align: left;">Candidate ID</th>
                                        <th style="text-align: left;">Candidate Name</th>
                                        <th>Last Modified</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = mysqli_fetch_array($result)): ?>
                                    <tr>
                                        <th style="text-align: left;"><?php echo $row['application_id']; ?></th>
                                        <td style="text-align: left;"><?php echo $row['job_id']; ?></td>
                                        <td style="text-align: left;"><?php echo $row['title']; ?></td>
                                        <td style="text-align: left;"><?php echo $row['city']; ?></td>
                                        <td style="text-align: left;"><?php echo $row['employer_id']; ?></td>
                                        <td style="text-align: left;"><?php echo $row['business_name']; ?></td>
                                        <td style="text-align: left;"><?php echo $row['candidate_id']; ?></td>
                                        <td style="text-align: left;"><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                                        <td><?php echo $row['application_date']; ?></td>
                                        <td><?php

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
                                                echo $status1;
                                            ?>
                                         </td>
                                        <td>
                                            <a onclick="popupFunction(<?php echo $row['application_id']; ?>,'application')" class="btn btn-sm btn-soft-danger deleteTrash">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- paginator -->
                        <!-- <div class="d-flex flex-row-reverse">
                            <div class="d-flex flex-column-reverse">
                                <p class="text-muted mb-0">Showing <b>1</b> to <b>12</b> of <b>45</b> entries</p>
                                <div class="col-auto">
                                    <div class="card d-inline-block ms-auto mb-0">
                                        <div class="card-body p-2">
                                            <nav aria-label="Page navigation example" class="mb-0">
                                                <ul class="pagination mb-0">
                                                    <li class="page-item">
                                                        <a class="page-link" href="javascript:void(0);"
                                                            aria-label="Previous">
                                                            <span aria-hidden="true">«</span>
                                                        </a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link"
                                                            href="javascript:void(0);">1</a></li>
                                                    <li class="page-item active"><a class="page-link"
                                                            href="javascript:void(0);">2</a></li>
                                                    <li class="page-item"><a class="page-link"
                                                            href="javascript:void(0);">3</a></li>
                                                    <li class="page-item"><a class="page-link"
                                                            href="javascript:void(0);">...</a></li>
                                                    <li class="page-item"><a class="page-link"
                                                            href="javascript:void(0);">12</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="javascript:void(0);"
                                                            aria-label="Next">
                                                            <span aria-hidden="true">»</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                <p class="text-muted font-size-16 mb-4">Are you sure you want to permanently erase the application.</p>
                <div class="hstack gap-2 justify-content-center mb-0">
                    <a type="button" class="btn btn-danger" id="deletelink">Delete Now</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closepopupFunction()">Close</button>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function popupFunction(id,category) {
        document.getElementById("deletepopup").style.visibility = "visible";
        document.getElementById("deletelink").href = "delete.php?id=" + id + "&category=" + category;
    }

    function closepopupFunction() {
        document.getElementById("deletepopup").style.visibility = "hidden"
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

</html>

<?php  
    include ("../includes/no_footer.php");
?>