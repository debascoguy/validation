<?php

namespace Emma\Validation\Converter;

use Attribute;
use DateTime;
use Emma\ORM\Attributes\Entity\Property\Property;

#[Attribute(Attribute::TARGET_PROPERTY)]
class DateTimeFormat extends Property implements DataTypeConverterInterface
{
    public function __construct(
        public string $inputFormat = "Y-m-d H:i:s",
        public string $outputFormat = "Y-m-d H:i:s",
    ) {

    }

    /**
     * @param mixed $value
     * @param array $context
     * @return string
     * @throws \Exception
     */
    public function formatInput(mixed $value, array $context = []): string
    {
        if ($value instanceof DateTime) {
            return $value->format($this->inputFormat);
        }
        return (new DateTime($value))->format($this->inputFormat);
    }

    /**
     * @param mixed $value
     * @param array $context
     * @return DateTime
     * @throws \Exception
     */
    public function formatOutput(mixed $value, array $context = []): DateTime
    {
        if (is_string($value)) {
            return (new DateTime($value));
        }
        if ($value instanceof DateTime) {
            return $value;
        }
        throw new \Exception("Cannot Convert Value to DateTime!");
    }

    /**
     * @param mixed $value
     * @return string
     * @throws \Exception
     */
    public function toString(mixed $value): string
    {
        if ($value instanceof DateTime) {
            return $value->format($this->outputFormat);
        }
        return (new DateTime($value))->format($this->outputFormat);
    }
}