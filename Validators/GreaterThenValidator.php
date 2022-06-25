<?php

namespace testTask\Validators;

use InvalidArgumentException;

class GreaterThenValidator implements Validator
{
    public function validate($value, Constraint $constraint): ValidateResult
    {
        if (!$constraint instanceof GreaterThen) {
            throw new InvalidArgumentException('Should be instance of class "GreaterThen"');
        }

        if ($value < $constraint->getValue()) {
            return new ValidateResult(false, $constraint->getErrorMessage());
        }

        return new ValidateResult(true);
    }
}