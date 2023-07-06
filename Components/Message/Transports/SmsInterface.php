<?php

namespace testTask\Components\Message\Transports;

use testTask\Components\Message\Types\Sms;

interface SmsInterface
{
    public function sendSms(Sms $message): Result;
}