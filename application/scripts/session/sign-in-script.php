<?php
include("../../includes/job_connect.php");
include("../../includes/utils.php");

if (isset($_POST['submit'])) {


$email = $_POST['email'];
$sanitized_email = mysqli_real_escape_string($jobConn, $email);

$query = "SELECT * FROM user WHERE email = '$sanitized_email'";

$result = mysqli_query($jobConn, $query);
if ($result) {
    // if record exists. Retry login
    if (mysqli_num_rows($result) > 0) {
        // echo $login_string;
        // $error_message = "This email already is in use";
        header('Location: ../../user-sign-in?email=' . $email);
        
        // echo $error_message;
    }
    //if record doesn't exist. Create account 
    else {
        // echo $user_type;
        header('Location: ../../user-registration.php?email=' . $email);
    }
} else {
    echo 'Error: ';
}
} else if ((!isset($_POST['submit']))) {
// echo $login_string;
}
?>