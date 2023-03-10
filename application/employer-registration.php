<?php
// $accl = "0,1";
$pageTitle = "Employer Registration";
include("includes/job_connect.php");
include("includes/utils.php");
include("includes/header.php");
?>

<style>
    main {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 0;
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
                <h4 class="card-title mt-3">Employer Registration</h4>
                <!-- <p class="mb-1 text-centre" style="max-width: 20ch;">You are one step away of finding the best talent for your salon</p> -->
            </div>
            <div class="card-body">
                <form name="myForm" action="scripts/account/employer-registration.php" onsubmit="return validateForm()" method="post">
                    <div class="row">
                        <!-- Name -->
                        <div class="col-12 mb-3">
                            <label for="business_name" class="form-label grey-text bold">Business Name</label>
                            <input type="text" class="form-control bg-light" name="business_name" id="business_name">
                            <small hidden id="bname_err" class="ms-2"></small>
                        </div>

                        <!-- Category -->
                        <div class="col-12 mb-3">
                            <label for="business_category" class="form-label grey-text bold">Category</label>
                            <input type="text" class="form-control bg-light" name="business_category" id="business_category">
                            <small hidden id="bcategory_err" class="ms-2"></small>
                        </div>

                        <!-- Description-->
                        <div class="col-12 mb-3">
                            <label for="business_description" class="form-label grey-text bold">Description</label>
                            <textarea class="form-control mt-2 bg-light" name="business_description" id="business_description" rows="3"></textarea>
                        </div>

                        <!-- Province -->
                        <div class="col-12 mb-3">
                            <label for="business_province" class="form-label grey-text bold">Province</label>
                            <select class="form-select bg-light" name="province" aria-label="Province select">
                                <option selected disabled value="0">Select Province</option>
                                <option value="AB">Alberta</option>
                                <option value="BC">British Columbia</option>
                                <option value="MB">Manitoba</option>
                                <option value="NB">New Brunswick</option>
                                <option value="NL">Newfoundland and Labrador</option>
                                <option value="NS">Nova Scotia</option>
                                <option value="NT">Northwest Territories</option>
                                <option value="NU">Nunavut</option>
                                <option value="ON">Ontario</option>
                                <option value="PE">Prince Edward Island</option>
                                <option value="QC">Quebec</option>
                                <option value="SK">Saskatchewan</option>
                                <option value="YT">Yukon</option>
                            </select>
                            <small hidden id="bprovince_err" class="ms-2"></small>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="business_city" class="form-label grey-text bold">City</label>
                            <input type="text" class="form-control bg-light" name="business_city" id="business_city">
                            <small hidden id="bcity_err" class="ms-2"></small>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="business_postal" class="form-label grey-text bold">Postal Code</label>
                            <input maxlength="6" type="text" class="form-control bg-light" name="business_postal" id="business_postal">
                            <small hidden id="bpostal_err" class="ms-2"></small>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="business_address" class="form-label grey-text bold">Address</label>
                            <input type="text" class="form-control bg-light" name="business_address" id="business_address">
                        </div>
                    </div>
                    <div class="d-grid gap-2 mb-2">
                        <button type="submit" name="submit" value="Register" class="btn btn-primary mr-2">Register</button>
                    </div>
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

    function postalFilter(postalCode) {

        if (!postalCode) {
            return false;
        }

        postalCode = postalCode.toString().trim();

        var ca = new RegExp(/([ABCEGHJKLMNPRSTVXY]\d)([ABCEGHJKLMNPRSTVWXYZ]\d){2}/i);

        if (ca.test(postalCode.toString().replace(/\W+/g, ''))) {
            return true;
        }
        return false;
    }

    function validateForm() {
        isError = false;
        let errorList = [];
        let bName = document.forms["myForm"]["business_name"].value;
        let bCategory = document.forms["myForm"]["business_category"].value;
        let bProvince = document.forms["myForm"]["province"].value;
        let bCity = document.forms["myForm"]["business_city"].value;
        let bPostal = document.forms["myForm"]["business_postal"].value;

        //Check if inputs are blank
        if (bName === "") {
            isError = toggleError('bname_err', 'Business name is blank');
        } else {
            toggleError('bname_err');
        }

        if (bCategory === "") {
            isError = toggleError('bcategory_err', 'Business category is blank');
        } else {
            toggleError('bcategory_err');
        }

        if (bCity === "") {
            isError = toggleError('bcity_err', 'Business city is blank');
        } else {
            toggleError('bcity_err');
        }

        if (bPostal === "") {
            isError = toggleError('bpostal_err', 'Business postal is blank');
        } else if (postalFilter(bPostal) == false) {
            isError = toggleError('bpostal_err', 'Business postal not in correct format. ex: K1A0B1 ');
        } else {
            toggleError('bpostal_err');
        }

        if (bProvince == 0) {
            isError = toggleError('bprovince_err', 'Business province is not selected');
        } else {
            toggleError('bprovince_err');
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