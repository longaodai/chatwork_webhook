<?php

use service\Chatwork;

require_once __DIR__ . '/bootstrap/app.php';

$chatwork = new Chatwork();
$response = $chatwork->handle();
