<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class MaxLength extends AbstractValidator
{
    /**
     * @param int $maxLength
     * @param string $errorMessage
     */
    public function __construct(
        protected int $maxLength,
        public string $errorMessage = "Max Length of [maxLength] for [fieldName] is required!")
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
        $this->errorMessage = str_replace("[maxLength]", $this->maxLength, $this->errorMessage);

        if (strlen((string)$value) > $this->maxLength) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }

}