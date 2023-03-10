<?php
$first_name = $employer_id = $last_name = $email = $position = $form_good = $validation = $job_id = "";
if (isset($_POST['new-contact'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $position = trim($_POST['position']);
   
    $form_good = true;

    if ($first_name == "") {
        $form_good = false;
        $validation .= "<p class=\"alert alert-danger\">job title is a required field.</p>";
    } else {
        $first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
        if ($first_name == false) {
            $form_good = false;
            $validation .= "<p class=\"alert alert-danger\">please try again.</p>";
        } else {
            if (strlen($first_name) > 40) {
                $form_good = false;
                $validation .= "<p class=\"alert alert-danger\">Sorry, the maximum job title name is 40 characters.</p>";
            } else {
                $first_name = ucwords($first_name);
            }
        }
    }

    if ($last_name == "") {
        $form_good = false;
        $validation .= "<p class=\"alert alert-danger\">Last Name is a required field.</p>";
    } else {
        $last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
        if ($last_name == false) {
            $form_good = false;
            $validation .= "<p class=\"alert alert-danger\">please try again.</p>";
        } else {
            if (strlen($last_name) > 100) {
                $form_good = false;
                $validation .= "<p class=\"alert alert-danger\">Sorry, the maximum job title name is 100 characters.</p>";
            } else {
                $last_name = ucwords($last_name);
            }
        }
    }

    if ($email == "") {
        $form_good = false;
        $validation .= "<p class=\"alert alert-danger\">job title is a required field.</p>";
    } else {
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        if ($email == false) {
            $form_good = false;
            $validation .= "<p class=\"alert alert-danger\">please try again.</p>";
        } else {
            if (strlen($email) > 40) {
                $form_good = false;
                $validation .= "<p class=\"alert alert-danger\">Sorry, the maximum job title name is 40 characters.</p>";
            } else {
                $email = ucwords($email);
            }
        }
    }

    if ($position == "") {
        $form_good = false;
        $validation .= "<p class=\"alert alert-danger\">position is a required field.</p>";
    } else {
        $position = filter_var($position, FILTER_SANITIZE_STRING);
        if ($position == false) {
            $form_good = false;
            $validation .= "<p class=\"alert alert-danger\">please try again.</p>";
        } else {
            if (strlen($position) > 40) {
                $form_good = false;
                $validation .= "<p class=\"alert alert-danger\">Sorry, the maximum job title name is 40 characters.</p>";
            } else {
                $position = ucwords($position);
            }
        }
    }

    if ($form_good == true) {
        $user_id = $_SESSION['user_id'];
        $employer_id = $_SESSION['employer_id'];
        if (isset($_GET['contact_id'])) {
            $contact_id = $_GET['contact_id'];
        } 

        if (strlen($contact_id) > 0) {
            $query = "UPDATE contact 
                SET contact_id = '$contact_id', first_name = '$first_name', last_name = '$last_name', email = '$email', notes = '$position'
                WHERE contact_id = $contact_id";
        } else {
            $query = "INSERT INTO contact (first_name,employer_id,last_name,email,notes) 
            VALUES ('$first_name', '$employer_id','$last_name','$email','$position')";
            // $query = "UPDATE contact SET contact_id = '$contact_id', first_name = '$first_name', last_name = '$last_name', email = '$email', notes = '$position'
            // WHERE contact_id = $contact_id";

        }

        if (mysqli_query($jobConn, $query)) {
            $validation .= "<p class=\"alert alert-success\">Your contact was posted successfully. </p>";
            $first_name = "";
        } else {
            $validation .= "<p class=\"alert alert-danger\">Sorry, there was a problem saving your contact. Please try again. </p>";
        }
    } else {
        $first_name = $employer_id = $last_name = $email = $position = $form_good = $contact_id = "";
    }
}
