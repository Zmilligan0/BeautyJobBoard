<?php
$accl = "0,0";
include("../includes/job_connect.php");
include("../includes/utils.php");
$url = $_SERVER['REQUEST_URI'];
$url_query = parse_url($url, PHP_URL_QUERY);
$exploded_url_query = explode("=", $url_query);
$exploded_candidate_id = explode("&", $exploded_url_query[1]);
$candidateID = $exploded_candidate_id[0];
$exp_id = $exploded_url_query[2];
$result = mysqli_query($jobConn, "SELECT * FROM candidate WHERE candidate_id = '$candidateID'") or die("Error: " . mysqli_error($jobConn));
$current_user = mysqli_fetch_array($result);
if (isset($_POST['submitA'])) {
    $first_name = $_POST['first-name-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET first_name = '$first_name' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitB'])) {
    $last_name = $_POST['last-name-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET last_name = '$last_name' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitC'])) {
    $description = $_POST['description-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET personal_description = '$description' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitD'])) {
    $gender = $_POST['gender-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET gender = '$gender' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitE'])) {
    $pronouns = $_POST['pronouns-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET pronouns = '$pronouns' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitF'])) {
    $city = $_POST['city-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET city = '$city' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitG'])) {
    $province = $_POST['province-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET province = '$province' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitH'])) {
    $country = $_POST['country-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET country = '$country' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitI'])) {
    $website = $_POST['website-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET website_url = '$website' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitJ'])) {
    $facebook = $_POST['facebook-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET facebook = '$facebook' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitK'])) {
    $instagram = $_POST['instagram-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET instagram = '$instagram' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitL'])) {
    $twitter = $_POST['twitter-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET linkedin = '$twitter' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitM'])) {
    $tiktok = $_POST['tiktok-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET tiktok = '$tiktok' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitN'])) {
    $youtube = $_POST['youtube-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET youtube = '$youtube' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitO'])) {
    $headline = $_POST['headline-edit'];
    mysqli_query($jobConn, "UPDATE candidate SET headline = '$headline' WHERE candidate_id = $candidateID") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitP'])) {
    $company_name = $_POST['company-name-post'];
    $title = $_POST['title-post'];
    $start_date = $_POST['start-date-post'];
    $end_date = $_POST['end-date-post'];
    $description = $_POST['description-post'];
    $employment_type = $_POST['employment-type-post'];
    $city = $_POST['city-post'];
    $province = $_POST['province-post'];
    $country = $_POST['country-post'];
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
    header("Location: editcandidate");
}

if (isset($_POST['submitQ'])) {
    $degree = $_POST['degree-post'];
    $institution = $_POST['institution-post'];
    $field = $_POST['field-post'];
    $start_date = $_POST['education-start-date-post'];
    $end_date = $_POST['education-end-date-post'];
    $gpa = $_POST['gpa-post'];
    if ($start_date == null && $end_date == null)
    {
        mysqli_query($jobConn, "INSERT INTO education (degree_type, institution_name, field, gpa, candidate_id) VALUES ('$degree', '$institution', '$field', '$gpa', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($start_date == null)
    {
        mysqli_query($jobConn, "INSERT INTO education (degree_type, institution_name, field, end_date, gpa, candidate_id) VALUES ('$degree', '$institution', '$field', '$end_date', '$gpa', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($end_date == null)
    {
        mysqli_query($jobConn, "INSERT INTO education (degree_type, institution_name, field, start_date, gpa, candidate_id) VALUES ('$degree', '$institution', '$field', '$start_date', '$gpa', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    else
    {
        mysqli_query($jobConn, "INSERT INTO education (degree_type, institution_name, field, start_date, end_date, gpa, candidate_id) VALUES ('$degree', '$institution', '$field', '$start_date', '$end_date', '$gpa', '$candidate_id')") or die("Error: " . mysqli_error($jobConn));
    }
    
    header("Location: editcandidate");
}

if (isset($_POST['submitR'])) {
    $nameEdit = $_POST['name-edit-edit'];
    mysqli_query($jobConn, "UPDATE experience SET company_name = '$nameEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitS'])) {
    $titleEdit = $_POST['title-edit-edit'];
    mysqli_query($jobConn, "UPDATE experience SET title = '$titleEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitT'])) {
    $workStartDateEdit = $_POST['work-start-date-edit-edit'];
    echo $workStartDateEdit;
    mysqli_query($jobConn, "UPDATE experience SET start_date = '$workStartDateEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitU'])) {
    $workEndDateEdit = $_POST['work-end-date-edit-edit'];
    mysqli_query($jobConn, "UPDATE experience SET end_date = '$workEndDateEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitV'])) {
    $descriptionEdit = $_POST['description-edit-edit'];
    mysqli_query($jobConn, "UPDATE experience SET description = '$descriptionEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitW'])) {
    $employmentTypeEdit = $_POST['employment-type-edit-edit'];
    mysqli_query($jobConn, "UPDATE experience SET employment_type = '$employmentTypeEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitX'])) {
    $cityEdit = $_POST['city-edit-edit'];
    mysqli_query($jobConn, "UPDATE experience SET city = '$cityEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitY'])) {
    $provinceEdit = $_POST['province-edit-edit'];
    mysqli_query($jobConn, "UPDATE experience SET province = '$provinceEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitZ'])) {
    $countryEdit = $_POST['country-edit-edit'];
    mysqli_query($jobConn, "UPDATE experience SET country = '$countryEdit' WHERE experience_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitAA'])) {
    $degreeTypeEdit = $_POST['degree-type-edit-edit'];
    mysqli_query($jobConn, "UPDATE education SET degree_type = '$degreeTypeEdit' WHERE education_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitAB'])) {
    $institutionNameEdit = $_POST['institution-name-edit-edit'];
    mysqli_query($jobConn, "UPDATE education SET institution_name = '$institutionNameEdit' WHERE education_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitAC'])) {
    $fieldEdit = $_POST['field-edit-edit'];
    mysqli_query($jobConn, "UPDATE education SET field = '$fieldEdit' WHERE education_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitAD'])) {
    $schoolStartDateEdit = $_POST['school-start-date-edit-edit'];
    mysqli_query($jobConn, "UPDATE education SET start_date = '$schoolStartDateEdit' WHERE education_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitAE'])) {
    $schoolEndDateEdit = $_POST['school-end-date-edit-edit'];
    mysqli_query($jobConn, "UPDATE education SET end_date = '$schoolEndDateEdit' WHERE education_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}

if (isset($_POST['submitAF'])) {
    $gpa = $_POST['gpa-edit-edit'];
    mysqli_query($jobConn, "UPDATE education SET gpa = '$gpa' WHERE education_id = $exp_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: editcandidate");
}
?>