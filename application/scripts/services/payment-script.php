<?php
include("../../includes/utils.php");
include("../../includes/job_connect.php");
require '../../../vendor/autoload.php';
// On submit add the selected items to the cart
// On success add the job entry to the database

if (isset($_POST['basic_choice']) || isset($_POST['boost_choice'])) {
  $error_array = array();
  $default_charge = false;
  //$job_id = 1;
  // Set price_ID here
  $basic_charge = getenv("HTTP_STRIPE_BASIC_CHARGE");
  $boost_3days = getenv("HTTP_STRIPE_BOOST_3");
  $boost_7days = getenv("HTTP_STRIPE_BOOST_7");
  $boost_30days = getenv("HTTP_STRIPE_BOOST_30");

  // Get the posted job details if they exist
  if (isset($_POST['city'])) {
    $job_city = $_POST['city'];
    $job_province = $_POST['province'];
    $job_postal_code = $_POST['postal_code'];
    $job_employ_type = $_POST['employ_type'];
    $job_salary = $_POST['salary'];
    $job_description = $_POST['job_description'];
    $job_address = $_POST['address'];
    $job_title = $_POST['job_title'];
    $payment_type = $_POST['pay_type'];
  }


  if (isset($_POST['job_id'])) {
    $job_id = $_POST['job_id'];
  }

  if (isset($_POST['employer_id'])) {
    $employer_id = $_POST['employer_id'];
  } else {
    $employer_id = $_SESSION['employer_id'];
  }

  //echo "Job ID: " . $job_id . " employer ID: " . $employer_id;
  $boost_choice = $_POST['boost_choice'];
  $basic_choice = $_POST['basic_choice'];

  switch ($basic_choice) {
      //Standard 30 days
    case 1:
      $basic_choice = $basic_charge;
      break;
    default:
      $basic_choice = null;
      break;
  }

  switch ($boost_choice) {
      //1: 3 day boost
    case '1':
      $boost_choice = $boost_3days;
      break;
      //2: 7 day boost
    case '2':
      $boost_choice = $boost_7days;
      break;
      //3: 30 day boost
    case '3':
      $boost_choice = $boost_30days;
      break;
    default:
      $boost_choice = null;
      break;
  }
  // Error handling


  // Existing job logic
  if (isset($job_id) && isset($employer_id)) {
    // check if job exists and is owned by user
    $existing_job = mysqli_query($jobConn, "SELECT * FROM job WHERE job_id = '$job_id' AND employer_id = '$employer_id'");
    if (mysqli_num_rows($existing_job) <= 0) {
      array_push($error_array, "job does not exist or is not owned by user");
    } else {
      $row = mysqli_fetch_array($existing_job);
      //Existing job expired: Add basic 30day charge no matter what
      if ($row['expiry_date'] < date("Y-m-d")) {
        $default_charge = true;
      }
      //Existing job not expired: Add basic 30day charge if user selects it
      if ($basic_choice != null) {
        $default_charge = true;
      }
    }
  }
  //TODO: New job logic
  else if (!isset($job_id) && isset($employer_id)) {
    //TODO: Validate job details and add to database
    $default_charge = true;
    $job_good = true;

    // Santiization
    $job_title = mysqli_real_escape_string($jobConn, $job_title);
    $job_description = mysqli_real_escape_string($jobConn, $job_description);
    $job_employ_type = mysqli_real_escape_string($jobConn, $job_employ_type);
    $post_date = date("Y-m-d H:i:s");
    $job_address = mysqli_real_escape_string($jobConn, $job_address);
    $job_city = mysqli_real_escape_string($jobConn, $job_city);
    $job_province = mysqli_real_escape_string($jobConn, $job_province);
    $job_postal_code = mysqli_real_escape_string($jobConn, $job_postal_code);
    $job_salary = mysqli_real_escape_string($jobConn, $job_salary);
    $payment_type = mysqli_real_escape_string($jobConn, $payment_type);

    //title validation
    if ($job_title == "") {
      $job_good = false;
    } elseif (strlen($job_title) > 40) {
      $job_good = false;
    } else {
      $job_title = ucwords($job_title);
    }

    //city validation
    if ($job_city == "") {
      $job_good = false;
    } elseif (strlen($job_city) > 40) {
      $job_good = false;
    } else {
      $job_city = ucwords($job_city);
    }

    //province validation
    if ($job_province == "") {
      $job_good = false;
    } elseif (strlen($job_province) > 40) {
      $job_good = false;
    } else {
      $job_province = strtoupper($job_province);
    }

    //postal code validation
    if ($job_postal_code == "") {
      $job_good = false;
    } elseif (strlen($job_postal_code) > 40) {
      $job_good = false;
    } else {
      $job_postal_code = strtoupper($job_postal_code);
    }

    //address validation
    if ($job_address == "") {
      $job_good = false;
    } elseif (strlen($job_address) > 100) {
      $job_good = false;
    } else {
      $job_address = ucwords($job_address);
    }

    //salary validation
    if ($job_salary == "") {
      $job_good = false;
    }

    //description validation
    if ($job_description == "") {
      $job_good = false;
    }

    //employ type validation
    if ($job_employ_type == "") {
      $job_good = false;
    }

    //payment type validation
    if ($payment_type == "") {
      $job_good = false;
    }


    if ($job_good) {
      try {
        $job_salary = $job_salary . "," . $job_salary;
        $new_job_sql = "INSERT INTO `job` (`employer_id`, `title`, `description`, `employment_type`, `post_date`, `address`, `city`, `province`, `postal_code`, `compensation`,`expiry_date`,`payment_type`) VALUES ('$employer_id','$job_title','$job_description','$job_employ_type','$post_date','$job_address','$job_city','$job_province','$job_postal_code','$job_salary','$post_date', '$payment_type')";
        mysqli_query($jobConn, $new_job_sql);
        //Get the last inserted job_id
        $job_id = mysqli_insert_id($jobConn);
      } catch (\Throwable $th) {
        echo $th;
        echo $new_job_sql;
        echo $job_description;
      }
    }
  }

  //If no items are posted and no default charge is needed: throw error
  if ($boost_choice == null && $basic_choice == null && $default_charge == false) {
    array_push($error_array, "No payment options supplied");
  }

  // function to fill cart
  function fillCart($basic_choice, $boost_choice, $default_charge, $basic_charge)
  {
    $cart = array();
    $item1 = array();
    $item2 = array();



    if ($default_charge) {
      $item1 = [
        'price' => $basic_charge,
        'quantity' => 1,
      ];
      array_push($cart, $item1);
    } else {
      if ($basic_choice != null) {
        $item1 = [
          'price' => $basic_choice,
          'quantity' => 1,
        ];
        array_push($cart, $item1);
      }
    }

    if ($boost_choice != null) {
      $item2 = [
        'price' => $boost_choice,
        'quantity' => 1,
      ];
      array_push($cart, $item2);
    }
    return $cart;
  }
  echo $job_id;
  $cart = fillCart($basic_choice, $boost_choice, $default_charge, $basic_charge);
  if (empty($error_array)) {

    try {
      \Stripe\Stripe::setApiKey(getenv("HTTP_STRIPE_API_KEY"));

      header('Content-Type: application/json');

      $YOUR_DOMAIN = 'http://localhost/GREENteam2022/application';

      $checkout_session = \Stripe\Checkout\Session::create([

        'line_items' => [
          $cart
        ],
        'mode' => 'payment',
        //send job id in url
        // on success page add a link to view the job
        // on failure page add a link to retry checkout
        'success_url' => $YOUR_DOMAIN . '/employer/payment-success?job_id=',
        'cancel_url' => $YOUR_DOMAIN . '/employer/payment-failure?job_id=',
        'expires_at' => time() + 60 * 30,
        'metadata' => [
          'job_id' => $job_id,
          'employer_id' => $employer_id,
        ],
      ]);

      header("HTTP/1.1 303 See Other");
      header("Location: " . $checkout_session->url);
    } catch (\Throwable $th) {
      echo $th;
    }
  }
  //Else there's errors
  else {
    //echo out all errors
    foreach ($error_array as $error) {
      echo $error . "<br>";
    }
    //echo "Errors in error_array";
  }
}
