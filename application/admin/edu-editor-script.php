<?php
$accl = "1,1";
include("../includes/edu_connect.php");
include("../includes/utils.php");
$resourceID = $_GET['id']; 

// Returns a clean csv string of tags
function parseCsv($parse_string){
    //Remove duplicate tags
    $parse_string = strtolower($parse_string);
    $parse_string = implode(',',array_unique(explode(',', $parse_string)));
    //Remove deleted tags
    $parse_string = str_replace("del,", "",$parse_string);
    $parse_string = str_replace(",del", "",$parse_string);
    //Remove spaces
    $parse_string = str_replace(" ", "",$parse_string);
    return $parse_string;
}


if (isset($_POST['submit'])) {
    $errorList = [];

    $edu_title = $_POST['title'];
    $edu_description = $_POST['description'];
    $edu_content = $_POST['edu-content'];
    $edu_tags = $_POST['edu-tags'];
    $edu_date = $_POST['date-selection'];
    $edu_category = $_POST['category'];

    $sanitized_edu_title = mysqli_real_escape_string($eduConn, $edu_title);
    $sanitized_edu_description = mysqli_real_escape_string($eduConn, $edu_description);
    $sanitized_edu_content = mysqli_real_escape_string($eduConn, $edu_content);
    $sanitized_edu_date = mysqli_real_escape_string($eduConn, $edu_date);
    $sanitized_edu_category = mysqli_real_escape_string($eduConn, $edu_category);
    $sanitized_edu_tags = parseCsv($edu_tags);

    if (empty($sanitized_edu_title)) {
        array_push($errorList, "Title empty: " . $sanitized_edu_title);
    }
    if (empty($sanitized_edu_description)) {
        array_push($errorList, "Description empty: " . $sanitized_edu_description);
    }
    if (empty($sanitized_edu_date)) {
        array_push($errorList, "Date empty: " . $sanitized_edu_date);
    }
    if ($sanitized_edu_category <= 0) {
        array_push($errorList, "Category not selected: " . $sanitized_edu_category);
    }
    if (strlen($sanitized_edu_tags) <= 0) {
        array_push($errorList, "No tags: " . $sanitized_edu_tags);
    }
    if (strlen($sanitized_edu_tags) > 150) {
        array_push($errorList, "Tags too long, max 150: " . $sanitized_edu_tags);
    }

    try {
        // If any errors. Don't add user. Else add user
        if (count($errorList) > 0) {
            echo "<ul>";
            foreach ($errorList as $key => $val) {
                echo "<li>" . $val . "</li>";
            }
            echo "</ul>";
        } else {
            // there wasn't an error, Insert into DB
            // Query to add the new user to the employer table

            $resource_query = "UPDATE `resource` SET resource_title='$sanitized_edu_title', description='$sanitized_edu_description', content='$sanitized_edu_content', category_id=$sanitized_edu_category,  tags='$sanitized_edu_tags' WHERE resource_id=$resourceID";
            echo $resource_query;
            mysqli_query($eduConn, $resource_query);
            header("Location:education.php");
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}
