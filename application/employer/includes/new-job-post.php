<?php 
$job_id = "";
$hide_me = true;
$form_good = $validation = $hide_it = "";
if (isset($_POST['new-job-post'])) {
    $job_title = trim($_POST['job_title']);
    $job_address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $province = trim($_POST['province']);
    $job_description = trim($_POST['description']);
    $salary = trim($_POST['salary']);
    $payment_type = trim($_POST['pay_type']);
    $employment_type = trim($_POST['employ_type']);
    $postal_code = trim($_POST['postal_code']);
    // $premium_expiry = trim($_POST['premium_expiry']);
    



$form_good = true;

if ($job_title == "")
    {
        $form_good = false;
        $validation .= "<p class=\"alert alert-danger\">job title is a required field.</p>";
    }
    else
    {
        $job_title = filter_var($job_title, FILTER_SANITIZE_STRING);
        if ($job_title == false)
            {
                $form_good = false;
                $validation .= "<p class=\"alert alert-danger\">please try again.</p>";
            }
            else
            { 
                if (strlen($job_title) > 40) 
                {
                    $form_good = false;
                    $validation .= "<p class=\"alert alert-danger\">Sorry, the maximum job title name is 40 characters.</p>";
                }
                else
                {
                    $job_title = ucwords($job_title);
                }
} 
    }

if ($job_address == "")
    {
        $form_good = false;
        $validation .= "<p class=\"alert alert-danger\">address is a required field.</p>";
    }
    else
    {
        $job_address = filter_var($job_address, FILTER_SANITIZE_STRING);
        if ($job_address == false)
            {
                $form_good = false;
                $validation .= "<p class=\"alert alert-danger\">please try again.</p>";
            }
            else
            { 
                if (strlen($job_address) > 100) 
                {
                    $form_good = false;
                    $validation .= "<p class=\"alert alert-danger\">Sorry, the maximum job title name is 100 characters.</p>";
                }
                else
                {
                    $job_address = ucwords($job_address);
                }
} 
}

if ($city == "")
    {
        $form_good = false;
        $validation .= "<p class=\"alert alert-danger\">City is a required field.</p>";
    }
    else
    {
        $city = filter_var($city, FILTER_SANITIZE_STRING);
        if ($city == false)
            {
                $form_good = false;
                $validation .= "<p class=\"alert alert-danger\">please try again.</p>";
            }
            else
            { 
                if (strlen($city) > 40) 
                {
                    $form_good = false;
                    $validation .= "<p class=\"alert alert-danger\">Sorry, the maximum job title name is 40 characters.</p>";
                }
                else
                {
                    $city = ucwords($city);
                }
} 
}

if ($province == "")
    {
        $form_good = false;
        $validation .= "<p class=\"alert alert-danger\">Province is a required field.</p>";
    }
    else
    {
        $province = filter_var($province, FILTER_SANITIZE_STRING);
        if ($province == false)
            {
                $form_good = false;
                $validation .= "<p class=\"alert alert-danger\">please try again.</p>";
            }
            else
            { 
                if (strlen($province) > 40) 
                {
                    $form_good = false;
                    $validation .= "<p class=\"alert alert-danger\">Sorry, the maximum job title name is 40 characters.</p>";
                }
                else
                {
                    $province = ucwords($province);
                }
} 
}

if ($job_description == "")
    {
        $form_good = false;
        $validation .= "<p class=\"alert alert-danger\">Job description is a required field.</p>";
    }
    else
    {   
        // Sanitizing messes with loading. Commenting out for now.
        // $job_description = filter_var($job_description, FILTER_SANITIZE_STRING);
        if ($job_description == false)
            {
                $form_good = false;
                $validation .= "<p class=\"alert alert-danger\">please try again.</p>";
            }
                else
                {
                    $job_description = ucwords($job_description);
                }
} 

if ($salary == "")
{
    
    $form_good = false;
    $validation .= "<p class=\"alert alert-danger\">salary cannot be empty</p>";
}
else
{
    $salary = filter_var($salary, FILTER_SANITIZE_STRING);
    if ($salary == false)
            {
                $form_good = false;
                $validation .= "<p>Sorry, there was a problem saving your salary. Please try again. </p>";
            }
    
}

if ($postal_code == "")
    {
        $form_good = false;
        $validation .= "<p class=\"alert alert-danger\">Postal Code is a required field.</p>";
    }
    else
    {
        $postal_code = filter_var($postal_code, FILTER_SANITIZE_STRING);
        if ($postal_code == false)
            {
                $form_good = false;
                $validation .= "<p class=\"alert alert-danger\">please try again.</p>";
            }
            else
            { 
                if (strlen($postal_code) > 40) 
                {
                    $form_good = false;
                    $validation .= "<p class=\"alert alert-danger\">Sorry, the maximum job title name is 40 characters.</p>";
                }
                else
                {
                    $postal_code = ucwords($postal_code);
                }
} 
}
}
if ($form_good == false){
    $hide_it == true;
    $hide_me = false;
} else {
    $hide_it == false;
    $hide_me = true;
}
    
        if ($form_good == true)
        {
            $user_id = $_SESSION['user_id'];
            $employer_id = $_SESSION['employer_id'];
            $sanitized_job_description = mysqli_real_escape_string($jobConn, $job_description);
            if(isset($_GET['job_id'])) {
                $job_id = $_GET['job_id'];
            }
    
            // if (isset($job_id)){
            if (strlen($job_id) > 0){
                
    
                $query = "UPDATE job SET title = '$job_title', address = '$job_address', city = '$city', province = '$province', description = '$sanitized_job_description', compensation = '$salary',
                            employment_type = '$employment_type', postal_code = '$postal_code'
                  WHERE job_id = $job_id and employer_id = $employer_id";
            }
            else
            {
            $expiry_date_new = Date('Y-m-d H:m:s', strtotime('+30 days')); 

                $query = "INSERT INTO job (title,employer_id,address,city,province,description,compensation,employment_type,postal_code,expiry_date,payment_type) 
                VALUES ('$job_title', '$employer_id','$job_address','$city','$province','$sanitized_job_description','$salary','$employment_type','$postal_code','$expiry_date_new','$payment_type')";
            }
            
    //     if (mysqli_query($jobConn, $query))
    // {
    //     // $validation .= "<p class=\"alert alert-success\">Your ad was posted successfully. </p>";
    //     $job_title = "";
    //     // include '../screening-questions.php';
    // }
    // else
    // {
    //     $validation .= "<p class=\"alert alert-danger\">Sorry, there was a problem saving your ad. Please try again. </p>";
    // }

    }
    else
    {
        $job_title = $employer_id = $job_address = $city = $province = $job_description = $salary = $payment_type = $employment_type = $postal_code =  $expiry_date = "";
    }
?>