<?php

spl_autoload_register(static function ($class){
    require_once '/' . str_replace('\\', '/', $class) . '.php';
});

$test = new \testTask\Tests\Test();
$test->run();