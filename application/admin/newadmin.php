<?php
$accl = "0,0";
$pageTitle = "Add New Admin";
include("../includes/job_connect.php");
include("../includes/utils.php");
include("../includes/header.php");
?>

<?php
if (isset($_POST['mysubmit'])) {
    $email = strip_tags(trim($_POST['email']));
    $password = strip_tags(trim($_POST['password']));
    $firstName = strip_tags(trim($_POST['first_name']));
    $lastName = strip_tags(trim($_POST['last_name']));
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $valid = 1;
    $msgPre = "<div class=\"alert alert-danger\" role=\"alert\">";
	$msgSucPre = "<div class=\"alert alert-success\" role=\"alert\">";
	$msgPost = "</div>";
    //validation
    if ($email == "") {
        $valid = 0;
        $valEmailMesg = "Email is required";
    } else {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $valid = 0;
            $valEmailMesg = "Invalid email address!";
        }
    }

    if ($password == "") {
        $valid = 0;
        $valPasswordMesg = "Pasword is required";
    } else {
        if (strlen($password) < 3) {
            $valid = 0;
            $valPasswordMesg = "Password too short!";
        }
    }

    if ($firstName == "") {
        $valid = 0;
        $valFirstMesg = "First name is required";
    } else {
        if (strlen($firstName) < 2) {
            $valid = 0;
            $valFirstMesg = "First name too short!";
        }
    }

    if ($lastName == "") {
        $valid = 0;
        $valLastMesg = "Last name is required";
    } else {
        if (strlen($lastName) < 2) {
            $valid = 0;
            $valLastMesg = "Last name too short!";
        }
    }


    if ($valid == 1) {
        $lastOnline = date("Y-m-d H:i:s");
        $isVerified = 1;


        $sql = "INSERT INTO `user` (type, email, password, is_verified, last_online) VALUES (2, '$email', '$hashed_password', 1, '$lastOnline')";

        mysqli_query($jobConn, $sql) or die(mysqli_error($jobConn));
        $selectRecentUser = mysqli_query($jobConn, "SELECT * FROM user WHERE email='$email'") or die(mysqli_error($jobConn));
        $recentUser = mysqli_fetch_array($selectRecentUser);
        $recentUserID = $recentUser['user_id'];
        mysqli_query($jobConn, "INSERT INTO `admin` (`user_id`, first_name, last_name) VALUES ($recentUserID, '$firstName', '$lastName')") or die(mysqli_error($jobConn));

        $validSucMsg = "New Admin Account Created!";

        $email = "";
        $password = "";
        $firstName = "";
        $lastName = "";
    }
}
?>

<link rel="stylesheet" href="css/styles.css">
<main>
    <div class="d-flex">

        <!--side bar-->
        <?php include("side_bar.php"); ?>
        <!--contents-->
        <div class="container-fluid p-5 pt-1">
            <!-- header -->
            <div class="mt-3 mb-3">
                <h2>Add New Admin</h2>
            </div>
            <!-- job list sections -->
            <div class="card mb-4">
                <div class="card-body d-flex flex-row justify-content-between mt-3">
                    <div class="d-flex" style="font-size: 1.5rem;">
                        <a class="link-dark" href="./job.php">New Admin</a>
                    </div>
                    <!-- button for add new jobs -->
                    <div>
                        <a class="btn btn-danger" href="#">Refresh</a>
                    </div>
                </div>


                <!-- job list -->
                <div>
                    <hr>
                    <div class="card-body list-height d-flex justify-content-between">

                        <form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="width: 100%;">
                            <div style="max-width: 35rem; margin:auto;">
                                <div class="form-group col">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" <?php if (isset($email)) {
                                                                                                        echo "value=\"$email\"";
                                                                                                    } ?>>
                                    <?php if(isset($valEmailMesg)){echo $msgPre.$valEmailMesg.$msgPost;} ?>
                                </div>
                                <div class="form-group col">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                    <?php if(isset($valPasswordMesg)){echo $msgPre.$valPasswordMesg.$msgPost;} ?>
                                </div>
                                <div class="form-group col">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" <?php if (isset($firstName)) {
                                                                                                                    echo "value=\"$firstName\"";
                                                                                                                } ?>>
                                    <?php if(isset($valFirstMesg)){echo $msgPre.$valFirstMesg.$msgPost;} ?>
                                </div>
                                <div class="form-group col">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" <?php if (isset($lastName)) {
                                                                                                                echo "value=\"$lastName\"";
                                                                                                            } ?>>
                                    <?php if(isset($valLastMesg)){echo $msgPre.$valLastMesg.$msgPost;} ?>
                                </div>
                                <div class="mb-3 text-lg-end text-center">
                                    <button type="submit" class="btn btn-success mt-4 col-12 col-md-6 col-lg-2" name="mysubmit" id="mysubmit">Submit</button>
                                    <?php if(isset($validSucMsg)){echo $msgSucPre.$validSucMsg.$msgPost;} ?>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
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
include("../includes/no_footer.php");
?>