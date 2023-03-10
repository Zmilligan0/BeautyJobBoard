<?php
$pageTitle = "Sign In";
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
                <h4 class="card-title mt-3">Sign In</h4>
                <p class="mb-1">Enter your password to proceed.</p>
            </div>
            <div class="card-body">
                <form action="scripts/session/authenticate.php" method="post">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label grey-text bold">Email</label>
                            <input name="email" type="text" class="form-control bg-light" value="<?php if (isset($_GET['email'])) { echo $_GET['email']; } ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label grey-text bold">Password</label>
                            <input name="password" type="password" id="password" class="form-control bg-light">
                        </div>
                        <div class="col-12 mb-3 mt-2">
                            <div class="form-check">
                                <input name="remember" type="checkbox" class="form-check-input" value="false">
                                <label class="form-check-label grey-text">
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 mb-2">
                        <button type="submit" class="btn btn-primary mr-2">Sign In</button>
                    </div>
                </form>
                <div class="text-center">
                    <p class="mt-3 mb-0 grey-text">
                        <a href="forgot-password">Forgot Password?</a>
                    </p>
                    <p class="mb-0 grey-text">Do not have an account?
                        <a href="sign-in">Sign up</a>
                    </p>
                    <p class="mt-4 mb-0 grey-text">
                        <a href="#">Privacy Policy</a>
                    </p>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger mt-3' role='alert'>";
            switch ($_GET['error']) {
                case 1:
                    echo "Invalid email or password.";
                    break;
                case 2:
                    echo "You must be logged in to access this page.";
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
        var input = document.getElementById("password").focus();
    }
</script>
<?php
include("includes/no_footer.php");
?>