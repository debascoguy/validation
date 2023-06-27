<?php

namespace Emma\Validation\FormFieldValidator;

use DateTime;
use Emma\Validation\FormError;
use Emma\Validation\Interfaces\FormFieldValidatorInterface;

class DateValidator implements FormFieldValidatorInterface {

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
        $errorMessage = empty($context["message"]) ? $field." value[".$context["value"]. "] is not a valid date!" : $context["message"];
        if ($context["value"] instanceof DateTime) {
            $context["value"] = $context["value"]->format("m/d/Y");
        }
        if (empty($context["value"]) || date("m/d/Y", strtotime($context["value"])) == "12/31/1969"){
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