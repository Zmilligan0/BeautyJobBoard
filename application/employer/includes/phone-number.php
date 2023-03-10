<?php
$pageTitle = "Phone Number";
$accl = "0,2";
include("../../includes/job_connect.php");
include("../../includes/utils.php");
include("../../includes/header.php");
include("../../scripts/services/send-sms.php");

$phone_number = "";
$phone = "";
$verification = "";
$verificationCode = "123";
$phoneMsg = "";
$msgSuccess = "";
$msgPreError = "\n<div class=\"alert alert-danger\" role=\"alert\" >";
$msgPreSuccess = "\n<div class=\"alert alert-primary\" role=\"alert\" >";
$msgPost = "\n</div>\n";

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
    $phone_number = $row['phone_number'];
}

if (isset($_POST['submit']) ) {

    $phone = strip_tags(trim($_POST['phone']));
    if($phone != ""){
		if((strlen($phone) < 10) || (strlen($phone) > 15)){  
			$phoneMsg = "<p>Please enter a phone number from 10 to 15 characters.</p>";
		}
        else{

            $validNumber = "true";

            //sets 6 random digits
            $verificationCode = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

            //checks if user exists in verification table
            $checkexistsql = "SELECT * from verification WHERE user_id = $_SESSION[user_id] ";

            $checkuserexist = mysqli_query($jobConn, $checkexistsql);
            
            //if one user found update phone number and verification code
            if(mysqli_num_rows($checkuserexist) == 1)
            {
                $NewDate = Date('Y-m-d H:m:s', strtotime('now'));
                $verificationCode = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $verificationsql = "UPDATE verification SET phone= '$phone', code= '$verificationCode', creation_date = '$NewDate'  WHERE user_id=$_SESSION[user_id]";
            }

            //else insert new record into database
            else{
                $verificationsql = "INSERT INTO verification (user_id, phone, code)
                VALUES ($_SESSION[user_id], $phone, $verificationCode)";
            }

            $insertVerification = mysqli_query($jobConn, $verificationsql);

            $a="Hello! your verification code is: {$verificationCode}";

            sendSMS($phone, $a);
            
            }

        }

         
    else{
        $phoneMsg = "<p>Please enter the phone number.</p>";
    }
    }

if(isset($_POST['verified'])){   


    //finds verification code from database
    $checkexistsql = "SELECT code, creation_date from verification 
    WHERE user_id = $_SESSION[user_id]
    && 
    creation_date >= (NOW() - INTERVAL 5 MINUTE); ";

    $checkuserexist = mysqli_query($jobConn, $checkexistsql);

    while($user = $checkuserexist->fetch_assoc()){

        $verificationCode = $user['code'];
        $creationDate = $user['creation_date'];

    }


    $verification = strip_tags(trim($_POST['verification']));
    if($verification != ""){

            
            if($verification == $verificationCode ){

                if(mysqli_num_rows($checkuserexist) == 1)
                {
                
                // grabs users new phone number from the verification table
                $grab_number_sql = "SELECT phone from verification WHERE user_id = '$_SESSION[user_id]' ";  
                $grab_result = mysqli_query($jobConn, $grab_number_sql);
                while ($grab_row = $grab_result->fetch_assoc()) {
                    $phone = $grab_row['phone'];
                }

                //updates users verification and phonenumber to new number

                $sql = "UPDATE user SET is_verified = 1, phone_number = '$phone'
                WHERE user_id = '$_SESSION[user_id]'";
                mysqli_query($jobConn, $sql) or die (mysqli_error($jobConn));
                
                // delete sql record 
                $deletesql = "DELETE FROM verification WHERE user_id = '$_SESSION[user_id]' ";
                mysqli_query($jobConn, $deletesql);
                
                $msgSuccess = "Successfully updated the phone number.";

                $redirect = true;

                if ($redirect) {

                    echo "<script>setTimeout(function(){window.location.href = '/greenteam2022/application/index';}, 3000);</script>";
        
                }

                }
                else
                {
                    $phoneMsg = "<p>The verification date has expired</p>";
                }
            }else{
                $phoneMsg = "<p>The verification code is not correct. Please try again.</p>";
            }


    }else{
        $phoneMsg = "<p>Please enter the verification code</p>";
    }  
}

if(isset($_POST['resend']))
{

    echo '<script defer src="../../static/js/phone-number-two.js"></script>';

    $checkresendsql = "SELECT * from verification WHERE user_id = $_SESSION[user_id] ";
    $checkresnendexist = mysqli_query($jobConn, $checkresendsql);

    while($user = $checkresnendexist->fetch_assoc()){
        $verificationCode = $user['code'];
        $phonenumber = $user['phone'];
    }

    $a="Hello! your verification code is: {$verificationCode}";

    sendSMS($phonenumber,$a);
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
                <a href="../job-list?id=<?php echo $id ?>" class="nav-link text-white">
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
    <!-- side bar p-5 mx-auto-->
    <div class="container-fluid pt-1">
        <!-- Account Access -->
        <div class="container mt-5">
            <div class="card main-card mx-auto d-block ">
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
                    <h4 class="mb-3">Phone numbers</h4>
                    <!-- <p>Phone numbers you've added</p> -->
                    <p class="fs-6 text-muted">These won't be displayed on your profile.</p>

                    <!-- <div class="mt-4 d-flex justify-content-between"> -->
                    <p class=" fw-bold text-muted">CA +1<?php echo $phone_number ?></p>
                    <?php
                    if ($msgSuccess) {
                        echo $msgPreSuccess . $msgSuccess . $msgPost;
                    }
                    if ($phoneMsg) {
                        echo $msgPreError . $phoneMsg . $msgPost;
                    }
                    ?>
                    <form class="mt-5" id="myform" name="myform" method="POST" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                        <h5 class="mb-4">Change your phone number</h5>
                        <!-- <div class="mt-3 col-lg-11 mb-3">
                                <label for="phone_number" class="form-label">Enter new phone number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number">
                            </div> -->
                        <div>
                        <div class="col-11 mb-3 d-flex">
                                    <input
                                    type="text" class="form-control phone-input" placeholder="Your phone number"
                                        style="border-radius:0.375rem 0 0 0.375rem;" id="phone" name="phone" 
                                        value="<?php
                                        if(isset($phone)){echo $phone;}
                                        if(isset($_POST['resend'])){echo $phonenumber;}
                                        ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-danger send-button"
                                            style="border-radius: 0 0.375rem 0.375rem 0;width: 100px; height: 100%;"
                                            type="submit"
                                            name="submit"
                                            <?php echo isset($_POST["submit"]) && $validNumber == true ? "disabled" : "";?>
                                            <?php echo isset($_POST["resend"]) ? "disabled" : "";?>
                                            onclick="onshowbutton()">Send</button>
                                    </div>
                                </div>
                                <div class="col-11 mb-3 d-flex">
                                    <input maxlength="6" type="text" class="form-control" placeholder="Verification code"
                                        style="border-radius:0.375rem 0 0 0.375rem;" id="verification" name="verification">
                                    <div class="input-group-append">
                                        <button class=" verified btn btn-success"
                                            style="border-radius: 0 0.375rem 0.375rem 0;width: 100px; height: 100%;"
                                            type="submit"
                                            name="verified"
                                            >Verify</button>
                                    </div>
                                </div>
                                <style>
                                    

                                    .show-container
                                    {
                                        align-items: center;
                                    }

                                    .resend,.change
                                    {
                                        margin-right: 1rem;
                                    }

                                    svg
                                    {
                                        margin-top: 0.2rem;
                                        margin-right: 0.5rem;
                                    }

                                </style>

                                <?php
                                
                                if (isset($_POST['submit']) && $validNumber =="true" || isset($_POST['resend']) )
                                {
                                    
                                echo  '<div class="show-container">';
                                echo '<div class="d-flex">';
                                echo '<svg class="svg-info text-primary align-items-center" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>';
                                echo  '<p class="text-primary v-message">Verification code sent. Please check your mobile device for the verification code. The verification code will expire in 5 minutes</p>';
                                echo '</div>';
                                echo  '<button
                                        type="submit"
                                        id="resend"
                                        name="resend"
                                        class="btn btn-primary mt-3 resend"
                                        >Resend Code</button>';
                                echo  '<button type="submit" id="change" name="change" class="btn btn-primary mt-3 change">Change Phone Number</button>';
                                echo  '</div>';

                                echo '<script src="../static/js/phone-number.js"></script>';
                                }

                                ?>
                                <div id="phoneHelp" class="col-11 form-text mt-4">A code will be sent to this phone number.
                                    Enter the code in the verify input and click on verify button to change your phone number.<div>
                                </div>
                    </form>
                    <!-- <div>
                            <a onclick="popupFunction()" class="btn btn-sm btn-soft-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </a>
                        </div> -->
                    <!-- </div> -->
                    <!-- <div class="d-flex justify-content-between">
                        <p class=" text-muted">Use for resseting password</p>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                        </div>
                    </div>
                    <p class="fs-6 fw-lighter text-muted">If selected, you'll be able to use this number to reset your
                        password</p> -->
                    <!-- <button type="submit" class="btn btn-sm btn-outline-primary">Make primary</button> -->
                    <!-- <hr>
                    <div class="d-flex justify-content-between">
                        <p class=" fw-bold">US +11239876754</p>
                        <div>
                            <a onclick="popupFunction()" class="btn btn-sm btn-soft-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class=" text-muted">Use for resseting password</p>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                        </div>
                    </div>
                    <p class="fs-6 fw-lighter text-muted">If selected, you'll be able to use this number to reset your
                        password</p>
                    <button type="submit" class="btn btn-sm btn-outline-primary">Make primary</button> -->
                    <!-- <button type="submit" class="mt-4 btn w-100 rounded-5 btn-primary"><a
                            onclick="addphonepopupFunction()">Add phone number</a></button> -->
                </div>
                <!-- Account Access Card Body -->
            </div>
        </div>
        <!-- Account Access Card -->
    </div>
    <!-- Account Access -->
</main>
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
            <p class="text-muted font-size-16 mb-4">Are you sure you want to permanently erase the job.</p>
            <div class="hstack gap-2 justify-content-center mb-0">
                <button type="button" class="btn btn-danger">Delete Now</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closepopupFunction()">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- delete warning -->
<!-- Adding Phone Number -->
<!-- <div class="modal-content deletenotvisible d-flex justify-content-center align-items-center" id="addphonepopup">
    <div class="deleteborder">
        <div class="modal-body px-4 py-5 text-center w-auto ">
            <button type="button" class="btn-close position-absolute end-0 top-0 m-3"
                onclick="closeaddphonepopupFunction()"></button>
            <div class="avatar-sm mb-4 mx-auto">
                <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                    <i class="mdi mdi-trash-can-outline"></i>
                </div>
            </div>
            <p class="fs-4 mb-2">Add a new phone number</p>
            <p class="text-muted font-size-16 mb-4">We'll send a verification code to this number.</p>
            <form action="#">
                <div>
                    <div class="col-12 mb-3 d-flex">
                        <input type="tel" class="form-control" placeholder="Your phone number"
                            style="border-radius:0.375rem 0 0 0.375rem;">
                        <div class="input-group-append">
                            <button class="btn btn-primary"
                                style="border-radius: 0 0.375rem 0.375rem 0;width: 100px; height: 100%;"
                                type="button">Send</button>
                        </div>
                    </div>
                    <div class="col-12 mb-3 d-flex">
                        <input type="text" class="form-control" placeholder="Verification code"
                            style="border-radius:0.375rem 0 0 0.375rem;">
                        <div class="input-group-append">
                            <button class="btn btn-success"
                                style="border-radius: 0 0.375rem 0.375rem 0;width: 100px; height: 100%;"
                                type="button">Verify</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- Adding Phone Number -->
<!-- js -->
<script>
    function popupFunction() {
        document.getElementById("deletepopup").style.visibility = "visible"
    }

    function closepopupFunction() {
        document.getElementById("deletepopup").style.visibility = "hidden"
    }

    function addphonepopupFunction() {
        document.getElementById("addphonepopup").style.visibility = "visible"
    }

    function closeaddphonepopupFunction() {
        document.getElementById("addphonepopup").style.visibility = "hidden"
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