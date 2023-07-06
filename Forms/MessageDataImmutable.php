<?php

namespace testTask\Forms;

readonly class MessageDataImmutable
{
    public function __construct(
        private ?string $phone,
        private ?string $email,
        private ?string $message,
    ) {}

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }
}