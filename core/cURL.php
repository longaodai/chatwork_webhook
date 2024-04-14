<?php

namespace core;

class cURL
{
    /**
     * Support for send request POST by cURL
     *
     * @param string $url
     * @param array $headers
     * @param mixed $data
     *
     * @return array
     *
     * @author <vochilong>
     */
    public static function post(string $url, $data, array $headers = []): array
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'code' => $code,
            'response' => $response,
        ];
    }
}