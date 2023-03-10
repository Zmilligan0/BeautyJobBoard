<?php
include("includes/job_connect.php");
include("includes/utils.php");
if (isset($_GET['id'])) 
{
    $jobId = $_GET['id'];
    $questionId = $_GET['qid'];
    $high = $_GET['high'];
    if (isset($_GET['type'])) 
    {
        $type = $_GET['type'];
    }

    // $res = mysqli_query($jobConn, "SELECT * FROM screening_question WHERE job_id = '$userId' LIMIT 1");

    // $conn = new mysqli("localhost", "root", '', "job_platform");
    // $result = mysqli_query($conn, "SELECT * FROM screening_question WHERE job_id = '$jobId'") or die("Error: " . mysqli_error($conn));
    $result = mysqli_query($jobConn, "SELECT * FROM screening_question WHERE job_id = $jobId") or die("Error: " . mysqli_error($jobConn));
    // $free_form = mysqli_query($jobConn, "SELECT * FROM free_form_question") or die("Error: " . mysqli_error($jobConn));
    // $multiple_choice = mysqli_query($jobConn, "SELECT * FROM multiple_choice_question") or die("Error: " . mysqli_error($jobConn));
    // $yes_no = mysqli_query($jobConn, "SELECT * FROM yes_no_question") or die("Error: " . mysqli_error($jobConn));
    // $file_upload = mysqli_query($jobConn, "SELECT * FROM file_upload_question") or die("Error: " . mysqli_error($jobConn));
    if (mysqli_num_rows($result) >= 1) 
    {
        $row = mysqli_fetch_array($result);
        // $employer_id = $row['employer_id'];
    }
    else 
    {
        header("Location: index");
    }
}

if (isset($_POST['submitA'])) 
{
    $first_name_raw = $_POST['title-edit'];
    echo $first_name_raw;

    $first_name_edited = str_replace("\\", "", $first_name_raw);
    $first_name = str_replace("'", "\'", $first_name_edited);
    if ($type == 1)
    {
        mysqli_query($jobConn, "UPDATE free_form_question SET question_title = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($type == 2)
    {
        mysqli_query($jobConn, "UPDATE multiple_choice_question SET question_title = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($type == 3)
    {
        mysqli_query($jobConn, "UPDATE yes_no_question SET question_title = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    }
    else
    {
        mysqli_query($jobConn, "UPDATE file_upload_question SET question_title = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    }
    header("Location: edit-questions?id=$jobId");
}

if (isset($_POST['submitB'])) 
{
    $first_name_raw = $_POST['question-edit'];
    echo $first_name_raw;

    $first_name_edited = str_replace("\\", "", $first_name_raw);
    $first_name = str_replace("'", "\'", $first_name_edited);
    if ($type == 1)
    {
        mysqli_query($jobConn, "UPDATE free_form_question SET question_text = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($type == 2)
    {
        mysqli_query($jobConn, "UPDATE multiple_choice_question SET question_text = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($type == 3)
    {
        mysqli_query($jobConn, "UPDATE yes_no_question SET question_text = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    }
    else
    {
        mysqli_query($jobConn, "UPDATE file_upload_question SET question_text = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    }
    // mysqli_query($conn, "UPDATE screening_question SET question = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($conn));
    header("Location: edit-questions?id=$jobId");
}

if (isset($_POST['submitC'])) 
{
    $first_name_raw = $_POST['option1-edit'];
    echo $first_name_raw;

    $first_name_edited = str_replace("\\", "", $first_name_raw);
    $first_name = str_replace("'", "\'", $first_name_edited);

    mysqli_query($jobConn, "UPDATE multiple_choice_question SET choice_1 = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    // mysqli_query($conn, "UPDATE screening_question SET option_one = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($conn));
    header("Location: edit-questions?id=$jobId");
}

if (isset($_POST['submitD'])) 
{
    $first_name_raw = $_POST['option2-edit'];
    echo $first_name_raw;

    $first_name_edited = str_replace("\\", "", $first_name_raw);
    $first_name = str_replace("'", "\'", $first_name_edited);

    mysqli_query($jobConn, "UPDATE multiple_choice_question SET choice_2 = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    // mysqli_query($conn, "UPDATE screening_question SET option_two = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($conn));
    header("Location: edit-questions?id=$jobId");
}

if (isset($_POST['submitE'])) 
{
    $first_name_raw = $_POST['option3-edit'];
    echo $first_name_raw;

    $first_name_edited = str_replace("\\", "", $first_name_raw);
    $first_name = str_replace("'", "\'", $first_name_edited);

    mysqli_query($jobConn, "UPDATE multiple_choice_question SET choice_3 = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));

    // mysqli_query($conn, "UPDATE screening_question SET option_three = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($conn));
    header("Location: edit-questions?id=$jobId");
}

if (isset($_POST['submitF'])) 
{
    $first_name_raw = $_POST['option4-edit'];
    echo $first_name_raw;

    $first_name_edited = str_replace("\\", "", $first_name_raw);
    $first_name = str_replace("'", "\'", $first_name_edited);

    mysqli_query($jobConn, "UPDATE multiple_choice_question SET choice_4 = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));

    // mysqli_query($conn, "UPDATE screening_question SET option_four = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($conn));
    header("Location: edit-questions?id=$jobId");
}

if (isset($_POST['submitG'])) 
{
    $first_name_raw = $_POST['option5-edit'];
    echo $first_name_raw;

    $first_name_edited = str_replace("\\", "", $first_name_raw);
    $first_name = str_replace("'", "\'", $first_name_edited);

    mysqli_query($jobConn, "UPDATE multiple_choice_question SET choice_5 = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    // mysqli_query($conn, "UPDATE screening_question SET option_five = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($conn));
    header("Location: edit-questions?id=$jobId");
}

if (isset($_POST['submitH'])) 
{
    $first_name_raw = $_POST['option6-edit'];
    echo $first_name_raw;

    $first_name_edited = str_replace("\\", "", $first_name_raw);
    $first_name = str_replace("'", "\'", $first_name_edited);

    mysqli_query($jobConn, "UPDATE multiple_choice_question SET choice_6 = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));

    // mysqli_query($conn, "UPDATE screening_question SET option_six = '$first_name' WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($conn));
    header("Location: edit-questions?id=$jobId");
}

if (isset($_POST['submitI'])) 
{
    $first_name_raw = "hello";
    echo $first_name_raw;
    if ($type == 1)
    {
        mysqli_query($jobConn, "DELETE FROM free_form_question WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($type == 2)
    {
        mysqli_query($jobConn, "DELETE FROM multiple_choice_question WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($type == 3)
    {
        mysqli_query($jobConn, "DELETE FROM yes_no_question WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    }
    else
    {
        mysqli_query($jobConn, "DELETE FROM file_upload_question WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    }
    mysqli_query($jobConn, "DELETE FROM screening_question WHERE custom_question_id = $questionId") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-questions?id=$jobId");
}

if (isset($_POST['submitJ'])) 
{
    $titles = [];
    $questions = [];
    $questionTypes = [];
    $options = [];

    $hiddenInfoQuestions = $_POST['shhh'.$high];
    // $type = $_POST['questionType'.$high];
    $questionsArray = explode(",", $hiddenInfoQuestions);

    foreach ($questionsArray as $value)
    {
        
        $myTitle = $_POST['title'.$value];
        $myQuestion = $_POST['question'.$value];
        $myQuestionType = $_POST['questionType'.$value];

        if ($myQuestionType == 2)
        {
            
            $option1 = $_POST['option1_'.$value];
            $option2 = $_POST['option2_'.$value];
            $option3 = $_POST['option3_'.$value];
            $option4 = $_POST['option4_'.$value];
            $option5 = $_POST['option5_'.$value];
            $option6 = $_POST['option6_'.$value];

        }
        else
        {
            $option1 = null;
            $option2 = null;
            $option3 = null;
            $option4 = null;
            $option5 = null;
            $option6 = null;
        }
        
        array_push($titles, $myTitle);
        array_push($questions, $myQuestion);
        array_push($questionTypes, $myQuestionType);

        array_push($options, $option1);
        array_push($options, $option2);
        array_push($options, $option3);
        array_push($options, $option4);

        array_push($options, $option5);
        array_push($options, $option6);
    }

    foreach ($titles as $value)
    {
        echo $value;
    }
    echo PHP_EOL;
    foreach ($questionTypes as $value)
    {
        echo $value;
    }
    echo PHP_EOL;
    foreach ($options as $value)
    {
        echo $value;
    }
    echo PHP_EOL;
    foreach ($questions as $value)
    {
        echo $value;
    }
    mysqli_query($jobConn, "INSERT INTO screening_question (job_id, question_type) VALUES ('$jobId', '$myQuestionType')") or die("Error: " . mysqli_error($jobConn));
    $newResult = mysqli_query($jobConn, "SELECT * FROM screening_question WHERE job_id = $jobId") or die("Error: " . mysqli_error($jobConn));
    $screeningQuestionIds = [];
    foreach ($newResult as $i)
    {
        array_push($screeningQuestionIds, $i['custom_question_id']);
    }
    $myCustomQuestionId = max($screeningQuestionIds);
    if ($myQuestionType == 1)
    {
        mysqli_query($jobConn, "INSERT INTO free_form_question (custom_question_id, question_title, question_text) VALUES ('$myCustomQuestionId', '$myTitle', '$myQuestion')") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($myQuestionType == 2)
    {
        mysqli_query($jobConn, "INSERT INTO multiple_choice_question (custom_question_id, question_title, question_text, choice_1, choice_2, choice_3, choice_4, choice_5, choice_6) VALUES ('$myCustomQuestionId', '$myTitle', '$myQuestion', '$option1', '$option2', '$option3', '$option4', '$option5', '$option6')") or die("Error: " . mysqli_error($jobConn));
    }
    else if ($myQuestionType == 3)
    {
        mysqli_query($jobConn, "INSERT INTO yes_no_question (custom_question_id, question_title, question_text) VALUES ('$myCustomQuestionId', '$myTitle', '$myQuestion')") or die("Error: " . mysqli_error($jobConn));
    }
    else
    {
        mysqli_query($jobConn, "INSERT INTO free_form_question (file_upload_id, question_title, question_text) VALUES ('$myCustomQuestionId', '$myTitle', '$myQuestion')") or die("Error: " . mysqli_error($jobConn));
    }

    // $first_name_edited = str_replace("\\", "", $first_name_raw);
    // $first_name = str_replace("'", "\'", $first_name_edited);
    // mysqli_query($jobConn, "UPDATE candidate SET first_name = '$first_name' WHERE user_id = $user_id") or die("Error: " . mysqli_error($jobConn));
    header("Location: edit-questions?id=$jobId");
}
?>