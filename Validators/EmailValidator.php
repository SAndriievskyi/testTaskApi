<?php

namespace testTask\Validators;

use InvalidArgumentException;

class EmailValidator implements Validator
{
    private const PATTERN_HTML5 = '/^[a-zA-Z0-9.!#$%&\'*+\\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/';

    public function validate($value, Constraint $constraint): ValidateResult
    {
        if (!$constraint instanceof Email) {
            throw new InvalidArgumentException('Should be instance of class "Email"');
        }

        if (!preg_match(self::PATTERN_HTML5, $value)) {
            return new ValidateResult(false, $constraint->getErrorMessage($value));
        }

        return new ValidateResult(true);
    }
}