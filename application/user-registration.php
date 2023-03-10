<?php
$pageTitle = "Sign Up";
include("includes/utils.php");
include("includes/no_header.php");
?>
<style>
    main {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #F3F2F1;
    }

    div.container {
        padding: 0;
        width: 480px;
    }

    a {
        text-decoration: none;
    }
</style>
<main>
    <div class="container">
        <!-- <div class="mini-logo text-center my-16" style="text-align:center;">
            <a href="index">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi mb-3 bi-bootstrap-fill" viewBox="0 0 16 16">
                    <path d="M6.375 7.125V4.658h1.78c.973 0 1.542.457 1.542 1.237 0 .802-.604 1.23-1.764 1.23H6.375zm0 3.762h1.898c1.184 0 1.81-.48 1.81-1.377 0-.885-.65-1.348-1.886-1.348H6.375v2.725z" />
                    <path d="M4.002 0a4 4 0 0 0-4 4v8a4 4 0 0 0 4 4h8a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4h-8zm1.06 12V3.545h3.399c1.587 0 2.543.809 2.543 2.11 0 .884-.65 1.675-1.483 1.816v.1c1.143.117 1.904.931 1.904 2.033 0 1.488-1.084 2.396-2.888 2.396H5.062z" />
                </svg>
            </a>
        </div> -->
        <div class="card">
            <div class="text-center justify-content-center">
                <h4 class="card-title mt-3">User Registration</h4>
                <p class="mb-1">Create a password and select your account type.</p>
            </div>
            <div class="card-body">
                <form class="form" name="myForm" action="scripts/account/user-registration.php" onsubmit="return validateForm()" method="post">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label grey-text bold">Email</label>
                            <input maxlength="99" type="email" class="form-control bg-light" name="email" value="<?php if (isset($_GET['email'])) {
                                                                                                                        echo $_GET['email'];
                                                                                                                    } ?>">
                            <small hidden id="email_err" class="ms-2"></small>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label grey-text bold">Password</label>
                            <input maxlength="99" type="password" class="form-control bg-light" id="passwd" name="password">
                            <small hidden id="password_err" class="ms-2"></small>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label grey-text bold">Confirm password</label>
                            <input maxlength="99" type="password" class="form-control bg-light" name="confirm_password">
                            <small hidden id="confirm_password_err" class="ms-2"></small>
                        </div>
                        <div class="my-1">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="user_type" value="0" id="user_type0" checked>
                                <label class="form-check-label" for="user_type0">
                                    Candidate
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="user_type" value="1" id="user_type1">
                                <label class="form-check-label" for="user_type1">
                                    Business
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3 mb-2">
                        <button type="submit" name="submit" class="btn btn-primary mr-2">Sign up</button>
                    </div>
                    <ul id="errorOut"></ul>
                </form>
            </div>
        </div>
    </div>
</main>
<script>
    document.getElementById("passwd").focus();

    //Get html elements to add errors to
    let errorOut = document.getElementById('errorOut');
    let isError = false;

    //Function hides error messages when a 2nd argument isn't provided. Otherwise it shows
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

    //Returns true if there's an uppcase in a string
    function isUpperCase(str) {
        for (var i = 0; i < str.length; i++) {
            if (str[i] === str[i].toUpperCase() &&
                str[i] !== str[i].toLowerCase()) {
                return true;
            }
        }
    }


    function validateForm() {
        isError = false;
        let errorList = [];
        let mail = document.forms["myForm"]["email"].value;
        let pass = document.forms["myForm"]["password"].value;
        let confirm_pass = document.forms["myForm"]["confirm_password"].value;
        //let phoneNum = document.forms["myForm"]["phone"].value;

        //Check if inputs are blank
        if (mail === "") {
            isError = toggleError('email_err', 'Email is blank');
        } else {
            toggleError('email_err');
        }

        //Password validation
        if (pass === "") {
            isError = toggleError('password_err', 'Password blank');
        } else if (pass != "") {
            // Password is not long enough
            if (pass.length < 8) {
                isError = toggleError('password_err', 'Password must be atleast 8 characters long');
            }
            // Checks for atleast 1 uppercase char in the password 
            else if (!isUpperCase(pass)) {
                isError = toggleError('password_err', 'Password must contain atleast 1 uppercase letter');
            } else {
                toggleError('password_err');
            }
        }

        // Check if passwords are the same
        if (pass != confirm_pass) {
            isError = toggleError('confirm_password_err', 'Passwords do not match');
        } else {
            toggleError('confirm_password_err');
        }

        //Remove all the on screen errors if there are some
        if (errorOut) {
            while (errorOut.firstChild) {
                errorOut.removeChild(errorOut.firstChild);
            }
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
include("includes/no_footer.php");
?>