<?php
$pageTitle = "Payment Success";

include("../includes/utils.php");
include("../includes/header.php");
?>
<main class="bg-light" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-12 col text-center">
                <h1 class="text-success">Payment Success!</h1>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                </div>
                <!-- Send to job post -->
                <a href="https://localhost/greenteam2022/application"  class="mt-3 btn btn-primary">Back to home</a>
            </div>
        </div>

    </div>

</main>
<?php
include("../includes/no_footer.php");
?>