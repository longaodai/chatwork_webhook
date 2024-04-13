<?php
$token = "379d91af33d874e35b8d3a47c646a5de";
$owner_id = '9307477';
$payload = file_get_contents('php://input');
$data = json_decode($payload, true);
$roomId = !empty($data['webhook_event']['room_id']) ? $data['webhook_event']['room_id'] : 358038119;
$urlRequest = "https://api.chatwork.com/v2/rooms/" . $roomId . "/messages";
writeToLog("Data payload: " . json_encode($data));

if (isset($data['webhook_event']['body']) && isset($data['webhook_event']['room_id'])) {
    writeToLog('----- Send manual by webhook -----');
    $message = $data['webhook_event']['body'];
    $responseMessage = "Xin chào! Bạn vừa gửi tin nhắn: [code]{$message}[/code]";
} else {
    writeToLog('----- Send manual by web -----');
    $responseMessage = "Xin chào! Tin nhắn này được gửi thủ công ở web!";
}

if (!empty($data['webhook_event']['account_id']) && $data['webhook_event']['account_id'] != $owner_id) {
    $postData = array(
        'body' => $responseMessage,
    );
    $result = sendMessage($postData, $urlRequest, $token);
}
$messageResponse = 'Oop! Something went wrong!';

if (!empty($result) && $result['code'] == 200) {
    $messageResponse = 'Yeah! Send message successfully! Room id: ' . $roomId;
}

function sendMessage($data, $url, $token): array
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'X-ChatWorkToken: ' . $token
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($code == 200) {
        return [
            'status' => 'success',
            'code' => $code,
        ];
    }

    return [
        'status' => 'failed',
        'code' => $code,
        'response' => $response,
    ];
}

function writeToLog($message)
{
    try {
        $logFile = __DIR__ . "/logs.txt";
        $logLine = date('Y-m-d H:i:s') . " - " . $message . "\n";
        file_put_contents($logFile, $logLine, FILE_APPEND | LOCK_EX);
    } catch (\Throwable $throwable) {
        // TODO: Handle error where write logs!
    }
}

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
    <p><?= $messageResponse ?></p>
</center>
</body>
</html>

