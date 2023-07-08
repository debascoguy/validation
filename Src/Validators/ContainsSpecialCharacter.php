<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class ContainsSpecialCharacter extends Pattern
{
    public function __construct(
        public string $errorMessage = "[fieldName] should contain at least a one of the special character (!@#$%^&*()\-_=+{};:,<.>)!",
        protected bool $allowEmpty = false,
        protected string $regex = '/[!@#$%^&*()\-_=+{};:,<.>]/'
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