<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Max extends AbstractValidator
{
    /**
     * @param int $maxValue
     * @param string $errorMessage
     */
    public function __construct(protected int $maxValue, public string $errorMessage = "Maximum size for [fieldName] is [size]. Supplied value size is not a valid!")
    {
        parent::__construct($this->errorMessage);
    }

    public function validate(mixed $value, array $context = []): bool
    {
        $this->errorMessage = str_replace("[size]", $context["size"], $this->errorMessage);

        if ($value > $this->maxValue) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }

}