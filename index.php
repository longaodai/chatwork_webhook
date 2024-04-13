<h1>Hello auto CICD github action</h1>
<p>My first package github action</p>
<p>Something done !! v1 kakaka PHP</p>
<?php
$payload = file_get_contents('php://input');
$data = json_decode($payload, true);
if (isset($data['webhook_event']['body']) && isset($data['webhook_event']['room_id'])) {
    $message = $data['webhook_event']['body'];
    $roomId = $data['webhook_event']['room_id'];

    $responseMessage = "Xin chào! Bạn vừa gửi tin nhắn: $message";
    $postData = array(
        'body' => $responseMessage,
    );

    // Gửi lại tin nhắn vào room
    $url = "https://api.chatwork.com/v2/rooms/$roomId/messages";
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\nX-ChatWorkToken: Ew5/V+BC4QMPU8a5kfFRCNDcJmbS6W7PcsCuJaMj72w=\r\n",
            'method'  => 'POST',
            'content' => json_encode($postData),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
    } else {
        echo "Tin nhắn đã được gửi lại thành công vào room $roomId.";
    }
} else {
    $roomId=358038119;
    $responseMessage = "Xin chào! Bạn vừa gửi tin nhắn: 123 ";
    $postData = array(
        'body' => $responseMessage,
    );
    echo "Không có dữ liệu tin nhắn hoặc room_id từ webhook.";
    $url = "https://api.chatwork.com/v2/rooms/$roomId/messages";
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\nX-ChatWorkToken: Ew5/V+BC4QMPU8a5kfFRCNDcJmbS6W7PcsCuJaMj72w=\r\n",
            'method'  => 'POST',
            'content' => json_encode($postData),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
    } else {
        echo "Tin nhắn đã được gửi lại thành công vào room $roomId.";
    }
}
