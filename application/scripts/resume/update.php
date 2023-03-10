<?php
include("../../includes/job_connect.php");
include("../../includes/utils.php");
$user_id = $_GET['id'];
$candidate_id = $_GET['canId'];

// $conn = new mysqjobCi("localhost", "root", '', "job_platform");
$result = mysqli_query($jobConn, "SELECT * FROM candidate WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));

if (isset($_POST['resume-one-save-button'])) 
{
    $resume_one_raw = $_POST['resume-one-edit'];
    $resume_one_edited = str_replace("\\", "", $resume_one_raw);
    $resume_one = str_replace("'", "\'", $resume_one_edited);
    mysqli_query($jobConn, "UPDATE resume SET resume_one_name = '$resume_one' WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: ../../candidate-profile?id=$user_id");
}

if (isset($_POST['resume-two-save-button'])) 
{
    $resume_two_raw = $_POST['resume-two-edit'];
    $resume_two_edited = str_replace("\\", "", $resume_two_raw);
    $resume_two = str_replace("'", "\'", $resume_two_edited);
    mysqli_query($jobConn, "UPDATE resume SET resume_two_name = '$resume_two' WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: ../../candidate-profile?id=$user_id");
}

if (isset($_POST['resume-three-save-button'])) 
{
    $resume_three_raw = $_POST['resume-one-edit'];
    $resume_three_edited = str_replace("\\", "", $resume_three_raw);
    $resume_three = str_replace("'", "\'", $resume_three_edited);
    mysqli_query($jobConn, "UPDATE resume SET resume_three_name = '$resume_three' WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: ../../candidate-profile?id=$user_id");
}

?>