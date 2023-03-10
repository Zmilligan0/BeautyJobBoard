<?php
include("../includes/job_connect.php");
if (isset($_GET['user_id'])){
    $id = $_GET['user_id'];
    
}


$contact_id = $_GET['contact_id'];
$id = $_GET['user_id'];

echo $contact_id;
if (!$contact_id || !is_numeric($contact_id) )
{
    header("Location:contacts?id=$id");
}
else
{
    $sql = "DELETE from contact Where contact_id = $contact_id";

    mysqli_query($jobConn, $sql);

    header("Location:contacts?id=$id");
}
?>