<?php

use testTask\Components\Logger;
use testTask\Forms\MessageDataImmutable;
use testTask\Commands\MessageSender;

spl_autoload_register(static function ($class){
    require_once '/' . str_replace('\\', '/', $class) . '.php';
});

$meassageData = new MessageDataImmutable(
    $_ENV['PHONE'] ?? null,
    $_ENV['EMAIL'] ?? null,
    $_ENV['MESSAGE'] ?? null,
);

$test = new MessageSender(new Logger());
$test->run($meassageData);