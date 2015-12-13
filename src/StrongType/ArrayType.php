<?php

namespace StrongType;

use StrongType\Exceptions\CriticalTypeException;

class ArrayType extends Type implements \IteratorAggregate, \Countable
{
    /**
     * @var array $arrayType
     */
    private $arrayType;

    /**
     * @param array $arrayType
     * @throws CriticalTypeException
     */
    public function __construct(array $arrayType)
    {
        $this->typeCheck($arrayType);

        $this->arrayType = $arrayType;
    }

    /**
     * @param mixed $arrayType
     * @throws CriticalTypeException
     */
    public function setType($arrayType)
    {
        $this->typeCheck($arrayType);

        $this->arrayType = $arrayType;
    }
    /**
     * @return int
     */
    public function count()
    {
        return count($this->arrayType);
    }
    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->arrayType);
    }
    /**
     * @return array
     */
    public function toArray()
    {
        return $this->arrayType;
    }
    /**
     * @param mixed $arrayType
     * @throws CriticalTypeException
     */
    private function typeCheck($arrayType)
    {
        if ($arrayType !== null) {
            if (!is_array($arrayType)) {
                throw new CriticalTypeException("ArrayType: ArrayType() constructor called with an argument that is not a array");
            }

            if (empty($arrayType)) {
                throw new CriticalTypeException("String: String() construct argument has to be a non-empty array. Don't pass array() ");
            }
        }
    }
} 