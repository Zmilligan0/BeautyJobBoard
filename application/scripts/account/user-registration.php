<?php
include("../../includes/utils.php");
require('../../includes/job_connect.php');


if (isset($_POST['submit'])) {

    // array for errors
    $errorList = [];

    $user_type = $_POST['user_type'];
    if ($user_type != 0 && $user_type != 1) {
        $user_type = 0;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $last_online = date("Y-m-d H:i:s");
    $is_verified = false;

    //sanitize to avoid SQL injection
    $sanitized_user_type = mysqli_real_escape_string($jobConn, $user_type);
    $sanitized_email = mysqli_real_escape_string($jobConn, $email);
    $sanitized_password = mysqli_real_escape_string($jobConn, $hashed_password);

    // Check if user type is 0 or 1
    if ($user_type != 0 && $user_type != 1) {
        array_push($errorList, "User type invalid: " . $user_type);
    }

    //Check for empty values
    if (empty($sanitized_email)) {
        array_push($errorList, "Email empty: " . $sanitized_email);
    }
    if (empty($password)) {
        array_push($errorList, "Password empty: " . $password);
    }
    if (empty($last_online)) {
        array_push($errorList, "Datetime empty: " . $create_datetime);
    }

    //Check if strings are too long
    if (strlen($sanitized_email) > 100) {
        array_push($errorList, "email max length is 100. Current length is: " . strlen($sanitized_email));
    }
    if (strlen($password) > 100) {
        array_push($errorList, "password max length is 100. Current length is: " . strlen($password));
    }
    
    // Check if email is in correct format
    if (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
        array_push($errorList, "Invalid email format: " . $sanitized_email);
    }

    // Check if password is in correct format
    if (!preg_match('/[A-Z]/', $password)) {
        array_push($errorList, "Invalid password format: No capitals in string");
    }
    if (strlen($password) < 8) {
        array_push($errorList, "Invalid password format: Password must be atleast 8 long");
    }

    // Verify email is not already in use
    $result = mysqli_query($jobConn, "SELECT user_id FROM user WHERE email = '$sanitized_email'");
    if (mysqli_num_rows($result) > 0) {
        // Email already in use
        array_push($errorList, "Email already in use: " . $sanitized_email);
        header('Location: ../../user-sign-in?email=' . $email);
    } else {
        try {
            // If any errors. Don't add user 
            if (count($errorList) > 0) {
                echo "<ul>";
                foreach ($errorList as $key => $val) {
                    echo "<li>" . $val . "</li>";
                }
                echo "</ul>";
            }
            // Else add user
            else {
                //Query to create a new user
                $user_query = "INSERT into `user` (type, email, password, last_online) VALUES ('$sanitized_user_type', '$sanitized_email', '$sanitized_password','$last_online')";

                mysqli_query($jobConn, $user_query);

                $sql = "SELECT user_id FROM user WHERE email = '$sanitized_email'";
                $result = mysqli_query($jobConn, $sql);
                $row = mysqli_fetch_assoc($result);

                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['type'] = $user_type;
                $_SESSION['email'] = $email;
                $_SESSION['is_verified'] = 0;

                if ($user_type == 0) {
                    header('Location: ../../candidate-registration');
                } else if ($user_type == 1) {
                    header('Location: ../../employer-registration');
                }
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}
