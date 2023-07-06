<?php

namespace testTask\Components\Message;

use testTask\Components\Message\Types\ValidatorInterface;
use testTask\Validators\ValidatorFactory;

class Validator
{
    private ValidatorFactory $validatorFactory;

    public function __construct()
    {
        $this->validatorFactory = new ValidatorFactory();
    }

    public function validate(ValidatorInterface $entity): array
    {
        $errors = [];
        foreach ($entity->getValidationConstraints() as $property => $constraint) {
            $propertyMethod = 'get' . ucfirst($property);
            $validateResult = $this->validatorFactory
                ->getInstance($constraint)
                ->validate($entity->{$propertyMethod}(), $constraint);
            if (!$validateResult->isValidated()) {
                $errors[] = $validateResult->getErrorMessage();
            }
        }

        return $errors;
    }
}