<?php  
    $accl = "0,0";
    $pageTitle = "Employer Management";
    include ("../includes/job_connect.php");
    include ("../includes/utils.php");
    include ("../includes/header.php");
    include("../includes/_functions.php");

?>

<?php
    if(isset($_GET['employer_id']) && is_numeric($_GET['employer_id'])){
        $employer_id = $_GET['employer_id'];
    } else {
        $employer_id = "";
    }
    if(isset($_GET['business_name'])){
        $business_name = $_GET['business_name'];
    } else {
        $business_name = "";
    }
    if(isset($_GET['focus'])){
        $focus = $_GET['focus'];
    } else {
        $focus = "";
    }

    $queryFilter = "";

    if(isset($_GET['filter'])){
        $queryAppend = array();

        if($employer_id != ""){
            array_push($queryAppend, "employer_id = $employer_id");
        }
  
        if($business_name != ""){
            array_push($queryAppend, "business_name LIKE '%$business_name%'");
        }

        if($focus != ""){
            array_push($queryAppend, "focus LIKE '%$focus%'");
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
    $result = mysqli_query($jobConn, "SELECT * FROM employer") or die(mysqli_error($jobConn));
    if(isset($_GET['filter'])){
        $result = mysqli_query($jobConn, "SELECT * FROM employer $queryFilter") or die(mysqli_error($jobConn));
    } 
    elseif (isset($_GET['displayby']) && isset($_GET['displayvalue'])) {
        $displayby = $_GET['displayby'];
        $displayvalue = $_GET['displayvalue'];
        $sqlQuery = "WHERE $displayby LIKE '$displayvalue'";
        if(isset($displayby) && isset($displayvalue)) {
        $result = mysqli_query($jobConn,"SELECT * FROM candidate $sqlQuery") or die (mysqli_error($jobConn));
        
        }
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
                <h2>Employer Management</h2>
            </div>
            <!-- job list sections -->
            <div class="card mb-4">
                <div class="card-body d-flex flex-row justify-content-between mt-3">
                    <div class="d-flex" style="font-size: 1.5rem;">
                        <a class="link-dark" href="<?php echo ROOT_URL; ?>/admin/salon.php">Employer List</a>
                    </div>
                    <!-- button for add new jobs -->
                    <div>
                        <a class="btn btn-danger" href="newcandidate.php">Add new Salon</a>
                        <a class="btn btn-danger" href="salon.php">Refresh</a>
                    </div>
                </div>
                <!-- Search Bar -->
                <hr>
                <div class=" pb-2 pt-2">
                    <form class="row container-fluid d-flex justify-content-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                        <div class="row ">
                            <div class="col-sm-2 search-bar-mobile-view">
                                <input type="text" class="form-control"
                                    placeholder="Employer ID" name="employer_id"
                                    id="employer_id" <?php if($employer_id != ""){echo "value=\"$employer_id\"";}?>>
                            </div>
                            <div class="col-sm-4 search-bar-mobile-view">
                                <input type="text" class="form-control"
                                    placeholder="Business Name" name="business_name"
                                    id="business_name" <?php if($business_name != ""){echo "value=\"$business_name\"";}?>>
                            </div>
                            <div class="col-sm-4 search-bar-mobile-view">
                                <input type="text" class="form-control"
                                    placeholder="What is the employer focus on? " name="focus"
                                    id="focus" <?php if($focus != ""){echo "value=\"$focus\"";}?>>
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
                                        <th style="text-align: left;">Employer ID</th>
                                        <th style="text-align: left;">Profile Picture</th>
                                        <th style="text-align: left;">Business Name</th>
                                        <th style="text-align: left;">City</th>
                                        <th style="text-align: left;">Focus</th>
                                        <th style="text-align: left;">Active Posts</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = mysqli_fetch_array($result)): ?>
                                    <tr>
                                        <th style="text-align: left;"><?php echo $row['employer_id']; ?></th>
                                        <td style="text-align: center;">
                                        <?php 
                                                if($row['profile_image'] == "") {
                                                    $profileImagePath = $companyProfileImagePath . "company_default.png"; 
                                                } else {
                                                    $profileImagePath = $companyProfileImagePath . $row['profile_image'];
                                                }
                                                echo "<img style=\"max-width: 100px;\" src=\"$profileImagePath\" alt=\"candidate profile picture\">";
                                            ?>
                                        </td>
                                        <td style="text-align: left;"><?php echo $row['business_name']; ?></td>
                                        <td style="text-align: left;"><?php echo $row['city']; ?></td>
                                        <td style="text-align: left;"><?php echo $row['focus']; ?></td>
                                        <td style="text-align: left;">
                                            <?php
                                                $employerID = $row['employer_id'];
                                                $jobSelect= mysqli_query($jobConn, "SELECT * FROM job WHERE employer_id = $employerID AND status = '1'") or die(mysqli_error($jobConn));
                                                echo mysqli_num_rows($jobSelect);
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-soft-primary pencil-bg"
                                                href="<?php echo ROOT_URL; ?>employer-profile?id=<?php echo $row['user_id']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg>
                                            </a>
                                            <a class="btn btn-sm btn-soft-primary pencil-bg"
                                                href="<?php echo ROOT_URL; ?>admin/editsalon?id=<?php echo $row['employer_id']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                </svg>
                                            </a>
                                            
                                            <a href="delete.php?id=<?php echo $row['employer_id']; ?>&category=employer" onclick="popupFunction()" class="btn btn-sm btn-soft-danger deleteTrash">
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
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- delete warning -->
    <div class="modal-content deletenotvisible d-flex justify-content-center align-items-center" id="deletepopup">
        <div class="deleteborder">
            <div class="modal-body px-4 py-5 text-center w-auto ">
                <button type="button" class="btn-close position-absolute end-0 top-0 m-3"
                    onclick="closepopupFunction()"></button>
                <div class="avatar-sm mb-4 mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
                <p class="text-muted font-size-16 mb-4">Are you sure you want to permanently erase the applicant.</p>
                <div class="hstack gap-2 justify-content-center mb-0">
                    <button type="button" class="btn btn-danger">Delete Now</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        onclick="closepopupFunction()">Close</button>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function popupFunction() {
        document.getElementById("deletepopup").style.visibility = "visible"
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

<?php  
    include ("../includes/no_footer.php");
?>