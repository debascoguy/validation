<?php

namespace Emma\Validation\Interfaces;


use Emma\Validation\FormError;

interface FormFieldValidatorInterface {

    /**
     * @param string $field
     * @param array $context
     * @return bool
     */
    public function isValid(string $field, array $context): bool;

    /**
     * @param FormError|null $error
     */
    public function setError(?FormError $error);

    /**
     * @return null|FormError $error
     */
    public function getError(): ?FormError;
}