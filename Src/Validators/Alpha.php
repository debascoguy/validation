<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Alpha extends Pattern
{
    /**
     * @param string $regex
     * @param bool $allowEmpty
     * @param string $errorMessage
     */
    public function __construct(
        protected string $regex = '/^[a-z]*$/i',
        protected bool $allowEmpty = false,
        public string $errorMessage = "For [fieldName] - Only characters A through Z are allowed!")
    {
        parent::__construct($this->errorMessage);
    }

}