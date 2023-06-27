<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class AlphaNumeric extends Pattern
{
    /**
     * @param string $regex
     * @param bool $allowEmpty
     * @param string $errorMessage
     */
    public function __construct(
        protected string $regex = '/^[a-z0-9\-\.\_\,]*$/i',
        protected bool $allowEmpty = false,
        public string $errorMessage = "For [fieldName] - Only a-z, 0-9, -, ., _ and space character allowed!")
    {
        parent::__construct($this->errorMessage);
    }

}