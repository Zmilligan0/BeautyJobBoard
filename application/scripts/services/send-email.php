<?php
$x = substr_count($_SERVER['REQUEST_URI'], "/");
$path = ($x > 3) ? str_repeat("../", $x - 3) : "";

require_once($path . '../vendor/autoload.php');

use Postmark\PostmarkClient;

$apiKey = getenv("HTTP_POSTMARK_API_KEY");

$client = new PostmarkClient($apiKey);

function sendEmail($to, $subject, $textBody, $htmlBody = NULL)
{
    global $client;

    if ($htmlBody == NULL) {
        $htmlBody = $textBody;
    }

    $tag = "example-email-tag";
    $trackOpens = true;
    $trackLinks = "None";
    $messageStream = "broadcast";

    // Send an email:
    $sendResult = $client->sendEmail(
        "greenteam@salonify.ca",
        $to,
        $subject,
        $htmlBody,
        $textBody,
        $tag,
        $trackOpens,
        NULL, // Reply To
        NULL, // CC
        NULL, // BCC
        NULL, // Header array
        NULL, // Attachment array
        $trackLinks,
        NULL, // Metadata array
        $messageStream
    );

    // echo "Email sent. Message ID: " . $sendResult->MessageID;
}

