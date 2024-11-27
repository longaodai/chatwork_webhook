<?php

namespace service;

use core\cURL;
use core\Logging;
use core\Request;

class Chatwork
{
    private string $token;
    private string $owner_id;
    private string $room_id;
    private array $headers;
    private string $endpoint_chatwork;

    public function __construct()
    {
        $this->__setToken();
        $this->__setOwnerId();
        $this->__setHeaders();
    }

    public function handle(): string
    {
        $request = new Request();

        if ($request->getMethod() == 'POST') {
            include_once BASE_PATH . 'template/home.php';
            exit();
        }

        $data = $request->all();
        $this->__setRoomId(!empty($data['webhook_event']['room_id']) ? $data['webhook_event']['room_id'] : CHAT_WORK_DEFAULT_ROOM_ID);
        $this->__setEndpointChatwork();
        Logging::write("----- DATA PAYLOAD -----: " . json_encode($data));

        if (
            !empty($data['webhook_event']['body']) && isset($data['webhook_event']['room_id']) &&
            (!empty($data['webhook_event']['account_id']) && $data['webhook_event']['account_id'] != $this->__getOwnerId())
        ) {
            Logging::write('----- HANDLE FOR PAYLOAD -----');
            $message = $data['webhook_event']['body'];
            $data_webhook = $data['webhook_event'];
            $reply_message = "[rp aid={$data_webhook['account_id']} to={$data_webhook['room_id']}-{$data_webhook['message_id']}]";
            $responseMessage = $reply_message;
            $actionService = new ActionService($message);
            $message = $actionService->handle();
            $postData = array(
                'body' => $responseMessage . " [code]{$message}[/code]",
            );
            $result = cURL::post($this->__getEndpointChatwork(), http_build_query($postData), $this->__getHeaders());
        }

        $messageResponse = 'Oop! Something went wrong!';
        $code = 400;

        if (!empty($result) && $result['code'] == 200) {
            $code = $result['code'];
            $messageResponse = 'Yeah! Send message successfully! Room id: ' . $this->__getRoomId();
        }

        echo json_encode([
            'code' => $code,
            'message' => $messageResponse,
        ]);
        exit();
    }

    private function __getToken(): string
    {
        return $this->token;
    }

    private function __setToken(): void
    {
        $this->token = CHAT_WORK_API_TOKEN;
    }

    private function __setHeaders(): void
    {
        $this->headers = [
            'Content-Type: application/json',
            'X-ChatWorkToken: ' . $this->__getToken()
        ];
    }

    private function __getHeaders(): array
    {
        return $this->headers;
    }

    private function __getRoomId(): string
    {
        return $this->room_id;
    }

    private function __setRoomId(string $room_id): void
    {
        $this->room_id = $room_id;
    }

    private function __getEndpointChatwork(): string
    {
        return $this->endpoint_chatwork;
    }

    private function __setEndpointChatwork(): void
    {
        $this->endpoint_chatwork = 'https://api.chatwork.com/v2/rooms/' . $this->__getRoomId() . '/messages';
    }

    private function __getOwnerId(): string
    {
        return $this->owner_id;
    }

    private function __setOwnerId(): void
    {
        $this->owner_id = CHAT_WORK_OWNER_ID;
    }
}
