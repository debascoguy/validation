<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ContainsNumeric extends Pattern
{
    protected string $regex = '/[0-9]/';

    public function __construct(
        protected bool $allowEmpty = false,
        public string $errorMessage = "[fieldName] should contain at least 1 number (e.g: 0 - 9)!"
    ) {
        parent::__construct($this->regex, $this->allowEmpty, $this->errorMessage);
    }

    /**
     * @param mixed $value
     * @param array $context
     * @return bool
     */
    public function validate(mixed $value, array $context = []): bool
    {
        if (empty($value) && $this->allowEmpty) {
            return true;
        }

        if (preg_match_all($this->regex, $value, $o) < 1) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }

}