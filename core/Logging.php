<?php

namespace core;

class Logging
{

    public static function write($message)
    {
        try {
            $logFile = PATH_LOGGING_FILE;
            $logLine = date('Y-m-d H:i:s') . ' - ' . $message . "\n";
            file_put_contents($logFile, $logLine, FILE_APPEND | LOCK_EX);
        } catch (\Throwable $throwable) {
            // TODO: Handle error where write logs!
        }
    }
}