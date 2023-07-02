<?php

namespace Emma\Validation\Validators;

class IsBase64 extends AbstractValidator
{
    /**
     * @param string $errorMessage
     */
    public function __construct(public string $errorMessage = "[fieldName] is not a valid base 64 string!")
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
        $parentValidate = parent::validate($value, $context);
        try {
            // Check if there are valid base64 characters
            if (!preg_match('/^([A-Za-z0-9+]{4})*([A-Za-z0-9+]{4}|[A-Za-z0-9+]{3}=|[A-Za-z0-9+]{2}==)$/', $value)) {
                $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
                return false;
            }
            if (base64_encode(base64_decode($value, true)) !== $value) {
                $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
                return false;
            }
        } catch (\Exception|\Throwable $e) {
            $this->setDefaultErrorMessage(__CLASS__ . "::" . __METHOD__);
            return false;
        }
        return true;
    }
}