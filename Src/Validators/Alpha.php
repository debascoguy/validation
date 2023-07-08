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
        public string $errorMessage = "For [fieldName] - Only characters A through Z are allowed!",
        protected string $regex = '/^[a-z]*$/i',
        protected bool $allowEmpty = false
    ) {
        parent::__construct($this->regex, $this->allowEmpty, $this->errorMessage);
    }

}