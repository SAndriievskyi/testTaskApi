<?php

namespace testTask\Validators;

use InvalidArgumentException;

class PhoneValidator implements Validator
{
    private const PATTERN = '/^\+380[0-9]{9}$/';

    public function validate($value, Constraint $constraint): ValidateResult
    {
        if (!$constraint instanceof Phone) {
            throw new InvalidArgumentException('Should be instance of class "Phone"');
        }

        if (!preg_match(self::PATTERN, $value)) {
            return new ValidateResult(false, $constraint->getErrorMessage($value));
        }

        return new ValidateResult(true);
    }
}