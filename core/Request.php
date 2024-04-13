<?php

namespace core;

class Request
{
    public array $data;
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

    public function __construct()
    {
        $this->handle();
    }

    /**
     * Handle post request
     *
     * @return void
     *
     * @author <vochilong>
     */
    private function handle()
    {
        $this->data = $_GET;

        if ($_SERVER['REQUEST_METHOD'] === self::POST && isset($_SERVER['CONTENT_TYPE'])) {
            $content_type = $_SERVER['CONTENT_TYPE'];

            if (strpos($content_type, 'application/json') !== false) {
                $json_data = file_get_contents("php://input");
                $this->data = array_merge($this->data, json_decode($json_data, true));
            } else {
                $this->data = array_merge($this->data, $_POST);
            }
        }
    }

    public function get($field, $default = null)
    {
        if (isset($this->data[$field])) {
            return $this->data[$field];
        }

        return $default;
    }

    public function all(): array
    {
        return $this->data;
    }
}
