<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Enum extends AbstractValidator
{
    /**
     * @param string $errorMessage
     */
    public function __construct(
        public array $enumValues = [],
        public bool $caseSensitive = true,
        public string $errorMessage = "[fieldName] is not a valid enum!"
    ) {
        parent::__construct($this->errorMessage);
    }

    /**
     * @param mixed $value
     * @param array $context
     * @return bool
     */
    public function validate(mixed $value, array $context = []): bool
    {
        if (count($this->enumValues) <= 0) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }

        if ($this->caseSensitive && !in_array($value, $this->enumValues)) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }

        if (!$this->caseSensitive && !in_array(strtolower($value), array_map('strtolower', $this->enumValues))) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        
        return true;
    }

}