<?php
if (!isset($_SESSION['user_id'])) {
    session_start();
} else {
    session_regenerate_id();
}

if (!defined("ROOT_URL")) {
    define("ROOT_URL", "http://localhost/GREENteam2022/application/");
}

include("../../includes/job_connect.php");
include("../../includes/utils.php");

$email = $password = "";

if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (empty(trim($_POST['email'])) || empty(trim($_POST['password']))) {
    exit('Invalid email or password');
} else {
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);
}

$result = mysqli_query($jobConn, "SELECT * FROM user WHERE email = '$email' limit 1");

$good_password = false;
$pass_result = mysqli_query($jobConn, "SELECT password FROM user WHERE email = '$email' ");
$pass_row = $pass_result->fetch_row();
$value = $pass_row[0] ?? false;

if (password_verify($password, $value) == true) {
    $good_password = true;
}

if (mysqli_num_rows($result) == 1 && $good_password == true) {
    $row = mysqli_fetch_array($result);

    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['type'] = $row['type'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['is_verified'] = $row['is_verified'];
    
    if ($row['deactivation_date'] != null) {
        session_destroy();
        header("Location: " . $path . "index");
        exit;
    }

    if ($_SESSION['is_verified'] == 0) {
        header("Location:" . ROOT_URL . "verify");
    } else {
        if ($_SESSION['type'] == 0) {
            $result = mysqli_query($jobConn, "SELECT * FROM candidate WHERE user_id = " . $_SESSION['user_id'] . " LIMIT 1");
            if (mysqli_num_rows($result)) {
                $row = mysqli_fetch_array($result);

                $_SESSION['candidate_id'] = $row['candidate_id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['location'] = $row['city'] . ", " . $row['province'];
            } else {
                exit('Internal database error: candidate does not exist.');
            }

            header("Location: " . ROOT_URL . "index");
        } else if ($_SESSION['type'] == 1) {
            $result = mysqli_query($jobConn, "SELECT * FROM employer WHERE user_id = " . $_SESSION['user_id'] . " LIMIT 1");

            if (mysqli_num_rows($result)) {
                $row = mysqli_fetch_array($result);

                $_SESSION['employer_id'] = $row['employer_id'];
                $_SESSION['business_name'] = $row['business_name'];
            } else {
                exit('Internal database error: employer does not exist.');
            }

            header("Location: " . ROOT_URL . "index");
        } else if ($_SESSION['type'] == 2) {
            $result = mysqli_query($jobConn, "SELECT * FROM admin WHERE user_id = " . $_SESSION['user_id'] . " LIMIT 1");

            if (mysqli_num_rows($result)) {
                $row = mysqli_fetch_array($result);

                $_SESSION['admin_id'] = $row['admin_id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
            } else {
                exit('Internal database error: admin does not exist.');
            }

            header("Location: " . ROOT_URL . "index");
        }
    }
} else {
    header('Location: ../../user-sign-in?error=1&email=' . $email);
}
?>