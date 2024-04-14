<?php

namespace service;

use core\cURL;

class Gemini
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = GEMINI_API_TOKEN;
    }

    public function sendRequest($message)
    {
        $url = 'https://generativelanguage.googleapis.com/v1beta3/models/text-bison-001:generateText?key=' . $this->apiKey;
        $data = array(
            'prompt' => [
                'text' => $message
            ],
        );
        $headers = array(
            'Content-Type: application/json'
        );
        $response = cURL::post($url, json_encode($data), $headers);
        $responseData = json_decode($response['response'], true);

        if (!empty($responseData['error'])) {
            return $responseData['error']['message'];
        }


        return $responseData['candidates'][0]['output'];
    }
}