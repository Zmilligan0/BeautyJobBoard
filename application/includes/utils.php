<?php
if (!isset($_SESSION['user_id'])) {
    session_start();
}

if (!defined("ROOT_URL")) {
    define("ROOT_URL", "http://localhost/GREENteam2022/application/");
}

$open_pages = array("index.php", "verify.php", "logout.php", "search.php", "candidate.php", "employer.php", "user-sign-in.php", "home.php", "catalog.php", "candidate-registration.php", "employer-registration.php");

if (isset($_SESSION['is_verified'])) {
    if ($_SESSION['is_verified'] != 1) {
        $script_name = explode("/", $_SERVER['SCRIPT_NAME']);
        if (!in_array(end($script_name), $open_pages)) {
            header("Location: " . ROOT_URL . "verify");
            exit;
        }
    }
}

if (isset($accl)) {

    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $account_type = $_SESSION['type'];
        $access = explode(",", $accl);
        
        switch ($account_type)
        {
            // Candidate
            case 0:
                // No access
                if ($access[0] == 0) {
                    header("Location: " . ROOT_URL);
                    exit;
                // Access to self only
                } else if ($access[0] == 2) {
                    if (!isset($_GET['id']) || $_GET['id'] != $id) {
                        header("Location: " . ROOT_URL);
                        exit;
                    }
                // Exit if not 1
                } else if ($access[0] != 1) {
                    echo "Error: An unknown error has occurred.";
                    exit;
                }
                break;
            // Employer
            case 1:
                // No access
                if ($access[1] == 0) {
                    header("Location: " . ROOT_URL);
                    exit;
                // Access to self only
                } else if ($access[1] == 2) {
                    if (!isset($_GET['id']) || $_GET['id'] != $id) {
                        header("Location: " . ROOT_URL);
                        exit;
                    }
                // Exit if not 1
                } else if ($access[1] != 1) {
                    echo "Error: An unknown error has occurred.";
                    exit;
                }
                break;
        }
    } else {
        header("Location: " . ROOT_URL . "sign-in?error=1");
        exit;
    }
}

// Prevent MySQL injection on GET and POST
if (isset($eduConn) || isset($jobConn)) {
    foreach ($_POST as $key => $value) {
        if (isset($eduConn)) {
            $_POST[$key] = mysqli_real_escape_string($eduConn, $value);
        }
        if (isset($jobConn)) {
            $_POST[$key] = mysqli_real_escape_string($jobConn, $value);
        }
    }

    foreach ($_GET as $key => $value) {
        if (isset($eduConn)) {
            $_GET[$key] = mysqli_real_escape_string($eduConn, $value);
        }
        if (isset($jobConn)) {
            $_GET[$key] = mysqli_real_escape_string($jobConn, $value);
        }
    }
}
