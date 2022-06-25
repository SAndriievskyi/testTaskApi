<?php

namespace testTask\Validators;

interface Constraint
{
    public function validatedBy(): string;
}