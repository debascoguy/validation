<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Double extends AbstractValidator
{
    /**
     * @param string $errorMessage
     */
    public function __construct(public string $errorMessage = "[fieldName] is not a valid boolean!")
    {
        parent::__construct($this->errorMessage);
    }

    /**
     * @param mixed $value
     * @param array $context
     * @return bool
     */
    public function validate(mixed $value, array $context = []): bool
    {
        if (!is_double($value)) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }

}