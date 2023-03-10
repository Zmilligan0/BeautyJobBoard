<?php
$pageTitle = "Sign In";
include("includes/no_header.php");
require('includes/job_connect.php');
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
            <a href="index" id="site-id-logo">Salonify</a>
        </div> -->
        <div class="card">
            <div class="text-center justify-content-center">
                <h4 class="card-title mt-3">Sign In</h4>
                <p class="mb-1">Create an account or sign in.</p>
            </div>
            <div class="card-body">
                <form action="scripts/session/sign-in-script" name="myForm" onsubmit="return validateForm()" method="post">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label grey-text bold">Email</label>
                            <input type="email" id="email" name="email" class="form-control bg-light">
                        </div>
                    </div>
                    <div class="mt-16 d-grid gap-2 mb-2">
                        <button type="submit" name="submit" class="btn btn-primary mr-2">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger mt-3' role='alert'>";
            switch ($_GET['error']) {
                case 1:
                    echo "You need to be signed in to access this page.";
                    break;
                default:
                    echo "An unknown error occurred.";
                    break;
            }
            echo "</div>";
        }
        ?>
    </div>
</main>
<script>
    window.onload = function() {
        var input = document.getElementById("email").focus();
    }

    function validateForm() {
        let mail = document.forms["myForm"]["email"].value;
        if (mail == "") {
            //alert("Email must be filled out");
            return false;
        }
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (mail.match(mailformat)) {
            return true;
        } else {
            return false;
        }
    }
</script>
<?php
include("includes/no_footer.php");
?>