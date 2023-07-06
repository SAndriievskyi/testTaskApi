<?php

namespace testTask\Components\Message\Transports\ThirdPartyProvider;

use RuntimeException;
use testTask\Components\CurlPost;
use testTask\Components\Message\Transports\EmailInterface;
use testTask\Components\Message\Transports\Result;
use testTask\Components\Message\Transports\ResultStatusEnum;
use testTask\Components\Message\Transports\SmsInterface;
use testTask\Components\Message\Types\Email;
use testTask\Components\Message\Types\Sms;

readonly class Transport implements SmsInterface, EmailInterface
{
    public function __construct(private Config $config) {}

    public function sendSMS(Sms $message): Result
    {
        if (!$message->getPhone()) {
            return new Result(ResultStatusEnum::ERROR, 'Phone does not exist!');
        }

        return $this->sendRequest([
            'phone' => $message->getPhone(),
            'message' => $message->getMessage(),
        ]);
    }

    public function sendEmail(Email $message): Result
    {
        if (!$message->getEmail()) {
            return new Result(ResultStatusEnum::ERROR, 'Email does not exist!');
        }

        return $this->sendRequest([
            'email' => $message->getEmail(),
            'message' => $message->getMessage(),
        ]);
    }

    private function sendRequest(array $data): Result
    {
        $curl = new CurlPost(
            $this->config->getUrl(),
            [
                CURLOPT_HTTPHEADER => ['Authorization: ' . $this->config->getAccessToken()],
                CURLOPT_TIMEOUT => 1,
            ]
        );

        try {
            echo $curl($data);
        } catch (RuntimeException $exception) {
            return new Result(
                ResultStatusEnum::ERROR,
                sprintf('Http error %s with code %d', $exception->getMessage(), $exception->getCode())
            );
        }

        return new Result(ResultStatusEnum::SUCCESS);
    }
}