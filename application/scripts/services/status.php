<?php
include("../../includes/job_connect.php");
include("../../includes/utils.php");
$user = '';
if (isset($_GET['id'])) 
{
    $userId = $_GET['id'];
    $user = $res = mysqli_query($jobConn, "SELECT * FROM candidate WHERE user_id = '$userId' LIMIT 1");

    if (mysqli_num_rows($res) == 1) 
    {
        $row = mysqli_fetch_array($res);
        $candidate_id = $row['candidate_id'];
    } 
    else 
    {
        header("Location: index");
    }
}
$url = $_SERVER['REQUEST_URI'];
$url_query = parse_url($url, PHP_URL_QUERY);
$exploded_url_query = explode("=", $url_query);
$exploded_user_id = explode("&", $exploded_url_query[1]);
$user_id = $exploded_user_id[0];
// $conn = new mysqli("localhost", "root", '', "job_platform");
if (isset($_POST['save-published-button'])) 
{
    $first_name = $_POST['publish-switch'];
    if ($first_name == "on")
    {
        echo $first_name;
        mysqli_query($jobConn, "UPDATE candidate SET visibility = 1 WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
    }
    else
    {
        echo "off";
        mysqli_query($jobConn, "UPDATE candidate SET visibility = 0 WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
    }
    echo $user_id;
    header("Location: ../../candidate-profile?id=$user_id");
}

?>