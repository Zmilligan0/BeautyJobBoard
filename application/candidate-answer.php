<?php
    //$accl = "2,0";
    $pageTitle = "Screening Questions";
    include("./includes/job_connect.php");
    //include("./includes/utils.php");
    include("./includes/header.php");
    include("./includes/_functions.php");
?>

<?php
    $applicationID = $_GET['id']; //match the URL
    if(!isset($applicationID)){
        // this value MUST be set in order for the next query to work
        //$charID =  1;// if not, load the first (assuming it's 1);
        $result = mysqli_query($jobConn,"SELECT * FROM application LIMIT 1") or die (mysqli_error($jobConn));
        
        while($row = mysqli_fetch_array($result)){
            $applicationID = $row['application_id'];
        }
    }

    if(isset($_POST['mysubmit'])){

        $freeFormCount = trim($_POST['free_form_count']);
        $multipleChoiceCount = $_POST['multiple_count'];
        $yesNoCount = $_POST['yes_no_count'];
        $fileUploadCount = $_POST['file_upload_count'];
        $theJobID = $_POST['job_id'];
        $msgPre = "<div class=\"alert alert-danger\" role=\"alert\">";
		$msgPost = "</div>";
        $validFile = 1; 
        $sql = "";
        for($i=1; $i <= $freeFormCount; $i++){
            ${"freeFormAnswer".$i} = strip_tags(trim($_POST['free_form'.$i]));
            ${"selectFreeQuestionID".$i} = $_POST['free_question_id'.$i];
            $sql .= "INSERT INTO screening_question_answer (application_id, custom_question_id, free_form_answer) VALUES ($applicationID, ".${"selectFreeQuestionID".$i}.", '".${"freeFormAnswer".$i}."');";
        }
        for($i=1; $i <= $multipleChoiceCount; $i++){

            ${"multipleChoiceAnswer".$i} = $_POST['multiple_choice'.$i];
            ${"selectChoiceQuestionID".$i} = $_POST['multiple_question_id'.$i];
            if(${"multipleChoiceAnswer".$i} != ""){
                $sql .= "INSERT INTO screening_question_answer (application_id, custom_question_id, choice_answer) VALUES ($applicationID, ".${"selectChoiceQuestionID".$i}.", '".implode(", ", ${"multipleChoiceAnswer".$i})."');";
            }
            
        }
        for($i=1; $i <= $yesNoCount; $i++){
            ${"yesNoAnswer".$i} = $_POST['yes_no'.$i];
            ${"selectYesNoQuestionID".$i} = $_POST['yes_no_question_id'.$i];
            $sql .= "INSERT INTO screening_question_answer (application_id, custom_question_id, yes_no_answer) VALUES ($applicationID, ".${"selectYesNoQuestionID".$i}.", ".${"yesNoAnswer".$i}.");";
        }
        for($i=1; $i <= $fileUploadCount; $i++){
            ${"fileUploadAnswer".$i} = $_FILES["myprofile".$i]["name"];
            ${"selectFileQuestionID".$i} = $_POST['file_question_id'.$i];

            if(${"fileUploadAnswer".$i} != ""){
                if(($_FILES["myprofile".$i]["type"] != "application/pdf") && ($_FILES["myprofile".$i]["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document")){
                        $validFile = 0;
                        $valFileMessage = "Not a valid PDF/Word";
                } //elseif (($_FILES["myprofile"]["size"]/1024)/1024 > 32){ //less than 32MB
                        //$valid = 0;
                        //$valFileMessage = "The uploaed image should be less that 32MB!";
                    //}

            }else{
                $validFile = 0;
            }
            if($validFile == 1) {
                ${"profilePrefix".$i} = "question_file_application" . $applicationID. "question" . ${"selectFileQuestionID".$i} . "_";
                
                if($_FILES["myprofile".$i]["type"] == "application/pdf"){
                    ${"uniqFilename".$i} = uniqid(${"profilePrefix".$i}) . '.pdf';
                } else {
                    ${"uniqFilename".$i} = uniqid(${"profilePrefix".$i}) . '.docx';
                }

                //$thisFile = $imgOriginals . $uniqFilename;
                $thisFile = "./uploads/files/" . ${"uniqFilename".$i};
                if(move_uploaded_file($_FILES["myprofile".$i]["tmp_name"], $thisFile)){
                //here is a greater place to create our thumbs, as validation has passed, and the image has been uploaded
                $sql .= "INSERT INTO screening_question_answer (application_id, custom_question_id, file_upload_answer) VALUES ($applicationID, ".${"selectFileQuestionID".$i}.", '".${"uniqFilename".$i}."');";
                }
            } else {
                $sql .= "INSERT INTO screening_question_answer (application_id, custom_question_id) VALUES ($applicationID, ".${"selectFileQuestionID".$i}.");";
            }
        }

        if(!isset($valFileMessage) || $valFileMessage == ""){
            $sql = substr_replace($sql ,"",-1);
            mysqli_multi_query($jobConn, $sql) or die(mysqli_error($jobConn));
            echo "<meta http-equiv=\"refresh\" content=\"0;url=apply-success.php?id=$theJobID\" />";
        }
        
    }

    



    $currentApplication = mysqli_query($jobConn,"SELECT * FROM application WHERE application_id=$applicationID") or die (mysqli_error($jobConn));
    while($row = mysqli_fetch_array($currentApplication)){
        $currentJobID = $row['job_id'];
    }
    $customQuestions = mysqli_query($jobConn,"SELECT * FROM screening_question WHERE job_id = $currentJobID ORDER BY question_type") or die (mysqli_error($jobConn));
    if(mysqli_fetch_array($customQuestions) =="") {
        echo "<meta http-equiv=\"refresh\" content=\"0;url=apply-success.php?id=$currentJobID\" />";
    }
    $freeFormCount = 0;
    $multipleChoiceCount = 0;
    $yesNoCount = 0;
    $fileUploadCount = 0;

?>
<div class="container mt-5">
<form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">


    <?php while($row = mysqli_fetch_array($customQuestions)): ?>
        <div class="card mt-3">
        <?php 
            $questionID = $row['custom_question_id'];
            if($row ['question_type']==1){
                $freeFormCount += 1;
                
                $question = mysqli_query($jobConn,"SELECT * FROM free_form_question WHERE custom_question_id = '$questionID' LIMIT 1") or die (mysqli_error($jobConn));
                $freeForm = mysqli_fetch_array($question);
                echo "<div class=\"card-header\"><h3>".$freeForm['question_title']."</h3>";
                echo "<p>".$freeForm['question_text']."</p></div>";
                echo "<div class=\"card-body\"><input class=\"form-control\" type=\"text\" name=\"free_form$freeFormCount\" id=\"free_form$freeFormCount\" />";
                echo "<input hidden class=\"form-control\" type=\"text\" name=\"free_question_id$freeFormCount\" id=\"free_question_id$freeFormCount\" value=\"$questionID\" /></div>";
            }
            elseif($row['question_type']==2){
                $multipleChoiceCount += 1;
                $question = mysqli_query($jobConn,"SELECT * FROM multiple_choice_question WHERE custom_question_id = $questionID") or die (mysqli_error($jobConn));
                $multipleChoice = mysqli_fetch_array($question);
                $choice1=$multipleChoice['choice_1'];
                $choice2=$multipleChoice['choice_2'];
                $choice3=$multipleChoice['choice_3'];
                $choice4=$multipleChoice['choice_4'];
                $choice5=$multipleChoice['choice_5'];
                $choice6=$multipleChoice['choice_6'];
                echo "<div class=\"card-header\"><h3>".$multipleChoice['question_title']."</h3>";
                echo "<p>".$multipleChoice['question_text']."</p></div>";
                echo "<div class=\"card-body\"><select class=\"form-select\" name=\"multiple_choice".$multipleChoiceCount."[]\" multiple>";
                echo "<option value=\"\" selected >None</option>";
                if(isset($choice1) && $choice1 != ""){
                    echo "<option value=\"$choice1\">$choice1</option>";
                    
                }
                if(isset($choice2) && $choice2 != ""){
                    echo "<option value=\"$choice2\">$choice2</option>";
                }
                if(isset($choice3) && $choice3 != ""){
                    echo "<option value=\"$choice3\">$choice3</option>";
                }
                if(isset($choice4) && $choice4 != ""){
                    echo "<option value=\"$choice4\">$choice4</option>";
                }
                if(isset($choice5) && $choice5 != ""){
                    echo "<option value=\"$choice5\">$choice5</option>";
                }
                if(isset($choice6) && $choice6 != ""){
                    echo "<option value=\"$choice6\">$choice6</option>";
                }
                
                echo "</select>";
                echo "<input hidden class=\"form-control\" type=\"text\" name=\"multiple_question_id$multipleChoiceCount\" id=\"multiple_question_id$multipleChoiceCount\" value=\"$questionID\" /></div>";
            }
            elseif($row['question_type']==3){
                $yesNoCount += 1;
                $question = mysqli_query($jobConn,"SELECT * FROM yes_no_question WHERE custom_question_id = " . $row['custom_question_id']) or die (mysqli_error($jobConn));
                $yesNoQuestion = mysqli_fetch_array($question);
                echo "<div class=\"card-header\"><h3 class=\"fw-bold mt-2 form-label\">".$yesNoQuestion['question_title']."</h3>
                <p>".$yesNoQuestion['question_text']."</p></div>
                <div class=\"card-body\">
                <div class=\"form-check\">
                    <input type=\"radio\" class=\"form-check-input\" name=\"yes_no$yesNoCount\" id=\"yes_no$yesNoCount\" value=\"1\" >
                    <label class=\"form-check-label fw-bold\" for=\"yes_no$yesNoCount\">
                        Yes
                    </label>
                </div>
                <div class=\"form-check\">
                    <input class=\"form-check-input\" type=\"radio\" name=\"yes_no$yesNoCount\" id=\"yes_no$yesNoCount\" value=\"0\" checked>
                    <label class=\"form-check-label fw-bold\" for=\"yes_no$yesNoCount\">
                        No
                    </label>
                </div>";
                echo "<input hidden class=\"form-control\" type=\"text\" name=\"yes_no_question_id$yesNoCount\" id=\"yes_no_question_id$yesNoCount\" value=\"$questionID\" /></div>";
            }
            elseif($row['question_type']==4){
                $fileUploadCount += 1;
                $question = mysqli_query($jobConn,"SELECT * FROM file_upload_question WHERE custom_question_id = " . $row['custom_question_id']) or die (mysqli_error($jobConn));
                $fileUploadQuestion = mysqli_fetch_array($question);
                echo"
                <div class=\"card-header\"><h3 class=\"fw-bold mt-2 form-label\">".$fileUploadQuestion['question_title']."</h7>
                <p>".$fileUploadQuestion['question_text']."</p></div>
                <div class=\"card-body\"
                <div class=\"form-group\">
                    <label for=\"myprofile\">Profile Image</label>
                    <input type=\"file\" name=\"myprofile$fileUploadCount\" />
                </div>

                ";
                if (isset($valFileMessage) &&  $valFileMessage != "") {
                    echo $msgPre . $valFileMessage . $msgPost;
                }
                echo "<input hidden class=\"form-control\" type=\"text\" name=\"file_question_id$fileUploadCount\" id=\"file_question_id$fileUploadCount\" value=\"$questionID\" /></div>";
            } else {
                echo "Question type error!";
            }
        ?>
        </div>
    <?php endwhile; ?>
    <input hidden type="text" name="free_form_count" value="<?php echo $freeFormCount; ?>"/>
    <input hidden type="text" name="multiple_count" value="<?php echo $multipleChoiceCount; ?>"/>
    <input hidden type="text" name="yes_no_count" value="<?php echo $yesNoCount; ?>"/>
    <input hidden type="text" name="file_upload_count" value="<?php echo $fileUploadCount; ?>"/>
    <input hidden type="text" name="job_id" value="<?php echo $currentJobID; ?>"/>
    <div class="mb-3 text-lg-end text-center">
        <button type="submit" class="btn btn-success mt-4 col-12 col-md-6 col-lg-2" name="mysubmit" id="mysubmit">Submit</button>
    </div>
</form>
</div>
<?php  
    include ("./includes/footer.php");
?>