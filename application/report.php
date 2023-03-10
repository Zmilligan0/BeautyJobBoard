<?php
$pageTitle = "Report a user";
include("includes/utils.php");
include("includes/header.php");
include("includes/job_connect.php");
?>



<div class="container p-5">
    <h1 class="mb-3 display-4">Report User</h1>

    <?php

    if (isset($_POST['submit'])) {

        $report = $_POST['report'];
        $radio = $_POST['radio'];
        $sqlReport = "";

        if ($radio == "on") {
            $sqlReport = $report;
        }
        if (isset($_POST['radio']) && $radio != "on") {
            $sqlReport = $radio;  //  Displaying Selected Value
        }


        $uid = $_GET['id'];

        $submitreportsql = "INSERT INTO report (user_id, reason)
    VALUES ('$uid', '$sqlReport')";

        $insertVerification = mysqli_query($jobConn, $submitreportsql);

        echo '<div class="alert alert-success container" role="alert">';
        echo 'Thanks for the feedback! We will review your form';
        echo '</div>';
        echo "<script>setTimeout(function(){window.location.href = '/greenteam2022/application/index';}, 3000);</script>";
    }
    ?>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" class="align-middle">
        <div class="card p-5">
            <p>Please select the reason you are reporting this profile.</p>
            <div class="card-body">
                <label for="reportOne">
                    <input value="They are impersonating somebody." type="radio" id="reportOne" name="radio" onclick="ShowHideDiv()" />
                    They are impersonating somebody.
                </label>
                <br>
                <label for="reportTwo">
                    <input value="They are posting spam." type="radio" id="reportTwo" name="radio" onclick="ShowHideDiv()" />
                    They are posting spam.
                </label>
                <br>
                <label for="reportThree">
                    <input value="They have illegal, hateful, or irrelevant content on their profile." type="radio" id="reportThree" name="radio" onclick="ShowHideDiv()" />
                    They have illegal, hateful, or irrelevant content on their profile.
                </label>
                <br>
                <label for="reportFour">
                    <input type="radio" id="reportFour" name="radio" onclick="ShowHideDiv()" />
                    Other (Explain).
                </label>
                <div id="text-comment" style="display: none">
                    <textarea name="report" id="txtBox" rows="4" cols="40"></textarea>
                </div>
                <div class="d-flex justify-content-start">
                    <input type="submit" value="Submit Report" name="submit" id="submit" class="btn btn-primary mt-5">
                </div>
            </div>
    </form>

    <div class="d-flex align-items-center">
        <svg class="text-primary" style="margin-top: 3rem ; margin-right:0.5rem;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
        </svg>
        <a style="text-decoration: none ; display:inline-block;" class="mt-5" href="<?php echo ROOT_URL; ?>privacy-policy">For more information please check our terms and conditions page</a>
    </div>
</div>
</div>





<script>
    function ShowHideDiv() {
        var reportFour = document.getElementById("reportFour");
        var textComment = document.getElementById("text-comment");
        textComment.style.display = reportFour.checked ? "block" : "none";
    }
</script>


<?php
include("includes/footer.php");
?>