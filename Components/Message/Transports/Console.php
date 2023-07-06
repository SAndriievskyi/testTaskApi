<?php

namespace testTask\Components\Message\Transports;

use testTask\Components\Message\Types\Email;
use testTask\Components\Message\Types\Sms;

class Console implements SmsInterface, EmailInterface
{
    public function sendSMS(Sms $message): Result
    {
        if (!$message->getPhone()) {
            return new Result(ResultStatusEnum::ERROR, 'Phone does not exist!');
        }

        echo 'Recipient with number ' . $message->getPhone() . ' recive SMS with text "' . $message->getMessage() . '"';
        echo PHP_EOL;

        return new Result(ResultStatusEnum::SUCCESS);
    }

    public function sendEmail(Email $message): Result
    {
        if (!$message->getEmail()) {
            return new Result(ResultStatusEnum::ERROR, 'Email does not exist!');
        }

        echo 'Recipient with email ' . $message->getEmail() . ' recive EMAIL with text "' . $message->getMessage() . '"';
        echo PHP_EOL;

        return new Result(ResultStatusEnum::SUCCESS);
    }
}