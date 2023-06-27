<?php

namespace Emma\Validation;

use ArrayIterator;
use Emma\Validation\Interfaces\ValidationInterface;
use Emma\Validation\Resolver\{DataTypeConverterResolver};
use Emma\Validation\Resolver\ValidationResolver;

class Validator implements ValidationInterface
{
    use DataTypeConverterResolver;
    use ValidationResolver;

    /**
     * @param object $entity
     * @return ArrayIterator
     */
    public static function validate(object $entity): ArrayIterator
    {
        $instance = new self();
        return $instance->validateObject($entity);
    }

    /**
     * @param object $entity
     * @param array $fieldValuesPair
     * @return ArrayIterator
     */
    public function validateObject(object $entity, array &$fieldValuesPair = []): ArrayIterator
    {
        $allErrors = [];
        $reflection = new \ReflectionObject($entity);
        $properties = $reflection->getProperties();
        foreach ($properties as $property) {
            $columnValue = $this->resolveInput($property, $property->getValue($entity));
            $fieldValuesPair[$property->getName()] = $this->validateProperty($property, $columnValue, $entity);
            $errors = $this->getErrors();
            if (!empty($errors)) {
                $allErrors[$property->getName()] = $errors;
            }
        }
        return new ArrayIterator($allErrors);
    }

}