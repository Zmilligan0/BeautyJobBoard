<?php
//$accl = "2,0";
$pageTitle = "Apply Successfull";
include("includes/job_connect.php");
include("includes/utils.php");
include("includes/header.php");


$job_id = "";
if (isset($_GET['id'])) {
    $job_id = $_GET['id'];
} 


$sql= "SELECT candidate_id, first_name, last_name From candidate WHERE user_id = '$_SESSION[user_id]'";
$list = $jobConn->query($sql);
while ($row = $list->fetch_assoc()){ 
    $candidate_id = $row['candidate_id'];
}


$job_result = mysqli_query($jobConn, "SELECT title from job WHERE job_id = '$job_id' ") or die(mysqli_error($jobConn));
$job_row = mysqli_fetch_array($job_result);

$employer_result = mysqli_query($jobConn, "SELECT business_name, employer.employer_id from employer 
inner join job on employer.employer_id = job.employer_id  
WHERE job_id = '$job_id' ") or die(mysqli_error($jobConn));
$employer_row = mysqli_fetch_array($employer_result);
$employer_id = $employer_row['employer_id'];


?>

<main style="height: 100rem;">
    <div class="container mb-5 mt-5">
      
        <div class="row m-auto d-flex justify-content-center">
            <div class="card p-3 col-lg-6 mt-3 text-center d-flex justify-content-center" style="min-height: 20rem;">                                                                         
                <p class="fs-2" style="color:green;">You have successfully submitted your answers to the questions for <?php echo $job_row['title']; ?> job at <?php echo $employer_row['business_name']; ?></p>                           
            </div>
        </div>           
        
    </div> <!-- end of Container -->
</main>


<?php
include("includes/footer.php");
?>



