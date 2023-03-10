<?php  
    $accl = "0,0";
    $pageTitle = "Add New Candidate";
    include ("../includes/job_connect.php");
    include ("../includes/utils.php");
    include ("../includes/header.php");
?>

<?php
    if(isset($_POST['mysubmit'])){
        $email = strip_tags(trim($_POST['email']));
        $password = strip_tags(trim($_POST['password']));
        $firstName = strip_tags(trim($_POST['first_name']));
        $lastName = strip_tags(trim($_POST['last_name']));
        $gender = $_POST['gender'];
        $relocate = $_POST['will_relocate'];

        //validation

        if($valid == 1) {

            $timedate = date("Y-m-d H:i:s");

			mysqli_query($jobConn, "INSERT INTO user (type, email, password, is_verified, creation_date, last_online) VALUES ('0', '$email', '$password','1','$timedate','$timedate')") or die(mysqli_error($jobConn));
            $lastUser = mysqli_query($jobConn, "SELECT * FROM user ORDER BY user_id DESC LIMIT 1") or die(mysqli_error($jobConn));
            $lastUserID = mysqli_fetch_array($lastUser)['user_id'];
            mysqli_query($jobConn, "INSERT INTO admin (user_id, first_name, last_name, gender, will_relocate) VALUES ('$lastUserID', '$firstName', '$lastName', $gender, $relocate)") or die(mysqli_error($jobConn));

			$validSucMsg = "New Candidate Created!";

			$email = "";
            $password = "";
            $firstName = "";
            $lastName = "";
            $gender = "";
            $relocate = "";
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
                <h2>Add New Admin</h2>
            </div>
            <!-- job list sections -->
            <div class="card mb-4">
                <div class="card-body d-flex flex-row justify-content-between mt-3">
                    <div class="d-flex" style="font-size: 1.5rem;">
                        <p class="link-dark">New Candidate</p>
                    </div>
                    <!-- button for add new jobs -->
                    <div>
                        <a class="btn btn-primary" href="#">Refresh</a>
                    </div>
                </div>

                
                <!-- job list -->
                <div>
                    <hr>
                    <div class="card-body list-height d-flex justify-content-between">
                        
                        <form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" style="width: 100%;">
                            <div style="max-width: 35rem; margin:auto;">
                                <div class="form-group col">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control"  name="email" id="email" <?php if(1==1){echo "value=\"\"";}?>>
                                </div>
                                <div class="form-group col">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control"  name="password" id="password" <?php if(1==1){echo "value=\"\"";}?>>
                                </div>
                                <div class="form-group col">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control"  name="first_name" id="first_name" <?php if(1==1){echo "value=\"\"";}?>>
                                </div>
                                <div class="form-group col">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control"  name="last_name" id="last_name" <?php if(1==1){echo "value=\"\"";}?>>
                                </div>
                                <div>
                                    <select class="form-select mt-2" name="gender" aria-label="Gender select">
                                        <option selected value="">Select Gender</option>
                                        <option value="1">M</option>
                                        <option value="2">F</option>
                                        <option value="3">O</option>
                                        <option value="4">N</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-check-label d-block mt-2">Are you willing to relocate?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="will_relocate" value="1" id="will_relocate1">
                                        <label class="form-check-label" for="will_relocate1">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="will_relocate" value="0" id="will_relocate2" checked>
                                        <label class="form-check-label" for="will_relocate2">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3 text-lg-end text-center">
                                    <button type="submit" class="btn btn-success mt-4 col-12 col-md-6 col-lg-2" name="mysubmit" id="mysubmit">Submit</button>
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
    include ("../includes/no_footer.php");
?>