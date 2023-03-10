<?php
if (!defined("ROOT_URL")) {
    define("ROOT_URL", "http://localhost/GREENteam2022/application/");
}

$pageTitle;
$fqt = "Salonify";
if (isset($pageTitle) && !empty($pageTitle) && $pageTitle != "Home Page") {
    $fqt = "$pageTitle - Salonify";
} elseif (empty($pageTitle)) {
    echo "<h1>Page title not set. Add a title before the header include by declaring the variable \$pageTitle.</h1>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>static/css/global.css">
</head>

<body>