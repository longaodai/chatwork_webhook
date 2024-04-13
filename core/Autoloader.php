<?php

namespace core;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class)
    {
        $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            var_dump('Class ' . $file . ' not found');
            die();
        }
    }
}
