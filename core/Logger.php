<?php

namespace core;

class Logger
{
    public function __construct()
    {
        ini_set('display_errors', true);
        ini_set('log_errors', true);
        ini_set('error_log', PATH_LOGGING_FILE);
    }
}