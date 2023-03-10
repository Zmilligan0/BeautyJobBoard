<?php
include ("../includes/job_connect.php");
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
}

$id = $_GET['user_id'];
$job_id = $_GET['job_id'];

if (!$job_id || !is_numeric($job_id) )
{
    header("Location:saved_jobs?id=$id");
}
else
{
    $sql = "DELETE from saved_job Where job_id = $job_id";
    $result = mysqli_query($jobConn, $sql) or die (mysqli_error($jobConn));
    header("Location:saved_jobs?id=$id");
}

?>

