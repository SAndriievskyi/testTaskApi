<?php

namespace testTask\Validators;

use InvalidArgumentException;

class GreaterThenOrEqualValidator implements Validator
{
    public function validate($value, Constraint $constraint): ValidateResult
    {
        if (!$constraint instanceof GreaterThenOrEqual) {
            throw new InvalidArgumentException('Should be instance of class "GreaterThenOrEqual"');
        }

        if ($value < $constraint->getValue()) {
            return new ValidateResult(false, $constraint->getErrorMessage());
        }

        return new ValidateResult(true);
    }
}