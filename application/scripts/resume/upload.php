<?php
include("../../includes/job_connect.php");
include("../../includes/utils.php");
$url = $_SERVER['REQUEST_URI'];
$url_query = parse_url($url, PHP_URL_QUERY);
$exploded_url_query = explode("id=", $url_query);
// $exploded_user_id = explode("&", $exploded_url_query[1]);
$user_id = $_GET['id'];
echo $user_id;
// echo $user_id;
if (isset($_POST['submitA'])) {
    // Get file information
    $file = $_FILES['uploadResumeOne'];

    $fileName = $_FILES['uploadResumeOne']['name'];
    $fileTmpName = $_FILES['uploadResumeOne']['tmp_name'];
    $fileSize = $_FILES['uploadResumeOne']['size'];
    $fileError = $_FILES['uploadResumeOne']['error'];
    $fileType = $_FILES['uploadResumeOne']['type'];
    // print_r($file);

    // print_r($_GET['activeres']);

    $candidateID = $_GET['activeres'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('pdf');

    // $conn = new mysqli("localhost", "root", '', "job_platform");
    $result = mysqli_query($jobConn, "SELECT * FROM resume") or die("Error: " . mysqli_error($jobConn));

    // Check conditions
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                // Upload file
                // $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileNameNew = $candidateID."-one.".$fileActualExt;
                // $fileDestination = '../../uploads/resumes/'.$fileNameNew;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                mysqli_query($jobConn, "UPDATE resume SET has_resume_one = 1 WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
                header("Location: ../../candidate-profile?resup=onesuccess&".$fileNameNew."&id=".$user_id);
            } else {
                echo "Your file is too big!";
                header("Location: ../../candidate-profile?error=size&".$fileNameNew."&id=".$user_id);
            }
        } else {
            echo "There was an error uploading your file!";
            header("Location: ../../candidate-profile?error=other&".$fileNameNew."&id=".$user_id);
        }
    } else {
        echo "You cannot upload files of this type!";
        header("Location: ../../candidate-profile?error=type&".$fileNameNew."&id=".$user_id);
    }

}
if (isset($_POST['submitB'])) {
    
    $file = $_FILES['uploadResumeTwo'];

    $fileName = $_FILES['uploadResumeTwo']['name'];
    $fileTmpName = $_FILES['uploadResumeTwo']['tmp_name'];
    $fileSize = $_FILES['uploadResumeTwo']['size'];
    $fileError = $_FILES['uploadResumeTwo']['error'];
    $fileType = $_FILES['uploadResumeTwo']['type'];
    // print_r($file);

    // print_r($_GET['activeres']);

    $candidateID = $_GET['activeres'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('pdf');

    // $conn = new mysqli("localhost", "root", '', "job_platform");
    $result = mysqli_query($jobConn, "SELECT * FROM resume") or die("Error: " . mysqli_error($jobConn));

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = $candidateID."-two.".$fileActualExt;
                // $fileDestination = '../../uploads/resumes/'.$fileNameNew;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                mysqli_query($jobConn, "UPDATE resume SET has_resume_two = 1 WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
                header("Location: ../../candidate-profile?resup=twosuccess&".$fileNameNew."&id=".$user_id);
            } else {
                echo "Your file is too big!";
                header("Location: ../../candidate-profile?error=size&".$fileNameNew."&id=".$user_id);
            }
        } else {
            echo "There was an error uploading your file!";
            header("Location: ../../candidate-profile?error=other&".$fileNameNew."&id=".$user_id);
        }
    } else {
        echo "You cannot upload files of this type!";
        header("Location: ../../candidate-profile?error=type&".$fileNameNew."&id=".$user_id);
    }

}
if (isset($_POST['submitC'])) {
    
    $file = $_FILES['uploadResumeThree'];

    $fileName = $_FILES['uploadResumeThree']['name'];
    $fileTmpName = $_FILES['uploadResumeThree']['tmp_name'];
    $fileSize = $_FILES['uploadResumeThree']['size'];
    $fileError = $_FILES['uploadResumeThree']['error'];
    $fileType = $_FILES['uploadResumeThree']['type'];
    // print_r($file);

    // print_r($_GET['activeres']);

    $candidateID = $_GET['activeres'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('pdf');

    // $conn = new mysqli("localhost", "root", '', "job_platform");
    $result = mysqli_query($jobConn, "SELECT * FROM resume") or die("Error: " . mysqli_error($jobConn));

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                // $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileNameNew = $candidateID."-three.".$fileActualExt;
                // $fileDestination = '../../uploads/resumes/'.$fileNameNew;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                mysqli_query($jobConn, "UPDATE resume SET has_resume_three = 1 WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
                header("Location: ../../candidate-profile?resup=threesuccess&".$fileNameNew."&id=".$user_id);
            } else {
                echo "Your file is too big!";
                header("Location: ../../candidate-profile?error=size&".$fileNameNew."&id=".$user_id);
            }
        } else {
            echo "There was an error uploading your file!";
            header("Location: ../../candidate-profile?error=other&".$fileNameNew."&id=".$user_id);
        }
    } else {
        echo "You cannot upload files of this type!";
        header("Location: ../../candidate-profile?error=type&".$fileNameNew."&id=".$user_id);
    }

}
?>