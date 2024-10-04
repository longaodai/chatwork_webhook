<?php

namespace service;

use core\cURL;
use core\Logging;

class Gemini
{
    private string $apiKey;
    const MODEL = 'gemini-1.5-flash';
    const BASEURL = 'https://generativelanguage.googleapis.com/v1beta';

    public function __construct()
    {
        $this->apiKey = GEMINI_API_TOKEN;
    }

    public function sendRequest($message)
    {
        $text = filter_var($this->message, FILTER_SANITIZE_STRING);
        // $url = sprintf("%s/models/%s:generateContent?key=%s", self::BASEURL, self::MODEL, $this->apiKey);
        // $data = [
        //     "contents" => [
        //         [
        //             "role" => "user",
        //             "parts" => [
        //                 ["text" => $text]
        //             ]
        //         ]
        //     ]
        // ];
        $url = 'https://generativelanguage.googleapis.com/v1beta3/models/' . self::MODEL . ':generateText?key=' . $this->apiKey;
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

        return $responseData['candidates'][0]['content']['parts'][0]['text'] ?? "No response returned";
    }
}
