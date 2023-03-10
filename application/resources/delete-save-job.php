<?php
include ("../includes/job_connect.php");
if (isset($_GET['user_id'])){
    $id = $_GET['user_id'];
}


$job_id = $_GET['job_id'];

$id = $_GET['candidate_id'];
if (!$job_id || !is_numeric($job_id) )
{
    header("Location:../job-post?id=$job_id");
}
else
{
    $sql = " DELETE FROM saved_job WHERE candidate_id = $id AND job_id = $job_id";
    mysqli_query($jobConn, $sql);
    header("Location:../job-post?id=$job_id");
}
// ?>