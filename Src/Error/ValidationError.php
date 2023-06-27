<?php
namespace Emma\Validation\Error;

/**
 * @Author: Ademola Aina
 * Email: debascoguy@gmail.com
 */
class ValidationError
{
    /**
     * @var string
     */
    protected string $fieldName = "";

    /**
     * @var string
     */
    protected string $errorMessage = "";

    /**
     * @var string
     */
    protected string $validator = "";


    /**
     * @param string $fieldName;
     * @param string $errorMessage;
     * @param string $validator;
     */
    public static function create(string $fieldName, string $errorMessage, string $validator): static
    {
        return (new self())->setFieldName($fieldName)->setErrorMessage($errorMessage)->setValidator($validator);
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
     * @return ValidationError
     */
    public function setFieldName(string $fieldName): static
    {
        $this->fieldName = $fieldName;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     * @return ValidationError
     */
    public function setErrorMessage(string $errorMessage): static
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    /**
     * @return string
     */
    public function getValidator(): string
    {
        return $this->validator;
    }

    /**
     * @param string $validator
     * @return ValidationError
     */
    public function setValidator(string $validator): static
    {
        $this->validator = $validator;
        return $this;
    }
}