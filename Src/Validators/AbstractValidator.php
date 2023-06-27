<?php

namespace Emma\Validation\Validators;

use Emma\Validation\Error\ValidationError;
use Emma\Validation\Interfaces\ValidatorInterface;

abstract class AbstractValidator implements ValidatorInterface
{
    private ?ValidationError $validationError = null;

    private string $fieldName;

    public function __construct(public string $errorMessage = "[fieldName] can not be null!")
    {

    }

    /**
     * @param mixed $value
     * @param array $context - Additional Parameters/Conditions that may be needed for validate
     * @return bool
     */
    public function validate(mixed $value, array $context = []): bool
    {
        if (is_null($value)) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }

    /**
     * @param ValidationError|null $error
     * @return $this
     */
    public function setError(?ValidationError $error): static
    {
        $this->validationError = $error;
        return  $this;
    }

    /**
     * @return ValidationError
     */
    public function getError(): ValidationError
    {
        return $this->validationError;
    }

    /**
     * @return string
     */
    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    /**
     * @param string $fieldName
     * @return AbstractValidator
     */
    public function setFieldName(string $fieldName): static
    {
        $this->fieldName = $fieldName;
        return $this;
    }

    /**
     * @param string $methodName
     * @return $this
     */
    public function setDefaultErrorMessage(string $methodName): static
    {
        $this->errorMessage = str_replace("[fieldName]", $this->fieldName, $this->errorMessage);
        $this->setError(ValidationError::create($this->fieldName, $this->errorMessage, $methodName));
        return $this;
    }
}