<?php

namespace Emma\Validation\Converter;

interface DataTypeConverterInterface
{
    public function formatInput(mixed $value, array $context): mixed;

    public function formatOutput(mixed $value, array $context): mixed;

    public function toString(mixed $value): string;
}