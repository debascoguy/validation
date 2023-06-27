<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class MinLength extends AbstractValidator
{
    /**
     * @param int $minLength
     * @param string $errorMessage
     */
    public function __construct(
        protected int $minLength,
        public string $errorMessage = "Min Length of [minLength] for [fieldName] is required!")
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
        $this->errorMessage = str_replace("[minLength]", $this->minLength, $this->errorMessage);

        if (strlen((string)$value) < $this->minLength) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }

}