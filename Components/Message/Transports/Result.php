<?php

namespace testTask\Components\Message\Transports;

readonly class Result
{
    public function __construct(
        private ResultStatusEnum $status,
        private ?string $error = null,
    ) {}

    public function getStatus(): ResultStatusEnum
    {
        return $this->status;
    }

    public function getError(): ?string
    {
        return $this->error;
    }
}