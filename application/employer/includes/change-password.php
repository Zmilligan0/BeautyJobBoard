<?php
$pageTitle = "Change Password";
$accl = "0,2";
include("../../includes/job_connect.php");
include("../../includes/utils.php");
include("../../includes/header.php");

$oldpassword = "";
$password = "";
$cpassword = "";
$passwordErr = "";
$msgSuccess = "";
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
$employer_id = $_SESSION['employer_id'];

$sql = "SELECT * FROM user WHERE user_id = '$_SESSION[user_id]' ";
$result = mysqli_query($jobConn, $sql) or die(mysqli_error($jobConn));
while ($row = mysqli_fetch_array($result)) {

    $oldpassword = $row['password'];
}

if (isset($_POST['submit'])) {

    $valid = 1;
    $msgPreError = "\n<div class=\"alert alert-danger\" role=\"alert\" >";
    $msgPreSuccess = "\n<div class=\"alert alert-primary\" role=\"alert\" >";
    $msgPost = "\n</div>\n";

    if (!empty($_POST["password"]) && isset($_POST['password']) && !empty($_POST["oldpassword"]) && isset($_POST['oldpassword'])) {
        $password = strip_tags(trim($_POST["password"]));
        $cpassword = strip_tags(trim($_POST["cpassword"]));
        if (strip_tags(trim($_POST['oldpassword'])) !== $oldpassword) {
            $valid = 0;
            $passwordErr = "Your old password is not correct!";
        } else {
            if (mb_strlen($_POST["password"]) <= 8) {
                $valid = 0;
                $passwordErr = "Your Password Must Contain At Least 8 Characters!";
            } elseif (!preg_match("#[0-9]+#", $password)) {
                $valid = 0;
                $passwordErr = "Your Password Must Contain At Least 1 Number!";
            } elseif (!preg_match("#[A-Z]+#", $password)) {
                $valid = 0;
                $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
            } elseif (!preg_match("#[a-z]+#", $password)) {
                $valid = 0;
                $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
            } elseif (!preg_match("#[\W]+#", $password)) {
                $valid = 0;
                $passwordErr = "Your Password Must Contain At Least 1 Special Character!";
            } elseif (strcmp($password, $cpassword) !== 0) {
                $valid = 0;
                $passwordErr = "Passwords must match!";
            }
        }
    } else {
        $valid = 0;
        $passwordErr = "Please enter password   ";
    }

    if ($valid == 1) {

        $msgSuccess = "Successfully updated the password.";
        $sql = "UPDATE user SET 
        password = '$password'
        WHERE user_id = '$_SESSION[user_id]'";
        mysqli_query($jobConn, $sql) or die(mysqli_error($jobConn));
    }
}


?>
<style>

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
        background-color: #2f2f2f;
    }

    .deleteTrash {
        background-color: #fef0f0;
        color: #f57575;
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

    .hamburger-sticky {
        position: absolute;
        top: 0;
        height: 50vh;
    }

    .side-bar {
        background-color: #222222;
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

    @media (min-width:575px) {
        .main-card {
            max-width: 60%;
        }
    }
</style>
<main class="d-flex">
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
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white side-bar  side-bar-sticky side-bar-hide active-side-bar" style="width: 280px;" id="try">
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
                <a href="../job-List?id=<?php echo $id ?>" class="nav-link text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase me-2" viewBox="0 0 16 16">
                        <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                    My Job List
                </a>
            </li>
            <li>
                <a href="../contacts?id=<?php echo $id ?>" class="nav-link text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill me-2" viewBox="0 0 16 16">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                    </svg>
                    Contacts
                </a>
            </li>
            <li>
                <a href="../applicant-list?id=<?php echo $id ?>" class="nav-link text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns-reverse me-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z" />
                    </svg>
                    Application List
                </a>
            </li>

            <li>
                <a href="../edit-profile?id=<?php echo $id ?>" class="nav-link text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                    Edit Profile
                </a>
            </li>
            <li>
                <a href="../login-security?id=<?php echo $id ?>" class="nav-link bg-danger text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-fill-check me-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647z" />
                    </svg>
                    Login and Security
                </a>
            </li>

        </ul>

    </div>
    <!-- side bar -->
    <div class="container-fluid pt-1">
        <!-- Account Access -->
        <div class="container mt-5">
            <div class="card main-card mx-auto m-5 d-block ">
                <!-- Account Access Card -->
                <div class="card-body">
                    <!-- Account Access Card Body -->
                    <p class="p-2">
                        <a class="text-decoration-none text-muted" href="/GREENTEAM2022/application/employer/login-security.php?id=<?php echo $id ?>">
                            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                            </svg>
                            Back
                        </a>
                    </p>
                    <h4 class="mb-3">Change password</h4>
                    <p class="text-muted">Create a new password that is at least 8 characters long.</p>
                    <?php
                    if ($msgSuccess) {
                        echo $msgPreSuccess . $msgSuccess . $msgPost;
                    }
                    if ($passwordErr) {
                        echo $msgPreError . $passwordErr . $msgPost;
                    }
                    ?>
                    <form class="mt-5" id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                        <div class="col-lg-12">
                            <label for="oldpassword" class="form-label text-muted">Type your current
                                password*</label>
                            <input type="password" class="form-control text-muted " id="oldpassword" name="oldpassword" placeholder="Current password">
                        </div>
                        <div class="mt-4 col-lg-12">
                            <label for="password" class="form-label text-muted">Type your new
                                password*</label>
                            <input type="password" class="text-muted form-control" id="password" name="password" placeholder="New password">
                        </div>
                        <div class="mt-4 col-lg-12">
                            <label for="cpassword" class="form-label text-muted">Retype your new
                                password*</label>
                            <input type="password" class="form-control text-muted" id="cpassword" name="cpassword" placeholder="Retype password">
                        </div>

                        <div class="d-grid gap-2 col-lg-3 mt-3">
                            <button type="submit" name="submit" class="btn btn-sm btn-danger mt-3">Save password</button>
                            <button type="submit" class="btn btn-sm btn-secondary mt-2">
                                <!-- <a class="text-decoration-none text-white" href="../forgot-password"> -->
                                <?php echo "<a href=\"" . ROOT_URL . "forgot-password?id=$_SESSION[user_id]\" class=\"text-decoration-none text-white\" aria-current=\"page\">" ?>
                                Forgot password</a>
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Account Access Card Body -->
            </div>
            <!-- Account Access Card -->
        </div>
    </div>
    <!-- Account Access -->
</main>
<!-- js -->
<script>
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