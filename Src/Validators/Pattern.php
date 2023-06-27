<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Pattern extends AbstractValidator
{
    /**
     * @param string $regex
     * @param bool $allowEmpty
     * @param string $errorMessage
     */
    public function __construct(
        protected string $regex,
        protected bool $allowEmpty = false,
        public string $errorMessage = "[fieldName] is not a valid!")
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
        if (empty($value) && $this->allowEmpty) {
            return true;
        }

        $status = preg_match($this->regex, $value ?? '');
        if ($status == 0 || !$status) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }

}