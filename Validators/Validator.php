<?php

namespace testTask\Validators;

interface Validator
{
    public function validate($value, Constraint $constraint): ValidateResult;
}