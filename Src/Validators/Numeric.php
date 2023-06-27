<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Numeric extends AbstractValidator
{
    /**
     * @param string $errorMessage
     */
    public function __construct(public string $errorMessage = "[fieldName] is not a valid numeric value!")
    {
        parent::__construct($this->errorMessage);
    }

    public function validate(mixed $value, array $context = []): bool
    {
        if (!is_numeric($value)){
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }

}