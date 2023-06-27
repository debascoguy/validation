<?php

namespace Emma\Validation\Resolver;

use Emma\Validation\Error\ValidationError;
use Emma\Validation\Interfaces\ValidatorInterface;

trait ValidationResolver
{
    /**
     * @var array|ValidationError[]
     */
    protected array $errors = [];

    /**
     * @param \ReflectionProperty $property
     * @param mixed $columnValue
     * @param object $entity
     * @return mixed
     */
    public function validateProperty(\ReflectionProperty $property, mixed $columnValue, object $entity): mixed
    {
        $this->errors = [];
        /** @var \ReflectionAttribute[]|array $validatorAttributes */
        $validatorAttributes = $property->getAttributes(ValidatorInterface::class, \ReflectionAttribute::IS_INSTANCEOF);
        if (!empty($validatorAttributes)) {
            $propertyName = $property->getName();
            foreach ($validatorAttributes as $validatorAttribute) {
                /** @var ValidatorInterface $validatorAttributeInstance */
                $validatorAttributeInstance = $validatorAttribute->newInstance();
                $validatorAttributeInstance->setFieldName($propertyName);
                if (!$validatorAttributeInstance->validate($columnValue, [$entity])) {
                    $this->errors[] = $validatorAttributeInstance->getError();
                }
            }
        }
        return $columnValue;
    }

    /**
     * @return array|ValidationError[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}