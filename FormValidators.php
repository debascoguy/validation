<?php
namespace Emma\Validation;


use Emma\Common\Utils\DateTimeUtils;
use Emma\Validation\FormFieldValidator\BooleanValidator;
use Emma\Validation\FormFieldValidator\EmailValidator;

/**
 * @Author: Ademola Aina
 * Email: debascoguy@gmail.com
 */
class FormValidators
{
    public static function required($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? $field . " is required!" : $context["message"];
        return empty($context["value"]) && $context["value"]!=0 && $context["value"]!=false ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

    public static function string($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? $field." value[".$context["value"]. "] is a string!" : $context["message"];
        return !is_string($context["value"]) ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

    public static function numeric($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? $field." value[".$context["value"]. "] is not numeric!" : $context["message"];
        return !is_numeric($context["value"]) ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

    public static function float($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? $field." value[".$context["value"]. "] is not float!" : $context["message"];
        return !is_float($context["value"] + 0) ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

    public static function double($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? $field." value[".$context["value"]. "] is not float!" : $context["message"];
        return !is_double($context["value"] + 0) ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

    public static function int($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? $field." value[".$context["value"]. "] is not integer!" : $context["message"];
        return !is_int($context["value"] + 0) ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

    public static function email($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? $field." value[".$context["value"]. "] is not a valid email!" : $context["message"];
        return !EmailValidator::isEmailValid($context["value"]) ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

    public static function boolean($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? $field." value[".$context["value"]. "] is not a valid boolean!" : $context["message"];
        return !BooleanValidator::isBoolean($context["value"]) ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

    public static function date($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? $field." value is not a valid date!" : $context["message"];
        return (!DateTimeUtils::isValidDate($context["value"])) ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

    public static function max($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? "Maximum size for '".$field."' is ".$context["size"]. ". Size supplied: ".strlen($context["value"]) : $context["message"];
        return strlen($context["value"]) > (int)$context["size"] ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

    public static function min($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? "Minimum size for '".$field."' is ".$context["size"]. ". Size supplied: ".strlen($context["value"]) : $context["message"];
        return strlen($context["value"]) < (int)$context["size"] ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

    public static function size($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? "Length of '".$field."' is ".$context["size"]. ". Size supplied: ".strlen($context["value"]) : $context["message"];
        return strlen($context["value"]) != (int)$context["size"] ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

    public static function url($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? $field." value[".$context["value"]. "] is not a valid boolean!" : $context["message"];
        return !filter_var($context["value"], FILTER_VALIDATE_URL) ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

    public static function ipAddress($field, array $context): true|FormError
    {
        $errorMessage = empty($context["message"]) ? $field." value[".$context["value"]. "] is not a valid boolean!" : $context["message"];
        return !filter_var($context["value"], FILTER_VALIDATE_IP) ? new FormError($field, $errorMessage, __METHOD__) : true;
    }

}