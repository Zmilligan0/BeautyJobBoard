<?php
include ("../includes/job_connect.php");
if (isset($_GET['user_id'])){
    $id = $_GET['user_id'];
}


$job_id = $_GET['job_id'];

$id = $_GET['user_id'];
if (!$job_id || !is_numeric($job_id) )
{
    header("Location:job-list?id=$id");
}
else
{
    $sql = "UPDATE job SET status = 0 Where job_id = $job_id";
    mysqli_query($jobConn, $sql);
    header("Location:job-list?id=$id");
}
// ?>