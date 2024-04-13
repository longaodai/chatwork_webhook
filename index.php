<h1>Hello auto CICD github action</h1>
<p>My first package github action</p>
<p>Something done !! v1 kakaka PHP</p>
<?php
$token = "379d91af33d874e35b8d3a47c646a5de";
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

$postData = array(
    'body' => $responseMessage,
);
$result = sendMessage($postData, $urlRequest, $token);

if ($result['code'] == 200) {
    echo "Tin nhắn đã được gửi lại thành công vào room $roomId.";
} else {
    echo "Có lỗi xảy ra khi gửi tin nhắn.";
}

function sendMessage($data, $url, $token)
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
    $logFile = "logs.txt";
    $fileHandle = fopen($logFile, 'a') or die("Không thể mở tệp log.");
    $logLine = date('Y-m-d H:i:s') . " - " . $message . "\n";
    fwrite($fileHandle, $logLine);
    fclose($fileHandle);
}

