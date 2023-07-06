<?php

namespace testTask\Validators;

class Phone implements Constraint
{
    private string $message = 'This "{{ value }}" is not a valid phone.';

    public function validatedBy(): string
    {
        return PhoneValidator::class;
    }

    public function getErrorMessage(string $value): string
    {
        return str_replace('{{ value }}', $value, $this->message);
    }
}