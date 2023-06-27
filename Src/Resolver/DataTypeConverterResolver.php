<?php

namespace Emma\Validation\Resolver;

use Emma\Validation\Converter\DataTypeConverterInterface;
use ReflectionProperty;

trait DataTypeConverterResolver
{

    /**
     * @param ReflectionProperty $property
     * @param mixed $value
     * @param array $context
     * @return mixed
     */
    public function resolveInput(ReflectionProperty $property, mixed $value, array $context = []): mixed
    {
        /** @var \ReflectionAttribute[]|array $customAttributeInterfaces */
        $customAttributeInterfaces = $property->getAttributes(DataTypeConverterInterface::class, \ReflectionAttribute::IS_INSTANCEOF);
        if (empty($customAttributeInterfaces)) {
            return $value;
        }
        foreach($customAttributeInterfaces as $attribute) {
            /** @var DataTypeConverterInterface $formatValueInstance */
            $formatValueInstance = $attribute->newInstance();
            $value = $formatValueInstance->formatInput($value, $context);
        }
        return $value;
    }

    /**
     * @param ReflectionProperty $property
     * @param mixed $value
     * @param array $context
     * @return mixed
     */
    public function resolveOutput(ReflectionProperty $property, mixed $value, array $context = []): mixed
    {
        /** @var \ReflectionAttribute[]|array $customAttributeInterfaces */
        $customAttributeInterfaces = $property->getAttributes(DataTypeConverterInterface::class, \ReflectionAttribute::IS_INSTANCEOF);
        if (empty($customAttributeInterfaces)) {
            return $value;
        }
        foreach($customAttributeInterfaces as $attribute) {
            /** @var DataTypeConverterInterface $formatValueInstance */
            $formatValueInstance = $attribute->newInstance();
            $value = $formatValueInstance->formatOutput($value, $context);
        }
        return $value;
    }
}