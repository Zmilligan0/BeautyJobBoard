<?php
$pageTitle = "Contact Us";
include("includes/utils.php");
include("includes/header.php");
include("scripts/services/send-email.php");

$recipientEmail = "henry.kruse@outlook.com";
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<main>
    <!-- Page content-->
    <div class="container">
        <div class="row justify-content-left align-items-center h-100 py-4">
            <div class="col-xl-5 col-md-6">
                <h1>Contact Us</h1>
                <form id="contact_form" method="post">
                    <div class="container d-flex gap-4 mt-2 mb-2">

                        <div class="input-contact">
                            <label for="name" class="fw-bold mt-2 form-label">Name</label>
                            <input type="text" id="name" class="form-control" size="25" name="name">
                        </div>
                        <div class="input-contact">
                            <label for="email" class="fw-bold mt-2 form-label">Email</label>
                            <input type="email" id="email" class="form-control" size="25" name="email">
                        </div>
                    </div>
                    <div class="container d-flex gap-5 mt-2 mb-2">
                        <div class="input-contact">
                            <label for="phone" class="fw-bold mt-2 form-label">Phone</label>
                            <input type="tel" id="phone" class="form-control" size="25" name="phone">
                        </div>
                    </div>
                    <div class="container d-flex gap-5 mt-2 mb-3">
                        <div class="input-contact">
                            <label for="message" class="fw-bold mt-2 form-label">Message</label>
                            <textarea id="message" class="form-control" name="message" cols="64" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="container d-flex justify-content-left">
                        <div class="g-recaptcha" data-sitekey="6LeYg30iAAAAAIclJX_g7zt4oFw10eORhATlpf1c"></div>
                    </div>
                    <div class="container d-flex justify-content-left mt-2">
                        <button type="submit" name="submit" style="width: 150px;" class="btn btn-dark rounded mb-5" value="submit">Submit</button>
                    </div>
                    <div>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $User_name = $_POST['name'];
                            $user_email = $_POST['email'];
                            $phone = $_POST['phone'];
                            $message = $_POST['message'];

                            $email_subject = "New Form Submission";
                            $email_body = "Name: $User_name.\nEmail: $user_email.\nPhone Number: $phone.\nMessage:\n$message";

                            $secretKey = "6LeYg30iAAAAAGip2Zw4ijJKvLhhG2taOTcJMOmM";
                            $responseKey = $_POST['g-recaptcha-response'];
                            $UserIP = $_SERVER['REMOTE_ADDR'];
                            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";

                            $response = file_get_contents($url);
                            $response = json_decode($response);

                            if ($response->success) {
                                sendEmail($recipientEmail, $email_subject, $email_body);

                                echo "<div class='alert alert-success mt-3' role='alert'>Your message sent successfully!</div>";
                            } else {
                                echo "<div class='alert alert-danger mt-3' role='alert'>Invalid Captcha. Please try again.</div>";
                            }
                        }
                        ?>
                    </div>
                </form>
            </div>
            <div class="justify-content-right align-items-center w-50">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                How do I sign up?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                You can sign up for our site by clicking on the Sign In button in the top right corner of our site!
                                Once you click on it, it will ask for your email, if you don't yet have an account, it will prompt you to create one.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Where can I promote my jobs on your site?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                You can promote any jobs you've posted by navigating to the Employer Dashboard, accesible from the footer of this page! From there you can promote your jobs, or edit them in any way you need.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Why can't I access the educational resources?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                You are only able to view the actual content inside the educational resource if you are signed in. You can browse the options, but you cannot view the content itself without an account.<br></br>If you sign up, you can also apply on jobs and create a profile for businesses to view potential talent to hire!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include("includes/footer.php");
?>