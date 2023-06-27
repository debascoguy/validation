<?php

namespace Emma\Validation\FormFieldValidator;


use Emma\Validation\FormError;
use Emma\Validation\Interfaces\FormFieldValidatorInterface;

class BooleanValidator implements FormFieldValidatorInterface {

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
        $errorMessage = empty($context["message"]) ? $field." value[".$context["value"]. "] is not a valid boolean!" : $context["message"];
        if (!self::isBoolean($context["value"])){
            $this->setError(new FormError($field, $errorMessage, __METHOD__));
            return false;
        }
        return true;
    }

    /**
     * @param string|int|bool $value
     * @return bool
     */
    public static function isBoolean(string|int|bool $value): bool
    {
        return !is_null(filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE));
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