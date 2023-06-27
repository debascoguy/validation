<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class UrlValidator extends AbstractValidator
{
    /**
     * @param string $errorMessage
     */
    public function __construct(public string $errorMessage = "[fieldName] is not a valid url!")
    {
        parent::__construct($this->errorMessage);
    }

    public function validate(mixed $value, array $context = []): bool
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }

}