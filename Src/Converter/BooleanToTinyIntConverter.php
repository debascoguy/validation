<?php

namespace Emma\Validation\Converter;

use Attribute;
use Emma\ORM\Attributes\Entity\Property\Property;

#[Attribute(Attribute::TARGET_PROPERTY)]
class BooleanToTinyintConverter extends Property implements DataTypeConverterInterface
{
    public function __construct() {

    }

    /**
     * @param mixed $value
     * @param array $context
     * @return int
     * @throws \Exception
     */
    public function formatInput(mixed $value, array $context = []): int
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ? 1 : 0;
    }

    /**
     * @param mixed $value
     * @param array $context
     * @return bool
     * @throws \Exception
     */
    public function formatOutput(mixed $value, array $context = []): bool
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }

    /**
     * @param mixed $value
     * @return string
     * @throws \Exception
     */
    public function toString(mixed $value): string
    {
        return (string) $this->formatInput($value);
    }
}