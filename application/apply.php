<?php
//$accl = "2,0";
$pageTitle = "Apply the Position";
include("includes/job_connect.php");
include("includes/utils.php");
include("includes/header.php");


$job_id = "";
if (isset($_GET['id'])) {
    $job_id = $_GET['id'];
} else {
    header('Location: search');
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


 $resume_result = mysqli_query($jobConn, "SELECT * from resume WHERE candidate_id = '$candidate_id' ") or die(mysqli_error($jobConn));
// //$resume_row1 = mysqli_fetch_array($resume_result);

$cover_letter = "";
$resume = "";
$submitMsg = "";
$msgPreSuccess = "\n<div class=\"alert alert-primary\" role=\"alert\" style=\"font-size:0.75rem;\" >";
$msgPost = "\n</div>\n";
$application_id = "";
$displayNext = false;

if (isset($_POST['submit'])) {
    $displayNext = true;
    $cover_letter = strip_tags(trim($_POST['cover_letter']));
    
    $resume = $_POST['resume'];

    $submitMsg = "Successfully sent resume and cover letter. Please answer to the employer questions.";
    mysqli_query($jobConn, "INSERT INTO application (resume, cover_letter, job_id, candidate_id, employer_id, status, application_date) VALUES('$resume', '$cover_letter', '$job_id', '$candidate_id', '$employer_id', default, default)") or die(mysqli_error($jobConn));

    $application_result = mysqli_query($jobConn, "SELECT * from application WHERE 
    candidate_id = '$candidate_id' And 
    job_id = '$job_id' And
    employer_id = '$employer_id'") or die(mysqli_error($jobConn));
    $application_row = mysqli_fetch_array($application_result);
    $application_id = $application_row['application_id'];
    //echo $application_id;
           
}


?>

<main>
    <div class="container mb-5">
        <h1 class="text-center mt-3"><?php echo $job_row['title']; ?></h1>
        <h4 class="text-center mt-3 mb-3"><?php echo $employer_row['business_name']; ?></h4>

        <form  method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
            <div class="row m-auto d-flex justify-content-center">
                <div class="card p-3 col-lg-6 mt-3">
                    <div class="form-group input-group-sm  mb-3">                       
                        <!-- <select name="fileType" id="fileType" class="form-select">
                            <option value= "">--- Please select file type ---</option>
                            <option value="resume">Resume</option>
                            <option value="cover_letter">Cover Letter</option>
                        </select>
                        <div class="p-0 mb-4">
                            <label for="formFile" class="form-label mt-4">Upload your file</label>
                            <input class="form-control text-muted" type="file" name="file" id="file">
                        </div>
                        <div class="col-sm-5 mt-3 mb-4 d-flex flex-row-reverse flex-column-reverse">
                            <button class="btn btn-md w-100 btn-primary desktop-view-button" type="submit" name="sybmit"
                                id="filter">Attach document
                            </button>
                        </div>  -->                       
                        <label class="text-muted mb-2" for="description">Please write your Cover Letter below</label>
                        <textarea class="form-control" style="min-height: 7rem;"  id="cover_letter" name="cover_letter"><?php if(isset($cover_letter)) {echo $cover_letter;} ?></textarea>
                        
                    </div>
                    <div class="">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Select</th>
                                    <th scope="col">Resume Name</th>
                                    <th scope="col">Type</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                // $files = scandir('uploads/files');
                                // foreach($files as $file){
                                //     if($file != '.' && $file != '..'){
                                //     echo '<tr>';
                                //         echo '<td>' . $file . '</td>';
                                //         echo '<td>' . pathinfo($file, PATHINFO_EXTENSION) . '</td>';
                                //         echo '<td>' . date("F d, Y h:i:s A", filemtime('uploads/files/' . $file)) . '</td>';
                                //         echo '<td><a href="delete.php?file=' . $file . '">Delete</a></td>';
                                //         echo '</tr>';
                                //     }
                                // }
                            ?>
                            <?php while($resume_row = mysqli_fetch_array($resume_result)):?>
                                <?php if ($resume_row['has_resume_one'] == 1) : ?>
                                    <tr>                                   
                                        <td><input type="radio" id="resume1" name="resume" value="<?php echo $resume_row['resume_one_name']; ?>,1"  checked="checked" ></td>
                                        <td><label for="resume"><?php echo $resume_row['resume_one_name']; ?></label></td>
                                        <td>Resume</td>
                                    </tr> 
                                <?php endif ?>
                                <?php if ($resume_row['has_resume_two'] == 1) : ?>
                                    <tr>                                   
                                        <td><input type="radio" id="resume2" name="resume" value="<?php echo $resume_row['resume_two_name']; ?>,2" ></td>
                                        <td><label for="resume"><?php echo $resume_row['resume_two_name']; ?></label></td>
                                        <td>Resume</td>
                                    </tr> 
                                <?php endif ?>
                                <?php if ($resume_row['has_resume_three'] == 1) : ?>
                                    <tr>                                   
                                        <td><input type="radio" id="resume3" name="resume" value="<?php echo $resume_row['resume_three_name']; ?>,3" ></td>
                                        <td><label for="resume"><?php echo $resume_row['resume_three_name']; ?></label></td>
                                        <td>Resume</td>
                                    </tr> 
                                <?php endif ?>
                            <?php endwhile;?>

				
                            </tbody>
                        </table>
                        <!-- <div class="mb-1">
                            <label for="exampleFormControlTextarea1" class="form-label"></label>
                            <textarea style="min-height: 10rem;" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write your cover letter here"></textarea>
                        </div> -->
                    </div>
                    
                    <div>
                    <?php
                        if ($submitMsg) {
                            echo $msgPreSuccess. $submitMsg. $msgPost;
                        }
                        // echo $displayNext;
                    ?>
                    </div>
                    <div class=" mt-3 d-flex justify-content-between">
                        <div>
                            <?php 
                            $resume_result1 = mysqli_query($jobConn, "SELECT * from resume WHERE candidate_id = '$candidate_id' ") or die(mysqli_error($jobConn));
                            $resume_row2 = mysqli_fetch_array($resume_result1); ?>

                            <?php if($resume_row2 !=""):?>
                            <button class="btn btn-md w-100 btn-primary desktop-view-button" type="submit" name="submit"
                                id="submit">Apply</a>
                            </button>
                            <?php else:?>
                            <?php
                                $submitMsg2 ="You should first upload your resume on your profile";
                                if ($submitMsg2) {
                                    echo $msgPreSuccess. $submitMsg2. $msgPost;
                                }                               
                            ?>
                            <button class="btn btn-md w-100 btn-primary desktop-view-button" type="submit" name="submit"
                                id="submit" disabled>Apply</a>
                            </button>
                            <?php endif;?>
                        </div>
                        <?php if ($displayNext == 1) : ?>
                        <div>
                            <a href="candidate-answer?id=<?php echo $application_id ?>" class="btn btn-md w-100 btn-primary desktop-view-button" >Screening questions</a>     
                        </div>
                        <?php endif ?>
                    </div> 
                </div>
            </div>           
        </form> 
    </div> <!-- end of Container -->
</main>




<?php
include("includes/footer.php");
?>



