<?php
// include("includes/job_connect.php");
// include("includes/utils.php");
// include("includes/header.php");
// include 'employer/includes/new-job-post.php';
$user = '';
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
// $userId = $_GET['id'];

if (isset($_POST['new-job-post'])) 
{
    // $premium_expiry = $_POST['premium_expiry'];
    $job_title = $_POST['job_title'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $postal_code = $_POST['postal_code'];

    // $expiry_date = $_POST['expiry_date'];

    $employ_type = $_POST['employ_type'];
    $payment_type = $_POST['pay_type'];
    $salary = $_POST['salary'];
    $description = $_POST['description'];

    // echo $premium_expiry;
    // echo $job_title;
    // echo $address;
    // echo $city;
    // echo $province;
    // echo $postal_code;
    // echo "Pay type: " .$payment_type;


    // echo $expiry_date;

    // echo $employ_type;
    // echo $salary;
    // echo $description;

}

$defaults = "1,2,3,4,5,6,7,8,9";

//$job_id= 1;
//$result = mysqli_query($jobConn,"SELECT * From screening_quetion where job_id = $job_id") or die(mysqli_error($jobConn));
?>
<script>
    let defaults = "1,2,3,4,5,6,7,8,9";
</script>
<main>
    <!-- Page content-->
    <div class="container">
        <!-- Question creator -->
        <div class="card my-4 question">
            <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white"
                    class="bi bi-pencil-fill border rounded-5 p-1 mb-2" viewBox="0 0 16 16" style="background-color:#408BD1;">
                    <path
                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                </svg>
                <h6 class="card-title d-inline-block">Custom Question</h6>
                <P class="card-subtitle mb-2 text-muted d-inline-block"> - Create your own question</P>
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
            </div>
        </div>
        <!-- End of question creator -->
        <!-- Blank questions -->
        <!-- <form action="../receive-questions.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>" id="my-sharona" method="POST" enctype="multipart/form-data"> -->
        <form action="payment.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>&high=0&test=1,2,3,4,5,6,7,8,9,0" id="my-sharona" method="POST" enctype="multipart/form-data">
            <input class="d-none" id="shhh0" name="shhh0" value="1,2,3,4,5,6,7,8,9,0"></input>
            <input class="d-none" id="jobTitle0" name="jobTitle0" value="<?php echo $job_title ?>"></input>
            <input class="d-none" id="address0" name="address0" value="<?php echo $address ?>"></input>
            <input class="d-none" id="city0" name="city0" value="<?php echo $city ?>"></input>
            <input class="d-none" id="province0" name="province0" value="<?php echo $province ?>"></input>
            <input class="d-none" id="postal_code0" name="postal_code0" value="<?php echo $postal_code ?>"></input>
            <input class="d-none" id="employ_type0" name="employ_type0" value="<?php echo $employ_type ?>"></input>
            <input class="d-none" id="pay_type0" name="pay_type0" value="<?php echo $payment_type ?>"></input>
            <input class="d-none" id="salary0" name="salary0" value="<?php echo $salary ?>"></input>
            <input class="d-none" id="description0" name="description0" value="<?php echo $description ?>"></input>
            
            <!-- free form blank question -->
            <!-- <div class="card mt-2" id="close" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
                <div class="card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white"
                        class="bi bi-newspaper border rounded-5 p-1" viewBox="0 0 16 16" style="background-color:#408BD1;">
                        <path
                            d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z" />
                        <path
                            d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z" />
                    </svg>
                    <h6 class="card-title d-inline-block col-5">
                        <input class="form-control" type="text" name="title" placeholder="Enter the question title">
                    </h6>
                    <button type="button" class="btn-close position-absolute end-0 top-0 m-3" 
                        onclick="closeFunction()"></button>
                    <div class="avatar-sm mx-auto">
                        <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <input class="form-control col-9 mb-3" type="text" name="question" placeholder="Enter the question">
                    </div>
                    <div class="row ">
                        <div class="form-group">
                            <textarea class="form-control rounded-2" id="exampleFormControlTextarea2" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>  -->
            <!-- End of free form blank question -->
            <!-- Multiple Choice blank question -->
            <!-- <div class="card mt-3" id="close" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
                <div class="card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white"
                        class="bi bi-ui-checks-grid border rounded-5 p-1 " viewBox="0 0 16 16" style="background-color:#408BD1;">
                        <path
                            d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1zm9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm0 9a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-3zm0-10a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-3zM2 9a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h3a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H2zm7 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-3a2 2 0 0 1-2-2v-3zM0 2a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5.354.854a.5.5 0 1 0-.708-.708L3 3.793l-.646-.647a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0l2-2z" />
                    </svg>
                    <h6 class="d-inline-block col-5">
                        <input class="form-control" type="text" name="question" placeholder="Enter the question title">
                    </h6>
                    <button type="button" class="btn-close position-absolute end-0 top-0 m-3" 
                        onclick="closeFunction()"></button>
                    <div class="avatar-sm mx-auto">
                        <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <input class="form-control mb-3" type="text" name="title" placeholder="Enter the question">
                    </div>
                    <div class="col-4">
                        <input class="form-control mb-3" type="text" name="option1" id="option1" placeholder="Enter option one">
                    </div>
                    <div class="col-4">
                        <input class="form-control mb-3" type="text" name="option2" id="option2" placeholder="Enter option two">
                    </div>
                    <div class="col-4">
                        <input class="form-control mb-3" type="text" name="option3" id="option3" placeholder="Enter option three">
                    </div>
                    <div class="col-4">
                        <input class="form-control mb-3" type="text" name="option4" id="option4" placeholder="Enter option four">
                    </div>
                    <div class="col-4">
                        <input class="form-control mb-3" type="text" name="option5" id="option5" placeholder="Enter option five">
                    </div>
                    <div class="col-4">
                        <input class="form-control mb-3" type="text" name="option6" id="option6" placeholder="Enter option six">
                    </div>   
                </div>
            </div> -->
            <!-- End of Multiple Choice blank question -->
            <!-- Yes/No blank question -->
            <!-- <div class="card mt-3" id="close" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
                <div class="card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white"
                        class="bi bi-slash-circle border rounded-5 p-1" viewBox="0 0 16 16" style="background-color:#408BD1;">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M11.354 4.646a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708z" />
                    </svg>
                    <h6 class="d-inline-block col-5">
                        <input class="form-control" type="text" name="title" placeholder="Enter the question title">
                    </h6>
                    <button type="button" class="btn-close position-absolute end-0 top-0 m-3" 
                        onclick="closeFunction()"></button>
                    <div class="avatar-sm  mx-auto">
                        <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <input class="form-control mb-3" type="text" name="question" placeholder="Enter the question">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            No
                        </label>
                    </div>
                </div>
            </div> -->
            <!-- End of Yes/No blank question -->
            <!-- File Upload blank question -->
            <!-- <div class="card mt-3" id="close" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
                <div class="card-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="white"
                        class="bi bi-calendar-event-fill border rounded-5 p-1" viewBox="0 0 16 16" style="background-color:#408BD1;">
                        <path
                            d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z" />
                    </svg>
                    <h6 class="card-title d-inline-block col-5">
                        <input class="form-control" type="text" name="title" placeholder="Enter the question title">
                    </h6>
                    <button type="button" class="btn-close position-absolute end-0 top-0 m-3" 
                        onclick="closeFunction()"></button>
                    <div class="avatar-sm mx-auto">
                        <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <div>
                            <input class="form-control mb-3" type="text" name="question" placeholder="Enter the question">
                        </div>
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="inputGroupFile02">
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- End of File Upload blank question -->
        <!-- End of Blank questions -->
        <!-- free form question mockup -->
        <div class=" d-none card mt-2 question" id="close1" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
            <div class="card-header">
                <h6 class="card-title d-inline-block">Free Form/License & Certificates</h6>
                <input class="d-none" id="title1" name="title1" value="Free Form/License & Certificates"></input>
                <input class="d-none" id="questionType1" name="questionType1" value=1></input>
                
                <button type="button" id="1" class="btn-close position-absolute end-0 top-0 m-3" 
                    onclick="closeFunction('1')"></button>
                <div class="avatar-sm mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>What license and certifications do you have?</p>
                <input class="d-none" id="question1" name="question1" value="What license and certifications do you have?"></input>
                <div class="row ">
                    <div class="form-group">
                        <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" disabled></textarea>
                    </div>
                </div>
            </div>
        </div> 
        <!-- End of free form question mockup-->
        <!-- File Upload question mockup -->
        <div class="d-none card mt-3 question" id="close2" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
            <div class="card-header">
                <h6 class="card-title d-inline-block">File Upload/Resume</h6>
                <input class="d-none" id="title2" name="title2" value="File Upload/Resume"></input>
                <input class="d-none" id="questionType2" name="questionType2" value=4></input>
                <button id="2" type="button" class="btn-close position-absolute end-0 top-0 m-3" 
                    onclick="closeFunction('2')"></button>
                <div class="avatar-sm mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <p>Please Upload your resume</p>
                    <input class="d-none" id="question2" name="question2" value="Please Upload your resume"></input>
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="inputGroupFile02" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- File Upload question mockup -->
        <!-- Multiple choice question mockup -->
        <div class="d-none card mt-3 question" id="close3" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
            <div class="card-header">
                <h6 class="d-inline-block">Multiple choice/Benefits</h6>
                <input class="d-none" id="title3" name="title3" value="Multiple choice/Benefits"></input>
                <input class="d-none" id="questionType3" name="questionType3" value=2></input>
                <button id="3" type="button" class="btn-close position-absolute end-0 top-0 m-3" 
                    onclick="closeFunction('3')"></button>
                <div class="avatar-sm mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
            </div>
            <div class="d-none card-body">
                <p>Select which benefits you would like:</p>
                <input class="d-none" id="question3" name="question3" value="Select which benefits you would like:"></input>
                
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" disabled>
                    <input class="d-none" value="Dental" id="option1_3" name="option1_3">
                    <label class="form-check-label" for="option1_3"> 
                        Dental
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Health" checked disabled>
                    <input class="d-none" value="Health" id="option2_3" name="option2_3">
                    <label class="form-check-label" for="option2_3">
                        Health
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" checked disabled>
                    <input class="d-none" value="Vision" id="option3_3" name="option3_3">
                    <label class="form-check-label" for="option3_3">
                        Vision
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Wellness" checked disabled>
                    <input class="d-none" value="Wellness" id="option4_3" name="option4_3">
                    <label class="form-check-label" for="option4_3">
                        Wellness
                    </label>
                </div>
                <div class="d-none">
                    <input class="form-check-input" type="checkbox" value=null id="option5_3" name="option5_3" checked>
                    <label class="form-check-label" for="option5_3">
                        Wellness
                    </label>
                </div>
                <div class="d-none">
                    <input class="form-check-input" type="checkbox" value=null id="option6_3" name="option6_3" checked>
                    <label class="form-check-label" for="option6_3">
                        Wellness
                    </label>
                </div>
            </div>
        </div>
        <!-- End of multiple choice question mockup -->
        <!-- Yes/No question mockup -->
        <div class="d-none card mt-3 question" id="close4" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
            <div class="card-header">
                <h6 class="d-inline-block">Yes-No/Work Authorization</h6>
                <input class="d-none" id="title4" name="title4" value="Yes-No/Work Authorization"></input>
                <input class="d-none" id="questionType4" name="questionType4" value=3></input>
                <button id="4" type="button" class="btn-close position-absolute end-0 top-0 m-3" 
                    onclick="closeFunction('4')"></button>
                <div class="avatar-sm  mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
            </div>
            <div class="d-none card-body">
                <p>Are you eligible to work in Canada?</p>
                <input class="d-none" id="question4" name="question4" value="Are you eligible to work in Canada?"></input>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault01" id="flexRadioDefault01" checked disabled>
                    <label class="form-check-label" for="flexRadioDefault01">
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault01" id="flexRadioDefault02" disabled>
                    <label class="form-check-label" for="flexRadioDefault02">
                        No
                    </label>
                </div>
            </div>
        </div>
        <!-- End of yes/No question mockup -->
        <!-- Date question mockup -->
        <div class="d-none card mt-3 question" id="close5" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
            <div class="card-header">
                <h6 class="card-title d-inline-block">Free Form/Start Date</h6>
                <input class="d-none" id="title5" name="title5" value="Free Form/Start Date"></input>
                <input class="d-none" id="questionType5" name="questionType5" value=1></input>
                <button id="5" type="button" class="btn-close position-absolute end-0 top-0 m-3" 
                    onclick="closeFunction('5')"></button>
                <div class="avatar-sm mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
            </div>
            <div class="d-none card-body">
                <div>
                    <p>When can you start?</p>
                    <input class="d-none" id="question5" name="question5" value="When can you start?"></input>
                    <div class="col-3">
                        <input class="form-control" type="text" id="date-selection" name="date-selection" min="2018-01-01" placeholder="date" disabled>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of date question mockup -->
        <!-- Number question mockup -->
        <div class="d-none card mt-3 question" id="close6" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
            <div class="card-header">
                <h6 class="card-title d-inline-block">Free Form/Age</h6>
                <input class="d-none" id="title6" name="title6" value="Free Form/Age"></input>
                <input class="d-none" id="questionType6" name="questionType6" value=1></input>
                <button id="6" type="button" class="btn-close position-absolute end-0 top-0 m-3" 
                    onclick="closeFunction('6')"></button>
                <div class="avatar-sm mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
            </div>
            <div class="d-none card-body">
                <div>
                    <p>How old are you?</p>
                    <input class="d-none" id="question6" name="question6" value="How old are you?"></input>
                    <div class="col-3">
                        <input class="d-block d-lg-inline form-control col-3" type="number" placeholder="number" disabled>
                    </div>
                </div>
            </div> 
        </div>
        <!-- End of number question mockup -->
        <!-- Yes/No question mockup -->
        <div class="d-none card mt-3 question" id="close7" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
            <div class="card-header">
                <h6 class="d-inline-block">Yes-No/Background Check</h6>
                <input class="d-none" id="title7" name="title7" value="Yes-No/Background Check"></input>
                <input class="d-none" id="questionType7" name="questionType7" value=3></input>
                <button id="7" type="button" class="btn-close position-absolute end-0 top-0 m-3" 
                    onclick="closeFunction('7')"></button>
                <div class="avatar-sm  mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
            </div>
            <div class="d-none card-body">
                <p>Are you willing to undergo a background check in accordance with local laws and regulations?</p>
                <input class="d-none" id="question7" name="question7" value="Are you willing to undergo a background check in accordance with local laws and regulations?"></input>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault011" id="flexRadioDefault011" checked disabled>
                    <label class="form-check-label" for="flexRadioDefault011">
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault011" id="flexRadioDefault012" disabled>
                    <label class="form-check-label" for="flexRadioDefault012">
                        No
                    </label>
                </div>
            </div>
        </div>
        <!-- End of yes/No question mockup -->
        <!-- Yes/No question mockup -->
        <div class="d-none card mt-3 question" id="close8" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
            <div class="card-header">
                <h6 class="d-inline-block">Yes-No/Overtime</h6>
                <input class="d-none" id="title8" name="title8" value="Yes-No/Overtime"></input>
                <input class="d-none" id="questionType8" name="questionType8" value=3></input>
                <button id="8" type="button" class="btn-close position-absolute end-0 top-0 m-3" 
                    onclick="closeFunction('8')"></button>
                <div class="avatar-sm  mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
            </div>
            <div class="d-none card-body">
                <p>Can you work overtime if necessary?</p>
                <input class="d-none" id="question8" name="question8" value="Can you work overtime if necessary?"></input>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault0111" id="flexRadioDefault0111" disabled>
                    <label class="form-check-label" for="flexRadioDefault0111">
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault0111" id="flexRadioDefault0112" checked disabled>
                    <label class="form-check-label" for="flexRadioDefault0112">
                        No
                    </label>
                </div>
            </div>
        </div>
        <!-- End of yes/No question mockup -->
        <!-- Yes/No question mockup -->
        <div class="d-none card mt-3 mb-3 question" id="close9" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
            <div class="card-header">
                <h6 class="d-inline-block">Yes-No/Commute</h6>
                <input class="d-none" id="title9" name="title9" value="Yes-No/Commute"></input>
                <input class="d-none" id="questionType9" name="questionType9" value=3></input>
                <button id="9" type="button" class="btn-close position-absolute end-0 top-0 m-3" 
                    onclick="closeFunction('9')"></button>
                <div class="avatar-sm  mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>Can you reliably commute to this job's location?</p>
                <input class="d-none" id="question9" name="question9" value="Can you reliably commute to this job's location?"></input>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault01111" id="flexRadioDefault01111" checked disabled>
                    <label class="form-check-label" for="flexRadioDefault01111">
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault01111" id="flexRadioDefault01112" disabled>
                    <label class="form-check-label" for="flexRadioDefault01112">
                        No
                    </label>
                </div>
                <!-- <button type="button" class="mt-3 px-4 btn btn-outline-success btn-rounded btn-sm" style="border-radius:20px;">Save Question</button> -->
            </div>
        </div>
        <!-- End of yes/No question mockup -->

        <!-- submit button -->
        <div class="mb-3 text-lg-end text-center">
            <button type="submit" class="btn mt-2 col-12 col-md-6 col-lg-2 btn-rounded text-white" style="border-radius:20px; background-color:#408BD1;" name="submitQuestions">Save Questions</button>
        </div>
        </form>
    </div>
    
    <!-- End of container div -->
</main>
<script>
        let mySharona = document.getElementById("my-sharona");
        let closeButtonOne = document.getElementById("1");
        let closeButtonTwo = document.getElementById("2");
        let questions = [1,2,3,4,5,6,7,8,9];
        let customQuestions = "";
        let allowedQuestions = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,100];
        let freeQuestions = allowedQuestions.filter(function(obj) { return questions.indexOf(obj) == -1; });
        let currentQuestion = Math.min(...freeQuestions);
        // console.log(freeQuestions);
        // console.log(currentQuestion);

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
                console.log("urrrggghh??");
                defaults = defaults.replace(buttonID+",", "");
                defaults = defaults.concat(",0");
                

                questions.splice(index, 1); //bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb
                freeQuestions.push(myID);
                freeQuestions.sort(function(a, b){return a-b});
                currentQuestion = Math.min(...freeQuestions);
                myQuestion.remove();
                // mySharona.setAttribute("action", "../receive-questions.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>&high="+questions.length.toString());
                mySharona.setAttribute("action", "payment.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>&test="+defaults+customQuestions+"&high="+questions.length.toString());

            // customQuestions = customQuestions.concat("," + currentQuestion);


            // questions.push(currentQuestion);
            // console.log("a");
            // console.log(currentQuestion);
            // questions.sort(function(a, b){return a-b});
            // freeQuestions = allowedQuestions.filter(function(obj) { return questions.indexOf(obj) == -1; });
            
            let hiddenInfoQuestions = document.createElement('input');
            hiddenInfoQuestions.className = "d-none";
            hiddenInfoQuestions.value = questions;
            hiddenInfoQuestions.setAttribute("id", "shhh0");
            hiddenInfoQuestions.setAttribute("name", "shhh0");
            // console.log(questions);

            let hiddenInfoType = document.createElement('input');
            hiddenInfoType.className = "d-none";
            hiddenInfoType.value = 2;
            hiddenInfoType.setAttribute("id", "questionType0");
            hiddenInfoType.setAttribute("name", "questionType0");

            let hiddenInfoJobTitle = document.createElement('input');
            hiddenInfoJobTitle.className = "d-none";
            hiddenInfoJobTitle.value = '<?php echo $job_title ?>';
            hiddenInfoJobTitle.setAttribute("id", "jobTitle0");
            hiddenInfoJobTitle.setAttribute("name", "jobTitle0");

            let hiddenInfoAddress = document.createElement('input');
            hiddenInfoAddress.className = "d-none";
            hiddenInfoAddress.value = '<?php echo $address ?>';
            hiddenInfoAddress.setAttribute("id", "address0");
            hiddenInfoAddress.setAttribute("name", "address0");

            let hiddenInfoCity = document.createElement('input');
            hiddenInfoCity.className = "d-none";
            hiddenInfoCity.value = '<?php echo $city ?>';
            hiddenInfoCity.setAttribute("id", "city0");
            hiddenInfoCity.setAttribute("name", "city0");

            let hiddenInfoProvince = document.createElement('input');
            hiddenInfoProvince.className = "d-none";
            hiddenInfoProvince.value = '<?php echo $province ?>';
            hiddenInfoProvince.setAttribute("id", "province0");
            hiddenInfoProvince.setAttribute("name", "province0");

            let hiddenInfoPostalCode = document.createElement('input');
            hiddenInfoPostalCode.className = "d-none";
            hiddenInfoPostalCode.value = '<?php echo $postal_code ?>';
            hiddenInfoPostalCode.setAttribute("id", "postal_code0");
            hiddenInfoPostalCode.setAttribute("name", "postal_code0");

            let hiddenInfoEmployType = document.createElement('input');
            hiddenInfoEmployType.className = "d-none";
            hiddenInfoEmployType.value = '<?php echo $employ_type ?>';
            hiddenInfoEmployType.setAttribute("id", "employ_type0");
            hiddenInfoEmployType.setAttribute("name", "employ_type0");

            let hiddenInfoPaymentType = document.createElement('input');
            hiddenInfoPaymentType.className = "d-none";
            hiddenInfoPaymentType.value = '<?php echo $payment_type ?>';
            hiddenInfoPaymentType.setAttribute("id", "pay_type0");
            hiddenInfoPaymentType.setAttribute("name", "pay_type0");

            let hiddenInfoSalary = document.createElement('input');
            hiddenInfoSalary.className = "d-none";
            hiddenInfoSalary.value = '<?php echo $salary ?>';
            hiddenInfoSalary.setAttribute("id", "salary0");
            hiddenInfoSalary.setAttribute("name", "salary0");

            let hiddenInfoDescription = document.createElement('input');
            hiddenInfoDescription.className = "d-none";
            hiddenInfoDescription.value = '<?php echo $description ?>';
            hiddenInfoDescription.setAttribute("id", "description0");
            hiddenInfoDescription.setAttribute("name", "description0");

            card.append(hiddenInfoQuestions);
            card.append(hiddenInfoType);
            // card.append(hiddenInfoPremiumExpiry);
            card.append(hiddenInfoJobTitle);
            card.append(hiddenInfoAddress);
            card.append(hiddenInfoCity);
            card.append(hiddenInfoProvince);
            card.append(hiddenInfoPostalCode);
            card.append(hiddenInfoEmployType);
            card.append(hiddenInfoPaymentType);
            card.append(hiddenInfoSalary);
            card.append(hiddenInfoDescription);

            currentQuestion = Math.min(...freeQuestions);
            mySharona.setAttribute("action", "payment.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>&test="+defaults+customQuestions+"&high="+questions.length.toString());
            // mySharona.setAttribute("action", "../receive-questions.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>&high="+questions.length.toString());
            mySharona.prepend(card);
            }
            // console.log(myID);
            // console.log(questions);
            // console.log(freeQuestions);

        }


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
        card.className = "card mt-3 question";
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
            customQuestions = customQuestions.concat("," + currentQuestion);
             // aaaaaaaaaaaaaaaaaaaaaaaaaaaa
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
            console.log(questions);

            let hiddenInfoType = document.createElement('input');
            hiddenInfoType.className = "d-none";
            hiddenInfoType.value = 1;
            hiddenInfoType.setAttribute("id", "questionType"+currentQuestion.toString());
            hiddenInfoType.setAttribute("name", "questionType"+currentQuestion.toString());

            let hiddenInfoJobTitle = document.createElement('input');
            hiddenInfoJobTitle.className = "d-none";
            hiddenInfoJobTitle.value = '<?php echo $job_title ?>';
            hiddenInfoJobTitle.setAttribute("id", "jobTitle"+currentQuestion.toString());
            hiddenInfoJobTitle.setAttribute("name", "jobTitle"+currentQuestion.toString());

            let hiddenInfoAddress = document.createElement('input');
            hiddenInfoAddress.className = "d-none";
            hiddenInfoAddress.value = '<?php echo $address ?>';
            hiddenInfoAddress.setAttribute("id", "address"+currentQuestion.toString());
            hiddenInfoAddress.setAttribute("name", "address"+currentQuestion.toString());

            let hiddenInfoCity = document.createElement('input');
            hiddenInfoCity.className = "d-none";
            hiddenInfoCity.value = '<?php echo $city ?>';
            hiddenInfoCity.setAttribute("id", "city"+currentQuestion.toString());
            hiddenInfoCity.setAttribute("name", "city"+currentQuestion.toString());

            let hiddenInfoProvince = document.createElement('input');
            hiddenInfoProvince.className = "d-none";
            hiddenInfoProvince.value = '<?php echo $province ?>';
            hiddenInfoProvince.setAttribute("id", "province"+currentQuestion.toString());
            hiddenInfoProvince.setAttribute("name", "province"+currentQuestion.toString());

            let hiddenInfoPostalCode = document.createElement('input');
            hiddenInfoPostalCode.className = "d-none";
            hiddenInfoPostalCode.value = '<?php echo $postal_code ?>';
            hiddenInfoPostalCode.setAttribute("id", "postal_code"+currentQuestion.toString());
            hiddenInfoPostalCode.setAttribute("name", "postal_code"+currentQuestion.toString());

            let hiddenInfoEmployType = document.createElement('input');
            hiddenInfoEmployType.className = "d-none";
            hiddenInfoEmployType.value = '<?php echo $employ_type ?>';
            hiddenInfoEmployType.setAttribute("id", "employ_type"+currentQuestion.toString());
            hiddenInfoEmployType.setAttribute("name", "employ_type"+currentQuestion.toString());

            let hiddenInfoPaymentType = document.createElement('input');
            hiddenInfoPaymentType.className = "d-none";
            hiddenInfoPaymentType.value = '<?php echo $payment_type ?>';
            hiddenInfoPaymentType.setAttribute("id", "pay_type"+currentQuestion.toString());
            hiddenInfoPaymentType.setAttribute("name", "pay_type"+currentQuestion.toString());

            let hiddenInfoSalary = document.createElement('input');
            hiddenInfoSalary.className = "d-none";
            hiddenInfoSalary.value = '<?php echo $salary ?>';
            hiddenInfoSalary.setAttribute("id", "salary"+currentQuestion.toString());
            hiddenInfoSalary.setAttribute("name", "salary"+currentQuestion.toString());

            let hiddenInfoDescription = document.createElement('input');
            hiddenInfoDescription.className = "d-none";
            hiddenInfoDescription.value = '<?php echo $description ?>';
            hiddenInfoDescription.setAttribute("id", "description"+currentQuestion.toString());
            hiddenInfoDescription.setAttribute("name", "description"+currentQuestion.toString());

            card.append(hiddenInfoQuestions);
            card.append(hiddenInfoType);
            // card.append(hiddenInfoPremiumExpiry);
            card.append(hiddenInfoJobTitle);
            card.append(hiddenInfoAddress);
            card.append(hiddenInfoCity);
            card.append(hiddenInfoProvince);
            card.append(hiddenInfoPostalCode);
            card.append(hiddenInfoEmployType);
            card.append(hiddenInfoPaymentType);
            card.append(hiddenInfoSalary);
            card.append(hiddenInfoDescription);

            currentQuestion = Math.min(...freeQuestions);
            mySharona.setAttribute("action", "payment.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>&test="+defaults+customQuestions+"&high="+questions.length.toString());
            // mySharona.setAttribute("action", "../receive-questions.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>&high="+questions.length.toString());
            mySharona.prepend(card);
            
        }
        }


        function createMultipleChoice() 
        {
        
        let card = document.createElement('div');
        card.className = "card mt-3 question";
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
            customQuestions = customQuestions.concat("," + currentQuestion);
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
            console.log(questions);

            let hiddenInfoType = document.createElement('input');
            hiddenInfoType.className = "d-none";
            hiddenInfoType.value = 2;
            hiddenInfoType.setAttribute("id", "questionType"+currentQuestion.toString());
            hiddenInfoType.setAttribute("name", "questionType"+currentQuestion.toString());

            let hiddenInfoJobTitle = document.createElement('input');
            hiddenInfoJobTitle.className = "d-none";
            hiddenInfoJobTitle.value = '<?php echo $job_title ?>';
            hiddenInfoJobTitle.setAttribute("id", "jobTitle"+currentQuestion.toString());
            hiddenInfoJobTitle.setAttribute("name", "jobTitle"+currentQuestion.toString());

            let hiddenInfoAddress = document.createElement('input');
            hiddenInfoAddress.className = "d-none";
            hiddenInfoAddress.value = '<?php echo $address ?>';
            hiddenInfoAddress.setAttribute("id", "address"+currentQuestion.toString());
            hiddenInfoAddress.setAttribute("name", "address"+currentQuestion.toString());

            let hiddenInfoCity = document.createElement('input');
            hiddenInfoCity.className = "d-none";
            hiddenInfoCity.value = '<?php echo $city ?>';
            hiddenInfoCity.setAttribute("id", "city"+currentQuestion.toString());
            hiddenInfoCity.setAttribute("name", "city"+currentQuestion.toString());

            let hiddenInfoProvince = document.createElement('input');
            hiddenInfoProvince.className = "d-none";
            hiddenInfoProvince.value = '<?php echo $province ?>';
            hiddenInfoProvince.setAttribute("id", "province"+currentQuestion.toString());
            hiddenInfoProvince.setAttribute("name", "province"+currentQuestion.toString());

            let hiddenInfoPostalCode = document.createElement('input');
            hiddenInfoPostalCode.className = "d-none";
            hiddenInfoPostalCode.value = '<?php echo $postal_code ?>';
            hiddenInfoPostalCode.setAttribute("id", "postal_code"+currentQuestion.toString());
            hiddenInfoPostalCode.setAttribute("name", "postal_code"+currentQuestion.toString());

            let hiddenInfoEmployType = document.createElement('input');
            hiddenInfoEmployType.className = "d-none";
            hiddenInfoEmployType.value = '<?php echo $employ_type ?>';
            hiddenInfoEmployType.setAttribute("id", "employ_type"+currentQuestion.toString());
            hiddenInfoEmployType.setAttribute("name", "employ_type"+currentQuestion.toString());

            let hiddenInfoPaymentType = document.createElement('input');
            hiddenInfoPaymentType.className = "d-none";
            hiddenInfoPaymentType.value = '<?php echo $payment_type ?>';
            hiddenInfoPaymentType.setAttribute("id", "pay_type"+currentQuestion.toString());
            hiddenInfoPaymentType.setAttribute("name", "pay_type"+currentQuestion.toString());

            let hiddenInfoSalary = document.createElement('input');
            hiddenInfoSalary.className = "d-none";
            hiddenInfoSalary.value = '<?php echo $salary ?>';
            hiddenInfoSalary.setAttribute("id", "salary"+currentQuestion.toString());
            hiddenInfoSalary.setAttribute("name", "salary"+currentQuestion.toString());

            let hiddenInfoDescription = document.createElement('input');
            hiddenInfoDescription.className = "d-none";
            hiddenInfoDescription.value = '<?php echo $description ?>';
            hiddenInfoDescription.setAttribute("id", "description"+currentQuestion.toString());
            hiddenInfoDescription.setAttribute("name", "description"+currentQuestion.toString());

            card.append(hiddenInfoQuestions);
            card.append(hiddenInfoType);
            // card.append(hiddenInfoPremiumExpiry);
            card.append(hiddenInfoJobTitle);
            card.append(hiddenInfoAddress);
            card.append(hiddenInfoCity);
            card.append(hiddenInfoProvince);
            card.append(hiddenInfoPostalCode);
            card.append(hiddenInfoEmployType);
            card.append(hiddenInfoPaymentType);
            card.append(hiddenInfoSalary);
            card.append(hiddenInfoDescription);

            currentQuestion = Math.min(...freeQuestions);
            mySharona.setAttribute("action", "payment.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>&test="+defaults+customQuestions+"&high="+questions.length.toString());
            // mySharona.setAttribute("action", "../receive-questions.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>&high="+questions.length.toString());
            mySharona.prepend(card);
        }
        }

        function createYesNo() 
        {
        
        let card = document.createElement('div');
        card.className = "card mt-3 question";
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
            customQuestions = customQuestions.concat("," + currentQuestion);
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
            console.log(questions);

            let hiddenInfoType = document.createElement('input');
            hiddenInfoType.className = "d-none";
            hiddenInfoType.value = 3;
            hiddenInfoType.setAttribute("id", "questionType"+currentQuestion.toString());
            hiddenInfoType.setAttribute("name", "questionType"+currentQuestion.toString());



            let hiddenInfoJobTitle = document.createElement('input');
            hiddenInfoJobTitle.className = "d-none";
            hiddenInfoJobTitle.value = '<?php echo $job_title ?>';
            hiddenInfoJobTitle.setAttribute("id", "jobTitle"+currentQuestion.toString());
            hiddenInfoJobTitle.setAttribute("name", "jobTitle"+currentQuestion.toString());

            let hiddenInfoAddress = document.createElement('input');
            hiddenInfoAddress.className = "d-none";
            hiddenInfoAddress.value = '<?php echo $address ?>';
            hiddenInfoAddress.setAttribute("id", "address"+currentQuestion.toString());
            hiddenInfoAddress.setAttribute("name", "address"+currentQuestion.toString());

            let hiddenInfoCity = document.createElement('input');
            hiddenInfoCity.className = "d-none";
            hiddenInfoCity.value = '<?php echo $city ?>';
            hiddenInfoCity.setAttribute("id", "city"+currentQuestion.toString());
            hiddenInfoCity.setAttribute("name", "city"+currentQuestion.toString());

            let hiddenInfoProvince = document.createElement('input');
            hiddenInfoProvince.className = "d-none";
            hiddenInfoProvince.value = '<?php echo $province ?>';
            hiddenInfoProvince.setAttribute("id", "province"+currentQuestion.toString());
            hiddenInfoProvince.setAttribute("name", "province"+currentQuestion.toString());

            let hiddenInfoPostalCode = document.createElement('input');
            hiddenInfoPostalCode.className = "d-none";
            hiddenInfoPostalCode.value = '<?php echo $postal_code ?>';
            hiddenInfoPostalCode.setAttribute("id", "postal_code"+currentQuestion.toString());
            hiddenInfoPostalCode.setAttribute("name", "postal_code"+currentQuestion.toString());

            let hiddenInfoEmployType = document.createElement('input');
            hiddenInfoEmployType.className = "d-none";
            hiddenInfoEmployType.value = '<?php echo $employ_type ?>';
            hiddenInfoEmployType.setAttribute("id", "employ_type"+currentQuestion.toString());
            hiddenInfoEmployType.setAttribute("name", "employ_type"+currentQuestion.toString());

            let hiddenInfoPaymentType = document.createElement('input');
            hiddenInfoPaymentType.className = "d-none";
            hiddenInfoPaymentType.value = '<?php echo $payment_type ?>';
            hiddenInfoPaymentType.setAttribute("id", "pay_type"+currentQuestion.toString());
            hiddenInfoPaymentType.setAttribute("name", "pay_type"+currentQuestion.toString());

            let hiddenInfoSalary = document.createElement('input');
            hiddenInfoSalary.className = "d-none";
            hiddenInfoSalary.value = '<?php echo $salary ?>';
            hiddenInfoSalary.setAttribute("id", "salary"+currentQuestion.toString());
            hiddenInfoSalary.setAttribute("name", "salary"+currentQuestion.toString());

            let hiddenInfoDescription = document.createElement('input');
            hiddenInfoDescription.className = "d-none";
            hiddenInfoDescription.value = '<?php echo $description ?>';
            hiddenInfoDescription.setAttribute("id", "description"+currentQuestion.toString());
            hiddenInfoDescription.setAttribute("name", "description"+currentQuestion.toString());

            card.append(hiddenInfoQuestions);
            card.append(hiddenInfoType);
            // card.append(hiddenInfoPremiumExpiry);
            card.append(hiddenInfoJobTitle);
            card.append(hiddenInfoAddress);
            card.append(hiddenInfoCity);
            card.append(hiddenInfoProvince);
            card.append(hiddenInfoPostalCode);
            card.append(hiddenInfoEmployType);
            card.append(hiddenInfoPaymentType);
            card.append(hiddenInfoSalary);
            card.append(hiddenInfoDescription);

            currentQuestion = Math.min(...freeQuestions);
            mySharona.setAttribute("action", "payment.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>&test="+defaults+customQuestions+"&high="+questions.length.toString());
            // mySharona.setAttribute("action", "../receive-questions.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>&high="+questions.length.toString());
            mySharona.prepend(card);
        }
        }

        function createUploadFile()
        {
        
        let card = document.createElement('div');
        card.className = "card mt-3 question";
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
            customQuestions = customQuestions.concat("," + currentQuestion);
            questions.push(currentQuestion);
            console.log("a");
            console.log("b:" + customQuestions);
            questions.sort(function(a, b){return a-b});
            freeQuestions = allowedQuestions.filter(function(obj) { return questions.indexOf(obj) == -1; });
            

            let hiddenInfoQuestions = document.createElement('input');
            hiddenInfoQuestions.className = "d-none";
            hiddenInfoQuestions.value = questions;
            hiddenInfoQuestions.setAttribute("id", "shhh"+currentQuestion.toString());
            hiddenInfoQuestions.setAttribute("name", "shhh"+currentQuestion.toString());
            console.log(questions);

            let hiddenInfoType = document.createElement('input');
            hiddenInfoType.className = "d-none";
            hiddenInfoType.value = 4;
            hiddenInfoType.setAttribute("id", "questionType"+currentQuestion.toString());
            hiddenInfoType.setAttribute("name", "questionType"+currentQuestion.toString());



            let hiddenInfoJobTitle = document.createElement('input');
            hiddenInfoJobTitle.className = "d-none";
            hiddenInfoJobTitle.value = '<?php echo $job_title ?>';
            hiddenInfoJobTitle.setAttribute("id", "jobTitle"+currentQuestion.toString());
            hiddenInfoJobTitle.setAttribute("name", "jobTitle"+currentQuestion.toString());

            let hiddenInfoAddress = document.createElement('input');
            hiddenInfoAddress.className = "d-none";
            hiddenInfoAddress.value = '<?php echo $address ?>';
            hiddenInfoAddress.setAttribute("id", "address"+currentQuestion.toString());
            hiddenInfoAddress.setAttribute("name", "address"+currentQuestion.toString());

            let hiddenInfoCity = document.createElement('input');
            hiddenInfoCity.className = "d-none";
            hiddenInfoCity.value = '<?php echo $city ?>';
            hiddenInfoCity.setAttribute("id", "city"+currentQuestion.toString());
            hiddenInfoCity.setAttribute("name", "city"+currentQuestion.toString());

            let hiddenInfoProvince = document.createElement('input');
            hiddenInfoProvince.className = "d-none";
            hiddenInfoProvince.value = '<?php echo $province ?>';
            hiddenInfoProvince.setAttribute("id", "province"+currentQuestion.toString());
            hiddenInfoProvince.setAttribute("name", "province"+currentQuestion.toString());

            let hiddenInfoPostalCode = document.createElement('input');
            hiddenInfoPostalCode.className = "d-none";
            hiddenInfoPostalCode.value = '<?php echo $postal_code ?>';
            hiddenInfoPostalCode.setAttribute("id", "postal_code"+currentQuestion.toString());
            hiddenInfoPostalCode.setAttribute("name", "postal_code"+currentQuestion.toString());

            let hiddenInfoEmployType = document.createElement('input');
            hiddenInfoEmployType.className = "d-none";
            hiddenInfoEmployType.value = '<?php echo $employ_type ?>';
            hiddenInfoEmployType.setAttribute("id", "employ_type"+currentQuestion.toString());
            hiddenInfoEmployType.setAttribute("name", "employ_type"+currentQuestion.toString());

            let hiddenInfoPaymentType = document.createElement('input');
            hiddenInfoPaymentType.className = "d-none";
            hiddenInfoPaymentType.value = '<?php echo $payment_type ?>';
            hiddenInfoPaymentType.setAttribute("id", "pay_type"+currentQuestion.toString());
            hiddenInfoPaymentType.setAttribute("name", "pay_type"+currentQuestion.toString());

            let hiddenInfoSalary = document.createElement('input');
            hiddenInfoSalary.className = "d-none";
            hiddenInfoSalary.value = '<?php echo $salary ?>';
            hiddenInfoSalary.setAttribute("id", "salary"+currentQuestion.toString());
            hiddenInfoSalary.setAttribute("name", "salary"+currentQuestion.toString());

            let hiddenInfoDescription = document.createElement('input');
            hiddenInfoDescription.className = "d-none";
            hiddenInfoDescription.value = '<?php echo $description ?>';
            hiddenInfoDescription.setAttribute("id", "description"+currentQuestion.toString());
            hiddenInfoDescription.setAttribute("name", "description"+currentQuestion.toString());

            card.append(hiddenInfoQuestions);
            card.append(hiddenInfoType);
            // card.append(hiddenInfoPremiumExpiry);
            card.append(hiddenInfoJobTitle);
            card.append(hiddenInfoAddress);
            card.append(hiddenInfoCity);
            card.append(hiddenInfoProvince);
            card.append(hiddenInfoPostalCode);
            card.append(hiddenInfoEmployType);
            card.append(hiddenInfoPaymentType);
            card.append(hiddenInfoSalary);
            card.append(hiddenInfoDescription);

            currentQuestion = Math.min(...freeQuestions);
            mySharona.setAttribute("action", "payment.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>&test="+defaults+customQuestions+"&high="+questions.length.toString());
            // mySharona.setAttribute("action", "../receive-questions.php?id=<?php echo $userId ?>&empId=<?php echo $employer_id ?>&high="+questions.length.toString());
            mySharona.prepend(card);
        }
        }

    </script>
<?php
// include("includes/footer.php");
?>

<style>
    .question 
    {
        width: 700px;
        min-width: 700px;
    }
</style>