<?php
include("../includes/job_connect.php");
include("../includes/utils.php");
$url = $_SERVER['REQUEST_URI'];
$url_query = parse_url($url, PHP_URL_QUERY);
$exploded_url_query = explode("=", $url_query);
$unexploded_user_id = $exploded_url_query[1];
$exploded_user_id = explode("&", $unexploded_user_id);
$user_id = $_GET['id'];
$high = $_GET['high'];
$employer_id = $_GET['empId'];
$my_test = $_GET['test'];
// echo $user_id;
// echo "a";
// echo $high;



// $conn = new mysqli("localhost", "root", '', "job_platform");
$result = mysqli_query($jobConn, "SELECT * FROM employer WHERE user_id = '$user_id'") or die("Error: " . mysqli_error($jobConn));
// $besult = mysqli_query($conn, "SELECT * FROM screening_question WHERE user_id = '$employer_id'") or die("Error: " . mysqli_error($conn));
$current_user = mysqli_fetch_array($result);
// $screeningQuestions = mysqli_fetch_array($besult);

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

if (isset($_POST['submitQuestions'])) 
{

    $completeQuestions = [];
    $hiddenInfo = [];
    $newQuestionsArray = explode(",", $my_test);
    $lastNo = end($newQuestionsArray);
    // $title = $_POST['title10'];
    // $question = $_POST['question10'];

    //TODO: fix bug where quotations are being escaped in the below values
    // using stripslashes until I can figure out why the slashes are being added
    // I think it has to do with new-job.php being posted to itself twice but IDK


    $hiddenInfoQuestions = ($_POST['shhh'.$lastNo]);


    // $hiddenInfoPremiumExpiry = $_POST['premiumExpiry'.$high];
    
    $hiddenInfoJobTitle = $_POST['jobTitle'.$lastNo];
    $hiddenInfoAddress =  $_POST['address'.$lastNo];
    $hiddenInfoCity =  $_POST['city'.$lastNo];
    $hiddenInfoProvince =  $_POST['province'.$lastNo];
    $hiddenInfoPostalCode = $_POST['postal_code'.$lastNo];
    $hiddenInfoEmployType =  $_POST['employ_type'.$lastNo];
    $hiddenInfoPaymentType =  $_POST['pay_type'.$lastNo];
    $hiddenInfoSalary =  $_POST['salary'.$lastNo];
    $hiddenInfoDescription = $_POST['description'.$lastNo];


    // echo $hiddenInfoPremiumExpiry;
    // echo $hiddenInfoJobTitle;
    // echo $hiddenInfoAddress;
    // echo $hiddenInfoCity;
    // echo $hiddenInfoProvince;
    // echo $hiddenInfoPostalCode;
    // echo $hiddenInfoEmployType;
    // echo $hiddenInfoSalary;
    // echo $hiddenInfoDescription;

    // array_push($hiddenInfo, $hiddenInfoJobTitle);
    // array_push($hiddenInfo, $hiddenInfoAddress);
    // array_push($hiddenInfo, $hiddenInfoCity);
    // array_push($hiddenInfo, $hiddenInfoProvince);
    // array_push($hiddenInfo, $hiddenInfoPostalCode);
    // array_push($hiddenInfo, $hiddenInfoEmployType);
    // array_push($hiddenInfo, $hiddenInfoSalary);
    // array_push($hiddenInfo, $hiddenInfoDescription); 

    // Set key value pairs on the array
    $hiddenInfo['job_title'] = $hiddenInfoJobTitle;
    $hiddenInfo['address'] = $hiddenInfoAddress;
    $hiddenInfo['city'] = $hiddenInfoCity;
    $hiddenInfo['province'] = $hiddenInfoProvince;
    $hiddenInfo['postal_code'] = $hiddenInfoPostalCode;
    $hiddenInfo['employ_type'] = $hiddenInfoEmployType;
    $hiddenInfo['pay_type'] = $hiddenInfoPaymentType;
    $hiddenInfo['salary'] = $hiddenInfoSalary;
    $hiddenInfo['job_description'] = $hiddenInfoDescription;

    array_push($completeQuestions, $hiddenInfo);

    $questionsArray = explode(",", $hiddenInfoQuestions);
    // $newQuestionsArray = explode(",", $my_test);
    // echo $questionsArray[count($questionsArray)-1];
    // echo $questionsArray;
    $titles = [];
    $questions = [];
    $questionTypes = [];
    $options = [];

    $something = [];
    $iii = 0;
    

    foreach ($newQuestionsArray as $value)
    {
        if ($value != 0)
        {
            $myTitle = $_POST['title'.$value];
            $myQuestion = $_POST['question'.$value];
            $myQuestionType = $_POST['questionType'.$value];
            if (strlen($value) == 1)
            {
                $longValue = '0'.$value;
            }
            else
            {
                $longValue = $value;
            }
            if ($myQuestionType == 2)
            {
                
                $option1 = $longValue.$_POST['option1_'.$value];
                $option2 = $longValue.$_POST['option2_'.$value];
                $option3 = $longValue.$_POST['option3_'.$value];
                $option4 = $longValue.$_POST['option4_'.$value];
                $option5 = $longValue.$_POST['option5_'.$value];
                $option6 = $longValue.$_POST['option6_'.$value];


            }
            else
            {
                $option1 = $longValue;
                $option2 = $longValue;
                $option3 = $longValue;
                $option4 = $longValue;
                $option5 = $longValue;
                $option6 = $longValue;
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

            $iii += 1;
            array_push($something, $iii);
        }
    }

    // foreach ($titles as $value)
    // {
    //     echo $value;
    // }
    // echo PHP_EOL;
    // foreach ($questionTypes as $value)
    // {
    //     echo $value;
    // }
    // echo PHP_EOL;
    // foreach ($options as $value)
    // {
    //     echo $value;
    // }
    // echo PHP_EOL;
    // foreach ($questions as $value)
    // {
    //     echo $value;
    // }

    sort($newQuestionsArray);
    foreach ($something as $value)
    {
        // echo $value;
        $thisQuestion = [];
        $trueValue = ($value - 1);
        $indexOne = ($trueValue * 6);
        $indexTwo = ($indexOne + 1);
        $indexThree = ($indexTwo + 1);
        $indexFour = ($indexThree + 1);
        $indexFive = ($indexFour + 1);
        $indexSix = ($indexFive + 1);
        $insertTitle = $titles[$trueValue];
        $insertQuestion = $questions[$trueValue];
        $insertQuestionType = $questionTypes[$trueValue];
        if (strlen($options[$indexOne]) == 2)
        {
            $insert_option_one = null;
            $insert_option_two = null;
            $insert_option_three = null;
            $insert_option_four = null;
            $insert_option_five = null;
            $insert_option_six = null;
        }
        else
        {
            $insert_option_one = substr($options[$indexOne], 2);
            $insert_option_two = substr($options[$indexTwo], 2);
            $insert_option_three = substr($options[$indexThree], 2);
            $insert_option_four = substr($options[$indexFour], 2);
            $insert_option_five = substr($options[$indexFive], 2);
            $insert_option_six = substr($options[$indexSix], 2);
        }
        // mysqli_query($conn, "INSERT INTO screening_question (question_type, question_title, question, option_one, option_two, option_three, option_four, option_five, option_six) VALUES ('$insertQuestionType', '$insertTitle', '$insertQuestion', '$insert_option_one', '$insert_option_two', '$insert_option_three', '$insert_option_four', '$insert_option_five', '$insert_option_six')") or die("Error: " . mysqli_error($conn));

        array_push($thisQuestion, $insertQuestionType);
        array_push($thisQuestion, $insertTitle);
        array_push($thisQuestion, $insertQuestion);
        array_push($thisQuestion, $insert_option_one);
        array_push($thisQuestion, $insert_option_two);
        array_push($thisQuestion, $insert_option_three);
        array_push($thisQuestion, $insert_option_four);
        array_push($thisQuestion, $insert_option_five);
        array_push($thisQuestion, $insert_option_six);
        array_push($completeQuestions, $thisQuestion);
    }

    // foreach ($completeQuestions as $value)
    // {
    //     foreach ($value as $v)
    //     {
    //         echo $v;
    //     }
    // }


    // echo $title;
    // echo $question;
    // echo $hiddenInfoQuestions;
    // echo $hiddenInfoType;

}

?>