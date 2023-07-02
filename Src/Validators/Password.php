<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Password extends AbstractValidator
{
    /**
     * @param string $errorMessage
     * @param ContainsUpperCase|null $containsUpperCase
     * @param ContainsLowerCase|null $containsLowerCase
     * @param ContainsNumeric|null $containsNumeric
     * @param ContainsSpecialCharacter|null $containsSpecialCharacter
     * @param MinLength|null $minLength
     * @param MaxLength|null $maxLength
     */
    public function __construct(
        protected ?ContainsUpperCase $containsUpperCase = new ContainsUpperCase(),
        protected ?ContainsLowerCase $containsLowerCase = new ContainsLowerCase(),
        protected ?ContainsNumeric $containsNumeric = new ContainsNumeric(),
        protected ?ContainsSpecialCharacter $containsSpecialCharacter = new ContainsSpecialCharacter(),
        protected ?MinLength $minLength = new MinLength(8),
        protected ?MaxLength $maxLength = new MaxLength(32),
        public string $errorMessage = "[fieldName] is not a valid password!"
    )
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

        if ($this->containsUpperCase && !$this->containsUpperCase->validate($value, $context)) {
            $this->errorMessage = $this->containsUpperCase->errorMessage;
            $this->setError($this->containsUpperCase->getError());
            return false;
        }
        if ($this->containsLowerCase && !$this->containsLowerCase->validate($value, $context)) {
            $this->errorMessage = $this->containsLowerCase->errorMessage;
            $this->setError($this->containsLowerCase->getError());
            return false;
        }
        if ($this->containsNumeric && !$this->containsNumeric->validate($value, $context)) {
            $this->errorMessage = $this->containsNumeric->errorMessage;
            $this->setError($this->containsNumeric->getError());
            return false;
        }
        if ($this->containsSpecialCharacter && !$this->containsSpecialCharacter->validate($value, $context)) {
            $this->errorMessage = $this->containsSpecialCharacter->errorMessage;
            $this->setError($this->containsSpecialCharacter->getError());
            return false;
        }
        if ($this->minLength && !$this->minLength->validate($value, $context)) {
            $this->errorMessage = $this->minLength->errorMessage;
            $this->setError($this->minLength->getError());
            return false;
        }
        if ($this->maxLength && !$this->maxLength->validate($value, $context)) {
            $this->errorMessage = $this->maxLength->errorMessage;
            $this->setError($this->maxLength->getError());
            return false;
        }
        return true;
    }

}