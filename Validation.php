<?php
namespace Emma\Validation;


use Emma\Common\CallBackHandler\CallBackHandler;
use Emma\Common\Utils\StringManagement;
use Emma\Validation\Interfaces\FormFieldValidatorInterface;

/**
 * @Author: Ademola Aina
 * Email: debascoguy@gmail.com
 */
class Validation
{
    /**
     * @var mixed
     */
    private $entity;

    /**
     * @var \ReflectionObject
     */
    private $objectReflector;

    /**
     * @var array
     */
    private $entityFieldValidators;

    /**
     * @var array
     */
    private $cacheValue = [];

    /**
     * @var array|FormError[]
     */
    public $errors;

    /**
     * @var array
     */
    public $errorMessages;


    /**
     * @param $fieldName
     * @return mixed|null
     * @throws \ReflectionException
     */
    public function getValue($fieldName): mixed
    {
        if ($this->objectReflector->hasProperty($fieldName)) {
            $property = $this->objectReflector->getProperty($fieldName);
            $property->setAccessible(true);
            return $property->getValue($this->entity);
        }
        return null;
    }

    /**
     * @param string $fieldName
     * @param callable|array $validator
     * @param array $context
     * @return void
     */
    public function validateField(string $fieldName, callable|array $validator, array $context = []): void
    {
        $context["value"] = $this->cacheValue[$fieldName];
        $status = CallBackHandler::get($validator, [$fieldName, $context], true);
        if ($status instanceof FormError) {
            $this->errors[] = $status;
            $this->errorMessages[] = $status->getErrorMessage();
        }
    }

    /**
     * @return $this
     * @throws \ReflectionException
     */
    public function validate(): static
    {
        foreach ($this->entityFieldValidators as $fieldName => $validators) {
            $message = null;
            if (isset($validators["message"])) {
                $message = $validators["message"];
                unset($validators["message"]);
            }            
            foreach ($validators as $key => $mixed) {
                if (!isset($this->cacheValue[$fieldName])){
                    $this->cacheValue[$fieldName] = $this->getValue($fieldName);
                }

                if ($mixed instanceof FormFieldValidatorInterface) {
                    if (!$mixed->isValid($fieldName, ["message" => $message, "value" => $this->cacheValue[$fieldName]])) {
                        $this->errors[] = $mixed->getError();
                        $this->errorMessages[] = $mixed->getError()->getErrorMessage();
                    }
                }
                else if (is_numeric($key)) {
                    if (is_string($mixed)) {
                        $callable = [
                            FormValidators::class,
                            StringManagement::underscoreToCamelCase($mixed)
                        ];
                        if (is_callable($callable)) {
                            $this->validateField($fieldName, $callable, ["message" => $message]);
                            continue;
                        }
                    }
                    if (is_callable($mixed)) {
                        $this->validateField($fieldName, $mixed, ["message" => $message]);
                    }
                }
                else {
                    $fn = StringManagement::underscoreToCamelCase($key);
                    $callable = [FormValidators::class, $fn];
                    if ("max" == $fn || "min" == $fn || "size" == $fn) {
                        $this->validateField($fieldName, $callable, ["size" => $mixed, "message" => $message]);
                    }
                    else if (method_exists(FormValidators::class, $fn)) {
                        $this->validateField($fieldName, $callable, [$key => $mixed, "message" => $message]);
                    }                      
                }
            }
        }
        return $this;
    }

    /**
     * @param  mixed  $entity
     * @return  self
     */ 
    public function setEntity(object $entity): static
    {
        $this->entity = $entity;
        $this->objectReflector = new \ReflectionObject($this->entity);
        return $this;
    }

    /**
     * @param  array  $entityFieldValidators
     * @return  self
     */ 
    public function setEntityFieldValidators(array $entityFieldValidators): static
    {
        $this->entityFieldValidators = $entityFieldValidators;
        return $this;
    }
}