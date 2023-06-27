<?php

namespace Emma\Validation\Validators;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Size extends AbstractValidator
{
    /**
     * @param int $size
     * @param string $errorMessage
     */
    public function __construct(protected int $size, public string $errorMessage = "Length of [fieldName] is [size] required. Supplied value size is not a valid!")
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
        $this->errorMessage = str_replace("[size]", $context["size"], $this->errorMessage);

        if (strlen((string)$value) != $this->size) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }

}