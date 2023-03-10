<?php 
if (isset($_GET['job-search'])){
    $job_search = $_GET['job-search'];
    $search_part1 = "AND (job.title LIKE '%$job_search%' OR description LIKE '%$job_search%')";
} else {
    $job_search = "";
    $search_part1 = "";
}

?>
