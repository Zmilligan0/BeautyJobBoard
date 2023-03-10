<?php
    //security
    $accl = "0,0";
    $pageTitle = "Deleting";
    include ("../includes/job_connect.php");
    include ("../includes/edu_connect.php");
    include ("../includes/utils.php");

    $id = $_GET['id'];
    $category = $_GET['category'];


    //next step, is to do the actual delete
    if(is_numeric($id)){
        if($category == "application"){
            // do the delete

            //delete sql
            mysqli_query($jobConn, "DELETE FROM application WHERE application_id = $id") or die(mysqli_error($jobConn));
            header("Location:application.php");
        }
        elseif($category == "candidate") {
            mysqli_query($jobConn, "DELETE FROM canadiate WHERE candidate_id = $id") or die(mysqli_error($jobConn));
            header("Location:candidate.php");
        }
        elseif($category == "job") {
            mysqli_query($jobConn, "DELETE FROM job WHERE job_id = $id") or die(mysqli_error($jobConn));
            header("Location:job.php");
        }
        elseif($category == "employer") {
            mysqli_query($jobConn, "DELETE FROM employer WHERE employer_id = $id") or die(mysqli_error($jobConn));
            header("Location:employer.php");
        }
        elseif($category == "education") {
            mysqli_query($eduConn, "DELETE FROM resource_view WHERE resource_id = $id") or die(mysqli_error($eduConn));
            mysqli_query($eduConn, "DELETE FROM resource WHERE resource_id = $id") or die(mysqli_error($eduConn));
            header("Location:education.php");
        }
    }



?>