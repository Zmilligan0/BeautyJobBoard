<?php
include("../includes/job_connect.php");
include("../includes/utils.php");
$url = $_SERVER['REQUEST_URI'];
$url_query = parse_url($url, PHP_URL_QUERY);
$exploded_url_query = explode("=", $url_query);
$user_id = $exploded_url_query[1];
// $conn = new mysqli("localhost", "root", '', "job_platform");
$result = mysqli_query($jobConn, "SELECT * FROM employer WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
$current_user = mysqli_fetch_array($result);

if (isset($_GET['id'])) 
{
    $userId = $_GET['id'];
    $res = mysqli_query($jobConn, "SELECT * FROM employer WHERE user_id = '$userId' LIMIT 1");
    if (mysqli_num_rows($res) == 1) 
    {
        $row = mysqli_fetch_array($res);
        $employer_id = $row['employer_id'];
    }
    else 
    {
        header("Location: index");
    }
}
if (isset($_POST['submitA'])) {
    $company_name_raw = $_POST['name-edit'];
    $company_name_edited = str_replace("\\", "", $company_name_raw);
    $company_name = str_replace("'", "\'", $company_name_edited);
    mysqli_query($jobConn, "UPDATE employer SET business_name = '$company_name' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Company Name");
}

if (isset($_POST['submitB'])) {
    $industry_raw = $_POST['industry-edit'];
    $industry_edited = str_replace("\\", "", $industry_raw);
    $industry = str_replace("'", "\'", $industry_edited);
    mysqli_query($jobConn, "UPDATE employer SET business_category = '$industry' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Industry");
}

if (isset($_POST['submitC'])) {
    $description_raw = $_POST['description-edit'];
    $description_edited = str_replace("\\", "", $description_raw);
    $description = str_replace("'", "\'", $description_edited);
    mysqli_query($jobConn, "UPDATE employer SET description = '$description' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Description");
}

if (isset($_POST['submitD'])) {
    $address_raw = $_POST['address-edit'];
    $address_edited = str_replace("\\", "", $address_raw);
    $address = str_replace("'", "\'", $address_edited);
    mysqli_query($jobConn, "UPDATE employer SET address = '$address' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Address");
}

if (isset($_POST['submitE'])) {
    $city_raw = $_POST['city-edit'];
    $city_edited = str_replace("\\", "", $city_raw);
    $city = str_replace("'", "\'", $city_edited);
    mysqli_query($jobConn, "UPDATE employer SET city = '$city' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=City");
}

if (isset($_POST['submitF'])) {
    $province_raw = $_POST['province-edit'];
    $province_edited = str_replace("\\", "", $province_raw);
    $province = str_replace("'", "\'", $province_edited);
    mysqli_query($jobConn, "UPDATE employer SET province = '$province' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Province");
}

if (isset($_POST['submitG'])) {
    $postal_raw = $_POST['postal-edit'];
    $postal_edited = str_replace("\\", "", $postal_raw);
    $postal = str_replace("'", "\'", $postal_edited);
    mysqli_query($jobConn, "UPDATE employer SET postal_code = '$postal' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Postal Code");
}

if (isset($_POST['submitH'])) {
    $website_raw = $_POST['website-edit'];
    $website_edited = str_replace("\\", "", $website_raw);
    $website = str_replace("'", "\'", $website_edited);
    mysqli_query($jobConn, "UPDATE employer SET website_url = '$website' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Website");
}

if (isset($_POST['submitI'])) {
    $facebook_raw = $_POST['facebook-edit'];
    $facebook_edited = str_replace("\\", "", $facebook_raw);
    $facebook = str_replace("'", "\'", $facebook_edited);
    if (str_contains($facebook, 'facebook.com/') || strlen($facebook) == 0) 
    { 
        mysqli_query($jobConn, "UPDATE employer SET facebook = '$facebook' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
        header("Location: edit-profile?id=$user_id&success=Facebook");
    }
    else
    {
        header("Location: edit-profile?id=$user_id&failure=Facebook");
    }
}

if (isset($_POST['submitJ'])) {
    $instagram_raw = $_POST['instagram-edit'];
    $instagram_edited = str_replace("\\", "", $instagram_raw);
    $instagram = str_replace("'", "\'", $instagram_edited);
    if (str_contains($instagram, 'instagram.com/') || strlen($instagram) == 0) 
    { 
        mysqli_query($jobConn, "UPDATE employer SET instagram = '$instagram' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
        header("Location: edit-profile?id=$user_id&success=Instagram");
    }
    else
    {
        header("Location: edit-profile?id=$user_id&failure=Instagram");
    }
}

if (isset($_POST['submitK'])) {
    $twitter_raw = $_POST['twitter-edit'];
    $twitter_edited = str_replace("\\", "", $twitter_raw);
    $twitter = str_replace("'", "\'", $twitter_edited);
    if (str_contains($twitter, 'twitter.com/') || strlen($twitter) == 0) 
    { 
        mysqli_query($jobConn, "UPDATE employer SET linkedin = '$twitter' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
        header("Location: edit-profile?id=$user_id&success=Twitter");
    }
    else
    {
        header("Location: edit-profile?id=$user_id&failure=Twitter");
    }
}

if (isset($_POST['submitL'])) {
    $tiktok_raw = $_POST['tiktok-edit'];
    $tiktok_edited = str_replace("\\", "", $tiktok_raw);
    $tiktok = str_replace("'", "\'", $tiktok_edited);
    if (str_contains($tiktok, 'tiktok.com/') || strlen($tiktok) == 0) 
    { 
        mysqli_query($jobConn, "UPDATE employer SET tiktok = '$tiktok' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
        header("Location: edit-profile?id=$user_id&success=TikTok");
    }
    else
    {
        header("Location: edit-profile?id=$user_id&failure=TikTok");
    }
}

if (isset($_POST['submitM'])) {
    $youtube_raw = $_POST['youtube-edit'];
    $youtube_edited = str_replace("\\", "", $youtube_raw);
    $youtube = str_replace("'", "\'", $youtube_edited);
    if (str_contains($youtube, 'youtube.com/') || strlen($youtube) == 0) 
    { 
        mysqli_query($jobConn, "UPDATE employer SET youtube = '$youtube' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
        header("Location: edit-profile?id=$user_id&success=YouTube");
    }
    else
    {
        header("Location: edit-profile?id=$user_id&failure=YouTube");
    }
}

if (isset($_POST['submitN'])) {
    $video_raw = $_POST['video-edit'];
    $video_edited = str_replace("\\", "", $video_raw);
    $video = str_replace("'", "\'", $video_edited);
    if (str_contains($video, 'youtube.com/watch?v=') || str_contains($video, 'youtube.com/shorts/') || strlen($video) == 0) 
    { 
        mysqli_query($jobConn, "UPDATE employer SET video = '$video' WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
        header("Location: edit-profile?id=$user_id&success=YouTube Video");
    }
    else
    {
        header("Location: edit-profile?id=$user_id&failure=YouTube Video");
    }

}
?>