<?php

namespace Emma\Validation\Validators;

use Attribute;
use Emma\Common\Utils\DateTimeUtils;

#[Attribute(Attribute::TARGET_PROPERTY)]
class DateValidator extends AbstractValidator
{
    /**
     * @param string $errorMessage
     */
    public function __construct(public string $errorMessage = "[fieldName] is not a valid date value!")
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
        if (DateTimeUtils::isValidDate($value)) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }

}