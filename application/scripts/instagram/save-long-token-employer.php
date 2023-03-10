<?php
include("../../includes/job_connect.php");
include("../../includes/utils.php");

$user_id_sql = "SELECT user_id From employer WHERE user_id = '$_SESSION[user_id]'";
$user_id_list = $jobConn->query($user_id_sql);

$user_id = "";

while ($row = $user_id_list->fetch_assoc()){ 
    $user_id = $row['user_id']; 
}

$url = $_SERVER['REQUEST_URI'];
$url_query = parse_url($url, PHP_URL_QUERY);
$exploded_url_query = explode("=", $url_query);
$token = $exploded_url_query[1];

// $conn = new mysqli("localhost", "root", '', "job_platform");
$result = mysqli_query($jobConn, "SELECT * FROM employer WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));

$current_user = mysqli_fetch_array($result);
mysqli_query($jobConn, "UPDATE employer SET instagram_key = '$token' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));

header("Location: ../../employer-profile?hasToken=true&id=".$user_id);

?>