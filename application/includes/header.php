<?php $signedIn = (isset($_SESSION['user_id'])) ? true : false; ?>
<?php
if (!defined("ROOT_URL")) {
    define("ROOT_URL", "http://localhost/GREENteam2022/application/");
}

$name = "";

if ($signedIn) {
    if (isset($_SESSION['first_name'])) {
        $name = $_SESSION['first_name'];
    } else if (isset($_SESSION['business_name'])) {
        $name = $_SESSION['business_name'];
    }
}

$dashboard = false;
$subpath = explode("/", $_SERVER['SCRIPT_NAME'])[count(explode("/", $_SERVER['SCRIPT_NAME'])) - 2];
if ($subpath == "employer" || $subpath == "candidate" || $subpath == "admin") {
    $dashboard = true;
}

$pageTitle;
$fqt = "Salonify";
if (isset($pageTitle) && !empty($pageTitle) && $pageTitle != "Home Page") {
    $fqt = "$pageTitle - Salonify";
} elseif (empty($pageTitle)) {
    echo "<h1>Page title not set. Add a title before the header include by declaring the variable \$pageTitle.</h1>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $fqt ?></title>
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>static/css/nav.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>static/css/global.css">
    <script src="<?php echo ROOT_URL ?>static/js/header.js" defer></script>
</head>

<body>
    <header>
        <style>
            .dashboard {
                max-width: none;
                padding-left: 1rem;             
                padding-right: 1rem;
            }
        </style>
        <div class="container" id="app-header">
            <script>
                if (<?php echo $dashboard ?>) {
                    document.getElementById("app-header").classList.add("dashboard");
                }
            </script>
            <div id="navbar">
                <!-- Logo -->
                <style>
                    #app-logo {
                        text-decoration: none;
                        color: #fff;
                        font-size: 1.5rem;
                        font-weight: 700;
                    }

                    #app-logo:hover {
                        color: #fff;
                    }
                </style>
                <a id="app-logo" href="<?php echo ROOT_URL ?>">
                    Salonify
                </a>
                <div id="navbar-right">
                    <!-- Sign in button -->
                    <a href="<?php echo ROOT_URL ?><?php echo $signedIn ? "scripts/session/sign-out" : "sign-in"; ?>" class="sign-in" id="snbtn1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        </svg>
                        <?php echo $signedIn ? "Sign out" : "Sign In"; ?>
                    </a>
                    <div>
                        <!-- Hamburger menu -->
                        <div id="ham-menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Responsive navbar-->
            <div>
                <nav id="navbar-menu">
                    <ul>
                        <li>
                            <a href="<?php echo ROOT_URL ?>">Home</a>
                        </li>
                        <?php
                        // Non signed in users
                        if (!$signedIn) {
                            echo "<li><a href=\"" . ROOT_URL . "search?query=&location=&type=&date=365&distance=0\">Find Jobs</a></li>";
                            echo "<li><a href=\"" . ROOT_URL . "employer/new-job\">Post Job</a></li>";
                            // Employers
                        } else if ($signedIn && $_SESSION['type'] == "1") {
                            echo "<li><a href=\"" . ROOT_URL . "employer/job-list?id=$_SESSION[user_id]\">Dashboard</a></li>";
                            echo "<li><a href=\"" . ROOT_URL . "employer/new-job?id=$_SESSION[user_id]\">Post Job</a></li>";
                            echo "<li><a href=\"" . ROOT_URL . "employer-profile?id=$_SESSION[user_id]\">Profile</a></li>";
                            // Candidates
                        } else if ($signedIn && $_SESSION['type'] == "0") {
                            echo "<li><a href=\"" . ROOT_URL . "candidate/applications?id=$_SESSION[user_id]\">Dashboard</a></li>";
                            echo "<li><a href=\"" . ROOT_URL . "search?query=&location=&type=&date=365&distance=0\">Find Jobs</a></li>";
                            echo "<li><a href=\"" . ROOT_URL . "candidate-profile?id=$_SESSION[user_id]\">Profile</a></li>";
                        } else if ($signedIn && $_SESSION['type'] == "2") {
                            echo "<li><a href=\"" . ROOT_URL . "admin/candidate\">Admin</a></li>";
                        }
                        ?>
                        <li>
                            <a href="<?php echo ROOT_URL ?>resources/home">Resources</a>
                        </li>
                        <?php
                        if (!empty($name)) {
                            switch ($_SESSION['type']) {
                                case 0:
                                    echo "<li><a href=\"" . ROOT_URL . "candidate-profile?id=$_SESSION[user_id]\">Hi, $name</a></li>";
                                    break;
                                case 1:
                                    echo "<li><a href=\"" . ROOT_URL . "employer-profile?id=$_SESSION[user_id]\">Hi, $name</a></li>";
                                    break;
                                case 2:
                                    echo "<li><a href=\"" . ROOT_URL . "admin/candidate\">Hi, $name</a></li>";
                                    break;
                            }
                        }
                        ?>
                        <li>
                            <!-- Sign in button -->
                            <a href="<?php echo ROOT_URL ?><?php echo $signedIn ? "scripts/session/sign-out" : "sign-in"; ?>" class="sign-in" id="snbtn2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                                <?php echo $signedIn ? "Sign out" : "Sign In"; ?>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>