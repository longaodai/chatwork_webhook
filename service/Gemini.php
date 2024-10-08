<?php

namespace service;

use core\cURL;
use core\Logging;

class Gemini
{
    private string $apiKey;
    const MODEL = 'gemini-1.5-flash-latest';
    const BASEURL = 'https://generativelanguage.googleapis.com/v1beta';

    public function __construct()
    {
        $this->apiKey = GEMINI_API_TOKEN;
    }

    public function sendRequest($message)
    {
        $text = filter_var($this->message, FILTER_SANITIZE_STRING);
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/' . self::MODEL . ':generateContent?key=' . $this->apiKey;
        $data = array(
            'contents' => [
                [
                    'parts' => [['text' => $message]]
                    
                ]
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

        return $responseData['candidates'][0]['content']['parts'][0]['text'] ?? "No response returned";
    }
}
