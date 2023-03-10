<?php
include("../../includes/job_connect.php");
include("../../includes/utils.php");

$user_id_sql = "SELECT user_id From candidate WHERE user_id = '$_SESSION[user_id]'";
$user_id_list = $jobConn->query($user_id_sql);

$user_id = "";

while ($row = $user_id_list->fetch_assoc()){ 
    $user_id = $row['user_id']; 
}

// $conn = new mysqli("localhost", "root", '', "job_platform");

mysqli_query($jobConn, "UPDATE candidate SET instagram_key = 1 WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));

header("Location: ../../candidate-profile?id=".$user_id);

?>