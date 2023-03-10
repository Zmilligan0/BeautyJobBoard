<?php
$pageTitle = "Home Page";
include("includes/utils.php");
include("includes/header.php");
include("includes/job_connect.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
<!-- Css Styles -->
<style>
    body {
        min-width: fit-content;
    }

    .carousel {
        min-height: auto;
    }

    .carousel-caption {
        z-index: 2;
        height: 70%;
    }


    .carousel-caption h5 {
        font-size: 70px;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-top: 25px;
        text-shadow: 0px 0px 10px black;
    }

    .carousel-caption p {
        width: 60%;
        margin: auto;
        font-size: 25px;
        line-height: 1.9;
        text-shadow: 0px 0px 10px black;
    }

    .carousel-caption a {
        padding: 5px 20px;
        margin-top: 30px;
    }


    .carousel-item {
        height: 40rem;
    }

    .w-100 {
        height: 100vh;
    }

    .form-outline {
        width: 500px;
    }

    .input-group-text {
        background-color: white;
    }

    .card {
        border: none;
        border-radius: 10px;
    }

    .c-details span {
        font-weight: 300;
        font-size: 13px;
    }

    .icon {
        width: 50px;
        height: 50px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 39px;
    }

    .badge span {
        background-color: black;
        width: 60px;
        height: 25px;
        padding-bottom: 3px;
        border-radius: 5px;
        display: flex;
        color: white;
        justify-content: center;
        align-items: center;
    }

    .text1 {
        font-size: 14px;
        font-weight: 600;
    }

    .text2 {
        color: red;
    }

    .recent-searches .btn {
        width: 10rem;
    }

    .recent-searches {
        box-shadow: 0px 1px 5px 0px rgb(0 0 0 / 75%);
        padding: 1rem;
        width: 35rem;
        margin: 0 auto;
        text-align: center;
        text-decoration: none;
        color: black;
    }

    .recent-searches:hover {
        color: black;
        width: 35.5rem;
        transition: 0.5s all;
        background-color: rgb(238, 236, 236);
    }

    .recent-searches>button {
        margin: 0 auto;
    }

    .recent-searches i {
        top: -60px;
        right: 0px;
        font-size: 2rem;
    }

    .input-icons i {
        position: absolute;
        margin-top: 17px;
        margin-left: 8px;
    }

    .input-icons {
        width: 100%;
        margin-bottom: 10px;
    }

    .icon {
        padding: 10px;
        min-width: 50px;
        text-align: center;
    }

    .input-field {
        width: 100%;
        padding-left: 2rem;
        padding-top: 1rem;
        padding-bottom: 1rem;
    }

    .services .card h3 {
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 5px;
        padding: 10px 30px;
        text-transform: uppercase;
    }

    .img-hover-zoom {
        /* [1.1] Set it as per your need */
        overflow: hidden;
        /* [1.2] Hide the overflowing of child elements */
    }

    .img-hover-zoom img {
        transition: transform 0.5s ease;
    }

    .img-hover-zoom:hover img {
        transform: scale(1.5);
    }

    .job-card {
        margin-right: 2.8rem;
        width: calc(25% - 2.8rem);
        height: 20rem;
    }

    .list-group div button {
        width: 60%;
    }

    .background-still {
        background-image: url(img/still-background.jpg);
        background-repeat: no-repeat;
        background-attachment: fixed;
        height: 75vh;
    }

    .card>svg {
        margin: 0 auto;
        width: 7rem;
    }

    .how-it-works {
        display: flex;
        justify-content: center;
    }

    .form-control {
        border-radius: 0;
    }

    .bg-image {
        /* background-image: url('static/img/banner/0.jpg'); */
        background-size: 100%;
        background-repeat: no-repeat;
        height: 40rem;
        box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.6);
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .bg-image p,
    .bg-image h1 {
        text-shadow: 0px 0px 5px black;
    }

    .bg-image h1 {
        font-size: 4rem;
    }

    .bg-image p {
        font-size: 1.3rem;
    }

    .bg-image>div {
        padding-top: 14rem;
    }

    .bg-image>div>div {
        display: flex;
        justify-content: center;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .wrapper>.search-input-one,
    .wrapper>.search-input-two {
        background: #fff;
        width: 100%;
        position: relative;
        box-shadow: 0px 1px 5px 3px rgba(0, 0, 0, 0.12);
    }

    .search-input-one .input-one,
    .search-input-two .input-two {
        height: 59px;
        width: 30vw;
        outline: none;
        border: none;
        padding: 0 60px 0 20px;
        font-size: 18px;
        box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
    }

    .search-input-one.active .input-one,
    .search-input-two.active .input-two {
        border-radius: 5px 5px 0 0;
    }

    .search-input-one .autocom-box-one,
    .search-input-two .autocom-box-two {
        z-index: 1;
        padding: 0;
        opacity: 0;
        pointer-events: none;
        max-height: 280px;
        overflow-y: auto;
    }

    .search-input-one.active .autocom-box-one,
    .search-input-two.active .autocom-box-two {
        padding: 10px 8px;
        opacity: 1;
        pointer-events: auto;
    }

    .autocom-box-one li,
    .autocom-box-two li {
        list-style: none;
        padding: 8px 12px;
        display: none;
        width: 100%;
        cursor: default;
        border-radius: 3px;
    }

    .search-input-one.active .autocom-box-one li,
    .search-input-two.active .autocom-box-two li {
        display: block;
    }

    .autocom-box-one li:hover,
    .autocom-box-two li:hover {
        background: #efefef;
    }

    .search-input-one .icon-one,
    .search-input-two .icon-two {
        position: absolute;
        right: 0px;
        top: 0px;
        height: 55px;
        width: 55px;
        text-align: center;
        line-height: 55px;
        font-size: 20px;
        color: #1c1e1e;
        cursor: pointer;
    }

    .autocom-wrapper {
        position: relative;
    }

    .autocom-wrapper>div {
        position: absolute;
        width: 100%;
        background-color: white;
    }

    .list-group>a {
        margin: 0 auto;
    }

    .list-group>a:first-child {
        margin-top: 3rem;
    }

    #search-form {
        display: flex;
    }

    .job-card {
        min-width: 232px;
    }

    @media only screen and (max-width: 1000px) {
        .job-card {
            width: calc(50% - 2.8rem);
        }

        .how-it-works {
            display: block;
        }

        .how-it-works p {
            font-size: 1rem;
        }

        .how-it-works>div {
            margin: 0 auto;
            margin-bottom: 3rem;
        }

    }

    @media only screen and (max-width: 767px) {

        .carousel-caption {
            height: 65%;
        }

        .carousel-caption h5 {
            font-size: 3rem;
        }

        .form-data {
            display: block;
        }

        .recent-searches {
            width: 25rem;
        }

        .recent-searches:hover {
            width: 25.5rem;
        }

        .container .d-flex .flex-wrap>div {
            width: 100%;
        }

        .job-card {
            width: calc(100% - 2.8rem);
            margin-right: 0rem;
        }

        .list-group div button {
            width: 100%;
        }

        .bg-image>div>div {
            display: block;
        }

        .bg-image {
            /* background-image: url('static/img/banner/welcome.jpg'); */
            background-size: 100%;
            background-repeat: no-repeat;
            box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.6);
            height: 44rem;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .bg-image button {
            margin: 0 auto;
        }

        .button-container {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }

        .bg-image>div {
            padding-top: 8rem;
        }

        .bg-image h1 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
        }

        .bg-image div p {
            margin-bottom: 4rem;
        }

        .input-icons input {
            margin-top: 3rem;
        }

        .button-container {
            margin-top: 4rem;
        }

        .carousel-caption {
            align-items: center;
        }

        .wrapper {
            margin-bottom: 2rem;
        }

        .search-input-one .input-one,
        .search-input-two .input-two {
            width: 90%;
        }

        .button-container {
            position: relative;
        }

        .button-container>.button-container {
            position: absolute;
        }

        #search-form {
            display: block;
        }
    }
</style>
<main>
    <a hidden href='https://dryicons.com/free-icons/hair-icons'> Icon by Dryicons </a>
    <a hidden href="http://www.onlinewebfonts.com">oNline Web Fonts</a>
    <!-- header -->
    <div class="bg-image">
        <div>
            <h1 class="text-center text-white">The Most Exciting Jobs</h1>
            <p class="text-center text-white">Your Dream Job Is Waiting For You</p>
            <div class="container mt-5">
                <form id="search-form" action="search" method="get">
                    <div class="wrapper">
                        <div class="search-input-one">
                            <a class="a-one" href="" target="_blank" hidden></a>
                            <input id="job" class="input-one" type="text" name="query" placeholder="Job Title" />
                            <div class="autocom-wrapper">
                                <div class="autocom-box-one"></div>
                            </div>
                            <div class="icon-one">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#CD2027" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
                                    <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z" />
                                    <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <?php
                    //Set current city and province
                    if (isset($_SESSION["location"])) {
                        $location = $_SESSION["location"];
                        $split = str_getcsv($location);
                        $city = $split[0];
                        $province = $split[1];
                    } else {
                        // Default values
                        $location = "";
                        $city = "";
                        $province = "";
                    }

                    ?>
                    <div class="wrapper">
                        <div class="search-input-two">
                            <a class="a-two" href="" target="_blank" hidden></a>
                            <input id="location" class="input-two" id="location-id" type="text" name="location" placeholder="Location" value="<?php if (isset($location)) {
                                                                                                                                                    echo $location;
                                                                                                                                                } ?>" />
                            <div class="autocom-wrapper">
                                <div class="autocom-box-two"></div>
                            </div>
                            <div class="icon-two">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#CD2027" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                                </svg>
                            </div>
                            <!-- Hidden inputs to set the URL params when searching from index -->
                            <input hidden name="type" value=""></input>
                            <input hidden name="date" value="365"></input>
                            <input hidden name="distance" value="0"></input>
                        </div>
                    </div>
                    <div class="button-container">
                        <button style=" -webkit-box-shadow:0px 0px 13px 4px rgba(149, 29, 34,0.5);
-moz-box-shadow: 0px 0px 13px 4px rgba(149, 29, 34,0.5);
box-shadow: 0px 0px 13px 4px rgba(149, 29, 34,0.5);border-radius: 0; width: 10rem; height: 3.679rem" type="submit" onclick=store() class="btn">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Logic for setting getting/setting user location -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Variables
        let lat;
        let long;
        let locationInput = document.getElementById('location-id');
        // Using AJAX send a post request and reload the page upon success
        function setLocation() {
            //radius = document.querySelector("input").value;
            let radius = 0;
            $.ajax({
                type: 'POST',
                url: 'scripts/services/location-script.php',
                data: 'latitude=' + lat + '&longitude=' + long + '&radius=' + radius,
                success: function(msg) {
                    if (msg) {
                        locationInput.value = String(msg);
                    } else {
                        console.log("Error: " + msg);
                    }
                }
            });
        }
        // Sets the users postion 
        function setPosition(position) {
            long = position.coords.longitude;
            lat = position.coords.latitude;
            console.log(lat + " : " + long);
            setLocation();
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(setPosition, null);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }
        // Running location prompt
        <?php
        if (!isset($_SESSION["location"])) {
            echo 'getLocation();';
        }

        ?>
    </script>
    <!-- Featured Jobs / Recent Searches Section -->
    <div>
        <div class="container" data-aos="zoom-in" data-aos-anchor-placement="top-bottom">

            <style>
                .cats-box {
                    margin-bottom: 2rem;
                    text-decoration: none;
                }

                .cats-box-caption h4 {
                    color: black;
                    font-size: 1rem;
                }

                .circle {
                    border-radius: 100%;
                    background: rgb(149, 29, 33, 0.2);
                }

                .cats-wrap:hover {

                    width: 12.5rem;
                    height: 9rem;
                    transition: all ease-in 5s;
                }

                .job-card {
                    border: 1px solid #e9ecef;
                }

                .job-info {
                    margin-top: 0.5rem;
                }

                .job-type-info svg {
                    margin-top: 0.2rem;
                    margin-right: 0.3rem;
                }

                .job-card p,
                .job-card h5 {
                    overflow: hidden;
                    white-space: nowrap;
                }

                .job-card {
                    cursor: pointer;
                }

                .job-card:hover {
                    transition: 0.1s ease-in all;
                    -webkit-box-shadow: 0px 0px 23px 0px rgba(4, 8, 7, 0.4);
                    -moz-box-shadow: 0px 0px 23px 0px rgba(4, 8, 7, 0.4);
                    box-shadow: 0px 0px 23px 0px rgba(4, 8, 7, 0.4);
                }

                .list-group-item {
                    padding: 1rem;
                    margin-bottom: 1rem;
                }

                .btn {
                    background-color: var(--light-red);
                    color: white;
                }

                .btn:hover {
                    background-color: var(--light-red-hover);
                    color: white;
                }
            </style>

            <ul class="nav nav-tabs" id="myTab">
                <li class="nav-item">
                    <a href="#jobfeed" class="mt-5 nav-link active" data-bs-toggle="tab">Featured Jobs</a>
                </li>
                <li class="nav-item">
                    <a href="#recentSearches" class="mt-5 nav-link" data-bs-toggle="tab">Recent Searches</a>
                </li>
            </ul>

            <div style="background-color:rgb(200,200,200,0.1); width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;">
                <div class="tab-content pb-5">
                    <div class="tab-pane fade show active" id="jobfeed">
                        <div class="container d-flex justify-content-center flex-wrap">

                            <?php
                            $login = false;
                            $eType = "";

                            if (isset($_SESSION['user_id'])) {
                                //TODO: Set users current location in session
                                $list_sql =
                                    "SELECT job.city, job.province, job.title, job.employment_type, job.compensation,
                                    job.job_id, job.premium_expiry, job.status, job.expiry_date, employer.business_name, job.payment_type
                                    FROM `job` 
                                    INNER JOIN employer ON job.employer_id = employer.employer_id
                                    WHERE premium_expiry >= CURDATE() && status = 1 && CURDATE() <= expiry_date
                                    AND job.city like '%$city%' AND job.province like '%$province%'
                                    ORDER BY RAND()
                                    LIMIT 8;";

                                $result = mysqli_query($jobConn, $list_sql);

                                if (mysqli_num_rows($result) >= 8) {

                                    while ($row = $result->fetch_assoc()) {

                                        if ($row['employment_type'] == 0) {

                                            $eType = "Full Time";
                                        } else if ($row['employment_type'] == 1) {
                                            $eType = "Part Time";
                                        } else if ($row['employment_type'] == 2) {
                                            $eType = "Contract";
                                        } else if ($row['employment_type'] == 3) {
                                            $eType = "Temporary";
                                        }
                                        $fullComp = explode(',',$row['compensation'])[0];
                                        if ($fullComp < 1000) {
                                            $fullComp = number_format($fullComp);
                                        } else if ($fullComp >= 1000 && $fullComp < 999999) {
                                            $fullComp = round($fullComp / 1000, 1);
                                            $fullComp = $fullComp . "K";

                                        } else {
                                            $fullComp = round($fullComp / 1000000, 1);
                                            $fullComp = $fullComp . "M";
                                        }
                                        
                                        // $compensation = explode(",", $row['compensation']);
                                        // $lowComp;
                                        // $highComp;
                                        // $fullComp;
                                        // if ($compensation[0] < 1000) {
                                        //     $lowComp = number_format($compensation[0]);
                                        // } else if ($compensation[0] >= 1000 && $compensation[0] < 999999) {
                                        //     $lowComp = round($compensation[0] / 1000, 1);
                                        //     $lowComp = $lowComp . "K";
                                        // } else {
                                        //     $lowComp = round($compensation[0] / 1000000, 1);
                                        //     $lowComp = $lowComp . "M";
                                        // }

                                        // if ($compensation[1] <= $compensation[0]) {
                                        //     $fullComp = $lowComp;
                                        // } else {
                                        //     if ($compensation[1] < 1000) {
                                        //         $highComp = number_format($compensation[1]);
                                        //     } else if ($compensation[1] >= 1000 && $compensation[1] < 999999) {
                                        //         $highComp = round($compensation[1] / 1000, 1);
                                        //         $highComp = $highComp . "K";
                                        //     } else {
                                        //         $highComp = round($compensation[1] / 1000000, 1);
                                        //         $highComp = $highComp . "M";
                                        //     }
                                        //     $fullComp = $lowComp . "-" . $highComp;
                                        // }

                                        $rate;
                                        if ($row['payment_type'] == "Annually") {
                                            $rate = "/yr";
                                        } else {
                                            $rate = "/hr";
                                        }

                            ?>
                                        <div data-aos="fade-up" class="job-card card mt-3 aos-init aos-animate">
                                            <div class="card-body">
                                                <a href="job-post?id=<?php echo $row['job_id'] ?>">
                                                    <div class="d-flex justify-content-center mb-4">
                                                        <img style="margin: 0 auto; max-width: 5rem" src="static/img/barbershop-logo-png-transparent.png" alt="job-img">
                                                    </div>
                                                </a>

                                                <h5 class="card-title text-center"><?php echo $row['title'] ?></h5>
                                                <h5 style="font-size:1rem; margin-bottom:0.8rem;" class="text-muted text-center"><?php echo $row['business_name'] ?></h5>
                                                <div class="job-info d-flex justify-content-center">

                                                    <div class="job-type-info d-flex text-muted">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                        </svg>
                                                        <p style="margin-right:1rem;" class="mb-0 text-center"><?php echo $eType ?></p>
                                                    </div>

                                                    <div class="job-type-info d-flex text-muted">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                                            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                                            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                                                        </svg>
                                                        <p class="text-center card-text">$<?php echo $fullComp . $rate ?></p>
                                                    </div>
                                                </div>

                                                <div class="job-type-info d-flex text-muted d-flex justify-content-center mt-1 mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt mr-5" viewBox="0 0 16 16">
                                                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"></path>
                                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                                                    </svg>
                                                    <p class="text-center card-text"><?php echo $row['city'], ', ', $row['province'] ?></h6>
                                                </div>

                                                <div class="mt-2 d-flex justify-content-center pb-5">
                                                    <a href="job-post?id=<?php echo $row['job_id'] ?>" class="btn">View Job</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else if (mysqli_num_rows($result) < 8) {

                                    $jobarray = array();

                                    foreach ($result as $value) {
                                        array_push($jobarray, $value);
                                    }


                                    $limit = count($jobarray);

                                    $need = 8 - $limit;

                                    $list2_sql =
                                        "SELECT job.city, job.province, job.title, job.employment_type, job.compensation,
                                        job.job_id, job.premium_expiry, job.status, job.expiry_date, employer.business_name, job.payment_type
                                        FROM `job` 
                                        INNER JOIN employer ON job.employer_id = employer.employer_id 
                                WHERE status = 1 && CURDATE() <= expiry_date && premium_expiry IS NULL
                                AND (job.city like '%$city%' AND job.province like '%$province%')
                                OR premium_expiry < CURDATE() 
                                ORDER BY RAND()
                                LIMIT $need";

                                    $result2 = mysqli_query($jobConn, $list2_sql);

                                    foreach ($result2 as $value) {
                                        array_push($jobarray, $value);
                                    }

                                    if (count($jobarray) >= 8) {
                                        foreach ($jobarray as $row) {

                                            if ($row['employment_type'] == 0) {
                                                $eType = "Full Time";
                                            } else if ($row['employment_type'] == 1) {
                                                $eType = "Part Time";
                                            } else if ($row['employment_type'] == 2) {
                                                $eType = "Contract";
                                            } else if ($row['employment_type'] == 3) {
                                                $eType = "Temporary";
                                            }
                                            $fullComp = explode(',',$row['compensation'])[0];                                            if ($fullComp < 1000) {
                                                $fullComp = number_format($fullComp);
                                            } else if ($fullComp >= 1000 && $fullComp < 999999) {
                                                $fullComp = round($fullComp / 1000, 1);
                                                $fullComp = $fullComp . "K";
    
                                            } else {
                                                $fullComp = round($fullComp / 1000000, 1);
                                                $fullComp = $fullComp . "M";
                                            }
                                            // $compensation = explode(",", $row['compensation']);
                                            // $lowComp;
                                            // $highComp;
                                            // $fullComp;
                                            // if ($compensation[0] < 1000) {
                                            //     $lowComp = number_format($compensation[0]);
                                            // } else if ($compensation[0] >= 1000 && $compensation[0] < 999999) {
                                            //     $lowComp = round($compensation[0] / 1000, 1);
                                            //     $lowComp = $lowComp . "K";
                                            // } else {
                                            //     $lowComp = round($compensation[0] / 1000000, 1);
                                            //     $lowComp = $lowComp . "M";
                                            // }

                                            // if ($compensation[1] <= $compensation[0]) {
                                            //     $fullComp = $lowComp;
                                            // } else {
                                            //     if ($compensation[1] < 1000) {
                                            //         $highComp = number_format($compensation[1]);
                                            //     } else if ($compensation[1] >= 1000 && $compensation[1] < 999999) {
                                            //         $highComp = round($compensation[1] / 1000, 1);
                                            //         $highComp = $highComp . "K";
                                            //     } else {
                                            //         $highComp = round($compensation[1] / 1000000, 1);
                                            //         $highComp = $highComp . "M";
                                            //     }
                                            //     $fullComp = $lowComp . "-" . $highComp;
                                            // }
                                            $rate;
                                            if ($row['payment_type'] == "Annually") {
                                                $rate = "/yr";
                                            } else {
                                                $rate = "/hr";
                                            }

                                        ?>
                                            <div data-aos="fade-up" class="job-card card mt-3 aos-init aos-animate">
                                                <div class="card-body">
                                                    <a href="job-post?id=<?php echo $row['job_id'] ?>">
                                                        <div class="d-flex justify-content-center mb-4">
                                                            <img style="margin: 0 auto; max-width: 5rem" src="static/img/barbershop-logo-png-transparent.png" alt="job-img">
                                                        </div>
                                                    </a>

                                                    <h5 class="card-title text-center"><?php echo $row['title'] ?></h5>
                                                    <h5 style="font-size:1rem; margin-bottom:0.8rem;" class="text-muted text-center"><?php echo $row['business_name'] ?></h5>
                                                    <div class="job-info d-flex justify-content-center">

                                                        <div class="job-type-info d-flex text-muted">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                                <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                            </svg>
                                                            <p style="margin-right:1rem;" class="mb-0 text-center"><?php echo $eType ?></p>
                                                        </div>

                                                        <div class="job-type-info d-flex text-muted">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                                                <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                                                <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                                                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                                                            </svg>
                                                            <p class="text-center card-text">$<?php echo $fullComp . $rate ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="job-type-info d-flex text-muted d-flex justify-content-center mt-1 mb-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt mr-5" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"></path>
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                                                        </svg>
                                                        <p class="text-center card-text"><?php echo $row['city'], ', ', $row['province'] ?></h6>
                                                    </div>

                                                    <div class="mt-2 d-flex justify-content-center pb-5">
                                                        <a href="job-post?id=<?php echo $row['job_id'] ?>" class="btn">View Job</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        $list3_sql =
                                            "SELECT job.city, job.province, job.title, job.employment_type, job.compensation,
                                            job.job_id, job.premium_expiry, job.status, job.expiry_date, employer.business_name, job.payment_type
                                            FROM `job` 
                                            INNER JOIN employer ON job.employer_id = employer.employer_id
                                    WHERE  status = 1 && CURDATE() <= expiry_date 
                                    ORDER BY RAND()
                                    LIMIT 8";

                                        $result3 = mysqli_query($jobConn, $list3_sql);

                                        while ($row = $result3->fetch_assoc()) {

                                            if ($row['employment_type'] == 0) {
                                                $eType = "Full Time";
                                            } else if ($row['employment_type'] == 1) {
                                                $eType = "Part Time";
                                            } else if ($row['employment_type'] == 2) {
                                                $eType = "Contract";
                                            } else if ($row['employment_type'] == 3) {
                                                $eType = "Temporary";
                                            }
                                            $fullComp = explode(',',$row['compensation'])[0];                                            if ($fullComp < 1000) {
                                                $fullComp = number_format($fullComp);
                                            } else if ($fullComp >= 1000 && $fullComp < 999999) {
                                                $fullComp = round($fullComp / 1000, 1);
                                                $fullComp = $fullComp . "K";
    
                                            } else {
                                                $fullComp = round($fullComp / 1000000, 1);
                                                $fullComp = $fullComp . "M";
                                            }
                                            // $compensation = explode(",", $row['compensation']);
                                            // $lowComp;
                                            // $highComp;
                                            // $fullComp;
                                            // if ($compensation[0] < 1000) {
                                            //     $lowComp = number_format($compensation[0]);
                                            // } else if ($compensation[0] >= 1000 && $compensation[0] < 999999) {
                                            //     $lowComp = round($compensation[0] / 1000, 1);
                                            //     $lowComp = $lowComp . "K";
                                            // } else {
                                            //     $lowComp = round($compensation[0] / 1000000, 1);
                                            //     $lowComp = $lowComp . "M";
                                            // }

                                            // if ($compensation[1] <= $compensation[0]) {
                                            //     $fullComp = $lowComp;
                                            // } else {
                                            //     if ($compensation[1] < 1000) {
                                            //         $highComp = number_format($compensation[1]);
                                            //     } else if ($compensation[1] >= 1000 && $compensation[1] < 999999) {
                                            //         $highComp = round($compensation[1] / 1000, 1);
                                            //         $highComp = $highComp . "K";
                                            //     } else {
                                            //         $highComp = round($compensation[1] / 1000000, 1);
                                            //         $highComp = $highComp . "M";
                                            //     }
                                            //     $fullComp = $lowComp . "-" . $highComp;
                                            // }
                                            $rate;
                                            if ($row['payment_type'] == "Annually") {
                                                $rate = "/yr";
                                            } else {
                                                $rate = "/hr";
                                            }
                                        ?>
                                            <div data-aos="fade-up" class="job-card card mt-3 aos-init aos-animate">
                                                <div class="card-body">
                                                    <a href="job-post?id=<?php echo $row['job_id'] ?>">
                                                        <div class="d-flex justify-content-center mb-4">
                                                            <img style="margin: 0 auto; max-width: 5rem" src="static/img/barbershop-logo-png-transparent.png" alt="job-img">
                                                        </div>
                                                    </a>

                                                    <h5 class="card-title text-center"><?php echo $row['title'] ?></h5>
                                                    <h5 style="font-size:1rem; margin-bottom:0.8rem;" class="text-muted text-center"><?php echo $row['business_name'] ?></h5>
                                                    <div class="job-info d-flex justify-content-center">

                                                        <div class="job-type-info d-flex text-muted">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                                <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                            </svg>
                                                            <p style="margin-right:1rem;" class="mb-0 text-center"><?php echo $eType ?></p>
                                                        </div>

                                                        <div class="job-type-info d-flex text-muted">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                                                <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                                                <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                                                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                                                            </svg>
                                                            <p class="text-center card-text">$<?php echo $fullComp . $rate ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="job-type-info d-flex text-muted d-flex justify-content-center mt-1 mb-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt mr-5" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"></path>
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                                                        </svg>
                                                        <p class="text-center card-text"><?php echo $row['city'], ', ', $row['province'] ?></h6>
                                                    </div>

                                                    <div class="mt-2 d-flex justify-content-center pb-5">
                                                        <a href="job-post?id=<?php echo $row['job_id'] ?>" class="btn">View Job</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    }
                                }
                            } else {


                                $list_sql =
                                    "SELECT job.city, job.province, job.title, job.employment_type, job.compensation,
                                    job.job_id, job.premium_expiry, job.status, job.expiry_date, employer.business_name, job.payment_type
                                    FROM `job` 
                                    INNER JOIN employer ON job.employer_id = employer.employer_id 
                            WHERE premium_expiry >= CURDATE() && status = 1 && CURDATE() <= expiry_date
                            AND job.city like '%$city%' AND job.province like '%$province%'
                            ORDER BY RAND()
                            LIMIT 8";

                                $result = mysqli_query($jobConn, $list_sql);

                                if (mysqli_num_rows($result) >= 8) {

                                    while ($row = $result->fetch_assoc()) {

                                        if ($row['employment_type'] == 0) {

                                            $eType = "Full Time";
                                        } else if ($row['employment_type'] == 1) {
                                            $eType = "Part Time";
                                        } else if ($row['employment_type'] == 2) {
                                            $eType = "Contract";
                                        } else if ($row['employment_type'] == 3) {
                                            $eType = "Temporary";
                                        }
                                        $fullComp = explode(',',$row['compensation'])[0];                                        if ($fullComp < 1000) {
                                            $fullComp = number_format($fullComp);
                                        } else if ($fullComp >= 1000 && $fullComp < 999999) {
                                            $fullComp = round($fullComp / 1000, 1);
                                            $fullComp = $fullComp . "K";

                                        } else {
                                            $fullComp = round($fullComp / 1000000, 1);
                                            $fullComp = $fullComp . "M";
                                        }
                                        // $compensation = explode(",", $row['compensation']);
                                        // $lowComp;
                                        // $highComp;
                                        // $fullComp;
                                        // if ($compensation[0] < 1000) {
                                        //     $lowComp = number_format($compensation[0]);
                                        // } else if ($compensation[0] >= 1000 && $compensation[0] < 999999) {
                                        //     $lowComp = round($compensation[0] / 1000, 1);
                                        //     $lowComp = $lowComp . "K";
                                        // } else {
                                        //     $lowComp = round($compensation[0] / 1000000, 1);
                                        //     $lowComp = $lowComp . "M";
                                        // }

                                        // if ($compensation[1] <= $compensation[0]) {
                                        //     $fullComp = $lowComp;
                                        // } else {
                                        //     if ($compensation[1] < 1000) {
                                        //         $highComp = number_format($compensation[1]);
                                        //     } else if ($compensation[1] >= 1000 && $compensation[1] < 999999) {
                                        //         $highComp = round($compensation[1] / 1000, 1);
                                        //         $highComp = $highComp . "K";
                                        //     } else {
                                        //         $highComp = round($compensation[1] / 1000000, 1);
                                        //         $highComp = $highComp . "M";
                                        //     }
                                        //     $fullComp = $lowComp . "-" . $highComp;
                                        // }
                                        $rate;
                                        if ($row['payment_type'] == "Annually") {
                                            $rate = "/yr";
                                        } else {
                                            $rate = "/hr";
                                        }
                                        ?>
                                        <div data-aos="fade-up" class="job-card card mt-3 aos-init aos-animate">
                                            <div class="card-body">
                                                <a href="job-post?id=<?php echo $row['job_id'] ?>">
                                                    <div class="d-flex justify-content-center mb-4">
                                                        <img style="margin: 0 auto; max-width: 5rem" src="static/img/barbershop-logo-png-transparent.png" alt="job-img">
                                                    </div>
                                                </a>

                                                <h5 class="card-title text-center"><?php echo $row['title'] ?></h5>
                                                <h5 style="font-size:1rem; margin-bottom:0.8rem;" class="text-muted text-center"><?php echo $row['business_name'] ?></h5>
                                                <div class="job-info d-flex justify-content-center">

                                                    <div class="job-type-info d-flex text-muted">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                        </svg>
                                                        <p style="margin-right:1rem;" class="mb-0 text-center"><?php echo $eType ?></p>
                                                    </div>

                                                    <div class="job-type-info d-flex text-muted">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                                            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                                            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                                                        </svg>
                                                        <p class="text-center card-text">$<?php echo $fullComp . $rate ?></p>
                                                    </div>
                                                </div>

                                                <div class="job-type-info d-flex text-muted d-flex justify-content-center mt-1 mb-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt mr-5" viewBox="0 0 16 16">
                                                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"></path>
                                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                                                    </svg>
                                                    <p class="text-center card-text"><?php echo $row['city'], ', ', $row['province'] ?></h6>
                                                </div>

                                                <div class="mt-2 d-flex justify-content-center pb-5">
                                                    <a href="job-post?id=<?php echo $row['job_id'] ?>" class="btn">View Job</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else if (mysqli_num_rows($result) < 8) {

                                    $jobarray = array();

                                    foreach ($result as $value) {
                                        array_push($jobarray, $value);
                                    }


                                    $limit = count($jobarray);

                                    $need = 8 - $limit;

                                    $list2_sql =
                                        "SELECT job.city, job.province, job.title, job.employment_type, job.compensation,
                                        job.job_id, job.premium_expiry, job.status, job.expiry_date, employer.business_name, job.payment_type
                                        FROM `job` 
                                        INNER JOIN employer ON job.employer_id = employer.employer_id
                                WHERE status = 1 && CURDATE() <= expiry_date && premium_expiry IS NULL
                                AND (job.city like '%$city%' AND job.province like '%$province%')
                                OR premium_expiry < CURDATE() 
                                ORDER BY RAND()
                                LIMIT $need";

                                    $result2 = mysqli_query($jobConn, $list2_sql);

                                    foreach ($result2 as $value) {
                                        array_push($jobarray, $value);
                                    }

                                    if (count($jobarray) >= 8) {
                                        foreach ($jobarray as $row) {

                                            if ($row['employment_type'] == 0) {
                                                $eType = "Full Time";
                                            } else if ($row['employment_type'] == 1) {
                                                $eType = "Part Time";
                                            } else if ($row['employment_type'] == 2) {
                                                $eType = "Contract";
                                            } else if ($row['employment_type'] == 3) {
                                                $eType = "Temporary";
                                            }
                                            $fullComp = explode(',',$row['compensation'])[0];                                            if ($fullComp < 1000) {
                                                $fullComp = number_format($fullComp);
                                            } else if ($fullComp >= 1000 && $fullComp < 999999) {
                                                $fullComp = round($fullComp / 1000, 1);
                                                $fullComp = $fullComp . "K";
    
                                            } else {
                                                $fullComp = round($fullComp / 1000000, 1);
                                                $fullComp = $fullComp . "M";
                                            }
                                            // $compensation = explode(",", $row['compensation']);
                                            // $lowComp;
                                            // $highComp;
                                            // $fullComp;
                                            // if ($compensation[0] < 1000) {
                                            //     $lowComp = number_format($compensation[0]);
                                            // } else if ($compensation[0] >= 1000 && $compensation[0] < 999999) {
                                            //     $lowComp = round($compensation[0] / 1000, 1);
                                            //     $lowComp = $lowComp . "K";
                                            // } else {
                                            //     $lowComp = round($compensation[0] / 1000000, 1);
                                            //     $lowComp = $lowComp . "M";
                                            // }

                                            // if ($compensation[1] <= $compensation[0]) {
                                            //     $fullComp = $lowComp;
                                            // } else {
                                            //     if ($compensation[1] < 1000) {
                                            //         $highComp = number_format($compensation[1]);
                                            //     } else if ($compensation[1] >= 1000 && $compensation[1] < 999999) {
                                            //         $highComp = round($compensation[1] / 1000, 1);
                                            //         $highComp = $highComp . "K";
                                            //     } else {
                                            //         $highComp = round($compensation[1] / 1000000, 1);
                                            //         $highComp = $highComp . "M";
                                            //     }
                                            //     $fullComp = $lowComp . "-" . $highComp;
                                            // }
                                            $rate;
                                            if ($row['payment_type'] == "Annually") {
                                                $rate = "/yr";
                                            } else {
                                                $rate = "/hr";
                                            }

                                        ?>
                                            <div data-aos="fade-up" class="job-card card mt-3 aos-init aos-animate">
                                                <div class="card-body">
                                                    <a href="job-post?id=<?php echo $row['job_id'] ?>">
                                                        <div class="d-flex justify-content-center mb-4">
                                                            <img style="margin: 0 auto; max-width: 5rem" src="static/img/barbershop-logo-png-transparent.png" alt="job-img">
                                                        </div>
                                                    </a>

                                                    <h5 class="card-title text-center"><?php echo $row['title'] ?></h5>
                                                    <h5 style="font-size:1rem; margin-bottom:0.8rem;" class="text-muted text-center"><?php echo $row['business_name'] ?></h5>
                                                    <div class="job-info d-flex justify-content-center">

                                                        <div class="job-type-info d-flex text-muted">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                                <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                            </svg>
                                                            <p style="margin-right:1rem;" class="mb-0 text-center"><?php echo $eType ?></p>
                                                        </div>

                                                        <div class="job-type-info d-flex text-muted">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                                                <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                                                <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                                                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                                                            </svg>
                                                            <p class="text-center card-text">$<?php echo $fullComp . $rate ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="job-type-info d-flex text-muted d-flex justify-content-center mt-1 mb-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt mr-5" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"></path>
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                                                        </svg>
                                                        <p class="text-center card-text"><?php echo $row['city'], ', ', $row['province'] ?></h6>
                                                    </div>

                                                    <div class="mt-2 d-flex justify-content-center pb-5">
                                                        <a href="job-post?id=<?php echo $row['job_id'] ?>" class="btn">View Job</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        $list3_sql =
                                            "SELECT job.city, job.province, job.title, job.employment_type, job.compensation,
                                    job.job_id, job.premium_expiry, job.status, job.expiry_date, employer.business_name, job.payment_type
                                    FROM `job`
                                    INNER JOIN employer ON job.employer_id = employer.employer_id
                                    WHERE  status = 1 && CURDATE() <= expiry_date 
                                    ORDER BY RAND()
                                    LIMIT 8";

                                        $result3 = mysqli_query($jobConn, $list3_sql);

                                        while ($row = $result3->fetch_assoc()) {

                                            if ($row['employment_type'] == 0) {
                                                $eType = "Full Time";
                                            } else if ($row['employment_type'] == 1) {
                                                $eType = "Part Time";
                                            } else if ($row['employment_type'] == 2) {
                                                $eType = "Contract";
                                            } else if ($row['employment_type'] == 3) {
                                                $eType = "Temporary";
                                            }
                                            $fullComp = explode(',',$row['compensation'])[0];
                                            if ($fullComp < 1000) {
                                                $fullComp = number_format($fullComp);
                                            } else if ($fullComp >= 1000 && $fullComp < 999999) {
                                                $fullComp = round($fullComp / 1000, 1);
                                                $fullComp = $fullComp . "K";
    
                                            } else {
                                                $fullComp = round($fullComp / 1000000, 1);
                                                $fullComp = $fullComp . "M";
                                            }
                                            // $compensation = explode(",", $row['compensation']);
                                            // $lowComp;
                                            // $highComp;
                                            // $fullComp;
                                            // if ($compensation[0] < 1000) {
                                            //     $lowComp = number_format($compensation[0]);
                                            // } else if ($compensation[0] >= 1000 && $compensation[0] < 999999) {
                                            //     $lowComp = round($compensation[0] / 1000, 1);
                                            //     $lowComp = $lowComp . "K";
                                            // } else {
                                            //     $lowComp = round($compensation[0] / 1000000, 1);
                                            //     $lowComp = $lowComp . "M";
                                            // }

                                            // if ($compensation[1] <= $compensation[0]) {
                                            //     $fullComp = $lowComp;
                                            // } else {
                                            //     if ($compensation[1] < 1000) {
                                            //         $highComp = number_format($compensation[1]);
                                            //     } else if ($compensation[1] >= 1000 && $compensation[1] < 999999) {
                                            //         $highComp = round($compensation[1] / 1000, 1);
                                            //         $highComp = $highComp . "K";
                                            //     } else {
                                            //         $highComp = round($compensation[1] / 1000000, 1);
                                            //         $highComp = $highComp . "M";
                                            //     }
                                            //     $fullComp = $lowComp . "-" . $highComp;
                                            // }
                                            $rate;
                                            if ($row['payment_type'] == "Annually") {
                                                $rate = "/yr";
                                            } else {
                                                $rate = "/hr";
                                            }
                                        ?>
                                            <div data-aos="fade-up" class="job-card card mt-3 aos-init aos-animate">
                                                <div class="card-body">
                                                    <a href="job-post?id=<?php echo $row['job_id'] ?>">
                                                        <div class="d-flex justify-content-center mb-4">
                                                            <img style="margin: 0 auto; max-width: 5rem" src="static/img/barbershop-logo-png-transparent.png" alt="job-img">
                                                        </div>
                                                    </a>

                                                    <h5 class="card-title text-center"><?php echo $row['title'] ?></h5>
                                                    <h5 style="font-size:1rem; margin-bottom:0.8rem;" class="text-muted text-center"><?php echo $row['business_name'] ?></h5>
                                                    <div class="job-info d-flex justify-content-center">

                                                        <div class="job-type-info d-flex text-muted">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase" viewBox="0 0 16 16">
                                                                <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z" />
                                                            </svg>
                                                            <p style="margin-right:1rem;" class="mb-0 text-center"><?php echo $eType ?></p>
                                                        </div>

                                                        <div class="job-type-info d-flex text-muted">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                                                <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                                                <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                                                                <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                                                                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                                                            </svg>
                                                            <p class="text-center card-text">$<?php echo $fullComp . $rate ?></p>
                                                        </div>
                                                    </div>

                                                    <div class="job-type-info d-flex text-muted d-flex justify-content-center mt-1 mb-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt mr-5" viewBox="0 0 16 16">
                                                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"></path>
                                                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                                                        </svg>
                                                        <p class="text-center card-text"><?php echo $row['city'], ', ', $row['province'] ?></h6>
                                                    </div>

                                                    <div class="mt-2 d-flex justify-content-center pb-5">
                                                        <a href="job-post?id=<?php echo $row['job_id'] ?>" class="btn">View Job</a>
                                                    </div>
                                                </div>
                                            </div>
                            <?php
                                        }
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="recentSearches">
                        <div id="recentSearch" class="list-group position-relative">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- What do we do?  -->
    <div class="container">
        <h2 class="ft-bold text-center mt-5">What We <span style="color: #CE1A22 ;">Do</span></h2>

        <div class="row row-cols-1 row-cols-md-3 g-4 pt-5 pb-5">
            <div class="col">
                <div class="card h-100">
                    <div class="img-hover-zoom">
                        <img src="static/img/job-search.jpg" class="card-img-top" alt="job-search" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title pt-2 pb-2">Find Jobs</h5>
                        <p class="card-text">
                            We make finding jobs in the beauty industry more convenient by displaying relevent jobs for our users.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="img-hover-zoom">
                        <img src="static/img/studying.jpg" class="card-img-top" alt="studying" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title pt-2 pb-2">Educate</h5>
                        <p class="card-text">
                            Our platform contains educational resources which users can utilize to sharpen their skills.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="img-hover-zoom">
                        <img src="static/img/connections.jpg" class="card-img-top" alt="connections" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title pt-2 pb-2">Create Connections</h5>
                        <p class="card-text">
                            We aim to create a space where job seekers can connect with employers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div style="background-color:rgb(200,200,200,0.1); width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    padding-bottom:3rem;
    margin-right: -50vw;">
        <div class="container pt-5">



            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center mb-5">
                        <h6 class="text-muted mb-0 mt-5">Popular Categories</h6>
                        <h2 class="ft-bold">Browse Top <span style="color: #CE1A22 ;">Categories</span></h2>
                    </div>
                </div>
            </div>

           
            <div class="row align-items-center">

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="cats-wrap text-center">
                        <a href="search?query=Barber" class="cats-box d-block rounded bg-white shadow px-2 py-4">
                            <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" fill="crimson" class="bi bi-scissors" viewBox="0 0 16 16">
                                    <path d="M3.5 3.5c-.614-.884-.074-1.962.858-2.5L8 7.226 11.642 1c.932.538 1.472 1.616.858 2.5L8.81 8.61l1.556 2.661a2.5 2.5 0 1 1-.794.637L8 9.73l-1.572 2.177a2.5 2.5 0 1 1-.794-.637L7.19 8.61 3.5 3.5zm2.5 10a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0zm7 0a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                                </svg>
                            </div>
                            <div class="cats-box-caption">
                                <h4 class="fs-md mb-0 ft-medium m-catrio">Barbering</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="cats-wrap text-center">
                        <a href="search?query=Hair Stylist" class="cats-box d-block rounded bg-white shadow px-2 py-4">
                            <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle">
                                <img fill="#B90F0A" width="30px" height="30px" src="static/img/hair-stylist.svg" alt="Hair Stylist image">
                            </div>
                            <div class="cats-box-caption">
                                <h4 class="fs-md mb-0 ft-medium m-catrio">Hair Stylist</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="cats-wrap text-center">
                        <a href="search?query=Makeup" class="cats-box d-block rounded bg-white shadow px-2 py-4">
                            <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle">
                                <img width="30px" height="30px" src="static/img/makeup-index.svg" alt="Makeup image">
                            </div>
                            <div class="cats-box-caption">
                                <h4 class="fs-md mb-0 ft-medium m-catrio">Makeup Artist</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="cats-wrap text-center">
                        <a href="search?query=Massage" class="cats-box d-block rounded bg-white shadow px-2 py-4">
                            <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle">
                                <img width="30px" height="30px" src="static/img/massage.svg" alt="Massage image">
                            </div>
                            <div class="cats-box-caption">
                                <h4 class="fs-md mb-0 ft-medium m-catrio">Massage Therapist</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="cats-wrap text-center">
                        <a href="search?query=Tattoo Artist" class="cats-box d-block rounded bg-white shadow px-2 py-4">
                            <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle">
                                <img width="30px" height="30px" src="static/img/tattoo-artist.svg" alt="Tattoo image">
                            </div>
                            <div class="cats-box-caption">
                                <h4 class="fs-md mb-0 ft-medium m-catrio">Tattoo Artist</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="cats-wrap text-center">
                        <a href="search?query=Spa" class="cats-box d-block rounded bg-white shadow px-2 py-4">
                            <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle">
                                <img width="30px" height="30px" src="static/img/spa.svg" alt="spa image">
                            </div>
                            <div class="cats-box-caption">
                                <h4 class="fs-md mb-0 ft-medium m-catrio">Spa Worker</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="cats-wrap text-center">
                        <a href="search?query=Receptionist" class="cats-box d-block rounded bg-white shadow px-2 py-4">
                            <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle">
                                <img width="30px" height="30px" src="static/img/Receptionist.svg" alt="Receptionist image">
                            </div>
                            <div class="cats-box-caption">
                                <h4 class="fs-md mb-0 ft-medium m-catrio">Receptionist</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="cats-wrap text-center">
                        <a href="search?query=esthetician" class="cats-box d-block rounded bg-white shadow px-2 py-4">
                            <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle">
                                <img width="30px" height="30px" src="static/img/esthetician.svg" alt="Esthetician image">
                            </div>
                            <div class="cats-box-caption">
                                <h4 class="fs-md mb-0 ft-medium m-catrio">Esthetician</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="cats-wrap text-center">
                        <a href="search?query=nail" class="cats-box d-block rounded bg-white shadow px-2 py-4">
                            <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle">
                                <img width="30px" height="30px" src="static/img/nail-technician.svg" alt="Nail image">
                            </div>
                            <div class="cats-box-caption">
                                <h4 class="fs-md mb-0 ft-medium m-catrio">Nail Technician</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="cats-wrap text-center">
                        <a href="search?query=Cosmetologist" class="cats-box d-block rounded bg-white shadow px-2 py-4">
                            <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle">
                                <img width="30px" height="30px" src="static/img/cosmetologist.svg" alt="Cosmetologist image">
                            </div>
                            <div class="cats-box-caption">
                                <h4 class="fs-md mb-0 ft-medium m-catrio">Cosmetologist</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="cats-wrap text-center">
                        <a href="search?query=Cosmetic surgeon" class="cats-box d-block rounded bg-white shadow px-2 py-4">
                            <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle">
                                <img width="30px" height="30px" src="static/img/cosmetic-surgeon.svg" alt="Cosmetic image">
                            </div>
                            <div class="cats-box-caption">
                                <h4 class="fs-md mb-0 ft-medium m-catrio">cosmetic-surgeon</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="cats-wrap text-center">
                        <a href="search?query=Stylist" class="cats-box d-block rounded bg-white shadow px-2 py-4">
                            <div class="text-center mb-2 mx-auto position-relative d-inline-flex align-items-center justify-content-center p-3 theme-bg-light circle">
                                <img width="30px" height="30px" src="static/img/stylist.svg" alt="Stylist image">
                            </div>
                            <div class="cats-box-caption">
                                <h4 class="fs-md mb-0 ft-medium m-catrio">Stylist</h4>
                            </div>
                        </a>
                    </div>
                </div>



            </div>
            /row -->

            <!-- <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="position-relative text-center">
                        <a href="search?query=" class="mt-3 mb-5 p-3 btn btn-md bg-dark rounded text-light hover-theme">Browse All Categories<i class="lni lni-arrow-right-circle ml-2"></i></a>
                    </div>
                </div>
            </div> -->

        </div>
    <!-- </div> -->

    <!-- Carousel  -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="static/img/carousel-img-three.jpeg" class="d-block w-100" alt="Carousel Image" />
                <div class="carousel-caption">
                    <h5 class="animate__animated animate__fadeInDown" style="animation-delay: 1s">
                        Tattooist
                    </h5>
                    <p class="animate__animated animate__fadeInDown display-5 d-sm-none d-md-block d-none .d-sm-block" style="animation-delay: 2s">
                        Click here to view more Tattoo jobs in Edmonton
                    </p>
                    <a href="search?query=Tattoo" class="animate__animated animate__fadeInDown btn view-more-button" style="animation-delay: 3s">
                        View More
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="static/img/carousel-img-three.webp" class="d-block w-100" alt="Carousel Image" />
                <div class="carousel-caption">
                    <h5 class="animate__animated animate__fadeInDown" style="animation-delay: 1s">
                        Stylist
                    </h5>
                    <p class="animate__animated animate__fadeInDown display-5 d-sm-none d-md-block d-none .d-sm-block" style="animation-delay: 2s">
                        Click here to view more Stylist jobs in Edmonton
                    </p>
                    <a href="search?query=Stylist" class="animate__animated animate__fadeInDown btn" style="animation-delay: 3s">
                        View More
                    </a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="static/img/carousel-img-one.jpeg" class="d-block w-100" alt="Carousel Image" />
                <div class="carousel-caption">
                    <h5 class="animate__animated animate__fadeInDown" style="animation-delay: 1s">
                        Barber
                    </h5>
                    <p class="animate__animated animate__fadeInDown display-5 d-sm-none d-md-block d-none .d-sm-block" style="animation-delay: 2s">
                        Click here to view more Barber jobs in Edmonton
                    </p>
                    <a href="search?query=Barber" class="animate__animated animate__fadeInDown btn" style="animation-delay: 3s">
                        View More
                    </a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- how does it work -->
    <div style="margin-top:5rem;" class="container mb-5">
        <h2 class="ft-bold text-center">How it <span style="color: #CE1A22 ;">Works</span></h2>
        <div data-aos="zoom-in-down" class="how-it-works mt-5">
            <div class="card" style="width: 18rem">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#CD2027" class="bi bi-person-video" viewBox="0 0 16 16">
                    <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                    <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2Zm10.798 11c-.453-1.27-1.76-3-4.798-3-3.037 0-4.345 1.73-4.798 3H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1.202Z" />
                </svg>
                <div class="card-body text-center">
                    <h5>Create an Account</h5>
                    <p class="card-text">
                        Create your own personalized Salonify Account
                    </p>
                </div>
            </div>
            <div class="card" style="width: 18rem">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#CD2027" class="bi bi-file-text" viewBox="0 0 16 16">
                    <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z" />
                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z" />
                </svg>
                <div class="card-body text-center">
                    <h5>Upload Your Resume</h5>
                    <p class="card-text">
                        Publish your resume so that employers can view your skills and credentials
                    </p>
                </div>
            </div>
            <div class="card" style="width: 18rem">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#CD2027" class="bi bi-search-heart" viewBox="0 0 16 16">
                    <path d="M6.5 4.482c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018Z" />
                    <path d="M13 6.5a6.471 6.471 0 0 1-1.258 3.844c.04.03.078.062.115.098l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1.007 1.007 0 0 1-.1-.115h.002A6.5 6.5 0 1 1 13 6.5ZM6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11Z" />
                </svg>
                <div class="card-body text-center">
                    <h5>Find A Job</h5>
                    <p class="card-text">
                        Browse our catalogue of jobs and find the one that interests you the most
                    </p>
                </div>
            </div>
            <div class="card" style="width: 18rem">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#CD2027" class="bi bi-envelope-check" viewBox="0 0 16 16">
                    <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z" />
                    <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686Z" />
                </svg>
                <div class="card-body text-center">
                    <h5>Apply</h5>
                    <p class="card-text">
                        Apply for a job and wait to hear back from the employer
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    console.log("test1");
    var iset;
</script>
<script type="text/javascript">
    console.log("hello world");

    function store() {
        let inputJob = document.getElementById("job").value;
        let inputLocation = document.getElementById("location");

        var locationArray = inputLocation.value.split(", ");
        let inputCity = locationArray[0];
        let inputProvince = locationArray[1];
        console.log(inputCity);
        console.log(inputProvince);

        var searchObject = {
            job: inputJob,
            city: inputCity,
            province: inputProvince
        }

        if (iset >= 10) {
            localStorage.setItem("setKey", 0);
        }

        if (localStorage.getItem("setKey") == null) {
            localStorage.setItem("setKey", 0);
        }

        iset = localStorage.getItem("setKey");

        console.log(iset);
        localStorage.setItem(iset, JSON.stringify(searchObject));
        console.log(JSON.parse(localStorage.getItem(0)));

        pullsearches();
        iset++

        window.localStorage.setItem("setKey", iset);

    }
</script>
<script type="text/javascript">
    function pullsearches() {
        var object;
        var job = null;
        var jobURL
        var city;
        var province = null;
        var card;
        var hrefVariable;

        for (var i = 0; i < localStorage.length - 1; i++) {
            console.log(localStorage.getItem(i));
            object = JSON.parse(localStorage.getItem(i));
            job = object.job;
            console.log(job);
            city = object.city;
            console.log(city);
            province = object.province;
            console.log(province);

            jobURL = job.replaceAll(" ", "");
            hrefVariable = "../application/search?query=" + jobURL + "&location=" + city + "%2C+" + province + "&type=&distance=0"
            card = '<a href="' + hrefVariable + '"class="list-group-item list-group-item-action w-75">' + job + ' jobs in ' + city + ' , ' + province + '.</a>';
            if (job == "") {
                hrefVariable = "../application/search?query=&location=" + city + "%2C+" + province + "&type=&distance=0";
                card = '<a href="' + hrefVariable + '"class="list-group-item list-group-item-action w-75">' + 'Jobs in ' + city + ' , ' + province + '.</a>';

            }
            if (job == "" && province === undefined) {
                hrefVariable = "../application/search?query=&location=" + city + "&type=&distance=0";
                card = '<a href="' + hrefVariable + '"class="list-group-item list-group-item-action w-75">' + 'Jobs in ' + city + '.</a>';
            }
            if (job != "" && province === undefined) {
                hrefVariable = "../application/search?query=" + jobURL + "&location=" + city + "&type=&distance=0";
                card = '<a href="' + hrefVariable + '"class="list-group-item list-group-item-action w-75">' + job + 'Jobs in ' + city + '.</a>';
            }
            if (province === undefined) {
                hrefVariable = "../application/search?query=" + jobURL + "&type=&distance=0";
                card = '<a href="' + hrefVariable + '"class="list-group-item list-group-item-action w-75">' + job + ' jobs' + '.</a>';
            }

            document.getElementById("recentSearch").innerHTML += card;
        }
    }
</script>
<script>
    if (localStorage.getItem("setKey") != null) {
        pullsearches();
    }
</script>
<script src="static/js/index-banner.js"></script>
<script src="static/js/script.js"></script>
<script src="static/js/script-two.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        offset: 120,
        duration: 3000,
    });
</script>
<?php
include("includes/footer.php");
?>