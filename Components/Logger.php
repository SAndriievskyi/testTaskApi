<?php

namespace testTask\Components;

class Logger
{
    public function notice(string $text): void
    {
        echo $text . PHP_EOL;
    }

    public function error(string $text): void
    {
        echo 'ERROR: ' . $text . PHP_EOL;
    }
}