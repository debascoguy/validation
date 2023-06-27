<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Email extends AbstractValidator
{
    /**
     * @param string $errorMessage
     */
    public function __construct(public string $errorMessage = "[fieldName] is not a valid email address!")
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
        if (empty($value)) {
            return false;
        }

        $value = filter_var($value, FILTER_SANITIZE_EMAIL);
        $isValid = (bool)filter_var($value, FILTER_VALIDATE_EMAIL);
        if (!$isValid) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }
}