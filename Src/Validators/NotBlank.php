<?php

namespace Emma\Validation\Validators;

use Attribute;
use Emma\Common\Utils\StringManagement;

#[Attribute(Attribute::TARGET_PROPERTY)]
class NotBlank extends AbstractValidator
{
    /**
     * @param string $errorMessage
     */
    public function __construct(public string $errorMessage = "[fieldName] can not be empty!")
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
        $value = StringManagement::stripSpace($value);
        if (empty($value)) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }
}