<?php
$pageTitle = "Payment Fail";

include("../includes/utils.php");
include("../includes/header.php");
?>
<main class="bg-light" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-12 col text-center">
                <h1 class="text-danger">Payment Failure!</h1>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="red" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                    </svg>
                </div>
                <a href="https://localhost/greenteam2022/application" class="mt-3 btn btn-primary">Back to home</a>
            </div>
        </div>

    </div>

</main>
<?php
include("../includes/no_footer.php");
?>