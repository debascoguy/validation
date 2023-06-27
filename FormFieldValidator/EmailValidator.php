<?php

namespace Emma\Validation\FormFieldValidator;

use Emma\Validation\FormError;
use Emma\Validation\Interfaces\FormFieldValidatorInterface;

class EmailValidator implements FormFieldValidatorInterface {
    /**
     * @var FormError|null
     */
    protected ?FormError $error;

    /**
     * @param string $field
     * @param array $context
     * @return bool
     */
    public function isValid(string $field, array $context): bool
    {
        $errorMessage = empty($context["message"]) ? $field." value[".$context["value"]. "] is not a valid email!" : $context["message"];
        if (!self::isEmailValid($context["value"])){
            $this->setError(new FormError($field, $errorMessage, __METHOD__));
            return false;
        }
        return true;
    }

    /**
     * Validate an email address.
     *
     * @param string $possible_email An email address to validate
     * @return bool
     */
    public static function isEmailValid(string $possible_email): bool
    {
        if (empty($possible_email)) {
            return false;
        }
        $possible_email = filter_var($possible_email, FILTER_SANITIZE_EMAIL);
        return (bool)filter_var($possible_email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @return  FormError|null
     */
    public function getError(): ?FormError
    {
        return $this->error;
    }

    /**
     * @param FormError|null $error
     * @return  self
     */
    public function setError(?FormError $error): static
    {
        $this->error = $error;
        return $this;
    }

}