<?php

namespace testTask\Components\Message\Transports;

use testTask\Components\Message\Types\Email;

interface EmailInterface
{
    public function sendEmail(Email $message): Result;
}