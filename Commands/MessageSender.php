<?php

namespace testTask\Commands;

use testTask\Components\Logger;
use testTask\Components\Message\Transports\ResultStatusEnum;
use testTask\Components\Message\TransportFactory;
use testTask\Components\Message\Types\Email;
use testTask\Components\Message\Types\Sms;
use testTask\Components\Message\Validator;
use testTask\Forms\MessageDataImmutable;

readonly class MessageSender
{
    public function __construct(
        private Logger $logger,
        private Validator $validator = new Validator(),
    ) {}

    public function run(MessageDataImmutable $meassageData): void
    {
        $messageText = $meassageData->getMessage();
        if (!$messageText) {
            $this->logger->error('Messege is empty!');

            return;
        }

        $phone = $meassageData->getPhone();
        $email = $meassageData->getEmail();
        if (!$phone && !$email) {
            $this->logger->error('No recipient data!');

            return;
        }

        $transportsFactory = new TransportFactory();
        if ($phone) {
            $this->sendSms($transportsFactory, $phone, $messageText);
        }
        if ($email) {
            $this->sendEmail($transportsFactory, $email, $messageText);
        }
    }

    private function sendSms(TransportFactory $transportsFactory, string $phone, string $messageText): void
    {
        $smsMessage = new Sms($phone, $messageText);
        $errors = $this->validator->validate($smsMessage);
        if ($errors) {
            $this->logger->notice('Validation errors:');
            $this->logger->notice(implode(PHP_EOL, $errors));
        } else {
            foreach ($transportsFactory->createSmsTransports() as $transport) {
                $result = $transport->sendSms($smsMessage);
                if ($result->getStatus() === ResultStatusEnum::ERROR) {
                    $this->logger->error($result->getError());
                }
            }
        }
    }

    private function sendEmail(TransportFactory $transportsFactory, string $email, string $messageText): void
    {
        $emailMessage = new Email($email, $messageText);
        $errors = $this->validator->validate($emailMessage);
        if ($errors) {
            $this->logger->notice('Validation errors:');
            $this->logger->notice(implode(PHP_EOL, $errors));
        } else {
            foreach ($transportsFactory->createEmailTransports() as $transport) {
                $result = $transport->sendEmail($emailMessage);
                if ($result->getStatus() === ResultStatusEnum::ERROR) {
                    $this->logger->error($result->getError());
                }
            }
        }
    }
}