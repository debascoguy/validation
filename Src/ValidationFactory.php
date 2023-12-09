<?php

namespace Emma\Validation;

use ArrayIterator;
use Emma\Common\Factory\ObjectFactory;
use Emma\Validation\Interfaces\ValidationInterface;

class ValidationFactory extends ObjectFactory implements ValidationInterface
{
    /**
     * @var ValidationInterface
     */
    protected ValidationInterface $validation;

    /**
     * @param object|string|null $noParamNeeded
     * @return $this
     */
    public function make(object|string $noParamNeeded = null): static
    {
        $this->validation = new Validator();
        return $this;
    }

    /**
     * @param object $entity
     * @param array $fieldValuesPair
     * @return ArrayIterator
     */
    public function validateObject(object $entity, array &$fieldValuesPair = []): ArrayIterator
    {
        return $this->validation->validateObject($entity, $fieldValuesPair);
    }

    /**
     * @param object $entity
     * @return ArrayIterator
     */
    public static function validate(object $entity): ArrayIterator
    {
        $self = new self();
        return $self->make()->validateObject($entity);
    }
}