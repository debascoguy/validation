<?php
namespace Emma\Validation;

/**
 * @Author: Ademola Aina
 * Email: debascoguy@gmail.com
 */
class FormError
{
    /**
     * @var string
     */
    protected string $fieldName;

    /**
     * @var string
     */
    protected string $errorMessage;

    /**
     * @var object|string
     */
    protected object|string $validator;


    /**
     * @param string $fieldName;
     * @param string $errorMessage;
     * @param string $validator;
     */
    public function __construct(string $fieldName, string $errorMessage, object|string $validator)
    {
        $this->setFieldName($fieldName)->setErrorMessage($errorMessage)->setValidator($validator);
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
     * @return static
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
     * @return static
     */
    public function setErrorMessage(string $errorMessage): static
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    /**
     * @return object|string
     */
    public function getValidator(): object|string
    {
        return $this->validator;
    }

    /**
     * @param object|string $validator
     * @return static
     */
    public function setValidator(object|string $validator): static
    {
        $this->validator = $validator;
        return $this;
    }
}