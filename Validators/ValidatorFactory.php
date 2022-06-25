<?php

namespace testTask\Validators;

class ValidatorFactory
{
    private array $validators = [];

    public function getInstance(Constraint $constraint): Validator
    {
        $className = $constraint->validatedBy();

        if (!isset($this->validators[$className])) {
            $this->validators[$className] = new $className();
        }

        return $this->validators[$className];
    }
}