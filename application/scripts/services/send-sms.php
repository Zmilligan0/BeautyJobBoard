<?php
$x = substr_count($_SERVER['REQUEST_URI'], "/");
$path = ($x > 3) ? str_repeat("../", $x - 3) : "";

require_once($path . "../vendor/autoload.php");

use Twilio\Rest\Client;

$sid = getenv("HTTP_TWILIO_ACCOUNT_SID");
$token = getenv("HTTP_TWILIO_AUTH_TOKEN");

$twilio = new Client($sid, $token);

function sendSMS($to, $message) {
    global $twilio;
    $twilio->messages->create(
        $to,
        array(
            "from" => "+15874122702",
            "body" => $message
        )
    );
}
?>