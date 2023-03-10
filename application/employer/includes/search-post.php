<?php 

if (isset($_GET['id'])){
    $_GET['id'];
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}


if (isset($_GET['job-search'])){
    $job_search = $_GET['job-search'];
    $search_part1 = "AND (title LIKE '%$job_search%' OR description LIKE '%$job_search%')";
} else {
    $job_search = "";
    $search_part1 = "";
}

if (isset($_GET['job_types'])){
    $job_types = $_GET['job_types'];
    $search_part2 = "AND (employment_type LIKE '%$job_types%')";
} else {
    $job_types = "";
    $search_part2 = "";
}


if (isset($_GET['status-search'])){
    $status_search = $_GET['status-search'];
    $search_part3 = "AND (status LIKE '%$status_search%')";
} else {
    $status_search = "";
    $search_part3 = "";
}

if (isset($_GET['posted_by'])){
    $posted_by = $_GET['posted_by'];
    $search_part4 = "AND (post_date Like '%$posted_by%')";
} else {
    $posted_by = "";
    $search_part4 = "";
}

if (isset($_GET['expiry_by'])){
    $expiry_by = $_GET['expiry_by'];
    $search_part5 = "AND (expiry_date Like '%$expiry_by%')";
} else {
    $expiry_by = "";
    $search_part5 = "";
}

?>