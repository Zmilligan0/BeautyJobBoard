<?php 


if (isset($_GET['id'])){
    $_GET['id'];
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

if (isset($_GET['applicant-search'])) {
    $applicant_search = $_GET['applicant-search'];
    $search_part1 = "AND (first_name LIKE '%$applicant_search%' OR last_name LIKE '%$applicant_search%' OR job.title LIKE '%$applicant_search%')";
} else {
    $$applicant_search = "";
    $search_part1 = "";
}

if (isset($_GET['date-apply'])) {
    $date_apply = $_GET['date-apply'];
    $date_search = "AND (application_date LIKE '%$date_apply%')";
} else {
    $date_apply = "";
    $date_search = "";
}

?>