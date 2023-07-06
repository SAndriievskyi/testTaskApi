<?php

namespace testTask\Components\Message\Types;

use testTask\Validators\Email as EmailConstraint;

readonly class Email implements ValidatorInterface
{
    public function __construct(
        private ?string $email,
        private ?string $message,
    ) {}

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getValidationConstraints(): array
    {
        return [
            'email' => new EmailConstraint(),
        ];
    }
}