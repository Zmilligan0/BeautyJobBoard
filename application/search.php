<?php
$pageTitle = "Search a Job";
include("includes/job_connect.php");
include("includes/utils.php");
include("includes/header.php");
include("includes/_functions.php");
?>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    /* .r-job-title {
        font-weight: bold;
        overflow: hidden;
        text-overflow: ellipsis;
    } */

    
    .book-tag {
        text-decoration: none;
        color: black;
        text-align: center;
        float: left;
        width: 36px;
        height: 36px;

    }

    .book-tag:hover {
        background-color: black;
        color: gold;
        transition: 0.5s all;
    }

    .book-tag svg {
        padding-top: 0.3rem;
    }

    .page-result {
        background-color: white;
    }

    .job-dates-font-size {
        font-size: 12px;
        color: #808080;
    }

    .DivToScroll {
        background-color: white;
        left: -1px;
        padding: 10px 7px 5px;
    }

    .DivWithScroll {
        /* height: 980px; */
        overflow: scroll;
        overflow-x: hidden;
    }

    .job-sticky {
        position: sticky;
        top: 1rem;
    }


    .posting-mobile-view {
        width: 40%;
    }

    .card-header h4 {
        padding-top: 0.5rem;
        font-weight: 600;
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

    .card:not(.right-preview) {
        cursor: pointer;
    }

    .job-card:hover,
    .job-card:active {
        transition: 0.2s all;
        box-shadow: 0px 0px 3px black;
    }

    .job-card:hover,
    .job-card:active {
        transition: 0.2s all;
        box-shadow: 0px 0px 3px black;
    }

    .premium-job-card:hover,
    .premium-job-card:active {
        transition: 0.2s all;
        box-shadow: 0px 0px 3px gold;
    }

    .DivToScroll {
        height: 75vh;
    }

    .autocom-box-one li:hover,
    .autocom-box-two li:hover {
        background: #efefef;
    }

    .autocom-wrapper {
        position: relative;
    }

    .autocom-wrapper>div {
        position: absolute;
        width: 100%;
        background-color: white;
    }

    select:hover {
        cursor: pointer;
    }

    div.job-card>div.card-body {
        height: fit-content;
        max-height: 300px;
        overflow: hidden;
    }

    .form-flex {
        display: flex;
    }

    .find-button-container button {
        padding-right: 2rem;
        padding-left: 2rem;
        text-align: center;
    }

    .button-two {
        display: none;
        margin-bottom: 2rem;
    }


    .job-card button {
        display: none;
    }

    .job-date {
        visibility: hidden;
    }

    .form-select {
        width: 10rem;
    }

    .job-card h4 {
        font-size: 1rem;
    }

    .select-container {
        margin-right: 1rem;
    }

    .button-one,
    .button-two,
    .btn-block {
        background-color: var(--light-red);
        border-radius: 0;
        width: 10rem;
        color: white;
    }

    .button-one:hover,
    .button-two:hover {
        background-color: var(--light-red-hover);
        color: white;
    }



    .card-header {
        background: rgb(248, 248, 252);
        background: linear-gradient(90deg, rgba(248, 248, 252, 1) 0%, rgba(240, 240, 248, 1) 100%);
    }

    .btn:hover {
        background-color: var(--light-red-hover);
        color: white;
    }

    input {
        height: 50px;
        width: 30vw;
        outline: none;
        border: none;
        padding: 0 60px 0 20px;
        font-size: 18px;
        box-shadow: 0px 1px 5px rgb(0 0 0 / 10%);
    }

    .btn {
        border-radius: 0.5rem;
        box-shadow: 0px 1px 5px rgb(0 0 0 / 20%);
    }

    select {
        box-shadow: 0px 1px 5px rgb(0 0 0 / 10%);
    }


    .business-name {
        color: var(--light-red-hover);
    }

    .job-card {
        box-shadow: 0px 1px 5px rgb(0 0 0 / 20%);
    }

    .circle>a {
        width: 8rem;
        text-decoration: none;
        color: var(--light-red);
        font-weight: bold;
    }

    .job-card img {
        width: 7rem;
        height: 7rem;
        margin-right: 1rem;
    }

    .job-desc, .salary
    {
        display: none;
    }








    @media only screen and (max-width: 1300px) {

        .find-button-container button {
            padding-left: 1rem;
            padding-right: 1rem;
            text-align: center;
        }


        .form-select {
            max-width: 13rem;
        }







    }



    @media only screen and (max-width: 992px) {

        .select-container>select {
            font-size: 0.6rem;
        }

        .select-container {
            margin-right: 1rem;
        }

        .select-container:last-child {
            margin-right: 0rem;
        }

        .posting-mobile-view {
            width: 100%;
        }

        .find-button-container button {
            padding-right: 0rem;
            padding-left: 0rem;
            text-align: center;
        }

        .form-flex {
            display: block;
        }

        .form-control {
            width: 100%;
            margin-bottom: 1rem;
        }

        .right-panel {
            visibility: hidden;
            position: absolute;
        }

        .desktop-view-button {
            margin-bottom: 0.4rem;
        }

        .find-button-container {
            justify-content: center;
            display: flex;
        }

        .find-button-container>button {
            width: 100%;
            margin-right: unset;
        }

        .button-one {
            display: none;
        }

        .button-two {
            display: block;
        }

        .job-card button {
            display: block;
        }

        .form-select {
            max-width: 7.5rem;
        }

        .distance {
            margin-right: 0rem;
        }







    }
</style>
<?php
$location = "";
if (isset($_GET['location'])) {
    $location = $_GET['location'];
} else if (isset($_SESSION['location'])) {
    $location = $_SESSION['location'];
}
?>
<main>
    <style>
        .icon-row
        {
            position: relative;
        }
        .icon-one {
    position: absolute;
    right: 10px;
    top: -5px;
    height: 55px;
    width: 55px;
    text-align: center;
    line-height: 55px;
    font-size: 20px;
    color: #1c1e1e;
    cursor: pointer;
        }
    </style>
    <!-- Page content-->
    <div class="container">

        <!-- Search bar Section -->
        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="GET">
            <!-- Query -->
            <div class="row form-flex justify-content-center mt-5">
                <div class="icon-row col-lg-5 col-md-12">
                    <input style="margin-right:1rem ;" type="text" class="form-control mr-2" value="<?php if (isset($_GET['query'])) {
                                                                                                        echo $_GET['query'];
                                                                                                    } ?>" placeholder="Job title or company" name="query" id="query">
                    <div class="icon-one">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#CD2027" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"></path>
                            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"></path>
                        </svg>
                    </div>


                </div>
                <!-- Location -->
                <div class="icon-row col-lg-5 col-md-12 search-bar-mobile-view">
                    <input style="margin-right:0.5rem ;" type="text" value="<?php if ($location) {
                                                                                echo $location;
                                                                            } ?>" class="form-control" placeholder="Location" name="location" id="location">
                    <div class="icon-one">                                                       
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#CD2027" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"></path>
                    </svg>
                                                                        </div>
                </div>
                <!-- Submit button -->
                <div style="
    display: flex;
    justify-content: end;" class=" col-lg-2 col-md-12 find-button-container">
                    <button class="btn button-one" type="submit" id="find-jobs">Find a Job!</button>
                </div>
            </div>

            <div class=" d-flex justify-content-center mb-5 mt-4">
                <!-- Job type -->
                <div class="select-container">
                    <select id="job-select" name="type" class="form-select">
                        <option value="" selected>Job-Type</option>
                        <option value="0">Full Time</option>
                        <option value="1">Part Time</option>
                        <option value="2">Contract</option>
                        <option value="3">Temporary</option>
                        <option value="4">Apprenticeship</option>
                    </select>
                    <script type="text/javascript">
                        document.getElementById('job-select').value = "<?php echo $_GET['type']; ?>";
                    </script>
                </div>
                <!-- Date posted -->
                <div class="select-container">
                    <select name="date" id="date-select" class="form-select">
                        <option value="365" selected>Date Posted</option>
                        <option value="1">Last 24 hours</option>
                        <option value="3">Last 3 days</option>
                        <option value="7">Last 7 days</option>
                        <option value="14">Last 14 days</option>
                    </select>
                    <script type="text/javascript">
                        document.getElementById('date-select').value = "<?php echo $_GET['date']; ?>";
                    </script>
                </div>
                <!-- radius  -->
                <div class="select-container">
                    <select name="distance" id="distance-select" class="form-select distance">
                        <option value="0" selected>Only In</option>
                        <option value="5">Within 5 Kilometers</option>
                        <option value="10">Within 10 Kilometers</option>
                        <option value="15">Within 15 Kilometers</option>
                        <option value="25">Within 25 Kilometers</option>
                        <option value="50">Within 50 Kilometers</option>
                        <option value="100">Within 100 Kilometers</option>
                    </select>
                    <script type="text/javascript">
                        document.getElementById('distance-select').value = "<?php echo $_GET['distance']; ?>";

                        function isJsonString(str) {
                            try {
                                JSON.parse(str);
                            } catch (e) {
                                return false;
                            }
                            return true;
                        }
                    </script>
                </div>
            </div>
            <div style="
    display: flex;
    justify-content: end;" class=" col-lg-2 col-md-12 find-button-container">
                <button class="btn button-two" type="submit" id="find-jobs">Find a Job!</button>
            </div>
            <script defer src="static/js/search-results-dropdown.js"></script>
        </form>
    </div>
    <!-- page result -->
    <div class="container page-result">
        <div class="row mt-2 d-flex justify-content-center job-post-centers">
            <!-- job positing -->
            <div class="posting-mobile-view">





                <?php
                // Old $provinces: Wasn't returning any search results when using this array
                //$provinces = array("AB" => "alberta", "BC" => "british columbia", "MB" => "manitoba", "NB" => "new brunswick", "NL" => "newfoundland and labrador", "NT" => "northwest territories", "NS" => "nova scotia", "NU" => "nunavut", "ON" => "ontario", "PE" => "prince edward island", "QC" => "quebec", "SK" => "saskatchewan", "YT" => "yukon");

                // New $provinces: Returns search results when using this array
                $provinces = array("alberta" => "AB", "british columbia" => "BC", "manitoba" => "MB", "new brunswick" => "NB", "newfoundland and labrador" => "NL", "northwest territories" => "NT", "nova scotia" => "NS", "nunavut" => "NU", "ontario" => "ON", "prince edward island" => "PE", "quebec" => "QC", "saskatchewan" => "SK", "yukon" => "YT");

                $query_one = isset($_GET['query']) ? trim($_GET['query']) : null;
                $query_two = isset($_GET['location']) ? trim($_GET['location']) : null;
                $job_type = isset($_GET['type']) ? $_GET['type'] : null;
                $date = isset($_GET['date']) ? $_GET['date'] : 365;
                // Multiply by 1000 to get KM's
                $radius = isset($_GET['distance']) ? $_GET['distance'] * 1000 : 0;
                $list_sql = "";
                $eType = "";

                $city = null;
                $province = null;

                if (strlen($query_two) > 1) {
                    $query_two = strtolower(preg_replace('/[^a-zA-Z ]/', '', $query_two));
                    $x = false;
                    foreach ($provinces as $key => $value) {
                        if (preg_match("/\b$key\b/i", $query_two)) {
                            $province = $provinces[$key];
                            $city = trim(strtolower(preg_replace("/\b$key\b/i", "", $query_two)));
                            $x = true;
                            break;
                        } else if (preg_match("/\b$value\b/i", $query_two)) {
                            $province = $value;
                            $city = trim(strtolower(preg_replace("/\b$value\b/i", "", $query_two)));
                            $x = true;
                            break;
                        }
                    }
                    if ($x == false) {
                        $city = trim(strtolower($query_two));
                    }
                }

                $now = new DateTime();
                date_default_timezone_set('America/Edmonton');
                $now->format('Y-m-d H:i:s');

                if (isset($_GET['query']) || isset($_GET['location']) || isset($_GET['type']) || isset($_GET['date']) || isset($_GET['distance'])) {
                    // $city variable has the name of the city and province stored in it.
                    // Get values in string seperated by spaces
                    // check if defined 
                    if (isset($city)) {
                        $search_prov = $province;
                    }

                    // Code for radius api call
                    //TODO: Can only radius search based on the lat and long saved in the session
                    if ($radius > 0 && isset($city)) {

                        // API key from environemnt variable in .htaccess
                        $api_key = getenv('HTTP_HEREAPI_KEY');
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://geocode.search.hereapi.com/v1/geocode?q=$city+$search_prov&apiKey=$api_key",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'GET',
                        ));

                        $response = curl_exec($curl);

                        curl_close($curl);

                        $json = json_decode($response, true);
                        $lat = $json['items'][0]['position']['lat'];
                        $long = $json['items'][0]['position']['lng'];


                        // link to documentation: https://developer.here.com/documentation/geocoding-search-api/dev_guide/topics/endpoint-reverse-geocode-brief.html
                        // Getting nearby locations
                        $curl = curl_init();
                        // Setting up API call
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://reverse.geocoder.ls.hereapi.com/6.2/multi-reversegeocode.json?&apiKey=$api_key&mode=retrieveAreas&level=city&gen=9",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => "id=0001&prox=$lat,$long,$radius",
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: *'
                            )
                        ));
                        // Execute and close curl
                        $response = curl_exec($curl);
                        curl_close($curl);

                        // Decode response json
                        $json = json_decode($response, true);

                        // Really long forloop chain to get the province and city within the response to our api call
                        $locations = array();
                        foreach ($json as $key => $value1) {
                            if ($key == "Response") {
                                foreach ($value1 as $key => $value2) {
                                    if ($key == "Item") {
                                        foreach ($value2 as $key => $value3) {
                                            foreach ($value3 as $key => $value4) {
                                                if ($key == "Result") {
                                                    foreach ($value4 as $key => $value5) {
                                                        foreach ($value5 as $key => $value6) {
                                                            if ($key == "Location") {
                                                                foreach ($value6 as $key => $value7) {
                                                                    if ($key == "Address") {
                                                                        $output = $value7["City"] . "," . $value7['State'];
                                                                        array_push($locations, $output);
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                    //looks for premium jobs related to search query
                    $searchedjobarray = array();

                    //Create query for radius search
                    if ($radius > 0 && isset($city)) {
                        $nojobsfoundarray = array();

                        $city_sql = "";
                        $province_sql = "";
                        //For loop gets all the locations needed to pass to the WHERE clause
                        if (count($locations) > 0) {
                            for ($i = 0; $i < count($locations); $i++) {
                                // get city and province from locations array
                                $split = str_getcsv($locations[$i]);
                                $split[0] = strtolower($split[0]);
                                $split[1] = strtolower($split[1]);

                                //If on last iteration
                                if ($i + 1 == count($locations)) {
                                    $city_sql .= "'" . $split[0] . "'";
                                    $province_sql .= "'" . $split[1] . "'";
                                } else {
                                    $city_sql .= "'" . $split[0] . "'" . ',';
                                    $province_sql .= "'" . $split[1] . "'" . ',';
                                }
                            }
                        }

                        // Remove duplicates from $province_sql and return a string
                        $province_sql = implode(',', array_unique(explode(',', $province_sql)));
                        // Remove duplicates from $city_sql and return a string
                        $city_sql = implode(',', array_unique(explode(',', $city_sql)));

                        //Premium search query
                        $list2_sql =
                            "SELECT job.title, job.description, job.post_date, job.expiry_date, job.address, job.city, job.province, job.status, job.compensation, job.job_id, job.employment_type, employer.business_name, job.premium_expiry, profile_image, payment_type 
                            FROM job INNER JOIN employer ON job.employer_id = employer.employer_id 
                            WHERE job.city in ($city_sql) && job.province in ($province_sql) 
                            AND premium_expiry >= CURDATE() && status = 1 && CURDATE() <= expiry_date 
                            AND (job.employment_type LIKE '%$job_type%')
                            AND (job.post_date >= NOW() - INTERVAL $date DAY)
                            AND (job.status = 1)
                            AND (job.title LIKE '%$query_one%' OR job.description LIKE '%$query_one%' OR employer.business_name LIKE '%$query_one%')
                            ORDER BY RAND();";
                        //Normal search query
                        $list_sql =
                            "SELECT job.title, job.description, job.post_date, job.expiry_date, job.address, job.city, job.province, job.status, job.compensation, job.job_id, job.employment_type, employer.business_name, job.premium_expiry, profile_image, payment_type 
                            FROM job INNER JOIN employer ON job.employer_id = employer.employer_id 
                            WHERE job.city in ($city_sql) && job.province in ($province_sql) 
                            AND (job.employment_type LIKE '%$job_type%')
                            AND (job.post_date >= NOW() - INTERVAL $date DAY)
                            AND (job.status = 1)
                            AND (job.title LIKE '%$query_one%' OR job.description LIKE '%$query_one%' OR employer.business_name LIKE '%$query_one%')
                            AND (premium_expiry < CURDATE() OR premium_expiry is null && status = 1 && CURDATE() <= expiry_date)
                            ORDER BY RAND();";
                    } else {
                        // Single location search

                        $list2_sql =
                            "SELECT job.title, job.description, job.post_date, job.expiry_date, job.address, job.city, job.province, job.status, job.compensation, job.job_id, job.employment_type, employer.business_name, job.premium_expiry, profile_image, payment_type
                            FROM job INNER JOIN employer ON job.employer_id = employer.employer_id 
                            WHERE premium_expiry >= CURDATE() && status = 1 && CURDATE() <= expiry_date
                            AND job.city like '%$city%' AND job.province like '%$province%' 
                            AND (job.employment_type LIKE '%$job_type%')
                            AND (job.post_date >= NOW() - INTERVAL $date DAY)
                            AND (job.status = 1)
                            AND (job.title LIKE '%$query_one%' OR job.description LIKE '%$query_one%' OR employer.business_name LIKE '%$query_one%')
                            ORDER BY RAND()";

                        $list_sql = "SELECT job.title, job.description, job.post_date, job.expiry_date, job.address, job.city, job.province, job.status, job.compensation, job.job_id, job.employment_type, employer.business_name, job.premium_expiry, profile_image, payment_type 
                        FROM job INNER JOIN employer ON job.employer_id = employer.employer_id
                        WHERE (job.title LIKE '%$query_one%' OR job.description LIKE '%$query_one%' OR employer.business_name LIKE '%$query_one%')
                        AND (job.city LIKE '%$city%' AND job.province LIKE '%$province%')
                        AND (job.employment_type LIKE '%$job_type%')
                        AND (job.post_date >= NOW() - INTERVAL $date DAY)
                        AND (job.status = 1)
                        AND (premium_expiry < CURDATE() OR premium_expiry is null && status = 1 && CURDATE() <= expiry_date)";
                    }

                    $testresult = mysqli_query($jobConn, $list2_sql);

                    foreach ($testresult as $value) {
                        array_push($searchedjobarray, $value);
                    }

                    $result = mysqli_query($jobConn, $list_sql);

                    foreach ($result as $value) {
                        array_push($searchedjobarray, $value);
                    }
                    //Create a function that returns true if the first characters of the string are {"ops":
                    function isJson($string)
                    {
                        json_decode($string);
                        return (json_last_error() == JSON_ERROR_NONE);
                    }


                    if (count($searchedjobarray) > 0) {
                        foreach ($searchedjobarray as $row) {
                            $date_posted = $row['post_date'];
                            $format_date = date("M d, Y", strtotime($date_posted));

                            $type = "";
                            switch ($row['employment_type']) {
                                case 0:
                                    $type = "Full-time";
                                    break;
                                case 1:
                                    $type = "Part-time";
                                    break;
                                case 2:
                                    $type = "Contract";
                                    break;
                                case 3:
                                    $type = "Temporary";
                                    break;
                                case 4:
                                    $type = "Apprenticeship";
                                    break;
                            }
                            $row['description'] = stripslashes($row['description']);
                            if ($row['premium_expiry'] <= $now && $row['premium_expiry'] != null) {
                                echo '<div id="job-card" class="premium-job-card job-card card mb-4 box-shadow w-100">';
                                echo '<div class="d-flex card-header">';
                                echo '<div class="m-1 d-flex justify-content-between">';
                ?>
                                <?php if ($row['profile_image'] == "") {
                                    $profile_image = $companyProfileImagePath . "company_default.png";
                                } else {
                                    $profile_image = $companyProfileImagePath . $row['profile_image'];
                                }

                                ?>
                                <div class="d-flex justify-content-between">
                                    <img src="<?= $profile_image ?>" alt="<?= $profile_image ?>" id="profile-photo" class="" height="75" width="75">
                                    <p><? $row['post_date'] ?> </p>
                                </div>

                                <?php
                                $date_posted = $row['post_date'];
                                $format_date = date("M d, Y", strtotime($date_posted));
                                // echo '<img src="https://source.unsplash.com/random/50x50" alt="A random photograph with 40px by 40px dimensions.">';
                                echo '</div>';
                                echo '<div>';
                                echo '<h4 id="job-title" class="job-title my-0 font-weight-normal">' . $row['title'] . "</h4>";
                                echo '<ul class="list-unstyled mt-1 mb-1">';
                                echo '<div class="d-flex">';
                                echo '<li class="business-name" ">' . $row['business_name'] . '</li>';
                                echo '</div>';
                                echo '<div class="d-flex">';
                                echo '<li class="location-name">' . $row['city'], ', ', $row['province'] . '</li>';
                                echo '</div>';
                                echo '<div class="mt-1 d-flex">';
                                echo '<li class="employment-type badge bg-secondary text-decoration-none link-light">' . $type . '</li>';
                                echo '</div>';
                                echo '</ul>';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="card-body">';
                                echo '<ul class="list-unstyled mt-3 mb-4">';
                                //Quill start
                                echo "<li id='quillContainer{$row['job_id']}'></li>";
                                echo "<script>var quillJS{$row['job_id']} = new Quill('#quillContainer{$row['job_id']}', {theme: 'bubble', readOnly: true, modules: {toolbar: false}});";
                                if (isJson($row['description'])) {
                                    echo "quillJS{$row['job_id']}.setContents({$row['description']})";
                                } else {
                                    echo "quillJS{$row['job_id']}.setText('Job description not in valid format')";
                                }

                                echo "</script>";
                                //Quill end
                                echo '</ul>';
                                echo '</div>';
                                echo '<div class="card-body a-container d-flex justify-content-between">';
                                echo '<a style="text-decoration:none;" href="job-post?id=' . $row['job_id'] . '">';
                                echo '<button type="button" class=" btn btn-md btn-block">Apply
                                        Now!</button>';
                                echo '</a>';
                                echo '<p style="visibility: hidden;"  class="job-date job-dates-font-size">' . $format_date . '</p>';
                                echo '</div>';
                                echo '<div style="position:relative;">';
                                echo '<p style="visibility: hidden; position:absolute;" class="job-desc">' . $row['description'] . '</p>';
                                $pay = explode(',',$row['compensation']);
                                if(isset($pay[1]) && $pay[0] != $pay[1]){
                                    $salaryString = $pay[0]. " to " . $pay[1] . " CAD " . $row['payment_type']; 
                                } else {
                                    $salaryString = $pay[0]. " CAD " . $row['payment_type'];
                                }
                                echo '<p style="visibility: hidden; position:absolute;" class="salary ">' . $salaryString . '</p>';
                                echo '</div>';
                                echo '</div>';
                            } else {
                                echo '<div id="job-card" class=" job-card card mb-4 box-shadow w-100">';
                                echo '<div class="d-flex card-header">';
                                echo '<div class="d-flex justify-content-between m-1">';
                                ?>
                                <?php if ($row['profile_image'] == "") {
                                    $profile_image = $companyProfileImagePath . "company_default.png";
                                } else {
                                    $profile_image = $companyProfileImagePath . $row['profile_image'];
                                }

                                ?>
                                <div class="d-flex justify-content-between">
                                    <img src="<?= $profile_image ?>" alt="<?= $profile_image ?>" id="profile-photo" class="" height="75" width="75">
                                    <p><? $row['post_date'] ?> </p>
                                </div> <?php
                                        // echo '<img src="https://source.unsplash.com/random/50x50" alt="A random photograph with 40px by 40px dimensions.">';
                                        echo '</div>';
                                        echo '<div>';
                                        echo '<h4 id="job-title" class="job-title my-0 font-weight-normal">' . $row['title'] . "</h4>";
                                        echo '<ul class="list-unstyled mt-1 mb-1">';
                                        echo '<div class="d-flex">';
                                        echo '<li class="business-name" ">' . $row['business_name'] . '</li>';
                                        echo '</div>';
                                        echo '<div class="d-flex">';
                                        echo '<li class="location-name">' . $row['city'], ', ', $row['province'] . '</li>';
                                        echo '</div>';
                                        echo '<div class="mt-1 d-flex">';
                                        echo '<li class="employment-type badge bg-secondary text-decoration-none link-light">' . $type . '</li>';
                                        echo '</div>';
                                        echo '</ul>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '<div class="card-body">';
                                        echo '<ul class="list-unstyled mt-3 mb-4">';
                                        //Quill start
                                        echo "<li id='quillContainer{$row['job_id']}'></li>";
                                        echo "<script>var quillJS{$row['job_id']} = new Quill('#quillContainer{$row['job_id']}', {theme: 'bubble', readOnly: true, modules: {toolbar: false}});";
                                        if (isJson($row['description'])) {
                                            echo "quillJS{$row['job_id']}.setContents({$row['description']})";
                                        } else {
                                            echo "quillJS{$row['job_id']}.setText('{$row['description']}')";
                                        }
                                        echo "</script>";
                                        //Quill end
                                        echo '</ul>';
                                        echo '</div>';
                                        echo '<div class="card-body a-container d-flex justify-content-between">';
                                        echo '<a style="text-decoration:none;" href="job-post?id=' . $row['job_id'] . '">';
                                        echo '<button type="button" class="  btn btn-md btn-block">Apply Now!</button>';
                                        echo '</a>';
                                        echo '<p style="visibility: hidden;"  class="job-date job-dates-font-size">' . $format_date . '</p>';
                                        echo '</div>';
                                        echo '<div style="position:relative;">';
                                        echo '<p style="visibility: hidden; position:absolute;" class="job-desc">' . $row['description'] . '</p>';
                                        $pay = explode(',',$row['compensation']);
                                        if(isset($pay[1]) && $pay[0] != $pay[1]){
                                            $salaryString = $pay[0]. " to " . $pay[1] . " CAD " . $row['payment_type']; 
                                        } else {
                                            $salaryString = $pay[0]. " CAD " . $row['payment_type'];
                                        }
                                        echo '<p style="visibility: hidden; position:absolute;" class="salary ">' . $salaryString . '</p>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }
                            } else {

                                //no jobs found
                                echo '<div id="alert" class="alert alert-danger">';
                                echo '<strong>No Jobs Found for: </strong>' . $query_one, ' ', $query_two . '</div>';

                                $nojobsfoundarray = array();



                                $list2_sql =
                                    "SELECT job.title, job.description, job.post_date, job.expiry_date, job.address, job.city, job.province, job.status, job.compensation, job.job_id, job.employment_type, employer.business_name, job.premium_expiry, profile_image
                        FROM job INNER JOIN employer ON job.employer_id = employer.employer_id 
                        WHERE premium_expiry >= CURDATE() && status = 1 && CURDATE() <= expiry_date
                        AND job.city like '%%' AND job.province like '%%'
                        ORDER BY RAND()";

                                $fourth_query = true;

                                $testresulfour = mysqli_query($jobConn, $list2_sql);

                                foreach ($testresulfour as $value) {
                                    array_push($nojobsfoundarray, $value);
                                }

                                $list3_sql = "SELECT job.title, job.description, job.post_date, job.expiry_date, job.address, job.city, job.province, job.status, job.compensation, job.job_id, job.employment_type, employer.business_name, job.premium_expiry, profile_image
                        FROM job INNER JOIN employer ON job.employer_id = employer.employer_id
                        WHERE (job.title LIKE '%%' OR job.description LIKE '%%' OR employer.business_name LIKE '%%')
                        AND (job.premium_expiry IS NULL OR job.premium_expiry <= CURDATE())  
                        AND (job.city LIKE '%%' AND job.province LIKE '%%')
                        AND (job.employment_type LIKE '%%')
                        AND (job.status = 1)
                        ORDER BY RAND()";


                                $testresulthree = mysqli_query($jobConn, $list3_sql);

                                foreach ($testresulthree as $value) {
                                    array_push($nojobsfoundarray, $value);
                                }


                                foreach ($nojobsfoundarray as $row) {
                                    $type = "";
                                    $date_posted = $row['post_date'];
                                    $format_date = date("M d, Y", strtotime($date_posted));
                                    switch ($row['employment_type']) {
                                        case 0:
                                            $type = "Full-time";
                                            break;
                                        case 1:
                                            $type = "Part-time";
                                            break;
                                        case 2:
                                            $type = "Contract";
                                            break;
                                        case 3:
                                            $type = "Temporary";
                                            break;
                                        case 4:
                                            $type = "Apprenticeship";
                                            break;
                                    }
                                    //If premium job not expired
                                    $row['description'] = stripslashes($row['description']);
                                    if ($row['premium_expiry'] <= $now && $row['premium_expiry'] != null) {
                                        echo '<div id="job-card" class =" premium-job-card job-card card mb-4 box-shadow w-100">';
                                        echo '<div class="d-flex card-header">';
                                        echo '<div class="d-flex justify-content-between m-1">';
                                        ?>
                                <?php if ($row['profile_image'] == "") {
                                            $profile_image = $companyProfileImagePath . "company_default.png";
                                        } else {
                                            $profile_image = $companyProfileImagePath . $row['profile_image'];
                                        }

                                ?>
                                <div class="d-flex justify-content-between">
                                    <img src="<?= $profile_image ?>" alt="<?= $profile_image ?>" id="profile-photo" class="" height="75" width="75">
                                    <p><? $row['post_date'] ?> </p>
                                </div>

                            <?php       
                                        //Search not found premium job
                                        // echo '<img src="https://source.unsplash.com/random/50x50" alt="A random photograph with 40px by 40px dimensions.">';
                                        echo '</div>';
                                        echo '<div>';
                                        echo '<h4 id="job-title" class="job-title my-0 font-weight-normal">' . $row['title'] . "</h4>";
                                        echo '<ul class="list-unstyled mt-1 mb-1">';
                                        echo '<div class="d-flex">';
                                        echo '<li class="business-name" ">' . $row['business_name'] . '</li>';
                                        echo '</div>';
                                        echo '<div class="d-flex">';
                                        echo '<li class="location-name">' . $row['city'], ', ', $row['province'] . '</li>';
                                        echo '</div>';
                                        echo '<div class="d-flex mt-1">';
                                        echo '<li class="employment-type badge bg-secondary text-decoration-none link-light">' . $type . '</li>';
                                        echo '</div>';
                                        echo '</ul>';
                                        echo '</div>';
                                        
                                        echo '</div>';
                                        echo '<div class="card-body">';
                                        echo '<ul class="list-unstyled mt-3 mb-4">';
                                        //Quill start
                                        echo "<li id='quillContainer{$row['job_id']}'></li>";
                                        echo "<script>var quillJS{$row['job_id']} = new Quill('#quillContainer{$row['job_id']}', {theme: 'bubble', readOnly: true, modules: {toolbar: false}});";
                                        
                                        if (isJson($row['description'])) {
                                            echo "quillJS{$row['job_id']}.setContents({$row['description']})";
                                        } else {
                                            echo "quillJS{$row['job_id']}.setText('Job description not in valid format')";
                                        }

                                        echo "</script>";
                                        //Quill end
                                        echo '</ul>';
                                        echo '</div>';
                                        
                                        echo '<div class="card-body a-container d-flex justify-content-between">';
                                        echo '<a style="text-decoration:none;" href="job-post?id=' . $row['job_id'] . '">';
                                        echo '<button type="button" class="btn btn-md btn-block">Apply
                                        Now!</button>';
                                        echo '</a>';
                                        echo '<p style="visibility: hidden;"  class="job-date job-dates-font-size">' . $format_date . '</p>';
                                        echo '</div>';
                                        echo '<div style="position:relative;">';
                                        echo '<p style="visibility: hidden; position:absolute;" class="job-desc">' . $row['description'] . '</p>';
                                        $pay = explode(',',$row['compensation']);
                                        if(isset($pay[1]) && $pay[0] != $pay[1]){
                                            $salaryString = $pay[0]. " to " . $pay[1] . " CAD " . $row['payment_type']; 
                                        } else {
                                            $salaryString = $pay[0]. " CAD " . $row['payment_type'];
                                        }
                                        echo '<p style="visibility: hidden; position:absolute;" class="salary ">' . $salaryString . '</p>';
                                        echo '</div>';
                                        echo '</div>';
                                        

                                    } else {
                                        //Job not found
                                        echo '<div id="job-card" class=" job-card card mb-4 box-shadow w-100">';
                                        echo '<div class="d-flex card-header">';
                                        echo '<div class="d-flex justify-content-between m-1">';
                                        
                            ?>
                                <?php if ($row['profile_image'] == "") {
                                            $profile_image = $companyProfileImagePath . "company_default.png";
                                        } else {
                                            $profile_image = $companyProfileImagePath . $row['profile_image'];
                                        }

                                ?>
                                <div class="d-flex justify-content-between">
                                    <img src="<?= $profile_image ?>" alt="<?= $profile_image ?>" id="profile-photo" class="" height="75" width="75">
                                    <p><? $row['post_date'] ?> </p>
                                </div> <?php
                                        //Job not found continued from above

                                        // echo '<img src="https://source.unsplash.com/random/50x50" alt="A random photograph with 40px by 40px dimensions.">';
                                        echo '</div>';
                                        echo '<div>';
                                        echo '<h4 id="job-title" class="job-title my-0 font-weight-normal">' . $row['title'] . "</h4>";
                                        echo '<ul class="list-unstyled mt-1 mb-1">';
                                        echo '<div class="d-flex">';
                                        echo '<li class="business-name" ">' . $row['business_name'] . '</li>';
                                        echo '</div>';
                                        echo '<div class="d-flex">';
                                        echo '<li class="location-name">' . $row['city'], ', ', $row['province'] . '</li>';
                                        echo '</div>';
                                        echo '<div class="d-flex mt-1">';
                                        echo '<li class="employment-type badge bg-secondary text-decoration-none link-light">' . $type . '</li>';
                                        echo '</div>';
                                        echo '</ul>';
                                        echo '</div>';

                                        echo '</div>';
                                        echo '<div class="card-body">';
                                        echo '<ul class="list-unstyled mt-3 mb-4">';
                                        //Quill start
                                        echo "<li id='quillContainer{$row['job_id']}'></li>";
                                        echo "<script>var quillJS{$row['job_id']} = new Quill('#quillContainer{$row['job_id']}', {theme: 'bubble', readOnly: true, modules: {toolbar: false}});";
                                        
                                        if (isJson($row['description'])) {
                                            echo "quillJS{$row['job_id']}.setContents({$row['description']})";
                                        } else {
                                            echo "quillJS{$row['job_id']}.setText('Job description not in valid format')";
                                        }

                                        echo "</script>";
                                        //Quill end
                                        echo '</ul>';
                                        echo '</div>';

                                        echo '<div class="card-body a-container d-flex justify-content-between">';
                                        echo '<a style="text-decoration:none;" href="job-post?id=' . $row['job_id'] . '">';
                                        echo '<button type="button" class="btn btn-md btn-block">Apply Now!</button>';
                                        echo '</a>';
                                        echo '<p style="visibility: hidden;"  class="job-date job-dates-font-size">' . $format_date . '</p>';
                                        echo '</div>';
                                        echo '<div style="position:relative;">';
                                        echo '<p style="visibility: hidden; position:absolute;" class="job-desc">' . $row['description'] . '</p>';
                                        $pay = explode(',',$row['compensation']);
                                        if(isset($pay[1]) && $pay[0] != $pay[1]){
                                            $salaryString = $pay[0]. " to " . $pay[1] . " CAD " . $row['payment_type']; 
                                        } else {
                                            $salaryString = $pay[0]. " CAD " . $row['payment_type'];
                                        }
                                        echo '<p style="visibility: hidden; position:absolute;" class="salary ">' . $salaryString . '</p>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                } ?>
                    <?php } ?>
                    <?php }
                //On page load
                else {
                    $displayedjobarray = array();

                    $city = "edmonton";
                    $province = "ab";


                    // finds 3 premium jobs in users city and province

                    $list2_sql =
                        "SELECT job.title, job.description, job.post_date, job.expiry_date, job.address, job.city, job.province, job.status, job.compensation, job.job_id, job.employment_type, employer.business_name, job.premium_expiry, profile_image
                    FROM job INNER JOIN employer ON job.employer_id = employer.employer_id 
                    WHERE premium_expiry >= CURDATE() && status = 1 && CURDATE() <= expiry_date
                    AND job.city like '%$city%' AND job.province like '%$province%'
                    ORDER BY RAND();";

                    $testresult = mysqli_query($jobConn, $list2_sql);

                    foreach ($testresult as $value) {
                        array_push($displayedjobarray, $value);
                    }

                    // populate RANDOM jobs from database

                    $list3_sql = "SELECT job.title, job.description, job.post_date, job.expiry_date, job.address, job.city, job.province, job.status, job.compensation, job.job_id, job.employment_type, employer.business_name, job.premium_expiry, profile_image
                    FROM job INNER JOIN employer ON job.employer_id = employer.employer_id
                    WHERE (job.title LIKE '%%' OR job.description LIKE '%%' OR employer.business_name LIKE '%%')
                    AND (job.premium_expiry IS NULL OR job.premium_expiry <= CURDATE())  
                    AND (job.city LIKE '%$city%' AND job.province LIKE '%$province%')
                    AND (job.employment_type LIKE '%%')
                    AND (job.status = 1)
                    ORDER BY RAND()";

                    $testresulttwo = mysqli_query($jobConn, $list3_sql);

                    // if there isnt at least one job in the users city and province just grab random active jobs from database

                    if (mysqli_num_rows($testresulttwo) == 0) {
                        $list3_sql = "SELECT job.title, job.description, job.post_date, job.expiry_date, job.address, job.city, job.province, job.status, job.compensation, job.job_id, job.employment_type, employer.business_name, job.premium_expiry, profile_image
                        FROM job INNER JOIN employer ON job.employer_id = employer.employer_id
                        WHERE (job.title LIKE '%%' OR job.description LIKE '%%' OR employer.business_name LIKE '%%')
                        AND (job.premium_expiry IS NULL OR job.premium_expiry <= CURDATE())
                        AND (job.city LIKE '%%' AND job.province LIKE '%%')
                        AND (job.employment_type LIKE '%%')
                        AND (job.status = 1)
                        ORDER BY RAND() ";

                        $testresulttwo = mysqli_query($jobConn, $list3_sql);
                    }

                    foreach ($testresulttwo as $value) {
                        array_push($displayedjobarray, $value);
                    }

                    foreach ($displayedjobarray as $row) {
                        $date_posted = $row['post_date'];
                        $format_date = date("M d, Y", strtotime($date_posted));
                        $type = "";
                        switch ($row['employment_type']) {
                            case 0:
                                $type = "Full-time";
                                break;
                            case 1:
                                $type = "Part-time";
                                break;
                            case 2:
                                $type = "Contract";
                                break;
                            case 3:
                                $type = "Temporary";
                                break;
                            case 4:
                                $type = "Apprenticeship";
                                break;
                        }

                        if ($row['premium_expiry'] <= $now && $row['premium_expiry'] != null) {
                            echo '<div id="job-card" class="premium-job-card job-card card mb-4 box-shadow w-100">';
                            echo '<div class="d-flex card-header">';
                            echo '<div class="d-flex justify-content-between m-1">';

                    ?>
                            <?php if ($row['profile_image'] == "") {
                                $profile_image = $companyProfileImagePath . "company_default.png";
                            } else {
                                $profile_image = $companyProfileImagePath . $row['profile_image'];
                            }

                            ?>
                            <div class="d-flex justify-content-between">
                                <img src="<?= $profile_image ?>" alt="<?= $profile_image ?>" id="profile-photo" class="" height="75" width="75">
                                <p><? $row['post_date'] ?> </p>
                            </div>
                        <?php
                            // echo '<img src="https://source.unsplash.com/random/50x50" alt="A random photograph with 40px by 40px dimensions.">';
                            echo '</div>';
                            echo '<div>';
                            echo '<h4 id="job-title" class="job-title my-0 font-weight-normal">' . $row['title'] . "</h4>";
                            echo '<ul class="list-unstyled mt-1 mb-1">';
                            echo '<div class="d-flex">';
                            echo '<li class="business-name" ">' . $row['business_name'] . '</li>';
                            echo '</div>';
                            echo '<div class="d-flex">';
                            echo '<li class="location-name">' . $row['city'], ', ', $row['province'] . '</li>';
                            echo '</div>';
                            echo '<div class="d-flex mt-1">';
                            echo '<li class="employment-type badge bg-secondary text-decoration-none link-light">' . $type . '</li>';
                            echo '</div>';
                            echo '</ul>';
                            echo '</div>';
                            echo '</div>';

                            echo '<div class="card-body">';
                            echo '<ul class="list-unstyled mt-3 mb-4">';
                            echo '<li>' . $row['description'] . '</li>';
                            echo '</ul>';
                            echo '</div>';
                            
                            echo '<div class="card-body a-container d-flex justify-content-between">';
                            echo '<a style="text-decoration:none;" href="job-post?id=' . $row['job_id'] . '">';
                            echo '<button type="button" class="btn btn-md btn-block">Apply
                                    Now!</button>';
                            echo '</a>';
                            echo '<p style="visibility: hidden;"  class="job-date job-dates-font-size">' . $format_date . '</p>';
                            echo '</div>';
                            echo '<div style="position:relative;">';
                            echo '<p style="visibility: hidden; position:absolute;" class="job-desc">' . $row['description'] . '</p>';
                            $pay = explode(',',$row['compensation']);
                            if(isset($pay[1]) && $pay[0] != $pay[1]){
                                $salaryString = $pay[0]. " to " . $pay[1] . " CAD " . $row['payment_type']; 
                            } else {
                                $salaryString = $pay[0]. " CAD " . $row['payment_type'];
                            }
                            echo '<p style="visibility: hidden; position:absolute;" class="salary ">' . $salaryString . '</p>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            echo '<div id="job-card" class=" job-card card mb-4 box-shadow w-100">';
                            echo '<div class="d-flex card-header">';
                            echo '<div class="d-flex justify-content-between m-1">';
                        ?>
                            <?php if ($row['profile_image'] == "") {
                                $profile_image = $companyProfileImagePath . "company_default.png";
                            } else {
                                $profile_image = $companyProfileImagePath . $row['profile_image'];
                            }

                            ?>
                            <div class="d-flex justify-content-between">
                                <img src="<?= $profile_image ?>" alt="<?= $profile_image ?>" id="profile-photo" class="" height="75" width="75">
                                <p><? $row['post_date'] ?> </p>
                            </div>
                        <?php
                            // echo '<img src="https://source.unsplash.com/random/50x50" alt="A random photograph with 40px by 40px dimensions.">';
                            echo '</div>';
                            echo '<div>';
                            echo '<h4 id="job-title" class="job-title my-0 font-weight-normal">' . $row['title'] . "</h4>";
                            echo '<ul class="list-unstyled mt-1 mb-1">';
                            echo '<div class="d-flex">';
                            echo '<li class="business-name" ">' . $row['business_name'] . '</li>';
                            echo '</div>';
                            echo '<div class="d-flex">';
                            echo '<li class="location-name">' . $row['city'], ', ', $row['province'] . '</li>';
                            echo '</div>';
                            echo '<div class="d-flex mt-1">';
                            echo '<li class="employment-type badge bg-secondary text-decoration-none link-light">' . $type . '</li>';
                            echo '</div>';
                            echo '</ul>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="card-body">';
                            echo '<ul class="list-unstyled mt-3 mb-4">';
                            echo '<li>' . $row['description'] . '</li>';
                            echo '</ul>';
                            echo '</div>';
                            echo '<div class=" card-body a-container d-flex justify-content-between">';
                            echo '<a style="text-decoration:none;" href="job-post?id=' . $row['job_id'] . '">';
                            echo '<button type="button" class="btn btn-md btn-block">Apply Now!</button>';
                            echo '</a>';
                            echo '<p style="visibility: hidden;"  class="job-date job-dates-font-size">' . $format_date . '</p>';
                            echo '</div>';
                            echo '<div style="position:relative;">';
                            echo '<p style="visibility: hidden; position:absolute;" class="job-desc">' . $row['description'] . '</p>';
                            $pay = explode(',',$row['compensation']);
                            if(isset($pay[1]) && $pay[0] != $pay[1]){
                                $salaryString = $pay[0]. " to " . $pay[1] . " CAD " . $row['payment_type']; 
                            } else {
                                $salaryString = $pay[0]. " CAD " . $row['payment_type'];
                            }
                            echo '<p style="visibility: hidden; position:absolute;" class="salary ">' . $salaryString . '</p>';
                            echo '</div>';
                            echo '</div>';
                        } ?>
                    <?php } ?>
                <?php  }  ?>




            </div>

            <style>
                .job-image {
                    width: 100px;
                    height: 100px;
                }

                .r-job-title {
                    font-weight: bold;
                }
            </style>
            <!-- job description -->
            <div class="right-panel d-flex flex-column w-50 align-items-center job-description-hide">
                <div class="card right-preview mb-4 box-shadow w-100 job-sticky">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="m-1 d-flex">
                                <img style="margin-right: 1rem ;" class="job-image" id="job-image" src="https://source.unsplash.com/random/50x50" alt="A random photograph with 40px by 40px dimensions.">
                                <div>
                                    <h4 class="my-0 font-weight-normal"></h4>
                                    <ul class="list-unstyled mt-1 mb-1">
                                        <li class="r-job-title">Job Title</li>
                                        <div class="d-flex">
                                            <li class="r-company-name">Company</li>
                                        </div>

                                        <li class="r-location">Edmonton,AB</li>
                                        <div class="d-flex justify-content-between">
                                            <li class="r-job-date job-dates-font-size">Today</p>
                                        </div>

                                    </ul>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="a-div">

                                    <a style="text-decoration:none;" href="job-post?id='">
                                        <button type="button" style="margin-top: 2rem ;" class=" btn btn-md btn-block w-auto">Apply
                                            Now!</button>
                                    </a>
                                </div>
                            </div>
                        </div>





                    </div>
                    <div class="DivToScroll DivWithScroll">
                        <div class="card-body ">
                            <h4>Job Details</h4>
                            <ul class="list-unstyled mt-3 mb-4">

                                <div class="d-flex">
                                    <h6>Salary</h6>
                                </div>
                                <li class="r-salary">$20-$24 an hour</li>

                                <div class="d-flex mt-3">
                                    <h6>Job Type</h6>
                                </div>
                                <li class="r-job-type">Full Time</li>
                            </ul>
                        </div>
                        <div class="card-body ">
                            <h4>Full Job description</h4>
                            <div class="r-job-desc" id="fullSizedQuill">

                            </div>
                            <input hidden id="hidden-job-description" value="">

                        </div>
                        <!-- script tag -->
                        <script>
                            //Logic for updating quilljs content

                            var quill = new Quill('#fullSizedQuill', {
                                modules: {
                                    toolbar: false
                                },
                                theme: 'bubble'
                            });

                            function updateQuill() {
                                var jobDescription = document.getElementById('hidden-job-description').value;
                                if (isJsonString(jobDescription)) {
                                    var jobDescription = JSON.parse(jobDescription);
                                    quill.setContents(jobDescription);
                                } else {
                                    quill.setText(jobDescription);
                                }
                            }

                            //Using mutation observer to detect changes in the jobtype
                            //get element by classname
                            var targetNode = document.getElementsByClassName('r-job-title')[0];
                            var config = {
                                attributes: true,
                                childList: true,
                                subtree: true
                            };
                            var callback = function(mutationsList, observer) {
                                for (var mutation of mutationsList) {
                                    if (mutation) {
                                        updateQuill();
                                        console.log("mutation");
                                    }
                                }
                            };
                            var observer = new MutationObserver(callback);
                            observer.observe(targetNode, config);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = (event) => {
            var toastLiveExample = document.getElementById('liveToast')
            var toast = new bootstrap.Toast(toastLiveExample)
            toast.show()
        }
    </script>
    <script defer src="static/js/job-search.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</main>
<?php
include("job-search-posts.php");
include("includes/footer.php");
?>