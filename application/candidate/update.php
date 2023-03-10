<?php
include("../includes/job_connect.php");
include("../includes/utils.php");
$url = $_SERVER['REQUEST_URI'];
$url_query = parse_url($url, PHP_URL_QUERY);
$exploded_url_query = explode("=", $url_query);
$exploded_user_id = explode("&", $exploded_url_query[1]);
$user_id = $exploded_user_id[0];
$exp_id = $exploded_url_query[2];
// $conn = new mysqli("localhost", "root", '', "job_platform");
$result = mysqli_query($jobConn, "SELECT * FROM candidate WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
$current_user = mysqli_fetch_array($result);
$candidate_id = $current_user['candidate_id'];

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
if (isset($_POST['submitA'])) 
{
    $first_name_raw = $_POST['first-name-edit'];
    $first_name_edited = str_replace("\\", "", $first_name_raw);
    $first_name = str_replace("'", "\'", $first_name_edited);
    mysqli_query($jobConn, "UPDATE candidate SET first_name = '$first_name' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=First Name");
}

if (isset($_POST['submitB'])) 
{
    $last_name_raw = $_POST['last-name-edit'];
    $last_name_edited = str_replace("\\", "", $last_name_raw);
    $last_name = str_replace("'", "\'", $last_name_edited);
    mysqli_query($jobConn, "UPDATE candidate SET last_name = '$last_name' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Last Name");
}

if (isset($_POST['submitC'])) 
{
    $description_raw = $_POST['description-edit'];
    $description_edited = str_replace("\\", "", $description_raw);
    $description = str_replace("'", "\'", $description_edited);
    mysqli_query($jobConn, "UPDATE candidate SET personal_description = '$description' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Description");
}

if (isset($_POST['submitD'])) 
{
    $gender_raw = $_POST['gender-edit'];
    $gender_edited = str_replace("\\", "", $gender_raw);
    $gender = str_replace("'", "\'", $gender_edited);
    mysqli_query($jobConn, "UPDATE candidate SET gender = '$gender' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Gender");
}

if (isset($_POST['submitE'])) 
{
    $pronouns_raw = $_POST['pronouns-edit'];
    $pronouns_edited = str_replace("\\", "", $pronouns_raw);
    $pronouns = str_replace("'", "\'", $pronouns_edited);
    mysqli_query($jobConn, "UPDATE candidate SET pronouns = '$pronouns' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Pronouns");
}

if (isset($_POST['submitF'])) 
{
    $city_raw = $_POST['city-edit'];
    $city_edited = str_replace("\\", "", $city_raw);
    $city = str_replace("'", "\'", $city_edited);
    mysqli_query($jobConn, "UPDATE candidate SET city = '$city' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=City");
}

if (isset($_POST['submitG'])) 
{
    $province_raw = $_POST['province-edit'];
    $province_edited = str_replace("\\", "", $province_raw);
    $province = str_replace("'", "\'", $province_edited);
    mysqli_query($jobConn, "UPDATE candidate SET province = '$province' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Province");
}

if (isset($_POST['submitH'])) 
{
    $country_raw = $_POST['country-edit'];
    $country_edited = str_replace("\\", "", $country_raw);
    $country = str_replace("'", "\'", $country_edited);
    mysqli_query($jobConn, "UPDATE candidate SET country = '$country' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Country");
}

if (isset($_POST['submitI'])) 
{
    $website_raw = $_POST['website-edit'];
    $website_edited = str_replace("\\", "", $website_raw);
    $website = str_replace("'", "\'", $website_edited);
    mysqli_query($jobConn, "UPDATE candidate SET website_url = '$website' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Website");
}

if (isset($_POST['submitJ'])) 
{
    $facebook_raw = $_POST['facebook-edit'];
    $facebook_edited = str_replace("\\", "", $facebook_raw);
    $facebook = str_replace("'", "\'", $facebook_edited);
    if (str_contains($facebook, 'facebook.com/') || strlen($facebook) == 0) 
    { 
        mysqli_query($jobConn, "UPDATE candidate SET facebook = '$facebook' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
        header("Location: edit-profile?id=$user_id&success=Facebook");
    }
    else
    {
        header("Location: edit-profile?id=$user_id&failure=Facebook");
    }
    
}

if (isset($_POST['submitK'])) 
{
    $instagram_raw = $_POST['instagram-edit'];
    $instagram_edited = str_replace("\\", "", $instagram_raw);
    $instagram = str_replace("'", "\'", $instagram_edited);
    if (str_contains($instagram, 'instagram.com/') || strlen($instagram) == 0) 
    { 
        mysqli_query($jobConn, "UPDATE candidate SET instagram = '$instagram' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
        header("Location: edit-profile?id=$user_id&success=Instagram");
    }
    else
    {
        header("Location: edit-profile?id=$user_id&failure=Instagram");
    }
}

if (isset($_POST['submitL'])) 
{
    $twitter_raw = $_POST['twitter-edit'];
    $twitter_edited = str_replace("\\", "", $twitter_raw);
    $twitter = str_replace("'", "\'", $twitter_edited);
    if (str_contains($twitter, 'twitter.com/') || strlen($twitter) == 0) 
    { 
        mysqli_query($jobConn, "UPDATE candidate SET linkedin = '$twitter' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
        header("Location: edit-profile?id=$user_id&success=Twitter");
    }
    else
    {
        header("Location: edit-profile?id=$user_id&failure=Twitter");
    }
}

if (isset($_POST['submitM'])) 
{
    $tiktok_raw = $_POST['tiktok-edit'];
    $tiktok_edited = str_replace("\\", "", $tiktok_raw);
    $tiktok = str_replace("'", "\'", $tiktok_edited);
    if (str_contains($tiktok, 'tiktok.com/') || strlen($tiktok) == 0) 
    { 
        mysqli_query($jobConn, "UPDATE candidate SET tiktok = '$tiktok' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
        header("Location: edit-profile?id=$user_id&success=TikTok");
    }
    else
    {
        header("Location: edit-profile?id=$user_id&failure=TikTok");
    }
}

if (isset($_POST['submitN'])) 
{
    $youtube_raw = $_POST['youtube-edit'];
    $youtube_edited = str_replace("\\", "", $youtube_raw);
    $youtube = str_replace("'", "\'", $youtube_edited);
    if (str_contains($youtube, 'youtube.com/') || strlen($youtube) == 0) 
    { 
        mysqli_query($jobConn, "UPDATE candidate SET youtube = '$youtube' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
        header("Location: edit-profile?id=$user_id&success=YouTube");
    }
    else
    {
        header("Location: edit-profile?id=$user_id&failure=YouTube");
    }
}

if (isset($_POST['submitO'])) 
{
    $headline_raw = $_POST['headline-edit'];
    $headline_edited = str_replace("\\", "", $headline_raw);
    $headline = str_replace("'", "\'", $headline_edited);
    mysqli_query($jobConn, "UPDATE candidate SET headline = '$headline' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Headline");
}

if (isset($_POST['submitP'])) 
{
    $company_name_raw = $_POST['company-name-post'];
    $company_name_edited = str_replace("\\", "", $company_name_raw);
    $company_name = str_replace("'", "\'", $company_name_edited);
    $title_raw = $_POST['title-post'];
    $title_edited = str_replace("\\", "", $title_raw);
    $title = str_replace("'", "\'", $title_edited);
    $start_date = $_POST['start-date-post'];
    $end_date = $_POST['end-date-post'];
    $description_raw = $_POST['description-post'];
    $description_edited = str_replace("\\", "", $description_raw);
    $description = str_replace("'", "\'", $description_edited);
    $employment_type = $_POST['employment-type-post'];
    $city_raw = $_POST['city-post'];
    $city_edited = str_replace("\\", "", $city_raw);
    $city = str_replace("'", "\'", $city_edited);
    $province_raw = $_POST['province-post'];
    $province_edited = str_replace("\\", "", $province_raw);
    $province = str_replace("'", "\'", $province_edited);
    $country_raw = $_POST['country-post'];
    $country_edited = str_replace("\\", "", $country_raw);
    $country = str_replace("'", "\'", $country_edited);
    if ($start_date == null && $end_date == null)
    {
        mysqli_query($jobConn, "INSERT INTO experience (company_name, title, description, employment_type, city, province, country, candidate_id) VALUES ('$company_name', '$title', '$description', '$employment_type', '$city', '$province', '$country', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($start_date == null)
    {
        mysqli_query($jobConn, "INSERT INTO experience (company_name, title, end_date, description, employment_type, city, province, country, candidate_id) VALUES ('$company_name', '$title', '$end_date', '$description', '$employment_type', '$city', '$province', '$country', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($end_date == null)
    {
        mysqli_query($jobConn, "INSERT INTO experience (company_name, title, start_date, description, employment_type, city, province, country, candidate_id) VALUES ('$company_name', '$title', '$start_date', '$description', '$employment_type', '$city', '$province', '$country', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    else
    {
        mysqli_query($jobConn, "INSERT INTO experience (company_name, title, start_date, end_date, description, employment_type, city, province, country, candidate_id) VALUES ('$company_name', '$title', '$start_date', '$end_date', '$description', '$employment_type', '$city', '$province', '$country', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    header("Location: edit-profile?id=$user_id&add=job");
}

if (isset($_POST['submitQ'])) 
{
    $degree_raw = $_POST['degree-post'];
    $degree_edited = str_replace("\\", "", $degree_raw);
    $degree = str_replace("'", "\'", $degree_edited);
    $institution_raw = $_POST['institution-post'];
    $institution_edited = str_replace("\\", "", $institution_raw);
    $institution = str_replace("'", "\'", $institution_edited);
    $field_raw = $_POST['field-post'];
    $field_edited = str_replace("\\", "", $field_raw);
    $field = str_replace("'", "\'", $field_edited);
    $start_date = $_POST['education-start-date-post'];
    $end_date = $_POST['education-end-date-post'];
    $gpa = $_POST['gpa-post'];
    if ($start_date == null && $end_date == null && $gpa == null)
    {
        mysqli_query($jobConn, "INSERT INTO education (degree_type, institution_name, field, candidate_id) VALUES ('$degree', '$institution', '$field', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($start_date == null && $end_date == null)
    {
        mysqli_query($jobConn, "INSERT INTO education (degree_type, institution_name, field, gpa, candidate_id) VALUES ('$degree', '$institution', '$field', '$gpa', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($start_date == null && $gpa == null)
    {
        mysqli_query($jobConn, "INSERT INTO education (degree_type, institution_name, field, end_date, candidate_id) VALUES ('$degree', '$institution', '$field', '$end_date', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($start_date == null)
    {
        mysqli_query($jobConn, "INSERT INTO education (degree_type, institution_name, field, end_date, gpa, candidate_id) VALUES ('$degree', '$institution', '$field', '$end_date', '$gpa', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($end_date == null && $gpa == null)
    {
        mysqli_query($jobConn, "INSERT INTO education (degree_type, institution_name, field, start_date, candidate_id) VALUES ('$degree', '$institution', '$field', '$start_date', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($end_date == null)
    {
        mysqli_query($jobConn, "INSERT INTO education (degree_type, institution_name, field, start_date, gpa, candidate_id) VALUES ('$degree', '$institution', '$field', '$start_date', '$gpa', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($gpa == null)
    {
        mysqli_query($jobConn, "INSERT INTO education (degree_type, institution_name, field, start_date, end_date, candidate_id) VALUES ('$degree', '$institution', '$field', '$start_date', '$end_date', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    else
    {
        mysqli_query($jobConn, "INSERT INTO education (degree_type, institution_name, field, start_date, end_date, gpa, candidate_id) VALUES ('$degree', '$institution', '$field', '$start_date', '$end_date', '$gpa', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    
    header("Location: edit-profile?id=$user_id&add=education");
}

if (isset($_POST['submitR'])) 
{
    $nameEdit_raw = $_POST['name-edit-edit'];
    $nameEdit_edited = str_replace("\\", "", $nameEdit_raw);
    $nameEdit = str_replace("'", "\'", $nameEdit_edited);
    mysqli_query($jobConn, "UPDATE experience SET company_name = '$nameEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Company Name");
}

if (isset($_POST['submitS'])) 
{
    $titleEdit_raw = $_POST['title-edit-edit'];
    $titleEdit_edited = str_replace("\\", "", $titleEdit_raw);
    $titleEdit = str_replace("'", "\'", $titleEdit_edited);
    mysqli_query($jobConn, "UPDATE experience SET title = '$titleEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Title");
}

if (isset($_POST['submitT'])) 
{
    $workStartDateEdit = $_POST['work-start-date-edit-edit'];
    echo $workStartDateEdit;
    mysqli_query($jobConn, "UPDATE experience SET start_date = '$workStartDateEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Start Date");
}

if (isset($_POST['submitU'])) 
{
    $workEndDateEdit = $_POST['work-end-date-edit-edit'];
    mysqli_query($jobConn, "UPDATE experience SET end_date = '$workEndDateEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=End Date");
}

if (isset($_POST['submitV'])) 
{
    $descriptionEdit_raw = $_POST['description-edit-edit'];
    $descriptionEdit_edited = str_replace("\\", "", $descriptionEdit_raw);
    $descriptionEdit = str_replace("'", "\'", $descriptionEdit_edited);
    mysqli_query($jobConn, "UPDATE experience SET description = '$descriptionEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Description");
}

if (isset($_POST['submitW'])) 
{
    $employmentTypeEdit_raw = $_POST['employment-type-edit-edit'];
    $employmentTypeEdit_edited = str_replace("\\", "", $employmentTypeEdit_raw);
    $employmentTypeEdit = str_replace("'", "\'", $employmentTypeEdit_edited);
    mysqli_query($jobConn, "UPDATE experience SET employment_type = '$employmentTypeEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Employment Type");
}

if (isset($_POST['submitX'])) 
{
    $cityEdit_raw = $_POST['city-edit-edit'];
    $cityEdit_edited = str_replace("\\", "", $cityEdit_raw);
    $cityEdit = str_replace("'", "\'", $cityEdit_edited);
    mysqli_query($jobConn, "UPDATE experience SET city = '$cityEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=City");
}

if (isset($_POST['submitY'])) 
{
    $provinceEdit_raw = $_POST['province-edit-edit'];
    $provinceEdit_edited = str_replace("\\", "", $provinceEdit_raw);
    $provinceEdit = str_replace("'", "\'", $provinceEdit_edited);
    mysqli_query($jobConn, "UPDATE experience SET province = '$provinceEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Province");
}

if (isset($_POST['submitZ'])) 
{
    $countryEdit_raw = $_POST['country-edit-edit'];
    $countryEdit_edited = str_replace("\\", "", $countryEdit_raw);
    $countryEdit = str_replace("'", "\'", $countryEdit_edited);
    mysqli_query($jobConn, "UPDATE experience SET country = '$countryEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Country");
}

if (isset($_POST['submitAA'])) 
{
    $degreeTypeEdit_raw = $_POST['degree-type-edit-edit'];
    $degreeTypeEdit_edited = str_replace("\\", "", $degreeTypeEdit_raw);
    $degreeTypeEdit = str_replace("'", "\'", $degreeTypeEdit_edited);
    mysqli_query($jobConn, "UPDATE education SET degree_type = '$degreeTypeEdit' WHERE education_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Degree Type");
}

if (isset($_POST['submitAB'])) 
{
    $institutionNameEdit_raw = $_POST['institution-name-edit-edit'];
    $institutionNameEdit_edited = str_replace("\\", "", $institutionNameEdit_raw);
    $institutionNameEdit = str_replace("'", "\'", $institutionNameEdit_edited);
    mysqli_query($jobConn, "UPDATE education SET institution_name = '$institutionNameEdit' WHERE education_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Institution");
}

if (isset($_POST['submitAC'])) 
{
    $fieldEdit_raw = $_POST['field-edit-edit'];
    $fieldEdit_edited = str_replace("\\", "", $fieldEdit_raw);
    $fieldEdit = str_replace("'", "\'", $fieldEdit_edited);
    mysqli_query($jobConn, "UPDATE education SET field = '$fieldEdit' WHERE education_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Field");
}

if (isset($_POST['submitAD'])) 
{
    $schoolStartDateEdit = $_POST['school-start-date-edit-edit'];
    mysqli_query($jobConn, "UPDATE education SET start_date = '$schoolStartDateEdit' WHERE education_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=Start Date");
}

if (isset($_POST['submitAE'])) 
{
    $schoolEndDateEdit = $_POST['school-end-date-edit-edit'];
    mysqli_query($jobConn, "UPDATE education SET end_date = '$schoolEndDateEdit' WHERE education_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=End Date");
}

if (isset($_POST['submitAF'])) 
{
    $gpa = $_POST['gpa-edit-edit'];
    mysqli_query($jobConn, "UPDATE education SET gpa = '$gpa' WHERE education_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&success=GPA");
}

if (isset($_POST['submitAG'])) 
{
    mysqli_query($jobConn, "DELETE FROM experience WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&delete=job");
}

if (isset($_POST['submitAH'])) 
{
    mysqli_query($jobConn, "DELETE FROM education WHERE education_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-profile?id=$user_id&delete=education");
}
?>