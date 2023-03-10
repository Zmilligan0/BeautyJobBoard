<?php
$pageTitle = "Candidate Info";
$accl = "0,2";
include("../includes/job_connect.php");
include("../includes/utils.php");
include("../includes/header.php");
?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$candidate_id = $_GET['candidate_id'];
$application_id = $_GET['application_id'];
$job_id = $_GET['job_id'];
$id = $_GET['id'];
if (!$application_id || !is_numeric($application_id)) {
    header("Location:applicant-list?id=$id");
} else {
    $sql = "UPDATE application SET status = 2 Where candidate_id = $candidate_id and application_id = $application_id";
    mysqli_query($jobConn, $sql);
}

$list_sql = "SELECT application.application_id, resume, cover_letter, application.job_id, application.candidate_id, application.employer_id, application.status, application_date, job.title, 
candidate.first_name, candidate.last_name, candidate.profile_photo, candidate.city, candidate.province, candidate.personal_description, job.title, application.application_date, 
job.description, candidate.user_id, headline, gender, skills, will_relocate
FROM application  
INNER JOIN job on application.job_id = job.job_id
INNER JOIN candidate on application.candidate_id = candidate.candidate_id
INNER JOIN experience on candidate.candidate_id = experience.candidate_id
where candidate.candidate_id = $candidate_id and application.job_id = $job_id";
$list_result = $jobConn->query($list_sql);
$row = $list_result->fetch_assoc();
?>
<style>
    .line {
        line-height: 0.5;
        font-weight: lighter;
    }

    .line1 {
        line-height: 1;
    }

    .pencil-bg {
        background-color: #eef0fc;
        color: #556ee6;
    }

    .pencil-bg:hover {
        color: #eef0fc;
        background-color: #556ee6;
    }

    .deleteTrash {
        background-color: #fef0f0;
        color: #f57575;
    }

    .deleteTrash:hover {
        background-color: #f57575;
        color: #fef0f0;
    }

    .summary_sticky {
        position: sticky;
        top: 3rem;
        height: 100vh;

    }
</style>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="../config.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="css/jordan.css" rel="stylesheet">
<main class="container">

    <div class="d-flex flex-column align-items-center">
        <div>
            <div class="mt-4 d-flex flex-column align-items-center">
                <h1><?php echo $row['first_name'] . " " . $row['last_name']; ?></h1>
                <p><?php echo $row['city'] . ", " . $row['province']; ?></p>
            </div>
        </div>
        <div class="col-lg-4 text-center">
            <a class="btn btn-sm btn-soft-primary pencil-bg col-md-4 mx-1" href="application_approve.php?candidate_id=<?php echo $candidate_id; ?>&user_id=<?php echo $id ?>&application_id=<?php echo $application_id ?>">Hire Now</a>
            <a class="btn btn-sm btn-soft-primary pencil-bg" href="../candidate-profile.php?id=<?php echo $row['user_id']; ?>">View Candidate</a>
            <a onclick="return confirm('Are you sure?'); return false;" class="btn btn-sm btn-soft-danger deleteTrash col-md-4" href="reject-applicant.php?candidate_id=<?php echo $candidate_id; ?>&user_id=<?php echo $id ?>&application_id=<?php echo $application_id ?>"> Reject</a>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-lg-3 summary_sticky">
            <div class="card">
                <div class="card-body">
                    <?php  ?>
                    <ul class="verti-timeline list-unstyled">
                        <li>
                            <h5><svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                                </svg> Credential:</h5>
                            <p class="text-muted ms-4"><?php echo $row['headline'] ?></p>
                        </li>
                        <li>
                            <h5><svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gender-ambiguous" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.5 1a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-3.45 3.45A4 4 0 0 1 8.5 10.97V13H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V14H6a.5.5 0 0 1 0-1h1.5v-2.03a4 4 0 1 1 3.471-6.648L14.293 1H11.5zm-.997 4.346a3 3 0 1 0-5.006 3.309 3 3 0 0 0 5.006-3.31z" />
                                </svg> Gender:</h5>
                            <?php if ($row['gender'] == 'F') {
                                $gender = 'Female';
                            } else {
                                $gender = 'Male';
                            }
                            ?>
                            <p class="text-muted ms-4"><?php echo $gender ?></p>
                        </li>
                        <li>
                            <h5><svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-award" viewBox="0 0 16 16">
                                    <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z" />
                                    <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z" />
                                </svg> Skills:</h5>
                            <p class="text-muted"><?php echo $row['skills'] ?></p>
                        </li>
                        <li>
                            <h5><svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                                </svg> Located:</h5>
                            <p class="text-muted ms-4"><?php echo $row['city'] . ' ' . $row['province'] ?></p>
                        </li>
                        <li>
                            <?php if ($row['will_relocate'] == 0) {
                                $will_relocate = 'No';
                            } else {
                                $will_relocate = 'Yes';
                            }
                            ?>
                            <h5><svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-globe-americas" viewBox="0 0 16 16">
                                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z" />
                                </svg> Willing to Relocate:</h5>
                            <p class="text-muted ms-4"><?php echo $will_relocate; ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Profile information -->
        <div class="d-flex flex-column flex-xl-row flex-wrap justify-content-center col-lg-9">
            <div id="bio-card" class="order-1 w-100">
                <div class="card main-card ps-4 me-xl-4 ">
                    <div class="card-body">
                        <h3 class="">Job Applied</h3>
                        <p class="text-muted"><?php echo $row['title']; ?></p>
                        <h4 class="mb-3">Resume</h4>
                        <?php
                        $myResume = explode(',', $row['resume']);
                        $resumeTitle = $myResume[0];
                        $resumeNo = $myResume[1];
                        if ($resumeNo == 1) {
                            echo '
                            <a href="../scripts/resume/uploads/' . $candidate_id . '-one.pdf">' . $resumeTitle . '</a>
                            ';
                        } else if ($resumeNo == 2) {
                            echo '
                            <a href="../scripts/resume/uploads/' . $candidate_id . '-two.pdf">' . $resumeTitle . '</a>
                            ';
                        } else {
                            echo '
                            <a href="../scripts/resume/uploads/' . $candidate_id . '-three.pdf">' . $resumeTitle . '</a>
                            ';
                        }

                        ?>
                        <h4 class="mb-3">Cover Letter</h4>
                        <p class="text-muted"><?php echo $row['cover_letter'] ?></p>

                        <h4 class="mb-3">Application Date</h4>
                        <p class="text-muted"><?php $date_posted = $row['application_date'];
                                                $format_date = date("M d, Y", strtotime($date_posted));
                                                echo $format_date; ?></p>
                        <h4 class="mb-3">Job Description</h4>
                        <div id="job_description" class="text-muted"></div>
                        <!-- Todo: add job description -->
                        <script>
                            var quill = new Quill('#job_description', {
                                theme: 'bubble',
                                readOnly: true,
                                modules: {
                                    toolbar: false
                                }
                            });
                            quill.setContents(<?php echo stripslashes($row['description']) ?>);
                        </script>
                        

                        <h3 class="mt-5 mb-4">

                            Employer Questions
                            <?php
                            $application_id = $row['application_id'];
                            $job_id = $row['job_id'];
                            $question_sql = "SELECT screening_question_answer.custom_question_id, question_type, free_form_answer, yes_no_answer, choice_answer, file_upload_answer
                            FROM screening_question 
                            INNER JOIN screening_question_answer on screening_question.custom_question_id = screening_question_answer.custom_question_id
                            where application_id = $application_id AND job_id = $job_id";
                            $question_result = $jobConn->query($question_sql);
                            ?>
                        </h3>
                        <?php
                        while ($questions = $question_result->fetch_assoc()) : ?>
                            <ul class="verti-timeline list-unstyled d-flex  ">
                                <li class="event-list w-100">
                                    <?php
                                    $custom_question_id = $questions['custom_question_id'];
                                    if ($questions['question_type'] == 1) {
                                        $question_type_sql = "SELECT * FROM free_form_question WHERE custom_question_id = $custom_question_id";
                                        $question_type_result = $jobConn->query($question_type_sql);
                                        $question_type = $question_type_result->fetch_assoc();
                                    ?>
                                        <div class="card">
                                            <h5 class="card-header"><?php echo $question_type['question_title'] ?></h5>
                                            <div class="card-body">
                                                <h6 class="card-title bold"><?php echo $question_type['question_text'] ?></h6>
                                                <p class="card-text text-muted"><?php echo $questions['free_form_answer'] ?></p>
                                            </div>
                                        </div>

                                    <?php } elseif ($questions['question_type'] == 2) {
                                        $question_type_sql = "SELECT * FROM multiple_choice_question WHERE custom_question_id = $custom_question_id";
                                        $question_type_result = $jobConn->query($question_type_sql);
                                        $question_type = $question_type_result->fetch_assoc();
                                    ?>
                                        <div class="card">
                                            <h5 class="card-header"><?php echo $question_type['question_title'] ?></h5>
                                            <div class="card-body">
                                                <h6 class="card-title bold"><?php echo $question_type['question_text'] ?></h6>
                                                <p class="card-text text-muted"><?php echo $questions['choice_answer'] ?></p>
                                            </div>
                                        </div>
                                    <?php } elseif ($questions['question_type'] == 3) {
                                        $question_type_sql = "SELECT * FROM yes_no_question WHERE custom_question_id = $custom_question_id";
                                        $question_type_result = $jobConn->query($question_type_sql);
                                        $question_type = $question_type_result->fetch_assoc(); ?>
                                        <div class="card">
                                            <h5 class="card-header"><?php echo $question_type['question_title'] ?></h5>
                                            <div class="card-body">
                                                <h6 class="card-title bold"><?php echo $question_type['question_text'] ?></h6>
                                                <?php if ($questions['yes_no_answer'] == 0) {
                                                    $yes_no_answer = "No";
                                                } else {
                                                    $yes_no_answer = "Yes";
                                                }
                                                ?>
                                                <p class="card-text text-muted"><?php echo $yes_no_answer; ?></p>
                                            </div>
                                        </div>
                                    <?php  } elseif ($questions['question_type'] == 4) {
                                        $question_type_sql = "SELECT * FROM file_upload_question WHERE custom_question_id = $custom_question_id";
                                        $question_type_result = $jobConn->query($question_type_sql);
                                        $question_type = $question_type_result->fetch_assoc();
                                    ?>
                                        <div class="card">
                                            <h5 class="card-header"><?php echo $question_type['question_title'] ?></h5>
                                            <div class="card-body">
                                                <h6 class="card-title bold"><?php echo $question_type['question_text'] ?></h6>
                                                <a class="card-text" href="../../uploads/files/<?php echo $questions['file_upload_answer'] ?>"><?php echo $questions['file_upload_answer'] ?></a>
                                            </div>
                                        </div>
                                    <?php } else {
                                        echo "Invalid";
                                    }

                                    ?>
                                </li>
                            </ul>


                            <!-- 1. free form
2. multiple choice
3.yes or no
4.upload question

1 for yes 2 for no
 -->
                        <?php endwhile ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<?php
include("../includes/no_footer.php");
?>
</script>