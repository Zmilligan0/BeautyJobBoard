<?php
$accl = "0,0";
$pageTitle = "Reported-users Management";
include("../includes/edu_connect.php");
include("../includes/job_connect.php");
include("../includes/utils.php");
include("../includes/header.php");
?>





<link rel="stylesheet" href="css/styles.css">
<main>
    <div class="d-flex">

        <!--side bar-->
        <?php include("side_bar.php"); ?>
        <!--contents-->
        <div style="margin-left: 2rem;" class="container-fluid">
            <h1 class="mt-5">Reported Users</h1>
            <div class="card mt-3">
                <div class="card-body list-height d-flex justify-content-between row text-center">
                    <div class="table-responsive">
                        <div class="card-body d-flex flex-row justify-content-between mt-3">
                            <div class="d-flex" style="font-size: 1.5rem;">
                                <a class="link-dark" href="./reported-users.php">Reported User List</a>
                            </div>
                            <!-- button for add new jobs -->
                            <div>
                                <a class="btn btn-danger" href="./reported-users.php">Refresh</a>
                            </div>
                        </div>
                        <hr>


                        <style>
                            .form-filter {
                                display: flex;
                                justify-content: start;
                            }
                        </style>


                        <form class="form-filter" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="GET">

                            <div style="margin-left: 0.5rem ; margin-right:1rem;" class="col-sm-2">
                                <input name="user_id" type="text" class="form-control" placeholder="User ID" id="user_id">
                            </div>

                            <div class="col-sm-1">
                                <button class="btn btn-danger" type="submit" id="filter">
                                    Filter
                                </button>
                            </div>
                        </form>

                        <hr>
                        <table style="margin-right:5rem; margin-top:1rem;" class="table table-bordered align-middle nowrap">
                            <thead>
                                <tr>
                                    <th style="text-align: left;">User ID</th>
                                    <th style="text-align: left;">Reason</th>
                                    <th>Report Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $userid = "";

                                $reporteduserarray = array();

                                if (isset($_GET['user_id'])) {

                                    $userid = $_GET['user_id'];
                                }


                                if (isset($_GET['delete_user_id'])) {

                                    echo '<div class="alert alert-success" role="alert">';
                                    echo 'User '.$_GET['delete_user_id'].' deactivated ';
                                    echo  '</div>';

                                    $deactivateuser = $_GET['delete_user_id'];
                                    $deactivate_sql =
                                        "UPDATE user SET deactivation_date = CURDATE() 
                                    WHERE user_id = $deactivateuser";

                                    $dresult = mysqli_query($jobConn, $deactivate_sql);
                                }

                                $report_sql =
                                    "SELECT * FROM `report` WHERE user_id like '%$userid%'
                                    ORDER BY report_date;";

                                $reportresult = mysqli_query($jobConn, $report_sql);

                                foreach ($reportresult as $value) {
                                    array_push($reporteduserarray, $value);
                                }

                                if (count($reporteduserarray) > 0) {

                                    foreach ($reporteduserarray as $row) {
                                        echo '<tr>';
                                        echo '<td style="text-align: left;">' . $row['user_id'] . '</td>';
                                        echo '<td style="text-align: left;">' . $row['reason'] . '</td>';
                                        echo '<td>' . $row['report_date'] . '</td>';
                                        echo '<td>';
                                        echo '<a class="uid" id="' . $row['user_id'] . '" class="btn btn-sm btn-soft-primary pencil-bg" onclick="popupFunction()" href="reported-users?delete_user_id=' . $row['user_id'] . '">';
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">';
                                        echo '<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z" />';
                                        echo '</svg>';
                                        echo '</a>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
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
                <button type="button" class="btn-close position-absolute end-0 top-0 m-3" onclick="closepopupFunction()"></button>
                <div class="avatar-sm mb-4 mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
                <p id="user" class="user text-muted font-size-16 mb-4">Are you sure you want to Deactivate user <?php echo $userid  ?> </p>
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="GET" class="hstack gap-2 justify-content-center mb-0">
                    <button href="#" type="submit" class="btn btn-danger">Deactivate</button>
                    <input name="deactivate" value="<?php echo $userid ?>" type="hidden"></input>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closepopupFunction()">Close</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script>
    const user = document.getElementById('user')
    const uid = document.getElementById('uid')

    function popupFunction() {
        if (confirm("Are you sure you want to deactivate this user..?") == true) {
            console.log(1)
            window.location.href="/greenteam2022/application/index"
            return true;
        } else {
            event.preventDefault();
            console.log(2)
            return false;
        }
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
include("../includes/no_footer.php");
?>