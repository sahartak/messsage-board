<?php

define('BASE_DIR', dirname(__DIR__));


spl_autoload_register(function ($class_name) {
    $filePath = BASE_DIR.'/'.str_replace('\\', '/', $class_name).'.php';

    if(file_exists($filePath)) {
        require $filePath;
    } else {
        throw new \Exception("Class $class_name not found");
    }
});