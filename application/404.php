<?php
$pageTitle = "404";
include("includes/header.php");
?>

<style>
    .background-image,
    .text-center {
        margin: 0 auto;
    }

    .background-image,
    .text-center {
        width: 60%;

    }

    .background-image img {
        margin-top: 2rem;
        width: 70%;
        height: 50vh;
    }

    @media only screen and (max-width: 767px) {
        .background-image img {
            margin-top: 5rem;
            height: 30vh;
        }
    }
</style>

<body>
    <div class="align-items-center vh-100">
        <div class="background-image d-flex justify-content-center">
            <!-- <img src="static/img/404-image.jpg" alt=""> -->
            <img src="https://i.imgur.com/iSA4yiu.jpg" alt="">
        </div>
        <div style="margin-bottom: 5rem ;" class="text-center">
            <p class="fs-3"> <span style="color:var(--light-red)">Oops!</span> Page not found.</p>
            <p>
                Sorry, the page you're looking for doesn't exist
            </p>
            <p>
                If you think something is broken, please contact us
            </p>
            <div style="margin-top: 2rem ;">
                <a href="/greenteam2022/application/index" style="background-color: var(--light-red) ; color:white; margin-right:1rem;" class="btn">Go Home</a>
                <a href="/greenteam2022/application/contact-us" style="background-color: black ; color:white;" class="btn">Contact Us</a>
            </div>
        </div>
    </div>
</body>
<?php
include("includes/footer.php");
?>