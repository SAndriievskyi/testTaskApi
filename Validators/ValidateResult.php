<?php

namespace testTask\Validators;

class ValidateResult
{
    private bool $isValidated;
    private ?string $errorMessage;

    public function __construct(bool $isValidated, ?string $errorMessage = null)
    {
        $this->isValidated = $isValidated;
        $this->errorMessage = $errorMessage;
    }

    public function isValidated(): bool
    {
        return $this->isValidated;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
}