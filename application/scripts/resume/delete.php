<?php
include("../../includes/job_connect.php");
include("../../includes/utils.php");
$user_id = $_GET['id'];
$candidate_id = $_GET['canID'];
$activeRes = $_GET['activeres'];

// $conn = new mysqli("localhost", "root", '', "job_platform");
$result = mysqli_query($jobConn, "SELECT * FROM resume WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
$current_user = mysqli_fetch_array($result);
$hasone = $current_user['has_resume_one'];
$hastwo = $current_user['has_resume_two'];
$hasthree = $current_user['has_resume_three'];
// $titleOne = $current_user['resume_one_name'];


$titleTwo_raw = $current_user['resume_two_name'];
$titleTwo_edited = str_replace("\\", "", $titleTwo_raw);
$titleTwo = str_replace("'", "\'", $titleTwo_edited);
$titleThree_raw = $current_user['resume_three_name'];
$titleThree_edited = str_replace("\\", "", $titleThree_raw);
$titleThree = str_replace("'", "\'", $titleThree_edited);

$url = $_SERVER['REQUEST_URI'];
$url_query = parse_url($url, PHP_URL_QUERY);
$exploded_url_query = explode("=", $url_query);
$exploded_user_id = explode("&", $exploded_url_query[1]);

echo $candidate_id;
echo $user_id;
echo $activeRes;

// Get file information
// $filenameA = "../../uploads/resumes/".$candidate_id."-one"."*";
$filenameA = "uploads/".$candidate_id."-one"."*";
$fileinfoA = glob($filenameA);
$fileextA = explode(".", $fileinfoA[0]);
$fileactualextA = $fileextA[1];
// $fileA = "../../uploads/resumes/".$candidate_id."-one".".".$fileactualextA;
$fileA = "uploads/".$candidate_id."-one".".".$fileactualextA;

if ($hastwo == 1) {
    // $filenameB = "../../uploads/resumes/".$candidate_id."-two"."*";
    $filenameB = "uploads/".$candidate_id."-two"."*";
    $fileinfoB = glob($filenameB);
    $fileextB = explode(".", $fileinfoB[0]);
    $fileactualextB = $fileextB[1];
    // $fileB = "../../uploads/resumes/".$candidate_id."-two".".".$fileactualextB;
    $fileB = "uploads/".$candidate_id."-two".".".$fileactualextB;
}


if ($hasthree == 1) {
    // $filenameC = "../../uploads/resumes/".$candidate_id."-three"."*";
    $filenameC = "uploads/".$candidate_id."-three"."*";
    $fileinfoC = glob($filenameC);
    $fileextC = explode(".", $fileinfoC[0]);
    $fileactualextC = $fileextC[1];
    // $fileC = "../../uploads/resumes/".$candidate_id."-three".".".$fileactualextC;
    $fileC = "uploads/".$candidate_id."-three".".".$fileactualextC;
}

// Delete files
if (isset($_POST['resume-one-delete-button'])) {
    if (!unlink($fileA)) {
        echo $fileactualextA." was not deleted!";
    } else {
        echo "File was deleted!";
        // Rename existing files to fill in gaps, if any are present
        if ($hastwo == 1) 
        {
            
            // rename("../../uploads/resumes/".$candidate_id."-two".".".$fileactualextB, "../../uploads/resumes/".$candidate_id."-one".".".$fileactualextB);
            rename("uploads/".$candidate_id."-two".".".$fileactualextB, "uploads/".$candidate_id."-one".".".$fileactualextB);
            if ($hasthree == 1) 
            {
                // rename("../../uploads/resumes/".$candidate_id."-three".".".$fileactualextC, "../../uploads/resumes/".$candidate_id."-two".".".$fileactualextC);
                rename("uploads/".$candidate_id."-three".".".$fileactualextC, "uploads/".$candidate_id."-two".".".$fileactualextC);
                mysqli_query($jobConn, "UPDATE resume SET has_resume_three = 0 WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
                mysqli_query($jobConn, "UPDATE resume SET resume_one_name = '$titleTwo' WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
                mysqli_query($jobConn, "UPDATE resume SET resume_two_name = '$titleThree' WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
                mysqli_query($jobConn, "UPDATE resume SET resume_three_name = 'My Resume Three' WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
            } 
            else 
            {
                mysqli_query($jobConn, "UPDATE resume SET has_resume_two = 0 WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
                mysqli_query($jobConn, "UPDATE resume SET resume_one_name = '$titleTwo' WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
                mysqli_query($jobConn, "UPDATE resume SET resume_two_name = 'My Resume Two' WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
            }
        } 
        else 
        {
            mysqli_query($jobConn, "UPDATE resume SET has_resume_one = 0 WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
            mysqli_query($jobConn, "UPDATE resume SET resume_one_name = 'My Resume One' WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
        }
    }
    

}

if (isset($_POST['resume-two-delete-button'])) {
    if (!unlink($fileB)) {
        echo $fileactualextB." was not deleted!";
    } else {
        echo "File was deleted!";
        if ($hasthree == 1) {
            // rename("../../uploads/resumes/".$candidate_id."-three".".".$fileactualextC, "../../uploads/resumes/".$candidate_id."-two".".".$fileactualextC);
            rename("uploads/".$candidate_id."-three".".".$fileactualextC, "uploads/".$candidate_id."-two".".".$fileactualextC);
            mysqli_query($jobConn, "UPDATE resume SET has_resume_three = 0 WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
            mysqli_query($jobConn, "UPDATE resume SET resume_two_name = '$titleThree' WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
            mysqli_query($jobConn, "UPDATE resume SET resume_three_name = 'My Resume Three' WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
        } else {
            mysqli_query($jobConn, "UPDATE resume SET has_resume_two = 0 WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
            mysqli_query($jobConn, "UPDATE resume SET resume_two_name = 'My Resume Two' WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
        }
    }
    echo $fileB;

    
}

if (isset($_POST['resume-three-delete-button'])) {
    if (!unlink($fileC)) {
        echo $fileactualextC." was not deleted!";
    } else {
        echo "File was deleted!";
        mysqli_query($jobConn, "UPDATE resume SET has_resume_three = 0 WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
        mysqli_query($jobConn, "UPDATE resume SET resume_three_name = 'My Resume Three' WHERE candidate_id = $candidate_id") or die("Error: " . mysqli_error($jobConn));
    }
    
}
header("Location: ../../candidate-profile?delete=resone&id=".$user_id);

// print_r($file);
?>