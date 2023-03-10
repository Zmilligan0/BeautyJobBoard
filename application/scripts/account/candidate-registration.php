<?php
$accl = "1,0";
include("../../includes/job_connect.php");
include("../../includes/utils.php");
// include("../../includes/header.php");

// Array for errors
$errorList = [];

// User id from session
$user_id = $_SESSION['user_id'];

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$will_relocate = $_POST['will_relocate'];

// Sanitization
$sanitized_first_name = mysqli_real_escape_string($jobConn, $first_name);
$sanitized_last_name = mysqli_real_escape_string($jobConn, $last_name);

//Checking for empty values
if (empty($sanitized_first_name)) {
    array_push($errorList, "First name empty: " . $sanitized_first_name);
}
if (empty($sanitized_last_name)) {
    array_push($errorList, "Last name empty: " . $sanitized_last_name);
}
try {
    $will_relocate = intval($will_relocate);
} catch (Exception $e) {
    array_push($errorList, "Will relocate empty: " . $will_relocate);
}

//Checking for length
if (strlen($sanitized_first_name) > 100) {
    array_push($errorList, "First_name max length is 100. Current length is: " . strlen($sanitized_first_name));
}
if (strlen($sanitized_last_name) > 100) {
    array_push($errorList, "last_name max length is 100. Current length is: " . strlen($sanitized_last_name));
}

try {
    // If any errors. Don't add user. Else add user.
    if (count($errorList) > 0) {
        echo "<ul>";
        foreach ($errorList as $key => $val) {
            echo "<li>" . $val . "</li>";
        }
        echo "</ul>";
    } else {
        // Add the new user to the candidate table
        $query = "INSERT INTO `candidate` (user_id, first_name, last_name, will_relocate) VALUES ('$user_id', '$sanitized_first_name', '$sanitized_last_name', " . $will_relocate . ")";

        mysqli_query($jobConn, $query);
        $sql = "SELECT candidate_id FROM candidate WHERE user_id = '$user_id'";

        $result = mysqli_query($jobConn, $sql);
        $row = mysqli_fetch_assoc($result);
        $candidate_id = $row['candidate_id'];
        mysqli_query($jobConn, "INSERT INTO resume (candidate_id, has_resume_one, has_resume_two, has_resume_three, resume_one_name, resume_two_name, resume_three_name) VALUES ('$candidate_id', 0, 0, 0, 'My Resume One', 'My Resume Two', 'My Resume Three')") or die("Error: " . mysqli_error($jobConn));

        $_SESSION['candidate_id'] = $candidate_id;
        $_SESSION['first_name'] = $sanitized_first_name;

        header("Location: ../../verify");
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
