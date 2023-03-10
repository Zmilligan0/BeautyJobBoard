<?php
include ("../includes/job_connect.php");
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
}

$id = $_GET['user_id'];
$application_id = $_GET['application_id'];

if (!$application_id || !is_numeric($application_id) )
{
    header("Location:applications?id=$id");
}
else
{
    $sql = "DELETE from application Where application_id = $application_id";
    $result = mysqli_query($jobConn, $sql) or die (mysqli_error($jobConn));
    header("Location:applications?id=$id");   
}

?>

