<?php
include("../../includes/job_connect.php");
include("../../includes/utils.php");
$user_id_sql = "SELECT user_id From candidate WHERE user_id = '$_SESSION[user_id]'";
$user_id_list = $jobConn->query($user_id_sql);

$url = $_SERVER['REQUEST_URI'];
$url_query = parse_url($url, PHP_URL_QUERY);
$exploded_url_query = explode("=", $url_query);

$almost_token = explode("?", $exploded_url_query[1]);
$almost_instagram_user_id = explode("?", $exploded_url_query[2]);
$instagram_token = $almost_token[0];
$instagram_user_id = $almost_instagram_user_id[0];
$user_id = $exploded_url_query[3];

// $conn = new mysqli("localhost", "root", '', "job_platform");
$result = mysqli_query($jobConn, "SELECT * FROM candidate WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));

$current_user = mysqli_fetch_array($result);
mysqli_query($jobConn, "UPDATE candidate SET instagram_key = '$instagram_token' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
mysqli_query($jobConn, "UPDATE candidate SET instagram_id = '$instagram_user_id' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));

header("Location: get-long-token");
?>