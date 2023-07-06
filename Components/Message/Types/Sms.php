<?php

namespace testTask\Components\Message\Types;

use testTask\Validators\Phone;

readonly class Sms implements ValidatorInterface
{
    public function __construct(
        private ?string $phone,
        private ?string $message,
    ) {}

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getValidationConstraints(): array
    {
        return [
            'phone' => new Phone(),
        ];
    }
}