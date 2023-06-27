<?php

namespace Emma\Validation\Interfaces;

use Emma\Validation\Error\ValidationError;

interface ValidatorInterface {

    /**
     * @param string $value
     * @param array $context
     * @return bool
     */
    public function validate(string $value, array $context = []): bool;

    /**
     * @param ValidationError|null $error
     * @return mixed
     */
    public function setError(?ValidationError $error): static;

    /**
     * @return ValidationError
     */
    public function getError(): ValidationError;

    /**
     * @return string
     */
    public function getFieldName(): string;

    /**
     * @param string $fieldName
     * @return $this
     */
    public function setFieldName(string $fieldName): static;

}