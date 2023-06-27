<?php

namespace Emma\Validation\Interfaces;
use ArrayIterator;

interface ValidationInterface
{
    public function validateObject(object $entity, array &$fieldValuesPair = []): ArrayIterator;

    public static function validate(object $entity): ArrayIterator;


}