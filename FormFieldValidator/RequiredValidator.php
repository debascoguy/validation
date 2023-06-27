<?php

namespace Emma\Validation\FormFieldValidator;

use Emma\Validation\FormError;
use Emma\Validation\Interfaces\FormFieldValidatorInterface;

class RequiredValidator implements FormFieldValidatorInterface {

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
        $errorMessage = empty($context["message"]) ? $field . " is required!" : $context["message"];
        if (empty($context["value"]) && $context["value"]!=0){
            $this->setError(new FormError($field, $errorMessage, __METHOD__));
            return false;
        }
        return true;
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