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
        $data = $request->all();
        $this->__setRoomId(!empty($data['webhook_event']['room_id']) ? $data['webhook_event']['room_id'] : CHAT_WORK_DEFAULT_ROOM_ID);
        $this->__setEndpointChatwork();
        Logging::write("----- DATA PAYLOAD -----: " . json_encode($data));

        if (isset($data['webhook_event']['body']) && isset($data['webhook_event']['room_id'])) {
            Logging::write('----- HANDLE FOR PAYLOAD -----');
            $message = $data['webhook_event']['body'];
            $responseMessage = "Xin chào! Bạn vừa gửi tin nhắn: [code]{$message}[/code]";
        } else {
            Logging::write('----- HANDLE FOR MANUAL -----');
            $responseMessage = "Xin chào! Tin nhắn này được gửi thủ công ở web!";
        }

        if (APP_ENVIRONMENT == 'local' && !empty($data['webhook_event']['account_id']) && $data['webhook_event']['account_id'] != $this->__getOwnerId()) {
            $postData = array(
                'body' => $responseMessage,
            );
            $result = cURL::post($this->__getEndpointChatwork(), $this->__getHeaders(), $postData);
        }

        $messageResponse = 'Oop! Something went wrong!';

        if (!empty($result) && $result['code'] == 200) {
            $messageResponse = 'Yeah! Send message successfully! Room id: ' . $this->__getRoomId();
        }

        return $messageResponse;
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