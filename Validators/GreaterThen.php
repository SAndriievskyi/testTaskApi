<?php

namespace testTask\Validators;

class GreaterThen implements Constraint
{
    private int $value;
    private string $message = 'This value should be greater than {{ compared_value }}.';

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function validatedBy(): string
    {
        return GreaterThenValidator::class;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getErrorMessage(): string
    {
        return str_replace('{{ compared_value }}', $this->getValue(), $this->message);
    }
}