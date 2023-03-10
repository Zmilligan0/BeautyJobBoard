<?php
$accl = "0,1";
include("../../includes/job_connect.php");
include("../../includes/utils.php");

if (isset($_POST['submit'])) {
    $errorList = [];

    echo "Checkpoint 1";

    // User id from session
    $user_id = $_SESSION['user_id'];

    // Form Fields Required
    $business_name = $_POST['business_name'];
    $business_category = $_POST['business_category'];
    $business_city = $_POST['business_city'];
    $business_postal = $_POST['business_postal'];
    $business_province = $_POST['province'];
    $business_description = $_POST['business_description'];
    $business_address = $_POST['business_address'];

    // Sanitize to avoid SQL injection
    $sanitized_business_name = mysqli_real_escape_string($jobConn, $business_name);
    $sanitized_business_category = mysqli_real_escape_string($jobConn, $business_category);
    $sanitized_business_city = mysqli_real_escape_string($jobConn, $business_city);
    $sanitized_business_postal = mysqli_real_escape_string($jobConn, $business_postal);

    $sanitized_business_description = mysqli_real_escape_string($jobConn, $business_description);
    $sanitized_business_address = mysqli_real_escape_string($jobConn, $business_address);

    // Verify province is in the list of provinces
    $provinces = ["AB", "BC", "MB", "NB", "NL", "NS", "NT", "NU", "ON", "PE", "QC", "SK", "YT"];
    if (!in_array($business_province, $provinces)) {
        array_push($errorList, "Province invalid: " . $business_province);
    }

    echo "Checkpoint 2";

    // Check for empty values
    if (empty($sanitized_business_name)) {
        array_push($errorList, "Business name empty: " . $sanitized_business_name);
    }
    if (empty($sanitized_business_category)) {
        array_push($errorList, "Business category empty: " . $sanitized_business_category);
    }
    if (empty($sanitized_business_city)) {
        array_push($errorList, "Business city empty: " . $sanitized_business_city);
    }
    if (empty($sanitized_business_postal)) {
        array_push($errorList, "Business postal code empty: " . $sanitized_business_postal);
    }

    echo "Checkpoint 3";

    // Check if postal code is in correct pattern
    $postal_pattern = "/([ABCEGHJKLMNPRSTVXY]\d)([ABCEGHJKLMNPRSTVWXYZ]\d){2}/i";
    if (!preg_match($postal_pattern, $sanitized_business_postal)) {
        array_push($errorList, "Business postal code does not match correct format: " . $sanitized_business_postal);
    }

    echo "Checkpoint 4";

    try {
        // If any errors. Don't add user. Else add user
        if (count($errorList) > 0) {
            echo "Error";
            echo "<ul>";
            foreach ($errorList as $key => $val) {
                echo "<li>" . $val . "</li>";
            }
            echo "</ul>";
        } else {
            echo "Checkpoint 5";
            // Query to add the new user to the employer table
            $employer_query = "INSERT into `employer` (business_category, business_name, description, address, city, province, postal_code, user_id) VALUES ('$sanitized_business_category','$sanitized_business_name', '$sanitized_business_description','$sanitized_business_address', '$sanitized_business_city','$business_province','$sanitized_business_postal', '$user_id')";

            mysqli_query($jobConn, $employer_query);
            $sql = "SELECT employer_id FROM employer WHERE user_id = '$user_id'";
            $result = mysqli_query($jobConn, $sql);
            $row = mysqli_fetch_assoc($result);
            $employer_id = $row['employer_id'];

            $_SESSION['employer_id'] = $employer_id;
            $_SESSION['business_name'] = $sanitized_business_name;

            header("Location: ../../verify");
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}
