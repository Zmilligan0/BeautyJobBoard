<?php
require '../../../vendor/autoload.php';
//include job connect
require '../../includes/job_connect.php';
// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
\Stripe\Stripe::setApiKey(getenv("HTTP_STRIPE_API_KEY"));

// You can find your endpoint's secret in your webhook settings
$endpoint_secret = getenv("HTTP_STRIPE_EPS");



$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
  $event = \Stripe\Webhook::constructEvent(
    $payload,
    $sig_header,
    $endpoint_secret
  );
} catch (\UnexpectedValueException $e) {
  // Invalid payload
  http_response_code(400);
  exit();
} catch (\Stripe\Exception\SignatureVerificationException $e) {
  // Invalid signature
  http_response_code(400);
  exit();
}

function payment_fail($job_id, $employer_id, $jobConn)
{

  //Get the value of expiry column using job_id
  $sql = "SELECT * FROM job WHERE job_id = '$job_id'";
  $result = mysqli_query($jobConn, $sql);
  $row = mysqli_fetch_assoc($result);
  $expiry = $row['expiry_date'];
  $post_date = $row['post_date'];

  if ($expiry <= $post_date) {
    //Delete job from DB
    $sql = "DELETE FROM job WHERE job_id = '$job_id'";
    mysqli_query($jobConn, $sql);
    error_log("Job deleted: " . $sql);
  }
  else{
    error_log("Job not deleted: " . $sql);
  }



  error_log("payment FAIL: " . $employer_id);
}

function payment_success($line_items, $job_id, $employer_id, $jobConn)
{
  // Set price_ID here
  $basic_charge = getenv("HTTP_STRIPE_BASIC_CHARGE");
  $boost_3days = getenv("HTTP_STRIPE_BOOST_3");
  $boost_7days = getenv("HTTP_STRIPE_BOOST_7");
  $boost_30days = getenv("HTTP_STRIPE_BOOST_30");

  //Get all the price ids from the line items
  $incoming_price_ids = array();
  $outgoing_price_ids = array();

  foreach ($line_items as $line_item) {
    array_push($incoming_price_ids, $line_item->price->id);
  }

  //iterate through the array and check if the price id in a switch statement
  foreach ($incoming_price_ids as $incoming_price_id) {
    switch ($incoming_price_id) {
      case $basic_charge:
        //add to outgoing array
        array_push($outgoing_price_ids, $incoming_price_id);
        break;
      case $boost_3days:
        array_push($outgoing_price_ids, $incoming_price_id);
        break;
      case $boost_7days:
        array_push($outgoing_price_ids, $incoming_price_id);
        break;
      case $boost_30days:
        array_push($outgoing_price_ids, $incoming_price_id);
        break;
      default:
        break;
    }
  }

  //Query the value of expiry column using job_id

  $job_query = "SELECT * FROM job WHERE job_id = $job_id and employer_id = $employer_id";
  $job_result = mysqli_query($jobConn, $job_query);
  $job_row = mysqli_fetch_assoc($job_result);
  $expiry_date = $job_row['expiry_date'];
  $premium_expiry_date = $job_row['premium_expiry'];
  error_log("job_query: " . $job_query);
  error_log("expiry date: " . $expiry_date . " premium expiry date: " . $premium_expiry_date);

  //set expiry result to the value of expiry column
  //$expiry_date = mysqli_fetch_assoc($job_result)['expiry_date'];
  //$premium_expiry_date = mysqli_fetch_assoc($job_result)['premium_expiry'];

  if ($expiry_date == null) {
    $expiry_date = date("Y-m-d H:i:s");
    error_log("expiry date is null: ". $expiry_date);
  }
  else {
    $expiry_date = date("Y-m-d H:i:s", strtotime($expiry_date));
    error_log("expiry date is not null: ". $expiry_date);
  }

  if ($premium_expiry_date == null) {
    $premium_expiry_date = date("Y-m-d H:i:s");
    error_log("premium expiry date is null: ". $premium_expiry_date);
  }
  else{
    $premium_expiry_date = date("Y-m-d H:i:s", strtotime($premium_expiry_date));
    error_log("premium expiry date is not null: ". $premium_expiry_date);
  }

  //For each price id in the outgoing array
  error_log("Count of price id's: " . count($outgoing_price_ids));
  foreach ($outgoing_price_ids as $outgoing_price_id) {
    //If outgoing price id = basic charge
    error_log("outgoing price id: " . $outgoing_price_id);
    if ($outgoing_price_id == $basic_charge) {
      //Add 30 days to expiry date
      $expiry_date = date("Y-m-d H:i:s", strtotime($expiry_date . "+30 days"));
      error_log("expiry date after basic charge: ". $expiry_date);
      //Update expiry date
      $basic_expiry_update = "UPDATE job SET expiry_date = '$expiry_date' WHERE job_id = $job_id and employer_id = $employer_id";
    }
    //If $boost_3days is in the outgoing array
    if ($outgoing_price_id == $boost_3days) {
      //Set premium_expiry to 3 days from now
      $premium_expiry_date = date('Y-m-d H:i:s', strtotime($premium_expiry_date . '+3 days'));
      error_log("premium expiry date after 3 days: ". $premium_expiry_date);
      //Update premium_expiry
      $premium_expiry_update = "UPDATE job SET premium_expiry = '$premium_expiry_date' WHERE job_id = $job_id and employer_id = $employer_id";
    }
    //If $boost_7days is in the outgoing array
    if ($outgoing_price_id == $boost_7days) {
      $premium_expiry_date = date('Y-m-d H:i:s', strtotime($premium_expiry_date . '+7 days'));
      error_log("premium expiry date after 7 days: ". $premium_expiry_date);
      //Update premium_expiry
      $premium_expiry_update = "UPDATE job SET premium_expiry = '$premium_expiry_date' WHERE job_id = $job_id and employer_id = $employer_id";
    }
    //If $boost_30days is in the outgoing array
    if ($outgoing_price_id == $boost_30days) {
      //Set premium_expiry to 30 days from now
      $premium_expiry_date = date('Y-m-d H:i:s', strtotime($premium_expiry_date . '+30 days'));
      error_log("premium expiry date after 30 days: ". $premium_expiry_date);
      //Update premium_expiry
      $premium_expiry_update = "UPDATE job SET premium_expiry = '$premium_expiry_date' WHERE job_id = $job_id and employer_id = $employer_id";
    }
  }

  //if expiry_update isset complete query
  if (isset($basic_expiry_update)) {
    try {
      $expiry_update_result = mysqli_query($jobConn, $basic_expiry_update);
    } catch (\Throwable $th) {
      error_log("Basic expiry error: " . $th);
    }
    
    error_log("basic expiry updated: ".$expiry_update_result);
  }

  //if premium_expiry_update isset complete query
  if (isset($premium_expiry_update)) {
    //If expiry_date will expire before premium_expiry and premium_expiry is set
    //Set expiry_date to premium_expiry
    if($expiry_date < $premium_expiry_date){
      //Update expiry_date and premium_expiry
      $expiry_update = "UPDATE job SET premium_expiry = '$premium_expiry_date', expiry_date = '$premium_expiry_date' WHERE job_id = $job_id and employer_id = $employer_id";
      try {
        mysqli_query($jobConn, $expiry_update);
      } catch (\Throwable $th) {
        error_log("Error updating basic with premium expiry: ".$th);
      }
      
      error_log("Expiry < premium update: ".$expiry_update);
    }
    else{
      try {
        mysqli_query($jobConn, $premium_expiry_update);
      } catch (\Throwable $th) {
        error_log("Error updating premium expiry: ".$th);
      }
      
      error_log("Premium update: ".$premium_expiry_update);
    }

  }

  error_log("Payment Success: " . $line_items);
  //error_log($line_items . ":" . $employer_id);
}

// Handle the checkout.session.completed event
if ($event->type == 'checkout.session.completed') {
  // Retrieve the session. If you require line items in the response, you may include them by expanding line_items.
  $session = \Stripe\Checkout\Session::retrieve([
    'id' => $event->data->object->id,
    'expand' => ['line_items'],

  ]);

  $line_items = $session->line_items;
  $job_id = $event->data->object->metadata->job_id;
  $employer_id = $event->data->object->metadata->employer_id;
  // Fulfill the purchase...
  payment_success($line_items, $job_id, $employer_id, $jobConn);
}

if ($event->type == 'checkout.session.expired') {
  $job_id = $event->data->object->metadata->job_id;
  $employer_id = $event->data->object->metadata->employer_id;
  payment_fail($job_id, $employer_id, $jobConn);
}

http_response_code(200);
