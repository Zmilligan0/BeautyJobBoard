<?php
$pageTitle = "Candidate Registration";
$accl = "1,0";
include("includes/job_connect.php");
include("includes/utils.php");
include("includes/header.php");
?>

<style>
    main {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #F3F2F1;
    }

    div.container-card {
        padding: 0;
        width: 480px;
    }

    a {
        text-decoration: none;
    }
</style>

<main>
    <div class="container container-card">
        <div class="card">
            <div class="text-center justify-content-center">
                <h4 class="card-title mt-3">Candidate Registration</h4>
                <!-- <p class="mb-1">You are one step away from finding your dream job.</p> -->
            </div>
            <div class="card-body">
                <form name="myForm" action="scripts/account/candidate-registration.php" onsubmit="return validateForm()" method="post">
                    <div class="row">
                        <!-- First -->
                        <div class="col-6 mb-3">
                            <label for="first_name"  class="form-label grey-text bold">First Name</label>
                            <input type="text" class="form-control bg-light" name="first_name" maxlength="99">
                            <small hidden id="fname_err" class="ms-2"></small>
                        </div>
    
                        <!-- Last -->
                        <div class="col-6 mb-3">
                            <label for="last_name"  class="form-label grey-text bold">Last Name</label>
                            <input type="text" class="form-control bg-light" name="last_name" maxlength="99">
                            <small hidden id="lname_err" class="ms-2"></small>
                        </div>
    
                        <!-- Relocate -->
                        <div class="col-12 mb-3">
                            <div style="display: flex; justify-content: space-between;">
                                <label for="relocate">Are you willing to relocate?</label>
                                <div style="display: flex;">
                                    <div>
                                        <input class="form-check-input" type="radio" name="will_relocate" value="1" id="will_relocate1">
                                        <label class="form-check-label" for="will_relocate1">
                                            Yes
                                        </label>
                                    </div>
                                    <div style="margin-left: 1rem;">
                                        <input class="form-check-input" type="radio" name="will_relocate" value="0" id="will_relocate2" checked>
                                        <label class="form-check-label" for="will_relocate2">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mb-2">
                        <button type="submit" name="submit" value="Register" class="btn btn-primary mr-2">Register</button>
                    </div>
                </form>
                <ul id="errorOut"></ul>
                </form>
            </div>
        </div>
    </div>
</main>
<script>
    //Get html elements to add errors to
    let errorOut = document.getElementById('errorOut');
    let isError = false;

    //Function hides error messages when a 2nd arguement isnt provided. Otherwise it shows
    //Returns true when a message is provided
    function toggleError(htmlID, message) {
        let err = document.getElementById(htmlID);
        if (message === undefined) {
            err.innerHTML = message;
            err.hidden = true;

        } else {
            err.style.color = 'red';
            err.innerHTML = message;
            err.hidden = false;
            return true;
        }
    }

    function validateForm() {
        isError = false;
        let errorList = [];
        let fName = document.forms["myForm"]["first_name"].value;
        let lName = document.forms["myForm"]["last_name"].value;

        //Check if inputs are blank
        if (fName === "") {
            isError = toggleError('fname_err', 'First name is blank');
        } else {
            toggleError('fname_err');
        }
        if (lName === "") {
            isError = toggleError('lname_err', 'Last name is blank');
        } else {
            toggleError('lname_err');
        }

        //Return false if there's an error
        if (isError) {
            // Return false, validation failed
            return false;
        } else {
            //Return true if validation succeeds 
            return true;
        }

    }
</script>
<?php
include("includes/footer.php");
?>