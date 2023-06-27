<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Length extends AbstractValidator
{
    /**
     * @param int $minLength
     * @param int $maxLength
     * @param string $errorMessage
     */
    public function __construct(
        protected int $minLength,
        protected int $maxLength,
        public string $errorMessage = "Min Length of [minLength] and Max Length of [maxLength] for [fieldName] is required!")
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
        $this->errorMessage = str_replace(
            ["[minLength]", "[maxLength]"],
            [$this->minLength, $this->maxLength],
            $this->errorMessage
        );

        $length = strlen((string)$value);
        if (!($length >= $this->minLength && $length <= $this->maxLength)) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }

}