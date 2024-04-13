<?php

use service\Chatwork;

require_once __DIR__ . '/bootstrap/app.php';

$chatwork = new Chatwork();
$response = $chatwork->handle();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Webhook Chatwork</title>
</head>
<body>
<center>
    <h1>Welcome to send message Chatwork</h1>
    <p><?= $response ?></p>
</center>
</body>
</html>

