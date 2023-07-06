<?php

namespace testTask\Components\Message\Types;

interface ValidatorInterface
{
    public function getValidationConstraints(): array;
}