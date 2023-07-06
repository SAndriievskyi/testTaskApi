<?php

namespace testTask\Validators;

class Email implements Constraint
{
    private string $message = 'This "{{ value }}" is not a valid email address.';

    public function validatedBy(): string
    {
        return EmailValidator::class;
    }

    public function getErrorMessage(string $value): string
    {
        return str_replace('{{ value }}', $value, $this->message);
    }
}