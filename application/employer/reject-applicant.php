<?php 
// $accl = "0,1";
include("../includes/job_connect.php");
// include("../includes/utils.php");
// include("../includes/header.php");
if (isset($_GET['user_id'])){
    $id = $_GET['user_id'];
}

$application_id = $_GET['application_id'];
$id = $_GET['user_id'];
if (!$application_id || !is_numeric($application_id) )
{
    header("Location:applicant-list?id=$id");
}
else
{
    $sql = "UPDATE application SET status = 0 Where application_id = $application_id  ";
    mysqli_query($jobConn, $sql);
    header("Location:applicant-list?id=$id");
}
?>