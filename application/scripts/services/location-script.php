<?php
include("../../includes/utils.php");

if (!empty($_POST['latitude']) && !empty($_POST['longitude'])) {
    // Get values
    $lat = trim($_POST['latitude']);
    $long = trim($_POST['longitude']);
    $radius = trim($_POST['radius']);

    // Getting current location 
    $url = "https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=$lat&longitude=$long&localityLanguage=en";
    $json = @file_get_contents($url);
    //TODO: Error check here
    $data = json_decode($json);
    $data_string = $data->city . ", " . $data->principalSubdivision;
    $_SESSION["location"] = $data_string;
    $_SESSION['latitude'] = $lat;
    $_SESSION['longitude'] = $long;

    echo $data_string;
}

