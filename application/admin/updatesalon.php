<?php
$accl = "0,0";
include("../includes/job_connect.php");
include("../includes/utils.php");
$url = $_SERVER['REQUEST_URI'];
$url_query = parse_url($url, PHP_URL_QUERY);
$exploded_url_query = explode("=", $url_query);
$employerID = $exploded_url_query[1];
$result = mysqli_query($jobConn, "SELECT * FROM employer WHERE employer_id = '$employerID'") or die("Error: " . mysqli_error($jobConn));
$current_user = mysqli_fetch_array($result);
if (isset($_POST['submitA'])) {
    $company_name = $_POST['name-edit'];
    mysqli_query($jobConn, "UPDATE employer SET business_name = '$company_name' WHERE employer_id = '$employerID'") or die("Error: " . mysqli_error($jobConn));
    header("Location: editsalon");
}

if (isset($_POST['submitB'])) {
    $industry = $_POST['industry-edit'];
    mysqli_query($jobConn, "UPDATE employer SET business_category = '$industry' WHERE employer_id = '$employerID'") or die("Error: " . mysqli_error($jobConn));
    header("Location: editsalon");
}

if (isset($_POST['submitC'])) {
    $description = $_POST['description-edit'];
    mysqli_query($jobConn, "UPDATE employer SET description = '$description' WHERE employer_id = '$employerID'") or die("Error: " . mysqli_error($jobConn));
    header("Location: editsalon");
}

if (isset($_POST['submitD'])) {
    $address = $_POST['address-edit'];
    mysqli_query($jobConn, "UPDATE employer SET address = '$address' WHERE employer_id = '$employerID'") or die("Error: " . mysqli_error($jobConn));
    header("Location: editsalon");
}

if (isset($_POST['submitE'])) {
    $city = $_POST['city-edit'];
    mysqli_query($jobConn, "UPDATE employer SET city = '$city' WHERE employer_id = '$employerID''") or die("Error: " . mysqli_error($jobConn));
    header("Location: editsalon");
}

if (isset($_POST['submitF'])) {
    $province = $_POST['province-edit'];
    mysqli_query($jobConn, "UPDATE employer SET province = '$province' WHERE employer_id = '$employerID'") or die("Error: " . mysqli_error($jobConn));
    header("Location: editsalon");
}

if (isset($_POST['submitG'])) {
    $postal = $_POST['postal-edit'];
    mysqli_query($jobConn, "UPDATE employer SET postal_code = '$postal' WHERE employer_id = '$employerID'") or die("Error: " . mysqli_error($jobConn));
    header("Location: editsalon");
}

if (isset($_POST['submitH'])) {
    $website = $_POST['website-edit'];
    mysqli_query($jobConn, "UPDATE employer SET website_url = '$website' WHERE employer_id = '$employerID''") or die("Error: " . mysqli_error($jobConn));
    header("Location: editsalon");
}

if (isset($_POST['submitI'])) {
    $facebook = $_POST['facebook-edit'];
    mysqli_query($jobConn, "UPDATE employer SET facebook = '$facebook' WHERE employer_id = '$employerID'") or die("Error: " . mysqli_error($jobConn));
    header("Location: editsalon");
}

if (isset($_POST['submitJ'])) {
    $instagram = $_POST['instagram-edit'];
    mysqli_query($jobConn, "UPDATE employer SET instagram = '$instagram' WHERE employer_id = '$employerID'") or die("Error: " . mysqli_error($jobConn));
    header("Location: editsalon");
}

if (isset($_POST['submitK'])) {
    $twitter = $_POST['twitter-edit'];
    mysqli_query($jobConn, "UPDATE employer SET linkedin = '$twitter' WHERE employer_id = '$employerID'") or die("Error: " . mysqli_error($jobConn));
    header("Location: editsalon");
}

if (isset($_POST['submitL'])) {
    $tiktok = $_POST['tiktok-edit'];
    mysqli_query($jobConn, "UPDATE employer SET tiktok = '$tiktok' WHERE employer_id = '$employerID'") or die("Error: " . mysqli_error($jobConn));
    header("Location: editsalon");
}

if (isset($_POST['submitM'])) {
    $youtube = $_POST['youtube-edit'];
    mysqli_query($jobConn, "UPDATE employer SET youtube = '$youtube' WHERE employer_id = '$employerID''") or die("Error: " . mysqli_error($jobConn));
    header("Location: editsalon");
}
?>