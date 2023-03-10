<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="css/styles.css">

<?php  
    $accl = "0,0";
    $pageTitle = "Edit Job";
    include ("../includes/job_connect.php");
    include ("../includes/utils.php");
    include ("../includes/header.php");
?>



<?php
    $jobID = $_GET['id']; 
    if(!isset($jobID)){
        // this value MUST be set in order for the next query to work
        //$charID =  1;// if not, load the first (assuming it's 1);
        $result = mysqli_query($jobConn,"SELECT * FROM job LIMIT 1") or die (mysqli_error($jobConn));
        
        while($row = mysqli_fetch_array($result)){
            $jobID = $row['job_id'];
        }
    }

    if(isset($_POST['mysubmit'])) {

        $title = strip_tags(trim($_POST['title']));
        $deadline = date('Y-m-d', strtotime($_POST['deadline']));
        $city = strip_tags(trim($_POST['city']));
        $address = strip_tags(trim($_POST['address']));
        $postcode = strip_tags(trim($_POST['postcode']));
        $job_description = trim($_POST['description']);
        $minPay = strip_tags(trim($_POST['min_pay']));
        $maxPay = strip_tags(trim($_POST['max_pay']));
        $payType = $_POST['pay_type'];
        $province = $_POST['province'];
        $employmentType = $_POST['employ_type'];
        $status = $_POST['status'];

        $stableDescription = mysqli_real_escape_string($jobConn, $job_description);

        if(isset($_POST['premium'])){
            $premium = $_POST['premium'];
            if($premium==7){
                $premium_expiry = date('Y-m-d H:i:s', strtotime($postDate. ' + 7 days'));
            }
            elseif($premium==30) {
                $premium_expiry = date('Y-m-d H:i:s', strtotime($postDate. ' + 30 days'));
            } 
        } else {
            $premium_expiry = "";
        }

        

        $valid = 1; 
        $msgPre = "<div class=\"alert alert-danger\" role=\"alert\">";
		$msgSucPre = "<div class=\"alert alert-success\" role=\"alert\">";
		$msgPost = "</div>";

        if($title == "") {
            $valid = 0;
            $valTitleMesg = "Job title is required";
        } else {
            if(strlen($title) > 100){
                $valid = 0;
                $valTitleMesg = "Job title should not longer than 100 characters.";
            }
        }

        if($deadline == "") {
            $valid = 0;
            $valExpireMesg = "Expired date is required";
        } else {
            if($deadline <= date("Y-m-d H:i:s")){
                $valid = 0;
                $valExpireMesg = "Invalid expired date";
            }
        }

        if($city == "") {
            $valid = 0;
            $valCityMesg = "City is required";
        } else {
            if(strlen($city) > 40){
                $valid = 0;
                $valCityMesg = "City name should not longer than 40 characters.";
            }
        }

        if(strlen($address) > 60){
            $valid = 0;
            $valAddressMesg = "Street address should not longer than 60 characters.";
        }

        if($postcode == "") {
            $valid = 0;
            $valExpireMesg = "Expired date is required";
        } else {
            if(strlen($postcode) > 7){
                $valid = 0;
                $valExpireMesg = "Invalid post code";
            }
        }

        if($job_description == "") {
            $valid = 0;
            $valDescMesg = "Job description is required";
        }

        if($minPay != "" && $minPay > 9999999){
            
            $valid = 0;
            $valCompMesg = "Invalid compensation";
        }

        if($maxPay != "" && $maxPay > 9999999){
            
            $valid = 0;
            $valCompMesg = "Invalid compensation";
        }


        if($province == "") {
            $valid = 0;
            $valProMesg = "Province is required";
        }

        if($employmentType == "") {
            $valid = 0;
            $valTypeMesg = "Employment type is required";
        }

        if($status == "") {
            $valid = 0;
            $valStatusMesg = "Status is required";
        }

        if($valid == 1) {

            $compensation = $minPay . "," . $maxPay;
            $postDate = date("Y-m-d H:i:s");

			mysqli_query($jobConn, "UPDATE job SET title='$title', description='$stableDescription', employment_type='$employmentType', expiry_date='$deadline', address='$address', city='$city', province='$province', postal_code='$postcode', status='$status', compensation='$compensation', payment_type='$payType' WHERE job_id=$jobID") or die(mysqli_error($jobConn));
			$validSucMsg = $msgSucPre . "Job Updated!" . $msgPost;

        }
    }

    //prefill field
    $result = mysqli_query($jobConn,"SELECT * FROM job WHERE job_id=$jobID") or die (mysqli_error($jobConn));
    while($row = mysqli_fetch_array($result)){
        $currentEmployerID = $row['employer_id'];
        $currentTitle = $row['title'];
        $currentAddress = $row['address'];
        $currentCity = $row['city'];
        $currentProvince = $row['province'];
        $currentPostcode = $row['postal_code'];
        $currentDeadline = date('Y-m-d', strtotime($row['expiry_date']));
        $currentEmploymentType = $row['employment_type'];

        if($row['compensation'] != ""){
            $currentCompensation = explode(",", $row['compensation']);
            $currentMinPay = $currentCompensation[0];
            if(isset($currentCompensation[1])){
                $currentMaxPay = $currentCompensation[1];
            } else {
                $currentMaxPay = $currentMinPay;
            }
            
        }
        $currentPayType = $row['payment_type'];
        $currentDescription = $row['description'];
        $currentStatus = $row['status'];
    }
?>


<main>
    <div class="d-flex">
        
        <!--side bar-->
        <?php include ("side_bar.php"); ?>
        <!--contents-->
        <div class="container-fluid p-5 pt-1">
            <!-- header -->
            <div class="mt-3 mb-3">
                <h2>Job Management</h2>
            </div>
            <!-- job list sections -->
            <div class="card mb-4">
                <div class="card-body d-flex flex-row justify-content-between mt-3">
                    <div class="d-flex" style="font-size: 1.5rem;">
                        <a class="link-dark" href="./job.php">Job List</a>
                        <p>&nbsp;>>&nbsp;</p>
                        <p class="link-dark">Update Job ID: <?php echo $jobID ?></p>
                    </div>


                </div>
            </div>
            <hr>
            <div class=" p-3 container p-5 pt-1">
                <h1 hidden class="text-decoration-underline">New Job</h1>

                <form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" onsubmit="saveQuill()" enctype="multipart/form-data">
                    
                    <div><?php if(isset($validSucMsg) && $validSucMsg != ""){ echo $validSucMsg; } ?></div>
                    <div>
                        <label for="title" class="fw-bold mt-2 form-label">*Job Title</label>
                        <input type="text" id="title" class="form-control" name="title" placeholder="Enter Job Title" <?php if(isset($currentTitle) && $currentTitle != ""){ echo "value=\"$currentTitle\"";} ?>>
                        <?php if(isset($valTitleMesg)){echo $msgPre.$valTitleMesg.$msgPost;} ?>
                    </div>
                    
                    <div>
                        <label for="address" class="fw-bold mt-2 mb-0 form-label">Street Address</label>
                        <small class="d-block mb-2 fw-light">Enter the street address for better visibility</small>
                        <input type="text" id="address" class="form-control" name="address"
                            placeholder="Enter street address" <?php if(isset($currentAddress) && $currentAddress != ""){ echo "value=\"$currentAddress\"";} ?>>
                        <?php if(isset($valAddressMesg)){echo $msgPre.$valAddressMesg.$msgPost;} ?>
                    </div>
                    
                    <div>
                        <label for="city" class="fw-bold mt-2 form-label">*City</label>
                        <input type="text" id="city" class="form-control" name="city"
                            placeholder="Enter Job Located City" <?php if(isset($currentCity) && $currentCity != ""){ echo "value=\"$currentCity\"";} ?>>
                        <?php if(isset($valCityMesg)){echo $msgPre.$valCityMesg.$msgPost;} ?>
                    </div>
                    
                    <div>
                        <label for="province">*Province</label>
                        <select class="form-control" name="province" id="province">
                            <option value="">select</option>
                            <option value="AB" <?php if(isset($currentProvince) && $currentProvince == "AB"){echo "selected";} ?>>Alberta</option>
                            <option value="BC" <?php if(isset($currentProvince) && $currentProvince == "BC"){echo "selected";} ?>>British Columbia</option>
                            <option value="MB" <?php if(isset($currentProvince) && $currentProvince == "MB"){echo "selected";} ?>>Manitoba</option>
                            <option value="NB" <?php if(isset($currentProvince) && $currentProvince == "NB"){echo "selected";} ?>>New Brunswick</option>
                            <option value="NL" <?php if(isset($currentProvince) && $currentProvince == "NL"){echo "selected";} ?>>Newfoundland and Labrador</option>
                            <option value="NS" <?php if(isset($currentProvince) && $currentProvince == "NS"){echo "selected";} ?>>Nova Scotia</option>
                            <option value="NT" <?php if(isset($currentProvince) && $currentProvince == "NT"){echo "selected";} ?>>Northwest Territories</option>
                            <option value="NU" <?php if(isset($currentProvince) && $currentProvince == "NU"){echo "selected";} ?>>Nunavut</option>
                            <option value="ON" <?php if(isset($currentProvince) && $currentProvince == "ON"){echo "selected";} ?>>Ontario</option>
                            <option value="PE" <?php if(isset($currentProvince) && $currentProvince == "PE"){echo "selected";} ?>>Prince Edward Island</option>
                            <option value="QC" <?php if(isset($currentProvince) && $currentProvince == "QC"){echo "selected";} ?>>Quebec</option>
                            <option value="SK" <?php if(isset($currentProvince) && $currentProvince == "SK"){echo "selected";} ?>>Saskatchewan</option>
                            <option value="YT" <?php if(isset($currentProvince) && $currentProvince == "YT"){echo "selected";} ?>>Yukon</option>
                        </select>
                        <?php if(isset($valProMesg)){echo $msgPre.$valProMesg.$msgPost;} ?>
                    </div>
                    
                    <div>
                        <label for="postcode" class="fw-bold mt-2 mb-0 form-label">*Post Code</label>
                        <input type="text" id="postcode" class="form-control" name="postcode" placeholder="Enter Post Code" <?php if(isset($currentPostcode) && $currentPostcode != ""){ echo "value=\"$currentPostcode\"";} ?>>
                        <?php if(isset($valPostMesg)){echo $msgPre.$valPostMesg.$msgPost;} ?>
                    </div>
                    
                    <div>
                        <label for="title" class="fw-bold mt-2 form-label">*Expired Date</label>
                        <input type="date" class="form-control" name="deadline" id="deadline" <?php if(isset($currentDeadline) && $currentDeadline != ""){echo "value=\"$currentDeadline\"";}?>>
                        <?php if(isset($valExpireMesg)){echo $msgPre.$valExpireMesg.$msgPost;} ?>
                    </div>
                    
                    
                    <label for="employ_type" class="fw-bold mt-2 mb-0 form-label">*Employment Type</label>
                    <select class="form-select mt-2 mb-4" id="employ_type" name="employ_type">
                        <option value="">select</option>
                        <option value="0" <?php if(isset($currentEmploymentType) && $currentEmploymentType == "0"){echo "selected";} ?>>Full Time</option>
                        <option value="1" <?php if(isset($currentEmploymentType) && $currentEmploymentType == "1"){echo "selected";} ?>>Part Time</option>
                        <option value="2" <?php if(isset($currentEmploymentType) && $currentEmploymentType == "2"){echo "selected";} ?>>Contract</option>
                        <option value="3" <?php if(isset($currentEmploymentType) && $currentEmploymentType == "3"){echo "selected";} ?>>Temporary</option>
                    </select>
                    <?php if(isset($valTypeMesg)){echo $msgPre.$valTypeMesg.$msgPost;} ?>
                    
                    <div>
                        <label class="fw-bold mt-2 mb-2 form-label" id="compensation">Compensation</label>
                        <div class="bg-light flex-row d-lg-flex p-3" style="border: 1px solid #ced4da">
                            <input class=" col-12 col-lg-4 d-block d-lg-inline" type="number" min="0.00" step="0.01" id="compensation" name="min_pay" placeholder="$CAD" <?php if(isset($currentMinPay) && $currentMinPay != ""){echo "value=\"$currentMinPay\"";}?>>
                            <small class="fw-bold p-1">to</small>
                            <input class=" col-12 col-lg-4 d-block d-lg-inline" type="number" min="0.00" step="0.01" id="compensation" name="max_pay" placeholder="$CAD" <?php if(isset($currentMaxPay) && $currentMaxPay != ""){echo "value=\"$currentMaxPay\"";}?>>
                            <select class="col-lg-2 col-8 ms-lg-1 mt-2 mt-lg-0 " id="compensation" name="pay_type">
                                <option value="">selecct</option>
                                <option value="Annually" <?php if(isset($currentPayType) && $currentPayType == "Annually"){echo "selected";} ?>>Annually</option>
                                <option value="Hourly" <?php if(isset($currentPayType) && $currentPayType == "Hourly"){echo "selected";} ?>>Hourly</option>
                                <option value="Salary" <?php if(isset($currentPayType) && $currentPayType == "Salary"){echo "selected";} ?>>Salary</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="fw-bold mt-2 mb-2 form-label">Job description</label>
                        <input type="text" hidden id="description" name="description" value="">
                        <!-- Create the editor container -->
                        <div style="height: 200px;" id="job_description">
                            
                        </div>

                        <!-- Initialize Quill editor -->
                        <script>
                            var quill = new Quill('#job_description', {
                                theme: 'snow'
                            });

                            function saveQuill() {
                                
                                document.getElementById('description').value = JSON.stringify(quill.getContents());
                                console.log(document.getElementById('description').value);
                            }
                            // Sets content to job_description. If new post just sets it to blank. 
                            quill.setContents(<?php if(isset($currentDescription)) {echo stripslashes($currentDescription);} ?>);
                        </script>
                        <?php if(isset($valDescMesg)){echo $msgPre.$valDescMesg.$msgPost;} ?>
                    </div>
                    
                    <div>
                        <label for="status" class="fw-bold mt-2 mb-0 form-label">*Status</label>
                        <select class="form-select mt-2 mb-4" id="status" name="status">
                            <option value="" >select</option>
                            <option value="1" <?php if(isset($currentStatus) && $currentStatus == "1"){echo "selected";} ?>>Active</option>
                            <option value="0" <?php if(isset($currentStatus) && $currentStatus == "0"){echo "selected";} ?>>Close</option>
                        </select>
                        <?php if(isset($valStatusMesg)){echo $msgPre.$valStatusMesg.$msgPost;} ?>
                    </div>

                    <div class="mb-3 text-lg-end text-center">
                        <button type="submit" class="btn btn-success mt-4 col-12 col-md-6 col-lg-2" name="mysubmit" id="mysubmit">Update</button>
                    </div>

                </form>
                <!-- This form is used for editing contact info of users in the "send new candidates to" section 
                <form class="col-12 col-lg-4 p-2 m-auto" style="border: 1px solid #ced4da">
                    <div>

                        <div class="text-end">
                            <a href="#">
                                <svg class="ms-1 mb-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z" />
                                </svg>
                            </a>
                        </div>

                        <label for="user-name" class="fw-bold mt-2 form-label">Name</label>
                        <input type="text" id="user-name" class="form-control" name="user-name"
                            placeholder="Enter name">
                        <label for="user-email" class="fw-bold mt-2 form-label">Email</label>
                        <input type="email" id="user-email" class="form-control" name="user-email"
                            placeholder="Enter email">
                        <label for="user-description" class="fw-bold mt-2 form-label">Description</label>
                        <input type="text" id="user-description" class="form-control" name="user-description"
                            placeholder="Enter description">
                        <div class="mb-3 text-lg-end text-center">
                            <button type="submit" class="btn btn-success mt-4 ">Save</button>
                        </div>
                    </div>
                </form>
                -->
            </div>
        </div>
    </div>
</main>
<script>
    function popupFunction() {
        document.getElementById("deletepopup").style.visibility = "visible"
    }

    function closepopupFunction() {
        document.getElementById("deletepopup").style.visibility = "hidden"
    }

    // side bar function
    function hide() {
        document.getElementById("try").classList.remove("active-side-bar");
        document.getElementById("showIcon").style.visibility = "visible";
        document.getElementById("showIcon").style.position = "absolute";
        document.getElementById("hamburger-position").style.position = "sticky";

    }

    function show() {
        document.getElementById("try").classList.add("active-side-bar");
        document.getElementById("showIcon").style.visibility = "hidden";
        document.getElementById("showIcon").style.position = "sticky";
        document.getElementById("hamburger-position").style.position = "absolute";
    }
    function screensize() {
        if (x.matches) {
            document.getElementById("try").classList.remove("active-side-bar");
            document.getElementById("showIcon").style.visibility = "visible";
            document.getElementById("showIcon").style.position = "absolute";
            document.getElementById("hamburger-position").style.position = "sticky";
        } else {
            document.getElementById("try").classList.add("active-side-bar");
            document.getElementById("showIcon").style.visibility = "hidden";
            document.getElementById("showIcon").style.position = "sticky";
            document.getElementById("hamburger-position").style.position = "absolute";
        }
    }

    var x = window.matchMedia("(max-width: 1460px)")
    screensize(x) // Call listener function at run time
    x.addListener(screensize) // Attach listener function on state changes
</script>

<?php  
    include ("../includes/no_footer.php");
?>