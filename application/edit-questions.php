<?php
$pageTitle = "Edit Questions";
$accl = "0,2";
include("includes/job_connect.php");
include("includes/utils.php");
include("includes/no_header.php");
$user = '';
if (isset($_GET['id'])) 
{
    $jobId = $_GET['id'];
    // $res = mysqli_query($jobConn, "SELECT * FROM screening_question WHERE job_id = '$userId' LIMIT 1");

    // $conn = new mysqli("localhost", "root", '', "job_platform");
    // $esult = mysqli_query($conn, "SELECT * FROM screening_question WHERE job_id = '$jobId'") or die("Error: " . mysqli_error($conn));
    $result = mysqli_query($jobConn, "SELECT * FROM screening_question WHERE job_id = $jobId") or die("Error: " . mysqli_error($jobConn));
    $free_form = mysqli_query($jobConn, "SELECT * FROM free_form_question") or die("Error: " . mysqli_error($jobConn));
    $multiple_choice = mysqli_query($jobConn, "SELECT * FROM multiple_choice_question") or die("Error: " . mysqli_error($jobConn));
    $yes_no = mysqli_query($jobConn, "SELECT * FROM yes_no_question") or die("Error: " . mysqli_error($jobConn));
    $file_upload = mysqli_query($jobConn, "SELECT * FROM file_upload_question") or die("Error: " . mysqli_error($jobConn));
    if (mysqli_num_rows($result) >= 1) 
    {
        $row = mysqli_fetch_array($result);
        // $employer_id = $row['employer_id'];
    }
    else 
    {
        // header("Location: index");
        $question_id = 0;
    }
}

echo '
<div class="row ">
<button type="button" value="1" class="btn text-white col-md m-1" style="background-color:#408BD1;" onClick="createFreeForm()">Free-Form</button>
<button type="button" value="2" class="btn text-white col-md m-1" style="background-color:#408BD1;" onClick="createMultipleChoice()">Multiple Choice</button>
<button type="button" value="3" class="btn text-white col-md m-1" style="background-color:#408BD1;" onClick="createYesNo()">Yes/No</button>
<button type="button" value="4" class="btn text-white col-md m-1" style="background-color:#408BD1;" onClick="createUploadFile()">Upload File</button>

<div id="getText" style="display: none;">
INNER TEXT
</div>
<!-- <button type="button" class="btn text-white col-md m-1" style="background-color:#408BD1;">Date</button>
<button type="button" class="btn text-white col-md m-1" style="background-color:#408BD1;">Number</button> -->
</div>
<form action="update-questions.php?id='.$jobId.'&high="+questions.length.toString() method="POST" enctype="multipart/form-data" id="my-sharona">
    <input type="submit" value="Save Changes" name="submitJ" id="title-save-button-">
</form>
';
// foreach ($free_form as $i)
// {
//     echo $i['question_title'];
// }
$noQuestions = 0;
$question_title = "";
$question = "";
$option_one = "";
$option_two = "";
$option_three = "";
$option_four = "";
$option_five = "";
$option_six = "";
if (mysqli_num_rows($result) >= 1) 
{
    foreach ($result as $fullQuestion)
    {
        $question_id = $fullQuestion['custom_question_id'];
        // $job_id = $fullQuestion['job_id'];
        $question_type = $fullQuestion['question_type'];
        // $question_title = $fullQuestion['question_title'];
        // $question = $fullQuestion['question'];
        // $noQuestions++;
    
    
        if ($question_type == 1)
        {
            foreach ($free_form as $i)
            {
                if ($i['custom_question_id'] == $question_id)
                {
                    $myQuestion = $i;
                    $question_title = $myQuestion['question_title'];
                    $question = $myQuestion['question_text'];
                }
            }
            echo '
            <div class="card mt-2" id="close" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
                <div class="card-header">
                    <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&type=1&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                        <h6 class="card-title d-inline-block col-5" id="title-display-'.$question_id.'">
                            <input class="form-control" type="text" value="'.$question_title.'" disabled>
                        </h6>
                        <h6 class="d-none" id="title-edit-'.$question_id.'">
                            <input class="form-control col-9 mb-3" type="text" name="title-edit" value="'.$question_title.'" required>
                        </h6>
                        <a href="edit-questions?id='.$jobId.'&section=title&myQID='.$question_id.'" id="title-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                        <input class="d-none" type="submit" value="Save Changes" name="submitA" id="title-save-button-'.$question_id.'">
                        <a href="edit-questions?id='.$jobId.'" class="d-none" id="title-cancel-button-'.$question_id.'">Cancel</a>
                        <input type="submit" class="btn-close position-absolute end-0 top-0 m-3" name="submitI" value="" onclick="clicked(event)">
                    </form>
    
                    <div class="avatar-sm mx-auto">
                        <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&type=1&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                        <div class="col-10" id="question-display-'.$question_id.'">
                            <input class="form-control col-9 mb-3" type="text" name="question" value="'.$question.'" disabled>
                        </div>
                        <div class="d-none" id="question-edit-'.$question_id.'">
                            <input class="form-control col-9 mb-3" type="text" name="question-edit" value="'.$question.'" autofocus required>
                        </div>
                        <a href="edit-questions?id='.$jobId.'&section=question&myQID='.$question_id.'" id="question-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                        <input class="d-none" type="submit" value="Save Changes" name="submitB" id="question-save-button-'.$question_id.'">
                        <a href="edit-questions?id='.$jobId.'" class="d-none" id="question-cancel-button-'.$question_id.'">Cancel</a>
                    </form>
    
                    <div class="row ">
                        <div class="form-group">
                            <textarea class="form-control rounded-2" id="exampleFormControlTextarea2" rows="3" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div> 
            ';
        }
        else if ($question_type == 2)
        {
            foreach ($multiple_choice as $i)
            {
                if ($i['custom_question_id'] == $question_id)
                {
                    $myQuestion = $i;
                    $question_title = $myQuestion['question_title'];
                    $question = $myQuestion['question_text'];
                    $option_one = $myQuestion['choice_1'];
                    $option_two = $myQuestion['choice_2'];
                    $option_three = $myQuestion['choice_3'];
                    $option_four = $myQuestion['choice_4'];
                    $option_five = $myQuestion['choice_5'];
                    $option_six = $myQuestion['choice_6'];
                }
            }
            // $option_one = $fullQuestion['option_one'];
            // $option_two = $fullQuestion['option_two'];
            // $option_three = $fullQuestion['option_three'];
            // $option_four = $fullQuestion['option_four'];
            // $option_five = $fullQuestion['option_five'];
            // $option_six = $fullQuestion['option_six'];
    
            echo '
            <div class="card mt-3" id="close" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
                <div class="card-header">
                    <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&type=2&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                        <h6 class="d-inline-block col-5" id="title-display-'.$question_id.'">
                            <input class="form-control" type="text" name="question" value="'.$question_title.'" disabled>
                        </h6>
                        <h6 class="d-none" id="title-edit-'.$question_id.'">
                            <input class="form-control col-9 mb-3" type="text" name="title-edit" value="'.$question_title.'" autofocus required>
                        </h6>
                        <a href="edit-questions?id='.$jobId.'&section=title&myQID='.$question_id.'" id="title-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                        <input class="d-none" type="submit" value="Save Changes" name="submitA" id="title-save-button-'.$question_id.'">
                        <a href="edit-questions?id='.$jobId.'" class="d-none" id="title-cancel-button-'.$question_id.'">Cancel</a>
                        <input type="submit" class="btn-close position-absolute end-0 top-0 m-3" name="submitI" value="" onclick="clicked(event)">
                    </form>
    
                    <div class="avatar-sm mx-auto">
                        <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&type=2&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                    <div class="col-10" id="question-display-'.$question_id.'">
                        <input class="form-control col-9 mb-3" type="text" name="question" value="'.$question.'" disabled>
                    </div>
                    <div class="d-none" id="question-edit-'.$question_id.'">
                        <input class="form-control col-9 mb-3" type="text" name="question-edit" value="'.$question.'" autofocus required>
                    </div>
                    <a href="edit-questions?id='.$jobId.'&section=question&myQID='.$question_id.'" id="question-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                    <input class="d-none" type="submit" value="Save Changes" name="submitB" id="question-save-button-'.$question_id.'">
                    <a href="edit-questions?id='.$jobId.'" class="d-none" id="question-cancel-button-'.$question_id.'">Cancel</a>
                </form>
                    
                    <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&type=2&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                        <div class="col-4" id="option-one-display-'.$question_id.'">
                            <input class="form-control mb-3" type="text" name="option1" value="'.$option_one.'" disabled>
                        </div>
                        <div class="d-none" id="option-one-edit-'.$question_id.'">
                            <input class="form-control mb-3" type="text" name="option1-edit" value="'.$option_one.'" autofocus required>
                        </div>
                        <a href="edit-questions?id='.$jobId.'&section=option-one&myQID='.$question_id.'" id="option-one-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                        <input class="d-none" type="submit" value="Save Changes" name="submitC" id="option-one-save-button-'.$question_id.'">
                        <a href="edit-questions?id='.$jobId.'" class="d-none" id="option-one-cancel-button-'.$question_id.'">Cancel</a>
                    </form>
                    <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&type=2&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                        <div class="col-4" id="option-two-display-'.$question_id.'">
                            <input class="form-control mb-3" type="text" name="option2" value="'.$option_two.'" disabled>
                        </div>
                        <div class="d-none" id="option-two-edit-'.$question_id.'">
                            <input class="form-control mb-3" type="text" name="option2-edit" value="'.$option_two.'" autofocus required>
                        </div>
                        <a href="edit-questions?id='.$jobId.'&section=option-two&myQID='.$question_id.'" id="option-two-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                        <input class="d-none" type="submit" value="Save Changes" name="submitD" id="option-two-save-button-'.$question_id.'">
                        <a href="edit-questions?id='.$jobId.'" class="d-none" id="option-two-cancel-button-'.$question_id.'">Cancel</a>
                    </form>';
                    if (strlen($option_three > 0))
                    {
                    echo '
                    <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&type=2&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                        <div class="col-4" id="option-three-display-'.$question_id.'">
                            <input class="form-control mb-3" type="text" name="option3" value="'.$option_three.'" disabled>
                        </div>
                        <div class="d-none" id="option-three-edit-'.$question_id.'">
                            <input class="form-control mb-3" type="text" name="option3-edit" value="'.$option_three.'" autofocus required>
                        </div>
                        <a href="edit-questions?id='.$jobId.'&section=option-three&myQID='.$question_id.'" id="option-three-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                        <input class="d-none" type="submit" value="Save Changes" name="submitE" id="option-three-save-button-'.$question_id.'">
                        <a href="edit-questions?id='.$jobId.'" class="d-none" id="option-three-cancel-button-'.$question_id.'">Cancel</a>
                    </form>';
                    }
                    if (strlen($option_four > 0))
                    {
                    echo '
                    <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&type=2&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                        <div class="col-4" id="option-four-display-'.$question_id.'">
                            <input class="form-control mb-3" type="text" name="option4" value="'.$option_four.'" disabled>
                        </div>
                        <div class="d-none" id="option-four-edit-'.$question_id.'">
                            <input class="form-control mb-3" type="text" name="option4-edit" value="'.$option_four.'" autofocus required>
                        </div>
                        <a href="edit-questions?id='.$jobId.'&section=option-four&myQID='.$question_id.'" id="option-four-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                        <input class="d-none" type="submit" value="Save Changes" name="submitF" id="option-four-save-button-'.$question_id.'">
                        <a href="edit-questions?id='.$jobId.'" class="d-none" id="option-four-cancel-button-'.$question_id.'">Cancel</a>
                    </form>';
                    }
                    if (strlen($option_five > 0))
                    {
                    echo'
                    <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&type=2&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                        <div class="col-4" id="option-five-display-'.$question_id.'">
                            <input class="form-control mb-3" type="text" name="option5" value="'.$option_five.'" disabled>
                        </div>
                        <div class="d-none" id="option-five-edit-'.$question_id.'">
                            <input class="form-control mb-3" type="text" name="option5-edit" value="'.$option_five.'" autofocus required>
                        </div>
                        <a href="edit-questions?id='.$jobId.'&section=option-five&myQID='.$question_id.'" id="option-five-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                        <input class="d-none" type="submit" value="Save Changes" name="submitG" id="option-five-save-button-'.$question_id.'">
                        <a href="edit-questions?id='.$jobId.'" class="d-none" id="option-five-cancel-button-'.$question_id.'">Cancel</a>
                    </form>';
                    }
                    if (strlen($option_six > 0))
                    {
                        echo '
                        <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                            <div class="col-4" id="option-six-display-'.$question_id.'">
                                <input class="form-control mb-3" type="text" name="option6" value="'.$option_six.'" disabled>
                            </div>
                            <div class="d-none" id="option-six-edit-'.$question_id.'">
                                <input class="form-control mb-3" type="text" name="option6-edit" value="'.$option_six.'" autofocus required>
                            </div>
                            <a href="edit-questions?id='.$jobId.'&section=option-six&myQID='.$question_id.'" id="option-six-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                            <input class="d-none" type="submit" value="Save Changes" name="submitH" id="option-six-save-button-'.$question_id.'">
                            <a href="edit-questions?id='.$jobId.'" class="d-none" id="option-six-cancel-button-'.$question_id.'">Cancel</a>
                        </form>';
                    }
            echo '
                </div>
            </div>
            ';
        }
        else if ($question_type == 3)
        {
            foreach ($yes_no as $i)
            {
                if ($i['custom_question_id'] == $question_id)
                {
                    $myQuestion = $i;
                    $question_title = $myQuestion['question_title'];
                    $question = $myQuestion['question_text'];
                }
            }
            echo '
            <div class="card mt-3" id="close" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
                <div class="card-header">
                    <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&type=3&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                        <h6 class="card-title d-inline-block col-5" id="title-display-'.$question_id.'">
                            <input class="form-control" type="text" value="'.$question_title.'" disabled>
                        </h6>
                        <h6 class="d-none" id="title-edit-'.$question_id.'">
                            <input class="form-control col-9 mb-3" type="text" name="title-edit" value="'.$question_title.'" autofocus required>
                        </h6>
                        <a href="edit-questions?id='.$jobId.'&section=title&myQID='.$question_id.'" id="title-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                        <input class="d-none" type="submit" value="Save Changes" name="submitA" id="title-save-button-'.$question_id.'">
                        <a href="edit-questions?id='.$jobId.'" class="d-none" id="title-cancel-button-'.$question_id.'">Cancel</a>
                        <input type="submit" class="btn-close position-absolute end-0 top-0 m-3" name="submitI" value="" onclick="clicked(event)">
                    </form>
                    <div class="avatar-sm  mx-auto">
                        <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&type=3&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                    <div class="col-10" id="question-display-'.$question_id.'">
                        <input class="form-control" type="text" value="'.$question.'" disabled>
                    </div>
                    <div class="d-none" id="question-edit-'.$question_id.'">
                        <input class="form-control col-9 mb-3" type="text" name="question-edit" value="'.$question.'" autofocus required>
                    </div>
                    <a href="edit-questions?id='.$jobId.'&section=question&myQID='.$question_id.'" id="question-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                    <input class="d-none" type="submit" value="Save Changes" name="submitB" id="question-save-button-'.$question_id.'">
                    <a href="edit-questions?id='.$jobId.'" class="d-none" id="question-cancel-button-'.$question_id.'">Cancel</a>
                </form>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" disabled>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" disabled>
                        <label class="form-check-label" for="flexRadioDefault2">
                            No
                        </label>
                    </div>
                </div>
            </div>
            ';
        }
        else
        {
            foreach ($file_upload as $i)
            {
                if ($i['custom_question_id'] == $question_id)
                {
                    $myQuestion = $i;
                    $question_title = $myQuestion['question_title'];
                    $question = $myQuestion['question_text'];
                }
            }
            echo '
            <div class="card mt-3" id="close" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
                <div class="card-header">
                    <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&type=4&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                        <h6 class="card-title d-inline-block col-5" id="title-display-'.$question_id.'">
                            <input class="form-control" type="text" value="'.$question_title.'" disabled>
                        </h6>
                        <h6 class="d-none" id="title-edit-'.$question_id.'">
                            <input class="form-control col-9 mb-3" type="text" name="title-edit" value="'.$question_title.'" autofocus required>
                        </h6>
                        <a href="edit-questions?id='.$jobId.'&section=title&myQID='.$question_id.'" id="title-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                        <input class="d-none" type="submit" value="Save Changes" name="submitA" id="title-save-button-'.$question_id.'">
                        <a href="edit-questions?id='.$jobId.'" class="d-none" id="title-cancel-button-'.$question_id.'">Cancel</a>
                        <input type="submit" class="btn-close position-absolute end-0 top-0 m-3" name="submitI" value="" onclick="clicked(event)">
                    </form>
                    <div class="avatar-sm mx-auto">
                        <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                    <form action="update-questions.php?id='.$jobId.'&qid='.$question_id.'&type=4&high="+questions.length.toString() method="POST" enctype="multipart/form-data" class="d-flex">
                        <div class="col-10" id="question-display-'.$question_id.'">
                            <input class="form-control" type="text" value="'.$question.'" disabled>
                        </div>
                        <div class="d-none" id="question-edit-'.$question_id.'">
                            <input class="form-control col-9 mb-3" type="text" name="question-edit" value="'.$question.'" autofocus required>
                        </div>
                        <a href="edit-questions?id='.$jobId.'&section=question&myQID='.$question_id.'" id="question-edit-button-'.$question_id.'" class="text-decoration-none">edit</a>
                        <input class="d-none" type="submit" value="Save Changes" name="submitB" id="question-save-button-'.$question_id.'">
                        <a href="edit-questions?id='.$jobId.'" class="d-none" id="question-cancel-button-'.$question_id.'">Cancel</a>
                    </form>
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="inputGroupFile02" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
    }
}


?>

<script>
const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});

let section = params.section;
let questionID = params.myQID;

let mySharona = document.getElementById("my-sharona");
let closeButtonOne = document.getElementById("1");
let closeButtonTwo = document.getElementById("2");
let questions = [];
<?php while ($noQuestions > 0) : ?>
    questions.push(<?php echo $noQuestions ?>);
    <?php $noQuestions--; ?>

<?php endwhile ?>
let allowedQuestions = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,100];
let freeQuestions = allowedQuestions.filter(function(obj) { return questions.indexOf(obj) == -1; });
let currentQuestion = Math.min(...freeQuestions);

let titleDisplay = document.getElementById("title-display-"+questionID);
let titleEdit = document.getElementById("title-edit-"+questionID);
let titleEditButton = document.getElementById("title-edit-button-"+questionID);
let titleSaveButton = document.getElementById("title-save-button-"+questionID);
let titleCancelButton = document.getElementById("title-cancel-button-"+questionID);

let questionDisplay = document.getElementById("question-display-"+questionID);
let questionEdit = document.getElementById("question-edit-"+questionID);
let questionEditButton = document.getElementById("question-edit-button-"+questionID);
let questionSaveButton = document.getElementById("question-save-button-"+questionID);
let questionCancelButton = document.getElementById("question-cancel-button-"+questionID);

let optionOneDisplay = document.getElementById("option-one-display-"+questionID);
let optionOneEdit = document.getElementById("option-one-edit-"+questionID);
let optionOneEditButton = document.getElementById("option-one-edit-button-"+questionID);
let optionOneSaveButton = document.getElementById("option-one-save-button-"+questionID);
let optionOneCancelButton = document.getElementById("option-one-cancel-button-"+questionID);

let optionTwoDisplay = document.getElementById("option-two-display-"+questionID);
let optionTwoEdit = document.getElementById("option-two-edit-"+questionID);
let optionTwoEditButton = document.getElementById("option-two-edit-button-"+questionID);
let optionTwoSaveButton = document.getElementById("option-two-save-button-"+questionID);
let optionTwoCancelButton = document.getElementById("option-two-cancel-button-"+questionID);

let optionThreeDisplay = document.getElementById("option-three-display-"+questionID);
let optionThreeEdit = document.getElementById("option-three-edit-"+questionID);
let optionThreeEditButton = document.getElementById("option-three-edit-button-"+questionID);
let optionThreeSaveButton = document.getElementById("option-three-save-button-"+questionID);
let optionThreeCancelButton = document.getElementById("option-three-cancel-button-"+questionID);

let optionFourDisplay = document.getElementById("option-four-display-"+questionID);
let optionFourEdit = document.getElementById("option-four-edit-"+questionID);
let optionFourEditButton = document.getElementById("option-four-edit-button-"+questionID);
let optionFourSaveButton = document.getElementById("option-four-save-button-"+questionID);
let optionFourCancelButton = document.getElementById("option-four-cancel-button-"+questionID);

let optionFiveDisplay = document.getElementById("option-five-display-"+questionID);
let optionFiveEdit = document.getElementById("option-five-edit-"+questionID);
let optionFiveEditButton = document.getElementById("option-five-edit-button-"+questionID);
let optionFiveSaveButton = document.getElementById("option-five-save-button-"+questionID);
let optionFiveCancelButton = document.getElementById("option-five-cancel-button-"+questionID);

let optionSixDisplay = document.getElementById("option-six-display-"+questionID);
let optionSixEdit = document.getElementById("option-six-edit-"+questionID);
let optionSixEditButton = document.getElementById("option-six-edit-button-"+questionID);
let optionSixSaveButton = document.getElementById("option-six-save-button-"+questionID);
let optionSixCancelButton = document.getElementById("option-six-cancel-button-"+questionID);

if (section == null)
{
    hideTitle();
    hideQuestion();
    hideOptionOne();
    hideOptionTwo();
    hideOptionThree();
    hideOptionFour();
    hideOptionFive();
    hideOptionSix();
}
else if (section == "title")
{
    showTitle();
    hideQuestion();
    hideOptionOne();
    hideOptionTwo();
    hideOptionThree();
    hideOptionFour();
    hideOptionFive();
    hideOptionSix();
}
else if (section == "question")
{
    showQuestion();
    hideTitle();
    hideOptionOne();
    hideOptionTwo();
    hideOptionThree();
    hideOptionFour();
    hideOptionFive();
    hideOptionSix();
}
else if (section == "option-one")
{
    showOptionOne();
    hideTitle();
    hideQuestion();
    hideOptionTwo();
    hideOptionThree();
    hideOptionFour();
    hideOptionFive();
    hideOptionSix();
}
else if (section == "option-two")
{
    showOptionTwo();
    hideTitle();
    hideQuestion();
    hideOptionOne();
    hideOptionThree();
    hideOptionFour();
    hideOptionFive();
    hideOptionSix();
}
else if (section == "option-three")
{
    showOptionThree();
    hideTitle();
    hideQuestion();
    hideOptionTwo();
    hideOptionOne();
    hideOptionFour();
    hideOptionFive();
    hideOptionSix();
}
else if (section == "option-four")
{
    showOptionFour();
    hideTitle();
    hideQuestion();
    hideOptionTwo();
    hideOptionThree();
    hideOptionOne();
    hideOptionFive();
    hideOptionSix();
}
else if (section == "option-five")
{
    showOptionFive();
    hideTitle();
    hideQuestion();
    hideOptionTwo();
    hideOptionThree();
    hideOptionFour();
    hideOptionOne();
    hideOptionSix();
}
else if (section == "option-six")
{
    showOptionOne();
    hideTitle();
    hideQuestion();
    hideOptionTwo();
    hideOptionThree();
    hideOptionFour();
    hideOptionFive();
    hideOptionOne();
}

function showTitle () 
{
	titleDisplay.className = "d-none";
	titleEdit.className = "card-title d-inline-block col-5";
	titleEditButton.className = "d-none";
	titleSaveButton.className = "btn btn-primary me-2 mt-2";
	titleCancelButton.className = "btn btn-danger mt-2";
}

function hideTitle () 
{
	titleDisplay.className = "card-title d-inline-block col-5";
	titleEdit.className = "d-none";
	titleEditButton.className = "text-decoration-none";
	titleSaveButton.className = "d-none";
	titleCancelButton.className = "d-none";
}

function showQuestion () 
{
	questionDisplay.className = "d-none";
	questionEdit.className = "col-10";
	questionEditButton.className = "d-none";
	questionSaveButton.className = "btn btn-primary me-2 mt-2";
	questionCancelButton.className = "btn btn-danger mt-2";
}

function hideQuestion () 
{
	questionDisplay.className = "col-10";
	questionEdit.className = "d-none";
	questionEditButton.className = "text-decoration-none";
	questionSaveButton.className = "d-none";
	questionCancelButton.className = "d-none";
}

function showOptionOne () 
{
	optionOneDisplay.className = "d-none";
	optionOneEdit.className = "col-4";
	optionOneEditButton.className = "d-none";
	optionOneSaveButton.className = "btn btn-primary me-2 mt-2";
	optionOneCancelButton.className = "btn btn-danger mt-2";
}

function hideOptionOne () 
{
	optionOneDisplay.className = "col-4";
	optionOneEdit.className = "d-none";
	optionOneEditButton.className = "text-decoration-none";
	optionOneSaveButton.className = "d-none";
	optionOneCancelButton.className = "d-none";
}

function showOptionTwo () 
{
	optionTwoDisplay.className = "d-none";
	optionTwoEdit.className = "col-4";
	optionTwoEditButton.className = "d-none";
	optionTwoSaveButton.className = "btn btn-primary me-2 mt-2";
	optionTwoCancelButton.className = "btn btn-danger mt-2";
}

function hideOptionTwo () 
{
	optionTwoDisplay.className = "col-4";
	optionTwoEdit.className = "d-none";
	optionTwoEditButton.className = "text-decoration-none";
	optionTwoSaveButton.className = "d-none";
	optionTwoCancelButton.className = "d-none";
}

function showOptionThree () 
{
	optionThreeDisplay.className = "d-none";
	optionThreeEdit.className = "col-4";
	optionThreeEditButton.className = "d-none";
	optionThreeSaveButton.className = "btn btn-primary me-2 mt-2";
	optionThreeCancelButton.className = "btn btn-danger mt-2";
}

function hideOptionThree () 
{
	optionThreeDisplay.className = "col-4";
	optionThreeEdit.className = "d-none";
	optionThreeEditButton.className = "text-decoration-none";
	optionThreeSaveButton.className = "d-none";
	optionThreeCancelButton.className = "d-none";
}

function showOptionFour () 
{
	optionFourDisplay.className = "d-none";
	optionFourEdit.className = "col-4";
	optionFourEditButton.className = "d-none";
	optionFourSaveButton.className = "btn btn-primary me-2 mt-2";
	optionFourCancelButton.className = "btn btn-danger mt-2";
}

function hideOptionFour () 
{
	optionFourDisplay.className = "col-4";
	optionFourEdit.className = "d-none";
	optionFourEditButton.className = "text-decoration-none";
	optionFourSaveButton.className = "d-none";
	optionFourCancelButton.className = "d-none";
}

function showOptionFive () 
{
	optionFiveDisplay.className = "d-none";
	optionFiveEdit.className = "col-4";
	optionFiveEditButton.className = "d-none";
	optionFiveSaveButton.className = "btn btn-primary me-2 mt-2";
	optionFiveCancelButton.className = "btn btn-danger mt-2";
}

function hideOptionFive () 
{
	optionFiveDisplay.className = "col-4";
	optionFiveEdit.className = "d-none";
	optionFiveEditButton.className = "text-decoration-none";
	optionFiveSaveButton.className = "d-none";
	optionFiveCancelButton.className = "d-none";
}

function showOptionSix () 
{
	optionSixDisplay.className = "d-none";
	optionSixEdit.className = "col-4";
	optionSixEditButton.className = "d-none";
	optionSixSaveButton.className = "btn btn-primary me-2 mt-2";
	optionSixCancelButton.className = "btn btn-danger mt-2";
}

function hideOptionSix () 
{
	optionSixDisplay.className = "col-4";
	optionSixEdit.className = "d-none";
	optionSixEditButton.className = "text-decoration-none";
	optionSixSaveButton.className = "d-none";
	optionSixCancelButton.className = "d-none";
}

function closeFunction(buttonID) 
        {
            // document.getElementById("close").style.visibility = "hidden"
            // console.log(buttonID);
            // console.log(questions);
            let myQuestion = document.getElementById("close"+buttonID);
            let myID = parseInt(buttonID);

            const index = questions.indexOf(myID);
            if (index > -1) 
            {
                questions.splice(index, 1);
                freeQuestions.push(myID);
                freeQuestions.sort(function(a, b){return a-b});
                currentQuestion = Math.min(...freeQuestions);
                myQuestion.remove();

                //mysharona setattribute 
                mySharona.setAttribute("action", "update-questions.php?id=<?php echo $jobId ?>&qid=<?php echo $question_id ?>");
                
            }
            // console.log(myID);
            // console.log(questions);
            // console.log(freeQuestions);

        }



        // console.log(freeQuestions);
        // console.log(currentQuestion);


        // closeButtonOne.addEventListener ("click", closeFunction("1"), false);
        // closeButtonTwo.addEventListener ("click", closeFunction("2"), false);
        console.log(questions);

        let btn = document.getElementById("free_form");
        let free_form = document.getElementById("free_form_div");
        btn.addEventListener("click", function () {
            document.body.appendChild(free_form);
        });

        function createFreeForm() 
        {
        
        // currentQuestion = Math.min(...freeQuestions);
        let card = document.createElement('div');
        card.className = "card mt-3";
        card.setAttribute("id", "close"+currentQuestion.toString());
        card.style.boxShadow = "0 3px 10px rgb(0 0 0)"; // changed rgb value
        let cardHeader = document.createElement('div');
        cardHeader.className = "card-header";
        card.append(cardHeader);

        let cardTitle = document.createElement('h6');
        cardTitle.className = "card-title d-inline-block col-5";
        cardHeader.append(cardTitle);
        let titleInput = document.createElement('input');
        titleInput.className = "form-control";
        titleInput.setAttribute("type", "text");
        titleInput.setAttribute("id", "title"+currentQuestion.toString());
        titleInput.setAttribute("name", "title"+currentQuestion.toString());
        titleInput.setAttribute("placeholder", "Enter the question title");
        titleInput.required = true;
        cardTitle.append(titleInput);
        let closeButton = document.createElement('button');
        closeButton.setAttribute("type", "button");
        closeButton.className = "btn-close position-absolute end-0 top-0 m-3";
        closeButton.setAttribute("id", currentQuestion.toString());
        closeButton.setAttribute("onclick", "closeFunction(this.id)");
        
        cardHeader.append(closeButton);
        let divA = document.createElement('div');
        divA.className = "avatar-sm mx-auto";
        cardHeader.append(divA);
        let divB = document.createElement('div');
        divB.className = "avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3";
        divA.append(divB);
        let i = document.createElement('i');
        i.className = "mdi mdi-trash-can-outline";
        divB.append(i);
        let cardBody = document.createElement('div');
        cardBody.className = "card-body";
        card.append(cardBody);
        let divC = document.createElement('div');
        cardBody.append(divC);
        let question = document.createElement('input');
        question.className = "form-control col-9 mb-3";
        question.setAttribute("type", "text");
        question.setAttribute("id", "question"+currentQuestion.toString());
        question.setAttribute("name", "question"+currentQuestion.toString());
        question.setAttribute("placeholder", "Enter the question");
        question.required = true;
        divC.append(question);
        let row = document.createElement('div');
        row.className = "row";
        cardBody.append(row);
        let formGroup = document.createElement('div');
        formGroup.className = "form-group";
        row.append(formGroup);
        let textArea = document.createElement('textarea');
        textArea.className = "form-control rounded-2";
        textArea.setAttribute("id", "exampleFormControlTextarea2");
        textArea.setAttribute("rows", "3");
        textArea.disabled = true;
        formGroup.append(textArea);
        if (questions.length < 15)
        {
            // document.body.appendChild(card);
            // mySharona.prepend(card);
            questions.push(currentQuestion);
            console.log("a");
            console.log(currentQuestion);
            questions.sort(function(a, b){return a-b});
            freeQuestions = allowedQuestions.filter(function(obj) { return questions.indexOf(obj) == -1; });

            let hiddenInfoQuestions = document.createElement('input');
            hiddenInfoQuestions.className = "d-none";
            hiddenInfoQuestions.value = questions;
            hiddenInfoQuestions.setAttribute("id", "shhh"+currentQuestion.toString());
            hiddenInfoQuestions.setAttribute("name", "shhh"+currentQuestion.toString());

            let hiddenInfoType = document.createElement('input');
            hiddenInfoType.className = "d-none";
            hiddenInfoType.value = 1;
            hiddenInfoType.setAttribute("id", "questionType"+currentQuestion.toString());
            hiddenInfoType.setAttribute("name", "questionType"+currentQuestion.toString());

            card.append(hiddenInfoQuestions);
            card.append(hiddenInfoType);

            currentQuestion = Math.min(...freeQuestions);
            mySharona.setAttribute("action", "update-questions.php?id=<?php echo $jobId ?>&qid=<?php echo $question_id ?>&high="+questions.length.toString());
            mySharona.prepend(card);
            
        }
        }


        function createMultipleChoice() 
        {
        
        let card = document.createElement('div');
        card.className = "card mt-3";
        card.setAttribute("id", "close"+currentQuestion.toString());
        card.style.boxShadow = "0 3px 10px rgb(0 0 0)"; // changed rgb value
        let cardHeader = document.createElement('div');
        cardHeader.className = "card-header";
        card.append(cardHeader);

        let cardTitle = document.createElement('h6');
        cardTitle.className = "card-title d-inline-block col-5";
        cardHeader.append(cardTitle);
        let titleInput = document.createElement('input');
        titleInput.className = "form-control";
        titleInput.setAttribute("type", "text");
        titleInput.setAttribute("id", "title"+currentQuestion.toString());
        titleInput.setAttribute("name", "title"+currentQuestion.toString());
        titleInput.setAttribute("placeholder", "Enter the question title");
        titleInput.required = true;
        cardTitle.append(titleInput);
        let closeButton = document.createElement('button');
        closeButton.setAttribute("type", "button");
        closeButton.className = "btn-close position-absolute end-0 top-0 m-3";
        closeButton.setAttribute("id", currentQuestion.toString());
        closeButton.setAttribute("onclick", "closeFunction(this.id)");
        
        cardHeader.append(closeButton);
        let divA = document.createElement('div');
        divA.className = "avatar-sm mx-auto";
        cardHeader.append(divA);
        let divB = document.createElement('div');
        divB.className = "avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3";
        divA.append(divB);
        let i = document.createElement('i');
        i.className = "mdi mdi-trash-can-outline";
        divB.append(i);
        let cardBody = document.createElement('div');
        cardBody.className = "card-body";
        card.append(cardBody);

        let divC = document.createElement('div');
        cardBody.append(divC);

        let question = document.createElement('input');
        question.className = "form-control mb-3";
        question.setAttribute("type", "text");
        question.setAttribute("id", "question"+currentQuestion.toString());
        question.setAttribute("name", "question"+currentQuestion.toString());
        question.setAttribute("placeholder", "Enter the question");
        question.required = true;
        divC.append(question);

        let divD = document.createElement('div');
        divD.className = "col-4";
        cardBody.append(divD);

        let optionA = document.createElement('input');
        optionA.className = "form-control mb-3";
        optionA.setAttribute("type", "text");
        optionA.setAttribute("id", "option1_"+currentQuestion.toString());
        optionA.setAttribute("name", "option1_"+currentQuestion.toString());
        optionA.setAttribute("placeholder", "Enter option one");
        optionA.required = true;
        divD.append(optionA);

        let divE = document.createElement('div');
        divE.className = "col-4";
        cardBody.append(divE);

        let optionB = document.createElement('input');
        optionB.className = "form-control mb-3";
        optionB.setAttribute("type", "text");
        optionB.setAttribute("id", "option2_"+currentQuestion.toString());
        optionB.setAttribute("name", "option2_"+currentQuestion.toString());
        optionB.setAttribute("placeholder", "Enter option two");
        optionB.required = true;
        divE.append(optionB);

        let divF = document.createElement('div');
        divF.className = "col-4";
        cardBody.append(divF);

        let optionC = document.createElement('input');
        optionC.className = "form-control mb-3";
        optionC.setAttribute("type", "text");
        optionC.setAttribute("id", "option3_"+currentQuestion.toString());
        optionC.setAttribute("name", "option3_"+currentQuestion.toString());
        optionC.setAttribute("placeholder", "Enter option three");
        divF.append(optionC);

        let divG = document.createElement('div');
        divG.className = "col-4";
        cardBody.append(divG);

        let optionD = document.createElement('input');
        optionD.className = "form-control mb-3";
        optionD.setAttribute("type", "text");
        optionD.setAttribute("id", "option4_"+currentQuestion.toString());
        optionD.setAttribute("name", "option4_"+currentQuestion.toString());
        optionD.setAttribute("placeholder", "Enter option four");
        divG.append(optionD);

        let divNewA = document.createElement('div');
        divNewA.className = "col-4";
        cardBody.append(divNewA);

        let divH = document.createElement('div');
        divH.className = "col-4";
        cardBody.append(divH);

        let optionE = document.createElement('input');
        optionE.className = "form-control mb-3";
        optionE.setAttribute("type", "text");
        optionE.setAttribute("id", "option5_"+currentQuestion.toString());
        optionE.setAttribute("name", "option5_"+currentQuestion.toString());
        optionE.setAttribute("placeholder", "Enter option five");
        divH.append(optionE);

        let divI = document.createElement('div');
        divI.className = "col-4";
        cardBody.append(divI);

        let optionF = document.createElement('input');
        optionF.className = "form-control mb-3";
        optionF.setAttribute("type", "text");
        optionF.setAttribute("id", "option6_"+currentQuestion.toString());
        optionF.setAttribute("name", "option6_"+currentQuestion.toString());
        optionF.setAttribute("placeholder", "Enter option six");
        divI.append(optionF);

        if (questions.length < 15)
        {
            questions.push(currentQuestion);
            console.log("a");
            console.log(currentQuestion);
            questions.sort(function(a, b){return a-b});
            freeQuestions = allowedQuestions.filter(function(obj) { return questions.indexOf(obj) == -1; });
            
            let hiddenInfoQuestions = document.createElement('input');
            hiddenInfoQuestions.className = "d-none";
            hiddenInfoQuestions.value = questions;
            hiddenInfoQuestions.setAttribute("id", "shhh"+currentQuestion.toString());
            hiddenInfoQuestions.setAttribute("name", "shhh"+currentQuestion.toString());

            let hiddenInfoType = document.createElement('input');
            hiddenInfoType.className = "d-none";
            hiddenInfoType.value = 2;
            hiddenInfoType.setAttribute("id", "questionType"+currentQuestion.toString());
            hiddenInfoType.setAttribute("name", "questionType"+currentQuestion.toString());

            card.append(hiddenInfoQuestions);
            card.append(hiddenInfoType);

            currentQuestion = Math.min(...freeQuestions);
            mySharona.setAttribute("action", "update-questions.php?id=<?php echo $jobId ?>&qid=<?php echo $question_id ?>&high="+questions.length.toString());
            mySharona.prepend(card);
        }
        }

        function createYesNo() 
        {
        
        let card = document.createElement('div');
        card.className = "card mt-3";
        card.setAttribute("id", "close"+currentQuestion.toString());
        card.style.boxShadow = "0 3px 10px rgb(0 0 0)"; // changed rgb value
        let cardHeader = document.createElement('div');
        cardHeader.className = "card-header";
        card.append(cardHeader);

        let cardTitle = document.createElement('h6');
        cardTitle.className = "card-title d-inline-block col-5";
        cardHeader.append(cardTitle);
        let titleInput = document.createElement('input');
        titleInput.className = "form-control";
        titleInput.setAttribute("type", "text");
        titleInput.setAttribute("id", "title"+currentQuestion.toString());
        titleInput.setAttribute("name", "title"+currentQuestion.toString());
        titleInput.setAttribute("placeholder", "Enter the question title");
        titleInput.required = true;
        cardTitle.append(titleInput);
        let closeButton = document.createElement('button');
        closeButton.setAttribute("type", "button");
        closeButton.className = "btn-close position-absolute end-0 top-0 m-3";
        closeButton.setAttribute("id", currentQuestion.toString());
        closeButton.setAttribute("onclick", "closeFunction(this.id)");
        
        cardHeader.append(closeButton);
        let divA = document.createElement('div');
        divA.className = "avatar-sm mx-auto";
        cardHeader.append(divA);
        let divB = document.createElement('div');
        divB.className = "avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3";
        divA.append(divB);
        let i = document.createElement('i');
        i.className = "mdi mdi-trash-can-outline";
        divB.append(i);
        let cardBody = document.createElement('div');
        cardBody.className = "card-body";
        card.append(cardBody);

        let divC = document.createElement('div');
        cardBody.append(divC);

        let question = document.createElement('input');
        question.className = "form-control mb-3";
        question.setAttribute("type", "text");
        question.setAttribute("id", "question"+currentQuestion.toString());
        question.setAttribute("name", "question"+currentQuestion.toString());
        question.setAttribute("placeholder", "Enter the question");
        question.required = true;
        divC.append(question);

        let divD = document.createElement('div');
        divD.className = "form-check";
        cardBody.append(divD);

        let chooseYes = document.createElement('input');
        chooseYes.className = "form-check-input";
        chooseYes.setAttribute("type", "radio");
        chooseYes.setAttribute("id", "flexRadioDefault"+currentQuestion.toString());
        chooseYes.setAttribute("name", "flexRadioDefault"+currentQuestion.toString());
        chooseYes.disabled = true;
        divD.append(chooseYes);

        let chooseYesLabel = document.createElement('label');
        chooseYesLabel.className = "form-check-label";
        chooseYesLabel.setAttribute("for", "flexRadioDefault"+currentQuestion.toString());
        chooseYesLabel.innerHTML = "Yes";
        divD.append(chooseYesLabel);

        let divE = document.createElement('div');
        divE.className = "form-check";
        cardBody.append(divE);


        let chooseNo = document.createElement('input');
        chooseNo.className = "form-check-input";
        chooseNo.setAttribute("type", "radio");
        chooseNo.setAttribute("id", "flexRadioDefault"+currentQuestion.toString());
        chooseNo.setAttribute("name", "flexRadioDefault"+currentQuestion.toString());
        chooseNo.disabled = true;
        divE.append(chooseNo);

        let chooseNoLabel = document.createElement('label');
        chooseNoLabel.className = "form-check-label";
        chooseNoLabel.setAttribute("for", "flexRadioDefault"+currentQuestion.toString());
        chooseNoLabel.innerHTML = "No";
        divE.append(chooseNoLabel);

        if (questions.length < 15)
        {
            questions.push(currentQuestion);
            console.log("a");
            console.log(currentQuestion);
            questions.sort(function(a, b){return a-b});
            freeQuestions = allowedQuestions.filter(function(obj) { return questions.indexOf(obj) == -1; });
            
            let hiddenInfoQuestions = document.createElement('input');
            hiddenInfoQuestions.className = "d-none";
            hiddenInfoQuestions.value = questions;
            hiddenInfoQuestions.setAttribute("id", "shhh"+currentQuestion.toString());
            hiddenInfoQuestions.setAttribute("name", "shhh"+currentQuestion.toString());

            let hiddenInfoType = document.createElement('input');
            hiddenInfoType.className = "d-none";
            hiddenInfoType.value = 3;
            hiddenInfoType.setAttribute("id", "questionType"+currentQuestion.toString());
            hiddenInfoType.setAttribute("name", "questionType"+currentQuestion.toString());
            

            card.append(hiddenInfoQuestions);
            card.append(hiddenInfoType);


            currentQuestion = Math.min(...freeQuestions);
            mySharona.setAttribute("action", "update-questions.php?id=<?php echo $jobId ?>&qid=<?php echo $question_id ?>&high="+questions.length.toString());
            mySharona.prepend(card);
        }
        }

        function createUploadFile()
        {
        
        let card = document.createElement('div');
        card.className = "card mt-3";
        card.setAttribute("id", "close"+currentQuestion.toString());
        card.style.boxShadow = "0 3px 10px rgb(0 0 0)"; // changed rgb value
        let cardHeader = document.createElement('div');
        cardHeader.className = "card-header";
        card.append(cardHeader);

        let cardTitle = document.createElement('h6');
        cardTitle.className = "card-title d-inline-block col-5";
        cardHeader.append(cardTitle);
        let titleInput = document.createElement('input');
        titleInput.className = "form-control";
        titleInput.setAttribute("type", "text");
        titleInput.setAttribute("id", "title"+currentQuestion.toString());
        titleInput.setAttribute("name", "title"+currentQuestion.toString());
        titleInput.setAttribute("placeholder", "Enter the question title");
        titleInput.required = true;
        cardTitle.append(titleInput);
        let closeButton = document.createElement('button');
        closeButton.setAttribute("type", "button");
        closeButton.className = "btn-close position-absolute end-0 top-0 m-3";
        closeButton.setAttribute("id", currentQuestion.toString());
        closeButton.setAttribute("onclick", "closeFunction(this.id)");
        
        cardHeader.append(closeButton);
        let divA = document.createElement('div');
        divA.className = "avatar-sm mx-auto";
        cardHeader.append(divA);
        let divB = document.createElement('div');
        divB.className = "avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3";
        divA.append(divB);
        let i = document.createElement('i');
        i.className = "mdi mdi-trash-can-outline";
        divB.append(i);
        let cardBody = document.createElement('div');
        cardBody.className = "card-body";
        card.append(cardBody);

        let divC = document.createElement('div');
        cardBody.append(divC);
        let divD = document.createElement('div');
        divC.append(divD);

        let question = document.createElement('input');
        question.className = "form-control mb-3";
        question.setAttribute("type", "text");
        question.setAttribute("id", "question"+currentQuestion.toString());
        question.setAttribute("name", "question"+currentQuestion.toString());
        question.setAttribute("placeholder", "Enter the question");
        question.required = true;
        divD.append(question);

        let divE = document.createElement('div');
        divE.className = "col-4";
        divC.append(divE);

        let divF = document.createElement('div');
        divF.className = "input-group mb-3";
        divE.append(divF);

        let uploadResponse = document.createElement('input');
        uploadResponse.setAttribute("type", "file");
        uploadResponse.className = "form-control";
        uploadResponse.setAttribute("id", "inputGroupFile02"+currentQuestion.toString());
        uploadResponse.setAttribute("name", "inputGroupFile02"+currentQuestion.toString());
        uploadResponse.disabled = true;
        divF.append(uploadResponse);

        if (questions.length < 15)
        {
            questions.push(currentQuestion);
            console.log("a");
            console.log(currentQuestion);
            questions.sort(function(a, b){return a-b});
            freeQuestions = allowedQuestions.filter(function(obj) { return questions.indexOf(obj) == -1; });
            
            let hiddenInfoQuestions = document.createElement('input');
            hiddenInfoQuestions.className = "d-none";
            hiddenInfoQuestions.value = questions;
            hiddenInfoQuestions.setAttribute("id", "shhh"+currentQuestion.toString());
            hiddenInfoQuestions.setAttribute("name", "shhh"+currentQuestion.toString());

            let hiddenInfoType = document.createElement('input');
            hiddenInfoType.className = "d-none";
            hiddenInfoType.value = 4;
            hiddenInfoType.setAttribute("id", "questionType"+currentQuestion.toString());
            hiddenInfoType.setAttribute("name", "questionType"+currentQuestion.toString());

            card.append(hiddenInfoQuestions);
            card.append(hiddenInfoType);

            currentQuestion = Math.min(...freeQuestions);
            mySharona.setAttribute("action", "update-questions.php?id=<?php echo $jobId ?>&qid=<?php echo $question_id ?>&high="+questions.length.toString());
            mySharona.prepend(card);
        }
    }

    function clicked(e)
    {
        if (!confirm('Are you sure you want to delete this?')) 
        {
            e.preventDefault();
        }
    }

</script>